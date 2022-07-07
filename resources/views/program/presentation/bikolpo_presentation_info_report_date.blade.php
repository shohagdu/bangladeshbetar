@extends("master_program")

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
                <h2 class="no-print">অধিবেশন কক্ষে প্রচার সংশ্লিষ্টদের তালিকা (বিকল্প)</h2>
                <button onclick="window.print()"
                        class="btn btn-success btn-xs no-print" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-print"></i>
                    Print
                </button>
                <button onclick="back()"
                        class="btn btn-danger btn-xs no-print" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-backward"></i>  Back
                </button>

            </header>
            <div>
                <?php
                $month_info= month_name_info();
                $day_name = show_day_info_bn();
                $odivision_data=odivision_info_data();
                ?>
                <div class="widget-body no-padding" >
                    <table class="print_table-no-border "  style="width:100%;border: 1px solid #fff !important;">
                        <tr>
                            <td  style="text-align: center;width:40%;border: 1px solid #fff !important; " >
                                <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  </div>

                                <div style="font-size:14px;">{{ $presentation_heading_info->name }}</div>
                                <div style="font-size:14px;">{{ $presentation_heading_info->address }}</div>
                                <div style="font-size:14px;">{{ $presentation_heading_info->fequencey_data }}</div>
                                <b><u>অধিবেশন কক্ষে প্রচার সংশ্লিষ্টদের তালিকা (বিকল্প)  </u></b>
                                <div class="clearfix"></div>
                                <span><b> মাস: </b> {{ (!empty($presentation_heading_info->months))?
                                $month_info[$presentation_heading_info->months]:'' }} </span>
                                <span style="padding-left:10px;"><b>সাল:</b> {{
                              (!empty($presentation_heading_info->presentation_year))?
                              eng2bnNumber($presentation_heading_info->presentation_year).' খ্রি.':'' }}</span>

                            </td>
                        </tr>

                        <tr>
                            <td>
                                <table class="table table-bordered print-style-table"  rules="all" >
                                    <?php
//                                        echo "<pre>";
//                                        print_r($presentation_info);
//                                        exit;
                                    foreach ($presentation_info as $date_key=> $info){
                                    ?>

                                    <tr>
                                        <td>{{ (!empty($date_key))?eng2bnNumber
                                        (date('d-m-Y',strtotime($date_key))):''  }}</td>
                                        <td style="text-align: center">{{ $day_name[date('D',strtotime
                                        ($date_key))]
                                        }}</td>

                                        <td>
                                            <table class="table table-bordered print-style-table presentation_table"
                                                   rules="all" id="table-style" style="border: 1px solid #fff" >
                                                <thead>
                                                <tr>
                                                    <td style="width: 120px;font-size:10px!important;"></td>
                                                    <td style="width: 120px;font-size:10px!important;">ডিউটি অফিসার</td>
                                                    <td style="width: 120px;font-size:10px!important;">ঘোষক/ উপস্থাপক</td>
                                                    <td style="width: 120px;font-size:10px!important;">লগ রাইটার</td>
                                                    <td style="width: 120px;font-size:10px!important;">অফিস সহায়ক</td>
                                                    <td style="width: 120px;font-size:10px!important;">
                                                        অফিসার-ইন-চার্জ
                                                    </td>
                                                </tr>
                                                </thead>
                                                <?php
                                                foreach ($info as $odivision_id=> $artist_data){
                                                 //   echo "<pre>";
                                                 //   print_r($artist_data);
                                                ?>
                                                <tr>
                                                    <td style="width:100px !important;">
                                                        {{ (!empty($odivision_id))?$odivision_data[$odivision_id]:'' }}
                                                    </td>
                                                    <?php
                                                        foreach ($role_title_array as $role_id=>
                                                        $role_info){
                                                            ?>
                                                    <td style="width: 140px;">
                                                    <?php
                                                            foreach($artist_data as $role_title_data=>$all_artist_data){
                                                                if($role_title_data==$role_info){
                                                    ?>

                                                        <?php
                                                        $artist_data_show='';
                                                          foreach ($all_artist_data as $artist_data_all){
                                                            $bikolpo_artist_info_data= (!empty
                                                            ($artist_data_all['bikolpo_artist_info']))?json_decode
                                                            ($artist_data_all['bikolpo_artist_info'],true):NULL;
                                                              if(!empty($bikolpo_artist_info_data['artist_id'])){
                                                                  $artist_data_show
                                                                      .=$atrist_info_info[$bikolpo_artist_info_data['artist_id']].' <span style="color:red"> ('.$artist_data_all['name_bn']."</span>) ,";

                                                              }

                                                        }
                                                          echo rtrim($artist_data_show,',');
                                                        ?>
                                                    </td>
                                                    <?php } } ?></td> <?php } ?>


                                                </tr>
                                                <?php } ?>
                                            </table>

                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>

                            </td>
                        </tr>
                    </table>
                    <table class="print_table-no-border" style="width: 100%;margin-bottom:
                                            20px;margin-top: 80px;margin-bottom: 80px;border: 1px solid #fff
                                            !important;" rules="all">
                        <tr>
                            <td style="width:25%;text-align: left;font-size:11px; " class="no-border"> <span
                                >
                                                            <u>পরিকল্পনাকারী:</u>
                                    {{
                                                 !empty($presentation_info[0]->presentation_created_by)?
                                                 $employee_info[$presentation_info[0]->presentation_created_by]:''
                                                    }}
                                                        </span>
                            </td>
                            <td style="width:25%;text-align: left;font-size:11px;" class="no-border"><span
                                        style="border-bottom:1px solid #333;">সহকারী
                                                            পরিচালক : </span></td>
                            <td style="width:25%;text-align: left;font-size:11px;" class="no-border"><span
                                        style="border-bottom:1px solid #333;
">উপ-পরিচালক: </span></td>
                            <td style="width:25%;text-align: left;font-size:11px;" class="no-border"><span
                                        style="border-bottom:1px solid #333;">আঞ্চলিক পরিচালক/
                                                            পরিচালক: </span></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </article>
    <!-- Modal -->
    <style>
        .presentation_table td {
            font-size:10px !important;
        }
        .presentation_table th {
            font-size:10px !important;;
        }
        .emptyColorInfo{
            color:darkred;
        }
    </style>
@endsection

