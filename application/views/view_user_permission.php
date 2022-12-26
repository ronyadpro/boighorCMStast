<section class="content">
	<div class="container-fluid">

		<div class="row pt-3">
			<div class="col-sm-6">
				<h3 class="m-0 text-dark">User Permissions</h3>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
					<li class="breadcrumb-item active">Permission</li>
				</ol>
			</div>
		</div>
		<!-- client, service, inventory, account, employee, team -->
		<div class="row mb-3">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<select class="form-control" name="" id="ddl_user">
					<option>Please, select username first...</option>
					<?php foreach ($userlist as $user): ?>
						<?php echo "<option value=".$user['usr'].">".$user['fullname']."</option>" ?>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="col-sm-1">
				<div class="spinner-border text-primary d-none" role="status" id="loader_div">
					<span class="sr-only">Loading...</span>
				</div>
			</div>
		</div>
		<div class="row justify-content-center d-none" id="blocks">
			<!-- Client -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-book"></i>
							Book
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<!-- checkbox -->
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="book_view">
										<label for="book_view" class="custom-control-label">View</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-valid" type="checkbox" id="book_create" >
										<label for="book_create" class="custom-control-label is-valid">Create</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-warning" type="checkbox" id="book_update" >
										<label for="book_update" class="custom-control-label is-warning">Update</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-invalid" type="checkbox" id="book_delete" >
										<label for="book_delete" class="custom-control-label is-invalid">Delete</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Author -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-user-tie"></i>
							Author
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<!-- checkbox -->
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="author_view">
										<label for="author_view" class="custom-control-label">View</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-valid" type="checkbox" id="author_create" >
										<label for="author_create" class="custom-control-label is-valid">Create</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-warning" type="checkbox" id="author_update" >
										<label for="author_update" class="custom-control-label is-warning">Update</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-invalid" type="checkbox" id="author_delete" >
										<label for="author_delete" class="custom-control-label is-invalid">Delete</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Publisher -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-copyright"></i>
							Publisher
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<!-- checkbox -->
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="publisher_view">
										<label for="publisher_view" class="custom-control-label">View</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-valid" type="checkbox" id="publisher_create" >
										<label for="publisher_create" class="custom-control-label is-valid">Create</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-warning" type="checkbox" id="publisher_update" >
										<label for="publisher_update" class="custom-control-label is-warning">Update</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-invalid" type="checkbox" id="publisher_delete" >
										<label for="publisher_delete" class="custom-control-label is-invalid">Delete</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Inventory -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-chart-pie"></i>
							Category
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<!-- checkbox -->
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="category_view">
										<label for="category_view" class="custom-control-label">View</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-valid" type="checkbox" id="category_create" >
										<label for="category_create" class="custom-control-label is-valid">Create</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-warning" type="checkbox" id="category_update" >
										<label for="category_update" class="custom-control-label is-warning">Update</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-invalid" type="checkbox" id="category_delete" >
										<label for="category_delete" class="custom-control-label is-invalid">Delete</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Fleet Management -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-chart-pie"></i>
							Genre
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<!-- checkbox -->
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="genre_view">
										<label for="genre_view" class="custom-control-label">View</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-valid" type="checkbox" id="genre_create" >
										<label for="genre_create" class="custom-control-label is-valid">Create</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-warning" type="checkbox" id="genre_update" >
										<label for="genre_update" class="custom-control-label is-warning">Update</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-invalid" type="checkbox" id="genre_delete" >
										<label for="genre_delete" class="custom-control-label is-invalid">Delete</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Accounts -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-sitemap"></i>
							Curation
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<!-- checkbox -->
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="curation_view">
										<label for="curation_view" class="custom-control-label">View</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-valid" type="checkbox" id="curation_create" >
										<label for="curation_create" class="custom-control-label is-valid">Create</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-warning" type="checkbox" id="curation_update" >
										<label for="curation_update" class="custom-control-label is-warning">Update</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-invalid" type="checkbox" id="curation_delete" >
										<label for="curation_delete" class="custom-control-label is-invalid">Delete</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Employee -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-images"></i>
							banners
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<!-- checkbox -->
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="banner_view">
										<label for="banner_view" class="custom-control-label">View</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-valid" type="checkbox" id="banner_create" >
										<label for="banner_create" class="custom-control-label is-valid">Create</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-warning" type="checkbox" id="banner_update" >
										<label for="banner_update" class="custom-control-label is-warning">Update</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-invalid" type="checkbox" id="banner_delete" >
										<label for="banner_delete" class="custom-control-label is-invalid">Delete</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Team -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-dollar-sign"></i>
							Pricing
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<!-- checkbox -->
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="pricing_view">
										<label for="pricing_view" class="custom-control-label">View</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-valid" type="checkbox" id="pricing_create" >
										<label for="pricing_create" class="custom-control-label is-valid">Create</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-warning" type="checkbox" id="pricing_update">
										<label for="pricing_update" class="custom-control-label is-warning">Update</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-invalid" type="checkbox" id="pricing_delete" >
										<label for="pricing_delete" class="custom-control-label is-invalid">Delete</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- BI & Analysis -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
						<i class="fas fa-chart-area"></i>
							BI & Analysis
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<!-- checkbox -->
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="bi_view">
										<label for="bi_view" class="custom-control-label">View</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-valid" type="checkbox" id="bi_create" >
										<label for="bi_create" class="custom-control-label is-valid">Create</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-warning" type="checkbox" id="bi_update" >
										<label for="bi_update" class="custom-control-label is-warning">Update</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-invalid" type="checkbox" id="bi_delete" >
										<label for="bi_delete" class="custom-control-label is-invalid">Delete</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Feedback / Comment -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="nav-icon fas fa-comment"></i>
							Feedback/Comment
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<!-- checkbox -->
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="feedback_view">
										<label for="feedback_view" class="custom-control-label">View</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-valid" type="checkbox" id="feedback_create" >
										<label for="feedback_create" class="custom-control-label is-valid">Create</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-warning" type="checkbox" id="feedback_update">
										<label for="feedback_update" class="custom-control-label is-warning">Update</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-invalid" type="checkbox" id="feedback_delete" >
										<label for="feedback_delete" class="custom-control-label is-invalid">Delete</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Quotes -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="nav-icon fas fa-quote-right"></i>
							Quotes
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<!-- checkbox -->
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="quote_view">
										<label for="quote_view" class="custom-control-label">View</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-valid" type="checkbox" id="quote_create" >
										<label for="quote_create" class="custom-control-label is-valid">Create</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-warning" type="checkbox" id="quote_update">
										<label for="quote_update" class="custom-control-label is-warning">Update</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-invalid" type="checkbox" id="quote_delete" >
										<label for="quote_delete" class="custom-control-label is-invalid">Delete</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- UGC -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="nav-icon fas fa-pen-alt"></i>
							UGC
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<!-- checkbox -->
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="ugc_view">
										<label for="ugc_view" class="custom-control-label">View</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-valid" type="checkbox" id="ugc_create" >
										<label for="ugc_create" class="custom-control-label is-valid">Create</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-warning" type="checkbox" id="ugc_update">
										<label for="ugc_update" class="custom-control-label is-warning">Update</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-invalid" type="checkbox" id="ugc_delete" >
										<label for="ugc_delete" class="custom-control-label is-invalid">Delete</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- UGC -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="nav-icon fas fa-pen-alt"></i>
							Coupon
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<!-- checkbox -->
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="coupon_view">
										<label for="coupon_view" class="custom-control-label">View</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-valid" type="checkbox" id="coupon_create" >
										<label for="coupon_create" class="custom-control-label is-valid">Create</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-warning" type="checkbox" id="coupon_update">
										<label for="coupon_update" class="custom-control-label is-warning">Update</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-invalid" type="checkbox" id="coupon_delete" >
										<label for="coupon_delete" class="custom-control-label is-invalid">Delete</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Campaign -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="nav-icon fas fa-hourglass"></i>
							Campaign
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<!-- checkbox -->
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="campaign_view">
										<label for="campaign_view" class="custom-control-label">View</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-valid" type="checkbox" id="campaign_create" >
										<label for="campaign_create" class="custom-control-label is-valid">Create</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-warning" type="checkbox" id="campaign_update">
										<label for="campaign_update" class="custom-control-label is-warning">Update</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-invalid" type="checkbox" id="campaign_delete" >
										<label for="campaign_delete" class="custom-control-label is-invalid">Delete</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Finance -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="nav-icon fas fa-chart-line"></i>
							Finance & Revenue Data
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<!-- checkbox -->
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="finance_view">
										<label for="finance_view" class="custom-control-label">View</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-valid" type="checkbox" id="finance_create" >
										<label for="finance_create" class="custom-control-label is-valid">Create</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-warning" type="checkbox" id="finance_update">
										<label for="finance_update" class="custom-control-label is-warning">Update</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input is-invalid" type="checkbox" id="finance_delete" >
										<label for="finance_delete" class="custom-control-label is-invalid">Delete</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Image Upload -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="nav-icon fas fa-images"></i>
							Image Upload
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="image_upload_notification">
										<label for="image_upload_notification" class="custom-control-label">Notification</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="image_upload_inapp" >
										<label for="image_upload_inapp" class="custom-control-label">In-App</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>
</section>


<script>

$('#navlink_permissions').addClass('active');
$('.loading').addClass('d-none');

$('#ddl_user').change(function(e) {
	$.ajax({
		url: "<?= base_url('permission/get_user_permission_list') ?>",
		type: "POST",
		data: {
			username: $('#ddl_user').val()
		},
		beforeSend: function( data ) {
			$('#loader_div').removeClass('d-none');
		},
		success: function(data){
			$('#loader_div').addClass('d-none');
			data = JSON.parse(data);
			// console.log(data);
			if (data) {
				// for (var item in data) {
				// 	$('#'+item).attr('checked', false);
				// }
				for (var item in data) {
					$('#'+item).prop('checked', Boolean(Number(data[item])));
				}
				$('#blocks').removeClass('d-none');
			} else {
				Swal.fire("User Not Fount!", "Please, contact developer-team to update user-permission table.", "warning");
				$('#blocks').addClass('d-none');
			}
		},
		error: function(err) {
			console.log(err);
		}
	});

});

$(":checkbox").change(function(e) {
	$.ajax({
		url: "<?= base_url('permission/update_user_permission') ?>",
		type: "POST",
		data: {
			username: $('#ddl_user').val(),
			field: this.id,
			value: $('#'+this.id).is(':checked') ? '1' : '0',
		},
		success: function(data) {
			console.log(data);
			if (data == 1) {
	            toastr.success('Permission changed successfully')
			} else {
	            toastr.success('Oops.. Something went wrong!')
			}
		},
		error: function(err) {
			console.log(err);
		}
	});

});
</script>
