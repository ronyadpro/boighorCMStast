<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_RemoteConfig extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_config() {
        $data['web'] = $this->db->where('platform','web')->get('boighor.tblAppSettingFlags')->row_array();
        $data['app'] = $this->db->where('platform','app')->get('boighor.tblAppSettingFlags')->row_array();
        $data['ios'] = $this->db->where('platform','ios')->get('boighor.tblAppSettingFlags')->row_array();
        return $data;
    }

    public function update_remote_config($post) {
    
        $this->db->limit(1)->where('platform',$post['platform'])->update('boighor.tblAppSettingFlags',$post);

        return $this->db->affected_rows();
    }
}
?>
