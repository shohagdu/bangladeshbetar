@extends("master_program")
@section('main_content_area')
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon no-print"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2 class="no-print">শিল্পীর তথ্য</h2>
                <a href="{{ url('artist_record') }}"
                   class="btn btn-primary btn-xs no-print" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    List
                </a>
                <button onclick="print_fun()"
                   class="btn btn-warning btn-xs no-print" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-print"></i>
                    Print
                </button>

            </header>
            <div>

                <div class="widget-body no-padding">
                    <div class="col-sm-12" >
                        <table class="print_table-no-border "  id="table-style" style="width:100%;border: 1px solid #fff
                    !important;">
                            <tr>
                                <td  style="text-align: center;width:40%;border: 1px solid #fff !important;
                                padding-bottom:20px !important;" >
                                    <img src = "{{ url('images/logo/logo.jpg') }}" style="height:50px; margin:0px;
                                    padding:0px;"/>
                                    <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  </div>
                                    <div style="font-size:15px;font-weight: bold;"> বাংলাদেশ বেতার  </div>
                                    <b><u>শিল্পীর তথ্য  </u></b>
                                </td>
                            </tr>
                        </table>
                        <table  id="table-style" style="width: 100%;">
                            <tr>
                                <td class="width20per "> স্ট্যাটাস</td>
                                <td class="{{ (!empty($artist_info_show->is_active) &&
                                        $artist_info_show->is_active==2) ?
                           "Inactive":'Active' }} width30per">{{ (!empty($artist_info_show->is_active) &&
                                        $artist_info_show->is_active==2) ?
                           "Inactive":'Active' }} </td>
                                <td class="width20per text-center" rowspan="4">
                                    <span >
                                        <img src="{{ (file_exists("fontView/assets/artist_image/"
                                            .$artist_info_show->picture))? (!empty
                                            ($artist_info_show->picture)?url
                                            ("fontView/assets/artist_image/"
                                            .$artist_info_show->picture):url
                                            ("images\default\default-avatar.png")):url
                                            ("images\default\default-avatar.png")  }}" style="height:115px; width:115px;">
                                            <div class="clearfix"></div>
                                            <div style="padding:5px;background: #d0d0d0;" >শিল্পীর ছবি</div>
                                    </span>
                                </td>
                                <td class="width20per text-center" rowspan="4">
                                    <span >
                                    <img src="{{ (file_exists("fontView/assets/artist_signature/"
                                        .$artist_info_show->artist_signature))? (!empty
                                        ($artist_info_show->artist_signature)?url
                                        ("fontView/assets/artist_signature/"
                                        .$artist_info_show->artist_signature):url
                                        ("images\default\default-avatar.png")):url
                                        ("images\default\default-avatar.png")  }}" style="height:115px; width:115px;
                                        ">
                                        <div class="clearfix"></div>
                                        <div style="padding:5px;background: #d0d0d0;" >স্বাক্ষর</div>
                                    </span>

                                </td>
                            </tr>
                            <tr>
                                <td class="width20per "> শিল্পীর দপ্তর</td>
                                <td class=" width30per">{{ (!empty($artist_info_show->artist_doptor) &&
                                            $artist_info_show->artist_doptor==1) ?
                               "অনুষ্ঠান":( ($artist_info_show->artist_doptor==2)?"বার্তা":"") }} </td>

                            </tr>
                            <tr>
                                <td class="width20per ">শিল্পীর ধরন</td>
                                <td class="width30per">
                                    @php
                                        $artist_type=artist_type();
                                        if(!empty($artist_type)){
                                            if(!empty($artist_info_show->artist_type)){
                                                echo ($artist_type[$artist_info_show->artist_type]);
                                            }
                                        }
                                    @endphp

                                    {{(!empty($artist_info_show->artist_type) &&
                                            $artist_info_show->artist_type==1) ?((!empty($artist_info_show->staff_id))?
                                    "-(".$artist_info_show->staff_id.")":''):'' }}
                                </td>
                            </tr>
                            <tr>
                                <td class=""> তালিকাভুক্ত কেন্দ্রে নাম</td>
                                <td>
                                    @if(!empty($artist_info_show->station_name ))
                                        {{ $artist_info_show->station_name }}
                                    @endif </td>

                            </tr>
                            <tr>
                                <td class=""> সর্বশেষ গ্রেড তালিকাভুক্তির তারিখ</td>
                                <td>{{ (empty($artist_info_show->enlisted_last_date) ||
                                $artist_info_show->enlisted_last_date=='0000-00-00' ||
                                $artist_info_show->enlisted_last_date=='1970-01-01') ?'':date('d-m-Y',strtotime
                                ($artist_info_show->enlisted_last_date)) }} </td>
                                <td class=" width20per">তালিকাভুক্তির তারিখ</td>
                                <td class="width30per">
                                    {{ (empty($artist_info_show->enlisted_date) ||
                                $artist_info_show->enlisted_date=='0000-00-00' ||
                                $artist_info_show->enlisted_date=='1970-01-01') ?'':date('d-m-Y',strtotime
                                ($artist_info_show->enlisted_date)) }}
                                </td>
                            </tr>

                            <tr>
                                <td class=""> শিল্পীর নাম (বাংলায়)</td>
                                <td> {{ !empty($artist_info_show->name_bn)?
                                $artist_info_show->name_bn:'' }}</td>
                                <td class="">শিল্পীর সংক্ষিপ্ত নাম</td>
                                <td>{{ $artist_info_show->artist_short_name }} </td>
                            </tr>

                            <tr>
                                <td class=""> শিল্পীর নাম (ইংরেজী)</td>
                                <td> {{ !empty($artist_info_show->name)?
                                $artist_info_show->name:'' }}</td>
                                <td class="">জাতীয় পুরষ্কার প্রাপ্ত</td>
                                <td>
                                    {{ !empty($artist_info_show->national_awarded_title) ?
                                    ($artist_info_show->national_awarded_title):'' }}

                                </td>
                            </tr>


                            <tr>
                                <td class=""> পিতার নাম</td>
                                <td>{{ !empty($artist_info_show->father_name)?
                                $artist_info_show->father_name:'' }} </td>
                                <td class="">পেশা</td>
                                <td> {{ !empty( $artist_info_show->artist_occupation)
                                          ?trim($artist_info_show->artist_occupation):'' }}</td>
                            </tr>
                            <tr>
                                <td class=""> মাতার নাম</td>
                                <td>{{ !empty( $artist_info_show->
                                mother_name)? $artist_info_show->
                                mother_name:'' }} </td>
                                <td class="">জাতীয়তা</td>
                                <td>
                                    {{ !empty($artist_info_show->nationality_title) &&
                                    ($artist_info_show->nationality_title ==!'') ?
                                    $artist_info_show->nationality_title: '' }}
                                </td>
                            </tr>

                            <tr>
                                <td class=""> {{ !empty($artist_info_show->is_husband_wife) &&
                                            ($artist_info_show->is_husband_wife == 1) ?
                                            'স্বামীর': (($artist_info_show->is_husband_wife == 2) ?
                                            'স্ত্রীর':'') }} নাম
                                </td>
                                <td>{{ !empty($artist_info_show->husband_wife_name)?
                                $artist_info_show->husband_wife_name:'' }} </td>
                                <td class="">জেলা</td>
                                <td>
                                    {{ !empty($artist_info_show->district_title) &&
                                   ($artist_info_show->district_title ==!'') ?
                                   $artist_info_show->district_title: '' }}
                                </td>
                            </tr>
                            <tr>
                                <td class=""> বৈবাহিক অবস্থা</td>
                                <td> {{ !empty($artist_info_show->marital_status) &&
                                            ($artist_info_show->marital_status == 1) ?
                                            'বিবাহিত': (!empty($artist_info_show->marital_status) &&
                                            ($artist_info_show->marital_status == 2) ?
                                            'অবিবাহিত':'') }}</td>
                                <td class="">লিঙ্গ</td>
                                <td> {{ !empty($artist_info_show->gender) &&
                                            ($artist_info_show->gender == 1) ?
                                            'পুরুষ': (!empty($artist_info_show->gender) &&
                                            ($artist_info_show->gender == 2) ?
                                            'মহিলা': (!empty($artist_info_show->gender) &&
                                            ($artist_info_show->gender == 3) ?
                                            'অন্যান্য': '')) }} </td>
                            </tr>
                            <tr>
                                <td class=""> ঠিকানা</td>
                                <td> {{ !empty($artist_info_show->address)?
                                $artist_info_show->address:'' }}</td>
                                <td class="">শিক্ষাগত যোগ্যতা</td>
                                <td> {{ !empty($artist_info_show->educational_info)?$artist_info_show->educational_info:'' }}</td>
                            </tr>
                            <tr>
                                <td class=""> মোবাইল</td>
                                <td> <?php
                                    if(!empty($artist_info_show->mobile)){
                                    $deconde_mobile = json_decode($artist_info_show->mobile, true);
                                    foreach($deconde_mobile as $key =>$mobile){
                                    $indexed = 1 + $key;
                                    ?>
                                    <div id="mobile_no_log_info_{{ $indexed }}">
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <b>{{$indexed}}.</b> {{ $mobile }}
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $indexed++;
                                    }
                                    }
                                    ?></td>
                                <td class="">ই-মেইল</td>
                                <td>{{ !empty($artist_info_show->email)?
                                $artist_info_show->email:'' }} </td>
                            </tr>
                            <tr>
                                <td class="">ফেইসবুক আইডি(Facebook ID)</td>
                                <td colspan="3"> {{ !empty($artist_info_show->fb_id_link)?
                                $artist_info_show->fb_id_link:'' }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"> বেতারের দায়িত্বপ্রাপ্ত কর্মস্থল</td>
                                <td colspan="2"><?php
                                    $previous_station = !empty($artist_info_show->previous_station_id) ?
                                        json_decode($artist_info_show->previous_station_id, true) : '';
                                    $selected = '';
                                    ?>
                                    @if(!empty($station_info))
                                        @foreach($station_info as $key=>$value)
                                            <?php
                                            if (!empty($previous_station) && in_array($key, $previous_station)) {
                                                echo $value;
                                            }
                                            ?>
                                        @endforeach
                                    @endif
                                </td>

                            </tr>


                            <tr>
                                <td class=""> ব্যাংকের নাম</td>
                                <td>
                                    {{ (!empty($artist_info_show->bank_name_title) &&
                                      $artist_info_show->bank_name_title ==!'') ?
                         $artist_info_show->bank_name_title:'' }}

                                </td>
                                <td class="">ব্যাংকের শাখার নাম</td>
                                <td>{{ !empty($artist_info_show->bank_branch_name)?
                                $artist_info_show->bank_branch_name:'' }} </td>
                            </tr>
                            <tr>
                                <td class=""> ব্যাংক একাউন্ট নং</td>
                                <td>{{ !empty($artist_info_show->bank_account_no)?
                                $artist_info_show->bank_account_no:'' }} </td>
                                <td class=""></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class=""> শিল্পীর কর্মক্ষেত্র</td>
                                <td colspan="3">
                                    <?php
                                    if(!empty($artist_work_area_info[0]->work_area_id)){
                                        $re_from = array("[", "]",'"');
                                        $re_to = array("", "", "");
                                        $work_area_id_a= str_replace($re_from, $re_to,
                                            $artist_work_area_info[0]->work_area_id);
                                        $arr=explode(",",$work_area_id_a);
                                        if(!empty($arr)){
                                            $work_data_unique=[];
                                            foreach ($arr as $work_area_ar){
                                                if(!empty($work_area_info_data[$work_area_ar])){
                                                    $work_data_unique[]=$work_area_info_data[$work_area_ar];
                                                }
                                            }
                                            $unique_work_area=array_unique($work_data_unique);
                                            echo implode(", ",$unique_work_area);
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4">
                                    <table class="table-bordered table" style="width: 100%;">
                                        <tr>
                                            <td>এক কালিন টাকা পরিমান</td>
                                            <td>দৈনিক টাকা</td>
                                            <td>সবোর্চ্চ দিনের সংখ্যা</td>
                                        </tr>
                                        <tr>
                                            <td>{{ !empty($artist_info_show->fixed_amount)?
                                $artist_info_show->fixed_amount:'' }}</td>
                                            <td>{{ !empty($artist_info_show->per_day_amount)?
                                $artist_info_show->per_day_amount:'' }}</td>
                                            <td>{{ !empty($artist_info_show->total_days)?
                                $artist_info_show->total_days:'' }}</td>
                                        </tr>
                                    </table>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table class="table table-bordered" style="width: 100%;">
                                        <tr>
                                            <th class="width30per">শিল্পীর দক্ষতা</th>
                                            <th class="width30per">দক্ষতার বিভাগ</th>
                                            <th class="width30per">শ্রেণী</th>
                                        </tr>


                                        <?php
                                        if(!empty($artist_info_show->artist_expertise_info)){
                                        $deconde_expertise = json_decode($artist_info_show->artist_expertise_info, true);
                                        if(!empty($deconde_expertise)){
                                        foreach($deconde_expertise as $key_main =>$expertise){
                                        ?>
                                        <tr>
                                            <td>
                                                {{ (!empty ( $expertise['expertise']) &&  $expertise['expertise']==!'') ?
                               $expertise['expertise']:'' }}

                                            </td>
                                            <td>
                                                {{ (!empty  ( $expertise['expertise_dept']) &&    $expertise['expertise_dept']==!'') ?$expertise['expertise_dept']:'' }}

                                            </td>
                                            <td>
                                                {{ (!empty
                                                      ( $expertise['expertise_grade']) &&
                                                      $expertise['expertise_grade']==!'') ?
                                 $expertise['expertise_grade']:'' }}

                                                </select>
                                            </td>
                                        </tr>

                                        <?php
                                        }
                                        }
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                           <!-- <tr>
                                <td colspan="4">
                                    <table class="table table-bordered">

                                        <tr>
                                            <th class="width30per">শিল্পী সম্মানীর চার্ট এর ক্যাটাগরি</th>
                                            <th class="width30per">অনুষ্ঠানের বিবরণ</th>
                                            <th class="width20per">শ্রেণী</th>
                                        </tr>
                                        <?php

                                        if(!empty($artist_info_show->artist_rate_chart_info)){
                                        $deconde_rate_chart = json_decode($artist_info_show->artist_rate_chart_info, true);
                                        foreach($deconde_rate_chart as $key_main =>$rate_chart){
                                        ?>
                                        <tr>
                                            <td>   {{ (!empty
                                               ( $rate_chart['artist_hounoriam_ctg']) &&
                                               $rate_chart['artist_hounoriam_ctg']==!'') ? $rate_chart['artist_hounoriam_ctg']:'' }}

                                            </td>
                                            <td>


                                                {{ (!empty($rate_chart['chart_description']) &&
                                                $rate_chart['chart_description']==!'') ?$rate_chart['chart_description']:'' }}

                                            </td>
                                            <td>
                                                {{ (!empty    ( $rate_chart['artist_grade']) &&
                                                     $rate_chart['artist_grade']==!'') ? $rate_chart['artist_grade']:'' }}
                                            </td>
                                        </tr>

                                        <?php
                                        }
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>-->

                        </table>


                    </div>
                </div>
            </div>
    </article>


@endsection