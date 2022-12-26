<div class="modal fade" id="modal_reply_global_create">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Add/Edit Reply</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_reply_create" method="post">
                <input type="hidden" name="reply_type" value="boighor">
                <input type="hidden" name="pkid" id="txt_reply_pkid_edit">
                <div class="modal-body">
                    <div class="row justify-content-center mt-2">  
                        <div class="col-sm-12">
                            <label>Reply</label>
                            <textarea class="form-control" name="replytext" rows="5" id="txt_replytext"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="btn_review_create" class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

function populate_modal_create_reply(pkid) {
    var this_row = current_dataset.find(function(row) {
        return row.pkid == pkid;
    })
    $('#txt_reply_pkid_edit').val(this_row.pkid) 
    $('#txt_replytext').val(this_row.replytext)
}

$('#frm_reply_create').submit(function(e) {
    e.preventDefault();

    if ($('#txt_replytext').val()=="") {
        Toast.fire({
            type: 'error',
            title: 'Replycannot be empty',
        });
        return 0;
    }

    Swal.fire({
        title: 'Are You Sure?',
        text: 'You are sure want to update this as a reply?',
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
                url: "<?= base_url() ?>review/create_reply",
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Reply added Successfully", "", "success").then((result) => {
                            location.reload();
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
});


</script>
