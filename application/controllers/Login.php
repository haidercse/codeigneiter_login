<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
   
    public function index()
    {
        $this->load->view('register');
    }

    public function registerNow()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('phone', 'Phone Number', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == TRUE) {
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');
                $password = $this->input->post('password');
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'password' => md5($password)
                );

                $this->load->model('User');
                $this->User->insertUser($data);
                $this->session->set_flashdata('success', 'data save successfully!');
                redirect(base_url('welcome/index'));
            }
        // $register = $_POST;
        // echo "<pre>";
        // print_r($register);
        }
    }
}
