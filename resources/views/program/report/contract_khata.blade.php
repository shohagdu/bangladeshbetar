@extends("master_program")
@section('title_area')
    :: {{ $page_title }}  ::
@endsection
@section('show_message')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert" style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
@endsection
@section('main_content_area')
    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>{{ $page_title }}</h2>
                <a href="{{ url('program_proposal_approved') }}" class="btn btn-info btn-xs"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                    চুক্তি পত্র (Contract)
                </a>
                <a href="{{ url('contract_khata') }}" class="btn btn-primary btn-xs"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-refresh"></i>
                    Refresh
                </a>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        {!! Form::open(['url' => '', 'method' => 'post','id' => 'searchContractInfoFrom',
                'class'=>'form-horizontal']) !!}
                        <div class="form-group">
                            <label class="col-md-2 control-label"> From Date </label>
                            <div class="col-md-3">
                                <input type="text" value="{{ date('01-m-Y')  }}" class="form-control
                                        datepicker"
                                       name="from_date">
                            </div>
                            <label class="col-md-2 control-label"> To Date </label>
                            <div class="col-md-3">
                                <input type="text" value="{{ date('d-m-Y')  }}"  class="form-control
                                        datepicker" name="to_date">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success btn-sm"
                                        onclick="searchContractInfo()"
                                        name="search_proposal"
                                ><i class="glyphicon glyphicon-search"></i> Search</button>
                            </div>


                        </div>
                        {!! Form::close() !!}
                        <div id="form_output"></div>

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection