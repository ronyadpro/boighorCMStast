<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ugc_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_ugclist_global($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];

        $serchkey = $post['search']['value'];
        if ($serchkey) {
            $this->db->group_start()->or_like('userid',$serchkey)->or_like('email',$serchkey)->or_like('username',$serchkey)->or_like('mobileno',$serchkey)->or_like('title',$serchkey)->group_end();
        }

        $data['data'] = $this->db->order_by($order_col, $order_dir)->limit($post['length'], $post['start'])->get('boighor.tblUGC')->result();
        $data['recordsFiltered'] = $this->db->count_all_results('boighor.tblUGC');
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function get_ugc_details($ugcid) {
        $data = $this->db->limit(1)->get_where('boighor.tblUGC',array('ugcid'=>$ugcid))->row_array();
        return $data;
    }

    public function change_ugc_status($ugcid, $isapproved) {
        return $this->db->limit(1)->where('ugcid', $ugcid)->set('isapproved', $isapproved)->update('boighor.tblUGC');
    }

}
?>
