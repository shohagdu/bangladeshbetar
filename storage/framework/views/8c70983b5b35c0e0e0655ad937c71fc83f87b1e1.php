
<?php
//        echo "<pre>";
//    print_r($all_discription_ctg);
//    exit;
//?>
<div class="form-group">
    <label class="col-md-3 control-label">অনুষ্ঠানের বিবরন</label>
    <div class="col-md-6">
        <select required name="description" id="description" class="form-control description">
            <option value="">চিহ্নিত করুন</option>
            <?php if(!empty($all_discription_ctg)): ?>
                <?php $__currentLoopData = $all_discription_ctg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($value->id); ?>" <?php echo e((!empty($discription->id) && $discription->id==$value->id)
                    ?"selected":''); ?>><?php echo e($value->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">ভূমিকা</label>
    <div class="col-md-6">
        <select required name="artist_vumika" id="artist_vumika"
                class="form-control">
            <option value="">চিহ্নিত করুন</option>
            <?php if(!empty($artist_vumika)): ?>
                <?php $__currentLoopData = $artist_vumika; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php echo e((!empty($discription->rate_vumika) && $discription->rate_vumika==$key)
                    ?"selected":''); ?>  value="<?php echo e($key); ?>" ><?php echo e($value); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">কর্মক্ষেত্র</label>
    <div class="col-md-6">
        <select required name="work_area[]" multiple id="work_area_show" class=" select2" style="width:100%;"
                placeholder="চিহ্নিত করুন">
            <?php
            $artist_work_area= !empty($discription->rate_chart_work_area)?
                json_decode($discription->rate_chart_work_area,true):'';
            ?>
            <?php if(!empty($work_area)): ?>
                <?php $__currentLoopData = $work_area; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if (!empty($artist_work_area) && in_array($key,$artist_work_area)){ echo  $selected=
                        "selected";} ?> value="<?php echo e($key); ?>" ><?php echo e($value); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>
    </div>
</div>

<table class="table width100per">
    <thead>
    <tr>
        <th class="width10per">শ্রেণী</th>
        <th class="width10per">অনুষ্ঠানের স্থিতি</th>
        <th class="width10per">সম্মানীর পরিমান</th>
        <th class="width6per">মহড়া ফি</th>
        <th class="width6per">জন(সবোর্চ্চ)</th>
        <th class="width10per">মন্তব্য</th>
        <th class="width6per">পজিশন</th>
        <th class="width6per">স্ট্যাটাস</th>
        <th class="width6per">#</th>
    </tr>

    </thead>

    <?php if(!empty($all_description_info)): ?>
        <?php $__currentLoopData = $all_description_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $description_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <input type="hidden"  id="rate_chart_id_<?php echo e($key); ?>" class="form-control"
                           value="<?php echo e($description_info->id); ?>" name="rate_chart_id[]"/>

                    <select required name="artist_song_grade[]" id="artist_song_grade_<?php echo e($key); ?>"
                            class="form-control">
                        <option value="">চিহ্নিত করুন</option>
                        <?php if(!empty($artist_grade_info)): ?>
                            <?php $__currentLoopData = $artist_grade_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php echo e((!empty($description_info->grade_id) &&
                        $description_info->grade_id==$key)
                   ?"selected":''); ?>><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </td>
                <td><input type="text"  id="stability_<?php echo e($key); ?>" class="form-control" placeholder="স্থিতি"
                           value="<?php echo e($description_info->stability); ?>" name="stability[]"/></td>
                <td><input type="text"  id="amount_1"   value="<?php echo e(!empty($description_info->amount)
                   ?$description_info->amount:''); ?>"  class="form-control onlyNumber"
                           placeholder="সম্মানীর পরিমান"  name="amount[]"/></td>
                <td> <select  id="mohoda_fee_<?php echo e($key); ?>" class="form-control" name="mohoda_fee[]">
                        <option value="2" <?php echo e((!empty($description_info->mohoda_fee) &&
                        $description_info->mohoda_fee==2)
                   ?"selected":''); ?>>না</option>
                        <option value="1" <?php echo e((!empty($description_info->mohoda_fee) &&
                        $description_info->mohoda_fee==1)
                   ?"selected":''); ?>>হ্যাঁ</option>
                    </select>
                </td>
                <td><input type="text"  id="maximum_artist_<?php echo e($key); ?>" class="form-control onlyNumber"
                           placeholder="জন(সবোর্চ্চ)"  value="<?php echo e(!empty($description_info->maximum_artist)
                   ?$description_info->maximum_artist:''); ?>"  name="maximum_artist[]"/> </td>



                <td>
           <textarea  rows="1" id="remarks_info_<?php echo e($key); ?>" class="form-control" placeholder="মন্তব্য"
                      name="remarks_info[]"><?php echo e(!empty($description_info->remarks)?$description_info->remarks:''); ?></textarea>
                </td>
                <td>
                    <input type="text"  id="display_position_<?php echo e($key); ?>" class="form-control onlyNumber"
                           placeholder="পজিশন"  value="<?php echo e(!empty($description_info->display_position)
                   ?$description_info->display_position:''); ?>" name="display_position[]"/>
                </td>
                <td>
                    <select  id="is_active_<?php echo e($key); ?>" class="form-control" required  name="is_active[]">
                        <option value="">Select</option>
                        <option value="1" <?php echo e((!empty($description_info->is_active) &&
                        $description_info->is_active==1)
                   ?"selected":''); ?>>Active</option>
                        <option value="2" <?php echo e((!empty($description_info->is_active) &&
                        $description_info->is_active==2)
                   ?"selected":''); ?>>Inactive</option>
                    </select>
                </td>
                <td><a href="javascript:void(0);"  id="deleteRow_<?php echo e($key); ?>"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <tbody id="artist_chart_info_show" >
    </tbody>

    <tfoot>
    <tr>
        <td colspan="4">
            <button type="button" class="btn btn-primary btn-sm
                                        artist_expertise_info_update"><i
                        class="glyphicon glyphicon-plus"></i> Add
            </button>
        </td>
        <td colspan="5">
           <div id="form_output"></div>
        </td>

    </tr>
    </tfoot>


</table>
<input type="hidden" name="chart_id" id="chart_id" value="<?php echo e($discription->id); ?>">

<script>
    $('#work_area_show').select2();
    var scntartist_chart_info = $('#artist_chart_info_show');
    var b = $('#artist_chart_info_show tr').size() + 2;
    $('.artist_expertise_info_update').on('click', function () {
        $('<tr><td>\n' +
            '                                        <select required name="artist_song_grade[]" id="artist_song_grade_1"\n' +
            '                                                class="form-control">\n' +
            '                                            <option value="">চিহ্নিত করুন</option>\n' +
            '                                            <?php if(!empty($artist_grade_info)): ?>\n' +
            '                                                <?php $__currentLoopData = $artist_grade_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>\n' +
            '                                                    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>\n' +
            '                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>\n' +
            '                                            <?php endif; ?>\n' +
            '                                        </select>\n' +
            '                                    </td><td><input type="text"  id="stability_1" ' +
            'class="form-control" placeholder="স্থিতি" value="" name="stability[]"/></td> <td><input type="text" ' +
            ' id="amount_1" class="form-control onlyNumber" placeholder="সম্মানীর পরিমান"  value="" ' +
            'name="amount[]"/></td> <td> <select  id="mohoda_fee_1" class="form-control" name="mohoda_fee[]">\n' +
            '                                            <option value="2">না</option>\n' +
            '                                            <option value="1">হ্যাঁ</option>\n' +
            '                                        </select>\n' +
            '                                    </td> <td><input type="text"  id="maximum_artist_1" class="form-control onlyNumber"\n' +
            '                                                     placeholder="জন(সবোর্চ্চ)"  value="" name="maximum_artist[]"/> </td>\n' +
            '                                    <td>\n' +
            '                                        <textarea  rows="1" id="remarks_info_1" class="form-control" placeholder="মন্তব্য"\n' +
            '                                                   name="remarks_info[]"></textarea>\n' +
            '                                    </td>\n' +
            '                                    <td>\n' +
            '                                        <input type="text"  id="display_position_1" class="form-control onlyNumber"\n' +
            '                                               placeholder="পজিশন"  value="" name="display_position[]"/>\n' +
            '                                    </td>\n' +
            '                                    <td>\n' +
            '                                        <select  id="is_active-1" class="form-control" required  name="is_active[]">\n' +
            '                                            <option value="">Select</option>\n' +
            '                                            <option value="1" selected>Active</option>\n' +
            '                                            <option value="2">Inactive</option>\n' +
            '                                        </select>\n' +
            '                                    </td><td><a href="javascript:void(0);"  id="deleteRow_' + b + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>').appendTo(scntartist_chart_info);

        b++;
        return false;
    });


</script>