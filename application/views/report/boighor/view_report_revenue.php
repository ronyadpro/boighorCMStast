
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
            <div class="row">
                <div class="col-sm-2">
                    <label>Author/Publisher</label>
                    <select class="form-control form-control-sm" id="text_licenser">
                        <option value="">All</option>
                        <?php foreach ($licensers as $key => $licenser): ?>
                            <option value="<?=$licenser['licensertype'].'__'.$licenser['licensercode']?>"><?=$licenser['licensername_en']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php
                   $begin = new DateTime( "2021-04-01" );
                   $end   = new DateTime( date('Y-m-d') );
                 ?>
                <div class="col-sm-2">
                    <label>From</label>
                    <select required class="form-control form-control-sm" id="text_year_month_from">
                        <?php for ($i = $end; $i >= $begin; $i->modify('-1 month')) { ?>
                            <option value="<?=$i->format("Y-m-01")?>"><?=$i->format("Y-F")?></option>
                        <?php } ?>
                    </select>
                </div>
                <?php
                   $begin = new DateTime( "2021-04-01" );
                   $end   = new DateTime( date('Y-m-d') );
                 ?>
               <div class="col-sm-2">
                   <label>To</label>
                   <select required class="form-control form-control-sm" id="text_year_month_to">
                       <?php for ($i = $end; $i >= $begin; $i->modify('-1 month')) { ?>
                           <option value="<?=$i->format("Y-m-31")?>"><?=$i->format("Y-F")?></option>
                       <?php } ?>
                   </select>
               </div>
               <div class="col-sm-2">
                   <label>Agrement Type</label>
                   <select class="form-control form-control-sm" id="text_isexclusive">
                       <option value="">All</option>
                       <option value="1">Exclusive</option>
                       <option value="0">Non-Exclusive</option>
                   </select>
               </div>
                <div class="col-sm-2" style="margin-top: 29px;">
                    <button id="btn_report" type="submit" class="btn btn-sm btn-outline-secondary">
                        <b id="btn_report_text">
                            <!-- <i class="fas fa-arrow-down mr-2"></i> -->
                            <span id="btn_loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none"></span>
                            <span id="btn_text">Get Report</span>
                            <i class="fas fa-arrow-right ml-2"></i>
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

        <div class="row mt-2">
            <div class="col-sm-12">
				<div id="invoicelist">

				</div>
				<table id="tbl_report" class="table table-sm" width="100%"></table>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">

$('#navlink_report').addClass('menu-open');
$('#navlink_report_revenue').addClass('active');
$('.loading').addClass('d-none');

var table;
var dataset;

$(document).ready(function (){
    if (location.hash) {
    	let url = location.href.replace(/\/$/, "");
    	const hash = url.split("#")[url.split("#").length-1];
        if (hash.toLowerCase()=="today") {
        } else {
            populate_report()
        }
    }
});

$('#form_xyz').submit(function(evnt) {
    evnt.preventDefault()
    populate_report()
})

function populate_report() {

    $('#btn_text').html('Loading Data...');
    $('#btn_loader').show()
    $('#btn_report').attr('disabled', true);

    $.ajax({
        url: "<?= base_url('report/boighor/revenue/get_revenue_report') ?>",
        method:"POST",
        data: {
            'licensertype' : $('#text_licenser').val().split('__')[0],
            'licensercode' : $('#text_licenser').val().split('__')[1],
            'isexclusive' : $('#text_isexclusive').val(),
            'date_from' : $('#text_year_month_from').val(),
            'date_to' : $('#text_year_month_to').val(),
        },
        success:function(data) {
            // console.log(data);
            $('#btn_text').html('Report');
            $('#btn_loader').hide()
            $('#btn_report').attr('disabled', false);
            dataset = jQuery.parseJSON(data);
            populate_customized_report()
        }
    });
}

function populate_customized_report() {
	var totalsell;
    var totalsell_ebs;
	var totalsell_final;
    var net_payable=0;
    var net_payable_ebs=0;
	var sl= 1;
	var unique_writers = get_unique_nonduplicate_column_values_from_2darray(dataset, 'writername');
	// console.log(unique_writers);
    invoiceListHtml= '<table class="table table-bordered table-sm" style="width:100%;text-align: center;">';
	invoiceListHtml+='<tr>';
	invoiceListHtml+='<th style="width:5%;font-weight:bold;border:1px solid #000;">Sl.</th>';
	invoiceListHtml+='<th style="width:10%;font-weight:bold;border:1px solid #000;">Author</th>';

	invoiceListHtml+='<th style="width:70%;font-weight:bold;border:1px solid #000;padding:0px;"><table class="table table-bordered table-sm" style="width:100%;text-align: center;margin-bottom:0px;"><tr><td style="width:25%;padding:0px; font-weight:600;">Book</td><td style="width:=75%;padding:0px;"><table nobr="true" style="width:100%;border-collapse: collapse;"><tr><td style="width:12.5%;font-weight:600;">Gateway</td><td style="width:12.5%;font-weight:600;">Unit</td><td style="width:10%;font-weight:600;">Price</td><td style="width:15%;font-weight:600;">Service Fee</td><td style="width:10%;font-weight:600;">Price(ASF*)</td><td style="width:10%;font-weight:600;">Total(ASF*)</td><td style="width:15%;font-weight:600;">Partner Share</td><td style="width:15%;font-weight:600;">EBS Share</td></tr></table></td></tr></table></th>';

	invoiceListHtml+='<th style="width:7.5%;font-weight:bold;border:1px solid #000;">Partner Net</th>';
	invoiceListHtml+='<th style="width:7.5%;font-weight:bold;border:1px solid #000;">EBS Net</th>';
	invoiceListHtml+='</tr>';

	for (var uwi = 0; uwi < unique_writers.length; uwi++) {
		totalsell = 0;
        totalsell_ebs = 0;
        totalsell_final = 0;
		invoiceListHtml+='<tr nobr="true">';
		//console.log("book price",prices);
		invoiceListHtml += '<td style="border:1px solid #000;">'+sl+'</td>';
		invoiceListHtml += '<td style="border:1px solid #000;">'+unique_writers[uwi]+'</td>';
		invoiceListHtml += '<td style="border:1px solid #000;padding:0px;">';
		invoiceListHtml += '<table cellpadding="3" nobr="true" style="width:100%;">';

		var books = dataset.filter(function(row,index) { return row['writername']==unique_writers[uwi]; });
		// var royalty = dataset.filter(function(row,index) { return row['writername']==unique_writers[uwi]; });
		var unique_books = get_unique_nonduplicate_column_values_from_2darray(books, 'bookname');

		for (var ubi = 0; ubi < unique_books.length; ubi++) {

            var royalty_percent = books.find(function(row,index) { return row['bookname']==unique_books[ubi]; });
            royalty_percent = royalty_percent?.royalty_percent;
            var royalty_percent_ebs = 100 - royalty_percent;
            // console.log(royalty_percent);

            invoiceListHtml+= '<tr>';
            invoiceListHtml+= '<td style="width:25%;">'+unique_books[ubi]+'</td>';
            invoiceListHtml+= '<td style="width:75%;padding:0px;"><table nobr="true" style="width:100%;">';

            //
            var paymentmethods = books.filter(function(row,index) { return row['bookname']==unique_books[ubi]; });
            var unique_paymentmethods = get_unique_nonduplicate_column_values_from_2darray(paymentmethods, 'paymentmethod');

            for (var upmi = 0; upmi < unique_paymentmethods.length; upmi++) {

                invoiceListHtml+='<tr>';
                // if (pay_type['paymentmethod']=='portpos') {
                //     switch (pay_type['paynetwork']) {
                //         case 'bkashcheckout':
                //         pay_type['paymentmethod'] = 'portpos/bkash';
                //         break;
                //         default:
                //         pay_type['paymentmethod'] = 'portpos/'+pay_type['paynetwork'];
                //         break;
                //     }
                // } else if (pay_type['paymentmethod']=='aiap') {
                //     pay_type['paymentmethod'] = 'Apple-IAP';
                // }
                let paymentmethod = unique_paymentmethods[upmi];
                switch (paymentmethod) {
                    case 'aiap':
                        paymentmethod = 'Apple-IAP';
                        break;
                    case 'portpos':
                        paymentmethod = 'Portpos';
                        break;
                    case 'card':
                        paymentmethod = 'Card';
                        break;
                    default:
                        break;
                }
                invoiceListHtml += '<td style="width:12.5%;">'+paymentmethod+'</td>';
                invoiceListHtml+= '<td style="width:90%;padding:0px;"><table nobr="true" style="width:100%;">';

                var prices = paymentmethods.filter(function(row,index) { return row['paymentmethod']==unique_paymentmethods[upmi]; });
                var unique_prices = get_unique_nonduplicate_column_values_from_2darray(prices, 'sellingprice');

                //$num = 0;
                for (var upi = 0; upi < unique_prices.length; upi++) {
                    var unique_price_count = prices.filter(function(row,index) { return row['sellingprice']==unique_prices[upi]; });
                    var pay_type = prices.find(function(row,index) { return row['sellingprice']==unique_prices[upi]; });
                    // console.log('>>>',pay_type);
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
                        service_charge_percent = 5;
                        default:        //      for protpos and others
                        service_charge_percent = 5;
                        break;
                    }
                    service_charge = pricetext*service_charge_percent/100;
                    without_service_charge = (pricetext - service_charge)*unique_price_count.length;

                    invoiceListHtml += '<tr>';
                    let paynetwork = (pay_type['paynetwork']=='bkashcheckout') ? 'bKash' : pay_type['paynetwork'];
                    invoiceListHtml += '<td style="width:12.5%;">'+unique_price_count.length+(paynetwork?' x '+paynetwork:"")+'</td>';
                    invoiceListHtml += '<td style="width:10%;">৳'+pricetext+'</td>';
                    var tamount = pricetext * unique_price_count.length;
                    var rev_share_percent = parseFloat(royalty_percent/100);
                    var rev_share_percent_ebs = parseFloat(royalty_percent_ebs/100);
                    var rev_share_total = (without_service_charge * rev_share_percent).toFixed(2);
                    var rev_share_total_ebs = (without_service_charge * rev_share_percent_ebs).toFixed(2);
                    totalsell += parseFloat(rev_share_total);
                    totalsell_ebs += parseFloat(rev_share_total_ebs);
                    invoiceListHtml += '<td style="width:15%;">৳'+(service_charge).toFixed(2)+' ('+service_charge_percent+'%)</td>';
                    invoiceListHtml += '<td style="width:10%;">৳'+(pricetext-service_charge).toFixed(2)+'</td>';
                    invoiceListHtml += '<td style="width:10%;">৳'+ (without_service_charge).toFixed(2) +'</td>';
                    invoiceListHtml += '<td style="width:15%;">৳'+ rev_share_total +' ('+ royalty_percent +'%)'+'</td>';
                    invoiceListHtml += '<td style="width:15%;">৳'+ rev_share_total_ebs +' ('+ royalty_percent_ebs +'%)'+'</td>';
                    net_payable += parseFloat(rev_share_total);
                    net_payable_ebs += parseFloat(rev_share_total_ebs);
                    invoiceListHtml += '</tr>';

                }
                invoiceListHtml += '</table></td></tr>';
            }
            //

			invoiceListHtml+='</table></td></tr>';
			// console.log(totalsell);
		}

		invoiceListHtml += '</table>';
		invoiceListHtml += '</td>';
		invoiceListHtml += '<td style="border:1px solid #000;">৳'+totalsell.toFixed(2)+'</td>';
		invoiceListHtml += '<td style="border:1px solid #000;">৳'+totalsell_ebs.toFixed(2)+'</td>';
		invoiceListHtml +='</tr>';
		sl++;
	}

	invoiceListHtml +='<tr>';
	invoiceListHtml +='<td colspan="3" style="text-align:right;border: 1px solid black;font-weight:600;">';
    // invoiceListHtml +='<table nobr="true" style="width:100%;">';
	// invoiceListHtml +='<tr><td colspan="2" style="text-align:right;border: 1px solid black;font-weight:600;"></td><td colspan="2" style="text-align:right;border: 1px solid black;font-weight:600;">x</td><td colspan="2" style="text-align:right;border: 1px solid black;font-weight:600;">Total Payable Amount: </td></tr>';
	// invoiceListHtml +='</td>';
    // invoiceListHtml += '</table>';
	invoiceListHtml +='<td style="text-align:center;border: 1px solid black;font-weight:600;font-size: 16px;">৳' + net_payable.toFixed(2) + '</td>';
	invoiceListHtml +='<td style="text-align:center;border: 1px solid black;font-weight:600;font-size: 16px;">৳' + net_payable_ebs.toFixed(2) + '</td>';
	invoiceListHtml +='</tr>';

    invoiceListHtml +='<tr><td colspan="3" style="text-align:right;border: 1px solid black;font-weight:600;"></td>';
    invoiceListHtml +='<td colspan="2" style="text-align:center;border: 1px solid black;font-weight:600;font-size: 16px;">৳' + (net_payable+net_payable_ebs).toFixed(2) + '</td>';
    invoiceListHtml +='</tr>';

    // console.log(net_payable);
	invoiceListHtml+='</table>';
    invoiceListHtml +='<small>*ASF stands for After Service Fee</small>';
	document.getElementById('invoicelist').innerHTML = '';
	//document.getElementById('emptyitem').style.display = "none";
	document.getElementById('invoicelist').innerHTML = invoiceListHtml;

    var tablediv = document.getElementById('div_report_summary');
    var tbl = document.createElement('table');
    tbl.style.width = '100%';
    tbl.setAttribute('border', '1');
    // tbl.classList.add("table");
    var tbody = document.createElement('tbody');

    // console.log(unique_writers);
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
