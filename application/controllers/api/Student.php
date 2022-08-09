<?php

require APPPATH . 'libraries/REST_Controller.php';

class Student extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/student_model');
    }
    public function index_post()
    {
        $data = json_decode(file_get_contents("php://input"));

        $name = isset($data->name) ? $data->name : "";
        $email = isset($data->email) ? $data->email : "";
        $phone = isset($data->phone) ? $data->phone : "";
        $password = isset($data->password) ? $data->password : "";

        if (!empty($name) && !empty($email) && !empty($phone) && !empty($password)) {
            $data = array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $name,
            );

            if ($this->student_model->insert_students($data)) {
                $this->response([
                    'status' => '1',
                    'message' => 'Data save successfully.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
            }
            else {
                $this->response([
                    'status' => '0',
                    'message' => 'Failed to create student.',

                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        else {
            $this->response([
                'status' => 0,
                'message' => 'All field must not be empty.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function index_put()
    {
        echo "This is PUT method!";
    }
    public function index_delete()
    {
        echo "This is DELETE method!";
    }
    public function index_get()
    {
        $data = $this->student_model->get_students();

        if (count($data) > 0) {
            $this->response([
                'status' => 1,
                'message' => 'Students Found',
                'data' => $data,
            ], REST_Controller::HTTP_OK);
        }
        else {
            $this->response([
                'status' => 0,
                'message' => 'Students Not Found',
                'data' => $data,
            ], REST_Controller::HTTP_NOT_FOUND);
        }


    }
}