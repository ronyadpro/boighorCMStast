<section class="content">
	<div class="container-fluid">

		<div class="row pt-3">
			<div class="col-sm-6">
				<h3 class="m-0 text-dark">Cms Log Details</h3>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
					<li class="breadcrumb-item active">CMS Log</li>
				</ol>
			</div>
		</div>
		<!-- client, service, inventory, account, employee, team -->
		<div class="row justify-content-center">
			<div class="col-sm-3">
				<!-- <select class="form-control" name="" id="ddl_user">
					<option>Please, select username first...</option>
					<?php foreach ($userlist as $user): ?>
						<?php echo "<option value=".$user['usr'].">".$user['fullname']."</option>" ?>
					<?php endforeach; ?>
				</select> -->

				<input type="date" class="form-control" name="logdate" id="logdate" value="<?= date('Y-m-d') ?>" placeholder="Please select a date" />
			</div>
			<div class="col-sm-1">
				<div class="spinner-border text-primary d-none" role="status" id="loader_div">
					<span class="sr-only">Loading...</span>
				</div>
			</div>
		</div>
		<div class="row" id="blocks">

			<textarea wrap="off" id="logdetails" rows="50" readonly class="form-control"></textarea>
		</div>
	</div>
</section>


<script>

$('#navlink_cmslog').addClass('active');
$('.loading').addClass('d-none');

$('#logdate').change(function(e) {
	$.ajax({
		url: "<?= base_url('devlog/get_logdetails_cmslog') ?>",
		type: "POST",
		data: {
			date: $('#logdate').val()
		},
		beforeSend: function( data ) {
			$('#loader_div').removeClass('d-none');
		},
		success: function(data){
			$('#loader_div').addClass('d-none');
			data = JSON.parse(data);
			 console.log(data);
			if (data) {
				// for (var item in data) {
				// 	$('#'+item).attr('checked', false);
				// }
				// for (var item in data) {
				// 	$('#'+item).prop('checked', Boolean(Number(data[item])));
				// }
				document.getElementById('logdetails').innerHTML = '';
				document.getElementById('logdetails').innerHTML = data['log'];
				$('#blocks').removeClass('d-none');
			} else {
				document.getElementById('logdetails').innerHTML = '';
				document.getElementById('logdetails').innerHTML = data['msg'];
				$('#blocks').addClass('d-none');
			}
		},
		error: function(err) {
			console.log(err);
		}
	});

});

$('#logdate').change()

</script>
