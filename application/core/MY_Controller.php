<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    // Core CI singletons injected by CI_Controller (PHP 8.2 needs declared props)
    public $benchmark;
    public $hooks;
    public $config;
    public $log;
    public $utf8;
    public $uri;
    public $router;
    public $output;
    public $security;
    public $input;
    public $lang;

    // Loader
    public $load;

    // Common extras you are already hitting
    public $db;
    public $pagination;

    // Models seen in your log (declare as needed)
    public $authentication_model;
    public $user_model;
    public $transactions_model;
    public $form_validation;
    public $charts_model;
}
