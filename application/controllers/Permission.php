<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Permission extends CMS_Controller {

    	function __construct() {
    		parent::__construct();
            $this->load->model('Model_Admin');
    	}

    public function index() {
        if ($this->userinfo['permissions']->admin_view) {
            $data['userlist'] = $this->Model_Admin->get_user_list();
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Permissions';
			$data['content'] = $this->load->view('view_user_permission', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
            $this->access_denied();
		}
    }

    public function get_user_permission_list() {
        if ($this->userinfo['permissions']->admin_view) {
            echo json_encode( $this->Model_Admin->get_user_permission_list($_POST['username']) );
        } else {
            $this->access_denied();
        }
    }

    public function update_user_permission() {
        if ($this->userinfo['permissions']->admin_update) {
            echo $this->Model_Admin->update_user_permission($_POST['username'], $_POST['field'], $_POST['value']);
        } else {
            $this->access_denied();
        }
    }

}
