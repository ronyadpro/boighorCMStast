<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DB_manipulate_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function run_query() {
        // echo "no-func";
        $this->update_filename();
    }

    private function update_filename() {

        // $oldname = "/var/www/html/ebswap/_oljkz/00591ec4.epub";
        // $newname = "/var/www/html/ebswap/_oljkz/00591ec4---.epub";
        // if (file_exists($oldname)) {
        //     if (rename($oldname,$newname)) {
        //         echo "1 <br>";
        //     } else {
        //         echo "error <br>";
        //     }
        // }
        // // echo "query_func_reached";
        // $bookcode_list = $this->db->select('bookid, bookcode, filename, filename_old')->where('filename IS NOT NULL')->where("filename <> ''")->get('tblBooks')->result_array();
        // // var_dump($bookcode_list);
        // foreach ($bookcode_list as $key => $book) {
        //     $oldname = "/var/www/html/ebswap/_oljkz/".$book['filename'];
        //     $newname = "/var/www/html/ebswap/_oljkz/".$book['filename_old'];
        //     if (file_exists($oldname)) {
        //         // $new_filename = $book['bookcode'].$this->RandomString(12).'.epub';
        //         // echo "$key -> ".$book['bookcode']." -> ".$book['filename']." -> $new_filename <br>";
        //         // $this->db->set('filename_old',$new_filename)->where('bookcode',$book['bookcode'])->limit(1)->update('tblBooks');
        //         if (rename($oldname,$newname)) {
        //             echo "1 <br>";
        //         } else {
        //             echo "error <br>";
        //         }
        //     }
        // }
        // echo "query done";
    }

    private function RandomString($length=0) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring .= $characters[rand(0, strlen($characters)-1)];
        }
        return $randstring;
    }

}
?>
