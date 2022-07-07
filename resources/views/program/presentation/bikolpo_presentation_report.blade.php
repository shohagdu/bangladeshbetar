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
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2 class="no-print">অধিবেশন কক্ষে প্রচার সংশ্লিষ্টদের তালিকা</h2>
                <button class="btn btn-primary btn-xs no-print" onclick="window.print()"  style="float:right;
                margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-print"></i>
                    Print
                </button>
            </header>
            <div>
                <?php
                $show_day_info_bn= show_day_info_bn();
                $month_info= month_name_info();
                $odivision_data=odivision_info_data();
                $role_info_data=role_info_data();
                ?>
                <div class="widget-body no-padding">
                    <table class="print_table-no-border " id="table-style" style="width:100%;border: 1px
                    solid #fff
                    !important;">
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
                            <td style="width:100%;border: 1px solid #fff !important;">
                                <table class="table table-bordered" style="width: 100%">
                                    <?php
                                       // echo "<pre>";
                                   // print_r($program_artist_info);
                                    if(!empty($presentation_info)){
                                    foreach ($presentation_info as $odivision_key=> $info){
                                    ?>
                                    <tr>
                                        <td style="font-size:14px;font-weight: bold" colspan="{{ (!empty($odivision_key) &&
                                        $odivision_key==1)
                                        ?1:7 }}">
                                            {{ !empty($odivision_key)? $odivision_data[$odivision_key]:'' }}
                                        </td>

                                        <?php
                                        if(!empty($odivision_key) && $odivision_key==1){
                                            echo " <th>বার</th>";
                                            foreach($role_title_array as $key =>$role_title_info){
                                                echo "<td>".  $role_info_data[$role_title_info]
                                                    ."</td>";
                                            }

                                        }
                                        ?>
                                    </tr>
                                    <?php
                                    foreach($info as $all_key=>$all_info)    {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $full_array=$presentation_info[$odivision_key][$all_key];
                                            $date_array=array_keys($full_array);
                                            $data_info=[];
                                            foreach ($date_array as $date_day){
                                                $data_info[]=date('d',strtotime($date_day));
                                            }
                                            echo (!empty($data_info))? eng2bnNumber( implode(",",$data_info)):'';
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $day_name= date('D',strtotime( $data_info[0].
                                                "-".$presentation_heading_info->months
                                                ."-".$presentation_heading_info->presentation_year));
                                            echo (!empty($day_name))?$show_day_info_bn[$day_name]:''
                                            ?>
                                        </td>



                                        <?php
                                        foreach($role_title_array as $key =>$role_title_info){
                                            echo "<td>";
                                            $artist_info=[];
                                            $artist_date=[];
                                            $artist_date_exiting=[];
                                            foreach($all_info as $date_info =>$array_date_info){
                                                foreach($array_date_info as $title=> $artist_info){
                                                    if($title==$role_title_info){

                                                        foreach ($artist_info as $artist_data){

                                                           $bikolpo_artist_info_data= (!empty
                                                           ($artist_data['bikolpo_artist_info']))?json_decode
                                                            ($artist_data['bikolpo_artist_info'],true):NULL;

                                                            if(!empty($bikolpo_artist_info_data['artist_id'])){
                                                             $artist_date[$program_artist_info[$bikolpo_artist_info_data['artist_id']]][]=  date('d',strtotime($date_info));
                                                                $artist_date_exiting[]=$artist_data['name_bn'];
                                                                ;
                                                            }else{

                                                            }
                                                        }

                                                    }
                                                }


                                            }
                                            $artist_date=array_unique($artist_date);
                                            $artist_data='';
                                            foreach ($artist_date as $artist_name=>$presentation_date){
                                                $artist_data.= $artist_name.((count($data_info) > count
                                                        ($presentation_date))? " (".eng2bnNumber(implode(",",
                                                            $presentation_date)).")":'').", ";

                                            }
                                            echo rtrim($artist_data,', ');
                                            echo "</td>";
                                        }


                                        ?>




                                        <?php

                                        //  }

                                        //                                            $info_data=  (isset
                                        //                                            ($presentation_info[$role_key][$all_key][$odivision_info]))
                                        //                                                ?$presentation_info[$role_key][$all_key][$odivision_info]:[];
                                        //                                            $all_data='';
                                        //                                            foreach ($info_data as $artist_data){
                                        //                                                $all_data.= date('d',strtotime($artist_data['presentation_date']))
                                        //                                                    .",";
                                        //                                            }
                                        //                                            echo rtrim(eng2bnNumber($all_data),',');

                                        ?>

                                        </td>
                                    </tr>

                                    <?php } }  }?>
                                </table>
                                <table class="print_table-no-border" style="width: 100%;margin-bottom:
                                            20px;margin-top: 80px;margin-bottom: 80px;border: 1px solid #fff
                                            !important;" rules="all">
                                    <tr>
                                        <td style="width:25%;text-align: center;font-size:11px; " class="no-border"> <span
                                            >
                                                            <u>পরিকল্পনাকারী:</u>
                                    {{
                                                    $employee_info[$presentation_heading_info->presentation_created_by]
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
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </article>
@endsection
