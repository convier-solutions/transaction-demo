<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Charts_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_piecharts()
    {
        $query  = "CALL sp_get_profit_Piechart(1)";
        $result = $this->db->query($query);

        $data = [];
        if ($result && $result->num_rows() > 0) {
            $data = $result->result_array();
        }

        // IMPORTANT for stored procedures (mysqli): clear remaining result sets
        if ($result) {
            $result->next_result();
            $result->free_result();
        }

        return $data;
    }

    public function get_pie_chartsByValue($params)
    {
        $params = (int) $params;

        $query  = "CALL sp_get_profit_Piechart({$params})";
        $result = $this->db->query($query);

        $data = [];
        if ($result && $result->num_rows() > 0) {
            $data = $result->result_array();
        }

        if ($result) {
            $result->next_result();
            $result->free_result();
        }

        return $data;
    }

    public function get_bar_chartsBydate($params)
    {
        $startdate = isset($params['startdate']) ? $this->db->escape_str($params['startdate']) : '';
        $enddate   = isset($params['enddate'])   ? $this->db->escape_str($params['enddate'])   : '';

        $query  = "CALL sp_get_profit_barchart('{$startdate}','{$enddate}')";
        $result = $this->db->query($query);

        $data = [];
        if ($result && $result->num_rows() > 0) {
            $data = $result->result_array();
        }

        if ($result) {
            $result->next_result();
            $result->free_result();
        }

        return $data;
    }
}
