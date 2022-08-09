<?php

class User extends CI_Model
{
    public function insertUser($data)
    {
        $this->db->insert('users', $data);
    }

    public function getAllUsers(){
        
    }
}