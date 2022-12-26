 <div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?//= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Legal Informations</li>
                </ol>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-body">
                        <table id="tbl_legal_info" class="table table-sm table-hover text-center" style="cursor: pointer;" width="100%">
                            <thead>
                                <th>SL</th>
                                <th>Title</th>
                                <!-- <th>Document</th> -->
                                <th>Last Edited By</th>
                                <th>Last Edited At</th>
                                <th>View/Edit</th>
                            </thead>
                            <tbody>
                                <?php foreach ($legalinfolist as $key => $legalinfo): ?>
                                    <tr>
                                        <td><?=$legalinfo['pkid'] ?></td>
                                        <td><?=$legalinfo['appinfo'] ?></td>
                                        <!-- <td><?//= strlen($legalinfo['body'])>100 ? substr($legalinfo['body'],0,100).' . . .' : $legalinfo['body'] ?></td> -->
                                        <td><?=$legalinfo['updatedby'] ?></td>
                                        <td><?=$legalinfo['updatetime'] ?></td>
                                        <td> <button class="btn btn-xs btn-primary btn_edit" id="<?=$legalinfo['pkid'] ?>">Edit <i class="fas fa-edit"></i></button> </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <!-- </div>
            <div class="col-10"> -->
                <div class="card bg-light d-none" id="div_form">
                    <div class="card-body">
                        <form id="frm_edit_legal_info" method="post">
                            <input required type="hidden" name="pkid" id="txt_pkid">

                            <label class="">Title</label>
                            <input required readonly class="form-control" name="appinfo" id="txt_title">

                            <label class="mt-2">Full Document</label>
                            <textarea required name="infodetail" id="txt_body" class="mt-2 mb-2"></textarea>

                            <button type="submit" class="btn btn-primary mt-2 w-100"><i class="fas fa-save mr-1"></i>Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$('html, body').animate({
    scrollTop: $('#navlink_legalinfo').offset().top - 20
}, 'slow');

$('#navlink_legalinfo').addClass('active');
$('.loading').addClass('d-none');

var legal_info_list = <?=json_encode($legalinfolist) ?>;

function init_editor() {
    var editor = CKEDITOR.replace('infodetail', {
        extraPlugins : 'filebrowser, notification',
        filebrowserBrowseUrl: 'images/',
        filebrowserUploadUrl: 'upload_article_image/',
        filebrowserUploadMethod: 'form',
        toolbarGroups: [
            { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
            // { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
            { name: 'links' },
            { name: 'insert' },
            { name: 'forms' },
            { name: 'tools' },
            { name: 'document',       groups: [ 'mode', 'document', 'doctools' ] },
            // { name: 'others' },
            { name: 'about' },
            '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
            { name: 'styles' },
            { name: 'colors' },
        ]
    });
    editor.on( 'required', function( evt ) {
        editor.showNotification( 'This field is required.', 'info' );
        evt.cancel();
    } );
}
init_editor();


$('.btn_edit').click(function(evnt) {
    CKEDITOR.instances.txt_body.destroy();
    current_pkid = this.id;
    var selected_row = legal_info_list.find(function(row) {
        return current_pkid == row.pkid;
    })
    $('#txt_pkid').val(selected_row.pkid);
    $('#txt_title').val(selected_row.appinfo);
    $('#txt_body').val(selected_row.infodetail);
    $('#div_form').removeClass('d-none');
    init_editor();
})


$('#frm_edit_legal_info').submit(function(evnt) {
    evnt.preventDefault();
    if ($('#txt_pkid').val()=="" || $('#txt_title').val()=="" || $('#txt_body').val()=="") {
        return;
    }
    $(this).find('input:text').each(function(){
        $(this).val($.trim($(this).val()));
    });
    $(this).find('textarea').each(function(){
        $(this).val($.trim($(this).val()));
    });
    Swal.fire({
        title: 'Do you want to Save Changes?',
        type: "question",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {
            var form_data = new FormData($('#frm_edit_legal_info')[0]);
            pleaseWait();
            $.ajax({
                url: "<?= base_url('legal/edit_legal_info') ?>",
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success:function(data) {
                    console.log(data);
                    data = JSON.parse(data);
                    console.log(data);
					if (data==403) {
						accessDenied();
					} else if (data==440) {
						sessionExpired();
					} else if (data==1) {
						Swal.fire({
							title: "Saved Successfully",
							type: "success",
                            timer: 1000,
                            buttons: false
                        }).then((resp) => {
                            location.reload();
                        });
                    } else {
						somethingWentWrong();
					}
                },
                error: function(data) {
                    console.log(data);
					somethingWentWrong();
                },
                xhr: function() {
					return handle_progress();
                },
            });
        }
    });
})

</script>
