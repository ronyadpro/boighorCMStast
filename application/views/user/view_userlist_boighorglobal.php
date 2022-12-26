
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
                <table id="tbl_userlist" class="table table-sm text-left" width="100%"></table>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">

$('#navlink_userlist').addClass('menu-open');
$('#navlink_userlist_boighorglobal').addClass('active');
$('.loading').addClass('d-none');

var sl=0;
var table = $('#tbl_userlist').DataTable( {
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
        url: "<?= base_url('user/get_userlist_global'); ?>",
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
            "data": "signupdate",
            render: function (data, type, service) {
                return ++sl;
            }
        },
        {
            "title": "SignedUp",
            "data": "signupdate",
        },
        {
            "title": "UserID",
            "data": "msisdn",
        },
        {
            "title": "Name",
            "data": "fullname",
        },
        {
            "title": "Email",
            "data": "email",
        },
        {
            "title": "SignUpFrom",
            "data": "signupfrom",
                render: function (data, type, service) {
                    return data=='ebs' ? 'campaign' : data;
                }
        },
        {
            "title": "Src",
            "data": "loginsrc",
        },
        // {
        //     "title": "Approved",
        //     "data": "approved",
        //     render: function (data, type, service) {
        //         var imageViewer = '';
        //         if (data==1) {
        //             imageViewer = '<button class="btn btn-xs btn-primary btn_edit_approval" id="'+service['pkid']+'" title="'+data+'">Change Status</button>';
        //         } else if (data==-1) {
        //             imageViewer = '<button class="btn btn-xs btn-primary btn_edit_approval" id="'+service['pkid']+'" title="'+data+'">Change Status</button>';
        //         } else {
        //             imageViewer = '<button class="btn btn-xs btn-primary btn_edit_approval" id="'+service['pkid']+'" title="'+data+'">Approve/Reject</button>';
        //         }
        //         return imageViewer;
        //     }
        // },
        {
            "title": "View",
            "data": "msisdn",
            render: function (data, type, service) {
                var button = '<a href="<?= base_url('user/overview') ?>/'+service['msisdn']+'"><button class="btn btn-xs btn-primary btn_view" id="'+service['msisdn']+'"><i class="fas fa-eye mr-1"></i>View</button></a>';
                return button;
            }
        },
    ],
    // "createdRow": function( row, data, dataIndex){
    //     if( data['approved'] == 1){
    //         $(row).addClass('bg-success');
    //         $(row).addClass('disabled');
    //     } else if( data['approved'] == -1) {
    //         $(row).addClass('bg-secondary');
    //         $(row).addClass('disabled');
    //     } else {
    //
    //     }
    // },
    fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
        $('.btn_edit_approval').click(function(evnt) {
            status_click_btn_action(this);
        });
        $('.btn_delete').click(function(evnt) {
            delete_click_btn_action(this);
        });
        return sPre;
    },
});

</script>
