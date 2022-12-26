
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Report</li>
                    <li class="breadcrumb-item active">Orders</li>
                </ol>
            </div>
            <div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-prepend">
                        <button type="button" class="btn btn-sm btn-outline-secondary bg-white" id="date_prev"><i class="fas fa-angle-double-left fa-lg mr-2"></i><b>Previous</b></button>
                    </span>
                    <input type="date" class="form-control form-control-sm btn-outline-secondary bg-white" id="txt_date" value="<?= $this->session->dailyservicedate ?: date('Y-m-d') ?>">
                    <span class="input-group-append">
                        <button type="button" class="btn btn-sm btn-outline-secondary bg-white" id="date_next"><b>Next</b><i class="fas fa-angle-double-right fa-lg ml-2"></i></button>
                    </span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table id="tbl_report" class="table table-sm" width="100%"></table>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">

$('#navlink_report').addClass('menu-open');
$('#navlink_report_orders').addClass('active');
$('.loading').addClass('d-none');

var table;
var dataset;


$('#form_xyz').submit(function(evnt) {
    evnt.preventDefault()
    populate_report()
})

populate_report();

function populate_report() {

    // $('#btn_text').html('Loading Data...');
    // $('#btn_loader').show()
    // $('#btn_report').attr('disabled', true);

    var sl=0;
    var totalprice=0;

    if (table) {
        table.destroy();
    }
    table = $('#tbl_report').DataTable( {
        dom: "<'row'<'col-6'l><'col-6 text-right'p>><'row'<'col-12't><'col-12'i>>r",
        processing: true,
        serverSide: true,
        stateSave : true,
        ordering : true,
        hilighting: false,
        responsive: true,
        searching: false,
        language: {
            search: "Search:",
            processing: '<i class="fa fa-sync fa-spin text-info" style="font-size:36px"></i>'
        },
        paging: true,
        pagingType: 'full_numbers',
        lengthMenu: [[15, 20, 25, 50, 100, 200, 500], [15, 20, 25, 50, 100, 200, 500]],
        ajax: {
            url: "<?= base_url('report/boighor/orders/get_order_logs'); ?>",
            type: 'POST',
            data: {
                date: function() { return $('#txt_date').val() },
            },
            dataFilter: function(data){

                // $('#btn_text').html('Report');
                // $('#btn_loader').hide()
                // $('#btn_report').attr('disabled', false);

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
        order: [ 1, "desc" ],
        columns: [
            {
                "title": "SL",
                "data": "pkid",
                render: function (data, type, service) {
                    return ++sl;
                }
            },
            {
                "title": "Time",
                "data": "created",
            },
            {
                "title": "OrderID",
                "data": "orderid",
            },
            {
                "title": "User",
                "data": "userid",
                render: function (userid, type, order) {
                    return '<a href="<?= base_url() ?>user/overview/'+userid+'" target="_blank">'+(order['name']==''?userid:order['name'])+'</a>';
                }
            },
            {
                "title": "Type",
                "data": "ordertype",
            },
            {
                "title": "Status",
                "data": "orderstatus",
                render: function (status, type, order) {
                    if (status=='delivered') {
                        return '<b class="text-success">'+status+'</b>';
                    } else {
                        return '<b class="text-danger">'+status+'</b>';
                    }
                }
            },
            {
                "title": "Book",
                "data": "bookname",
                render: function (bookname, type, order) {
                    return '<a href="<?= base_url() ?>book/overview/'+order['bookcode']+'" target="_blank">'+bookname+'</a>';
                }
            },
            {
                "title": "Writer",
                "data": "writername",
                render: function (writername, type, order) {
                    return '<a href="<?= base_url() ?>author/overview/'+order['writercode']+'" target="_blank">'+writername+'</a>';
                }
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
                            paymenttype = 'PortPos';
                            break;
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
        ],
        "createdRow": function( row, data, dataIndex){
        },
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iMax, sPre ) {
            return sPre;
        },
    });
    $('#txt_date').change(function(evnt) {
    	table.ajax.reload();
    })
}


$(function() {
	$( "#txt_date" ).datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
	});
});
$('#date_prev').click(function() {
	var xdate = new Date($('#txt_date').val());
	xdate.setDate(xdate.getDate() - 1);
	$('#txt_date').val($.datepicker.formatDate('yy-mm-dd', xdate)).trigger('change');
})
$('#date_next').click(function() {
	var xdate = new Date($('#txt_date').val());
	xdate.setDate(xdate.getDate() + 1);
	$('#txt_date').val($.datepicker.formatDate('yy-mm-dd', xdate)).trigger('change');
})



</script>
