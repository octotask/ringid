<?php
/**
 * Description of news
 * @author tamal
 */
class news_link extends Controller {

    function __construct() {
        parent::Controller();
        $this->load->model('mod_site');
        $this->load->model('mod_news');
    }

    function index() {
        $data['nav_array'] = array(
            array('title' => 'Manage News', 'url' => '')
        );
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array("New For", "News Title", "News Link", "Status", "Date");
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
            array("name" => "news_link",
                "index" => "news_link",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "status",
                "index" => "status",
                "width" => 80,
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
        $gridObj->setGridOptions("News listing", 880, 250, "id", "desc", $gridColumn, $gridColumnModel, site_url('news_link/load_news_link'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'news';
        $data['page'] = 'news_link_listing';
        $this->load->view('main', $data);
    }

    function add_news_link() {

        if ($_POST['save']) {
            if ($this->form_validation->run('valid_news_link')) {
                $this->mod_site->save_news_link();
                $this->session->set_flashdata('msg', "Content Added Successfully");
                redirect('news_link');
            }
        }
        $data = $_REQUEST;
        $data['nav_array'] = array(
            array('title' => 'Manage News', 'url' => '')
        );
        $data['dir'] = 'news';
        $data['action'] = 'news_link/add_news_link';
        $data['page'] = 'add_news_link';
        $data['page_title'] = "News";
        $this->load->view('main', $data);
    }

    function load_news_link() {
        $this->load->helper('text');
        $this->mod_news->get_news_linkGrid();
    }

    function edit_news_link($cid='') {

        if ($cid == '') {
            redirect('news_link');
        }
        $data['error'] = "";
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_news_link')) {
                $data = array(
                    'language' => $_POST['language'],
                    'company_name' => $_POST['company_name'],
                    'news_title' => $_POST['news_title'],
                    'news_description' => $_POST['news_description'],
                    'news_link' => $_POST['news_link'],
                    'status' => $_POST['status']
                );

                $this->db->update('news_link', $data, array('id' => $cid));
                $this->session->set_flashdata('msg', "Content Changed Successfully");
                redirect('news_link');
            }
        }
        $data = sql::row('news_link', 'id=' . $cid);
        $data['nav_array'] = array(
            array('title' => 'Manage News', 'url' => '')
        );
        $data['error'] = $err ? $err : '';
        $data['dir'] = 'news';
        $data['action'] = 'news_link/edit_news_link/' . $cid;
        $data['page'] = 'add_news_link'; //Don't Change
        $data['page_title'] = "Edit";
        $this->load->view('main', $data);
    }

    function publish_news_link($cid='') {

        if ($cid == '') {
            redirect('news_link');
        }
        $data = array(
            'status' => 1
        );

        $this->db->update('news_link', $data, "id in($cid)");
        $this->session->set_flashdata('msg', "News Published Successfully");
        redirect('news_link');
    }

    function unpublish_news_link($cid='') {

        if ($cid == '') {
            redirect('news');
        }
        $data = array(
            'status' => 0
        );
        $this->db->update('news_link', $data, "id in($cid)");
        $this->session->set_flashdata('msg', "News UnPublished Successfully");
        redirect('news_link');
    }

    function delete_news_link($cid='') {
        if ($cid == '') {
            redirect('news_link');
        }
   
        sql::delete('news_link', "id in($cid)");
        $this->session->set_flashdata('msg', "Message Deleted Successfully");
        redirect('news_link');
    }

    function go_archive($cid='') {
        if ($cid == '') {
            common::redirect();
        }
        $data = array(
            'is_archive' => 1,
            'status' => 0
        );
        $this->db->update('news_link', $data, "id in($cid)");
        $this->session->set_flashdata('msg', "News Successfully goes to archive");
        common::redirect();
    }

    function archive_news() {
        $data['nav_array'] = array(
            array('title' => 'Manage News Archive', 'url' => '')
        );
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array("New For", "News Title", "News Link", "Status", "Date");
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
            array("name" => "news_link",
                "index" => "news_link",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "status",
                "index" => "status",
                "width" => 80,
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
        $gridObj->setGridOptions("News listing", 880, 250, "id", "desc", $gridColumn, $gridColumnModel, site_url('news_link/load_archive_news'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'news';
        $data['page'] = 'news_link_listing';
        $this->load->view('main', $data);
    }

    function load_archive_news(){
        $this->load->helper('text');
        $this->mod_news->get_news_linkGrid(1);
    }
    
}
?>
