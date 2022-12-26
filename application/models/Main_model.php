<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    function getBaseUrl()
    {
        return $this->config->item('api_url');
    }

    function validateUser($username,$password){

        $this->db->where('email', $username);
        $this->db->where('oldpass', $password);
        $this->db->where('level >', 0);
        $query = $this->db->get('tblAuthUsers');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data['result']= 'success';
                $data['id']= $row->id;
                $data['usr']= $row->usr;
                $data['name']= $row->fullname;
                $data['email']= $row->email;
                $data['level']= $row->level;
                $data['iplock']= $row->iplock;
                $data['regIP']= $row->regIP;
                $data['allowedip']= $row->allowedip;
            }
        } else {
            $data['result']= 'fail';
        }

        return $data;
    }

    function postLogs($data) {
        if ($data['request'] != '[]') {
            $this->db->insert('tblLogCms', $data);
        }
    }

    public function get_log_timeline($username, $date, $date_to, $level, $bookcode='') {
        if ($level == 6) { // developers+managers
            // $logs = $this->db->limit(50)->order_by('timeofentry', 'desc')->get_where('tblLogCms', array('date' => date_format(date_create("-1"),"Y-m-d")))->result();
            if ($username) {
                $this->db->where('usr', $username);
            }
            if ($bookcode) {
                $this->db->like('whatyoudid', $bookcode);
            }
            if ($date == $date_to) {
                $this->db->where('date', $date);
            } else {
                $this->db->where('date >=', $date)->where('date <=', $date_to);
            }
            $logs = $this->db->order_by('timeofentry', 'desc')->get('tblLogCms')->result();
        } else {
            $logs = $this->db->order_by('timeofentry', 'desc')->get_where('tblLogCms', array('usr' => $username, 'date' => $date))->result();
        }
        return $logs;
    }

    public function search($keyword) {
        $response = $this->db->select('code')->order_by('tagtype')->group_by('code')->like('tags', $keyword)->get('tblBookTagging')->result();
        $tagRes = array();
        $genres = array();
        foreach ($response as $row) {
            array_push($tagRes, $row->code);
            if (strlen($row->code) == 3) {
                array_push($genres, $row->code);
            }
        }
        if ($tagRes) {
            $data = $this->db->select('bookname, writer')->where_in('bookcode', $tagRes)->or_where_in('writercode', $tagRes)->or_where_in('category', $tagRes)->get('tblBooks')->result();
            $genRes = $this->db->select('bookcode')->group_by('bookcode')->where_in('genrecode', $tagRes)->get('tblBookGenreTagging')->result();
            $genResArr = array();
            foreach ($genRes as $row) {
                array_push($genResArr, $row->bookcode);
            }
            if ($genResArr) {
                $dataGenre = $this->db->select('bookname, writer')->where_in('bookcode', $genResArr)->get('tblBooks')->result();
                return array_merge($data, $dataGenre);
            } else {
                return $data;
            }
        } else {
            return array();
        }
    }
}
?>
