<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Author_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_authorlist() {
        return $this->db->where('deleted', 0)->order_by('author', 'asc')->get('tblBookAuthor')->result_array();
    }

    function get_authorlist_serverside($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $order_col = (isset($post['columns']) && isset($post['order'])) ? $post['columns'][$post['order'][0]['column']]['data'] : 'authorcode';
        $order_dir = isset($post['order']) ? $post['order'][0]['dir'] : 'ASC';
        $this->db->where('deleted', '0');
        if ($post['search']['value']) {
            $this->db->group_start()->or_like('author_bn', $post['search']['value'])->or_like('author', $post['search']['value'])->group_end();
        }
        $data['data'] = $this->db->order_by($order_col, $order_dir)->limit($post['length'], $post['start'])->get('tblBookAuthor')->result();
        $data['recordsFiltered'] = $this->db->where('deleted', '0')->count_all_results('tblBookAuthor');
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function get_author_details($authorcode)  {
        $data = $this->db->get_where('tblBookAuthor', "authorcode = '$authorcode'")->row();
        $tags = $this->db->select('tags')->from('tblBookTagging')->where('code', $authorcode)->where('tagtype', 1)->get()->result();
        $tag_string_arr = array();
        foreach ($tags as $row) {
            array_push($tag_string_arr, $row->tags);
        }
        $data->tags = $tag_string_arr;
        $data->followers = $this->db->where('authorcode',$authorcode)->where('deleted',0)->count_all_results('tblBookAuthorFollow');
        return get_object_vars($data);;
    }

    public function update_authorInfo_by_authorcode($authorcode, $data) {
        return $this->db->where('authorcode', $authorcode)->limit(1)->update('tblBookAuthor', $data);
    }

    public function update_authorTags_by_authorcode($authorcode, $data) {
        // $tags = $this->db->select('bookcode')->group_by('bookcode')->get('tblBookTagging')->result();
        // foreach ($tags as $row) {
        //     $authorcode = $this->db->select('writercode')->from('tblBooks')->where('bookcode', $row->bookcode)->get()->row()->writercode;
        //     $this->db->where('bookcode', $row->bookcode)->update('tblBookTagging', array('authorcode' => $authorcode));
        // }
    }

    public function add_new_author($data) {
        $authorid = $this->db->query("SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'boighor' AND   TABLE_NAME   = 'tblBookAuthor'")->row()->AUTO_INCREMENT;
        $authorcode = "A".str_pad(strtoupper(dechex(intval($authorid)+1000)), 4, '0', STR_PAD_LEFT);
        $data['authorcode'] = $authorcode;
        $resp = $this->db->insert('tblBookAuthor', $data);
        if ($resp) {
            return $authorcode;
        } else {
            return 0;
        }

    }
    // function generateAuthorCode() {
    //     $authors = $this->db->get('tblBookAuthor')->result();
    //     $authorcodes = [];
    //     foreach ($authors as $row) {
    //         $authorid = $row->authorid;
    //         $authorcode = "A".str_pad(strtoupper(dechex(intval($authorid)+1000)), 4, '0', STR_PAD_LEFT);
    //         $this->db->where('authorid', $authorid)->limit(1)->update('tblBookAuthor', array('authorcode' => $authorcode));
    //     }
    //     return $authorcodes;
    // }

    ////////////////////////////////
    // public function update_bookCount() {
    //     $authors = $this->db->select('authorcode')->get('tblBookAuthor')->result();
    //     foreach ($authors as $row) {
    //         $authorcode = $row->authorcode;
    //         $bookCount = $this->db->from('tblBooks')->where('writercode', $authorcode)->count_all_results();
    //         $this->db->where('authorcode', $authorcode)->limit(1)->update('tblBookAuthor', array('numberofbooks' => $bookCount));
    //     }
    //     return 1;
    // }
}
?>
