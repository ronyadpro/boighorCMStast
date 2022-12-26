<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Author_model');
		$this->load->model('License_model');
	}

	public function index() {
        $this->authorlist();
	}

    public function authorlist() {
        if ($this->userinfo['permissions']->author_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Author List';
			$data['content'] = $this->load->view('author/view_authorlist', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
    }

    public function getauthors() {
        if ($this->userinfo['permissions']->author_view) {
            echo json_encode( $this->Author_model->get_authorlist_serverside($_POST) );
        } else {
            echo 403;
        }
    }

    public function overview($authorcode='')  {
		if ($this->userinfo['permissions']->author_view) {
            $data = $this->Author_model->get_author_details($authorcode);
			$data['credentials'] = $this->License_model->get_licenser_credentials($authorcode);
			$data['licensetypes'] = $this->License_model->get_book_license_types();
			$data['paymenttypes'] = $this->License_model->get_book_license_payment_types();
			$data['termtypes'] = $this->License_model->get_book_license_terms();
			$data['userinfo'] = $this->userinfo;
            $data['title'] = 'Author Overview';
            $data['content'] = $this->load->view('author/view_authoroverview', $data, TRUE);
            $this->load->view('view_layout', $data);
        } else {
			$this->access_denied();
		}
    }

    public function updateAuthorInfo($authorcode) {
		if ($this->userinfo['permissions']->author_update) {
            $_POST['updatedby'] = $this->userinfo['username'];
            $response = $this->Author_model->update_authorInfo_by_authorcode($authorcode, $_POST);
            echo $response;
            $this->log('updated author info - '.$authorcode.' - '.$_POST['author'], 2, $_POST, $response);
        } else {
			echo 403;
		}
    }

    public function updateAuthorLicenseInfo($authorcode) {
		if ($this->userinfo['permissions']->author_update) {
            $_POST['updatedby'] = $this->userinfo['username'];
            $response = $this->Author_model->update_authorInfo_by_authorcode($authorcode, $_POST);
            echo $response;
            $this->log('updated author license info - '.$authorcode.' - '.$_POST['author'], 2, $_POST, $response);
        } else {
			echo 403;
		}
    }

    public function uploadAuthorPic($authorcode) {
        if ($this->userinfo['permissions']->author_update) {
            $path = 'author_th';
            $file_extension = ".jpg";
            if(isset($_FILES["file_upload"]["name"])) {
                // if (file_exists($path.$authorcode.'.jpg')) {
                //     $backup_path = '/var/www/html/ebswap/author_th_deleted/';
                //     copy($path.$authorcode.'.jpg', $backup_path.$authorcode.'_'.date('Y-m-d_H:i:s').'_'.$this->userinfo['username'].'.jpg');
                // }
                // $config['upload_path'] = $path;
                // $config['allowed_types'] = 'jpg|epub';
                // $config['max_size'] = '2048';
                // $config['file_name'] = $authorcode.".jpg";

				$resp = $this->upload_image_to_s3('file_upload', $path, $authorcode);
				echo $resp;
				$this->Author_model->update_authorInfo_by_authorcode($authorcode, array('author_th'=>1));
				$this->log('uploaded author pic - '.$authorcode, 2, $authorcode, $resp);

                // $this->load->library('upload', $config);
                // $this->upload->overwrite = true;
                // if ($this->upload->do_upload('file_upload')) {
                //     echo 1;
                //     $this->log('uploaded author pic - '.$authorcode, 2, $authorcode, 1);
                // } else {
                //     $error = $this->upload->display_errors();
                //     echo json_encode( $error );
                //     $this->log('uploaded author pic - '.$authorcode, 2, $error, 0);
                // }
            } else {
                echo 0;
            }
        } else {
            echo 403;
        }
    }

    public function updateAuthorTags($authorcode) {
		if ($this->userinfo['permissions']->author_update) {
            $this->load->model('Book_model');
            $response = $this->Book_model->update_tags_by_code($authorcode, 1, $_POST, $this->userinfo['username']);
            echo $response;
            $this->log('edited author tags - '.$authorcode, 2, $_POST, $response);
        } else {
			echo 403;
		}
    }

    public function addNew() {
		if ($this->userinfo['permissions']->author_create) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'New Author';
			$data['content'] = $this->load->view('author/view_addnewauthor', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
    }

    public function addNewAuthorInfo() {
		if ($this->userinfo['permissions']->author_create) {
            $_POST['numberofbooks'] = 0;
            $_POST['addedby'] = $this->userinfo['username'];
            $_POST['dateofaddition'] = date('Y-m-d H:i:s');
            $response = $this->Author_model->add_new_author($_POST);
            echo $response;
            $this->log('added new author - '.$_POST['author'], 1, $_POST, $response);
		} else {
			echo 401;
		}
    }

	// public function update_bookCount() {
    //     return $this->Author_model->update_bookCount();
    // }

	public function createLicenserProfile($authorcode) {
		if ($this->userinfo['permissions']->author_update) {
			$post = $this->input->post(NULL,TRUE);
			$response = $this->License_model->create_licenser_profile($post);
			echo $response;
			$this->log('created author licenser profile - '.$authorcode, 1, $_POST, $response);
		} else {
			echo 403;
		}
	}


}
