
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Campaign Report</li>
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
                <div class="col-sm-9 mt-4">
                    <button id="btn_report" type="submit" class="btn btn-primary btn-block">
                        <b id="btn_report_text">
                            <i class="fas fa-arrow-down mr-2"></i>
                            <span id="btn_loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none"></span>
                            <span id="btn_text">Report</span>
                            <i class="fas fa-arrow-down ml-2"></i>
                        </b>
                    </button>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-sm-12">
                <table id="tbl_report" class="table table-sm table-hover" width="100%"></table>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">

$('#navlink_report').addClass('menu-open');
$('#navlink_report_campaign').addClass('active');
$('.loading').addClass('d-none');

var table;
var dataset;

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
            url: "<?= base_url('campaign/get_campaign_report'); ?>",
            type: 'POST',
            data: {
                'date_from' : $('#text_date_from').val(),
                'date_to' : $('#text_date_to').val(),
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
        rowId: 'id',
        order: [ 3, "desc" ],
        columns: [
            {
                "title": "SL",
                "data": "sl",
                render: function (data, type, row) {
                    sl=data;
                    return sl;
                }
            },
            {
                "title": "User",
                "data": "fullname",
                render: function (data, type, row) {
                    return '<a href="https://remote.ebsbd.com/admin/live/user/overview/'+(row['userid'])+'" target="_blank">'+((row['fullname']=='') ? row['userid'] : row['fullname'])+'</a>';
                }
            },
            {
                "title": "Order Count",
                "data": "count",
            },
            {
                "title": "Total Amount",
                "data": "charged",
            },
        ],
        "createdRow": function( row, data, dataIndex){
        },
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iMax, sPre ) {
            return '<b>Total Users: '+Math.ceil(sl)+'</b>';
        },
    });
}

</script>
