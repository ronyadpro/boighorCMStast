
<div class="modal fade" id="modal_publisher_booklist">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Publisher Booklist</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <table id="table_publisher_booklist" class="table table-sm table-hover text-center" width="100%"></table>
                </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var publisherbooktable;
function initDatatable(publishercode) {
    if (publisherbooktable) {
        publisherbooktable.destroy();
        document.getElementById('table_publisher_booklist').innerHTML = '';
    }
    publisherbooktable = $('#table_publisher_booklist').DataTable( {
        processing: true,
        serverSide: true,
        ordering : true,
        hilighting: false,
        responsive: false,
        ajax: {
            url: "<?php echo base_url(); ?>publisher/getbooklist",
            type: 'POST',
            data: {
                'category' : 'all',
                'publishercode': publishercode
            },
            dataFilter: function(data){
                // console.log(JSON.parse(data));
                sl = jQuery.parseJSON(data)['start'];
                return data;
            },
            error: function(err){
                console.log(err);
            }
        },
        rowId: 'bookcode',
        columns: [
            {
                "title": "SL",
                "data": "timeofentry",
                render: function (data, type, service) {
                    return ++sl;
                }
            },
            {
                "title": "Cover",
                "data": "bookcover_small",
                render: function (data, type, service) {
                    var placeholderImg = "this.src='<?php echo base_url(); ?>images/no_img.png';"
                    return '<img width="50px" src="https://d1b3dh5v0ocdqe.cloudfront.net/media/book_th/'+data+'" onerror="'+placeholderImg+'" />';
                }
            },
            {
                "title": "Title",
                "data": "bookname"
            },
            {
                "title": "Title (Bn)",
                "data": "bookname_bn"
            },
            // {
            //     "title": "Created",
            //     "data": "dateofaddition",
            //     render: function (data) {
            //         return data ? data.substring(0,10) : "N/A";
            //     }
            // },
            // {
            //     "title": "Created By",
            //     "data": "addedby",
            //     render: function (data) {
            //         return data ? data.substring(0,1).toUpperCase()+data.substring(1) : "N/A";
            //     }
            // },
            {
                "title": "Action",
                "data": "bookcode",
                render: function (data, type, service) {
                    return "<a href='<?php echo base_url() ?>book/overview/"+data+"' class='btn btn-app bg-light' style='border: none'><i class='fas fa-edit text-secondary'></i>Details</a>";
                }
            }
        ],
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Showing " + iStart +" to "+ iEnd + " from " + iTotal + " Books";
        },
    });
}
</script>
