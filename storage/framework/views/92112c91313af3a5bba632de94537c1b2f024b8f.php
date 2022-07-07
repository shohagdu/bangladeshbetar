<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
    <tr>
        <th style="width:5%;">SL</th>
        <th > ছবি</th>
        <th style="width:15%"> শিল্পীর নাম</th>
        <th style="width:15%"> ঠিকানা</th>


        <th> মোবাইল</th>
        <!-- <th> সম্মানীর ক্যাটাগরি</th>-->
        <th> দক্ষতা</th>
        <th> কর্মক্ষেত্র</th>
        <th> status</th>
        <th style="width: 100px"> #</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $i = 1;
    ?>
    <?php if(!empty($program_artist_info)): ?>
        <?php $__currentLoopData = $program_artist_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>  <?php echo e($i++); ?></td>
                <td><img src="<?php echo e((file_exists("fontView/assets/artist_image/"
                                            .$singleData->picture))? (!empty
                                            ($singleData->picture)?url
                                            ("fontView/assets/artist_image/"
                                            .$singleData->picture):url
                                            ("images\default\default-avatar.png")):url
                                            ("images\default\default-avatar.png")); ?>" style="height:60px;width:60px;">
                </td>
                <td>  <?php echo e($singleData->name_bn); ?></td>
                <td>  <?php echo e($singleData->address); ?></td>





                <td>
                    <?php
                    if(!empty($singleData->mobile)){
                        $mobile = json_decode($singleData->mobile,true);
                        echo $mobile[0];
                    }
                    ?>
                </td>
                <td>
                    <?php
                    $expertise_info = json_decode($singleData->artist_expertise_info,
                        true);
                    //  echo "<pre>";
                    //print_r($expertise_info);
                    // print_r($artist_exp_type);
                    //  print_r($artist_exp_type_department);
                    //                                            artist_exp_type_department
                    // $expertise_info='';
                    if(!empty($expertise_info)){
                        $expertise_info_data='';
                        foreach ($expertise_info as $expertise){
                            $expertise_info=(!empty($expertise['expertise']) && !empty
                                ($artist_exp_type[$expertise['expertise']]))
                                ?$artist_exp_type[$expertise['expertise']]:'';
                            $artist_exp_type_department_info=(!empty
                                ($expertise['expertise_dept']) && !empty($artist_exp_type_department[$expertise['expertise_dept']]) )
                                ?"("
                                .$artist_exp_type_department[$expertise['expertise_dept']]:'';
                            $expertise_grade_info_data=  !empty($expertise['expertise_grade'])
                                ?"-".$artist_grade_info[$expertise['expertise_grade']].")":'';
                            $expertise_info_data.=
                                "<b>".$expertise_info."</b>"
                                .$artist_exp_type_department_info.$expertise_grade_info_data
                                ." ,";
                        }
                        if(!empty($expertise_info_data)){
                            echo rtrim($expertise_info_data,",");
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if(!empty($singleData->work_area_id)){
                        $re_from = array("[", "]",'"');
                        $re_to = array("", "", "");
                        $work_area_id_a= str_replace($re_from, $re_to,
                            $singleData->work_area_id);
                        $arr=explode(",",$work_area_id_a);
                        if(!empty($arr)){
                            $work_data_unique=[];
                            foreach ($arr as $work_area_ar){
                                if(!empty($work_area_info_data[$work_area_ar])){
                                    $work_data_unique[]=$work_area_info_data[$work_area_ar];
                                }
                            }
                            $unique_work_area=array_unique($work_data_unique);
                            echo implode(", ",$unique_work_area);
                        }
                    }
                    ?>
                </td>
                <td class="<?php echo e(($singleData->is_active==1)?"Active":"Inactive"); ?>">  <?php echo e(($singleData->is_active==1)?"Active":"Inactive"); ?></td>
                <td>
                    <a href="<?php echo e(url('artist_record_attachment/'.$singleData->id )); ?>"
                       class="btn btn-info btn-xs">
                        <i class="glyphicon glyphicon-link"></i>
                        প্রমানক যুক্ত
                    </a>
                    <div class="col-sm-12" style="height: 5px;"></div>
                    <a href="<?php echo e(url('artist_record_update/'.$singleData->id )); ?>"
                       class="btn btn-info btn-xs" target="_blank">
                        <i class="glyphicon glyphicon-pencil"></i>
                        Edit
                    </a>

                    <a href="<?php echo e(url('artist_record_view/'.$singleData->id )); ?>"
                       class="btn btn-primary btn-xs">
                        <i class="glyphicon glyphicon-share-alt"></i>
                        View
                    </a>


                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dt_basic').DataTable( {
            "pageLength": 30,
            "lengthMenu": [[30, 50, 70, 100, -1], [30, 50, 70, 100, "All"]]
        });
    });
</script>