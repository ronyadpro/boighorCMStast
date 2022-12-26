<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="<?= base_url('user/boighorglobal'); ?>">Users</a></li>
                    <li class="breadcrumb-item active"><?= $userdetails['msisdn'] ?></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username"><?= $userdetails['fullname'] ?: "Username not found" ?></h3>
                        <h5 class="widget-user-desc"><?= isset($ip_details->{'countryname'}) ? $ip_details->{'countryname'} : 'Country Not Found' ?></h5>
                    </div>
                    <div class="widget-user-image">
                        <?php if($userdetails['userimageurl'] == '' && ($userdetails['publicimgurl'] == '' || $userdetails['publicimgurl'] == 'null')){ ?>
                            <img class="img-circle elevation-2" src="https://remote.ebsbd.com/admin/live/dist/img/default-user.jpg" alt="User Avatar">
                        <?php } else if($userdetails['userimageurl'] != '') { ?>
                            <img class="img-circle elevation-2" src="<?= "https://d1b3dh5v0ocdqe.cloudfront.net/media/userimage/".$userdetails['msisdn'].".jpg" ?>" alt="User Avatar">
                        <?php } else { ?>
                            <img class="img-circle elevation-2" src="<?= $userdetails['publicimgurl'] ?>" alt="User Avatar">
                        <?php } ?>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><?= array_sum(array_column($transactionhistory, 'amount')).'৳'; ?></h5>
                                    <span class="description-text">PURCHASED</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><?= (sizeof($activityhistory)>0) ? date('Y-m-d', strtotime(array_values($activityhistory)[0]['timeofentry'])) : ''; ?></h5>
                                    <span class="description-text">LAST ACTIVE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header"><?= sizeof($booklist) ?></h5>
                                    <span class="description-text">BOOKS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
            <div class="col-sm-8">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info mr-1"></i>User Information</h3>
                        <input type="hidden" id="userid" value="<?= $userdetails['msisdn'] ?>" >
                    </div>
                    <table class="table table-bordered table-sm m-0">
                        <?php //foreach ($userdetails as $key => $value): ?>
                            <tr>
                                <td><b>User ID</b></td>
                                <td style="color: #17a2b8; font-weight: 600;"><?= $userdetails['msisdn'] ?></td>
                                <td><b>Name</b></td>
                                <td><?= $userdetails['fullname'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Email</b></td>
                                <td><?= $userdetails['email'] ?></td>
                                <td><b>PIN</b></td>
                                <td><?= $userdetails['pincode'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Date of Birth</b></td>
                                <td><?= $userdetails['dob']=='0000-00-00'?'':$userdetails['dob'] ?></td>
                                <td><b>Gender</b></td>
                                <td><?= $userdetails['gender'] ?></td>
                            </tr>

                            <tr>
                                <td><b>Register Date</b></td>
                                <td><?= $userdetails['signupdate'] ?></td>
                                <td><b>Android Version</b></td>
                                <td> <span> <b> <?= $config['web']['currentversion'] ?> </b> </span></td>
                            </tr>
                            <tr>
                                <td><b>Platform</b></td>
                                <td style="color: #20c997; font-weight: 600;"><?= $userdetails['loginsrc']?:'mobile' ?></td>
                                <td><b>iOS Version</b></td>
                                <td> <span> <b> <?= $config['ios']['currentversion'] ?> </b> </span></td>
                            </tr>
                            <tr>
                                <td><b>Source</b></td>
                                <td><?= $userdetails['signupfrom']=='app'?'Android':$userdetails['signupfrom'] ?></td>
                                <td><b>User Version</b></td>
                                <td>
                                    <?php if ($config['web']['currentversion'] == array_reverse($activityhistory)[0]['versionCode'] || $config['web']['currentversion'] == array_reverse($activityhistory)[0]['versionCode']): ?>
                                        <span class="text-success">
                                            <b>
                                                <?= array_reverse($activityhistory)[0]['versionCode'] ?>
                                            </b>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-danger">
                                            <b>
                                                <?= array_reverse($activityhistory)[0]['versionCode'] ?>
                                            </b>
                                        </span>
                                    <?php endif; ?>
                                    <?php if (!empty($browsinghistory)): ?>
                                        <b class="ml-2">(<?= array_reverse($browsinghistory)[0]['fromsrc']=='app'?'Android':$userdetails['signupfrom'] ?>)</b>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><b>User Device</b></td>
                                <td>
                                    <?= isset($deviceid['deviceid']) ? $deviceid['deviceid'] : '' ?>
                                    <button data-toggle="modal" data-target="#modal_edit_device" class="btn btn-sm pt-0 pb-0 text-warning" type="button"><i class="fas fa-exchange-alt text-warning mr-1"></i>change device</button>
                                </td> 
                                <td colspan="2">
                                    <button id="btn_add" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#modal-add-item" type="button" id="button"><i class="fas fa-plus mr-1"></i>Add Book</button>
                                </td>
                            </tr>
                            <?php //endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-bell mr-1"></i>Push Notification ID</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <input readonly type="text" class="form-control" id="fcmid" placeholder="Not Available" value="<?= isset($fcm['fcmid']) ? $fcm['fcmid'] : '' ?>">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" onclick=copyToClipboard("#fcmid")><i class="far fa-copy mr-1"></i> Copy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-comments mr-1"></i>In-App Messaging ID</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <input readonly type="text" class="form-control" id="inappid" placeholder="Not Available" value="<?= isset($fcm['inappid']) ? $fcm['inappid'] : '' ?>">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" onclick=copyToClipboard("#inappid")><i class="far fa-copy mr-1"></i> Copy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-code mr-1"></i>Last Device ID</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <?php foreach ($activityhistory as $key => $trx): ?>
                                        <input readonly type="text" class="form-control" id="deviceid" placeholder="Not Available" value="<?= $trx['deviceId'] ?: '' ?>">
                                        <?php break; ?>
                                    <?php endforeach; ?>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" onclick=copyToClipboard("#deviceid")><i class="far fa-copy mr-1"></i> Copy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-book mr-1"></i>Book List</h3>
                        </div>
                        <table class="table">
                            <thead>
                                <th>#</th>
                                <th>Time</th>
                                <th>bookcode</th>
                                <th>BookName</th>
                                <th>Writer</th>
                                <th>Price</th>
                                <th>DownLoad Count</th>
                                <th>ObtainedBy</th>
                            </thead>
                            <tbody>
                                <?php foreach ($booklist as $key => $book): ?>
                                    <tr>
                                        <td><?= 1+(int)$key ?></td>
                                        <td><?= $book['pagehittime'] ?></td>
                                        <td><?= $book['bookcode'] ?></td>
                                        <td><?= $book['bookname_bn'] ?></td>
                                        <td><?= $book['writer_bn'] ?></td>
                                        <td><?= $book['bookprice'] ?></td>
                                        <td><?= $book['redownload'] ?></td>
                                        <td><?= $book['obtainedby'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-search-dollar mr-1"></i>Transaction History</h3>
                        </div>
                        <table class="table">
                            <thead>
                                <th>#</th>
                                <th>Time</th>
                                <th>IP</th>
                                <th>Order ID</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Payment ID</th>
                                <th>Country</th>
                            </thead>
                            <tbody>
                                <?php foreach ($transactionhistory as $key => $trx): ?>
                                    <tr>
                                        <td><?= 1+(int)$key ?></td>
                                        <td><?= $trx['timeofentry'] ?></td>
                                        <td><?= $trx['remoteaddr'] ?></td>
                                        <td><?= $trx['orderId'] ?></td>
                                        <td><?= $trx['amount'] ?></td>
                                        <td><?= $trx['paymentmethod'].'/'.$trx['paynetwork'] ?></td>
                                        <td><?= $trx['paymentId'] ?></td>
                                        <td><?= $trx['countryname'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card card-outline card-danger collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-history mr-1"></i>Login History</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Time</th>
                                    <th>IP</th>
                                    <th>Operator</th>
                                    <th>Deviceid</th>
                                    <th>Model</th>
                                    <th>Adroid Ver.</th>
                                    <th>App Ver.</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($activityhistory as $key => $trx): ?>
                                        <tr>
                                            <td><?= 1+(int)$key ?></td>
                                            <td><?= $trx['timeofentry'] ?></td>
                                            <td><?= $trx['remoteaddr']/*.':'.$trx['remoteport']*/ ?></td>
                                            <td><?= $trx['operatorName'] ?></td>
                                            <td><?= $trx['deviceId'] ?></td>
                                            <td><?= $trx['brand'].' - '.$trx['model'] ?></td>
                                            <td><?= $trx['rel'].($trx['sdkVersion']?'('.$trx['sdkVersion'].')':'') ?></td>
                                            <td><?= $trx['versionCode'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card card-outline card-danger collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-history mr-1"></i>Browsing History</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Time</th>
                                    <th>IP</th>
                                    <th>API</th>
                                    <th>Param</th>
                                    <th>Src</th>
                                    <th>UA</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($browsinghistory as $key => $trx): ?>
                                        <tr>
                                            <td><?= 1+(int)$key ?></td>
                                            <td><?= $trx['created'] ?></td>
                                            <td><?= $trx['remoteaddr'] ?></td>
                                            <td><?= $trx['api'] ?></td>
                                            <td><?= $trx['param'] ?></td>
                                            <td><?= $trx['fromsrc'] ?></td>
                                            <td><?= $trx['useragent'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card card-outline card-danger collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-shopping-cart mr-1"></i>Cart History</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Time</th>
                                    <th>OrderID</th>
                                    <th>Book</th>
                                    <th>Price</th>
                                    <th>Sell Price</th>
                                    <th>Disc%</th>
                                    <th>Promocode</th>
                                    <th>Status</th>
                                    <!-- <th>Ver.</th> -->
                                </thead>
                                <tbody>
                                    <?php foreach ($carthistory as $key => $trx): ?>
                                        <?php $status = in_array($trx['orderid'], array_column($transactionhistory, 'orderId')) ? 'Purchased' : 'Unpurchased'; ?>
                                        <tr>
                                            <td><?= 1+(int)$key ?></td>
                                            <td><?= $trx['created'] ?></td>
                                            <td><?= $trx['orderid'] ?></td>
                                            <td><?= $trx['bookcode'].' - '.$trx['bookname_bn'] ?></td>
                                            <td><?= $trx['bookprice'] ?></td>
                                            <td><?= $trx['sellingprice'] ?></td>
                                            <td><?= $trx['discountpercent'] ?></td>
                                            <td><?= $trx['promocode'] ?></td>
                                            <td> <span class="badge badge-<?= $status=='Purchased' ? 'success' : 'secondary' ?>"> <?= $status ?> </span></td>
                                            <!-- <td><?//= $trx['version'] ?></td> -->
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card card-outline card-danger collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-search-dollar mr-1"></i>Payment Initiation</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Time</th>
                                    <th>OrderID</th>
                                    <th>Payment Method</th>
                                    <th>PaymentID</th>
                                    <th>Status</th>
                                    <th>Payment Message</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($payinithistory as $key => $trx): ?>
                                        <tr>
                                            <td><?= 1+(int)$key ?></td>
                                            <td><?= $trx['timeofentry'] ?></td>
                                            <td><?= $trx['orderid'] ?></td>
                                            <td><?= $trx['paymentmethod'] ?></td>
                                            <td><?= $trx['paymentid'] ?></td>
                                            <td><?= strtoupper($trx['status']) ?></td>
                                            <td><?= $trx['errormsg'] ?></td>
                                            <td>
                                                <?php if ($trx['paymentmethod']!='portpos') { ?>
                                                <?php } else if ($trx['statuschecked'] == 1 || $trx['status'] == 'CHARGED' || strtoupper($trx['status']) == 'FAILED') { ?>
                                                    <button class="btn btn-sm pt-0 pb-0 text-success" disabled type="button"><i class="fas fa-check text-success mr-1"></i>checked</button>
                                                <?php } else { ?>
                                                    <button onclick="payment_recheck('<?= $trx['orderid']?>','<?= $trx['paymentmethod']?>', '<?= $trx['paymentid']?>')" class="btn btn-sm pt-0 pb-0 text-warning" type="button"><i class="fas fa-undo text-warning mr-1"></i>re-check</button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-add-item">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h4 class="modal-title">Add Book</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frm_gift_book_item" method="post">
                    <div class="modal-body">

                        <div class="row justify-content-center mt-2">
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Book Code</i></span>
                                    </div>
                                    <input id="txt_bookcode" onInput="getBookInfo()" name="txt_bookcode" maxlength="50" type="text" class="form-control capitalize" placeholder="Enter valid bookcode" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Type</i></span>
                                    </div>
                                    <select id="txt_obtain_type" name="txt_obtain_type" class="form-control" required>
                                        <option value="gift" selected>Gift</option>
                                        <option value="purchased" selected>Purchase</option>
                                        <option value="development" selected>Development</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Book name EN</i></span>
                                    </div>
                                    <input readonly id="txt_bookname_en" name="txt_bookname_en" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Book name BN</i></span>
                                    </div>
                                    <input readonly id="txt_bookname_bn" name="txt_bookname_bn" type="text" class="form-control" required>
                                </div>
                            </div>



                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Book Author</i></span>
                                    </div>
                                    <input readonly id="txt_writer" name="txt_writer" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Book Publisher</i></span>
                                    </div>
                                    <input readonly id="txt_publisher" name="txt_publisher" type="text" class="form-control" required>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="btn_gift_submit" class="btn btn-primary" disabled type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit_device">
        <div class="modal-dialog">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h4 class="modal-title">Change/Update Device</h4>
                    <button type="button" class="close_device" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frm_edit_device" method="post">
                    <div class="modal-body">
                        <div class="row justify-content-center mt-2">
                            <div class="col-12">
                                <label>Device Information</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Current device</i></span>
                                    </div>
                                    <input id="txt_edit_cd" type="text" value="<?= $deviceid['deviceid'] ?: '' ?>" class="form-control" disabled required> 
                                </div> 
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">New device Id</i></span>
                                    </div>
                                    <input id="txt_edit_device_id" type="text" class="form-control" required>
                                </div>                                 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close </button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">

    function getBookInfo()
    {
        var g_bookcode = document.getElementById("txt_bookcode").value;
        if (g_bookcode.length >= 8) {
            $.ajax({
                url: "<?= base_url('user/get_bookDetails'); ?>",
                type: "POST",
                data: {'bookcode': g_bookcode},
                success: function(data){
                    //console.log(data);
                    var responsedata = JSON.parse(data);
                    document.getElementById('txt_bookname_en').value = responsedata['bookname'];
                    document.getElementById('txt_bookname_bn').value = responsedata['bookname_bn'];
                    document.getElementById('txt_writer').value = responsedata['writer'];
                    document.getElementById('txt_publisher').value = responsedata['publisher'];
                    document.getElementById("btn_gift_submit").disabled = false;
                    if (responsedata['status_global'] == 0) {
                        toastr.warning('This book is currently offline on Boighor');
                    }
                },
                error: function() {
                    toastr.success('Book information not found');
                }
            });
        } else {
            //console.log(g_bookcode);
            document.getElementById('txt_bookname_en').value = '';
            document.getElementById('txt_bookname_bn').value = '';
            document.getElementById('txt_writer').value = '';
            document.getElementById('txt_publisher').value = '';
            document.getElementById("btn_gift_submit").disabled = true;
        }

    }

    $('#frm_gift_book_item').on('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are You Sure?',
            text: 'want to gift book to this user',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.value) {

                var form_data = {}
                form_data['userid'] = document.getElementById('userid').value;
                form_data['bookcode'] = document.getElementById("txt_bookcode").value;
                form_data['obtaintype'] = document.getElementById('txt_obtain_type').value;
                if (form_data['userid'] != '' && form_data['bookcode'] != '') {

                    $.ajax({
                        url: "<?= base_url('user/add_book_to_userprofile'); ?>",
                        type: "POST",
                        data: form_data,
                        success: function(data){
                            console.log(data);

                            if (data == 1) {
                                Swal.fire("Success", "Book added to profile", "success").then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire("Oops!!!", "Book already exists in the profile", "error").then((result) => {
                                    location.reload();
                                });
                            }

                        },
                        error: function() {
                            Swal.fire("Oops!!!", "Something went wrong", "error").then((result) => {
                                location.reload();
                            });
                        }
                    });

                }

            }
        });
    }); 

    $('#frm_edit_device').on('submit', function(e) {
        e.preventDefault();
        var data = {};
        data['msisdn'] = $('#userid').val();
        data['deviceid'] = $('#txt_edit_device_id').val();  

        $.ajax({
            url: "<?php echo base_url() ?>user/editDevice",
            method: "POST",
            data: data,
            success:function(data) { 
                // console.log(data);
                if (data == 401) {
                    Swal.fire("Session Expired", "Please Login Again", "warning").then((result) => {
                        document.location = "<?php echo base_url() ?>";
                    });
                } else if (data == 1) {
                    Swal.fire("Device Information Updated Successfully", "", "success").then((result) => {
                        location.reload();
                        $('.close_device').click();
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
    });


    function payment_recheck(orderid,gateway,paymentid){

        var userid = document.getElementById('userid').value;
        if (orderid != '' || gateway != '' || paymentid != '' || userid != '') {
            var form_data = {}
            form_data['userid'] = userid;
            form_data['orderid'] = orderid;
            form_data['sptransactionid'] = paymentid;
            form_data['paymenttype'] = gateway;
            form_data['checkedby'] = '<?php echo $_SESSION['username']; ?>';

            Swal.fire({
                title: 'Do you want to check payment status?',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "https://api.boighor.com/checkout/paymentStatusCheckFromCms",
                        type: "POST",
                        data: form_data,
                        success: function(data){
                            console.log(data);
                            if (data == 1) {
                                Swal.fire("Success", "Data fetched and updated successfully", "success").then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire("Oops!!!", "Something Went Wrong!", "error").then((result) => {
                                    location.reload();
                                });
                            }
                        },
                        error: function() {
                            Swal.fire("Oops!!!", "Some error occured", "error").then((result) => {
                                location.reload();
                            });
                        }
                    });
                }
            });
        }else {
            Swal.fire("Information not valid", "Please check every field is valid", "error");
        }

    }

    $('#navlink_userlist').addClass('menu-open');
    $('#navlink_userlist_boighorglobal').addClass('active');
    $('.loading').addClass('d-none');

</script>
