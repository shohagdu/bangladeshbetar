<?php
$day_name=show_day_info_bn();
$odivision_info_data=odivision_info_data();
$odivision = [
    1,2,3,4
];
$date=$data['presentation_date'];
$setting_content=!empty($setting_content)?json_decode($setting_content,true):'';
?>

<?php echo Form::open(['url' => '', 'method' => 'post','id' => 'save_adhok_presentation_info_form',
    'class'=>'form-horizontal']); ?>

<div style="padding:10px 10px;">
    <div class="col-sm-12" style="padding-bottom:5px;">
        <div class="col-sm-6">
            তারিখ <span style="color:red;font-weight: bold;"> <?php echo e(date('d-m-Y',strtotime($date))); ?></span>
        </div>
        <div class="col-sm-6">
            বার: <?php echo e($day_name[date('D',strtotime($date))]); ?>

        </div>
    </div>
    <?php $__currentLoopData = $odivision; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $odivision_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <table  class="table table-bordered width100per" id="presentation_table"  >
            <tr>
                <th colspan="6">
                    <?php echo e($odivision_info_data[$odivision_id]); ?>

                </th>
            </tr>
            <tr>
                <td style="width: 20% !important;">
                    <?php
                    $duty_officer_info=  !empty($setting_content[date('D',strtotime
                    ($date))
                    ][$odivision_id] ['duty_officer']) ?$setting_content[date('D',strtotime
                    ($date))
                    ][$odivision_id] ['duty_officer']:NULL;
                    ?>
                    <input type="hidden"  name="program_date[<?php echo e($date); ?>][<?php echo e($odivision_id); ?>][duty_officer]" class="form-control">
                    <select id="magazine_manage" placeholder="ডিউটি অফিসার"  class="select2"  multiple required
                            name="program_date[<?php echo e($date); ?>][<?php echo e($odivision_id); ?>][duty_officer][]" style="width:100% !important">
                        <?php if(!empty($atrist_info_info)): ?>
                            <?php $__currentLoopData = $atrist_info_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                    $selected= ( !empty($duty_officer_info) &&
                                    in_array($key,
                                    $duty_officer_info))
                                    ?"selected":'';
                                 ?>
                                <option value="<?php echo e($key); ?>" <?php echo e($selected); ?>><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </td>
                <td style="width: 20% !important;">
                    <?php
                    $announcer_info=  !empty($setting_content[date('D',strtotime
                    ($date))
                    ][$odivision_id] ['announcer'])?$setting_content[date('D',strtotime
                    ($date))
                    ][$odivision_id] ['announcer']:NULL ;

                    ?>
                    <input type="hidden"  name="program_date[<?php echo e($date); ?>][<?php echo e($odivision_id); ?>][announcer]" class="form-control">
                    <select id="magazine_manage" placeholder="ঘোষক"  class="select2"  multiple required
                            name="program_date[<?php echo e($date); ?>][<?php echo e($odivision_id); ?>][announcer][]" style="width:100% !important">

                        <?php if(!empty($atrist_info_info)): ?>
                            <?php $__currentLoopData = $atrist_info_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                    $selected= (!empty($announcer_info) && in_array($key,
                                    $announcer_info))
                                    ?"selected":'';
                                 ?>
                                <option value="<?php echo e($key); ?>" <?php echo e($selected); ?>><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </td>
                <td style="width: 20% !important;">
                    <?php
                    $log_writer_info= (!empty($setting_content[date('D',strtotime($date)) ][$odivision_id]
                    ['log_writer']))? $setting_content[date('D',strtotime($date)) ][$odivision_id]
                    ['log_writer']:NULL;
                    ?>
                    <input type="hidden"  name="program_date[<?php echo e($date); ?>][<?php echo e($odivision_id); ?>][log_writer]" class="form-control">
                    <select id="magazine_manage" placeholder="লগ রাইটার"  class="select2"  multiple required
                            name="program_date[<?php echo e($date); ?>][<?php echo e($odivision_id); ?>][log_writer][]" style="width:200px !important">

                        <?php if(!empty($atrist_info_info)): ?>
                            <?php $__currentLoopData = $atrist_info_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                    $selected= (!empty($log_writer_info) &&
                                    in_array($key,
                                    $log_writer_info))
                                    ?"selected":'';
                                 ?>
                                <option value="<?php echo e($key); ?>" <?php echo e($selected); ?>><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </td>
                <td style="width: 20% !important;">
                    <?php
                    $officer_assistent_info= (!empty($setting_content[date('D',strtotime($date))][$odivision_id]
                    ['officer_assistent']))? $setting_content[date('D',strtotime($date))][$odivision_id]
                    ['officer_assistent']:NULL;
                    ?>
                    <input type="hidden"  name="program_date[<?php echo e($date); ?>][<?php echo e($odivision_id); ?>][officer_assistent]" class="form-control">
                    <select id="magazine_manage" placeholder="অফিস সহায়ক"  class="select2"  multiple required
                            name="program_date[<?php echo e($date); ?>][<?php echo e($odivision_id); ?>][officer_assistent][]" style="width:100% !important">
                        <?php if(!empty($atrist_info_info)): ?>
                            <?php $__currentLoopData = $atrist_info_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                    $selected= ( !empty
                                    ($officer_assistent_info) && in_array($key,
                                    $officer_assistent_info))
                                    ?"selected":'';
                                 ?>
                                <option value="<?php echo e($key); ?>" <?php echo e($selected); ?>><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </td>
                <td style="width: 20% !important;">
                    <?php
                    $officer_incharge_info=  (!empty($setting_content[date('D',strtotime($date))][$odivision_id]['officer_incharge']))?$setting_content[date('D',strtotime($date))][$odivision_id]['officer_incharge']:NULL;
                    ?>
                    <input type="hidden"  name="program_date[<?php echo e($date); ?>][<?php echo e($odivision_id); ?>][officer_incharge]" class="form-control">
                    <select id="magazine_manage" placeholder="অফিসার ইনসার্স"  class="select2"  multiple required
                            name="program_date[<?php echo e($date); ?>][<?php echo e($odivision_id); ?>][officer_incharge][]" style="width:100% !important">

                        <?php if(!empty($atrist_info_info)): ?>
                            <?php $__currentLoopData = $atrist_info_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                    $selected= ( !empty
                                    ($officer_incharge_info) && in_array($key,
                                    $officer_incharge_info))
                                    ?"selected":'';
                                 ?>
                                <option value="<?php echo e($key); ?>" <?php echo e($selected); ?>><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>

                </td>


            </tr>
        </table>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
    <div class="col-sm-12">
        <button type="button" onclick="saveAdhokPresentationInfo()" class="btn btn-success pull-left
"><span class="glyphicon glyphicon-off"></span> Save</button>


        <button type="button" class="btn btn-danger btn-default
            pull-left"
                style="margin-left:20px;"
                data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel
        </button>
        <input type="hidden" id="presentation_date"  value="<?php echo $data['presentation_date']; ?>"
               name="presentation_date">
        <input type="hidden" id="station_id"  value="<?php echo $data['station_id']; ?>" name="station_id">
        <input type="hidden" id="sub_station_id"  value="<?php echo $data['sub_station_id']; ?>" name="sub_station_id">
        <input type="hidden" id="presentation_id"  value="<?php echo $data['presentation_id']; ?>" name="presentation_id">
    </div>
</div>
<?php echo Form::close(); ?>



