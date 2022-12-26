<style>

.redearview{
    height:500px;
    width:100%;

}
@media screen and (max-width: 420px) {
    .redearview{
        height:720px;width:100%;
    }
}
</style>

<div class="content-header">
    <div class="container-fluid">

        <?php $url = 'https://remote.ebsbd.com/ebswap/futurepress-cms/reader/index.html?bookPath=https://remote.ebsbd.com/ebswap/_oljkz/'.$filename.'#epubcfi(/6/4[titlePageContent]!/4/2/4/2/1:0)'; ?>

        <div class="row">
            <iframe src="<?php //echo $url; ?>" class="<?php echo $bookcode ?>" id="<?php echo $bookcode ?>" style="position:fixed; top:0; left:0; bottom:0; right:0; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;">
                Your browser doesn't support this reader.
            </iframe>
        </div>
    </div>
</div>

<script>

$('#navlink_books').addClass('menu-open');
$('#navlink_booklist').addClass('active');
$('.loading').addClass('d-none');

var filename = '<?=$filename ?>';
var bookcode = '<?=$bookcode ?>';
var type = '<?=$type ?>';
// $.ajax({
//     url: "<?php //echo base_url() ?>reader/getFilename",
//     method: "POST",
//     data: {
//         'bookcode' : bookcode,
//     },
//     success:function(data) {
//         console.log(data);
//         var url = 'https://remote.ebsbd.com/ebswap/futurepress/reader/index.html?bookcode='+bookcode+'&bookPath=https://remote.ebsbd.com/ebswap/_oljkz/'+data+'#epubcfi(/6/4[titlePageContent]!/4/2/4/2/1:0)';
//         $('iframe').attr('src', url);
//     },
//     error: function() {
//         console.log(data);
//     }
// });
if (type=='preview') {
    var url = 'https://cms.boighor.com/futurepress/reader/index.html?bookcode='+bookcode+'&bookPath=https://boighor-content.s3.ap-southeast-1.amazonaws.com/media/books_preview/'+bookcode+'.epub#epubcfi(/6/4[titlePageContent]!/4/2/4/2/1:0)';
} else {
    var url = 'https://cms.boighor.com/futurepress/reader/index.html?bookcode='+bookcode+'&bookPath=https://boighor-content-ebook.s3.ap-southeast-1.amazonaws.com/media/_oljkz/'+filename+'#epubcfi(/6/4[titlePageContent]!/4/2/4/2/1:0)';
}
$('iframe').attr('src', url);
</script>
