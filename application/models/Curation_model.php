<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curation_model extends CI_Model {
    //
    //      PRIVATE FUNCTIONS STARTS
    //

    private $userinfo = null;

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
		$this->load->library('session');
        $this->userinfo['username'] = $this->session->userdata('username');
    }

    private function getTableNameForTelco($telco='') {
        switch ($telco) {
            case 'airtel':
                $tablename = 'boighor.tblBanner_airtel';
                break;
            case 'blink':
                $tablename = 'boighor.tblBanner_blink';
                break;
            case 'global':
                $tablename = 'boighor.tblBanner_global';
                break;
            case 'gp':
                $tablename = 'gpboighor.tblBanner';
                break;
            case 'robi':
                $tablename = 'boighor.tblBanner_robi';
                break;
            default:
                $tablename = 'gpboighor.tblBanner';
                break;
        }
        return $tablename;
    }
    //
    //      PRIVATE FUNCTIONS ENDS
    //

    public function get_homedata_serverside($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        // $data['data'] = $this->db->select('*, IF(itemtype=1, "Regular", "Banner") AS itemtype')->order_by('sortorder', 'asc')->get('gpboighor.tblAppHomeBoighor')->result();
        $data['data'] = $this->db->order_by('sortorder', 'asc')->get('gpboighor.tblAppHomeBoighor')->result();
        $data['recordsFiltered'] = 10;
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function update_sortorder_home($data) {
        foreach ($data as $value) {
            $this->db->where('catcode', $value['catcode'])->limit(1)->update('gpboighor.tblAppHomeBoighor', array('sortorder' => $value['pos']+1));
        }
        return true;
    }

    public function update_status_by_platform($data) {
        return $this->db->where(array('catcode' => $data['catcode']))->limit(1)->update('gpboighor.tblAppHomeBoighor', array($data['platform'] => $data['status']));
    }

    public function get_booklist_serverside($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        if (isset($post['gen']) && $post['gen']) {
            $genList = $this->db->select('id, bookcode')->group_by('bookcode')->where_in('genrecode', $post['gen'])->get('tblBookGenreTagging')->result();
            $genList = json_decode(json_encode($genList), true);
            $genListArray = array_column($genList, 'bookcode');
            if ($genListArray) {
                if ($post['search']['value']) $this->db->group_start()->or_like('bookname', $post['search']['value'])->or_like('bookname_bn', $post['search']['value'])->or_like('writer', $post['search']['value'])->or_like('writer_bn', $post['search']['value'])->group_end();
                if ($post['link']) {
                    $data['data'] = $this->db->group_start()->where('category', $post['cat'])->where_in('bookcode', $genListArray)->group_end()->limit($post['length'], $post['start'])->get_where('tblBooks',array('status_gp' => 1, 'isaudiobook' => $post['adb']))->result();
                    $data['recordsFiltered'] = $this->db->where('category', $post['cat'])->where_in('bookcode', $genListArray)->where(array('status_gp' => 1, 'isaudiobook' => $post['adb']))->count_all_results('tblBooks');
                    $data['recordsTotal'] = $data['recordsFiltered'];
                } else {
                    $data['data'] = $this->db->group_start()->where('category', $post['cat'])->or_where_in('bookcode', $genListArray)->group_end()->limit($post['length'], $post['start'])->get_where('tblBooks',array('status_gp' => 1, 'isaudiobook' => $post['adb']))->result();
                    $data['recordsFiltered'] = $this->db->where('category', $post['cat'])->or_where_in('bookcode', $genListArray)->where(array('status_gp' => 1, 'isaudiobook' => $post['adb']))->count_all_results('tblBooks');
                    $data['recordsTotal'] = $data['recordsFiltered'];
                }
            } else {
                $data['data'] = array();
                $data['recordsFiltered'] = 0;
                $data['recordsTotal'] = $data['recordsFiltered'];
            }
        } else if(isset($post['cat']) && $post['cat']){
            if ($post['search']['value']) $this->db->group_start()->or_like('bookname', $post['search']['value'])->or_like('bookname_bn', $post['search']['value'])->or_like('writer', $post['search']['value'])->or_like('writer_bn', $post['search']['value'])->group_end();
            $data['data'] = $this->db->where('category', $post['cat'])->limit($post['length'], $post['start'])->get_where('tblBooks',array('status_gp' => 1, 'isaudiobook' => $post['adb']))->result();
            $data['recordsFiltered'] = $this->db->where('category', $post['cat'])->where(array('status_gp' => 1, 'isaudiobook' => $post['adb']))->count_all_results('tblBooks');
            $data['recordsTotal'] = $data['recordsFiltered'];
        } else {
            if ($post['search']['value']) $this->db->group_start()->or_like('bookname', $post['search']['value'])->or_like('bookname_bn', $post['search']['value'])->or_like('writer', $post['search']['value'])->or_like('writer_bn', $post['search']['value'])->group_end();
            $data['data'] = $this->db->limit($post['length'], $post['start'])->get_where('tblBooks',array('status_gp' => 1, 'isaudiobook' => $post['adb']))->result();
            $data['recordsFiltered'] = $this->db->where(array('status_gp' => 1, 'isaudiobook' => $post['adb']))->count_all_results('tblBooks');
            $data['recordsTotal'] = $data['recordsFiltered'];
        }
        return $data;
    }

    public function create_new_section($post) {
        $bookcodes = $post['bookcodes'];
        unset($post['bookcodes']);
        $this->db->insert('gpboighor.tblAppHomeBoighor', $post);
        foreach ($bookcodes as $key => $value) {
            $this->db->insert('gpboighor.tblAppBoighorHomeItems', array('bookcode' => $value, 'sectioncode' => $post['catcode'], 'addedby'=>$this->userinfo['username'], 'addedby'=>$this->userinfo['username']));
        }
        return 1;
    }

    public function get_section_items_by_catcode($catcode) {

        $data = $this->db->select('catcode, catname, catname_bn, itemtype')->get_where('gpboighor.tblAppHomeBoighor', array('catcode' => $catcode))->row_array();
        // $data['books'] = $this->db->where("bookcode IN (SELECT bookcode FROM gpboighor.tblAppBoighorHomeItems WHERE sectioncode = \"$catcode\" ORDER BY sortorder)")->get('tblBooks')
                                // ->join('gpboighor.tblAppBoighorHomeItems')->result_array();
        switch ($data['itemtype']) {
            case 1:
                $data['books'] = $this->db->select('tb.bookcode, bookname, writer, bookcover_small')->where('sectioncode', $catcode)->join('tblBooks AS tb', 'gpboighor.tblAppBoighorHomeItems.bookcode = tb.bookcode', 'left outer')->order_by('gpboighor.tblAppBoighorHomeItems.sortorder')->get('gpboighor.tblAppBoighorHomeItems')->result_array();
                break;
            case 2:
                $data['books'] = $this->db->select('tb.bookcode, bookname, writer, bookcover_small')->where('sectioncode', $catcode)->join('tblBooks AS tb', 'gpboighor.tblAppBoighorHomeItems.bookcode = tb.bookcode', 'left outer')->order_by('gpboighor.tblAppBoighorHomeItems.sortorder')->get('gpboighor.tblAppBoighorHomeItems')->result_array();
                break;
            case 3:
                $data['authors'] = $this->db->select('ta.authorcode, author')->where('sectioncode', $catcode)->join('tblBookAuthor AS ta', 'gpboighor.tblAppBoighorHomeItems.bookcode = ta.authorcode', 'left outer')->order_by('sortorder')->get('gpboighor.tblAppBoighorHomeItems')->result_array();
                break;
            case 4:
                $data['authors'] = $this->db->select('ta.authorcode, author')->where('sectioncode', $catcode)->join('tblBookAuthor AS ta', 'gpboighor.tblAppBoighorHomeItems.bookcode = ta.authorcode', 'left outer')->order_by('sortorder')->get('gpboighor.tblAppBoighorHomeItems')->result_array();
                break;
            default:
                $data['books'] = array();
                $data['authors'] = array();
                break;
        }
        return $data;
    }

    public function update_section_items_sortorder($post) {
        $catcode = $post['catcode'];
        unset($post['catcode']);
        foreach ($post as $row) {
            $this->db->where(array('bookcode' => $row['bookcode'], 'sectioncode' => $catcode))->limit(1)->update('gpboighor.tblAppBoighorHomeItems', array('sortorder' => $row['sortorder']));
        }
        return 1;
    }

    public function remove_section_item($post='') {
        return $this->db->limit(1)->delete('gpboighor.tblAppBoighorHomeItems', array('bookcode' => $post['bookcode'], 'sectioncode' => $post['catcode']));
    }

    public function add_section_item($post='') {
        $existcount = $this->db->where(array('bookcode' => $post['bookcode'], 'sectioncode' => $post['catcode']))->count_all_results('gpboighor.tblAppBoighorHomeItems');
        if ($existcount) {
            return 409;
        } else {
            $this->db->insert('gpboighor.tblAppBoighorHomeItems', array('bookcode' => $post['bookcode'], 'sectioncode' => $post['catcode'], 'addedby'=>$this->userinfo['username']));
            return $this->db->affected_rows();
        }

    }

    public function update_section_info($post='') {
        $bookcodes = $post['bookcodes'];
        unset($post['bookcodes']);
        foreach ($bookcodes as $sortorder => $bookcode) {
            $this->db->limit(1)->where(array('bookcode' => $bookcode, 'sectioncode' => $post['catcode']))->update('gpboighor.tblAppBoighorHomeItems', array('sortorder' => $sortorder));
        }
        // return;
        return $this->db->limit(1)->where(array('catcode' => $post['catcode']))->update('gpboighor.tblAppHomeBoighor', $post);
    }

    public function get_banner_items($post, $telco) {
        $tablename = $this->getTableNameForTelco($telco);
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $data['data'] = $this->db->order_by('sortorder')->get_where($tablename, array('deleted' => 0))->result_array();
        $data['recordsFiltered'] = sizeof($data['data']);
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function add_banner_item($post, $telco) {
        $tablename = $this->getTableNameForTelco($telco);
        return $this->db->insert($tablename, $post);
    }

    public function change_banner_item_status($id='', $status='', $telco='') {
        $tablename = $this->getTableNameForTelco($telco);
        return $this->db->limit(1)->where('id', $id)->update($tablename, array('status' => $status));
    }

    public function delete_banner_item($id='', $telco='') {
        $tablename = $this->getTableNameForTelco($telco);
        return $this->db->limit(1)->where('id', $id)->update($tablename, array('deleted' => 1));
    }

    public function update_banner_item($post='', $telco='') {
        $tablename = $this->getTableNameForTelco($telco);
        $bannerid = $post['bannerid'];
        unset($post['bannerid']);
        return $this->db->limit(1)->where('id', $bannerid)->update($tablename, $post);
    }

    public function update_sortorder_banner($data, $telco='') {
        $tablename = $this->getTableNameForTelco($telco);
        foreach ($data as $value) {
            $this->db->where('id', $value['id'])->limit(1)->update($tablename, array('sortorder' => $value['sortorder']));
        }
        return true;
    }

}
?>
