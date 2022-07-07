@extends("master_store")
@section('title_area')
    :: Product Setup   ::
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
                <h2>Product Setup </h2>

                <button type="button" data-toggle="modal" onclick="addProuctInfo()" data-target="#exampleModal"
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

                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th data-class="expand"> #</th>
                                <th data-class="expand"> Product Code</th>
                                <th data-class="expand"> Name</th>
                                <th data-class="expand"> Product Ctg</th>
                                <th data-class="expand"> Product Sub Ctg</th>
                                <th data-class="expand"> Unit</th>
                                <th data-class="expand"> Remarks</th>
                                <th data-hide="phone,tablet" style="width:120px;"> #</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($all_product_info))
                            @php($i=1)
                            @foreach($all_product_info as $singleData)
                                <tr>
                                    <td>  {{ $i++  }}</td>
                                    <td>  {{ $singleData->product_code  }}</td>
                                    <td>  {{ $singleData->name  }}</td>
                                    <td>  {{ $singleData->product_ctg_title  }}</td>
                                    <td>  {{ $singleData->product_sub_ctg_title  }}</td>
                                    <td>  {{ $singleData->unit_title  }}</td>
                                    <td class="{{ ($singleData->is_active==1)?"Active":"Inactive"  }}">  {{ ($singleData->is_active==1)?"Active":"Inactive"  }}</td>
                                    <td>

                                            <button type="button"data-toggle="modal" data-target="#exampleModal" onclick="UpdateProductInfo('{{ $singleData->id }}')" class="btn btn-primary btn-xs">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </button>
                                            {{--<button type="button" onclick=" deleteSetupConfirm('{{ $singleData->id }}','product_sub_category')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </button>--}}

                                    </td>

                                </tr>
                            @endforeach
                                @endif
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
        <div class="modal-dialog" role="document">
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
                {!! Form::open(['url' => '/save_land_info', 'method' => 'post', 'id' => 'product_info_form','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Product Code</label>
                            <div class="col-md-8">
                                <input type="text" id="product_code" value="{{  mt_rand(100000, 999999)  }}" class="form-control" placeholder="Product Code"  name="product_code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"> Category</label>
                            <div class="col-md-8">
                                <select id="product_ctg" class="form-control"   name="product_ctg" onchange="getSubCategoryInfo(this.value)">
                                    <option value="">Select</option>
                                    @if(!empty($all_product_ctg_info))
                                        @foreach($all_product_ctg_info as $ctg)
                                            <option value="{{ $ctg->id }}">{{ $ctg->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"> Sub Category </label>
                            <div class="col-md-8">
                                <select id="sub_ctg_id" class="form-control"  name="sub_ctg_id">
                                    <option value="">Select Sub Category</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Name</label>
                            <div class="col-md-8">
                                <input type="text" id="product_name" class="form-control" placeholder="Product Name"  name="product_name"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Product Unit</label>
                            <div class="col-md-8">
                                <select id="product_unit" class="form-control"  name="product_unit">
                                    <option value="">Select Unit</option>
                                    @if(!empty($all_unit_info))
                                        @foreach($all_unit_info as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-8">
                                <select  id="is_active" class="form-control" required  name="is_active">
                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>



                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <div class=" col-sm-7 text-left">
                        <span class="text-left" id="error_product_info"></span>
                    </div>
                    <div class=" col-sm-5">
                        <button type="button"  onclick="saveProductInfo()" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i>
                            Save
                        </button>
                        <button type="button" onclick="saveProductInfo()" id="updateBtn" class="btn btn-success"><i
                                    class="glyphicon glyphicon-save"></i> Update
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

@endsection

