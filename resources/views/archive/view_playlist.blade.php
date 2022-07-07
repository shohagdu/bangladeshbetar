@extends("master_archive")
@section('show_message')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert"
             style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
@endsection
<style>
    .text-bold {
        font-weight: bold;
        text-align: center;
    }
</style>
@section('main_content_area')
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2 class="no-print">প্লে লিস্ট রিপোর্ট</h2>
                <button class="btn btn-primary btn-xs no-print" onclick="window.print()"  style="float:right;
                margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-print"></i>
                    Print
                </button>
            </header>
            <div>

                <div class="widget-body no-padding">
                    <table class="print_table-no-border " id="table-style" style="width:100%;border: 1px
                    solid #fff
                    !important;">
                        <tr>
                            <td  style="text-align: center;width:40%;border: 1px solid #fff !important; " >
                                <img src = "{{ url('images/logo/logo.jpg') }}" style="height:50px; margin:0px;
                                    padding:0px;"/>
                                <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</div>
                                <div style="font-size:14px;">{{ $playlist->station_name }}</div>
                                <div style="font-size:14px;">{{ $playlist->address }}</div>
                                <div style="font-size:14px;">{{ $playlist->sub_station_name. '('.$playlist->fequencey.')' }}</div>
                                <div class="clearfix"></div>
                                <div class="clearfix"></div>
                                <p><b> অনুষ্ঠানের নাম: </b> {{ $playlist->program_name }} </p>
                                <p style="padding-left:10px;line-height: 10px;"><b>অনুষ্ঠানের বিষয়:</b> {{ $playlist->program_subject }}</p>
                                <span style="padding-left:10px;line-height: 10px;"><b>প্রচার তারিখ:</b> {{ $playlist->boardcast_date }}</span>
                                <span style="padding-left:10px;line-height: 10px;"><b>প্রচার সময়:</b> {{ $playlist->boardcast_time }}</span>
                            </td>
                        </tr>

                        <tr>
                            <td style="width:100%;border: 1px solid #fff !important;">
                                <table class="table table-bordered" style="width: 100%">
                                    <tr style="background:gray;color:white;">
                                        <td style="width:5%" class="text-bold">নং</td>
                                        <td class="text-bold">অনুষ্ঠানের বিষয়বস্তু</td>
                                    </tr>
                                    <?php

                                    $i = 1;
                                    foreach($item_info as $row) {
                                    $details = $row['details'];
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <?php
                                        if($details->archive_type ==1) {
                                        $songit_info = json_decode($details->songit_info);
//                                        dd($songit_info);
                                        ?>
                                            <td>
                                                <p>

                                                    <b>গানের প্রকারঃ</b>
                                                    {{
                                                        !empty($songit_info->category)?get_name_by_id('archive_category',['id'=>$songit_info->category])->name:''
                                                    }}
                                                    ;
                                                    <b>শিল্পীঃ</b> {{ !empty($songit_info->artist)?get_shilpi_name_by_ids($songit_info->artist):'' }} ;
                                                    <b>গীতিকার:</b> {{ !empty($songit_info->gitikar)  ? get_shilpi_name_by_ids($songit_info->gitikar) : ''  }} ;
                                                    <b>সুরকার:</b> {{ !empty($songit_info->surokar)  ? get_shilpi_name_by_ids($songit_info->surokar) : ''  }} ;
                                                    <?php
                                                    if($songit_info->song_department==2) {
                                                        $film_info = $songit_info->film_info;
                                                    ?>
                                                    <b>ছায়াছবির নাম:</b> {{ !empty($film_info) ? $film_info->film_name : ''  }};
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    if($songit_info->song_department==3) {
                                                    ?>
                                                    <b>ব্যন্ডের নাম:</b> {{ !empty($songit_info->band_id)?get_name_by_id('archive_band',['id'=>$songit_info->band_id])->name:'' }};
                                                    <?php
                                                    }
                                                    ?>
                                                    <b>স্থিতি:</b> {{$songit_info->stability}}
                                                    ;
                                                    <b>আইডি:</b>   {{ $songit_info->id }} ;
                                                    <b>প্রথম লাইনঃ</b> {{ $songit_info->first_line }} ;
                                                </p>
                                            </td>
                                        <?php
                                        }
                                        elseif($details->archive_type ==2) {
                                        $item_info = json_decode($details->kobita_info);
                                        ?>
                                        <td>
                                            <p>

                                                <b>প্রথম লাইনঃ</b> {{ $item_info->first_line }} ;
                                                <b>রচয়িতাঃ</b> {{!empty($item_info->rochoyita)?get_shilpi_name_by_ids($item_info->rochoyita):''}};
                                                <b>আবৃতিকার:</b> {{ !empty($item_info->abritikar)  ? get_shilpi_name_by_ids($item_info->abritikar) : ''  }};
                                                <b>রচয়িতা:</b> {{ !empty($item_info->rochoyita)  ? get_shilpi_name_by_ids($item_info->rochoyita) : ''  }};
                                                <b>স্থিতি:</b> {{$item_info->stability}};
                                                <b>আইডি:</b>   {{ $item_info->id }} ;
                                            </p>
                                        </td>
                                        <?php
                                        }
                                        elseif($details->archive_type ==3) {
                                        $item_info = json_decode($details->natok_info);
                                        ?>
                                        <td>
                                            <p>

                                                <b>নাটকের নামঃ</b> {{$item_info->name}};
                                                <b>নাটকের প্রকারঃ </b>{{ !empty($item_info->category)?get_name_by_id('archive_category',['id'=>$item_info->category])->name:'' }};
                                                <b>নাট্যশিল্পী:</b> {{ !empty($item_info->actors)  ? get_shilpi_name_by_ids($item_info->actors) : ''  }};
                                                <b>নাট্যকার:</b> {{ !empty($item_info->nattokar)  ? get_shilpi_name_by_ids($item_info->nattokar) : ''  }};
                                                <b>নাট্যরুপকার:</b> {{ !empty($item_info->rupokar)  ? get_shilpi_name_by_ids($item_info->rupokar) : ''  }};
                                                <b>নাট্য প্রযোজক:</b> {{ !empty($item_info->natok_producer)  ? get_shilpi_name_by_ids($item_info->natok_producer) : ''  }};
                                                <b>স্থিতি:</b> {{$item_info->stability}};
                                                <b>আইডি:</b>   {{ $item_info->id }} ;
                                            </p>
                                        </td>
                                        <?php
                                        }
                                        elseif($details->archive_type ==4) {
                                        $item_info = json_decode($details->program_info);
                                        ?>
                                        <td>
                                            <p>

                                                <b>অনুষ্ঠানের নামঃ</b>  {{$item_info->name}};
                                                <b>অনুষ্ঠানের প্রকারঃ</b>  {{!empty($item_info->category) ? get_name_by_id('archive_category',['id'=>$item_info->category])->name:''}};
                                                <b>গবেষণা:</b>{{ !empty($item_info->gobeshona)  ? get_shilpi_name_by_ids($item_info->gobeshona) : ''  }};
                                                <b>গ্রন্থনা:</b>{{ !empty($item_info->gronthona)  ? get_shilpi_name_by_ids($item_info->gronthona) : ''  }};
                                                <b>উপস্থাপনা:</b>{{ !empty($item_info->uposthapona)  ? get_shilpi_name_by_ids($item_info->uposthapona) : ''  }};
                                                <b>স্থিতি:</b> {{$item_info->stability}};
                                                <b>আইডি:</b>   {{ !empty($item_info->id) ? $item_info->id : $item_info->program_id }} ;
                                            </p>
                                        </td>
                                        <?php
                                        }
                                        elseif($details->archive_type ==5) {
                                        $item_info = json_decode($details->vhason_info);
//                                        dd($item_info);
                                        ?>
                                        <td>
                                            <p>

                                                <b>প্রথম লাইন:</b>   {{ $item_info->first_line }} ;
                                                <b>ভাষণের প্রকারঃ </b> <?php echo !empty($item_info->category) ? get_name_by_id('archive_category',['id'=>$item_info->category])->name:''; ?>;
                                                <b>প্রদানকারীর নাম:</b> {{$item_info->vhason_kari}};
                                                <b>প্রদানের তারিখ:</b> {{$item_info->prodaner_tarikh}};
                                                <b>কর্মক্ষেত্র:</b> {{$item_info->work_area}};
                                                <b>স্থিতি:</b> {{$item_info->stability}};
                                                <b>আইডি:</b>   {{ $item_info->id }} ;
                                            </p>
                                        </td>
                                        <?php }
                                        elseif($details->archive_type ==6) {
                                        $item_info = json_decode($details->sakhhatkar_info);
                                        ?>
                                        <td>
                                            <p>

                                                <b>সাক্ষাৎ দাতাঃ</b> <?php echo $item_info->sakhhat_data; ?>;
                                                <b>প্রকারঃ </b><?php echo !empty($item_info->category) ? get_name_by_id('archive_category',['id'=>$item_info->category])->name:''; ?>;
                                                <?php if(!empty($item_info->sakhhatkar_department)) {  ?>
                                                <b>সাক্ষাতকার বিভাগ:</b>{{ get_sakhhatkar_department_name( $item_info->sakhhatkar_department) }};
                                                <?php } ?>
                                                <b>স্থিতি:</b>{{$item_info->stability}};
                                                <b>আইডি:</b>   {{ $item_info->id }} ;
                                            </p>
                                        </td>
                                        <?php }
                                        elseif($details->archive_type==7) {
                                        $kothika_info = json_decode($details->kothika_info);
                                        ?>
                                        <td>
                                            <p>

                                              <b>কথিকার নামঃ</b>{{$kothika_info->name}};
                                              <b>কথিকার বিষয়ঃ</b>{{$kothika_info->subject}};
                                              <b>গ্রন্থনা:</b>{{ !empty($kothika_info->gronthona)  ? get_shilpi_name_by_ids($kothika_info->gronthona) : 'N/A'  }};
                                               <b>উপস্থাপনা:</b>{{ !empty($kothika_info->uposthapona)  ? get_shilpi_name_by_ids($kothika_info->uposthapona) : 'N/A'  }};
                                                <b>স্থিতি:</b>{{$kothika_info->stability}};
                                                <b>আইডি:</b>   {{ $kothika_info->id }} ;
                                            </p>
                                        </td>
                                        <?php
                                        }
                                        elseif($details->archive_type==8) {
                                        $item_info = json_decode($details->procharona_info);
                                        ?>
                                        <td>
                                            <p>

                                                <b>প্রথম লাইনঃ</b> <?php echo $item_info->first_line; ?>;
                                                <b>প্রচারণার বিষয়ঃ</b> <?php echo $item_info->subject; ?>;
                                                <b>আঙ্গিক:</b>  {{ !empty($item_info->angik)?get_name_by_id('archive_category',['id'=>$item_info->angik])->name:'' }};
                                                <b>স্থিতি:</b> <?php echo $item_info->stability; ?>;
                                                <b>আইডি:</b> <?php echo $item_info->id?>;
                                            </p>
                                        </td>
                                        <?php
                                        }
                                        else {
                                        ?>
                                        <td colspan="2">

                                        </td>
                                        <?php
                                        }
                                        ?>
                                    </tr>

                                    <?php  } ?>

                                </table>
                                <table class="print_table-no-border" style="width: 100%;margin-bottom:
                                            20px;margin-top: 80px;margin-bottom: 80px;border: 1px solid #fff
                                            !important;" rules="all">
                                    <tr>
                                        <td style="width:20%;padding-left:30px;text-align: left;font-size:11px;" class="no-border"><span
                                                    style="border-bottom:1px solid #333;"></span>
                                        <u>প্লেলিস্ট আইডি : </u>
                                            {{ $playlist->playlist_id  }}
                                        </td>
                                        <td style="width:25%;text-align: center;font-size:11px; " class="no-border"> <span>
                                                            <u>পরিকল্পনাকারী:</u>
                                                        {{  get_employee_name_by_ids([$playlist->planner_id]) }}
                                                        </span>
                                        </td>
                                        <td style="width:25%;text-align: left;font-size:11px;" class="no-border"><span
                                                    style="border-bottom:1px solid #333;">সহকারী
                                                            পরিচালক : </span></td>
                                        <td style="width:25%;text-align: left;font-size:11px;" class="no-border"><span
                                                    style="border-bottom:1px solid #333;
">উপ-পরিচালক: </span></td>

                                    </tr>

                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </article>
@endsection

