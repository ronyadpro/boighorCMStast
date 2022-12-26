<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">New Author</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>/author/authorlist">Authors</a></li>
                    <li class="breadcrumb-item active">New</li>
                </ol>
            </div>
        </div>

        <div class="row mb-3 justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="frm_update_author_info">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Author Name (En)</i></span>
                                </div>
                                <input id="txt_author_en" type="text" class="form-control" name="author">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Author Name (Bn)</i></span>
                                </div>
                                <input id="txt_author_bn" type="text" class="form-control" name="author_bn">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Date of Birth</i></span>
                                </div>
                                <input id="txt_dob" type="date" class="form-control" name="dob">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Date of Death</i></span>
                                </div>
                                <input id="txt_dod" type="date" class="form-control" name="dod">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Short Biography</i></span>
                                </div>
                                <textarea id="txt_bio" class="form-control" name="authorcode"></textarea>
                            </div>
                            <div class="input-group mb-3 justify-content-center">
                                <input type="submit" class="btn btn-outline-danger" id="btn_submit" value="Create Author">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$('#navlink_authors').addClass('menu-open');
$('#navlink_newauthor').addClass('active');
$('.loading').addClass('d-none');

    $('.input-group-text').width(150);

    $('#frm_update_author_info').on('submit', function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Please Confirm',
            text: "Are you sure you want to upload this Authors Information?",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                var data = {};
                data['author'] = $('#txt_author_en').val();
                data['author_bn'] = $('#txt_author_bn').val();
                data['dob'] = $('#txt_dob').val();
                data['dod'] = $('#txt_dod').val();
                data['bio'] = $('#txt_bio').val();
                // data = $(this);
                $.ajax({
                    url: "<?php echo base_url() ?>author/addNewAuthorInfo",
                    method: "POST",
                    data: data,
                    success:function(data) {
                        console.log(data);
                        if (data == 401) {
                            Swal.fire("Session Expired", "Please Login Again", "warning").then((result) => {
                                document.location = "<?php echo base_url() ?>";
                            });
                        } else if (data.length == 5 && data[0] == 'A') {
                            Swal.fire("Done", "Author Added Successfully", "success").then((result) => {
                                document.location = "<?php echo base_url() ?>author/overview/"+data;
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

</script>
