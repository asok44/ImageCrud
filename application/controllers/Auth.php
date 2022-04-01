<?php

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function register()
    {

        if ($this->auth_model->authorized() == true) {

            redirect(base_url() . 'auth/dashboard');
        }

        $this->load->library('form_validation', NULL, 'fv');

        $this->fv->set_message('is_unique', 'Email address already exist, please try another.');
        $this->fv->set_rules('firstname', 'First Name', 'required');
        $this->fv->set_rules('lastname', 'Last Name', 'required');
        $this->fv->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->fv->set_rules('phone', 'Phone No.', 'required');
        $this->fv->set_rules('password', 'Password', 'required');

        if ($this->fv->run() == false) {

            $this->load->view('register');
        } else {

            $orig_filename = $_FILES["image"]['name'];
            $new_name = time() . "" . str_replace(' ', '-', $orig_filename);

            $config['upload_path'] = './image/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $new_name;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $img_filename = $this->upload->data('file_name');
                $formarray = array(
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'created_at' => date('Y-m-d H:i:s'),
                    'filename' => $img_filename
                );
                $this->auth_model->create($formarray);
                $this->session->set_flashdata('msg', 'Your account has been created successfully.');
                redirect(base_url() . 'auth/register');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('register', $error);
            }
        }
    }

    public function login()
    {

        if ($this->auth_model->authorized() == true) {

            redirect(base_url() . 'auth/dashboard');
        }

        $this->load->library('form_validation', NULL, 'fv');

        $this->fv->set_rules('email', 'Email', 'required|valid_email');
        $this->fv->set_rules('password', 'Password', 'required');

        if ($this->fv->run() == true) {

            $email = $this->input->post('email');
            $user = $this->auth_model->checkUser($email);

            if (!empty($user)) {

                $password = $this->input->post('password');
                if (password_verify($password, $user['password']) == true) {

                    $sessArray['id'] = $user['id'];
                    $sessArray['firstname'] = $user['firstname'];
                    $sessArray['lastname'] = $user['lastname'];
                    $sessArray['email'] = $user['email'];

                    $this->session->set_userdata('user', $sessArray);
                    redirect(base_url() . 'auth/dashboard');
                } else {

                    $this->session->set_flashdata('msg', 'Either email or password is incorrect, please try again.');
                    redirect(base_url() . 'auth/login');
                }
            }
        } else {

            $this->load->view('login');
        }
    }

    public function dashboard()
    {
        if ($this->auth_model->authorized() == false) {

            $this->session->set_flashdata('msg', 'You are not authorized to access this section.');
            redirect(base_url() . 'auth/login');
        }
        $data['users'] = $this->session->userdata('user');
        $this->load->view('dashboard', $data);
    }

    public function display()
    {
        if ($this->auth_model->authorized() == false) {
            $this->session->set_flashdata('msg', 'Your are not authorized to access this section.');
            redirect(base_url('auth/login'));
        }

        $data['users'] = $this->auth_model->getUser();
        $this->load->view('display', $data);
    }

    public function edit($id)
    {
        $data['users'] = $this->auth_model->editUser($id);
        $this->load->view('edit', $data);
    }

    public function update($id)
    {
        $this->load->library('form_validation', NULL, 'fv');
        
        $this->fv->set_rules('firstname', 'First Name', 'required');
        $this->fv->set_rules('lastname', 'Last Name', 'required');
        $this->fv->set_rules('email', 'Email', 'required|valid_email');
        $this->fv->set_rules('phone', 'Phone No.', 'required');
        $this->fv->set_rules('password', 'Password', 'required');
        
        if ($this->fv->run())
        {
            $old_filename = $this->input->post('old_image');
            $new_filename = $_FILES["image"]['name'];

            if ($new_filename == false) {
                $update_filename = $old_filename;
            }
            else
            {
                $update_filename = time() . "" . str_replace(" ", "-", $_FILES["image"]['name']);
                $config['upload_path'] = './image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['file_name'] = $update_filename;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    if (file_exists("./image/" . $old_filename)) {
                        unlink("./image/".$old_filename);
                    }
                }
            }
                $updateArray = array(
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'filename' => $update_filename
                );
                $this->auth_model->updateUser($updateArray, $id);
                
                $this->session->set_flashdata('msg', 'Your account has been updated successfully.');
                redirect(base_url() . 'auth/edit/' . $id);
        } 
        else
        {
            redirect(base_url() . 'auth/edit/' . $id);
        }
    }

    public function delete($id)
    {
        if($this->auth_model->checkUserImage($id))
        {
            $data = $this->auth_model->checkUserImage($id);
            if(file_exists("./image/".$data->filename)){
                unlink("./image/".$data->filename);
            }
            $this->auth_model->deleteUser($id);
            $this->session->set_flashdata('msg', 'User deleted successfully.');
            redirect(base_url('auth/display'));
        }
    }

    public function logout()
    {

        $this->session->unset_userdata('user');
        redirect(base_url() . 'auth/login');
    }
}
