<div class="content-header p-0">
    <div class="container-fluid p-0">

        <!-- <div class="row mb-1">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?//= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Banner</li>
                    <li class="breadcrumb-item active">Boighor Global</li>
                </ol>
            </div>
        </div> -->

        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-8">
                        <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false"></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="nav-nav-banner" data-toggle="tab" href="#nav-banner" role="tab" aria-controls="nav-banner" aria-selected="true"><span style="color : #3a3a3a"><i class="fas fa-images mr-1"></i>Banner</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nav-nav-promo" data-toggle="tab" href="#nav-promo" role="tab" aria-controls="nav-promo"><span style="color : #3a3a3a"><i class="fas fa-band-aid mr-1"></i>Promo</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <button id="btn_add" class="btn btn-primary float-right" style="margin-top: -4;" data-toggle="modal" data-target="#modal-add-item" type="button" id="button"><i class="fas fa-plus"></i> &nbsp; Add Banner </button>
                    </div>
                </div>
                <div class="row">
                    <div class="tab-content" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-banner" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
									<p class="invisible collapsing m-0 p-0">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                    <div class="col-12">
                                        <table id="tbl_cur_banner_global" class="table table-hover" width="100%"></table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-promo" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
									<p class="invisible collapsing m-0 p-0">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                    <div class="row">
                                        <div class="col-12">
                                        <button id="btn_add_promo" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-add-promo" type="button" id="button"><i class="fas fa-plus"></i> &nbsp; Add Promo</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <table id="tbl_cur_promo_global" class="table table-hover" width="100%"></table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Add Banner</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_add_banner_item" method="post">
                <div class="modal-body">
                    <label>Information</label>
                    <div class="row justify-content-center mt-2">
                        <div class="col-sm-7">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Title</i></span>
                                </div>
                                <input id="txt_banner_title" name="title" maxlength="50" type="text" class="form-control capitalize" required>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Type</i></span>
                                </div>
                                <select id="txt_banner_type" name="type" class="form-control" required>
                                    <option value="single">Single</option>
                                    <option value="category">Category</option>
                                    <option value="genre">Genre</option>
                                    <option value="section">Curated / Home-Section</option>
                                    <option value="video">Video</option>
                                    <option value="url">Link/Url</option>
                                    <option value="quiz">Quiz</option>
                                    <option value="promotion">Promotion</option>
                                    <option value="ugc">User Generated Content</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">URL</i></span>
                                </div>
                                <input readonly id="txt_banner_url" name="url" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Code</i></span>
                                </div>
                                <input id="txt_banner_code" name="code" maxlength="50" type="text" class="form-control" placeholder="code of the 'type' above" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text free-size">Promotion Details</div>
                                </div>
                                <textarea class="form-control" id="" name="promodetails" rows="1" placeholder="(Optional)"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="row justify-content-center">
                                <div class="input-group form-group col-12">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text free-size">
                                            <i class="fas fa-desktop"></i>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input id="file_banner_web" type="file" name="file_banner_web" class="custom-file-input form-control-sm" accept=".jpg" required>
                                        <label id="lbl_file_banner_web" class="custom-file-label form-control" for="customFile">1000 x 300</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="row justify-content-center">
                                <div class="input-group form-group col-12">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text free-size">
                                            <i class="fas fa-desktop"></i>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input id="file_banner_app" type="file" name="file_banner_app" class="custom-file-input form-control-sm" accept=".jpg" required>
                                        <label id="lbl_file_banner_app" class="custom-file-label form-control" for="customFile">500 x 200</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="row justify-content-center">
                                <div class="input-group form-group col-12">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text free-size">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input id="file_banner_mob" type="file" name="file_banner_mob" class="custom-file-input form-control-sm" accept=".jpg" required>
                                        <label id="lbl_file_banner_mob" class="custom-file-label form-control" for="customFile">500 x 150</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="btn_file_banner" class="btn btn-primary" type="submit">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Edit Banner</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_edit_banner_item" method="post">
                <div class="modal-body">
                    <label>Information</label>
                    <div class="row justify-content-center mt-2">

                        <input type="hidden" id="txt_edit_banner_id" name="bannerid" value="">
                        <input type="hidden" id="txt_edit_banner_oldimage_web" name="banner_oldimage_web" value="">
                        <input type="hidden" id="txt_edit_banner_oldimage_app" name="banner_oldimage_app" value="">
                        <input type="hidden" id="txt_edit_banner_oldimage_mob" name="banner_oldimage_mob" value="">
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Title</i></span>
                                </div>
                                <input id="txt_edit_banner_title" name="title" maxlength="50" type="text" class="form-control capitalize" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Type</i></span>
                                </div>
                                <select id="txt_edit_banner_type" name="type" class="form-control" required>
                                    <option value="single">Single</option>
                                    <option value="category">Category</option>
                                    <option value="genre">Genre</option>
                                    <option value="section">Curated / Home-Section</option>
                                    <option value="video">Video</option>
                                    <option value="url">Link/Url</option>
                                    <option value="quiz">Quiz</option>
                                    <option value="promotion">Promotion</option>
                                    <option value="ugc">User Generated Content</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">URL</i></span>
                                </div>
                                <input readonly id="txt_edit_banner_url" name="url" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Code</i></span>
                                </div>
                                <input id="txt_edit_banner_code" name="code" maxlength="20" type="text" class="form-control" placeholder="code of the 'type' above" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text free-size">Promotion Details</div>
                                </div>
                                <textarea class="form-control" id="txt_edit_banner_promodetails" name="promodetails" rows="3" placeholder="(Optional)"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card mb-2 p-0">
                                <div class="card-body pt-2 pl-3 pr-3 pb-3">
                                    <h6 class="text-center">1000 x 300 .jpg only</h6>
                                    <img class="img-border" width="100%" id="img_banner_web_edit" src="https://d1b3dh5v0ocdqe.cloudfront.net/media/banner_th/global/placeholder.png">
                                </div>
                                <div class="card-body pt-0 pl-2 pr-2 pb-2" style="padding-top: 0">
                                    <div class="input-group form-group col-12 mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text free-size">
                                                <i class="fas fa-desktop"></i>
                                            </div>
                                        </div>
                                        <div class="custom-file">
                                            <input id="file_banner_web" type="file" name="file_banner_web_edit" class="custom-file-input form-control-sm" accept=".jpg">
                                            <label id="lbl_file_banner_web_edit" class="custom-file-label form-control" for="customFile">1000 x 300</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card mb-2 p-0">
                                <div class="card-body pt-2 pl-3 pr-3 pb-3">
                                    <h6 class="text-center">500 x 200 .jpg only</h6>
                                    <img class="img-border" width="100%" id="img_banner_app_edit" src="https://d1b3dh5v0ocdqe.cloudfront.net/media/banner_th/global/placeholder.png">
                                </div>
                                <div class="card-body pt-0 pl-2 pr-2 pb-2" style="padding-top: 0">
                                    <div class="input-group form-group col-12 mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text free-size">
                                                <i class="fas fa-desktop"></i>
                                            </div>
                                        </div>
                                        <div class="custom-file">
                                            <input id="file_banner_app" type="file" name="file_banner_app_edit" class="custom-file-input form-control-sm" accept=".jpg">
                                            <label id="lbl_file_banner_app_edit" class="custom-file-label form-control" for="customFile">500 x 200</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card mb-2 p-0">
                                <div class="card-body pt-2 pl-3 pr-3 pb-3">
                                    <h6 class="text-center">500 x 150 .jpg only</h6>
                                    <img class="img-border" width="100%" id="img_banner_mob_edit" src="https://d1b3dh5v0ocdqe.cloudfront.net/media/banner_th/global/placeholder.png">
                                </div>
                                <div class="card-body pt-0 pl-2 pr-2 pb-2" style="padding-top: 0">
                                    <div class="input-group form-group col-12 mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text free-size">
                                                <i class="fas fa-desktop"></i>
                                            </div>
                                        </div>
                                        <div class="custom-file">
                                            <input id="file_banner_mob" type="file" name="file_banner_mob_edit" class="custom-file-input form-control-sm" accept=".jpg">
                                            <label id="lbl_file_banner_mob_edit" class="custom-file-label form-control" for="customFile">500 x 150</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-promo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Add Promo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_add_promo_item" method="post">
                <div class="modal-body">
                    <label>Information</label>
                    <div class="row justify-content-center mt-2">
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Title</i></span>
                                </div>
                                <input id="txt_promo_title" name="title" maxlength="50" type="text" class="form-control capitalize" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Type</i></span>
                                </div>
                                <select id="txt_promo_type" name="type" class="form-control" required>
                                    <option value="single">Single</option>
                                    <option value="category">Category</option>
                                    <option value="genre">Genre</option>
                                    <option value="author">Author</option>
                                    <option value="section">Curated</option>
                                    <option value="video">Video</option>
                                    <option value="url">Link/Url</option>
                                    <option value="quiz">Quiz</option>
                                    <option value="promotion">Promotion</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">URL</i></span>
                                </div>
                                <input id="txt_promo_url" name="url" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Code</i></span>
                                </div>
                                <input id="txt_promo_code" name="code" maxlength="20" type="text" class="form-control" placeholder="code of the 'type' above" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text free-size">Promotion Details</div>
                                </div>
                                <textarea class="form-control" id="" name="promodetails" rows="1" placeholder="(Optional)"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="row justify-content-center">
                                <div class="input-group form-group col-12">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text free-size">
                                            <i class="fas fa-desktop"></i>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input id="file_promo" type="file" name="file_promo" class="custom-file-input form-control-sm" accept=".jpg" required>
                                        <label id="lbl_file_promo" class="custom-file-label form-control" for="customFile">Select Promo Image</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="btn_file_promo" class="btn btn-primary" type="submit">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-promo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Edit Promo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_edit_promo_item" method="post">
                <div class="modal-body">
                    <label>Information</label>
                    <div class="row justify-content-center mt-2">

                            <input type="hidden" id="txt_edit_promo_id" name="promoid" value="">
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Title</i></span>
                                    </div>
                                    <input id="txt_edit_promo_title" name="title" maxlength="50" type="text" class="form-control capitalize" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Type</i></span>
                                    </div>
                                    <select id="txt_edit_promo_type" name="type" class="form-control" required>
                                        <option value="single">Single</option>
                                        <option value="category">Category</option>
                                        <option value="genre">Genre</option>
                                        <option value="author">Author</option>
                                        <option value="section">Curated</option>
                                        <option value="video">Video</option>
                                        <option value="url">Link/Url</option>
                                        <option value="quiz">Quiz</option>
                                        <option value="promotion">Promotion</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">URL</i></span>
                                    </div>
                                    <input id="txt_edit_promo_url" name="url" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Code</i></span>
                                    </div>
                                    <input id="txt_edit_promo_code" name="code" maxlength="20" type="text" class="form-control" placeholder="code of the 'type' above" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text free-size">Promotion Details</div>
                                    </div>
                                    <textarea class="form-control" id="txt_edit_promo_promodetails" name="promodetails" rows="1" placeholder="(Optional)"></textarea>
                                </div>
                            </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

$('#navlink_banners').addClass('menu-open');
$('#navlink_banner_global').addClass('active');
$('.loading').addClass('d-none');

var table;
var table_promo;
var sl;
var currentDataSet;
var currentDataSet_promo;

$('#file_banner_web, #file_banner_mob, #file_banner_app, #file_promo').change(function(e){
    //$('#lbl_'+e.target.id).text(e.target.files[0].name);
    //
    var img = new Image;
    img.onload = function() {
        console.log(img.width);
        if(
            (e.target.id == 'file_banner_web' && img.width == 1000 && img.height == 300) ||
            (e.target.id == 'file_banner_app' && img.width == 500 && img.height == 200) ||
            (e.target.id == 'file_banner_mob' && img.width == 500 && img.height == 150) ||
            (e.target.id == 'file_promo' && img.width == 1170 && img.height == 142)
        ) {
            $('#lbl_'+e.target.id).text(e.target.files[0].name);
            // if (e.target.files && e.target.files[0]) {
            //     var reader = new FileReader();
            //     reader.onload = function (ee) {
            //         $('#img_'+e.target.id).attr('src', ee.target.result);
            //     };
            //     reader.readAsDataURL(e.target.files[0]);
            // }
        } else {
            // $('#img_'+e.target.id).attr('src', '<?php //echo base_url().'images/no_img.png'; ?>');
            if (e.target.id == 'file_banner_web') {
                $('#lbl_'+e.target.id).text('1000 x 300');
            } else if(e.target.id == 'file_banner_app') {
                $('#lbl_'+e.target.id).text('500 x 200');
            } else {
                $('#lbl_'+e.target.id).text('500 x 150');
            }
            if (e.target.id == 'file_promo') {
                $('#lbl_'+e.target.id).text('Select Promo Image');
            }
            $('#'+e.target.id).val('');
            Swal.fire("Incorrent resolution", "Web-Banners: 1000x300 & Mobile-Banners: 500x200 & App-Banners: 500x150, Promo: 1170x142", "warning");
        }
    };
    img.src = URL.createObjectURL(this.files[0]);
});

table = $('#tbl_cur_banner_global').DataTable( {
    processing: true,
    serverSide: true,
    ordering: false,
    responsive: false,
    searching: false,
    rowReorder: true,
    paging: false,
    iDisplayLength: 50,
    lengthMenu: [[-1], ["All"]],
    ajax: {
        url: "<?= base_url('curation_global/get_banner_items'); ?>",
        type: 'POST',
        dataFilter: function(data){
            // console.log(jQuery.parseJSON(data));
            sl = jQuery.parseJSON(data)['start'];
            currentDataSet = jQuery.parseJSON(data)['data'];
            return data;
        },
        error: function(err){
            console.log(err);
        }
    },
    rowId: 'id',
    columnDefs: [
        { orderable: true, className: 'reorder text-center', targets: 0 },
    ],
    columns: [
        {
            "title": "#",
            "data": "id",
            render: function () {
                return ++sl;
            }
        },
        {
            "title": "Title",
            "data": "title"
        },
        {
            "title": "Web",
            "data": "bannerfile_web",
            render: function (data) {
                data = data ? data : 'placeholder.png';
                return '<img src="https://d1b3dh5v0ocdqe.cloudfront.net/media/banner_th/global/'+data+'" height="42">';
            }
        },
        {
            "title": "App",
            "data": "bannerfile_app",
            render: function (data) {
                data = data ? data : 'placeholder.png';
                return '<img src="https://d1b3dh5v0ocdqe.cloudfront.net/media/banner_th/global/'+data+'" height="42">';
            }
        },
        {
            "title": "Mobile",
            "data": "bannerfile_mob",
            render: function (data) {
                data = data ? data : 'placeholder.png';
                return '<img src="https://d1b3dh5v0ocdqe.cloudfront.net/media/banner_th/global/'+data+'" height="42">';
            }
        },
        {
            "title": "URL",
            "data": "url"
        },
        {
            "title": "Promo Details",
            "data": "promodetails",
            render: function (data) {
                return data.substring(0,50);
            }
        },
        {
            "title": "Type",
            "data": "type"
        },
        {
            "title": "Web",
            "data": { id: "id", status: "status"},
            render: function (data, type, row) {
                var id = "status__"+data['id'];
                return '<div class="custom-control custom-switch"><input type="checkbox" '+(data['status'] == '1' ? 'checked' : '')+' class="custom-control-input" id="'+id+'"><label class="custom-control-label" for="'+id+'"></label></div>';
            }
        },
        {
            "title": "Android",
            "data": { id: "id", status: "status_app"},
            render: function (data, type, row) {
                var id = "status_app__"+data['id'];
                return '<div class="custom-control custom-switch"><input type="checkbox" '+(data['status_app'] == '1' ? 'checked' : '')+' class="custom-control-input" id="'+id+'"><label class="custom-control-label" for="'+id+'"></label></div>';
            }
        },
        {
            "title": "iOS",
            "data": { id: "id", status: "status_ios"},
            render: function (data, type, row) {
                var id = "status_ios__"+data['id'];
                return '<div class="custom-control custom-switch"><input type="checkbox" '+(data['status_ios'] == '1' ? 'checked' : '')+' class="custom-control-input" id="'+id+'"><label class="custom-control-label" for="'+id+'"></label></div>';
            }
        },
        {
            "title": "Edit",
            "data": { id: "id", status: "status"},
            render: function (data) {
                let button_edit = '<button type="button" name="btn_edit" class="btn btn-sm btn-info mb-1" id="btn_edit_banner_item_'+data['id']+'" value="'+data['status']+'" title="Edit" data-toggle="modal" data-target="#modal-edit-item"><i class="fas fa-edit"></i></button>';
                return button_edit;
            }
        },
        {
            "title": "Delete",
            "data": { id: "id", status: "status"},
            render: function (data) {
                let button_delete = '<button type="button" name="btn_delete" class="btn btn-sm btn-danger mb-1" id="btn_delete_banner_item_'+data['id']+'" value="'+data['status']+'" title="Delete"><i class="fas fa-trash"></i></button>'
                return button_delete;
            }
        },
    ],
    fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {

        $('button[name=btn_edit]').on('click', function(e) {
            let id = this.id.split("_").reverse()[0];
            var thisRow = currentDataSet.find(function(element) {
                return element['id'] == id;
            });
            // console.log(thisRow);
            $('#txt_edit_banner_id').val(thisRow['id']);
            $('#txt_edit_banner_title').val(thisRow['title']);
            $('#txt_edit_banner_type').val(thisRow['type']);
            $('#txt_edit_banner_url').val(thisRow['url']);
            $('#txt_edit_banner_code').val(thisRow['code']);
            $('#txt_edit_banner_promodetails').val(thisRow['promodetails']);
            $('#lbl_file_banner_web_edit').text(thisRow['bannerfile_web']);
            $('#lbl_file_banner_app_edit').text(thisRow['bannerfile_app']);
            $('#lbl_file_banner_mob_edit').text(thisRow['bannerfile_mob']);
            $('#txt_edit_banner_oldimage_web').val(thisRow['bannerfile_web']);
            $('#txt_edit_banner_oldimage_app').val(thisRow['bannerfile_app']);
            $('#txt_edit_banner_oldimage_mob').val(thisRow['bannerfile_mob']);
            $("#img_banner_web_edit").attr("src", thisRow['bannerfile_web'] ? "https://d1b3dh5v0ocdqe.cloudfront.net/media/banner_th/global/"+thisRow['bannerfile_web'] : 'https://d1b3dh5v0ocdqe.cloudfront.net/media/banner_th/global/placeholder.png');
            $("#img_banner_app_edit").attr("src", thisRow['bannerfile_app'] ? "https://d1b3dh5v0ocdqe.cloudfront.net/media/banner_th/global/"+thisRow['bannerfile_app'] : 'https://d1b3dh5v0ocdqe.cloudfront.net/media/banner_th/global/placeholder.png');
            $("#img_banner_mob_edit").attr("src", thisRow['bannerfile_mob'] ? "https://d1b3dh5v0ocdqe.cloudfront.net/media/banner_th/global/"+thisRow['bannerfile_mob'] : 'https://d1b3dh5v0ocdqe.cloudfront.net/media/banner_th/global/placeholder.png');
        });

        $('button[name=btn_delete]').on('click', function(e) {
            Swal.fire({
                title: 'Do you want to Delete this item?',
                text: 'Caution: This action cannot be undone.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                preConfirm: (data) => {
                    return $.ajax({
                        url: "<?php echo base_url() ?>curation_global/delete_banner_item",
                        method: "POST",
                        data: {
                            id: this.id.split("_").reverse()[0]
                        },
                        success:function(data) {
                            console.log(data);
                            toastr.success('Item Deleted Successfully');
                            location.reload();
                        },
                        error: function() {
                            toastr.success('Something Went Wrong')
                        }
                    });
                },
            });
        });

        $('.custom-control-input').on('change', function() {
            changeStatus(this.id.split('__')[0], this.id.split('__')[1], (this.checked ? 1 : 0));
            // console.log(this);
        });
        return sPre;
    },
});

function changeStatus(colname, id, status) {
    // console.log(colname, id, status);
    // return 1;
    $.ajax({
        url: "<?=base_url('curation_global/change_banner_item_status')?>",
        method:"POST",
        data: {
            id: id,
            colname: colname,
            status: status,
        },
        success:function(data) {
            console.log(data);
            if (data) {
                toastr.success('Status Changed Successfully')
            } else {
                toastr.success('Status Update Unsuccessful')
            }
        },
        error: function() {
            Toast.fire({
                type: 'error',
                title: '&nbsp;&nbsp;Sorry, Something went wrong!!!'
            });
        }
    });
}

table_promo = $('#tbl_cur_promo_global').DataTable( {
    processing: true,
    serverSide: true,
    ordering: false,
    responsive: false,
    searching: false,
    rowReorder: true,
    paging: false,
    iDisplayLength: 50,
    lengthMenu: [[-1], ["All"]],
    ajax: {
        url: "<?= base_url('curation_global/get_promo_items'); ?>",
        type: 'POST',
        dataFilter: function(data){
            // console.log(jQuery.parseJSON(data));
            sl = jQuery.parseJSON(data)['start'];
            currentDataSet_promo = jQuery.parseJSON(data)['data'];
            return data;
        },
        error: function(err){
            console.log(err);
        }
    },
    rowId: 'id',
    columnDefs: [
        { orderable: true, className: 'reorder text-center', targets: 0 },
    ],
    columns: [
        {
            "title": "#",
            "data": "id",
            render: function () {
                return ++sl;
            }
        },
        {
            "title": "Title",
            "data": "title"
        },
        {
            "title": "Web",
            "data": "promofile",
            render: function (data) {
                return '<img src="https://d1b3dh5v0ocdqe.cloudfront.net/media/promo_th/global/'+data+'" height="42">';
            }
        },
        {
            "title": "URL",
            "data": "url"
        },
        {
            "title": "Promo Details",
            "data": "promodetails"
        },
        {
            "title": "Type",
            "data": "type"
        },
        {
            "title": "Action",
            "data": { id: "id", status: "status"},
            render: function (data) {
                let button_edit = '<button type="button" name="btn_edit_promo" class="btn btn-sm btn-info mb-1" id="btn_edit_promo_item_'+data['id']+'" value="'+data['status']+'" title="Edit" data-toggle="modal" data-target="#modal-edit-promo"><i class="fas fa-edit"></i></button>';
                let button_status = '<button type="button" name="btn_status_promo" class="btn '+(data['status']==1 ? 'btn-success' : 'btn-secondary')+' btn-sm mb-1" id="btn_promo_item_status_'+data['id']+'" value="'+data['status']+'" title="Status"><i class="fas fa-power-off"></i></button>';
                let button_delete = '<button type="button" name="btn_delete_promo" class="btn btn-sm btn-danger mb-1" id="btn_delete_promo_item_'+data['id']+'" value="'+data['status']+'" title="Delete"><i class="fas fa-trash"></i></button>'
                return button_edit+'&nbsp;'+button_delete;
            }
        },
    ],
    fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
        $('button[name=btn_edit_promo]').on('click', function(e) {
            let id = this.id.split("_").reverse()[0];
            var thisRow = currentDataSet_promo.find(function(element) {
                return element['id'] == id;
            });
            // console.log(thisRow);
            $('#txt_edit_promo_id').val(thisRow['id']);
            $('#txt_edit_promo_title').val(thisRow['title']);
            $('#txt_edit_promo_type').val(thisRow['type']);
            $('#txt_edit_promo_url').val(thisRow['url']);
            $('#txt_edit_promo_code').val(thisRow['code']);
            $('#txt_edit_promo_promodetails').val(thisRow['promodetails']);
        });

        $('button[name=btn_status_promo]').on('click', function(e) {
            Swal.fire({
                title: 'Do you want to '+($('#'+this.id).val()==1 ? 'Hide' : 'Show')+' this item from Home Page?',
                text: '',
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                preConfirm: (data) => {
                    return $.ajax({
                        url: "<?php echo base_url() ?>curation_global/change_promo_item_status",
                        method: "POST",
                        data: {
                            id: this.id.split("_").reverse()[0],
                            status: $('#'+this.id).val()==1 ? 0 : 1
                        },
                        success:function(data) {
                            console.log(data);
                            toastr.success('Status Changed Successfully');
                            location.reload();
                        },
                        error: function() {
                            toastr.success('Something Went Wrong')
                        }
                    });
                },
            });
        });

        $('button[name=btn_delete_promo]').on('click', function(e) {
            Swal.fire({
                title: 'Do you want to Delete this item?',
                text: 'Caution: This action cannot be undone.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                preConfirm: (data) => {
                    return $.ajax({
                        url: "<?php echo base_url() ?>curation_global/delete_promo_item",
                        method: "POST",
                        data: {
                            id: this.id.split("_").reverse()[0]
                        },
                        success:function(data) {
                            console.log(data);
                            toastr.success('Item Deleted Successfully');
                            location.reload();
                        },
                        error: function() {
                            toastr.success('Something Went Wrong')
                        }
                    });
                },
            });
        });

        return sPre;
    },
});

table.on( 'row-reorder', function ( e, diff, edit ) {
    var data = {};
    for (var row in diff) {
        data[row] = {id: diff[row].node.id, sortorder: diff[row].newPosition};
    }
    $.ajax({
        url: "<?php echo base_url();?>curation_global/reorder_banner",
        method:"POST",
        data: data,
        success:function(data) {
            // console.log(data);
            if (data) {
                toastr.success('Banner Re-ordered Successfully');
            } else {
                toastr.success('Could not Reorder');
            }
        }
    });
});

$('#frm_add_banner_item').on('submit', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Are You Sure?',
        text: 'You are about to upload this Banner',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {

            var form_data = new FormData($('#'+e.target.id)[0]);

            var swal = Swal.fire({
                title: 'Please Wait. Uploading Files...  &nbsp;&nbsp;  <i class="fas fa-spinner fa-spin"></i>',
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
                url: "<?php echo base_url() ?>curation_global/add_banner_item",
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Banner added Successfully", "", "success").then((result) => {
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

$('#frm_edit_banner_item').on('submit', function(e) {
    e.preventDefault();

    var formData = new FormData($('#'+e.target.id)[0]);
    Swal.fire({
        title: 'Do you want to update this Banner?',
        type: 'question',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        preConfirm: (data) => {
            return $.ajax({
                url: "<?php echo base_url() ?>curation_global/update_banner_item",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Banner Updated Successfully", "", "success").then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Something Went Wrong", "", "error").then((result) => {
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
        },
    }).then((result) => {
        location.reload();
    });
});

$('#frm_add_promo_item').on('submit', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Are You Sure?',
        text: 'You are about to upload this Promo',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {
            var form_data = new FormData($('#'+e.target.id)[0]);
            var swal = Swal.fire({
                title: 'Please Wait. Uploading Files...  &nbsp;&nbsp;  <i class="fas fa-spinner fa-spin"></i>',
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
                url: "<?= base_url('curation_global/add_promo_item') ?>",
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Promo added Successfully", "", "success").then((result) => {
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

$('#frm_edit_promo_item').on('submit', function(e) {
    e.preventDefault();
    var formData = new FormData($('#'+e.target.id)[0]);
    Swal.fire({
        title: 'Do you want to update this Promo?',
        type: 'question',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        preConfirm: (data) => {
            return $.ajax({
                url: "<?= base_url('curation_global/update_promo_item') ?>",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Promo Updated Successfully", "", "success").then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Something Went Wrong", "", "error").then((result) => {
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
        },
    }).then((result) => {
        location.reload();
    });
});

$('#txt_banner_type').change(function(evnt) {
    switch ($(this).val()) {
        case 'single':
            $('#txt_banner_url').val('https://boighor.com/book/');
            break;
        case 'category':
            $('#txt_banner_url').val('https://boighor.com/content/category/');
            break;
        case 'genre':
            $('#txt_banner_url').val('https://boighor.com/content/genre/');
            break;
        case 'section':
            $('#txt_banner_url').val('https://boighor.com/content/');
            break;
        case 'ugc':
            $('#txt_banner_url').val('https://boighor.com/ugc/');
            $('#txt_banner_code').val('ugc');
            break;
        default:

    }
})

$('#txt_banner_code').change(function(evnt) {
    switch ($('#txt_banner_type').val()) {
        case 'single':
            $('#txt_banner_url').val('https://boighor.com/book/'+$(this).val());
            break;
        case 'category':
            $('#txt_banner_url').val('https://boighor.com/content/category/'+$(this).val());
            break;
        case 'genre':
            $('#txt_banner_url').val('https://boighor.com/content/genre/'+$(this).val());
            break;
        case 'section':
            $('#txt_banner_url').val('https://boighor.com/content/'+$(this).val());
            break;
        default:

    }
})

//
$('#txt_edit_banner_type').change(function(evnt) {
    switch ($(this).val()) {
        case 'single':
            $('#txt_edit_banner_url').val('https://boighor.com/book/'+$('#txt_edit_banner_code').val());
            break;
        case 'category':
            $('#txt_edit_banner_url').val('https://boighor.com/content/category/'+$('#txt_edit_banner_code').val());
            break;
        case 'genre':
            $('#txt_edit_banner_url').val('https://boighor.com/content/genre/'+$('#txt_edit_banner_code').val());
            break;
        case 'section':
            $('#txt_edit_banner_url').val('https://boighor.com/content/'+$('#txt_edit_banner_code').val());
            break;
        case 'ugc':
            $('#txt_edit_banner_url').val('https://boighor.com/ugc/');
            $('#txt_edit_banner_code').val('ugc');
            break;
        default:

    }
})

$('#txt_edit_banner_code').change(function(evnt) {
    switch ($('#txt_edit_banner_type').val()) {
        case 'single':
            $('#txt_edit_banner_url').val('https://boighor.com/book/'+$(this).val());
            break;
        case 'category':
            $('#txt_edit_banner_url').val('https://boighor.com/content/category/'+$(this).val());
            break;
        case 'genre':
            $('#txt_edit_banner_url').val('https://boighor.com/content/genre/'+$(this).val());
            break;
        case 'section':
            $('#txt_edit_banner_url').val('https://boighor.com/content/'+$(this).val());
            break;
        default:

    }
})

</script>
