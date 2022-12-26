<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dbip_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        include APPPATH . 'third_party/dbip_helper/dbip.class.php';

    }

    public function get_ip_info($iptocheck){
        if ($iptocheck == "") {
            $iptocheck = "";
        }
        $db = new PDO("mysql:host=10.0.1.108;dbname=geolookup", "devuser", "EBS@dev123");
        $dbip = new DBIP($db);
        $inf = $dbip->Lookup($iptocheck);
        $return_arr = array();
        $data =array();
        $row_array['ip']  = $iptocheck;
        $row_array['country']  = $inf->country;
        $row_array['countryname']  = $this->get_country($row_array['country']);
        // $row_array['stateprov']  = "";//$inf->stateprov;
        // $row_array['district']  = "";//$inf->district;
        // $row_array['city']  = "";//$inf->city;
        // $row_array['isp_name']  = "";//$inf->isp_name;
        // $row_array['organization_name']  = "";//$inf->organization_name;
        //$row_array['remoteip']  = $iptocheck;
        //array_push($return_arr,$row_array);
        return json_encode($row_array);

    }

    function get_country($param){
        $result = $this->db->select('countryname')->get_where('boighor.tblCountryName', array('countrycode' => $param))->row_array();
        return $result['countryname'] ?: "";
    }

}
?>
