<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_notification_images($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];

        $serchkey = $post['search']['value'];
        if ($serchkey) {
            $this->db->like('filename',$serchkey);
        }

        $data['data'] = $this->db->order_by($order_col, $order_dir)->limit($post['length'], $post['start'])->get('tbl_image_notification')->result();
        $data['recordsFiltered'] = $this->db->count_all_results('tbl_image_notification');
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function insert_notification_image($data) {
        $resp = $this->db->limit(1)->insert('tbl_image_notification',$data);
        return $resp;
    }


    public function get_inapp_images($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];

        $serchkey = $post['search']['value'];
        if ($serchkey) {
            $this->db->like('filename',$serchkey);
        }

        $data['data'] = $this->db->order_by($order_col, $order_dir)->limit($post['length'], $post['start'])->get('tbl_image_inapp')->result();
        $data['recordsFiltered'] = $this->db->count_all_results('tbl_image_inapp');
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function insert_inapp_image($data) {
        $resp = $this->db->limit(1)->insert('tbl_image_inapp',$data);
        return $resp;
    }

}
?>
