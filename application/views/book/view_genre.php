<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Book Genres</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Genres</li>
                </ol>
            </div>
        </div>

        <div class="row mb-3 justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php if ($userinfo['level']==6): ?>
                            <button class="btn btn-sm btn-outline-primary float-right" data-toggle="modal" data-target="#modal_genre_sorting" type="button" id="btn_genre_sort_order"><i class="fas fa-sort-numeric-down mr-1"></i>Set Sort Order</button>
                            <button class="btn btn-sm btn-outline-success float-right mr-2" data-toggle="modal" data-target="#modal_add_genre" type="button" id="button"><i class="fas fa-plus mr-1"></i>Add new Genre</button>
                        <?php endif; ?>
                        <table id="tbl_genrelist" class="table table-hover text-center" width="100%"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_add_genre">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Add New Genre</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_new_genre" method="post">
                <div class="modal-body">
                    <div class="row justify-content-center mt-2">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Genre Name (En)</i></span>
                                </div>
                                <input id="txt_genre_en" type="text" class="form-control capitalize" required onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Genre Name (Bn)</i></span>
                                </div>
                                <input id="txt_genre_bn" type="text" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Genre Code</i></span>
                                </div>
                                <input id="txt_genre_code" maxlength="3" type="text" class="form-control" required onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))'>
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
<div class="modal fade" id="modal_edit_genre">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Edit Genre</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center mt-2">
                    <div class="col-12">
                        <label>Information</label>
                        <form id="frm_edit_genre" method="post">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Genre Name (En)</i></span>
                                </div>
                                <input id="txt_edit_genre_en" type="text" class="form-control capitalize" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Genre Name (Bn)</i></span>
                                </div>
                                <input id="txt_edit_genre_bn" type="text" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Genre Code</i></span>
                                </div>
                                <input id="txt_edit_genre_code" type="text" class="form-control" disabled required>
                            </div>
                                <label>Tags</label>
                            <div class="input-group mb-3">
                                <div class="row">
                                    <div class="col-12" id="div_tag">
                                        <textarea id="txt_genre_tag" placeholder="Add Tags here"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <!-- <div class="col-12"> -->
                                    <!-- <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close </button> -->
                                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Update </button>
                                <!-- </div> -->
                            </div>
                        </form>
                        <div class="card" style="margin-bottom: 10px; padding: 0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <img width="200px" height="100px" id="img_genre" src="" onerror="this.src='<?php echo base_url(); ?>images/no_img.png';" >
                                    </div>
                                    <div class="col-6">
                                        <form method="post" id="frm_upload_genre" enctype="multipart/form-data">
                                            <div class="custom-file mt-1" style="margin-bottom: 10px;">
                                                <input id="file_genre" name="file_upload" class="custom-file-input form-control-sm" type="file" accept=".jpg">
                                                <label id="lbl_genre" class="custom-file-label form-control-sm" for="file_genre">Select Image</label>
                                            </div>
                                            <button id="btn_file_genre" class="btn btn-outline-secondary w-100 mt-2" type="submit" disabled><b>Upload</b></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('book/view_modal_genre_sorting') ?>

<script>

$('#navlink_categories').addClass('menu-open');
$('#navlink_genre').addClass('active');
$('.loading').addClass('d-none');

    var sl = 0;
    var currentDataSet;
    var oldtags;
    var tagify;

    $('.input-group-text').width(120);
    document.getElementById('txt_genre_tag').className = '';

    table = $('#tbl_genrelist').DataTable( {
        processing: true,
        serverSide: true,
        stateSave : true,
        ordering : true,
        hilighting: false,
        responsive: false,
        pagingType: 'full_numbers',
        ajax: {
            url: "<?php echo base_url(); ?>book/getgenres",
            type: 'POST',
            dataFilter: function(data){
                currentDataSet = JSON.parse(data)['data'];
                sl = jQuery.parseJSON(data)['start'];
                return data;
            },
            error: function(err){
                console.log(err);
            }
        },
        rowId: 'genre_code',
        // order: [ 2, "asc" ],
        columns: [
            {
                "title": "SL",
                "data": "genre_code",
                render: function (data, type, service) {
                    return ++sl;
                }
            },
            {
                "title": "Image",
                "data": "genre_code",
                render: function (data) {
                    var placeholderImg = "this.src='<?php echo base_url(); ?>images/no_img.png';"
                    return '<img width="100px" height="50px" src="https://d1b3dh5v0ocdqe.cloudfront.net/media/book_genre_th/'+data+'.jpg" onerror="'+placeholderImg+'" />';
                }
            },
            {
                "title": "English",
                "data": "genre_en"
            },
            {
                "title": "Bangla",
                "data": "genre_bn"
            },
            {
                "title": "Code",
                "data": "genre_code"
            },
            {
                "title": "Books",
                "data": "count",
                // "orderable": false
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
                "title": "Show in Home",
                "data": "genre_code",
                render: function (data, type, row) {
                    var id = "showitem__"+row['genre_code'];
                    return '<div class="custom-control custom-switch"><input type="checkbox" '+(row['show_in_home'] == '1' ? 'checked' : '')+' class="custom-control-input" id="'+id+'"><label class="custom-control-label" for="'+id+'"></label></div>';
                }
            },
            {
                "title": "Action",
                "data": "genre_code",
                render: function (data, type, row, meta) {
                    return "<button data-toggle='modal' data-target='#modal_edit_genre' class='btn btn-sm btn_edit_genre' type='button' id='"+data+"_"+meta.row+"'><i class='fas fa-edit text-secondary'></i>  Edit</button>";
                }
            }
        ],
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            initButtonClickFunction();
            $('.custom-control-input').on('change', function() {
                change_show_in_home_status(this.id.split('__')[1], (this.checked ? 1 : 0));
            });
            return sPre;
        },
    } );

    $('#frm_new_genre').on('submit', function(e) {
        e.preventDefault();
        var data = {};
        data['genre_en'] = $('#txt_genre_en').val();
        data['genre_bn'] = $('#txt_genre_bn').val();
        data['genre_code'] = $('#txt_genre_code').val();
        $.ajax({
            url: "<?php echo base_url() ?>book/addNewGenre",
            method: "POST",
            data: data,
            success:function(data) {
                // console.log(data);
                if (data == 401) {
                    Swal.fire("Session Expired", "Please Login Again", "warning").then((result) => {
                        document.location = "<?php echo base_url() ?>";
                    });
                } else if (data == 1) {
                    Swal.fire("Genre Added Successfully", "", "success").then((result) => {
                        table.ajax.reload();
                        $('.close').click();
                        $('#txt_genre_en').val('');
                        $('#txt_genre_bn').val('');
                        $('#txt_genre_code').val('');
                    });
                } else if (data == 2) {
                    Swal.fire({
                        title: 'Genre-Code alredy exists',
                        type: "error",
                    });
                } else {
                    Swal.fire("Oops", "Something Went Wrong!", "error").then((result) => {
                        location.reload();
                        $('.close').click();
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
        $('.btn_edit_genre').on('click', function(e) {
            var idx = this.id.substring(4);
            var id = this.id.substring(0,3);
            // console.log(idx, id);
            $('#txt_edit_genre_en').val(currentDataSet[idx].genre_en);
            $('#txt_edit_genre_bn').val(currentDataSet[idx].genre_bn);
            $('#txt_edit_genre_code').val(currentDataSet[idx].genre_code);
            $("#img_genre").attr("src", "https://d1b3dh5v0ocdqe.cloudfront.net/media/book_genre_th/"+currentDataSet[idx].genre_code+".jpg");
            $.ajax({
                url: "<?php echo base_url() ?>book/getGenreTags/"+currentDataSet[idx].genre_code,
                method: "POST",
                success:function(data) {
                    // console.log(data);
                    oldtags = JSON.parse(data);
                    document.getElementById('div_tag').innerHTML = '<textarea id="txt_genre_tag" placeholder="Add Tags here"></textarea>';
                    $('#txt_genre_tag').val(oldtags).trigger('change');
                    tagify = new Tagify(document.querySelector('#txt_genre_tag'));
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


    $('#frm_edit_genre').on('submit', function(e) {
        e.preventDefault();
        var data = {};
        data['genre_en'] = $('#txt_edit_genre_en').val();
        data['genre_bn'] = $('#txt_edit_genre_bn').val();
        data['genre_code'] = $('#txt_edit_genre_code').val();

        let tags = $('#txt_genre_tag').val();
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
            url: "<?php echo base_url() ?>book/editGenre",
            method: "POST",
            data: data,
            success:function(data) {
                // console.log(data);
                if (data == 401) {
                    Swal.fire("Session Expired", "Please Login Again", "warning").then((result) => {
                        document.location = "<?php echo base_url() ?>";
                    });
                } else if (data == 11) {
                    Swal.fire("Genre Information Updated Successfully", "", "success").then((result) => {
                        location.reload();
                    });
                } else if (data == 2) {
                    Swal.fire({
                        title: 'Genre-Code alredy exists',
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


    $('#file_genre').change(function(e){

        var img = new Image;
        img.onload = function() {
            if(img.width == 300 && img.height == 100) {
                document.getElementById('lbl_genre').innerHTML = e.target.files[0].name;
                document.getElementById('btn_file_genre').className = 'btn btn-danger w-100 mt-2';
                document.getElementById('btn_file_genre').disabled = false;
                // document.getElementById('btn_file_genre').innerHTML = '<b>Upload</b>';
                if (e.target.files && e.target.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (ee) {
                        $('#img_genre').attr('src', ee.target.result);
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
                toastr.warning('Images are not uploaded until you click the Upload button');
            } else {
                $('#img_genre').attr('src', '<?php echo base_url().'images/no_img.png'; ?>');
                document.getElementById('lbl_genre').innerHTML = 'Select Image';
                document.getElementById('btn_file_genre').className = 'btn btn-outline-secondary w-100 mt-2';
                document.getElementById('btn_file_genre').disabled = true;
                Swal.fire("Incorrent resolution", "Image must 300px * 100px", "warning");
            }
        };
        img.src = URL.createObjectURL(this.files[0]);

    });

    $('#frm_upload_genre').on('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Please Confirm',
            text: "Are you sure you want to upload or replace this image?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                var form_data = new FormData($('#'+e.target.id)[0]);
                $.ajax({
                    url: "<?php echo base_url() ?>book/uploadGenreImage/"+$('#txt_edit_genre_code').val(),
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success:function(data) {
                        console.log(data);
                        if (data == 1) {
                            Swal.fire({
                                title: "Image Uploaded Successfully",
                                type: "success",
                            }).then((value) => {
                                location.reload();
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
            }
        });
    });

    function change_show_in_home_status(genre_code, status) {

        $.ajax({
            url: "<?=base_url('book/change_show_in_home_status')?>",
            method:"POST",
            data: {
                genre_code: genre_code,
                status: status,
            },
            success:function(data) {
                console.log(data);
                if (data) {
                    toastr.success('Status Changed Successfully')
                } else {
                    toastr.success('Status Update Unsuccessful')
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
</script>
