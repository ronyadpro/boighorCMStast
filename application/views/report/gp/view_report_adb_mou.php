
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Report</li>
                    <li class="breadcrumb-item active">GP Boimela</li>
                    <li class="breadcrumb-item active">Audiobook - Minutes of Usage</li>
                </ol>
            </div>
        </div>

        <form method="post" id="form_xyz">
            <div class="row mb-2">
                <?php
                    $begin = new DateTime( "2021-04-01" );
                    $end   = new DateTime( date('Y-m-d') );
                ?>
                <div class="col-sm-2">
                    <label>Year - Month</label>
                    <select required class="form-control form-control-sm" id="text_year_month">
                        <?php for ($i = $end; $i >= $begin; $i->modify('-1 month')) { ?>
                            <option value="<?=$i->format("Y-m")?>"><?=$i->format("Y-F")?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label>Publisher</label>
                    <select class="form-control form-control-sm" id="text_publisher">
                        <option value="">All</option>
                        <?php foreach ($publishers as $key => $publisher): ?>
                            <option value="<?= $publisher['publishercode'] ?>"><?= $publisher['publishername_bn'] ?></option>
                        <?php endforeach; ?>
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
            </div>
        </form>

        <div class="row">
            <div class="col-sm-12">
                <div id="div_report_summary">

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <!-- <div class="card">
                    <div class="card-body"> -->
                        <table id="tbl_report" class="table table-sm" width="100%"></table>
                    <!-- </div>
                </div> -->
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">

$('#navlink_report_gp').addClass('menu-open');
$('#navlink_report_adb_mou_gp').addClass('active');
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
    var totalmou=0;
    var totalhit=0;

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
            url: "<?= base_url('report/gp/adb/get_mou_report'); ?>",
            type: 'POST',
            data: {
                'date_from' : $('#text_year_month').val()+'-01',
                'date_to' : $('#text_year_month').val()+'-31',
                'publishercode' : $('#text_publisher').val(),
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
                "data": "msisdn",
                render: function (data, type, row) {
                    return ++sl;
                }
            },
            {
                "title": "Book",
                "data": "bookname",
                render: function (data, type, row) {
                    return row['bookname']+' - '+row['writer'];
                }
            },
            {
                "title": "Audiobook",
                "data": "title",
            },
            // {
            //     "title": "Writer",
            //     "data": "writer",
            // },
            // {
            //     "title": "bookcode",
            //     "data": "bookcode",
            // },
            // {
            //     "title": "adbid",
            //     "data": "adbid",
            // },
            {
                "title": "Hit Count",
                "data": "hitcount",
                render: function (data, type, row) {
                    totalhit += parseInt(data);
                    return data;
                }
            },
            // {
            //     "title": "SOU",
            //     "data": "total_usage_in_seconds",
            // },
            {
                "title": "Total Minutes of Use",
                "data": "total_usage_in_seconds",
                render: function (data, type, row) {
                    data = Math.ceil(parseInt(data)/60);
                    totalmou += data;
                    return data;
                }
            },
        ],
        "createdRow": function( row, data, dataIndex){
        },
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iMax, sPre ) {
            return 'Total Hit Count: <b>'+totalhit+'</b><br>Total Minutes of Use: <b>'+totalmou+'</b>';
        },
    });
}

</script>
