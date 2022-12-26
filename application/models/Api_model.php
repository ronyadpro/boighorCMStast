<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
		$this->load->library('user_agent');
    }

    public function get_all_book_api($post) {
        header('Content-Type: application/json');
        $post['page']--;
        $data['catname'] = 'All Books';
        $totalbooks = $this->db->where(array('isaudiobook' => 0))->count_all_results('tblBooks');
        $data['pagelimit'] = (int)($totalbooks/50);
        $data['pagelimit'] += (fmod($totalbooks, 50) == 0) ? 0 : 1;
        $data['contents']   = $this->db->select('tblBooks.bookcode, tblBooks.bookname_bn AS bookname, tblBooks.writer, IF(EXISTS(SELECT * FROM tblBookPreview WHERE bookcode = tblBooks.bookcode), "1", "0") as category    , tblBooks.bookprice AS price, tblBooks.bookprice_bn AS bookprice, CONCAT("https://bangladhol.com/book_th_plain/", tblBooks.bookcover_small) as bookcover')
        ->join('tblBookCategory', 'tblBookCategory.catcode = tblBooks.category', 'left outer')
        ->limit(50, $post['page']*50)->order_by('dateofaddition', 'desc')->get_where('tblBooks', array('isaudiobook' => 0))->result();
        return $data;
    }

    public function get_home_data($src='') {
        $showEnglish = 0;
        $data = $this->db->select('catcode,catname,catname_bn,itemtype')->order_by('sortorder')->get_where('tblAppHomeBoighor', array('status' => 1, 'deleted' => 0))->result_array();
        for ($i=0; $i < sizeof($data); $i++) {
            $catcode = $data[$i]['catcode'];
            $itemtype = $data[$i]['itemtype'];
            switch ($itemtype) {
                case 1:
                    $data[$i]['contents']= $this->db->select('bookcode,bookname,bookname_bn,CONCAT("https://bangladhol.com/book_th/", bookcover_small) AS bookcover,writer,writer_bn,category AS catcode,category_en,category_bn, IF(isenglishbook = 1, "en", "bn") AS language, isaudiobook AS adb')
                    ->select('IFNULL((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT gp FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS bdt')
                    ->select('IFNULL((SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS usd')
                    // ->select("(SELECT sortorder FROM tblAppBoighorHomeItems WHERE bookcode = tblBooks.bookcode AND sectioncode = \"$catcode\") AS sortorder")
                    ->where("bookcode IN (SELECT bookcode FROM tblAppBoighorHomeItems WHERE sectioncode = \"$catcode\")")
                    ->order_by("(SELECT sortorder FROM tblAppBoighorHomeItems WHERE bookcode = tblBooks.bookcode AND sectioncode = \"$catcode\")")
                    ->limit(20)->get_where('tblBooks',array('isaudiobook' => 0, 'status' => 1))->result_array();
                    break;
                case 2:
                    $data[$i]['contents'] = array();
                    break;
                case 3:
                    $data[$i]['contents']= $this->db->select('authorcode, author, author_bn, numberofbooks, CONCAT("https://bangladhol.com/author_th/", authorcode, ".jpg") AS image')->where(array('deleted' => 0))
                    ->where("authorcode IN (SELECT bookcode FROM tblAppBoighorHomeItems WHERE sectioncode = \"$catcode\")")
                    ->order_by("(SELECT sortorder FROM tblAppBoighorHomeItems WHERE bookcode = tblBookAuthor.authorcode AND sectioncode = \"$catcode\")")
                    ->limit(20)->get_where('tblBookAuthor',array('deleted' => 0))->result_array();
                    break;
                case 4:
                    $data[$i]['contents']= $this->db->select('authorcode, author, author_bn, numberofbooks, CONCAT("https://bangladhol.com/author_th/", authorcode, ".jpg") AS image')->where(array('deleted' => 0))
                    ->where("authorcode IN (SELECT bookcode FROM tblAppBoighorHomeItems WHERE sectioncode = \"$catcode\")")
                    ->order_by("(SELECT sortorder FROM tblAppBoighorHomeItems WHERE bookcode = tblBookAuthor.authorcode AND sectioncode = \"$catcode\")")
                    ->limit(20)->get_where('tblBookAuthor',array('deleted' => 0))->row_array();
                    break;
                case 5:

                    if ($src=='web') {
                        $bannertype = 'bannerfile_web';
                    } else {
                        $bannertype = 'bannerfile_mob';
                    }
                    $data[$i]['contents'] = $this->db->select('type, code, title, CONCAT("https://bangladhol.com/banner_th/", '.$bannertype.') AS image_location, url')->limit(10)->order_by('sortorder')->get_where('gpboighor.tblBanner', array('status' => 1, 'deleted' => 0))->result_array();

                    // if ($src=='web') {
                    //     $data[$i]['contents'] = array(
                    //         array(
                    //             'type' => 'genre',
                    //             'code' => 'lib',
                    //             'title' => 'মুক্তিযুদ্ধের বই',
                    //             'image_location' => 'https://bangladhol.com/banner_th/App-Banner_26th-March_01_1000x300.jpg',
                    //             'url' => 'http://gp.boighor.com/contents/genrebooklist/lib',
                    //         ),
                    //         // array(
                    //         //     'type' => 'author',
                    //         //     'code' => 'A043F',
                    //         //     'title' => 'আল-কুরআন প্রথম বাংলা অনুবাদ',
                    //         //     'image_location' => 'https://bangladhol.com/bookpreview/The-Holy-Quran-1000x300.jpg',
                    //         //     'url' => 'http://gp.boighor.com/authors/authordetails/A043F',
                    //         // ),
                    //         array(
                    //             'type' => 'section',
                    //             'code' => 'english-classic',
                    //             'title' => 'English Classics',
                    //             'image_location' => 'https://bangladhol.com/banner_th/App-Banner_English_Classics_01_1000x300.jpg',
                    //             'url' => 'http://gp.boighor.com/contents/engcls',
                    //         ),
                    //     );
                    // } else {
                    //     $data[$i]['contents'] = array(
                    //         array(
                    //             'type' => 'section',
                    //             'code' => 'lib',
                    //             'title' => 'মুক্তিযুদ্ধের বই',
                    //             'image_location' => 'https://bangladhol.com/banner_th/App-Banner_26th-March_01_500x150.jpg',
                    //             'url' => 'http://gp.boighor.com/contents/genrebooklist/lib',
                    //         ),
                    //         // array(
                    //         //     'type' => 'author',
                    //         //     'code' => 'A043F',
                    //         //     'title' => 'আল-কুরআন প্রথম বাংলা অনুবাদ',
                    //         //     'image_location' => 'https://bangladhol.com/bookpreview/The-Holy-Quran-500x150.jpg',
                    //         //     'url' => 'http://gp.boighor.com/authors/authordetails/A043F',
                    //         // ),
                    //         array(
                    //             'type' => 'section',
                    //             'code' => 'english-classic',
                    //             'title' => 'English Classics',
                    //             'image_location' => 'https://bangladhol.com/banner_th/App-Banner_English_Classics_01_500x150.jpg',
                    //             'url' => 'http://gp.boighor.com/contents/engcls',
                    //         ),
                    //     );
                    // }

                    break;
                case 6:     //category
                    $data[$i]['contents']= $this->db->select('tc.catcode, tc.catname_en, tc.catname_bn, COUNT(*) AS count')->from('tblBooks AS tb')->join('tblBookCategory AS tc', 'tc.catcode = tb.category', 'left')->group_by('tb.category')->order_by('count', 'DESC')->limit(10)->get()->result_array();
                    break;
                case 7:     //genre
                    // $genre_codes = array('dec','htl','hor','mys','ptl','rel','sfi','spi','thr','yth');
                    $genre_codes = array('adv','rom','htl','lib','phi','ptl','con');
                    $data[$i]['contents']= $this->db->select('genre_code, genre_en, genre_bn, CONCAT("https://bangladhol.com/book_genre_th/",genre_code,".jpg") AS image')->where_in('genre_code', $genre_codes)->get_where('tblBookGenre',array('isdeleted' => 0))->result_array();
                    for ($j=0; $j < sizeof($data[$i]['contents']); $j++) {
                        $genrecode = $data[$i]['contents'][$j]['genre_code'];
                        $this->db->select('bookcode,bookname,bookname_bn,CONCAT("https://bangladhol.com/book_th/", bookcover_small) AS bookcover,writer,writer_bn,category, IF(isenglishbook = 1, "en", "bn") AS language')
                        ->select('IFNULL((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT gp FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS bdt')
                        ->select('IFNULL((SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS usd')
                        ->where("bookcode IN (SELECT bookcode FROM tblBookGenreTagging WHERE genrecode = \"$genrecode\")");
                        if (!$showEnglish) {
                            $this->db->where('isenglishbook', 0);
                        }
                        $data[$i]['contents'][$j]['books'] = $this->db->limit(10)->get_where('tblBooks',array('status' => 1))->result_array();
                    }
                    break;
                default:
                    $data[$i]['contents'] = array();
                    break;
            }
        }
        return $data;
    }

    public function get_section_data_all($catcode ='',$page = '') {

        $limit = 20;
        $startfrom = ($page - 1)*$limit;

        $catname = $this->db->select('catname, catname_bn')->get_where('tblAppHomeBoighor', array('catcode' => $catcode))->row();
        $contents = $this->db->select('bookcode,bookname,bookname_bn,CONCAT("https://bangladhol.com/book_th/", bookcover_small) AS bookcover,writer,writer_bn,category AS catcode,category_en,category_bn,IF(isenglishbook = 1, "en", "bn") AS language, isaudiobook AS adb')
        ->select('IFNULL((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT gp FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS bdt')
        ->select('IFNULL((SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS usd')
        ->where("bookcode IN (SELECT bookcode FROM tblAppBoighorHomeItems WHERE sectioncode = \"$catcode\")")
        ->order_by("(SELECT sortorder FROM tblAppBoighorHomeItems WHERE bookcode = tblBooks.bookcode AND sectioncode = \"$catcode\")")
        ->limit($limit,$startfrom)
        ->get_where('tblBooks',array('isaudiobook' => 0, 'status' => 1))->result_array();
        $data['catcode'] = $catcode;
        $data['catname_en'] = isset($catname->catname) ? $catname->catname : "";
        $data['catname_bn'] = isset($catname->catname_bn) ? $catname->catname_bn : "";
        $totalfound = (int)$this->db->select("(SELECT COUNT(*) FROM tblBooks WHERE bookcode IN (SELECT bookcode FROM tblAppBoighorHomeItems WHERE sectioncode = '$catcode') AND status = 1 AND isaudiobook = 0) AS count")->get()->row_array()['count'];
        $data['totalfound'] = $totalfound;
        $data['pagelimit'] = ceil($totalfound/$limit);
        $data['currentpage'] = (int)$page;
        $data['pagesize'] = sizeof($contents);

        $from = $startfrom+1;
        $to = $from+$data['pagesize']-1;
        $data['paginginfo'] = "Showing $from to $to from $totalfound books";

        $data['data'] = $contents;

        return $data;
    }

    public function get_single_book_details($bookcode='') {

        $booksdetails = $this->db->select('bookcode,bookname AS name_en,bookname_bn AS name_bn,booksummary AS summary,CONCAT("http://bangladhol.com/book_th/",bookcover_small) AS cover,writercode,bookprice_en AS bookprice,category,catcode,catname_en,catname_bn, "" AS genres,
        "https://bangladhol.com/boighorapiglobal/boighor_buybook.php" AS purchaseurl, CONCAT("http://gp.boighor.com/bookdetails/",bookcode) AS shareurl, "3.5" AS rating, "0" AS mylist, filename')
        ->select('IF(isenglishbook = 1, "en", "bn") AS language')
        ->select('IF(isaudiobook = 1, "audiobook", "ebook") AS type, adb_has_book AS ebookcoode')
        ->join('tblBookCategory', 'tblBookCategory.catcode = tblBooks.category')
        ->get_where('tblBooks', array('bookcode' => $bookcode, 'status' => 1))->row_array();

        if (!$booksdetails) return array();

        if ($booksdetails['type']=='audiobook') {
            $booksdetails['audiotracks'] = $this->db->select('title,title_bn,filesize,filelength,CONCAT("http://remote.ebsbd.com:1935/robiboighoraudiobook/mp3:", bookaudiocode, "/playlist.m3u8") AS url')->where('bookcode', $bookcode)->get_where('tblBookAudios', array('status' => 1))->result_array();
            if ($booksdetails['ebookcoode'] && $booksdetails['summary']=='') {
                $summary = $this->db->select('booksummary AS summary')->get_where('tblBooks', array('bookcode' => $booksdetails['ebookcoode']))->row_array();
                if (isset($summary['summary'])) {
                    $booksdetails['summary'] = $summary['summary'];
                }
            }
        } else {
            $booksdetails['audiotracks'] = array();
        }

        $publisher = $this->db->select('publishercode ,IF(IFNULL(publisher, "") = "", "BOIGHOR", publisher) AS publisher , IF(IFNULL(publisher_bn, "") = "", "বইঘর", publisher_bn) AS publisher_bn')->get_where('tblBooks', array('bookcode' => $bookcode, 'status' => 1))->row_array();

        $author = $this->db->select('authorcode, author, author_bn, IF(dob = "0000-00-00", "N/A", IF(DATE_FORMAT(dob, "%D %M %Y") IS NULL, DATE_FORMAT(dob, "%Y"), DATE_FORMAT(dob, "%D %M %Y"))) as dob, IF(dod = "0000-00-00", "N/A", IF(DATE_FORMAT(dod, "%D %M %Y") IS NULL, DATE_FORMAT(dod, "%Y"), DATE_FORMAT(dod, "%D %M %Y"))) as dod, bio, numberofbooks')->get_where('tblBookAuthor', array('authorcode' => $booksdetails['writercode'], 'deleted' => 0))->row_array();

        $category = array(
            'catcode' => $booksdetails['catcode'],
            'catname_en' => $booksdetails['catname_en'],
            'catname_bn' => $booksdetails['catname_bn']
        );

        $genre = $this->db->select('genrecode, genre_en, genre_bn')->join('tblBookGenre', 'tblBookGenre.genre_code = tblBookGenreTagging.genrecode')->get_where('tblBookGenreTagging',array('bookcode' => $bookcode))->result_array();

        // if ($booksdetails['language'] == 'en') {
        //     $pricing_bdt = $this->db->select('gp AS pricecode, (SELECT bookprice_en FROM tblBookPrice WHERE id = gp) AS price')->get_where('tblBookPriceTagging', array('bookcode' => $bookcode))->row_array();
        // } else {
            $pricing_bdt = $this->db->select('gp AS pricecode, (SELECT bookprice_bn FROM tblBookPrice WHERE id = gp) AS price, (SELECT bookprice_en FROM tblBookPrice WHERE id = gp) AS price_en')->get_where('tblBookPriceTagging', array('bookcode' => $bookcode))->row_array();
        // }
        $pricing_usd = $this->db->select('global_usd AS pricecode, CONCAT("$",(SELECT price FROM tblBookPriceGlobal WHERE id = global_usd)) AS price')->get_where('tblBookPriceTagging', array('bookcode' => $bookcode))->row_array();

        $pricing = array();
        if ($pricing_bdt['pricecode']=='12') {
            $pricing['isfree'] = '1';
        } else {
            $pricing['isfree'] = '0';
        }
        $pricing['bdt'] = $pricing_bdt;
        $pricing['usd'] = $pricing_usd;

        // $filepath="/var/www/html/ebswap/books/" . $booksdetails['filename'];
        // if (file_exists($filepath)) {
        //     $filesize = filesize($filepath);
        //     $filesize = round($filesize);
        // } else {
        //     $filesize = 0;
        //     $filesize = 0;
        // }

        unset($booksdetails['writercode']);
        // unset($booksdetails['filename']);
        unset($booksdetails['bookprice']);
        unset($booksdetails['catcode']);
        unset($booksdetails['category']);
        unset($booksdetails['genres']);
        unset($booksdetails['catname_en']);
        unset($booksdetails['catname_bn']);

        $data = array();
        $data['bookdetails'] = $booksdetails;
        $data['publisher'] = $publisher;
        $data['author'] = $author;
        $data['category'] = $category;
        $data['genre'] = $genre;
        $data['pricing'] = $pricing;

        $genrelist = json_encode( array_column($genre, 'genrecode') );
        $genrelist = substr($genrelist, 1, strlen($genrelist)-2);

        $cmxWhereClauseLogic = $data['category']['catcode']=='cmx'?'=':'!=';

        $data['similar'] = $this->db->select('bookcode,bookname,bookname_bn,CONCAT("http://bangladhol.com/book_th/", bookcover_small) AS bookcover,writer,writer_bn,category AS catcode,category_en,category_bn, IF(isenglishbook = 1, "en", "bn") AS language')
        ->select('IFNULL((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT gp FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS bdt')
        ->select('IFNULL((SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS usd')
        ->where("bookcode IN (SELECT bookcode FROM tblBookGenreTagging WHERE genrecode IN ($genrelist))")
        ->where('isaudiobook', $booksdetails['type']=='ebook'?'0':'1')
        ->where("category $cmxWhereClauseLogic 'cmx'")
        ->order_by('RAND()')->limit(20)->get_where('tblBooks', array('status' => 1))->result_array();

        $data['categories'] = $this->db->select('tc.catcode, tc.catname_en, tc.catname_bn, COUNT(*) AS count')->from('tblBooks AS tb')->join('tblBookCategory AS tc', 'tc.catcode = tb.category', 'left')->group_by('tb.category')->order_by('count', 'DESC')->where(array('tb.status' => 1, 'isaudiobook'=>0))->limit(10)->get()->result_array();
        shuffle($data['categories']);

        $genrecodes = $this->db->query("SELECT tg.genre_code, COUNT(*) AS count FROM tblBookGenreTagging AS tgt LEFT JOIN tblBookGenre AS tg ON tg.genre_code = tgt.genrecode GROUP BY genrecode ORDER BY count DESC LIMIT 20")->result_array();
        $genrecodes = array_column($genrecodes, 'genre_code');

        $data['genres']= $this->db->select('genre_code, genre_en, genre_bn, CONCAT("https://bangladhol.com/book_genre_th/",genre_code,".jpg") AS image')->where_in('genre_code', $genrecodes)->get_where('tblBookGenre',array('isdeleted' => 0))->result_array();
        shuffle($data['genres']);

        return $data;
    }

    public function get_all_authors($page = '') {

        $limit = 20;
        $startfrom = $limit * ($page - 1);

        $authors = $this->db->select('authorcode, author, author_bn, CONCAT("http://bangladhol.com/author_th/", authorcode, ".jpg") AS image, numberofbooks')
            ->order_by('author')->limit($limit,$startfrom)->get_where('tblBookAuthor', array('deleted' => 0))->result_array();

        $totalfound = (int)$this->db->where(array('deleted' => 0))->count_all_results('tblBookAuthor');
        $data['totalfound'] = $totalfound;
        $data['pagelimit'] = ceil($totalfound/$limit);
        $data['currentpage'] = (int)$page;
        $data['pagesize'] = sizeof($authors);

        $from = $startfrom+1;
        $to = $from+$data['pagesize']-1;
        $data['paginginfo'] = "Showing $from to $to from $totalfound Authors";

        $data['contents'] = $authors;

        return $data;
        //}
    }

    public function get_all_author_details($authorcode='') {
        $data = $this->db->select('authorcode, author, author_bn, IF(dob = "0000-00-00", "N/A", IF(DATE_FORMAT(dob, "%D %M %Y") IS NULL, DATE_FORMAT(dob, "%Y"), DATE_FORMAT(dob, "%D %M %Y"))) as dob, IF(dod = "0000-00-00", "N/A", IF(DATE_FORMAT(dod, "%D %M %Y") IS NULL, DATE_FORMAT(dod, "%Y"), DATE_FORMAT(dod, "%D %M %Y"))) as dod, bio, CONCAT("http://bangladhol.com/author_th/", authorcode, ".jpg") AS image, numberofbooks')->get_where('tblBookAuthor', array('authorcode' => $authorcode, 'deleted' => 0))->row_array();
        if ($data) {
            $data['books'] = $this->db->select('bookcode,bookname,bookname_bn,CONCAT("http://bangladhol.com/book_th/", bookcover_small) AS bookcover,writer,writer_bn,category AS catcode,category_en,category_bn, IF(isenglishbook = 1, "en", "bn") AS language')
                ->select('IFNULL((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT gp FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS bdt')
                ->select('IFNULL((SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS usd')
                ->get_where('tblBooks', array('writercode' => $authorcode, 'isaudiobook'=>0, 'status'=>1))->result_array();
            $data['topauthors'] = $this->db->select('authorcode, author, author_bn, CONCAT("http://bangladhol.com/author_th/", authorcode, ".jpg") AS image, numberofbooks')
                ->order_by('numberofbooks', 'desc')->limit(15)->get_where('tblBookAuthor', array('deleted' => 0, 'authorcode !=' => $authorcode))->result_array();
            shuffle($data['topauthors']);
            return $data;
        } else {
            return new stdClass();
        }
    }

    public function get_all_genres() {
        $genres = $this->db->select('genre_code, genre_en, genre_bn')->get_where('tblBookGenre', array('isdeleted' => 0))->result_array();
        $data['count'] = sizeof($genres);
        $data['data'] = $genres;
        return $data;
    }

    public function get_all_books_by_genre($genrecode='',$page='') {

        $limit = 20;
        $startfrom = ($page - 1)*$limit;

        $data = $this->db->select("genre_code, genre_en, genre_bn")->get_where('tblBookGenre', array('genre_code' => $genrecode))->row_array();

        $books = $this->db->select('bookcode,bookname,bookname_bn,CONCAT("http://bangladhol.com/book_th/", bookcover_small) AS bookcover,writer,writer_bn,category, IF(isenglishbook = 1, "en", "bn") AS language, isaudiobook AS adb')
            ->select('IFNULL((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT gp FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS bdt')
            ->select('IFNULL((SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS usd')
            ->where("bookcode IN (SELECT bookcode FROM tblBookGenreTagging WHERE genrecode = \"$genrecode\")")->limit($limit,$startfrom)->get_where('tblBooks', array( 'status' => 1, 'isaudiobook' => 0))->result_array();

        $totalfound = (int)$this->db->select("(SELECT COUNT(*) FROM tblBooks WHERE bookcode IN (SELECT bookcode FROM tblBookGenreTagging WHERE genrecode = '$genrecode') AND status = 1 AND isaudiobook = 0) AS count")->get()->row_array()['count'];
        $data['totalfound'] = $totalfound;
        $data['pagelimit'] = ceil($data['totalfound']/$limit);
        $data['currentpage'] = (int)$page;
        $data['pagesize'] = sizeof($books);

        $from = $startfrom+1;
        $to = $from+$data['pagesize']-1;
        $data['paginginfo'] = "Showing $from to $to from $totalfound books";

        $data['data'] = $books;

        return $data;
    }

    public function get_all_categories() {
        $categories = $this->db->select('catcode, catname_en, catname_bn')->get_where('tblBookCategory', array('isdeleted' => 0))->result_array();
        $data['count'] = sizeof($categories);
        $data['data'] = $categories;
        return $data;
    }

    public function get_all_books_by_category($catcode='', $page = '') {

        $limit = 20;
        $startfrom = ($page - 1)*$limit;

        $data = $this->db->select('catcode, catname_en, catname_bn')->get_where('tblBookCategory', array('catcode' => $catcode))->row_array();
        $books= $this->db->select('bookcode,bookname,bookname_bn,CONCAT("http://bangladhol.com/book_th/", bookcover_small) AS bookcover,writer,writer_bn,category AS catcode,category_en,category_bn, IF(isenglishbook = 1, "en", "bn") AS language, isaudiobook AS adb')
            ->select('IFNULL((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT gp FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS bdt')
            ->select('IFNULL((SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS usd')
            ->limit($limit, $startfrom)->get_where('tblBooks', array('category' => $catcode, 'isaudiobook'=>0, 'status'=>1))->result_array();

        $totalfound = (int)$this->db->where(array('category'=>$catcode, 'isaudiobook'=>0, 'status'=>1))->count_all_results('tblBooks');
        $data['totalfound'] = $totalfound;
        $data['pagelimit'] = ceil($data['totalfound']/$limit);
        $data['currentpage'] = (int)$page;
        $data['pagesize'] = sizeof($books);

        $from = $startfrom+1;
        $to = $from+$data['pagesize']-1;
        $data['paginginfo'] = "Showing $from to $to from $totalfound books";

        $data['data'] = $books;

        return $data;
    }

    // public function get_all_books_by_section_category($catcode='') {
    //     $data = $this->db->select('catcode, catname_en, catname_bn')->get_where('tblBookCategory', array('catcode' => $catcode))->row_array();
    //     // $books = $this->db->select('bookcode,bookname,CONCAT("http://bangladhol.com/book_th_plain/", bookcover_small) AS bookcover,writer,category,bookprice AS price, bookprice_en AS bookprice')
    //     //                 ->where("category", $catcode)->get('tblBooks')->result_array();
    //
    //     $books= $this->db->select('bookcode,bookname,bookname_bn,CONCAT("http://bangladhol.com/book_th/", bookcover_small) AS bookcover,writer,writer_bn,category AS catcode,category_en,category_bn')
    //         ->select('IFNULL((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT gp FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS bdt')
    //         ->select('IFNULL((SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS usd')
    //         // ->select("(SELECT sortorder FROM tblAppBoighorHomeItems WHERE bookcode = tblBooks.bookcode AND sectioncode = \"$catcode\") AS sortorder")
    //         ->where("bookcode IN (SELECT bookcode FROM tblAppBoighorHomeItems WHERE sectioncode = \"$catcode\")")
    //         ->order_by("(SELECT sortorder FROM tblAppBoighorHomeItems WHERE bookcode = tblBooks.bookcode AND sectioncode = \"$catcode\")")
    //         ->get('tblBooks')->result_array();
    //     $data['count'] = sizeof($books);
    //     $data['data'] = $books;
    //     return $data;
    // }

    public function search($keys) {

        // $all_books = $this->db->select('bookcode, bookname, bookcover_small')->get('tblBooks')->result_array();
        // $no_plainCover_list = array();
        // foreach ($all_books as $row) {
        //     if (!file_exists('/var/www/html/ebswap/book_th_plain/'.$row['bookcover_small'])) {
        //         array_push($no_plainCover_list, array('bookcode' => $row['bookcode'], 'bookname' => $row['bookname']));
        //     }
        // }
        // return $no_plainCover_list;

        $where_clause = " '%$keys[0]%' ";
        for ($i=1; $i < sizeof($keys); $i++) {
            $where_clause .= " OR tags LIKE '%$keys[$i]%' ";
        }

        $books = $this->db->select('bookcode,bookname,bookname_bn,CONCAT("http://bangladhol.com/book_th/", bookcover_small) AS bookcover,writer,writer_bn,category, IF(isenglishbook = 1, "en", "bn") AS language, isaudiobook AS adb')
        ->select('IFNULL((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT gp FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS bdt')
        ->select('IFNULL((SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS usd')
        ->group_start()
        ->where("bookcode IN (SELECT code FROM tblBookTagging WHERE tagtype = 0 AND tags LIKE $where_clause GROUP BY code)")
        // ->or_where("category IN (SELECT code FROM tblBookTagging WHERE tagtype = 2 AND tags LIKE $where_clause GROUP BY code)")
        ->or_where("bookcode IN (SELECT bookcode FROM tblBookGenreTagging WHERE genrecode IN (SELECT code FROM tblBookTagging WHERE tagtype = 3 AND tags LIKE $where_clause GROUP BY code))")
        ->group_end()
        ->get_where('tblBooks', array('status'=>1, 'hideit'=>0))->result_array();

        $writers = $this->db->select('authorcode, author, author_bn, CONCAT("http://bangladhol.com/author_th/", authorcode, ".jpg") AS image, numberofbooks')
        ->where("authorcode IN (SELECT code FROM tblBookTagging WHERE tagtype = 1 AND tags LIKE $where_clause GROUP BY code)")
        ->get_where('tblBookAuthor',array('deleted' => 0))->result_array();

        $genres = $this->db->select('genre_code, genre_en, genre_bn, (SELECT COUNT(*) FROM tblBookGenreTagging WHERE genrecode = genre_code) AS numberofbooks')
        ->where("genre_code IN (SELECT code FROM tblBookTagging WHERE tagtype = 3 AND tags LIKE $where_clause GROUP BY code)")
        ->get('tblBookGenre')->result_array();

        $categories = $this->db->select('catcode, catname_en, catname_bn, (SELECT COUNT(*) FROM tblBooks WHERE catcode = catcode) AS numberofbooks')
        ->where("catcode IN (SELECT code FROM tblBookTagging WHERE tagtype = 2 AND tags LIKE $where_clause GROUP BY code)")
        ->get('tblBookCategory')->result_array();

        $data['totalfound'] = sizeof($books)+sizeof($writers)+sizeof($categories)+sizeof($genres);
        $data['totalbooks'] = sizeof($books);
        $data['totalwriters'] = sizeof($writers);
        $data['totalcategories'] = sizeof($categories);
        $data['totalgenres'] = sizeof($genres);
        $data['books'] = $books;
        $data['writers'] = $writers;
        $data['categories'] = $categories;
        $data['genres'] = $genres;
        return $data;

        // $all_category = $this->db->select('catcode, catname_en, catname_bn')->get('tblBookCategory')->result_array();
        // foreach ($all_category as $row) {
        //     $this->db->where('category', $row['catcode'])->update('tblBooks', array('category_en' => $row['catname_en'], 'category_bn' => $row['catname_bn']));
        // }
        // return 1;

    }

    public function get_all_audiobook($page = '') {
        $limit = 20;
        $startfrom = ($page - 1) * $limit;

        $countdata = $this->db->select("count(*) as totalcontent")->get_where('tblBooks', array('isaudiobook' => 1, 'status' => 1))->row();

        $data = array(
            'catcode' => 'adb',
            'catname' => 'Audio Books'
        );
        $data['pagelimit'] = ceil(($countdata->totalcontent)/$limit);

        $books = $this->db->select('bookcode,bookname,bookname_bn,CONCAT("https://bangladhol.com/book_th/", bookcover_small) AS bookcover,writer,writer_bn,category AS catcode,category_en,category_bn, IF(isenglishbook = 1, "en", "bn") AS language, isaudiobook AS adb, IFNULL(bookprice_bn, "") AS bdt, IFNULL(bookprice_global, "") AS usd')
            // ->select('IFNULL((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT gp FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS bdt')
            // ->select('IFNULL((SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode LIMIT 1) LIMIT 1), "") AS usd')
            // ->select("(SELECT sortorder FROM tblAppBoighorHomeItems WHERE bookcode = tblBooks.bookcode AND sectioncode = \"$catcode\") AS sortorder")
            ->limit($limit,$startfrom)->get_where('tblBooks', array('isaudiobook' => 1, 'status' => 1))->result_array();

        $totalfound = (int)$this->db->where(array('isaudiobook'=>1, 'status'=>1))->count_all_results('tblBooks');
        $data['totalfound'] = $totalfound;
        $data['pagelimit'] = ceil($data['totalfound']/$limit);
        $data['currentpage'] = (int)$page;
        $data['pagesize'] = sizeof($books);

        $from = $startfrom+1;
        $to = $from+$data['pagesize']-1;
        $data['paginginfo'] = "Showing $from to $to from $totalfound books";

        $data['contents'] = $books;

        return $data;
    }

    public function get_app_info($appinfo='') {
        $data = $this->db->select('infodetail')->where(array('appinfo'=>$appinfo, 'telco'=>'gp'))->get('gpboighor.tblBookAppInfo')->row_array();
        return isset($data['infodetail']) ? $data['infodetail'] : "";
    }

    public function signup($param = array()) {

        $httphost=$_SERVER["HTTP_HOST"];
        $useragent = $this->agent->agent_string() ?: "";
        $remoteaddr = $this->input->server('REMOTE_ADDR');
        $remoteport = $this->input->server('REMOTE_PORT');
        $ref= $this->agent->referrer();

        	$exdate = date("Y-m-d H:i:s", strtotime('+1 mins'));
        	$at=$httphost . "signuppage" . $exdate;
        	$accesstoken=sha1($at);

        $serviceName = isset($param['serviceName']) ? $param['serviceName'] : "";
        $msisdn = isset($param['msisdn']) ? $param['msisdn'] : "";
        $deviceId = isset($param['deviceId']) ? $param['deviceId'] : "";
        $imei = isset($param['imei']) ? $param['imei'] : "";
        $imsi = isset($param['imsi']) ? $param['imsi'] : "";
        $softwareVersion = isset($param['softwareVersion']) ? $param['softwareVersion'] : "";
        $simSerialNumber = isset($param['simSerialNumber']) ? $param['simSerialNumber'] : "";
        $operator = isset($param['operator']) ? $param['operator'] : "";
        $operatorName = isset($param['operatorName']) ? $param['operatorName'] : "";
        $brand = isset($param['brand']) ? $param['brand'] : "";
        $model = isset($param['model']) ? $param['model'] : "";
        $release = isset($param['release']) ? $param['release'] : "";
        $sdkVersion = isset($param['sdkVersion']) ? $param['sdkVersion'] : "";
        $versionCode = isset($param['versionCode']) ? $param['versionCode'] : "";
        $retrieve = isset($param['retrieve']) ? $param['retrieve'] : "";

        $telco_initial = substr($msisdn,0,5);
        $pin = $this->generatePIN(6);
        $curdate=date('Y-m-d H:i:s');

        if (empty($msisdn)) {   //  NO MSISDN
        	$data['status']="blank";
        	$data['message']="No Mobile Number Provided";
        } else {    //  HAS MSISDN
            if (strlen($msisdn)<>"13") {    //  WRONG SIZE
            	$data['status']="invalidsize";
            	$data['message']="Mobile Number Size is Invalid - " . strlen($msisdn);
            } else if(!($telco_initial=="88013" || $telco_initial=="88017")) {
                $data['status']="signup";
                $data['message']="Please use a Grameenphone number to signup!";
            } else {    //  CORRECT SIZE
                $user_exists_row = $this->db->get_where('gpboighor.tblBoiMelaSubscriptionDetails', array('msisdn' => $msisdn))->row_array();
                if (empty($user_exists_row)) {      //  NEW USER
                    $msg="Thanks for Signing up. Your password is " . $pin. " Login to BoiGhor";
    				$msg=urlencode($msg);
    				$url2 = "http://wapcharge.ebsbd.com/wapapi/sendsms.aspx?user=user&pass=pass&msisdn=$msisdn&sms=$msg&shortcode=7050&telco=3";
    				$sms_response = $this->get_data($url2);
                    $insert_array_new_user_log = array('msisdn'=>$msisdn, 'whatyoudid'=>'signup', 'returnmsg'=>$sms_response, 'param'=>$url2, 'accesstoken'=>'notoken', 'remoteaddr'=>$remoteaddr, 'httphost'=>$httphost, 'uaprof'=>$useragent);
                    $sql1 = $this->db->insert('gpboighor.tblAPIComDetails', $insert_array_new_user_log);

                    $sms_status = substr($sms_response,0,10);
                    if ($sms_status == 'Successful') {

                        $insert_array_new_user = array('msisdn'=>$msisdn, 'subdatetime'=>$curdate, 'actualsubdatetime'=>$curdate, 'substatus'=>0, 'pincode'=>$pin, 'signedup'=>1, 'signupdate'=>$curdate, 'signupfrom'=>'app');
                        $sql2 = $this->db->insert('gpboighor.tblBoiMelaSubscriptionDetails', $insert_array_new_user);

                        $data['status']="signup";
                        $data['message']="Thank you for signing up. Please check your SMS inbox for Password";
                    } else {
                        $data['status']="signup";
                        $data['message']="Sorry, there has been a problem, please try again";
                    }
                } else {
                    if ($retrieve==1) {
                        $pasword_retrive_retry_count = $this->db->where(array('username'=>$msisdn, 'loginstatus'=>'forget'))->count_all_results('gpboighor.tblMasterAccessToken');
                        if ($pasword_retrive_retry_count > 15) {
                            $data['status']="limitover";
                            $data['message']="You requested for password for more than 15 times. Please try later.";
                        } else {
                            $sql3 = $this->db->get_where('gpboighor.tblBoiMelaSubscriptionDetails', array('msisdn' => $msisdn))->row_array();
                            $issignedup = $sql3['signedup'];
                            $pinfromdb = $sql3['pincode'];

        					 if ($issignedup=='0') {
                                 $data['status']="forget";
                                 $data['message']="You are not signed up yet, please signup first.";
        					 } else {
        						$msg="Your password is " . $pinfromdb. ". Login to BoiGhor";
        						$msg=urlencode($msg);
        						$url2 = "http://wapcharge.ebsbd.com/wapapi/sendsms.aspx?user=user&pass=pass&msisdn=$msisdn&sms=$msg&shortcode=7050&telco=3";

        						$sms_response = $this->get_data($url2);

                                $insert_array_api_com_details = array('msisdn'=>$msisdn, 'whatyoudid'=>'forgetpassword', 'returnmsg'=>$sms_response, 'param'=>$url2, 'accesstoken'=>$accesstoken, 'remoteaddr'=>$remoteaddr, 'httphost'=>$httphost, 'uaprof'=>$useragent);
                                $sql4 = $this->db->insert('gpboighor.tblAPIComDetails', $insert_array_api_com_details);

        						$checkmsg=substr($sms_response, 0, 10);

        						if ($checkmsg=='Successful') {
                                    $data['status']="forget";
                                    $data['message']="You will get the password in the SMS Inbox";
        						} else {
                                    $data['status']="forget";
                                    $data['message']="Something Went wrong, Please retry.";
        						}
                            }
                        }
                    } else {    //  OLD USER
                        $sql3 = $this->db->get_where('gpboighor.tblBoiMelaSubscriptionDetails', array('msisdn' => $msisdn))->row_array();
                        $issignedup = $sql3['signedup'];
                        $pinfromdb = $sql3['pincode'];

						if ($pinfromdb) {
							$pin=$pinfromdb;
						}

                        if ($issignedup==0) {
    						$msg="Thanks for Signing up. Your password is " . $pin. ". Login to BoiGhor";
    						$msg=urlencode($msg);
    						$url2 = "http://wapcharge.ebsbd.com/wapapi/sendsms.aspx?user=user&pass=pass&msisdn=$msisdn&sms=$msg&shortcode=7050&telco=3";
    						$sms_response = $this->get_data($url2);

                            $insert_array_api_com_details = array('msisdn'=>$msisdn, 'whatyoudid'=>'forgetpassword', 'returnmsg'=>$sms_response, 'param'=>$url2, 'accesstoken'=>'notoken', 'remoteaddr'=>$remoteaddr, 'httphost'=>$httphost, 'uaprof'=>$useragent);
                            $sql2 = $this->db->insert('gpboighor.tblAPIComDetails', $insert_array_api_com_details);

    						$checkmsg=substr($sms_response, 0, 10);

    						if ($checkmsg=='Successful') {

                                $update_array_new_user = array('signedup'=>1, 'signupdate'=>$curdate, 'signupfrom'=>'app', 'pincode'=>$pin);
                                $sql2 = $this->db->limit(1)->where('msisdn', $msisdn)->update('gpboighor.tblBoiMelaSubscriptionDetails', $update_array_new_user);

                                $data['status']="signup";
                                $data['message']="Thank you for signing up. Please check your SMS inbox for Password";
    						} else {
                                $data['status']="signup";
                                $data['message']="Sorry, there has been a problem, please try again.";
    						}

        				} else {
                            $data['status']="duplicate";
                            $data['message']="Dear User you are already signed up, click on forget password to get it via SMS.";
        				}
                    }
                }
            }
        }

        $insert_masterAccessToken_array = array('accesstoken' => $accesstoken, 'tokenexpirytime' => $exdate, 'username' => $msisdn, 'password' => $pin, 'remoteaddr' => $remoteaddr, 'httphost' => $httphost, 'uaprof' => $useragent, 'remoteport' => $remoteport, 'imei' => $imei, 'softwareVersion' => $softwareVersion, 'simSerialNumber' => $simSerialNumber, 'imsi' => $imsi, 'operator' => $operator, 'operatorName' => $operatorName, 'brand' => $brand, 'model' => $model, 'rel' => $release, 'sdkVersion' => $sdkVersion, 'versionCode' => $versionCode, 'deviceId' => $deviceId, 'api' => '', 'version' =>'', 'referer' => $ref, 'loginstatus' => $data['status']);

        $this->db->insert('gpboighor.tblMasterAccessToken', $insert_masterAccessToken_array);
        return $data;
    }

//
//
//

    public function login($param) {
        $httphost=$_SERVER["HTTP_HOST"];
        $useragent = $this->agent->agent_string();
        $remoteaddr = $this->input->server('REMOTE_ADDR');
        $remoteport = $this->input->server('REMOTE_PORT');
        $ref= $this->agent->referrer();

    	$exdate = date("Y-m-d H:i:s", strtotime('+1 mins'));
    	$at=$httphost . "signuppage" . $exdate;
    	$accesstoken=sha1($at);

        $serviceName = isset($param['serviceName']) ? $param['serviceName'] : "";
        $msisdn = isset($param['msisdn']) ? $param['msisdn'] : "";
        $password = isset($param['password']) ? $param['password'] : "";
        $deviceId = isset($param['deviceId']) ? $param['deviceId'] : "";
        $imei = isset($param['imei']) ? $param['imei'] : "";
        $imsi = isset($param['imsi']) ? $param['imsi'] : "";
        $softwareVersion = isset($param['softwareVersion']) ? $param['softwareVersion'] : "";
        $simSerialNumber = isset($param['simSerialNumber']) ? $param['simSerialNumber'] : "";
        $operator = isset($param['operator']) ? $param['operator'] : "";
        $operatorName = isset($param['operatorName']) ? $param['operatorName'] : "";
        $brand = isset($param['brand']) ? $param['brand'] : "";
        $model = isset($param['model']) ? $param['model'] : "";
        $release = isset($param['release']) ? $param['release'] : "";
        $sdkVersion = isset($param['sdkVersion']) ? $param['sdkVersion'] : "";
        $versionCode = isset($param['versionCode']) ? $param['versionCode'] : "";
        $haspin = isset($param['haspin']) ? $param['haspin'] : "";

        $telco_initial = substr($msisdn,0,5);
        $pin = $this->generatePIN(6);
        $curdatetime=date('Y-m-d H:i:s');

        if($telco_initial=="88013" || $telco_initial=="88017") {
            if ($haspin=='yes') {
                $user_info = $this->db->get_where('gpboighor.tblBoiMelaSubscriptionDetails', array('msisdn' => $msisdn))->row_array();
            } else {
                $user_info = $this->db->get_where('gpboighor.tblBoiMelaSubscriptionDetails', array('msisdn' => $msisdn, 'pincode'=>$password))->row_array();
            }
            // echo json_encode($user_info);

            if ($user_info) {

        		$trialused = $user_info['trialused'];
        		$substatus = $user_info['substatus'];
        		$subenddatetime = $user_info['subenddatetime'];
        		$activepack = $user_info['activepack'];
        		$pack = $user_info['pack'];
        		$freeuserfromdata = $user_info['freeuserfromdata'];
        		$alloweddevice = $user_info['alloweddevice'];
        		$lastreminded = $user_info['lastreminded'];
        		$consent = $user_info['consent'];
        		$ugc_agreed = $user_info['ugc_agreed'];

                if ($pack<>'') {
            		$packtext="Dear user you are subscribed to " . $user_info['activepack'] . " pack.";
        			if ($pack=='free' and $consent<>1) {
        				$timeFirst  = strtotime($lastreminded);
        				$timeSecond = strtotime($curdatetime);

        				$differenceInSeconds = $timeSecond - $timeFirst;
        				if ($differenceInSeconds>500) {
        					$output_array['consent']=1;
        				} else {
        					$output_array['consent']=0;
        				}
        			} else {
        				$output_array['consent']=0;
        			}
                } else {
            		$pack = "nopack";
            		$packtext = "You are subscribed to no packs!";
            		$output_array['consent']=0;
                }

        		$suc="success";
        		$exdate = date("Y-m-d H:i:s", strtotime('+4 mins'));
        		$at=$httphost . $msisdn . $exdate;
        		$accesstoken=sha1($at);
        		$output_array['result']="success";
        		$output_array['token']=$accesstoken;

                if ($alloweddevice=="" and $deviceId<>"") {

                    $stmt223 = $this->db->limit(1)->where('msisdn',$msisdn)->update('gpboighor.tblBoiMelaSubscriptionDetails', array('alloweddevice'=>$deviceId));

                    $insert_array_tblSubscriberDevice = array('username' => $msisdn, 'referer'=>$ref, 'remoteaddr'=>$remoteaddr, 'remoteport'=>$remoteport, 'httphost'=>$httphost, 'uaprof'=>$useragent, 'version'=>'', 'imei'=>$imei, 'softwareVersion'=>$softwareVersion, 'simSerialNumber'=>$simSerialNumber, 'imsi'=>$imsi, 'operator'=>$operatorName, 'brand'=>$brand, 'model'=>$model, 'rel'=>$release, 'api'=>'', 'sdkVersion'=>$sdkVersion, 'versionCode'=>$versionCode, 'deviceId'=>$deviceId, 'timeofentry'=>$curdatetime);
                    $stmt22 = $this->db->insert('gpboighor.tblSubscriberDevice', $insert_array_tblSubscriberDevice);

        			$alloweddevice = $deviceId;
        		}

                if ($subenddatetime >= $curdatetime) {

    				$output_array['play']=1;
    				$output_array['packcode']=$pack;
    				$output_array['packname']=$activepack;
    				$output_array['packtext']=$packtext;
    				$playtoken=1;

                    $insert_array_tblMasterAccessToken = array('accesstoken' => $accesstoken, 'tokenexpirytime' => $exdate, 'username' => $msisdn, 'password' => $password, 'remoteaddr' => $remoteaddr, 'httphost' => $httphost, 'uaprof' => $useragent, 'remoteport' => $remoteport, 'imei' => $imei, 'softwareVersion' => $softwareVersion, 'simSerialNumber' => $simSerialNumber, 'imsi' => $imsi, 'operator' => $operator, 'operatorName' => $operatorName, 'brand' => $brand, 'model' => $model, 'rel' => $release, 'sdkVersion' => $sdkVersion, 'versionCode' => $versionCode, 'deviceId' => $deviceId, 'api' => '', 'version' =>'', 'referer' => $ref, 'loginstatus' => $suc, 'playtoken'=>$playtoken);

                } else {

    				$pack="nopack";
    				$suc="success";
    				$output_array['result']="success";
    				$output_array['play']=0;
    				$output_array['packcode']=$pack;
    				$output_array['packname']=$pack;
    				$packtext="You are subscribed to no packs!";
     				$playtoken=0;
    				$output_array['packtext']=$packtext;
                }
        		$output_array['ugc_agreed']=intval($user_info['ugc_agreed']);
            } else {
                $accesstoken='userdatanotfound';
                $exdate='';
                $alloweddevice='';
                $substatus=0;
                // auto signup from here.
                $output_array['consent']=0;
                $pack="nopack";
                $suc="fail";
                $output_array['result']="fail";
                $output_array['token']='notoken';
                $output_array['play']=0;
                $output_array['packcode']=$pack;
                $output_array['packname']=$pack;
                $output_array['ugc_agreed']=0;

    			$packtext="You are subscribed to no packs!";
        		$output_array['packtext']=$packtext;
            }
        } else {
        	$alloweddevice='';
        	$substatus=0;
        	$output_array['consent']=0;
        	$suc="fail";
        	$exdate = '';
        	$accesstoken='';
        	$pack="nopack";
        	$packtext="লগইন করুন এবং যেকোনো একটি প্যাকেজ নির্বাচন করুন";
        	$output_array['result']="fail";
        	$output_array['token']='notoken';
        	$output_array['play']=0;
        	$output_array['packcode']=$pack;
        	$output_array['packname']=$pack;
        	$output_array['packtext']=$packtext;
        	$output_array['ugc_agreed']=0;
        }
//
        $pagename='loginfromapp';
        	$var1='makelogin';
        if ($substatus=='') {
        	$substatus='nosubdata';
        }
        $insert_array_tblPageHitLog = array('pagename' => $pagename, 'msisdn' => $msisdn, 'var1' => $substatus, 'var2' => $pack, 'var3' => $suc, 'referer' => $ref, 'remoteaddr' => $remoteaddr, 'httphost' => $httphost, 'uaprof' => $useragent, 'remoteport' => $remoteport);
        $stmt4 = $this->db->insert('gpboighor.tblPageHitLog_bookapp', $insert_array_tblPageHitLog);

    	$output_array['msisdn']=$msisdn;
    	$output_array['enforce']=0;
    	$output_array['enforcetext']="Dear User, New Update of BoiGhor is available. Please update or app might not work properly.";
    	$output_array['currentversion']=31;
    	$output_array['currentversionios']='1.0.0';
    	$output_array['showbanner']=1;
    	$output_array['boimelaurl']='http://bangladhol.com/boimela2017/bookfair_stall_loc.php';


        if ($alloweddevice=="") {
        	$output_array['concurrent']=0; //0 and 1
        } else {
        	if ($deviceId==$alloweddevice) {
        		$output_array['concurrent']=0; //0 and 1
        	} else {
        		$output_array['concurrent']=1; //0 and 1
        	}
        }
        $output_array['sync']=0; //0 and 1, 0 means unregistered users can sync books

        //  Probably test numbers
        if ($msisdn=='8801919276405' || $msisdn=='8801995571421' || $msisdn=='8801959176721' || $msisdn=='8801993879899') {
        	$output_array['concurrent']=0; //0 and 1
        }


    	$output_array['concurrenttext']="You are signed in from another device, please sign out from that device";

    	$output_array['consenttext']="Free subscription will end soon, please confirm.";
    	$output_array['consenturl']="https://bangladhol.com/bookapiv2/boighor_consent.php";


        $fetchbanner = $this->db->get_where('gpboighor.tblBanner', array('id' => 9))->row_array();
    	if ($fetchbanner) {
    		$output_array['ugc_terms']=$fetchbanner['promodetails'];
        }

        $ugcfoundcount = $this->db->where(array('deleted' => 0, 'msisdn' => $msisdn))->count_all_results('gpboighor.tblBoiMelaSubcriberUGC');


		$output_array['ugc_list']= $ugcfoundcount>0 ? 1 : 0;

        return $output_array;
    }

    public function subscription_schemes() {
        $subschemes = $this->db->select('packname, packname_bn, sub_pack_name AS packcode, packduration, sub_text AS subtext')->order_by('sortorder')->get_where('gpboighor.tblSubscriptionType', array('status' => 1))->result_array();
        return $subschemes;
    }

    public function subscribe($msisdn='', $packcode='') {
        return 1;
    }

	public function get_filename_by_bookcode($bookcode) {
        $data = $this->db->select('filename')->get_where('ebswap.tblBooks', array('bookcode' => $bookcode))->row_array();
        if (isset($data['filename'])) {
            return $data['filename'];
        } else {
            return $data;
        }
	}

//
//
//

    function generatePin($digits = 4){
        $i = 0; //counter
        $pin = ""; //our default pin is blank.
        while($i < $digits){
            //generate a random number between 0 and 9.
            $pin .= mt_rand(0, 9);
            $i++;
        }
        return $pin;
    }

    function get_data($url) {
    	$ch = curl_init();
    	$timeout = 5;
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    	$data = curl_exec($ch);
    	curl_close($ch);
    	return $data;
    }

}
?>
