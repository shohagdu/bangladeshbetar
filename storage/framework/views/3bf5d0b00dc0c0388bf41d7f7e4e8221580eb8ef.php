<?php
$odivision_data=odivision_info_data();
$role_info_data=role_info_data();
$program_presentation_type=program_presentation_type();
//echo "<pre>";
//print_r($live_program_info_data);
?>
<table class="table-bordered table">
    <tr>
        <th colspan="10">সজীব</th>
    </tr>
    <tr>
        <td>শিল্পীর ছবি</td>
        <td>শিল্পীর নাম</td>
        <td>মোবাইল</td>
        <td>চুক্তিপত্রের আইডি</td>
        <td>
            অনুষ্ঠানের নাম
        </td>
        <td>এডহক/ বিকল্প</td>
        <td>অধিবেশন তথ্য</td>
        <td>পারফরমেন্স</td>
        <td>মন্তব্য</td>
    </tr>
    <?php
    if(!empty($live_program_info_data)){
    foreach ($live_program_info_data as $key=>$all_info){
    ?>
    <tr>
        <td>
            <img src="<?php echo e((file_exists("fontView/assets/artist_image/"
                                        .$all_info->picture))? (!empty
                                        ($all_info->picture)?url
                                        ("fontView/assets/artist_image/"
                                        .$all_info->picture):''):url
                                        ("images\default\default-avatar.png")); ?>" style="height:30px;">
            <input type="hidden" name="artist_infos_primary_id[]" value="<?php echo e(!empty($all_info->id)
            ?$all_info->id:''); ?>">
        </td>
        <td><?php echo e(!empty($all_info->name_bn)?$all_info->name_bn:''); ?></td>
        <td>
            <?php
                if(!empty($all_info->mobile)) {
                    $mobile_info=json_decode($all_info->mobile,true);
                    echo !empty($mobile_info)?$mobile_info[0]:'';
                }
            ?>
        </td>
        <td><?php echo e(!empty($all_info->program_identity)?$all_info->program_identity:''); ?></td>
        <td><?php echo e(!empty($all_info->program_name)?$all_info->program_name:''); ?></td>
        <td><?php echo e(!empty($all_info->presentation_type)?$program_presentation_type[$all_info->presentation_type]:''); ?></td>
        <td>
            <select name="recording_info[]" class="form-control">
                <option value="1"  >হ্যাঁ</option>
                <option value="2" >না</option>
                <option value="3" >উল্লেখ নেই</option>
            </select>
        </td>
        <td>
            <select name="performance_odvision_info[]" class="form-control">
                <option value="1" <?php echo e((!empty($all_info->performance_odvision_info) &&
                $all_info->performance_odvision_info==1 )?"selected":""); ?> >হ্যাঁ</option>
                <option value="2" <?php echo e((!empty($all_info->performance_odvision_info) &&
                $all_info->performance_odvision_info==2 )?"selected":""); ?>>না</option>
                <option value="3" <?php echo e((!empty($all_info->performance_odvision_info) &&
                $all_info->performance_odvision_info==3 )?"selected":""); ?>>উল্লেখ নেই</option>
            </select>
        </td>
        <td>
            <select name="performance_ctg[]" class="form-control">
                <option value="1" <?php echo e((!empty($all_info->performance_ctg) &&
                $all_info->performance_ctg==1 )?"selected":""); ?>>হ্যাঁ</option>
                <option value="2" <?php echo e((!empty($all_info->performance_ctg) &&
                $all_info->performance_ctg==2 )?"selected":""); ?>>না</option>
            </select>
        </td>
        <td>
            <textarea name="performance_comments[]" placeholder="মন্তব্য" rows="1" class="form-control"
                      id="performance_comments_<?php echo e($all_info->id); ?>"><?php echo e((!empty($all_info->performance_comments) )?$all_info->performance_comments:""); ?></textarea>
        </td>

    </tr>
    <?php } } ?>
    <tr>
        <td style="text-align: center" colspan="10">
            <button type="button" id="presentation_performance_btn" onclick="saveperformanceInfoPresentation()"
                    class="btn
            btn-primary btn-sm"><i
                        class="glyphicon
            glyphicon-ok-sign"></i> আপডেট
                সজীব
                
            </button>
        </td>
    </tr>
</table>
<table class="table-bordered table">
    <tr>
        <th colspan="10">বাণীবদ্ধ</th>
    </tr>
    <tr>
        <td>শিল্পীর ছবি</td>
        <td>শিল্পীর নাম</td>
        <td>মোবাইল</td>
        <td>চুক্তিপত্রের আইডি</td>
        <td>
            অনুষ্ঠানের নাম
        </td>
        <td>এডহক/ বিকল্প</td>
        <td>রেকর্ডিং তথ্য</td>
        <td>অধিবেশন তথ্য</td>
        <td>পারফরমেন্স</td>
        <td>মন্তব্য</td>
    </tr>
    <?php
    if(!empty($record_program_info_data)){
    foreach ($record_program_info_data as $key=>$all_info){
    ?>
    <tr>
        <td>
            <img src="<?php echo e((file_exists("fontView/assets/artist_image/"
                                        .$all_info->picture))? (!empty
                                        ($all_info->picture)?url
                                        ("fontView/assets/artist_image/"
                                        .$all_info->picture):''):url
                                        ("images\default\default-avatar.png")); ?>" style="height:30px;">
            <input type="hidden" name="artist_infos_primary_id[]" value="<?php echo e(!empty($all_info->id)
            ?$all_info->id:''); ?>">
        </td>
        <td><?php echo e(!empty($all_info->name_bn)?$all_info->name_bn:''); ?></td>
        <td>
            <?php
                if(!empty($all_info->mobile)) {
                    $mobile_info=json_decode($all_info->mobile,true);
                    echo !empty($mobile_info)?$mobile_info[0]:'';
                }
            ?>
        </td>
        <td><?php echo e(!empty($all_info->program_identity)?$all_info->program_identity:''); ?></td>
        <td><?php echo e(!empty($all_info->program_name)?$all_info->program_name:''); ?></td>
        <td><?php echo e(!empty($all_info->presentation_type)?$program_presentation_type[$all_info->presentation_type]:''); ?></td>
        <td>
            <select name="recording_info[]" class="form-control">
                <option value="1"  >হ্যাঁ</option>
                <option value="2" >না</option>
                <option value="3" >উল্লেখ নেই</option>
            </select>
        </td>
        <td>
            <select name="performance_odvision_info[]" class="form-control">
                <option value="1" <?php echo e((!empty($all_info->performance_odvision_info) &&
                $all_info->performance_odvision_info==1 )?"selected":""); ?> >হ্যাঁ</option>
                <option value="2" <?php echo e((!empty($all_info->performance_odvision_info) &&
                $all_info->performance_odvision_info==2 )?"selected":""); ?>>না</option>
                <option value="3" <?php echo e((!empty($all_info->performance_odvision_info) &&
                $all_info->performance_odvision_info==3 )?"selected":""); ?>>উল্লেখ নেই</option>
            </select>
        </td>
        <td>
            <select name="performance_ctg[]" class="form-control">
                <option value="1" <?php echo e((!empty($all_info->performance_ctg) &&
                $all_info->performance_ctg==1 )?"selected":""); ?>>হ্যাঁ</option>
                <option value="2" <?php echo e((!empty($all_info->performance_ctg) &&
                $all_info->performance_ctg==2 )?"selected":""); ?>>না</option>
            </select>
        </td>
        <td>
            <textarea name="performance_comments[]" placeholder="মন্তব্য" rows="1" class="form-control"
                      id="performance_comments_<?php echo e($all_info->id); ?>"><?php echo e((!empty($all_info->performance_comments) )?$all_info->performance_comments:""); ?></textarea>
        </td>

    </tr>
    <?php } } ?>
    <tr>
        <td style="text-align: center" colspan="10">
            <button type="button" id="presentation_performance_btn" onclick="saveperformanceInfoPresentation()"
                    class="btn
            btn-primary btn-sm"><i
                        class="glyphicon
            glyphicon-ok-sign"></i> আপডেট
                বাণীবদ্ধ
            </button>
        </td>
    </tr>
</table>


<table class="table-bordered table">
    <tr>
        <th colspan="10">অধিবেশন কক্ষ</th>
    </tr>
    <tr>
        <td>শিল্পীর ছবি</td>
        <td>শিল্পীর নাম</td>
        <td>মোবাইল</td>
        <td>চুক্তিপত্রের আইডি</td>
        <td>পালা</td>
        <td>অধিবেশনে ভূমিকা</td>
        <td>এডহক/ বিকল্প</td>
        <td>অধিবেশন তথ্য</td>
        <td>পারফরমেন্স</td>
        <td>মন্তব্য</td>
    </tr>
    <?php
    if(!empty($presentation_info)){
    foreach ($presentation_info as $key=>$all_info){
    ?>
    <tr>
        <td>
            <img src="<?php echo e((file_exists("fontView/assets/artist_image/"
                                        .$all_info->picture))? (!empty
                                        ($all_info->picture)?url
                                        ("fontView/assets/artist_image/"
                                        .$all_info->picture):''):url
                                        ("images\default\default-avatar.png")); ?>" style="height:30px;">
            <input type="hidden" name="artist_infos_primary_id[]" value="<?php echo e(!empty($all_info->id)
            ?$all_info->id:''); ?>">
        </td>
        <td><?php echo e(!empty($all_info->name_bn)?$all_info->name_bn:''); ?></td>
        <td>
            <?php
                if(!empty($all_info->mobile)) {
                    $mobile_info=json_decode($all_info->mobile,true);
                    echo !empty($mobile_info)?$mobile_info[0]:'';
                }
            ?>
        </td>
        <td><?php echo e(!empty($all_info->presentation_identification_id)?$all_info->presentation_identification_id:''); ?></td>
        <td><?php echo e(!empty($all_info->odivision_id)?$odivision_data[$all_info->odivision_id]:''); ?></td>
        <td><?php echo e(!empty($all_info->role_title)?$role_info_data[$all_info->role_title]:''); ?></td>
        <td><?php echo e(!empty($all_info->presentation_type)?$program_presentation_type[$all_info->presentation_type]:''); ?></td>
        <td>
            <select name="performance_odvision_info[]" class="form-control">
                <option value="1" <?php echo e((!empty($all_info->performance_odvision_info) &&
                $all_info->performance_odvision_info==1 )?"selected":""); ?> >হ্যাঁ</option>
                <option value="2" <?php echo e((!empty($all_info->performance_odvision_info) &&
                $all_info->performance_odvision_info==2 )?"selected":""); ?>>না</option>
                <option value="3" <?php echo e((!empty($all_info->performance_odvision_info) &&
                $all_info->performance_odvision_info==3 )?"selected":""); ?>>উল্লেখ নেই</option>
            </select>
        </td>
        <td>
            <select name="performance_ctg[]" class="form-control">
                <option value="1" <?php echo e((!empty($all_info->performance_ctg) &&
                $all_info->performance_ctg==1 )?"selected":""); ?>>হ্যাঁ</option>
                <option value="2" <?php echo e((!empty($all_info->performance_ctg) &&
                $all_info->performance_ctg==2 )?"selected":""); ?>>না</option>
            </select>
        </td>
        <td>
            <textarea name="performance_comments[]" placeholder="মন্তব্য" rows="1" class="form-control"
                      id="performance_comments_<?php echo e($all_info->id); ?>"><?php echo e((!empty($all_info->performance_comments) )?$all_info->performance_comments:""); ?></textarea>
        </td>

    </tr>
    <?php } } ?>
    <tr>
        <td style="text-align: center" colspan="10">
            <button type="button" id="presentation_performance_btn" onclick="saveperformanceInfoPresentation()"
                    class="btn
            btn-primary btn-sm"><i
                        class="glyphicon
            glyphicon-ok-sign"></i> আপডেট
                অধিবেশন
                কক্ষ
            </button>
        </td>
    </tr>
</table>



