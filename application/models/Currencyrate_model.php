<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currencyrate_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url','string'));
        $this->load->database();
    }

    public function update_rates()
    {
        date_default_timezone_set('Asia/Dhaka');
        $today = date('Y-m-d h:i:s ');
        $charging_rates = $this->db->query("SELECT * FROM boighor.tblChargingRates where updatedat = '$today'")->row_array();
        if (empty($charging_rates)) {
             return "called";
        }else {
            return "data exist";
        }
        //
        // $curl = curl_init();
        //
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://api.apilayer.com/exchangerates_data/convert?to=BDT&from=USD&amount=1",
        //     CURLOPT_HTTPHEADER => array(
        //         "Content-Type: text/plain",
        //         "apikey: YTo5tP2PZYZUc9jc88fPKDQPXN320G9H"
        //     ),
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "GET"
        // ));
        //
        // $response = curl_exec($curl);
        //
        // curl_close($curl);
        // echo $response;

    }


}
?>
