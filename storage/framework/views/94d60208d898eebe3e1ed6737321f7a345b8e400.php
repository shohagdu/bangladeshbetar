<?php echo Form::open(['url' => '/save_employee_award_info', 'method' => 'post', 'id' => 'employee_award_form',
'class'=>'form-horizontal']); ?>

<div class="modal-body">
    <div class="col-sm-12">
        <?php
        $award_info = (!empty($employee_general_info->award_info)) ? json_decode
        ($employee_general_info->award_info, true) : NULL;
        ?>

        <div class="col-sm-12">
            <table class="table table-bordered width100per">
                <thead>
                <tr>
                    <th colspan="3" class="width100per">Award Information</th>
                </tr>
                <tr>
                    <th class="width30per">Title</th>
                    <th  class="width30per">Description</th>
                    <th class="width10per">Action</th>
                </tr>

                </thead>
                <?php if(!empty($award_info)): ?>
                    <?php ($kl=1); ?>
                    <?php $__currentLoopData = $award_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $award): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><input type="text" name="title[]" placeholder="Award Title" value="<?php echo e((!empty
                            ($award['title']))?$award['title']:''); ?>" class="form-control" id="gchildName_<?php echo e($kl); ?>"></td>
                            <td><textarea name="description[]"  rows="1" placeholder="Award Description"
                                          class="form-control"
                                          id="description_<?php echo e($kl); ?>"><?php echo e((!empty($award['description']))
                            ?$award['description']:''); ?></textarea></td>

                            <td><a href="javascript:void(0);"  id="deleteRow_<?php echo e($kl); ?>"  class="deleteRow btn btn-warning
                             btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i> Drop</a></td>

                        </tr>
                        <?php ($kl++); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <tbody id="dynamicAwardInfo">
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3"><button type="button" class="btn btn-primary btn-sm" id="add_award_info" ><i
                                    class="glyphicon glyphicon-plus"></i> Add New</button> </td>
                </tr>
                </tfoot>

            </table>

        </div>

    </div>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <div class=" col-sm-7 text-left">
        <span class="text-left" id="form_output_award"></span>
    </div>
    <div class=" col-sm-5">
        <input type="hidden" name="employee_id" value="<?php echo e($employe_info->employee_id); ?>">
        <button type="button" onclick="updateAwardInfo()" id="updateBtn" class="btn btn-success"><i
                    class="glyphicon glyphicon-save"></i> Update
        </button>
        <a data-toggle="tab" class="btn btn-danger" href="#promotion"><i
                    class="glyphicon glyphicon-step-forward"></i> Next</a>

    </div>
</div>
<?php echo Form::close(); ?>


<script>
    var scntDivAwardInfo = $('#dynamicAwardInfo');
    var expertise_info = $('#dynamicAwardInfo').size() + 1;
    $('#add_award_info').on('click', function () {
        $(`<tr>
            <td><input type="text" name="title[]" placeholder="Award Title" class="form-control"
        id="title_${expertise_info}"> </td>
        <td><textarea name="description[]" placeholder="Award Description" rows="1" id="description_${expertise_info}"
        class="form-control"></textarea></td>
        <td><a href="javascript:void(0);"  id="deleteRow_${expertise_info }"  class="deleteRow btn btn-warning btn-flat btn-sm"><i
        class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>`).appendTo(scntDivAwardInfo);

        expertise_info++;
        return false;
    });
</script>