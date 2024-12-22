<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RegisterController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }


    public function index()
    {
        $data['title'] = 'Register';

        $this->load->view('template_register/head_regis', $data);
        $this->load->view('auth/register', $data);
        $this->load->view('template_register/footer_regis', $data);
    }


    public function act_register()
    {
        // Set validation rules for the form inputs
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirmation', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Gender', 'required');

        // Run the form validation
        if ($this->form_validation->run() == FALSE) {
            // Validation failed, send back errors
            $errors = validation_errors();
            echo json_encode(['success' => false, 'message' => $errors]);
        } else {
            // Validation passed, proceed to check if username, email, or phone already exists
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');

            // Check if username, email, or phone exists in the database
            if ($this->UserModel->is_username_taken($username)) {
                echo json_encode(['success' => false, 'message' => 'Username is already taken.']);
                return;
            }

            if ($this->UserModel->is_email_taken($email)) {
                echo json_encode(['success' => false, 'message' => 'Email is already in use.']);
                return;
            }

            if ($this->UserModel->is_phone_taken($phone)) {
                echo json_encode(['success' => false, 'message' => 'Phone number is already in use.']);
                return;
            }

            // If all checks pass, save the user data
            $userData = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'username' => $username,
                'email' => $email,
                'password' => $this->input->post('password'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'type_user_id' => 3,
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            );

            // Insert the user data into the database
            $inserted = $this->UserModel->insert_user($userData);

            if ($inserted) {
                echo json_encode(['success' => true, 'message' => 'Registration successful!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Registration failed. Please try again later.']);
            }
        }
    }
}

/* End of file RegisterController.php */
