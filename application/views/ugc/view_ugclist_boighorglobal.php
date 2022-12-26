
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                    <li class="breadcrumb-item active">Boighor Global</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table id="tbl_ugclist" class="table table-sm text-left" width="100%"></table>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">

$('#navlink_ugc').addClass('menu-open');
$('#navlink_ugc_boighorglobal').addClass('active');
$('.loading').addClass('d-none');

var sl=0;
var table = $('#tbl_ugclist').DataTable( {
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
        url: "<?= base_url('ugc/get_ugclist_global'); ?>",
        type: 'POST',
        dataFilter: function(data){
            // console.log(jQuery.parseJSON(data));
            sl = jQuery.parseJSON(data)['start'];
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
            "data": "datetime",
            render: function (data, type, row) {
                return ++sl;
            }
        },
        {
            "title": "Submitted",
            "data": "datetime",
        },
        {
            "title": "Name",
            "data": "username",
        },
        {
            "title": "Mobile",
            "data": "mobileno",
        },
        {
            "title": "Email",
            "data": "email",
        },
        {
            "title": "Title",
            "data": "title",
        },
		{
			"title": "Approved",
			"data": "isapproved",
			"width": "1px",
			render: function (data, type, row) {
				if (data==1) {
					return '<i class="fas fa-check text-green"></i>';
				} else {
					return '<i class="fas fa-times text-danger"></i>';
				}
			}
		},
        {
            "title": "View",
            "data": "ugcid",
            render: function (data, type, row) {
                var button = '<a href="<?= base_url('ugc/overview') ?>/'+row['ugcid']+'"><button class="btn btn-xs btn-primary btn_view" id="'+row['ugcid']+'"><i class="fas fa-eye mr-1"></i>View</button></a>';
                return button;
            }
        },
    ],
    fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
        return sPre;
    },
});

</script>
