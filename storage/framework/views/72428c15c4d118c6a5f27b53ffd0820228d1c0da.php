<?php $__env->startSection('main_content_area'); ?>
<article class="col-sm-12 col-md-12 col-lg-12">
    <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
        <header class="no-print">
            <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
            <h2> অনুষ্ঠান সময়সূচী সেটিংস </h2>

            <a href="<?php echo e(url('master_day_program_time_table')); ?>">
                <button type="button" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                    Back
                </button>
            </a>

            <button onclick="print_fun()" type="button" class="btn btn-success btn-xs" style="float:right;margin-top:5px;
            margin-right:5px;"><i class="glyphicon glyphicon-print"></i>
                Print
            </button>
        </header>
        <div>
            <div class="widget-body no-padding">
                <?php echo Form::open(['url' => '', 'id' => 'program_time_table_setup_form','method' => 'post','class'=>'form-horizontal']); ?>

                <div class="col-sm-12" style="margin-top:10px;margin-bottom:80px;">
                    <?php 

                        $onusthan_suchi = [
                            1=>'গ্রীষ্মকালীন(১লা এপ্রিল-৩০শে সেপ্টেম্বর)',
                            2=>'শীতকালীন(১রা অক্টোবর-৩১শে মার্চ)'
                        ];

                        $plan = [
                            1=>'১ম: (বৈশাখ-আযাঢ়)',
                            2=>'২য়: (শ্রাবণ-আশ্বিন)',
                            3=>'৩য়: (কার্তিক-পৌষ)',
                            4=>'৪র্থ: (মাঘ-চৈত্র)',
                        ];
                        $onurup = json_decode($schedule_info->onurup,true);
                    ?>
                    <p><b>কেন্দ্রের নাম :</b> <?php if(!empty($station_info)): ?>
                                <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php echo e($key===$schedule_info->station_id ? $value : ''); ?> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?></p>
                    <p><b>ফিকোয়েন্সি :</b> <?php  foreach($sub_station_info as $key => $value) { ?>
                                    <?php echo $value->id==$schedule_info->sub_station_id ? $value->title.'('.$value->fequencey.')' : '' ?> 
                                <?php } ?> </p>
                    <p><b>অনুরুপ ফিকোয়েন্সি :</b> <?php  foreach($sub_station_info as $key => $value) { ?>
                                    <?php echo in_array($value->id,$onurup) ? $value->title.'('.$value->fequencey.') /' : '' ?> 
                                <?php } ?></p>
                    <p><b>নিদিষ্ট অনুষ্ঠান সূচি :</b> <?php echo  isset($onusthan_suchi[$schedule_info->fixed_onustan_suchy])?$onusthan_suchi[$schedule_info->fixed_onustan_suchy]:''; ?></p>
                    <p><b>ত্রৈমিাসিক পরিক্লপনা :</b> <?php echo  isset($plan[$schedule_info->torimasik_porikolpona])?$plan[$schedule_info->torimasik_porikolpona]:''; ?></p>
                    <p><b>বাংলা সন :</b> <?php echo $schedule_info->bangla_son; ?></p>

                    <table class="table-bordered table" id="table-style">

                        <thead>
                            
                            <tr>
                                <td  style="width:12%">বার</td>
                                <td>সপ্তাহ</td>
                                <td style="width:8%">সময়</td>

                                <td>চাংক</td>
                                <td>অনুষ্ঠানের বিবরন</td>
                                <td>অনুষ্ঠানের বিষয়বস্তু</td>
                                <td style="width:8%">স্থিতি (মিনিট)</td>
                                <td style="width:12%">প্রযোজনা</td>
                                <td style="width:10%">তত্বাবধানে</td>
                                <td style="width:12%">মন্তব্য</td>

                                <td style="width:5%">রেকর্ড</td>
                                <td style="width:2%">ক্রমিক</td>
                            </tr>
                        </thead>

                        <tbody id="dynamicJobHistorytr">
                            <?php
                            $content = json_decode($schedule_info->content,true);

                            $days_array = [
                                1 => 'শনিবার',
                                2=> 'রবিবার',
                                3=>'সোমবার',
                                4=>'মঙ্গলবার',
                                5=>'বুধবার',
                                6=>'বৃহস্পতিবার',
                                7=>'শুক্রবার',
                                8=>'প্রতিদিন'
                            ];
                            $week_array = [
                                1 => '১ম',
                                2=> '২য়',
                                3=>'৩য়',
                                4=>'৪র্থ',
                                5=>'৫ম',
                                6=>'শেষ',
                                7=>'প্রতি',

                            ];

                            foreach($content as $key => $value) {
                            ?>
                            <tr id="<?php echo $key; ?>">
                                <td>
                                    <?php 
                                      if(!empty($value['days'] )){
                                        foreach($value['days'] as $day_id) {
                                            echo $days_array[$day_id].'<br/>';
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($value['week'] )){
                                            foreach($value['week'] as $week) {
                                                echo $week_array[$week].'<br/>';
                                            }
                                        }
                                    ?>
                                </td>


                                <td>
                                    <?php echo $value['time'] ?>
                                </td>

                                <td>
                                    <?php echo $value['chank'] ?>
                                </td>
                                <td>
                                   <?php echo $value['biboron'] ?>
                                </td>
                                <td>
                                   <?php echo (!empty($value['description']))? $value['description']:'' ?>
                                </td>

                                <td>
                                    <?php echo $value['stability'] ?> মিনিট
                                </td>
                                <td>
                                    <?php echo (!empty($value['projejeno']))? $employee_info[$value['projejeno']]:'' ?>
                                </td>
                                <td>
                                    <?php echo (!empty($value['tottabodane']))?
                                        $employee_info[$value['tottabodane']]:'' ?>
                                </td>
                                <td>
                                    <?php echo $value['comment'] ?>
                                </td>


                                <td>
                                    <?php echo $value['is_recorded']==1?'<i class="	glyphicon glyphicon-ban-circle"></i>':
                                        'সজীব'; ?>
                                </td>
                                <td>
                                    <?php echo $value['sorting'] ?>
                                </td>

                            </tr>
                            <?php } ?>
                        </tbody>


                    </table>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</article>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>