<?php

class company extends Controller {

    private $dir = 'company';

    function __construct() {
        parent::Controller();
        $this->load->model('mod_company');
        common::is_logged();
    }

    function index() {
        $data['nav_array'] = array(
            array('title' => 'Manage Company', 'url' => '')
        );
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Company Name', 'EPS', 'P/E', 'Authorize Capital', 'Paidup Capital', 'Face Value','Lot','#of Share','Status');
        $gridColumnModel = array(
            array("name" => "company_name",
                "index" => "company_name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ), array("name" => "eps",
                "index" => "eps",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "p_e",
                "index" => "p_e",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "authorize_capital",
                "index" => "authorize_capital",
                "width" => 80,
                "sortable" => false,
                "align" => "left",
                "editable" => false
            ),
             array("name" => "paidup_capital",
                "index" => "paidup_capital",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "face_value",
                "index" => "face_value",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
             array("name" => "lot",
                "index" => "lot",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "no_of_share",
                "index" => "no_of_share",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
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
            $gridObj->setGridOptions('Manage Company', 880, 200, "company_id", "desc", $gridColumn, $gridColumnModel, site_url("?c=company&m=load_companys&searchField={$_POST['searchField']}&searchValue={$_POST['searchValue']}&status={$_POST['status']}"), true);
        } else {
            $gridObj->setGridOptions('Manage Company', 880, 200, "company_id", "desc", $gridColumn, $gridColumnModel, site_url('company/load_companys'), true);
        }
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'company';
        $data['page'] = 'index';
        $data['page_title'] = 'Manage Company';
        $this->load->view('main', $data);
    }

    function load_companys() {
        $this->mod_company->get_companyGrid();
    }

    function new_company() {

        if ($_POST['save']) {
            //if ($this->form_validation->run('valid_admin_user')) {
            $user_id = $this->session->userdata('admin_user_id');
            $insdata = array(
                'company_name' => $_POST['company_name'],
                'authorize_capital' => $_POST['authorize_capital'],
                'paidup_capital' => $_POST['paidup_capital'],
                'face_value' => $_POST['face_value'],
                'lot' => $_POST['lot'],
                'no_of_share' => $_POST['no_of_share'],
                'eps' => $_POST['eps'],
                'p_e' => $_POST['p_e'],
                'share' => $_POST['share'],
                'nav' => $_POST['nav'],
                'category'=>$_POST['category']
            );
            $this->db->insert('company_info', $insdata);
            $company_id=  $this->db->insert_id();
            $this->session->set_flashdata('msg', lang('msg_add_success'));
            redirect('company');
            //}
        }

        $data['nav_array'] = array(
            array('title' => 'Manage Company', 'url' => site_url('company')),
            array('title' => 'Add Company', 'url' => '')
        );

        $data['dir'] = 'company';
        $data['action'] = 'company/new_company/';
        $data['page'] = 'company_form'; //Don't Change
        $data['page_title'] = 'Add Company';
        $this->load->view('main', $data);
    }

    function edit_company($company_id='') {
        if ($company_id == '' || !is_numeric($company_id)) {
            redirect('company');
        }
        $data = sql::row('company_info', "company_id='$company_id'");
        if ($_POST['save']) {
            //if ($this->form_validation->run('valid_admin_user')) {
            $insdata = array(
                'company_name' => $_POST['company_name'],
                'authorize_capital' => $_POST['authorize_capital'],
                'paidup_capital' => $_POST['paidup_capital'],
                'face_value' => $_POST['face_value'],
                'lot' => $_POST['lot'],
                'no_of_share' => $_POST['no_of_share'],
                'eps' => $_POST['eps'],
                'p_e' => $_POST['p_e'],
                'share' => $_POST['share'],
                'nav' => $_POST['nav'],
                'category'=>$_POST['category']
            );
            $this->db->update('company_info', $insdata, array('company_id' => $company_id));
            $this->session->set_flashdata('msg', lang('msg_update_success'));
            redirect('company');
            //}
        }

        $this->session->set_userdata('edit_company_id', $data['company_id']); //Don't Change
        $data['nav_array'] = array(
            array('title' => 'Manage Company', 'url' => site_url('company')),
            array('title' => 'Send Company Reply', 'url' => '')
        );
        $edit_admin_user_id = $this->session->userdata('edit_company_id');

        $data['dir'] = 'company';
        $data['action'] = 'company/edit_company/' . $data['company_id'];
        $data['page'] = 'company_form'; //Don't Change
        $data['page_title'] = 'Send Company Reply';
        $this->load->view('main', $data);
    }

    function delete_company($id='') {
        if ($id == '') {
            redirect('company');
        }
        sql::delete('company_info', "company_id in($id)");
        $this->session->set_flashdata('msg', lang('msg_delete'));
        common::redirect();
    }

    function company_status($status='', $id='') {
        if ($id == '') {
            common::redirect();
        }
        common::change_status('company_info', "company_id in($id)", $status);
        $this->session->set_flashdata('msg', lang('msg_status_success'));
        common::redirect();
    }
     function new_tradecompany() {

        if ($_POST['save']) {
            //if ($this->form_validation->run('valid_admin_user')) {
            $user_id = $this->session->userdata('admin_user_id');
            $insdata = array(
                'trading_code' => $_POST['trading_code']
            );
            $this->db->insert('current_trade_data', $insdata);

            $insdata = array(
                'industry_id' => $_POST['industry_id'],
                'company_name' => $_POST['trading_code']
            );
            $this->db->insert('company_names', $insdata);
            
            $insdata = array(
                'company_name' => $_POST['trading_code']
            );
            $this->db->insert('company_info', $insdata);


            $company_id=  $this->db->insert_id();
            $this->session->set_flashdata('msg', lang('msg_add_success'));
            redirect('company');
            //}
        }

        $data['nav_array'] = array(
            array('title' => 'Manage Company', 'url' => site_url('company')),
            array('title' => 'Add Company', 'url' => '')
        );

        $data['dir'] = 'company';
        $data['action'] = 'company/new_tradecompany/';
        $data['page'] = 'new_tradecompany'; //Don't Change
        $data['page_title'] = 'Add Company';
        $data['industries']=$this->mod_company->get_industry_options();
        $this->load->view('main', $data);
    }
}
?>
