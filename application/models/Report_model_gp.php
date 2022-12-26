<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model_gp extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_all_promocodes() {
        return $this->db->get('boighor.tblPromoCode')->result_array();
    }

    public function get_all_licensers() {
        return $this->db->select('licensername_en, licensertype, licensercode')->get('tblBookLicenser')->result_array();
    }

    public function get_sales_report($post) {
        $data['start'] = 0;//$post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $serchkey = $post['search']['value'];

        $this->db->select('*');
        if ($post['writercode']) $this->db->where('writercode',$post['writercode']);
        if ($post['publishercode']) $this->db->where('publishercode',$post['publishercode']);
        if ($post['date_from'] && $post['date_to']) $this->db->where('DATE(pagehittime) >=',$post['date_from'])->where('DATE(pagehittime) <=',$post['date_to']);
        $this->db->order_by($order_col, $order_dir);
        $this->db->join('boighor.tblBooks','boighor.tblBooks.bookcode = gpboighor.tblBoiMelaSubscriberContentSelection.bookcode');
        $data['data'] = $this->db->get('gpboighor.tblBoiMelaSubscriberContentSelection')->result();

        if ($post['writercode']) $this->db->where('writercode',$post['writercode']);
        if ($post['publishercode']) $this->db->where('publishercode',$post['publishercode']);
        if ($post['date_from'] && $post['date_to']) $this->db->where('DATE(pagehittime) >=',$post['date_from'])->where('DATE(pagehittime) <=',$post['date_to']);
        $this->db->join('boighor.tblBooks','boighor.tblBooks.bookcode = gpboighor.tblBoiMelaSubscriberContentSelection.bookcode');
        $data['recordsFiltered'] = $this->db->count_all_results('gpboighor.tblBoiMelaSubscriberContentSelection');
        $data['recordsTotal'] = $data['recordsFiltered'];

        return $data;
    }

        public function get_subscription_report($post) {
            $data['start'] = 0;//$post['start'];
            $data['draw'] = $post['draw'];
            $order_col = $post['columns'][$post['order'][0]['column']]['data'];
            $order_dir = $post['order'][0]['dir'];
            $serchkey = $post['search']['value'];

            $this->db->select('*');
            if ($post['date_from'] && $post['date_to']) $this->db->where('DATE(logtime) >=',$post['date_from'])->where('DATE(logtime) <=',$post['date_to']);
            $this->db->order_by($order_col, $order_dir);
            $this->db->join('gpboighor.tblSubscriptionType','gpboighor.tblSubscriptionType.sub_pack_name = gpboighor.tblBoiMelaSubscriptionDetails_log.pack');
            $data['data'] = $this->db->get('gpboighor.tblBoiMelaSubscriptionDetails_log')->result();

            if ($post['date_from'] && $post['date_to']) $this->db->where('DATE(logtime) >=',$post['date_from'])->where('DATE(logtime) <=',$post['date_to']);
            $this->db->join('gpboighor.tblSubscriptionType','gpboighor.tblSubscriptionType.sub_pack_name = gpboighor.tblBoiMelaSubscriptionDetails_log.pack');
            $data['recordsFiltered'] = $this->db->count_all_results('gpboighor.tblBoiMelaSubscriptionDetails_log');
            $data['recordsTotal'] = $data['recordsFiltered'];

            return $data;
        }

    public function get_mou_report($post) {
        $data['start'] = 0;//$post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $serchkey = $post['search']['value'];

        $this->db->select('gpboighor.tblContentPlayLog.msisdn AS msisdn, gpboighor.tblContentPlayLog.adbid AS adbid, boighor.tblBookAudios.bookcode AS bookcode, boighor.tblBookAudios.title AS title, boighor.tblBookAudios.title_bn AS title_bn, boighor.tblBooks.bookname AS bookname, boighor.tblBooks.writercode AS writercode, boighor.tblBooks.writer AS writer, boighor.tblBooks.writer_bn AS writer_bn, boighor.tblBookAudios.filelength AS filelength, SUM(LEAST(pulse,playposition)) AS total_usage_in_seconds, COUNT(*) AS hitcount');
        if ($post['publishercode']) $this->db->where('boighor.tblBooks.publishercode',$post['publishercode']);
        $this->db->where('DATE(pagehittime) >=',$post['date_from'])->where('DATE(pagehittime) <=',$post['date_to']);
        $this->db->join('boighor.tblBookAudios','boighor.tblBookAudios.id = gpboighor.tblContentPlayLog.adbid');
        $this->db->join('boighor.tblBooks','boighor.tblBooks.bookcode = gpboighor.tblContentPlayLog.bookcode');
        $data['data'] = $this->db->order_by("total_usage_in_seconds","desc")->group_by('bookcode')->group_by('adbid')->get('gpboighor.tblContentPlayLog')->result();

        $data['recordsFiltered'] = sizeof($data['data']);
        $data['recordsTotal'] = $data['recordsFiltered'];
        //  JSON
        // $data['json'] = array_column($data['data'],'writercode');
        return $data;
    }

}
?>
