<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adb extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Report_model');
		// $this->load->model('Author_model');
		$this->load->model('Publisher_model');
	}

	public function mou($servicename='boighorglobal') {
		switch ($servicename) {
			case 'boighorglobal':
				$this->index();
				break;
			default:
				$this->index();
				break;
		}
	}

	public function index() {
        if ($this->userinfo['permissions']->bi_view) {
			$data['userinfo'] = $this->userinfo;
			$data['publishers'] = $this->Publisher_model->get_all_publishers();
			$data['title'] = 'MOU';
			$data['servicename'] = 'boighorglobal';
			$data['content'] = $this->load->view('report/boighor/view_report_adb_mou', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

    public function get_mou_report() {
        if ($this->userinfo['permissions']->bi_view) {
            $post = $this->input->post(NULL, TRUE);
            echo json_encode( $this->Report_model->get_mou_report($post) );
        } else {
            echo 403;
        }
    }
}
