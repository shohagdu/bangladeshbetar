@extends("master_program")
@section('title_area')
    ::  শিল্পী সম্মানীর সাব ক্যাটাগরি ::
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
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2> শিল্পী সম্মানীর সাব ক্যাটাগরি </h2>

                <button type="button"data-toggle="modal" onclick="AddSetupInfo()" data-target="#exampleModal" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                    Add New
                </button>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th style="width:5%;">SL</th>
                                <th >প্রধান ক্যাটাগরি</th>
                                <th> সাব-ক্যাটাগরি</th>
                                <th>স্ট্যাটাস </th>
                                <th>পজিশন </th>
                                <th style="width: 20%"> #</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i=1;
                            ?>
                            @foreach($setup_info as $singleData)
                                <tr>
                                    <td>  {{ $i++  }}</td>
                                    <td>  {{ $singleData->product_ctg_title  }}</td>
                                    <td>  {{ $singleData->title  }}</td>
                                    <td class="{{ ($singleData->is_active==1)?"Active":"Inactive"  }}">  {{ ($singleData->is_active==1)?"Active":"Inactive"  }}</td>
                                    <td>  {{ $singleData->display_position  }}</td>
                                    <td>
                                        @if($singleData->is_default==1)
                                            <button type="button"  onclick="default_setup()" class="btn btn-warning btn-xs">
                                                <i class="glyphicon glyphicon-list"></i> Default Settings
                                            </button>
                                        @endif
                                        @if($singleData->is_default!=1)
                                            <button type="button"data-toggle="modal" data-target="#exampleModal"
                                                    onclick="UpdateSubCtgSetupInfo('{{ $singleData->id }}','{{ $singleData->title }}','{{ $singleData->is_active }}','{{ $singleData->parent_id }}','{{ $singleData->display_position  }}')" class="btn btn-primary btn-xs">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </button>
                                            <button type="button" onclick=" deleteSetupConfirm('{{ $singleData->id }}','program_ctg_setup')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </button>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-8">
                        <h5 class="modal-title" id="exampleModalLabel">শিল্পী সম্মানীর সাব ক্যাটাগরি </h5>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>

                {!! Form::open(['url' => '/save_setup_type', 'id' => 'type_setup_form','method' => 'post','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">

                        <div class="form-group">
                            <label class="col-md-2 control-label"> প্রধান ক্যাটাগরি</label>
                            <div class="col-md-10">
                                <select id="product_ctg" class="form-control"    name="product_ctg">
                                    <option value="">চিহ্নিত করুন</option>
                                    @if(!empty($parent_setup_info))
                                        @foreach($parent_setup_info as $ctg)
                                            <option value="{{ $ctg->id }}">{{ $ctg->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">সাব ক্যাটাগরি</label>
                            <div class="col-md-10">
                                <input type="text"  id="title" class="form-control" placeholder="সাব ক্যাটাগরি"  value="" name="title"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">পজিশন</label>
                            <div class="col-md-10">
                                <input type="text"  id="display_position" class="form-control" placeholder="পজিশন"  value="" name="display_position"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Status</label>
                            <div class="col-md-10">
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
                    <div class="col-sm-6 text-left">
                        <div id="form_output"></div>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" onclick="saveSetupInfo()" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Save</button>
                        <button type="button" onclick="saveSetupInfo()" id="updateBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                        <button type="button"  class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
                        <input type="hidden" name="setting_id" id="setting_id">

                        <input type="hidden" value="19" name="type" id="type">
                        <input type="hidden" value="artist_honouriam_sub_ctg" name="redirect_page" id="redirect_page">

                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

