
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('publisher'); ?>">Publishers</a></li>
                    <li class="breadcrumb-item active"><?= $publisher['publishername_en'] ?></li>
                </ol>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-9">
                <!-- <div class="row">
                    <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-nav-info" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="true"><span style="color : #3a3a3a"><i class="fas fa-info"></i> Basic Information</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-nav-legal" data-toggle="tab" href="#nav-legal" role="tab" aria-controls="nav-legal"><span style="color : #3a3a3a"><i class="fas fa-dollar-sign"></i> Legal Information</span></a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="tab-content" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-info" role="tabpanel"> -->
                            <div class="card">
                                <div class="col-12">
                                    <div class="card-body">
                                        <!-- <p class="invisible collapsing m-0 p-0">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p> -->
                                        <form id="frm_edit_publisher" method="post">
                                            <h5>Basic Information</h5>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="mt-2">Publisher Name (EN)</label>
                                                    <input type="text" class="form-control form-control-sm" name="publishername_en" id="txt_edit_publishername_en" value="<?= $publisher['publishername_en'] ?>">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="mt-2">Publisher Name (BN)</label>
                                                    <input type="text" class="form-control form-control-sm" name="publishername_bn" id="txt_edit_publishername_bn" value="<?= $publisher['publishername_bn'] ?>">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="mt-2">Publisher Code</label>
                                                    <input readonly type="text" class="form-control form-control-sm" name="publishercode" id="txt_edit_publishercode" value="<?= $publisher['publishercode'] ?>">
                                                </div>
                                            </div>
                                            <h5 class="mt-5">License Information</h5>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="mt-2">License Type</label>
                                                    <select class="form-control form-control-sm" name="licensetype" id="txt_licensetype">
                                                        <option value="">N/A</option>
                                                        <?php foreach ($licensetypes as $key => $type): ?>
                                                            <option value="<?= $type['licensetype'] ?>"><?= $type['licensetype'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="mt-2">Payment Type</label>
                                                    <select class="form-control form-control-sm" name="paymenttype" id="txt_paymenttype">
                                                        <option value="">N/A</option>
                                                        <?php foreach ($paymenttypes as $key => $type): ?>
                                                            <option value="<?= $type['paymenttype'] ?>"><?= $type['paymenttype'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="mt-2">Term Type</label>
                                                    <select class="form-control form-control-sm" name="termtype" id="txt_termtype">
                                                        <option value="">N/A</option>
                                                        <?php foreach ($termtypes as $key => $termtype): ?>
                                                            <option value="<?= $termtype['term'] ?>"><?= $termtype['term'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="mt-2">Term Start Date</label>
                                                    <input type="date" class="form-control form-control-sm" name="termstartdate" id="txt_edit_royalty_percent" value="<?= $publisher['termstartdate'] ?>">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="mt-2">Term Duration (in Year)</label>
                                                    <input type="number" class="form-control form-control-sm" name="termdurationyear" id="txt_edit_royalty_percent" value="<?= $publisher['termdurationyear'] ?>">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="mt-2">Royalty (%)</label>
                                                    <input type="number" class="form-control form-control-sm" name="royalty_percent" id="txt_edit_royalty_percent" value="<?= $publisher['royalty_percent'] ?>" min="0" max="100">
                                                </div>
                                            </div>
                                            <div class="row justify-content-center mt-4">
                                                <div class="col-9">
                                                    <button type="submit" class="btn btn-primary w-100">  <i class="fas fa-save mr-1"></i> <b>Save</b> </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-sm-3 d-flex">
                            <div class="card">
                                <div class="col-12">
                                    <div class="card-body">
                                        <h5 class="mt-5">User Credentials</h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="mt-2">email</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input readonly type="email" class="form-control" id="email" placeholder="Not Available" value="<?= !empty($credentials['email'])?$credentials['email']:'' ?>">
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-outline-secondary" onclick=copyToClipboard("#email")><i class="far fa-copy mr-1"></i> Copy</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <label class="mt-2">Password</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input readonly type="password" class="form-control" id="password" placeholder="Not Available" value="<?= !empty($credentials['passtext'])?$credentials['passtext']:'321654' ?>">
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-outline-secondary" onclick=copyToClipboard("#password")><i class="far fa-copy mr-1"></i> Copy</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade" id="nav-legal" role="tabpanel">
                            <div class="card">
                                <div class="col-12">
                                    <div class="card-body">
                                        <p class="invisible collapsing m-0 p-0">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div> -->

        </div>

    </div>
</div>

<script type="text/javascript">

$('#navlink_publisher').addClass('active');
$('.loading').addClass('d-none');

$('#txt_licensetype').val('<?= $publisher['licensetype'] ?>')
$('#txt_paymenttype').val('<?= $publisher['paymenttype'] ?>')
$('#txt_termtype').val('<?= $publisher['termtype'] ?>')

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
