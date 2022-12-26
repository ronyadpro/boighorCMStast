<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Boighorglobal extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Feedback_model');
	}

	public function index() {
        if ($this->userinfo['permissions']->feedback_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Feedback Boighor-Global';
			$data['content'] = $this->load->view('feedback/view_feedback_boighorglobal', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

    public function get_feedback_serverside() {
        if ($this->userinfo['permissions']->feedback_view) {
            $post = $this->input->post(NULL, TRUE);
            echo json_encode( $this->Feedback_model->get_feedback_serverside($post) );
        } else {
            echo 403;
        }
    }

	public function updte_feedback_status() {
        if ($this->userinfo['permissions']->feedback_update) {
            $post = $this->input->post(NULL, TRUE);
			$post['username'] = $this->userinfo['username'];
            echo json_encode( $this->Feedback_model->updte_feedback_status($post) );
        } else {
            echo 403;
        }
    }
}
