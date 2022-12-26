<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Campaign extends CMS_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_Admin');
        $this->load->model('Campaign_model');
    }

    public function index() {
        if ($this->userinfo['permissions']->campaign_view) {
            $data['userinfo'] = $this->userinfo;
            $data['title'] = 'Campaign';
            $data['content'] = $this->load->view('campaign/view_campaign_report.php', $data, TRUE);
            $this->load->view('view_layout', $data);
        } else {
            $this->access_denied();
        }
    }

    public function get_campaign_report() {
        $param = $this->input->post(NULL, TRUE);
        echo json_encode($this->Campaign_model->get_campaign_report($param));
    }

}
