<div class="content-header">
    <div class="container-fluid">
        <!-- <div class="row mb-4">
            <div class="col-sm-9">
                <h1 class="m-0 text-dark">Home Curation</h1>
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php //echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Curation</li>
                    <li class="breadcrumb-item active">Home Page</li>
                </ol>
            </div>
        </div> -->

        <!-- <div class="row mb-2 justify-content-center">
            <div class="col-12">
                <div class="card"> -->
                    <!-- <div class="card-body"> -->
                        <table id="tbl_cur_home" class="table table-hover" width="100%"></table>
                        <div class="row justify-content-center mb-2">

                            <div class="btn-group">
                                <!-- <button id="btn_add_banner" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modal-add-banner" type="button"><i class="fas fa-band-aid"></i> Add Banner Row </button> -->
                                <button id="btn_add" class="btn btn-secondary" data-toggle="modal" data-target="#modal-add-section" type="button" id="button"><i class="fas fa-book"></i>  Add Book Row </button>
                                <button id="btn_add_author" class="btn btn-secondary" data-toggle="modal" data-target="#modal-add-author" type="button"><i class="fas fa-user-plus"></i> Add Author Row </button>
                            </div>
                        </div>
                    <!-- </div> -->
                <!-- </div>
            </div>
        </div> -->
    </div>
</div>

<div class="modal fade" id="modal-add-section">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-gradient-light">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-add-section-title">Add Book Row</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>Select Criterias :</label>
                <div class="row">
                    <div class="col-4">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Category</i></span>
                            </div>
                            <select class="form-control" id="ddl_category">
                                <option value="">Select</option>
                                <?php foreach ($categories as $category): ?>
                                    <?php echo "<option value='".$category->catcode."'>".$category->catname_en." • ".$category->catname_bn."</option>" ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-1">
                        <button id="btn_link" type="button" class="btn btn-lg btn-outline-secondary w-100" value="1"><i class="fas fa-link"></i></button>
                    </div>
                    <div class="col-5">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Genre</i></span>
                            </div>
                            <select class="select2" multiple="multiple" name="ddl_genre" id="ddl_genre">
                                <?php foreach ($genres as $genre): ?>
                                    <?php echo "<option value='".$genre->genre_code."'>".$genre->genre_en." • ".$genre->genre_bn."</option>" ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Type</i></span>
                            </div>
                            <select class="form-control" name="ddl_search_type" id="ddl_search_type">
                                <option value="0">eBook</option>
                                <option value="1">Audiobook</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mb-3">
                    <div class="col-3">
                        <button id="btn_clear" type="button" class="btn btn-outline-secondary float-right"><i class="fas fa-times"></i><b> Clear</b></button>
                    </div>
                    <div class="col-3 ">
                        <button id="btn_cat_gen_search" type="button" class="btn btn-primary"><i class="fas fa-search"></i><b> Search</b></button>
                    </div>
                </div>
                <form id="frm_new_section" method="post">
                    <div class="card">
                        <div class="card-body">
                            <label>Information :</label>
                            <div class="row">
                                <div class="col-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Name (En)</i></span>
                                        </div>
                                        <input id="txt_catname_en" maxlength="50" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Name (Bn)</i></span>
                                        </div>
                                        <input id="txt_catname_bn" maxlength="50" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Type</i></span>
                                        </div>
                                        <select class="form-control" id="ddl_type" required>
                                            <option value="1">Multiple Books</option>
                                            <option value="2">Single Book</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Code</i></span>
                                        </div>
                                        <!-- <input id="txt_catcode" maxlength="20" type="text" class="form-control" required onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))'> -->
                                        <input required id="txt_catcode" maxlength="20" type="text" class="form-control" pattern="^[a-z-]+$">
                                    </div>
                                </div>
                            </div>
                            <label>New Items :</label>
                            <table id="tbl_new_section" class="table table-hover text-center" style="cursor: pointer;" width="100%">
                                <thead>
                                    <th>SL</th>
                                    <th>Cover</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Writer</th>
                                    <th>Action</th>
                                </thead>
                            </table>
                            <div class="row justify-content-center mb-3">
                                <div class="col-3">
                                    <button id="btn_clear_section" type="button" class="btn btn-outline-secondary float-right"><i class="fas fa-broom"></i><b> Clear All</b></button>
                                </div>
                                <div class="col-3 ">
                                    <button id="btn_create_section" name="btn_create" type="submit" class="btn btn-primary"><i class="fas fa-check"></i><b> Create</b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card">
                    <div class="card-body">
                        <label>Search Result :</label>
                        <table id="tbl_new_section_result" class="table table-hover text-center" width="100%">
                            <thead>
                                <th>SL</th>
                                <th>Cover</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Writer</th>
                                <th>Action</th>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close </button>
                </div> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-author">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Add Author List Section</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_author" method="post">
                <div class="modal-body">
                    <label>Information</label>
                    <div class="row justify-content-center mt-2">
                        <div class="col-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Secion Name (En)</i></span>
                                </div>
                                <input id="txt_author_catname_en" maxlength="50" type="text" class="form-control" required onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Secion Name (Bn)</i></span>
                                </div>
                                <input id="txt_author_catname_bn" maxlength="50" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Secion Code</i></span>
                                </div>
                                <input id="txt_author_catcode" maxlength="20" type="text" class="form-control" required onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))'>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Type</i></span>
                                </div>
                                <select class="form-control" id="ddl_author_section_type" required>
                                    <option value="3">Multiple Author</option>
                                    <option value="4">Single Author</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <label>Added Authors</label>
                    <table id="tbl_curated_author_list" class="table text-center" width="100%">
                        <thead>
                            <th>SL</th>
                            <th>Picture</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Action</th>
                        </thead>
                    </table>
                    <div class="row justify-content-center mb-3">
                        <div class="col-3">
                            <button id="btn_clear_authors" type="button" class="btn btn-outline-secondary float-right"><i class="fas fa-broom"></i><b> Clear All</b></button>
                        </div>
                        <div class="col-3 ">
                            <button id="btn_create_author_section" name="btn_create" type="submit" class="btn btn-primary"><i class="fas fa-check"></i><b> Create</b></button>
                        </div>
                    </div>
                    <label>All Authors</label>
                    <table id="tbl_author_list" class="table text-center" width="100%">
                        <thead>
                            <th>SL</th>
                            <th>Picture</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Remove</th>
                        </thead>
                    </table>
                </div>
                <!-- <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close </button>
                    <button type="button" class="btn btn-primary"><i class="fas fa-save"></i> Save </button>
                </div> -->
            </form>
        </div>
    </div>
</div>

<script>

$('#navlink_curation').addClass('menu-open');
$('#navlink_curation_gp').addClass('active');
$('.loading').addClass('d-none');

$('.content-header').addClass('p-0');
$('.container-fluid').addClass('p-0');

var table;
var sl;
var sl_result;
var catcode_being_edited;
var author_catcode_being_edited;
var itemtype;

$('#btn_link').click(function() {
    if (this.value == 0) {
        $('#btn_link').html('<i class="fas fa-link"></i>').val(1);
    } else {
        $('#btn_link').html('<i class="fas fa-unlink"></i>').val(0);
    }
});


//      HOME
table = $('#tbl_cur_home').DataTable( {
    processing: true,
    serverSide: true,
    stateSave: true,
    ordering: false,
    hilighting: false,
    responsive: false,
    rowReorder: true,
    searching: false,
    // paging: true,
        paging: false,
    iDisplayLength: 50,
    lengthMenu: [[-1], ["All"]],
    ajax: {
        url: "<?php echo base_url(); ?>curation/getHomeData",
        type: 'POST',
        dataFilter: function(data){
            // console.log(jQuery.parseJSON(data));
            sl = jQuery.parseJSON(data)['start'];
            return data;
        },
        error: function(err){
            console.log(err);
        }
    },
    rowId: 'catcode',
    columnDefs: [
        { orderable: true, className: 'reorder text-center', targets: 0 },
        { className: 'text-center', targets: 1 },
        // { orderable: true, className: 'text-center', targets: 6 },
    ],
    columns: [
        {
            "title": "Reorder",
            "data": "catcode",
            render: function () {
                return '<i class="fas fa-sort"></i>';
            },
            "width":"1px",
        },
        {
            "title": "Sort Order",
            "data": "sortorder",
            "width":"1px",
        },
        {
            "title": "Name (Bn)",
            "data": "catname_bn"
        },
        {
            "title": "Name (En)",
            "data": "catname"
        },
        {
            "title": "Type",
            "data": "itemtype",
            render: function (data) {
                switch (data) {
                    case '1':
                        return 'Book Row';
                        break;
                    case '2':
                        return 'Single Book';
                        break;
                    case '3':
                        return 'Author Row';
                        break;
                    case '4':
                        return 'Single Author';
                        break;
                    case '5':
                        return 'Spotlight/Banner';
                        break;
                    case '6':
                        return 'Category Row';
                        break;
                    case '7':
                        return 'Genre Row';
                        break;
                    default:
                        return 'N/A';
                }
            }
        },
        {
            "title": "Status",
            "data": { catcode: "catcode", status: "status"},
            render: function (data, type, service) {
                var id = "status_"+data['catcode'];
                return '<div class="custom-control custom-switch"><input type="checkbox" '+(data['status'] == '1' ? 'checked' : '')+' class="custom-control-input" id="'+id+'"><label class="custom-control-label" for="'+id+'"></label></div>';
            }
        },
        {
            "title": "Action",
            "data": {catcode: "catcode", itemtype: "itemtype"},
            render: function (data) {
                switch (data['itemtype']) {
                    case '1':
                        return "<button data-toggle='modal' data-target='#modal-add-section' onclick='populateEditSectionItems(\""+data['catcode']+"\", true)' class='btn btn-sm pt-0 pb-0' type='button' id='"+data['catcode']+"_"+sl+"'><i class='fas fa-edit text-secondary'></i> Edit</button>";
                        break;
                    case '3':
                        return "<button data-toggle='modal' data-target='#modal-add-author' onclick='populateEditAuthorSectionItems(\""+data['catcode']+"\", true)' class='btn btn-sm pt-0 pb-0' type='button' id='"+data['catcode']+"_"+sl+"'><i class='fas fa-edit text-secondary'></i> Edit</button>";
                        break;
                    case '4':
                        return "<button data-toggle='modal' data-target='#modal-add-author' onclick='populateEditAuthorSectionItems(\""+data['catcode']+"\", true)' class='btn btn-sm pt-0 pb-0' type='button' id='"+data['catcode']+"_"+sl+"'><i class='fas fa-edit text-secondary'></i> Edit</button>";
                        break;
                    default:
                        return "<button class='btn btn-sm pt-0 pb-0 d-none' type='button' disabled><i class='fas fa-edit text-secondary'></i> Edit</button>";
                        break;
                }
            }
        },
    ],
    fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch();
        });
        $('.custom-control-input').on('change', function() {
            changeStatus(this.id.split('_')[0], this.id.split('_')[1], (this.checked ? 1 : 0));
            // console.log(this);
        });
        return '';
    },
} );

table.on( 'row-reorder', function ( e, diff, edit ) {
    var data = {};
    for (var row in diff) {
        data[row] = {catcode: diff[row].node.id, pos: diff[row].newPosition};
    }
    $.ajax({
        url: "<?php echo base_url();?>curation/reorderhomedata",
        method:"POST",
        data: data,
        success:function(data) {
            // console.log(data);
            if (data) {
                Toast.fire({
                    type: 'success',
                    title: '&nbsp;&nbsp;Home Reordered Successfully'
                });
            } else {
                Toast.fire({
                    type: 'error',
                    title: '&nbsp;&nbsp;Couldn\'t Update Home Order'
                });
            }
        }
    });
});

$('#tbl_cur_home thead').css("background-color", "#rgb(222, 226, 230)");

function changeStatus(platform, catcode, status) {
    // console.log(platform, catcode, status);
    $.ajax({
        url: "<?php echo base_url();?>curation/changeStatus",
        method:"POST",
        data: {
            catcode: catcode,
            platform: platform,
            status: status,
        },
        success:function(data) {
            // console.log(data);
            if (data) {
                toastr.success('Status Changed Successfully')
            } else {
                toastr.success('Status Update Unsuccessfully')
            }
        },
        error: function() {
            Toast.fire({
                type: 'error',
                title: '&nbsp;&nbsp;Sorry, Something went wrong!!!'
            });
        }
    });
}


var curatedTable = $('#tbl_new_section').DataTable({
    paging: false,
    bInfo: false,
    searching: false,
    rowReorder: true,
    columnDefs: [
        {
            targets: 0,
            orderable: true,
            className: 'reorder text-center',
        },
    ],
    drawCallback: function() {
        $('#tbl_new_section').DataTable().column(0).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
        $('#tbl_new_section tr td').removeClass('d-none');
    }
});

curatedTable.on( 'row-reorder', function ( e, diff, edit ) {
    if ($('#btn_create_section').attr('name') == 'btn_update') {
        var data = {};
        for (var row in diff) {
            data[row] = {bookcode: diff[row].node.id, sortorder: diff[row].newPosition};
        }
        data['catcode'] = catcode_being_edited;
        console.log(data);
        $.ajax({
            url: "<?php echo base_url();?>curation/updateSectionSortorder",
            method:"POST",
            data: data,
            success:function(data) {
                console.log(data);
                if (data) {
                    toastr.success('Re-ordered Successfully')
                } else {
                    toastr.error('Oops.. Something went Wrong')
                }
            },
            error: function(err){
                toastr.error('Oops.. Something went Wrong')
            }
        });
    }
});

var searchResultTable = $('#tbl_new_section_result').DataTable({
    paging: false,
    bInfo: false,
    // searching: true,
    ordering: false,
    hilighting: false,
});

$( "#btn_add" ).click(function() {
    $('#ddl_category').val('').trigger('change');
    $('#ddl_genre').val('').trigger('change');
    $('#txt_catname_en').val('');
    $('#txt_catname_bn').val('');
    $('#txt_catcode').val('');
    $('#ddl_type').val('');
    $('#tbl_new_section').DataTable().clear().draw();
    if (searchResultTable) searchResultTable.destroy();
    searchResultTable = $('#tbl_new_section_result').DataTable({data:[]});
    // searchResultTable.destroy();
    // $('#tbl_new_section_result').html('')
    // $('#tbl_new_section_result').DataTable();
    $('#btn_create_section').html('<i class="fas fa-check"></i><b> Create</b>');
    $('#btn_create_section').attr('name', 'btn_create');
    $('#btn_clear_section').attr("disabled", false);
    $('#txt_catcode').attr("disabled", false);
});

$( "#btn_clear" ).click(function() {
    $('#ddl_category').val('');
    $('#ddl_genre').val('').trigger('change');
});

$( "#btn_cat_gen_search" ).click(function() {
    searchResultTable.destroy();
    searchResultTable = $('#tbl_new_section_result').DataTable( {
        processing: true,
        serverSide: true,
        ordering: false,
        hilighting: false,
        // searching: false,
        lengthMenu: [[5,10,25,50], ["5","10","25","50"]],
        ajax: {
            url: "<?php echo base_url(); ?>curation/getBooklist",
            type: 'POST',
            data: {
                cat: $('#ddl_category').val(),
                gen: $('#ddl_genre').val(),
                adb: $('#ddl_search_type').val(),
                link: $('#btn_link').val(),
            },
            dataFilter: function(data){
                // console.log(data);
                sl_result = jQuery.parseJSON(data)['start'];
                return data;
            },
            error: function(err){
                console.log(err);
            }
        },
        rowId: 'bookcode',
        columnDefs: [
            // { targets: 0, width: "10%", },
            // { targets: 1, width: "10%", },
            { className: "d-none", "targets": [ 5 ] },
            {
                targets: '_all',
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).addClass('draggable_tr');
                }
            },
        ],
        columns: [
            {
                "title": "SL",
                "data": "bookcode",
                render: function () {
                    return ++sl_result;
                }
            },
            {
                "title": "Cover",
                "data": "bookcover_small",
                render: function (data, type, service) {
                    var placeholderImg = "this.src='<?php echo base_url(); ?>images/no_img.png';"
                    return '<img width="50px" src="https://bangladhol.com/book_th/'+data+'" onerror="'+placeholderImg+'" />';
                }
            },
            {
                "title": "Code",
                "data": "bookcode"
            },
            {
                "title": "Name",
                "data": "bookname"
            },
            {
                "title": "Author",
                "data": "writer"
            },
            {
                "title": "Action",
                "data": "bookcode",
                render: function(data) {
                    return '<i class="fas fa-minus-circle fa-2x text-danger" onclick="clear_single_row(\''+data+'\')"></i>';
                }
            },
        ],
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return sPre;
        },
        drawCallback: function () {
            $("#tbl_new_section_result tr .draggable_tr").draggable({
                helper: function(){
                    var selected = $('tr.selectedRow');
                    if (selected.length === 0) {
                        selected = $(this).closest('tr').addClass('selectedRow');
                    }
                    var container = $('<div/>').attr('id', 'draggingContainer');
                    container.append(selected.clone().removeClass("selectedRow"));
                    return container;
                }
            });
        }
    } );
});

$("#tbl_new_section, #tbl_new_section_result, #tbl_curated_author_list").droppable({
    drop: function (event, ui) {
        var dropTable = $(this).DataTable();
        var dropTableData = dropTable.data().toArray();
        var draggingTable = $('.selectedRow').closest('table').DataTable();
        var dupFlag = 0;
        for (var i in dropTableData) {
            if (ui.helper.children()[0].id == dropTableData[i][2]) {
                dupFlag = 1;
                break;
            }
        }
        if (!dupFlag) {
            if ($('#btn_create_section').attr('name') == 'btn_update') {    //  BOOKS
                $.ajax({
                    url: "<?php echo base_url();?>curation/addSectionItem",
                    method:"POST",
                    data: {
                        catcode : catcode_being_edited,
                        bookcode: ui.helper.children()[0].id,
                    },
                    success:function(data) {
                        console.log(data);
                        if (data == 1) {
                            toastr.success('Item Added Successfully');
                            populateEditSectionItems(catcode_being_edited);
                        } else if(data == 409) {
                            toastr.warning('Item Already Added');
                        } else {
                            toastr.error('Oops.. Something went Wrong');
                        }
                    },
                    error: function(err) {
                        toastr.error('Oops.. Something went Wrong');
                    }
                });
            } else if ($('#btn_create_author_section').attr('name') == 'btn_update') {  //  AUTHORS
                $.ajax({
                    url: "<?php echo base_url();?>curation/addSectionItem",
                    method:"POST",
                    data: {
                        catcode : author_catcode_being_edited,
                        bookcode: ui.helper.children()[0].id,
                    },
                    success:function(data) {
                        console.log(data);
                        if (data == 1) {
                            toastr.success('Item Added Successfully');
                            // dropTable.row.add(ui.helper.children()).draw(false);
                            populateEditAuthorSectionItems(author_catcode_being_edited);
                        } else if(data == 409) {
                            toastr.warning('Item Already Added');
                        } else {
                            toastr.error('Oops.. Something went Wrong');
                        }
                    },
                    error: function(err) {
                        toastr.error('Oops.. Something went Wrong');
                    }
                });
            } else {
                dropTable.row.add(ui.helper.children()).draw(false);
            }
        } else {
            toastr.warning('Item Already Added');
        }
        draggingTable.row($('.selectedRow')).remove().draw(false);
    }
});

$(document).on("click", ".tablegrid tr", function () {
    $(this).toggleClass("selectedRow");
});

$('#frm_new_section').on('submit', function(e) {
    e.preventDefault();
    var btn_name = $('#btn_create_section').attr('name');
    if (btn_name == 'btn_update') {
		Swal.fire({
			title: 'Please Wait...',
			allowOutsideClick: false,
			onBeforeOpen: () => {
				Swal.showLoading()
			},
		});
        console.log($('#tbl_new_section').DataTable().column(2).data().toArray());
        $.ajax({
            url: "<?php echo base_url() ?>curation/editSectionInfo",
            method: "POST",
            data: {
                catname : $('#txt_catname_en').val(),
                catname_bn: $('#txt_catname_bn').val(),
                catcode: $('#txt_catcode').val(),
                itemtype: $('#ddl_type').val(),
                bookcodes: $('#tbl_new_section').DataTable().column(2).data().toArray(),
            },
            success:function(data) {
                console.log(data);
                if (data) {
                    Swal.fire("Section Info Updated Successfully", "", "success").then((result) => {
                        location.reload();
                    });
                } else {
                    Swal.fire("Oops.. Something Went Wrong!", "", "error").then((result) => {
                        location.reload();
                    });
                }
            },
            error: function() {
                Swal.fire("Oops.. Something Went Wrong!", "", "error").then((result) => {
                    location.reload();
                });
            }
        });
    } else {
        var new_section_bookcodes = $('#tbl_new_section').DataTable().column(2).data().toArray();
        console.log(new_section_bookcodes);
        if (new_section_bookcodes.length == 0) {
            Swal.fire({
                title: 'Please, add some books',
                type: "warning"
            });
            return 0;
        }
        Swal.fire({
            title: 'Create New Section?',
            type: "question",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?php echo base_url() ?>curation/createSection",
                    method: "POST",
                    data: {
                        catname : $('#txt_catname_en').val(),
                        catname_bn: $('#txt_catname_bn').val(),
                        catcode: $('#txt_catcode').val(),
                        itemtype: $('#ddl_type').val(),
                        bookcodes: new_section_bookcodes,
                    },
                    success:function(data) {
                        console.log(data);
                        if (data == 1) {
                            Swal.fire("Section Created Successfully", "", "success").then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Oops.. Something Went Wrong!", "", "error").then((result) => {
                                location.reload();
                            });
                        }
                    },
                    error: function() {
                        Swal.fire("Oops.. Something Went Wrong!", "", "error").then((result) => {
                            location.reload();
                        });
                    }
                });
            }
        });
    }
});

$('#btn_clear_section').click(function() {
    $('#tbl_new_section').DataTable().clear().draw();
});

function clear_single_row(rowId) {
    if ($('#btn_create_section').attr('name') == 'btn_update') {
        if ($('#tbl_new_section').DataTable().column(2).data().toArray().length==1) {
            Swal.fire({
                title: 'List cannot be empty?',
                type: "warning",
            });
            return 0;
        }
        $.ajax({
            url: "<?php echo base_url();?>curation/removeSectionItem",
            method:"POST",
            data: {
                catcode : catcode_being_edited,
                bookcode: $('#tbl_new_section').DataTable().row('#'+rowId).data().DT_RowId,
            },
            success:function(data) {
                console.log(data);
                if (data) {
                    toastr.success('Item Removed Successfully');
                    $('#tbl_new_section').DataTable().row('#'+rowId).remove().draw();
                } else {
                    toastr.error('Oops.. Something went Wrong');
                }
            },
            error: function(err){
                toastr.error('Oops.. Something went Wrong');
            }
        });
    } else {
        $('#tbl_new_section').DataTable().row('#'+rowId).remove().draw();
    }
}

function populateEditSectionItems(catcode, shouldCleanSearchData = false) {
    $('#btn_create_section').html('<i class="fas fa-save"></i><b> Save</b>').attr('name', 'btn_update');
    if (shouldCleanSearchData == true) {
        $('#ddl_category').val('').trigger('change');
        $('#ddl_genre').val('').trigger('change');
        if (searchResultTable) searchResultTable.destroy();
        searchResultTable = $('#tbl_new_section_result').DataTable({data:[]});
    }
    $('#btn_clear_section').attr("disabled", true);
    $('#txt_catcode').attr("disabled", true);
    catcode_being_edited = catcode;
    $.ajax({
        url: "<?php echo base_url();?>curation/getSectionItems",
        method:"POST",
        data: {
            catcode: catcode
        },
        success:function(data) {
            data = JSON.parse(data);
            console.log(data['catname']);
            $('#modal-add-section-title').text('Add Books to: '+data.catname_bn+'');
            $('#txt_catname_en').val(data.catname);
            $('#txt_catname_bn').val(data['catname_bn']);
            $('#txt_catcode').val(data['catcode']);
            $('#ddl_type').val(data['itemtype']);
            let books = data['books'];
            var html = '';
            for (var row in books) {

                html += '<tr id="'+books[row]['bookcode']+'" role="row" class="odd"><td class="reorder text-center sorting_1">'+(parseInt(row)+1)+'</td><td><img width="50px" src="https://bangladhol.com/book_th/'+books[row]['bookcover_small']+'"></td><td>'+books[row]['bookcode']+'</td><td>'+books[row]['bookname']+'</td><td>'+books[row]['writer']+'</td><td><i class="fas fa-minus-circle fa-2x text-danger" onclick="clear_single_row(\''+books[row]['bookcode']+'\')"></i></td></tr>';
            }
            document.getElementById('tbl_new_section').innerHTML = html;

            sl = 0;
            curatedTable.destroy();
            curatedTable = $('#tbl_new_section').DataTable({
                paging: false,
                bInfo: false,
                searching: false,
                rowReorder: true,
                drawCallback: function() {
                    $('#tbl_new_section').DataTable().column(0).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    } );
                    $('#tbl_new_section tr td').removeClass('d-none');
                }
            });
        }
    });
}

var authorTable = $('#tbl_author_list').DataTable();

$( "#btn_add_author" ).click(function() {
    $('#btn_create_author_section').html('<i class="fas fa-check"></i><b> Create</b>').attr('name', 'btn_create');
    $('#btn_clear_authors').attr("disabled", false);
    $('#txt_author_catcode').attr("disabled", false);
    populateAuthorList();
});

function populateAuthorList() {
    authorTable.destroy();
    authorTable = $('#tbl_author_list').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        hilighting: false,
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
        columnDefs: [
            { className: "d-none", "targets": [ 4 ] },
            {
                targets: '_all',
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).addClass('draggable_tr');
                }
            },
        ],
        columns: [
            {
                "title": "SL",
                "data": "authorcode",
                render: function (data, type, service) {
                    return ++sl;
                }
            },
            {
                "title": "Photo",
                "data": "authorcode",
                render: function (data, type, service) {
                    var placeholderImg = "this.src='<?php echo base_url(); ?>images/author_avatar.png';"
                    return '<img width="50px" src="https://bangladhol.com/author_th/'+data+'.jpg" onerror="'+placeholderImg+'" />';
                }
            },
            {
                "title": "Code",
                "data": "authorcode"
            },
            {
                "title": "Name (En)",
                "data": "author"
            },
            {
                "title": "Remove",
                "data": "authorcode",
                render: function(data) {
                    return '<i class="fas fa-minus-circle fa-2x text-danger" onclick="clear_single_author_row(\''+data+'\')"></i>';
                }
            },
        ],
        drawCallback: function () {
            $("#tbl_author_list tr .draggable_tr").draggable({
                helper: function(){
                    var selected = $('tr.selectedRow');
                    if (selected.length === 0) {
                        selected = $(this).closest('tr').addClass('selectedRow');
                    }
                    var container = $('<div/>').attr('id', 'draggingContainer');
                    container.append(selected.clone().removeClass("selectedRow"));
                    return container;
                }
            });
        }
    });
}

var curatedAuthorTable = $('#tbl_curated_author_list').DataTable({
    paging: false,
    bInfo: false,
    searching: false,
    rowReorder: true,
    columnDefs: [
        {
            targets: 0,
            orderable: true,
            className: 'reorder text-center',
        },
    ],
    drawCallback: function() {
        $('#tbl_curated_author_list').DataTable().column(0).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
        $('#tbl_curated_author_list tr td').removeClass('d-none');
    }
});

curatedAuthorTable.on( 'row-reorder', function ( e, diff, edit ) {
    if ($('#btn_create_author_section').attr('name') == 'btn_update') {
        var data = {};
        for (var row in diff) {
            data[row] = {bookcode: diff[row].node.id, sortorder: diff[row].newPosition};
        }
        data['catcode'] = author_catcode_being_edited;
        console.log(data);
        $.ajax({
            url: "<?php echo base_url();?>curation/updateSectionSortorder",
            method:"POST",
            data: data,
            success:function(data) {
                console.log(data);
                if (data) {
                    toastr.success('Re-ordered Successfully')
                } else {
                    toastr.error('Oops.. Something went Wrong')
                }
            },
            error: function(err){
                toastr.error('Oops.. Something went Wrong')
            }
        });
    }
});

$('#btn_clear_authors').click(function() {
    $('#tbl_curated_author_list').DataTable().clear().draw();
});

$('#frm_author').on('submit', function(e) {
    e.preventDefault();
    if ($('#btn_create_author_section').attr('name') == 'btn_update') {
        $.ajax({
            url: "<?php echo base_url() ?>curation/editSectionInfo",
            method: "POST",
            data: {
                catname : $('#txt_author_catname_en').val(),
                catname_bn: $('#txt_author_catname_bn').val(),
                catcode: $('#txt_author_catcode').val(),
                itemtype: $('#ddl_author_section_type').val(),
            },
            success:function(data) {
                console.log(data);
                if (data) {
                    Swal.fire("Section Info Updated Successfully", "", "success").then((result) => {
                        location.reload();
                    });
                } else {
                    Swal.fire("Oops.. Something Went Wrong!", "", "error").then((result) => {
                        location.reload();
                    });
                }
            },
            error: function() {
                Swal.fire("Oops.. Something Went Wrong!", "", "error").then((result) => {
                    location.reload();
                });
            }
        });
    } else {
        if ($('#tbl_curated_author_list').DataTable().column(2).data().toArray().length>0) {
            var new_authorcodes = $('#tbl_curated_author_list').DataTable().column(2).data().toArray();
            console.log(new_authorcodes);

            Swal.fire({
                title: 'Create New Author-List Section?',
                type: "question",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?php echo base_url() ?>curation/createSection",
                        method: "POST",
                        data: {
                            catname : $('#txt_author_catname_en').val(),
                            catname_bn: $('#txt_author_catname_bn').val(),
                            catcode: $('#txt_author_catcode').val(),
                            itemtype: $('#ddl_author_section_type').val(),
                            bookcodes: new_authorcodes,
                        },
                        success:function(data) {
                            console.log(data);
                            if (data == 1) {
                                Swal.fire("Section Created Successfully", "", "success").then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire("Oops.. Something Went Wrong!", "", "error").then((result) => {
                                    location.reload();
                                });
                            }
                        },
                        error: function() {
                            Swal.fire("Oops.. Something Went Wrong!", "", "error").then((result) => {
                                location.reload();
                            });
                        }
                    });
                }
            });

        } else {
            Swal.fire({
                title: 'List cannot be empty',
                type: "warning",
            });
        }
    }
});

function clear_single_author_row(rowId) {
    if ($('#tbl_curated_author_list').DataTable().column(2).data().toArray().length==1) {
        Swal.fire({
            title: 'List cannot be empty',
            type: "warning",
        });
        return 0;
    } else {
        // $('#tbl_curated_author_list').DataTable().row('#'+rowId).remove().draw();
        $.ajax({
            url: "<?php echo base_url();?>curation/removeSectionItem",
            method:"POST",
            data: {
                catcode : author_catcode_being_edited,
                bookcode: $('#tbl_curated_author_list').DataTable().row('#'+rowId).data().DT_RowId,
            },
            success:function(data) {
                console.log(data);
                if (data) {
                    toastr.success('Item Removed Successfully');
                    $('#tbl_curated_author_list').DataTable().row('#'+rowId).remove().draw();
                } else {
                    toastr.error('Oops.. Something went Wrong');
                }
            },
            error: function(err){
                toastr.error('Oops.. Something went Wrong');
            }
        });
    }
}

function populateEditAuthorSectionItems(catcode, shouldCleanSearchData = false) {
    if (shouldCleanSearchData == true) {
        $('#txt_author_catname_en').val('');
        $('#txt_author_catname_bn').val('');
        if (authorTable) authorTable.destroy();
        authorTable = $('#tbl_author_list').DataTable({data:[]});
        $('#btn_create_author_section').html('<i class="fas fa-save"></i><b> Save</b>').attr('name', 'btn_update');
    }
    $('#btn_clear_authors').attr("disabled", true);
    $('#txt_author_catcode').attr("disabled", true);
    author_catcode_being_edited = catcode;
    populateAuthorList();
    $.ajax({
        url: "<?php echo base_url();?>curation/getSectionItems",
        method:"POST",
        data: {
            catcode: catcode
        },
        success:function(data) {
            data = JSON.parse(data);
            console.log(data['catname']);
            $('#txt_author_catname_en').val(data.catname);
            $('#txt_author_catname_bn').val(data['catname_bn']);
            $('#txt_author_catcode').val(data['catcode']);
            $('#ddl_author_section_type').val(data['itemtype']);
            let authors = data['authors'];
            var html = '';
            var placeholderImg = "this.src='<?php echo base_url(); ?>images/author_avatar.png';"
            for (var row in authors) {
                html += '<tr id="'+authors[row]['authorcode']+'" role="row" class="odd"><td class="reorder text-center sorting_1">'+(parseInt(row)+1)+'</td><td><img width="50px" src="https://bangladhol.com/author_th/'+authors[row]['authorcode']+'.jpg'+'" onerror="'+placeholderImg+'"></td><td>'+authors[row]['authorcode']+'</td><td>'+authors[row]['author']+'</td><td><i class="fas fa-minus-circle fa-2x text-danger" onclick="clear_single_author_row(\''+authors[row]['authorcode']+'\')"></i></td></tr>';
            }
            document.getElementById('tbl_curated_author_list').innerHTML = html;
            sl = 0;
            curatedAuthorTable.destroy();
            curatedAuthorTable = $('#tbl_curated_author_list').DataTable({
                paging: false,
                bInfo: false,
                searching: false,
                rowReorder: true,
                drawCallback: function() {
                    $('#tbl_curated_author_list').DataTable().column(0).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    } );
                    $('#tbl_curated_author_list tr td').removeClass('d-none');
                }
            });
        }
    });
}

</script>
