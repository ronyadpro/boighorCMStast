<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Book_model');
		$this->load->model('Model_RemoteConfig');

	}

	public function index() {
		echo "looking for Something? 😒";
	}

	public function boighorglobal() {
        if ($this->userinfo['permissions']->bi_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Global User List';
			$data['content'] = $this->load->view('user/view_userlist_boighorglobal', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
            $this->access_denied();
		}
	}

    public function get_userlist_global() {
        $param = $this->input->post(NULL, TRUE);
        echo json_encode($this->User_model->get_userlist_global($param));
    }

	public function get_bookDetails()
	{
		$param = $this->input->post(NULL, TRUE);
		$data = $this->Book_model->get_book_details($param['bookcode']);
		echo json_encode($data);
	}

	public function add_book_to_userprofile(){
		$param = $this->input->post(NULL, TRUE);
		$result = $this->User_model->handleGiftBook($param);
		if ($result == -1) {
			// code...
		}else {
			$this->log('Book added to - userid - '. $param['userid'].' - bookcode - '.$param['bookcode'], 1, $_POST, $result);
		}

		echo $result;
	}

    public function overview($userid) {
        if ($this->userinfo['permissions']->bi_view) {
            $data = $this->User_model->get_user_details($userid);
			$data['config'] = $this->Model_RemoteConfig->get_config();
            $data['userinfo'] = $this->userinfo;
            $data['title'] = 'User Overview';
            $data['content'] = $this->load->view('user/view_user_overview_boighorglobal', $data, TRUE);
            $this->load->view('view_layout', $data);
        } else {
            $this->access_denied();
        }
    }

	public function editDevice() {
        if ($this->userinfo['permissions']->category_update) {  
            $response = $this->User_model->edit_device($_POST);
            echo $response;
            $this->log('edited device - '.$this->userinfo['username'], 2, $_POST, $response); 
        } else {
            echo 403;
        }
    }

}
