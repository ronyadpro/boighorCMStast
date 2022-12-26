<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <h1 class="m-0 text-dark">Book List</h1>
            </div>
            <?php if (true): ?>
                <div class="col-sm-8">
                    <div class="row justify-content-center">
                        <div class="col-sm-2">
                            <select class="form-control" name="txt_language" id="txt_language">
                                <option value="all">Language</option>
                                <option value="0">Bangla</option>
                                <option value="1">English</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><b>Category :</b></div>
                                </div>
                                <select class="form-control" name="txt_category" id="txt_category">
                                    <option value="all">All</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo $category->catcode ?>"><?php echo $category->catname_en.' • '.$category->catname_bn ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><b>Genre :</b></div>
                                </div>
                                <select class="form-control" name="txt_genre" id="txt_genre">
                                    <option value="all">All</option>
                                    <?php foreach ($genres as $genre): ?>
                                        <option value="<?php echo $genre->genre_code ?>"><?php echo $genre->genre_en.' • '.$genre->genre_bn ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="txt_type" id="txt_type">
                                <option value="all">Type</option>
                                <option value="0">e-Book</option>
                                <option value="1" <?php echo $type=='audiobook' ? ' selected' : ''?>>Audio Book</option>
                            </select>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-sm-8">
                    <div class="row mb-4 justify-content-center">
                        <div class="btn-group" role="group">
                            <button type="button" id="all" class="btn btn-secondary" onclick="changeTab(this.id);">All</button>
                            <button type="button" id="str" class="btn btn-dark btn-outline-info" onclick="changeTab(this.id);">গল্প</button>
                            <button type="button" id="nov" class="btn btn-dark btn-outline-info" onclick="changeTab(this.id);">উপন্যাস</button>
                            <button type="button" id="pom" class="btn btn-dark btn-outline-info" onclick="changeTab(this.id);">কবিতা</button>
                            <button type="button" id="cmx" class="btn btn-dark btn-outline-info" onclick="changeTab(this.id);">কমিক্স</button>
                            <!-- <button type="button" id="cld" class="btn btn-dark btn-outline-info" onclick="changeTab(this.id);">শিশুসাহিত্য</button> -->
                            <button type="button" id="otr" class="btn btn-dark btn-outline-info" onclick="changeTab(this.id);">অন্যান্য</button>
                            <!-- <button type="button" id="adb" class="btn btn-dark btn-outline-info" onclick="changeTab(this.id);">অডিও বই</button> -->
                            <button type="button" id="eng" class="btn btn-dark btn-outline-info" onclick="changeTab(this.id);">ইংরেজি বই</button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-sm-2">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Books</li>
                </ol>
            </div>
        </div>

        <div class="row mb-2 justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="tbl_booklist" class="table table-sm table-hover" width="100%"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// $('input[name$="navlink"]').each(function() {
//   $(this).removeClass('active');
// });
$('#navlink_books').addClass('menu-open');
$('#navlink_booklist').addClass('active');
$('.loading').addClass('d-none');

var sl = 99;
var table;
var language = 'all';
var type = '<?php echo $type=='audiobook' ? '1' : 'all'?>';
var selectedCategoryName = 'all';
var selectedGenreName = 'all';
// var groupButtonsIds = [ 'all', 'str', 'nov', 'pom', 'cld', 'otr', 'cmx', 'adb', 'eng' ];
var groupButtonsIds = [ 'all', 'str', 'nov', 'pom', 'cmx', 'otr', 'eng' ];

var username = '<?php echo $userinfo['username']; ?>';

generateDataTable();

$('#txt_language').change(function() {
    language = $(this).val();
    generateDataTable();
});

$('#txt_type').change(function() {
    type = $(this).val();
    generateDataTable();
});

$('#txt_category').change(function() {
    $('#txt_genre').val('all');
    selectedGenreName = 'all';
    selectedCategoryName = $(this).val();
    generateDataTable();
});

$('#txt_genre').change(function() {
    $('#txt_category').val('all');
    selectedCategoryName = 'all';
    selectedGenreName = $(this).val();
    generateDataTable();
});

function changeTab(newTab) {
    if (selectedCategoryName != newTab) {
        selectedCategoryName = newTab;
        for (var i in groupButtonsIds) {
            if (groupButtonsIds[i] == newTab) {
                document.getElementById(groupButtonsIds[i]).className = "btn btn-secondary";
            } else {
                document.getElementById(groupButtonsIds[i]).className = "btn btn-dark btn-outline-info";
            }
        }
        generateDataTable();
    }
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
        pagingType: 'full_numbers',
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
                return data;
            },
            error: function(err){
                console.log(err);
            }
        },
        rowId: 'bookcode',
        order: [ 0, "desc" ],
        columns: [
            {
                "title": "SL",
                "data": "bookid",
                render: function (data, type, book) {
                    return ++sl;
                }
            },
            {
                "title": "Cover",
                "data": "bookcover_small",
                render: function (data, type, book) {
                    var placeholderImg = "this.src='<?php echo base_url(); ?>images/no_img.png';";
                    var imageViewer = '<ul class="enlarge p-1 mb-1"><li class="m-0"><img src="https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th/'+data+'" onerror="'+placeholderImg+'" width="50px" /><span><img src="https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th/'+data+'" /></span></li></ul>'+'<code>'+book['bookcode']+'</code>';
                    return imageViewer;
                }
            },
            // {
            //     "title": "Bookcode",
            //     "data": "bookcode",
            //     render: function (bookcode,type,book) {
            //         return '<code>'+bookcode+'</code>';
            //     }
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
                "title": "Category",
                "data": "catname_en"
            },
            {
                "title": "Type",
                "data": "isaudiobook",
                render: function (data) {
                    return data==1 ? 'Audiobook' : "eBook";
                }
            },
            {
                "title": "Price",
                "data": "bookprice_boighor_bdt",
                render: function (data, type, row) {
                    return ((row['bookprice_boighor_bdt']==null)?'-':(row['bookprice_boighor_bdt']))+' • '+((row['bookprice_boighor_usd']==null)?'-':(((row['bookprice_boighor_usd']==0)?'Free':('$'+row['bookprice_boighor_usd']))));
                }
            },
            {
                "title": "Discount",
                "data": "isdiscounted",
                render: function (data, type, row) {
                    return row['isdiscounted']==1 ? row['bookprice_boighor_bdt_disc'] : '';
                }
            },
            {
                "title": "Status",
                "data": "status_global",
                render: function (data) {
                    return data==1 ? '<span class="badge badge-success">LIVE</span>' : '<span class="badge badge-secondary">OFFLINE</span>';
                }
            },
            {
                "title": "Created",
                "data": "dateofaddition",
                render: function (data) {
                    return data ? data.substring(0,10) : "N/A";
                }
            },
            // {
            //     "title": "Created By",
            //     "data": "addedby",
            //     render: function (data) {
            //         return data ? data.substring(0,1).toUpperCase()+data.substring(1) : "N/A";
            //     }
            // },
            {
                "title": "Action",
                "data": "bookcode",
                render: function (data, type, service) {
                    var button_1 = "<a href='<?php echo base_url(); ?>book/overview/"+data+"' class='btn btn-sm btn-outline-secondary mr-2'><i class='fas fa-edit mr-1'></i>View</a>";
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
    $('#tbl_booklist').DataTable().column(5).visible(selectedCategoryName == 'all' ? true : false);
    // $('#tbl_booklist').DataTable().column(9).visible(username == 'sanaullah' || username == 'bhuyan' ? false : true);
    // $('#tbl_booklist').DataTable().column(10).visible(username == 'sanaullah' || username == 'bhuyan' ? false : true);
    $('#tbl_booklist thead').css("background-color", "#rgb(23, 162, 184)").css("color", "white");
}

function makeLivePrompt(bookcode, platform, status) {
    Swal.fire({
        title: "Make this Book "+(status == 1 ? 'LIVE' : 'OFFLINE')+" for "+(platform == 'status' ? 'LOCAL' : 'GLOBAL')+" Platform?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: 'Checking Validity',
                timer: Math.floor(Math.random() * 3000) + 2000,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            }).then((result) => {
                checkBookLiveValidity(bookcode, platform, status);
            });
        } else {
            $("#"+platform+"_"+bookcode). prop("checked", !status);
        }
    });
}

function checkBookLiveValidity(bookcode, platform, status) {
    if (status == 0) {
        changeBookStatus(bookcode, platform, status);
    } else {
        $.ajax({
            url: "<?php echo base_url() ?>book/checkBookLiveValidity/"+bookcode,
            method: "POST",
            success:function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data == '') {
                    changeBookStatus(bookcode, platform, status);
                } else {
                    var html = '<div class="row justify-content-center"><ol>';
                    for (i of data) html += '<b><li>'+i+'</li></b>';
                    html += '</ol></div>';
                    Swal.fire("Followings are required to make this book LIVE", html, "error").then((result) => {
                        $("#"+platform+"_"+bookcode). prop("checked", !status);
                    });
                }
            }
        });
    }
}

function changeBookStatus(bookcode, platform, status) {
    $.ajax({
        url: "<?php echo base_url() ?>book/changeStatus/"+bookcode,
        method: "POST",
        data: {
            platform : platform,
            status: status
        },
        success:function(data) {
            console.log(data);
            if (data == 1) {
                Toast.fire({
                    type: (status == '1' ? 'success' : 'error'),
                    title: '&nbsp;&nbsp;Book is '+(status == '1' ? 'Online' : 'Offline')+(platform == 'status' ? ' Locally' : ' Globally')
                });
            } else {
                Swal.fire("Oops", "Something Went Wrong!", "error").then((result) => {
                });
            }
        },
        error: function() {
            Swal.fire("Oops", "Something Went Wrong!", "error").then((result) => {
                location.reload();
            });
        }
    });
}
</script>
