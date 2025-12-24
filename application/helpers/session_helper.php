<?php

session_start();

define('MESSAGE_TYPE', 'flash_message_type');
define('MESSAGE', 'flash_message');

function is_user_loggedin()
{
    if (
        isset($_SESSION) &&
        isset($_SESSION['user_id']) &&
        isset($_SESSION['first_name']) &&
        isset($_SESSION['last_name']) &&
        isset($_SESSION['email'])
    ) 
    {
        return  true;
    } else {
        return redirect('login');
    }
}

function expire_session()
{
    if (isset($_SESSION['user_id'])) {
        unset($_SESSION['user_id']);
    }
    if (isset($_SESSION['first_name'])) {
        unset($_SESSION['first_name']);
    }
    if (isset($_SESSION['last_name'])) {
        unset($_SESSION['last_name']);
    }
    if (isset($_SESSION['email'])) {
        unset($_SESSION['email']);
    }
    if (isset($_SESSION['modules'])) {
        unset($_SESSION['modules']);
    }
}

function check_modules_access($module_id)
{
    if (isset($_SESSION['modules']) && in_array($module_id ,$_SESSION['modules']))
    {
        return true;
    }
    return false;
}

function flash_message($type, $message) {
    $_SESSION[MESSAGE_TYPE] = $type;
    $_SESSION[MESSAGE] = $message;
}