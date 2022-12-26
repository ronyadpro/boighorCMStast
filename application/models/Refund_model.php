<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Refund_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_refund_serverside($post) {
        $data['start'] = 0;//$post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $serchkey = $post['search']['value'];

        $this->db->select('*');
        //$this->db->select('(SELECT email FROM boighor.tblBoiMelaSubscriptionDetails WHERE msisdn = boighor.tblFeedback.userid LIMIT 1) AS email');
        $this->db->order_by($order_col, $order_dir)->limit($post['length'], $post['start']);
        $data['data'] = $this->db->get('boighor.tblRefundRequest')->result();

        $data['recordsFiltered'] = $this->db->count_all_results('boighor.tblRefundRequest');
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function update_refund_request_status($post) {
        $this->db->set('status',$post['status']);
        $this->db->set('status_updated_by',$post['username']);
        $this->db->set('status_updated_datetime',date('Y-m-d H:i:s'));
        return $this->db->limit(1)->where('pk_id',$post['pk_id'])->update('boighor.tblRefundRequest') ? 1 : 0;
    }

}
?>
