<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Coupon</li>
                </ol>
            </div>
            <div class="col-6">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_quote_create" class="btn btn-sm btn-outline-primary float-right btn_quote_create" id="'+data+'"><i class="fas fa-plus mr-1"></i><b>Add New Coupon</b></a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table id="tbl_quote" class="table table-sm text-left" width="100%"></table>
            </div>
        </div>

    </div>
</div>

<?php $this->load->view('coupon/view_modal_coupon_create'); ?>
<?php // $this->load->view('coupon/view_modal_coupon_edit'); ?>

<script type="text/javascript">

$('#navlink_quote').addClass('menu-open');
$('#navlink_quote').addClass('active');
$('.loading').addClass('d-none');

var sl=0;
var currentDataSet;
var table = $('#tbl_quote').DataTable( {
    processing: true,
    serverSide: true,
    stateSave : true,
    ordering : true,
    hilighting: false,
    responsive: false,
    searching: true,
    pagingType: 'full_numbers',
    paging: true,
    pageLength : 25,
    ajax: {
        url: "<?= base_url('coupon/get_coupons'); ?>",
        type: 'POST',
        dataFilter: function(data){
             console.log(jQuery.parseJSON(data));
            currentDataSet = jQuery.parseJSON(data)['data'];
            sl = jQuery.parseJSON(data)['start'];
            return data;
        },
        error: function(err){
            console.log(err);
        }
    },
    rowId: 'pkid',
    order: [ 0, "asc" ],
    columns: [
        {
            "title": "SL",
            "data": "pkid",
            render: function (data, type, service) {
                return ++sl;
            }
        },
        // {
        //     "title": "Promotion Type",
        //     "data": "promo_type",
        // },
        {
            "title": "Title",
            "data": "promotitle",
        },
        {
            "title": "Coupon Code",
            "data": "promocode",
        },
        {
            "title": "Discount",
            "data": "discount",
        },
        // {
        //     "title": "Discount Amount",
        //     "data": "discount_amount",
        // },
        // {
        //     "title": "Discount Percent",
        //     "data": "discount_percent",
        // },
        // {
        //     "title": "Cart. Min CAP",
        //     "data": "total_amount_min",
        // },
        {
            "title": "Book Limit",
            "data": "booklimit",
        },
        // {
        //     "title": "Usage Limit",
        //     "data": "usage_limit",
        // },
        // {
        //     "title": "Start Date",
        //     "data": "start_date",
        // },
        // {
        //     "title": "Expire Date",
        //     "data": "expire_date",
        // },

        {
            "title": "Status",
            "data": "status",
            render: function (data, type, row) {
                var id = "status_" + row['pkid'];
                return '<div class="form-group"><div class="custom-control mt-2 custom-switch"><input type="checkbox" '+(data == '1' ? 'checked' : '')+' class="custom-control-input" id="'+id+'"><label class="custom-control-label" for="'+id+'"></label></div></div>';
            }
        },
        {
            "title": "Action",
            "data": "pkid",
            render: function (data, type, row) {

                //var button = '<button  class="btn btn-xs btn-outline-danger btn_quote_edit" type="button"><i class="fas fa-trash text-danger mr-1"></i>Delete</button>';
                var button = '<a href="javascript:void(0)" data-toggle="modal"  class="btn btn-xs btn-outline-danger btn_delete" id="'+data+'"><i class="fas fa-trash mr-1"></i>Delete</a>';
                return button;
            }
        },
    ],
    fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
        $('.btn_quote_edit').click(function(evnt) {
            console.log(this.id.split('_').reverse()[0]);
            //populate_modal_coupon_edit(this.id.split('_').reverse()[0]);
        });
        $('.btn_delete').click(function(evnt) {
            //console.log(this.id.split('_').reverse()[0]);
            delete_click_btn_action(this.id.split('_').reverse()[0]);
        });
        //
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch();
        });
        $('.custom-control-input').on('change', function() {
            changeCouponStatus(this.id.split('_').reverse()[0], (this.checked ? 1 : 0));
        });
        return sPre;
    },
});

function delete_click_btn_action(couponid)
{

    Swal.fire({
        title: 'Are You Sure?',
        text: 'You are about to delete this promotion',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {

            $.ajax({
                url: "<?= base_url() ?>coupon/delete_coupon_status",
                method: "POST",
                data: {
                    couponid : couponid
                },
                success:function(data) {
                    console.log(data);
                    if (data==1) {

                        Toast.fire({
                            type: (data == '1' ? 'success' : 'error'),
                            title: '&nbsp;&nbsp;Coupon is '+(data == '1' ? 'Deleted' : 'Not deleted')
                        });
                        location.reload();
                    } else if (data==403) {
                        Swal.fire("Access Denied", "You do not have permission to perform this action", "error").then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Oops", "Something Went Wrong!", "error").then((result) => {
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



}

function changeCouponStatus(couponid, status) {
    $.ajax({
        url: "<?= base_url() ?>coupon/change_coupon_status",
        method: "POST",
        data: {
            couponid : couponid,
            status: status
        },
        success:function(data) {
            console.log(data);
            if (data==1) {
                Toast.fire({
                    type: (status == '1' ? 'success' : 'error'),
                    title: '&nbsp;&nbsp;Coupon is '+(status == '1' ? 'Online' : 'Offline')
                });
            } else if (data==403) {
                Swal.fire("Access Denied", "You do not have permission to perform this action", "error").then((result) => {
                    location.reload();
                });
            } else {
                Swal.fire("Oops", "Something Went Wrong!", "error").then((result) => {
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

function populate_modal_coupon_edit(pkid) {
    var thisRow = currentDataSet.find(function(element) {
        return element['pkid'] == pkid;
    });
    $('#txt_quote_pkid').val(thisRow['pkid']);
    $('#txt_author_en_edit').val(thisRow['authorname_en']);
    $('#txt_author_bn_edit').val(thisRow['authorname_bn']);
    $('#txt_quote_edit').val(thisRow['quote']);
}
</script>
