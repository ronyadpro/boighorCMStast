<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index() {
		$this->load->view('app');
	}

	// public function calculate_and_update_book_revenue_share() {
	// 	$this->load->database();
	// 	$orders = $this->db->where('net_selling_price',0)->limit(1)->get('tblOrderDetails_temp')->result_array();
	//
	//
	// 	echo "<pre>";
	// 	var_dump($orders);
	// }

}
