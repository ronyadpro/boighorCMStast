<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manualsubscription extends CMS_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('excel_import_model');
		$this->load->library('excel');
	}

	public function index() {
		$this->manual_sub_from_excel();
	}

	public function manual_sub_from_excel() {
		if ($this->userinfo['permissions']->bi_view) {
			$data['userinfo'] = $this->userinfo;
			$data['title'] = 'Manual Subscription';
			$data['content'] = $this->load->view('manualjobs/view_manual_subscribe', $data, TRUE);
			$this->load->view('view_layout', $data);
		} else {
			$this->access_denied();
		}
	}

	public function subscribe_users_from_excel() {
		var_dump($_POST);
		echo "<br>";
		echo "********************";
		echo "<br>";
		var_dump($_FILES);
	}

	function generatePIN($digits = 6){
	    $i = 0; //counter
	    $pin = ""; //our default pin is blank.
	    while($i < $digits){
	        //generate a random number between 0 and 9.
	        $pin .= mt_rand(0, 9);
	        $i++;
	    }
	    return $pin;
	}


	function import()
	{
		$curtime = date("Y-m-d H:s:i");
		$pack = $this->input->post('packname',TRUE);
		if ($pack == "boighor_30days") {
			$packname = '30 days';
			$subendmin=date("Y-m-d", strtotime('+29 days'));
			$subendmin=$subendmin . " 23:59:59";
		}else {
			echo "select pack first";
			return;
		}



		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				for($row=2; $row<=$highestRow; $row++)
				{
					$msisdn = $worksheet->getCellByColumnAndRow(0, $row)->getValue();

					if (strlen($msisdn) == 10) {
						 $msisdn = '880'.$msisdn;
					}else {

					}
					if ($msisdn != '') {
						$data[] = array(
							'msisdn'		=>	$msisdn,
							'pincode' => $this->generatePIN(6),
							'signedup'	 =>	1,
							'signupdate' =>	$curtime,
							'signupfrom'	=>	"ebs",
							'pack'		=>	$pack,
							'packname'		=>	$packname,
							'activepack'	=>	$packname,
							'subdatetime'		=>	$curtime,
							'actualsubdatetime'		=>	$curtime,
							'subenddatetime'		=>	$subendmin,
							'substatus'	=> 2
						);
					}


				}
			}
			if ($data[0]['msisdn'] != '') {
				 $this->excel_import_model->insert($data);
				 echo 1;
				 //echo json_encode($data);
			}else {
				echo 0;
			}


		}else {
			echo 0;
		}
	}


}
