<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Quotes</li>
                </ol>
            </div>
            <div class="col-6">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_quote_create" class="btn btn-sm btn-outline-primary float-right btn_quote_create" id="'+data+'"><i class="fas fa-plus mr-1"></i><b>Add New Quote</b></a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table id="tbl_quote" class="table table-sm text-left" width="100%"></table>
            </div>
        </div>

    </div>
</div>

<?php $this->load->view('quote/view_modal_quote_create'); ?>
<?php $this->load->view('quote/view_modal_quote_edit'); ?>

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
        url: "<?= base_url('quote/get_quotes'); ?>",
        type: 'POST',
        dataFilter: function(data){
            // console.log(jQuery.parseJSON(data));
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
        {
            "title": "Author",
            "data": "authorname_bn",
        },
        {
            "title": "Quote",
            "data": "quote",
        },
        {
            "title": "Created",
            "data": "created",
        },
        {
            "title": "Status",
            "data": "status",
            render: function (data, type, row) {
                var id = "status_"+row['pkid'];
                return '<div class="form-group"><div class="custom-control custom-switch"><input type="checkbox" '+(data == '1' ? 'checked' : '')+' class="custom-control-input" id="'+id+'"><label class="custom-control-label" for="'+id+'"></label></div></div>';
            }
        },
        {
            "title": "Edit",
            "data": "pkid",
            render: function (data, type, row) {
                var button = '<a href="javascript:void(0)" data-toggle="modal" data-target="#modal_quote_edit" class="btn btn-xs btn-outline-primary btn_quote_edit" id="'+data+'"><i class="fas fa-edit mr-1"></i>Edit</a>';
                return button;
            }
        },
    ],
    fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
        $('.btn_quote_edit').click(function(evnt) {
            populate_modal_quote_edit(this.id.split('_').reverse()[0]);
        });
        $('.btn_delete').click(function(evnt) {
            delete_click_btn_action(this);
        });
        //
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch();
        });
        $('.custom-control-input').on('change', function() {
            changeQuoteStatus(this.id.split('_').reverse()[0], (this.checked ? 1 : 0));
        });
        return sPre;
    },
});

function changeQuoteStatus(quoteid, status) {
    $.ajax({
        url: "<?= base_url() ?>quote/change_quote_status",
        method: "POST",
        data: {
            quoteid : quoteid,
            status: status
        },
        success:function(data) {
            console.log(data);
            if (data==1) {
                Toast.fire({
                    type: (status == '1' ? 'success' : 'error'),
                    title: '&nbsp;&nbsp;Quote is '+(status == '1' ? 'Online' : 'Offline')
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

function populate_modal_quote_edit(pkid) {
    var thisRow = currentDataSet.find(function(element) {
        return element['pkid'] == pkid;
    });
    $('#txt_quote_pkid').val(thisRow['pkid']);
    $('#txt_author_en_edit').val(thisRow['authorname_en']);
    $('#txt_author_bn_edit').val(thisRow['authorname_bn']);
    $('#txt_quote_edit').val(thisRow['quote']);
}
</script>
