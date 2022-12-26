<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Revenue extends CMS_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Report_model');
    }

    public function index() {
        if (!empty($this->userinfo['permissions']->finance_view)) {
        	$data['userinfo'] = $this->userinfo;
        	$data['title'] = 'Revenue';
			$data['licensers'] = $this->Report_model->get_all_licensers();
        	$data['content'] = $this->load->view('report/boighor/view_report_revenue', $data, TRUE);
        	$this->load->view('view_layout', $data);
        } else {
            $this->access_denied();
        }
    }

    public function get_revenue_report() {
        if (!empty($this->userinfo['permissions']->finance_view)) {
            $post = $this->input->post(NULL, TRUE);
            echo json_encode( $this->Report_model->get_revenue_report($post) );
        } else {
            echo 403;
        }
    }
}
