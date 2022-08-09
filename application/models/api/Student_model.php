<?php

class Student_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

    public function get_students(){
        $query = $this->db->get("users")->result();
        return $query;
    }

    public function insert_students($data = array()){
        return $this->db->insert('users',$data);
    }
}