<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Book_model');
		$this->load->model('Main_model');
		$this->load->model('Report_model');
		$this->load->model('Dashboard_model');
		$this->load->model('Order_model');

	}

	public function index() {

		$this->dashboard();
	}

	public function dashboard() {
			$data = $this->Dashboard_model->get_dashboard_info();
			$data['daily_sale_book'] = $this->Report_model->get_daily_book_sale(30);
			$data['daily_sale_amount'] = $this->Report_model->get_daily_sale_amount(30);
			$data['monthly_sale_amount'] = $this->Report_model->get_monthly_sale_amount(6);
			$data['total_sale_amount'] = $this->Report_model->get_monthly_sale_amount(100);
			$data['this_month_sale_amount'] = $this->Report_model->get_this_month_sale_amount();
			$data['top_author'] = $this->Report_model->get_top_author_pie_chart_data(30);
			$data['top_genre'] = $this->Report_model->get_top_genre_pie_chart_data(7);
			$data['top_country'] = $this->Report_model->get_top_country_pie_chart_data(7);
			$data['top_book'] = $this->Report_model->get_top_book_pie_chart_data(7);
			$data['top_paymethod'] = $this->Report_model->get_top_paymethod_pie_chart_data(7);
			$data['top_platform'] = $this->Report_model->get_top_platform_pie_chart_data(7);
			$data['latest_uploads'] = $this->Dashboard_model->get_last_upload_list(20);
 			$data['userinfo'] = $this->userinfo;
            if ($this->userinfo['username'] == 'bhuyan' || $this->userinfo['username'] == 'sanaullah') {
                $data['showtoplist'] = '0';
            } else {
                $data['showtoplist'] = '1';
            }
			$data['title'] = 'Dashboard';
			$data['content'] = $this->load->view('view_dashboard', $data, TRUE);
			$this->load->view('view_layout', $data);
	}

    public function timeline($username='', $date='', $date_to='') {
        if ($this->userinfo['level']==6 || $this->userinfo['username']=='anarjo') {
        } else {
            $username = $this->userinfo['username'];
        }
            $data['date'] = $date;
            $data['date_to'] = $date_to ?: $date;
            $data['username'] = $username;
			$data['logs'] = $this->Main_model->get_log_timeline($username=="all" ? "" : $username, date_format(date_create($date ? $date : ''),"Y-m-d"), date_format(date_create($date_to ? $date_to : ''),"Y-m-d"), $this->userinfo['level']);
 			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Timeline';
			$data['content'] = $this->load->view('view_logs', $data, TRUE);
			$this->load->view('view_layout', $data);
    }

    public function maintenance() {
        // $data = $this->Book_model->updatePricing();
        $data['booklist'] = $this->Book_model->get_all_books();
        $data['userinfo'] = $this->userinfo;
        $data['title'] = 'Maintenance';
        $data['content'] = $this->load->view('view_maintenance', $data, TRUE);
        $this->load->view('view_layout', $data);
    }

    public function search($keyword) {
        header('Content-Type:application/json');
        if ($this->isloggedin) {
            $data = $this->Main_model->search($keyword);
            echo json_encode($data, JSON_PRETTY_PRINT);
        } else {
			redirect(base_url());
        }
    }

    public function report() {
        $booklist = $this->Book_model->get_all_books();
        $newbooklist = array();
        foreach ($booklist as $book) {
            if (file_exists('/var/www/html/ebswap/book_th_plain/'.$book->bookcover_small) && file_exists('/var/www/html/ebswap/book_th/'.$book->bookcover_small)) {
                array_push($newbooklist, $book);
            }
        }
        $data['userinfo'] = $this->userinfo;
        $data['booklist'] = $newbooklist;
        $data['content'] = $this->load->view('view_report', $data, TRUE);
        $this->load->view('view_layout', $data);
    }

	public function get_order_details() {
        $order_result = $this->Order_model->get_order_details_count();

		echo json_encode($order_result);
    }

    // public function get_file_info($url='') {
    //
    //     $booklist = $this->Book_model->get_all_books();
    //
    //     foreach ($booklist as $row) {
    //
    //         $url = "https://bangladhol.com/book_th/$row->bookcover_small";
    //
    //         $size = $this->lol($url);
    //
    //         /*$header = get_headers($url);
    //         foreach ($header as $head) {
    //             if (preg_match('/Content-Length: /', $head)) {
    //                 $size = substr($head, 15);
    //             }
    //         }*/
    //
    //         $image_info = getimagesize($url);
    //
    //         $data['bookcode'] = $row->bookcode;
    //         $data['bookname'] = $row->bookname;
    //         $data['writer'] = $row->writer;
    //         $data['bookcover'] = $row->bookcover_small;
    //         $data['width'] = $image_info[0];
    //         $data['height'] = $image_info[1];
    //         $data['format'] = explode('.', $row->bookcover_small)[1];
    //         $data['filesize'] = explode('.', $size/1024)[0];
    //
    //         //if ($data['filesize']>200 || $data['width']!=360 || $data['height']!=540 || $data['format']!='jpg') {
    //             // echo json_encode($data);
    //         $this->db->insert('_tblWrongCoverSizes', $data);
    //         //}
    //
    //         //break;
    //     }
    // }

    // public function lol($uu)
    // {
    //     $remoteFile = $uu;
    //     $ch = curl_init($remoteFile);
    //     curl_setopt($ch, CURLOPT_NOBODY, true);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_HEADER, true);
    //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); //not necessary unless the file redirects (like the PHP example we're using here)
    //     $data = curl_exec($ch);
    //     curl_close($ch);
    //     if ($data === false) {
    //       echo 'cURL failed';
    //       exit;
    //     }
    //
    //     $contentLength = 'unknown';
    //     $status = 'unknown';
    //     if (preg_match('/^HTTP\/1\.[01] (\d\d\d)/', $data, $matches)) {
    //       $status = (int)$matches[1];
    //     }
    //     if (preg_match('/Content-Length: (\d+)/', $data, $matches)) {
    //       $contentLength = (int)$matches[1];
    //     }
    //
    //     //echo 'HTTP Status: ' . $status . "\n";
    //     return $contentLength;
    // }

}
