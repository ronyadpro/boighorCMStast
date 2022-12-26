<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publisher extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Publisher_model');
		$this->load->model('License_model');
	}

	public function index() {
        if ($this->userinfo['permissions']->publisher_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'UGC List';
			$data['content'] = $this->load->view('publisher/view_publisher_list', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
            $this->access_denied();
		}
	}

    public function get_publishers() {
        $param = $this->input->post(NULL, TRUE);
        echo json_encode($this->Publisher_model->get_publishers($param));
    }

    public function overview($publishercode) {
        if ($this->userinfo['permissions']->publisher_view) {
            $data['publisher'] = $this->Publisher_model->get_publisher_details($publishercode);
			$data['credentials'] = $this->License_model->get_licenser_credentials($publishercode);
			$data['licensetypes'] = $this->License_model->get_book_license_types();
			$data['paymenttypes'] = $this->License_model->get_book_license_payment_types();
			$data['termtypes'] = $this->License_model->get_book_license_terms();
            $data['userinfo'] = $this->userinfo;
            $data['title'] = 'Publisher Overview';
            $data['content'] = $this->load->view('publisher/view_publisher_overview', $data, TRUE);
            $this->load->view('view_layout', $data);
        } else {
            $this->access_denied();
        }
    }

    public function add_publisher() {
        if ($this->userinfo['permissions']->publisher_create) {
			$post['publishername_en'] = $this->input->post('publishername_en', TRUE);
			$post['publishername_bn'] = $this->input->post('publishername_bn', TRUE);
			$post['createdby'] = $this->userinfo['username'];
            $response = $this->Publisher_model->add_publisher($post);
            echo $response;
        } else {
            echo 403;
        }
    }

    public function update_publisher() {
        if ($this->userinfo['permissions']->publisher_update) {
			$post = $this->input->post(NULL, TRUE);
            $response = $this->Publisher_model->update_publisher($post);
            echo $response;
        } else {
            echo 403;
        }
    }

	public function getbooklist() {
        if ($this->userinfo['permissions']->publisher_view) {
			$post = $this->input->post(NULL, TRUE);
            $response = $this->Publisher_model->get_booklist($post);
            echo json_encode($response);
        } else {
            echo 403;
        }
	}

}
