<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mod_static_pages
 *
 * @author Anwar
 */
class mod_static_pages extends Model {

    function __construct() {
        parent::Model();
    }

    function get_page_grid() {
        $sortname = common::getVar('sidx', 'page_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $searchField = common::getVar('searchField');
        $searchValue = common::getVar('searchValue');
        $status = $_REQUEST['status'];
        $con = '1';
        if ($searchField != '' && $searchValue != '') {
            $con.=" and $searchField like '%$searchValue%'";
        }

        if ($status != '') {
            if ($status == '00') {
                $status = 0;
            }
            $con.=" and status like '%$status%'";
        }

        $sql = "select * from static_pages where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('static_pages', $con);
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

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;

        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;

        foreach ($rows as $row) {
            $status = $row[status] == 1 ? 'Active' : 'Inactive';
            $responce->rows[$i]['id'] = $row['page_id'];
            $index = strrpos($row['page_name'], "_");
            if ($index > 0) {
                $page_name = substr($row['page_name'], 0, $index);
                $responce->rows[$i]['cell'] = array($page_name, $row['page_title'], $status);
            } else {
                $responce->rows[$i]['cell'] = array($row['page_name'], $row['page_title'], $status);
            }
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

    function save_page() {
        $page_name = $_POST['page_name'] . "_" . time();
        write_file(FRONT_END . "views/static/" . $page_name . ".php", $_POST['page_des'], "w+");
        $sql = "insert into static_pages set 
                    page_language={$this->db->escape($_POST['page_language'])},
                    page_category={$this->db->escape($_POST['page_category'])},
                    page_name={$this->db->escape($page_name)},
                    page_title={$this->db->escape($_POST['page_title'])}";
        return $this->db->query($sql);
    }

    function update_page($page_id='') {
        //$page_id=  $this->session->userdata('edit_page_id');
        $data = sql::row('static_pages', "page_id='$page_id'");
        if ($data['page_name'] != $_POST['page_name']) {
            @unlink(FRONT_END . "views/static/" . $data['page_name'] . '.php');
        }
        $page_name = $_POST['page_name'] . "_" . time();
        write_file(FRONT_END . "views/static/" . $page_name . ".php", $_POST['page_des'], "w+");
        $sql = "update static_pages set
                    page_language={$this->db->escape($_POST['page_language'])},
                    page_category={$this->db->escape($_POST['page_category'])},
                    page_name={$this->db->escape($page_name)},
                    page_title={$this->db->escape($_POST['page_title'])}
                    where page_id='$page_id'";
        return $this->db->query($sql);
    }

    function get_search_options($sel='') {
        $arr = array(
            'page_name' => 'Page Name',
            'page_title' => 'Page Title'
        );
        $opt = '';
        foreach ($arr as $key => $value) {
            if ($sel == $key) {
                $opt.="<option value='$key' selected='selected'>$value</option>";
            } else {
                $opt.="<option value='$key'>$value</option>";
            }
        }
        return $opt;
    }

    function get_page_category($sel='') {
        $rows =array(1=>'Help',2=>"Guideline",4=>"New Declaration",3=>"Others");
        $opt.="<option value='3'>Others</option>";
        foreach ($rows as $key=>$value) {
            if ($key == $sel) {
                $opt.='<option value="' . $key . '" selected="selected">' . $value . '</option>';
            } else {
                $opt.='<option value="' . $key . '">' . $value . '</option>';
            }
        }
        return $opt;
    }

    function get_language_opt($sel='') {
        $rows =array(1=>'Bengali',2=>"English");
        $opt.="<option value='2'>English</option>";
        foreach ($rows as $key=>$value) {
            if ($key == $sel) {
                $opt.='<option value="' . $key . '" selected="selected">' . $value . '</option>';
            } else {
                $opt.='<option value="' . $key . '">' . $value . '</option>';
            }
        }
        return $opt;
    }

}

?>
