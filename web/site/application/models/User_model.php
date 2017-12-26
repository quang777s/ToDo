<?php

class User_model extends CI_Model {
    protected $table_name = 'users';

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function get_user_by_email($email)
    {
        $this->db->select('*')->from('users');
        $this->db->where('email', $email);
        $query=$this->db->get();
        return $query->result_array();
    }

    public function hash_password($old = '', $iterations = 0)
    {
        $password = $this->auth->hash_password($old, $iterations);
        if (empty($password) || empty($password['hash'])) {
            return false;
        }

        return array($password['hash'], $password['iterations']);
    }

    public function register()
    {
        $data = array(
            'email' => $this->input->post('email'),
            'password_hash' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'created' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('users', $data);
    }
}