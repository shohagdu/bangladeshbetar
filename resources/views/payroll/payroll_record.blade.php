@extends("master_hr")
@section('title_area')
    :: Payroll Record ::

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
    <article class="col-sm-12 col-md-12 col-lg-12 padding-bottom-10px" >

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false" >
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>Employee Payroll Record </h2>
           <a href="<?php  echo asset('/payroll_generate');?>"
            class="btn btn-primary btn-xs topbarbutton" ><i
            class="glyphicon glyphicon-backward"></i>
            Payrole Generate
            </a>
            </header>
            <div>
                <div class="widget-body no-padding"  >
                    {!! Form::open(['url' => '/save_employee_payrole_genrate', 'method' => 'post', 'id' => 'employee_payslip_record','class'=>'form-horizontal']) !!}
                    <div class="col-sm-12" >
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select type="text"  id="show_payslip_record" class="form-control" name="payrole_months">
                                    <option value="">Select Payslip Months</option>
                                    @if(!empty($payslip_months))
                                        @foreach($payslip_months as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div id="show_eligible_employee_payrole"></div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </article>
@endsection

