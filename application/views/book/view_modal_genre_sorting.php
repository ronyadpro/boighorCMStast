
<div class="modal fade" id="modal_genre_sorting">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Set Sort Order</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_gernre_sorting" method="post">
                <div class="modal-body">
                    <table id="tbl_genre_sorting" style="width:100%" class="table table-hover table-bordered table-sm text-center">
                        <thead class="table-secondary">
                            <th>#</th>
                            <th>CODE</th>
                            <th>IMG</th>
                            <th>BN</th>
                            <th>EN</th>
                        </thead>
                        <tbody id="tbody"></tbody>
                    </table>
                    <div class="row justify-content-center mt-2">
                        <div class="col-12">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times mr-1"></i> Close </button>
                    <button type="submit" class="btn btn-primary" id="btn_genre_sorting_save"> <i class="fas fa-save mr-1"></i> Save </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>

$('#frm_gernre_sorting').submit(function(event) {
    event.preventDefault()
})


var datatable;
var sorted_genre_list;

$('#modal_genre_sorting').on("shown.bs.modal", function (e) {
    console.log("modal loaded");

    $.ajax({
        url: "<?=base_url('book/get_genre_sorted_list')?>",
        method:"POST",
        success:function(data) {
            // console.log(data);
            sorted_genre_list = JSON.parse(data);
            // console.log(sorted_genre_list);
            if (sorted_genre_list) {
                loadTableData(sorted_genre_list);
            }
        },
        error: function() {
            Swal.fire({
                title: 'Oops.. Something went wrong!',
                type: "error",
            }).then((result) => {
                location.reload()
            });
        }
    });
})

function loadTableData(items) {
	if (datatable) {
		datatable.destroy();
	}

	document.getElementById("tbody").innerHTML = '';
	const table = document.getElementById("tbody");
	items.forEach( function (item, i) {
        // console.log(item);
		let row = table.insertRow();
		row.id = 'row_'+item.genre_code;

		row.insertCell(0).innerHTML = i+1;
		row.insertCell(1).innerHTML = item.genre_code;
        //
		let img = document.createElement("img");
        img.src = 'https://d1b3dh5v0ocdqe.cloudfront.net/media/book_genre_th/'+item.genre_code+'.jpg';
		img.classList.add("w-50");
		row.insertCell(2).appendChild(img);
        //
		row.insertCell(3).innerHTML = item.genre_bn;
		row.insertCell(4).innerHTML = item.genre_en;
	}.bind(this));

	datatable = $('#tbl_genre_sorting').DataTable( {
		responsive: true,
		searching: false,
		paging: false,
		rowReorder: true,
		bInfo: false,
		columnDefs: [
			{ "visible": false, "targets": [1] },
		// 	{ "width": "100px", "targets": [2] },
		// 	{ "width": "200px", "targets": [5,8] },
		// 	{ "width": "100px", "targets": [10] },
		// 	// { "width": "80px", "targets": [11] }
		],
	});
}

$('#btn_genre_sorting_save').click(function(event) {
    event.preventDefault()

	var sortedGenreCodes = $('#tbl_genre_sorting').DataTable().column(1).data().toArray();

    Swal.fire({
        title: 'Do you want to save?',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {

            var swal = Swal.fire({
                title: 'Please Wait...  &nbsp;&nbsp;  <i class="fas fa-spinner fa-spin"></i>',
                type: 'info',
                html: '<label id="progress_label">Progress: 0%</label><progress id="progress" class="progress-bar bg-primary progress-bar-striped pb-3 mb-3" max="100" style="width:0%; height:100%"></progress>',
                showConfirmButton: false,
                showCloseButton: false,
                showCancelButton: false,
                allowOutsideClick: false,
            });

            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            console.log(percentComplete);
                            $('#progress').width(parseInt(percentComplete)+'%');
                            $('#progress_label').text('Progress: '+parseInt(percentComplete)+'%');
                        }
                    }, false);
                    return xhr;
                },
                url: "<?= base_url() ?>book/save_genre_sortorder",
                method: "POST",
                data: {
                    genrecodes : sortedGenreCodes
                },
                success:function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire("Saved Successfully", "", "success").then((result) => {
                            $('#modal_genre_sorting').modal('hide');
                        });
                    } else if (data==403) {
                        Swal.fire("Access Denied", "You do not have permission to perform this action", "error").then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Oops.. Something went wrong!", "", "error").then((result) => {
                            location.reload();
                        });
                    }
                },
                error: function() {
                    Swal.fire("Oops.. Something went wrong!", "", "error").then((result) => {
                        location.reload();
                    });
                }
            });
        }
    });
})



</script>
