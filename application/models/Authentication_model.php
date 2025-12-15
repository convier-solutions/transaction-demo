<?php

class Authentication_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function login_authentication ($user_email, $user_password)
    {
        $query = "SELECT * FROM `portal_users` WHERE email = '$user_email' AND password = '$user_password' ;" ;
        $result = $this->db->query($query);
        
        if ($result->num_rows() > 0)
        {
            return $result->result_array();
        }
        else
        {
            return array();
        }
    }

   
}