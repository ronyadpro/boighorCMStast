
<div class="content-header">
    <div class="container-fluid">

		<div class="row">
			<section class="col-sm-6">
				<div class="card">
					<div class="card-header ui-sortable-handle">
						<h3 class="card-title">
							<i class="fas fa-chart-bar mr-1"></i>
							Number of Books Sold (Last 30 Days)
						</h3>
					</div>
                    <div class="card-body">
                        <canvas id="cnv_daily_sale" class="chartjs-render-monitor"></canvas>
					</div>
				</div>
			</section>
			<section class="col-sm-6">
				<div class="card">
					<div class="card-header ui-sortable-handle">
						<h3 class="card-title">
							<i class="fas fa-chart-bar mr-1"></i>
							Total Sales Amount (Last 30 Days)
						</h3>
					</div>
                    <div class="card-body">
                        <canvas id="cnv_daily_sale_amount" class="chartjs-render-monitor"></canvas>
					</div>
				</div>
			</section>
			<section class="col-sm-4">
				<div class="card">
					<div class="card-header ui-sortable-handle">
						<h3 class="card-title">
							<i class="fas fa-chart-pie mr-1"></i>
							Login Platform
						</h3>
					</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul id="chrt_legend_user" class="chart-legend clearfix"></ul>
                            </div>
                            <div class="col-sm-8">
                                <canvas id="chrt_pie_user" class="chartjs-render-monitor" style="height:350px; min-height:350px"></canvas>
                            </div>
                        </div>
					</div>
				</div>
			</section>
			<section class="col-sm-4">
				<div class="card">
					<div class="card-header ui-sortable-handle">
						<h3 class="card-title">
							<i class="fas fa-chart-pie mr-1"></i>
							Signup Source
						</h3>
					</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul id="chrt_legend_source" class="chart-legend clearfix"></ul>
                            </div>
                            <div class="col-sm-8">
                                <canvas id="chrt_pie_source" class="chartjs-render-monitor" style="height:350px; min-height:350px"></canvas>
                            </div>
                        </div>
					</div>
				</div>
			</section>
			<section class="col-sm-4">
				<div class="card">
					<div class="card-header ui-sortable-handle">
						<h3 class="card-title">
							<i class="fas fa-chart-pie mr-1"></i>
							Live Book
						</h3>
					</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul id="chrt_legend_book_types" class="chart-legend clearfix"></ul>
                            </div>
                            <div class="col-sm-8">
                                <canvas id="chrt_book_types" class="chartjs-render-monitor" style="height:350px; min-height:350px"></canvas>
                            </div>
                        </div>
					</div>
				</div>
			</section>
			<section class="col-sm-4">
				<div class="card">
					<div class="card-header ui-sortable-handle">
						<h3 class="card-title">
							<i class="fas fa-chart-pie mr-1"></i>
							Book Prices
						</h3>
					</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul id="chrt_legend_book_prices" class="chart-legend clearfix"></ul>
                            </div>
                            <div class="col-sm-8">
                                <canvas id="chrt_book_prices" class="chartjs-render-monitor" style="height:350px; min-height:350px"></canvas>
                            </div>
                        </div>
					</div>
				</div>
			</section>
			<section class="col-sm-4">
				<div class="card">
					<div class="card-header ui-sortable-handle">
						<h3 class="card-title">
							<i class="fas fa-chart-pie mr-1"></i>
							Book Categories
						</h3>
					</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul id="chrt_legend_book_categories" class="chart-legend clearfix"></ul>
                            </div>
                            <div class="col-sm-8">
                                <canvas id="chrt_book_categories" class="chartjs-render-monitor" style="height:350px; min-height:350px"></canvas>
                            </div>
                        </div>
					</div>
				</div>
			</section>
			<section class="col-sm-4">
				<div class="card">
					<div class="card-header ui-sortable-handle">
						<h3 class="card-title">
							<i class="fas fa-chart-pie mr-1"></i>
							Book Genres
						</h3>
					</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul id="chrt_legend_book_genre" class="chart-legend clearfix"></ul>
                            </div>
                            <div class="col-sm-8">
                                <canvas id="chrt_book_genre" class="chartjs-render-monitor" style="height:350px; min-height:350px"></canvas>
                            </div>
                        </div>
					</div>
				</div>
			</section>
		</div>
    </div>
</div>

<script type="text/javascript">

$('#navlink_report').addClass('menu-open').addClass('navtree-rc').addClass('card-outline card-primary');
$('#navlink_report_charts').addClass('active');
$('.loading').addClass('d-none');
// var some_colors =['#f39c12', '#00c0ef', '#3c8dbc', '#f56954', '#d2d6de', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#00a65a'];
// var source_colors = ['#e6194b', '#4363d8', '#ffe119', '#3cb44b', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#000075', '#808080', '#ffffff', '#000000'];
var social_colors = ["#3b5998", "#0F9D58", "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA","#0074D9"];
var social_lables = <?= json_encode(array_map(function($each)
    {
        return ucwords($each);
    }, array_column($social_login,'loginsrc'))) ?>;
var social_counts = <?= json_encode(array_column($social_login,'count')) ?>;

var source_lables = <?= json_encode(array_map(function($each)
    {
        return ucwords($each);
    }, array_column($login_source,'signupfrom'))) ?>;
var source_counts = <?= json_encode(array_column($login_source,'count')) ?>;

var book_type_lables = <?= json_encode(array_column($book_types,'type')) ?>;
var book_type_counts = <?= json_encode(array_column($book_types,'count')) ?>;

var book_price_lables = <?= json_encode(array_column($bookprice,'bookprice_bn')) ?>;
var book_price_counts = <?= json_encode(array_column($bookprice,'count')) ?>;

var book_category_lables = <?= json_encode(array_column($category,'category_bn')) ?>;
var book_category_counts = <?= json_encode(array_column($category,'count')) ?>;

var book_genre_lables = <?= json_encode(array_column($genre,'genre_bn')) ?>;
var book_genre_counts = <?= json_encode(array_column($genre,'count')) ?>;

daliy_sale()
social_chart()
source_chart()
daliy_sale_amounnt()
book_types()
price_chart()
category_chart()
genre_chart()

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
        options: {}
    });

}

function daliy_sale_amounnt() {

    var cnv_daily_sale = $('#cnv_daily_sale_amount').get(0).getContext('2d');
    var chart = new Chart(cnv_daily_sale, {
        type: 'bar',

        data: {
            labels: <?= json_encode(array_column($daily_sale_amount,'date')) ?>,
            datasets: [
                {
                    label: 'BDT',
                    backgroundColor: '#3b5998',
                    borderColor: '#3b5998',
                    data: <?= json_encode(array_column($daily_sale_amount,'count')) ?>
                },
            ]
        },
        options: {}
    });

}

function social_chart() {
    var donutChart = new Chart($('#chrt_pie_user').get(0).getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: social_lables,
            datasets: [
                {
                    data: social_counts,
                    backgroundColor : social_colors,
                }
            ]
        },
        options: {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: false
            }
        }
    })
    for (var i = 0; i < social_lables.length; i++) {
        $('#chrt_legend_user').append( "<li><i class='fas fa-circle mr-1' style='color:"+social_colors[i]+"'></i><small>"+social_lables[i]+" - "+social_counts[i]+"</small></li>" );
    }
}

function source_chart() {
    var donutChart = new Chart($('#chrt_pie_source').get(0).getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: source_lables,
            datasets: [
                {
                    data: source_counts,
                    backgroundColor : social_colors,
                }
            ]
        },
        options: {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: false
            }
        }
    })
    for (var i = 0; i < source_lables.length; i++) {
        $('#chrt_legend_source').append( "<li><i class='fas fa-circle mr-1' style='color:"+social_colors[i]+"'></i><small>"+source_lables[i]+" - "+source_counts[i]+"</small></li>" );
    }
}

function book_types() {
    var donutChart = new Chart($('#chrt_book_types').get(0).getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: book_type_lables,
            datasets: [
                {
                    data: book_type_counts,
                    backgroundColor : social_colors,
                }
            ]
        },
        options: {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: false
            }
        }
    })
    for (var i = 0; i < book_type_lables.length; i++) {
        $('#chrt_legend_book_types').append( "<li><i class='fas fa-circle mr-1' style='color:"+social_colors[i]+"'></i><small>"+book_type_lables[i]+" - "+book_type_counts[i]+"</small></li>" );
    }
}

function price_chart() {
    var donutChart = new Chart($('#chrt_book_prices').get(0).getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: book_price_lables,
            datasets: [
                {
                    data: book_price_counts,
                    backgroundColor : social_colors,
                }
            ]
        },
        options: {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: false
            }
        }
    })
    for (var i = 0; i < book_price_lables.length; i++) {
        $('#chrt_legend_book_prices').append( "<li><i class='fas fa-circle mr-1' style='color:"+social_colors[i]+"'></i><small>"+book_price_lables[i]+" - "+book_price_counts[i]+"</small></li>" );
    }
}

function category_chart() {
    var donutChart = new Chart($('#chrt_book_categories').get(0).getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: book_category_lables,
            datasets: [
                {
                    data: book_category_counts,
                    backgroundColor : social_colors,
                }
            ]
        },
        options: {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: false
            }
        }
    })
    for (var i = 0; i < book_category_lables.length; i++) {
        $('#chrt_legend_book_categories').append( "<li><i class='fas fa-circle mr-1' style='color:"+social_colors[i]+"'></i><small>"+book_category_lables[i]+" - "+book_category_counts[i]+"</small></li>" );
    }
}

function genre_chart() {
    var donutChart = new Chart($('#chrt_book_genre').get(0).getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: book_genre_lables,
            datasets: [
                {
                    data: book_genre_counts,
                    backgroundColor : social_colors,
                }
            ]
        },
        options: {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: false
            }
        }
    })
    for (var i = 0; i < book_genre_lables.length; i++) {
        $('#chrt_legend_book_genre').append( "<li><i class='fas fa-circle mr-1' style='color:"+social_colors[i]+"'></i><small>"+book_genre_lables[i]+" - "+book_genre_counts[i]+"</small></li>" );
    }
}

</script>
