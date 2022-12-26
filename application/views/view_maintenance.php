
<!-- <div class="content-header bg-maintenance"> -->
<!-- <div class="content-header">
    <div class="container-fluid"> -->
        <div class="row justify-content-center">
            <h2>Sorry, This part of the website is under maintenance.</h2>
        </div>
        <div class="row justify-content-center">
            <h1>Please try again after a while.</h1>
        </div>
        <table id="table" class="table table-primary"  width="100%"></table>

    <!-- </div>
</div> -->

<script type="text/javascript">

$('#navlink_timeline').addClass('nav-link active');
$('.loading').addClass('d-none');


var sl = 0;
var booklist = <?php echo json_encode($booklist) ?>;
$('#table').DataTable({
    data: booklist,
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
    ]
});

    //
    // var booklist = <?php //echo json_encode($booklist) ?>;
    //
    // var img = new Image;
    // img.onload = function() {
    //     console.log(this);
    //     if(img.width == 360 && img.height == 540) {
    //         console.log('true');
    //     } else {
    //         console.log(this.id, img.width, img.height, img.filesize);
    //     }
    // };
    //
    // // for (var i in booklist) {
    // //     img.id = booklist[i].bookcode;
    // //     img.src = 'https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th/'+booklist[i].bookcover_small;
    // // }
    //
    // var i = 0;
    // function setImage() {
    //     if (i < booklist.length) {
    //         img.id = booklist[i].bookcode;
    //         img.src = 'https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th/'+booklist[i].bookcover_small;
    //         i++;
    //         setTimer();
    //     }
    // }
    //
    // function setTimer() {
    //     setTimeout(() => {
    //         setImage();
    //     }, 1000);
    // }
    //
    // setTimer();

</script>
