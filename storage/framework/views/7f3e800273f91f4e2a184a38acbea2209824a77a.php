<?php $__env->startSection('title_area'); ?>
    :: setting ::  Presentation  ::

<?php $__env->stopSection(); ?>
<?php $__env->startSection('show_message'); ?>
    <?php if(Session::has('message')): ?>
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert"
             style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo e(Session::get('message')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content_area'); ?>
    <article class="col-sm-12 col-md-12 col-lg-12">

       

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>উপস্থাপনা সেটিংস সমুহ</h2>

                <a href="<?php  echo asset('/presentation_setting');?>"
                   class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    List
                </a>

            </header>
            
            <div>
                <div class="widget-body no-padding">
                    <table class="table table-bordered table-striped table-hover" style="width:100%">
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">কেন্দ্রের / ইউনিট নাম </label>
                                    <div class="col-md-4">
                                       : <?php echo e($presentation_setting_info->station_name); ?>

                                    </div>
                                    <label class="col-md-2 control-label text-right">ফ্রিকোয়েন্সি </label>
                                    <div class="col-md-4">
                                        : <?php echo e($presentation_setting_info->fequencey_data); ?>

                                    </div>

                                </div>
                            </td>
                        </tr>
                        
                        <?php
                        $day_name = show_day_info_bn();
               
                        $day_info=(!empty($presentation_setting_info->content_info))? json_decode
                        ($presentation_setting_info->content_info,true):'';

                         

                        ?>
                        
                        <tr>
                            <td>
                                <?php
                                foreach ($day_info as $day_id=>$day_data) {
                                   
                                 $j = 0;

                                ?>
                                <div class="col-sm-12" style="padding-bottom:2px;background: #d0d0d0">
                                    <div class="col-sm-6" style="color:red;">
                                        বার: <?php echo e($day_name[$day_id]); ?>

                                        <input type="hidden" name="day_name_id[]" id="day_name_id_<?php echo e($day_id); ?>"
                                               value="<?php echo e($day_id); ?>">
                                    </div>
                                </div>

                     
                                <?php $__currentLoopData = $day_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $odivision_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php
                              
                                //   echo "<pre>";
                                //   print_r($odivision_info['log_writer']);exit;
                              ?>
                                    <table class="table table-bordered table-striped table-hover width100per" id="presentation_table">
                                        <tr>
                                          
                                            <th colspan="6">
                                                <?php if( $key ==1): ?>
                                                    প্রথম অধিবেশন(৬.০০-১২.০০)
                                                <?php elseif( $key ==2): ?>
                                                    দ্বিতীয় অধিবেশন(১২.০০-৬.০০)
                                                <?php elseif( $key ==3): ?>
                                                    তৃতীয় অধিবেশন(৬.০০-১২.০০)
                                                <?php elseif( $key ==4): ?>
                                                    ৪র্থ অধিবেশন(১২.০০-৬.০০)
                                                <?php endif; ?>
                                            </th>
                                        </tr>
                                       
                                        <tr>
                                            <td style="width: 20% !important;">
                                                <?php
                                                    if(!empty($odivision_info['announcer'])){
                                                        $info='';
                                                        foreach ($odivision_info['announcer']  as $key=>$value){
                                                            if(!empty($value)){
                                                                $info.=$atrist_info_info[$value].",";
                                                            }
                                                        }
                                                        echo trim($info,',');
                                                    }else{
                                                        echo "<span class='emptyColorInfo'> কোন তথ্য পাওয়া যায় নাই
                                                        </span>";
                                                    }
                                                ?>
                                            </td>
                                           
                                            <td style="width: 20% !important;">
                                                <?php
                                                    if(!empty($odivision_info['log_writer'])){
                                                        $info='';
                                                        foreach ($odivision_info['log_writer']  as $key=>$value){
                                                          
                                                            if(!empty($value)){

                                                                if(isset($atrist_info_info[$value])){
                                                                $info.= $atrist_info_info[$value].",";
                                                                }
                                                            }
                                                        }
                                                        echo trim($info,',');
                                                    }else{
                                                        echo "<span class='emptyColorInfo'> কোন তথ্য পাওয়া যায় নাই
                                                        </span>";
                                                    }
                                                ?>
                                            </td>
                                           
                                            <td style="width: 20% !important;">
                                                <?php
                                                    if(!empty($odivision_info['officer_incharge'])){
                                                        $info='';
                                                        foreach ($odivision_info['officer_incharge']  as $key=>$value){
                                                            if(!empty($value)){
                                                                $info.=$atrist_info_info[$value].",";
                                                            }
                                                        }
                                                        echo trim($info,',');
                                                    }else{
                                                        echo "<span class='emptyColorInfo'> কোন তথ্য পাওয়া যায় নাই
                                                        </span>";
                                                    }
                                                ?>
                                            </td>
                                            
                                            <td style="width: 20% !important;">
                                                <?php
                                                    if(!empty($odivision_info['officer_assistent'])){
                                                        $info='';
                                                        foreach ($odivision_info['officer_assistent']  as $key=>$value){
                                                            if(!empty($value)){
                                                                $info.=$atrist_info_info[$value].",";
                                                            }
                                                        }
                                                        echo trim($info,',');
                                                    }else{
                                                        echo "<span class='emptyColorInfo'> কোন তথ্য পাওয়া যায় নাই
                                                        </span>";
                                                    }
                                                ?>
                                            </td>
                                           
                                            <td style="width: 20% !important;">
                                                <?php
                                                    // if(!empty($odivision_info['duty_officer'])){
                                                    //     $info='';
                                                    //     foreach ($odivision_info['duty_officer']  as $key=>$value){
                                                    //         if(!empty($value)){
                                                    //             $info.=$atrist_info_info[$value].",";
                                                    //         }
                                                    //     }
                                                    //     echo trim($info,',');
                                                    // }else{
                                                    //     echo "<span class='emptyColorInfo'> কোন তথ্য পাওয়া যায় নাই
                                                    //     </span>";
                                                    // }
                                                ?>
                                            </td>

                                        </tr>
                                       
                                    </table>
                                    

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              
                                <?php 
                                 
                                  $j++;
                                //   echo "<pre>";
                                //   print_r($day_data);exit;
                                  
                                }
                                  ?>

                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </article>
    <!-- Modal -->
    <style>
        #presentation_table td {
            border: 1px solid #d0d0d0;
            font-size:12px;
        }
        #presentation_table th {
            border: 1px solid #d0d0d0;
            font-size:12px;
        }
        .emptyColorInfo{
            color:darkred;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>