<section class="content">
	<div class="container-fluid">

		<div class="row pt-3">
			<div class="col-sm-6">
				<h3 class="m-0 text-dark">Remote Configuaration</h3>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
					<li class="breadcrumb-item active">Remote Configuaration</li>
				</ol>
			</div>
		</div>

		<div class="row justify-content-center">
			<ul class="nav nav-tabs" id="nav-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false"></a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" id="nav-nav-web" data-toggle="tab" href="#nav-web" role="tab" aria-controls="nav-web" aria-selected="true">
						<span style="color:#3a3a3a">
							<i class="fab fa-internet-explorer mr-1"></i>
							<b>Web</b>
						</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="nav-nav-app" data-toggle="tab" href="#nav-app" role="tab" aria-controls="nav-app">
						<span style="color:#3a3a3a">
							<i class="fab fa-android mr-1"></i>
							<b>Android</b>
						</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="nav-nav-ios" data-toggle="tab" href="#nav-ios" role="tab" aria-controls="nav-ios">
						<span style="color:#3a3a3a">
							<i class="fab fa-apple mr-1"></i>
							<b>iOS</b>
						</span>
					</a>
				</li>
			</ul>
		</div>

		<div class="row">
			<div class="tab-content">
				<div class="tab-pane fade show active" id="nav-web" role="tabpanel">
					<p class="invisible collapsing m-0 p-0">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
					<div class="card">
						<div class="card-body">
							<form id="frm_configs_web" method="post" class="m-0">
								<input type="hidden" name="platform" id="platform_web" value="web">
								<div class="row justify-content-center">
									<!-- Login -->
									<div class="col-sm-2">
										<div class="card card-light mt-3">
											<div class="card-header">
												<h3 class="card-title">
													<i class="fas fa-lock"></i>
													Login
												</h3>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-sm-12">
														<!-- checkbox -->
														<div class="form-group">
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="login_email_web">
																<label for="login_email_web" class="custom-control-label">Email</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="login_facebook_web" >
																<label for="login_facebook_web" class="custom-control-label">Facebook</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="login_google_web" >
																<label for="login_google_web" class="custom-control-label">Google</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="card card-light mt-3">
											<div class="card-header">
												<h3 class="card-title">
													<i class="fas fa-money-check-alt"></i>
													Payment
												</h3>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-sm-12">
														<!-- checkbox -->
														<div class="form-group">
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_bkash_web">
																<label for="pay_bkash_web" class="custom-control-label">bKash</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_nagad_web">
																<label for="pay_nagad_web" class="custom-control-label">Nagad</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_portwallet_web">
																<label for="pay_portwallet_web" class="custom-control-label">Port Wallet</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_stripe_web">
																<label for="pay_stripe_web" class="custom-control-label">Stripe</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_gpay_web">
																<label for="pay_gpay_web" class="custom-control-label">gPay</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_city_web">
																<label for="pay_city_web" class="custom-control-label">City Bank</label>
															</div>



														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- UGC -->
									<div class="col-sm-5">
										<div class="card card-light mt-3">
											<div class="card-header">
												<h3 class="card-title">
													<i class="fas fa-user-tie"></i>
													UGC
												</h3>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-sm-12">
														<!-- checkbox -->
														<div class="form-group mb-1">
															<label for="ugc_consent_msg_web">Consent Message</label>
															<textarea class="form-control" rows="2" id="ugc_consent_msg_web"><?= $config['web']['ugc_consent_msg'] ?></textarea>
															<label for="ugc_postlimit_msg_web">Max Submit Message</label>
															<textarea class="form-control" rows="1" id="ugc_postlimit_msg_web"><?= $config['web']['ugc_postlimit_msg'] ?></textarea>
															<label for="consent_msg_web">Consent Message</label>
															<textarea class="form-control" rows="1" id="consent_msg_web"><?= $config['web']['consent_msg'] ?></textarea>
															<label for="ugc_char_min_web">Minimun Char Limit</label>
															<input class="form-control" type="number" id="ugc_char_min_web" value="<?= $config['web']['ugc_char_min'] ?>">
															<label for="ugc_char_max_web">Maximum Char Limit</label>
															<input class="form-control" type="number" id="ugc_char_max_web" value="<?= $config['web']['ugc_char_max'] ?>">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!-- Updates -->
									<div class="col-sm-5">
										<div class="card card-light mt-3">
											<div class="card-header">
												<h3 class="card-title">
													<i class="fas fa-code-branch"></i>
													Updates
												</h3>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-sm-12">
														<!-- checkbox -->
														<div class="form-group">
															<label for="enforcetext_web">Enforce Message</label>
															<textarea class="form-control" rows="4" id="enforcetext_web"><?= $config['web']['enforcetext'] ?></textarea>
															<label for="enforcetext_web">Update Message</label>
															<textarea class="form-control" rows="3" id="message_update_web"><?= $config['web']['message_update'] ?></textarea>
															<!-- <label for="enforcetext_web">Force Update Message</label>
															<textarea class="form-control" rows="1" id="message_forceupdate"></textarea> -->
															<label for="enforcetext_web">Enforce App Version (Android)</label>
															<input class="form-control" type="number" id="currentversion_web" value="<?= $config['web']['currentversion'] ?>">
															<div class="custom-control custom-checkbox mt-2">
																<input class="custom-control-input" type="checkbox" id="enforce_web">
																<label for="enforce_web" class="custom-control-label text-danger">Enforce Update</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="col-12">
										<button class="btn btn-block btn-primary mt-2"> <i class="fas fa-save mr-1"></i> SAVE </button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="nav-app" role="tabpanel">
					<p class="invisible collapsing m-0 p-0">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
					<div class="card">
						<div class="card-body">
							<form id="frm_configs_app" method="post" class="m-0">
								<input type="hidden" name="platform" id="platform_app" value="app">
								<div class="row justify-content-center">
									<!-- Login -->
									<div class="col-sm-2">
										<div class="card card-light mt-3">
											<div class="card-header">
												<h3 class="card-title">
													<i class="fas fa-lock"></i>
													Login
												</h3>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-sm-12">
														<!-- checkbox -->
														<div class="form-group">
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="login_email_app">
																<label for="login_email_app" class="custom-control-label">Email</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="login_facebook_app" >
																<label for="login_facebook_app" class="custom-control-label">Facebook</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="login_google_app" >
																<label for="login_google_app" class="custom-control-label">Google</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="card card-light mt-3">
											<div class="card-header">
												<h3 class="card-title">
													<i class="fas fa-money-check-alt"></i>
													Payment
												</h3>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-sm-12">
														<!-- checkbox -->
														<div class="form-group">
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_bkash_app">
																<label for="pay_bkash_app" class="custom-control-label">bKash</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_nagad_app">
																<label for="pay_nagad_app" class="custom-control-label">Nagad</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_portwallet_app">
																<label for="pay_portwallet_app" class="custom-control-label">Port Wallet</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_stripe_app">
																<label for="pay_stripe_app" class="custom-control-label">Stripe</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_gpay_app">
																<label for="pay_gpay_app" class="custom-control-label">gPay</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_city_app">
																<label for="pay_city_app" class="custom-control-label">City Bank</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- UGC -->
									<div class="col-sm-5">
										<div class="card card-light mt-3">
											<div class="card-header">
												<h3 class="card-title">
													<i class="fas fa-user-tie"></i>
													UGC
												</h3>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-sm-12">
														<!-- checkbox -->
														<div class="form-group mb-1">
															<label for="ugc_consent_msg_app">Consent Message</label>
															<textarea class="form-control" rows="2" id="ugc_consent_msg_app"><?= $config['app']['ugc_consent_msg'] ?></textarea>
															<label for="ugc_postlimit_msg_app">Max Submit Message</label>
															<textarea class="form-control" rows="1" id="ugc_postlimit_msg_app"><?= $config['app']['ugc_postlimit_msg'] ?></textarea>
															<label for="consent_msg_app">Consent Message</label>
															<textarea class="form-control" rows="1" id="consent_msg_app"><?= $config['app']['consent_msg'] ?></textarea>
															<label for="ugc_char_min_app">Minimun Char Limit</label>
															<input class="form-control" type="number" id="ugc_char_min_app" value="<?= $config['app']['ugc_char_min'] ?>">
															<label for="ugc_char_max_app">Maximum Char Limit</label>
															<input class="form-control" type="number" id="ugc_char_max_app" value="<?= $config['app']['ugc_char_max'] ?>">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!-- Updates -->
									<div class="col-sm-5">
										<div class="card card-light mt-3">
											<div class="card-header">
												<h3 class="card-title">
													<i class="fas fa-code-branch"></i>
													Updates
												</h3>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-sm-12">
														<!-- checkbox -->
														<div class="form-group">
															<label for="enforcetext_app">Enforce Message</label>
															<textarea class="form-control" rows="4" id="enforcetext_app"><?= $config['app']['enforcetext'] ?></textarea>
															<label for="enforcetext_app">Update Message</label>
															<textarea class="form-control" rows="3" id="message_update_app"><?= $config['app']['message_update'] ?></textarea>
															<!-- <label for="enforcetext_app">Force Update Message</label>
															<textarea class="form-control" rows="1" id="message_forceupdate"></textarea> -->
															<label for="enforcetext_app">Enforce App Version (Android)</label>
															<input class="form-control" type="number" id="currentversion_app" value="<?= $config['app']['currentversion'] ?>">
															<div class="custom-control custom-checkbox mt-2">
																<input class="custom-control-input" type="checkbox" id="enforce_app">
																<label for="enforce_app" class="custom-control-label text-danger">Enforce Update</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="col-12">
										<button class="btn btn-block btn-primary mt-2"> <i class="fas fa-save mr-1"></i> SAVE </button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="nav-ios" role="tabpanel">
					<p class="invisible collapsing m-0 p-0">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
					<div class="card">
						<div class="card-body">
							<form id="frm_configs_ios" method="post" class="m-0">
								<input type="hidden" name="platform" id="platform_ios" value="ios">
								<div class="row justify-content-center">
									<!-- Login -->
									<div class="col-sm-2">
										<div class="card card-light mt-3">
											<div class="card-header">
												<h3 class="card-title">
													<i class="fas fa-lock"></i>
													Login
												</h3>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-sm-12">
														<!-- checkbox -->
														<div class="form-group">
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="login_email_ios">
																<label for="login_email_ios" class="custom-control-label">Email</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="login_facebook_ios" >
																<label for="login_facebook_ios" class="custom-control-label">Facebook</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="login_google_ios" >
																<label for="login_google_ios" class="custom-control-label">Google</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="card card-light mt-3">
											<div class="card-header">
												<h3 class="card-title">
													<i class="fas fa-money-check-alt"></i>
													Payment
												</h3>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-sm-12">
														<!-- checkbox -->
														<div class="form-group">
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_bkash_ios">
																<label for="pay_bkash_ios" class="custom-control-label">bKash</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_nagad_ios">
																<label for="pay_nagad_ios" class="custom-control-label">Nagad</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_portwallet_ios">
																<label for="pay_portwallet_ios" class="custom-control-label">Port Wallet</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_stripe_ios">
																<label for="pay_stripe_ios" class="custom-control-label">Stripe</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_gpay_ios">
																<label for="pay_gpay_ios" class="custom-control-label">gPay</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="pay_city_ios">
																<label for="pay_city_ios" class="custom-control-label">City Bank</label>
															</div>

															<div class="custom-control custom-checkbox">

															</div>

															<hr>
															<div class="custom-control custom-checkbox">
																<input class="custom-control-input" type="checkbox" id="show_cart_ios">
																<label for="show_cart_ios" class="custom-control-label">Show cart iOS</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- UGC -->
									<div class="col-sm-5">
										<div class="card card-light mt-3">
											<div class="card-header">
												<h3 class="card-title">
													<i class="fas fa-user-tie"></i>
													UGC
												</h3>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-sm-12">
														<!-- checkbox -->
														<div class="form-group mb-1">
															<label for="ugc_consent_msg_ios">Consent Message</label>
															<textarea class="form-control" rows="2" id="ugc_consent_msg_ios"><?= $config['ios']['ugc_consent_msg'] ?></textarea>
															<label for="ugc_postlimit_msg_ios">Max Submit Message</label>
															<textarea class="form-control" rows="1" id="ugc_postlimit_msg_ios"><?= $config['ios']['ugc_postlimit_msg'] ?></textarea>
															<label for="consent_msg_ios">Consent Message</label>
															<textarea class="form-control" rows="1" id="consent_msg_ios"><?= $config['ios']['consent_msg'] ?></textarea>
															<label for="ugc_char_min_ios">Minimun Char Limit</label>
															<input class="form-control" type="number" id="ugc_char_min_ios" value="<?= $config['ios']['ugc_char_min'] ?>">
															<label for="ugc_char_max_ios">Maximum Char Limit</label>
															<input class="form-control" type="number" id="ugc_char_max_ios" value="<?= $config['ios']['ugc_char_max'] ?>">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!-- Updates -->
									<div class="col-sm-5">
										<div class="card card-light mt-3">
											<div class="card-header">
												<h3 class="card-title">
													<i class="fas fa-code-branch"></i>
													Updates
												</h3>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-sm-12">
														<!-- checkbox -->
														<div class="form-group">
															<label for="enforcetext_ios">Enforce Message</label>
															<textarea class="form-control" rows="4" id="enforcetext_ios"><?= $config['ios']['enforcetext'] ?></textarea>
															<label for="enforcetext_ios">Update Message</label>
															<textarea class="form-control" rows="3" id="message_update_ios"><?= $config['ios']['message_update'] ?></textarea>
															<!-- <label for="enforcetext_ios">Force Update Message</label>
															<textarea class="form-control" rows="1" id="message_forceupdate"></textarea> -->
															<label for="enforcetext_ios">Enforce App Version (Android)</label>
															<input class="form-control" type="number" id="currentversion_ios" value="<?= $config['ios']['currentversion'] ?>">
															<div class="custom-control custom-checkbox mt-2">
																<input class="custom-control-input" type="checkbox" id="enforce_ios">
																<label for="enforce_ios" class="custom-control-label text-danger">Enforce Update</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="col-12">
										<button class="btn btn-block btn-primary mt-2"> <i class="fas fa-save mr-1"></i> SAVE </button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<script>

$('#navlink_remoteconfig').addClass('active');
$('.loading').addClass('d-none');

var config = <?= json_encode($config) ?>;
for (var platform in config) {
	for (var item in config[platform]) {
		$('#'+item+'_'+platform).prop('checked', Boolean(Number(config[platform][item])));
	}
}

$('#frm_configs_web, #frm_configs_app, #frm_configs_ios').submit(function(evnt) {
    evnt.preventDefault();

	let platform_suffix = '_'+this.id.substring(this.id.length -3);

    var form_data = {}
    form_data['platform'] = $('#platform'+platform_suffix).val()
    form_data['login_email'] = $('#login_email'+platform_suffix).prop('checked') ? 1 : 0
    form_data['login_facebook'] = $('#login_facebook'+platform_suffix).prop('checked') ? 1 : 0
    form_data['login_google'] = $('#login_google'+platform_suffix).prop('checked') ? 1 : 0
    form_data['pay_bkash'] = $('#pay_bkash'+platform_suffix).prop('checked') ? 1 : 0
    form_data['pay_nagad'] = $('#pay_nagad'+platform_suffix).prop('checked') ? 1 : 0
    form_data['pay_portwallet'] = $('#pay_portwallet'+platform_suffix).prop('checked') ? 1 : 0
    form_data['pay_stripe'] = $('#pay_stripe'+platform_suffix).prop('checked') ? 1 : 0
    form_data['pay_city'] = $('#pay_city'+platform_suffix).prop('checked') ? 1 : 0
    form_data['pay_gpay'] = $('#pay_gpay'+platform_suffix).prop('checked') ? 1 : 0
	form_data['show_cart'] = $('#show_cart'+platform_suffix).prop('checked') ? 1 : 0
    form_data['ugc_consent_msg'] = $('#ugc_consent_msg'+platform_suffix).val()
    form_data['ugc_postlimit_msg'] = $('#ugc_postlimit_msg'+platform_suffix).val()
    form_data['consent_msg'] = $('#consent_msg'+platform_suffix).val()
    form_data['ugc_char_min'] = $('#ugc_char_min'+platform_suffix).val()
    form_data['ugc_char_max'] = $('#ugc_char_max'+platform_suffix).val()
    form_data['enforcetext'] = $('#enforcetext'+platform_suffix).val()
    form_data['message_update'] = $('#message_update'+platform_suffix).val()
    form_data['message_forceupdate'] = $('#message_forceupdate'+platform_suffix).val()
    form_data['currentversion'] = $('#currentversion'+platform_suffix).val()
    form_data['enforce'] = $('#enforce'+platform_suffix).prop('checked') ? 1 : 0

    Swal.fire({
        title: 'Do you want to save?',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "<?= base_url('remote-config/update_remote_config') ?>",
                type: "POST",
                data: form_data,
                success: function(data){
                    console.log(data);
                    if (data == 1 || data == 0) {
                        Swal.fire("Saved Successfully", "", "success").then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Oops", "Something Went Wrong!", "error").then((result) => {
                            location.reload();
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
    });
})

// $(":checkbox").change(function(e) {
// 	$.ajax({
// 		url: "<?= base_url('remote-config/update_remote_config') ?>",
// 		type: "POST",
// 		data: {
// 			field: this.id,
// 			value: $('#'+this.id).is(':checked') ? '1' : '0',
// 		},
// 		success: function(data) {
// 			console.log(data);
// 			if (data == 1) {
// 	            toastr.success('Saved successfully')
// 			} else {
// 				$('#'+this.id).prop('checked', Boolean(Number($('#'+this.id).is(':checked') ? '0' : '1')));
// 	            toastr.error('Oops.. Something went wrong!')
// 			}
// 		},
// 		error: function(err) {
// 			console.log(err);
// 			$('#'+this.id).prop('checked', Boolean(Number($('#'+this.id).is(':checked') ? '0' : '1')));
// 			toastr.error('Oops.. Something went wrong!')
// 		}
// 	});
//
// });
</script>
