@extends("master_program")
@section('title_area')
    :: Add ::  Presentation  ::

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
                <h2>উপস্থাপনা সেটিংস তথ্য সমুহ</h2>
                <a href="<?php  echo asset('/add_presentation_setting');?>"
                   class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    Add New
                </a>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th style="width:5%;">SL</th>
                                <th> কেন্দ্রের / ইউনিট নাম</th>
                                <th> ফ্রিকোয়েন্সি</th>
                                <th>এন্ট্রি সময়</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            ?>
                            @if(!empty($presentation_setting_info))

                                @foreach($presentation_setting_info as $singleData)
                                    <tr>
                                        <td>  {{ $i++  }}</td>
                                        <td>  {{ $singleData->station_name}}</td>
                                        <td>  {{ $singleData->fequencey_data}}</td>
                                        <td>  {{ date('d-m-Y',strtotime($singleData->created_time)) }} </td>
                                        <td>
{{--                                            <a href="{{ url('update_program_presentation/'.$singleData->id) }}"--}}
{{--                                               class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-pencil"></i>--}}
{{--                                            </a>--}}

                                            <a href="{{ url('presentation_setting_info_report/'.$singleData->id) }}"
                                               class="btn btn-success btn-xs"><i class="glyphicon
                                               glyphicon-share-alt"></i> View
                                            </a>
                                            <button onclick="deletePresentationSetting('{{ $singleData->id }}')"
                                               class="btn btn-danger btn-xs"><i class="glyphicon
                                               glyphicon-trash"></i> Delete
                                            </button>


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
@endsection

