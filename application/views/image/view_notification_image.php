<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Notification Images</li>
                </ol>
            </div>
            <div class="col-6">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_upload_notification_image" class="btn btn-sm btn-outline-primary float-right btn_quote_create"><i class="fas fa-plus mr-1"></i><b>Upload New Image</b></a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table id="tbl_images" class="table table-sm text-left" width="100%"></table>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="modal_upload_notification_image">
    <div class="modal-dialog modal-sm">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Upload New Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_upload_notification_image" method="post">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <h5>512x256 .JPG file only</h5><small class="ml-2">Max. 512KB</small>
                        </div>
                        <div class="row">
                            <div class="card" style="margin-bottom: 10px; padding: 0">
                                <div class="card-body">
                                    <a class="umodal__open" href="<?= base_url().'images/no_img.png'; ?>">
                                        <img width="100%" id="img_file" src="<?= base_url().'images/no_img.png'; ?>">
                                    </a>
                                </div>
                                <div class="card-body" style="padding-top: 0">
                                    <input required type="text" id="file_name" name="filename" class="form-control form-control-sm mb-2" placeholder="File Name" pattern="^[a-zA-Z0-9-]{2,50}$">
                                    <div class="custom-file" style="margin-bottom: 10px;">
                                        <input required id="file" name="file_upload" class="custom-file-input form-control-sm" type="file" accept=".jpg">
                                        <label id="lbl_file" class="custom-file-label form-control-sm" for="file">Select File</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="custom-file" style="margin-bottom: 10px;">
                        <input id="file" name="file_upload" class="custom-file-input form-control-sm" type="file" accept=".png">
                        <label id="file" class="custom-file-label form-control-sm" for="file">Select File</label>
                    </div> -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="btn_quote_add" class="btn btn-primary" type="submit">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

$('#navlink_notification_image').addClass('active');
$('.loading').addClass('d-none');

var sl=0;
var currentDataSet;
var table = $('#tbl_images').DataTable( {
    processing: true,
    serverSide: true,
    stateSave : true,
    ordering : true,
    hilighting: false,
    responsive: false,
    searching: true,
    pagingType: 'full_numbers',
    paging: true,
    pageLength : 25,
    language: {
        processing: '<i class="fa fa-sync fa-spin text-primary" style="font-size:36px"></i>'
    },
    ajax: {
        url: "<?= base_url('notification-image/get_notification_images'); ?>",
        type: 'POST',
        dataFilter: function(data){
            // console.log(jQuery.parseJSON(data));
            sl = jQuery.parseJSON(data)['start'];
            // publishers = jQuery.parseJSON(data)['data'];
            return data;
        },
        error: function(err){
            console.log(err);
        }
    },
    rowId: 'pkid',
    order: [ 0, "desc" ],
    columns: [
        {
            "title": "SL",
            "data": "pkid",
            render: function (data, type, row) {
                return ++sl;
            }
        },
        {
            "title": "Image",
            "data": "filename",
            render: function (filename, type, row) {
                return '<img src="https://d1b3dh5v0ocdqe.cloudfront.net/media/pn/'+filename+'" width="200px">';
            }
        },
        {
            "title": "Image URL",
            "data": "filename",
            render: function (filename, type, row) {
                return "https://d1b3dh5v0ocdqe.cloudfront.net/media/pn/"+filename;
            }
        },
        {
            "title": "createdby",
            "data": "createdby",
        },
        {
            "title": "createdat",
            "data": "createdat",
        },
        // {
        //     "title": "Actions",
        //     "data": "filename",
        //     render: function (filename, type, row) {
        //         var copybutton = "<button class='btn btn-xs btn-outline-primary mr-1'><i class='fas fa-copy mr-1'></i></i>Copy URL</button>";
        //         return copybutton;
        //     }
        // },
    ],
    fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
        return sPre;
    },
});

$('#file').change(function(e){

        var img = new Image;
        img.onload = function() {
            if(
                img.width == 512 && img.height == 256
            ) {
                document.getElementById('lbl_'+e.target.id).innerHTML = e.target.files[0].name;
                if (e.target.files && e.target.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (ee) {
                        $('#img_'+e.target.id).attr('src', ee.target.result);
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
                Toast.fire({
                    type: 'warning',
                    title: ' Images are not uploaded until you click the Upload button'
                });
            } else {
                $('#img_'+e.target.id).attr('src', '<?= base_url('images/no_img.png'); ?>');
                $('#file').val('');
                Swal.fire("Incorrent resolution", "Image must be 512x256", "warning");
            }
        };
        img.src = URL.createObjectURL(this.files[0]);

});

$('#frm_upload_notification_image').submit(function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Are You Sure?',
        text: 'You are about to Upload Image',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {

            var form_data = new FormData($('#'+e.target.id)[0]);

            var swal = Swal.fire({
                title: 'Please Wait...  &nbsp;&nbsp;  <i class="fas fa-spinner fa-spin"></i>',
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
                            console.log(percentComplete);
                            $('#progress').width(parseInt(percentComplete)+'%');
                            $('#progress_label').text('Progress: '+parseInt(percentComplete)+'%');
                        }
                    }, false);
                    return xhr;
                },
                url: "<?= base_url('notification-image/upload') ?>",
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Uploaded Successfully", "", "success").then((result) => {
                            location.reload();
                        });
                    } else if (data==403) {
                        Swal.fire("Access Denied", "You do not have permission to perform this action", "error").then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Oops.. Something went wrong!", "", "error").then((result) => {
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

</script>
