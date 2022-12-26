
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-4">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Manual Jobs</li>
                    <li class="breadcrumb-item active">Subscribe</li>
                </ol>
            </div>
        </div>

        <div class="row justified-content-center">
            <div class="col-sm-4">

            </div>
            <div class="col-sm-4">

                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <label>Manual user creation</label>
                        <form method="post" id="import_form" enctype="multipart/form-data">
                            <div class="custom-file" style="margin-bottom: 10px;">
                                <input required id="file_excel" name="file" class="custom-file-input form-control-sm" type="file" accept=".xlsx">
                                <label id="lbl_file_excel" class="custom-file-label form-control-sm" for="file_excel">*.xlsx</label>
                            </div>
                            <!-- <input required type="file" class="form-control" name="file_excel" enctype="multipart/form-data"> -->
                            <select required class="form-control" name="packname" readonly>
                                <option value="boighor_30days" selected >Monthly pack</option>
                            </select>
                            <button type="submit" class="form-control btn btn-primary w-100 mt-2"><b>Submit</b></button>

                            <br>
                            <br>
                            <label  style="align:center;color:red; font-size:10px;">Before submit make sure the .xlxs document is well formated. (ex. msisdn only) </label>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$('#navlink_boighorglobal').addClass('menu-open');
$('#navlink_manual_subscription').addClass('active');
$('.loading').addClass('d-none');

$('#file_excel').change(function(e){
    document.getElementById('lbl_file_excel').innerHTML = e.target.files[0].name;
});


$('#import_form').on('submit', function(e){
    event.preventDefault();
    var form_data = new FormData(this);

    Swal.fire({
        title: 'Do you want to Upload this MSISDN List?',
        type: 'question',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        allowOutsideClick: false,
    }).then((result) => {
        if (result.value) {
            pleaseWait();
            $.ajax({
                url:"<?php echo base_url(); ?>Manualsubscription/import",
                method: "POST",
                data:form_data,
                contentType:false,
                cache:false,
                processData:false,
                success:function(data) {
                    console.log(data);
                    if (data==403) {
                        accessDenied();
                    } else if (data==440) {
                        sessionExpired();
                    } else if (data == 1) {
                        Swal.fire({
                            title: 'User created successfully',
                            type: 'success',
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        //console.log(data);
                        somethingWentWrong();
                    }

                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(xhr.responseText);
                    console.log(status);
                    console.log(error);
                    somethingWentWrong();
                }
            });
        }
    });

});


</script>
