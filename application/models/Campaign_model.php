<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_campaign_report($post) {
        $data['start'] = 0;//$post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $serchkey = $post['search']['value'];

        $this->db->select('*');
        $this->db->select('COUNT(*) AS count');
        $this->db->select("SUM(IF(charged=0.99, '80.00', IF(charged=1.49, '120.00', IF(charged=1.99, '150.00', IF(charged=2.49, '220.00', IF(charged=2.99, '250.00', IF(charged=3.49, '300.00', IF(charged=3.99, '350.00', IF(charged=4.49, '390.00', IF(charged=4.99, '420.00', IF(charged=5.49, '450.00', IF(charged=5.99, '500.00', charged)))))))))))) AS charged");

        if ($post['date_from'] && $post['date_to']) $this->db->where('DATE(timeofentry) >=',$post['date_from'])->where('DATE(timeofentry) <=',$post['date_to']);
        $this->db->order_by($order_col, $order_dir);
        $this->db->where('paymentStatus', 'CHARGED')->group_by('userid');
        $this->db->join('boighor.tblBoiMelaSubscriptionDetails','boighor.tblBoiMelaSubscriptionDetails.msisdn = boighor.tblPaymentNotification.userid');
        $data['data'] = $this->db->get('boighor.tblPaymentNotification')->result();
        foreach ($data['data'] as $key => $row) {
            $row->sl = 1+(int)$key;
        }

        // if ($post['date_from'] && $post['date_to']) $this->db->where('DATE(timeofentry) >=',$post['date_from'])->where('DATE(timeofentry) <=',$post['date_to']);
        // $this->db->where('paymentStatus', 'CHARGED')->group_by('userid');
        // $data['recordsFiltered'] = $this->db->count_all_results('boighor.tblPaymentNotification');
        $data['recordsFiltered'] = sizeof($data['data']);
        $data['recordsTotal'] = $data['recordsFiltered'];
        //  JSON
        // $data['json'] = array_column($data['data'],'writercode');
        return $data;
    }

}
?>
