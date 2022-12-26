
<div class="content-header">
    <div class="container-fluid">


		<div class="row">
	        <div class="col-sm-4">
	            <div class="top-campaign">
					<div class="card">
						<div class="card-body">
			                <h4 style="text-align:center">Top Downloaded Free Books on <?= $date ?></h3>
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
			                            foreach ($topfreebooks as $key => $row) {
			                            $sl++;
			                            ?>
			                            <tr>
                                            <td style="text-align:left"><?= 1+(int)$key;?></td>
			                                <td style="text-align:left">
                                                <a href="javascript:void(0)">
                                                    <?= $row['bookname_bn'];?>
                                                </a>
                                            </td>
			                                <td style="text-align:right"><?= $row['count'];?></td>
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
