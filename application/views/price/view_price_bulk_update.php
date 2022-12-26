<div class="content-header p-0">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <table id="tbl_booklist" class="table text-center" width="100%"></table>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-sm btn-outline-primary float-right mb-3" id="btn_save_price"><i class="fas fa-save mr-1"></i><b>Save all Book Prices</b></button>
                        <table id="tbl_selected_books" class="table text-center" width="100%">
                            <thead><th>Cover</th><th>Title</th><th>Writer</th><th>Regular Price</th><th>Discount Price</th><th>Remove</th></thead>
                            <tbody id="tbody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$('#navlink_pricing').addClass('menu-open');
$('#navlink_pricing_bulk_update').addClass('active');
$('.loading').addClass('d-none');

var sl = 99;
var table;
var language = 'all';
var type = '0';
var selectedCategoryName = 'all';
var selectedGenreName = 'all';
var username = '<?php echo $userinfo['username']; ?>';
var current_dataset;
var book_pool_array = <?php echo json_encode($discounted_books) ?>;
var bdt_prices = <?= json_encode($bdt); ?>;

populate_discounted_books();
generateDataTable();

function populate_discounted_books() {
    book_pool_array.forEach((book, i) => {
        insert_book_row(book);
    });
}

function generateDataTable() {
    if (table) {
        table.destroy();
        document.getElementById('tbl_booklist').innerHTML = '';
    }
    table = $('#tbl_booklist').DataTable( {
        processing: true,
        serverSide: true,
        stateSave : true,
        ordering : true,
        hilighting: false,
        responsive: false,
        // pagingType: 'full_numbers',
        ajax: {
            url: "<?php echo base_url(); ?>book/getbooklist",
            type: 'POST',
            data: {
                'category' : selectedCategoryName,
                'genre' : selectedGenreName,
                'language': language,
                'type': type,
            },
            dataFilter: function(data){
                // console.log(jQuery.parseJSON(data));
                sl = jQuery.parseJSON(data)['start'];
                current_dataset = jQuery.parseJSON(data)['data'];
                return data;
            },
            error: function(err){
                console.log(err);
            }
        },
        rowId: 'bookcode',
        order: [ 0, "desc" ],
        columns: [
            // {
            //     "title": "SL",
            //     "data": "timeofentry",
            //     render: function (data, type, service) {
            //         return ++sl;
            //     }
            // },
            {
                "title": "Cover",
                "data": "bookcover_small",
                render: function (data, type, service) {
                    var placeholderImg = "this.src='<?php echo base_url(); ?>images/no_img.png';";
                    var imageViewer = '<img src="https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th/'+data+'" onerror="'+placeholderImg+'" width="50px" />';
                    return imageViewer;
                }
            },
            // {
            //     "title": "Bookcode",
            //     "data": "bookcode"
            // },
            {
                "title": "Title",
                "data": "bookname_bn"
            },
            {
                "title": "Write",
                "data": "writer_bn"
            },
            {
                "title": "Add",
                "data": "bookcode",
                render: function (data, type, row) {
                    var button_1 = '<i class="fas fa-plus-circle fa-2x text-success" onclick="add_book_to_pool(\''+data+'\')"></i>';
                    return button_1;
                }
            }
        ],
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            $("input[data-bootstrap-switch]").each(function() {
              $(this).bootstrapSwitch();
            });
            $('.custom-control-input').on('change', function() {
                makeLivePrompt(this.id.split('_')[1], this.id.split('_')[0], (this.checked ? 1 : 0));
            });
            return "Showing " + iStart +" to "+ iEnd + " of " + iTotal + " Books • Filtered from "+iMax+" Books";
        },
    } );
    // $('#tbl_booklist').DataTable().column(5).visible(selectedCategoryName == 'all' ? true : false);
    // $('#tbl_booklist thead').css("background-color", "#rgb(23, 162, 184)").css("color", "white");
}

function add_book_to_pool(bookcode) {
    // console.log(bookcode);
    var book = current_dataset.find(function(row) {
        return row.bookcode == bookcode;
    })
    // console.log(book);
    // console.log(book_pool_array);
    var is_book_found_in_pool = book_pool_array.find(function(row) {
        return row.bookcode == book.bookcode;
    })
    // console.log(is_book_found_in_pool);
    if (is_book_found_in_pool) {
        // return;
        // console.log('book exists');
    } else {
        // console.log('new book');
        insert_book_row(book);
    }
}

function insert_book_row(book) {
    // document.getElementById("tbody").innerHTML = '';
    const table = document.getElementById("tbody");
    let row = table.insertRow();
    row.id = 'row_'+book.bookcode;

    var book_image = document.createElement("img");
    book_image.src = "https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th/"+book.bookcover_small;
    book_image.onerror = "this.src='<?php echo base_url(); ?>images/no_img.png';";
    book_image.width = "50";
    row.insertCell(0).appendChild(book_image);

    row.insertCell(1).innerHTML = book.bookname_bn;
    row.insertCell(2).innerHTML = book.writer_bn;
    row.insertCell(3).innerHTML = book.bookprice_boighor_bdt;

    var price_select = document.createElement("select");
    price_select.id = "price_select__"+book.bookcode;
    price_select.classList.add("form-control");
    price_select.classList.add("form-control-sm");
    price_select.classList.add("txt_table_price_select");
    price_select.appendChild(document.createElement("option"));
    bdt_prices.forEach( function (price, i) {
        var option = document.createElement("option");
        option.value= price.id;
        option.innerHTML = price.bookprice_bn;
        if ( price.id == book.bookprice_boighor_bdt_disc_id ) {
            option.selected = true;
        }
        price_select.appendChild(option);
    })
    row.insertCell(4).appendChild(price_select);

    var remove_btn = document.createElement("i");
    remove_btn.classList.add("fas");
    remove_btn.classList.add("fa-2x");
    remove_btn.classList.add("fa-minus-circle");
    remove_btn.classList.add("text-danger");
    remove_btn.onclick = function() { remove_book_from_pool(book.bookcode); };
    row.insertCell(5).appendChild(remove_btn);

    book_pool_array.push(book);
}

function remove_book_from_pool(bookcode) {
    // console.log(book_pool_array);
    var row = document.getElementById("row_"+bookcode);
    row.parentNode.removeChild(row);
    var new_pool = book_pool_array.filter(function(row) {
        return row.bookcode != bookcode;
    })
    book_pool_array = new_pool;
    // console.log(new_pool);
}

$('#btn_save_price').click(function(evnt) {
    // return;
    if (book_pool_array.length==0) {
        return;
    }
    final_array = [];
    book_pool_array.forEach((book, i) => {
        global_bdt_id = $('#price_select__'+book.bookcode).val();
        temp_array = {};
        temp_array['bookcode'] = book.bookcode;
        temp_array['global_bdt'] = global_bdt_id;
        final_array.push(temp_array);
    });
    console.log(final_array);

    Swal.fire({
        title: 'Do you want to save?',
        text: 'You are about to save multiple books prices',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {

            // var form_data = new FormData($('#'+e.target.id)[0]);

            var swal = Swal.fire({
                title: 'Please Wait...  &nbsp;&nbsp;  <i class="fas fa-spinner fa-spin"></i>',
                type: 'info',
                html: '<label id="progress_label">Progress: 0%</label><progress id="progress" class="progress-bar bg-primary progress-bar-striped pb-3 mb-3" max="100" style="width:0%; height:100%"></progress>',
                showConfirmButton: false,
                showCloseButton: false,
                showCancelButton: false,
                allowOutsideClick: false,
            });
            var ajax_data = {};
            ajax_data['books'] = final_array;
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            console.log(percentComplete);
                            $('#progress').width(parseInt(percentComplete)+'%');
                            $('#progress_label').text('Progress: '+parseInt(percentComplete)+'%');
                        }
                    }, false);
                    return xhr;
                },
                url: "<?= base_url() ?>price/price_bulk_update",
                method: "POST",
                data: ajax_data,
                // contentType: false,
                // processData: false,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Pricing saved Successfully", "", "success").then((result) => {
                            location.reload();
                            // $('#modal_review_reply').modal('hide');
                        });
                    } else if (data==403) {
                        Swal.fire("Access Denied", "You do not have permission to perform this action", "error").then((result) => {
                            location.reload();
                        });
                    }
                },
                error: function() {
                    Swal.fire("Oops.. Something went wrong!", "", "error").then((result) => {
                        location.reload();
                    });
                }
            });
        }
    });
})

</script>
