
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Refund</li>
                    <li class="breadcrumb-item active">Boighor Global</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table id="tbl_refund" class="table table-sm" width="100%"></table>
            </div>
        </div>
    </div>
</div>

<?php //$this->load->view('feedback/view_modal_feedback_edit') ?>

<script type="text/javascript">

$('#navlink_refund').addClass('menu-open');
$('#navlink_refund_boighorglobal').addClass('active');
$('.loading').addClass('d-none');

var table;

function populate_report() {

    var sl=0;
    var totalprice=0;
    var current_dataset;

    if (table) {
        table.destroy();
    }
    table = $('#tbl_refund').DataTable( {
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
        pageLength : 50,
        language: {
            processing: '<i class="fa fa-sync fa-spin text-primary" style="font-size:36px"></i>'
        },
        ajax: {
            url: "<?= base_url('refund/boighorglobal/get_refund_serverside'); ?>",
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
                "title": "Feedback",
                "data": "remarks",
            },
            {
                "title": "Staus",
                "data": "status",
                render: function (status, type, row) {
                    var color = '';
                    switch (status) {
                        case 'Unreviewed':
                            color = 'danger';
                            break;
                        case 'Reviewed':
                            color = 'secondary';
                            break;
                        case 'Resolved':
                            color = 'success';
                            break;
                        default:
                            color = 'primary';
                    }
                    var tag = '<button id="'+row.pk_id+'" title="'+status+'" class="btn btn-xs btn-'+color+' btn_status"><b>'+status+'</b></button>';
                    return tag;
                }
            },
            {
                "title": "Updated by",
                "data": "status_updated_by",
            },
            {
                "title": "Time",
                "data": "status_updated_datetime",
                render: function (data, type, service) {
                    return data=='0000-00-00 00:00:00'?'':data;
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
            $('.btn_status').click(function(evnt) {
                status_click_btn_action(this);
            });
            return sPre;
        },
    });
}

populate_report()

function status_click_btn_action(evnt) {
    Swal.fire({
        title: 'Select Status',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Save',
        input: 'select',
        inputOptions: {
            "Unreviewed":"Unreviewed","Reviewed":"Reviewed","Resolved":"Resolved",
        },
        inputValue: evnt.title,
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "<?=base_url('refund/boighorglobal/update_refund_request_status')?>",
                method: "POST",
                data: {
                    pk_id: evnt.id,
                    status: result.value,
                },
                beforeSend: function() {
                    pleaseWait();
                },
                success: function(data) {
                    console.log(data);
                    data = JSON.parse(data);
                    console.log(data);
                    if (data==403) {
                        accessDenied();
                    } else if (data==440) {
                        sessionExpired();
                    } else if (data==1) {
                        Swal.fire({
                            title: "Done",
                            type: "success",
                            showConfirmButton: false,
                            timer: 500
                        }).then((resp) => {
                            table.ajax.reload();
                        });
                    } else {
                        somethingWentWrong();
                    }
                },
                error: function() {
                    somethingWentWrong();
                },
            });
        }
    });
}

</script>
