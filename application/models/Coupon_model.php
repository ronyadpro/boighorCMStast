<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coupon_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_coupons_old($post) {

            $data['start'] = $post['start'];
            $data['draw'] = $post['draw'];
            $order_col = $post['columns'][$post['order'][0]['column']]['data'];
            $order_dir = $post['order'][0]['dir'];

            $serchkey = $post['search']['value'];
            if ($serchkey) {
                $this->db->group_start()->or_like('promocode',$serchkey)->or_like('promotitle',$serchkey)->group_end();
            }

            $data['data'] = $this->db->order_by($order_col, $order_dir)->limit($post['length'], $post['start'])->get('boighor.tblPromoCode')->result();
            $data['recordsFiltered'] = $this->db->count_all_results('boighor.tblPromoCode');
            $data['recordsTotal'] = $data['recordsFiltered'];
            return $data;

    }


    public function get_coupons($post) {


            $data['start'] = $post['start'];
            $data['draw'] = $post['draw'];
            $order_col = $post['columns'][$post['order'][0]['column']]['data'];
            $order_dir = $post['order'][0]['dir'];

            $serchkey = $post['search']['value'];
            if ($serchkey) {
                $this->db->group_start()->or_like('promo_code',$serchkey)->or_like('promo_title',$serchkey)->group_end();
            }

            $data['data'] = $this->db->order_by($order_col, $order_dir)->where('status',1)->limit($post['length'], $post['start'])->get('boighor.tblPromoCode_new')->result();
            $data['recordsFiltered'] = $this->db->count_all_results('boighor.tblPromoCode_new');
            $data['recordsTotal'] = $data['recordsFiltered'];
            return $data;

    }

    public function change_status($couponid, $status) {
        if ($status == 1) {
            $response = $this->db->where('pkid',$couponid)->set('status',$status)->set('isdeleted',0)->limit(1)->update('boighor.tblPromoCode');
            return $response ? 1 : 0;
        }else {
            $response = $this->db->where('pkid',$couponid)->set('status',$status)->set('isdeleted',1)->limit(1)->update('boighor.tblPromoCode');
            return $response ? 1 : 0;
        }

    }

    public function change_delete_status($couponid)
    {
        $response = $this->db->where('pkid',$couponid)->set('status',0)->set('isdeleted',1)->limit(1)->update('boighor.tblPromoCode');
        return $response ? 1 : 0;
    }

    public function create_coupon($param) {
        $this->db->insert('boighor.tblPromoCode',$param);
        return $this->db->affected_rows();
    }


}
?>
