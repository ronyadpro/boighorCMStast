<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    public function get_all_orders($post) {
        return $this->db->get('boighor.tblOrderDetails')->result_array();
    }

    public function get_order_details_count() {
       $sql="SELECT OD.orderstatus, count(*) as ordercount from boighor.tblOrderDetails as OD inner JOIN boighor.tblPaymentInitReference as PIR ON OD.orderid = PIR.orderid WHERE DATE(OD.created) = CURDATE() GROUP BY OD.orderstatus order by OD.orderstatus";
       $query = $this->db->query($sql);
       return $query->result_array();
    }


    public function get_sales_report($post) {
        $data['start'] = 0;//$post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $serchkey = $post['search']['value'];

        // $this->db->select('tblOrderDetails.userid, tblOrderDetails.orderid, tblOrderDetails.bookcode, tblOrderDetails.bookname_bn, tblOrderDetails.sellingprice, tblOrderDetails.promocode, tblOrderDetails.campaignname, tblOrderDetails.paymenttype, tblPaymentNotification.timeofentry');
        $this->db->select('*');
        // $this->db->group_start()->or_like('bookname',$serchkey)->or_like('username',$serchkey)->or_like('reviewtext',$serchkey)->group_end();
        if ($post['writercode']) $this->db->where('writercode',$post['writercode']);
        if ($post['publishercode']) $this->db->where('publishercode',$post['publishercode']);
        if ($post['date_from'] && $post['date_to']) $this->db->where('DATE(timeofentry) >=',$post['date_from'])->where('DATE(timeofentry) <=',$post['date_to']);
        // if ($post['promo']) $this->db->where('promocode',$post['promo']);
        if ($post['campaign']) $this->db->where('campaignname',$post['campaign']);
        if ($post['paymenttype']) $this->db->where('paymenttype',$post['paymenttype']);
        $this->db->order_by($order_col, $order_dir);//->limit($post['length'], $post['start']);
        $data['data'] = $this->db->join('boighor.tblPaymentNotification','boighor.tblPaymentNotification.orderId = boighor.tblOrderDetails.orderid', 'inner')->get('boighor.tblOrderDetails')->result();

        if ($post['writercode']) $this->db->where('writercode',$post['writercode']);
        if ($post['publishercode']) $this->db->where('publishercode',$post['publishercode']);
        if ($post['date_from'] && $post['date_to']) $this->db->where('DATE(timeofentry) >=',$post['date_from'])->where('DATE(timeofentry) <=',$post['date_to']);
        // if ($post['promo']) $this->db->where('promocode',$post['promo']);
        if ($post['campaign']) $this->db->where('campaignname',$post['campaign']);
        if ($post['paymenttype']) $this->db->where('paymenttype',$post['paymenttype']);
        $this->db->join('boighor.tblPaymentNotification','boighor.tblPaymentNotification.orderId = boighor.tblOrderDetails.orderid', 'inner');
        $data['recordsFiltered'] = $this->db->count_all_results('boighor.tblOrderDetails');
        $data['recordsTotal'] = $data['recordsFiltered'];
        //  JSON
        // $data['json'] = array_column($data['data'],'writercode');
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
            ON p.orderId = o.orderid

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
                IF(p.amount=0.99, 80.00, IF(p.amount=1.49, 120, IF(p.amount=1.99, 150, IF(p.amount=2.49, 220, IF(p.amount=2.99, 250, IF(p.amount=3.49, 300, IF(p.amount=3.99, 350, IF(p.amount=4.49, 390, IF(p.amount=4.99, 420, IF(p.amount=5.49, 450, IF(p.amount=5.99, 500, p.amount)))))))))))
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
                ON DATE(p.timeofentry) = b.Days

                GROUP BY DATE(b.Days)
                ORDER BY b.Days'
                )->result_array();
        // $this->db->cache_off();
        return $data;
    }

    public function get_monthly_sale_amount($duration=12) {
        $this->db->select("DATE_FORMAT(timeofentry, '%M') AS month");
        $this->db->select("IFNULL(SUM( IF(amount=0.99, 80, IF(amount=1.49, 120, IF(amount=1.99, 150, IF(amount=2.49, 220, IF(amount=2.99, 250, IF(amount=3.49, 300, IF(amount=3.99, 350, IF(amount=4.49, 390, IF(amount=4.99, 420, IF(amount=5.49, 450, IF(amount=5.99, 500, amount))))))))))) ),0) AS count");
        $this->db->where("timeofentry >= '2021-03-18 00:00:00'");
        $this->db->where('timeofentry >= curdate() - INTERVAL 6 MONTH');
        $this->db->group_by('MONTH(timeofentry)');
        $data = $this->db->get('boighor.tblPaymentNotification')->result_array();
        return $data;
    }

    public function get_this_month_sale_amount() {
        $data = $this->db->select('amount')->where('MONTH(timeofentry) = MONTH(CURRENT_DATE())')->where('YEAR(timeofentry) = YEAR(CURRENT_DATE())')->get('boighor.tblPaymentNotification')->result_array();
        $data = array_column($data, 'amount');
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
        $this->db->select("boighor.tblBookGenreTagging.genrecode AS genrecode, COUNT(*) AS count");
        $this->db->where("DATE(timeofentry) > curdate() - INTERVAL 7 DAY");
        $this->db->group_by("boighor.tblBookGenreTagging.genrecode");
        $this->db->join('boighor.tblBookGenreTagging','boighor.tblBookGenreTagging.bookcode = boighor.tblOrderDetails.bookcode', 'inner');
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
        $this->db->where("DATE(timeofentry) > curdate() - INTERVAL 30 DAY");
        $this->db->group_by("boighor.tblPaymentNotification.countrycode");
        $this->db->order_by("COUNT(*)","DESC");
        $this->db->join('boighor.tblPaymentNotification','boighor.tblPaymentNotification.orderId = boighor.tblOrderDetails.orderid', 'inner');
        $this->db->join('boighor.tblCountryName','boighor.tblCountryName.countrycode = boighor.tblPaymentNotification.countrycode');
        $data = $this->db->get('boighor.tblOrderDetails')->result_array();
        return $data;
    }

    public function get_top_book_pie_chart_data($duration=7) {
        $this->db->select("boighor.tblOrderDetails.bookname AS bookname, COUNT(*) AS count");
        $this->db->select("IFNULL(SUM( IF(sellingprice=0.99, 80, IF(sellingprice=1.49, 120, IF(sellingprice=1.99, 150, IF(sellingprice=2.49, 220, IF(sellingprice=2.99, 250, IF(sellingprice=3.49, 300, IF(sellingprice=3.99, 350, IF(sellingprice=4.49, 390, IF(sellingprice=4.99, 420, IF(sellingprice=5.49, 450, IF(sellingprice=5.99, 500, sellingprice))))))))))) ),0) AS amount");
        $this->db->where("DATE(timeofentry) > curdate() - INTERVAL 7 DAY");
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
        $this->db->where("DATE(timeofentry) > curdate() - INTERVAL 30 DAY");
        $this->db->group_by("paymentmethod");
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
        $this->db->select('"1" AS sl, bookcode, bookname_bn, COUNT(*) AS totalcount');
        $this->db->where('DATE(timeofentry) > "2021-03-17"');
        $this->db->group_by('bookcode');
        $this->db->order_by('COUNT(*)', 'desc');
        $data = $this->db->limit(100)->get('boighor.tblBoiMelaSubscriberContentSelection')->result_array();
        return $data;
    }

    function getTopPurchasedList(){
        $this->db->select('"1" AS sl, bookcode, bookname_bn, COUNT(*) AS totalcount');
        $this->db->where('DATE(tblPaymentNotification.timeofentry) > "2021-03-17"');
        $this->db->join('boighor.tblPaymentNotification','boighor.tblPaymentNotification.orderId = boighor.tblOrderDetails.orderid', 'inner');
        $this->db->group_by('bookcode');
        $this->db->order_by('COUNT(*)', 'desc');
        $data = $this->db->limit(100)->get('boighor.tblOrderDetails')->result_array();
        return $data;
    }

    function getPopularWriterList(){
        $this->db->select('"1" AS sl, writercode, writername AS writer_bn, COUNT(*) AS totalcount');
        $this->db->where('DATE(tblPaymentNotification.timeofentry) > "2021-03-17"');
        $this->db->join('boighor.tblPaymentNotification','boighor.tblPaymentNotification.orderId = boighor.tblOrderDetails.orderid', 'inner');
        $this->db->group_by('writercode');
        $this->db->order_by('COUNT(*)', 'desc');
        $data = $this->db->limit(100)->get('boighor.tblOrderDetails')->result_array();
        return $data;
    }

    public function get_mou_report($post) {
        $data['start'] = 0;//$post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $serchkey = $post['search']['value'];

        $this->db->select('boighor.tblContentPlayLog.msisdn AS msisdn, boighor.tblContentPlayLog.adbid AS adbid, boighor.tblBookAudios.bookcode AS bookcode, boighor.tblBookAudios.title AS title, boighor.tblBookAudios.title_bn AS title_bn, boighor.tblBooks.bookname AS bookname, boighor.tblBooks.writercode AS writercode, boighor.tblBooks.writer AS writer, boighor.tblBooks.writer_bn AS writer_bn, boighor.tblBookAudios.filelength AS filelength, SUM(playtime) AS total_usage_in_seconds, COUNT(*) AS hitcount');
        if ($post['publishercode']) $this->db->where('boighor.tblBooks.publishercode',$post['publishercode']);
        $this->db->where('DATE(pagehittime) >=',$post['date_from'])->where('DATE(pagehittime) <=',$post['date_to']);
        $this->db->join('boighor.tblBookAudios','boighor.tblBookAudios.id = boighor.tblContentPlayLog.adbid');
        $this->db->join('boighor.tblBooks','boighor.tblBooks.bookcode = boighor.tblContentPlayLog.bookcode');
        $data['data'] = $this->db->order_by("total_usage_in_seconds","desc")->group_by('bookcode')->group_by('adbid')->get('boighor.tblContentPlayLog')->result();

        // if ($post['date_from'] && $post['date_to']) $this->db->where('DATE(timeofentry) >=',$post['date_from'])->where('DATE(timeofentry) <=',$post['date_to']);
        // if ($post['publishercode']) $this->db->where('boighor.tblBooks.publishercode');
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
