
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Report</li>
                    <li class="breadcrumb-item active">Boighor Global</li>
                </ol>
            </div>
        </div>

        <form method="post" id="form_xyz">
            <div class="row justify-content-center mb-2">
                <div class="col-sm-3">
                    <label>Date from</label>
                    <input type="date" class="form-control form-control-sm" value="<?=date('Y-m-d')?>" id="text_date_from">
                </div>
                <div class="col-sm-3">
                    <label>Date to</label>
                    <input type="date" class="form-control form-control-sm" value="<?=date('Y-m-d')?>" id="text_date_to">
                </div>
                <div class="col-sm-3">
                    <label>Author</label>
                    <select class="form-control form-control-sm select2" id="ddl_content_owner">
                        <option value="">All Authors</option>
                        <?php foreach ($authorlist as $key => $author): ?>
                            <option value="<?=$author['authorcode'] ?>"><?=$author['author'].' • '.$author['author_bn'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label>Publishers</label>
                    <select class="form-control form-control-sm select2" id="ddl_publisher">
                        <option value="">All Publishers</option>
                        <?php foreach ($publisherlist as $key => $publisher): ?>
                            <option value="<?=$publisher['publishercode'] ?>"><?=$publisher['publishername_en'].' • '.$publisher['publishername_bn'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-9 mt-4">
                    <button id="btn_report" type="submit" class="btn btn-primary btn-block">
                        <b id="btn_report_text">
                            <i class="fas fa-arrow-down mr-2"></i>
                            <span id="btn_loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none"></span>
                            <span id="btn_text">Get Invoice</span>
                            <i class="fas fa-arrow-down ml-2"></i>
                        </b>
                    </button>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-sm-12">
                <div id="div_report_summary">

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
				<div id="invoicelist">

				</div>
                <!-- <div class="card">
                    <div class="card-body"> -->
                        <table id="tbl_report" class="table table-sm" width="100%"></table>
                    <!-- </div>
                </div> -->
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">

$('#navlink_report').addClass('menu-open');
$('#navlink_report_invoice').addClass('active');
$('.loading').addClass('d-none');

var table;
var dataset;

$('#form_xyz').submit(function(evnt) {
    evnt.preventDefault()
    populate_report()
})

function populate_report() {

    $('#btn_text').html('Loading Data...');
    $('#btn_loader').show()
    $('#btn_report').attr('disabled', true);

    $.ajax({
        url: "<?= base_url('report/sales/get_sales_report'); ?>",
        method:"POST",
        data: {
            'draw':'1',
            'columns':[
                {
                    'data':'created'
                },
            ],
            'order':[
                {
                    'column':'0',
                    'dir':'desc'
                }
            ],
            'search': {
                    'value':''
                },
            'writercode' : $('#ddl_content_owner').val(),
            'publishercode' : $('#ddl_publisher').val(),
            'date_from' : $('#text_date_from').val(),
            'date_to' : $('#text_date_to').val(),
            'paymenttype' : '',
            'campaign' : '',
        },
        success:function(data) {
            console.log(data);
            $('#btn_text').html('Report');
            $('#btn_loader').hide()
            $('#btn_report').attr('disabled', false);
            dataset = jQuery.parseJSON(data)['data'];
            populate_customized_report()
            // if (data) {
            //     toastr.success('Banner Re-ordered Successfully');
            // } else {
            //     toastr.success('Could not Reorder');
            // }
        }
    });
}

function populate_customized_report() {
	var totalsell;
	var totalsell_final;
    var net_payable=0;
	var sl= 1;
	var unique_writers = get_unique_nonduplicate_column_values_from_2darray(dataset, 'writername');
	console.log(unique_writers);
    invoiceListHtml= '<table class="table table-bordered table-sm" style="width:100%;text-align: center;">';
	invoiceListHtml+='<tr>';
	invoiceListHtml+='<th style="width:5%;font-weight:bold;border:1px solid #000;">Sl.</th>';
	invoiceListHtml+='<th style="width:10%;font-weight:bold;border:1px solid #000;">Author Name</th>';

	invoiceListHtml+='<th style="width:75%;font-weight:bold;border:1px solid #000;padding:0px;"><table class="table table-bordered table-sm" style="width:100%;text-align: center;margin-bottom:0px;"><tr><td style="width:30%;padding:0px; font-weight: 600;">Book Name</td><td style="width:=70%;padding:0px;"><table nobr="true" style="width:100%;border-collapse: collapse;"><tr><td style="width:15%;font-weight: 600;">Payment Type</td><td style="width:10%;font-weight: 600;">Unit</td><td style="width:15%;font-weight: 600;">Price/Unit</td><td style="width:15%;font-weight: 600;">Service Fee</td><td style="width:15%;font-weight: 600;">Unit/Price(ASF)</td><td style="width:15%;font-weight: 600;">Total(ASF)</td><td style="width:15%;font-weight: 600;">Rev. Share(50%)</td></tr></table></td></tr></table></th>';

	invoiceListHtml+='<th style="width:10%;font-weight:bold;border:1px solid #000;">Payable Amount</th>';
	invoiceListHtml+='</tr>';

	for (var uwi = 0; uwi < unique_writers.length; uwi++) {
		totalsell = 0;
        totalsell_final = 0;
		invoiceListHtml+='<tr nobr="true">';
		//console.log("book price",prices);
		invoiceListHtml += '<td style="border:1px solid #000;">'+sl+'</td>';
		invoiceListHtml += '<td style="border:1px solid #000;">'+unique_writers[uwi]+'</td>';
		invoiceListHtml += '<td style="border:1px solid #000;padding:0px;">';
		invoiceListHtml += '<table cellpadding="3" nobr="true" style="width:100%;">';

		var books = dataset.filter(function(row,index) { return row['writername']==unique_writers[uwi]; });
		var unique_books = get_unique_nonduplicate_column_values_from_2darray(books, 'bookname');

		for (var ubi = 0; ubi < unique_books.length; ubi++) {

			var prices = books.filter(function(row,index) { return row['bookname']==unique_books[ubi]; });
			var unique_prices = get_unique_nonduplicate_column_values_from_2darray(prices, 'sellingprice');


			invoiceListHtml+= '<tr>';
			invoiceListHtml+= '<td style="width:30%;">'+unique_books[ubi]+' (৳'+(prices[0]['bookprice']).slice(0,-3)+')</td>';
			invoiceListHtml+= '<td style="width:70%;padding:0px;"><table nobr="true" style="width:100%;">';
			//$num = 0;
			for (var upi = 0; upi < unique_prices.length; upi++) {
				var unique_price_count = prices.filter(function(row,index) { return row['sellingprice']==unique_prices[upi]; });
				var pay_type = prices.find(function(row,index) { return row['sellingprice']==unique_prices[upi]; });

				invoiceListHtml+='<tr>';
                if (pay_type['paymentmethod']=='portpos') {
                    switch (pay_type['paynetwork']) {
                        case 'bkashcheckout':
                            pay_type['paymentmethod'] = 'portpos/bkash';
                            break;
                        default:
                            pay_type['paymentmethod'] = 'portpos/'+pay_type['paynetwork'];
                            break;
                    }
                }
				invoiceListHtml += '<td style="width:15%;">'+pay_type['paymentmethod']+'</td>';
                var pricetext = unique_prices[upi];
                if (pricetext < 10) {
                    switch (pricetext) {
                        case '0.99':
                            pricetext = '80.00';
                            break;
                        case '1.49':
                            pricetext = '120.00';
                            break;
                        case '1.99':
                            pricetext = '150.00';
                            break;
                        case '2.49':
                            pricetext = '220.00';
                            break;
                        case '2.99':
                            pricetext = '250.00';
                            break;
                        case '3.49':
                            pricetext = '300.00';
                            break;
                        case '3.99':
                            pricetext = '350.00';
                            break;
                        case '4.49':
                            pricetext = '390.00';
                            break;
                        case '4.99':
                            pricetext = '420.00';
                            break;
                        case '5.49':
                            pricetext = '450.00';
                            break;
                        case '5.99':
                            pricetext = '500.00';
                            break;
                        default:
                            break;
                    }
                }
                var service_charge_percent = 0;
                var service_charge = 0;
                var without_service_charge = pricetext;
                switch (pay_type['paymentmethod']) {
                    case 'bkash':
                        service_charge_percent = 10;
                        break;
                    case 'gpay':
                        var paymentDate = new Date(pay_type['paymentDate']);
                        var june2021 = new Date(2021, 06, 01); //Year, Month, Date  // 00->January, 05->June
                        if (paymentDate >= june2021) {
                            service_charge_percent = 15;
                        }else {
                            service_charge_percent = 30;
                        }
                        break;
                    case 'aiap':
                        service_charge_percent = 15;
                        break;
                    case 'card':
                        service_charge_percent = 10;
                        break;
                    case 'stripe':
                        service_charge_percent = 3;
                        break;
                    default:
                        service_charge_percent = 5;
                        break;
                }
                service_charge = pricetext*service_charge_percent/100;
                without_service_charge = (pricetext - service_charge)*unique_price_count.length;

                invoiceListHtml += '<td style="width:10%;">'+unique_price_count.length+'</td>';
				invoiceListHtml += '<td style="width:15%;">৳'+pricetext+'</td>';
				var tamount = pricetext * unique_price_count.length;
                var rev_share_percent = 0.50;
                var rev_share_total = (without_service_charge * rev_share_percent).toFixed(2);
				totalsell += parseFloat(rev_share_total);
                invoiceListHtml += '<td style="width:15%;">৳'+(service_charge).toFixed(2)+' ('+service_charge_percent+'%)</td>';
                invoiceListHtml += '<td style="width:15%;">৳'+(pricetext-service_charge).toFixed(2)+'</td>';
				invoiceListHtml += '<td style="width:15%;">৳'+ (without_service_charge).toFixed(2) +'</td>';
				invoiceListHtml += '<td style="width:15%;">৳'+ rev_share_total +'</td>';
                net_payable += parseFloat(rev_share_total);
				invoiceListHtml+='</tr>';

			}
			invoiceListHtml+='</table></td></tr>';
			console.log(totalsell);
			//invoiceListHtml += '<td style="border:1px solid #000;">'+totalsell+'</td>';
		}

		invoiceListHtml += '</table>';
		invoiceListHtml += '</td>';
		invoiceListHtml += '<td style="border:1px solid #000;">৳'+totalsell.toFixed(2)+'</td>';
		//invoiceListHtml += '<td style="border:1px solid #000;padding:0px;">';
		//invoiceListHtml += '<table  style="width:100%;">';

		// for (var ubi = 0; ubi < unique_books.length; ubi++) {
		//
		// 	invoiceListHtml+='<tr>';
		// 	invoiceListHtml += '<td style="">'+unique_prices+'</td>';
		// 	invoiceListHtml+='</tr>';
		// 	for (var upi = 0; upi < unique_prices.length; upi++) {
		// 		var unique_price_count = prices.filter(function(row,index) { return row['sellingprice']==unique_prices[upi]; });
		// 		console.log("price"+unique_prices);
		// 		invoiceListHtml+='<tr>';
		// 		invoiceListHtml += '<td style="">'+unique_prices[upi]+' x '+unique_price_count.length+'</td>';
		// 		//invoiceListHtml += '<td style="">'+unique_prices[upi]+' x '+unique_price_count.length+'</td>';
		// 		invoiceListHtml+='</tr>';
		// 	}
		// }

		//invoiceListHtml += '</table>';
		//invoiceListHtml += '</td>';
		//invoiceListHtml += '<td style="">'++'</td>';
		invoiceListHtml +='</tr>';
		// invoiceListHtml +='<tr>';
		// invoiceListHtml += '<td style="width:30%;"> Grand Total';
		// invoiceListHtml += '</td>';
		// invoiceListHtml +='</tr>';
		sl++;
	}
    // invoiceListHtml+='<tr>';
    // invoiceListHtml += '<td>Net Payable'+parseFloat(net_payable).toFixed(2);
    // invoiceListHtml += '</td>';
    // invoiceListHtml+='</tr>';
	// end of main for loop

	invoiceListHtml +='<tr><td colspan="3" style="text-align:right;border: 1px solid black;font-weight:600;">Total Payable Amount: </td>';
	invoiceListHtml +='<td style="text-align:center;border: 1px solid black;font-weight:600;font-size: 16px;">৳' + net_payable.toFixed(2) + '</td></tr>';

    console.log(net_payable);
	invoiceListHtml+='</table>';
	document.getElementById('invoicelist').innerHTML = '';
	//document.getElementById('emptyitem').style.display = "none";
	document.getElementById('invoicelist').innerHTML = invoiceListHtml;

    var tablediv = document.getElementById('div_report_summary');
    var tbl = document.createElement('table');
    tbl.style.width = '100%';
    tbl.setAttribute('border', '1');
    // tbl.classList.add("table");
    var tbody = document.createElement('tbody');

    console.log(unique_writers);
    // for (var uwi = 0; uwi < unique_writers.length; uwi++) {
    //     console.log('-',unique_writers[uwi]);
	//
    //     var tr_writer = document.createElement('tr')
	//
    //     var td_writer = document.createElement('td')
    //     var td_book = document.createElement('td')
    //     var td_price = document.createElement('td')
	//
    //     td_writer.appendChild(document.createTextNode(unique_writers[uwi]))
    //     tr_writer.appendChild(td_writer)
	//
    //     var books = dataset.filter(function(row,index) { return row['writername']==unique_writers[uwi]; });
    //     var unique_books = get_unique_nonduplicate_column_values_from_2darray(books, 'bookname');
	//
    //     var tbl_book = document.createElement('table')
    //     var tbody_book = document.createElement('tbody')
    //     tbl_book.style.width = '100%';
    //     tbl_book.setAttribute('border', '1');
    //     for (var ubi = 0; ubi < unique_books.length; ubi++) {
    //         console.log('--',unique_books[ubi]);
	//
    //         var tr_book = document.createElement('tr')
    //         var td_book = document.createElement('td')
    //         td_book.appendChild(document.createTextNode(unique_books[ubi]))
    //         tr_book.appendChild(td_book)
    //         tbody_book.appendChild(tr_book)
	//
    //         var prices = books.filter(function(row,index) { return row['bookname']==unique_books[ubi]; });
    //         var unique_prices = get_unique_nonduplicate_column_values_from_2darray(prices, 'sellingprice');
	//
    //         var tbl_price = document.createElement('table')
    //         var tbody_price = document.createElement('tbody')
    //         tbl_price.style.width = '100%';
    //         tbl_price.setAttribute('border', '1');
    //         // for (var upi = 0; upi < unique_prices.length; upi++) {
    //         //
    //         //     var unique_price_count = prices.filter(function(row,index) { return row['sellingprice']==unique_prices[upi]; });
    //         //     console.log('---',unique_prices[upi],'x',unique_price_count.length);
    //         //
    //         //     var tr_price = document.createElement('tr')
    //         //     var td_price = document.createElement('td')
    //         //     td_price.appendChild(document.createTextNode(unique_prices[upi]+' x '+unique_price_count.length))
    //         //     tr_price.appendChild(td_price)
    //         //     tbody_price.appendChild(tr_price)
    //         //     tbl_price.appendChild(tbody_price)
    //         //
    //         // }
	//
    //         // td_book.appendChild(tbl_book)
    //         // var hr = document.createElement('hr')
    //         // td_book.appendChild(hr)
	//
    //     }
	//
    //     tbl_book.appendChild(tbody_book)
	//
    //     tr_writer.appendChild(tbl_book)
    //     tr_writer.appendChild(tbl_price)
	//
    //     tbody.appendChild(tr_writer);
    // }
    tbl.appendChild(tbody);
    tablediv.innerHTML = "";
    tablediv.appendChild(tbl)
}

function get_unique_nonduplicate_column_values_from_2darray(array2d, columnname) {
    var filteredarray = array2d.map(function(value,index) { return value[columnname]; });
    filteredarray = Array.from(new Set(filteredarray));
    filteredarray = filteredarray.filter(function (el) {
        return el != '';
    });
    return filteredarray;
}

</script>
