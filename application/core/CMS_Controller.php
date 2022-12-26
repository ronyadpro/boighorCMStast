<?php
require_once('application/libraries/s3.php');
require_once('application/libraries/s3_upload.php');
defined('BASEPATH') OR exit('No direct script access allowed');

class CMS_Controller extends CI_Controller {

    public $undermaintenance = 0;

    public $isloggedin = null;
    public $userinfo = null;

	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('user_agent');
		$this->load->model('Main_model');
		$this->isloggedin = $this->session->userdata('logged_in');
        $this->userinfo['username'] = $this->session->userdata('username');
        $this->userinfo['name'] = $this->session->userdata('name');
        $this->userinfo['email'] = $this->session->userdata('email');
        $this->userinfo['level'] = $this->session->userdata('userlevel');
        $this->userinfo['permissions'] = $this->session->userdata('permissions');
        if (!$this->isloggedin) {
            $requested_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $userdata = array( 'referer' => $requested_url );
            $this->session->set_userdata($userdata);
            $this->log_in();
        }
        if ($this->undermaintenance && $this->userinfo['level'] != 6) {
            // $this->load->view('view_undermaintenance');
            redirect(base_url()."dashboard/maintenance");
        }
		include APPPATH . 'third_party/MP3File.php';
        $this->load->library('s3');
        $this->load->library('s3_upload');
	}

    function log($wyd, $type, $request, $response) {
        $data['whatyoudid'] = $wyd;
        $data['referer'] = $this->agent->referrer();
        $data['url'] = $this->input->server('REQUEST_URI');
        $data['type'] = $type;
		$data['request'] = json_encode($request);
		$data['response'] = $response;
		$data['usr'] = $this->userinfo['username'];
		$data['ip'] = $this->input->server('REMOTE_ADDR');
		$data['agent'] = $this->agent->agent_string();
        $data['date'] = date('Y-m-d');
		$this->Main_model->postLogs($data);
	}

    public function getdatetimeid() {
        $t = microtime(true);
        $micro = sprintf("%06d",($t - floor($t)) * 1000000);
        $datetime = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
        $datetime = $datetime->format("ymdHisu");
        return $datetime;
    }

    public function access_denied() {
        $data['userinfo'] = $this->userinfo;
        $data['content'] = $this->load->view('view_access_denied', $data, TRUE);
        $this->load->view('view_layout', $data);
    }

    public function page_not_found() {
        $data['userinfo'] = $this->userinfo;
        $data['content'] = $this->load->view('view_page_not_found', $data, TRUE);
        $this->load->view('view_layout', $data);
    }

    public function log_in() {
        redirect(base_url());
    }

    public function get_adb_file_info($filename) {
        return $this->s3_upload->get_adb_file_info($filename);
    }

    public function delete_adb_file($filename) {
        return $this->s3_upload->delete_adb_file($filename);
    }

    public function upload_image_to_s3($from_image_name, $folder_name, $file_name) {
        // $filesCount = count($_FILES['file_upload']['name']);
        // for($i = 0; $i < $filesCount; $i++){
        if ($_FILES["$from_image_name"]['name']) {
            $_FILES['file']['name']     = $_FILES["$from_image_name"]['name'];
            $_FILES['file']['type']     = $_FILES["$from_image_name"]['type'];
            $_FILES['file']['tmp_name'] = $_FILES["$from_image_name"]['tmp_name'];
            $_FILES['file']['error']    = $_FILES["$from_image_name"]['error'];
            $_FILES['file']['size']     = $_FILES["$from_image_name"]['size'];

            $dir = dirname($_FILES["file"]["tmp_name"]);
            $destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
            rename($_FILES["file"]["tmp_name"], $destination);

            if ($folder_name=='books') {
                $upload = $this->s3_upload->upload_epub_file($destination, $folder_name, $file_name);
                return $upload;
            } else if ($folder_name=='adb') {
                $upload = $this->s3_upload->upload_adb_file($destination, $folder_name, $file_name);
                return $upload;
            } else {
                $upload = $this->s3_upload->upload_image_file($destination, $folder_name, $file_name);
                return $upload;
            }

        } else {
            return 0;
        }
    }

}
