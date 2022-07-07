@extends("master_program")
@section('main_content_area')
    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->

        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">

            <header>
                <button onclick="print_fun()"
                        class="btn btn-warning btn-xs no-print" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-print"></i>
                    Print
                </button>
            </header>

            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12" >
                        <div class="col-sm-12" style="height: 10px;"></div>
                        <table class="print_table-no-border " style="width:100%;border: 1px solid #fff !important;">
                            <tr>
                                <td    style="text-align: center;width:40%;border: 1px solid #fff!important" >
                                    <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  </div>

                                    <div style="font-size:14px;">  {{ !empty($program_plan->station_name)?$program_plan->station_name:'' }}</div>
                                    <div style="font-size:14px;">{{ !empty($program_plan->station_address)?$program_plan->station_address:''
                                    }}</div>
                                    <div style="font-size:14px;">{{ !empty($program_plan->fequencey_data)?$program_plan->fequencey_data:'' }}</div>

                                    <div class="clearfix"></div>
                                    <span style="font-weight: bold;font-size:14px;"> অনুষ্ঠানের বিবরণ </span>
                                    <div class="clearfix"></div>
                                </td>
                            </tr>
                        </table>

                        <table style="width:100%;border:1px solid #d0d0d0" rules="all"  class="table table-bordered"
                               id="print_table">
                            <tr>
                                <td class="text-bold">অনুষ্ঠানের আইডি</td>
                                <td>
                                    {{ !empty($program_plan->program_identity)?$program_plan->program_identity:''  }}
                                </td>
                                <td colspan="2" style="font-size:15px !important;font-weight: bold;"
                                    class="text-bold">
                                    {{ ($program_plan->record_type==1)?"সজীব":(($program_plan->record_type==2)
                                ?"বাণীবদ্ধ":(($program_plan->record_type==3)?"এককালীন":'')
                                )  }}
                                </td>
                            </tr>
                            <!--<tr>
                                <th class="text-bold">কেন্দ্র</th>
                                <td>
{{--                                    {{ !empty($program_plan->station_name)?$program_plan->station_name:'' }}--}}
                                </td>
                                <th class="text-bold">ফ্রিকোয়েন্সি</th>
                                <td >
{{--                                    {{ !empty($program_plan->fequencey_data)?$program_plan->fequencey_data:'' }}--}}
                                </td>

                            </tr>-->
                            <tr>
                                <td class="text-bold">নিদিষ্ট অনুষ্ঠান সূচি</td>
                                <td >
                                    <?php
                                    $torimasik_porikolpona_info=torimasik_porikolpona_info();
                                    $fixed_onusan_suchy_info=fixed_onusan_suchy_info();
                                    if(!empty($program_plan->fixed_onusan_suchy)){
                                        echo  $fixed_onusan_suchy_info[$program_plan->fixed_onusan_suchy];
                                    }
                                    ?>
                                </td>
                                <td class="text-bold">ত্রৈমাসিক পরিকল্পনা </td>
                                <td >{{ !empty($program_plan->torimasik_porikolpona)
                                ?$torimasik_porikolpona_info[$program_plan->torimasik_porikolpona]:''}} {{ !empty
                                ($program_plan->bangla_son)?
                                '('.$program_plan->bangla_son.")":''}}  </td>

                            </tr>
                            @if($program_plan->sub_fixed_program_type_id>0)
                                <tr>
                                    <td class="text-bold">বার্ষিকী অনুষ্ঠানের ধরন  </td>
                                    <td colspan="3">
                                        {{ !empty($program_plan->fixed_program_name)
                                        ?$program_plan->fixed_program_name:'' }}: {{ !empty($program_plan->fixed_sub_program_title)?$program_plan->fixed_sub_program_title:'' }}
                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <td class="text-bold ">অনুষ্ঠানের নাম</td>
                                <td colspan="3" style="font-size:15px !important;font-weight: bold;" class="text-bold width30per">

                                    {{$program_plan->program_name }}
                                </td>

                            </tr>
                            <tr>
                                <td class="text-bold">বিষয়/উদ্দেশ্য</td>
                                <td colspan="3">{{$program_plan->larget_viewer}} </td>
                            </tr>

                            <tr>
                                <td class="text-bold width20per">অনুষ্ঠানের ধরন</td>
                                <td class="width30per" >
                                    {{ !empty($program_plan->program_type_title)?$program_plan->program_type_title:'' }}
                                </td>
                                <td class="text-bold width20per">অনুষ্ঠানের  স্থিতি  </td>
                                <td class="width30per">
                                    {{ !empty($program_plan->dolar_name)?$program_plan->recording_stabilty:'' }}
                                </td>
                            </tr>


                        <!-- <tr>
                                <th class="text-bold">রেকর্ডিং তারিখ</th>
                                <td>
                                    <?php
                            //                                    if (!empty($program_plan->recorded_date)) {
                            //                                        $recorded_dt = !empty($program_plan->recorded_date) ? json_decode
                            //                                        ($program_plan->recorded_date, true) : '';
                            //                                        echo implode(",", $recorded_dt);
                            //                                    }
                            ?>

                                </td>

                                <th class="text-bold">রেকর্ডিং সময়</th>

                                <td>
{{--                                    {{ $program_plan->recorded_time }}--}}
                                </td>
                            </tr>-->

                            <tr>
                                <td class="text-bold">প্রচার তারিখ</td>

                                <td>

                                    <?php

                                    if (!empty($program_plan->live_date)) {
                                        $live_dt = !empty($program_plan->live_date) ? json_decode
                                        ($program_plan->live_date, true) : '';
                                        //print_r($live_dt);
                                        if(!empty($live_dt)){
                                            $livDT='';
                                            $mnth='';
                                            $yer='';
                                            foreach ($live_dt as $key=> $liveDate){
                                                $mnth= date('m',strtotime($live_dt[0]));
                                                $yer= date('Y',strtotime($live_dt[0]));
                                                $livDT.=date('d',strtotime($liveDate)).", ";
                                            }
                                            echo eng2bnNumber(rtrim($livDT,', ')." / ".$mnth." / ".$yer);
                                        }
                                        //echo implode(", ", eng2bnNumber($live_dt));
                                    }
                                    ?>
                                </td>

                                <td class="text-bold">প্রচার সময়</td>

                                <td>
                                    {{ (!empty($program_plan->live_time))? eng2bnNumber($program_plan->live_time):'' }}
                                </td>
                            </tr>
                            @if($program_plan->dologot_poribashona>0)
                                <tr>
                                    <td class="text-bold">দলের নাম (উৎসব ও বার্ষিকী) </td>
                                    <td>
                                        {{ !empty($program_plan->dolar_name)?$program_plan->dolar_name:'' }}
                                    </td>

                                    <td class="text-bold">দলের তথ্য</td>
                                    <td>
                                        {{ !empty($program_plan->dolar_info)?$program_plan->dolar_info:'' }}
                                    </td>
                                </tr>
                            @endif








                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <table style="width:100%;border:1px solid #d0d0d0" rules="all" class="table table-bordered " id="table-style">
                            <tr>
                                <td style="text-align: center;font-size:12px !important;" colspan="14">অনুষ্ঠানে
                                    অংশগ্রহনকারীর বিবরন
                                    (শিল্পী সম্মানী চার্ট অনুযায়ী)</td>
                            </tr>


                            <tr>
                                <td class="width10per">অনুষ্ঠানে ভূমিকা</td>
                                <td>শিল্পীর নাম</td>
                                <td>গ্রেড</td>
                                <td class="width6per text-right">সম্মানী</td>
                                <td>রেকর্ডি তাং</td>
                                <td>রেকর্ডি সময়</td>
                                <td>বুকিং সংখ্যা</td>
                                <td class="width15per">মহড়া তাং</td>
                                <td class="text-right width5per">মহড়া ফি</td>
                                <td class="text-right width4per">টিএ </td>
                                <td class="text-right width4per">ডিএ </td>
                                <td class="width6per">খেতাব প্রাপ্ত</td>
                                <td class="width6per text-right">মোট সম্মানী</td>
                                @if($program_plan->is_active>=3)
                                    <td>#</td>
                                @endif
                            </tr>

                            <?php
                            $i = 1;
                            $total_amount = '0.00';
                            //                            echo "<pre>";
                            //                            print_r($get_program_planning_info_artist);
                            //                                exit;
                            if(!empty($get_program_planning_info_artist)) {
                            foreach ($get_program_planning_info_artist as $key=> $description) {
                            ?>
                            <tr>
                                <td>
                                    {{ $description->artist_vumika_title }}
                                </td>
                                <td>
                                    {{ $description->artist_name }}
                                </td>

                                <td>{{ $description->grade_title }}</td>


                                <td class="text-right">
                                    {{ (!empty($description->artist_grade_amount)?eng2bnNumber(number_format
                                    ($description->artist_grade_amount,2,'.','')):'০.০০') }}
                                </td>
                                <td>
                                    <?php

                                    if (!empty($description->live_date_log) && $program_plan->record_type==1 ) {
                                        $live_date_log = !empty($description->live_date_log) ? json_decode
                                        ($description->live_date_log, true) : '';
                                        $live_date=(!empty($live_date_log))? array_column($live_date_log,'date'):'';
                                    //    echo (!empty($live_date))? implode(",", $live_date):'';
                                    }elseif (!empty($description->record_date_log) && $program_plan->record_type==2 ) {
                                        $record_date_log = !empty($description->record_date_log) ? json_decode
                                        ($description->record_date_log, true) : '';


                                        $record_date=(!empty($record_date_log))? array_column($record_date_log,'date'):'';
                                        //                                        echo "<pre>";
//                                       // print_r($record_date_log);
//
//                                        $record_date=(!empty($record_date_log))? array_column($record_date_log,'date'):'';
//                                        dd($record_date);
//
//                                        foreach ($record_date as $ft_data){
////                                            $year_index[date('d',strtotime($ft_data))][[date('m',strtotime($ft_data))
////                                            ]][date('Y',strtotime($ft_data))]=$ft_data;
//                                            print_r($ft_data);
//                                            $year[date('Y',strtotime($ft_data))][date('m',strtotime($ft_data))]=$ft_data;
//                                         //   $year[date('m',strtotime($ft_data))]=$ft_data;
//                                        }
//                                        foreach ($year as $year_key=> $year_data){
//                                            foreach ($record_date as $my_data){
//                                                if(date('Y-m',strtotime($my_data)==$year_key.'-')
//                                            }
//
//                                        }
//                                        print_r($year);
                                        echo (!empty($record_date))? implode(",", $record_date):'';
                                    }

                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (!empty($description->live_date_log) && $program_plan->record_type==1 ) {
                                        $live_date_log = !empty($description->live_date_log) ? json_decode
                                        ($description->live_date_log, true) : '';
                                        $live_time=(!empty($live_date_log))? array_column($live_date_log,'time'):'';
                                        $result = (!empty($live_time))?array_unique($live_time):'';
                                     //   echo (!empty($result))? implode(",", $result):'';
                                    }elseif (!empty($description->record_date_log) && $program_plan->record_type==2 ) {
                                        $record_date_log = !empty($description->record_date_log) ? json_decode
                                        ($description->record_date_log, true) : '';
                                        $record_time=(!empty($record_date_log))? array_column($record_date_log,'time'):'';
                                        $result = (!empty($record_time))?array_unique($record_time):'';
                                        echo (!empty($result))? implode(",", $result):'';
                                    }

                                    ?>
                                </td>

                                <td class="text-center">
                                    {{ !empty($description->number_of_days)?eng2bnNumber
                                    ($description->number_of_days):'' }}
                                </td>
                                <td>
                                    <?php
                                    if (!empty($description->mohoda_date_add)) {
                                        $mohoda_dt = !empty($description->mohoda_date_add) ? json_decode
                                        ($description->mohoda_date_add, true) : '';
                                        $mohoda_data_info='';
                                        foreach ($mohoda_dt as $mdt){
                                          $m_date= date('d/m',strtotime($mdt)).", ";
                                          $mohoda_data_info.=eng2bnNumber($m_date);
                                        }
                                      echo rtrim($mohoda_data_info,', ');
                                    }
                                    ?>
                                </td>
                                <td class="text-right">
                                    {{ (!empty($description->mohoda_amount))? eng2bnNumber(number_format
                                   ($description->mohoda_amount,2,'.','')):'০.০০' }}
                                </td>
                                <td class="text-right">
                                    {{ (!empty($description->artist_ta_amount))?eng2bnNumber(number_format
                                   ($description->artist_ta_amount,2,'.','')):'০.০০' }}
                                </td>


                                <td class="text-right">
                                    {{ (!empty($description->artist_da_amount))?eng2bnNumber(number_format
                                    ($description->artist_da_amount,2,'.','')):'০.০০' }}
                                </td>
                                <td class="text-center">
                                    @if($description->khetab_prapto)
                                        {{ ($description->khetab_prapto==1)?"হ্যাঁ":"না"}}
                                    @endif
                                </td>
                                <td class="text-right">
                                    {{ eng2bnNumber($description->total_amount) }}
                                    @php
                                        $total_amount+=$description->total_amount;
                                    @endphp
                                </td>
                                @if($program_plan->is_active>=3)
                                    <td>
{{--                                        <a href="{{ url('payment/pdf/vouchar.php?pslip='--}}
{{--                                                    .sha1($description->id))  }}" target="_blank">ভাউচার </a>/--}}
                                        <a href="{{ url('payment/pdf/contact_paper.php?pslip='
                                                    .sha1($description->id))  }}" target="_blank">চুক্তি পত্র </a>
                                    </td>
                                @endif
                            </tr>
                            <?php } } ?>
                            <tr>
                                <th colspan="12" class="text-right" >মোট ব্যয়</th>
                                <td colspan=" {{ 1 }} +  {{($program_plan->is_active<=3)?1:0 }}" class="text-right">{{
                              (!empty($total_amount))?  eng2bnNumber(number_format($total_amount,
                                    2,'.','')):'০.০০' }}</td>
                            </tr>


                        </table>
                        <table class="table table-bordered" id="table-style">
                            <tr>
                                <th class="text-bold width10per text-center" style="font-size:12px !important;">অনুষ্ঠানের বিষয়বস্তু</th>
                            </tr>
                            <tr>
                                <td >{{ !empty($program_plan->onusthan_bisoy_bostu)
                                    ?$program_plan->onusthan_bisoy_bostu:'.'}} </td>
                            </tr>

                        </table>

                        <table class="table table-bordered" id="table-style" rules="all" border="1px" >
                            <?php
                            $manager_info=prgram_manage();
                            if(!empty($organizer_info)){
                            foreach ($organizer_info as $key=>$organizer_data){
                            $child_key_index=1;
                            if($key==2 || $key==3 ){

                            }else{
                            ?>
                            <tr>
                                <td style="width:20%;">{{ $manager_info[$key] }}</td>
                                <td>
                                    <?php
                                    if(!empty($organizer_data)){
                                        echo  implode(",",$organizer_data);
                                    }

                                    ?>
                                </td>
                            </tr>

                            <?php
                            $child_key_index++;
                            }
                            }

                            }
                            ?>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </article>
    <style>
        #print_table{
            width:100%;
        }
        #print_table td{
            /*font-family: Arial, Verdana, sans-serif;*/
            border:1px solid #d0d0d0;
            font-size:11px !important;
            padding-left:5px !important;
            padding-top:2px !important;
            padding-bottom:2px !important;

        }
        #print_table th{
            /*font-family: Arial, Verdana, sans-serif;*/
            border:1px solid #d0d0d0;
            font-size:11px !important;
            padding-left:2px !important;
            padding-top:2px !important;
            padding-bottom:2px !important;
            font-weight: bold;
        }
    </style>
@endsection

