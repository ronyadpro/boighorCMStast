<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->model('Model_Authentication');
        $this->load->database();
    }

    public function get_userlist_global($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];

        $serchkey = $post['search']['value'];
        if ($serchkey) {
            $this->db->group_start()->or_like('msisdn',$serchkey)->or_like('email',$serchkey)->or_like('fullname',$serchkey)->group_end();
        }

        $data['data'] = $this->db->order_by($order_col, $order_dir)->limit($post['length'], $post['start'])->get('boighor.tblBoiMelaSubscriptionDetails')->result();

        if ($serchkey) {
            $this->db->group_start()->or_like('msisdn',$serchkey)->or_like('email',$serchkey)->or_like('fullname',$serchkey)->group_end();
        }
        $data['recordsFiltered'] = $this->db->count_all_results('boighor.tblBoiMelaSubscriptionDetails');
        $data['recordsTotal'] = $this->db->count_all_results('boighor.tblBoiMelaSubscriptionDetails');
        return $data;
    }

    public function get_user_details($userid) {
        $data['userdetails'] = $this->db->limit(1)->get_where('boighor.tblBoiMelaSubscriptionDetails',array('msisdn'=>$userid))->row_array();
        $this->db->select('*');
        $this->db->select('(SELECT COUNT(*) FROM boighor.tblBoiMelaContentComment WHERE username = "'.$userid.'" AND contentid = boighor.tblBoiMelaSubscriberContentSelection.bookcode AND comment = "download successful") AS redownload');
        $data['booklist'] = $this->db->order_by('timeofentry','desc')->get_where('boighor.tblBoiMelaSubscriberContentSelection',array('msisdn'=>$userid))->result_array()?:array();
        $data['transactionhistory'] = $this->db->order_by('timeofentry','desc')->get_where('boighor.tblPaymentNotification',array('userid'=>$userid))->result_array()?:array();
        $data['activityhistory'] = $this->db->order_by('timeofentry','desc')->limit(50)->get_where('boighor.tblMasterAccessToken',array('username '=>$userid))->result_array()?:array();
        $data['browsinghistory'] = $this->db->order_by('created','desc')->limit(50)->get_where('boighor.tblApiLog',array('userid '=>$userid))->result_array()?:array();
        $data['carthistory'] = $this->db->order_by('created','desc')->limit(50)->get_where('boighor.tblOrderDetails',array('userid '=>$userid))->result_array()?:array();
        $data['payinithistory'] = $this->db->order_by('timeofentry','desc')->limit(50)->get_where('boighor.tblPaymentInitReference',array('userid '=>$userid))->result_array()?:array();
        $data['fcm'] = $this->db->limit(1)->get_where('boighor.tbl_fcmid',array('userid'=>$userid))->row_array()?:array();
        $data['deviceid'] = $this->db->limit(1)->get_where('boighor.tblWhitelistedMsisdn',array('msisdn'=>$userid))->row_array()?:array();
        if (sizeof($data['activityhistory'])>0) {
            $data['ip_details'] = $this->Model_Authentication->getipinfo('web', $data['activityhistory'][0]['remoteaddr']);
        } else {
            $data['ip_details'] = new stdClass();
        }

        return $data;
    }

    function handleGiftBook($param)
    {
        $bookcode = $param['bookcode'];
        $row = $this->db->query("SELECT * FROM boighor.tblBooks LEFT JOIN tblBookPriceTagging ON tblBookPriceTagging.bookcode = tblBooks.bookcode LEFT JOIN tblBookPrice ON tblBookPriceTagging.global_bdt = tblBookPrice.id LEFT JOIN tblBookPriceGlobal ON tblBookPriceTagging.global_bdt = tblBookPriceGlobal.id WHERE tblBooks.bookcode = '$bookcode'")->row_array();

        $sqlcheck = $this->db->select('bookcode')->get_where('boighor.tblBoiMelaSubscriberContentSelection', array('msisdn' => $param['userid'],'bookcode' => $row['bookcode']))->row_array();
        if (isset($sqlcheck) && count($sqlcheck) > 0) {
            log_message('error',"Book gift ----Userid:".$param['userid']."-----bookcode:".$bookcode."---- already in list");
            return -1;
        }else {

            $bookdata['msisdn']=$param['userid'];
            $bookdata['bookid']=$row['bookid'];
            $bookdata['bookcode']=$row['bookcode'];
            $bookdata['nametoshow']=$row['bookname'];
            $bookdata['bookname_bn']=$row['bookname_bn'];
            $bookdata['bookprice']=$row['bookprice'];
            $bookdata['bookprice_bn']=$row['bookprice_bn'];
            $bookdata['bookprice_en']=$row['bookprice_en'];
            $bookdata['timeofentry']= date('Y-m-d H:i:s');

            //$bookdata['bookname']=$row['bookname'];
            $bookdata['writer']=$row['writer'];
            //$bookdata['filename']=$row['filename'];
            $bookdata['isaudiobook']=$row['isaudiobook'];
            $bookdata['bookcover']=$row['bookcover_small'];
            $bookdata['writer_bn']=$row['writer_bn'];
            $bookdata['obtainedby'] = $param['obtaintype'];

            $bookdata['isOpen']= $row['isOpen'];
            $bookdata['filepath']=$row['filename'];
            $this->db->INSERT('boighor.tblBoiMelaSubscriberContentSelection',$bookdata);

            log_message('error',"Book gift ----Userid:".$param['userid']."-----bookcode:".$bookcode."---- Book added to profile");
            return 1;
        }

    }

    public function edit_device($data) {
        return $this->db->where('msisdn', $data['msisdn'])->limit(1)->update('tblWhitelistedMsisdn', $data);
    }

}
?>
