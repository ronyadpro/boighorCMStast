<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-9">
                <h1 class="m-0 text-dark">Add New Audiobook</h1>
            </div><!-- /.col -->
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>/book/booklist">Books</a></li>
                    <li class="breadcrumb-item active">New Audiobook</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row justify-content-center">
            <div class="col-sm-9">
                <div class="row">
                    <div class="card">
                        <div class="col-12">
                            <div class="card-body">
                                <form id="frm_book_info" method="post">
                                    <div class="row">
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="width: 200px">Book Code</div>
                                            </div>
                                            <input type="text" class="form-control" id="txt_bookcode" placeholder="e.g. 0894AD11 or e5e59740" required>
                                        </div>
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="width: 200px">Book Title (English)</div>
                                            </div>
                                            <input type="text" class="form-control capitalize" id="txt_title_en" required>
                                        </div>
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="width: 200px">Book Title (Bangla)</div>
                                            </div>
                                            <input type="text" class="form-control" id="txt_title_bn" required>
                                        </div>
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="width: 200px">Author Name</div>
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
                                            </select>
                                        </div>
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="width: 200px">Category</div>
                                            </div>
                                            <select class="form-control" name="txt_category" id="txt_category" required>
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="width: 200px">Genre</div>
                                            </div>
                                            <select class="select2" multiple="multiple" name="txt_genre" id="txt_genre" required></select>
                                        </div>
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="width: 200px">Book Summary</div>
                                            </div>
                                            <textarea class="form-control" id="txt_booksummary" rows="1"></textarea>
                                        </div>
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="width: 200px">Price Local</div>
                                            </div>
                                            <select class="form-control" id="txt_isfree_local" required>
                                                <option value="">Select</option>
                                                <option value="1">Free</option>
                                                <option value="0">Paid</option>
                                            </select>
                                            <select class="form-control" id="txt_price_local" required>
                                                <option value="">Select</option>
                                                <!-- <option value="0">৳0 - ফ্রী বই</option>
                                                <option value="10">৳12.18 - ৳১২.১৮</option>
                                                <option value="15">৳18.26 - ৳১৮.২৬</option>
                                                <option value="20">৳24.35 - ৳২৪.৩৫</option> -->
                                            </select>
                                        </div>
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="width: 200px">Price Global</div>
                                            </div>
                                            <select class="form-control" id="txt_isfree_global" required>
                                                <option value="">Select</option>
                                                <option value="1">Free</option>
                                                <option value="0">Paid</option>
                                            </select>
                                            <select class="form-control" id="txt_price_global" required>
                                                <option value="">Select</option>
                                                <!-- <option value="0">$0</option>
                                                <option value="0.99">$0.99</option> -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-5">
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style="width: 150px">Language</div>
                                                </div>
                                                <select class="form-control " id="txt_isenglishbook" required>
                                                    <option value="">Select</option>
                                                    <option value="0">Bangla</option>
                                                    <option value="1">English</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style="width: 160px">Audio Book Code</div>
                                                </div>
                                                <input type="text" class="form-control" id="txt_audiobookcode" placeholder="(Optional)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mt-2">
                                        <button type="submit" class="btn btn-outline-danger">Create New Book</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$('#navlink_books').addClass('menu-open');
$('#navlink_newbook').addClass('active');
$('.loading').addClass('d-none');

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

    //  genre
    var genreSelect = document.getElementById("txt_genre");
    var genreList = <?php echo json_encode($genreList); ?>;
    for (genre of genreList) {
        genreSelect.options.add(new Option(genre.genre_en+' - '+genre.genre_bn, genre.genre_code));
    }

    //  price_local
    var localPriceSelect = document.getElementById("txt_price_local");
    var localPriceList = <?php echo json_encode($localPriceList); ?>;
    for (localPrice of localPriceList) {
        localPriceSelect.options.add(new Option(localPrice.bookprice_en+' - '+localPrice.bookprice_bn, localPrice.bookprice));
    }

    //  price_global
    var globalPriceSelect = document.getElementById("txt_price_global");
    var globalPriceList = <?php echo json_encode($globalPriceList); ?>;
    for (globalPrice of globalPriceList) {
        globalPriceSelect.options.add(new Option('$'+globalPrice.price, globalPrice.id));
    }

    $('.select2').select2({
        theme: 'bootstrap4',
        placeholder: "Select",
        allowClear: true
     });
    $('#txt_genre').trigger('change');

    // var price_local = document.getElementById("txt_price_local");
    // var price_global = document.getElementById("txt_price_global");
    // price_local.options[1].disabled = true;
    // price_local.options[2].disabled = true;
    // price_local.options[3].disabled = true;
    // price_local.options[4].disabled = true;
    // price_global.options[1].disabled = true;
    // price_global.options[2].disabled = true;

    // $('#txt_isfree_local').on('change', function() {
    //     if (this.value == 1) {
    //         $('#txt_price_local').val(0);
    //         price_local.options[0].disabled = true;
    //         price_local.options[1].disabled = false;
    //         price_local.options[2].disabled = true;
    //         price_local.options[3].disabled = true;
    //         price_local.options[4].disabled = true;
    //     } else {
    //         $('#txt_price_local').val(10);
    //         price_local.options[0].disabled = true
    //         price_local.options[1].disabled = true
    //         price_local.options[2].disabled = false
    //         price_local.options[3].disabled = false
    //         price_local.options[4].disabled = false;
    //     }
    // });
    // $('#txt_isfree_global').on('change', function() {
    //     if (this.value == 1) {
    //         $('#txt_price_global').val(0);
    //         price_global.options[0].disabled = true;
    //         price_global.options[1].disabled = false;
    //         price_global.options[2].disabled = true;
    //     } else {
    //         $('#txt_price_global').val(0.99);
    //         price_global.options[0].disabled = true;
    //         price_global.options[1].disabled = true;
    //         price_global.options[2].disabled = false;
    //     }
    // });


    $('#frm_book_info').on('submit', function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "Confirm Create New Book",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                var data = {};
                data['bookcode'] = document.getElementById('txt_bookcode').value;
                data['bookname'] = document.getElementById('txt_title_en').value;
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
                data['genre'] = $('#txt_genre').val();
                data['booksummary'] = document.getElementById('txt_booksummary').value;
                data['isfree'] = document.getElementById('txt_isfree_local').value;
                data['isfreeglobal'] = document.getElementById('txt_isfree_global').value;
                data['bookprice'] = document.getElementById('txt_price_local').value;
                var bookprice_select_div = document.getElementById("txt_price_local");
                data['bookprice'] = bookprice_select_div.value;
                var bookprice_text = bookprice_select_div.options[bookprice_select_div.selectedIndex].text;
                data['bookprice_en'] = bookprice_text.split(" - ")[0];
                data['bookprice_bn'] = bookprice_text.split(" - ")[1];
                data['bookprice_global'] = document.getElementById('txt_price_global').value;
                data['isenglishbook'] = document.getElementById('txt_isenglishbook').value;
                data['audiobookcode'] = document.getElementById('txt_audiobookcode').value;
                $.ajax({
                    url: "<?php echo base_url() ?>book/addNewAudiobookInfo",
                    type: "POST",
                    data: data,
                    success: function(data){
                        console.log(data);
                        if (data == 111) {
                            Swal.fire("Done", "Book Added Successfully", "success").then((result) => {
                                document.location = "<?php echo base_url() ?>book/overview/"+$('#txt_bookcode').val();
                            });
                        } else if (data == 2) {
                            Swal.fire({
                                title: 'Duplicate Book',
                                text: "A book exists with the same Book-Code",
                                type: "error",
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'See Duplicate Book',
                                cancelButtonText: 'Cancel'
                            }).then((result) => {
                                if (result.value) {
                                    document.location = "<?php echo base_url() ?>book/overview/"+$('#txt_bookcode').val();
                                }
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
            }
        });
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
</script>
