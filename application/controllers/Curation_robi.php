<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class curation_robi extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Curation_model_robi');
	}

	public function index() {
		echo "looking for Something? 😒";
	}

    public function getHomeData() {
        if ($this->userinfo['permissions']->curation_view) {
            echo json_encode( $this->Curation_model_robi->get_homedata_serverside($_POST) );
        } else {
            $this->access_denied();
        }
    }

    public function getHomeData_archived() {
        if ($this->userinfo['permissions']->curation_view) {
            echo json_encode( $this->Curation_model_robi->get_homedata_archived($_POST) );
        } else {
            echo 403;
        }
    }

    public function reorderhomedata() {
        if ($this->userinfo['permissions']->curation_update) {
            $response = $this->Curation_model_robi->update_sortorder_home($_POST);
            echo $response;
            $this->log('reordered home', 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function changeStatus() {
        if ($this->userinfo['permissions']->curation_update) {
            $resp = $this->Curation_model_robi->update_status_by_platform($_POST);
            $this->log('changed home section "'.$_POST['catcode'].'" status for '.($_POST['platform']=='showitem'?'app':'web').' to '.($_POST['status']?'live':'offline').' - ', 2, $_POST, $resp);
            echo $resp;
        } else {
            echo 403;
        }
    }

    public function archiveItem() {
        if ($this->userinfo['permissions']->curation_update) {
            $resp = $this->Curation_model_robi->archive_item($_POST['catcode']);
            $this->log('archived home item - '.$_POST['catcode'], 2, $_POST, $resp);
            echo $resp;
        } else {
            echo 403;
        }
    }

    public function unarchiveItem() {
        if ($this->userinfo['permissions']->curation_update) {
            $resp = $this->Curation_model_robi->unarchive_item($_POST['catcode']);
            $this->log('unarchived home item - '.$_POST['catcode'], 2, $_POST, $resp);
            echo $resp;
        } else {
            echo 403;
        }
    }

    public function getBooklist($value='') {
        if ($this->userinfo['permissions']->curation_view) {
            echo json_encode( $this->Curation_model_robi->get_booklist_serverside($_POST) );
        } else {
            echo 403;
        }
    }

    public function createSection($value='') {
        if ($this->userinfo['permissions']->curation_create) {
            echo $this->Curation_model_robi->create_new_section($_POST);
        } else {
            echo 403;
        }
    }

    public function getSectionItems($value='') {
        if ($this->userinfo['permissions']->curation_view) {
            echo json_encode( $this->Curation_model_robi->get_section_items_by_catcode($_POST['catcode']) );
        } else {
            echo 403;
        }
    }

    public function updateSectionSortorder($value='') {
        if ($this->userinfo['permissions']->curation_update) {
            echo json_encode( $this->Curation_model_robi->update_section_items_sortorder($_POST) );
        } else {
            echo 403;
        }
    }

    public function removeSectionItem($value='') {
        if ($this->userinfo['permissions']->curation_delete) {
            echo json_encode( $this->Curation_model_robi->remove_section_item($_POST) );
        } else {
            echo 403;
        }
    }

    public function addSectionItem($value='') {
        if ($this->userinfo['permissions']->curation_create) {
            echo json_encode( $this->Curation_model_robi->add_section_item($_POST) );
        } else {
            echo 403;
        }
    }

    public function editSectionInfo($value='') {
        if ($this->userinfo['permissions']->curation_update) {
            echo json_encode( $this->Curation_model_robi->update_section_info($_POST) );
        } else {
            echo 403;
        }
    }

    public function banner() {
        if ($this->userinfo['permissions']->banner_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Banner-Curation Robi';
            $data['content'] = $this->load->view('curation/view_cur_banner_robi', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
            $this->access_denied();
		}
    }

    public function get_banner_items() {
        if ($this->userinfo['permissions']->banner_view) {
            echo json_encode( $this->Curation_model_robi->get_banner_items($_POST) );
        } else {
            echo 403;
        }
    }

    public function add_banner_item() {
        $path = "/var/www/html/ebswap/banner_th/robi";
        if(isset($_FILES["file_banner_web"]["name"]) && isset($_FILES["file_banner_mob"]["name"])) {
            if (file_exists($path.$_FILES["file_banner_web"]["name"]) || file_exists($path.$_FILES["file_banner_web"]["name"])) {
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

            $ext1 = pathinfo($_FILES["file_banner_web"]["name"], PATHINFO_EXTENSION);
            $_POST['bannerfile_web'] = $datetime.'w.'.$ext1;
            $_FILES["file_banner_web"]["name"] = $_POST['bannerfile_web'];

            $t = microtime(true);
            $micro = sprintf("%06d",($t - floor($t)) * 1000000);
            $datetime = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
            $datetime = $datetime->format("ymdHisu");

            $ext2 = pathinfo($_FILES["file_banner_mob"]["name"], PATHINFO_EXTENSION);
            $_POST['bannerfile_mob'] = $datetime.'a.'.$ext2;
            $_FILES["file_banner_mob"]["name"] = $_POST['bannerfile_mob'];

            // echo json_encode( $config );
            // return 1;
            $this->load->library('upload', $config);
            $this->upload->overwrite = false;
            if ($this->upload->do_upload('file_banner_web') && $this->upload->do_upload('file_banner_mob')) {
                $db_insert_result = $this->Curation_model_robi->add_banner_item($_POST);
                echo $db_insert_result;
                // echo "1";
                $this->log('Robi Banner Upload - '.$_POST['title'], 1, $_POST, 1);
            } else {
                $error = $this->upload->display_errors();
                echo json_encode( $error );
                $this->log('Robi Banner Upload - '.$_POST['title'], 1, $_POST, 0);
            }
        } else {
            echo 'file not found';
        }
    }

    public function change_banner_item_status() {
        if ($this->userinfo['permissions']->banner_update) {
            $response = $this->Curation_model_robi->change_banner_item_status($_POST['id'], $_POST['status']);
            echo $response;
            $this->log('Robi Banner Status - '.$_POST['id'].' to '.$_POST['status'], 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function delete_banner_item() {
        if ($this->userinfo['permissions']->banner_delete) {
            $response = $this->Curation_model_robi->delete_banner_item($_POST['id']);
            echo $response;
            $this->log('Robi Banner Delete - '.$_POST['id'], 0, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function update_banner_item() {
        if ($this->userinfo['permissions']->banner_update) {
            $response = $this->Curation_model_robi->update_banner_item($_POST);
            echo $response;
            $this->log('Robi Banner Update - '.$_POST['title'], 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function reorder_banner() {
        if ($this->userinfo['permissions']->banner_update) {
            $response = $this->Curation_model_robi->update_sortorder_banner($_POST);
            echo $response;
            $this->log('Robi Banner Reordered', 2, $_POST, $response);
        } else {
            echo 403;
        }
    }


    // PROMO SECTION

    public function get_promo_items() {
        if ($this->userinfo['permissions']->banner_view) {
            echo json_encode( $this->Curation_model_robi->get_promo_items($_POST) );
        } else {
            echo 403;
        }
    }

    public function add_promo_item() {
        $path = "/var/www/html/ebswap/promo_th/robi";
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
                $db_insert_result = $this->Curation_model_robi->add_promo_item($_POST);
                echo $db_insert_result;
                // echo "1";
                $this->log('Robi Promo Upload - '.$_POST['title'], 1, $_POST, 1);
            } else {
                $error = $this->upload->display_errors();
                echo json_encode( $error );
                $this->log('Robi Promo Upload - '.$_POST['title'], 1, $_POST, 0);
            }
        } else {
            echo 'file not found';
        }
    }

    public function change_promo_item_status() {
        if ($this->userinfo['permissions']->banner_update) {
            $response = $this->Curation_model_robi->change_promo_item_status($_POST['id'], $_POST['status']);
            echo $response;
            $this->log('Robi Promo Status - '.$_POST['id'].' to '.$_POST['status'], 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function delete_promo_item() {
        if ($this->userinfo['permissions']->banner_delete) {
            $response = $this->Curation_model_robi->delete_promo_item($_POST['id']);
            echo $response;
            $this->log('Robi Promo Delete - '.$_POST['id'], 0, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function update_promo_item() {
        if ($this->userinfo['permissions']->banner_update) {
            $response = $this->Curation_model_robi->update_promo_item($_POST);
            echo $response;
            $this->log('Robi Promo Update - '.$_POST['title'], 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function reorder_promo() {
        if ($this->userinfo['permissions']->banner_update) {
            $response = $this->Curation_model_robi->update_sortorder_promo($_POST);
            echo $response;
            $this->log('Robi Promo Reordered', 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

}
