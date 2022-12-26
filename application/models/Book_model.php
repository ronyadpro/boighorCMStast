<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->config->item('base_url');
        $this->config->item('api_url');
        $this->load->helper('url');
        $this->load->database();
    }

    // function update_authorCode() {
    //     $all_books = $this->db->get('tblBooks')->result();
    //     foreach ($all_books as $book) {
    //         $writer = $book->writer;
    //         $authorcode = $this->db->select('authorcode')->from('tblBookAuthor')->where('author', $writer)->limit(1)->get()->row();
    //         // return $authorcode->authorcode;
    //         $this->db->where('writer', $writer)->update('tblBooks', array('writercode' => $authorcode->authorcode   ));
    //     }
    // }

    public function get_category_list() {
        return $this->db->order_by('catname_en')->get_where('tblBookCategory', array('isdeleted' => 0))->result();
    }

    public function get_genre_list() {
        return $this->db->order_by('genre_en')->get_where('tblBookGenre', array('isdeleted' => 0))->result();
    }

    function get_booklist_serverside($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $data['recordsTotal'] = $this->db->count_all_results('tblBooks');
        if (isset($post['authorcode'])) {       //  FOR AUTHOR LIST
            if ($post['search']['value']) {
                $data['data'] = $this->db->where('writercode', $post['authorcode'])->where('hideit', 0)
                    ->like('bookname', $post['search']['value'])->or_like('bookname_bn', $post['search']['value'])->or_like('writer', $post['search']['value'])->or_like('writer_bn', $post['search']['value'])->or_like('bookcode', $post['search']['value'])
                    ->join('tblBookCategory', 'tblBookCategory.catcode = tblBooks.category', 'left outer')->limit($post['length'], $post['start'])->order_by($order_col, $order_dir)->get('tblBooks')->result();
                $data['recordsFiltered'] = $this->db->where('writercode', $post['authorcode'])->where('hideit', 0)
                    ->like('bookname', $post['search']['value'])->or_like('bookname_bn', $post['search']['value'])->or_like('writer', $post['search']['value'])->or_like('writer_bn', $post['search']['value'])->or_like('bookcode', $post['search']['value'])
                    ->count_all_results('tblBooks');
                $data['recordsTotal'] = $this->db->where('hideit', 0)->count_all_results('tblBooks');
            } else {
                $data['data'] = $this->db->where('writercode', $post['authorcode'])->where('hideit', 0)->join('tblBookCategory', 'tblBookCategory.catcode = tblBooks.category', 'left outer')
                    ->limit($post['length'], $post['start'])->order_by($order_col, $order_dir)->get('tblBooks')->result();
                $data['recordsFiltered'] = $this->db->where('writercode', $post['authorcode'])->where('hideit', 0)->count_all_results('tblBooks');
                $data['recordsTotal'] = $this->db->where('hideit', 0)->count_all_results('tblBooks');
            }
        } else if ($post['category'] != 'all') {       //  FOR CATEGORY
            if ($post['search']['value']) {
                if ($post['type'] != 'all') $this->db->where('isaudiobook', $post['type']);
                if ($post['language'] != 'all') $this->db->where('isenglishbook', $post['language']);
                $this->db->select('*');
                $this->db->select('(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_bdt');
                $this->db->select('(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_bdt_disc');
                $this->db->select('IF((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode))=(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode)), 1, 0) AS isdiscounted');
                $this->db->select('(SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_usd');
                $data['data'] = $this->db->where('category', $post['category'])
                    ->group_start()->or_like('bookname', $post['search']['value'])->or_like('bookname_bn', $post['search']['value'])->or_like('writer', $post['search']['value'])->or_like('writer_bn', $post['search']['value'])->or_like('bookcode', $post['search']['value'])->group_end()
                    ->join('tblBookCategory', 'tblBookCategory.catcode = tblBooks.category', 'left outer')
                    ->limit($post['length'], $post['start'])->order_by($order_col, $order_dir)->get('tblBooks')->result();
                $data['recordsFiltered'] = $this->db->where('category', $post['category'])->group_start()->or_like('bookname', $post['search']['value'])->or_like('bookname_bn', $post['search']['value'])
                    ->or_like('writer', $post['search']['value'])->or_like('writer_bn', $post['search']['value'])->or_like('bookcode', $post['search']['value'])->group_end()->where('hideit', 0)->count_all_results('tblBooks');
                $data['recordsTotal'] = $this->db->where('hideit', 0)->count_all_results('tblBooks');
            } else {
                if ($post['type'] != 'all') $this->db->where('isaudiobook', $post['type']);
                if ($post['language'] != 'all') $this->db->where('isenglishbook', $post['language']);
                $this->db->select('*');
                $this->db->select('(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_bdt');
                $this->db->select('(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_bdt_disc');
                $this->db->select('IF((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode))=(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode)), 1, 0) AS isdiscounted');
                $this->db->select('(SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_usd');
                $data['data'] = $this->db->where('category', $post['category'])->join('tblBookCategory', 'tblBookCategory.catcode = tblBooks.category', 'left outer')
                    ->limit($post['length'], $post['start'])->order_by($order_col, $order_dir)->get('tblBooks')->result();
                if ($post['type'] != 'all') $this->db->where('isaudiobook', $post['type']);
                if ($post['language'] != 'all') $this->db->where('isenglishbook', $post['language']);
                $data['recordsFiltered'] = $this->db->where('category', $post['category'])->where('hideit', 0)->count_all_results('tblBooks');
                $data['recordsTotal'] = $this->db->where('hideit', 0)->count_all_results('tblBooks');
            }
        } else if ($post['genre'] != 'all') {       //  FOR GENRE
            $genList = $this->db->select('id, bookcode')->group_by('bookcode')->get_where('tblBookGenreTagging', array('genrecode' => $post['genre']))->result();
            $genList = json_decode(json_encode($genList), true);
            $genListArray = array_column($genList, 'bookcode');
            if (!$genListArray) {
                $data['data'] = array();
                $data['recordsFiltered'] = array();
            } else if ($post['search']['value']) {
                if ($post['type'] != 'all') $this->db->where('isaudiobook', $post['type']);
                if ($post['language'] != 'all') $this->db->where('isenglishbook', $post['language']);
                $this->db->select('*');
                $this->db->select('(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_bdt');
                $this->db->select('(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_bdt_disc');
                $this->db->select('IF((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode))=(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode)), 1, 0) AS isdiscounted');
                $this->db->select('(SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_usd');
                $data['data'] = $this->db->where_in('bookcode', $genListArray)
                    ->group_start()->or_like('bookname', $post['search']['value'])->or_like('bookname_bn', $post['search']['value'])->or_like('writer', $post['search']['value'])->or_like('writer_bn', $post['search']['value'])->or_like('bookcode', $post['search']['value'])->group_end()
                    ->join('tblBookCategory', 'tblBookCategory.catcode = tblBooks.category', 'left outer')
                    ->limit($post['length'], $post['start'])->order_by($order_col, $order_dir)->get('tblBooks')->result();
                if ($post['type'] != 'all') $this->db->where('isaudiobook', $post['type']);
                if ($post['language'] != 'all') $this->db->where('isenglishbook', $post['language']);
                $data['recordsFiltered'] = $this->db->where_in('bookcode', $genListArray)->group_start()->or_like('bookname', $post['search']['value'])->or_like('bookname_bn', $post['search']['value'])
                    ->or_like('writer', $post['search']['value'])->or_like('writer_bn', $post['search']['value'])->or_like('bookcode', $post['search']['value'])->group_end()->where('hideit', 0)->count_all_results('tblBooks');
                $data['recordsTotal'] = $this->db->where('hideit', 0)->count_all_results('tblBooks');
            } else {       //  FOR REGULAR
                if ($post['type'] != 'all') $this->db->where('isaudiobook', $post['type']);
                if ($post['language'] != 'all') $this->db->where('isenglishbook', $post['language']);
                $this->db->select('*');
                $this->db->select('(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_bdt');
                $this->db->select('(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_bdt_disc');
                $this->db->select('IF((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode))=(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode)), 1, 0) AS isdiscounted');
                $this->db->select('(SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_usd');
                $data['data'] = $this->db->from('tblBooks')->where_in('bookcode', $genListArray)->join('tblBookCategory', 'tblBookCategory.catcode = tblBooks.category', 'left outer')
                    ->limit($post['length'], $post['start'])->order_by($order_col, $order_dir)->get()->result();
                if ($post['type'] != 'all') $this->db->where('isaudiobook', $post['type']);
                if ($post['language'] != 'all') $this->db->where('isenglishbook', $post['language']);
                $data['recordsFiltered'] = $this->db->where_in('bookcode', $genListArray)->where('hideit', 0)->count_all_results('tblBooks');
                $data['recordsTotal'] = $this->db->where('hideit', 0)->count_all_results('tblBooks');
            }
        } else {
            if ($post['search']['value']) {
                if ($post['type'] != 'all') $this->db->where('isaudiobook', $post['type']);
                if ($post['language'] != 'all') $this->db->where('isenglishbook', $post['language']);
                $this->db->select('*');
                $this->db->select('(SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) AS bookprice_boighor_bdt_disc_id');
                $this->db->select('(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_bdt');
                $this->db->select('(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_bdt_disc');
                $this->db->select('IF((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode))=(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode)), 1, 0) AS isdiscounted');
                $this->db->select('(SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_usd');
                $data['data'] = $this->db->group_start()->or_like('bookname', $post['search']['value'])->or_like('bookname_bn', $post['search']['value'])
                    ->or_like('writer', $post['search']['value'])->or_like('writer_bn', $post['search']['value'])->or_like('bookcode', $post['search']['value'])->group_end()
                    ->join('tblBookCategory', 'tblBookCategory.catcode = tblBooks.category', 'left outer')
                    ->limit($post['length'], $post['start'])->order_by($order_col, $order_dir)->get_where('tblBooks', array('hideit' => 0))->result();
                if ($post['type'] != 'all') $this->db->where('isaudiobook', $post['type']);
                if ($post['language'] != 'all') $this->db->where('isenglishbook', $post['language']);
                $data['recordsFiltered'] = $this->db->group_start()->or_like('bookname', $post['search']['value'])->or_like('bookname_bn', $post['search']['value'])->or_like('writer', $post['search']['value'])
                    ->or_like('writer_bn', $post['search']['value'])->or_like('bookcode', $post['search']['value'])->group_end()->where('hideit', 0)->count_all_results('tblBooks');
                $data['recordsTotal'] = $this->db->where('hideit', 0)->count_all_results('tblBooks');
            } else {
                if ($post['type'] != 'all') $this->db->where('isaudiobook', $post['type']);
                if ($post['language'] != 'all') $this->db->where('isenglishbook', $post['language']);
                $this->db->select('*');
                $this->db->select('(SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) AS bookprice_boighor_bdt_disc_id');
                $this->db->select('(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_bdt');
                $this->db->select('(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_bdt_disc');
                $this->db->select('IF((SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt_disc FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode))=(SELECT bookprice_bn FROM tblBookPrice WHERE id = (SELECT global_bdt FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode)), 0, 1) AS isdiscounted');
                $this->db->select('(SELECT price FROM tblBookPriceGlobal WHERE id = (SELECT global_usd FROM tblBookPriceTagging WHERE bookcode = tblBooks.bookcode) ) AS bookprice_boighor_usd');
                $data['data'] = $this->db->join('tblBookCategory', 'tblBookCategory.catcode = tblBooks.category', 'left outer')
                    ->limit($post['length'], $post['start'])->order_by($order_col, $order_dir)->get_where('tblBooks', array('hideit' => 0))->result();
                if ($post['type'] != 'all') $this->db->where('isaudiobook', $post['type']);
                if ($post['language'] != 'all') $this->db->where('isenglishbook', $post['language']);
                $data['recordsFiltered'] = $this->db->where('hideit', 0)->count_all_results('tblBooks');
                $data['recordsTotal'] = $data['recordsFiltered'];
            }
        }
        return $data;
    }

    function get_info_new_book() {
        $data['authorlist'] = $this->db->where('deleted', 0)->order_by('author', 'asc')->get('tblBookAuthor')->result();
        $data['publisherlist'] = $this->db->order_by('publishername_en', 'asc')->get('tblBookPublisher')->result();
        $data['categoryList'] = $this->db->where('isdeleted', 0)->order_by('catname_en', 'asc')->get('tblBookCategory')->result();
        $data['genreList'] = $this->db->where('isdeleted', 0)->order_by('genre_en', 'asc')->get('tblBookGenre')->result();
        $data['localPriceList'] = $this->db->select('id, bookprice, price_bn, bookprice_bn, bookprice_en')->order_by('sortorder')->get_where('tblBookPrice', array('servicename' => 'banglalink'))->result_array();
        $data['globalPriceList'] = $this->db->select('id, price')->where('servicename','boighorglobal')->order_by('sortorder')->get('tblBookPriceGlobal')->result_array();
        return $data;
    }

    function get_book_details($bookcode='') {
        $data = $this->db->select('*, tblBooks.royalty_percent AS royalty_percent, tblBooks.updatedby AS updatedby')
            ->join('tblBookCategory', 'tblBookCategory.catcode = tblBooks.category', 'left outer')
            ->join('tblBookPublisher', 'tblBookPublisher.publishercode = tblBooks.publishercode', 'left outer')
            ->get_where("tblBooks", "bookcode = '$bookcode'")->row();
        $data->publisherlist = $this->db->order_by('publishername_en', 'asc')->get('tblBookPublisher')->result();
        $data->categoryList = $this->db->where('isdeleted', 0)->order_by('catname_en', 'asc')->get('tblBookCategory')->result();
        $data->genreList = $this->db->where('isdeleted', 0)->order_by('genre_en', 'asc')->get('tblBookGenre')->result();
        $data->previews = $this->db->where('bookcode', $bookcode)->order_by('prev_serial')->get('tblBookPreview')->result();
        $data->pricelistblink = $this->db->where('servicename', 'banglalink')->order_by('cast(bookprice as unsigned)')->get('tblBookPrice')->result();
        $data->pricelistairtel = $this->db->where('servicename', 'airtel')->order_by('cast(bookprice as unsigned)')->get('tblBookPrice')->result();
        $data->pricelistrobi = $this->db->where('servicename', 'robi')->order_by('cast(bookprice as unsigned)')->get('tblBookPrice')->result();
        $data->pricelistgp = $this->db->where('servicename', 'gp')->order_by('cast(bookprice as unsigned)')->get('tblBookPrice')->result();
        $data->pricelistbdt = $this->db->where('servicename', 'boighorglobal')->order_by('cast(bookprice as unsigned)')->get('tblBookPrice')->result();
        $data->pricelistusd = $this->db->where('servicename','boighorglobal')->order_by('sortorder')->get('tblBookPriceGlobal')->result();
        $data->prices = $this->db->get_where('tblBookPriceTagging', array('bookcode' => $bookcode))->row();
        $tags = $this->db->from('tblBookTagging')->where('code', $bookcode)->where('tagtype', 0)->get()->result();
        $genres = $this->db->select('genrecode')->where('bookcode', $bookcode)->get('tblBookGenreTagging')->result();
        $adbcode = $this->db->get_where('tblBooks', array('adb_has_book' => $bookcode))->row();
        $data->adbcode = $adbcode ? $adbcode->bookcode: '';

        $data->favouritecount = $this->db->where("bookcode",$bookcode)->where("deleted",0)->count_all_results('tblFavourites');
        $data->soldcount = $this->db->where("bookcode",$bookcode)->where("orderstatus","delivered")->where("paymentStatus","CHARGED")->where('DATE(tblPaymentNotification.timeofentry) > "2021-03-17"')->join('boighor.tblPaymentNotification','boighor.tblPaymentNotification.orderId = boighor.tblOrderDetails.orderid', 'inner')->count_all_results('tblOrderDetails');

        if ($data->isaudiobook) {
            $data->audiobooks = $this->db->get_where('tblBookAudios', array('bookcode' => $bookcode))->result();
        } else {
            $data->audiobooks = array();
        }


        $tag_string_arr = array();
        foreach ($tags as $row) {
            array_push($tag_string_arr, $row->tags);
        }

        $genrelist = array();
        foreach ($genres as $row) {
            array_push($genrelist, $row->genrecode);
        }

        $data->tags = $tag_string_arr;
        $data->genres = $genrelist;

        return get_object_vars($data);
    }

    public function update_book_info_by_bookcode($post) {
        if (!empty($post['category'])) {
            $category = $this->db->select('catname_en AS category_en, catname_bn AS category_bn')->where('catcode',$post['category'])->limit(1)->get('tblBookCategory')->row_array();
            $post = array_merge($post,$category);
        }
        return $this->db->where('bookcode', $post['bookcode'])->limit(1)->update('tblBooks', $post);
    }

    public function update_genres_by_bookcode($bookcode, $genrelist, $username) {
        if (isset($genrelist['add']) && $genrelist['add']) {
            foreach ($genrelist['add'] as $genrecode) {
                $resp = $this->db->insert('tblBookGenreTagging', array('bookcode' => $bookcode, 'genrecode' => $genrecode, 'createdby' => $username));
                if (!$resp) { return 0; }
            }
        }
        if (isset($genrelist['delete']) && $genrelist['delete']) {
            foreach ($genrelist['delete'] as $genrecode) {
                $resp = $this->db->limit(1)->delete('tblBookGenreTagging', array('bookcode' => $bookcode, 'genrecode' => $genrecode));
                if (!$resp) { return 0; }
            }
        }
        return 1;
    }

    public function update_tags_by_code($code, $tagtype, $data, $username) {
        if (isset($data['add']) && $data['add']) {
            foreach ($data['add'] as $tag) {
                $resp = $this->db->insert('tblBookTagging', array('code' => $code, 'tagtype' => $tagtype, 'tags' => $tag, 'updatedby' => $username));
                if (!$resp) { return 0; }
            }
        }
        if (isset($data['delete']) && $data['delete']) {
            foreach ($data['delete'] as $tag) {
                $resp = $this->db->limit(1)->delete('tblBookTagging', array('code' => $code, 'tagtype' => $tagtype, 'tags' => $tag));
                if (!$resp) { return 0; }
            }
        }
        return 1;
    }

    public function update_fileInfo_by_bookCode($bookcode, $type, $filename) {
        if ($type == 'ebook' || $type == 'book_preview' || $type == 'cover' || $type == 'plain' || $type == 'square' || $type == 'fb') {
            $columnName = '';
            if ($type == 'ebook') {
                return $this->db->where('bookcode', $bookcode)->update('tblBooks', array('filename' => $filename));
            } else if ($type == 'book_preview') {
                return $this->db->where('bookcode', $bookcode)->update('tblBooks', array('ebook_preview'=>1));
            } else if ($type == 'square') {
                return $this->db->where('bookcode', $bookcode)->update('tblBooks', array('file_square'=>1,'bookcover_square' => $filename));
            } else if ($type == 'fb') {
                return $this->db->where('bookcode', $bookcode)->update('tblBooks', array('file_share'=>1,'banner_fb' => $filename));
            } else if ($type == 'plain') {
                return $this->db->where('bookcode', $bookcode)->update('tblBooks', array('file_plain' => 1,'bookcover_small' => $filename));
            } else {
                return $this->db->where('bookcode', $bookcode)->update('tblBooks', array('file_crease' => 1,'bookcover_small' => $filename));
            }
        } else {
            $this->load->library('session');
            $prev_serial = substr($type, -1)+1;
            $isixist = $this->db->from('tblBookPreview')->where('bookcode', $bookcode)->where('prev_serial', $prev_serial)->count_all_results();
            if ($isixist) {
                return $this->db->where('bookcode', $bookcode)->where('prev_serial', $prev_serial)->update('tblBookPreview', array('prev_name' => $filename, 'status' => 1, 'addedby' => $this->session->userdata('username')));
            } else {
                return $this->db->insert('tblBookPreview', array('bookcode' => $bookcode, 'prev_serial' => $prev_serial, 'prev_name' => $filename, 'status' => 1, 'addedby' => $this->session->userdata('username')));
            }
        }
    }

    public function add_new_book($data, $username) {
        $bookid = $this->db->query("SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'boighor' AND   TABLE_NAME   = 'tblBooks'")->row()->AUTO_INCREMENT;
        $bookcode = ($data['isaudiobook']?'ab':'eb').str_pad($bookid, 6, 0, STR_PAD_LEFT);

        $data['bookcode'] = $bookcode;
        $data['addedby'] = $username;
        $data['dateofaddition'] = date('Y-m-d H:i:s');

        $this->db->insert('tblBooks', $data);
        $insert_flag = $this->db->affected_rows();

        return $insert_flag ? $bookcode : 0;
    }

    public function add_new_book_scope($data, $username) {
        $data['addedby'] = $username;
        $data['dateofaddition'] = date('Y-m-d H:i:s');
        $category = $this->db->select('catname_en AS category_en, catname_bn AS category_bn')->where('catcode',$data['category'])->limit(1)->get('tblBookCategory')->row_array();
        $data = array_merge($data,$category);
        $insert_flag = $this->db->insert('tblBookScope', $data);
        return $insert_flag ? 1 : 0;
    }

    public function get_book_scopes($post){
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $data['recordsTotal'] = $this->db->count_all_results('tblBookScope');
        if ($post['search']['value']) {
            $skey = $post['search']['value'];
            $this->db->like('bookname',$skey)->or_like('bookname_bn',$skey)->or_like('writercode',$skey)->or_like('writer',$skey)->or_like('writer_bn',$skey)->or_like('category_en',$skey)->or_like('category_bn',$skey)->or_like('publishercode',$skey)->or_like('publisher',$skey)->or_like('publisher_bn',$skey);
            $data['data'] = $this->db->limit($post['length'], $post['start'])->order_by($order_col, $order_dir)->get('tblBookScope')->result();
            $data['recordsFiltered'] = $this->db->like('bookname',$skey)->or_like('bookname_bn',$skey)->or_like('writercode',$skey)->or_like('writer',$skey)->or_like('writer_bn',$skey)->or_like('category_en',$skey)->or_like('category_bn',$skey)->or_like('publishercode',$skey)->or_like('publisher',$skey)->or_like('publisher_bn',$skey)->count_all_results('tblBookScope');
        } else {
            $data['data'] = $this->db->limit($post['length'], $post['start'])->order_by($order_col, $order_dir)->get('tblBookScope')->result();
            $data['recordsFiltered'] = $data['recordsTotal'];
        }
        return $data;
    }

    public function change_book_status_by_bookcode($bookcode, $platform, $status) {
        $this->db->where('bookcode', $bookcode)->limit(1)->update('tblBooks', array($platform => $status));
        $this->update_all_book_counts();
        return 1;
    }

    public function change_book_status_for_all_platform($statuses) {
        $resp = $this->db->limit(1)->where('bookcode', $statuses['bookcode'])->update('tblBooks', $statuses);
        $this->update_all_book_counts();
        return $resp;
    }

    function postLogs($client, $querytype, $msg, $json, $response, $responsecode, $track){

        $this->load->library('user_agent');
        $this->load->library('session');

        $data['client'] = $client;
        $data['querytype'] = $querytype;
        $data['message'] = $msg;
        $data['request'] = json_encode($json);
        $data['response'] = $response;
        $data['responsecode'] = $responsecode;

        $data['remote_ip'] = $this->input->server('REMOTE_ADDR');
        $data['uaprof'] = $this->agent->agent_string();
        $data['referer_track'] = $track;
        $data['referer'] = $this->agent->referrer();
        $data['entryby'] = $this->session->userdata('username');

        $this->db->insert('tbl_Log_Report', $data);
    }

    public function check_duplicate($bookcode) {
        return $this->db->where('bookcode', $bookcode)->count_all_results('tblBooks');
    }

    public function check_live_validity($bookcode) {
        $empty_fields = array();
        $data = $this->db->select('booksummary, bookcover_small, filename, isaudiobook')->where(array('bookcode'=>$bookcode))->get('tblBooks')->row();
        $prices = $this->db->select('global_bdt, global_usd, airtel, robi, gp, blink')->where(array('bookcode'=>$bookcode))->get('tblBookPriceTagging')->row_array();
        if ($data->isaudiobook==0 && $data->filename == ''){
            array_push($empty_fields, 'Epub file');
        }
        if ($data->booksummary == ''){
            array_push($empty_fields, 'Book Summary');
        }
        if ($data->bookcover_small == ''){
            array_push($empty_fields, 'Book Cover');
        }
        if ($this->db->where(array('code'=>$bookcode, 'tagtype'=>0))->count_all_results('tblBookTagging') == 0){
            array_push($empty_fields, 'Title Tags');
        }
        if ($prices['global_bdt']==0 || $prices['global_usd']==0 || $prices['airtel']==0 || $prices['robi']==0 || $prices['gp']==0 || $prices['blink']==0) {
            array_push($empty_fields, 'Price');
        }
        // if ($this->db->where(array('bookcode'=>$bookcode))->count_all_results('tblBookPreview') == 0){
        //     array_push($empty_fields, 'Book Previews');
        // }
        return $empty_fields;
    }

    public function get_categories_serverside($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $this->db->where('isdeleted', '0');
        if ($post['search']['value']) {
            $this->db->like('catcode', $post['search']['value'])->or_like('catname_bn', $post['search']['value'])->or_like('catname_en', $post['search']['value']);
        }
        $data['data'] = $this->db->order_by($order_col, $order_dir)->limit($post['length'], $post['start'])->get('tblBookCategory')->result();
        foreach ($data['data'] as $row) {
            $row->count = $this->db->where('category', $row->catcode)->count_all_results('tblBooks');
        }
        $data['recordsFiltered'] = $this->db->where('isdeleted', '0')->count_all_results('tblBookCategory');
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function get_genres_serverside($post) {
        $data['start'] = $post['start'];
        $data['draw'] = $post['draw'];
        $order_col = $post['columns'][$post['order'][0]['column']]['data'];
        $order_dir = $post['order'][0]['dir'];
        $this->db->where('isdeleted', '0');
        if ($post['search']['value']) {
            $this->db->like('genre_code', $post['search']['value'])->or_like('genre_en', $post['search']['value'])->or_like('genre_bn', $post['search']['value']);
        }
        $this->db->select('*');
        $this->db->select('(SELECT COUNT(*) FROM tblBookGenreTagging WHERE tblBookGenreTagging.genrecode = tblBookGenre.genre_code) AS count');
        $data['data'] = $this->db->order_by($order_col, $order_dir)->limit($post['length'], $post['start'])->get('tblBookGenre')->result();
        $data['recordsFiltered'] = $this->db->where('isdeleted', '0')->count_all_results('tblBookGenre');
        $data['recordsTotal'] = $data['recordsFiltered'];
        return $data;
    }

    public function get_genres_tags_by_code($code) {
        $response = $this->db->select('tags')->get_where('tblBookTagging', array('code' => $code, 'tagtype'=>'3'))->result();
        $taglist = array();
        foreach ($response as $row) {
            array_push($taglist, $row->tags);
        }
        return $taglist;
    }

    public function get_category_tags_by_code($code) {
        $response = $this->db->select('tags')->get_where('tblBookTagging', array('code' => $code, 'tagtype'=>'2'))->result();
        $taglist = array();
        foreach ($response as $row) {
            array_push($taglist, $row->tags);
        }
        return $taglist;
    }

    public function add_new_genre($data) {
        $isexists =  $this->db->where('genre_code', $data['genre_code'])->count_all_results('tblBookGenre');
        if ($isexists) {
            return 2;
        } else {
            return $this->db->insert('tblBookGenre', $data);
        }
    }

    public function edit_genre($data) {
        return $this->db->where('genre_code', $data['genre_code'])->limit(1)->update('tblBookGenre', $data);
    }

    public function edit_genre_tags($tags) {

    }

    public function get_genre_sorted_list() {
        return $this->db->where('show_in_home',1)->order_by('sortorder')->get('tblBookGenre')->result_array();
    }

    public function save_genre_sortorder($genrecodes) {
        foreach ($genrecodes as $key => $genre) {
            $this->db->where('genre_code',$genre)->set('sortorder',$key)->limit(1)->update('tblBookGenre');
        }
        return 1;
    }

    public function add_new_category($data) {
        $isexists =  $this->db->where('catcode', $data['catcode'])->count_all_results('tblBookCategory');
        if ($isexists) {
            return 2;
        } else {
            return $this->db->insert('tblBookCategory', $data);
        }
    }

    public function edit_category($data) {
        return $this->db->where('catcode', $data['catcode'])->limit(1)->update('tblBookCategory', $data);
    }

    public function update_pricing_by_bookcode($data) {
        $resp = $this->db->where('bookcode', $data['bookcode'])->limit(1)->update('tblBookPriceTagging', $data);
        if ($resp) {
            $productid_googleplay = $this->db->where('id',$data['global_usd'])->get('tblBookPriceGlobal')->row_array()['productid_googleplay'];
            // $productid_appstore = $this->db->where('id',$data['aiap_usd'])->get('tblBookPriceGlobal')->row_array()['productid_appstore'];
            $resp = $this->db->where('bookcode', $data['bookcode'])->set('productid_googleplay',$productid_googleplay)/*->set('productid_appstore',$productid_appstore)*/->limit(1)->update('tblBooks');
        }
        return $resp?1:0;
    }

    // public function updatePricing() {
    //     $booklist = $this->db->select('bookcode, isopen, bookprice, bookprice_global')->get('tblBooks')->result();
    //     foreach ($booklist as $book) {
    //         $local_price_id = 0;
    //         if ($book->bookprice == 0) {
    //             if ($book->isopen == 0) {
    //                 $local_price_id = 4;
    //             } else {
    //                 $local_price_id = 5;
    //             }
    //         } else if ($book->bookprice == 5) {
    //             $local_price_id = 6;
    //         } else if ($book->bookprice == 10) {
    //             $local_price_id = 1;
    //         } else if ($book->bookprice == 15) {
    //             $local_price_id = 2;
    //         } else if ($book->bookprice == 20) {
    //             $local_price_id = 3;
    //         }
    //
    //         $global_price_id = 0;
    //         if ($book->bookprice_global == 0) {
    //             $global_price_id = 1;
    //         } else if ($book->bookprice_global == 0.99) {
    //             $global_price_id = 2;
    //         } else if ($book->bookprice_global == 1.99) {
    //             $global_price_id = 3;
    //         } else if ($book->bookprice_global == 2.99) {
    //             $global_price_id = 4;
    //         } else if ($book->bookprice_global == 3.99) {
    //             $global_price_id = 5;
    //         } else if ($book->bookprice_global == 4.99) {
    //             $global_price_id = 6;
    //         }
    //
    //
    //         $arr =  array(
    //             'bookcode' => $book->bookcode,
    //             'global_bdt' => $local_price_id,
    //             'global_usd' => $global_price_id,
    //             'airtel' => $local_price_id,
    //             'robi' => $local_price_id,
    //             'gp' => $local_price_id,
    //             'blink' => $local_price_id,
    //             'createdby' => 'shuvodeep'
    //         );
    //         $this->db->insert('tblBookPriceTagging', $arr);
    //
    //     }
    // }

    public function get_all_books() {
        return $this->db->select('bookcode, bookname, bookcover_small, writer')->limit(20)->get('tblBooks')->result();
    }

    public function add_audiobook($post) {
        return $this->db->insert('tblBookAudios', $post);
    }

    public function edit_audiobook_preview($post) {
        $rowid = $post['rowid'];
        unset($post['rowid']);
        return $this->db->limit(1)->where('id', $rowid)->update('tblBookAudios', $post);
    }

    public function change_adb_status($id='', $status='') {
        return $this->db->limit(1)->where('id', $id)->update('tblBookAudios', array('status' => $status));
    }

    public function add_audiobook_preview($bookcode) {
        return $this->db->limit(1)->where('bookcode', $bookcode)->update('tblBooks', array('adb_preview' => 1));
    }

    public function get_books_for_ddl() {
        return $this->db->select('bookcode, bookname, bookname_bn')->where('hideit',0)->get('tblBooks')->result_array();
    }

//============================================================================================================================================================


    public function update_all_book_counts() {
        $this->updateAuthorLiveBookCount();
        $this->updateCategoryLiveBookCount();
        $this->updateGenreLiveBookCount();
        $this->db->cache_delete_all();
    }

    public function updateAuthorLiveBookCount() {
        $this->db->select('writercode, COUNT(*) AS numberofbooks, SUM(status) AS numberoflivebooks');
        $this->db->select('SUM(status_gp) AS numberoflivebooks_gp');
        $this->db->select('SUM(status_global) AS numberoflivebooks_global');
        $this->db->select('SUM(status_robi) AS numberoflivebooks_robi');
        $this->db->select('SUM(status_airtel) AS numberoflivebooks_airtel');
        $this->db->select('SUM(status_blink) AS numberoflivebooks_blink');
        $bookcountarray = $this->db->where(array('isaudiobook'=>0, 'hideit'=>0))->group_by('writercode')->get('tblBooks')->result_array();
        foreach ($bookcountarray as $key => $row) {
            $this->db->limit(1)->where('authorcode',$row['writercode'])
            ->set('numberofbooks', $row['numberofbooks'])
            ->set('numberoflivebooks', $row['numberoflivebooks'])
            ->set('numberoflivebooks_gp', $row['numberoflivebooks_gp'])
            ->set('numberoflivebooks_global', $row['numberoflivebooks_global'])
            ->set('numberoflivebooks_robi', $row['numberoflivebooks_robi'])
            ->set('numberoflivebooks_airtel', $row['numberoflivebooks_airtel'])
            ->set('numberoflivebooks_blink', $row['numberoflivebooks_blink'])
            ->update('tblBookAuthor');
        }
        return 1;
    }

    public function updateCategoryLiveBookCount() {
        $this->db->select('category, SUM(status) AS numberoflivebooks');
        $this->db->select('SUM(status_gp) AS numberoflivebooks_gp');
        $this->db->select('SUM(status_global) AS numberoflivebooks_global');
        $this->db->select('SUM(status_robi) AS numberoflivebooks_robi');
        $this->db->select('SUM(status_airtel) AS numberoflivebooks_airtel');
        $this->db->select('SUM(status_blink) AS numberoflivebooks_blink');
        $bookcountarray = $this->db->where(array('isaudiobook'=>0, 'hideit'=>0))->group_by('category')->get('tblBooks')->result_array();
        foreach ($bookcountarray as $key => $row) {
            $this->db->limit(1)->where('catcode',$row['category'])
            ->set('numberoflivebooks', $row['numberoflivebooks'])
            ->set('numberoflivebooks_gp', $row['numberoflivebooks_gp'])
            ->set('numberoflivebooks_global', $row['numberoflivebooks_global'])
            ->set('numberoflivebooks_robi', $row['numberoflivebooks_robi'])
            ->set('numberoflivebooks_airtel', $row['numberoflivebooks_airtel'])
            ->set('numberoflivebooks_blink', $row['numberoflivebooks_blink'])
            ->update('tblBookCategory');
        }
        return 1;
    }

    public function updateGenreLiveBookCount() {

        $livebookcountarray = $this->db->query("SELECT genrecode, COUNT(*) AS count FROM tblBookGenreTagging WHERE (SELECT tblBooks.hideit FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) = 0 AND (SELECT tblBooks.isaudiobook FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) = 0 AND (SELECT tblBooks.status FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) GROUP BY genrecode")->result_array();

        $livebookcountarray_gp = $this->db->query("SELECT genrecode, COUNT(*) AS count FROM tblBookGenreTagging WHERE (SELECT tblBooks.hideit FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) = 0 AND (SELECT tblBooks.isaudiobook FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) = 0 AND (SELECT tblBooks.status_gp FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) GROUP BY genrecode")->result_array();

        $livebookcountarray_global = $this->db->query("SELECT genrecode, COUNT(*) AS count FROM tblBookGenreTagging WHERE (SELECT tblBooks.hideit FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) = 0 AND (SELECT tblBooks.isaudiobook FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) = 0 AND (SELECT tblBooks.status_global FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) GROUP BY genrecode")->result_array();

        $livebookcountarray_robi = $this->db->query("SELECT genrecode, COUNT(*) AS count FROM tblBookGenreTagging WHERE (SELECT tblBooks.hideit FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) = 0 AND (SELECT tblBooks.isaudiobook FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) = 0 AND (SELECT tblBooks.status_robi FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) GROUP BY genrecode")->result_array();

        $livebookcountarray_airtel = $this->db->query("SELECT genrecode, COUNT(*) AS count FROM tblBookGenreTagging WHERE (SELECT tblBooks.hideit FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) = 0 AND (SELECT tblBooks.isaudiobook FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) = 0 AND (SELECT tblBooks.status_airtel FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) GROUP BY genrecode")->result_array();

        $livebookcountarray_blink = $this->db->query("SELECT genrecode, COUNT(*) AS count FROM tblBookGenreTagging WHERE (SELECT tblBooks.hideit FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) = 0 AND (SELECT tblBooks.isaudiobook FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) = 0 AND (SELECT tblBooks.status_blink FROM tblBooks WHERE tblBooks.bookcode = tblBookGenreTagging.bookcode) GROUP BY genrecode")->result_array();

        foreach ($livebookcountarray as $key => $row) {
            $this->db->limit(1)->where('genre_code',$row['genrecode'])->set('numberoflivebooks', $row['count'])->update('tblBookGenre');
        }
        foreach ($livebookcountarray_gp as $key => $row) {
            $this->db->limit(1)->where('genre_code',$row['genrecode'])->set('numberoflivebooks_gp', $row['count'])->update('tblBookGenre');
        }
        foreach ($livebookcountarray_global as $key => $row) {
            $this->db->limit(1)->where('genre_code',$row['genrecode'])->set('numberoflivebooks_global', $row['count'])->update('tblBookGenre');
        }
        foreach ($livebookcountarray_robi as $key => $row) {
            $this->db->limit(1)->where('genre_code',$row['genrecode'])->set('numberoflivebooks_robi', $row['count'])->update('tblBookGenre');
        }
        foreach ($livebookcountarray_airtel as $key => $row) {
            $this->db->limit(1)->where('genre_code',$row['genrecode'])->set('numberoflivebooks_airtel', $row['count'])->update('tblBookGenre');
        }
        foreach ($livebookcountarray_blink as $key => $row) {
            $this->db->limit(1)->where('genre_code',$row['genrecode'])->set('numberoflivebooks_blink', $row['count'])->update('tblBookGenre');
        }
        return 1;
    }
}
?>
