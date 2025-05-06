<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author Anwar
 */
class home extends Controller {
    function  __construct() {
        parent::Controller();
    }
    function index(){
        $data['dir']='home';
        $data['page']='index';
        $this->load->view('main',$data);
    }


}
?>
