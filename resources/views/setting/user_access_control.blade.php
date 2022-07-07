@extends("master_hr")
@section('title_area')
    :: User Access Control ::

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
                <h2 id="title_info_print">User Access Control </h2>
                <div class="no-print">
                    <a href="{{ url('user_access_control') }}" class="btn btn-warning btn-xs topbarbutton"><i
                                class="glyphicon glyphicon-refresh"></i>
                        Refresh
                    </a>
                </div>
            </header>
            <div>
                <div class="widget-body no-padding"  >
                    <div class="col-sm-12" >
                        <div class="col-sm-12 margin-top-10px" style="margin-top:10px"></div>
                        <div class="no-print">
                            {!! Form::open(['url' => '', 'method' => 'post', 'id' => 'employee_report_form','class'=>'form-horizontal']) !!}
                            <div class="col-sm-2">
                                <label>Station</label>
                                <select id="station_id" class="form-control"   name="station_id">
                                    <option value="">Select</option>
                                    @if(!empty($station_info))
                                        @foreach($station_info as $key=>$station)
                                            <option value="{{ $key }}">{{ $station }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label>Employee Name</label>
                                <input type="text" onkeypress="autocompleteEmployeeInfo(this)"  id="employee_name_search" class="form-control" placeholder="Search Name Or ID"  />
                                <input type="hidden"  id="employee_id_search" class="form-control"  name="employee_id_search"/>
                            </div>
                            <div class="col-sm-2 margin-top-20px">
                                <button type="button" onclick="employee_user_access_search()" id="search_btn"
                                        class="btn btn-success btn-sm"   name="search_btn"><i class="glyphicon glyphicon-search"></i> Search</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12 margin-top-10px" >
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

    <script>

        function updateDataUserInfo(id,name,mobile,email,address,employee_id) {
            $("#name").val(name);
            $("#mobile").val(mobile);
            $("#email").val(email);
            $("#address").val(address);


            $("#setting_id").val(id);
            $("#employee_id").val(employee_id);
            $('#form_output').html('');
            $("#saveBtn").hide();
            $("#updateBtn").show();
            $("#heading-title").html('Update ')

        }

        function createUser() {
            $.ajax({
                type: "POST",
                url: "<?php  echo url('/save_user_customer_info');?>",
                data: $('form').serialize(),
                'dataType': 'json',
                success: function (response) {
                    if(response.status=='error'){
                        $('#form_output').html("<div class='alert alert-danger'>"+response.message+"</div>");
                    }else {
                        var data = response.message;
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output').html(error_html);
                        } else {
                            $('#exampleModal').modal().hide();
                            $('#formData')[0].reset();
                            $('#form_output').html('');
                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                                // $('#dt_basic').DataTable();
                            });
                        }
                    }
                }
            });
        }

        function impersonateUserAccount(id) {
            swal({
                title: "Are you sure?",
                text: "Impersonate in this user access",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: "<?php  echo url('/delete_user_customer_info')?>",
                            data: {id: id},
                            'dataType': 'json',
                            success: function (response) {
                                if (response.status == 'success') {
                                    swal({
                                        text: response.message,
                                        icon: "success",
                                    }).then(function() {
                                        location.reload();
                                    });

                                } else {
                                    swal(response.message, {
                                        icon: "warning",
                                    });
                                }
                            }
                        });
                    } else {
                        swal("Cancelled Now!");
                    }
                });
        }

    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="float: left" id="exampleModalLabel"><span id="heading-title"></span> Update Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="clearfix"></div>
                </div>
                <div class="col-sm-12" >
                    <div id="form_output"></div>
                </div>
                {!! Form::open(['url' => '/save_user_customer_info', 'id' => 'formData', 'method' => 'post','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Employee ID </label>
                            <div class="col-md-9">
                                <input type="text" readonly  id="employee_id" class="form-control" placeholder="Name" required value="" name="employee_id"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Employee Name </label>
                            <div class="col-md-9">
                                <input type="text" readonly id="name" class="form-control" placeholder="Name" required value="" name="name"/>

                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-3 control-label">Mobile </label>
                            <div class="col-md-9">
                                <input type="text" readonly id="mobile" class="form-control" placeholder="Mobile" required value="" name="mobile"/>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Login Access</label>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> Email</label>
                            <div class="col-md-9">
                                <input type="text" readonly  id="email" class="form-control" placeholder="Email" required value="" name="email"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">New Password</label>
                            <div class="col-md-9">
                                <input type="password"  id="password" class="form-control" placeholder="New Password"  value="" name="password">

                            </div>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="createUser()" id="updateBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
                    <input type="hidden" name="setting_id" id="setting_id">
                    <input type="hidden" name="type" value="1" id="type">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection



