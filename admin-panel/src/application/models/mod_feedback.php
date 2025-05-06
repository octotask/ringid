<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mod_feedback
 *
 * @author Anwar
 */
class mod_feedback extends Model {

    function __construct() {
        parent::Model();
    }

    function get_feedbackGrid() {
        $sortname = common::getVar('sidx', 'feedback_id');
        $sortorder = common::getVar('sord', 'desc');
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
            $con.=" and l.status like '%$status%'";
        }

        $sql = "select * from feedback where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $r = $this->db->query($sql);
        $count = count($r->result_array());
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

        $i = 0;
        foreach ($rows as $row) {
            $status = $row[status] == 1 ? 'Active' : 'Inactive';
            $responce->rows[$i]['id'] = $row['feedback_id'];
            $responce->rows[$i]['cell'] = array($row['first_name'] . ' ' . $row['last_name'], $row['email'], $row['phone'], $row['comments'], $row['feedback_reply'], $status);
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

    function get_search_options($sel='') {
        $arr = array(
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email Address',
            'compnay' => 'Company Name',
            'phone' => 'Phone Number',
            'comments' => 'Comments'
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

    function send_feedbackmessage($feedback_id='') {
        $data = sql::row('feedback', "feedback_id=$feedback_id");
        $subject = "Registration Successful";
        $msg = '<div style="font-size:15px;border:1px solid #ddd;">
                     <h3><a href="http://www.bdstock4u.com">BDStock4U.Com</a></h3>
                    <hr />
                    <div style="padding:10px;">
                        <span>Dear ' . $data['first_name'] . ' ' . $data['last_name'] . ',</span>
                        <p>You have been submitted a query to us!<br /> Your query to us: <br />'.nl2br($data['comments']).'</p>
                        <p><strong>Reply Message: </strong><br />'.nl2br($data['feedback_reply']).'</p>
                        <br />Thank you,<br />
                        BDStock4U.Com Online Support
                    </div>
                </div>';
        common::mail_sending('flamma@flammabd.com', 'www.bdstock4u.com', $data['email'], $subject, $msg);
    }

}
?>
