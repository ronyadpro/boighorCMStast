<div class="content-header p-0">
    <div class="container-fluid">

        <div class="row mb-2 justify-content-center">

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-10">
                        <div class="row">
                            <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false"></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="nav-nav-info" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="true">
                                        <span style="color : #3a3a3a"><i class="fab fa-leanpub mr-1"></i><b><?php echo $bookname_bn." :: ".$bookname ?></b></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="nav-nav-price" data-toggle="tab" href="#nav-price" role="tab" aria-controls="nav-price">
                                        <span style="color : #3a3a3a"><i class="fas fa-dollar-sign"></i> Pricing</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="nav-nav-files" data-toggle="tab" href="#nav-files" role="tab" aria-controls="nav-files">
                                        <span style="color : #3a3a3a"><i class="fas fa-file-upload"></i> File Upload</span>
                                    </a>
                                </li>
                                <?php if ($isaudiobook): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="nav-nav-audiobook" data-toggle="tab" href="#nav-audiobook" role="tab" aria-controls="nav-audiobook">
                                            <span style="color : #3a3a3a"><i class="fas fa-headphones"></i> Audio Files </span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if ($_SESSION['userlevel']==6): ?>

                                    <li class="nav-item">
                                        <a class="nav-link" id="nav-nav-history" data-toggle="tab" href="#nav-history" role="tab" aria-controls="nav-history">
                                            <span style="color : #3a3a3a"><i class="fas fa-history"></i> History </span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="row">
                            <b class="pt-3">Copies Sold: <?= $soldcount ?></b>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="tab-content" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-info" role="tabpanel">
                            <div class="card">
                                <div class="col-12 p-0">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="card p-0 mb-3">
                                                    <div class="card-body p-0 m-0">
                                                        <img width="100%" class="img-border" src="<?php echo $bookcover_small ? "https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th/".$bookcover_small : base_url().'images/no_img.png'; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="small-box bg-info">
                                                            <div class="inner">
                                                                <h3><?php echo $isaudiobook ? 'Audio Book' : 'e-Book' ?></h3>
                                                                    <a class="btn btn-sm btn-warning text-dark" href="<?php echo base_url().'book/overview/'.($audiobookcode ?: $adb_has_book) ?>">
                                                                        <b>
                                                                            <?php if ($isaudiobook): ?>
                                                                                <?php if ($adb_has_book): ?>
                                                                                    Go to e-Book
                                                                                <?php else: ?>
                                                                                    Doesn't have e-Book
                                                                                <?php endif; ?>
                                                                            <?php else: ?>
                                                                                <?php if ($audiobookcode): ?>
                                                                                    Go to Audio Book
                                                                                <?php else: ?>
                                                                                    Doesn't have Audio Book
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </b>
                                                                    </a>
                                                                </div>
                                                                <div class="icon">
                                                                    <?php echo $isaudiobook ? '<i class="fas fa-headphones-alt"></i>' : '<i class="fas fa-book"></i>' ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="small-box bg-<?php echo $status ? 'success' : 'danger' ?>">
                                                                <div class="inner">
                                                                    <h3>Telco-Status <sup style="font-size: 15px"><?php echo $status ? 'Live' : 'Offline' ?></sup></h3>
                                                                    <button class="btn btn-sm btn-warning text-dark" id="btn_local"><b>Take <?php echo $status ? 'Offline' : 'Online' ?> <i class="fas fa-level-<?php echo $status ? 'down' : 'up' ?>-alt"></i></b></button>
                                                                </div>
                                                                <div class="icon">
                                                                    <i class="fas fa-map-marker-alt"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 d-none">
                                                            <div class="small-box bg-<?php echo $globalstatus ? 'success' : 'danger' ?>">
                                                                <div class="inner">
                                                                    <h3>Global <sup style="font-size: 15px"><?php echo $globalstatus ? 'Live' : 'Offline' ?></sup></h3>
                                                                    <button class="btn btn-sm btn-warning text-dark" id="btn_global"><b>Take <?php echo $globalstatus ? 'Offline' : 'Online' ?> <i class="fas fa-level-<?php echo $globalstatus ? 'down' : 'up' ?>-alt"></i></b></button>
                                                                </div>
                                                                <div class="icon">
                                                                    <i class="fas fa-globe-americas"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <form id="frm_status" method="post">
                                                                <div class="row">
                                                                    <div class="col-sm-2">
                                                                        <div class="card">
                                                                            <div class="card-body pt-1 pb-2">
                                                                                <label class="ml-1 mr-1">Boighor Global</label><br>
                                                                                <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-on-color="success" data-label-text="<span class='fa fa-broadcast-tower'></span>" id="chk_status_global" <?php echo $status_global ? 'checked' : '' ?>>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="card">
                                                                            <div class="card-body pt-1 pb-2">
                                                                                <label class="ml-1 mr-1">GP Boimela</label><br>
                                                                                <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-on-color="success" data-label-text="<span class='fa fa-broadcast-tower'></span>" id="chk_status_gp" <?php echo $status_gp ? 'checked' : '' ?>>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="card">
                                                                            <div class="card-body pt-1 pb-2">
                                                                                <label class="ml-1 mr-1">Robi Boighor</label><br>
                                                                                <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-on-color="success" data-label-text="<span class='fa fa-broadcast-tower'></span>" id="chk_status_robi" <?php echo $status_robi ? 'checked' : '' ?>>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <!-- </div>
                                                                <div class="row"> -->
                                                                    <div class="col-sm-2">
                                                                        <div class="card">
                                                                            <div class="card-body pt-1 pb-2">
                                                                                <label class="ml-1 mr-1">Airtel Pocketbook</label><br>
                                                                                <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-on-color="success" data-label-text="<span class='fa fa-broadcast-tower'></span>" id="chk_status_airtel" <?php echo $status_airtel ? 'checked' : '' ?>>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="card">
                                                                            <div class="card-body pt-1 pb-2">
                                                                                <label class="ml-1 mr-1">Banglalink Boighor</label><br>
                                                                                <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-on-color="success" data-label-text="<span class='fa fa-broadcast-tower'></span>" id="chk_status_blink" <?php echo $status_blink ? 'checked' : '' ?>>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="card">
                                                                            <div class="card-body pt-1 pb-2">
                                                                                <button type="submit" class="btn btn-danger mt-3 mb-1 w-100">Update Status</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>

                                            </div>
                                        </div>
                                        <!--Book info-->
                                        <form id="frm_book_info" method="post">
                                            <div class="row justify-content-center">
                                                <div class="col-12">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Title</div>
                                                        </div>
                                                        <input type="text" class="form-control" id="txt_title_en" placeholder="English Name" value="<?php echo $bookname; ?>" required>
                                                        <input type="text" class="form-control" id="txt_title_bn" placeholder="Bangla Name" value="<?php echo $bookname_bn; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Author</div>
                                                        </div>
                                                        <select class="form-control select2" name="txt_writer" id="txt_writer" required></select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Publisher</div>
                                                        </div>
                                                        <select class="form-control select2" name="txt_publisher" id="txt_publisher" value="">
                                                            <option value=""> </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Category</div>
                                                        </div>
                                                        <select class="form-control" name="txt_category" id="txt_category" required></select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Genre</div>
                                                        </div>
                                                        <select class="select2" multiple="multiple" name="txt_genre" id="txt_genre" required></select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Summary</div>
                                                        </div>
                                                        <textarea class="form-control" id="txt_booksummary" rows="<?php echo (strlen($booksummary)/250)+1; ?>"><?php echo $booksummary; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group" id="tagdiv">
                                                        <label for="titletags">Title Tags</label>
                                                    </div>
                                                    <div class="input-group form-group" id="tagdiv">
                                                        <textarea id="titletags" class="textarea" placeholder="Add Tags here">
                                                            <?php echo json_encode($tags ? $tags: explode(" ", $bookname." ".$bookname_bn)); ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-4">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="width: 150px">Language</div>
                                                        </div>
                                                        <select class="form-control " id="txt_isenglishbook">
                                                            <option value="0">Bangla</option>
                                                            <option value="1">English</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="width: 150px">ADB Bookcode</div>
                                                        </div>
                                                        <input type="text" class="form-control" id="txt_audiobookcode" placeholder="(Optional)" value="<?php echo $audiobookcode ?>">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="width: 150px">Created On</div>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="N/A" value="<?php echo $dateofaddition; ?>" disabled>
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text prepend-short-20">By</div>
                                                        </div>
                                                        <input type="text" class="form-control capitalize" placeholder="N/A" value="<?php echo $addedby; ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-4">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Android PID</div>
                                                        </div>
                                                        <input type="text" class="form-control" id="txt_productid_googleplay" placeholder="(Optional)" value="<?php echo $productid_googleplay ?>">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Book Page</div>
                                                        </div>
                                                        <input type="text" class="form-control" id="txt_book_page" placeholder="(Optional)" value="<?php echo $bookpage ?>">
                                                    </div>
                                                </div>
                                                <!-- <div class="col-1"></div> -->
                                                <div class="col-4">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="width: 150px">Last Modified</div>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="N/A" value="<?php echo $timeofentry; ?>" disabled>
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text prepend-short-20">By</div>
                                                        </div>
                                                        <input type="text" class="form-control capitalize" placeholder="N/A" value="<?php echo $updatedby; ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-4">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Apple PID </div>
                                                        </div>
                                                        <input type="text" class="form-control" id="txt_productid_appstore" placeholder="(Optional)" value="<?php echo $productid_appstore ?>">
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                </div>
                                            </div>
                                            <label>Legal Info</label>
                                            <div class="row justify-content-center">
                                                <div class="col-4">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Is Exclusive ?</div>
                                                        </div>
                                                        <select class="form-control" name="isexclusive" id="txt_isexclusive">
                                                            <option value="0" <?= !$isexclusive ? 'selected' : '' ?>>Non-Exclusive</option>
                                                            <option value="1" <?= $isexclusive ? 'selected' : '' ?>>Exclusive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Roalty (%)</div>
                                                        </div>
                                                        <select class="form-control" name="royalty_percent" id="txt_royalty_percent">
                                                            <option value="50" <?= $royalty_percent==50 ? 'selected' : '' ?>>50</option>
                                                            <option value="60" <?= $royalty_percent==60 ? 'selected' : '' ?>>60</option>
                                                            <option value="70" <?= $royalty_percent==70 ? 'selected' : '' ?>>70</option>
                                                            <option value="80" <?= $royalty_percent==80 ? 'selected' : '' ?>>80</option>
                                                            <option value="90" <?= $royalty_percent==90 ? 'selected' : '' ?>>90</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                </div>
                                            </div>
                                            <div class="row justify-content-center" style="padding-bottom: 20px">
                                                <button type="submit" class="btn btn-outline-danger">Update Information</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-files" role="tabpanel">
                            <p class="invisible collapsing m-0 p-0">Raw denim you.</p>
                            <div class="card">
                                <div class="col-12">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row justify-content-center">
                                                    <h5>e-Book File</h5><small class="ml-2">Max. 30MB</small>
                                                </div>
                                                <form method="post" id="frm_upload_epub" enctype="multipart/form-data">
                                                    <div class="row justify-content-center">
                                                        <div class="input-group form-group col-8">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text prepend-short-20">
                                                                    <i class="fab fa-leanpub"></i>
                                                                </div>
                                                            </div>
                                                            <div class="custom-file">
                                                                <input id="file_epub" type="file" name="file_upload" class="custom-file-input form-control-sm" accept=".epub">
                                                                <label id="lbl_file_epub" class="custom-file-label form-control-sm" for="customFile"><?= !empty($filename) ? $filename : '' ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <?php if ( !empty($filename) ): ?>
                                                                <a type="button" name="btn_reader" class="btn btn-primary mr-2" target="_blank" href="<?php echo base_url().'book/reader/'.$bookcode.'/'.$filename ?>">Open Epub File</a>
                                                        <?php endif; ?>
                                                        <button id="btn_file_epub" class="btn btn-sm btn-outline-secondary" type="submit" disabled><?php echo $filename ? 'Replace .epub File' : 'Upload .epub File'; ?></button>
                                                        <?php if ( !empty($filename) && ($userinfo['username'] == 'shuvodeep' || $userinfo['username'] == 'rajuwan' || $userinfo['username'] == 'mynul')): ?>
                                                            <a type="button" class="btn btn-secondary ml-2" target="_blank" href="https://boighor-content-ebook.s3.ap-southeast-1.amazonaws.com/media/_oljkz/<?= $filename ?>">Download<i class="fas fa-download ml-2"></i></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row justify-content-center">
                                                    <h5>Preview e-Book File</h5><small class="ml-2">Max. 512KB</small>
                                                </div>
                                                <form method="post" id="frm_upload_epub_preview" enctype="multipart/form-data">
                                                    <div class="row justify-content-center">
                                                        <div class="input-group form-group col-8">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text prepend-short-20">
                                                                    <i class="fab fa-leanpub"></i>
                                                                </div>
                                                            </div>
                                                            <div class="custom-file">
                                                                <input id="file_epub_preview" type="file" name="file_upload" class="custom-file-input form-control-sm" accept=".epub">
                                                                <label id="lbl_file_epub_preview" class="custom-file-label form-control-sm" for="customFile"><?php echo $ebook_preview ? $bookcode : '' ; ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <?php if ( !empty($ebook_preview) ): ?>
                                                                <a type="button" name="btn_reader" class="btn btn-primary mr-2" target="_blank" href="<?php echo 'https://reader.boighor.com/preview/'.$bookcode ?>">Open Preview File</a>
                                                        <?php endif; ?>
                                                        <button id="btn_file_epub_preview" class="btn btn-sm btn-outline-secondary" type="submit" disabled><?php echo $ebook_preview ? 'Replace .epub File' : 'Upload .epub File'; ?></button>
                                                        <?php if ( !empty($ebook_preview) && ($userinfo['username'] == 'shuvodeep' || $userinfo['username'] == 'rajuwan' || $userinfo['username'] == 'mynul')): ?>
                                                            <a type="button" class="btn btn-secondary ml-2" target="_blank" href="https://boighor-content.s3.ap-southeast-1.amazonaws.com/media/books_preview/<?= $bookcode ?>.epub">Download<i class="fas fa-download ml-2"></i></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center mt-3">
                                            <div class="card-body col-md-3">
                                                <div class="row">
                                                    <h5>Book Cover (Crease)</h5>
                                                </div>
                                                <div class="row">
                                                    <small class="ml-2">360x540px(Max - 512KB)</small>
                                                </div>
                                                <div class="row">
                                                    <div class="card" style="margin-bottom: 10px; padding: 0">
                                                        <div class="card-body">
                                                            <a class="umodal__open" href="<?php echo $file_crease ? "https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th/".$bookcover_small : base_url().'images/no_img.png'; ?>">
                                                                <img width="100%" class="img-border" id="img_file_cover" src="<?php echo $file_crease ? "https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th/".$bookcover_small : base_url().'images/no_img.png'; ?>">
                                                            </a>
                                                        </div>
                                                        <div class="card-body" style="padding-top: 0">
                                                            <form method="post" id="frm_upload_cover" enctype="multipart/form-data">
                                                                <div class="custom-file" style="margin-bottom: 10px;">
                                                                    <input id="file_cover" name="file_upload" class="custom-file-input form-control-sm" type="file" accept=".jpg">
                                                                    <label id="lbl_file_cover" class="custom-file-label form-control-sm" for="file_cover"><?php echo $file_crease ? $bookcover_small : '.jpg'; ?></label>
                                                                </div>
                                                                <button id="btn_file_cover" class="btn btn-sm btn-outline-secondary w-100" type="submit" disabled><?php echo $file_crease ? 'Replace Cover' : 'Add Cover'; ?></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body col-md-3">
                                                <div class="row">
                                                    <h5>Book Cover (Plain)</h5>
                                                </div>
                                                <div class="row">
                                                    <small class="ml-2">360x540px(Max - 512KB)</small>
                                                </div>
                                                <div class="row">
                                                    <div class="card" style="margin-bottom: 10px; padding: 0">
                                                        <div class="card-body">
                                                            <a class="umodal__open" href="<?php echo $file_plain ? "https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th_plain/".$bookcover_small : base_url().'images/no_img.png'; ?>">
                                                                <img width="100%" class="img-border" id="img_file_cover_plain" src="<?php echo $file_plain ? "https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th_plain/".$bookcover_small : base_url().'images/no_img.png'; ?>" onerror="this.src='<?php echo base_url(); ?>images/no_img.png';">
                                                            </a>
                                                        </div>
                                                        <div class="card-body" style="padding-top: 0">
                                                            <form method="post" id="frm_upload_cover_plain" enctype="multipart/form-data">
                                                                <div class="custom-file" style="margin-bottom: 10px;">
                                                                    <input id="file_cover_plain" name="file_upload" class="custom-file-input form-control-sm" type="file" accept=".jpg">
                                                                    <label id="lbl_file_cover_plain" class="custom-file-label form-control-sm" for="file_cover_plain"><?php echo $file_plain ? $bookcover_small : 'Select File'; ?></label>
                                                                </div>
                                                                <button id="btn_file_cover_plain" class="btn btn-sm btn-outline-secondary w-100" type="submit" disabled><?php echo $file_plain ? 'Replace Cover' : 'Add Cover'; ?></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if ($isaudiobook): ?>
                                                <div class="card-body col-md-3">
                                                    <div class="row">
                                                        <h5>Albumarts (Square)</h5><
                                                    </div>
                                                    <div class="row">
                                                        <small class="ml-2">1000x1000px(Max - 512KB)</small>
                                                    </div>
                                                    <div class="row">
                                                        <div class="card" style="margin-bottom: 10px; padding: 0">
                                                            <div class="card-body">
                                                                <a class="umodal__open" href="<?php echo $file_square ? "https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th_square/".$bookcover_square : base_url().'images/no_img.png'; ?>">
                                                                    <img width="100%" class="img-border" id="img_file_square" src="<?php echo $file_square ? "https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th_square/".$bookcover_square : base_url().'images/no_img.png'; ?>" onerror="this.src='<?php echo base_url(); ?>images/no_img.png';">
                                                                </a>
                                                            </div>
                                                            <div class="card-body" style="padding-top: 0">
                                                                <form method="post" id="frm_upload_square" enctype="multipart/form-data">
                                                                    <div class="custom-file" style="margin-bottom: 10px;">
                                                                        <input id="file_square" name="file_upload" class="custom-file-input form-control-sm" type="file" accept=".jpg">
                                                                        <label id="lbl_file_square" class="custom-file-label form-control-sm" for="file_square"><?php echo $file_square ? $bookcover_square : 'Select File'; ?></label>
                                                                    </div>
                                                                    <button id="btn_file_square" class="btn btn-sm btn-outline-secondary w-100" type="submit" disabled><?php echo $file_square ? 'Replace Cover' : 'Add Image'; ?></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="card-body col-md-3">
                                                <div class="row">
                                                    <h5>Share Image</h5>
                                                </div>
                                                <div class="row">
                                                    <small class="ml-2">1200x630px(Max - 512KB)</small>
                                                </div>
                                                <div class="row">
                                                    <div class="card" style="margin-bottom: 10px; padding: 0">
                                                        <div class="card-body">
                                                            <a class="umodal__open" href="<?= $file_share ? "https://d1b3dh5v0ocdqe.cloudfront.net/media/banner_fb/".$bookcode.'.png' : base_url().'images/no_img.png'; ?>">
                                                                <img width="100%" class="img-border" id="img_file_cover_plain" src="<?= $file_share ? "https://d1b3dh5v0ocdqe.cloudfront.net/media/banner_fb/".$bookcode.'.png' : base_url().'images/no_img.png'; ?>" onerror="this.src='<?= base_url(); ?>images/no_img.png';">
                                                            </a>
                                                        </div>
                                                        <div class="card-body" style="padding-top: 0">
                                                            <form method="post" id="frm_upload_banner_fb" enctype="multipart/form-data">
                                                                <div class="custom-file" style="margin-bottom: 10px;">
                                                                    <input id="file_banner_fb" name="file_upload" class="custom-file-input form-control-sm" type="file" accept=".png">
                                                                    <label id="lbl_file_banner_fb" class="custom-file-label form-control-sm" for="file_banner_fb"><?= $file_share ? $bookcover_small : 'Select File'; ?></label>
                                                                </div>
                                                                <button id="btn_file_banner_fb" class="btn btn-sm btn-outline-secondary w-100" type="submit" disabled><?= $file_share ? 'Replace Image' : 'Upload Image'; ?></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row d-none">
                                            <div class="card-body">
                                                <div class="row justify-content-center">
                                                    <h5>Previews</h5>
                                                </div>
                                                <div class="row">
                                                    <?php for ($i=0; $i < 3; $i++) { ?>
                                                        <div class="card col-sm-4" style="margin-bottom: 10px; padding: 0;">
                                                            <div class="card-body">
                                                                <a class="umodal__open" href="<?php echo isset($previews[$i]) ? "https://bangladhol.com/bookpreview/".$previews[$i]->prev_name : base_url().'images/no_img.png'; ?>">
                                                                    <img width="100%" id="img_file_preview<?php echo $i; ?>" src="<?php echo isset($previews[$i]) ? "https://bangladhol.com/bookpreview/".$previews[$i]->prev_name : base_url().'images/no_img.png'; ?>">
                                                                </a>
                                                            </div>
                                                            <div class="card-body" style="padding-top: 0">
                                                                <form method="post" id="frm_upload_preview<?php echo $i; ?>" enctype="multipart/form-data">
                                                                    <div class="custom-file" style="margin-bottom: 10px;">
                                                                        <input id="file_preview<?php echo $i; ?>" name="file_upload" class="custom-file-input form-control-sm" type="file" accept=".jpg">
                                                                        <label id="lbl_file_preview<?php echo $i; ?>" class="custom-file-label form-control-sm" for="file_preview<?php echo $i; ?>"><?php echo isset($previews[$i]) ? $previews[$i]->prev_name : 'Choose File'; ?></label>
                                                                    </div>
                                                                    <button id="btn_file_preview<?php echo $i; ?>" class="btn btn-sm btn-outline-secondary w-100" type="submit" disabled><?php echo isset($previews[$i]) ? 'Replace Preview' : 'Add Preview'; ?></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-price" role="tabpanel">
                            <div class="card">
                                <form id="frm_price" method="post">
                                <div class="row p-3">
                                        <div class="col-4">
                                            <div class="card card-light">
                                                <div class="card-header">
                                                    <label class="m-0">Boighor BDT</label>
                                                </div>
                                                <div class="card-footer p-3">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text input-group-text-nowidth">Main</div>
                                                        </div>
                                                        <select class="form-control select2" name="global_bdt" id="txt_global_bdt" required>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="input-group form-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text input-group-text-nowidth">Disc.</div>
                                                        </div>
                                                        <select class="form-control select2" name="" id="txt_global_bdt_disc" required>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card card-light">
                                                <div class="card-header">
                                                    <label class="m-0">Boighor USD</label>
                                                </div>
                                                <div class="card-footer p-3">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text input-group-text-nowidth">Android</div>
                                                        </div>
                                                        <select class="form-control select2" name="global_usd" id="txt_global_usd" required>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="input-group form-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text input-group-text-nowidth">Apple</div>
                                                        </div>
                                                        <select class="form-control select2" name="aiap_usd" id="txt_aiap_usd" required disabled>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card card-light">
                                                <div class="card-header">
                                                    <label class="m-0">GP Boimela</label>
                                                </div>
                                                <div class="card-footer p-3">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text input-group-text-nowidth">Main</div>
                                                        </div>
                                                        <select class="form-control select2" name="gp" id="txt_gp">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="input-group form-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text input-group-text-nowidth">Disc.</div>
                                                        </div>
                                                        <select class="form-control select2" name="gp" id="txt_gp_disc">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card card-light">
                                                <div class="card-header">
                                                    <label class="m-0">Airtel Pocketbook</label>
                                                </div>
                                                <div class="card-footer p-3">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text input-group-text-nowidth">Main</div>
                                                        </div>
                                                        <select class="form-control select2" name="airtel" id="txt_airtel" required>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="input-group form-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text input-group-text-nowidth">Disc.</div>
                                                        </div>
                                                        <select class="form-control select2" name="airtel" id="txt_airtel_disc" required>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card card-light">
                                                <div class="card-header">
                                                    <label class="m-0">Robi Boighor</label>
                                                </div>
                                                <div class="card-footer p-3">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text input-group-text-nowidth">Main</div>
                                                        </div>
                                                        <select class="form-control select2" name="robi" id="txt_robi" required>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="input-group form-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text input-group-text-nowidth">Disc.</div>
                                                        </div>
                                                        <select class="form-control select2" name="robi" id="txt_robi_disc" required>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card card-light">
                                                <div class="card-header">
                                                    <label class="m-0">Banglalink Boighor</label>
                                                </div>
                                                <div class="card-footer p-3">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text input-group-text-nowidth">Main</div>
                                                        </div>
                                                        <select class="form-control select2" name="blink" id="txt_blink" required>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="input-group form-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text input-group-text-nowidth">Disc.</div>
                                                        </div>
                                                        <select class="form-control select2" name="blink" id="txt_blink_disc" required>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                        </div>
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-outline-danger w-100"><i class="fas fa-save mr-1"></i><b>Update Pricing</b></button>
                                        </div>
                                        <div class="col-4">
                                        </div>
                                    <!-- <div class="col-6">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <form id="frm_price" method="post">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row justify-content-center">
                                                                <h5>Book Pricing</h5>
                                                                <div class="col-12">
                                                                </div>
                                                                <div class="input-group form-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">Airtel Pocketbook</div>
                                                                    </div>
                                                                    <select class="form-control select2" name="airtel" id="txt_airtel" required>
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                                <div class="input-group form-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">Robi Boighor</div>
                                                                    </div>
                                                                    <select class="form-control select2" name="robi" id="txt_robi" required>
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                                <div class="input-group form-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text"> GP Boimela </div>
                                                                    </div>
                                                                    <select class="form-control select2" name="gp" id="txt_gp">
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                                <div class="input-group form-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">Banglalink Boighor</div>
                                                                    </div>
                                                                    <select class="form-control select2" name="blink" id="txt_blink" required>
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                                <div class="row">
                                                                    <button type="submit" class="btn btn-outline-danger">Update Pricing</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </form>
                            </div>
                        </div>

                        <?php if ($isaudiobook): ?>
                        <div class="tab-pane fade" id="nav-audiobook" role="tabpanel">
                            <div class="card">
                                <div class="col-12">

                                    <div class="card-body">
                                        <div class="row justify-content-center">

                                            <div class="col-12">
                                                <div class="row justify-content-center">
                                                    <h5>Audiobook Preview File</h5><small class="text-danger ml-2">Max. 2MB</small>
                                                </div>
                                                <form method="post" id="frm_upload_audiofile_preview" enctype="multipart/form-data">
                                                    <input type="hidden" name="bookcode" value="<?php echo $bookcode ?>">
                                                    <input type="hidden" name="type" value="preview">
                                                    <div class="row justify-content-center">
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="input-group form-group col-6">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text free-size">
                                                                            <i class="fas fa-file-audio"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="custom-file">
                                                                        <input id="file_audio_preview" type="file" name="file_audio_preview" class="custom-file-input form-control-sm" accept=".mp3">
                                                                        <label id="lbl_file_audio_preview" class="custom-file-label form-control-sm" for="customFile">
                                                                            <?php if ($adb_preview): ?>
                                                                                <?php echo $bookcode.'-preview.mp3' ?>
                                                                            <?php else: ?>
                                                                                Select File
                                                                            <?php endif; ?>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="input-group form-group col-2">
                                                                    <button id="btn_file_audio_preview" class="btn btn-sm btn-outline-secondary w-100" type="submit" disabled><i class="fas fa-upload mr-1"></i><b>Upload</b></button>
                                                                </div>
                                                                <?php if ($adb_preview): ?>
                                                                    <!-- <div class="input-group form-group col-2">
                                                                        <a href="https://boighor-audio-input.s3.ap-southeast-1.amazonaws.com/media/audiobook/<?php //echo $bookcode.'-preview.mp3' ?>" target="_blank" class="btn btn-sm btn-primary w-100 p-2"><i class="fas fa-download mr-1"></i><b>Download</b></a>
                                                                    </div> -->
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <?php if ($adb_preview): ?>
                                                            <div class="col-sm-3" style="margin-top: -8;">
                                                                <div class="row">
                                                                    <div class="input-group form-group">
                                                                        <audio controls>
                                                                            <source src="https://boighor-audio-input.s3.ap-southeast-1.amazonaws.com/media/audiobook/<?php echo $bookcode.'-preview.mp3' ?>" type="audio/mpeg">
                                                                            Your browser does not support the audio element.
                                                                        </audio>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-12">
                                                <div class="row justify-content-center">
                                                    <h5>Upload New Audio File</h5><small class="text-danger ml-2">Max. 50MB</small>
                                                </div>
                                                <form method="post" id="frm_upload_audiofile" enctype="multipart/form-data">
                                                    <input type="hidden" name="type" value="main">
                                                    <div class="row justify-content-center">
                                                        <div class="col-sm-4">
                                                            <div class="input-group form-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text free-size">Name(En)</div>
                                                                </div>
                                                                <input type="text" class="form-control" name="title" id="txt_audoibook_name_en" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="input-group form-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text free-size">Name(Bn)</div>
                                                                </div>
                                                                <input type="text" class="form-control" name="title_bn" id="txt_audoibook_name_bn" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="row">
                                                                <div class="input-group form-group col-9">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text free-size">
                                                                            <i class="fas fa-file-audio"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="custom-file">
                                                                        <input id="file_audio" type="file" name="file_audio" class="custom-file-input form-control-sm" accept=".mp3">
                                                                        <label id="lbl_file_audio" class="custom-file-label form-control-sm" for="customFile">Select File</label>
                                                                    </div>
                                                                </div>
                                                                <div class="input-group form-group col-3">
                                                                    <button id="btn_file_audio" class="btn btn-sm btn-outline-secondary w-100" type="submit" disabled><i class="fas fa-upload mr-1"></i><b>Upload</b></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>


                                            <h5>Existing Audio Files:</h5>
                                            <div class="col-sm-12">
                                                <table style="width:100%" class="table table-hover table-bordered">
                                                    <thead>
                                                        <th><b>#</b></th>
                                                        <th><b>adbID</b></th>
                                                        <th><b>Name(En)</b></th>
                                                        <th><b>Name(Bn)</b></th>
                                                        <th><b>Filename</b></th>
                                                        <th><b>Length</b></th>
                                                        <th><b>File size</b></th>
                                                        <th><b>Play</b></th>
                                                        <th><b>Added-by</b></th>
                                                        <th colspan="3"><b>Action</b></th>
                                                    </thead>
                                                    <tbody>
                                                        <?php $sl=0; ?>
                                                        <?php foreach ($audiobooks as $audiobook): ?>
                                                            <?php $sl=$sl+1; ?>
                                                            <tr>
                                                                <td><?= $sl ?></td>
                                                                <td><?= $audiobook->id ?></td>
                                                                <td><?= $audiobook->title ?></td>
                                                                <td><?= $audiobook->title_bn ?></td>
                                                                <td><?= $audiobook->bookaudiocode ?></td>
                                                                <td><?= $audiobook->filelength ?></td>
                                                                <td><?= $audiobook->filesize ?></td>
                                                                <td class="p-1">
                                                                    <audio controls>
                                                                        <source src="https://boighor-audio-input.s3.ap-southeast-1.amazonaws.com/media/audiobook/<?= $audiobook->bookaudiocode ?>" type="audio/mpeg">
                                                                            Your browser does not support the audio element.
                                                                        </audio>
                                                                    </td>
                                                                    <td class="capitalize"><?= $audiobook->addedby ?></td>
                                                                    <!-- <td>
                                                                    <a href="https://boighor-audio-input.s3.ap-southeast-1.amazonaws.com/media/audiobook/<?php //echo $audiobook->bookaudiocode ?>" target="_blank" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Download"><i class="fas fa-download"></i></a>
                                                                </td> -->
                                                                <td>
                                                                    <button type="button" name="btn_status" class="btn <?php echo $audiobook->status ? 'btn-success' : 'btn-secondary' ?> btn-sm mr-1" id="btn_adb_status_<?php echo $audiobook->id ?>" value="<?php echo $audiobook->status ?>" data-toggle="tooltip" data-original-title="Status"><i class="fas fa-power-off"></i></button>
                                                                </td>
                                                                <td>
                                                                    <button type="button" name="btn_edit_audiobook" class="btn btn-warning btn-sm btn_edit_audiobook" id="btn_edit_audiobook_<?php echo $audiobook->id ?>" data-toggle="modal" data-target="#modal_edit_audiobook"><i class="fas fa-edit"></i></button>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="tab-pane fade" id="nav-history" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="timeline">
                                                <p class="invisible collapsing m-0 p-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                <?php foreach ($logs as $log):
                                                    ?>
                                                    <div>
                                                        <?php if (strpos($log->whatyoudid, 'info')): ?>
                                                            <i class="fas fa-info bg-primary"></i>
                                                        <?php elseif (strpos($log->whatyoudid, 'genre')): ?>
                                                            <i class="fas fa-theater-masks bg-warning"></i>
                                                        <?php elseif (strpos($log->whatyoudid, 'tags')): ?>
                                                            <i class="fas fa-tags bg-success"></i>
                                                        <?php elseif (strpos($log->whatyoudid, 'pricing')): ?>
                                                            <i class="fas fa-dollar-sign bg-danger"></i>
                                                        <?php elseif (strpos($log->whatyoudid, 'status')): ?>
                                                            <i class="fas fa-broadcast-tower bg-danger"></i>
                                                        <?php elseif (strpos($log->whatyoudid, 'audiobook')): ?>
                                                            <i class="fas fa-volume-up bg-primary"></i>
                                                        <?php else: ?>
                                                            <i class="fas fa-clock bg-secondary"></i>
                                                        <?php endif; ?>
                                                        <div class="timeline-item <?php echo $log->response ? '' : 'bg-danger' ?>">
                                                            <span class="time"><i class="fas fa-clock mr-1"></i> <?= $log->timeofentry ?></span>
                                                            <h3 class="timeline-header">
                                                                <?php
                                                                $wyd = $log->whatyoudid;
                                                                ?>
                                                                <a>
                                                                    <?php echo ucfirst($log->usr) ?>
                                                                </a>
                                                                <span>
                                                                    <?php echo ucwords(explode(" - ", $wyd)[0]) ?>
                                                                </span>

                                                            </h3>
                                                        </div>
                                                    </div>
                                                <?php endforeach;?>
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

    </div>
</div>

<div class="modal fade" id="modal_edit_audiobook">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Edit Audio File</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="frm_edit_audiobook" enctype="multipart/form-data">
                <input type="hidden" id="txt_bookaudiocode" name="bookaudiocode" value="" required>
                <input type="hidden" id="txt_bookaudiocode_rowid" name="rowid" value="" required>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="input-group form-group col-12">
                            <div class="input-group-prepend">
                                <div class="input-group-text free-size">Name(En)</div>
                            </div>
                            <input type="text" class="form-control" name="title" id="txt_audoibook_name_en_edit" required>
                        </div>
                        <div class="input-group form-group col-12">
                            <div class="input-group-prepend">
                                <div class="input-group-text free-size">Name(Bn)</div>
                            </div>
                            <input type="text" class="form-control" name="title_bn" id="txt_audoibook_name_bn_edit" required>
                        </div>
                        <div class="input-group form-group col-12">
                            <div class="input-group-prepend">
                                <div class="input-group-text free-size">Length</div>
                            </div>
                            <input type="text" class="form-control" name="filelength" id="txt_audoibook_filelength_edit" required pattern="^([0-9]{1,2}:[0-9]{2}:[0-9]{2}|[0-9]{1,2}:[0-9]{2})$">
                        </div>
                        <div class="input-group form-group col-12">
                            <div class="input-group-prepend">
                                <div class="input-group-text free-size">
                                    <i class="fas fa-file-audio"></i>
                                </div>
                            </div>
                            <div class="custom-file">
                                <input id="file_audio_edit" type="file" name="file_audio" class="custom-file-input form-control-sm" accept=".mp3">
                                <label id="lbl_file_audio_edit" class="custom-file-label form-control-sm" for="customFile">Select File</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between pb-0">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_file_audio_edit" class="btn btn-primary disabled" disabled><i class="fas fa-save mr-1"></i>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

$('#navlink_books').addClass('menu-open');
$('#navlink_booklist').addClass('active');
$('.input-group-text').width(90);
$('.input-group-text-nowidth').width(45);
$('.prepend-short-20').width(20);
$('.free-size').width('');
$('.loading').addClass('d-none');

var audiobooks = <?php echo json_encode($audiobooks) ?>;

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
// async function removeLoaderAfterWaiting() {
//     await sleep(2000);
//     $('.loading').addClass('d-none');
//     console.log("wait done");
// }
// removeLoaderAfterWaiting();

var tag = <?php echo json_encode($tags); ?>;

document.getElementById('titletags').className = '';

var tagify = new Tagify(document.querySelector('#titletags'), {
    // pattern : "/[1-9]/",
    blacklist : ['a', 'an', 'and', 'O', 'the', 'on', 'of', 'for', 'in', 'at', 'if', 'Ek', 'ek', 'দ্যা', 'অফ', 'এ্যান্ড', 'ও', 'এবং', 'এক', '-', ':', ';', '&', '?', '!']
});

// disable e-book upload

if (<?php echo $isaudiobook==1 ? 'true' : 'false' ?>) {
    $('#file_epub').attr('disabled', true);
}

// author
var authorSelect = document.getElementById("txt_writer");
var authorlist = <?php echo json_encode($authorlist); ?>;
for (author of authorlist) {
    authorSelect.options.add(new Option(author.author+' - '+author.author_bn, author.authorcode));
}
authorSelect.value = '<?php echo $writercode; ?>';


// publisher
var publisherSelect = document.getElementById("txt_publisher");
var publisherlist = <?php echo json_encode($publisherlist); ?>;
for (publisher of publisherlist) {
    publisherSelect.options.add(new Option(publisher.publishername_en+' - '+publisher.publishername_bn, publisher.publishercode));
}
publisherSelect.value = "<?php echo $publishercode; ?>";

//  category
var categorySelect = document.getElementById("txt_category");
var categoryList = <?php echo json_encode($categoryList); ?>;
for (category of categoryList) {
    categorySelect.options.add(new Option(category.catname_en+' - '+category.catname_bn, category.catcode));
}
categorySelect.value = '<?php echo $category; ?>';

//  genre
var genreSelect = document.getElementById("txt_genre");
var genreList = <?php echo json_encode($genreList); ?>;
for (genre of genreList) {
    genreSelect.options.add(new Option(genre.genre_en+' - '+genre.genre_bn, genre.genre_code));
}

// price_local
var priceBdtSelect = document.getElementById("txt_global_bdt");
var priceBdtDiscSelect = document.getElementById("txt_global_bdt_disc");
var priceAirtelSelect = document.getElementById("txt_airtel");
var priceRobiSelect = document.getElementById("txt_robi");
var priceGpSelect = document.getElementById("txt_gp");
var priceBlinkSelect = document.getElementById("txt_blink");
var priceAirtelDiscSelect = document.getElementById("txt_airtel_disc");
var priceRobiDiscSelect = document.getElementById("txt_robi_disc");
var priceGpDiscSelect = document.getElementById("txt_gp_disc");
var priceBlinkDiscSelect = document.getElementById("txt_blink_disc");

var priceBdtList = <?php echo json_encode($pricelistbdt); ?>;
for (priceBdt of priceBdtList) {
    var selectText = priceBdt.bookprice+' -- '+priceBdt.bookprice_bn+' - '+priceBdt.bookprice_en+' (inc.VAT)';
    priceBdtSelect.options.add(new Option(selectText, priceBdt.id));
    // priceBkashSelect.options.add(new Option(selectText, priceBdt.id));
}

var priceBdtList = <?php echo json_encode($pricelistbdt); ?>;
for (priceBdt of priceBdtList) {
    var selectText = priceBdt.bookprice+' -- '+priceBdt.bookprice_bn+' - '+priceBdt.bookprice_en+' (inc.VAT)';
    priceBdtDiscSelect.options.add(new Option(selectText, priceBdt.id));
    // priceBkashSelect.options.add(new Option(selectText, priceBdt.id));
}

var priceBdtList = <?php echo json_encode($pricelistgp); ?>;
for (priceBdt of priceBdtList) {
    var selectText = priceBdt.bookprice+' -- '+priceBdt.bookprice_bn+' - '+priceBdt.bookprice_en+' (inc.VAT)';
    priceGpSelect.options.add(new Option(selectText, priceBdt.id));
    priceGpDiscSelect.options.add(new Option(selectText, priceBdt.id));
}

var priceBdtList = <?php echo json_encode($pricelistblink); ?>;
for (priceBdt of priceBdtList) {
    var selectText = priceBdt.bookprice+' -- '+priceBdt.bookprice_bn+' - '+priceBdt.bookprice_en+' (inc.VAT)';
    priceBlinkSelect.options.add(new Option(selectText, priceBdt.id));
    priceBlinkDiscSelect.options.add(new Option(selectText, priceBdt.id));
}

var priceBdtList = <?php echo json_encode($pricelistairtel); ?>;
for (priceBdt of priceBdtList) {
    var selectText = priceBdt.bookprice+' -- '+priceBdt.bookprice_bn+' - '+priceBdt.bookprice_en+' (inc.VAT)';
    priceAirtelSelect.options.add(new Option(selectText, priceBdt.id));
    priceAirtelDiscSelect.options.add(new Option(selectText, priceBdt.id));
}

var priceBdtList = <?php echo json_encode($pricelistrobi); ?>;
for (priceBdt of priceBdtList) {
    var selectText = priceBdt.bookprice+' -- '+priceBdt.bookprice_bn+' - '+priceBdt.bookprice_en+' (inc.VAT)';
    priceRobiSelect.options.add(new Option(selectText, priceBdt.id));
    priceRobiDiscSelect.options.add(new Option(selectText, priceBdt.id));
}

var priceUsdSelect = document.getElementById("txt_global_usd");
var priceAiapSelect = document.getElementById("txt_aiap_usd");
var priceUsdList = <?php echo json_encode($pricelistusd); ?>;
for (priceUsd of priceUsdList) {
    priceUsdSelect.options.add(new Option('$'+priceUsd.price, priceUsd.id));
    priceAiapSelect.options.add(new Option('$'+priceUsd.price, priceUsd.id));
}

$('#txt_isenglishbook').val('<?php echo $isenglishbook; ?>');
$('#txt_global_bdt').val(<?php echo $prices->global_bdt; ?>);
$('#txt_global_bdt_disc').val(<?php echo $prices->global_bdt_disc; ?>);
$('#txt_global_usd').val(<?php echo $prices->global_usd; ?>);
$('#txt_aiap_usd').val(<?php echo $prices->aiap_usd; ?>);
$('#txt_airtel').val(<?php echo $prices->airtel; ?>);
$('#txt_robi').val(<?php echo $prices->robi; ?>);
$('#txt_gp').val(<?php echo $prices->gp; ?>);
$('#txt_blink').val(<?php echo $prices->blink; ?>);
$('#txt_airtel_disc').val(<?php echo $prices->airtel_disc; ?>);
$('#txt_robi_disc').val(<?php echo $prices->robi_disc; ?>);
$('#txt_gp_disc').val(<?php echo $prices->gp_disc; ?>);
$('#txt_blink_disc').val(<?php echo $prices->blink_disc; ?>);


$('#txt_genre').val(<?php echo json_encode($genres); ?>).trigger('change');
// .change(function(e){ console.log($(".select2").val()); });


$('#txt_isfree_local').on('change', function() {
    var price_local = document.getElementById("txt_price_local");
    if (this.value == 1) {
        $('#txt_price_local').val(0);
        price_local.options[0].disabled = false;
        price_local.options[1].disabled = true;
        price_local.options[2].disabled = true;
        price_local.options[3].disabled = true;
    } else {
        $('#txt_price_local').val(10);
        price_local.options[0].disabled = true
        price_local.options[1].disabled = false
        price_local.options[2].disabled = false
        price_local.options[3].disabled = false
    }
});


$('#txt_isfree_global').on('change', function() {
    var price_global = document.getElementById("txt_price_global");
    if (this.value == 1) {
        $('#txt_price_global').val(0);
        price_global.options[0].disabled = false;
        price_global.options[1].disabled = true;
    } else {
        $('#txt_price_global').val(0.99);
        price_global.options[0].disabled = true;
        price_global.options[1].disabled = false;
    }
});

$('#txt_global_usd').on('change', function() {
    var global_usd = $('#txt_global_usd').val();
    if (global_usd >= 15 && global_usd <= 19) {
        aiap_usd = global_usd-5;
        $('#txt_aiap_usd').val(aiap_usd).trigger('change');
    } else {
        $('#txt_aiap_usd').val(global_usd).trigger('change');
    }
});

$('#frm_book_info').on('submit', function(e){
    e.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: "Confirm Update Information",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            var data = {};
            data['bookcode'] = '<?php echo $bookcode; ?>';
            data['bookname'] = document.getElementById('txt_title_en').value;
            data['bookname_bn'] = document.getElementById('txt_title_bn').value;
            data['writercode'] = $("#txt_writer option:selected").val();
            data['writer'] = $("#txt_writer option:selected").text().split(" - ")[0];
            data['writer_bn'] = $("#txt_writer option:selected").text().split(" - ")[1];
            data['publishercode'] = document.getElementById('txt_publisher').value;
            data['publisher'] = $("#txt_publisher option:selected").text().split(" - ")[0];
            data['publisher_bn'] = $("#txt_publisher option:selected").text().split(" - ")[1];
            data['publisher'] = (data['publisher'] ? data['publisher'].trim() : '');
            data['publisher_bn'] = (data['publisher_bn'] ? data['publisher_bn'].trim() : '');
            data['category'] = document.getElementById('txt_category').value;
            data['booksummary'] = document.getElementById('txt_booksummary').value;
            data['isenglishbook'] = document.getElementById('txt_isenglishbook').value;
            data['audiobookcode'] = document.getElementById('txt_audiobookcode').value;
            data['bookpage'] = document.getElementById('txt_book_page').value;
            data['productid_googleplay'] = document.getElementById('txt_productid_googleplay').value;
            data['productid_appstore'] = document.getElementById('txt_productid_appstore').value;
            data['isexclusive'] = document.getElementById('txt_isexclusive').value;
            data['royalty_percent'] = document.getElementById('txt_royalty_percent').value;


            var oldGenres = <?php echo json_encode($genres); ?>;
            var newGenres = $('#txt_genre').val();
            var addGenre = [];
            var deleteGenre = [];

            for (var genre in newGenres) {
                if (!oldGenres.includes(newGenres[genre])) {
                    addGenre.push(newGenres[genre]);
                }
            }
            for (var genre in oldGenres) {
                if (!newGenres.includes(oldGenres[genre])) {
                    deleteGenre.push(oldGenres[genre]);
                }
            }

            data['genre'] = {
                add : addGenre,
                delete : deleteGenre
            };
            /////////////
            let titleTags = document.getElementById('titletags').value;
            if (titleTags) {
                titleTags = JSON.parse(titleTags).map(function(d) { return d['value']; });
            }
            var addTags = [];
            var deleteTags = [];
            if (JSON.stringify(titleTags) != JSON.stringify(tag)) {
                for (var tagitem in tag) {
                    if (!titleTags.includes(tag[tagitem])) {
                        deleteTags.push(tag[tagitem]);
                    }
                }
                for (var tagitem in titleTags) {
                    if (!tag.includes(titleTags[tagitem])) {
                        addTags.push(titleTags[tagitem]);
                    }
                }
            }
            data['titleTags'] = {
                add : addTags,
                delete : deleteTags
            };
            console.log(data);

            $.ajax({
                url: "<?php echo base_url() ?>book/updateBookInfo",
                type: "POST",
                data: data,
                success: function(data){
                    console.log(data);
                    if (data == 111) {
                        Swal.fire("Information Updated Successfully", "", "success").then((result) => {
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


$('#frm_upload_epub, #frm_upload_epub_preview, #frm_upload_cover, #frm_upload_cover_plain, #frm_upload_banner_fb, #frm_upload_square, #frm_upload_preview0, #frm_upload_preview1, #frm_upload_preview2').on('submit', function(e){
    e.preventDefault();
    Swal.fire({
        title: 'Please Confirm',
        text: (e.target.id.substring(0,15) == 'frm_upload_epub' ? "Are you sure you want to upload or replace this .epub file?" : "Are you sure you want to upload or replace this image?"),
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            var previews = <?php echo json_encode($previews); ?>;
            var form_data = new FormData($('#'+e.target.id)[0]);
            var type = '';
            if (e.target.id == 'frm_upload_epub') {
                type = 'ebook';
            } else if (e.target.id == 'frm_upload_epub_preview') {
                type = 'book_preview';
            } else if (e.target.id == 'frm_upload_cover') {
                type = 'cover';
            } else if (e.target.id == 'frm_upload_cover_plain') {
                type = 'plain';
            } else if (e.target.id == 'frm_upload_square') {
                type = 'square';
            } else if (e.target.id == 'frm_upload_banner_fb') {
                type = 'fb';
            } else {
                type = e.target.id.substring(11);
            }
            var previewfilename = (previews[e.target.id.charAt(e.target.id.length-1)] ? previews[e.target.id.charAt(e.target.id.length-1)].prev_name : '');
            var oldfilename = '';
            if (e.target.id == 'frm_upload_epub') {
                 oldfilename = '<?php echo $filename ?>';
            } else if (e.target.id == 'frm_upload_epub_preview') {
                oldfilename = '<?php echo $bookcode.'.epub' ?>';
            } else if (e.target.id == 'frm_upload_cover' || e.target.id == 'frm_upload_cover_plain') {
                oldfilename = '<?php echo $bookcover_small ?>';
            } else if (e.target.id == 'frm_upload_square') {
                oldfilename = '<?php echo $bookcover_square ?>';
            } else {
                oldfilename = previewfilename;
            }
            Swal.fire({
                title: 'Please Wait...',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            $.ajax({
                url: "<?php echo base_url() ?>book/uploadFile/"+type+"/<?php echo $bookcode; ?>/"+oldfilename,
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        if (type == 'ebook' || type == 'book_preview') {
                            Swal.fire("Epub Uploaded Successfully", "", "success").then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: "Image Uploaded Successfully",
                                icon: "success",
                                timer: 500,
                                buttons: false
                            }).then((value) => {
                                location.reload(true);
                            });
                        }
                    } else {
                        Swal.fire("Oops.. Something Went Wrong!", data, "error").then((result) => {
                            location.reload();
                        });
                    }
                },
                error: function() {
                    Swal.fire("Oops.. Something Went Wrong!", "", "error").then((result) => {
                        location.reload();
                    });
                }
            });
        }
    });
});

$('#file_epub, #file_epub_preview, #file_cover, #file_cover_plain, #file_banner_fb, #file_square, #file_preview0, #file_preview1, #file_preview2').change(function(e){

    if (e.target.id.substring(0,9) == 'file_epub') {
        document.getElementById('lbl_'+e.target.id).innerHTML = e.target.files[0].name;
        document.getElementById('btn_'+e.target.id).className = 'btn btn-sm btn-danger';
        document.getElementById('btn_'+e.target.id).disabled = false;
    } else {
        var img = new Image;
        img.onload = function() {
            if(
                (e.target.id.substring(0,10) == 'file_cover' && '<?php echo $category; ?>'!='cmx' && img.width == 360 && img.height == 540)
                ||
                (e.target.id.substring(0,10) == 'file_cover' && '<?php echo $category; ?>'=='cmx' && img.width == 360 && img.height == 488)
                ||
                (e.target.id.substring(0,11) == 'file_square' && '<?php echo $isaudiobook; ?>'==='1' && img.width == 1000 && img.height == 1000)
                ||
                (e.target.id.substring(0,12) == 'file_preview' && img.width == 1080 && img.height == 1920)
                ||
                (e.target.id.substring(0,14) == 'file_banner_fb' && img.width == 1200 && img.height == 630)
            ) {
                document.getElementById('lbl_'+e.target.id).innerHTML = e.target.files[0].name;
                document.getElementById('btn_'+e.target.id).className = 'btn btn-sm btn-danger w-100';
                document.getElementById('btn_'+e.target.id).disabled = false;
                document.getElementById('btn_'+e.target.id).innerHTML = 'Upload';
                if (e.target.files && e.target.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (ee) {
                        $('#img_'+e.target.id).attr('src', ee.target.result);
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
                Toast.fire({
                    type: 'warning',
                    title: ' Images are not uploaded until you click the Upload button'
                });
            } else {
                $('#img_'+e.target.id).attr('src', '<?php echo base_url().'images/no_img.png'; ?>');
                document.getElementById('lbl_'+e.target.id).innerHTML = 'Choose File';
                document.getElementById('btn_'+e.target.id).className = 'btn btn-sm btn-outline-secondary w-100';
                document.getElementById('btn_'+e.target.id).disabled = true;
                Swal.fire("Incorrent resolution", "Book Image must have 360x540, Comics Image must have 360x488, Albumarts must have 1000x1000", "warning");
            }
        };
        img.src = URL.createObjectURL(this.files[0]);
    }
});

function updateTagInfo() {
    Swal.fire({
        title: 'Please Confirm',
        text: "Are you sure you want to update tagging?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            let titleTags = document.getElementById('titletags').value;
            if (titleTags) {
                titleTags = JSON.parse(titleTags).map(function(d) { return d['value']; });
            }
            let writerTags = document.getElementById('writertags').value;
            if (writerTags) {
                writerTags = JSON.parse( writerTags ).map(function(d) { return d['value']; });
            }
            let genreTags = document.getElementById('genretags').value;
            if (genreTags) {
                genreTags = JSON.parse( genreTags ).map(function(d) { return d['value']; });
            }
            var data = {};
            if (titleTags && titleTags != <?php echo json_encode(isset($tags[0]) ? $tags[0]: ""); ?>) {
                data['1'] = titleTags;
            }
            if (writerTags && writerTags != <?php echo json_encode(isset($tags[1]) ? $tags[1]: ""); ?>) {
                data['2'] = writerTags;
            }
            if (genreTags && genreTags != <?php echo json_encode(isset($tags[2]) ? $tags[2]: ""); ?>) {
                data['3'] = genreTags;
            }
            // console.log(tag[0]);
            var addTags = [[],[],[]];
            var deleteTags = [[],[],[]];
            //  TITLEs
            if (JSON.stringify(titleTags) != JSON.stringify(tag[0])) {
                for (var tagitem in tag[0]) {
                    if (!titleTags.includes(tag[0][tagitem])) {
                        deleteTags[0].push(tag[0][tagitem]);
                    }
                }
                for (var tagitem in titleTags) {
                    if (!tag[0].includes(titleTags[tagitem])) {
                        addTags[0].push(titleTags[tagitem]);
                    }
                }
            }
            //  WRITERs
            if (JSON.stringify(writerTags) != JSON.stringify(tag[1])) {
                for (var tagitem in tag[1]) {
                    if (!writerTags.includes(tag[1][tagitem])) {
                        deleteTags[1].push(tag[1][tagitem]);
                    }
                }
                for (var tagitem in writerTags) {
                    if (!tag[1].includes(writerTags[tagitem])) {
                        addTags[1].push(writerTags[tagitem]);
                    }
                }
            }
            //  GENREs
            if (JSON.stringify(genreTags) != JSON.stringify(tag[2])) {
                for (var tagitem in tag[2]) {
                    if (!genreTags.includes(tag[2][tagitem])) {
                        deleteTags[2].push(tag[2][tagitem]);
                    }
                }
                for (var tagitem in genreTags) {
                    if (!tag[2].includes(genreTags[tagitem])) {
                        addTags[2].push(genreTags[tagitem]);
                    }
                }

            }
            console.log(addTags);
            console.log(deleteTags);
            if (!addTags && !deleteTags) {
                Swal.fire("Tags Updated Successfully", "", "success");
                return 0;
            }
            // console.log(titleTags);

            $.ajax({
                url: "<?php echo base_url() ?>book/updateTags/<?php echo $bookcode; ?>",
                method: "POST",
                data: {
                    add : addTags,
                    delete: deleteTags
                },
                success:function(data) {
                    // console.log(data);
                    if (data == 1) {
                        Swal.fire("Tags Updated Successfully", "", "success").then((result) => {
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
        } else {
            return 0;
        }
    });
}

$("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('onText', 'Online').bootstrapSwitch('offText', 'Offline').bootstrapSwitch('state', $(this).prop('checked'));
});


$( "#btn_local, #btn_global" ).click(function() {

    Swal.fire({
        title: "Make this Book <?php echo $status ? 'Offline' : 'Online' ?> for "+(this.id == 'btn_local' ? 'Local' : 'Global')+" Platform?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
    }).then((result) => {
        if (result.value) {
            if ((this.id == 'btn_local' && <?php echo $status ? '0' : '1' ?>==0) || (this.id == 'btn_global' && <?php echo $globalstatus ? '0' : '1' ?>==0)) {
                if (this.id == 'btn_local') {
                    changeBookStatus('status', '<?php echo $status ? '0' : '1' ?>');
                } else {
                    changeBookStatus('globalstatus', '<?php echo $globalstatus ? '0' : '1' ?>');
                }
            } else {
                Swal.fire({
                    title: 'Checking Validity',
                    timer: Math.floor(Math.random() * 3000) + 2000,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                }).then((result) => {
                    checkBookLiveValidity(this.id);
                });
            }
        }
    });

});

function checkBookLiveValidity(id) {
    $.ajax({
        url: "<?php echo base_url() ?>book/checkBookLiveValidity/<?php echo $bookcode; ?>",
        method: "POST",
        success:function(data) {
            data = JSON.parse(data);
            console.log(data);
            if (data == '') {
                if (id == 'btn_local') {
                    changeBookStatus('status', '<?php echo $status ? '0' : '1' ?>');
                } else {
                    changeBookStatus('globalstatus', '<?php echo $globalstatus ? '0' : '1' ?>');
                }
            } else {
                var html = '<div class="row justify-content-center"><ol>';
                for (i of data) html += '<b><li>'+i+'</li></b>';
                html += '</ol></div>';
                Swal.fire("Followings are required to make this book LIVE", html, "error");
            }
        }
    });
}

function changeBookStatus(platform, status) {
    $.ajax({
        url: "<?php echo base_url() ?>book/changeStatus/<?php echo $bookcode; ?>",
        method: "POST",
        data: {
            platform : platform,
            status: status
        },
        success:function(data) {
            console.log(data);
            if (data == 1) {
                Swal.fire("Status Updated Successfully", "", "success").then((result) => {
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

$('#frm_price').on('submit', function(e) {
    e.preventDefault();
    var data = {};
    data['global_bdt'] = $('#txt_global_bdt').val();
    data['global_usd'] = $('#txt_global_usd').val();
    data['aiap_usd'] = $('#txt_aiap_usd').val();
    data['global_bdt_disc'] = $('#txt_global_bdt_disc').val();
    data['airtel'] = $('#txt_airtel').val();
    data['robi'] = $('#txt_robi').val();
    data['gp'] = $('#txt_gp').val();
    data['blink'] = $('#txt_blink').val();
    data['airtel_disc'] = $('#txt_airtel_disc').val();
    data['robi_disc'] = $('#txt_robi_disc').val();
    data['gp_disc'] = $('#txt_gp_disc').val();
    data['blink_disc'] = $('#txt_blink_disc').val();
    $.ajax({
        url: "<?php echo base_url() ?>book/updatePricing/<?php echo $bookcode; ?>",
        method: "POST",
        data: data,
        success:function(data) {
            console.log(data);
            if (data == 1) {
                Swal.fire("Pricing Updated Successfully", "", "success").then((result) => {

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
})

$('#file_audio, #file_audio_preview').change(function(e){
    document.getElementById('lbl_'+e.target.id).innerHTML = e.target.files[0].name;
    document.getElementById('btn_'+e.target.id).className = 'btn btn-sm btn-danger w-100';
    document.getElementById('btn_'+e.target.id).disabled = false;
    if (e.target.id=='file_audio_preview' && <?= $adb_preview?>==1) {
        document.getElementById('btn_'+e.target.id).innerHTML = '<i class="fas fa-upload mr-1"></i><b>Replace</b>';
    } else {
        document.getElementById('btn_'+e.target.id).innerHTML = '<i class="fas fa-upload mr-1"></i><b>Upload</b>';
    }
});

$('#file_audio_edit').change(function(e){
    document.getElementById('lbl_'+e.target.id).innerHTML = e.target.files[0].name;
    document.getElementById('btn_file_audio_edit').className = 'btn btn-danger';
    document.getElementById('btn_file_audio_edit').disabled = false;
});

$('#txt_audoibook_name_en_edit, #txt_audoibook_name_bn_edit, #txt_audoibook_filelength_edit').keyup(function(e){
    document.getElementById('btn_file_audio_edit').className = 'btn btn-danger';
    document.getElementById('btn_file_audio_edit').disabled = false;
});

$('#frm_upload_audiofile, #frm_upload_audiofile_preview').on('submit', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Are You Sure?',
        text: 'You are about to upload Audiobook',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {

            var form_data = new FormData($('#'+e.target.id)[0]);
            form_data.append("bookcode", '<?php echo $bookcode ?>');
            // form_data.append("title", $('#txt_audoibook_name_en').val());
            // form_data.append("title_bn", $('#txt_audoibook_name_bn').val());

            console.log(form_data);
            var swal = Swal.fire({
                title: 'Uploading File...',
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
                            $('#progress').width(parseInt(percentComplete)+'%');
                            $('#progress_label').text('Progress: '+parseInt(percentComplete)+'%');
                        }
                    }, false);
                    return xhr;
                },
                url: "<?php echo base_url() ?>book/uploadAudiobook/<?php echo $bookcode ?>/",
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("File Uploaded Successfully", "", "success").then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Oops.. Something Went Wrong!", "", "error").then((result) => {
                            location.reload();
                        });
                    }
                },
                error: function(data) {
                    Swal.fire("Oops.. Something Went Wrong!", "", "error").then((result) => {
                        location.reload();
                    });
                }
            });
        }
    });
});

$('button[name=btn_status]').on('click', function(e) {
    console.log(this.id.substring(15));
    console.log($('#'+this.id).val()==1 ? "a" : "b");

    Swal.fire({
        title: 'Please Wait...',
        allowOutsideClick: false,
        onBeforeOpen: () => {
            Swal.showLoading()

            $.ajax({
                url: "<?php echo base_url() ?>book/change_adb_status",
                method: "POST",
                data: {
                    id: this.id.substring(15),
                    status: $('#'+this.id).val()==1 ? 0 : 1
                },
                success:function(data) {
                    console.log(data);
                    toastr.success('Status Changed Successfully')
                    location.reload();
                    Swal.close()
                },
                error: function() {
                    toastr.success('Something Went Wrong')
                    location.reload();
                    Swal.close()
                }
            });

        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
        }
    })
})

$('#frm_status').on('submit', function(e) {
    e.preventDefault();
    var statuses = {};
    statuses['bookcode'] = '<?php echo $bookcode; ?>';
    statuses['status_gp'] = ($('#chk_status_gp').is(":checked"))==true ? '1' : '0';
    statuses['status_airtel'] = ($('#chk_status_airtel').is(":checked"))==true ? '1' : '0';
    statuses['status_robi'] = ($('#chk_status_robi').is(":checked"))==true ? '1' : '0';
    statuses['status_global'] = ($('#chk_status_global').is(":checked"))==true ? '1' : '0';
    statuses['status_blink'] = ($('#chk_status_blink').is(":checked"))==true ? '1' : '0';
    console.log(statuses);
    Swal.fire({
		title: 'Do you want to Update Statuses?',
		type: 'question',
		showCancelButton: true,
		confirmButtonText: 'Confirm',
		allowOutsideClick: false,
	}).then((result) => {
		if (result.value) {
            Swal.fire({
                title: 'Please Wait...',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            $.ajax({
                url: "<?php echo base_url() ?>book/changeStatus_bulk",
                method: "POST",
                data: {
                    'statuses' : statuses,
                },
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire({
                            title: "Status Updated Successfully",
                            icon: "success",
                            timer: 500,
                            buttons: false
                        }).then((value) => {
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
})

$(".btn_edit_audiobook").click(function(e) {
    var audiobookid = this.id.split('_').pop();
    var this_adb_row = audiobooks.find(function(row) {
        return row.id == audiobookid;
    });
    // console.log(this_adb_row);
    $('#txt_audoibook_name_en_edit').val(this_adb_row.title);
    $('#txt_audoibook_name_bn_edit').val(this_adb_row.title_bn);
    $('#txt_audoibook_filelength_edit').val(this_adb_row.filelength);
    $('#lbl_file_audio_edit').text(this_adb_row.bookaudiocode);
    $('#txt_bookaudiocode').val(this_adb_row.bookaudiocode);
    $('#txt_bookaudiocode_rowid').val(this_adb_row.id);
});

$('#frm_edit_audiobook').on('submit', function(e) {
    e.preventDefault();
    console.log('on form submit');
    var form_data = new FormData($('#'+e.target.id)[0]);
    Swal.fire({
		title: 'Do you want to update this Audiobook?',
		type: 'question',
		showCancelButton: true,
		confirmButtonText: 'Confirm',
		allowOutsideClick: false,
	}).then((result) => {
		if (result.value) {
            var swal = Swal.fire({
                title: 'Uploading File...',
                type: 'warning',
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
                            $('#progress').width(parseInt(percentComplete)+'%');
                            $('#progress_label').text('Progress: '+parseInt(percentComplete)+'%');
                        }
                    }, false);
                    return xhr;
                },
                url: "<?php echo base_url() ?>book/update_audiobook",
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success:function(data) {
                    console.log(data);
                    $('#modal_edit_audiobook').modal('hide');
                    if (data == 1) {
                        Swal.fire("Audiobook Updated Successfully", "", "success").then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("This Module is Under Maintenance!", "", "warning").then((result) => {
                            location.reload();
                        });
                    }
                },
                error: function() {
                    Swal.fire("Oops... Something Went Wrong!", "", "error").then((result) => {
                        location.reload();
                    });
                }
            });
		}
	});
});

$('.loading').addClass('d-none');

</script>
