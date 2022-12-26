<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_feedback_serverside($post) {
        $data['start'] = 0;//$post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $serchkey = $post['search']['value'];

        $this->db->select('*');
        $this->db->select('(SELECT email FROM boighor.tblBoiMelaSubscriptionDetails WHERE msisdn = boighor.tblFeedback.userid LIMIT 1) AS email');
        $this->db->order_by($order_col, $order_dir)->limit($post['length'], $post['start']);
        $data['data'] = $this->db->get('boighor.tblFeedback')->result();

        $data['recordsFiltered'] = $this->db->count_all_results('boighor.tblFeedback');
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function updte_feedback_status($post) {
        $this->db->set('status',$post['status']);
        $this->db->set('boighor_reply',$post['boighor_reply']);
        $this->db->set('status_marked_by',$post['username']);
        $this->db->set('status_mark_datetime',date('Y-m-d H:i:s'));
        return $this->db->limit(1)->where('pk_id',$post['pk_id'])->update('boighor.tblFeedback') ? 1 : 0;
    }

}
?>
