<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class License_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_book_license_types() {
        return $this->db->get('tblBookLicenseType')->result_array();
    }

    public function get_book_license_payment_types() {
        return $this->db->get('tblBookLicensePaymentType')->result_array();
    }

    public function get_book_license_terms() {
        return $this->db->get('tblBookLicenseTermType')->result_array();
    }

    public function get_licenser_credentials($authorcode) {
        // ->where('licensertype','author')
        return $this->db->where('licensercode',$authorcode)->get('boighor.tblBookLicenser')->row_array();
    }

    public function create_licenser_profile($post) {
        $this->db->insert('boighor.tblBookLicenser',$post);
        return $this->db->affected_rows();
    }

}
?>
