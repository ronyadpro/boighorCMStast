<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Coupon extends CMS_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_Admin');
        $this->load->model('Coupon_model');
    }

    public function index() {
        if ($this->userinfo['permissions']->coupon_view) {

            //$data['userlist'] = $this->Model_Admin->get_user_list();
            $data['userinfo'] = $this->userinfo;
            $data['title'] = 'Coupon';
            $data['content'] = $this->load->view('coupon/view_coupon.php', $data, TRUE);
            $this->load->view('view_layout', $data);

        } else {
            $this->access_denied();
        }
    }

    public function get_coupons() {
        $param = $this->input->post(NULL, TRUE);
        echo json_encode($this->Coupon_model->get_coupons_old($param));
    }







    // public function get_coupons() {
    //     $param = $this->input->post(NULL, TRUE);
    //     echo json_encode($this->Coupon_model->get_coupons($param));
    // }

    public function change_coupon_status() {
        if ($this->userinfo['permissions']->coupon_update) {
	        $couponid = $this->input->post('couponid', TRUE);
	        $status = $this->input->post('status', TRUE);
            $response = json_encode($this->Coupon_model->change_status($couponid, $status));
			echo $response;
            $this->log('changed coupon status - '.$couponid, 2, $_POST, $response);
		} else {
            echo 403;
		}
	}
    public function delete_coupon_status(){
        if ($this->userinfo['permissions']->coupon_delete) {
	        $couponid = $this->input->post('couponid', TRUE);
            $response = json_encode($this->Coupon_model->change_delete_status($couponid));
			echo $response;
            $this->log('changed coupon status - '.$couponid, 2, $_POST, $response);
		} else {
            echo 403;
		}
    }

    public function create_coupon() {
        if ($this->userinfo['permissions']->coupon_create) {
			$param['promo_type'] = $this->input->post('ddlcoupon_type', TRUE);
			$param['promo_code'] = $this->input->post('txtcode', TRUE);
			$param['promo_title'] = $this->input->post('txttitle', TRUE);
            $param['discount_type'] = $this->input->post('ddldiscount_type', TRUE);
            if ($param['discount_type'] == 'amount') {
                $param['discount_amount'] = $this->input->post('txtdiscountamount', TRUE);
            }else {
                $param['discount_percent'] = $this->input->post('txtdiscountamount', TRUE);
            }
            $param['discount_amount_limit_enabled'] = $this->input->post('DCEcheck', TRUE);
            //$param['book_limit_enabled'] = $this->input->post('UCEcheck', TRUE);
            $param['book_limit_enabled'] = $this->input->post('MBCEcheck', TRUE);

            $param['total_amount_min'] = !empty($this->input->post('mindiscount', TRUE)) ?  $this->input->post('mindiscount', TRUE) : 0;
            $param['usage_limit'] = !empty($this->input->post('txtusagelimit', TRUE)) ?  $this->input->post('txtusagelimit', TRUE) : 0;
            $param['book_limit'] = !empty($this->input->post('txtcartsize', TRUE)) ? $this->input->post('txtcartsize', TRUE) : 0 ;

            $param['start_date'] = $this->input->post('txtstart_date', TRUE)." 00:00:00";
            $param['expire_date'] = $this->input->post('txtexpire_date', TRUE) ." 23:59:59";

            $response = json_encode($this->Coupon_model->create_coupon($param));

            echo $response;
            $this->log('created coupon', 1, $_POST, $response);
		} else {
            echo 403;
		}
	}




}
