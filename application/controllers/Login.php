<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    private $isloggedin = null;
    private $userinfo = null;

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Book_model');
        $this->load->model('Dashboard_model');
		$this->load->model('Model_Authentication');
        $this->isloggedin = $this->session->userdata('logged_in');
        $this->userinfo['username'] = $this->session->userdata('username');
        $this->userinfo['name'] = $this->session->userdata('name');
        $this->userinfo['email'] = $this->session->userdata('email');
        $this->userinfo['level'] = $this->session->userdata('userlevel');
    }

    public function index() {
        if ($this->isloggedin) {
            redirect('dashboard');
        } else {
            $this->load->view('view_login');
        }
    }

    public function validateuser() {
        $this->load->library('session');
        $this->load->model('Main_model');

        $username = $this->input->post("email");
        $password = $this->input->post("password");

        $data = $this->Main_model->validateUser($username, $password);

        if ($data['result'] == "success") {
            $user_permission = $this->Model_Authentication->get_user_permissions($data['usr']);
            $userdata = array(
                'username'  => $data['usr'],
                'name'  => $data['name'],
                'userlevel'  => $data['level'],
                'email'  => $data['email'],
                'logged_in' => TRUE,
                'permissions' => $user_permission
            );

            $this->session->set_userdata($userdata);
            $response = array (
                'result' => 1,
                'referer' => $this->session->userdata('referer') ?: base_url()
            );
        } else {
            $response = array(
                'result' => 0
            );
        }
        echo json_encode($response);
    }


    public function logout() {
        $this->load->library('session');
        $this->session->sess_destroy();
        redirect(base_url());
    }

}
