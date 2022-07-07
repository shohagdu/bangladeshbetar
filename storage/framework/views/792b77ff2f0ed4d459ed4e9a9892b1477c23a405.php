<textarea style="visibility:hidden;" id="schedule" name="schedule"><?php  echo json_encode($schedule,true)  ?></textarea>
<h3>বারঃ <?php echo e($day_name); ?></h3>


    <table class="table-bordered table">

        <thead>

                <!-- <tr>
                    <th colspan="6">
                    </th>
                </tr> -->

                <!-- <tr>
                <td>সময়</td>
                <td>অনুষ্ঠানের টাইটেল</td>
                <td>মন্তব্য</td>
                <td>রেকর্ড করা আছে</td>
                <td>ওভার রাইড</td>
                <td>#</td> 
                </tr>-->

                <tr>
                    <td>সময়</td>
                    
                    <td>অনুষ্ঠানের নাম</td>
                    <td>অনুষ্ঠানের বিবরন</td>
                    <td>অনুষ্ঠানের বিষয়বস্তু</td>
                    <td>প্লে লিষ্ট আই ডি</td>
                    <td>রেকর্ড</td>
                    <td>স্থিতি</td>
                    <td>মন্তব্য</td>
                    <td>প্রযোজনা</td>
                    <td>তত্বাবধানে</td>
                    <td>ক্রমিক</td>
                    
                    <td>ওভার রাইড</td>
                    
                    <td>#</td>
                </tr>

        </thead>
        
        <tbody>
                <?php  
                $i=0;
               // echo "<pre>";
              //  print_r($schedule);
                 ?>
                <?php $__currentLoopData = $schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentKey => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="schedule_<?php echo e($i); ?>">
                        <td>
                            <input type='text' readonly autocomplete='off' value='<?php echo $value['time'] ?>' id="time_<?php echo e($i); ?>"   placeholder='সময়' class='form-control'>
                        </td>
                         <td>
                            <input type='text' readonly autocomplete='off' value='<?php echo $value['chank'] ?>' id="onusan_name_<?php echo e($i); ?>"  placeholder='অনুষ্ঠানের নাম' class='form-control'>
                        </td>
                        <td>
                            <input type='text' readonly  value="<?php echo $value['biboron'] ?>" id="title_<?php echo e($i); ?>"  placeholder='অনুষ্ঠানের টাইটেল' class='form-control'>
                            <input type="text"  placeholder='অনুষ্ঠানের ওভাররাইড টাইটেল' class='form-control' onkeyUp="modifySchedule( <?php echo e($i); ?>, this.value)" style="display:none" name="overwrite_details" id="overwrite_details_<?php echo e($i); ?>"/>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $value['description'] ?>" placeholder="অনুষ্ঠানের বিষয়বস্তু" class="form-control">
                            </td>
                        <td>
                            <input type="text" onchange="pushPlaylist(<?php echo e($i); ?>,this.value)"   id="playlist_info_<?php echo e($i); ?>" onkeyup="autocompletePlaylistInfo('<?php echo e($i); ?>')" placeholder="প্লে লিষ্ট আইডি নং" class="form-control"
                            >
                             <input type="hidden"  id="playlist_info_id_<?php echo e($i); ?>" placeholder="প্লে লিষ্ট আইডি নং" class="form-control">
                            </td>
                        <td>
                            <input type="checkbox" <?php echo e((!empty( $value['is_recorded']) &&  $value['is_recorded']==1)?"checked":""); ?> >
                        </td>
                        <td>
                            <input type='text'  autocomplete='off' value='<?php echo $value['stability'] ?>'  placeholder='স্থিতি' class='form-control'>
                        </td>
                       
                        
                        <td>
                            <input type='text'  autocomplete='off' value='<?php echo $value['comment'] ?>'  placeholder='মন্তব্য' class='form-control'>
                        </td>
                        <td>
                            <select class='form-control'>
                                <option value=''>চিহ্নিত করুন</option>
                                <?php if(!empty($employee_info)): ?>
                                    <?php $__currentLoopData = $employee_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value_p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>"><?php echo e($value_p); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </td>
                        <td>
                            <select class='form-control'>
                                <option value=''>চিহ্নিত করুন</option>
                                <?php if(!empty($employee_info)): ?>
                                    <?php $__currentLoopData = $employee_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value_t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>"><?php echo e($value_t); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </td>
                        <td>
                            <input type='text'  autocomplete='off' value='<?php echo $value['sorting'] ?>'  placeholder='সময়' class='form-control'>
                        </td>
                        
                        <td>
                            <input type='checkbox'  onclick="showOverwriteDetails(<?php echo e($i); ?>, this );"/>
                        </td>
                        
                        
                        <td>
                            <button type='button' onclick="removeSchedule(<?php echo e($i); ?>)" class='btn btn-warning btn-flat btn-sm'><i class='glyphicon glyphicon-remove'></i> </button>
                        </td>
                    </tr>
                <?php  
                $i++;
                 ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>

        <tfoot>
                <tr>
                    <td colspan="9">
                    </td>
                </tr>
        </tfoot>

    </table>


    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-md-4">
        <button style="margin-bottom:10px;margin-left:300px;" type="submit" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Save</button>
        </div>
    </div>