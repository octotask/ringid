<?php

/**
 * Description of mod_login
 *
 * @author anwar
 */
class mod_login extends Model {

    function mod_login() {
        parent::Model();
    }

    function is_valid_user() {
        $status = '1';
        $password = $_POST['password'];
        $sql = "SELECT * FROM user WHERE user_name = ? AND password = ?";
        $query = $this->db->query($sql, array($_POST['user_name'], $password));
        if ($query->num_rows() > 0) {
            $this->do_login($query->row_array());
            return true;
        } else {
            return false;
        }
    }

    function do_login($data) {
        $this->session->set_userdata('user_id', $data['user_id']);
        $this->session->set_userdata('full_name', $data['first_name'] . ' ' . $data['last_name']);
        $this->session->set_userdata('email', $data['email']);
        $this->session->set_userdata('permission', $data['permission']);
        $this->session->set_userdata('logged_in', TRUE);

         //added By tamal on 04-01-2011

        $this->session->set_userdata('user_name', $data['user_name']);
    }

    function do_logout() {
        $this->session->sess_destroy();
    }

    function reset_password() {
        $site = common::get_settings_data();
        $verification_code = md5(date("F j, Y, g:i:s a"));
        $sql = "update admin set forgot_password_verify='$verification_code' where admin_email='{$_POST['admin_email']}'";
        $this->db->query($sql);
        $base_url = base_url();
        $msg_content = "<div><a href='$base_url'><img alt='Welated' src='" . $base_url . "/images/flammabd.png' border='0'/></a>
                            <br />
                            <h3 style='border-bottom:1px solid #DDD;margin:0;'></h3>";
        $msg_content.="<div style='width:700px;font-family:trebuchet ms;color:#343434;font-size:13px;'>";
        $msg_content.="Thank you for contacting Welated Online Account Support.
                        <br /><br />You have asked us to reset your password.
                        <br /><br />Please click on the link below to reset your password.
                        <br /><br />
                        Password Reset URL: <a href='" . site_url('login/reset_password/' . $verification_code) . "'>" . site_url('login/reset_password/' . $verification_code) . "</a>
                        <br />
                        <br />Thank you,
                        <br />Welated Account Support";
        $msg_content.='</div></div>';
        $from = $site['admin_email'];
        $from_name = 'Welated Admin';
        $to = $_POST['email'];
        $subject = 'Forgot Password Support';
        common::sending_mail($from, $from_name, $to, $subject, $msg_content);
    }

    function is_password_verfiy($password_verify) {
        $sql = $this->db->query("select * from user where forgot_password_verify='$password_verify'");
        if ($sql->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update_password($verification_code) {
        $password = $_POST['new_password'];
        $sql = "update user set password='$password' where forgot_password_verify='$verification_code'";
        return $this->db->query($sql);
    }

}