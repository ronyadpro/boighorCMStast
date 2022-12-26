<div class="modal fade" id="modal_review_global_edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Edit Review</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_review_edit" method="post">
                <input type="hidden" name="fromebs" value="1">
                <input type="hidden" name="pkid" id="txt_review_pkid_edit">
                <div class="modal-body">
                    <div class="row justify-content-center mt-2">
                        <div class="col-sm-12">
                            <label>Book:</label>
                            <select class="form-control select2" name="bookcode" id="ddl_review_bookcode_edit">
                                <option required value="">Please Select</option>
                                <?php foreach ($booklist as $key => $book): ?>
                                    <option value="<?= $book['bookcode'] ?>"><?= $book['bookname'].' - '.$book['bookname_bn'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>User Name:</label>
                            <input required type="text" class="form-control" name="username" id="txt_review_username_edit">
                        </div>
                        <div class="col-sm-4">
                            <label>Rating Point:</label>
                            <select required class="form-control" name="ratingpoint" id="txt_review_ratingpoint_edit">
                                <option value="">Please Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Review Time:</label>
                            <input required type="datetime" class="form-control" name="datetime" id="txt_review_datetime_edit">
                        </div>
                        <div class="col-sm-12">
                            <label>Review</label>
                            <textarea class="form-control" name="reviewtext" rows="5" id="txt_review_reviewtext_edit"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="btn_review_edit" class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

function populate_modal_edit_review(pkid) {
    var this_row = current_dataset.find(function(row) {
        return row.pkid == pkid;
    })
    $('#txt_review_pkid_edit').val(this_row.pkid)
    $('#ddl_review_bookcode_edit').val(this_row.bookcode).trigger('change')
    $('#txt_review_username_edit').val(this_row.username)
    $('#txt_review_ratingpoint_edit').val(this_row.ratingpoint)
    $('#txt_review_datetime_edit').val(this_row.datetime)
    $('#txt_review_reviewtext_edit').val(this_row.reviewtext)
}

$('#frm_review_edit').submit(function(e) {
    e.preventDefault();

    if ($('#txt_reviewtext_edit').val()=="") {
        Toast.fire({
            type: 'error',
            title: 'Review cannot be empty',
        });
        return 0;
    }

    Swal.fire({
        title: 'Save changes?',
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
                url: "<?= base_url() ?>review/edit_review",
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Review Saved", "", "success").then((result) => {
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
