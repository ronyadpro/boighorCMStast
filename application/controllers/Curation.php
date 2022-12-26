<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curation extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Curation_model');
		$this->load->model('Book_model');
	}

	public function index() {
		echo "looking for Something? 😒";
	}

    public function gp() {
		if ($this->userinfo['permissions']->curation_view) {
            $data['categories'] = $this->Book_model->get_category_list();
            $data['genres'] = $this->Book_model->get_genre_list();
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Curation-GP';
			$data['content'] = $this->load->view('curation/view_cur_home_gp', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
    }

    public function boighor() {
		if ($this->userinfo['permissions']->curation_view) {
            $data['categories'] = $this->Book_model->get_category_list();
            $data['genres'] = $this->Book_model->get_genre_list();
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Curation-Global';
			$data['content'] = $this->load->view('curation/view_cur_home_global', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
    }

    public function robi() {
		if ($this->userinfo['permissions']->curation_view) {
            $data['categories'] = $this->Book_model->get_category_list();
            $data['genres'] = $this->Book_model->get_genre_list();
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Curation-RobiBoighor';
			$data['content'] = $this->load->view('curation/view_cur_home_robi', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
    }

    public function blink() {
		if ($this->userinfo['permissions']->curation_view) {
            $data['categories'] = $this->Book_model->get_category_list();
            $data['genres'] = $this->Book_model->get_genre_list();
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Curation-BanglalinkBoighor';
			$data['content'] = $this->load->view('curation/view_cur_home_blink', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
    }

    public function airtel() {
		if ($this->userinfo['permissions']->curation_view) {
            $data['categories'] = $this->Book_model->get_category_list();
            $data['genres'] = $this->Book_model->get_genre_list();
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Curation-AirtelPocketbook';
			$data['content'] = $this->load->view('curation/view_cur_home_airtel', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
    }

    public function getHomeData() {
        if ($this->userinfo['permissions']->curation_view) {
            echo json_encode( $this->Curation_model->get_homedata_serverside($_POST) );
        } else {
            echo 403;
        }
    }

    public function reorderhomedata() {
        if ($this->userinfo['permissions']->curation_update) {
            $response = $this->Curation_model->update_sortorder_home($_POST);
            echo $response;
            $this->log('reordered home', 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function changeStatus() {
        if ($this->userinfo['permissions']->curation_update) {
            echo $this->Curation_model->update_status_by_platform($_POST);
        } else {
            echo 403;
        }
    }

    public function getBooklist($value='') {
        if ($this->userinfo['permissions']->curation_view) {
            echo json_encode( $this->Curation_model->get_booklist_serverside($_POST) );
        } else {
            echo 403;
        }
    }

    public function createSection($value='') {
        if ($this->userinfo['permissions']->curation_create) {
            echo $this->Curation_model->create_new_section($_POST);
        } else {
            echo 403;
        }
    }

    public function getSectionItems($value='') {
        if ($this->userinfo['permissions']->curation_view) {
            echo json_encode( $this->Curation_model->get_section_items_by_catcode($_POST['catcode']) );
        } else {
            echo 403;
        }
    }

    public function updateSectionSortorder($value='') {
        if ($this->userinfo['permissions']->curation_update) {
            echo json_encode( $this->Curation_model->update_section_items_sortorder($_POST) );
        } else {
            echo 403;
        }
    }

    public function removeSectionItem($value='') {
        if ($this->userinfo['permissions']->curation_update) {
            echo json_encode( $this->Curation_model->remove_section_item($_POST) );
        } else {
            echo 403;
        }
    }

    public function addSectionItem($value='') {
        if ($this->userinfo['permissions']->curation_create) {
            echo json_encode( $this->Curation_model->add_section_item($_POST) );
        } else {
            echo 403;
        }
    }

    public function editSectionInfo($value='') {
        if ($this->userinfo['permissions']->curation_update) {
            echo json_encode( $this->Curation_model->update_section_info($_POST) );
        } else {
            echo 403;
        }
    }

    public function banner($telco ='' ) {
		if ($this->userinfo['permissions']->curation_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Banner-Curation '.$telco;
            switch ($telco) {
                case 'airtel':
                    $data['content'] = $this->load->view('curation/view_cur_banner_airtel', $data, TRUE);
                    break;
                case 'blink':
                    $data['content'] = $this->load->view('curation/view_cur_banner_blink', $data, TRUE);
                    break;
                case 'global':
                    $data['content'] = $this->load->view('curation/view_cur_banner_global', $data, TRUE);
                    break;
                case 'gp':
                    $data['content'] = $this->load->view('curation/view_cur_banner_gp', $data, TRUE);
                    break;
                case 'robi':
                    $data['content'] = $this->load->view('curation/view_cur_banner_robi', $data, TRUE);
                    break;
                default:
        			redirect(base_url());
                    break;
                    return;
            }
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
    }

    public function get_banner_items($telco='') {
        if ($this->userinfo['permissions']->curation_view) {
            if ($telco) {
                echo json_encode( $this->Curation_model->get_banner_items($_POST, $telco) );
            }
        } else {
            echo 403;
        }
    }

    public function add_banner_item($telco='') {
        //$path = "/var/www/html/ebswap/banner_th/$telco";
		$path = "banner_th/$telco";
        if(isset($_FILES["file_banner_web"]["name"]) && isset($_FILES["file_banner_mob"]["name"])) {
            // if (file_exists($path.$_FILES["file_banner_web"]["name"]) || file_exists($path.$_FILES["file_banner_web"]["name"])) {
            //     echo "duplicate";
            //     return 0;
            // }
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = "1024";

            $t = microtime(true);
            $micro = sprintf("%06d",($t - floor($t)) * 1000000);
            $datetime = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
            $datetime = $datetime->format("ymdHisu");

            $ext1 = pathinfo($_FILES["file_banner_web"]["name"], PATHINFO_EXTENSION);
			$file_name_web = $datetime.'w';
            $_POST['bannerfile_web'] = $datetime.'w.'.$ext1;

            $_FILES["file_banner_web"]["name"] = $_POST['bannerfile_web'];

            $t = microtime(true);
            $micro = sprintf("%06d",($t - floor($t)) * 1000000);
            $datetime = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
            $datetime = $datetime->format("ymdHisu");

            $ext2 = pathinfo($_FILES["file_banner_mob"]["name"], PATHINFO_EXTENSION);
			$file_name_mob = $datetime.'a';
            $_POST['bannerfile_mob'] = $datetime.'a.'.$ext2;
            $_FILES["file_banner_mob"]["name"] = $_POST['bannerfile_mob'];

			$result = $this->upload_image_to_s3('file_banner_web', $path, $file_name_web);
			$this->log($telco.' Banner Upload - status :'.$result . $_POST['title'], 1, $_POST, 1);
			$result = $this->upload_image_to_s3('file_banner_mob', $path, $file_name_mob);
			$this->log($telco.' Banner Upload - status :'. $result .$_POST['title'], 1, $_POST, 1);

			$db_insert_result = $this->Curation_model->add_banner_item($_POST, $telco);
			echo $db_insert_result;

			//$this->log($telco.' Banner Upload - status :'...$_POST['title'], 1, $_POST, 1);

            // echo json_encode( $config );
            // return 1;
            // $this->load->library('upload', $config);
            // $this->upload->overwrite = false;
            // if ($this->upload->do_upload('file_banner_web') && $this->upload->do_upload('file_banner_mob')) {
            //     $db_insert_result = $this->Curation_model->add_banner_item($_POST, $telco);
            //     echo $db_insert_result;
            //     // echo "1";
            //     $this->log($telco.' Banner Upload - '.$_POST['title'], 1, $_POST, 1);
            // } else {
            //     $error = $this->upload->display_errors();
            //     echo json_encode( $error );
            //     $this->log($telco.' Banner Upload - '.$_POST['title'], 1, $_POST, 0);
            // }
        } else {
            echo 'file not found';
        }
    }

    public function change_banner_item_status($telco='') {
        if ($this->userinfo['permissions']->curation_update) {
            $response = $this->Curation_model->change_banner_item_status($_POST['id'], $_POST['status'], $telco);
            echo $response;
            $this->log($telco.' Banner Status - '.$_POST['id'].' to '.$_POST['status'], 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function delete_banner_item($telco='') {
        if ($this->userinfo['permissions']->curation_delete) {
            $response = $this->Curation_model->delete_banner_item($_POST['id'], $telco);
            echo $response;
            $this->log($telco.' Banner Delete - '.$_POST['id'], 0, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function update_banner_item($telco='') {
        if ($this->userinfo['permissions']->curation_update) {
            $response = $this->Curation_model->update_banner_item($_POST, $telco);
            echo $response;
            $this->log($telco.' Banner Update - '.$_POST['title'], 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function reorder_banner($telco='') {
        if ($this->userinfo['permissions']->curation_update) {
            $response = $this->Curation_model->update_sortorder_banner($_POST, $telco);
            echo $response;
            $this->log($telco.' Banner Reordered - '.$telco, 2, $_POST, $response);
        } else {
            echo 403;
        }
    }
}
