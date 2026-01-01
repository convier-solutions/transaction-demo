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
        $result = $this->transactions_model->paginated_transactions();

        if ($this->input->is_ajax_request()) {
            echo json_encode([
                'draw' => (int) $this->input->post('draw'),
                'recordsTotal' => $total_records,
                'recordsFiltered' => $result['filtered'],
                'data' => $result['data']
            ]);
            exit;
        }

        $data['_view'] = 'dashboard';
        $data['total_records'] = $total_records;
        $this->load->view('layouts/main', $data);
    }
}
