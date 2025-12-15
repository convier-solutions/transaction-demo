<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('authentication_model');
        $this->load->model('user_model');
    }

    public function login()
    {

        if (count($_POST) > 0) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('authentication/login');
            } else {
                $user_email = $this->input->post('email');
                $user_password = $this->input->post('password');
                $result = $this->authentication_model->login_authentication($user_email, $user_password);
                if (is_array($result) && count($result) > 0) {
                    $_SESSION['user_id'] = $result[0]['id'];
                    $_SESSION['first_name'] = $result[0]['first_name'];
                    $_SESSION['last_name'] = $result[0]['last_name'];
                    $_SESSION['email'] = $result[0]['email'];
                    $_SESSION['modules'] = json_decode($result[0]['modules']);
                    redirect('');
                } else {
                    $this->load->view('authentication/login');
                }
            }
        } else {
            $this->load->view('authentication/login');
        }
    }

    public function logout()
    {
        expire_session();
        redirect('login');
    }
}
