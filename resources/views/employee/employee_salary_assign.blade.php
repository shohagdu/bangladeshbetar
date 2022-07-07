@extends("master_hr")
@section('title_area')
    :: Employee Salary Assign Information   ::
@endsection
@section('show_message')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert"
             style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
@endsection
@section('main_content_area')
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>Employee Salary Assign </h2>
            </header>
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table id="employee_salary_assign" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th data-class="expand"> employee Id</th>
                                    <th data-class="expand"> Name</th>
                                    <th data-class="expand"> Station</th>
                                    <th data-class="expand"> Mobile</th>
                                    <th data-class="expand"> Department</th>
                                    <th data-class="expand"> Designation</th>
                                    <th data-class="expand"> Status</th>
                                    <th data-hide="phone,tablet" style="width:120px;"> #</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <div class="modal fade" id="salaryAssignModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:80%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title-salary-assign"></span></h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>
                {!! Form::open(['url' => '/save_salary_assign', 'method' => 'post', 'id' => 'employee_salary_assign_form','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12">
                        <table class="width100per table table-bordered">
                            <tr>
                                <th rowspan="3" class="width20per">Image</th>
                                <th class="width10per">Employee ID</th>
                                <td><span id="employee_id_show"></span></td>
                                <th class="width10per">Station Name</th>
                                <td><span id="station_name"></span></td>

                            </tr>
                            <tr>
                                <th> Name</th>
                                <td><span id="employee_name"></span></td>
                                <th>Mobile</th>
                                <td><span id="mobile"></span></td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td><span id="department"></span></td>
                                <th>Designation</th>
                                <td><span id="designaion"></span></td>
                            </tr>


                        </table>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Basic Salary</label>
                            <div class="col-md-4">
                                <input type="text" id="emp_basic_salary" readonly class="form-control" placeholder="Basic Salary"  name="emp_basic_salary"/>
                            </div>
                            <label class="col-md-2 control-label">Pay Scal </label>
                            <div class="col-md-4">
                                <input type="text" id="emp_pay_scal" readonly class="form-control" placeholder="Employee Pay Scal"  name="emp_pay_scal"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                 <div id="show_earning_ctg"></div>
                            </div>
                            <div class="col-md-6">
                                <div id="show_deduction_ctg"></div>
                            </div>


                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <div class=" col-sm-7 text-left">
                        <span class="text-left" id="form_output_assign"></span>
                    </div>
                    <div class=" col-sm-5">
                        <input type="hidden" name="employee_id" id="employee_id" >
                        <input type="hidden" name="is_salary_assign" id="is_salary_assign" >
                        <button type="button"  onclick="saveEmployeeSalaryAssign()" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i>
                            Save
                        </button>
                        <button type="button" id="updateBtn" onclick="saveEmployeeSalaryAssign()" class="btn btn-success"><i
                                    class="glyphicon glyphicon-save"></i> Update
                        </button>
                        <button type="button"  class="btn btn-danger" data-dismiss="modal"><i
                                    class="glyphicon glyphicon-remove"></i> Close
                        </button>

                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection



