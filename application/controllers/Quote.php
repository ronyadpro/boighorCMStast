<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quote extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Quote_model');
		$this->load->model('Author_model');
	}

	public function index() {
        if ($this->userinfo['permissions']->quote_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Quotes';
			$data['authorlist'] = $this->Author_model->get_authorlist();
			$data['content'] = $this->load->view('quote/view_quote', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
            $this->access_denied();
		}
	}

    public function get_quotes() {
        $param = $this->input->post(NULL, TRUE);
        echo json_encode($this->Quote_model->get_quotes($param));
    }

	public function change_quote_status() {
        if ($this->userinfo['permissions']->quote_update) {
	        $quoteid = $this->input->post('quoteid', TRUE);
	        $status = $this->input->post('status', TRUE);
            $response = json_encode($this->Quote_model->change_status($quoteid, $status));
			echo $response;
            $this->log('changed quote status - '.$quoteid, 2, $_POST, $response);
		} else {
            echo 403;
		}
	}

	public function create_quote() {
        if ($this->userinfo['permissions']->quote_create) {
			$param['quote'] = trim($this->input->post('quote', TRUE));
			$param['authorname_en'] = trim($this->input->post('authorname_en', TRUE));
			$param['authorname_bn'] = trim($this->input->post('authorname_bn', TRUE));
            $response = json_encode($this->Quote_model->create_quote($param));
			echo $response;
            $this->log('created quote', 1, $_POST, $response);
		} else {
            echo 403;
		}
	}

	public function edit_quote() {
        if ($this->userinfo['permissions']->quote_update) {
			$param['pkid'] = trim($this->input->post('pkid', TRUE));
			$param['quote'] = trim($this->input->post('quote', TRUE));
			$param['authorname_en'] = trim($this->input->post('authorname_en', TRUE));
			$param['authorname_bn'] = trim($this->input->post('authorname_bn', TRUE));
            $response = json_encode($this->Quote_model->edit_quote($param));
			echo $response;
            $this->log('edited quote - '.$param['pkid'], 2, $_POST, $response);
			// echo json_encode( $param );
		} else {
            echo 403;
		}
	}


}
