{!! Form::open(['url' => '/save_employee_bank_info', 'method' => 'post', 'id' => 'employee_bank_form','class'=>'form-horizontal']) !!}
<div class="modal-body">
    <div class="col-sm-12">
        <div class="form-group">
            <label class="col-md-2 control-label">Basic Salary</label>
            <div class="col-md-4">
                <input type="text" id="basic_salary"  value="{{ (!empty($employee_salary_info->basic_salary)?$employee_salary_info->basic_salary:'')  }}" class="form-control onlyNumber" placeholder="Basic Salary"  name="basic_salary"/>

            </div>
            <label class="col-md-2 control-label">Pay Scale</label>
            <div class="col-md-4">
                <input type="text" id="pay_scale"  value="{{ (!empty($employee_salary_info->pay_scal)?$employee_salary_info->pay_scal:'')  }}" class="form-control onlyNumber" placeholder="Pay Scale"  name="pay_scale"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Bank Name</label>
            <div class="col-md-4">
                <select id="bank_name" class="form-control"  name="bank_name">
                    <option value="">Select</option>
                    @if(!empty($bank_data_info))
                        @foreach($bank_data_info as $key=>$value)
                            <option value="{{ $key }}" {{ (!empty($employee_salary_info->bank_Id) && $employee_salary_info->bank_Id==$key)?"selected":'' }}>{{ $value }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <label class="col-md-2 control-label">Account No</label>
            <div class="col-md-4">
                <input type="text" value="{{ (!empty($employee_salary_info->account_no)?$employee_salary_info->account_no:'')  }}" id="account_no" class="form-control" placeholder="Account No"  name="account_no"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-12">Provident fund information</label>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">PF Inital Balance</label>
            <div class="col-md-4">
                <input type="text" id="pf_inital_pf_balance" value="{{ (!empty($employee_salary_info->pf_inital_balance)?$employee_salary_info->pf_inital_balance:'')  }}" class="form-control onlyNumber" placeholder="PF Inital Balance"  name="pf_inital_pf_balance"/>
            </div>
            <label class="col-md-2 control-label">PF Deduction(%)</label>
            <div class="col-md-4">
                <input type="text" id="pf_deduction_per" value="{{ (!empty($employee_salary_info->pf_deduction_per)?$employee_salary_info->pf_deduction_per:'')  }}" class="form-control onlyNumber" placeholder="PF Deduction(%)"  name="pf_deduction_per"/>
            </div>
        </div>


    </div>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <div class=" col-sm-7 text-left">
        <span class="text-left" id="form_output_bank_info"></span>
    </div>
    <div class=" col-sm-5">
        <input type="hidden" name="employee_id" value="{{ $employe_info->employee_id }}">
        <button type="button" onclick="updateBankSalaryInfo()" id="updateBtn" class="btn btn-success"><i
                    class="glyphicon glyphicon-save"></i> Update
        </button>
        <a data-toggle="tab" class="btn btn-danger" href="#ict_credentials"><i
                    class="glyphicon glyphicon-step-forward"></i> Next</a>

    </div>
</div>
{!! Form::close() !!}