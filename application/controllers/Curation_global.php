<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class curation_global extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Curation_model_global');
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

    public function getHomeData() {
        if ($this->userinfo['permissions']->curation_view) {
            echo json_encode( $this->Curation_model_global->get_homedata_serverside($_POST) );
        } else {
            echo 403;
        }
    }

    public function getHomeData_archived() {
        if ($this->userinfo['permissions']->curation_view) {
            echo json_encode( $this->Curation_model_global->get_homedata_archived($_POST) );
        } else {
            echo 403;
        }
    }

    public function reorderhomedata() {
        if ($this->userinfo['permissions']->curation_update) {
            $response = $this->Curation_model_global->update_sortorder_home($_POST);
            echo $response;
            $this->log('reordered home', 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function changeStatus() {
        if ($this->userinfo['permissions']->curation_update) {
            $resp = $this->Curation_model_global->update_status_by_platform($_POST);
            $this->log('changed home section "'.$_POST['catcode'].'" status for '.($_POST['platform']=='showitem'?'app':'web').' to '.($_POST['status']?'live':'offline').' - ', 2, $_POST, $resp);
            echo $resp;
        } else {
            echo 403;
        }
    }

    public function archiveItem() {
        if ($this->userinfo['permissions']->curation_update) {
            $resp = $this->Curation_model_global->archive_item($_POST['catcode']);
            $this->log('archived home item - '.$_POST['catcode'], 2, $_POST, $resp);
            echo $resp;
        } else {
            echo 403;
        }
    }

    public function unarchiveItem() {
        if ($this->userinfo['permissions']->curation_update) {
            $resp = $this->Curation_model_global->unarchive_item($_POST['catcode']);
            $this->log('unarchived home item - '.$_POST['catcode'], 2, $_POST, $resp);
            echo $resp;
        } else {
            echo 403;
        }
    }

    public function getBooklist($value='') {
        if ($this->userinfo['permissions']->curation_view) {
            echo json_encode( $this->Curation_model_global->get_booklist_serverside($_POST) );
        } else {
            echo 403;
        }
    }

    public function createSection($value='') {
        if ($this->userinfo['permissions']->curation_create) {
            echo $this->Curation_model_global->create_new_section($_POST);
        } else {
            echo 403;
        }
    }

    public function createSectionSingleBook($value='') {
        if ($this->userinfo['permissions']->curation_create) {
            echo $this->Curation_model_global->create_new_section($_POST);
        } else {
            echo 403;
        }
    }

    public function editSectionSingleBook($value='') {
        if ($this->userinfo['permissions']->curation_update) {
            echo $this->Curation_model_global->update_single_book_section($_POST);
        } else {
            echo 403;
        }
    }

    public function getSectionItems($value='') {
        if ($this->userinfo['permissions']->curation_view) {
            echo json_encode( $this->Curation_model_global->get_section_items_by_catcode($_POST['catcode']) );
        } else {
            echo 403;
        }
    }

    public function updateSectionSortorder($value='') {
        if ($this->userinfo['permissions']->curation_update) {
            echo json_encode( $this->Curation_model_global->update_section_items_sortorder($_POST) );
        } else {
            echo 403;
        }
    }

    public function removeSectionItem($value='') {
        if ($this->userinfo['permissions']->curation_delete) {
            echo json_encode( $this->Curation_model_global->remove_section_item($_POST) );
        } else {
            echo 403;
        }
    }

    public function addSectionItem($value='') {
        if ($this->userinfo['permissions']->curation_create) {
            echo json_encode( $this->Curation_model_global->add_section_item($_POST) );
        } else {
            echo 403;
        }
    }

    public function editSectionInfo($value='') {
        if ($this->userinfo['permissions']->curation_update) {
            echo json_encode( $this->Curation_model_global->update_section_info($_POST) );
        } else {
            echo 403;
        }
    }

    public function banner() {
        if ($this->userinfo['permissions']->curation_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Banner-Curation Global';
            $data['content'] = $this->load->view('curation/view_cur_banner_global', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
            $this->access_denied();
		}
    }

    public function get_banner_items() {
        if ($this->userinfo['permissions']->curation_view) {
            echo json_encode( $this->Curation_model_global->get_banner_items($_POST) );
        } else {
            echo 403;
        }
    }

    public function add_banner_item() {
        $path = "banner_th/global";
        if(isset($_FILES["file_banner_web"]["name"]) && isset($_FILES["file_banner_mob"]["name"]) && isset($_FILES["file_banner_app"]["name"])) {
            // if (file_exists($path.$_FILES["file_banner_web"]["name"]) || file_exists($path.$_FILES["file_banner_web"]["name"])) {
            //     echo "duplicate";
            //     return 0;
            // }
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = "1024";

            $ext1 = '.'.pathinfo($_FILES["file_banner_web"]["name"], PATHINFO_EXTENSION);
			$file_name_web = $this->getdatetimeid().'w';
            $_POST['bannerfile_web'] = $file_name_web.$ext1;
            $_FILES["file_banner_web"]["name"] = $_POST['bannerfile_web'];

            $ext2 = '.'.pathinfo($_FILES["file_banner_mob"]["name"], PATHINFO_EXTENSION);
			$file_name_mob = $this->getdatetimeid().'m';
            $_POST['bannerfile_mob'] = $file_name_mob.$ext2;
            $_FILES["file_banner_mob"]["name"] = $_POST['bannerfile_mob'];

			$ext3 = '.'.pathinfo($_FILES["file_banner_app"]["name"], PATHINFO_EXTENSION);
			$file_name_app = $this->getdatetimeid().'a';
			$_POST['bannerfile_app'] = $file_name_app.$ext3;
			$_FILES["file_banner_app"]["name"] = $_POST['bannerfile_app'];


			$this->upload_image_to_s3('file_banner_web', $path, $file_name_web);
			$this->upload_image_to_s3('file_banner_mob', $path, $file_name_mob);
			$this->upload_image_to_s3('file_banner_app', $path, $file_name_app);

			$db_insert_result = $this->Curation_model_global->add_banner_item($_POST);
			echo $db_insert_result;
			$this->log('Global Banner Upload - '.$_POST['title'], 1, $_POST, 1);

            // echo json_encode( $config );
            // return 1;
            // $this->load->library('upload', $config);
            // $this->upload->overwrite = false;
            // if ($this->upload->do_upload('file_banner_web') && $this->upload->do_upload('file_banner_mob') && $this->upload->do_upload('file_banner_app')) {
            //     $db_insert_result = $this->Curation_model_global->add_banner_item($_POST);
            //     echo $db_insert_result;
            //     // echo "1";
            //     $this->log('Global Banner Upload - '.$_POST['title'], 1, $_POST, 1);
            // } else {
            //     $error = $this->upload->display_errors();
            //     echo json_encode( $error );
            //     $this->log('Global Banner Upload - '.$_POST['title'], 1, $_POST, 0);
            // }
        } else {
            echo 'file not found';
        }
    }

    public function change_banner_item_status() {
        if ($this->userinfo['permissions']->curation_update) {
			$id = $this->input->post('id',TRUE) ?: '';
			$colname = $this->input->post('colname',TRUE) ?: '';
			$status = $this->input->post('status',TRUE) ?: '';
            $response = $this->Curation_model_global->change_banner_item_status($id, $colname, $status);
            echo $response;
            $this->log('Global Banner Status - '.$_POST['id'].' to '.$_POST['status'], 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function delete_banner_item() {
        if ($this->userinfo['permissions']->curation_delete) {
            $response = $this->Curation_model_global->delete_banner_item($_POST['id']);
            echo $response;
            $this->log('Global Banner Delete - '.$_POST['id'], 0, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function update_banner_item() {
		// var_dump($_POST);
		// var_dump($_FILES);
		// return 1;
        if ($this->userinfo['permissions']->curation_update) {

			$path = "banner_th/global";
			// $backup_path = "/var/www/html/ebswap/replaced_banner_th/global/";

			$config['upload_path'] = $path;
			$config['allowed_types'] = 'jpg|png';
			$config['max_size'] = "1024";

			$this->load->library('upload', $config);
			$this->upload->overwrite = true;

			if ($_FILES["file_banner_web_edit"]["name"]) {
				$ext1 = '.'.pathinfo($_FILES["file_banner_web_edit"]["name"], PATHINFO_EXTENSION);
				$file_name = $this->getdatetimeid().'w';
				$_POST['bannerfile_web'] = $file_name.$ext1;
				$_FILES["file_banner_web_edit"]["name"] = $_POST['bannerfile_web'];
				// if ($this->upload->do_upload('file_banner_web_edit')) {
				// 	copy($path.$_POST['banner_oldimage_web'], $backup_path.$_POST['banner_oldimage_web']);
				// }
				$this->upload_image_to_s3('file_banner_web_edit', $path, $file_name);
			}

			if ($_FILES["file_banner_mob_edit"]["name"]) {
				$ext2 = '.'.pathinfo($_FILES["file_banner_mob_edit"]["name"], PATHINFO_EXTENSION);
				$file_name = $this->getdatetimeid().'m';
				$_POST['bannerfile_mob'] = $file_name.$ext2;
				$_FILES["file_banner_mob_edit"]["name"] = $_POST['bannerfile_mob'];
				// if ($this->upload->do_upload('file_banner_mob_edit')) {
				// 	copy($path.$_POST['banner_oldimage_mob'], $backup_path.$_POST['banner_oldimage_mob']);
				// }
				$this->upload_image_to_s3('file_banner_mob_edit', $path, $file_name);
			}

			if ($_FILES["file_banner_app_edit"]["name"]) {
				$ext3 = '.'.pathinfo($_FILES["file_banner_app_edit"]["name"], PATHINFO_EXTENSION);
				$file_name = $this->getdatetimeid().'a';
				$_POST['bannerfile_app'] = $file_name.$ext3;
				$_FILES["file_banner_app_edit"]["name"] = $_POST['bannerfile_app'];
				// if ($this->upload->do_upload('file_banner_app_edit')) {
				// 	copy($path.$_POST['banner_oldimage_app'], $backup_path.$_POST['banner_oldimage_app']);
				// }
				$this->upload_image_to_s3('file_banner_app_edit', $path, $file_name);
			}

            $response = $this->Curation_model_global->update_banner_item($_POST);
            echo $response;
            $this->log('Global Banner Update - '.$_POST['title'], 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function reorder_banner() {
        if ($this->userinfo['permissions']->curation_update) {
            $response = $this->Curation_model_global->update_sortorder_banner($_POST);
            echo $response;
            $this->log('Global Banner Reordered', 2, $_POST, $response);
        } else {
            echo 403;
        }
    }


    // PROMO SECTION

    public function get_promo_items() {
        if ($this->userinfo['permissions']->curation_update) {
            echo json_encode( $this->Curation_model_global->get_promo_items($_POST) );
        } else {
            echo 403;
        }
    }

    public function add_promo_item() {
        $path = "/var/www/html/ebswap/promo_th/global";
        if(isset($_FILES["file_promo"]["name"])) {
            if (file_exists($path.$_FILES["file_promo"]["name"])) {
                echo "duplicate";
                return 0;
            }
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = "1024";

            $t = microtime(true);
            $micro = sprintf("%06d",($t - floor($t)) * 1000000);
            $datetime = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
            $datetime = $datetime->format("ymdHisu");

            $ext1 = pathinfo($_FILES["file_promo"]["name"], PATHINFO_EXTENSION);
            $_POST['promofile'] = $datetime.'w.'.$ext1;
            $_FILES["file_promo"]["name"] = $_POST['promofile'];

            // echo json_encode( $config );
            // return 1;
            $this->load->library('upload', $config);
            $this->upload->overwrite = false;
            if ($this->upload->do_upload('file_promo')) {
                $db_insert_result = $this->Curation_model_global->add_promo_item($_POST);
                echo $db_insert_result;
                // echo "1";
                $this->log('Global Promo Upload - '.$_POST['title'], 1, $_POST, 1);
            } else {
                $error = $this->upload->display_errors();
                echo json_encode( $error );
                $this->log('Global Promo Upload - '.$_POST['title'], 1, $_POST, 0);
            }
        } else {
            echo 'file not found';
        }
    }

    public function change_promo_item_status() {
        if ($this->userinfo['permissions']->curation_update) {
            $response = $this->Curation_model_global->change_promo_item_status($_POST['id'], $_POST['status']);
            echo $response;
            $this->log('Global Promo Status - '.$_POST['id'].' to '.$_POST['status'], 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function delete_promo_item() {
        if ($this->userinfo['permissions']->curation_delete) {
            $response = $this->Curation_model_global->delete_promo_item($_POST['id']);
            echo $response;
            $this->log('Global Promo Delete - '.$_POST['id'], 0, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function update_promo_item() {
        if ($this->userinfo['permissions']->curation_update) {
            $response = $this->Curation_model_global->update_promo_item($_POST);
            echo $response;
            $this->log('Global Promo Update - '.$_POST['title'], 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function reorder_promo() {
        if ($this->userinfo['permissions']->curation_update) {
            $response = $this->Curation_model_global->update_sortorder_promo($_POST);
            echo $response;
            $this->log('Global Promo Reordered', 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

}
