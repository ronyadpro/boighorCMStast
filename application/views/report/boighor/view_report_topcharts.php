<div class="content-header">
    <div class="container-fluid">
		<div class="row">

	        <div class="col-sm-3">
	            <div class="top-campaign">
					<div class="card">
						<div class="card-body">
			                <h4 style="text-align:center">Top Users</h3>
			                <div class="table-responsive">
			                    <table class="table table-sm">
                                    <thead>
                                        <th style="text-align:left"><b>SL</b></th>
                                        <th style="text-align:left"><b>Name</b></th>
                                        <th style="text-align:right"><b>Count</b></th>
                                    </thead>
			                        <tbody>
			                          <?php
			                            $sl = 0;
			                            foreach ($topusers as $key => $row) {
			                            $sl++;
			                            ?>
			                            <tr>
                                            <td style="text-align:left"><?= 1+(int)$key;?></td>
			                                <td style="text-align:left">
                                                <a href="<?= base_url()."user/overview/".$row['msisdn'] ?>">
                                                    <?= $row['msisdn'];?>
                                                </a>
                                            </td>
			                                <td style="text-align:right"><?= $row['totalcount'];?></td>
			                            </tr>
			                            <?php
			                            }
			                          ?>
			                        </tbody>
			                    </table>
			                </div>
						</div>
					</div>
	            </div>
	        </div>

	        <div class="col-sm-3">
	            <div class="top-campaign">
					<div class="card">
						<div class="card-body">
			                <h4 style="text-align:center">Polular Writers</h3>
			                <div class="table-responsive">
			                    <table class="table table-sm">
                                    <thead>
                                        <th style="text-align:left"><b>SL</b></th>
                                        <th style="text-align:left"><b>Name</b></th>
                                        <th style="text-align:right"><b>Count</b></th>
                                    </thead>
			                        <tbody>
			                          <?php
			                            $sl = 0;
			                            foreach ($popularwriters as $key => $row) {
			                            $sl++;
			                            ?>
			                            <tr>
                                            <td style="text-align:left"><?= 1+(int)$key;?></td>
			                                <td style="text-align:left">
                                                <a href="<?= base_url()."author/overview/".$row['writercode'] ?>">
                                                    <?= $row['writer_bn'];?>
                                                </a>
                                            </td>
			                                <td style="text-align:right"><?= $row['totalcount'];?></td>
			                            </tr>
			                            <?php
			                            }
			                          ?>
			                        </tbody>
			                    </table>
			                </div>
						</div>
					</div>
	            </div>
	        </div>

	        <div class="col-sm-3">
	            <div class="top-campaign">
					<div class="card">
						<div class="card-body">
			                <h4 style="text-align:center">Top Purchases</h3>
			                <div class="table-responsive">
			                    <table class="table table-sm">
                                    <thead>
                                        <th style="text-align:left"><b>SL</b></th>
                                        <th style="text-align:left"><b>Name</b></th>
                                        <th style="text-align:right"><b>Count</b></th>
                                    </thead>
			                        <tbody>
			                          <?php
			                            $sl = 0;
			                            foreach ($toppurchase as $key => $row) {
			                            $sl++;
			                            ?>
			                            <tr>
                                            <td style="text-align:left"><?= 1+(int)$key;?></td>
			                                <td style="text-align:left">
                                                <a href="<?= base_url()."book/overview/".$row['bookcode'] ?>">
                                                    <?= $row['bookname'];?>
                                                </a>
                                            </td>
			                                <td style="text-align:right"><?= $row['totalcount'];?></td>
			                            </tr>
			                            <?php
			                            }
			                          ?>
			                        </tbody>
			                    </table>
			                </div>
			            </div>
					</div>
	            </div>
	            <!-- END TOP CAMPAIGN-->
	        </div>

	        <!-- <div class="col-sm-3">
	            <div class="top-campaign">
					<div class="card">
						<div class="card-body">
			                <h4 style="text-align:center">Top Downloads</h3>
			                <div class="table-responsive">
			                    <table class="table table-sm">
                                    <thead>
                                        <th style="text-align:left"><b>SL</b></th>
                                        <th style="text-align:left"><b>Name</b></th>
                                        <th style="text-align:right"><b>Count</b></th>
                                    </thead>
			                        <tbody>
			                          <?php
			                            $sl = 0;
			                            foreach ($topbooks as $key => $row) {
			                            $sl++;
			                            ?>
			                            <tr>
                                            <td style="text-align:left"><?= 1+(int)$key;?></td>
			                                <td style="text-align:left">
                                                <a href="<?= base_url()."book/overview/".$row['bookcode'] ?>">
                                                    <?= $row['nametoshow'];?>
                                                </a>
                                            </td>
			                                <td style="text-align:right"><?= $row['totalcount'];?></td>
			                            </tr>
			                            <?php
			                            }
			                          ?>
			                        </tbody>
			                    </table>
			                </div>
						</div>
					</div>
	            </div>
	        </div> -->

	        <div class="col-sm-3">
	            <div class="top-campaign">
					<div class="card">
						<div class="card-body">
			                <h4 style="text-align:center">Free Book Downloads</h3>
			                <div class="table-responsive">
			                    <table class="table table-sm">
                                    <thead>
                                        <th style="text-align:left"><b>SL</b></th>
                                        <th style="text-align:left"><b>Date</b></th>
                                        <th style="text-align:right"><b>Count</b></th>
                                    </thead>
			                        <tbody>
			                          <?php
			                            $sl = 0;
			                            foreach ($freedownloads as $key => $row) {
			                            $sl++;
			                            ?>
			                            <tr>
                                            <td style="text-align:left"><?= 1+(int)$key;?></td>
			                                <td style="text-align:left">
                                                <a href="<?= base_url()."report/boighor/topcharts/freebookdownloads/".$row['date_no'] ?>">
                                                    <?= $row['date_no'];?>
                                                </a>
                                            </td>
			                                <td style="text-align:right"><?= $row['totalcount'];?></td>
			                            </tr>
			                            <?php
			                            }
			                          ?>
			                        </tbody>
			                    </table>
			                </div>
						</div>
					</div>
	            </div>
	            <!-- END TOP CAMPAIGN-->
	        </div>
		</div>
    </div>
</div>

<script type="text/javascript">

$('#navlink_report').addClass('menu-open');
$('#navlink_report_topcharts').addClass('active');
$('.loading').addClass('d-none');


</script>
