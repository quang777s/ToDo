<?php

class Todo_model extends CI_Model {
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

    public function get_user()
    {
        $post = [
            'token' => $this->input->post('token')
        ];
        $url = 'http://web/api/user/get_user';
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_VERBOSE        => 1,
            CURLOPT_POST           => 1,
            CURLOPT_POSTFIELDS     => $post
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }

    public function get_user_id()
    {
        $user = $this->get_user();
        if ($user->status) {
            return $user->id;
        }
        return FALSE;
    }

    public function get_todo_by_user($userId)
    {
        $this->db->select('*')->from('todo');
        $this->db->where('user_id', $userId);
        $query=$this->db->get();
        return $query->result_array();
    }
}