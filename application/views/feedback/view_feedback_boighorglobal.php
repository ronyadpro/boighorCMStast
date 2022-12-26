
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Feedback</li>
                    <li class="breadcrumb-item active">Boighor Global</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table id="tbl_feedback" class="table table-sm" width="100%"></table>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('feedback/view_modal_feedback_edit') ?>

<script type="text/javascript">

$('#navlink_feedback').addClass('menu-open');
$('#navlink_feedback_boighorglobal').addClass('active');
$('.loading').addClass('d-none');

var table;

function populate_report() {

    var sl=0;
    var totalprice=0;
    var current_dataset;

    if (table) {
        table.destroy();
    }
    table = $('#tbl_feedback').DataTable( {
        // dom: "<'row'<'col-md-6'l><'col-md-6'f>>" + "<'row'<'col-md-6'><'col-md-6'>>" + "<'row'<'col-md-6'B><'col-md-6 text-right'i>><'row'<'col-md-12't>>r",
		// buttons: [
		// 	'copy', 'csv', 'excel', 'print'
		// ],
        processing: true,
        serverSide: true,
        stateSave : false,
        ordering : true,
        hilighting: false,
        responsive: false,
        searching: false,
        pagingType: 'full_numbers',
        paging: true,
        pageLength : 100,
        language: {
            processing: '<i class="fa fa-sync fa-spin text-primary" style="font-size:36px"></i>'
        },
        ajax: {
            url: "<?= base_url('feedback/boighorglobal/get_feedback_serverside'); ?>",
            type: 'POST',
            // data: {
            //     'writercode' : $('#ddl_content_owner').val(),
            //     'date_from' : $('#text_date_from').val(),
            //     'date_to' : $('#text_date_to').val(),
            //     'paymenttype' : $('#ddl_payment_type').val(),
            //     'promo' : $('#ddl_promo').val(),
            //     'campaign' : $('#ddl_campaign').val(),
            // },
            dataFilter: function(data){
                // console.log(jQuery.parseJSON(data));
                sl = jQuery.parseJSON(data)['start'];
                current_dataset = jQuery.parseJSON(data)['data'];
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
                "data": "pk_id",
                render: function (data, type, service) {
                    return ++sl;
                }
            },
            {
                "title": "Time",
                "data": "created",
            },
            {
                "title": "UserID",
                "data": "userid",
            },
            {
                "title": "Email",
                "data": "email",
            },
            {
                "title": "Mobile",
                "data": "mobileno",
            },
            {
                "title": "Type",
                "data": "type",
            },
            {
                "title": "Feedback",
                "data": "feedback",
            },
            {
                "title": "Staus",
                "data": "status",
                render: function (status, type, row) {
                    var color = '';
                    switch (status) {
                        case 'unreviewed':
                            color = 'badge-danger';
                            break;
                        case 'reviewed':
                            color = 'badge-secondary';
                            break;
                        case 'resolved':
                            color = 'badge-success';
                            break;
                        default:

                    }
                    var tag = '<span class="badge badge-lg '+color+'">'+status+'</span>';
                    return tag;
                }
            },
            {
                "title": "Reply",
                "data": "boighor_reply",
                render: function (data, type, service) {
                    return data ? data : 'N/A';
                }
            },
            {
                "title": "Viewed",
                "data": "viewed",
                render: function (data, type, service) {
                    var faicon = data==1 ? 'check text-success' : 'times text-danger';
                    return '<i class="fas fa-'+faicon+' fa-lg"></i>';
                }
            },
            {
                "title": "Approved By",
                "data": "status_marked_by",
            },
            {
                "title": "Source",
                "data": "fromsrc",
                render: function (data, type, row) {
                    return data+'('+(row['userid'].length==13 ? 'Telco' : (row['userid'].length==21 ? 'Google' : 'Facebook'))+') V:'+row['appversion'];
                }
            },
            {
                "title": "Edit",
                "data": "pk_id",
                render: function (data, type, row) {
                    var button = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modal_feedback_edit" class="btn btn-xs btn-primary btn_feedback_edit" id="'+data+'"><i class="fas fa-edit mr-1"></i>Reply</a>';
                    return button;
                }
            },
        ],
        "createdRow": function( row, data, dataIndex){
        },
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iMax, sPre ) {
            $('.btn_feedback_edit').click(function(event) {
                $('#txt_feedback_pkid').val(this.id);
                var this_feedback = current_dataset.find(feedback => {
                    return feedback.pk_id == this.id;
                })
                $('#boighor_reply').text(this_feedback.boighor_reply);
                $('#txt_feedback_status').val(this_feedback.status);
            })
            return sPre;
        },
    });
}

populate_report()

</script>
