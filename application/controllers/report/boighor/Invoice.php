<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Report_model');
		$this->load->model('Author_model');
		$this->load->model('Publisher_model');
	}

	public function index() {
        if ($this->userinfo['permissions']->bi_view) {
			$data['userinfo'] = $this->userinfo;
			$data['authorlist'] = $this->Author_model->get_authorlist();
			$data['publisherlist'] = $this->Publisher_model->get_all_publishers();
			$data['title'] = 'Report by Owner';
			$data['content'] = $this->load->view('report/boighor/view_report_invoice', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

    public function get_sales_report() {
        if ($this->userinfo['permissions']->bi_view) {
            $post = $this->input->post(NULL, TRUE);
            echo json_encode( $this->Report_model->get_sales_report($post) );
        } else {
            echo 403;
        }
    }
}
