<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of site_config
 *
 * @author Anwar
 */
class static_pages extends Controller {

    function __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->helper('file');
        $this->load->model('mod_static_pages');
    }

    function index($page="about") {
        $data['nav_array'] = array(
            array('title' => lang('menu_manage_page'), 'url' => '')
        );
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array(lang('label_page_name'), lang('label_page_title'), lang('label_status'));
        $gridColumnModel = array(
            array("name" => "page_name",
                "index" => "page_name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "page_title",
                "index" => "page_title",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "status",
                "index" => "status",
                "width" => 50,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            )
        );
        if ($_POST['apply_filter']) {
            $gridObj->setGridOptions(lang('menu_manage_template'), 880, 200, "page_name", "asc", $gridColumn, $gridColumnModel, site_url("?c=static_pages&m=load_page&searchField={$_POST['searchField']}&searchValue={$_POST['searchValue']}&status={$_POST['status']}"), true);
        } else {
            $gridObj->setGridOptions(lang('menu_manage_page'), 880, 250, "page_name", "asc", $gridColumn, $gridColumnModel, site_url('static_pages/load_page/'), true);
        }
        $data['grid_data'] = $gridObj->getGrid();
        $data['dir'] = "static_pages";
        $data['page'] = "index";
        $this->load->view('main', $data);
    }

    function load_page() {
        $this->mod_static_pages->get_page_grid();
    }

    function new_page() {
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_page')) {
                if ($this->mod_static_pages->save_page()) {
                    $this->session->set_flashdata('msg', lang('msg_add_success'));
                    redirect('static_pages');
                }
            }
        }
        $data['nav_array'] = array(
            array('title' => lang('menu_manage_page'), 'url' => site_url('static_pages')),
            array('title' => lang('menu_new_page'), 'url' => '')
        );
        $data['page_title'] = lang('menu_new_page');
        $data['editor_view'] = TRUE;
        $data['dir'] = "static_pages";
        $data['action'] = 'static_pages/new_page';
        $data['page'] = "page_form";
        $this->load->view('main', $data);
    }

    function edit_page($page_id='') {
        if ($page_id == '') {
            common::redirect();
        }

        if ($_POST['save']) {
            if ($this->form_validation->run('valid_page')) {
                if ($this->mod_static_pages->update_page($page_id)) {
                    $this->session->set_flashdata('msg', lang('msg_add_success'));
                    redirect('static_pages');
                }
            }
        }
        $data = sql::row('static_pages', "page_id='$page_id'");
        //print_r($data);
        $this->session->set_userdata('edit_page_id', $data['page_id']);

        $data['page_des'] = read_file(FRONT_END . "views/static/" . $data['page_name'] . ".php");
        $data['nav_array'] = array(
            array('title' => lang('menu_manage_page'), 'url' => site_url('static_pages')),
            array('title' => lang('menu_edit_page'), 'url' => '')
        );
        $data['form_page_title'] = lang('menu_edit_page');
        $data['editor_view'] = TRUE;
        $data['dir'] = "static_pages";
        $data['action'] = 'static_pages/edit_page/' . $data['page_id'];
        $data['page'] = "page_form";

        $index = strrpos($data['page_name'], "_");
        if ($index > 0) {
            $data['page_name'] = substr($data['page_name'], 0, $index);
        }

        $this->load->view('main', $data);
    }

    function delete_page($id='') {
        if ($id == '') {
            common::redirect();
        }
        $data = sql::row('static_pages', "page_id='$id'");
        @unlink(FRONT_END . "views/static/" . $data['page_name'] . ".php");
        sql::delete('static_pages', "page_id in($id)");
        $this->session->set_flashdata('msg', lang('msg_delete'));
        common::redirect();
    }

    function page_status($status=1, $id='') {
        if ($id == '') {
            common::redirect();
        }
        common::change_status('static_pages', "page_id in($id)", $status);
        $this->session->set_flashdata('msg', lang('msg_status_success'));
        common::redirect();
    }

}

?>