<?php
// require_once('vendor/autoload.php');
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CMS_Controller {

	function __construct() {
		parent::__construct();
        $this->load->helper('form');
        $this->load->library('Curl');
		$this->load->model('Book_model');
	}

	public function index() {
		$this->booklist();
	}

	public function overview_rnd($bookcode='eb002108') {
		if ($this->userinfo['permissions']->book_view) {
            $this->load->model('Author_model');
			$data = $this->Book_model->get_book_details($bookcode);
			$data['logs'] = $this->Main_model->get_log_timeline('', '2019-12-28', date('Y-m-d'), $this->userinfo['level'], $bookcode);
            $data['authorlist'] = $this->Author_model->get_authorlist();
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Book Overview';
			$data['content'] = $this->load->view('book/view_bookoverview_v2', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

	public function booklist($type='') {
		if ($this->userinfo['permissions']->book_view) {
            $data['categories'] = $this->Book_model->get_category_list();
            $data['genres'] = $this->Book_model->get_genre_list();
            $data['type'] = $type;
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Booklist';
			$data['content'] = $this->load->view('book/view_booklist', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

    public function getbooklist() {
        if ($this->userinfo['permissions']->book_view) {
            echo json_encode( $this->Book_model->get_booklist_serverside($_POST) );
        } else {
            echo 403;
        }
    }

	public function overview($bookcode='') {
		if ($this->userinfo['permissions']->book_view) {
            $this->load->model('Author_model');
			$data = $this->Book_model->get_book_details($bookcode);
			$data['logs'] = $this->Main_model->get_log_timeline('', '2019-12-28', date('Y-m-d'), $this->userinfo['level'], $bookcode);
            $data['authorlist'] = $this->Author_model->get_authorlist();
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Book Overview';
			$data['content'] = $this->load->view('book/view_bookoverview', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

    public function updateBookInfo() {
        if ($this->userinfo['permissions']->book_update) {
            $genrelist = isset($_POST['genre']) ? $_POST['genre'] : array();
            unset($_POST['genre']);
            $tags = isset($_POST['titleTags']) ? $_POST['titleTags'] : array();
            unset($_POST['titleTags']);
            $_POST['updatedby'] = $this->userinfo['username'];
            $response1 = $this->Book_model->update_book_info_by_bookcode($_POST);
            $response2 = $this->Book_model->update_genres_by_bookcode($_POST['bookcode'], $genrelist, $this->userinfo['username']);
            $response3 = $this->Book_model->update_tags_by_code($_POST['bookcode'], 0, $tags, $this->userinfo['username']);
            echo $response1.$response2.$response3;
            $this->log('edited book info - '.$_POST['bookcode'].' - '.$_POST['bookname'], 2, $_POST, $response1);
            $this->log('edited book genre - '.$_POST['bookcode'].' - '.$_POST['bookname'], 2, $genrelist, $response2);
            $this->log('edited title tags - '.$_POST['bookcode'].' - '.$_POST['bookname'], 2, $tags, $response3);
		} else {
			echo 403;
		}
    }

    public function updateTags($bookcode='') {
        if ($this->userinfo['permissions']->book_update) {
            $response = $this->Book_model->update_tags_by_code($bookcode, 0, $_POST, $this->userinfo['username']);
            echo $response;
            $this->log('edited title tags - '.$bookcode, 2, $_POST, $response);
		} else {
			echo 403;
		}
    }

	public function uploadFile($type, $bookcode, $oldfilename='') {
        $path = '';
		$ext = '.'.pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION);
        switch ($type) {
            case 'ebook':
                $file_extension = ".epub";
                // $path = '/var/www/html/ebswap/books/';
                $path = 'books';//'/var/www/html/ebswap/_oljkz/';
                break;
            case 'book_preview':
                $file_extension = ".epub";
                $path = 'books_preview';
                break;
            case 'cover':
                $file_extension = ".jpg";
                $path = 'book_th';
                break;
            case 'plain':
                $file_extension = ".jpg";
                $path = 'book_th_plain';
                break;
            case 'square':
                $file_extension = ".jpg";
                $path = 'book_th_square';
                break;
            case 'fb':
                $file_extension = ".png";
                $path = 'banner_fb';
                break;
            default:
                $file_extension = ".jpg";
                $path = 'bookpreview';
                break;
        }
        if(isset($_FILES["file_upload"]["name"])) {
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'png|jpg|jpeg|epub';
            if ($type == "ebook" || $type == "book_preview") {
                $config['max_size'] = "30720";
            } else {
                $config['max_size'] = "512";
            }
            // $config['max_size'] = ($type == "ebook" ? "25600" : "512");
            if ($type == 'ebook') {
				$config['file_name'] = $bookcode.$this->RandomString(12);
            } elseif ($type == 'book_preview' || $type == 'cover' || $type == 'plain' || $type == 'square' || $type == 'fb') {
                $config['file_name'] = $bookcode;
			} else {
                $config['file_name'] = $bookcode."-".$type;
            }

			$resp = $this->upload_image_to_s3('file_upload', $path, $config['file_name']);
			echo $resp;
			$resp = $this->Book_model->update_fileInfo_by_bookCode($bookcode, $type, $config['file_name'].$ext);
			// $this->load->library('upload', $config);
			// $this->upload->overwrite = true;
			// if ($this->upload->do_upload('file_upload')) {
			// 	$resp = $this->Book_model->update_fileInfo_by_bookCode($bookcode, $type, $this->upload->data()['file_name']);
			// 	echo $resp ? 1 : 0 ;
            //     $this->log('uploaded '.$type.' - '.$bookcode, 2, $this->upload->data()['file_name'], $resp);
	        // } else {
			// 	$error = $this->upload->display_errors();
            //     echo json_encode( $error );
	        // }
		} else {
            echo 0;
        }
	}

	public function addnew() {
        if ($this->userinfo['permissions']->book_create) {
			$data = $this->Book_model->get_info_new_book();
			$data['userinfo'] = $this->userinfo;
			// $data['priceList'] = $this->Book_model->get_price_list_for('banglalink');
			$data['title'] = 'New Book';
			$data['content'] = $this->load->view('book/view_addnewbook', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

	public function addnewscope() {
        if ($this->userinfo['permissions']->book_create) {
			$data = $this->Book_model->get_info_new_book();
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'New Book Scope';
			$data['content'] = $this->load->view('book/view_addnewbook_scope', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

	public function addnewaudiobook() {
        if ($this->userinfo['permissions']->book_create) {
			$data = $this->Book_model->get_info_new_book();
			$data['userinfo'] = $this->userinfo;
			// $data['priceList'] = $this->Book_model->get_price_list_for('banglalink');
			$data['title'] = 'New Book';
			$data['content'] = $this->load->view('book/view_addnewbook', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

    public function addNewBookInfo() {
        if ($this->userinfo['permissions']->book_create) {
            // $isexists =  $this->Book_model->check_duplicate($_POST['bookcode']);
            // if ($isexists) {
            //     echo 2;
            // } else {
                $request = $_POST;
                $genrelist['add'] = $_POST['genre'];
                unset($_POST['genre']);
                $res1 = $this->Book_model->add_new_book($_POST, $this->userinfo['username']);
				if ($res1) {
					$bookcode = $res1;
					$msg = 'added new book - '.$bookcode.' - '.$_POST['bookname'];
	                $res2 = $this->Book_model->update_genres_by_bookcode($bookcode, $genrelist, $this->userinfo['username']);
					if ($res2) {
						echo $bookcode;
						$res = 1;
						$log_msg = $msg;
					} else {
						echo 0;
						$res = 0;
						$log_msg = $msg.' - genre insert failed';
					}
				} else {
					echo 0;
					$res = 0;
					$log_msg = $msg.' - book insert failed';
				}
                $this->log($msg, 1, $request, $res);
				log_message('error',$log_msg);
            // }
        } else {
            echo 403;
        }
    }

    public function addNewBookScope() {
        if ($this->userinfo['permissions']->book_create) {
            $request = $_POST;
            $res1 = $this->Book_model->add_new_book_scope($_POST, $this->userinfo['username']);
            echo $res1;
            $msg = 'added new book scope - '.$_POST['bookname'];
            $this->log($msg, 1, $request, $res1);
        } else {
            echo 403;
        }
    }

    public function get_book_scopes() {
        if ($this->userinfo['permissions']->book_view) {
            $res1 = $this->Book_model->get_book_scopes($_POST);
            echo json_encode($res1);
        } else {
            echo 403;
        }
    }



    public function changeStatus($bookcode) {
        if ($this->userinfo['permissions']->book_update) {
            $resp = $this->Book_model->change_book_status_by_bookcode($bookcode, $_POST['platform'], $_POST['status']);
            echo $resp ? 1 : 0;
            $_POST['bookcode'] = $bookcode;
            $msg = 'changed '.$_POST['platform'].' To '.$_POST['status'].' - '.$bookcode;
            $this->log($msg, 2, $_POST, $resp);
        } else {
            echo 403;
        }
    }

    public function changeStatus_bulk() {
        if ($this->userinfo['permissions']->book_update) {
            $statuses = $_POST['statuses'];
            $resp = $this->Book_model->change_book_status_for_all_platform($statuses);
            echo $resp ? 1 : 0;
            $msg = 'changed statuses - '.$statuses['bookcode'];
            $this->log($msg, 2, $_POST, $resp);
        } else {
            echo 403;
        }
    }

    public function checkBookLiveValidity($bookcode) {
        echo json_encode( $this->Book_model->check_live_validity($bookcode) );
    }

    public function updatePricing($bookcode) {
        if ($this->userinfo['permissions']->book_update) {
            $_POST['bookcode'] = $bookcode;
            $response = $this->Book_model->update_pricing_by_bookcode($_POST);
            echo $response;
            $this->log('updated pricing - '.$bookcode, 2, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function category() {
        if ($this->userinfo['permissions']->category_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Category';
			$data['content'] = $this->load->view('book/view_category', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
    }

    public function getcategories() {
        if ($this->userinfo['permissions']->category_view) {
            echo json_encode( $this->Book_model->get_categories_serverside($_POST) );
        } else {
            echo 403;
        }
    }

    public function getCategoryTags($catcode) {
        if ($this->userinfo['permissions']->category_view) {
        echo json_encode( $this->Book_model->get_category_tags_by_code($catcode) );
	    } else {
	        echo 403;
	    }
    }

    public function genre() {
        if ($this->userinfo['permissions']->genre_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Genre';
			$data['content'] = $this->load->view('book/view_genre', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
    }

    public function getgenres() {
        if ($this->userinfo['permissions']->genre_view) {
        echo json_encode( $this->Book_model->get_genres_serverside($_POST) );
	    } else {
	        echo 403;
	    }
    }

    public function getGenreTags($genre_code) {
        if ($this->userinfo['permissions']->genre_view) {
        echo json_encode( $this->Book_model->get_genres_tags_by_code($genre_code) );
	    } else {
	        echo 403;
	    }
    }

    public function addNewGenre() {
        if ($this->userinfo['permissions']->genre_create) {
            $_POST['createdby'] = $this->userinfo['username'];
            $response = $this->Book_model->add_new_genre($_POST);
            echo $response;
            $this->log('added new genre - '.$_POST['genre_code'].' - '.$_POST['genre_en'], 1, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function editGenre() {
        if ($this->userinfo['permissions']->genre_update) {
            $tags = isset($_POST['tags']) ? $_POST['tags'] : array();
            unset($_POST['tags']);
            $_POST['updatedby'] = $this->userinfo['username'];

            $response = $this->Book_model->edit_genre($_POST);
            echo $response;
            $this->log('edited genre - '.$_POST['genre_code'], 2, $_POST, $response);

            $response = $this->Book_model->update_tags_by_code($_POST['genre_code'], 3, $tags, $this->userinfo['username']);
            echo $response;
            $this->log('edited genre tags - '.$_POST['genre_code'], 2, $tags, $response);
        } else {
            echo 403;
        }
    }

	public function change_show_in_home_status() {
		$post['genre_code'] = $this->input->post('genre_code', TRUE);
		$post['show_in_home'] = $this->input->post('status', TRUE);
		$response = $this->Book_model->edit_genre($post);
		echo $response;
		$this->log('edited genre show_in_home - '.$_POST['genre_code'], 2, $_POST, $response);
	}

	public function get_genre_sorted_list() {
		$response = $this->Book_model->get_genre_sorted_list();
		echo json_encode($response);
	}

	public function save_genre_sortorder() {
		if ($this->userinfo['permissions']->genre_update) {
			$genrecodes = $this->input->post('genrecodes', TRUE);
			$response = $this->Book_model->save_genre_sortorder($genrecodes);
			echo $response;
			$this->log('Genre Sorted ', 2, $_POST, $response);
		} else {
			echo 403;
		}
	}

    public function addNewCategory() {
        if ($this->userinfo['permissions']->category_create) {
            $_POST['createdby'] = $this->userinfo['username'];
            $response = $this->Book_model->add_new_category($_POST);
            echo $response;
            $this->log('added new category - '.$_POST['catcode'].' - '.$_POST['catname_en'], 1, $_POST, $response);
        } else {
            echo 403;
        }
    }

    public function editCategory() {
        if ($this->userinfo['permissions']->category_update) {
            $tags = isset($_POST['tags']) ? $_POST['tags'] : array();
            unset($_POST['tags']);
            $_POST['updatedby'] = $this->userinfo['username'];

            $response = $this->Book_model->edit_category($_POST);
            echo $response;
            $this->log('edited category - '.$_POST['catcode'], 2, $_POST, $response);

            $response = $this->Book_model->update_tags_by_code($_POST['catcode'], 2, $tags, $this->userinfo['username']);
            echo $response;
            $this->log('edited category tags - '.$_POST['catcode'], 2, $tags, $response);
        } else {
            echo 403;
        }
    }

    public function api_all_books() {
        $this->load->model('Api_model');
        echo json_encode( $this->Api_model->get_all_book_api($this->input->post()) );
    }

    public function uploadGenreImage($genrecode='') {
        if ($this->userinfo['permissions']->genre_update) {
            $path = "book_genre_th";
            if(isset($_FILES["file_upload"]["name"])) {
                // if (file_exists($path.$genrecode.".jpg")) {
                //     $backup_path = "/var/www/html/ebswap/replaced_genre_th/";
                //     copy($path.$genrecode.".jpg", $backup_path.explode(".",$genrecode)[0]."__".date('Y-m-d_H:i:s')."__".$this->userinfo['username'].".jpg");
                // }
                // $config['upload_path'] = $path;
                // $config['allowed_types'] = 'jpg';
                // $config['max_size'] = "50";
                // $config['file_name'] = $genrecode;

				$resp = $this->upload_image_to_s3('file_upload', $path, $genrecode);
				echo $resp;
				$this->Book_model->edit_genre(array('genre_code'=>$genrecode, 'genre_th'=>1));
				$this->log('uploaded genre image - '.$genrecode, 2, $genrecode, $resp);

                // $this->load->library('upload', $config);
                // $this->upload->overwrite = true;
                // if ($this->upload->do_upload('file_upload')) {
                //     echo 1;
                //     $this->log('Uploaded Genre Image - '.$genrecode, 2, $this->upload->data()['file_name'], 1);
                // } else {
                //     $error = $this->upload->display_errors();
                //     echo json_encode( $error );
                //     $this->log('Uploaded Genre Image - '.$genrecode, 2, $this->upload->data()['file_name'], 0);
                // }
            } else {
                echo 0;
            }
        } else {
            echo 403;
        }
    }

    public function uploadAudiobook($bookcode='', $filename='', $filename_bn='') {
		// return;
        if ($this->userinfo['permissions']->book_create) {
            $path = "https://boighor-audio-input.s3.ap-southeast-1.amazonaws.com/media/audiobook/";
            // $path = "/usr/share/ac/boighoraudiobook/";
            // $path_preview = "/usr/share/ac/boighoraudiobookpreview/";
            if ($_POST['type']=='main') {
                unset($_POST['type']);
                if(isset($_FILES["file_audio"]["name"])) {
                    $ext = pathinfo($_FILES["file_audio"]["name"], PATHINFO_EXTENSION);
                    $config['upload_path'] = $path;
                    $config['allowed_types'] = 'mp3';
                    $config['max_size'] = "51200";  //50MB
					$filename = $this->getdatetimeid();
                    $_FILES["file_audio"]["name"] = $filename.'.'.$ext;

                    $_POST['bookaudiocode'] = $_FILES["file_audio"]["name"];
                    $_POST['filesize'] = $_FILES["file_audio"]["size"]/1024/1024;
                    $_POST['filesize'] = number_format($_POST['filesize'], 2, '.', '').' MB';
                    $_POST['addedby'] = $this->userinfo['username'];

                    // $this->load->library('upload', $config);
                    // $this->upload->overwrite = false;
					$resp = $this->upload_image_to_s3('file_audio', 'adb', $filename);
                    if ($resp) {
						// $file_info = $this->get_adb_file_info($filename.'.mp3');
						// {"time":1664085629,"hash":"75394a47c43c9075524db77f3ca75fd1","type":"audio\/mpeg","size":420888}
						// echo json_encode($file_info);
                        $filepath = $path.$filename.'.'.$ext;
                        // $filepath = 'https://d1b3dh5v0ocdqe.cloudfront.net/media/audiobook/'.$filename.'.m3u8';
                        $mp3file = new MP3File($filepath);
                        $_POST['filelength'] = MP3File::formatTime($mp3file->getDuration());
						// echo $_POST['filelength'];
						//
                        $db_insert_result = $this->Book_model->add_audiobook($_POST);
                        echo $db_insert_result;
                        $this->log('Audiobook Upload - '.$bookcode, 1, $filename.'.'.$ext, 1);
                    } else {
                        // $error = $this->upload->display_errors();
                        // echo json_encode( $error );
						echo 0;
                        $this->log('Audiobook Upload - '.$bookcode, 1, $filename.'.'.$ext, 0);
                    }
                } else {
                    echo 'file not found';
                }
            } else if ($_POST['type']=='preview') {
                if (isset($_FILES["file_audio_preview"]["name"])) {
                    $ext = pathinfo($_FILES["file_audio_preview"]["name"], PATHINFO_EXTENSION);
                    $config_preview['upload_path'] = $path;
                    $config_preview['allowed_types'] = 'mp3';
                    $config_preview['max_size'] = "5120";   //5MB
                    // $_FILES["file_audio_preview"]["name"] = $_POST['bookcode'].'-preview.'.$ext;
					$filename = $_POST['bookcode'].'-preview';
                    $_FILES["file_audio_preview"]["name"] = $filename.'.'.$ext;

                    // $this->load->library('upload', $config_preview);
                    // $this->upload->overwrite = true;
					$resp = $this->upload_image_to_s3('file_audio_preview', 'adb', $filename);
                    if ($resp) {
                        $db_insert_result = $this->Book_model->add_audiobook_preview($bookcode);
                        echo $db_insert_result;
                        $this->log('Audiobook Preview Upload - '.$bookcode, 1, $filename.'.'.$ext, 1);
                    } else {
                        // $error = $this->upload->display_errors();
                        // echo json_encode( $error );
						echo 0;
                        $this->log('Audiobook Preview Upload - '.$bookcode, 1, $filename.'.'.$ext, 0);
                    }
                } else {
                    echo 'file not found';
                }
            } else {
                echo "type param incorrect from hidden <input>";
            }
        } else {
            echo 403;
        }
    }

    public function change_adb_status() {
        if ($this->userinfo['permissions']->book_update) {
            echo $this->Book_model->change_adb_status($_POST['id'], $_POST['status']);
        } else {
            echo 403;
        }
    }

    public function reader($bookcode='', $filename='', $type='') {
        if ($this->userinfo['permissions']->book_view) {
            $data['userinfo'] = $this->userinfo;
            $data['title'] = 'Genre';

            $data['bookcode'] =  $bookcode;
	        $data['filename'] =  $filename;
	        $data['type'] =  $type;
            $data['content'] = $this->load->view('book/view_reader', $data, TRUE);
            $this->load->view('view_layout', $data);

        } else {
            $this->access_denied();
        }
    }

    public function update_audiobook() {
        if ($this->userinfo['permissions']->book_update) {
            if(isset($_FILES["file_audio"]["name"]) && $_FILES["file_audio"]["name"]) {
                $path = "https://boighor-audio-input.s3.ap-southeast-1.amazonaws.com/media/audiobook/";

                // $backup_path = "/usr/share/ac/replaced_boighoraudiobook/";
                // copy($path.$_POST['bookaudiocode'], $backup_path.explode(".",$_POST['bookaudiocode'])[0]."__".date('Y-m-d_H:i:s')."__".$this->userinfo['username'].".".explode(".",$_POST['bookaudiocode'])[1]);
				$resp = $this->delete_adb_file($_POST['bookaudiocode']);

                $ext = pathinfo($_FILES["file_audio"]["name"], PATHINFO_EXTENSION);
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'mp3';
                $config['max_size'] = "51200";  //50MB
                $_FILES["file_audio"]["name"] = $_POST['bookaudiocode'];
				// $filename = explode('.',$_POST['bookaudiocode'])[0];
				$filename = $this->getdatetimeid();
				$_FILES["file_audio"]["name"] = $filename.'.'.$ext;

                $_POST['filesize'] = $_FILES["file_audio"]["size"]/1024/1024;
                $_POST['filesize'] = number_format($_POST['filesize'], 2, '.', '').' MB';
                $_POST['addedby'] = $this->userinfo['username'];

                // $this->load->library('upload', $config);
                // $this->upload->overwrite = true;
				$resp = $this->upload_image_to_s3('file_audio', 'adb', $filename);
                if ($resp) {
                    $_POST['bookaudiocode'] = $filename.'.'.$ext;
                    $filepath = $path.$filename.'.'.$ext;
        			$mp3file = new MP3File($filepath);
                    $_POST['filelength'] = MP3File::formatTime($mp3file->getDuration());
                } else {
                    // $error = $this->upload->display_errors();
                    // echo json_encode( $error );
					echo 0;
                    $this->log('Audiobook Edit - '.$_POST['bookaudiocode'], 1, $this->upload->data()['file_name'], 0);
                }
            }
            // echo json_encode($_POST);
            $db_insert_result = $this->Book_model->edit_audiobook_preview($_POST);
            echo $db_insert_result;
            $this->log('Audiobook Edit - '.$_POST['bookaudiocode'], 1, $_POST, $db_insert_result);
        } else {
            echo 403;
        }
    }

	public function pricing() {
        if ($this->userinfo['permissions']->pricing_view) {
            $this->load->model('Price_model');
            $data['prices'] = $this->Price_model->get_price_list();
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Pricing';
			$data['content'] = $this->load->view('view_pricelist', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

	public function edit_pricing_bdt() {
        if ($this->userinfo['permissions']->pricing_update) {
            $this->load->model('Price_model');
            $post = $this->input->post(NULL, TRUE);
            $post['id']=$post['pkid'];
            unset($post['pkid']);
            // echo json_encode($post);
            $resp = $this->Price_model->edit_pricing_bdt($post);
            echo $resp;
		} else {
			echo 403;
		}
	}

	public function edit_pricing_usd() {
        if ($this->userinfo['permissions']->pricing_update) {
            $this->load->model('Price_model');
            $post = $this->input->post(NULL, TRUE);
            $post['id']=$post['pkid'];
            unset($post['pkid']);
            // echo json_encode($post);
            $resp = $this->Price_model->edit_pricing_usd($post);
            echo $resp;
		} else {
			echo 403;
		}
	}

	public function add_pricing_bdt() {
        if ($this->userinfo['permissions']->pricing_create) {
            $this->load->model('Price_model');
            $post = $this->input->post(NULL, TRUE);
            $resp = $this->Price_model->add_pricing_bdt($post);
            echo $resp;
		} else {
			echo 403;
		}
	}

	public function add_pricing_usd() {
        if ($this->userinfo['permissions']->pricing_create) {
            $this->load->model('Price_model');
            $post = $this->input->post(NULL, TRUE);
            $resp = $this->Price_model->add_pricing_usd($post);
            echo $resp;
		} else {
			echo 403;
		}
	}

	public function s3_upload() {
		$this->load->view('s3_upload');
	}

//====================================================================================

    private function RandomString($length=0) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring .= $characters[rand(0, strlen($characters)-1)];
        }
        return $randstring;
    }

}
