<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_image extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Image_model');
	}

	public function index() {
        if (!empty($this->userinfo['permissions']->image_upload_notification)) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Notification Image';
			$data['content'] = $this->load->view('image/view_notification_image', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
            $this->access_denied();
		}
	}

	public function get_notification_images() {
        if (!empty($this->userinfo['permissions']->image_upload_notification)) {
			$post = $this->input->post(NULL, TRUE);
			echo json_encode($this->Image_model->get_notification_images($post));
		} else {
			$this->access_denied();
		}
    }

	public function upload() {
        if (!empty($this->userinfo['permissions']->image_upload_notification)) {
			$filename = $this->input->post('filename');
			if (isset($_FILES["file_upload"]["name"]) && isset($_POST["filename"])) {
				$resp = $this->upload_image_to_s3('file_upload', 'pn', $_POST["filename"]);
				if ($resp) {
					$data = array(
						'filename'=>$_POST["filename"].'.jpg',
						'createdby'=>$this->userinfo['username']
					);
					$this->Image_model->insert_notification_image($data);
					echo 1;
				} else {
					echo 0;
				}
			} else {
				echo 403;
			}
		} else {
			$this->access_denied();
		}

	}

}
