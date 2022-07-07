@extends("master_program")

@section('main_content_area')
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2 class="no-print">পারফরমেন্স তথ্য সমুহ</h2>
                <button type="button" onclick="print()"
                   class="btn btn-primary btn-xs no-print" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-print"></i>
                    Print
                </button>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <?php
                        $odivision_data=odivision_info_data();
                        $role_info_data=role_info_data();
                        $program_presentation_type=program_presentation_type();
                        ?>
                        <table class="table-bordered table">
                            <tr>
                                <td colspan="11" class="no-border"   style="text-align: center;width:40%;border: 1px
                                solid
                                #fff!important" >
                                    <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  </div>

                                    <div style="font-size:14px;">{{ $heading_performance_info->name }}</div>
                                    <div style="font-size:14px;">{{ $heading_performance_info->address }}</div>
                                    <div style="font-size:14px;">{{ $heading_performance_info->fequencey_data }}</div>
                                    <span><b>তারিখ: </b> {{ (!empty($heading_performance_info->performance_date))?
                                 eng2bnNumber(date('d-m-Y',strtotime($heading_performance_info->performance_date)))
                                 :'' }} </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="no-border" colspan="11">অধিবেশন কক্ষ</td>
                            </tr>

                            <tr>
                                <td>শিল্পীর ছবি</td>
                                <td>শিল্পীর নাম</td>
                                <td>মোবাইল</td>
                                <td>চুক্তিপত্রের আইডি</td>
                                <td>পালা</td>
                                <td>অধিবেশনে ভূমিকা</td>
                                <td>এডহক/ বিকল্প</td>
                                <td>অধিবেশন তথ্য</td>
                                <td>পারফরমেন্স</td>
                                <td>মন্তব্য</td>
                                <td>অনুমোদনকারী</td>
                            </tr>
                            <?php
                            if(!empty($performance_info)){
                            foreach ($performance_info as $key=>$all_info){
                            ?>
                            <tr>
                                <td>
                                    <img src="{{ (file_exists("fontView/assets/artist_image/"
                                        .$all_info->picture))? (!empty
                                        ($all_info->picture)?url
                                        ("fontView/assets/artist_image/"
                                        .$all_info->picture):''):url
                                        ("images\default\default-avatar.png")  }}" style="height:30px;">
                                    <input type="hidden" name="artist_infos_primary_id[]" value="{{ !empty($all_info->id)
            ?$all_info->id:'' }}">
                                </td>
                                <td>{{ !empty($all_info->name_bn)?$all_info->name_bn:'' }}</td>
                                <td>
                                    <?php
                                    if(!empty($all_info->mobile)) {
                                        $mobile_info=json_decode($all_info->mobile,true);
                                        echo !empty($mobile_info)?$mobile_info[0]:'';
                                    }
                                    ?>
                                </td>
                                <td>{{ !empty($all_info->presentation_identification_id)?$all_info->presentation_identification_id:'' }}</td>
                                <td>{{ !empty($all_info->odivision_id)?$odivision_data[$all_info->odivision_id]:'' }}</td>
                                <td>{{ !empty($all_info->role_title)?$role_info_data[$all_info->role_title]:'' }}</td>
                                <td>{{ !empty($all_info->presentation_type)?$program_presentation_type[$all_info->presentation_type]:'' }}</td>
                                <td>
                                      {{ (!empty($all_info->performance_odvision_info) &&
                $all_info->performance_odvision_info==1 )?"হ্যাঁ":"" }}
                                        {{ (!empty($all_info->performance_odvision_info) &&
                $all_info->performance_odvision_info==2 )?"না":"" }}
                                        {{ (!empty($all_info->performance_odvision_info) &&
                $all_info->performance_odvision_info==3 )?"উল্লেখ নেই":"" }}
                                </td>
                                <td>

                                        {{ (!empty($all_info->performance_ctg) &&
                $all_info->performance_ctg==1 )?"হ্যাঁ":"" }}
                                    {{ (!empty($all_info->performance_ctg) &&
                $all_info->performance_ctg==2 )?"না":"" }}
                                </td>
                                <td>
           {{ (!empty($all_info->performance_comments) )?$all_info->performance_comments:"" }}
                                </td>
                                <td>
           {{ (!empty($heading_performance_info->performance_created_by) )?$heading_performance_info->performance_created_by:"" }}
                                </td>


                            </tr>
                            <?php } } ?>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

