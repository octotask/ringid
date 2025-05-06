<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of about_us
 *
 * @author tamal
 */
class about_us extends Controller {
    function __construct() {
        parent::Controller();
        $this->load->model('mod_site');
    }
    function index() {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array("id", "Title", "Description","Status");
        $gridColumnModel = array(
            array("name" => "id",
                "index" => "id",
                "width" => 40,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "title",
                "index" => "title",
                "width" => 150,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "description",
                "index" => "description",
                "width" => 200,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "status",
                "index" => "status",
                "width" => 70,
                "sortable" => true,
                "align" => "Center",
                "editable" => false
            )
        );
        $gridObj->setGridOptions("listing", 880, 250, "id", "asc", $gridColumn, $gridColumnModel, site_url('about_us/get_about_us_grid'), true);
        $data['grid_data'] = $gridObj->getGrid();  
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'about_us';
        $data['page'] = 'about_us_listing';
        $this->load->view('main', $data);
    }
    function admin_email()
    {
         $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array("id", "Name", "Email","Status");
        $gridColumnModel = array(
            array("name" => "id",
                "index" => "id",
                "width" => 40,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "Name",
                "index" => "admin_name",
                "width" => 150,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "admin_email",
                "index" => "admin_email",
                "width" => 200,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
           array("name" => "status",
                "index" => "status",
                "width" => 200,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
        );
        $gridObj->setGridOptions("listing", 880, 250, "id", "asc", $gridColumn, $gridColumnModel, site_url('about_us/get_admin_setting_data'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'about_us';
        $data['page'] = 'admin_email_listing';
        $this->load->view('main', $data);


    }
    function get_about_us_grid()
    {
      $this->mod_site->get_about_us_grid();     
    }
    function get_admin_setting_data()
    {
          $this->mod_site->get_admin_setting_data();

    }
      function add_about_us() {
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_about_us')) {
                $this->mod_site->save_about_us();
                $this->session->set_flashdata('msg', "Content Added Successfully");
                redirect('about_us');
            }
        }
        $data['dir'] = 'about_us';
        $data['action'] = 'about_us/add_about_us';
        $data['page'] = 'about_us';
        $data['page_title'] = "About Us";
        $this->load->view('main', $data);
    }
 function edit_about_us($cid='') {
        if ($cid == '') {
            redirect('about_us');
        }
        $data['error'] = "";
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_about_us')) {
                $data = array(
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'status' => $_POST['status']
                );
                $this->db->update('about_us', $data, array('id' => $cid));
                $this->session->set_flashdata('msg', "Content Changed Successfully");
                redirect('about_us');
            }
        }
        $data = sql::row('about_us', 'id=' . $cid);
        $data['error'] = $err ? $err : '';
        $data['dir'] = 'about_us';
        $data['action'] = 'about_us/edit_about_us/' . $cid;
        $data['page'] = 'about_us'; //Don't Change
        $data['page_title'] = "Edit";
        $this->load->view('main', $data);
    }
    function publish_about_us($cid='') {
        if ($cid == '') {
            redirect('about_us');
        }
        $data = array(
            'status' => "Published"
        );
      
        $this->db->update('about_us', $data, "id in($cid)");

        $this->session->set_flashdata('msg', "News Published Successfully");
        redirect('about_us');
    }
    function unpublish_about_us($cid='') {
        if ($cid == '') {
            redirect('about_us');
        }
        $data = array(
            'status' => "Not Published",
        );
         $this->db->update('about_us', $data, "id in($cid)");
        $this->session->set_flashdata('msg', "News UnPublished Successfully");
        redirect('about_us');
    }

    function delete_about_us($cid='') {
        if ($cid == '') {
            redirect('about_us');
        }
        sql::delete('about_us', 'id in(' . $cid.')');
        $this->session->set_flashdata('msg', "Message Deleted Successfully");
        redirect('about_us');
    }
    //for Admin email setting
    function add_admin_email() {
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_admin_email')) {
                $this->mod_site->save_admin_email();
                $this->session->set_flashdata('msg', "Content Added Successfully");
                redirect('about_us/admin_email');
            }
        }
        $data['dir'] = 'about_us';
        $data['action'] = 'about_us/add_admin_email';
        $data['page'] = 'admin_email_form';
        $data['page_title'] = "AdminEmail";
        $this->load->view('main',$data);
}
function edit_admin_email($cid='') {
        if ($cid == '') {
            redirect('about_us/admin_email');
        }
        $data['error'] = "";
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_admin_email')) {
                $data = array(
                    'admin_name' => $_POST['admin_name'],
                    'admin_email' => $_POST['admin_email'],
                    'status' => $_POST['status']
                );
                $this->db->update('admin_email', $data, array('id' => $cid));
                $this->session->set_flashdata('msg', "Content Changed Successfully");
                redirect('about_us/admin_email');
            }
        }
        $data = sql::row('admin_email', 'id=' . $cid);
        $data['error'] = $err ? $err : '';
        $data['dir'] = 'about_us';
        $data['action'] = 'about_us/edit_admin_email/' . $cid;
        $data['page'] = 'admin_email_form'; //Don't Change
        $data['page_title'] = "Edit";
        $this->load->view('main', $data);
    }
    function activate_admin_email($cid='') {
        if ($cid == '') {
            redirect('about_us/admin_email');
        }
        $data = array(
            'status' => "Activate"
        );
        $this->db->update('admin_email', $data, "id in($cid)");
        $this->session->set_flashdata('msg', "Activated Successfully");
        redirect('about_us/admin_email');
    }
    function deactivate_admin_email($cid='') {
        if ($cid == '') {
            redirect('about_us/admin_email');
        }
        $data = array(
            'status' => "DeActivate",
        );
        $this->db->update('admin_email', $data, "id in($cid)");
        $this->session->set_flashdata('msg', "DeActivated Successfully");
        redirect('about_us/admin_email');
    }

    function delete_admin_email($cid='') {
        if ($cid == '') {
            redirect('about_us/admin_email');
        }
        sql::delete('admin_email', "id in($cid)");
        $this->session->set_flashdata('msg', "Deleted Successfully");
        redirect('about_us/admin_email');
    }
}
?>
