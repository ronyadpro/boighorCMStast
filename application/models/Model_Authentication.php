<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/dbip_lib/Ipinfo.php';
class Model_Authentication extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->Ipinfo = new Ipinfo();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function getipinfo($fromsrc = NULL ,  $ip = NULL)
    {
        if ($fromsrc == 'web') {
            $ip =  $ip ?: "119.81.42.250";
        }else {
            $ip = getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR');
        }
        $info = json_decode($this->Ipinfo->get_ip_info($ip));
        return $info;
    }

    function validateUser($username,$password) {
        return $this->db->where('email',$username)->where('oldpass',$password)->limit(1)->get('tz_members_hydrokleen')->row_array();
    }

    public function get_user_info($username) {
        return $this->db->select("email, usr AS username, fullname AS name, level, 'TRUE' AS logged_in")->get_where('tz_members_hydrokleen', array('email' => $username))->row_array();
    }

    public function get_user_permissions($username='') {
        return $this->db->get_where('tbl_UserPermission', array('username' => $username))->row();
    }

}
?>
