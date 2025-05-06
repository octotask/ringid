<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of news
 *
 * @author tamal
 */
class news extends Controller {

    //put your code here
    function __construct() {
        parent::Controller();
        $this->load->model('mod_site');
        $this->load->model('mod_login');
        common::is_logged();
        $this->load->model('mod_news');
    }

    function index() {
        $data['nav_array'] = array(
            array('title' => 'Manage News', 'url' => '')
        );
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array("News For", "News Title", "News Description", "Status", "Date");
        $gridColumnModel = array(
            array("name" => "company_name",
                "index" => "company_name",
                "width" => 60,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "news_title",
                "index" => "news_title",
                "width" => 150,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "news_description",
                "index" => "news_description",
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
            ),
            array("name" => "date",
                "index" => "date",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => false
            ),
        );
        $gridObj->setGridOptions("News listing", 880, 250, "id", "desc", $gridColumn, $gridColumnModel, site_url('news/load_news'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'news';
        $data['page'] = 'news_lising';
        $data['page_title'] = 'News';
        $this->load->view('main', $data);
    }

    function add_news() {
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_news')) {
                //$this->mod_site->save_news();
                $data = array(
                    'company_name' => $_POST['company_name'],
                    'news_title' => $_POST['news_title'],
                    'news_description' => $_POST['news_description'],
                    'status' => $_POST['status']
                );
                $this->db->insert('site_content', $data);
                $this->session->set_flashdata('msg', "Content Added Successfully");
                redirect('news');
            }
        }
        $data = $_REQUEST;
        $data['dir'] = 'news';
        $data['action'] = 'news/add_news';
        $data['page'] = 'add_news';
        $data['page_title'] = "News";
        $this->load->view('main', $data);
    }

    function load_news() {
        $this->load->helper('text');
        $this->mod_news->get_newsGrid();
    }

    function edit_news($cid='') {
        if ($cid == '') {
            redirect('news');
        }
        $data['error'] = "";
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_news')) {
                $data = array(
                    'company_name' => $_POST['company_name'],
                    'news_title' => $_POST['news_title'],
                    'news_description' => $_POST['news_description'],
                    'status' => $_POST['status']
                );

                $this->db->update('site_content', $data, array('id' => $cid));
                $this->session->set_flashdata('msg', "Content Changed Successfully");
                redirect('news');
            }
        }
        $data = sql::row('site_content', 'id=' . $cid);
        $data['error'] = $err ? $err : '';
        $data['dir'] = 'news';
        $data['action'] = 'news/edit_news/' . $cid;
        $data['page'] = 'add_news'; //Don't Change
        $data['page_title'] = "Edit";
        $this->load->view('main', $data);
    }

    function publish_news($cid='') {

        if ($cid == '') {
            redirect('news');
        }
        $data = array(
            'status' => 1
        );
        $this->db->update('site_content', $data, "id in($cid)");
        $this->session->set_flashdata('msg', "News Published Successfully");
        redirect('news');
    }

    function unpublish_news($cid='') {
        if ($cid == '') {
            redirect('news');
        }
        $data = array(
            'status' => 0,
        );
        $this->db->update('site_content', $data, "id in($cid)");
        $this->session->set_flashdata('msg', "News UnPublished Successfully");
        redirect('news');
    }

    function delete_news($cid='') {
        if ($cid == '') {
            redirect('news');
        }
        sql::delete('site_content', "id in($cid)");
        $this->session->set_flashdata('msg', "Message Deleted Successfully");
        redirect('news');
    }

    function go_archive($cid='') {
        if ($cid == '') {
            redirect('news');
        }
        $data = array(
            'is_archive' => 1,
            'status'=>0
        );
        $this->db->update('site_content', $data, "id in($cid)");
        $this->session->set_flashdata('msg', "News Successfully goes to archive");
        common::redirect();
    }

    function archive_news() {
        $data['nav_array'] = array(
            array('title' => 'Manage Archive News', 'url' => '')
        );
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array("News For", "News Title", "News Description", "Status", "Date");
        $gridColumnModel = array(
            array("name" => "company_name",
                "index" => "company_name",
                "width" => 60,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "news_title",
                "index" => "news_title",
                "width" => 150,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "news_description",
                "index" => "news_description",
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
            ),
            array("name" => "date",
                "index" => "date",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => false
            ),
        );
        $gridObj->setGridOptions("News listing", 880, 250, "id", "desc", $gridColumn, $gridColumnModel, site_url('news/load_archive_news'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'news';
        $data['page'] = 'news_lising';
        $data['page_title'] = 'News';
        $this->load->view('main', $data);
    }
    function load_archive_news(){
        $this->load->helper('text');
        $this->mod_news->get_newsGrid(1);
    }

//End Home News
    //Start Admin Setting
    function update_user() {
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_admin')) {

                $this->mod_site->update_admin();
                $this->session->set_userdata('user_name', $_POST['user_name']);
                $this->session->set_flashdata('msg', "Content Changed Successfully");
                redirect('news');
            }
        }
        $data['dir'] = 'news';
        $data['page'] = 'admin_user_setting';
        $data['page_title'] = "Change Username & Password";
        $this->session->set_flashdata('msg', "Content Changed Successfully");
        $data['action'] = 'news/update_user';
        $this->load->view('main', $data);
    }

    function add_user() {
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_admin')) {
                $this->mod_site->add_admin();
                $this->session->set_flashdata('msg', "Content Added Successfully");
                redirect('news');
            }
        }
        $data['dir'] = 'news';
        $data['page'] = 'admin_user_setting';
        $data['page_title'] = "ADD User";
        $this->session->set_flashdata('msg', "Content Changed Successfully");
        $data['action'] = 'news/add_user';
        $this->load->view('main', $data);
    }

    //End Admin Setting
}
?>
