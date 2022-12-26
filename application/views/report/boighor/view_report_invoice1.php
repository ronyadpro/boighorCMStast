
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
                    <input type="date" class="form-control form-control-sm" value="2021-06-01" id="text_date_from">
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
        url: "<?= base_url('report/boighor/sales/get_sales_report'); ?>",
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
            // console.log(data);
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
    var tablediv = document.getElementById('div_report_summary');
    var tbl = document.createElement('table');
    tbl.style.width = '100%';
    tbl.setAttribute('border', '1');
    // tbl.classList.add("table");
    var tbody = document.createElement('tbody');
    var unique_writers = get_unique_nonduplicate_column_values_from_2darray(dataset, 'writername');
    console.log(unique_writers);
    for (var uwi = 0; uwi < unique_writers.length; uwi++) {
        console.log('-',unique_writers[uwi]);

        var tr_writer = document.createElement('tr')

        var td_writer = document.createElement('td')
        var td_book = document.createElement('td')
        var td_price = document.createElement('td')

        td_writer.appendChild(document.createTextNode(unique_writers[uwi]))
        tr_writer.appendChild(td_writer)

        var books = dataset.filter(function(row,index) { return row['writername']==unique_writers[uwi]; });
        var unique_books = get_unique_nonduplicate_column_values_from_2darray(books, 'bookname');

        var tbl_book = document.createElement('table')
        var tbody_book = document.createElement('tbody')
        tbl_book.style.width = '100%';
        tbl_book.setAttribute('border', '1');
        for (var ubi = 0; ubi < unique_books.length; ubi++) {
            console.log('--',unique_books[ubi]);

            var tr_book = document.createElement('tr')
            var td_book = document.createElement('td')
            td_book.appendChild(document.createTextNode(unique_books[ubi]))
            tr_book.appendChild(td_book)
            tbody_book.appendChild(tr_book)

            var prices = books.filter(function(row,index) { return row['bookname']==unique_books[ubi]; });
            var unique_prices = get_unique_nonduplicate_column_values_from_2darray(prices, 'sellingprice');

            var tbl_price = document.createElement('table')
            var tbody_price = document.createElement('tbody')
            tbl_price.style.width = '100%';
            tbl_price.setAttribute('border', '1');
            // for (var upi = 0; upi < unique_prices.length; upi++) {
            //
            //     var unique_price_count = prices.filter(function(row,index) { return row['sellingprice']==unique_prices[upi]; });
            //     console.log('---',unique_prices[upi],'x',unique_price_count.length);
            //
            //     var tr_price = document.createElement('tr')
            //     var td_price = document.createElement('td')
            //     td_price.appendChild(document.createTextNode(unique_prices[upi]+' x '+unique_price_count.length))
            //     tr_price.appendChild(td_price)
            //     tbody_price.appendChild(tr_price)
            //     tbl_price.appendChild(tbody_price)
            //
            // }

            // td_book.appendChild(tbl_book)
            // var hr = document.createElement('hr')
            // td_book.appendChild(hr)

        }

        tbl_book.appendChild(tbody_book)

        tr_writer.appendChild(tbl_book)
        tr_writer.appendChild(tbl_price)

        tbody.appendChild(tr_writer);
    }
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
