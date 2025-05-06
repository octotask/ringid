<?php
class feedback extends Controller {

    private $dir = 'feedback';

    function __construct() {
        parent::Controller();
        $this->load->model('mod_feedback');
        common::is_logged();
    }

    function index() {
        $data['nav_array'] = array(
            array('title' => 'Manage Feedback', 'url' => '')
        );
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Name', 'Email', 'Phone', 'Comments', 'Reply', 'Status');
        $gridColumnModel = array(
            array("name" => "first_name",
                "index" => "first_name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ), array("name" => "email",
                "index" => "email",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "phone",
                "index" => "phone",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "comments",
                "index" => "comments",
                "width" => 80,
                "sortable" => false,
                "align" => "left",
                "editable" => false
            ),
             array("name" => "feedback_reply",
                "index" => "feedback_reply",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "status",
                "index" => "status",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            )
        );
        if ($_POST['apply_filter']) {
            $gridObj->setGridOptions('Manage Feedback', 880, 200, "feedback_id", "desc", $gridColumn, $gridColumnModel, site_url("?c=feedback&m=load_feedbacks&searchField={$_POST['searchField']}&searchValue={$_POST['searchValue']}&status={$_POST['status']}"), true);
        } else {
            $gridObj->setGridOptions('Manage Feedback', 880, 200, "feedback_id", "desc", $gridColumn, $gridColumnModel, site_url('feedback/load_feedbacks'), true);
        }
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'feedback';
        $data['page'] = 'index';
        $data['page_title'] = 'Manage Feedback';
        $this->load->view('main', $data);
    }

    function load_feedbacks() {
        $this->mod_feedback->get_feedbackGrid();
    }

    function new_feedback() {

        if ($_POST['save']) {
            //if ($this->form_validation->run('valid_admin_user')) {
            $user_id = $this->session->userdata('admin_user_id');
            $insdata = array(
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'company' => $_POST['company'],
                'phone' => $_POST['phone'],
                'comments' => $_POST['comments'],
                'feedback_reply' => $_POST['feedback_reply']
            );
            $this->db->insert('feedback', $insdata);
            $feedback_id=  $this->db->insert_id();
            $this->mod_feedback->send_feedbackmessage($feedback_id);
            $this->session->set_flashdata('msg', lang('msg_add_success'));
            redirect('feedback');
            //}
        }

        $data['nav_array'] = array(
            array('title' => 'Manage Feedback', 'url' => site_url('feedback')),
            array('title' => 'Add Feedback', 'url' => '')
        );

        $data['dir'] = 'feedback';
        $data['action'] = 'feedback/new_feedback/';
        $data['page'] = 'feedback_form'; //Don't Change
        $data['page_title'] = 'Add Feedback';
        $this->load->view('main', $data);
    }

    function edit_feedback($feedback_id='') {
        if ($feedback_id == '' || !is_numeric($feedback_id)) {
            redirect('feedback');
        }
        $data = sql::row('feedback', "feedback_id='$feedback_id'");
        if($data['feedback_reply']==''){
            $data['feedback_reply']='

Please keep on touch with BDSTOCK4U
Best regards,
Bdstock4u ';
        }
        if ($_POST['save']) {
            //if ($this->form_validation->run('valid_admin_user')) {
            $insdata = array(
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'company' => $_POST['company'],
                'phone' => $_POST['phone'],
                'comments' => $_POST['comments'],
                'feedback_reply' => $_POST['feedback_reply']
            );
            $this->db->update('feedback', $insdata, array('feedback_id' => $feedback_id));
            $this->mod_feedback->send_feedbackmessage($feedback_id);
            $this->session->set_flashdata('msg', lang('msg_update_success'));
            redirect('feedback');
            //}
        }

        $this->session->set_userdata('edit_feedback_id', $data['feedback_id']); //Don't Change
        $data['nav_array'] = array(
            array('title' => 'Manage Feedback', 'url' => site_url('feedback')),
            array('title' => 'Send Feedback Reply', 'url' => '')
        );
        $edit_admin_user_id = $this->session->userdata('edit_feedback_id');

        $data['dir'] = 'feedback';
        $data['action'] = 'feedback/edit_feedback/' . $data['feedback_id'];
        $data['page'] = 'feedback_form'; //Don't Change
        $data['page_title'] = 'Send Feedback Reply';
        $this->load->view('main', $data);
    }

    function delete_feedback($id='') {
        if ($id == '') {
            redirect('feedback');
        }
        sql::delete('feedback', "feedback_id in($id)");
        $this->session->set_flashdata('msg', lang('msg_delete'));
        common::redirect();
    }

    function feedback_status($status='', $id='') {
        if ($id == '') {
            common::redirect();
        }
        common::change_status('feedback', "feedback_id in($id)", $status);
        $this->session->set_flashdata('msg', lang('msg_status_success'));
        common::redirect();
    }

}
?>
