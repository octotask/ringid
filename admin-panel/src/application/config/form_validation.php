<?php

$config = array(
    'valid_login' => array(
        array('field' => 'user_name', 'label' => 'User Name', 'rules' => 'required'),
        array('field' => 'password', 'label' => 'Password', 'rules' => 'required')
    ),
    'valid_page' => array(
        array('field' => 'page_language', 'label' => 'Page Language', 'rules' => 'required'),
        array('field' => 'page_category', 'label' => 'Page Category', 'rules' => 'required'),
        array('field' => 'page_name', 'label' => 'Page Name', 'rules' => 'required|alpha_dash|trim'),
        array('field' => 'page_title', 'label' => 'Page Title', 'rules' => 'required'),
        array('field' => 'page_des', 'label' => 'Page Description', 'rules' => ''),
    ),
    'valid_change_password' => array(
        array('field' => 'old_password', 'label' => 'Old Password', 'rules' => 'required|callback_is_valid_user_password'),
        array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'required'),
        array('field' => 'confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[new_password]')
    ),
    'valid_user' => array(
        array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'required'),
        array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'required'),
        array('field' => 'user_name', 'label' => 'User Name', 'rules' => 'required'),
        array('field' => 'email', 'label' => 'Email', 'rules' => ''),
        array('field' => 'password', 'label' => 'Password', 'rules' => 'required'),
        array('field' => 'confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[password]')
    ),
    'valid_forgot_password' => array(
        array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email|callback_is_user'),
    ),
    'valid_type' => array(
        array('field' => 'type_name', 'label' => 'Type Name', 'rules' => 'required'),
        array('field' => 'type_for', 'label' => 'Type For', 'rules' => 'required')
    ),
    //added by tamal
    'valid_news' => array(
        array('field' => 'news_title', 'label' => 'News Title', 'rules' => 'required'),
        array('field' => 'news_description', 'label' => 'news Description', 'rules' => 'required')
    ),
    'valid_news_link' => array(
        array('field' => 'news_title', 'label' => 'News Title', 'rules' => 'required'),
        array('field' => 'news_link', 'label' => 'news Link', 'rules' => 'required')
    ),
    'valid_admin' => array(
        array('field' => 'user_name', 'label' => 'User Name', 'rules' => 'required'),
        array('field' => 'password', 'label' => 'Password', 'rules' => 'required')
    ),
    'valid_about_us' => array(
        array('field' => 'title', 'label' => 'Title', 'rules' => 'required'),
        array('field' => 'description', 'label' => 'Description', 'rules' => 'required')
    ),
    'valid_admin_email' => array(
        array('field' => 'admin_email', 'label' => 'Email', 'rules' => 'required|valid_email')
    ),
    'upload_ipo_file' => array(
        array('field' => 'company_name', 'label' => 'Company Name', 'rules' => 'required'),
        array('field' => 'company_description', 'label' => 'Company Description', 'rules' => 'required')
    )
    )
?>
