<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publisher_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_all_publishers() {
        return $this->db->order_by('publishername_en')->get('tblBookPublisher')->result_array();
    }

    public function get_publishers($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];

        $serchkey = $post['search']['value'];
        if ($serchkey) {
            $this->db->group_start()->or_like('publishercode',$serchkey)->or_like('publishername_en',$serchkey)->or_like('publishername_bn',$serchkey)->group_end();
        }

        $data['data'] = $this->db->order_by($order_col, $order_dir)->limit($post['length'], $post['start'])->get('tblBookPublisher')->result();
        $data['recordsFiltered'] = $this->db->count_all_results('tblBookPublisher');
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function add_publisher($post) {
        $publisherid = $this->db->query("SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'boighor' AND   TABLE_NAME   = 'tblBookPublisher'")->row()->AUTO_INCREMENT;
        $publishercode = "P".str_pad(strtoupper(dechex(intval($publisherid)+1000)), 4, '0', STR_PAD_LEFT);
        $post['publishercode'] = $publishercode;
        $this->db->insert('tblBookPublisher',$post);
        return $this->db->affected_rows();
    }

    public function update_publisher($post) {
        return $this->db->where('publishercode', $post['publishercode'])->limit(1)->update('tblBookPublisher', $post);
    }

    public function get_publisher_details($publishercode) {
        $publisherdata = $this->db->limit(1)->where('publishercode',$publishercode)->get('tblBookPublisher')->row_array();
        return $publisherdata;
    }

    public function get_booklist($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $data['data'] = $this->db->where('publishercode', $post['publishercode'])->where('hideit', 0)
        //->like('bookname', $post['search']['value'])->or_like('bookname_bn', $post['search']['value'])->or_like('writer', $post['search']['value'])->or_like('writer_bn', $post['search']['value'])->or_like('bookcode', $post['search']['value'])
        ->order_by($order_col, $order_dir)->limit($post['length'], $post['start'])->get('tblBooks')->result();
        $data['recordsFiltered'] = $this->db->where('publishercode', $post['publishercode'])->where('hideit', 0)
        //->like('bookname', $post['search']['value'])->or_like('bookname_bn', $post['search']['value'])->or_like('writer', $post['search']['value'])->or_like('writer_bn', $post['search']['value'])->or_like('bookcode', $post['search']['value'])
        ->count_all_results('tblBooks');
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

}
?>
