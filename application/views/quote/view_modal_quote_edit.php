<div class="modal fade" id="modal_quote_edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Edit Quote</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_quote_edit" method="post">
                <input type="hidden" name="pkid" id="txt_quote_pkid" value="">
                <div class="modal-body">
                    <!-- <label>Information</label> -->
                    <div class="row justify-content-center mt-2">
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Author EN</i></span>
                                </div>
                                <input id="txt_author_en_edit" name="authorname_en" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Author BN</i></span>
                                </div>
                                <input id="txt_author_bn_edit" name="authorname_bn" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text free-size">Quote</div>
                                </div>
                                <textarea class="form-control" id="txt_quote_edit" name="quote" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="btn_quote_add" class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

$('#frm_quote_edit').submit(function(e) {
    e.preventDefault();

    if ($('#txt_quote_edit').val()=="") {
        Toast.fire({
            type: 'error',
            title: 'Quote text cannot be empty',
        });
        return 0;
    }

    Swal.fire({
        title: 'Are You Sure?',
        text: 'You are about to Create a Quote',
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
                url: "<?= base_url() ?>quote/edit_quote",
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Quote updated Successfully", "", "success").then((result) => {
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
