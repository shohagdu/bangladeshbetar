<div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
        <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>

        <h2><span class="no-print"><?php echo e($page_title); ?>  </span></h2>

        <button onclick="print_fun()"
                class="btn btn-warning btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                    class="glyphicon glyphicon-print"></i>
            Print
        </button>
    </header>

    <div>
        <div class="widget-body no-padding">
            <div class="col-sm-12">
                <div class="col-sm-12" style="height: 10px;"></div>
                <table style="width:100%;border:1px solid #d0d0d0" rules="all" class="table table-bordered "
                       id="table-style">
                    <tr>
                        <th style="width:5%;">নং</th>
                        <th>শিল্পীর নাম</th>
                        <th>ঠিকান</th>
                        <th>মোবাইল</th>
                        <th>অনুষ্ঠানে নাম</th>
                        <th>প্রচার তাং</th>
                        <th>প্রচার সময়</th>
                        <th>রেকডিং তাং</th>
                        <th>যে তারিখে রেকর্ড করা হয়েছে</th>
                        <th>রেকডিং সময়</th>
                        <th>স্থিতি</th>
                        <th>হার</th>
                        <th >বুকিং সংখ্যা</th>
                        <th > সম্মানী</th>
                        <th>সহ. প.</th>
                        <th>উপ. প.</th>
                        <th>হিসাব. প.</th>
                        <th>মন্তব্য</th>
                    </tr>

                    <?php
                    $i = 1;
                    $total_amount = '0.00';
                    if(!empty($program_info)) {
                    foreach ($program_info as $key=> $row) {
                    ?>
                    <tr>
                        <td>
                            <?php echo e($row->program_identity); ?>

                        </td>
                        <td>
                            <?php echo e($row->artist_name); ?>

                        </td>

                        <td><?php echo e($row->address); ?></td>
                        <td>
                            <?php
                            if (!empty($row->artist_mobile)) {
                                $artist_mobile = !empty($row->artist_mobile) ? json_decode
                                ($row->artist_mobile, true) : '';
                                echo $artist_mobile[0];
                            }
                            ?>
                        </td>

                        <td>
                            <?php echo e($row->program_name); ?>

                        </td>
                        <td>
                            <?php
                            if (!empty($row->live_date)) {
                                $live_date_dt = !empty($row->live_date) ? json_decode
                                ($row->live_date, true) : '';
                                echo implode(",", $live_date_dt);
                            }
                            ?>
                        </td>
                        <td>  <?php echo e($row->live_time); ?></td>

                        <td>
                            <?php
                            if (!empty($row->recorded_date)) {
                                $recorded_date_dt = !empty($row->recorded_date) ? json_decode
                                ($row->recorded_date, true) : '';
                                echo implode(",", $recorded_date_dt);
                            }
                            ?>
                        </td>
                        <td></td>
                        <td></td>
                        <td>  <?php echo e($row->stability_title); ?></td>

                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo e($row->number_of_days); ?></td>
                        <td>
                            <?php echo e($row->total_amount); ?>

                            <?php 
                                $total_amount+=$row->total_amount;
                             ?>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <?php } } ?>
                    <tr>
                        <th colspan="13" class="text-right">মোট ব্যয়</th>
                        <td colspan="6"><?php echo e(number_format($total_amount,
                        2,'.','')); ?></td>
                    </tr>
                </table>

            </div>

        </div>

