<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Book Categories</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
            </div>
        </div>

        <div class="row mb-3 justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php if ($userinfo['level']==6): ?>
                            <button class="btn btn-sm btn-outline-success float-right" data-toggle="modal" data-target="#modal-add-category" type="button" id="button"><i class="fas fa-plus"></i> Add new Category</button>
                        <?php endif; ?>
                        <table id="tbl_categorylist" class="table table-hover text-center" width="100%"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-category">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Add New Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_new_category" method="post">
                <div class="modal-body">
                    <div class="row justify-content-center mt-2">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Category Name (En)</i></span>
                                </div>
                                <input id="txt_catname_en" type="text" class="form-control capitalize" required onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Category Name (Bn)</i></span>
                                </div>
                                <input id="txt_catname_bn" type="text" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Category Code</i></span>
                                </div>
                                <input id="txt_catcode" maxlength="3" type="text" class="form-control" required onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"> Close </button>
                    <button type="submit" class="btn btn-primary"> Create </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_edit_category">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Edit category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_edit_category" method="post">
                <div class="modal-body">
                    <div class="row justify-content-center mt-2">
                        <div class="col-12">
                            <label>Information</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Category Name (En)</i></span>
                                </div>
                                <input id="txt_edit_catname_en" type="text" class="form-control capitalize" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Category Name (Bn)</i></span>
                                </div>
                                <input id="txt_edit_catname_bn" type="text" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Category Code</i></span>
                                </div>
                                <input id="txt_edit_catcode" type="text" class="form-control" disabled required>
                            </div>
                                <label>Tags</label>
                            <div class="input-group mb-3">
                                <div class="row">
                                    <div class="col-12" id="div_tag">
                                        <textarea id="txt_category_tag" placeholder="Add Tags here"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close </button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Update </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

$('#navlink_categories').addClass('menu-open');
$('#navlink_category').addClass('active');
$('.loading').addClass('d-none');

var sl = 0;
var currentDataSet;
var oldtags;
var tagify;

    $('.input-group-text').width(130);
    document.getElementById('txt_category_tag').className = '';

    table = $('#tbl_categorylist').DataTable( {
        processing: true,
        serverSide: true,
        stateSave : true,
        ordering : true,
        hilighting: false,
        responsive: false,
        pagingType: 'full_numbers',
        ajax: {
            url: "<?php echo base_url(); ?>book/getcategories",
            type: 'POST',
            dataFilter: function(data){
                currentDataSet = JSON.parse(data)['data'];
                sl = JSON.parse(data)['start'];
                return data;
            },
            error: function(err){
                console.log(err);
            }
        },
        rowId: 'catcode',
        columns: [
            {
                "title": "SL",
                "data": "catcode",
                render: function (data, type, service) {
                    return ++sl;
                }
            },
            {
                "title": "English",
                "data": "catname_en"
            },
            {
                "title": "Bangla",
                "data": "catname_bn"
            },
            {
                "title": "Code",
                "data": "catcode"
            },
            {
                "title": "Books",
                "data": "count",
                "orderable": false
            },
            {
                "title": "Created By",
                "data": "createdby",
                render: function (data) {
                    return data ? data.substring(0,1).toUpperCase()+data.substring(1) : "N/A";
                }
            },
            {
                "title": "Created On",
                "data": "created"
            },
            {
                "title": "Action",
                "data": "catcode",
                render: function (data, type, row, meta) {
                    return "<button data-toggle='modal' data-target='#modal_edit_category' class='btn btn-sm' type='button' id='"+data+"_"+meta.row+"'><i class='fas fa-edit text-secondary'></i>  Edit</button>";
                }
            }
        ],
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            initButtonClickFunction();
            return sPre;
        },
    } );


    $('#frm_new_category').on('submit', function(e) {
        e.preventDefault();
        var data = {};
        data['catname_en'] = $('#txt_catname_en').val().trim();
        data['catname_bn'] = $('#txt_catname_bn').val().trim();
        data['catcode'] = $('#txt_catcode').val().trim();
        $.ajax({
            url: "<?php echo base_url() ?>book/addNewCategory",
            method: "POST",
            data: data,
            success:function(data) {
                console.log(data);
                if (data == 401) {
                    Swal.fire("Session Expired", "Please Login Again", "warning").then((result) => {
                        document.location = "<?php echo base_url() ?>";
                    });
                } else if (data == 1) {
                    Swal.fire("Category Added Successfully", "", "success").then((result) => {
                        table.ajax.reload();
                        $('.close').click();
                        $('#txt_catname_en').val('');
                        $('#txt_catname_bn').val('');
                        $('#txt_catcode').val('');
                    });
                } else if (data == 2) {
                    Swal.fire({
                        title: 'Category-Code alredy exists',
                        type: "error",
                    });
                } else {
                    Swal.fire("Oops", "Something Went Wrong!", "error").then((result) => {
                        location.reload();
                    });
                }
            },
            error: function() {
                Swal.fire("Oops", "Something Went Wrong!", "error").then((result) => {
                    location.reload();
                });
            }
        });
    });


    function initButtonClickFunction() {
        $('.btn-sm').on('click', function(e) {
            var idx = this.id.substring(4);
            var id = this.id.substring(0,3);
            $('#txt_edit_catname_en').val(currentDataSet[idx].catname_en);
            $('#txt_edit_catname_bn').val(currentDataSet[idx].catname_bn);
            $('#txt_edit_catcode').val(currentDataSet[idx].catcode);
            $.ajax({
                url: "<?php echo base_url() ?>book/getCategoryTags/"+currentDataSet[idx].catcode,
                method: "POST",
                success:function(data) {
                    // console.log(data);
                    oldtags = JSON.parse(data);
                    document.getElementById('div_tag').innerHTML = '<textarea id="txt_category_tag" placeholder="Add Tags here"></textarea>';
                    $('#txt_category_tag').val(oldtags).trigger('change');
                    tagify = new Tagify(document.querySelector('#txt_category_tag'));
                },
                error: function() {
                    Swal.fire("Oops", "Something Went Wrong!", "error").then((result) => {
                        location.reload();
                        $('.close').click();
                    });
                }
            });
        });
    }


    $('#frm_edit_category').on('submit', function(e) {
        e.preventDefault();
        var data = {};
        data['catname_en'] = $('#txt_edit_catname_en').val();
        data['catname_bn'] = $('#txt_edit_catname_bn').val();
        data['catcode'] = $('#txt_edit_catcode').val();
        let tags = $('#txt_category_tag').val();
        if (tags) {
            tags = JSON.parse(tags).map(function(d) { return d['value']; });
        }
        var addTags = [];
        var deleteTags = [];
        if (JSON.stringify(tags) != JSON.stringify(oldtags)) {
            for (var tagitem in oldtags) {
                if (!tags.includes(oldtags[tagitem])) {
                    deleteTags.push(oldtags[tagitem]);
                }
            }
            for (var tagitem in tags) {
                if (!oldtags.includes(tags[tagitem])) {
                    addTags.push(tags[tagitem]);
                }
            }
        }
        data['tags'] = {
            add : addTags,
            delete : deleteTags
        };

        $.ajax({
            url: "<?php echo base_url() ?>book/editCategory",
            method: "POST",
            data: data,
            success:function(data) {
                // console.log(data);
                if (data == 401) {
                    Swal.fire("Session Expired", "Please Login Again", "warning").then((result) => {
                        document.location = "<?php echo base_url() ?>";
                    });
                } else if (data == 11) {
                    Swal.fire("Category Information Updated Successfully", "", "success").then((result) => {
                        table.ajax.reload();
                        $('.close').click();
                    });
                } else if (data == 2) {
                    Swal.fire({
                        title: 'Category-Code alredy exists',
                        type: "error",
                    });
                } else {
                    Swal.fire("Oops", "Something Went Wrong!", "error").then((result) => {
                        location.reload();
                    });
                }
            },
            error: function() {
                Swal.fire("Oops", "Something Went Wrong!", "error").then((result) => {
                    location.reload();
                });
            }
        });
    });

</script>
