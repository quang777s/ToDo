<?php

class User_model extends CI_Model {
    protected $table_name = 'users';

    protected $validation_rules = array(
        array(
            'field' => 'password',
            'label' => 'lang:bf_password',
            'rules' => 'max_length[120]|valid_password|matches[pass_confirm]',
        ),
    );

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
        return $query->row();
    }

    public function get_user_by_token($token)
    {
        $this->db->select('*')->from('users');
        $this->db->where('token', $token);
        $query=$this->db->get();
        return $query->row();
    }

    public function get_id_user_by_token()
    {
        $user = $this->get_user_by_token($this->input->post('token'));
        if ($user) {
            return $user->id;
        }
        return FALSE;
    }

    public function update_token($id, $token)
    {
        $date = new DateTime();
        $date->modify("+10 minute");
        return $this->db->set('token', $token)
            ->set('expired', $date->format('Y-m-d H:i:s'))
            ->where('id', $id)
            ->update('users');
    }

    public function register()
    {
        $user = $this->get_user_by_email($this->input->post('email'));
        if ($user) {
            return false;
        }

        $data = array(
            'email' => $this->input->post('email'),
            'password_hash' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'created' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('users', $data);
    }

    public function login()
    {
        $user = $this->get_user_by_email($this->input->post('email'));
        if (!$user || !password_verify($this->input->post('password'), $user->password_hash)) {
            return FALSE;
        }

        $token = bin2hex(random_bytes(16));
        $this->update_token($user->id, $token);

        return $token;
    }
}