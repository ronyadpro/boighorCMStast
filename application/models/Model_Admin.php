<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Admin extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_user_permissions($username='') {
        return $this->db->get_where('tbl_UserPermission', array('username' => $username))->row();
    }

    function get_user_list() {
        return $this->db->select('usr, fullname')->order_by('fullname')->get('tblAuthUsers')->result_array();
    }

    public function get_user_permission_list($username='') {
        return $this->db->get_where('tbl_UserPermission', array('username' => $username))->row_array();
    }

    public function update_user_permission($username, $field, $value) {
        $this->db->limit(1)->where('username', $username)->update('tbl_UserPermission', array($field => $value));
        return $this->db->affected_rows();
    }

    public function get_all_ac_brands() {
        return $this->db->order_by('brandname')->get('tblACBrands')->result_array();
    }

    public function add_acbrands($post) {
        $this->db->insert('tblACBrands', $post);
        return $this->db->affected_rows();
    }

    public function get_all_ac_tons() {
        return $this->db->get('tbl_AcCapacity')->result_array();
    }

    public function add_actons($post) {
        $this->db->insert('tbl_AcCapacity', $post);
        return $this->db->affected_rows();
    }

    //  LOCATION
    public function get_all_district() {
        $districts = $this->db->select('name')->get('tblDistrict')->result_array();
        return array_column($districts, "name");
    }

    public function get_all_district_list() {
        return $this->db->select('name')->order_by('name')->get('tblDistrict')->result_array();
    }

    public function get_all_area() {
        return $this->db->select('area_name, zone_name, district')->order_by('area_name')->get('tblArea')->result_array();
    }

    public function get_all_zone() {
        return $this->db->select('zone_name')->order_by('zone_name')->get('tblZone')->result_array();
    }

    public function get_all_statuses() {
        return $this->db->get('tbl_ServiceStatusCode')->result_array();
    }

    //service Types
    public function get_corporate_client_list_with_custom_service_list() {
        return $this->db->select('clientid, (SELECT companyname FROM tbl_Clients WHERE clientid = tbl_CorporateClientAgreement.clientid LIMIT 1) as clientname')->get_where('tbl_CorporateClientAgreement', array('hascustomservicelist'=>1))->result_array();
    }

    public function get_servicetypes_serverside($post) {
        $data['draw'] = $post['draw'];
        $data['start'] = $post['start'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $search = $post['search']['value'];
        $this->db->group_start()->or_like('servicename', $search)->or_like('rate', $search)->or_like('completiontime', $search)->or_like('createdby', $search)->group_end();
        $this->db->order_by($order_col, $order_dir)->limit($post['length'], $post['start']);
        $data['data'] = $this->db->get_where('tbl_ServiceType', array('type'=>$post['type'], 'servicefor'=>$post['servicefor'], 'deleted'=>0))->result_array();
        $data['recordsFiltered'] = $this->db->group_start()->or_like('servicename', $search)->or_like('rate', $search)->or_like('completiontime', $search)->or_like('createdby', $search)->group_end()->where(array('type'=>$post['type'], 'servicefor'=>$post['servicefor'], 'deleted'=>0))->count_all_results('tbl_ServiceType');
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function add_service_type($post) {
        $this->db->insert('tbl_ServiceType', $post);
        return $this->db->affected_rows();
    }

    public function edit_service_type($post) {
        $this->db->limit(1)->where('servicetypeid', $post['servicetypeid'])->update('tbl_ServiceType', $post);
        return $this->db->affected_rows();
    }

    public function edit_area_by_code($post) {
        $this->db->limit(1)->where('id', $post['id'])->update('tblArea', $post);
        return $this->db->affected_rows();
    }

    public function get_area_by_districtname($post) {
        $data['draw'] = $post['draw'];
        $data['start'] = $post['start'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $search = $post['search']['value'];
        $this->db->group_start()->or_like('area_name', $search)->or_like('zone_name', $search)->or_like('createdby', $search)->group_end();
        $this->db->order_by($order_col, $order_dir)->limit($post['length'], $post['start']);
        $data['data'] = $this->db->get_where('tblArea', array('district'=>$post['type'], 'deleted'=>0))->result_array();
        $data['recordsFiltered'] = $this->db->group_start()->or_like('area_name', $search)->or_like('zone_name', $search)->or_like('createdby', $search)->group_end()->where(array('district'=>$post['type'], 'deleted'=>0))->count_all_results('tblArea');
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function get_nonapvroved_service_types_for_client($param) {
        $clientid = $param['clientid'];
        $user_type = $param['user_type'];
        if ($user_type=='finance') {
            $this->db->where(array('clientcode'=>$clientid, 'hkapprovedstatus'=>1, 'financeapprovedstatus'=>0, 'deleted'=>0));
            $data = $this->db->get('tbl_CorporateServiceList')->result_array();
        } elseif ($user_type=='director') {
            $this->db->where(array('clientcode'=>$clientid, 'hkapprovedstatus'=>1, 'financeapprovedstatus'=>1, 'directorapprovestatus'=>0, 'deleted'=>0));
            $data = $this->db->get('tbl_CorporateServiceList')->result_array();
        } else {
            $this->db->where(array('clientcode'=>$clientid, 'hkapprovedstatus'=>1, 'financeapprovedstatus'=>1, 'directorapprovestatus'=>1, 'deleted'=>0));
            $data = $this->db->get('tbl_CorporateServiceList')->result_array();
        }
        return $data;
    }

    public function submit_service_item_for_approval($servicelist, $username) {
        foreach ($servicelist as $servicetype) {
            $exists = $this->db->where(array('mainserviceid'=>$servicetype['mainserviceid'], 'clientcode'=>$servicetype['clientcode']))->count_all_results('tbl_CorporateServiceList');
            if ($exists) {
                $servicetype['updatedby'] = $username;
                $servicetype['financeapprovedstatus'] = 0;
                $servicetype['directorapprovestatus'] = 0;
                $this->db->limit(1)->where(array('mainserviceid'=>$servicetype['mainserviceid'], 'clientcode'=>$servicetype['clientcode']));
                $this->db->update('tbl_CorporateServiceList', $servicetype);
            } else {
                $servicetype['createdby'] = $username;
                $this->db->insert('tbl_CorporateServiceList', $servicetype);
            }
        }
        return $this->db->affected_rows();
    }

    public function approve_service_list($servicelist, $username) {
        $finance = array("rasel");
        $director = array("khaled", "rafi", "enamul", "emon", "faisal");
        if (in_array($username, $finance)) { // if finance
            foreach ($servicelist as $servicetype) {
                $servicetype['financeapprovedstatus'] = 1;
                $servicetype['financeapproevdby'] = $username;
                $this->db->limit(1)->where(array('mainserviceid'=>$servicetype['mainserviceid'], 'clientcode'=>$servicetype['clientcode']));
                $this->db->update('tbl_CorporateServiceList', $servicetype);
            }
            return $this->db->affected_rows();
        } elseif (in_array($username, $director)) { // if director
            foreach ($servicelist as $servicetype) {
                $servicetype['directorapprovestatus'] = 1;
                $servicetype['finalapprovedby'] = $username;
                $this->db->limit(1)->where(array('mainserviceid'=>$servicetype['mainserviceid'], 'clientcode'=>$servicetype['clientcode']));
                $this->db->update('tbl_CorporateServiceList', $servicetype);
            }
            return $this->db->affected_rows();
        } else {
            return 403;
        }
    }

    public function get_apvroved_service_types_for_client($clientid) {
        $this->db->select('*, mainserviceid as servicetypeid')->where(array('clientcode'=>$clientid, 'hkapprovedstatus'=>1, 'financeapprovedstatus'=>1, 'directorapprovestatus'=>1, 'deleted'=>0));
        $data = $this->db->get('tbl_CorporateServiceList')->result_array();
        return $data;
    }

    public function delete_corporate_service_type($post) {
        $this->db->limit(1)->where(array('mainserviceid'=>$post['mainserviceid'], 'deleted'=>0))->set('deleted',1)->set('updatedby',$post['updatedby'])->update('tbl_CorporateServiceList');
        return $this->db->affected_rows();
    }

}
?>
