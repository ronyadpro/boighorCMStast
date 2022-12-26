<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    function get_dashboard_info($value='') {
        // $this->db->cache_on();
        $data['totalbooks'] = $this->db->where(array('hideit'=>0))->count_all_results('tblBooks');
        $data['totalauthors'] = $this->db->where('deleted', 0)->count_all_results('tblBookAuthor');
        $data['totalpublishers'] = $this->db->count_all_results('tblBookPublisher');
        $data['totalaudiobooks'] = $this->db->where(array('hideit'=>0, 'isaudiobook'=>1))->count_all_results('tblBooks');
        // $data['activeuser'] = $this->db->query("SELECT COUNT(DISTINCT(userid)) AS count FROM `tblApiLog` WHERE created >= NOW() - INTERVAL 10 MINUTE");
        // $this->db->cache_off();
		// $data['topbooks'] = $this->getTopDownloadHistory();
		// $data['toppurchase'] = $this->getTopPurchasedList();
		// $data['popularwriters'] = $this->getPopularWriterList();

        // $data['categoryChart'] = $this->db->select('tc.catname_en, COUNT(*) AS count')->from('tblBooks AS tb')->join('tblBookCategory AS tc', 'tc.catcode = tb.category', 'left')->group_by('tb.category')->order_by('count', 'DESC')->limit(12)->get()->result_array();
        // $data['genreChart'] = $this->db->select('tg.genre_en, COUNT(*) AS count')->from('tblBookGenreTagging AS tgt')->join('tblBookGenre AS tg', 'tg.genre_code = tgt.genrecode', 'left')->group_by('genrecode')->order_by('count', 'DESC')->limit(12)->get()->result_array();
        // $genreChart = $this->db->query("SELECT tg.genre_en, COUNT(*) AS count FROM tblBookGenreTagging AS tgt LEFT OUTER JOIN tblBookGenre AS tg ON tg.genre_code = tgt.genrecode GROUP BY genrecode ORDER BY COUNT(*) DESC LIMIT 10")->result();
        // $data['uploadChart'] = $this->db->query('SELECT DATE(dateofaddition) AS date, COUNT(*) AS count FROM tblBooks WHERE DATE(dateofaddition) between (CURDATE() - INTERVAL 3 MONTH ) and CURDATE() GROUP BY DATE(dateofaddition)')->result_array();
        // $data['priceChart'] = $this->db->query("SELECT (SELECT COUNT(*) FROM tblBooks WHERE isfree = 1 AND isOpen = 1) AS 'free', (SELECT COUNT(*) FROM tblBooks WHERE isfree = 1 AND isOpen = 0) AS 'Premium', (SELECT COUNT(*) FROM tblBooks WHERE isfree = 0) AS 'Paid'")->result_array();
        // $data['categoryChart'] = json_decode(json_encode($categoryChart), true);
        // $data['genreChart'] = json_decode(json_encode($genreChart), true);
        return $data;
    }

    function getBookHistory(){

        $this->db->where('category !=', 'cmx');
        $query = $this->db->get('tblBooks');

        if ($query->num_rows() > 0) {
            $data['totalbook'] = $query->num_rows();
        } else {
            $data['totalbook'] = 0;
        }

        $this->db->where('category', 'cmx');
        $query2 = $this->db->get('tblBooks');

        if ($query2->num_rows() > 0) {
            $data['totalcomics'] = $query2->num_rows();
        } else {
            $data['totalcomics'] = 0;
        }

        $query3 = $this->db->get('tblBookAuthor');

        if ($query3->num_rows() > 0) {
            $data['authors'] = $query3->num_rows();
        } else {
            $data['authors'] = 0;
        }

        $this->db->where('isfree', 1);
        $query4 = $this->db->get('tblBooks');

        if ($query4->num_rows() > 0) {
            $data['freebooks'] = $query4->num_rows();
        } else {
            $data['freebooks'] = 0;
        }

        return $data;
    }

    function getTopDownloadHistory(){

        $data = array();

        $this->db->cache_on();
        $query = $this->db->query('SELECT bookcode, COUNT(*) as count FROM tblBoiMelaSubscriberContentSelection WHERE bookcode IS NOT NULL GROUP BY bookcode ORDER BY count DESC LIMIT 10');
        $this->db->cache_off();

        if ($query->num_rows() > 0){
            foreach ($query->result() as $row){

                $bcode = $row->bookcode;

                $this->db->where('bookcode', $bcode);
                $query2 = $this->db->get('tblBooks');
                if ($query2->num_rows() > 0) {

                    //$data1['bookcode'] = $row->bookcode;
                    $data1['totalcount'] = $row->count;

                    foreach ($query2->result() as $row2){

                        $data1['bookname_bn'] = $row2->bookname_bn;
                        //$data1['writer_bn'] = $row2->writer_bn;
                        //$data1['category'] = $row2->category;
                        //$data1['cover'] = $row2->bookcover_small;
                    }
                    $data1['bookcode'] = $row->bookcode;

                }

                array_push($data, $data1);
            }
            return $data;
        } else {
            return $data;
        }

    }

    function getTopPurchasedList(){

        $data = array();

        $this->db->cache_on();
        $query = $this->db->query('SELECT bookcode,COUNT(*) as count FROM tblBoiMelaSubscriberContentSelection WHERE bookcode IS NOT NULL AND bookprice != 0 GROUP BY bookcode ORDER BY count DESC LIMIT 10');
        $this->db->cache_off();

        if ($query->num_rows() > 0){
            foreach ($query->result() as $row){

                $bcode = $row->bookcode;

                $this->db->where('bookcode', $bcode);
                $query2 = $this->db->get('tblBooks');
                if ($query2->num_rows() > 0) {

                    //$data1['bookcode'] = $row->bookcode;
                    $data1['totalcount'] = $row->count;

                    foreach ($query2->result() as $row2){

                        $data1['bookname_bn'] = $row2->bookname_bn;
                        //$data1['writer_bn'] = $row2->writer_bn;
                        //$data1['category'] = $row2->category;
                        //$data1['cover'] = $row2->bookcover_small;
                    }
                    $data1['bookcode'] = $row->bookcode;

                }

                array_push($data, $data1);
            }
            return $data;
        } else {
            return $data;
        }

    }

    function getPopularWriterList(){

        $data = array();

        $this->db->cache_on();
        $query = $this->db->query('SELECT var1,COUNT(*) as count FROM tblPageHitLog_bookapp WHERE pagename = "bookview" GROUP BY var1 ORDER BY count DESC LIMIT 10');
        $this->db->cache_off();

        if ($query->num_rows() > 0){
            foreach ($query->result() as $row){

                $bcode = $row->var1;

                $this->db->where('bookcode', $bcode);
                $query2 = $this->db->get('tblBooks');
                if ($query2->num_rows() > 0) {

                    //$data1['bookcode'] = $row->bookcode;
                    $data1['totalcount'] = $row->count;

                    foreach ($query2->result() as $row2){

                        //$data1['bookname_bn'] = $row2->bookname_bn;
                        $data1['writer_bn'] = $row2->writer_bn;
                        //$data1['category'] = $row2->category;
                        //$data1['cover'] = $row2->bookcover_small;
                        $data1['writercode'] = $row2->writercode;
                    }

                }

                array_push($data, $data1);
            }
            return $data;
        } else {
            return $data;
        }

    }

    function get_last_upload_list($limit=10) {

        $this->db->select('*')->select('(SELECT catname_bn FROM tblBookCategory where catcode = tblBooks.category LIMIT 1) AS category_bn');
        $returnData = $this->db->limit($limit)->order_by('dateofaddition','desc')->get('tblBooks')->result_array();
        foreach ($returnData as $key => $book) {

            $log = $this->db->group_start()->where('whatyoudid','changed globalstatus To 1')->like('request','"status":"1","bookcode":"'.$book['bookcode'].'"')->group_end()
            ->or_group_start()->where('whatyoudid','changed statuses - '.$book['bookcode'])->like('request','"status_global":"1"')->group_end()
            ->order_by('timeofentry')->limit(1)->get('tblLogCms')->row_array();
            if (!empty($log)) {
                $returnData[$key]['livetime'] = $log['timeofentry'];
                $returnData[$key]['liveby'] = $log['usr'];
            } else {
                $returnData[$key]['livetime'] = '-';
                $returnData[$key]['liveby'] = '-';
            }
        }
        return $returnData;
    }
}
?>
