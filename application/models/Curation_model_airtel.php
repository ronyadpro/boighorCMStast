<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curation_model_airtel extends CI_Model {
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

    //
    //      PRIVATE FUNCTIONS ENDS
    //

    public function get_homedata_serverside($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $data['data'] = $this->db->order_by('sortorder', 'asc')->get_where('boighor_airtel.tblAppHomeBoighor', array('deleted'=>0, 'archived'=>0))->result();
        $data['recordsFiltered'] = sizeof($data['data']);//10;
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function get_homedata_archived($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $data['data'] = $this->db->order_by('sortorder', 'asc')->get_where('boighor_airtel.tblAppHomeBoighor', array('deleted'=>0, 'archived'=>1))->result();
        $data['recordsFiltered'] = sizeof($data['data']);//10;
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function update_sortorder_home($data) {
        foreach ($data as $value) {
            $this->db->where('catcode', $value['catcode'])->limit(1)->update('boighor_airtel.tblAppHomeBoighor', array('sortorder' => $value['pos']+1));
        }
        return true;
    }

    public function update_status_by_platform($data) {
        $this->db->where(array('catcode' => $data['catcode']))->limit(1)->update('boighor_airtel.tblAppHomeBoighor', array($data['platform'] => $data['status']));
        if (preg_match('/promo-/i', $data['catcode']) && $this->db->affected_rows()) {
            $promoid = substr($data['catcode'], 6);
            $this->db->limit(1)->where('id', $promoid)->update('boighor_airtel.tblPromo', array('status' => $data['status']));
            return $this->db->affected_rows();
        } else {
            return $this->db->affected_rows();
        }
    }

    public function archive_item($catcode) {
        $this->db->limit(1)->where('catcode',$catcode)->set(array('archived'=>1,'showitem'=>0,'showinapp'=>0,'sortorder'=>99))->update('boighor_airtel.tblAppHomeBoighor');
        return $this->db->affected_rows();
    }

    public function unarchive_item($catcode) {
        $this->db->limit(1)->where('catcode',$catcode)->set('archived',0)->update('boighor_airtel.tblAppHomeBoighor');
        return $this->db->affected_rows();
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
                    $data['data'] = $this->db->group_start()->where('category', $post['cat'])->where_in('bookcode', $genListArray)->group_end()->limit($post['length'], $post['start'])->get_where('tblBooks',array('status_global' => 1, 'isaudiobook' => $post['adb']))->result();
                    $data['recordsFiltered'] = $this->db->where('category', $post['cat'])->where_in('bookcode', $genListArray)->where(array('status_global' => 1, 'isaudiobook' => $post['adb']))->count_all_results('tblBooks');
                    $data['recordsTotal'] = $data['recordsFiltered'];
                } else {
                    $data['data'] = $this->db->group_start()->where('category', $post['cat'])->or_where_in('bookcode', $genListArray)->group_end()->limit($post['length'], $post['start'])->get_where('tblBooks',array('status_global' => 1, 'isaudiobook' => $post['adb']))->result();
                    $data['recordsFiltered'] = $this->db->where('category', $post['cat'])->or_where_in('bookcode', $genListArray)->where(array('status_global' => 1, 'isaudiobook' => $post['adb']))->count_all_results('tblBooks');
                    $data['recordsTotal'] = $data['recordsFiltered'];
                }
            } else {
                $data['data'] = array();
                $data['recordsFiltered'] = 0;
                $data['recordsTotal'] = $data['recordsFiltered'];
            }
        } else if(isset($post['cat']) && $post['cat']){
            if ($post['search']['value']) $this->db->group_start()->or_like('bookname', $post['search']['value'])->or_like('bookname_bn', $post['search']['value'])->or_like('writer', $post['search']['value'])->or_like('writer_bn', $post['search']['value'])->group_end();
            $data['data'] = $this->db->where('category', $post['cat'])->limit($post['length'], $post['start'])->get_where('tblBooks',array('status_global' => 1, 'isaudiobook' => $post['adb']))->result();
            $data['recordsFiltered'] = $this->db->where('category', $post['cat'])->where(array('status_global' => 1, 'isaudiobook' => $post['adb']))->count_all_results('tblBooks');
            $data['recordsTotal'] = $data['recordsFiltered'];
        } else {
            if ($post['search']['value']) $this->db->group_start()->or_like('bookname', $post['search']['value'])->or_like('bookname_bn', $post['search']['value'])->or_like('writer', $post['search']['value'])->or_like('writer_bn', $post['search']['value'])->group_end();
            $data['data'] = $this->db->limit($post['length'], $post['start'])->get_where('tblBooks',array('status_global' => 1, 'isaudiobook' => $post['adb']))->result();
            $data['recordsFiltered'] = $this->db->where(array('status_global' => 1, 'isaudiobook' => $post['adb']))->count_all_results('tblBooks');
            $data['recordsTotal'] = $data['recordsFiltered'];
        }
        return $data;
    }

    public function create_new_section($post) {
        $bookcodes = $post['bookcodes'];
        unset($post['bookcodes']);
        $this->db->insert('boighor_airtel.tblAppHomeBoighor', $post);
        foreach ($bookcodes as $key => $value) {
            $this->db->insert('boighor_airtel.tblAppBoighorHomeItems', array('bookcode' => $value, 'sectioncode' => $post['catcode'], 'addedby'=>$this->userinfo['username']));
        }
        return 1;
    }

    public function get_section_items_by_catcode($catcode) {

        $data = $this->db->select('catcode, catname, catname_bn, itemtype')->get_where('boighor_airtel.tblAppHomeBoighor', array('catcode' => $catcode))->row_array();
        switch ($data['itemtype']) {
            case 1:
                $data['books'] = $this->db->select('tb.bookcode, bookname, writer, bookcover_small')->where('sectioncode', $catcode)->join('tblBooks AS tb', 'boighor_airtel.tblAppBoighorHomeItems.bookcode = tb.bookcode', 'left outer')->order_by('boighor_airtel.tblAppBoighorHomeItems.sortorder')->get('boighor_airtel.tblAppBoighorHomeItems')->result_array();
                break;
            case 2:
                $data['books'] = $this->db->select('tb.bookcode, bookname, writer, bookcover_small')->where('sectioncode', $catcode)->join('tblBooks AS tb', 'boighor_airtel.tblAppBoighorHomeItems.bookcode = tb.bookcode', 'left outer')->order_by('boighor_airtel.tblAppBoighorHomeItems.sortorder')->get('boighor_airtel.tblAppBoighorHomeItems')->result_array();
                break;
            case 3:
                $data['authors'] = $this->db->select('ta.authorcode, author')->where('sectioncode', $catcode)->join('tblBookAuthor AS ta', 'tblAppBoighorHomeItems.bookcode = ta.authorcode', 'left outer')->order_by('sortorder')->get('boighor_airtel.tblAppBoighorHomeItems')->result_array();
                break;
            case 4:
                $data['authors'] = $this->db->select('ta.authorcode, author')->where('sectioncode', $catcode)->join('tblBookAuthor AS ta', 'boighor_airtel.tblAppBoighorHomeItems.bookcode = ta.authorcode', 'left outer')->order_by('sortorder')->get('boighor_airtel.tblAppBoighorHomeItems')->result_array();
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
            $this->db->where(array('bookcode' => $row['bookcode'], 'sectioncode' => $catcode))->limit(1)->update('boighor_airtel.tblAppBoighorHomeItems', array('sortorder' => $row['sortorder']));
        }
        return 1;
    }

    public function remove_section_item($post='') {
        return $this->db->limit(1)->delete('boighor_airtel.tblAppBoighorHomeItems', array('bookcode' => $post['bookcode'], 'sectioncode' => $post['catcode']));
    }

    public function add_section_item($post='') {
        $existcount = $this->db->where(array('bookcode' => $post['bookcode'], 'sectioncode' => $post['catcode']))->count_all_results('boighor_airtel.tblAppBoighorHomeItems');
        if ($existcount) {
            return 409;
        } else {
            $this->db->insert('boighor_airtel.tblAppBoighorHomeItems', array('bookcode' => $post['bookcode'], 'sectioncode' => $post['catcode'], 'addedby'=>$this->userinfo['username']));
            return $this->db->affected_rows();
        }

    }

    public function update_section_info($post='') {
        $bookcodes = $post['bookcodes'];
        unset($post['bookcodes']);
        foreach ($bookcodes as $sortorder => $bookcode) {
            $this->db->limit(1)->where(array('bookcode' => $bookcode, 'sectioncode' => $post['catcode']))->update('boighor_airtel.tblAppBoighorHomeItems', array('sortorder' => $sortorder));
        }
        // return;
        return $this->db->limit(1)->where(array('catcode' => $post['catcode']))->update('boighor_airtel.tblAppHomeBoighor', $post);
    }

    public function get_banner_items($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $data['data'] = $this->db->order_by('sortorder')->get_where('boighor_airtel.tblBanner', array('deleted' => 0))->result_array();
        $data['recordsFiltered'] = sizeof($data['data']);
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function add_banner_item($post) {
        return $this->db->insert('boighor_airtel.tblBanner', $post);
    }

    public function change_banner_item_status($id='', $status='') {
        return $this->db->limit(1)->where('id', $id)->update('boighor_airtel.tblBanner', array('status' => $status));
    }

    public function delete_banner_item($id='') {
        return $this->db->limit(1)->where('id', $id)->update('boighor_airtel.tblBanner', array('deleted' => 1));
    }

    public function update_banner_item($post='') {
        $bannerid = $post['bannerid'];
        unset($post['bannerid']);
        return $this->db->limit(1)->where('id', $bannerid)->update('boighor_airtel.tblBanner', $post);
    }

    public function update_sortorder_banner($data) {
        foreach ($data as $value) {
            $this->db->where('id', $value['id'])->limit(1)->update('boighor_airtel.tblBanner', array('sortorder' => $value['sortorder']));
        }
        return true;
    }

    //PROMO SECTION

    public function get_promo_items($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $data['data'] = $this->db->order_by('sortorder')->get_where('boighor_airtel.tblPromo', array('deleted' => 0))->result_array();
        $data['recordsFiltered'] = sizeof($data['data']);
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function add_promo_item($post) {
        $this->db->insert('boighor_airtel.tblPromo', $post);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows()) {
            $hometablearray = array('catcode'=>'promo-'.$insert_id,'catname'=>$post['title'],'catname_bn'=>$post['title'],'itemtype'=>'9','contentviewtype'=>'1');
            $this->db->insert('boighor_airtel.tblAppHomeBoighor', $hometablearray);
            return $this->db->affected_rows();
        } else {
            return 0;
        }
    }

    public function change_promo_item_status($id='', $status='') {
        $this->db->limit(1)->where('id', $id)->update('boighor_airtel.tblPromo', array('status' => $status));
        if ($this->db->affected_rows()) {
            $this->db->limit(1)->where('catcode', 'promo-'.$id)->update('boighor_airtel.tblAppHomeBoighor', array('status' => $status));
            return $this->db->affected_rows();
        } else {
            return 0;
        }
    }

    public function delete_promo_item($id='') {
        $this->db->limit(1)->where('id', $id)->update('boighor_airtel.tblPromo', array('deleted' => 1));
        if ($this->db->affected_rows()) {
            $this->db->limit(1)->where('catcode', 'promo-'.$id)->update('boighor_airtel.tblAppHomeBoighor', array('deleted' => 1));
            return $this->db->affected_rows();
        } else {
            return 0;
        }
    }

    public function update_promo_item($post='') {
        $promoid = $post['promoid'];
        unset($post['promoid']);
        return $this->db->limit(1)->where('id', $promoid)->update('boighor_airtel.tblPromo', $post);
    }

    public function update_sortorder_promo($data) {
        foreach ($data as $value) {
            $this->db->where('id', $value['id'])->limit(1)->update('boighor_airtel.tblPromo', array('sortorder' => $value['sortorder']));
        }
        return true;
    }

}
?>
