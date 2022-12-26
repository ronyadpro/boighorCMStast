<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function getReviewList_global($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $serchkey = $post['search']['value'];
        $this->db->select('*, (SELECT bookname FROM boighor.tblBooks WHERE boighor.tblBooks.bookcode = boighor.tblReview.bookcode LIMIT 1) AS bookname');
        // $this->db->group_start()->or_like('bookname',$serchkey)->or_like('username',$serchkey)->or_like('reviewtext',$serchkey)->group_end();
        $data['data'] = $this->db->order_by($order_col, $order_dir)->limit($post['length'], $post['start'])->get_where('boighor.tblReview',array('deleted'=>0))->result();
        $data['recordsFiltered'] = $this->db->where('deleted', '0')->count_all_results('boighor.tblReview');
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function change_approve_status($post) {
        $this->db->limit(1)->where('pkid',$post['pkid'])->update('boighor.tblReview',$post);
        return $this->db->affected_rows();
    }

    public function insert_review($post) {
        $this->db->insert('boighor.tblReview',$post);
        return $this->db->affected_rows();
    }

    public function insert_reply($post) {
        return $this->db->limit(1)->where('pkid',$post['pkid'])->update('boighor.tblReview', $post);
    }

    public function edit_review($post) {
        return $this->db->limit(1)->where('pkid',$post['pkid'])->where('fromebs',1)->update('boighor.tblReview', $post);
    }
}
?>
