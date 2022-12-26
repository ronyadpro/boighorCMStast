<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Price_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_price_list_gpboimela() {
        $price['bdt'] = $this->db->order_by('sortorder')->get_where('tblBookPrice', array('servicename'=>'gp'))->result_array();
        $price['usd'] = $this->db->order_by('sortorder')->get_where('tblBookPriceGlobal', array('servicename'=>'gpboimela'))->result_array();
        return $price;
    }

    public function add_pricing_gp_bdt($post) {
        $this->db->insert('tblBookPrice',$post);
        return $this->db->affected_rows();
    }

    public function add_pricing_gp_usd($post) {
        $this->db->insert('tblBookPriceGlobal',$post);
        return $this->db->affected_rows();
    }

    public function edit_pricing_gp_bdt($post) {
        $this->db->limit(1)->where('id', $post['id'])->update('tblBookPrice',$post);
        return $this->db->affected_rows();
    }

    public function edit_pricing_gp_usd($post) {
        $this->db->limit(1)->where('id', $post['id'])->update('tblBookPriceGlobal',$post);
        return $this->db->affected_rows();
    }

    public function get_price_list_global() {
        $price['bdt'] = $this->db->order_by('CAST(bookprice AS DECIMAL)')->get_where('tblBookPrice', array('servicename'=>'boighorglobal'))->result_array();
        $price['usd'] = $this->db->order_by('sortorder')->get_where('tblBookPriceGlobal', array('servicename'=>'boighorglobal'))->result_array();
        return $price;
    }

    public function add_pricing_global_bdt($post) {
        $this->db->insert('tblBookPrice',$post);
        return $this->db->affected_rows();
    }

    public function add_pricing_global_usd($post) {
        $this->db->insert('tblBookPriceGlobal',$post);
        return $this->db->affected_rows();
    }

    public function edit_pricing_global_bdt($post) {
        $this->db->limit(1)->where('id', $post['id'])->update('tblBookPrice',$post);
        return $this->db->affected_rows();
    }

    public function edit_pricing_global_usd($post) {
        $this->db->limit(1)->where('id', $post['id'])->update('tblBookPriceGlobal',$post);
        return $this->db->affected_rows();
    }

    public function get_discounted_books() {
        $this->db->select('*');
        $this->db->select('(SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) AS bookprice_boighor_bdt_disc_id');
        $this->db->select('(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_bdt');
        $this->db->select('(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_bdt_disc');
        $this->db->select('IF((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode))=(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode)), 1, 0) AS isdiscounted');
        $this->db->select('(SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_usd');
        $this->db->where('(SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode)<>(SELECT global_bdt FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode)');
        $data = $this->db->join('tblBookCategory', 'tblBookCategory.catcode = tblBooks.category', 'left outer')->get_where('tblBooks', array('hideit' => 0))->result();
        return $data;
    }

    public function price_bulk_update($post) {
        foreach ($post as $key => $book) {
            // var_dump($book);
            $this->db->limit(1)->where('bookcode', $book['bookcode'])->set('global_bdt_disc', $book['global_bdt'])->update('tblBookPriceTagging');
        }
        return 1;
    }

}
?>
