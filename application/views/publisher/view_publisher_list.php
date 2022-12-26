
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Publishers</li>
                </ol>
            </div>
            <div class="col-sm-6">
                <button class="btn btn-outline-primary float-right" data-toggle='modal' data-target='#modal_add_publisher'> <i class="fas fa-plus mr-2"></i> <b>Add Publisher</b> </button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table id="tbl_publisherlist" class="table table-sm text-left" width="100%"></table>
            </div>
        </div>

    </div>
</div>

<?php $this->load->view('publisher/view_modal_publisher_booklist') ?>
<?php $this->load->view('publisher/view_modal_add_publisher') ?>

<script type="text/javascript">

$('#navlink_publisher').addClass('active');
$('.loading').addClass('d-none');

var sl=0;
var publishers = [];

var table = $('#tbl_publisherlist').DataTable( {
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
    language: {
        processing: '<i class="fa fa-sync fa-spin text-primary" style="font-size:36px"></i>'
    },
    ajax: {
        url: "<?= base_url('publisher/get_publishers'); ?>",
        type: 'POST',
        dataFilter: function(data){
            // console.log(jQuery.parseJSON(data));
            sl = jQuery.parseJSON(data)['start'];
            publishers = jQuery.parseJSON(data)['data'];
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
            "data": "publishercode",
            render: function (data, type, row) {
                return ++sl;
            }
        },
        {
            "title": "Code",
            "data": "publishercode",
        },
        {
            "title": "Name (EN)",
            "data": "publishername_en",
        },
        {
            "title": "Name (BN)",
            "data": "publishername_bn",
        },
        {
            "title": "Actions",
            "data": "publishercode",
            render: function (data, type, row) {
                //initDatatable function in modal file ->> publisher/view_modal_publisher_booklist.php
                var booksbutton = "<button data-toggle='modal' data-target='#modal_publisher_booklist' onclick=initDatatable('"+data+"') class='btn btn-xs btn-outline-primary mr-1'><i class='fas fa-book mr-1'></i></i>Books</button>";
                var viewbutton = "<a href='<?= base_url('publisher/overview') ?>/"+data+"' class='btn btn-xs btn-outline-primary mr-1'><i class='fas fa-edit mr-1'></i></i>View</a>";
                return booksbutton+viewbutton;
            }
        },
    ],
    fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
        return sPre;
    },
});

</script>
