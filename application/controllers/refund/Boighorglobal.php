<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Boighorglobal extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Refund_model');
	}

	public function index() {
        if ($this->userinfo['permissions']->feedback_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Refund Boighor-Global';
			$data['content'] = $this->load->view('refund/view_refund_boighorglobal', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

    public function get_refund_serverside() {
        if ($this->userinfo['permissions']->feedback_view) {
            $post = $this->input->post(NULL, TRUE);
            echo json_encode( $this->Refund_model->get_refund_serverside($post) );
        } else {
            echo 403;
        }
    }

	public function update_refund_request_status() {
        if ($this->userinfo['permissions']->feedback_update) {
            $post = $this->input->post(NULL, TRUE);
			$post['username'] = $this->userinfo['username'];
            echo json_encode( $this->Refund_model->update_refund_request_status($post) );
        } else {
            echo 403;
        }
    }
}
