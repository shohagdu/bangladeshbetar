@extends("master_store")
@section('title_area')
    :: Product Stock Information   ::

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

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>Product Stock Information </h2>

                <button type="button" data-toggle="modal" onclick="addProuctStockInfo()" data-target="#exampleModal"
                        class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    Add New
                </button>

            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <table id="product_stock_data" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th data-class="expand"> Stock Code</th>
                                <th data-class="expand"> Station</th>
                                <th data-class="expand"> Product Info.</th>
                                <th data-class="expand"> Reference</th>
                                <th data-class="expand"> Room No</th>
                                <th data-class="expand"> Purchase Date</th>
                                <th data-class="expand"> Warranty</th>
                                <th data-class="expand"> Life Time</th>
                                <th data-class="expand">Maintenance</th>
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


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title"></span></h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>
                {!! Form::open(['url' => '/save_land_info', 'method' => 'post', 'id' => 'stock_info_form','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Product Reference </label>
                            <div class="col-md-4">
                                <input type="text" id="reference" class="form-control" placeholder="Reference"  name="reference"/>

                            </div>
                            <label class="col-md-2 control-label">Station Name</label>
                            <div class="col-md-4">
                                <select id="station_name" class="form-control"  name="station_name">
                                    <option value="">Select Station</option>
                                    @if(!empty($branch_info))
                                        @foreach($branch_info as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>


                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Product</label>
                            <div class="col-md-4">
                                <input type="text" onkeypress="searchAutoComplete(this)"  id="product_name_search" class="form-control" placeholder="Search Product Name Or Code"  />
                                <input type="hidden"  id="product_id_search" class="form-control"  name="product"/>
                            </div>
                            <label class="col-md-2 control-label">Room No</label>
                            <div class="col-md-4">
                                <input type="text" id="room_no" class="form-control" placeholder="Room No"  name="room_no"/>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-md-2 control-label">Purchase Date </label>
                            <div class="col-md-4">
                                <input type="text" id="purchase_date" class="form-control datepickerinfo" placeholder="Purchase Date" value="{{ date('d-m-Y') }}"  name="purchase_date"/>
                            </div>
                            <label class="col-md-2 control-label">Warranty </label>
                            <div class="col-md-2">
                                <input type="text" id="warranty_count" class="form-control" placeholder="0"  name="warranty_count"/>
                            </div>
                            <div class="col-md-2">

                                <?php
                                $days=show_days_year()
                                ?>

                                <select id="warranty" class="form-control"  name="warranty">
                                    <option value="">Select</option>
                                    @if(!empty($days))
                                        @foreach($days as $key=>$value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Product Life Time</label>
                            <div class="col-md-2">
                                <input type="text" id="life_time_count" class="form-control" placeholder="0"  name="life_time_count"/>
                            </div>
                            <div class="col-md-2">
                                <select id="life_time" class="form-control"  name="life_time">
                                    <option value="">Select</option>
                                    @if(!empty($days))
                                        @foreach($days as $key=>$value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <label class="col-md-2 control-label">Maintenance </label>
                            <div class="col-md-4">
                                <select id="is_maintenance" class="form-control"  name="is_maintenance">
                                    <option value="1">No</option>
                                    <option value="2">Yes</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group" id="maintenance_details">
                            <label class="col-md-2 control-label">Maintenance Details</label>
                            <div class="col-md-10">
                                <textarea id="maintenance_details_data" class="form-control" placeholder="Maintenance Details"  name="maintenance_details"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Product User</label>
                            <div class="col-md-4">
                                <input type="text" id="product_user" class="form-control" placeholder="Product User"  name="product_user"/>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <div class=" col-sm-7 text-left">
                        <span class="text-left" id="error_product_stock_info"></span>
                    </div>
                    <div class=" col-sm-5">
                        <button type="button"  onclick="saveProductStock()" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i>
                            <span id="SaveUpdateBtn"></span>
                        </button>

                        <button type="button"  class="btn btn-danger" data-dismiss="modal"><i
                                    class="glyphicon glyphicon-remove"></i> Close
                        </button>
                        <input type="hidden" name="setting_id" id="setting_id">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="modal fade" id="stockOutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel" ><span id="heading-title-stock-out"></span></h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>
                {!! Form::open(['url' => '/stock_out_info', 'method' => 'post', 'id' => 'stock_out_info','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Stock Code </label>
                            <div class="col-md-8">
                                <input type="text" readonly id="stock_code" class="form-control" placeholder="Reference" />

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Product Reference </label>
                            <div class="col-md-8">
                                <input type="text" readonly id="reference_stock_out" class="form-control" placeholder="Reference"  />

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Station Name</label>
                            <div class="col-md-8">
                                <select id="station_name_stock_out" readonly class="form-control"  >
                                    <option value="">Select Station</option>
                                    @if(!empty($branch_info))
                                        @foreach($branch_info as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>


                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Product</label>
                            <div class="col-md-8">
                                <input type="text" readonly  name="product_name_stock_out" id="product_name_stock_out" class="form-control" placeholder="Search Product Name Or Code"  />

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Purchase Date </label>
                            <div class="col-md-8">
                                <input type="text" readonly id="purchase_date_stock_out" class="form-control datepickerinfo" placeholder="Purchase Date"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Product User</label>
                            <div class="col-md-8">
                                <input type="text" readonly id="product_user_stock_out" class="form-control" placeholder="Product User"  />
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-md-4 control-label">Stock Out Reason</label>
                            <div class="col-md-8">
                                <textarea id="stock_out_reason" class="form-control" placeholder="Stock Out Reason"  name="stock_out_reason"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <div class=" col-sm-7 text-left">
                        <span class="text-left" id="error_product_stock_out"></span>
                    </div>
                    <div class=" col-sm-5">
                        <button type="button"  onclick="ProductStockOut()" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i>
                            <span id="stockOutBtn"></span>
                        </button>

                        <button type="button"  class="btn btn-danger" data-dismiss="modal"><i
                                    class="glyphicon glyphicon-remove"></i> Close
                        </button>
                        <input type="hidden" name="setting_id" id="setting_stock_id">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

