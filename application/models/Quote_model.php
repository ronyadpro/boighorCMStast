<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quote_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_quotes($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];

        $serchkey = $post['search']['value'];
        if ($serchkey) {
            $this->db->group_start()->or_like('authorname_en',$serchkey)->or_like('quote',$serchkey)->group_end();
        }

        $data['data'] = $this->db->order_by($order_col, $order_dir)->limit($post['length'], $post['start'])->get('boighor.tblQuotes')->result();
        $data['recordsFiltered'] = $this->db->count_all_results('boighor.tblQuotes');
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function change_status($quoteid, $status) {
        $response = $this->db->where('pkid',$quoteid)->set('status',$status)->limit(1)->update('boighor.tblQuotes');
        return $response ? 1 : 0;
    }

    public function create_quote($param) {
        $this->db->insert('boighor.tblQuotes',$param);
        return $this->db->affected_rows();
    }

    public function edit_quote($param) {
        $this->db->set('quote',$param['quote']);
        $this->db->set('authorname_en',$param['authorname_en']);
        $this->db->set('authorname_bn',$param['authorname_bn']);
        $this->db->where('pkid',$param['pkid']);
        $response = $this->db->limit(1)->update('boighor.tblQuotes');
        return $response ? 1 : 0;
    }
}
?>
