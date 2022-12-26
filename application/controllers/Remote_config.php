<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Remote_config extends CMS_Controller {

    	function __construct() {
    		parent::__construct();
            $this->load->model('Model_RemoteConfig');
    	}

    public function index() {
        if ($this->userinfo['permissions']->admin_view) {
			$data['config'] = $this->Model_RemoteConfig->get_config();
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Remote Configuaration';
			$data['content'] = $this->load->view('view_remote_config', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
            $this->access_denied();
		}
    }

    public function update_remote_config() {
        if ($this->userinfo['permissions']->admin_update) {
            $post = $this->input->post(NULL, TRUE);
            echo $this->Model_RemoteConfig->update_remote_config($post);
        } else {
            echo 403;
        }
    }

}
