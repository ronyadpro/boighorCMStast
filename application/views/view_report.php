
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <table id="table" class="table"  width="100%"></table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$('#navlink_report').addClass('menu-open');
$('.loading').addClass('d-none');

var sl = 0;
var data = <?php echo json_encode($booklist) ?>;
$('#table').DataTable({
    data: data,
    rowId: 'bookcover_small',
    columns: [
        {
            "title": "SL",
            "data": "bookcode",
            render: function (data, type, service) {
                return ++sl;
            }
        },
        {
            "title": "Bookcode",
            "data": "bookcode"
        },
        {
            "title": "Book Name",
            "data": "bookname"
        },
        {
            "title": "Cover Crease",
            "data": "bookcover_small",
            render: function (data, type, service) {
                var placeholderImg = "this.src='<?php echo base_url(); ?>images/no_img.png';";
                var imageViewer = '<ul class="enlarge"><li><img src="https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th/'+data+'" width="50px" /><span><img src="https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th/'+data+'" /></span></li></ul>';
                return imageViewer;
            }
        },
        {
            "title": "Cover Plain",
            "data": "bookcover_small",
            render: function (data, type, service) {
                var placeholderImg = "this.src='<?php echo base_url(); ?>images/no_img.png';";
                var imageViewer = '<ul class="enlarge"><li><img src="https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th_plain/'+data+'"  width="50px" /><span><img src="https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th_plain/'+data+'" /></span></li></ul>';
                return imageViewer;
            }
        },
    ]
});

</script>
