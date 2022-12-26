<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price extends CMS_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('Price_model');
	}

	public function index() {
		echo "looking for Something? 😒";
	}

    // GP BIMELA

	public function gpboimela() {
        if ($this->userinfo['permissions']->pricing_view) {
            $data['prices'] = $this->Price_model->get_price_list_gpboimela();
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Pricing GP Boimela';
			$data['content'] = $this->load->view('price/view_pricelist_gp', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

	public function edit_pricing_gp_bdt() {
        if ($this->userinfo['permissions']->pricing_update) {
            $post = $this->input->post(NULL, TRUE);
            $post['id']=$post['pkid'];
            unset($post['pkid']);
            $resp = $this->Price_model->edit_pricing_gp_bdt($post);
            echo $resp;
            $this->log('edited pricing scheme for gpboimela bdt - '.$post['id'], 2, $post, $resp);
		} else {
			echo 403;
		}
	}

	public function edit_pricing_gp_usd() {
        if ($this->userinfo['permissions']->pricing_update) {
            $post = $this->input->post(NULL, TRUE);
            $post['id']=$post['pkid'];
            unset($post['pkid']);
            $resp = $this->Price_model->edit_pricing_gp_usd($post);
            echo $resp;
            $this->log('edited pricing scheme for gpboimela usd - '.$post['id'], 2, $post, $resp);
		} else {
			echo 403;
		}
	}

	public function add_pricing_gp_bdt() {
        if ($this->userinfo['permissions']->pricing_create) {
            $post = $this->input->post(NULL, TRUE);
            $resp = $this->Price_model->add_pricing_gp_bdt($post);
            echo $resp;
            $this->log('added pricing scheme for gpboimela bdt - '.$post['id'], 2, $post, $resp);
		} else {
			echo 403;
		}
	}

	public function add_pricing_gp_usd() {
        if ($this->userinfo['permissions']->pricing_create) {
            $post = $this->input->post(NULL, TRUE);
            $resp = $this->Price_model->add_pricing_gp_usd($post);
            echo $resp;
            $this->log('added pricing scheme for gpboimela usd - '.$post['id'], 2, $post, $resp);
		} else {
			echo 403;
		}
	}


    // BOIGHOR GLOABL

	public function boighorglobal() {
        if ($this->userinfo['permissions']->pricing_view) {
            $data['prices'] = $this->Price_model->get_price_list_global();
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Pricing Boighor Global';
			$data['content'] = $this->load->view('price/view_pricelist_global', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

	public function edit_pricing_global_bdt() {
        if ($this->userinfo['permissions']->pricing_update) {
            $post = $this->input->post(NULL, TRUE);
            $post['id']=$post['pkid'];
            unset($post['pkid']);
            $resp = $this->Price_model->edit_pricing_global_bdt($post);
            echo $resp;
            $this->log('edited pricing scheme for boighorglobal bdt - '.$post['id'], 2, $post, $resp);
		} else {
			echo 403;
		}
	}

	public function edit_pricing_global_usd() {
        if ($this->userinfo['permissions']->pricing_update) {
            $post = $this->input->post(NULL, TRUE);
            $post['id']=$post['pkid'];
            unset($post['pkid']);
            $resp = $this->Price_model->edit_pricing_global_usd($post);
            echo $resp;
            $this->log('edited pricing scheme for boighorglobal usd - '.$post['id'], 2, $post, $resp);
		} else {
			echo 403;
		}
	}

	public function add_pricing_global_bdt() {
        if ($this->userinfo['permissions']->pricing_create) {
            $post = $this->input->post(NULL, TRUE);
            $resp = $this->Price_model->add_pricing_global_bdt($post);
            echo $resp;
            $this->log('added pricing scheme for boighorglobal bdt - '.$post['bookprice'], 1, $post, $resp);
		} else {
			echo 403;
		}
	}

	public function add_pricing_global_usd() {
        if ($this->userinfo['permissions']->pricing_create) {
            $post = $this->input->post(NULL, TRUE);
            $resp = $this->Price_model->add_pricing_global_usd($post);
            echo $resp;
            $this->log('added pricing scheme for boighorglobal usd - '.$post['price'], 1, $post, $resp);
		} else {
			echo 403;
		}
	}

	public function bulkedit() {
        if ($this->userinfo['permissions']->pricing_update) {
			$data = $this->Price_model->get_price_list_global();
			$data['discounted_books'] = $this->Price_model->get_discounted_books();
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Bulk Update';
			$data['content'] = $this->load->view('price/view_price_bulk_update', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

	public function price_bulk_update() {
        if ($this->userinfo['permissions']->pricing_update) {
            $post = $this->input->post('books', TRUE);
            $resp = $this->Price_model->price_bulk_update($post);
            echo $resp;
            $this->log('multiple pricing updated for boighorglobal bdt discount - ', 2, $post, $resp);
		} else {
			echo 403;
		}
	}

}
