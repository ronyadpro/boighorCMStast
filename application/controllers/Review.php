<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CMS_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('Review_model');
        $this->load->model('Book_model');
	}

	public function index() {
		echo "looking for Something? 😒";
	}

    // BOIGHOR GLOABL

	public function boighorglobal() {
        if ($this->userinfo['permissions']->feedback_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Review Approval & Reply - Boighor Global';
			$data['booklist'] = $this->Book_model->get_books_for_ddl();
			$data['content'] = $this->load->view('review/view_review_global', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
            $this->access_denied();
		}
	}

    public function getReviewList_global() {
        if ($this->userinfo['permissions']->feedback_view) {
            $post = $this->input->post(NULL, TRUE);
            $resp = $this->Review_model->getReviewList_global($post);
            echo json_encode($resp);
		} else {
			echo 403;
		}
    }

    public function change_approve_status() {
        if ($this->userinfo['permissions']->feedback_view) {
            $post = $this->input->post(NULL, TRUE);
            $post['approvedby'] = $this->userinfo['username'];
            $post['approvedtime'] = date('Y-m-d H:i:s');
            $resp = $this->Review_model->change_approve_status($post);
            echo json_encode($resp);
		} else {
			echo 403;
		}
    }

    public function delete_review() {
        if ($this->userinfo['permissions']->feedback_view) {
            $post = $this->input->post(NULL, TRUE);
            $post['deleted'] = 1;
            $post['deletedby'] = $this->userinfo['username'];
            $post['deletedtime'] = date('Y-m-d H:i:s');
            $resp = $this->Review_model->change_approve_status($post);
            echo json_encode($resp);
		} else {
			echo 403;
		}
    }

    public function create_review() {
        if ($this->userinfo['permissions']->feedback_view) {
            $post = $this->input->post(NULL, TRUE);
            $post['username'] = trim($this->input->post('username', TRUE));
            $post['reviewtext'] = trim($this->input->post('reviewtext', TRUE));
            $post['ebsentryby'] = $this->userinfo['username'];
            $post['ebsentrytime'] = date('Y-m-d H:i:s');
            $resp = $this->Review_model->insert_review($post);
            echo json_encode($resp);
		} else {
			echo 403;
		}
    }

    public function edit_review() {
        if ($this->userinfo['permissions']->feedback_update) {
            $post = $this->input->post(NULL, TRUE);
            $post['username'] = trim($this->input->post('username', TRUE));
            $post['reviewtext'] = trim($this->input->post('reviewtext', TRUE));
            $post['ebsentryby'] = $this->userinfo['username'];
            $post['ebsentrytime'] = date('Y-m-d H:i:s');
            $resp = $this->Review_model->edit_review($post);
            echo $resp;
		} else {
			echo 403;
		}
    }

    public function create_reply() {
        if ($this->userinfo['permissions']->feedback_view) {
            $post = $this->input->post(NULL, TRUE);
            $post['replytext'] = trim($this->input->post('replytext', TRUE));
            $post['reply_by'] = $this->userinfo['username'];
            $post['reply_time'] = date('Y-m-d H:i:s');
            $resp = $this->Review_model->insert_reply($post);
            echo $resp;
		} else {
			echo 403;
		}
    }

    public function change_reply_status() {
        if ($this->userinfo['permissions']->feedback_update) {
            $post['pkid'] = $this->input->post('pkid', TRUE);
            $reply_type = $this->input->post('reply_type', TRUE);
			if ($reply_type=='boighor') {
				$post['reply_status'] = $this->input->post('status', TRUE);
			} else {
				$post['author_reply_status'] = $this->input->post('status', TRUE);
			}
            $resp = $this->Review_model->insert_reply($post);
            echo $resp;
		} else {
			echo 403;
		}
    }


}
