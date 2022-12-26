<div class="content-header">
    <div class="container-fluid">

                <table id="tbl_cur_banner_gp" class="table table-hover" width="100%"></table>

        <div class="row justify-content-center mb-2">

            <div class="btn-group">
                <button id="btn_add" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-item" type="button" id="button"><i class="fas fa-book"></i> &nbsp; Add New Item </button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modal-add-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Add Banner Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_add_banner_item" method="post">
                <div class="modal-body">
                    <label>Information</label>
                    <div class="row justify-content-center mt-2">
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Title</i></span>
                                </div>
                                <input id="txt_banner_title" name="title" maxlength="50" type="text" class="form-control capitalize" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Type</i></span>
                                </div>
                                <select id="txt_banner_type" name="type" class="form-control" required>
                                    <option value="single">Single</option>
                                    <option value="category">Category</option>
                                    <option value="genre">Genre</option>
                                    <option value="section">Curated Home-Section</option>
                                    <option value="url">Link/Url</option>
                                    <option value="quiz" disabled>Quiz</option>
                                    <option value="promotion" disabled>promotion</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">URL</i></span>
                                </div>
                                <input id="txt_banner_url" name="url" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Code</i></span>
                                </div>
                                <input id="txt_banner_code" name="code" maxlength="20" type="text" class="form-control" placeholder="code of the 'type' above" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text free-size">Promotion Details</div>
                                </div>
                                <textarea class="form-control" id="" name="promodetails" rows="1" placeholder="(Optional)"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row justify-content-center">
                                <div class="input-group form-group col-12">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text free-size">
                                            <i class="fas fa-desktop"></i>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input id="file_banner_web" type="file" name="file_banner_web" class="custom-file-input form-control-sm" accept=".jpg" required>
                                        <label id="lbl_file_banner_web" class="custom-file-label form-control" for="customFile">Select Web Version</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row justify-content-center">
                                <div class="input-group form-group col-12">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text free-size">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input id="file_banner_mob" type="file" name="file_banner_mob" class="custom-file-input form-control-sm" accept=".jpg" required>
                                        <label id="lbl_file_banner_mob" class="custom-file-label form-control" for="customFile">Select App Version</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="btn_file_banner" class="btn btn-primary" type="submit">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-edit-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Edit Banner Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_edit_banner_item" method="post">
                <div class="modal-body">
                    <label>Information</label>
                    <div class="row justify-content-center mt-2">

                            <input type="hidden" id="txt_edit_banner_id" name="bannerid" value="">
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Title</i></span>
                                    </div>
                                    <input id="txt_edit_banner_title" name="title" maxlength="50" type="text" class="form-control capitalize" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Type</i></span>
                                    </div>
                                    <select id="txt_edit_banner_type" name="type" class="form-control" required>
                                        <option value="single">Single</option>
                                        <option value="category">Category</option>
                                        <option value="genre">Genre</option>
                                        <option value="section">Curated Home-Section</option>
                                        <option value="url">Link/Url</option>
                                        <option value="quiz" disabled>Quiz</option>
                                        <option value="promotion" disabled>promotion</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">URL</i></span>
                                    </div>
                                    <input id="txt_edit_banner_url" name="url" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Code</i></span>
                                    </div>
                                    <input id="txt_edit_banner_code" name="code" maxlength="20" type="text" class="form-control" placeholder="code of the 'type' above" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text free-size">Promotion Details</div>
                                    </div>
                                    <textarea class="form-control" id="txt_edit_banner_promodetails" name="promodetails" rows="1" placeholder="(Optional)"></textarea>
                                </div>
                            </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="btn_save_edited_item" class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>

$('#navlink_curation').addClass('menu-open');
$('#navlink_banner_gp').addClass('active');
$('.loading').addClass('d-none');

var table;
var sl;
var currentDataSet;

$('#file_banner_web, #file_banner_mob').change(function(e){
    //$('#lbl_'+e.target.id).text(e.target.files[0].name);
    //
    var img = new Image;
    img.onload = function() {
        console.log(img.width);
        if((e.target.id == 'file_banner_web' && img.width == 1000 && img.height == 300) || (e.target.id == 'file_banner_mob' && img.width == 500 && img.height == 150)) {

            $('#lbl_'+e.target.id).text(e.target.files[0].name);

            // if (e.target.files && e.target.files[0]) {
            //     var reader = new FileReader();
            //     reader.onload = function (ee) {
            //         $('#img_'+e.target.id).attr('src', ee.target.result);
            //     };
            //     reader.readAsDataURL(e.target.files[0]);
            // }
        } else {
            // $('#img_'+e.target.id).attr('src', '<?php //echo base_url().'images/no_img.png'; ?>');
            if (e.target.id == 'file_banner_web') {
                $('#lbl_'+e.target.id).text('Select Web Version');
            } else {
                $('#lbl_'+e.target.id).text('Select App Version');
            }
            $('#'+e.target.id).val('');
            Swal.fire("Incorrent resolution", "Web-Banners: 1000x300 & App-Banners: 500x150", "warning");
        }
    };
    img.src = URL.createObjectURL(this.files[0]);
});

table = $('#tbl_cur_banner_gp').DataTable( {
    processing: true,
    serverSide: true,
    ordering: false,
    responsive: false,
    searching: false,
    rowReorder: true,
    paging: false,
    iDisplayLength: 50,
    lengthMenu: [[-1], ["All"]],
    ajax: {
        url: "<?php echo base_url(); ?>curation/get_banner_items/gp",
        type: 'POST',
        dataFilter: function(data){
            // console.log(jQuery.parseJSON(data));
            sl = jQuery.parseJSON(data)['start'];
            currentDataSet = jQuery.parseJSON(data)['data'];
            return data;
        },
        error: function(err){
            console.log(err);
        }
    },
    rowId: 'id',
    columnDefs: [
        { orderable: true, className: 'reorder text-center', targets: 0 },
    ],
    columns: [
        {
            "title": "#",
            "data": "id",
            render: function () {
                return ++sl;
            }
        },
        {
            "title": "Title",
            "data": "title"
        },
        {
            "title": "Web",
            "data": "bannerfile_web",
            render: function (data) {
                return '<img src="https://bangladhol.com/banner_th/'+data+'" alt="Smiley face" height="42">';
            }
        },
        {
            "title": "Mobile",
            "data": "bannerfile_mob",
            render: function (data) {
                return '<img src="https://bangladhol.com/banner_th/'+data+'" alt="Smiley face" height="42">';
            }
        },
        {
            "title": "URL",
            "data": "url"
        },
        {
            "title": "Promo Details",
            "data": "promodetails"
        },
        {
            "title": "Type",
            "data": "type"
        },
        {
            "title": "Action",
            "data": { id: "id", status: "status"},
            render: function (data) {
                let button_edit = '<button type="button" name="btn_edit" class="btn btn-sm btn-info" id="btn_edit_banner_item_'+data['id']+'" value="'+data['status']+'" title="Edit" data-toggle="modal" data-target="#modal-edit-item"><i class="fas fa-edit"></i></button>';
                let button_status = '<button type="button" name="btn_status" class="btn '+(data['status']==1 ? 'btn-success' : 'btn-secondary')+' btn-sm" id="btn_banner_item_status_'+data['id']+'" value="'+data['status']+'" title="Status"><i class="fas fa-power-off"></i></button>';
                let button_delete = '<button type="button" name="btn_delete" class="btn btn-sm btn-danger" id="btn_delete_banner_item_'+data['id']+'" value="'+data['status']+'" title="Delete"><i class="fas fa-trash"></i></button>'
                return button_edit+'&nbsp;'+button_status+'&nbsp;'+button_delete;
            }
        },
    ],
    fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {

        $('button[name=btn_edit]').on('click', function(e) {
            let id = this.id.split("_").reverse()[0];
            var thisRow = currentDataSet.find(function(element) {
                return element['id'] == id;
            });
            // console.log(thisRow);
            $('#txt_edit_banner_id').val(thisRow['id']);
            $('#txt_edit_banner_title').val(thisRow['title']);
            $('#txt_edit_banner_type').val(thisRow['type']);
            $('#txt_edit_banner_url').val(thisRow['url']);
            $('#txt_edit_banner_code').val(thisRow['code']);
            $('#txt_edit_banner_promodetails').val(thisRow['promodetails']);
        });

        $('button[name=btn_status]').on('click', function(e) {
            Swal.fire({
                title: 'Do you want to '+($('#'+this.id).val()==1 ? 'Hide' : 'Show')+' this item from Home Page?',
                text: '',
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                preConfirm: (data) => {
                    return $.ajax({
                        url: "<?php echo base_url() ?>curation/change_banner_item_status",
                        method: "POST",
                        data: {
                            id: this.id.split("_").reverse()[0],
                            status: $('#'+this.id).val()==1 ? 0 : 1
                        },
                        success:function(data) {
                            console.log(data);
                            toastr.success('Status Changed Successfully');
                            location.reload();
                        },
                        error: function() {
                            toastr.success('Something Went Wrong')
                        }
                    });
                },
            });
        });

        $('button[name=btn_delete]').on('click', function(e) {
            Swal.fire({
                title: 'Do you want to Delete this item?',
                text: 'Caution: This action cannot be undone.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                preConfirm: (data) => {
                    return $.ajax({
                        url: "<?php echo base_url() ?>curation/delete_banner_item",
                        method: "POST",
                        data: {
                            id: this.id.split("_").reverse()[0]
                        },
                        success:function(data) {
                            console.log(data);
                            toastr.success('Item Deleted Successfully');
                            location.reload();
                        },
                        error: function() {
                            toastr.success('Something Went Wrong')
                        }
                    });
                },
            });
        });

        return sPre;
    },
});

table.on( 'row-reorder', function ( e, diff, edit ) {
    var data = {};
    for (var row in diff) {
        data[row] = {id: diff[row].node.id, sortorder: diff[row].newPosition};
    }
    $.ajax({
        url: "<?php echo base_url();?>curation/reorder_banner/gp",
        method:"POST",
        data: data,
        success:function(data) {
            // console.log(data);
            if (data) {
                toastr.success('Banner Re-ordered Successfully');
            } else {
                toastr.success('Could not Reorder');
            }
        }
    });
});


$('#frm_add_banner_item').on('submit', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Are You Sure?',
        text: 'You are about to upload this Banner',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {

            var form_data = new FormData($('#'+e.target.id)[0]);

            var swal = Swal.fire({
                title: 'Please Wait. Uploading Files...  &nbsp;&nbsp;  <i class="fas fa-spinner fa-spin"></i>',
                type: 'info',
                html: '<label id="progress_label">Progress: 0%</label><progress id="progress" class="progress-bar bg-primary progress-bar-striped pb-3 mb-3" max="100" style="width:0%; height:100%"></progress>',
                showConfirmButton: false,
                showCloseButton: false,
                showCancelButton: false,
                allowOutsideClick: false,
            });

            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            // Place upload progress bar visibility code here
                            console.log(percentComplete);
                            $('#progress').width(parseInt(percentComplete)+'%');
                            $('#progress_label').text('Progress: '+parseInt(percentComplete)+'%');
                        }
                    }, false);
                    return xhr;
                },
                url: "<?php echo base_url() ?>curation/add_banner_item",
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Banner-item added Successfully", "", "success").then((result) => {
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
});


$('#frm_edit_banner_item').on('submit', function(e) {
    e.preventDefault();

    var formData = new FormData($('#'+e.target.id)[0]);
    Swal.fire({
        title: 'Do you want to update this Banner?',
        type: 'question',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        preConfirm: (data) => {
            return $.ajax({
                url: "<?php echo base_url() ?>curation/update_banner_item",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Banner Item Updated Successfully", "", "success").then((result) => {
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
        },
    }).then((result) => {
        location.reload();
    });
});



</script>
