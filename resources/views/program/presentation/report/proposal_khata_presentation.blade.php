@extends("master_program")
@section('main_content_area')
    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2 class="no-print">{{ $page_title }}</h2>
                <a href="{{ url('presentation_proposal_info') }}" class="btn btn-info btn-xs no-print"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                    প্রস্তাব (Proposal)
                </a>
                <a href="{{ url('proposal_khata_presentation') }}" class="btn btn-primary btn-xs no-print"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-refresh"></i>
                    Refresh
                </a>

            </header>
            <div>
                <div class="widget-body no-padding ">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        {!! Form::open(['url' => '', 'method' => 'post','id' => 'searchProposalInfoFrom',
                'class'=>'form-horizontal']) !!}
                        <div class="form-group no-print">
                            <div class="col-md-2">
                                <label> কেন্দ্রের / ইউনিট নাম </label>
                                <select id="station_id"  required class="form-control" onchange="getSubStation(this.value)"  name="station_id">
                                    <option value="">চিহ্নিত করুন</option>
                                    @if(!empty($station_info))
                                        @foreach($station_info as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif


                                </select>

                            </div>
                            <div class="col-md-2">
                                <label> ফ্রিকোয়েন্সি </label>
                                <select id="sub_station_id" required class="form-control" name="fequency_id">
                                    <option value="">চিহ্নিত করুন</option>
                                </select>
                            </div>


                            <div class="col-md-2">
                                <label>  শুরুর তারিখ </label>
                                <input type="text" value="{{ date('01-m-Y')  }}" class="form-control
                                        datepicker"
                                       name="from_date">
                            </div>

                            <div class="col-md-2">
                                <label> শেষ তারিখ </label>
                                <input type="text" value="{{ date('d-m-Y')  }}"  class="form-control
                                        datepicker" name="to_date">
                            </div>
                            <div class="col-md-2" style="margin-top:22px;">
                                <input type="hidden" name="presentration_type" value="{{   Request::segment(2) }}">
                                <button type="button" class="btn btn-success btn-sm"
                                        onclick="searchProposalInfoPresentation()"
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