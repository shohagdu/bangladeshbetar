@extends("master_store")
@section('title_area')
    :: Product Stock In Report ::
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
    <article class="col-sm-12 col-md-12 col-lg-12 padding-bottom-10px">
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2 id="title_info_print">Product Stock In Report </h2>

                <div class="no-print">
                    <button type="button" onclick="print_fun()" class="btn btn-warning btn-xs topbarbutton"><i
                                class="glyphicon glyphicon-print"></i>
                        Print
                    </button>
                </div>
                <div class="show-print-date" style="display:none;">
                    Date: {{ date('d-m-Y') }}
                </div>
            </header>
            <div style="margin-bottom:50px;">
                <div class="widget-body no-padding" style="padding-bottom:50px;">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px"></div>
                        <div class="no-print">
                        {!! Form::open(['url' => '', 'method' => 'post', 'id' => 'product_stock_in_form','class'=>'form-horizontal']) !!}
                            <div class="col-sm-2">
                                <select id="station_id" class="form-control"   name="station_id">
                                    <option value="">Select</option>
                                    @if(!empty($station_info))
                                        @foreach($station_info as $key=>$station)
                                            <option value="{{ $key }}">{{ $station }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select id="product_ctg" class="form-control"   name="product_ctg" onchange="getSubCategoryInfo(this.value)">
                                    <option value="">Select</option>
                                    @if(!empty($product_ctg))
                                        @foreach($product_ctg as $ctg)
                                            <option value="{{ $ctg->id }}">{{ $ctg->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select id="sub_ctg_id" class="form-control"  name="sub_ctg_id">
                                    <option value="">Select Sub Category</option>
                                </select>

                            </div>
                            <div class="col-sm-2">
                                <input type="text" onkeypress="searchAutoComplete(this)"  id="product_name_search" class="form-control" placeholder="Product Name Or Code"  />
                                <input type="hidden"  id="product_id_search" class="form-control"  name="product"/>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" onclick="search_stock_in_info()" id="search_btn" class="btn btn-success btn-sm"   name="search_btn"><i class="glyphicon glyphicon-search"></i> Search</button>
                            </div>
                        {!! Form::close() !!}
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12" style="margin-top:10px;">
                            <div class="col-sm-4" >
                                <div class="row">
                                    <div id="error_data"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div id="show_report_info"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

