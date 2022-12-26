<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Legal extends CMS_Controller {

    public function index() {
        if ($this->userinfo['permissions']->book_view) {
            $this->load->model('Legal_model');
            $data['userinfo'] = $this->userinfo;
            $data['title'] = 'Legal Informations';
            $data['legalinfolist'] = $this->Legal_model->get_legal_info_list();
            $data['content'] = $this->load->view('view_legal_info', $data, TRUE);
            $this->load->view('view_layout', $data);
        } else {
            $this->access_denied();
        }
    }

    public function edit_legal_info() {
        if ($this->userinfo['permissions']->book_view) {
            $this->load->model('Legal_model');
            $_POST['updatedby'] = $this->userinfo['username'];
            $resp = $this->Legal_model->edit_legal_info($_POST);
            $this->log('edited legal information - '.$_POST['appinfo'], 2, $_POST, $resp);
            echo $resp;
        } else {
            $this->access_denied();
		}
	}

}
