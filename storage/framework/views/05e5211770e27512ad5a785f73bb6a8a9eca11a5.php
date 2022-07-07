<div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
        <button onclick="print_fun()"
                class="btn btn-warning btn-xs no-print" style="float:right;margin-top:5px;margin-right:5px;"><i
                    class="glyphicon glyphicon-print"></i>
            Print
        </button>
    </header>

    <div>
        <div class="widget-body no-padding">
            <div class="col-sm-12">
                <div class="col-sm-12" style="height: 10px;"></div>
                <table class="print_table-no-border " style="width:100%;border: 1px solid #fff !important;">
                    <tr>
                        <td    style="text-align: center;width:40%;border: 1px solid #fff!important" >
                            <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  </div>

                            <div style="font-size:14px;"><?php echo e(!empty($heading_info->name)?$heading_info->name:''); ?></div>
                            <div style="font-size:14px;"><?php echo e(!empty($heading_info->address)?$heading_info->address:''); ?></div>
                            <div style="font-size:14px;"><?php echo e(!empty($heading_info->fequencey_data)?$heading_info->fequencey_data:''); ?></div>

                            <div class="clearfix"></div>
                            <span style="font-weight: bold;font-size:14px;"> <?php echo e((!empty
                                    ($heading_fixed_data['title']))?
                                $heading_fixed_data['title']:''); ?> </span>
                            <div class="clearfix"></div>
                            <span style="padding-left:10px;"> <?php echo e((!empty($heading_fixed_data['date_range']))?
                                $heading_fixed_data['date_range']:''); ?></span>

                        </td>
                    </tr>
                </table>
                <table style="width:100%;border:1px solid #d0d0d0" rules="all" class="table table-bordered "
                       id="table-style">
                    <thead>
                        <tr>
                            <th style="width:5%;">আইডি নং</th>
                            <th nowrap>শিল্পীর নাম</th>
                            <th>ঠিকান</th>
                            <th nowrap>মোবাইল</th>
                            <th nowrap>অনুষ্ঠানে নাম</th>
                            <th nowrap>প্রচার তাং</th>
                            <th nowrap>প্রচার সময়</th>
                            <th nowrap>রেকডিং তাং</th>
                            <th nowrap>অনুষ্ঠানের স্থিতি</th>
                            <th nowrap  class="width5per"> পূর্ববতী তাং</th>
                            <th nowrap="" class="width5per">পরবর্তী তাং</th>
                            <th nowrap>মহড়ার তারিখ</th>
                            <th nowrap style="width:100px;">অন্যান্য</th>
                            <th nowrap class="width10per">হার</th>
                            <th nowrap>বুকিং সংখ্যা</th>
                            <th nowrap>মোট সম্মানী</th>
                            <th class="width5per">মন্তব্য</th>
                        </tr>
                    </thead>

                    <?php
                    $i = 1;
                    $total_amount = '0.00';
                    //echo "<pre>";
                  //  print_r($program_info);
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
                            if (!empty($row->live_date_log)) {
                                $record_date_log_dt = !empty($row->live_date_log) ? json_decode
                                ($row->live_date_log, true) : '';
                                if(!empty($record_date_log_dt)){
                                 $record_date_log_dt_info= array_column($record_date_log_dt,'date');
                                }
                                echo implode(", ", $record_date_log_dt_info);
                            }
                            ?>
                        </td>
                        <td>  <?php echo e($row->live_time); ?></td>

                        <td>
                            <?php
                            if (!empty($row->record_date_log)) {
                                $record_date_log_dt = !empty($row->record_date_log) ? json_decode
                                ($row->record_date_log, true) : '';
                                if(!empty($record_date_log_dt)){
                                    $record_date_log_dt_info= array_column($record_date_log_dt,'date');
                                }
                                echo  implode(", ", $record_date_log_dt_info);
                            }
                            ?>
                        </td>
                        <td>  <?php echo e($row->recording_stabilty); ?></td>

                        <td></td>
                        <td></td>
                        <td>
                            <?php
                                if (!empty($row->mohoda_date_add)) {
                                    $mohoda_date_add_log_dt = !empty($row->mohoda_date_add) ? json_decode
                                    ($row->mohoda_date_add, true) : '';
                                    echo implode(",", $mohoda_date_add_log_dt);
                                }
                            ?>
                        </td>
                        <td>
                            <?php echo e('টিএ: '.number_format($row->artist_ta_amount,2,',','')); ?>

                            <?php echo e('ডিএ: '. number_format($row->artist_da_amount,2,'.','')); ?>

                            <?php echo e('খেতাব প্রাপ্ত: '. (($row->khetab_prapto==1)?'হ্যাঁ':'না')); ?>

                        </td>
                        <td>  <?php echo e('সম্মানী: '. $row->artist_grade_amount); ?>


                            <?php echo e('মহড়া: '.$row->mohoda_amount); ?>

                            <div class="clearfix"></div>

                        </td>
                        <td class="text-center"><?php echo e($row->number_of_days); ?></td>
                        <td class="text-right">
                            <?php echo e($row->total_amount); ?>

                            <?php 
                                $total_amount+=$row->total_amount;
                             ?>
                        </td>
                        <td></td>

                    </tr>
                    <?php } } ?>
                    <tr>
                        <th colspan="15" class="text-right">মোট ব্যয়</th>
                        <td colspan="2"><?php echo e(number_format($total_amount,
                        2,'.','')); ?></td>
                    </tr>
                </table>
                <table class="print_table-no-border" style="width: 100%;margin-bottom:
                                            20px;margin-top: 80px;margin-bottom: 80px;border: 1px solid #fff
                                            !important;" rules="all">
                    <tr>
                        <td style="width:25%;text-align: left;font-size:11px; " class="no-border">
                            <span
                                    style="border-bottom:1px solid #333;">অনুষ্ঠান সচিব</span>
                        </td>
                        <td style="width:25%;text-align: left;font-size:11px;" class="no-border"><span
                                    style="border-bottom:1px solid #333;">সহকারী
                                                            পরিচালক : </span></td>
                        <td style="width:25%;text-align: left;font-size:11px;" class="no-border"><span
                                    style="border-bottom:1px solid #333;
">উপ-পরিচালক: </span></td>
                        <td style="width:25%;text-align: left;font-size:11px;" class="no-border"><span
                                    style="border-bottom:1px solid #333;">আঞ্চলিক পরিচালক/
                                                            পরিচালক: </span></td>
                    </tr>

                </table>
            </div>

        </div>

