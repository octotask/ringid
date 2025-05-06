<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ipo_form
 *
 * @author tamal
 */
class ipo_form extends Controller {

    function __construct() {
        parent::Controller();
        $this->load->model('mod_site');
        common::is_logged();
    }

    function index() {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array("id", "Company Name", "Description", "Status");
        $gridColumnModel = array(
            array("name" => "id",
                "index" => "id",
                "width" => 40,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "company_name",
                "index" => "company_name",
                "width" => 90,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "company_description",
                "index" => "company_description",
                "width" => 150,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "status",
                "index" => "status",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => false
            )
        );
        $gridObj->setGridOptions("IPO Form listing", 880, 250, "id", "asc", $gridColumn, $gridColumnModel, site_url('ipo_form/get_ipo_form_list'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['upload_success_msg'] = $this->session->flashdata('upload_success_msg');
        $data['dir'] = 'ipo_form';
        $data['page'] = 'ipo_form_listing';
        $this->load->view('main', $data);
    }

    function get_ipo_form_list() {
        $this->mod_site->get_ipo_form_list();
    }

    function add_ipo_form() {

        if ($_POST['save']) {
            if ($this->form_validation->run('upload_ipo_file')) {
                $this->mod_site->save_ipo_form();
                $this->session->set_flashdata('msg', "Content Added");
                $this->session->set_flashdata('upload_success_msg', $_FILES['file_name']['name'] . " " . "Uploaded Successfully");
                redirect('ipo_form');
            }
        }
        $data['status']=1;
        $data['dir'] = 'ipo_form';
        $data['page'] = 'add_ipo_form';
        $data['action'] = 'ipo_form/add_ipo_form';
        $data['page_title'] = "Add Ipo Form";
        $this->load->view('main', $data);
    }

    function upload_ipo_form() {
        // $config['file_name']=$_FILES['file_name'];
        //$config['file_path']=$_FILES[]
        $config['upload_path'] = '..../uploads/';
        $config['allowed_types'] = 'doc|docx|pdf';
        $config['max_size'] = '81920000';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file_name')) {
            return true;
        } else {
            return FALSE;
        }
    }

    function edit_ipo_form($cid='') {
        if ($cid == '') {
            redirect('ipo_form');
        }

        if ($_POST['save']) {
            if ($this->form_validation->run('upload_ipo_file')) {
                //if ($this->upload_ipo_form()) {
                    //$data_uploaded = $this->upload->data();
                    $file_name=$_POST['h_file'];
                    if($_FILES['file_name']['name']!=''){
                        $file_name=$this->mod_site->save_file($_POST['h_file']);
                    }
                    $data = array(
                        'company_name' => $_POST['company_name'],
                        'company_description' => $_POST['company_description'],
                        'file_name' => $file_name,
                        'status' => $_POST['status'],
                    );
                    $this->session->set_flashdata('msg', "Content Added");
                    $this->session->set_flashdata('upload_success_msg', $_FILES['file_name']['name'] . " " . "Edited  Successfully");
                    $data_pre = $this->mod_site->get_single_entry($cid);
                    $path = '..../uploads/' . $data_pre['file_name'];
                    @unlink($path);
                    $this->db->update('ipo_form', $data, array('id' => $cid));
                    $this->session->set_flashdata('msg', "Content Changed Successfully");
                    redirect('ipo_form');
//                } else {
//                    $err = "Upload Fails!!!!!";
//                }
            }
        }

        $data = sql::row('ipo_form', 'id=' . $cid);
        $data['error_msg'] = $err ? $err : '';
        $data['dir'] = 'ipo_form';
        $data['action'] = 'ipo_form/edit_ipo_form/' . $cid;
        $data['page'] = 'add_ipo_form'; //Don't Change
        $data['page_title'] = "Edit";
        $this->load->view('main', $data);
    }

    function publish_ipo_form($cid='') {

        if ($cid == '') {
            redirect('ipo_form');
        }
        $data = array(
            'status' => 1
        );
        $this->db->update('ipo_form', $data, "id in($cid)");
        $this->session->set_flashdata('msg', "Published Successfully");
        redirect('ipo_form');
    }

    function unpublish_ipo_form($cid='') {
        if ($cid == '') {
            redirect('ipo_form');
        }
        $data = array(
            'status' => 0,
        );
        $this->db->update('ipo_form', $data, "id in($cid)");
        $this->session->set_flashdata('msg', "UnPublished Successfully");
        redirect('ipo_form');
    }

    function delete_ipo_form($cid='') {
        if ($cid == '') {
            redirect('ipo_form');
        }
        $data = $this->mod_site->get_single_entry($cid);
        $path = UPLOAD_PATH.'ipoform/' . $data['file_name'];
        @unlink($path);
        sql::delete('ipo_form', "id in($cid)");
        $this->session->set_flashdata('msg', "Deleted Successfully");
        redirect('ipo_form');
    }

    function go_top($cid='') {
        if ($cid == '') {
            redirect('ipo_form');
        }
        $data = sql::row('ipo_form',"id=$cid");
        $insdata=array(
            'company_name'=>$data['company_name'],
            'file_name'=>$data['file_name'],
            'company_description'=>$data['company_description'],
            'status'=>$data['status']
        );
        $this->db->insert('ipo_form',$insdata);
        sql::delete('ipo_form', 'id=' . $cid);
        redirect('ipo_form');
    }

}
?>
