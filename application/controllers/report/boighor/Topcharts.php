<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topcharts extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Report_model');
	}

	public function index() {
        if ($this->userinfo['permissions']->bi_view) {
			$data['userinfo'] = $this->userinfo;
    		$data['topbooks'] = $this->Report_model->getTopDownloadHistory();
    		$data['toppurchase'] = $this->Report_model->getTopPurchasedList();
    		$data['topusers'] = $this->Report_model->getTopUserList();
    		$data['popularwriters'] = $this->Report_model->getPopularWriterList();
    		$data['freedownloads'] = $this->Report_model->getFreeBookDownloadList();
			$data['title'] = 'Top Charts';
			$data['content'] = $this->load->view('report/boighor/view_report_topcharts', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

	public function freebookdownloads($date='') {
		if ($date=='') return 0;
        if ($this->userinfo['permissions']->bi_view) {
			$data['userinfo'] = $this->userinfo;
			$data['date'] = $date;
    		$data['topfreebooks'] = $this->Report_model->getFreeBookDownloadListForDate($date);
			$data['title'] = 'Top Free books on '.$date;
			$data['content'] = $this->load->view('report/boighor/view_report_topcharts_freebook_download', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}



}
