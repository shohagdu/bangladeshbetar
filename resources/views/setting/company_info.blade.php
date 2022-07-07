@extends("master_hr")
@section('title_area')
    :: Organization Information   ::
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
                <h2>Organization Information </h2>
            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        {!! Form::open(['url' => '/company_info_update', 'method' => 'post','class'=>'form-horizontal','files' => true,'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            <label class="col-md-2 control-label">Company Name</label>
                            <div class="col-md-4">
                                <input type="text" id="name" value="{{ $company_data->com_name }}" class="form-control" placeholder="Company Name"  name="name">
                            </div>
                            <label class="col-md-2 control-label">Application Name </label>
                            <div class="col-md-4">
                                <input type="text" id="name" class="form-control" value="{{ $company_data->apps_name }}" placeholder="Application Name"  name="apps_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Email</label>
                            <div class="col-md-4">
                                <input type="text" id="email" value="{{ $company_data->email }}" class="form-control" placeholder="Email"  name="email">
                            </div>
                            <label class="col-md-2 control-label">Mobile </label>
                            <div class="col-md-4">
                                <input type="text" id="mobile" value="{{ $company_data->mobile }}" class="form-control" placeholder="Mobile"  name="mobile">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Address</label>
                            <div class="col-md-4">
                                <textarea type="text" id="address" class="form-control" placeholder="address"  name="address">{{ $company_data->address }}</textarea>
                            </div>

                            <label class="col-md-2 control-label">Apps. Share Link </label>
                            <div class="col-md-4">
                                <textarea type="text" id="apps_link"  class="form-control" placeholder="Apps. Share Link"  name="apps_link">{{ $company_data->apps_link }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Helpline</label>
                            <div class="col-md-4">
                                <input type="text" id="email" value="{{ $company_data->helpline }}" class="form-control" placeholder="Helpline"  name="helpline">
                            </div>
                            <label class="col-md-2 control-label">Web Address </label>
                            <div class="col-md-4">
                                <input type="text" id="name" value="{{ $company_data->web_address }}" class="form-control" placeholder="Web Address"  name="web_address">
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Default Email</label>
                            <div class="col-md-4">
                                <input type="text" id="default_email_send" value="{{ $company_data->default_email_send }}" class="form-control" placeholder="Default Email"  name="default_email_send">
                            </div>
                            <label class="col-md-2 control-label">Logo</label>
                            <div class="col-md-4">
                                <input type="file" class="form-control"  value="" name="image"/>
                                <input type="hidden" id="old_image" value="{{ $company_data->company_logo }}" name="old_image">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-sm-offset-8 col-md-4">
                                @if( !empty($company_data->company_logo) && file_exists('images/logo/'.$company_data->company_logo) )
                                    <img class="img-thumbnail" src=" {{ url('images/logo/'.$company_data->company_logo)   }}" style="height: 50px;width:100px;">
                                @else
                                    <img class="img-thumbnail" src=" {{ url('images/default/default-avatar.png')   }}" style="height: 50px;width:100px;">
                                @endif
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="submit" id="updateBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                            <input type="hidden" value="{{ $company_data->id }}" name="setting_id" id="setting_id">
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection