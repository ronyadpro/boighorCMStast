
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Report</li>
                    <li class="breadcrumb-item active">GpBoimela</li>
                </ol>
            </div>
        </div>

        <form method="post" id="form_xyz">
            <div class="row justify-content-center mb-2">
                <div class="col-sm-2">
                    <label>Date from</label>
                    <input type="date" class="form-control form-control-sm" value="<?=date('Y-m-d')?>" id="text_date_from">
                </div>
                <div class="col-sm-2">
                    <label>Date to</label>
                    <input type="date" class="form-control form-control-sm" value="<?=date('Y-m-d')?>" id="text_date_to">
                </div>
                <!-- <div class="col-sm-2">
                    <label>Author</label>
                    <select class="form-control form-control-sm select2" id="ddl_content_owner">
                        <option value="">All Authors</option>
                        <?php foreach ($authorlist as $key => $author): ?>
                            <option value="<?=$author['authorcode'] ?>"><?=$author['author'].' • '.$author['author_bn'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div> -->
                <!-- <div class="col-sm-2">
                    <label>Publishers</label>
                    <select class="form-control form-control-sm select2" id="ddl_publisher">
                        <option value="">All Publishers</option>
                        <?php foreach ($publisherlist as $key => $publisher): ?>
                            <option value="<?=$publisher['publishercode'] ?>"><?=$publisher['publishername_en'].' • '.$publisher['publishername_bn'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div> -->
                <div class="col-sm-2">
                    <label>Report Type</label>
                    <select class="form-control form-control-sm" id="ddl_reporttype">
                        <option value="subscription" selected>Subscription</option>
                        <option value="bookpurchase">Book Purchase</option>

                    </select>
                </div>

                <div class="col-sm-2 mt-4">
                    <button id="btn_report" type="submit" class="btn btn-primary btn-block">
                        <b id="btn_report_text">
                            <i class="fas fa-arrow-down mr-2"></i>
                            <span id="btn_loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none"></span>
                            <span id="btn_text">Report</span>
                            <i class="fas fa-arrow-down ml-2"></i>
                        </b>
                    </button>
                </div>

                <!-- <div class="col-sm-2">
                    <label>Campaign</label>
                    <select class="form-control form-control-sm" id="ddl_campaign">
                        <option value="">N/A</option>
                        <?php foreach ($promocodes as $key => $promo): ?>
                            <option value="<?= $promo['promocode'] ?>"><?= $promo['promotitle'].'('.$promo['promocode'].')' ?></option>
                        <?php endforeach; ?>
                    </select>
                </div> -->
                <!-- <div class="col-sm-9 mt-4">
                    <button id="btn_report" type="submit" class="btn btn-primary btn-block">
                        <b id="btn_report_text">
                            <i class="fas fa-arrow-down mr-2"></i>
                            <span id="btn_loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none"></span>
                            <span id="btn_text">Report</span>
                            <i class="fas fa-arrow-down ml-2"></i>
                        </b>
                    </button>
                </div> -->
            </div>
        </form>

        <div class="row">
            <div class="col-sm-12">
                <table id="tbl_report" class="table table-sm" width="100%"></table>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">

$('#navlink_gpreport').addClass('menu-open');
$('#navlink_report_gpsales').addClass('active');
$('.loading').addClass('d-none');

var table;
var dataset;

$(document).ready(function (){
    if (location.hash) {
    	let url = location.href.replace(/\/$/, "");
    	const hash = url.split("#")[url.split("#").length-1];
        if (hash.toLowerCase()=="today") {
        } else {
            $('#text_date_from').val('<?= date('Y-m-01') ?>')
        }
        populate_report()
    }
});


$('#form_xyz').submit(function(evnt) {
    evnt.preventDefault()
    populate_report()
})

function populate_report() {

    $('#btn_text').html('Loading Data...');
    $('#btn_loader').show()
    $('#btn_report').attr('disabled', true);

    var sl=0;
    var totalprice=0;

    if (table) {
        table.destroy();
    }
    table = $('#tbl_report').DataTable( {
        dom: "<'row'<'col-md-6'l><'col-md-6'f>>" + "<'row'<'col-md-6'><'col-md-6'>>" + "<'row'<'col-md-6'B><'col-md-6 text-right'i>><'row'<'col-md-12't>>r",
		buttons: [
			'copy', 'csv', 'excel', 'print'
		],
        processing: true,
        serverSide: true,
        stateSave : false,
        ordering : true,
        hilighting: false,
        responsive: false,
        searching: false,
        pagingType: 'full_numbers',
        paging: false,
        language: {
            processing: '<i class="fa fa-sync fa-spin text-primary" style="font-size:36px"></i>'
        },
        ajax: {
            url: "<?= base_url('gp-report/gpboimela/get_subscription_report'); ?>",
            type: 'POST',
            data: {

                'date_from' : $('#text_date_from').val(),
                'date_to' : $('#text_date_to').val(),
                'reporttype' : $('#ddl_reporttype').val(),
            },
            dataFilter: function(data){

                $('#btn_text').html('Report');
                $('#btn_loader').hide()
                $('#btn_report').attr('disabled', false);

                sl = jQuery.parseJSON(data)['start'];
                dataset = jQuery.parseJSON(data)['data'];
                // var json = jQuery.parseJSON(data)['json'];
                // console.log(json);
                return data;
            },
            error: function(err){
                console.log(err);
            }
        },
        rowId: 'pkid',
        order: [ 0, "desc" ],
        columns: [
            {
                "title": "SL",
                "data": "pkid",
                render: function (data, type, service) {
                    return ++sl;
                }
            },
            {
                "title": "OrderID",
                "data": "orderid",
            },
            {
                "title": "UserID",
                "data": "userid",
                render: function (data, type, service) {
                    return '<a href="https://remote.ebsbd.com/admin/live/user/overview/'+data+'" target="_blank">'+data+'</a>';
                }
            },
            {
                "title": "Order Type",
                "data": "ordertype",
            },
            {
                "title": "Book",
                "data": "bookname_bn",
            },
            {
                "title": "Writer",
                "data": "writername",
            },
            // {
            //     "title": "Campaign",
            //     "data": "campaignname",
            // },
            {
                "title": "Promo",
                "data": "promocode",
            },
            {
                "title": "Regular Price",
                "data": "bookprice",
                render: function (data, type, service) {
                    return data>=10 ? '৳'+data : '$'+data;
                }
            },
            {
                "title": "Selling Price",
                "data": "sellingprice",
                render: function (data, type, service) {
                    switch (data) {
                        case '0.99':
                            data = '80.00';
                            break;
                        case '1.49':
                            data = '120.00';
                            break;
                        case '1.99':
                            data = '150.00';
                            break;
                        case '2.49':
                            data = '220.00';
                            break;
                        case '2.99':
                            data = '250.00';
                            break;
                        case '3.49':
                            data = '300.00';
                            break;
                        case '3.99':
                            data = '350.00';
                            break;
                        case '4.49':
                            data = '390.00';
                            break;
                        case '4.99':
                            data = '420.00';
                            break;
                        case '5.49':
                            data = '450.00';
                            break;
                        case '5.99':
                            data = '500.00';
                            break;
                        default:
                            break;
                    }
                    totalprice+=parseFloat(data);
                    return '৳'+data;
                }
            },
            {
                "title": "PaymentType",
                "data": "paymenttype",
                render: function (paymenttype, type, row) {
                    switch (paymenttype) {
                        case 'bkash':
                            paymenttype  = 'bKash';
                            break;
                        case 'giap':
                            paymenttype  = 'gPay';
                            break;
                        case 'stripe':
                            paymenttype  = 'Stripe';
                            break;
                        case 'card':
                            paymenttype  = 'Card';
                            break;
                        case 'aiap':
                            paymenttype  = 'Apple-IAP';
                            break;
                        case 'portwallet':
                            switch (row['paynetwork']) {
                                case 'bkashcheckout':
                                    paymenttype = 'portpos/bkash';
                                    break;
                                default:
                                    paymenttype = 'portpos/'+row['paynetwork'];
                                    break;
                            }
                        default:
                            break;
                    }
                    return paymenttype;
                }
            },
            {
                "title": "Country",
                "data": "countryname",
            },
            {
                "title": "Order Time",
                "data": "timeofentry",
            },
        ],
        "createdRow": function( row, data, dataIndex){
        },
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iMax, sPre ) {
            return '<b>Total Sell: ৳'+totalprice.toFixed(2)+'</b>';
        },
    });
}

</script>
