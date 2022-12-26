<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Author List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Authors</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row mb-2 justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table id="tbl_authorlist" class="table table-hover" style="text-align: center"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_booklist">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Author Booklist</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <table id="tbl_author_booklist" class="table table-sm table-hover text-center" width="100%"></table>
                </div>
        </div>
    </div>
</div>

<script>

$('#navlink_authors').addClass('menu-open');
$('#navlink_authorlist').addClass('active');
$('.loading').addClass('d-none');

    var sl;
    var authorbooktable;
    var table = $('#tbl_authorlist').DataTable( {
        processing: true,
        serverSide: true,
        stateSave : true,
        ordering : true,
        hilighting: false,
        responsive: false,
        pagingType: 'full_numbers',
        ajax: {
            url: "<?php echo base_url(); ?>author/getauthors",
            type: 'POST',
            dataFilter: function(data){
                // console.log(data);
                sl = jQuery.parseJSON(data)['start'];
                return data;
            },
            error: function(err){
                  console.log(err);
            }
        },
        rowId: 'authorcode',
        order: [[ 6, "desc" ]],
        columns: [
            {
                "title": "SL",
                "data": "authorcode",
                render: function (data, type, author) {
                    return ++sl;
                }
            },
            {
                "title": "Photo",
                "data": "authorcode",
                render: function (authorcode, type, author) {
                    var placeholderImg = "this.src='<?php echo base_url(); ?>images/author_avatar.png';"
                    if (author.author_th==1) {
                        return '<img width="50px" src="https://d1b3dh5v0ocdqe.cloudfront.net/media/author_th/'+authorcode+'.jpg" onerror="'+placeholderImg+'"/>';
                    } else {
                        return '<img width="50px" src="<?php echo base_url(); ?>images/author_avatar.png"/>';
                    }
                }
            },
            {
                "title": "AuthorCode",
                "data": "authorcode"
            },
            {
                "title": "Name (En)",
                "data": "author"
            },
            {
                "title": "Name (Bn)",
                "data": "author_bn"
            },
            {
                "title": "Date of Birth",
                "data": "dob",
                render: function (data) {
                    return data == "0000-00-00" ? "N/A" : data;
                }
            },
            {
                "title": "Date of Death",
                "data": "dod",
                render: function (data) {
                    return data == "0000-00-00" ? "N/A" : data;
                }
            },
            {
                "title": "Books",
                "data": "numberofbooks"
            },
            {
                "title": "Added By",
                "data": "addedby",
                render: function (data) {
                    return data ? data.substring(0,1).toUpperCase()+data.substring(1) : "N/A";
                }
            },
            // {
            //     "title": "Created On",
            //     "data": "dateofaddition",
            //     render: function (data) {
            //         return data ? data.substring(0,10) : "N/A";
            //     }
            // },
            {
                "title": "Action",
                "data": "authorcode",
                render: function (data, type, author) {
                    var button_1 = "<a href='<?php echo base_url(); ?>author/overview/"+data+"' class='btn btn-sm btn-outline-secondary mr-2'><i class='fas fa-edit mr-1'></i>Details</a>";
                    var button_2 = "<a href='javascript:void(0)' data-toggle='modal' data-target='#modal_booklist' onclick=initDatatable('"+data+"') class='btn btn-sm btn-outline-secondary mr-1'><i class='fas fa-book mr-1'></i></i>Books</a>";
                    return button_2+button_1;
                }
            }
        ]
    } );
    $('#tbl_authorlist thead').css("background-color", "#rgb(45, 126, 127)").css("color", "white");

    function initDatatable(authorcode) {
        if (authorbooktable) {
            authorbooktable.destroy();
            document.getElementById('tbl_author_booklist').innerHTML = '';
        }
        authorbooktable = $('#tbl_author_booklist').DataTable( {
            processing: true,
            serverSide: true,
            ordering : true,
            hilighting: false,
            responsive: false,
            ajax: {
                url: "<?php echo base_url(); ?>book/getbooklist",
                type: 'POST',
                data: {
                    'category' : 'all',
                    'authorcode': authorcode
                },
                dataFilter: function(data){
                    // console.log(JSON.parse(data));
                    sl = jQuery.parseJSON(data)['start'];
                    return data;
                },
                error: function(err){
                    console.log(err);
                }
            },
            rowId: 'bookcode',
            columns: [
                {
                    "title": "SL",
                    "data": "timeofentry",
                    render: function (data, type, service) {
                        return ++sl;
                    }
                },
                {
                    "title": "Cover",
                    "data": "bookcover_small",
                    render: function (data, type, service) {
                        var placeholderImg = "this.src='<?php echo base_url(); ?>images/no_img.png';"
                        return '<img width="50px" src="https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th/'+data+'" onerror="'+placeholderImg+'" />';
                    }
                },
                {
                    "title": "Title",
                    "data": "bookname"
                },
                {
                    "title": "Title (Bn)",
                    "data": "bookname_bn"
                },
                {
                    "title": "Category",
                    "data": "catname_en"
                },
                {
                    "title": "Created",
                    "data": "dateofaddition",
                    render: function (data) {
                        return data ? data.substring(0,10) : "N/A";
                    }
                },
                {
                    "title": "Created By",
                    "data": "addedby",
                    render: function (data) {
                        return data ? data.substring(0,1).toUpperCase()+data.substring(1) : "N/A";
                    }
                },
                {
                    "title": "Action",
                    "data": "bookcode",
                    render: function (data, type, service) {
                        return "<a href='<?php echo base_url() ?>book/overview/"+data+"' class='btn btn-app bg-light' style='border: none'><i class='fas fa-edit text-secondary'></i>Details</a>";
                    }
                }
            ],
            fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
                return "Showing " + iStart +" to "+ iEnd + " from " + iTotal + " Books";
            },
        });
    }
</script>
