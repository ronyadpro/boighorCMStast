<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ipinfo{

  protected $CI;
  function __construct() {
    $this->CI =& get_instance(); 
    $this->CI->load->model('dbip/Dbip_model');
  }
  
  public function get_ip_info($param){
     if($param !='')
     {
      $json =  $this->CI->Dbip_model->get_ip_info($param);
      return $json;
     }else
     {
       return "";
     } 
  }
    
  
}
