
<div class="modal fade" id="modal_edit_publisher">
    <div class="modal-dialog modal-sm">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Edit Publisher</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_edit_publisher" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="">Publisher Code</label>
                            <input readonly type="text" class="form-control form-control-sm" name="publishercode" id="txt_edit_publishercode">
                            <label for="">Publisher Name (EN)</label>
                            <input type="text" class="form-control form-control-sm" name="publishername_en" id="txt_edit_publishername_en">
                            <label for="">Publisher Name (BN)</label>
                            <input type="text" class="form-control form-control-sm" name="publishername_bn" id="txt_edit_publishername_bn">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100"> <b>Save</b> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

function populateModal(publishercode) {
    this_publisher = publishers.find(function(publisher) {
        return publisher.publishercode == publishercode;
    })
    if (this_publisher) {
        $('#txt_edit_publishercode').val(this_publisher.publishercode);
        $('#txt_edit_publishername_en').val(this_publisher.publishername_en);
        $('#txt_edit_publishername_bn').val(this_publisher.publishername_bn);
    }
}

$('#frm_edit_publisher').submit(function(event) {
    event.preventDefault();

    Swal.fire({
        title: 'Do you want to save changes?',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {

            var form_data = new FormData($('#'+event.target.id)[0]);

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
                            // Place upload progress bar visibility code here
                            console.log(percentComplete);
                            $('#progress').width(parseInt(percentComplete)+'%');
                            $('#progress_label').text('Progress: '+parseInt(percentComplete)+'%');
                        }
                    }, false);
                    return xhr;
                },
                url: "<?= base_url('publisher/update_publisher') ?>",
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Successfully Saved", "", "success").then((result) => {
                            location.reload();
                        });
                    } else if (data == 403) {
                        Swal.fire("", "You do not have permission to perform this action", "warning").then((result) => {
                        });
                    } else {
                        Swal.fire("Oops.. Something went wrong!", "", "error").then((result) => {
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
