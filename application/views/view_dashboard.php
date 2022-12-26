<section class="content">
    <div class="container-fluid p-2">
    	<!-- Card Block starts -->
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo $totalbooks; ?></h3>
                                <p>Books</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <a href="<?php echo base_url() ?>book/booklist" class="small-box-footer">See All Books <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo $totalaudiobooks; ?><sup style="font-size: 20px"></sup></h3>
                                <p>Audiobooks</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-headphones-alt"></i>
                            </div>
                            <a href="<?php echo base_url() ?>book/booklist/audiobook" class="small-box-footer">Browse All <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo $totalauthors; ?></h3>
                                <p>Authors</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-edit"></i>
                            </div>
                            <a href="<?php echo base_url() ?>author/authorlist" class="small-box-footer">Author List <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3><?php echo $totalpublishers; ?></h3>
                                <p>Publishers</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <a href="<?= base_url('publisher') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($_SESSION['permissions']->bi_view) { ?>
                <div class="col-lg-6 col-sm-12">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-gradient-purple">
                                <div class="inner">
                                    <h3>৳<?= number_format(ceil(array_sum(array_column($total_sale_amount,'count')))); ?></h3>
                                    <p data-toggle="tooltip" data-original-title="From 18th March 2021">
                                        Lifetime Sale
                                        <sup><i class="fas fa-info-circle fa-xs"></i></sup>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-sm fa-hand-holding-usd"></i>
                                </div>
                                    <a href="<?= base_url('report/boighor/sales#Today') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-gradient-primary">
                                <div class="inner">
                                    <h3>৳<?= ($this_month_sale_amount>9999)? number_format($this_month_sale_amount) : $this_month_sale_amount ?></h3>
                                    <p><?= date('F') ?>'s Sale</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                                <a href="<?= base_url('report/boighor/sales#'.date('F')) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-gradient-danger">
                                <div class="inner">
                                    <h3><?php echo '৳'.$daily_sale_amount[sizeof($daily_sale_amount)-1]['count']; ?></h3>
                                    <p>Today's Sale</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                                <a href="<?= base_url('report/boighor/sales#Today') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 d-none">
                            <?php
                            $sales_count_array = array_column($daily_sale_amount,'count');
                            $this_week_sale = array_sum(array_slice($sales_count_array,sizeof($sales_count_array)-7,7));
                            $last_week_sale = array_sum(array_slice($sales_count_array,sizeof($sales_count_array)-14,7));
                            $net = $this_week_sale-$last_week_sale;
                            ?>
                            <div class="small-box <?= $net<0 ? 'bg-danger' : 'bg-success' ?>">
                                <div class="inner">
                                    <h3><?= $net<0 ? '-'.abs($net) : '+'.abs($net) ?>৳</h3>
                                        <p>Weekly Sales Retention</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <a href="<?= base_url('report/boighor/charts/boighorglobal') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <!-- Card Block ends -->

        <!-- Charts Block starts -->
        <?php if ($_SESSION['permissions']->bi_view) { ?>
        <div class="row">
			<section class="col-sm-4">
				<div class="card card-light">
					<div class="card-header ui-sortable-handle">
                        <a data-toggle="tooltip" data-original-title="Daily number of books sold in past 30 days(Boighor Global only)">
    						<h3 class="card-title">
                                <i class="fas fa-chart-bar mr-1"></i>
                                Daily Sales Quantity
                                <sup><i class="fas fa-info-circle fa-xs text-secondary"></i></sup>
    						</h3>
                        </a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                        </div>
					</div>
                    <div class="card-body p-2">
                        <canvas id="cnv_daily_sale" class="chartjs-render-monitor" style="max-height:500px"></canvas>
					</div>
				</div>
			</section>
			<section class="col-sm-4">
				<div class="card card-light">
					<div class="card-header ui-sortable-handle">
                        <a data-toggle="tooltip" data-original-title="Daily sales amount in past 30 days(Boighor Global only)">
    						<h3 class="card-title">
    							<i class="fas fa-chart-bar mr-1"></i>
    							Daily Sales Amount
                                <sup><i class="fas fa-info-circle fa-xs text-secondary"></i></sup>
    						</h3>
                        </a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                        </div>
					</div>
                    <div class="card-body p-2">
                        <canvas id="cnv_daily_sale_amount" class="chartjs-render-monitor" style="max-height:500px"></canvas>
					</div>
				</div>
			</section>
			<section class="col-sm-4">
				<div class="card card-light">
					<div class="card-header ui-sortable-handle">
                        <a data-toggle="tooltip" data-original-title="Monthly sales amount in past 6 months(Boighor Global only)">
    						<h3 class="card-title">
    							<i class="fas fa-chart-bar mr-1"></i>
    							Month Wise Sale
                                <sup><i class="fas fa-info-circle fa-xs text-secondary"></i></sup>
    						</h3>
                        </a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                        </div>
					</div>
                    <div class="card-body p-2">
                        <canvas id="cnv_monthly_sale_amount" class="chartjs-render-monitor" style="max-height:500px"></canvas>
					</div>
				</div>
			</section>
		</div>
		<!-- Charts Block ends -->

		<!-- Pie/Donut(1) Chart Block starts -->
		<div class="row">
			<div class="col-sm-4">
                <div class="card card-light">
                    <div class="card-header">
                        <a data-toggle="tooltip" data-original-title="Number of books sold in past 30 days(Boighor Global only)">
    						<h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Top Country
                                <sup><i class="fas fa-info-circle fa-xs text-secondary"></i></sup>
    						</h3>
                        </a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- <div class="col-sm-6">
                                <ul id="chrt_legend_category" class="chart-legend clearfix"></ul>
                            </div> -->
                            <div class="col-sm-12">
                                <canvas id="chrt_cat" style="height:350px; min-height:350px"></canvas>
                                <!-- <div id="regions_div"></div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card card-light">
                    <div class="card-header">
                        <a data-toggle="tooltip" data-original-title="Number of books sold in past 30 days(Boighor Global only)">
    						<h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Top Author
                                <sup><i class="fas fa-info-circle fa-xs text-secondary"></i></sup>
    						</h3>
                        </a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 align-middle">
                                <ul id="chrt_legend_author" class="chart-legend clearfix"></ul>
                            </div>
                            <div class="col-sm-6">
                                <canvas id="chrt_author" style="height:350px; min-height:350px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card card-light">
                    <div class="card-header">
                        <a data-toggle="tooltip" data-original-title="Based on number of books sold in past 7 days from Boighor service only">
    						<h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Top Books
                                <sup><i class="fas fa-info-circle fa-xs text-secondary"></i></sup>
    						</h3>
                        </a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 align-middle">
                                <ul id="chrt_legend_book" class="chart-legend clearfix"></ul>
                            </div>
                            <div class="col-sm-6">
                                <canvas id="chrt_book" style="height:350px; min-height:350px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Pie/Donut Chart Block ends -->

        <!-- Pie/Donut Chart(2) Block starts -->
        <div class="row">
        	<!-- <div class="col-sm-3">
                <div class="card card-light">
                    <div class="card-header">
                        <a data-toggle="tooltip" data-original-title="Based on number of books sold today from Boighor service only">
    						<h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Purchase Rate
                                <sup><i class="fas fa-info-circle fa-xs text-secondary"></i></sup>
    						</h3>
                        </a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-6 align-middle">
                                <ul id="chrt_legend_purchase" class="chart-legend clearfix"></ul>
                            </div>
                            <div class="col-sm-6">
                                <canvas id="chrt_order_purchase" style="height:350px; min-height:350px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-sm-4">
                <div class="card card-light">
                    <div class="card-header">
                        <a data-toggle="tooltip" data-original-title="Based on number of books sold in past 30 days from Boighor service only">
    						<h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Popular Payment
                                <sup><i class="fas fa-info-circle fa-xs text-secondary"></i></sup>
    						</h3>
                        </a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 align-middle">
                                <ul id="chrt_legend_paymethod" class="chart-legend clearfix"></ul>
                            </div>
                            <div class="col-sm-6">
                                <canvas id="chrt_paymethod" style="height:350px; min-height:350px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card card-light">
                    <div class="card-header">
                        <a data-toggle="tooltip" data-original-title="Based on sign up in past 30 days from Boighor service only">
    						<h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Top Platform
                                <sup><i class="fas fa-info-circle fa-xs text-secondary"></i></sup>
    						</h3>
                        </a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 align-middle">
                                <ul id="chrt_legend_platform" class="chart-legend clearfix"></ul>
                            </div>
                            <div class="col-sm-6">
                                <canvas id="chrt_platform" style="height:350px; min-height:350px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card card-light">
                    <div class="card-header">
                        <a data-toggle="tooltip" data-original-title="Based on number of books sold in past 7 days from Boighor service only">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Top Genre
                                <sup><i class="fas fa-info-circle fa-xs text-secondary"></i></sup>
                            </h3>
                        </a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul id="chrt_legend_genre" class="chart-legend clearfix"></ul>
                            </div>
                            <div class="col-sm-6">
                                <canvas id="chrt_gen" style="height:350px; min-height:350px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
        <!-- Pie/Donut Chart Block ends -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-light">
                    <div class="card-header ui-sortable-handle">
                        <h3 class="card-title">
                            <i class="fas fa-list mr-1"></i>
                            Latest Uploads
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0" bis_skin_checked="1">
                        <table class="table table-sm">
                            <thead>
                                <tr class="bg-light">
                                    <th style="width: 10px"><b>#</b></th>
                                    <th><b>Book</b></th>
                                    <th><b>Writer</b></th>
                                    <th><b>Type</b></th>
                                    <th><b>Category</b></th>
                                    <th><b>Publisher</b></th>
                                    <th><b>Status</b></th>
                                    <th><b>LiveTime</b></th>
                                    <th><b>LiveBy</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($latest_uploads as $idx => $content): ?>
                                    <tr>
                                        <td><?php echo intval($idx)+1 ?></td>
                                        <td><a href="<?= base_url('book/overview') ?>/<?= $content['bookcode'] ?>" target=""><?= $content['bookname_bn'] ?></a></td>
                                        <td><a href="<?= base_url('author/overview') ?>/<?= $content['writercode'] ?>" target=""><?= $content['writer_bn'] ?></a></td>
                                        <td><?= $content['isaudiobook']?'<i class="fas fa-headphones text-info"></i>':'<i class="fas fa-book text-success"></i>' ?></td>
                                        <td><?= $content['category_bn'] ?></td>
                                        <td><?= $content['publisher_bn'] ?: 'বইঘর' ?></td>
                                        <td><span class="badge badge-<?=$content['status_global']?'success':'secondary'?> text-xs"><?=$content['status_global']?'Live':'Offline'?></span></td>
                                        <td><?= $content['livetime'] ?></td>
                                        <td><?= $content['liveby'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-light">
                    <div class="card-header">
                        <a data-toggle="tooltip" data-original-title="Number of books sold in past 30 days(Boighor Global only)">
    						<h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Top Country Map
                                <sup><i class="fas fa-info-circle fa-xs text-secondary"></i></sup>
    						</h3>
                        </a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="regions_div"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Google Chart Starts here -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {
    'packages':['geochart'],
});
google.charts.setOnLoadCallback(drawRegionsMap);

function drawRegionsMap() {
    var data = google.visualization.arrayToDataTable(
        [
            ['Country', 'Purchase'],
            <?php
            foreach ($top_country as $row) {
                echo "['".$row["country"]."', ".$row["count"]."],";
            }
            ?>
        ]
    );

    var options = {
        colorAxis: {colors: category_colors}
    };

    var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

    chart.draw(data, options);
}
</script>
<!-- Google Chart Ends here -->

<script type="text/javascript">
var order_init = 0;
var order_purchase = 0;
$(document).ready(function(){

 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"<?php echo base_url('Dashboard/get_order_details') ?>",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
       if (data.length > 0) {
           order_purchase = data[0]['ordercount'];
           order_init = data[1]['ordercount'];


           var top_purchase = [order_init,order_purchase];
           var top_purchase_lables = ['Ordered',"Sold"];
           var top_purchase_colours = ['#FB8065',"#50AF61"];


           var pieChartCanvas = $('#chrt_order_purchase').get(0).getContext('2d')
           var pieData        = {
               labels: top_purchase_lables,
               datasets: [
                   {
                     data: top_purchase,
                     backgroundColor : top_purchase_colours,
                   }
                 ]

           }
           var donutOptions     = {
               maintainAspectRatio : false,
               responsive : true,
               legend: {
                   display: false
                 }
           }

           var donutChart = new Chart(pieChartCanvas, {
               type: 'pie',
               data: pieData,
               options: donutOptions
           })
            $('#chrt_legend_purchase').html('');
           for (var i = 0; i < top_purchase_lables.length; i++) {
               $('#chrt_legend_purchase').append( "<li><i class='fas fa-circle' style='color:"+top_purchase_colours[i]+"'></i> "+top_purchase_lables[i]+" ("+top_purchase[i]+")</li>" );
           }


       }else {
           $('#chrt_legend_purchase').html('No order created yet');
       }

   }
  });
 }

 // load_unseen_notification();

 // $('#comment_form').on('submit', function(event){
 //  event.preventDefault();
 //  if($('#subject').val() != '' && $('#comment').val() != '')
 //  {
 //   var form_data = $(this).serialize();
 //   $.ajax({
 //    url:"insert.php",
 //    method:"POST",
 //    data:form_data,
 //    success:function(data)
 //    {
 //     $('#comment_form')[0].reset();
 //     load_unseen_notification();
 //    }
 //   });
 //  }
 //  else
 //  {
 //   alert("Both Fields are Required");
 //  }
 // });

 // $(document).on('click', '.dropdown-toggle', function(){
 //  $('.count').html('');
 //  load_unseen_notification('yes');
 // });

//  setInterval(function(){
//   load_unseen_notification();;
// }, 60000);

});

$('#navlink_dashboard').addClass('active');
$('.loading').addClass('d-none');

var genre_colors = ['#f39c12', '#00c0ef', '#3c8dbc', '#f56954', '#d2d6de', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#00a65a'];
var category_colors = ['#28a746', '#4363d8', '#e6194b', '#ffe119', '#3cb44b', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#000075', '#808080', '#ffffff', '#000000'];
var author_colors = ['#17a2b8', '#ffc108', '#28a746', '#f39c12', '#00c0ef'];
// var category_lables = <?php //echo json_encode(array_column($categoryChart, 'catname_en')) ?>;
// var category_counts = <?php //echo json_encode(array_column($categoryChart, 'count')) ?>;
var country_lables = <?php echo json_encode(array_column($top_country, 'country')) ?>;
var country_counts = <?php echo json_encode(array_column($top_country, 'count')) ?>;

var genre_lables = <?php echo json_encode(array_column($top_genre, 'genre_en')) ?>;
var genre_counts = <?php echo json_encode(array_column($top_genre, 'count')) ?>;

var top_author = <?php echo json_encode(array_column($top_author, 'count')) ?>;
var top_author_lables = <?php echo json_encode(array_column($top_author, 'author')) ?>;

var top_book = <?php echo json_encode(array_column($top_book, 'count')) ?>;
var top_book_amount = <?php echo json_encode(array_column($top_book, 'amount')) ?>;
var top_book_lables = <?php echo json_encode(array_column($top_book, 'bookname')) ?>;

var top_paymethod = <?php echo json_encode(array_column($top_paymethod, 'count')) ?>;
var top_paymethod_lables = <?php echo json_encode(array_column($top_paymethod, 'paymentmethod')) ?>;

var top_platform = <?php echo json_encode(array_column($top_platform, 'count')) ?>;
var top_platform_lables = <?php echo json_encode(array_column($top_platform, 'signupfrom')) ?>;



var pieChartCanvas = $('#chrt_cat').get(0).getContext('2d')
var pieData        = {
    labels: country_lables,
    datasets: [
        {
          data: country_counts,
          backgroundColor : category_colors,
        }
      ]

}
var donutOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
        display: false
    }
}

var donutChart = new Chart(pieChartCanvas, {
    type: 'horizontalBar',
    data: pieData,
    options: donutOptions
})

var donutOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
        display: false
    }
}

var donutChartCanvas = $('#chrt_gen').get(0).getContext('2d')
var donutData        = {
    labels: genre_lables,
    datasets: [
        {
          data: genre_counts,
          backgroundColor : genre_colors,
        }
      ]

}
//Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
var donutChart = new Chart(donutChartCanvas, {
    type: 'pie',
    data: donutData,
    options: donutOptions
})


var authorChartCanvas = $('#chrt_author').get(0).getContext('2d')
var priceData = {
    labels: top_author_lables,
    datasets: [
        {
          data: top_author,
          backgroundColor : author_colors,
        }
      ]
}
var authorChart = new Chart(authorChartCanvas, {
    type: 'pie',
    data: priceData,
    options: donutOptions
})

//======
var bookChartCanvas = $('#chrt_book').get(0).getContext('2d')
var bookData = {
    labels: top_book_lables,
    datasets: [
        {
          data: top_book,
          backgroundColor : author_colors,
        }
      ]
}
var bookChart = new Chart(bookChartCanvas, {
    type: 'pie',
    data: bookData,
    options: donutOptions
})

//======
var paymethodChartCanvas = $('#chrt_paymethod').get(0).getContext('2d')
var paymethodData = {
    labels: top_paymethod_lables,
    datasets: [
        {
          data: top_paymethod,
          backgroundColor : author_colors,
        }
      ]
}
var bookChart = new Chart(paymethodChartCanvas, {
    type: 'doughnut',
    data: paymethodData,
    options: donutOptions
})

//======
var paltformChartCanvas = $('#chrt_platform').get(0).getContext('2d')
var paltformData = {
    labels: top_platform_lables,
    datasets: [
        {
          data: top_platform,
          backgroundColor : author_colors,
        }
      ]
}
var bookChart = new Chart(paltformChartCanvas, {
    type: 'doughnut',
    data: paltformData,
    options: donutOptions
})

// for (var i = 0; i < country_lables.length; i++) {
//     $('#chrt_legend_category').append( "<li><i class='fas fa-circle' style='color:"+category_colors[i]+"'></i> "+country_lables[i]+" ("+country_counts[i]+")</li>" );
// }
for (var i = 0; i < genre_lables.length; i++) {
    $('#chrt_legend_genre').append( "<li><i class='fas fa-circle' style='color:"+genre_colors[i]+"'></i> "+genre_lables[i]+" ("+genre_counts[i]+")</li>" );
}
for (var i = 0; i < top_author_lables.length; i++) {
    $('#chrt_legend_author').append( "<li><i class='fas fa-circle' style='color:"+author_colors[i]+"'></i> "+top_author_lables[i]+" ("+top_author[i]+")</li>" );
}
for (var i = 0; i < top_book_lables.length; i++) {
    $('#chrt_legend_book').append( "<li><i class='fas fa-circle' style='color:"+author_colors[i]+"'></i> "+top_book_lables[i]+" ("+top_book[i]+") (৳"+top_book_amount[i]+")</li>" );
}
for (var i = 0; i < top_paymethod_lables.length; i++) {
    $('#chrt_legend_paymethod').append( "<li><i class='fas fa-circle' style='color:"+author_colors[i]+"'></i> "+top_paymethod_lables[i]+" ("+top_paymethod[i]+")</li>" );
}
for (var i = 0; i < top_platform_lables.length; i++) {
    $('#chrt_legend_platform').append( "<li><i class='fas fa-circle' style='color:"+author_colors[i]+"'></i> "+top_platform_lables[i]+" ("+top_platform[i]+")</li>" );
}

function daliy_sale() {

    var cnv_daily_sale = $('#cnv_daily_sale').get(0).getContext('2d');
    var chart = new Chart(cnv_daily_sale, {
        type: 'bar',

        data: {
            labels: <?= json_encode(array_column($daily_sale_book,'date')) ?>,
            datasets: [
                {
                    label: 'Books',
                    backgroundColor: '#0F9D58',
                    borderColor: '#0F9D58',
                    data: <?= json_encode(array_column($daily_sale_book,'count')) ?>
                },
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

}

function daliy_sale_amounnt() {

    var cnv_daily_sale = $('#cnv_daily_sale_amount').get(0).getContext('2d');
    var chart = new Chart(cnv_daily_sale, {
        type: 'bar',

        data: {
            labels: <?= json_encode(array_column($daily_sale_amount,'date')) ?>,
            datasets: [
                // {
                //     label: 'Books',
                //     yAxisID: 'A',
                //     backgroundColor: '#0F9D58',
                //     borderColor: '#0F9D58',
                //     data: <?//= json_encode(array_column($daily_sale_book,'count')) ?>
                // },
                {
                    label: 'BDT',
                    // yAxisID: 'B',
                    backgroundColor: '#3b5998',
                    borderColor: '#3b5998',
                    data: <?= json_encode(array_column($daily_sale_amount,'count')) ?>
                },
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

}

function monthly_sale_amount() {

    var cnv_monthly_sale = $('#cnv_monthly_sale_amount').get(0).getContext('2d');
    var chart = new Chart(cnv_monthly_sale, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($monthly_sale_amount,'month')) ?>,
            datasets: [
                {
                    label: 'BDT',
                    // yAxisID: 'B',
                    backgroundColor: '#4363d8',
                    borderColor: '#4363d8',
                    data: <?= json_encode(array_column($monthly_sale_amount,'count')) ?>
                },
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

}



daliy_sale()
daliy_sale_amounnt()
monthly_sale_amount()
</script>
