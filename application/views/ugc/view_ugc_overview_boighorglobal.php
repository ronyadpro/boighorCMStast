
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="<?= base_url('ugc/boighorglobal'); ?>">UGC</a></li>
                    <li class="breadcrumb-item active"><?= $ugc['title'] ?></li>
                </ol>
            </div>
            <div class="col-sm-6">
               <div class="row float-right">
                   <input type="checkbox" name="my-checkbox"  data-bootstrap-switch data-on-color="success" data-off-color="secondary" data-label-text="<span class='fa fa-check'></span>" id="chk_isapproved" <?= $ugc['isapproved'] ? 'checked' : '' ?>>
               </div>
            </div>
        </div>

        <div class="row">
            <!-- <div class="col-sm-3">
                Writer:
            </div>
            <div class="col-sm-3">
                Mobile No: <?= $ugc['mobileno'] ?>
            </div>
            <div class="col-sm-3">
                Email: <?= $ugc['email'] ?>
            </div>
            <div class="col-sm-3">
                Submitted: <?= $ugc['datetime'] ?>
            </div> -->
        </div>
        <div class="row">
            <div class="col-6">

                <h3><?= $ugc['title'] ?></h3>
                <h5><?= $ugc['username'] ?></h5>

            </div>
            <div class="col-6 text-right">
                <p class="p-0 m-0">
                    <b>Mobile No: </b><?= $ugc['mobileno'] ?>
                </p>
                <p class="p-0 m-0">
                    <b>Email: </b><?= $ugc['email'] ?>
                </p>
                <p class="p-0 m-0">
                    <b>Submitted: </b><?= $ugc['datetime'] ?>
                </p>
            </div>
        </div>
        <br>
        <div class="row">
            <p><?= $ugc['content'] ?></p>
        </div>
    </div>
</div>

<script type="text/javascript">

$('#navlink_ugc').addClass('menu-open');
$('#navlink_ugc_boighorglobal').addClass('active');
$('.loading').addClass('d-none');

$("input[data-bootstrap-switch]").each(function(){
   $(this).bootstrapSwitch('onText', 'Approved').bootstrapSwitch('offText', 'Unapproved').bootstrapSwitch('state', $(this).prop('checked')).on('switchChange.bootstrapSwitch', function (event, state) {
       console.log(event, state)
       changeApproveStatus('<?= $ugc['ugcid'] ?>', state?1:0)
   });
});

function changeApproveStatus(ugcid, isapproved) {
    if (isapproved==<?= $ugc['isapproved'] ?>) {
        return 0;
    }
   $.ajax({
       url: "<?= base_url() ?>ugc/change_ugc_status",
       method: "POST",
       data: {
           ugcid : ugcid,
           isapproved: isapproved
       },
       success:function(data) {
           console.log(data);
           if (data==1) {
               Toast.fire({
                   type: (isapproved == '1' ? 'success' : 'error'),
                   title: 'UGC is '+(isapproved == '1' ? 'Approved' : 'Unapproved')
               });
           } else if (data==403) {
               Toast.fire({
                   type: 'warning',
                   title: 'You do not have permission to perform this action'
               });
               $('#chk_isapproved').bootstrapSwitch('state', isapproved?false:true);
               // $("#chk_isapproved").prop("checked", false);
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
</script>
