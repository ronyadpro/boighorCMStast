<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo $author." :: ".$author_bn ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>author/authorlist">Authors</a></li>
                    <li class="breadcrumb-item active">Overview</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">

            <div class="col-sm-12">
                <div class="row">
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

                        <div class="tab-pane fade show active" id="nav-info" role="tabpanel">
                            <div class="card">
                                <div class="col-12">
                                    <div class="card-body">
                                        <p class="invisible collapsing m-0 p-0">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>

                                        <div class="row">
                                            <div class="col-sm-3" style="display: flex">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row justify-content-center">
                                                            <label>Picture</label>
                                                        </div>
                                                        <form method="post" id="frm_upload_author" enctype="multipart/form-data">
                                                            <img width="100%" id="img_author" class="mb-4" src="<?php echo "https://d1b3dh5v0ocdqe.cloudfront.net/media/author_th/".$authorcode.".jpg" ?>" onerror="this.src='<?php echo base_url(); ?>images/author_avatar.png';">
                                                            <div class="custom-file" style="margin-bottom: 10px;">
                                                                <input required id="file_cover" name="file_upload" class="custom-file-input form-control-sm" type="file" accept=".jpg">
                                                                <label id="lbl_file_cover" class="custom-file-label form-control-sm" for="file_cover">Select .jpg file Only</label>
                                                            </div>
                                                            <button id="btn_file_cover" class="btn btn-sm btn-outline-secondary w-100" type="submit" disabled>Change Picture</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6" style="display: flex">
                                                <div class="card" style="width: 100%">
                                                    <div class="card-body">
                                                        <div class="row justify-content-center">
                                                            <label>Information</label>
                                                        </div>
                                                        <form method="post" id="frm_update_author_info">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Author Code</i></span>
                                                                </div>
                                                                <input type="text" class="form-control" name="authorcode" value="<?php echo $authorcode ?>" disabled>
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Author Name (En)</i></span>
                                                                </div>
                                                                <input id="txt_author_en" type="text" class="form-control" name="author" value="<?php echo $author ?>">
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Author Name (Bn)</i></span>
                                                                </div>
                                                                <input id="txt_author_bn" type="text" class="form-control" name="author_bn" value="<?php echo $author_bn ?>">
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Date of Birth</i></span>
                                                                </div>
                                                                <input id="txt_dob" type="date" class="form-control" name="dob" value="<?php echo $dob ?>">
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Date of Death</i></span>
                                                                </div>
                                                                <input id="txt_dod" type="date" class="form-control" name="dod" value="<?php echo $dod ?>">
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Short Biography</i></span>
                                                                </div>
                                                                <textarea id="txt_bio" class="form-control" name="authorcode" rows="10"><?php echo $bio ?></textarea>
                                                            </div>
                                                            <h5>Follower</h5>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend freesize">
                                                                            <span class="input-group-text">Default</i></span>
                                                                        </div>
                                                                        <input id="txt_follower" type="number" class="form-control" name="default_follower_count" value="<?php echo $default_follower_count ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend freesize">
                                                                            <span class="input-group-text">Actual</i></span>
                                                                        </div>
                                                                        <input disabled id="txt_follower" type="number" class="form-control" name="default_follower_count" value="<?php echo $followers ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend freesize">
                                                                            <span class="input-group-text">Displayed</i></span>
                                                                        </div>
                                                                        <input disabled id="txt_follower" type="number" class="form-control" name="default_follower_count" value="<?php echo ((int)$default_follower_count)+((int)$followers) ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="input-group mb-3 justify-content-center">
                                                                <input type="submit" class="btn btn-danger" value="Update Information">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3" style="display: flex">
                                                <div class="card" style="width: 100%">
                                                    <div class="card-body">
                                                        <div class="row justify-content-center">
                                                            <label>Tagging</label>
                                                        </div>
                                                        <form method="post" id="frm_update_author_tags">
                                                            <div class="input-group form-group" id="tagdiv">
                                                                <textarea id="tags" class="textarea" placeholder="Add Tags here"><?php echo json_encode($tags ? $tags: explode(" ", $author." ".$author_bn)); ?></textarea>
                                                            </div>
                                                            <div class="input-group mb-3 justify-content-center">
                                                                <input type="submit" class="btn btn-danger" value="Update Tags">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-legal" role="tabpanel">
                            <div class="card">
                                <div class="col-12">
                                    <div class="card-body">
                                        <p class="invisible collapsing m-0 p-0">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                        <?php if (!empty($credentials)): ?>
                                            <div class="row">
                                                <div class="col-sm-6">
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
                                                <div class="col-sm-6">
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
                                        <?php endif; ?>
                                        <?php if (empty($credentials) && ($userinfo['username']=='mynul' || $userinfo['username']=='rajuwan' || $userinfo['username']=='zahid' || $userinfo['username']=='shuvodeep')): ?>
                                            <form id="frm_edit_create_licenser_profile" method="post">
                                                <input type="hidden" name="licensertype"    value="author">
                                                <input type="hidden" name="licensercode"    value="<?= $authorcode ?>">
                                                <input type="hidden" name="licensername_en" value="<?= $author ?>">
                                                <input type="hidden" name="licensername_bn" value="<?= $author_bn ?>">
                                                <input type="hidden" name="licensername_en" value="<?= $author ?>">
                                                <input type="hidden" name="username" value="<?= implode(".", explode(" ", strtolower($author))) ?>">
                                                <input type="hidden" name="password" value="$2y$10$kuwT/nfk58gLARzpNka4Yeh1lSwpZYtWqqsX/VBUrYdFK1IH15mwe">
                                                <input type="hidden" name="createdby" value="<?= $userinfo['username'] ?>">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label class="mt-2">Email:</label>
                                                        <input required type="email" class="form-control form-control-sm" name="email" value="">
                                                    </div>
                                                    <div class="col-6" style="margin-top:37px">
                                                        <button type="submit" class="btn btn-sm btn-outline-primary">  <i class="fas fa-plus mr-1"></i> <b>Create Licenser Profile</b> </button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                        <form id="frm_edit_author_license_info" method="post">
                                            <input type="hidden" name="authorcode" value="<?= $authorcode ?>">
                                            <input type="hidden" name="author" value="<?= $author ?>">
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
                                                        <?php foreach ($termtypes as $key => $term): ?>
                                                            <option value="<?= $term['term'] ?>"><?= $term['term'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="mt-2">Term Start Date</label>
                                                    <input type="date" class="form-control form-control-sm" name="termstartdate" value="<?= $termstartdate ?>">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="mt-2">Term Duration (in Year)</label>
                                                    <input type="number" class="form-control form-control-sm" name="termdurationyear" value="<?= $termdurationyear ?>">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="mt-2">Royalty (%)</label>
                                                    <input type="number" class="form-control form-control-sm" name="royalty_percent" value="<?= $royalty_percent ?>" min="0" max="100">
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

                    </div>
                </div>

            </div>

        </div>

        <div class="row mb-3 justify-content-center">

        </div>
    </div>
</div>

<script>

$('#navlink_authors').addClass('menu-open');
$('#navlink_authorlist').addClass('active');
$('.loading').addClass('d-none');

$('#txt_licensetype').val('<?= $licensetype ?>')
$('#txt_paymenttype').val('<?= $paymenttype ?>')
$('#txt_termtype').val('<?= $termtype ?>')

var tag = <?php echo json_encode($tags); ?>;

$('.input-group-text').width('130px');
$('.freesize').width('90px');
var tagify = new Tagify(document.querySelector('#tags'));

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
            data['authorcode'] = "<?php echo $authorcode ?>";
            data['author'] = $('#txt_author_en').val();
            data['author_bn'] = $('#txt_author_bn').val();
            data['dob'] = $('#txt_dob').val();
            data['dod'] = $('#txt_dod').val();
            data['bio'] = $('#txt_bio').val();
            data['default_follower_count'] = $('#txt_follower').val();
            $.ajax({
                url: "<?php echo base_url() ?>author/updateAuthorInfo/<?php echo $authorcode ?>",
                method: "POST",
                data: data,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Done", "Author Information Updated Successfully", "success").then((result) => {
                            location.reload();
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

$('#file_cover').change(function(e){
    var img = new Image;
    img.onload = function() {
        if( img.width == 200 && img.height == 200 ) {
            document.getElementById('lbl_'+e.target.id).innerHTML = e.target.files[0].name;
            document.getElementById('btn_'+e.target.id).className = 'btn btn-sm btn-danger w-100';
            document.getElementById('btn_'+e.target.id).disabled = false;
            document.getElementById('btn_'+e.target.id).innerHTML = 'Upload';
            if (e.target.files && e.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function (ee) {
                    $('#img_author').attr('src', ee.target.result);
                };
                reader.readAsDataURL(e.target.files[0]);
            }
            Toast.fire({
                type: 'warning',
                title: ' Images are not uploaded until you click the Upload button'
            });
        } else {
            $('#img_author').attr('src', '<?php echo base_url().'images/author_avatar.png'; ?>');
            document.getElementById('lbl_'+e.target.id).innerHTML = 'Select .jpg file Only';
            document.getElementById('btn_'+e.target.id).className = 'btn btn-sm btn-outline-secondary w-100';
            document.getElementById('btn_'+e.target.id).disabled = true;
            Swal.fire("Incorrent resolution", "Author image must be 200x200 pixels", "warning");
        }
    };
    img.src = URL.createObjectURL(this.files[0]);
});

$('#frm_upload_author').on('submit', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Please Confirm',
        text: "Are you sure you want to upload/replace this image?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            var form_data = new FormData($('#'+e.target.id)[0]);
            $.ajax({
                url: "<?php echo base_url() ?>author/uploadAuthorPic/<?php echo $authorcode; ?>",
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Done", "Image Changed Successfully", "success").then((result) => {
                            location.reload();
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

$('#frm_update_author_tags').on('submit', function(e) {
    e.preventDefault();

    let authorTags = document.getElementById('tags').value;
    if (authorTags) {
        authorTags = JSON.parse(authorTags).map(function(d) { return d['value']; });
    }
    var addTags = [];
    var deleteTags = [];
    if (JSON.stringify(authorTags) != JSON.stringify(tag)) {
        for (var tagitem in tag) {
            if (!authorTags.includes(tag[tagitem])) {
                deleteTags.push(tag[tagitem]);
            }
        }
        for (var tagitem in authorTags) {
            if (!tag.includes(authorTags[tagitem])) {
                addTags.push(authorTags[tagitem]);
            }
        }
    }
    console.log(addTags);
    console.log(deleteTags);
    $.ajax({
        url: "<?php echo base_url() ?>author/updateAuthorTags/<?php echo $authorcode; ?>",
        method: "POST",
        data: {
            add : addTags,
            delete: deleteTags
        },
        success:function(data) {
            console.log(data);
            if (data == 1) {
                Swal.fire("Done", "Tags Updated Successfully", "success").then((result) => {
                    location.reload();
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
});


$('#frm_edit_author_license_info').submit(function(event) {
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

            pleaseWait();

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
                url: "<?= base_url('author/updateAuthorLicenseInfo') ?>/<?= $authorcode ?>",
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

$('#frm_edit_create_licenser_profile').submit(function(event) {
    event.preventDefault();

    Swal.fire({
        title: 'Create new profile for this Author?',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {

            var form_data = new FormData($('#'+event.target.id)[0]);

            pleaseWait();

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
                url: "<?= base_url('author/createLicenserProfile') ?>/<?= $authorcode ?>",
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
