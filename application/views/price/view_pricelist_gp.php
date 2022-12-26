
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-4">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Pricing</li>
                    <li class="breadcrumb-item active">GP Boimela</li>
                </ol>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="row">
                    <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-nav-bdt" data-toggle="tab" href="#nav-bdt" role="tab" aria-controls="nav-bdt" aria-selected="true"><span style="color : #3a3a3a"><i class="fas fa-info"></i> BDT</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-nav-usd" data-toggle="tab" href="#nav-usd" role="tab" aria-controls="nav-usd"><span style="color : #3a3a3a"><i class="fas fa-dollar-sign"></i> USD</span></a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="tab-content" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-bdt" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
									<p class="invisible collapsing m-0 p-0">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal_add_price_bdt"><i class="fas fa-plus mr-1"></i>Add Price</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <table id="table_bdt" class="table"  width="100%"></table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-usd" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
									<p class="invisible collapsing m-0 p-0">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal_add_price_usd"><i class="fas fa-plus mr-1"></i>Add Price</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <table id="table_usd" class="table"  width="100%"></table>
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

<div class="modal fade" id="modal_add_price_bdt">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Add Price BDT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_add_price_bdt" method="post">
                <div class="modal-body">
                    <div class="row justify-content-center mt-2">
                        <div class="col-12">
                            <label for="">bookprice</label>
                            <input required type="text" class="form-control" name="bookprice" pattern="^[0-9]{1,4}(.[0-9]{2})?$" id="txt_add_bookprice_bdt">
                            <label for="">price_bn</label>
                            <input required type="text" class="form-control" name="price_bn" pattern="^[০-৯]{1,4}(.[০-৯]{2})?$" id="txt_add_price_bn_bdt">
                            <label for="">bookprice_en</label>
                            <input required type="text" class="form-control" name="bookprice_en" pattern="^৳[0-9]{1,4}(.[0-9]{2})?$" id="txt_add_bookprice_en_bdt">
                            <label for="">bookprice_bn</label>
                            <input required type="text" class="form-control" name="bookprice_bn" pattern="^৳[০-৯]{1,4}(.[০-৯]{2})?$" id="txt_add_bookprice_bn_bdt" value="৳">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_add_price_usd">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Add Price USD</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_add_price_usd" method="post">
                <div class="modal-body">
                    <div class="row justify-content-center mt-2">
                        <div class="col-12">
                            <label for="">Tier</label>
                            <input required type="text" class="form-control" name="tier" pattern="^Tier [0-9]{1,2}$" id="txt_add_tier_usd">
                            <label for="">Tier Value</label>
                            <input required type="text" class="form-control" name="tiervalue" pattern="^[0-9]{1,2}$" id="txt_add_tiervalue_usd">
                            <label for="">Price</label>
                            <input required type="text" class="form-control" name="price" pattern="^[0-9]{1,4}.[0-9]{2}$" id="txt_add_price_usd">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_edit_price_bdt">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Edit Price BDT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_edit_price_bdt" method="post">
                <div class="modal-body">
                    <div class="row justify-content-center mt-2">
                        <div class="col-12">
                            <input required type="hidden" name="pkid" id="txt_edit_pkid_bdt">
                            <label for="">bookprice</label>
                            <input required type="text" class="form-control" name="bookprice" pattern="^[0-9]{1,4}(.[0-9]{2})?$" id="txt_edit_bookprice_bdt">
                            <label for="">price_bn</label>
                            <input required type="text" class="form-control" name="price_bn" pattern="^[০-৯]{1,4}(.[০-৯]{2})?$" id="txt_edit_price_bn_bdt">
                            <label for="">bookprice_en</label>
                            <input required type="text" class="form-control" name="bookprice_en" pattern="^৳[0-9]{1,4}(.[0-9]{2})?$" id="txt_edit_bookprice_en_bdt">
                            <label for="">bookprice_bn</label>
                            <input required type="text" class="form-control" name="bookprice_bn" pattern="^৳[০-৯]{1,4}(.[০-৯]{2})?$" id="txt_edit_bookprice_bn_bdt">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_edit_price_usd">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Edit Price USD</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_edit_price_usd" method="post">
                <div class="modal-body">
                    <div class="row justify-content-center mt-2">
                        <div class="col-12">
                            <input required type="hidden" name="pkid" id="txt_edit_pkid_usd">
                            <label for="">Tier</label>
                            <input required type="text" class="form-control" name="tier" pattern="^Tier [0-9]{1,2}$" id="txt_edit_tier_usd">
                            <label for="">Tier Value</label>
                            <input required type="text" class="form-control" name="tiervalue" pattern="^[0-9]{1,2}$" id="txt_edit_tiervalue_usd">
                            <label for="">Price</label>
                            <input required type="text" class="form-control" name="price" pattern="^[0-9]{1,4}.[0-9]{2}$" id="txt_edit_price_usd">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

$('#navlink_pricing').addClass('menu-open');
$('#navlink_pricing_gp').addClass('active');
$('.loading').addClass('d-none');

var sl = 0;
var pricelist_bdt = <?php echo json_encode($prices['bdt']) ?>;
$('#table_bdt').DataTable({
    searching: false,
    paging: false,
    bInfo: false,
    data: pricelist_bdt,
    rowId: 'bookcover_small',
    columns: [
        {
            "title": "SL",
            "data": "bookcode",
            render: function (data, type, service) {
                return ++sl;
            }
        },
        {
            "title": "bookprice",
            "data": "bookprice"
        },
        {
            "title": "price_bn",
            "data": "price_bn"
        },
        {
            "title": "bookprice_bn",
            "data": "bookprice_bn"
        },
        {
            "title": "bookprice_en",
            "data": "bookprice_en"
        },
        {
            "title": "Edit",
            "data": "id",
            render: function (data, type, service) {
                var button = '<button type="button" class="btn btn-xs btn_edit_bdt" id="'+data+'" data-toggle="modal" data-target="#modal_edit_price_bdt"><i class="fas fa-edit"></i></button>';
                return button;
            }
        },
    ]
});

var sl = 0;
var pricelist_usd = <?php echo json_encode($prices['usd']) ?>;
$('#table_usd').DataTable({
    searching: false,
    paging: false,
    bInfo: false,
    data: pricelist_usd,
    rowId: 'bookcover_small',
    columns: [
        {
            "title": "SL",
            "data": "bookcode",
            render: function (data, type, service) {
                return ++sl;
            }
        },
        {
            "title": "Tier",
            "data": "tier"
        },
        {
            "title": "Tiervalue",
            "data": "tiervalue"
        },
        {
            "title": "Price",
            "data": "price"
        },
        {
            "title": "Edit",
            "data": "id",
            render: function (data, type, service) {
                var button = '<button type="button" class="btn btn-xs btn_edit_usd" id="'+data+'" data-toggle="modal" data-target="#modal_edit_price_usd"><i class="fas fa-edit"></i></button>';
                return button;
            }
        },
    ]
});

$('.btn_edit_bdt').click(function(e) {
    let price_id = this.id;
    let this_price = pricelist_bdt.find(function(price) {
        return price.id == price_id;
    });
    $('#txt_edit_pkid_bdt').val(this_price.id);
    $('#txt_edit_bookprice_bdt').val(this_price.bookprice);
    $('#txt_edit_price_bn_bdt').val(this_price.price_bn);
    $('#txt_edit_bookprice_en_bdt').val(this_price.bookprice_en);
    $('#txt_edit_bookprice_bn_bdt').val(this_price.bookprice_bn);
})

$('#frm_edit_price_bdt').submit(function(evnt) {
    evnt.preventDefault();
    var form_data = new FormData($('#'+evnt.target.id)[0]);
    Swal.fire({
        title: 'Do you want to save?',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "<?= base_url('price/edit_pricing_gp_bdt') ?>",
                type: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success: function(data){
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Saved Successfully", "", "success").then((result) => {
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

$('.btn_edit_usd').click(function(e) {
    let price_id = this.id;
    let this_price = pricelist_usd.find(function(price) {
        return price.id == price_id;
    });
    $('#txt_edit_pkid_usd').val(this_price.id);
    $('#txt_edit_tier_usd').val(this_price.tier);
    $('#txt_edit_tiervalue_usd').val(this_price.tiervalue);
    $('#txt_edit_price_usd').val(this_price.price);
})

$('#frm_edit_price_usd').submit(function(evnt) {
    evnt.preventDefault();
    var form_data = new FormData($('#'+evnt.target.id)[0]);
    Swal.fire({
        title: 'Do you want to save?',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "<?= base_url('price/edit_pricing_gp_usd') ?>",
                type: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success: function(data){
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Saved Successfully", "", "success").then((result) => {
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

$('#frm_add_price_bdt').submit(function(evnt) {
    evnt.preventDefault();
    var form_data = new FormData($('#'+evnt.target.id)[0]);
    Swal.fire({
        title: 'Do you want to Add New Price?',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "<?= base_url('price/add_pricing_gp_bdt') ?>",
                type: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success: function(data){
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Price Added Successfully", "", "success").then((result) => {
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

$('#frm_add_price_usd').submit(function(evnt) {
    evnt.preventDefault();
    var form_data = new FormData($('#'+evnt.target.id)[0]);
    Swal.fire({
        title: 'Do you want to Add New Price?',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "<?= base_url('price/add_pricing_gp_usd') ?>",
                type: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success: function(data){
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Price Added Successfully", "", "success").then((result) => {
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

</script>
