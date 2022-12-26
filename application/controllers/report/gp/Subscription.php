<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Report_model');
		$this->load->model('Report_model_gp');
		$this->load->model('Author_model');
		$this->load->model('Publisher_model');
	}

	public function index() {
        if ($this->userinfo['permissions']->bi_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Subscription Report';
			$data['content'] = $this->load->view('report/gp/view_report_subscription', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

    public function get_subscription_report() {
        if ($this->userinfo['permissions']->bi_view) {
            $post = $this->input->post(NULL, TRUE);
            echo json_encode( $this->Report_model_gp->get_subscription_report($post) );
        } else {
            echo 403;
        }
    }
}
