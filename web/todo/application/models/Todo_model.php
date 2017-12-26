<?php

class Todo_model extends CI_Model {
    protected $table_name = 'users';

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
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

    public function add($userId)
    {
        $data = array(
            'user_id' => $userId,
            'content' => $this->input->post('content'),
            'is_complete' => FALSE
        );

        return $this->db->insert('todo', $data);
    }
}