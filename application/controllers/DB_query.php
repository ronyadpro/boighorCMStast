<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DB_query extends CMS_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('DB_manipulate_model');
    }

    public function index() {
        echo ">_<";
    }

    public function run_query() {
        $this->DB_manipulate_model->run_query();
        // $bookcode = $this->input->get('bookcode', TRUE);
        // $filename = $bookcode.'.epub';
        //
        // header("Content-Type: application/octet-stream");
        // header('Content-Length: '.filesize('/var/www/html/ebswap/_sr2z_bfiles/'.$filename));
        // header('Content-Disposition: attachment; filename="'.$filename.'"');
        // header('X-Pad: avoid browser bug');
        // header('Cache-Control: no-cache');
        // readfile('/var/www/html/ebswap/_sr2z_bfiles/'.$filename);

    }

}
