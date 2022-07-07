    
    <script>
        $("document").ready(function(){
            $('.select2').select2();
            $('.datepickerinfo_1').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
            }).val();

        });
    </script>

    <table class="table table-bordered">
        <tr>
            <th colspan="5">উপস্থাপনা বিবরন</th>
            
        </tr>

        <tr>
            <th style="width:15%;">তারিখ</th>
            <th style="width:20%;">প্রথম অধিবেশন(৬.০০-১২.০০)</th>
            <th style="width:20%;">দি্বতীয় অধিবেশন(১২.০০-৬.০০)</th>
            <th style="width:20%;">তৃতীয় অধিবেশন(৬.০০-১২.০০)</th>
            <th style="width:20%;">৪র্থ অধিবেশন(১২.০০-৬.০০)</th>
        </tr>
        <?php
            $odivision = [
                    1,2,3,4   
            ];

            foreach ($presentation_info as $day_id=>$value) {
            
        ?>

        <tr>
            <td>
                @php 
                echo date('d-m-Y-D',strtotime($value->presentation_date));
                @endphp
                <div>
                    রিপিট তারিখ
                    <br/>
                    <input type="text" id="{{$value->presentation_date}}" placeholder="রিপিট তারিখ" name="repeat[{{$value->presentation_date}}]"  class="form-control datepickerinfo_1"/>
                </div>
            </td>
            
            @php 
            $odivision_info = json_decode($value->artist_log_info,true);
            @endphp
            @foreach($odivision_info as $odivision_id => $odivision_data)
            
            <td>
                <div class="row">
                <div class="col-sm-2">ঘোষক</div>
                    <div class="col-sm-10">
                    <input type="hidden"  name="program_date[{{$value->presentation_date}}][{{$odivision_id}}][announcer]" class="form-control">
                        <select id="magazine_manage" placeholder="ঘোষক"  class="select2"  multiple required
                        name="program_date[{{$value->presentation_date}}][{{$odivision_id}}][announcer][]" style="width:150px !important">

                            @if(!empty($atrist_info_info))
                                @foreach($atrist_info_info as $key=> $art_name)
                                    <option {{ is_array($odivision_data['announcer']) && in_array($key,$odivision_data['announcer']) ? 'selected': '' }} value="{{ $key }}">{{ $art_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                <div class="col-sm-12" style="margin-top:10px"></div>
                
                <div class="col-sm-2">লগ রাইটার</div>
                <div class="col-sm-10">
                <input type="hidden"  name="program_date[{{$value->presentation_date}}][{{$odivision_id}}][log_writer]" class="form-control">
                    <select id="magazine_manage" placeholder="লগ রাইটার"  class="select2"  multiple required
                    name="program_date[{{$value->presentation_date}}][{{$odivision_id}}][log_writer][]" style="width:150px !important">

                        @if(!empty($atrist_info_info))
                            @foreach($atrist_info_info as $key=> $name)
                                <option {{ is_array($odivision_data['log_writer']) && in_array($key,$odivision_data['log_writer']) ? 'selected': '' }} value="{{ $key }}">{{ $name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="col-sm-12" style="margin-top:10px"></div>
                <div class="col-sm-2">অফিসার ইনসার্স</div>
                <div class="col-sm-10">
                <input type="hidden"  name="program_date[{{$value->presentation_date}}][{{$odivision_id}}][officer_incharge]" class="form-control">
                    <select id="magazine_manage" placeholder="অফিসার ইনসার্স"  class="select2"  multiple required
                    name="program_date[{{$value->presentation_date}}][{{$odivision_id}}][officer_incharge][]" style="width:150px !important">

                        @if(!empty($atrist_info_info))
                            @foreach($atrist_info_info as $key=> $name)
                                <option {{ is_array($odivision_data['officer_incharge']) && in_array($key,$odivision_data['officer_incharge']) ? 'selected': '' }} value="{{ $key }}">{{ $name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="col-sm-12" style="margin-top:10px"></div>
                <div class="col-sm-2">অফিস সহায়ক</div>
                <div class="col-sm-10">
                <input type="hidden"  name="program_date[{{$value->presentation_date}}][{{$odivision_id}}][officer_assistent]" class="form-control">
                    <select id="magazine_manage" placeholder="অফিস সহায়ক"  class="select2"  multiple required
                    name="program_date[{{$value->presentation_date}}][{{$odivision_id}}][officer_assistent][]" style="width:150px !important">
                        @if(!empty($atrist_info_info))
                            @foreach($atrist_info_info as $key=> $name)
                                <option {{ is_array($odivision_data['officer_assistent']) && in_array($key,$odivision_data['officer_assistent']) ? 'selected': '' }} value="{{ $key }}">{{ $name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="col-sm-12" style="margin-top:10px"></div>
                <div class="col-sm-2">ডিউটি অফিসার</div>
                <div class="col-sm-10">
                <input type="hidden"  name="program_date[{{$value->presentation_date}}][{{$odivision_id}}][duty_officer]" class="form-control">
                    <select id="magazine_manage" placeholder="ডিউটি অফিসার"  class="select2"  multiple required
                    name="program_date[{{$value->presentation_date}}][{{$odivision_id}}][duty_officer][]" style="width:150px !important">
                        @if(!empty($atrist_info_info))
                            @foreach($atrist_info_info as $key=> $name)
                                <option {{ is_array($odivision_data['duty_officer']) && in_array($key,$odivision_data['duty_officer']) ? 'selected': '' }} value="{{ $key }}">{{ $name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                
            </td>
            
            @endforeach
            
        </tr>


        <?php } ?>

    </table>

       