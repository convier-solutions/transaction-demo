<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('transactions_model');
        is_user_loggedin();
    }

    public function index()
    {
        $total_records = $this->transactions_model->count_all_transactions();
        $data = $this->transactions_model->paginate_transactions($total_records);
        $data['_view'] = 'dashboard';
        $data['total_records'] = $total_records;
        $this->load->view('layouts/main', $data);
    }
}
