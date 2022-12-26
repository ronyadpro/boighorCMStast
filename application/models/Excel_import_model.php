<?php
class Excel_import_model extends CI_Model
{
	function __construct() {
			parent::__construct();
			$this->config->item('base_url');
			$this->config->item('api_url');
			$this->load->helper('url');
			$this->load->library('session');
			$this->load->database();
	}

	function get_data($url) {
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	function insert($data)
	{
		foreach ($data as $row) {
			$checkresult = $this->db->Select('*')->get_where('boighorglobal.tblBoiMelaSubscriptionDetails',array('msisdn' => $row['msisdn']))->row_array();
			if ($checkresult) {
				log_message('error',"Manual_user_creation----userid:".$row['msisdn']."-----Message:User already exist, noting to do.");
			}else {
				$msisdn = $row['msisdn'];
				$username =substr($msisdn, 2); //str_replace("88","",$msisdn);
				$pincode = $row['pincode'];

				$msg="Congrats, you have got 1-month Free Boighor Service for paying Tuition Fees through Bkash. Username:".$username.",Password: ".$pincode.". Visit: https://boighor.com";
				$msg=urlencode($msg);
				$url2 = "http://wapcharge.ebsbd.com/wapapi/sendsms.aspx?user=user&pass=pass&msisdn=$msisdn&sms=$msg&shortcode=bkashboighor&telco=3";
				$returned_content = $this->get_data($url2);
				$checkmsg=substr($returned_content, 0, 10);


				$msg = "ভিজিট করুন https://boighor.com এবং FreeBoighor প্রোমোকোড ব্যবহার করে ১০টি বই ডাউনলোড করুন ফ্রি!!!";
				$msg=urlencode($msg);
				$url2 = "http://wapcharge.ebsbd.com/wapapi/sendsms.aspx?user=user&pass=pass&msisdn=$msisdn&sms=$msg&shortcode=bkashboighor&telco=3";
				$returned_content = $this->get_data($url2);
				$checkmsg=substr($returned_content, 0, 10);

				$this->db->insert('boighor.tblBoiMelaSubscriptionDetails', $row);
				log_message('error',"Manual_user_creation----userid:".$row['msisdn']."-----Message: User created.");
			}

		}

	}

}
