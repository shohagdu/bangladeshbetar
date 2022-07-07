<table class="table table-bordered" style="width:100%">
    <tr>
        <th >
            উপস্থাপনা বিবরন
            <a style="float:right;margin-left:10px !important;"
               href="{{ url('artist_record_add') }} " class="btn btn-primary btn-xs"
               target="_blank"><i class="glyphicon glyphicon-plus"></i> নতুন শিল্পী যোগ
                করুন</a>
        </th>
    </tr>
    <?php
        $day_name=show_day_info_bn();
        $odivision = [
            1,2,3,4
        ];
        $setting_content=!empty($setting_content)?json_decode($setting_content,true):'';
    ?>
    <tr>
        <td>
            <div class="widget-body no-padding"  >
                <div class="col-sm-12" >
                    <div class="col-sm-12" style="margin-top:10px;"></div>
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a data-toggle="tab" href="#oneToTen">(1-10) Date</a></li>
                        <li><a data-toggle="tab" href="#elevenToTwenty">(11-20) Date</a></li>
                        <li><a data-toggle="tab" href="#twentyToThirtyOne">(21-31) Date</a></li>

                    </ul>
                    <div class="tab-content" style="border: 1px solid #d0d0d0;margin-bottom:10px;">

                            <div id="oneToTen" class="tab-pane fade in active">
                                <?php
                                    foreach ($dates as $day_id=>$date) {


                                    $day_id++;
                                    $j=0;
                                        if($day_id>=0 && $day_id<=10  ){
                                        ?>
                                            <div class="col-sm-12" style="padding-bottom:5px;">
                                                <div class="col-sm-6">
                                                    তারিখ <span style="color:red;font-weight: bold;"> {{ date('d-m-Y',strtotime($date)) }}</span>
                                                </div>
                                                <div class="col-sm-6">
                                                    বার: {{ $day_name[date('D',strtotime($date))] }}
                                                </div>
                                            </div>
                                            @foreach($odivision as $odivision_id)

                                           
                                                <table  class="table table-bordered width100per" id="presentation_table"  >
                                                    <tr>
                                                        <th colspan="6">
                                                            @if( $odivision_id ==1)
                                                                প্রথম অধিবেশন(৬.০০-১২.০০)
                                                            @elseif( $odivision_id ==2)
                                                                দ্বিতীয় অধিবেশন(১২.০০-৬.০০)
                                                            @elseif( $odivision_id ==3)
                                                                তৃতীয় অধিবেশন(৬.০০-১২.০০)
                                                            @elseif( $odivision_id ==4)
                                                                ৪র্থ অধিবেশন(১২.০০-৬.০০)
                                                            @endif
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 20% !important;">
                                                        
                                                            <?php
                                                            $duty_officer_info= isset( $setting_content[date('D',strtotime
                                                            ($date))
                                                            ][$odivision_id] ['duty_officer']) ?  $setting_content[date('D',strtotime
                                                            ($date))
                                                            ][$odivision_id] ['duty_officer'] : "";
                                                            
                                                            ?>
                                                              
                                                            <input type="hidden"  name="program_date[{{$date}}][{{$odivision_id}}][duty_officer]" class="form-control">
                                                            <select id="magazine_manage" placeholder="ডিউটি অফিসার"  class="select2"  multiple required
                                                                    name="program_date[{{$date}}][{{$odivision_id}}][duty_officer][]" style="width:100% !important">
                                                                @if(!empty($atrist_info_info))
                                                                    @foreach($atrist_info_info as $key=> $value)
                                                                        @php
                                                                            $selected= ( !empty($duty_officer_info) &&
                                                                            in_array($key,
                                                                            $duty_officer_info))
                                                                            ? "selected":'';
                                                                        @endphp
                                                                        <option value="{{ $key }}" {{ $selected }}>{{ $value
                                                                            }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </td>

                                                     
                                                        <td style="width: 20% !important;">
                                                            <?php
                                                                $announcer_info=  isset($setting_content[date('D',strtotime
                                                                ($date))
                                                                ][$odivision_id] ['announcer']) ? $setting_content[date('D',strtotime
                                                                ($date))
                                                                ][$odivision_id] ['announcer'] : "";

                                                            ?>
                                                            <input type="hidden"  name="program_date[{{$date}}][{{$odivision_id}}][announcer]" class="form-control">
                                                            <select id="magazine_manage" placeholder="ঘোষক"  class="select2"  multiple required
                                                                    name="program_date[{{$date}}][{{$odivision_id}}][announcer][]" style="width:100% !important">

                                                                @if(!empty($atrist_info_info))
                                                                    @foreach($atrist_info_info as $key=> $value)
                                                                       @php
                                                                            $selected= (!empty($announcer_info) && in_array($key,
                                                                            $announcer_info))
                                                                            ?"selected":'';
                                                                        @endphp
                                                                        <option value="{{ $key }}" {{ $selected }}>{{ $value
                                                                        }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </td>
                                                      
                                                        <td style="width: 20% !important;">
                                                            <?php
                                                                $log_writer_info=  isset($setting_content[date('D',strtotime
                                                                ($date))
                                                                ][$odivision_id] ['log_writer']) ? $setting_content[date('D',strtotime
                                                                ($date))
                                                                ][$odivision_id] ['log_writer'] : "" ;
                                                            ?>
                                                            <input type="hidden"  name="program_date[{{$date}}][{{$odivision_id}}][log_writer]" class="form-control">
                                                            <select id="magazine_manage" placeholder="লগ রাইটার"  class="select2"  multiple required
                                                                    name="program_date[{{$date}}][{{$odivision_id}}][log_writer][]" style="width:200px !important">

                                                                @if(!empty($atrist_info_info))
                                                                    @foreach($atrist_info_info as $key=> $value)
                                                                        @php
                                                                            $selected= (!empty($log_writer_info) &&
                                                                            in_array($key,
                                                                            $log_writer_info))
                                                                            ?"selected":'';
                                                                        @endphp
                                                                        <option value="{{ $key }}" {{ $selected }}>{{ $value
                                                                        }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </td>

                                                       
                                                        <td style="width: 20% !important;">
                                                            <?php
                                                            $officer_assistent_info=  isset($setting_content[date('D',strtotime
                                                            ($date))
                                                            ][$odivision_id] ['officer_assistent']) ? $setting_content[date('D',strtotime
                                                            ($date))
                                                            ][$odivision_id] ['officer_assistent'] : "" ;
                                                            ?>
                                                            <input type="hidden"  name="program_date[{{$date}}][{{$odivision_id}}][officer_assistent]" class="form-control">
                                                            <select id="magazine_manage" placeholder="অফিস সহায়ক"  class="select2"  multiple required
                                                                    name="program_date[{{$date}}][{{$odivision_id}}][officer_assistent][]" style="width:100% !important">
                                                                @if(!empty($atrist_info_info))
                                                                    @foreach($atrist_info_info as $key=> $value)
                                                                        @php
                                                                            $selected= ( !empty
                                                                            ($officer_assistent_info) && in_array($key,
                                                                            $officer_assistent_info))
                                                                            ?"selected":'';
                                                                        @endphp
                                                                        <option value="{{ $key }}" {{ $selected }}>{{ $value
                                                                            }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </td>
                                                       
                                                        <td style="width: 20% !important;">
                                                            <?php
                                                                $officer_incharge_info=  isset($setting_content[date('D',strtotime
                                                                ($date))
                                                                ][$odivision_id] ['officer_incharge']) ?  $setting_content[date('D',strtotime
                                                                ($date))
                                                                ][$odivision_id] ['officer_incharge'] : "";
                                                            ?>
                                                            <input type="hidden"  name="program_date[{{$date}}][{{$odivision_id}}][officer_incharge]" class="form-control">
                                                            <select id="magazine_manage" placeholder="অফিসার ইনসার্স"  class="select2"  multiple required
                                                                    name="program_date[{{$date}}][{{$odivision_id}}][officer_incharge][]" style="width:100% !important">

                                                                @if(!empty($atrist_info_info))
                                                                    @foreach($atrist_info_info as $key=> $value)
                                                                        @php
                                                                            $selected= ( !empty
                                                                            ($officer_incharge_info) && in_array($key,
                                                                            $officer_incharge_info))
                                                                            ?"selected":'';
                                                                        @endphp
                                                                        <option value="{{ $key }}" {{ $selected }}>{{ $value
                                                                        }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>

                                                        </td>
                                                       
                                                    </tr>
                                                </table>

                                            @endforeach
                                    <?php $j++; ?>
                                        <?php
                                        }
                                    }
                                ?>
                            </div>

                    
                            <div id="elevenToTwenty" class="tab-pane fade">
                                <?php
                                foreach ($dates as $day_id=>$date) {
                                $day_id++;
                                $j=0;
                                if($day_id>=11 && $day_id<=20  ){
                                ?>
                                <div class="col-sm-12" style="padding-bottom:5px;">
                                    <div class="col-sm-6">
                                        তারিখ <span style="color:red;font-weight: bold;"> {{ date('d-m-Y',strtotime($date)) }}</span>
                                    </div>
                                    <div class="col-sm-6">
                                        বার: {{ $day_name[date('D',strtotime($date))] }}
                                    </div>
                                </div>
                                @foreach($odivision as $odivision_id)
                                    <table  class="table table-bordered width100per" id="presentation_table"  >
                                        <tr>
                                            <th colspan="6">
                                                @if( $odivision_id ==1)
                                                    প্রথম অধিবেশন(৬.০০-১২.০০)
                                                @elseif( $odivision_id ==2)
                                                    দ্বিতীয় অধিবেশন(১২.০০-৬.০০)
                                                @elseif( $odivision_id ==3)
                                                    তৃতীয় অধিবেশন(৬.০০-১২.০০)
                                                @elseif( $odivision_id ==4)
                                                    ৪র্থ অধিবেশন(১২.০০-৬.০০)
                                                @endif
                                            </th>
                                        </tr>
                                        <tr>
                                            <td style="width: 20% !important;">
                                                <?php
                                                $duty_officer_info=  isset($$setting_content[date('D',strtotime
                                                ($date))
                                                ][$odivision_id] ['duty_officer']) ? $setting_content[date('D',strtotime
                                                ($date))
                                                ][$odivision_id] ['duty_officer'] : "";
                                                ?>
                                                <input type="hidden"  name="program_date[{{$date}}][{{$odivision_id}}][duty_officer]" class="form-control">
                                                <select id="magazine_manage" placeholder="ডিউটি অফিসার"  class="select2"  multiple required
                                                        name="program_date[{{$date}}][{{$odivision_id}}][duty_officer][]" style="width:100% !important">
                                                    @if(!empty($atrist_info_info))
                                                        @foreach($atrist_info_info as $key=> $value)
                                                            @php
                                                                $selected= (!empty($duty_officer_info) && in_array
                                                                ($key,$duty_officer_info))
                                                                ?"selected":'';
                                                            @endphp
                                                            <option value="{{ $key }}" {{ $selected }}>{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td style="width: 20% !important;">
                                                <?php
                                                    $announcer_info=  isset($setting_content[date('D',strtotime
                                                    ($date))
                                                    ][$odivision_id] ['announcer']) ? $setting_content[date('D',strtotime
                                                    ($date))
                                                    ][$odivision_id] ['announcer'] : "";
                                                ?>
                                                <input type="hidden"  name="program_date[{{$date}}][{{$odivision_id}}][announcer]" class="form-control">
                                                <select id="magazine_manage" placeholder="ঘোষক"  class="select2"  multiple required
                                                        name="program_date[{{$date}}][{{$odivision_id}}][announcer][]" style="width:100% !important">

                                                    @if(!empty($atrist_info_info))
                                                        @foreach($atrist_info_info as $key=> $value)
                                                            @php
                                                                $selected= (!empty($announcer_info) && in_array($key,
                                                                $announcer_info))
                                                                ?"selected":'';
                                                            @endphp
                                                            <option value="{{ $key }}" {{ $selected }}>{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td style="width: 20% !important;">
                                                <?php
                                                    $log_writer_info=  isset($setting_content[date('D',strtotime
                                                    ($date))
                                                    ][$odivision_id] ['log_writer']) ? $setting_content[date('D',strtotime
                                                    ($date))
                                                    ][$odivision_id] ['log_writer'] : "";
                                                ?>
                                                <input type="hidden"  name="program_date[{{$date}}][{{$odivision_id}}][log_writer]" class="form-control">
                                                <select id="magazine_manage" placeholder="লগ রাইটার"  class="select2"  multiple required
                                                        name="program_date[{{$date}}][{{$odivision_id}}][log_writer][]" style="width:100% !important">

                                                    @if(!empty($atrist_info_info))
                                                        @foreach($atrist_info_info as $key=> $value)
                                                            @php
                                                                $selected= (!empty($log_writer_info) && in_array($key,
                                                                $log_writer_info))
                                                                ?"selected":'';
                                                            @endphp
                                                            <option value="{{ $key }}" {{ $selected }}>{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td style="width: 20% !important;">
                                                <?php
                                                $officer_assistent_info=  isset($setting_content[date('D',strtotime
                                                ($date))
                                                ][$odivision_id] ['officer_assistent']) ? $$setting_content[date('D',strtotime
                                                ($date))
                                                ][$odivision_id] ['officer_assistent'] : "";
                                                ?>
                                                <input type="hidden"  name="program_date[{{$date}}][{{$odivision_id}}][officer_assistent]" class="form-control">
                                                <select id="magazine_manage" placeholder="অফিস সহায়ক"  class="select2"  multiple required
                                                        name="program_date[{{$date}}][{{$odivision_id}}][officer_assistent][]" style="width:100% !important">
                                                    @if(!empty($atrist_info_info))
                                                        @foreach($atrist_info_info as $key=> $value)
                                                            @php
                                                                $selected= ( !empty($officer_assistent_info) &&
                                                                in_array($key,
                                                                $officer_assistent_info))
                                                                ?"selected":'';
                                                            @endphp
                                                            <option value="{{ $key }}" {{ $selected }}>{{ $value
                                                                }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td style="width: 20% !important;">
                                                <?php
                                                    $officer_incharge_info=  isset($setting_content[date('D',strtotime
                                                    ($date))
                                                    ][$odivision_id] ['officer_incharge']) ? $setting_content[date('D',strtotime
                                                    ($date))
                                                    ][$odivision_id] ['officer_incharge'] : "";
                                                ?>
                                                <input type="hidden"  name="program_date[{{$date}}][{{$odivision_id}}][officer_incharge]" class="form-control">
                                                <select id="magazine_manage" placeholder="অফিসার ইনসার্স"  class="select2"  multiple required
                                                        name="program_date[{{$date}}][{{$odivision_id}}][officer_incharge][]" style="width:100% !important">

                                                    @if(!empty($atrist_info_info))
                                                        @foreach($atrist_info_info as $key=> $value)
                                                            @php
                                                                $selected= (!empty($officer_incharge_info) && in_array($key,
                                                                $officer_incharge_info))
                                                                ?"selected":'';
                                                            @endphp
                                                            <option value="{{ $key }}" {{ $selected }}>{{ $value
                                                                }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>

                                            </td>


                                        </tr>
                                    </table>

                                @endforeach
                                <?php $j++; ?>
                                <?php
                                }
                                }
                                ?>
                            </div>

                            <div id="twentyToThirtyOne" class="tab-pane fade">

                                <?php
                                foreach ($dates as $day_id=>$date) {
                                $day_id++;
                                $j=0;
                                if($day_id>=21 && $day_id<=31  ){
                                ?>
                                <div class="col-sm-12" style="padding-bottom:5px;">
                                    <div class="col-sm-6">
                                        তারিখ <span style="color:red;font-weight: bold;"> {{ date('d-m-Y',strtotime($date)) }}</span>
                                    </div>
                                    <div class="col-sm-6">
                                        বার: {{ $day_name[date('D',strtotime($date))] }}
                                    </div>
                                </div>
                                @foreach($odivision as $odivision_id)
                                    <table  class="table table-bordered width100per" id="presentation_table"  >
                                        <tr>
                                            <th colspan="6">
                                                @if( $odivision_id ==1)
                                                    প্রথম অধিবেশন(৬.০০-১২.০০)
                                                @elseif( $odivision_id ==2)
                                                    দ্বিতীয় অধিবেশন(১২.০০-৬.০০)
                                                @elseif( $odivision_id ==3)
                                                    তৃতীয় অধিবেশন(৬.০০-১২.০০)
                                                @elseif( $odivision_id ==4)
                                                    ৪র্থ অধিবেশন(১২.০০-৬.০০)
                                                @endif
                                            </th>
                                        </tr>
                                        <tr>
                                            <td style="width: 20% !important;">
                                                <?php
                                                $duty_officer_info= isset( $setting_content[date('D',strtotime
                                                ($date))
                                                ][$odivision_id] ['duty_officer']) ?  $setting_content[date('D',strtotime
                                                ($date))
                                                ][$odivision_id] ['duty_officer'] : "";
                                                ?>
                                                <input type="hidden"  name="program_date[{{$date}}][{{$odivision_id}}][duty_officer]" class="form-control">
                                                <select id="magazine_manage" placeholder="ডিউটি অফিসার"  class="select2"  multiple required
                                                        name="program_date[{{$date}}][{{$odivision_id}}][duty_officer][]" style="width:100% !important">
                                                    @if(!empty($atrist_info_info))
                                                        @foreach($atrist_info_info as $key=> $value)
                                                            @php
                                                                $selected= ( !empty($duty_officer_info) && in_array
                                                                ($key,$duty_officer_info))
                                                                ?"selected":'';
                                                            @endphp
                                                            <option value="{{ $key }}" {{ $selected }}>{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>

                                            <td style="width: 20% !important;">
                                                <?php
                                                    $announcer_info= isset( $setting_content[date('D',strtotime
                                                    ($date))
                                                    ][$odivision_id] ['announcer']) ?  $setting_content[date('D',strtotime
                                                    ($date))
                                                    ][$odivision_id] ['announcer'] : "";
                                                ?>
                                                <input type="hidden"  name="program_date[{{$date}}][{{$odivision_id}}][announcer]" class="form-control">
                                                <select id="magazine_manage" placeholder="ঘোষক"  class="select2"  multiple required
                                                        name="program_date[{{$date}}][{{$odivision_id}}][announcer][]" style="width:100% !important">

                                                    @if(!empty($atrist_info_info))
                                                        @foreach($atrist_info_info as $key=> $value)
                                                            @php
                                                                $selected= ( !empty($announcer_info) && in_array($key,
                                                                $announcer_info))
                                                                ?"selected":'';
                                                            @endphp
                                                            <option value="{{ $key }}" {{ $selected }}>{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td style="width: 20% !important;">
                                                <?php
                                                    $log_writer_info=  isset($setting_content[date('D',strtotime
                                                    ($date))
                                                    ][$odivision_id] ['log_writer']) ? $setting_content[date('D',strtotime
                                                    ($date))
                                                    ][$odivision_id] ['log_writer'] : "";
                                                ?>
                                                <input type="hidden"  name="program_date[{{$date}}][{{$odivision_id}}][log_writer]" class="form-control">
                                                <select id="magazine_manage" placeholder="লগ রাইটার"  class="select2"  multiple required
                                                        name="program_date[{{$date}}][{{$odivision_id}}][log_writer][]" style="width:100% !important">

                                                    @if(!empty($atrist_info_info))
                                                        @foreach($atrist_info_info as $key=> $value)
                                                            @php
                                                                $selected= (!empty($log_writer_info) && in_array($key,
                                                                $log_writer_info))
                                                                ?"selected":'';
                                                            @endphp
                                                            <option value="{{ $key }}" {{ $selected }}>{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td style="width: 20% !important;">
                                                <?php
                                                $officer_assistent_info=  isset($setting_content[date('D',strtotime
                                                ($date))
                                                ][$odivision_id] ['officer_assistent']) ? $setting_content[date('D',strtotime
                                                ($date))
                                                ][$odivision_id] ['officer_assistent'] : "";
                                                ?>
                                                <input type="hidden"  name="program_date[{{$date}}][{{$odivision_id}}][officer_assistent]" class="form-control">
                                                <select id="magazine_manage" placeholder="অফিস সহায়ক"  class="select2"  multiple required
                                                        name="program_date[{{$date}}][{{$odivision_id}}][officer_assistent][]" style="width:100% !important">
                                                    @if(!empty($atrist_info_info))
                                                        @foreach($atrist_info_info as $key=> $value)
                                                            @php
                                                                $selected= ( !empty($officer_assistent_info)
                                                                && in_array($key,
                                                                $officer_assistent_info))
                                                                ?"selected":'';
                                                            @endphp
                                                            <option value="{{ $key }}"  {{ $selected }}>{{ $value
                                                                }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td style="width: 20% !important;">
                                                <?php
                                                    $officer_incharge_info=  isset($setting_content[date('D',strtotime
                                                    ($date))
                                                    ][$odivision_id] ['officer_incharge']) ? $setting_content[date('D',strtotime
                                                    ($date))
                                                    ][$odivision_id] ['officer_incharge'] : "";
                                                ?>
                                                <input type="hidden"  name="program_date[{{$date}}][{{$odivision_id}}][officer_incharge]" class="form-control">
                                                <select id="magazine_manage" placeholder="অফিসার ইনসার্স"  class="select2"  multiple required
                                                        name="program_date[{{$date}}][{{$odivision_id}}][officer_incharge][]" style="width:100% !important">

                                                    @if(!empty($atrist_info_info))
                                                        @foreach($atrist_info_info as $key=> $value)
                                                            @php
                                                                $selected= ( !empty($officer_incharge_info) && in_array
                                                                ($key,$officer_incharge_info))
                                                                ?"selected":'';
                                                            @endphp
                                                            <option value="{{ $key }}" {{ $selected }}>{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>

                                            </td>


                                        </tr>
                                    </table>

                                @endforeach
                                <?php $j++; ?>
                                <?php
                                }
                                }
                                ?>
                            </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td id="form_output"></td>
    </tr>
    <tr>

        <td  style="text-align:right">
            <button type="button" onclick="savePresentationInfo()" id="saveBtn" class="btn btn-success"><i
                        class="glyphicon glyphicon-save"></i>
                Save
            </button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                        class="glyphicon glyphicon-remove"></i> Close
            </button>
        </td>
        
    </tr>

</table>
<style>
    #presentation_table td{
        border:1px solid #d0d0d0;

    }
    #presentation_table th{
        border:1px solid #d0d0d0;

    }

</style>