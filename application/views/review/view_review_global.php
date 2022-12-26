<style type="text/css">

td.details-control {
	background: url('../images/details_open.png') no-repeat center center;
	cursor: pointer;
}
tr.details td.details-control {
	background: url('../images/details_close.png') no-repeat center center;
}

</style>

<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Review Approval & Reply</li>
                    <li class="breadcrumb-item active">Boighor Global</li>
                </ol>
            </div>
            <div class="col-sm-6">
                <button class="btn btn-sm btn-outline-primary float-right" data-toggle="modal" data-target="#modal_review_global_create"> <i class="fas fa-plus mr-1"></i> <b> Insert Review </b> </button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table id="tbl_reviews" class="table table-bordered table-sm" width="100%"></table>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('review/view_modal_review_global_create'); ?>
<?php $this->load->view('review/view_modal_review_global_edit'); ?>
<?php $this->load->view('review/view_modal_reply_global_create'); ?>

<script type="text/javascript">

$('#navlink_reviewapproval').addClass('menu-open');
$('#navlink_reviewapproval_global').addClass('active');
$('.loading').addClass('d-none');

var sl=0;
var current_dataset;

var table = $('#tbl_reviews').DataTable( {
        processing: true,
        serverSide: true,
        stateSave : true,
        ordering : true,
        hilighting: false,
        responsive: false,
        pagingType: 'full_numbers',
		pageLength: 25,
    ajax: {
        url: "<?= base_url('review/getReviewList_global'); ?>",
        type: 'POST',
        // data: {
        //     'category' : selectedCategoryName,
        //     'genre' : selectedGenreName,
        //     'language': language,
        //     'type': type,
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
    order: [ 2, "desc" ],
    columns: [
		{
			"class":          "details-control",
			"orderable":      false,
			"data":           null,
			"defaultContent": "",
			"width":"1px",
		},
        {
            "title": "SL",
            "data": "datetime",
            render: function (data, type, row) {
                return ++sl;
            }
        },
        {
            "title": "Time",
            "data": "datetime",
        },
        {
            "title": "Bookname",
            "data": "bookname",
        },
        {
            "title": "BookCode",
            "data": "bookcode",
        },
        {
            "title": "Username",
            "data": "username",
        },
        {
            "title": "UserID",
            "data": "userid",
        },
        {
            "title": "Rating",
            "data": "ratingpoint",
            "width": "100px",
            render: function (data, type, row) {
                var rating_stars = '';
                for (var i = 0; i < 5; i++) {
                    if (i<data) {
                        rating_stars+='<i class="fas fa-star text-warning"></i>';
                    } else {
                        rating_stars+='<i class="far fa-star text-warning"></i>';
                    }
                }
                return rating_stars;
            }
        },
        {
            "title": "Comment/Review Text",
            "data": "reviewtext",
        },
        // {
        //     "title": "Reply Text",
        //     "data": "replytext",
        // },
        {
            "title": "Approved",
            "data": "approved",
            render: function (data, type, row) {
                var imageViewer = '';
                if (data==1) {
                    imageViewer = '<button class="btn btn-xs btn-primary btn_edit_approval" id="'+row['pkid']+'" title="'+data+'">Change Status</button>';
                } else if (data==-1) {
                    imageViewer = '<button class="btn btn-xs btn-primary btn_edit_approval" id="'+row['pkid']+'" title="'+data+'">Change Status</button>';
                } else {
                    imageViewer = '<button class="btn btn-xs btn-primary btn_edit_approval" id="'+row['pkid']+'" title="'+data+'">Approve/Reject</button>';
                }
                return imageViewer;
            }
        },
        {
            "title": "Delete",
            "data": "deleted",
            render: function (data, type, row) {
                var imageViewer = '<button class="btn btn-xs btn-danger btn_delete" id="'+row['pkid']+'" title="'+row['pkid']+'"><i class="fas fa-trash"></i></button>';
                return imageViewer;
            }
        },
        <?php if ($this->userinfo['permissions']->feedback_update): ?>
        {
            "title": "Edit",
            "data": "pkid",
            render: function (data, type, row) {
                var imageViewer = '<button class="btn btn-xs btn-warning btn_edit" onclick="populate_modal_edit_review(\''+row['pkid']+'\')" data-toggle="modal" data-target="#modal_review_global_edit"><i class="fas fa-edit"></i></button>';
                return row['fromebs']==1 ? imageViewer : '';
            }
        },
        <?php endif; ?>
        {
            "title": "Reply",
            "data": "replytext",
            render: function (data, type, row) {
                var imageViewer = '';
                if (data && data.length > 0) {
                    // imageViewer = '<button class="btn btn-xs btn-secondary" onclick="populate_modal_create_reply(\''+row['pkid']+'\')" data-toggle="modal" data-target="#modal_reply_global_create" id="'+row['pkid']+'" title="'+data+'">Edit Reply</button>';
                }  else {
                    imageViewer = '<button class="btn btn-xs btn-primary" onclick="populate_modal_create_reply(\''+row['pkid']+'\')" data-toggle="modal" data-target="#modal_reply_global_create" id="'+row['pkid']+'" title="'+data+'">Reply</button>';
                }
                return imageViewer;
            }
        },

    ],
    "createdRow": function( row, data, dataIndex){
        if( data['approved'] == 1){
            $(row).addClass('bg-green');
            // $(row).addClass('disabled');
        } else if( data['approved'] == -1) {
            $(row).addClass('bg-secondary');
            // $(row).addClass('disabled');
        } else {

        }
    },
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

$('#tbl_reviews tbody').on( 'click', 'tr td.details-control', function () {
	var tr = $(this).closest('tr');
	var row = table.row( tr );
	var idx = $.inArray( tr.attr('id'), current_dataset );
	if ( row.child.isShown() ) {
		tr.removeClass( 'details' );
		row.child.hide();
		// Remove from the 'open' array
		current_dataset.splice( idx, 1 );
	} else {
		tr.addClass( 'details' );
		row.child( format( row.data() ) ).show();
		// Add to the 'open' array
		if ( idx === -1 ) {
			current_dataset.push( tr.attr('id') );
		}
		// console.log(row.data());
	}
    $('.btn_reply_status').click(function(evnt) {
        reply_status_click_btn_action(this, 'boighor');
    });
    $('.btn_author_reply_status').click(function(evnt) {
        reply_status_click_btn_action(this, 'author');
    });
});

function format ( row ) {
    var expand_text = '<table class="table table-bordered table-sm mb-0">';
    expand_text+= '<thead><tr><th>Reply Time</th><th>Reply Type</th><th>Replied By</th><th>Reply Text</th><th>Status</th><th>Edit</th></tr></thead>';
    expand_text_length = expand_text.length;
    if (row.replytext!='') {
        expand_text+= '<tr><td>'+row.reply_time+'</td><td>Boighor</td><td>'+row.replytext+'</td><td>'+row.reply_by+'</td>';
        if (row.reply_status==1) {
            expand_text+= '<td><button id="'+row.pkid+'" title="1" class="btn btn-xs btn-success btn_reply_status">LIVE</button></td>';
        } else {
            expand_text+= '<td><button id="'+row.pkid+'" title="0" class="btn btn-xs btn-secondary btn_reply_status">OFFLINE</button></td>';
        }
        expand_text+= '<td><button class="btn btn-xs btn-secondary btn_reply_edit" onclick="populate_modal_create_reply(\''+row.pkid+'\')" data-toggle="modal" data-target="#modal_reply_global_create"><i class="fas fa-edit"></i></button></td>';
        expand_text+= '</tr>';
    }
    if (row.author_reply_text!='') {
        expand_text+= '<tr><td>'+row.author_reply_time+'</td><td>Author</td><td>'+row.author_reply_text+'</td><td>'+row.author_reply_by+'</td>';
        if (row.author_reply_status==1) {
            expand_text+= '<td><button id="'+row.pkid+'" title="1" class="btn btn-xs btn-success btn_author_reply_status">LIVE</button></td>';
        } else {
            expand_text+= '<td><button id="'+row.pkid+'" title="0" class="btn btn-xs btn-secondary btn_author_reply_status">OFFLINE</button></td>';
        }
        expand_text+= '<td></td>';
        expand_text+= '</tr>';
    }
    if (expand_text.length==expand_text_length) {
        expand_text+= '<thead><tr><td colspan="6">No Reply Yet</td></tr></thead>';
    }
    expand_text+= '</table>';
    return expand_text;
}

function reply_status_click_btn_action(evnt,reply_type) {
    Swal.fire({
        title: 'Select Status',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Save',
        input: 'select',
        inputOptions: {
            "1":"Live","0":"Offline",
        },
        inputValue: evnt.title,
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "<?=base_url('review/change_reply_status')?>",
                method: "POST",
                data: {
                    pkid: evnt.id,
                    status: result.value,
                    reply_type:reply_type
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

function status_click_btn_action(evnt) {
    Swal.fire({
        title: 'Select Status',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Save',
        input: 'select',
        inputOptions: {
            "1":"Approve","-1":"Reject",
        },
        inputValue: evnt.title,
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "<?=base_url('review/change_approve_status')?>",
                method: "POST",
                data: {
                    pkid: evnt.id,
                    approved: result.value,
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

function delete_click_btn_action(evnt) {
    Swal.fire({
        title: 'Delete this Review',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "<?=base_url('review/delete_review')?>",
                method: "POST",
                data: {
                    pkid: evnt.id,
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
