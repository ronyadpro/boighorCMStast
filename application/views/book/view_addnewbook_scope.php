<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-9">
                <h1 class="m-0 text-dark">Book Scope</h1>
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>/book/booklist">Books</a></li>
                    <li class="breadcrumb-item active">New Scope</li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center mb-2">
            <div class="col-12">
                <button type="button" class="btn btn-sm btn-outline-primary float-right"  data-toggle="modal" data-target="#modal_new_scope"><i class="fas fa-plus mr-1"></i><b>Add New</b></button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-sm table-bordered bg-light" id="tbl_booklist"></table>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="modal_new_scope">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">New Book Scope</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frm_book_info" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="width: 200px">Book Title (English)<sup class="text-danger">*</sup></div>
                            </div>
                            <input type="text" class="form-control" id="txt_title_en" required>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="width: 200px">Book Title (Bangla)<sup class="text-danger">*</sup></div>
                            </div>
                            <input type="text" class="form-control" id="txt_title_bn" required>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="width: 200px">Author Name<sup class="text-danger">*</sup></div>
                            </div>
                            <select class="form-control select2" name="txt_writer" id="txt_writer" required>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="width: 200px">Publisher</div>
                            </div>
                            <select class="form-control select2" name="txt_publisher" id="txt_publisher" value="">
                                <option value=""></option>
                                <!-- <option value="P0000">Boighor - বইঘর</option> -->
                            </select>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="width: 200px">Category<sup class="text-danger">*</sup></div>
                            </div>
                            <select class="form-control" name="txt_category" id="txt_category" required>
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" style="width: 150px">Language<sup class="text-danger">*</sup></div>
                                </div>
                                <select class="form-control " id="txt_isenglishbook" required>
                                    <option value="0">Bangla</option>
                                    <option value="1">English</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" style="width: 150px">Type<sup class="text-danger">*</sup></div>
                                </div>
                                <select class="form-control " id="txt_isaudiobook" required>
                                    <option value="0">e-Book</option>
                                    <option value="1">Audiobook</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="col-9">
                        <button type="submit" class="btn btn-outline-danger w-100"><b>SUBMIT</b></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

$('#navlink_books').addClass('menu-open');
$('#navlink_newbook_scope').addClass('active');
$('.loading').addClass('d-none');

var table;
    // author
    var authorSelect = document.getElementById("txt_writer");
    var authorlist = <?php echo json_encode($authorlist); ?>;
    for (author of authorlist) {
        authorSelect.options.add(new Option(author.author+' - '+author.author_bn, author.authorcode));
    }

    // publisher
    var publisherSelect = document.getElementById("txt_publisher");
    var publisherlist = <?php echo json_encode($publisherlist); ?>;
    for (publisher of publisherlist) {
        publisherSelect.options.add(new Option(publisher.publishername_en+' - '+publisher.publishername_bn, publisher.publishercode));
    }

    //  category
    var categorySelect = document.getElementById("txt_category");
    var categoryList = <?php echo json_encode($categoryList); ?>;
    for (category of categoryList) {
        categorySelect.options.add(new Option(category.catname_en+' - '+category.catname_bn, category.catcode));
    }

    $('#txt_isaudiobook').on('change', function(e) {
        if (this.value==1) {
            $('#txt_audiobookcode').val('');
            $('#txt_audiobookcode').attr('disabled', true);
        } else {
            $('#txt_audiobookcode').attr('disabled', false);
        }
    });

    $('.select2').select2({
        theme: 'bootstrap4',
        placeholder: "Select",
        allowClear: true
     });
    $('#txt_genre').trigger('change');

    $('#frm_book_info').on('submit', function(e){
        e.preventDefault();
        // Swal.fire({
        //     title: 'Are you sure?',
        //     text: "Confirm Create New Book",
        //     type: "warning",
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Yes'
        // }).then((result) => {
        //     if (result.value) {
                var data = {};
                data['bookname'] = document.getElementById('txt_title_en').value;
                data['bookname'] = data['bookname'].charAt(0).toUpperCase() + data['bookname'].slice(1);
                data['bookname_bn'] = document.getElementById('txt_title_bn').value;
                data['writercode'] = $("#txt_writer option:selected").val();
                data['writer'] = $("#txt_writer option:selected").text().split(" - ")[0];
                data['writer_bn'] = $("#txt_writer option:selected").text().split(" - ")[1];
                data['publishercode'] = document.getElementById('txt_publisher').value;
                data['publisher'] = $("#txt_publisher option:selected").text().split(" - ")[0];
                data['publisher_bn'] = $("#txt_publisher option:selected").text().split(" - ")[1];
                data['publisher'] = (data['publisher'] ? data['publisher'].trim() : '');
                data['publisher_bn'] = (data['publisher_bn'] ? data['publisher_bn'].trim() : '');
                data['category'] = document.getElementById('txt_category').value;
                data['isenglishbook'] = document.getElementById('txt_isenglishbook').value;
                data['isaudiobook'] = document.getElementById('txt_isaudiobook').value;
                $.ajax({
                    url: "<?php echo base_url() ?>book/addNewBookScope",
                    type: "POST",
                    data: data,
                    success: function(data){
                        console.log(data);
                        if (data == 1) {
                            Swal.fire({
                                title: 'Book Added Successfully',
                                type: "success",
                                timer: 1000
                            }).then((result) => {
                                //location.reload();
                                generateDataTable()
                                $('#frm_book_info')[0].reset();
                                $('#txt_writer').val('').trigger('change');
                                $('#txt_publisher').val('').trigger('change');
                            });
                        } else {
                            Swal.fire("Oops", "Something Went Wrong!", "error").then((result) => {
                                location.reload();
                            });
                        }
                    },
                    error: function() {
                        Swal.fire("Oops", "Something Went Wrong!", "error").then((result) => {
                            location.reload();
                        });
                    }
                });
        //     }
        // });
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

    generateDataTable()
    function generateDataTable() {

        if (table) {
            table.destroy();
            document.getElementById('tbl_booklist').innerHTML = '';
        }

        table = $('#tbl_booklist').DataTable( {
            processing: true,
            serverSide: true,
            stateSave : true,
            ordering : true,
            hilighting: false,
            responsive: false,
            pagingType: 'full_numbers',
            ajax: {
                url: "<?php echo base_url(); ?>book/get_book_scopes",
                type: 'POST',
                dataFilter: function(data){
                    sl = jQuery.parseJSON(data)['start'];
                    return data;
                },
                error: function(err){
                    console.log(err);
                }
            },
            rowId: 'bookcode',
            order: [ 0, "desc" ],
            columns: [
                {
                    "title": "SL",
                    "data": "timeofentry",
                    render: function (data, type, row) {
                        return ++sl;
                    }
                },
                {
                    "title": "Title",
                    "data": "bookname_bn"
                },
                {
                    "title": "Write",
                    "data": "writer_bn"
                },
                {
                    "title": "Publisher",
                    "data": "publisher_bn"
                },
                {
                    "title": "Category",
                    "data": "category_bn"
                },
                {
                    "title": "Created",
                    "data": "dateofaddition",
                    render: function (data) {
                        return data ? data.substring(0,10) : "N/A";
                    }
                },
                {
                    "title": "Created By",
                    "data": "addedby",
                    render: function (data) {
                        return data ? data.substring(0,1).toUpperCase()+data.substring(1) : "N/A";
                    }
                },
                // {
                //     "title": "Action",
                //     "data": "bookcode",
                //     render: function (data, type, service) {
                //         var button_1 = "<a href='javascript:void(0)' class='btn btn-sm btn-default btn-primary mr-2'><i class='fas fa-edit mr-1'></i>Edit</a>";
                //         return button_1;
                //     }
                // }
            ],
            fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
                return "Showing " + iStart +" to "+ iEnd + " of " + iTotal + " Books • Filtered from "+iMax+" Books";
            },
        } );
        // $('#tbl_booklist thead').css("background-color", "#rgb(45, 126, 127)").css("color", "white");
    }

</script>
