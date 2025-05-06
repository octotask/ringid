<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mod_company
 *
 * @author Anwar
 */
class mod_company extends Model {

    function __construct() {
        parent::Model();
    }

    function get_companyGrid() {
        $sortname = common::getVar('sidx', 'company_id');
        $sortorder = common::getVar('sord', 'desc');
        $sort = "ORDER BY $sortname $sortorder";

        $searchField = common::getVar('searchField');
        $searchValue = common::getVar('searchValue');
        $status = $_REQUEST['status'];

        $con = '1';
        if ($searchField != '' && $searchValue != '') {
            $con.=" and $searchField like '%$searchValue%'";
        }

        $sql = "select * from company_info where $con $sort";

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
            $responce->rows[$i]['id'] = $row['company_id'];
            $responce->rows[$i]['cell'] = array($row['company_name'], $row['eps'], $row['p_e'], $row['authorize_capital'], $row['paidup_capital'],$row['face_value'], $row['lot'], $row['no_of_share'],$status);
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
            'company_name' => 'Company Name',
            'eps' => 'EPS',
            'p_e' => 'P/E',
            'authorize_capital' => 'Authorize Capital',
            'paidup_capital' => 'Paid up Capital',
            'face_value' => 'Face Value'
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

    function get_company_options($sel='') {
        $rows = sql::rows('company_names', "company_name NOT REGEXP 'T[0-9]+Y[0-9]+'", 'company_name');
        $opt = '<option value="">Select Company Name</option>';
        foreach ($rows as $row) {
            if ($row['company_name'] == $sel) {
                $opt.='<option value="' . $row['company_name'] . '" selected="selected">' . $row['company_name'] . '</option>';
            } else {
                $opt.='<option value="' . $row['company_name'] . '">' . $row['company_name'] . '</option>';
            }
        }
        return $opt;
    }

    function get_industry_options($sel='') {
        $rows = sql::rows('industry_names','1 order by industry_name ASC');
        $opt = '<option value="">Select Industry Name</option>';
        foreach ($rows as $row) {
            if ($row['industry_id'] == $sel) {
                $opt.='<option value="' . $row['industry_id'] . '" selected="selected">' . $row['industry_name'] . '</option>';
            } else {
                $opt.='<option value="' . $row['industry_id'] . '">' . $row['industry_name'] . '</option>';
            }
        }
        return $opt;
    }
}
?>