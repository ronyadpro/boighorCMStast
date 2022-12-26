<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gpreport_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_all_promocodes() {
        return $this->db->get('boighor.tblPromoCode')->result_array();
    }

    public function get_all_licensers() {
        return $this->db->select('licensername_en, licensertype, licensercode')->get('tblBookLicenser')->result_array();
    }

    public function get_subscription_report($post) {

        $this->db->select('msisdn,virtualid,subid,packname,actualsubdatetime');
        if ($post['date_from'] && $post['date_to']) $this->db->where('DATE(gpboighor.tblBoiMelaSubscriptionDetails_log.logtime) >=',$post['date_from'])->where('DATE(gpboighor.tblBoiMelaSubscriptionDetails_log.logtime) <=',$post['date_to']);
        $this->db->order_by('created', 'desc');
        $data = $this->db->get('gpboighor.tblBoiMelaSubscriptionDetails_log')->result();
        return $data;

        return $data;
    }

    public function get_revenue_report($post) {
        $this->db->select('*');
        if ($post['licensertype']=='author') $this->db->where('boighor.tblOrderDetails.writercode',$post['licensercode'])->where('boighor.tblOrderDetails.publishercode','');
        if ($post['licensertype']=='publisher') $this->db->where('boighor.tblOrderDetails.publishercode',$post['licensercode']);
        if ($post['isexclusive']!=='') $this->db->where('ebswap.tblBooks.isexclusive',$post['isexclusive']);
        if ($post['date_from'] && $post['date_to']) $this->db->where('DATE(boighor.tblPaymentNotification.timeofentry) >=',$post['date_from'])->where('DATE(boighor.tblPaymentNotification.timeofentry) <=',$post['date_to']);
        $this->db->where("paymentStatus","CHARGED");
        $this->db->where('boighor.tblOrderDetails.promocode <> "LALCHALK"');
        $this->db->order_by('created', 'desc');
        $this->db->join('ebswap.tblBooks','ebswap.tblBooks.bookcode = boighor.tblOrderDetails.bookcode');
        $this->db->join('boighor.tblPaymentNotification','boighor.tblPaymentNotification.orderId = boighor.tblOrderDetails.orderid', 'inner');
        $data = $this->db->get('boighor.tblOrderDetails')->result();
        return $data;
    }

    public function get_daily_book_sale($duration=30) {
        // $this->db->cache_on();
        $data = $this->db->query(
            'SELECT COUNT(p.orderId) AS count, DATE_FORMAT(b.Days, "%b-%e") AS date
            FROM (SELECT a.Days
                FROM (
                    SELECT curdate() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS Days
                    FROM       (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                    CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                    CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                ) a
            WHERE a.Days >= curdate() - INTERVAL 30 DAY) b

            LEFT JOIN boighor.tblOrderDetails AS o
            ON DATE(created) = b.Days

            LEFT OUTER JOIN boighor.tblPaymentNotification AS p
            ON p.orderId = o.orderid AND p.paymentStatus = "CHARGED"

            GROUP BY DATE(b.Days)
            ORDER BY b.Days'
        )->result_array();
        // $this->db->cache_off();
        return $data;
    }

    public function get_daily_sale_amount($duration=30) {
        // $this->db->cache_on();
        $data = $this->db->query(
            'SELECT
            IFNULL(SUM(
                IF(p.charged=0.99, 80.00, IF(p.charged=1.49, 120.00, IF(p.charged=1.99, 150.00, IF(p.charged=2.49, 220.00, IF(p.charged=2.99, 250.00, IF(p.charged=3.49, 300.00, IF(p.charged=3.99, 350.00, IF(p.charged=4.49, 390.00, IF(p.charged=4.99, 420.00, IF(p.charged=5.49, 450.00, IF(p.charged=5.99, 500.00, p.charged)))))))))))
            ),0) AS count,
            DATE_FORMAT(b.Days, "%b-%e") AS date
            FROM (SELECT a.Days
                FROM (
                    SELECT curdate() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS Days
                    FROM       (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                    CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                    CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                ) a
                WHERE a.Days >= curdate() - INTERVAL 30 DAY) b

                LEFT OUTER JOIN boighor.tblPaymentNotification AS p
                ON DATE(p.timeofentry) = b.Days AND p.paymentStatus = "CHARGED"

                GROUP BY DATE(b.Days)
                ORDER BY b.Days'
                )->result_array();
        // $this->db->cache_off();
        return $data;
    }

    public function get_monthly_sale_amount($duration=12) {
        // $this->db->select("DATE_FORMAT(timeofentry, '%M') AS month");
        // $this->db->select("IFNULL(SUM( IF(amount=0.99, 80, IF(amount=1.49, 120, IF(amount=1.99, 150, IF(amount=2.49, 220, IF(amount=2.99, 250, IF(amount=3.49, 300, IF(amount=3.99, 350, IF(amount=4.49, 390, IF(amount=4.99, 420, IF(amount=5.49, 450, IF(amount=5.99, 500, amount))))))))))) ),0) AS count");
        // $this->db->where("paymentStatus","CHARGED");
        // $this->db->where("timeofentry >= '2021-03-18 00:00:00'");
        // $this->db->where("timeofentry >= curdate() - INTERVAL $duration MONTH");
        // $this->db->group_by('MONTH(timeofentry)');
        // $this->db->order_by('YEAR(timeofentry)')->order_by('MONTH(timeofentry)');
        // $data = $this->db->get('boighor.tblPaymentNotification')->result_array();
        // return $data;

        $data = array();
        $month = date('m');
        $year = date('Y');
        for ($i=0; $i<$duration; $i++) {
            $this->db->select("DATE_FORMAT(timeofentry, '%M') AS month");
            $this->db->select("IFNULL(SUM( IF(amount=0.99, 80, IF(amount=1.49, 120, IF(amount=1.99, 150, IF(amount=2.49, 220, IF(amount=2.99, 250, IF(amount=3.49, 300, IF(amount=3.99, 350, IF(amount=4.49, 390, IF(amount=4.99, 420, IF(amount=5.49, 450, IF(amount=5.99, 500, amount))))))))))) ),0) AS count");
            $this->db->where("paymentStatus","CHARGED");
            $this->db->where("timeofentry >= '2021-03-18 00:00:00'");
            $this->db->where("timeofentry >= '$year-$month-01 00:00:00'");
            $this->db->where("timeofentry <= '$year-$month-31 23:59:59'");
            // $this->db->group_by('MONTH(timeofentry)');
            // $this->db->order_by('YEAR(timeofentry)')->order_by('MONTH(timeofentry)');
            $row = $this->db->get('boighor.tblPaymentNotification')->row_array();
            array_push($data, $row);
            $month--;
            if ($month==0) {
                $month=12;
                $year--;
            }
            if ($year==2021 && $month==2) {
                $i=$duration;
            }
        }
        $data=array_reverse($data,true);
        return $data;
    }

    public function get_this_month_sale_amount() {
        $data = $this->db->select('charged')->where("paymentStatus","CHARGED")->where('MONTH(timeofentry) = MONTH(CURRENT_DATE())')->where('YEAR(timeofentry) = YEAR(CURRENT_DATE())')->get('boighor.tblPaymentNotification')->result_array();
        $data = array_column($data, 'charged');
        foreach ($data as $key => $value) {
            switch ($value) {
                case '0.99':
                    $data[$key] = '80';
                    break;

                case '1.49':
                    $data[$key] = '120';
                    break;

                case '1.99':
                    $data[$key] = '150';
                    break;

                case '2.49':
                    $data[$key] = '220';
                    break;

                case '2.99':
                    $data[$key] = '250';
                    break;

                case '3.49':
                    $data[$key] = '300';
                    break;

                case '3.99':
                    $data[$key] = '350';
                    break;

                case '4.49':
                    $data[$key] = '390';
                    break;

                case '4.99':
                    $data[$key] = '420';
                    break;

                case '5.49':
                    $data[$key] = '450';
                    break;

                case '5.99':
                    $data[$key] = '500';
                    break;

                default:
                    break;
            }
        }
        return array_sum($data);
    }

    public function get_social_login_pie_chart_data() {
        // $this->db->cache_on();
        $this->db->select('IFNULL(loginsrc, "msisdn") AS loginsrc, COUNT(*) AS count');
        // $this->db->where('loginsrc IS NOT NULL');
        $this->db->order_by('loginsrc');
        $this->db->group_by("CASE
               WHEN loginsrc = 'facebook' THEN 'facebook'
               WHEN loginsrc = 'google' THEN 'google'
               ELSE 'Mobile No.'
           END");
        $data = $this->db->get('boighor.tblBoiMelaSubscriptionDetails')->result_array();
        $this->db->cache_off();
        return $data;
    }

    public function get_login_source_pie_chart_data() {
        $this->db->select('IF(signupfrom="ebs", "campaign", signupfrom) AS signupfrom, COUNT(*) AS count');
        $this->db->order_by("CASE
               WHEN signupfrom = 'app' THEN 0
               WHEN signupfrom = 'web' THEN 1
               WHEN signupfrom = 'ghoori' THEN 2
               WHEN signupfrom = 'ebs' THEN 3
               ELSE signupfrom
           END");
        $data = $this->db->group_by('signupfrom')->get('boighor.tblBoiMelaSubscriptionDetails')->result_array();
        return $data;
    }

    public function get_top_author_pie_chart_data($duration=7) {
        $this->db->select("boighor.tblOrderDetails.writername AS author, COUNT(*) AS count");
        $this->db->where("DATE(timeofentry) > curdate() - INTERVAL 7 DAY");
        $this->db->group_by("boighor.tblOrderDetails.writercode");
        $data = $this->db->join('boighor.tblPaymentNotification','boighor.tblPaymentNotification.orderId = boighor.tblOrderDetails.orderid', 'inner')->get('boighor.tblOrderDetails')->result_array();
        $count = array_column($data, 'count');
        array_multisort($count, SORT_DESC, $data);
        $data = array_slice($data, 0, 5);
        return $data;
        //==================================================================
        // $data = array();
        // // NOTE: first get unique writers in date range
        // $writers = $this->db->select("writer, writercode")->where("DATE(created) > curdate() - INTERVAL 7 DAY")->group_by("writercode")->get('boighor.tblBookDownloadLog')->result_array();
        // $writercodes = array_column($writers, "writercode");
        // // NOTE: get count for each writer in that date range
        // foreach ($writercodes as $key => $writercode) {
        //     $this->db->where('writercode',$writercode)->where("DATE(created) > curdate() - INTERVAL 7 DAY");
        //     $count = $this->db->group_by('msisdn')->group_by('bookcode')->count_all_results("boighor.tblBookDownloadLog");
        //     $index_array = array('author'=>$writers[$key]['writer'],'count'=>$count);
        //     array_push($data,$index_array);
        // }
        // $count = array_column($data, 'count');
        //
        // array_multisort($count, SORT_DESC, $data);
        // $data = array_slice($data, 0, 5);
        // // $data = sort($data);
        // // $this->db->select('writer AS author, COUNT(DISTINCT(bookcode)) AS count');
        // // $this->db->where("created >= curdate() - INTERVAL 7 DAY");
        // // $data = $this->db->order_by('COUNT(*)','DESC')->group_by('writercode')->limit(5)->get('boighor.tblBookDownloadLog')->result_array();
        // return $data;
    }

    public function get_top_genre_pie_chart_data($duration=7) {
        $this->db->select("ebswap.tblBookGenreTagging.genrecode AS genrecode, COUNT(*) AS count");
        $this->db->where("paymentStatus","CHARGED");
        $this->db->where("DATE(timeofentry) > curdate() - INTERVAL 7 DAY");
        $this->db->group_by("ebswap.tblBookGenreTagging.genrecode");
        $this->db->join('ebswap.tblBookGenreTagging','ebswap.tblBookGenreTagging.bookcode = boighor.tblOrderDetails.bookcode', 'inner');
        $this->db->join('boighor.tblPaymentNotification','boighor.tblPaymentNotification.orderId = boighor.tblOrderDetails.orderid', 'inner');
        $data = $this->db->get('boighor.tblOrderDetails')->result_array();
        $count = array_column($data, 'count');
        array_multisort($count, SORT_DESC, $data);
        $data = array_slice($data, 0, 5);
        foreach ($data as $key => $row) {
            $data[$key]['genre_en'] = $this->db->limit(1)->get_where('tblBookGenre', array('genre_code'=>$data[$key]['genrecode']))->row_array()['genre_en'];
        }
        return $data;
    }

    public function get_top_country_pie_chart_data($duration=7) {
        $this->db->select("boighor.tblPaymentNotification.countryname AS country, COUNT(DISTINCT(boighor.tblPaymentNotification.orderId)) AS count");
        $this->db->where("paymentStatus","CHARGED");
        $this->db->where("DATE(timeofentry) > curdate() - INTERVAL 30 DAY");
        $this->db->group_by("boighor.tblPaymentNotification.countrycode");
        $this->db->order_by("count","DESC");
        $this->db->join('boighor.tblPaymentNotification','boighor.tblPaymentNotification.orderId = boighor.tblOrderDetails.orderid', 'inner');
        $this->db->join('boighor.tblCountryName','boighor.tblCountryName.countrycode = boighor.tblPaymentNotification.countrycode');
        $data = $this->db->get('boighor.tblOrderDetails')->result_array();
        return $data;
    }

    public function get_top_book_pie_chart_data($duration=7) {
        $this->db->select("boighor.tblOrderDetails.bookname AS bookname, COUNT(*) AS count");
        $this->db->select("IFNULL(SUM( IF(sellingprice=0.99, 80, IF(sellingprice=1.49, 120, IF(sellingprice=1.99, 150, IF(sellingprice=2.49, 220, IF(sellingprice=2.99, 250, IF(sellingprice=3.49, 300, IF(sellingprice=3.99, 350, IF(sellingprice=4.49, 390, IF(sellingprice=4.99, 420, IF(sellingprice=5.49, 450, IF(sellingprice=5.99, 500, sellingprice))))))))))) ),0) AS amount");
        $this->db->where("DATE(timeofentry) > curdate() - INTERVAL 7 DAY");
        $this->db->where("paymentStatus","CHARGED");
        $this->db->group_by("boighor.tblOrderDetails.bookcode");
        $this->db->order_by("count","desc");
        $this->db->order_by("amount","desc");
        $this->db->limit(5);
        $data = $this->db->join('boighor.tblPaymentNotification','boighor.tblPaymentNotification.orderId = boighor.tblOrderDetails.orderid', 'inner')->get('boighor.tblOrderDetails')->result_array();
        // $count = array_column($data, 'count');
        // array_multisort($count, SORT_DESC, $data);
        // $data = array_slice($data, 0, 10);
        return $data;
    }

    public function get_top_paymethod_pie_chart_data($duration=30) {
        $this->db->select("paymentmethod, COUNT(*) AS count");
        $this->db->where("paymentStatus","CHARGED");
        $this->db->where("DATE(timeofentry) > curdate() - INTERVAL 30 DAY");
        $this->db->group_by("paymentmethod");
        $this->db->order_by("COUNT(*)","DESC");
        $data = $this->db->get('boighor.tblPaymentNotification')->result_array();
        // $count = array_column($data, 'count');
        // array_multisort($count, SORT_DESC, $data);
        // $data = array_slice($data, 0, 5);
        return $data;
    }

    public function get_top_platform_pie_chart_data($duration=30) {
        $this->db->select("signupfrom, COUNT(*) AS count");
        $this->db->where("DATE(signupdate) > curdate() - INTERVAL 30 DAY");
        $this->db->group_by("signupfrom");
        $data = $this->db->get('boighor.tblBoiMelaSubscriptionDetails')->result_array();
        return $data;
    }

    public function get_ebook_vs_adb() {
        // $this->db->cache_on();
        $this->db->select('IF(isaudiobook=0, "eBook", "AudioBook") AS type, COUNT(*) AS count');
        $this->db->order_by('isaudiobook','desc')->group_by('isaudiobook');
        $data =  $this->db->where('status_global',1)->get('tblBooks')->result_array();
        $this->db->cache_off();
        return $data;
    }

    public function get_price_pie_chart_data() {
        // $this->db->cache_on();
        $this->db->select('bookprice_bn, COUNT(*) AS count');
        $this->db->where('(SELECT status_global FROM tblBooks WHERE tblBooks.bookcode = tblBookPriceTagging.bookcode LIMIT 1) = 1');
        $this->db->join('tblBookPrice', 'tblBookPrice.id = tblBookPriceTagging.global_bdt');
        $data = $this->db->order_by('sortorder')->group_by('global_bdt')->get('tblBookPriceTagging')->result_array();
        $this->db->cache_off();
        return $data;
    }

    public function get_category_pie_chart_data() {
        // $this->db->cache_on();
        $this->db->select('tblBookCategory.catname_bn AS category_bn, COUNT(*) AS count');
        $this->db->where('status_global',1);
        $this->db->join('tblBookCategory','tblBookCategory.catcode = tblBooks.category');
        $data = $this->db->group_by('category')->get('tblBooks')->result_array();
        $this->db->cache_off();
        return $data;
    }

    public function get_genre_pie_chart_data() {
        // $this->db->cache_on();
        $this->db->select('tblBookGenre.genre_bn, COUNT(*) AS count');
        $this->db->where('(SELECT status_global FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode LIMIT 1) = 1');
        $this->db->join('tblBookGenre', 'tblBookGenre.genre_code = tblBookGenreTagging.genrecode');
        $data = $this->db->order_by('count','desc')->order_by('tblBookGenre.created','desc')->group_by('genrecode')->limit(15)->get('tblBookGenreTagging')->result_array();
        $this->db->cache_off();
        return $data;
    }

    function getTopDownloadHistory(){
        $this->db->select('"1" AS sl, bookcode, nametoshow, COUNT(*) AS totalcount');
        $this->db->where('DATE(timeofentry) > "2021-03-17"');
        $this->db->group_by('bookcode');
        $this->db->order_by('COUNT(*)', 'desc');
        $data = $this->db->limit(50)->get('boighor.tblBoiMelaSubscriberContentSelection')->result_array();
        return $data;
    }

    function getTopPurchasedList(){
        $this->db->select('"1" AS sl, bookcode, bookname, COUNT(*) AS totalcount');
        $this->db->where("paymentStatus","CHARGED");
        $this->db->where('DATE(tblPaymentNotification.timeofentry) > "2021-03-17"');
        $this->db->join('boighor.tblPaymentNotification','boighor.tblPaymentNotification.orderId = boighor.tblOrderDetails.orderid', 'inner');
        $this->db->group_by('bookcode');
        $this->db->order_by('COUNT(*)', 'desc');
        $data = $this->db->limit(50)->get('boighor.tblOrderDetails')->result_array();
        return $data;
    }

    function getTopUserList(){
        $this->db->select('"1" AS sl, boighor.tblBoiMelaSubscriberContentSelection.msisdn, fullname AS username, COUNT(*) AS totalcount');
        $this->db->where("bookprice > 0");
        // $this->db->where('DATE(tblBoiMelaSubscriptionDetails.timeofentry) > "2021-03-17"');
        $this->db->join('boighor.tblBoiMelaSubscriptionDetails','boighor.tblBoiMelaSubscriptionDetails.msisdn = boighor.tblBoiMelaSubscriberContentSelection.msisdn', 'inner');
        $this->db->group_by('msisdn');
        $this->db->order_by('COUNT(*)', 'desc');
        $data = $this->db->limit(50)->get('boighor.tblBoiMelaSubscriberContentSelection')->result_array();
        return $data;
    }

    function getPopularWriterList(){
        $this->db->select('"1" AS sl, writercode, writername AS writer_bn, COUNT(*) AS totalcount');
        $this->db->where("paymentStatus","CHARGED");
        $this->db->where('DATE(tblPaymentNotification.timeofentry) > "2021-03-17"');
        $this->db->join('boighor.tblPaymentNotification','boighor.tblPaymentNotification.orderId = boighor.tblOrderDetails.orderid', 'inner');
        $this->db->group_by('writercode');
        $this->db->order_by('COUNT(*)', 'desc');
        $data = $this->db->limit(50)->get('boighor.tblOrderDetails')->result_array();
        return $data;
    }

    function getFreeBookDownloadList(){

        $data = array();

        // $this->db->cache_on();
        $query = $this->db->query('SELECT b.Days AS edate,  COUNT(contentid) AS enumbers
            FROM (SELECT a.Days
                FROM (
                    SELECT curdate() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS Days
                    FROM       (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                    CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                    CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                ) a
            WHERE a.Days > curdate() - INTERVAL 50 DAY) b

            LEFT JOIN (
                SELECT username, contentid, comment, timeofentry FROM boighor.tblBoiMelaContentComment AS c
                LEFT JOIN ebswap.tblBookPriceTagging AS p ON p.bookcode = c.contentid
                WHERE p.global_bdt = 16 AND (c.comment = "download successful" OR c.comment = "download success")
            ) AS t ON DATE(t.timeofentry) = b.Days GROUP BY DATE(b.Days) ORDER BY edate DESC');
        $this->db->cache_off();

        if ($query->num_rows() > 0){
            foreach ($query->result() as $row){

                $data1['date_no'] = $row->edate;
                $data1['totalcount'] = $row->enumbers;
                array_push($data, $data1);
            }
        }

        return $data;
    }

    public function getFreeBookDownloadListForDate($date) {
        $query = $this->db->query(
            'SELECT b.bookcode, b.bookname, b.bookname_bn, b.writercode, b.writer, b.writer_bn, COUNT(*) AS count
            FROM boighor.tblBoiMelaContentComment AS c
            JOIN ebswap.tblBookPriceTagging AS p ON p.bookcode = c.contentid
            JOIN ebswap.tblBooks AS b ON b.bookcode = c.contentid
            WHERE p.global_bdt = 16 AND (c.comment = "download successful" OR c.comment = "download success") AND DATE(c.timeofentry) = "'.$date.'"
            GROUP BY b.bookcode  ORDER BY count DESC')->result_array();
        return $query;
    }

    public function get_mou_report($post) {
        $data['start'] = 0;//$post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $serchkey = $post['search']['value'];

        $this->db->select('boighor.tblContentPlayLog.msisdn AS msisdn, boighor.tblContentPlayLog.adbid AS adbid, ebswap.tblBookAudios.bookcode AS bookcode, ebswap.tblBookAudios.title AS title, ebswap.tblBookAudios.title_bn AS title_bn, ebswap.tblBooks.bookname AS bookname, ebswap.tblBooks.writercode AS writercode, ebswap.tblBooks.writer AS writer, ebswap.tblBooks.writer_bn AS writer_bn, ebswap.tblBookAudios.filelength AS filelength, SUM(LEAST(playtime,playposition)) AS total_usage_in_seconds, COUNT(*) AS hitcount');
        if ($post['publishercode']) $this->db->where('ebswap.tblBooks.publishercode',$post['publishercode']);
        $this->db->where('DATE(pagehittime) >=',$post['date_from'])->where('DATE(pagehittime) <=',$post['date_to']);
        $this->db->join('ebswap.tblBookAudios','ebswap.tblBookAudios.id = boighor.tblContentPlayLog.adbid');
        $this->db->join('ebswap.tblBooks','ebswap.tblBooks.bookcode = boighor.tblContentPlayLog.bookcode');
        $data['data'] = $this->db->order_by("total_usage_in_seconds","desc")->group_by('bookcode')->group_by('adbid')->get('boighor.tblContentPlayLog')->result();

        // if ($post['date_from'] && $post['date_to']) $this->db->where('DATE(timeofentry) >=',$post['date_from'])->where('DATE(timeofentry) <=',$post['date_to']);
        // if ($post['publishercode']) $this->db->where('ebswap.tblBooks.publishercode');
        // $this->db->join('boighor.tblPaymentNotification','boighor.tblPaymentNotification.orderId = boighor.tblOrderDetails.orderid', 'inner');
        $data['recordsFiltered'] = sizeof($data['data']);
        $data['recordsTotal'] = $data['recordsFiltered'];
        //  JSON
        // $data['json'] = array_column($data['data'],'writercode');
        return $data;
    }

    public function cache_clean() {
        $this->db->cache_delete_all();
    }

}
?>
