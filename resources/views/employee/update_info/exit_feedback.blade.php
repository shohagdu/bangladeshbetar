{!! Form::open(['url' => '/save_employee_exit_feedback', 'method' => 'post', 'id' => 'employee_exit_feedback_form','class'=>'form-horizontal']) !!}
<div class="modal-body">
    <div class="col-sm-12">
        <?php
        $exit_feedback_info = (!empty($employee_general_info->exit_feedback)) ? json_decode($employee_general_info->exit_feedback, true) : NULL;
        ?>
        <div class="form-group">
            <label class="col-md-2 control-label">Reason of Resignation</label>
            <div class="col-md-4">
                <input type="text" value="{{ (!empty($exit_feedback_info['reason_of_resignation'])?$exit_feedback_info['reason_of_resignation']:'')  }}" id="reason_of_resignation" class="form-control" placeholder="Reason of Resignation"  name="reason_of_resignation"/>

            </div>
            <label class="col-md-2 control-label">Resignation Date</label>
            <div class="col-md-4">
                <input type="text" value="{{ (!empty($exit_feedback_info['resignation_date'])?$exit_feedback_info['resignation_date']:'')  }}" id="resignation_date" class="form-control datepickerinfo" placeholder="Resignation Date"  name="resignation_date"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">New Work Place</label>
            <div class="col-md-4">
                <input type="text" value="{{ (!empty($exit_feedback_info['new_work_place'])?$exit_feedback_info['new_work_place']:'')  }}" id="new_work_place" class="form-control" placeholder="New Work Place"  name="new_work_place"/>
            </div>
            <label class="col-md-2 control-label">New Work Place Address</label>
            <div class="col-md-4">
                <textarea id="new_work_place_address" class="form-control" placeholder="New Work Place Address"  name="new_work_place_address">{{ (!empty($exit_feedback_info['new_work_place_address'])?$exit_feedback_info['new_work_place_address']:'')  }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Comments of Employee</label>
            <div class="col-md-10">
                <textarea id="comments_employee" class="form-control" placeholder="Comments of Employee"  name="comments_employee">{{ (!empty($exit_feedback_info['comments_employee'])?$exit_feedback_info['comments_employee']:'')  }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Comments of Authority</label>
            <div class="col-md-10">
                <textarea id="comments_authority" class="form-control" placeholder="Comments of Authority"  name="comments_authority">{{ (!empty($exit_feedback_info['comments_authority'])?$exit_feedback_info['comments_authority']:'')  }}</textarea>
            </div>
        </div>

    </div>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <div class=" col-sm-7 text-left">
        <span class="text-left" id="form_output_exit_feedback"></span>
    </div>
    <div class=" col-sm-5">
        <input type="hidden" name="employee_id" value="{{ $employe_info->employee_id }}">
        <button type="button" onclick="updateExitFeedbackInfo()" id="updateBtn" class="btn btn-success"><i
                    class="glyphicon glyphicon-save"></i> Update
        </button>
        <a data-toggle="tab" class="btn btn-danger" href="#employee_action"><i
                    class="glyphicon glyphicon-step-forward"></i> Next</a>

    </div>
</div>
{!! Form::close() !!}