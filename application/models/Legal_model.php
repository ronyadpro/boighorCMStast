<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Legal_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_legal_info_list(){
        return $this->db->get('boighor.tblBookAppInfo')->result_array();
    }

    public function edit_legal_info($post) {
        return $this->db->limit(1)->where('pkid',$post['pkid'])->update('boighor.tblBookAppInfo',$post);
    }

}
?>
