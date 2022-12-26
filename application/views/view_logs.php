<section class="content">
    <div class="container-fluid">

        <div class="row mb-4">
            <div class="col-sm-9">
                <h1 class="m-0 text-dark">Timeline</h1>
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="timeline">
                    <div class="time-label">
                        <span class="bg-light">
                            <select id="userpicker" class="form-control form-control-sm bg-success">
                                <?php if ($userinfo['level'] == 6 || $userinfo['username'] == 'anarjo'): ?>
                                    <option value="all">All</option>
                                    <option value="anarjo">Anarjo</option>
                                    <option value="bhuyan">Bhuyan</option>
                                    <option value="sumaiya">Sumaiya</option>
                                    <option value="aryan.mahbub">Aryan</option>
                                    <option value="shomeshwar.oli">Oli</option>
                                    <option value="mynul">Mynul</option>
                                    <option value="sanaullah">Sanaullah</option>
                                    <option value="rajuwan">Rajuwan</option>
                                    <option value="shuvodeep">Shuvodeep</option>
                                <?php else: echo "<option value='".$userinfo['username']."'>".ucwords($userinfo['username'])."</option>";?>

                                <?php endif; ?>
                            </select>
                        </span>
                    </div>
                    <div class="time-label">
                        <span class="bg-light">
                            <input id="datepicker" class="form-control form-control-sm bg-success" type="date" value="<?= $date ?>">
                        </span>
                        To
                        <span class="bg-light">
                            <input id="datepicker_to" class="form-control form-control-sm bg-success" type="date" value="<?= $date_to ?>">
                        </span>
                    </div>
                    <div class="time-label">
                        <span class="bg-warning">
                            <?php echo isset($logs[0]) ? "<small> From </small>".$logs[sizeof($logs)-1]->timeofentry."<small> to </small>".$logs[0]->timeofentry."<small> • Total</small> ".sizeof($logs)."<small> logs </small>" : "" ?>
                        </span>
                    </div>
                    <?php if (isset($logs[0])) { foreach ($logs as $log):
                        ?>
                        <div>
                            <?php if (strpos($log->whatyoudid, 'info')): ?>
                                <i class="fas fa-info bg-primary"></i>
                            <?php elseif (strpos($log->whatyoudid, 'genre')): ?>
                                <i class="fas fa-theater-masks bg-warning"></i>
                            <?php elseif (strpos($log->whatyoudid, 'tags')): ?>
                                <i class="fas fa-tags bg-success"></i>
                            <?php elseif (strpos($log->whatyoudid, 'pricing')): ?>
                                <i class="fas fa-dollar-sign bg-danger"></i>
                            <?php elseif (strpos($log->whatyoudid, 'status')): ?>
                                <i class="fas fa-broadcast-tower bg-danger"></i>
                            <?php elseif (strpos($log->whatyoudid, 'audiobook')): ?>
                                <i class="fas fa-volume-up bg-primary"></i>
                            <?php else: ?>
                                <i class="fas fa-clock bg-secondary"></i>
                            <?php endif; ?>
                            <div class="timeline-item <?php echo $log->response ? '' : 'bg-danger' ?>">
                                <span class="time"><i class="fas fa-clock mr-1"></i> <?= $log->timeofentry ?></span>
                                <h3 class="timeline-header">
                                    <?php
                                        $wyd = $log->whatyoudid;
                                     ?>
                                    <a><?php echo ucfirst($log->usr) ?> </a><span><?php echo ucwords(explode(" - ", $wyd)[0]) ?> • </span>
                                    <?php
                                        $bookurl = base_url()."book/overview/";
                                        $authorurl = base_url()."author/overview/";
                                        $categoryurl = base_url()."book/category/";
                                        $genreurl = base_url()."book/genre/";
                                        $code = isset(explode(" - ", $wyd)[1]) ? (explode(" - ", $wyd)[1]) : '';
                                        if (strlen($code) == 8) {
                                            $url = $bookurl.$code;
                                        } else if (strlen($code) == 5) {
                                            $url = $authorurl.$code;
                                        } else if (strlen($code) == 3) {
                                            if (strpos($log->whatyoudid, 'category')) {
                                                $url = $categoryurl;
                                            } else {
                                                $url = $genreurl;
                                            }
                                        } else {
                                            $url = '';
                                        }
                                     ?>
                                    <a href="<?php echo $url ?>">
                                        <?php echo ucfirst(explode(" - ", $wyd)[sizeof(explode(" - ", $wyd))-1]) ?>
                                    </a>
                                </h3>
                            </div>
                        </div>
                    <?php endforeach; } else { ?>
                        <div>
                            <i class="fas fa-times bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> <?php echo date_format(date_create(),"H:i") ?></span>
                                <h3 class="timeline-header"><a>No Records Found</a></h3>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">

    // $('input[name$="navlink"]')
    $('#navlink_timeline').addClass('nav-link active');
    $('.loading').addClass('d-none');

    $('#userpicker').val('<?php echo $username ?>');

    $('#datepicker, #datepicker_to, #userpicker').change(function() {
        document.location = "<?php echo base_url() ?>dashboard/timeline/"+$('#userpicker').val()+"/"+$('#datepicker').val()+"/"+$('#datepicker_to').val();
    });

</script>
