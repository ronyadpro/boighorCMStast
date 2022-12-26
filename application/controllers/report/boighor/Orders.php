<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Report_model');
	}

	public function index() {
        if ($this->userinfo['permissions']->bi_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Daily Orders';
			$data['content'] = $this->load->view('report/boighor/view_report_order_log', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

    public function get_order_logs() {
        if ($this->userinfo['permissions']->bi_view) {
            $post = $this->input->post(NULL, TRUE);
            echo json_encode( $this->Report_model->get_order_logs($post) );
        } else {
            echo 403;
        }
    }
}
