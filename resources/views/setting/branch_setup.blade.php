@extends("master_hr")
@section('title_area')
    ::  Station Setup  ::

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
                <h2> Station Setup </h2>
                <button type="button"data-toggle="modal" onclick="addDataBranch()" data-target="#exampleModal" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                    Add New
                </button>

            </header>

            <!-- widget div-->
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th style="width:5%;">SL</th>
                                <th> Station Name</th>
                                <th> Mobile</th>
                                <th> Email</th>
                                <th> Address</th>
                                <th> Status </th>
                                <th> Sorting</th>
                                <th style="width: 10%"> #</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i=1;
                            ?>
                            @foreach($branch_info as $singleData)
                                <tr>
                                    <td>  {{ $i++  }}</td>

                                    <td>  {{ $singleData->name  }}</td>
                                    <td>  {{ $singleData->mobile  }}</td>
                                    <td>  {{ $singleData->email  }}</td>
                                    <td>  {{ $singleData->address  }}</td>

                                    <td class="{{ ($singleData->is_active==1)?"Active":"Inactive"  }}">  {{ ($singleData->is_active==1)?"Active":"Inactive"  }}</td>
                                    <td>  {{ $singleData->sorting  }}</td>
                                    <td>
                                        <button type="button"data-toggle="modal" data-target="#exampleModal" onclick='updateBranchInfo("{{ $singleData->id }}","{{ $singleData->name }}","{{ $singleData->mobile }}","{{ $singleData->email }}","{{ $singleData->is_active }}","{{ $singleData->sorting }}" )' class="btn btn-primary btn-xs">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </button>
                                        {{--<a href="{{ url('/delete_montly_open/'. $singleData->id  ) }}" onclick="return confirm('Are you want to delete this record')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </a>--}}
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
    <script>

        function addDataBranch() {
            $("#branch_setup")[0].reset();
            $("#setting_id").val('');
            $("#status").val(1);
            $("#updateBtn").hide();
            $("#saveBtn").show();
            $("#dynamicSubStationtr").html('');

        }
        function updateBranchInfo(id,name,mobile,email,status,position) {
            $("#branch_name").val(name);
            $("#mobile").val(mobile);
            $("#email").val(email);
            $("#status").val(status);
            $("#position").val(position);
            $("#setting_id").val(id);


            $("#updateBtn").show();
            $("#saveBtn").hide();

            $.ajax({
                type: "POST",
                url: base_url + "/get_branch_info",
                data: {id: id},
                'dataType': 'json',
                success: function (response) {
                    if (response.status == 'success') {
                        $("#address").val(response.data.address);
                        var sub_station=response.data.sub_station_info;
                        $('#dynamicSubStationtr').html('');
                        $('#dynamicSubStationtrAdd').hide('');
                        var scntDivSubStation = $('#dynamicSubStationtr');
                        var sub_count = parseInt(100) + 1;
                        for (var count = 0; count < sub_station.length; count++) {
                            $('<tr><td><input type="hidden" value="'+ sub_station[count].id+'"  id="id_'+
                                sub_count +'" ' +
                                'class="form-control"   name="id['+ sub_count +']"/><select  id="type_' + sub_count +
                                '" ' +
                                'class="form-control"  name="type['+ sub_count +']">\n' +
                                '                                            <option value="">Select</option>\n' +
                                '                                            <option value="1" >AM</option>\n' +
                                '                                            <option value="2">Fm</option>\n' +
                                '                                        </select></td><td><input type="text"  ' +
                                'value="'+ sub_station[count].fequencey +'"' +
                                ' id="fequencey_'+ sub_count+'" ' +
                                'class="form-control" placeholder="Fequencey"   name="fequencey['+ sub_count +']"/></td><td><input ' +
                                'type="text" value="'+ sub_station[count].title +'"  id="name_'+ sub_count +'" class="form-control" ' +
                                'placeholder="Name"\n' +
                                '                                               required  name="name['+ sub_count +']"/><td><a ' +
                                'href="javascript:void(0);"  id="deleteRow_' + sub_count + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>').appendTo(scntDivSubStation);
                                $("#type_"+sub_count).val(sub_station[count].type);
                            sub_count++
                        }


                    } else {
                        $("#address").val('');
                    }
                }
            });
        }
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-8">
                        <h5 class="modal-title" id="exampleModalLabel">Station Information  </h5>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                {!! Form::open(['url' => '/save_branch_setup', 'id'=>'branch_setup', 'method' => 'post','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">


                        <div class="form-group">
                            <label class="col-md-2 control-label"> Station Name</label>
                            <div class="col-md-4">
                                <input type="text"  id="branch_name" class="form-control" placeholder="Station Name" required  name="branch_name"/>

                            </div>
                            <label class="col-md-2 control-label">Mobile
                            </label>
                            <div class="col-md-4">
                                <input type="text"  id="mobile" class="form-control" placeholder="Mobile"  required  name="mobile"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Email
                            </label>
                            <div class="col-md-4">
                                <input type="text"  id="email" class="form-control" placeholder="Email"  required  name="email"/>

                            </div>
                            <label class="col-md-2 control-label">Sorting </label>
                            <div class="col-md-4">
                                <input type="text"  id="position" class="form-control" placeholder="Sorting" required value="" name="position"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Address
                            </label>
                            <div class="col-md-4">
                                <textarea id="address" class="form-control" placeholder="Address"  required name="address"></textarea>
                            </div>
                            <label class="col-md-2 control-label"> Status</label>
                            <div class="col-md-4">
                                <select  id="status" class="form-control" required name="status">
                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <table class="width100per table table-bordered">
                                <tr>
                                    <th class="width15per">Type</th>
                                    <th class="width30per">Fequencey</th>
                                    <th class="width30per">Name</th>
                                    <th class="width15per">#</th>
                                </tr>
                                <tr id="dynamicSubStationtrAdd">
                                    <td>
                                        <select  id="type_1" class="form-control"  name="type[]">
                                            <option value="">Select</option>
                                            <option value="1">এ এম(AM)</option>
                                            <option value="2">এফ এম (Fm)</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text"  id="fequencey_1" class="form-control"
                                               placeholder="Fequencey"
                                                 name="fequencey[]"/>
                                    </td>
                                    <td>
                                        <input type="text"  id="name_1" class="form-control" placeholder="Name"
                                                 name="name[]"/>
                                    </td>
                                    <td></td>
                                </tr>
                                <tbody id="dynamicSubStationtr">
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="4">
                                        <button type="button" class="btn btn-primary btn-sm"
                                                            id="add_sub_station" class="add_sub_station"><i
                                                    class="glyphicon glyphicon-plus"></i> Add New</button> </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>


                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="saveBtn" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Save </button>
                    <button type="submit" name="updateBtn" id="updateBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i>Close</button>
                    <input type="hidden" name="setting_id" id="setting_id">

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script>
        var scntDivSubStation = $('#dynamicSubStationtr');
        var a = $('#dynamicSubStationtr tr').size() + 2;
        $('#add_sub_station').on('click', function () {
            $('<tr><td><select  id="type_'+ a +'" class="form-control"  name="type[]">\n' +
                '                                            <option value="">Select</option>\n' +
                '                                            <option value="1">AM</option>\n' +
                '                                            <option value="2">Fm</option>\n' +
                '                                        </select></td><td><input type="text"  id="fequencey_'+ a +'" ' +
                'class="form-control" placeholder="Fequencey"   name="fequencey[]"/></td><td><input type="text"  id="name_'+ a +'" class="form-control" placeholder="Name"\n' +
                '                                                 name="name[]"/><td><a ' +
                'href="javascript:void(0);"  id="deleteRow_' + a + '"  class="deleteRow btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td></tr>').appendTo(scntDivSubStation);
            a++;
            return false;
        });
    </script>

@endsection

