<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">

.bg-maintenance {
    background-image: url("<?= base_url(); ?>images/maintenance.gif");
    height: 100%;
    width: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.table th {
    vertical-align: middle;
    /* font-size: 1rem; */
    font-weight: 800;
    /* text-align: center; */
}

.table td {
    vertical-align: middle;
    /* font-size: 0.8rem; */
    font-weight: 400;
    /* text-align: center; */
}

.body {
    font-size: 1rem;
}

.capitalize {
    text-transform: capitalize;
}

.img-border {
    border: 1px solid #c1c1c1;
    border-radius: .25rem;
}
/* LOADER CSS STARTS HERE*/
/* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 1037;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 40;
  left: 200;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, 1));

  background: -webkit-radial-gradient(rgba(222, 226, 230,1), rgba(222, 226, 230,1));
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 150ms infinite linear;
  -moz-animation: spinner 150ms infinite linear;
  -ms-animation: spinner 150ms infinite linear;
  -o-animation: spinner 150ms infinite linear;
  animation: spinner 150ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
/* LOADER CSS ENDS HERE*/

</style>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Boighor CMS | <?= $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="<?= base_url(); ?>images/favicon.png" rel="icon">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url(); ?>plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url(); ?>dist/css/adminlte.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>dist/css/uienlarge.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


	<!-- jQuery -->
	<script src="<?= base_url(); ?>plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?= base_url(); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="<?= base_url(); ?>plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url(); ?>dist/js/adminlte.js"></script>


    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.6/css/rowReorder.dataTables.min.css">
    <!-- DataTables -->
    <script src="<?= base_url(); ?>plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?= base_url(); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url(); ?>plugins/datatables/dataTables.rowReorder.min.js"></script>
	<!-- Tagify -->
    <link rel="stylesheet" href="<?= base_url(); ?>dist/css/tagify.css">
    <script src="<?= base_url(); ?>dist/js/tagify.js"></script>

    <!-- SweetAlert2 -->
    <!-- <link rel="stylesheet" href="<?php //echo base_url(); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"> -->
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/sweetalert2/sweetalert2.min.css">
    <!-- <link rel="stylesheet" href="@sweetalert2/theme-material-ui/material-ui.css"> -->
    <script src="<?= base_url(); ?>plugins/sweetalert2/sweetalert2.min.js"></script>


    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <script src="<?= base_url(); ?>plugins/select2/js/select2.full.min.js"></script>
    <!-- uModal -->
    <script src="<?= base_url();?>plugins/umodal/umodal.js"></script>
    <link href="<?= base_url();?>plugins/umodal/umodal.css" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url();?>plugins/toastr/toastr.min.css">
    <script src="<?= base_url();?>plugins/toastr/toastr.min.js"></script>
    <!-- CARTS -->
    <script src="<?= base_url();?>plugins/chart.js/Chart.min.js"></script>
    <!-- Venn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
    <script src="https://cdn.rawgit.com/benfred/venn.js/master/venn.js"></script>

	<!-- DataTables Export CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
	<!-- DataTables Export JS -->
    <script src="<?=base_url()?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

    <!-- CKEditor 4 -->
    <script src="<?= base_url('plugins/ckeditor/ckeditor.js');?>"></script>
    <script src="<?= base_url('plugins/ckfinder/ckfinder.js');?>"></script>

    <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/cms.css">
</head>
<!-- <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse"> -->
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

    <div class="loading">Loading&#8230;</div>
	<div class="wrapper">

		<!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" style="padding-top: 12px;" href="#"><i class="fas fa-bars"></i></a>
				</li>
				<!-- <li class="nav-item d-none d-sm-inline-block">
					<a href="<?= base_url(); ?>dashboard" class="nav-link pt-2">Home</a>
				</li> -->
                <li>
                    <!-- <div class="input-group input-group-sm pt-1">
    					<input id="txt_search" class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
    					<div class="input-group-append">
    						<button id="btn_nav_search" class="btn btn-navbar" type="submit">
    							<i class="fas fa-search"></i>
    						</button>
    					</div>
    				</div> -->
                </li>
			</ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="<?= base_url() ?>dashboard" class="nav-link m-0" data-toggle="tooltip" data-original-title="Dashboard"><i class="fas fa-tachometer-alt pt-1"></i></a>
                </li>
                <?php if ($_SESSION['permissions']->book_view) { ?>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>book/booklist" class="nav-link m-0" data-toggle="tooltip" data-original-title="Books"><i class="fas fa-book pt-1"></i></a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['permissions']->author_view) { ?>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>author/authorlist" class="nav-link m-0" data-toggle="tooltip" data-original-title="Authors"><i class="fas fa-user-edit pt-1"></i></a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['permissions']->curation_view) { ?>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>curation/boighor" class="nav-link m-0" data-toggle="tooltip" data-original-title="Curation"><i class="fas fa-sitemap pt-1"></i></a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['permissions']->bi_view) { ?>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>user/boighorglobal" class="nav-link m-0" data-toggle="tooltip" data-original-title="Users"><i class="fas fa-user pt-1"></i></a>
                    </li>
                <?php } ?>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="btn_refresh" class="nav-link text-primary" data-toggle="tooltip" href="javascript:void(0)" onclick="location.reload()" title="" data-original-title="Reload">
                        <!-- Refresh  -->
                        <i class="fas fa-sync pt-1"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a id="btn_logout" class="nav-link text-danger" data-toggle="tooltip" href="javascript:void(0)" title="" data-original-title="Sign Out">
                        <!-- Sign Out  -->
                        <i class="fas fa-sign-out-alt fa-lg pt-1"></i>
                    </a>
                </li>
            </ul>
        </nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="<?= base_url(); ?>" class="brand-link">
				<img src="<?= base_url(); ?>images/ic-login.png" alt="AdminLTE Logo" class="img-circle brand-image elevation-3"
				style="opacity: .8">
				<span class="brand-text font-weight-light">Boighor CMS</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="<?= base_url(); ?>dist/img/default-user.jpg" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="#" class="d-block"><?= $userinfo['name'] ? ucfirst($userinfo['name']) : ucfirst($userinfo['username']); ?></a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>" name="navlink" id="navlink_dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <?php if ($_SESSION['permissions']->book_view) { ?>
                            <li id="navlink_books" class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Books
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>book/addnew" name="navlink" id="navlink_newbook" class="nav-link">
                                            <i class="far fa-circle nav-icon text-success"></i>
                                            <p>Add New Book</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>book/booklist" name="navlink" id="navlink_booklist" class="nav-link">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>Book List</p>
                                        </a>
                                    </li>
                                    <?php if ($_SESSION['permissions']->book_create) { ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url(); ?>book/addnewscope" name="navlink" id="navlink_newbook_scope" class="nav-link">
                                                <i class="far fa-circle nav-icon text-danger"></i>
                                                <p>Book Scopes</p>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['permissions']->author_view) { ?>
                            <li id="navlink_authors" class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user-edit"></i>
                                    <p>
                                        Authors
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>author/addnew" name="navlink" id="navlink_newauthor" class="nav-link">
                                            <i class="far fa-circle nav-icon text-success"></i>
                                            <p>Add New Author</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>author/authorlist" name="navlink" id="navlink_authorlist" class="nav-link">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>Author List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['permissions']->publisher_view) { ?>
                            <li class="nav-item">
                                <a href="<?= base_url('publisher'); ?>" class="nav-link" id="navlink_publisher">
                                    <i class="nav-icon fas fa-copyright"></i>
                                    <p>Publishers</p>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['permissions']->pricing_view) { ?>
                            <li id="navlink_pricing" class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-dollar-sign"></i>
                                    <p>Book Pricing<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('price/bulkedit'); ?>" name="navlink" id="navlink_pricing_bulk_update" class="nav-link">
                                            <i class="fas fa-globe nav-icon text-info"></i>
                                            <p>Bulk Price Update</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('price/boighorglobal'); ?>" name="navlink" id="navlink_pricing_global" class="nav-link">
                                            <i class="fas fa-globe nav-icon text-info"></i>
                                            <p>Boighor</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('price/gpboimela'); ?>" name="navlink" id="navlink_pricing_gp" class="nav-link">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>GP Boimela</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['permissions']->category_view) { ?>

                            <li class="nav-header">CLASSIFICATION</li>

                            <li class="nav-item">
                                <a href="<?= base_url(); ?>book/category" name="navlink" id="navlink_category" class="nav-link">
                                    <i class="fas fa-icons nav-icon"></i>
                                    <p>Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url(); ?>book/genre" name="navlink" id="navlink_genre" class="nav-link">
                                    <i class="fas fa-theater-masks nav-icon"></i>
                                    <p>Genres</p>
                                </a>
                            </li>

                        <?php } ?>

                        <li class="nav-header">CURATION</li>
                        <?php if ($_SESSION['permissions']->curation_view) { ?>

                            <li id="navlink_curation" class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-sitemap"></i>
                                    <p>Home UI</p>
                                    <i class="right fas fa-angle-left"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('curation/gp'); ?>" name="navlink" id="navlink_curation_gp" class="nav-link">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>GP Boimela</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('curation/boighor'); ?>" name="navlink" id="navlink_curation_global" class="nav-link">
                                            <i class="fas fa-globe nav-icon text-info"></i>
                                            <p>Boighor</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('curation/blink'); ?>" name="navlink" id="navlink_curation_blink" class="nav-link">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>BanglaLink Boighor</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('curation/robi'); ?>" name="navlink" id="navlink_curation_robi" class="nav-link">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>Robi Boighor</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('curation/airtel'); ?>" name="navlink" id="navlink_curation_airtel" class="nav-link">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>Airtel Pocketbook</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['permissions']->banner_view) { ?>
                            <li id="navlink_banners" class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-images"></i>
                                    <p>Spotlight<i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('curation/banner/airtel'); ?>" name="navlink" id="navlink_banner_airtel" class="nav-link">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>Airtel Pocketbook</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>curation/banner/blink" name="navlink" id="navlink_banner_blink" class="nav-link">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>BanglaLink Boighor</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>curation/banner/global" name="navlink" id="navlink_banner_global" class="nav-link">
                                            <i class="fas fa-globe nav-icon text-info"></i>
                                            <p>Boighor</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>curation/banner/gp" name="navlink" id="navlink_banner_gp" class="nav-link">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>GP Boimela</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url(); ?>curation/banner/robi" name="navlink" id="navlink_banner_robi" class="nav-link">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>Robi Boighor</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['permissions']->bi_view) { ?>
                            <li class="nav-header">REPORTS</li>
                            <li class="nav-item">
                                <a href="<?= base_url('report/boighor/sales'); ?>" name="navlink" id="navlink_report_sales" class="nav-link">
                                    <i class="fas fa-funnel-dollar nav-icon"></i>
                                    <p>Summary Report</p>
                                </a>
                            </li>
                        <?php } ?>


                        <?php if ($_SESSION['permissions']->feedback_view) { ?>
                            <li class="nav-header">ENGAGEMENT</li>
                            <li id="navlink_reviewapproval" class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-comments"></i>
                                    <p>Comments on Book<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('review/boighorglobal'); ?>" name="navlink" id="navlink_reviewapproval_global" class="nav-link">
                                            <i class="fas fa-globe nav-icon text-info"></i>
                                            <p>Boighor</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['permissions']->feedback_view) { ?>
                            <li id="navlink_feedback" class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-comment-medical"></i>
                                    <p>
                                        Feedback/Complains
                                        <i class="right fas fa-angle-left"></i>
                                        <!-- <span class="badge badge-warning right">sdkfh</span> -->
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('feedback/boighorglobal'); ?>" name="navlink" id="navlink_feedback_boighorglobal" class="nav-link">
                                            <i class="fas fa-globe nav-icon text-info"></i>
                                            <p>
                                                Boighor
                                                <!-- <span class="badge badge-warning right">sdkfh</span> -->
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['permissions']->feedback_view) { ?>
                            <li id="navlink_refund" class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-bomb"></i>
                                    <p>
                                        Refund Request
                                        <i class="right fas fa-angle-left"></i>
                                        <!-- <span class="badge badge-warning right">sdkfh</span> -->
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('refund/boighorglobal'); ?>" name="navlink" id="navlink_refund_boighorglobal" class="nav-link">
                                            <i class="fas fa-globe nav-icon text-info"></i>
                                            <p>
                                                Boighor
                                                <!-- <span class="badge badge-warning right">sdkfh</span> -->
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if (isset($_SESSION['permissions']->ugc_view) && $_SESSION['permissions']->ugc_view) { ?>
                            <li id="navlink_ugc" class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-pen-alt"></i>
                                    <p>UGC<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('ugc/boighorglobal'); ?>" name="navlink" id="navlink_ugc_boighorglobal" class="nav-link">
                                            <i class="fas fa-globe nav-icon text-info"></i>
                                            <p>Boighor</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>


                        <?php if ($_SESSION['permissions']->quote_view) { ?>
                            <li class="nav-header">MISCELLANEOUS</li>
                            <li class="nav-item">
                                <a href="<?= base_url('quote'); ?>" class="nav-link" id="navlink_quote">
                                    <i class="nav-icon fas fa-quote-right"></i>
                                    <p>Quotes</p>
                                </a>
                            </li>
                        <?php } ?>


                        <?php if ($_SESSION['permissions']->bi_view) { ?>
                            <li id="navlink_report_gp" class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-sim-card"></i>
                                    <p>BI & Analysis (Gp)<i class="right fas fa-angle-left"></i></p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('report/gp/sales'); ?>" name="navlink" id="navlink_report_sales_gp" class="nav-link">
                                            <i class="fas fa-dollar-sign nav-icon text-info"></i>
                                            <p>Sales</p>
                                        </a>
                                    </li>
                                </ul>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('report/gp/subscription'); ?>" name="navlink" id="navlink_report_subscription_gp" class="nav-link">
                                            <i class="fas fa-redo nav-icon text-info"></i>
                                            <p>Subscription</p>
                                        </a>
                                    </li>
                                </ul>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('report/gp/adb'); ?>" name="navlink" id="navlink_report_adb_mou_gp" class="nav-link">
                                            <i class="fas fa-headphones nav-icon text-info"></i>
                                            <p>ADB Usage</p>
                                        </a>
                                    </li>
                                </ul>


                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['permissions']->bi_view) { ?>
                            <li id="navlink_report" class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-globe-asia"></i>
                                    <p>BI & Analysis (Boighor)<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('report/boighor/topcharts'); ?>" name="navlink" id="navlink_report_topcharts" class="nav-link">
                                            <i class="fas fa-list-ol nav-icon text-info"></i>
                                            <p>Top Charts</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('report/boighor/charts'); ?>" name="navlink" id="navlink_report_charts" class="nav-link">
                                            <i class="fas fa-chart-bar nav-icon text-info"></i>
                                            <p>Charts</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('report/boighor/adb'); ?>" name="navlink" id="navlink_report_adb_mou" class="nav-link">
                                            <i class="fas fa-headphones nav-icon text-info"></i>
                                            <p>ADB Usage</p>
                                        </a>
                                    </li>
                                </ul>
                                <?php if ($_SESSION['permissions']->campaign_view) { ?>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?= base_url('campaign'); ?>" name="navlink" id="navlink_report_campaign" class="nav-link">
                                                <i class="fas fa-hourglass nav-icon text-info"></i>
                                                <p>Campaign Report</p>
                                            </a>
                                        </li>
                                    </ul>
                                <?php } ?>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('report/boighor/invoice'); ?>" name="navlink" id="navlink_report_invoice" class="nav-link">
                                            <i class="fas fa-file-invoice nav-icon text-info"></i>
                                            <p>Invoice</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('report/boighor/sales'); ?>" name="navlink" id="navlink_report_sales" class="nav-link">
                                            <i class="fas fa-funnel-dollar nav-icon text-info"></i>
                                            <p>Sales</p>
                                        </a>
                                    </li>
                                </ul>
                                <!-- <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('report/boighor/orders'); ?>" name="navlink" id="navlink_report_orders" class="nav-link">
                                            <i class="fas fa-shopping-cart nav-icon text-info"></i>
                                            <p>Orders</p>
                                        </a>
                                    </li>
                                </ul> -->
                                <?php if (!empty($_SESSION['permissions']->finance_view)) { ?>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?= base_url('report/boighor/revenue'); ?>" name="navlink" id="navlink_report_revenue" class="nav-link">
                                                <i class="fas fa-chart-line nav-icon text-info"></i>
                                                <p>Revenue Share Report</p>
                                            </a>
                                        </li>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['permissions']->bi_view) { //coupon ?>
                            <li id="navlink_report" class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-area"></i>
                                    <p>Manage Coupon<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('coupon'); ?>" name="navlink" id="navlink_coupon_index" class="nav-link">
                                            <i class="fas fa-list-ol nav-icon text-info"></i>
                                            <p>Coupon</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('report/sales'); ?>" name="navlink" id="navlink_report_sales" class="nav-link">
                                            <i class="fas fa-funnel-dollar nav-icon text-info"></i>
                                            <p>Coupon Usage</p>
                                        </a>
                                    </li>
                                </ul>

                            </li>
                        <?php } ?>

                        <?php if (!empty($_SESSION['permissions']->image_upload_notification) || !empty($_SESSION['permissions']->image_upload_inapp)) { ?>
                            <li class="nav-header">IMAGE UPLOAD</li>
                        <?php } ?>

                        <?php if (!empty($_SESSION['permissions']->image_upload_notification)) { ?>
                            <li class="nav-item">
                                <a href="<?= base_url("notification-image") ?>" name="navlink" id="navlink_notification_image" class="nav-link">
                                    <i class="nav-icon fas fa-images"></i>
                                    <p>Notification Image</p>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (!empty($_SESSION['permissions']->image_upload_inapp)) { ?>
                            <li class="nav-item">
                                <a href="<?= base_url("in-app-image") ?>" name="navlink" id="navlink_in_app_image" class="nav-link">
                                    <i class="nav-icon fas fa-images"></i>
                                    <p>In-App Image</p>
                                </a>
                            </li>
                        <?php } ?>


                        <?php if ($_SESSION['permissions']->bi_view) { ?>
                            <li class="nav-header">ADMIN CONTROLS</li>
                            <li class="nav-item">
                                <a href="<?= base_url()."dashboard/timeline/".($userinfo['level']==6 ? 'all' : $userinfo['username'])."/".date_format(date_create(),"Y-m-d"); ?>" name="navlink" id="navlink_timeline" class="nav-link">
                                    <i class="nav-icon fas fa-clock"></i>
                                    <p>Timeline</p>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['permissions']->bi_view) { ?>
                            <li id="navlink_userlist" class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>User List<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('user/boighorglobal'); ?>" name="navlink" class="nav-link" id="navlink_userlist_boighorglobal">
                                            <i class="fas fa-globe nav-icon text-info"></i>
                                            <p>Boighor</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('legal'); ?>" class="nav-link" name="navlink" id="navlink_legalinfo">
                                    <i class="nav-icon fas fa-balance-scale-right"></i>
                                    <p>Legal Informations</p>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($userinfo['username'] == 'shuvodeep' || $userinfo['username'] == 'zahid' || $userinfo['username'] == 'rajuwan' || $userinfo['username'] == 'mynul' || $userinfo['username'] == 'prolay' || $userinfo['username'] == 'ripon') { ?>

                            <li class="nav-item">
                                <a href="<?= base_url('permission'); ?>" class="nav-link" name="navlink" id="navlink_permissions">
                                    <i class="nav-icon fas fa-lock"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('remote-config'); ?>" class="nav-link" name="navlink" id="navlink_remoteconfig">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>Remote Configuaration</p>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['permissions']->bi_create) { ?>
                            <li id="navlink_manual_subscription" class="nav-item">
                                <a href="<?= base_url('manualsubscription'); ?>" class="nav-link">
                                    <i class="nav-icon fas fa-user-plus"></i>
                                    <p>Manual Subscription</p>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($userinfo['username'] == 'shuvodeep' || $userinfo['username'] == 'zahid' || $userinfo['username'] == 'rajuwan' || $userinfo['username'] == 'nirob') { ?>

                            <li class="nav-header">LOGS</li>

                            <li class="nav-item">
                                <a href="<?= base_url('devlog/apilog'); ?>" class="nav-link" name="navlink" id="navlink_apilog_boighorglobal">
                                    <i class="nav-icon fas fa-lock"></i>
                                    <p>Boighor - Api Log</p>
                                </a>
                            </li>

                            <!-- <li class="nav-item">
                                <a href="<?//= base_url('devlog/weblog'); ?>" class="nav-link" name="navlink" id="navlink_weblog_boighorglobal">
                                    <i class="nav-icon fas fa-lock"></i>
                                    <p>Boighor - Website Log</p>
                                </a>
                            </li> -->

                            <li class="nav-item">
                                <a href="<?= base_url('devlog/cmslog'); ?>" class="nav-link" name="navlink" id="navlink_cmslog">
                                    <i class="nav-icon fas fa-lock"></i>
                                    <p>Boighor - CMS Log</p>
                                </a>
                            </li>

                        <?php } ?>

                    </ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<div class="content-header p-0">
			    <div class="container-fluid p-2">
					<?= $content; ?>
				</div>
			</div>
		</div>
		<!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; <?= date('Y') ?> <a href="http://ebsbd.com">E. B. Solutions Ltd.</a></strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

<script type="text/javascript">

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $('.select2').select2({
        theme: 'bootstrap4',
        placeholder: "Select",
        allowClear: true
    });
});

    if( $(".content-wrapper").width()<=1366 ) {
        // $('body').addClass('sidebar-collapse');
    }

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });

    $('#btn_logout').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Do you want to logout?',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                document.location = "<?= base_url(); ?>login/logout";
            }
        });
    });

    $('#btn_nav_search').on('click', function(e) {
        if ('<?= $userinfo['level'] == 6 ?>') {
            document.location = "<?= base_url()."dashboard/search/" ?>"+$('#txt_search').val();
        }
    })

    // $('[data-toggle="tooltip"]').tooltip();
// $(document).ready(function(){
//   $('[data-toggle="tooltip"]').tooltip();
// });


function pleaseWait() {
	Swal.fire({
        title: 'Please Wait...',
        // type: 'warning',
        html: '<label id="progress_label">Progress: 0%</label><progress id="progress" class="progress-bar bg-primary progress-bar-striped progress-bar-animated pb-3 mb-3" max="100" style="width:0%; height:100%"></progress>',
        showConfirmButton: false,
        showCloseButton: false,
        showCancelButton: false,
        allowOutsideClick: false,
		onBeforeOpen: () => {
			Swal.showLoading()
		},
	});
}
function somethingWentWrong() {
	Swal.fire({
		title: 'Oops.. Something went wrong!',
		type: 'error',
	}).then((data) => {
		location.reload();
	});
}
function accessDenied() {
	Swal.fire({
		title: 'Sorry, You do not have permission.',
		type: 'error',
	}).then((data) => {
		location.reload();
	});
}
function sessionExpired() {
	Swal.fire({
		title: 'Session Expired',
		text: 'Please, login again.',
		type: 'warning',
	}).then((data) => {
		window.location.href = "<?=base_url()?>";
	});
}
function taskComplete(shouldReload = false) {
	Swal.fire({
		title: 'Successful',
		type: 'success',
	}).then((data) => {
		if (shouldReload) {
			location.reload();
		}
	});
}
function taskCompleteTimer(shouldReload = false) {
	Swal.fire({
		title: 'Successful',
		type: 'success',
		showConfirmButton: false,
		timer: 1000
	}).then((data) => {
		if (shouldReload) {
			location.reload();
		}
	});
}

function handle_progress() {
	var xhr = new window.XMLHttpRequest();
	xhr.upload.addEventListener("progress", function(evt) {
		if (evt.lengthComputable) {
			var percentComplete = (evt.loaded / evt.total) * 100;
			$('#progress').width(percentComplete.toFixed(2)+'%');
			$('#progress_label').text('Progress: '+percentComplete.toFixed(2)+'%');
		}
	}, false);
	return xhr;
}

function eng_to_bng(number) {
    number = String(number);
    number = number.replaceAll("0", "০");
    number = number.replaceAll("1", "১");
    number = number.replaceAll("2", "২");
    number = number.replaceAll("3", "৩");
    number = number.replaceAll("4", "৪");
    number = number.replaceAll("5", "৫");
    number = number.replaceAll("6", "৬");
    number = number.replaceAll("7", "৭");
    number = number.replaceAll("8", "৮");
    number = number.replaceAll("9", "৯");
    return number;
}

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).val()).select();
    document.execCommand("copy");
    $temp.remove();
    if (element=="#fcmid") {
        toastr.info('Push Notification ID Copied');
    } else if (element=="#inappid") {
        toastr.info('In-App Messaging ID Copied');
    } else if (element=="#deviceid") {
        toastr.info('Device ID Copied');
    }
}

</script>

</body>
</html>
