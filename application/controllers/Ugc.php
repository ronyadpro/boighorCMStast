<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ugc extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Ugc_model');
	}

	public function index() {
		echo "looking for Something? 😒";
	}

	public function boighorglobal() {
        if ($this->userinfo['permissions']->ugc_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'UGC List';
			$data['content'] = $this->load->view('ugc/view_ugclist_boighorglobal', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
            $this->access_denied();
		}
	}

    public function get_ugclist_global() {
        $param = $this->input->post(NULL, TRUE);
        echo json_encode($this->Ugc_model->get_ugclist_global($param));
    }

    public function overview($userid) {
        if ($this->userinfo['permissions']->ugc_view) {
            $data['ugc'] = $this->Ugc_model->get_ugc_details($userid);
            $data['userinfo'] = $this->userinfo;
            $data['title'] = 'UGC Overview';
            $data['content'] = $this->load->view('ugc/view_ugc_overview_boighorglobal', $data, TRUE);
            $this->load->view('view_layout', $data);
        } else {
            $this->access_denied();
        }
    }

    public function change_ugc_status() {
        if ($this->userinfo['permissions']->ugc_update) {
            $response = $this->Ugc_model->change_ugc_status($_POST['ugcid'], $_POST['isapproved']);
            echo $response;
        } else {
            echo 403;
        }
    }

}
