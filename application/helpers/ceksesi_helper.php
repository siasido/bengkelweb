<?php

function isLogin(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('userid');
    $user_level = $ci->session->userdata('level');
    if($user_session && ($user_level == 1)){
        redirect('dashboardadmin');
    } 
    if($user_session && ($user_level == 2)){
        redirect('dashboardcustomer');
    } 
}

function isLogout(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('userid');
    if(!$user_session){
        redirect('auth');
    }
}