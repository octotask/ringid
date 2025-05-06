<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mod_site
 *
 * @author tamal
 */
class mod_site extends Model {

    function mod_site() {
        parent::Model();
    }

    function save_news() {
        $sql = "insert into site_content set
                company_name={$this->db->escape($_POST['company_name'])},
                news_title={$this->db->escape($_POST['news_title'])},
                news_description={$this->db->escape($_POST['news_description'])},
                status={$this->db->escape($_POST['status'])},
                date={$this->db->escape(date("Y-m-d H:i:s"))}";
        $flag= $this->db->query($sql);
        $id=$this->db->insert_id();
        $this->send_newsMail('site_content', $id);
        return $flag;
    }

    function save_news_link() {
        $sql = "insert into news_link set
                language={$this->db->escape($_POST['language'])},
                company_name={$this->db->escape($_POST['company_name'])},
                news_title={$this->db->escape($_POST['news_title'])},
                news_description={$this->db->escape($_POST['news_description'])},
                news_link={$this->db->escape(strip_tags($_POST['news_link']))},
                status={$this->db->escape($_POST['status'])},
                date={$this->db->escape(date("Y-m-d H:i:s"))}";
        return $this->db->query($sql);
        $id=$this->db->insert_id();
        $this->send_newsMail('news_link', $id);
        return $flag;
    }

    function save_about_us() {
        $sql = "insert into about_us set
                title={$this->db->escape($_POST['title'])},
                description={$this->db->escape($_POST['description'])},
                status={$this->db->escape($_POST['status'])}";
        return $this->db->query($sql);
    }

    function save_admin_email() {
        $sql = "insert into admin_email set
                admin_name={$this->db->escape($_POST['admin_name'])},
                admin_email={$this->db->escape($_POST['admin_email'])},
                status={$this->db->escape($_POST['status'])}";
        return $this->db->query($sql);
    }

    function get_news_linkGrid($is_archive=0) {
        $sortname = common::getVar('sidx', 'date');
        $sortorder = common::getVar('sord', 'desc');
        $sort = "ORDER BY $sortname $sortorder";
        $sql = "select * from news_link where is_archive=$is_archive $sort";
        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $tmp = $this->db->query($sql);
        $count = count($tmp->result_array());
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 5;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        if ($limit < 0)
            $limit = 0;
        $start = $limit * $page - $limit;
        if ($start < 0)
            $start = 0;
        $sql_query = $this->db->query($sql . " limit $start, $limit");
        $rows = $sql_query->result_array();
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        foreach ($rows as $row) {
            $status = $row[status] == 1 ? 'Active' : 'Inactive';
            $links = $this->word_limiter(trim(strip_tags($row['news_link'])), 5);
            $responce->rows[$i]['id'] = $row['id'];
            $responce->rows[$i]['cell'] = array($row['company_name'], $row['news_title'], $links, $status, $row['date']);
            $i++;
        }
        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author: Md. Anwar Hossain");
        header("Email: anwarworld@gmail.com");
        header("Content-type: text/x-json");
        echo json_encode($responce);
        return '';
    }

    function get_about_us_grid() {
        $sortname = common::getVar('sidx', 'id');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        $sql = "select * from about_us where 1 $sort";
        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $tmp = $this->db->query($sql);
        $count = count($tmp->result_array());
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 5;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        if ($limit < 0)
            $limit = 0;
        $start = $limit * $page - $limit;
        if ($start < 0)
            $start = 0;
        $sql_query = $this->db->query($sql . " limit $start, $limit");
        $rows = $sql_query->result_array();
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        foreach ($rows as $row) {
            $responce->rows[$i]['id'] = $row['id'];
            $responce->rows[$i]['cell'] = array($row['id'], $row['title'], $row['description'], $row['status']);
            $i++;
        }
        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author: Md. Anwar Hossain");
        header("Email: anwarworld@gmail.com");
        header("Content-type: text/x-json");
        echo json_encode($responce);
        return '';
    }

    function get_admin_setting_data() {
        $sortname = common::getVar('sidx', 'id');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        $sql = "select * from admin_email where 1 $sort";
        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $tmp = $this->db->query($sql);
        $count = count($tmp->result_array());
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 5;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        if ($limit < 0)
            $limit = 0;
        $start = $limit * $page - $limit;
        if ($start < 0)
            $start = 0;
        $sql_query = $this->db->query($sql . " limit $start, $limit");
        $rows = $sql_query->result_array();
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        foreach ($rows as $row) {
            $responce->rows[$i]['id'] = $row['id'];
            $responce->rows[$i]['cell'] = array($row['id'], $row['admin_name'], $row['admin_email'], $row['status']);
            $i++;
        }
        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author: Md. Anwar Hossain");
        header("Email: anwarworld@gmail.com");
        header("Content-type: text/x-json");
        echo json_encode($responce);
        return '';
    }

    function update_admin() {
        $current_userid = $this->session->userdata('user_id');
        $data = array(
            'user_name' => $_POST['user_name'],
            'password' => $_POST['password'],
        );

        return $this->db->update('user', $data, array('user_id' => $current_userid));
    }

    function add_admin() {
        $sql = "insert into user set
                user_name={$this->db->escape($_POST['user_name'])},
                password={$this->db->escape($_POST['password'])}";
        return $this->db->query($sql);
    }

    function word_limiter($str, $limit = 100, $end_char = '&#8230;') {
        if (trim($str) == '') {
            return $str;
        }
        preg_match('/^\s*+(?:\S++\s*+){1,' . (int) $limit . '}/', $str, $matches);

        if (strlen($str) == strlen($matches[0])) {
            $end_char = '';
        }

        return rtrim($matches[0]) . $end_char;
    }

    //Ipo Form Related
    function get_ipo_form_list() {
        $sortname = common::getVar('sidx', 'id');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        $sql = "select * from ipo_form where 1 $sort";
        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $tmp = $this->db->query($sql);
        $count = count($tmp->result_array());
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 5;
        }
        if ($page > $total_pages)
            $page = $total_pages;
        if ($limit < 0)
            $limit = 0;
        $start = $limit * $page - $limit;
        if ($start < 0)
            $start = 0;

        $sql_query = $this->db->query($sql . " limit $start, $limit");
        $rows = $sql_query->result_array();
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        foreach ($rows as $row) {
            $status = $row[status] == 1 ? 'Active' : 'Inactive';
            $responce->rows[$i]['id'] = $row['id'];
            $responce->rows[$i]['cell'] = array($row['id'], $row['company_name'], $row['company_description'], $status);
            $i++;
        }
        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author: Md. Anwar Hossain");
        header("Email: anwarworld@gmail.com");
        header("Content-type: text/x-json");
        echo json_encode($responce);

        return '';
    }

    function save_ipo_form() {
        //$data = $this->upload->data();
        $file_name='';
        if($_FILES['file_name']['name']!=''){
            $file_name=$this->save_file();
            //print_r($_FILES);
        }
        $sql = "insert into ipo_form set
                company_name={$this->db->escape($_POST['company_name'])},
                company_description={$this->db->escape($_POST['company_description'])},
                file_name={$this->db->escape($file_name)},
                status={$this->db->escape($_POST['status'])}";
        return $this->db->query($sql);
    }
    function save_file($pre_image=''){
        $flash = "";
        $param['dir'] = UPLOAD_PATH . "ipoform/";
        $param['type'] = 'doc,docx,xml,pdf,jpg,gif,png,jpeg';
        $this->load->library('zupload', $param);
        if ($pre_file != "") {
            $this->zupload->delFile($pre_file);
        }
        $this->zupload->setFileInputName("file_name");
        $this->zupload->upload(true);
        $flash = $this->zupload->getOutputFileName();

        return $flash;
    }

    function get_single_entry($id='') {
        $sql = "select * from ipo_form where id='$id'";
        $sql_query = $this->db->query($sql);
        $row = $sql_query->row_array();
        return $row;
    }

    function get_company_options($sel='') {
        $rows = sql::rows('company_names', "company_name NOT REGEXP 'T[0-9]+Y[0-9]+'", 'company_name');
        $opt = '<option value="Common News">Common News</option>';
        foreach ($rows as $row) {
            if ($row['company_name'] == $sel) {
                $opt.='<option value="' . $row['company_name'] . '" selected="selected">' . $row['company_name'] . '</option>';
            } else {
                $opt.='<option value="' . $row['company_name'] . '">' . $row['company_name'] . '</option>';
            }
        }
        return $opt;
    }

    function send_newsMail($table='news_link', $news_id='') {
        $data = sql::row($table, "id='$news_id'");
        $subject = $data['news_title'];

        $sql = $this->db->query("select distinct(u.id),u.* from site_user as u
                                 join interest_company as c on c.user_id=u.id
                                 where c.company_name='{$data['company_name']}' and u.email!=''");
        $rows = $sql->result_array();
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                $msg = '<div style="font-size:15px;border:1px solid #ddd;">
                     <h3><a href="http://www.bdstock4u.com">BDStock4U.Com</a></h3>
                    <hr />
                    <div style="padding:10px;">
                        <span>Dear ' . $row['first_name'] . ' ' . $row['last_name'] . ',</span>
                        <p>You have been received this message from BDStock4U.Com</p>
                        <p>' . $data['news_description'] . '</p>
                        <br />Thank you,<br />
                        BDStock4U.Com Online Support
                    </div>
                </div>';
                common::mail_sending('flamma@flammabd.com', 'www.bdstock4u.com', $row['email'], $subject, $msg);
            }
        }
    }

}
?>
