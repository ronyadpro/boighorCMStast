<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charts extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Report_model');
		$this->load->model('Dashboard_model');
	}

    public function index() {
        $this->boighorglobal();
    }

	public function boighorglobal() {
        if ($this->userinfo['permissions']->bi_view) {
            $this->load->model('Report_model');
			$data = $this->Dashboard_model->get_dashboard_info();
			$data['userinfo'] = $this->userinfo;
			$data['daily_sale_book'] = $this->Report_model->get_daily_book_sale(30);
			$data['daily_sale_amount'] = $this->Report_model->get_daily_sale_amount(30);
			$data['daily_new_user'] = $this->Report_model->get_daily_new_user(90);
			$data['social_login'] = $this->Report_model->get_social_login_pie_chart_data();
			$data['login_source'] = $this->Report_model->get_login_source_pie_chart_data();
			$data['book_types'] = $this->Report_model->get_ebook_vs_adb();
			$data['bookprice'] = $this->Report_model->get_price_pie_chart_data();
			$data['category'] = $this->Report_model->get_category_pie_chart_data();
			$data['genre'] = $this->Report_model->get_genre_pie_chart_data();
			$data['title'] = 'Charts & Graphs';
			$data['content'] = $this->load->view('report/boighor/view_report_charts', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

    public function clear_cache() {
        $this->Report_model->cache_clean();
        $this->boighorglobal();
    }
}
