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
                    <div class="col-sm-12" >
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
                    <?php
                    if(!empty($program_info_data[0])){
                        foreach ($program_info_data as $main_program_key=> $program_plan){
                    ?>
                        <span style="font-size:17px;font-weight: bold;" >
                            <?php
                                $previous_key= $main_program_key-1;
                                if($previous_key>=0){
                                    echo ($program_info_data[$previous_key]->entry_date==$program_plan->entry_date)
                                        ?"":$program_plan->entry_date;

                                }else{
                                    echo $program_plan->entry_date;
                                }
                            ?>
                        </span>
                        <table style="width:100%;border:1px solid #d0d0d0" rules="all"  class="table table-bordered"
                               id="print_table">
                            <tr>
                                <td class="text-bold">অনুষ্ঠানের আইডি </td>
                                <td>
                                    <?php echo e(!empty($program_plan->program_identity)?$program_plan->program_identity:''); ?>

                                </td>
                                <td colspan="2" style="font-size:15px !important;font-weight: bold;"
                                    class="text-bold"><?php echo e((!empty
                                ($program_plan->record_type) &&
                                ($program_plan->record_type==1))
                                    ?'সজীব':(!empty($program_plan->record_type) && ($program_plan->record_type==2))
                                    ?"বাণীবদ্ধ":""); ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">কেন্দ্র</td>
                                <td>
                                    <?php echo e(!empty($program_plan->station_name)?$program_plan->station_name:''); ?>

                                </td>
                                <td class="text-bold">ফ্রিকোয়েন্সি</td>
                                <td >
                                    <?php echo e(!empty($program_plan->fequencey_data)?$program_plan->fequencey_data:''); ?>

                                </td>

                            </tr>
                            <tr>
                                <td class="text-bold">নিদিষ্ট অনুষ্ঠান সূচি</td>
                                <td >
                                    <?php
                                    $torimasik_porikolpona_info=torimasik_porikolpona_info();
                                    $fixed_onusan_suchy_info=fixed_onusan_suchy_info();
                                    if(!empty($program_plan->fixed_onusan_suchy)){
                                        echo  $fixed_onusan_suchy_info[$program_plan->fixed_onusan_suchy];
                                    }
                                    ?>
                                </td>
                                <td class="text-bold">ত্রৈমাসিক পরিকল্পনা </td>
                                <td ><?php echo e(!empty($program_plan->torimasik_porikolpona)
                                ?$torimasik_porikolpona_info[$program_plan->torimasik_porikolpona]:''); ?> <?php echo e(!empty
                                ($program_plan->bangla_son)?
                                '('.$program_plan->bangla_son.")":''); ?>  </td>

                            </tr>
                            <?php if($program_plan->sub_fixed_program_type_id>0): ?>
                                <tr>
                                    <td class="text-bold">বার্ষিকী অনুষ্ঠানের ধরণ  </td>
                                    <td colspan="3">
                                        <?php echo e(!empty($program_plan->fixed_program_name)
                                        ?$program_plan->fixed_program_name:''); ?>: <?php echo e(!empty($program_plan->fixed_sub_program_title)?$program_plan->fixed_sub_program_title:''); ?>

                                    </td>
                                </tr>
                            <?php endif; ?>

                            <tr>
                                <td class="text-bold ">অনুষ্ঠানের নাম</td>
                                <td colspan="3" style="font-size:15px !important;font-weight: bold;" class="text-bold width30per">

                                    <?php echo e($program_plan->program_name); ?>

                                </td>

                            </tr>
                            <tr>
                                <td class="text-bold">বিষয়/উদ্দেশ্য</td>
                                <td colspan="3"><?php echo e($program_plan->larget_viewer); ?> </td>
                            </tr>

                            <tr>
                                <td class="text-bold width20per">অনুষ্ঠানের ধরণ</td>
                                <td class="width30per" >
                                    <?php echo e(!empty($program_plan->program_type_title)?$program_plan->program_type_title:''); ?>

                                </td>
                                <td class="text-bold width20per">অনুষ্ঠানের  স্থিতি  </td>
                                <td class="width30per">
                                    <?php echo e(!empty($program_plan->dolar_name)?$program_plan->recording_stabilty:''); ?>

                                </td>
                            </tr>


                        <!-- <tr>
                                <td class="text-bold">রেকর্ডিং তারিখ</td>
                                <td>
                                    <?php
                            //                                    if (!empty($program_plan->recorded_date)) {
                            //                                        $recorded_dt = !empty($program_plan->recorded_date) ? json_decode
                            //                                        ($program_plan->recorded_date, true) : '';
                            //                                        echo implode(",", $recorded_dt);
                            //                                    }
                            ?>

                                </td>

                                <td class="text-bold">রেকর্ডিং সময়</td>

                                <td>

                                </td>
                            </tr>-->

                            <tr>
                                <td class="text-bold">প্রচার তারিখ</td>

                                <td>

                                    <?php
                                    if (!empty($program_plan->live_date)) {
                                        $live_dt = !empty($program_plan->live_date) ? json_decode
                                        ($program_plan->live_date, true) : '';
                                        echo implode(",", $live_dt);
                                    }
                                    ?>
                                </td>

                                <td class="text-bold">প্রচার সময়</td>

                                <td>
                                    <?php echo e($program_plan->live_time); ?>

                                </td>
                            </tr>
                            <?php if($program_plan->dologot_poribashona>0): ?>
                                <tr>
                                    <td class="text-bold">দলের নাম (উৎসব ও বার্ষিকী) </td>
                                    <td>
                                        <?php echo e(!empty($program_plan->dolar_name)?$program_plan->dolar_name:''); ?>

                                    </td>

                                    <td class="text-bold">দলের তথ্য</td>
                                    <td>
                                        <?php echo e(!empty($program_plan->dolar_info)?$program_plan->dolar_info:''); ?>

                                    </td>
                                </tr>
                            <?php endif; ?>








                        </table>
    <div class="row">
        <div class="col-sm-12">
            <table style="width:100%;border:1px solid #d0d0d0" rules="all" class="table table-bordered " id="print_table">
                <thead>
                <tr>
                    <td style="text-align: center;font-size:12px !important;" colspan="14">অনুষ্ঠানে
                        অংশগ্রহণকারীর বিবরন
                        (শিল্পী সম্মানী চার্ট অনুযায়ী)</td>
                </tr>


                    <tr>
                        <td class="widtd10per">অনুষ্ঠানে ভূমিকা</td>
                        <td>শিল্পীর নাম</td>
                        <td>গ্রেড</td>
                        <td class="widtd6per text-right">সম্মানী</td>
                        <td>রেকর্ডি তাং</td>
                        <td>রেকর্ডি সময়</td>
                        <td>বুকিং সংখ্যা</td>
                        <td class="widtd15per">মহড়া তাং</td>
                        <td class="text-right widtd5per">মহড়া ফি</td>
                        <td class="text-right widtd4per">টিএ </td>
                        <td class="text-right widtd4per">ডিএ </td>
                        <td class="width6per">খেতাব প্রাপ্ত</td>
                        <td class="width6per text-right">মোট সম্মানী</td>

                    </tr>
                </thead>
                <?php
                $i = 1;
                $total_amount = '0.00';
                $get_program_planning_info_artist= $program_plan->get_all_artist_info;
                if(!empty($get_program_planning_info_artist)) {
                foreach ($get_program_planning_info_artist as $key=> $description) {
                ?>
                <tr>
                    <td>
                        <?php echo e($description->artist_vumika_title); ?>

                    </td>
                    <td>
                        <?php echo e($description->artist_name); ?>

                    </td>

                    <td><?php echo e($description->grade_title); ?></td>


                    <td class="text-right">
                        <?php echo e((!empty($description->artist_grade_amount)? eng2bnNumber(number_format
                        ($description->artist_grade_amount,2,'.','')):'0.00')); ?>

                    </td>
                    <td>
                        <?php

                        if (!empty($description->live_date_log) && $program_plan->record_type==1 ) {
                            $live_date_log = !empty($description->live_date_log) ? json_decode
                            ($description->live_date_log, true) : '';
                            $live_date=(!empty($live_date_log))? array_column($live_date_log,'date'):'';
                            echo (!empty($live_date))? implode(",", $live_date):'';
                        }elseif (!empty($description->record_date_log) && $program_plan->record_type==2 ) {
                            $record_date_log = !empty($description->record_date_log) ? json_decode
                            ($description->record_date_log, true) : '';
                            $record_date=(!empty($record_date_log))? array_column($record_date_log,'date'):'';
                            echo (!empty($record_date))? implode(",", $record_date):'';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (!empty($description->live_date_log) && $program_plan->record_type==1 ) {
                            $live_date_log = !empty($description->live_date_log) ? json_decode
                            ($description->live_date_log, true) : '';
                            $live_time=(!empty($live_date_log))? array_column($live_date_log,'time'):'';
                            $result = (!empty($live_time))?array_unique($live_time):'';
                            echo (!empty($result))? implode(",", $result):'';
                        }elseif (!empty($description->record_date_log) && $program_plan->record_type==2 ) {
                            $record_date_log = !empty($description->record_date_log) ? json_decode
                            ($description->record_date_log, true) : '';
                            $record_time=(!empty($record_date_log))? array_column($record_date_log,'time'):'';
                            $result = (!empty($record_time))?array_unique($record_time):'';
                            echo (!empty($result))? implode(",", $result):'';
                        }
                        ?>
                    </td>

                    <td class="text-center">
                        <?php echo e(!empty($description->number_of_days)?eng2bnNumber($description->number_of_days):''); ?>

                    </td>
                    <td>
                        <?php
                        if (!empty($description->mohoda_date_add)) {
                            $mohoda_dt = !empty($description->mohoda_date_add) ? json_decode
                            ($description->mohoda_date_add, true) : '';
                            echo implode(",", $mohoda_dt);
                        }
                        ?>
                    </td>
                    <td class="text-right">
                        <?php echo e($description->mohoda_amount); ?>

                    </td>
                    <td class="text-right">
                        <?php echo e((!empty($description->artist_ta_amount))?number_format
                       ($description->artist_ta_amount,2,'.',''):'0.00'); ?>

                    </td>


                    <td class="text-right">
                        <?php echo e((!empty($description->artist_da_amount))?number_format
                        ($description->artist_da_amount,2,'.',''):'0.00'); ?>

                    </td>
                    <td class="text-center">
                        <?php if($description->khetab_prapto): ?>
                            <?php echo e(($description->khetab_prapto==1)?"হ্যাঁ":"না"); ?>

                        <?php endif; ?>
                    </td>
                    <td class="text-right">
                        <?php echo e(eng2bnNumber($description->total_amount)); ?>

                        <?php 
                            $total_amount+=$description->total_amount;
                         ?>
                    </td>
                </tr>
                <?php } } ?>
                <tr>
                    <td colspan="12" class="text-right" >মোট ব্যয়</td>
                    <td colspan=" 2" style="text-align:right"><?php echo e(eng2bnNumber(number_format($total_amount,
                                    2,'.',''))); ?></td>
                </tr>


            </table>
            <table class="table table-bordered" id="print_table">
                <tr>
                    <td class="text-bold width10per text-center" style="font-size:12px !important;">অনুষ্ঠানের বিষয়বস্তু</td>
                </tr>
                <tr>
                    <td ><?php echo e(!empty($program_plan->onusthan_bisoy_bostu)
                                    ?$program_plan->onusthan_bisoy_bostu:'.'); ?> </td>
                </tr>

            </table>

            <table class="table table-bordered" id="print_table" rules="all" border="1px" >
                <?php
                $manager_info=prgram_manage();
                $organizer_info=[];
                $data_info_orgazizer=[];
                if(!empty($program_plan->program_organizer)){
                    $program_organizer=json_decode($program_plan->program_organizer,true);
                    foreach ($program_organizer as $key => $organizer_info){
                        if($key==2 || $key==3 ){

                        }else{
                            foreach ($organizer_info as $info_key=> $organizer) {
                                $data_info_orgazizer[$key][] = $employee_info[$organizer];
                            }
                        }
                    }
                }

                if(!empty($data_info_orgazizer)){
                foreach ($data_info_orgazizer as $key=>$organizer_data){
                $child_key_index=1;
                ?>
                <tr>
                    <td style="width:20%;">
                        <?php echo e($manager_info[$key]); ?>

                    </td>
                    <td>
                        <?php
                        if(!empty($organizer_data)){
                            echo  implode(",",$organizer_data);
                        }

                        ?>
                    </td>
                </tr>

                <?php
                $child_key_index++;

                }

                }
                ?>

            </table>
            <div style="border: 1px solid #d0d0d0;margin-top:30px;margin-bottom:30px; "></div>

            <?php
            }
             }else{
                echo "<span style='color:red;font-weight: bold;text-align: center'>No Data Found</span>";
            }
           ?>
        </div>

    </div>
    <style>
        #print_table{
            width:100%;
        }
        #print_table td{
            /*font-family: Arial, Verdana, sans-serif;*/
            border:1px solid #d0d0d0;
            font-size:11px !important;
            padding-left:5px !important;
            padding-top:2px !important;
            padding-bottom:2px !important;

        }
        #print_table th{
            /*font-family: Arial, Verdana, sans-serif;*/
            border:1px solid #d0d0d0;
            font-size:11px !important;
            padding-left:2px !important;
            padding-top:2px !important;
            padding-bottom:2px !important;
            font-weight: bold;
        }
    </style>
