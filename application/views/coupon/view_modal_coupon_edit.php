<div class="modal fade" id="modal_quote_edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Add new coupon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_coupon_create" method="post">
                <div class="modal-body">

                    <div class="row gx-2 gx-lg-3">
                        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="name">Coupon Type</label>
                                                <select class="form-control" name="ddlcoupon_type" style="width: 100%" required="">
                                                    <option value="single">Single</option>
                                                    <option value="cart">Cart</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="name">Title <span style="color:red;">*</span></label>
                                                <input type="text" name="txttitle" class="form-control" id="txttitle" placeholder="Promotion Title" required="">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="name">Coupon Code <span style="color:red;">*</span></label>
                                                <input type="text" name="txtcode" value="" class="form-control" id="txtcode" placeholder="Enter coupon code" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="name">Discount type</label>
                                                <select class="form-control" name="ddldiscount_type" style="width: 100%">
                                                    <option value="amount">Amount</option>
                                                    <option value="percent">Percentage</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="name">Amount/Percent <span style="color:red;">*</span></label>
                                                <input type="text" name="txtdiscountamount" class="form-control" id="txtdiscountamount" placeholder="Enter discount amount/percent" required="">
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label for="name">Discount CAP enabled</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="DCEcheck" id="DCEcheck">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label for="name">Usage CAP enabled</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="UCEcheck" id="UCEcheck">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label for="name">Max Book CAP enabled</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"  name="MBCEcheck" id="MBCEcheck">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row" id="capblock" style="display:none;">

                                        <div class="col-md-4 col-6">
                                            <div class="form-group">
                                                <label for="name">Cart min. amount</label>
                                                <input type="text" min="1" max="1000" name="mindiscount" class="form-control" id="mindiscount" placeholder="Min. purchase amount" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Limit For Same User</label>
                                                <input type="number" name="txtusagelimit" id="txtusagelimit" class="form-control" placeholder="EX: 1" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Cart max book limit</label>
                                                <input type="number" name="txtcartsize" id="txtcartsize" class="form-control" placeholder="EX: 1" disabled>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="name">Start date <span style="color:red;">*</span></label>
                                                <input type="date" name="txtstart_date" class="form-control" id="txtstart_date" placeholder="Start date" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="name">Expire date <span style="color:red;">*</span></label>
                                                <input type="date" name="txtexpire_date" class="form-control" id="txtexpire_date" placeholder="Expire date" >
                                            </div>
                                        </div>

                                    </div>
                                    <!-- <div class="row">
                                    <div class="col-md-3 col-6">
                                    <div class="form-group">
                                    <label for="name">Discount</label>
                                    <input type="number" min="1" max="1000000" name="discount" class="form-control" id="discount" placeholder="Discount" required="">
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                            <label for="name">Minimum purchase</label>
                            <input type="number" min="1" max="1000000" name="min_purchase" class="form-control" id="minimum purchase" placeholder="Minimum purchase" required="">
                        </div>
                        <div class="col-md-3 col-6">
                        <div class="form-group">
                        <label for="name">Maximum discount</label>
                        <input type="number" min="1" max="1000000" name="max_discount" class="form-control" id="maximum discount" placeholder="Maximum discount" required="">
                    </div>
                </div>
            </div> -->

        </div>
    </div>
</div>
</div>

</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button id="btn_quote_add" class="btn btn-primary" type="submit">Create</button>
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
