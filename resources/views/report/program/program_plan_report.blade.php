<?php
$odivision = [
    '1' => "প্রথম অধিবেশন(৬.০০-১২.০০)",
    '2' => "দি্বতীয় অধিবেশন(১২.০০-৬.০০)",
    '3' => "তৃতীয় অধিবেশন(৬.০০-১২.০০)",
    '4' => "৪র্থ অধিবেশন(১২.০০-৬.০০)"
];
$presentation_data = isset($presentation_info->artist_log_info)?json_decode($presentation_info->artist_log_info,true):[];
// echo "<pre>";
// print_r($presentation_data);
// echo "</pre>";
?>
<table class="table-bordered table">
        <thead>
             @if(!empty($presentation_data))
                <tr>
                    <th colspan="4">উপস্থাপনা বিবরন</th>
                </tr>
            @endif
            <tr>
                <th colspan="4">তারিখ : {{ date('d-m-Y',strtotime($date)) }}</th>
            </tr>
            @if(!empty($presentation_data))
                <tr>
                    <th style="width:15%;">প্রথম অধিবেশন(৬.০০-১২.০০)</th>
                    <th style="width:15%;">দ্বিতীয় অধিবেশন(১২.০০-৬.০০)</th>
                    <th style="width:15%;">তৃতীয় অধিবেশন(৬.০০-১২.০০)</th>
                    <th style="width:15%;">৪র্থ অধিবেশন(১২.০০-৬.০০)</th>
                </tr>
            @endif
        </thead>
        <tbody>
            <tr>
            @if(!empty($presentation_data))
                @foreach($presentation_data as $key => $data)
                <td style="text-align:left;">
                    <ul>
                        <li style="list-style:none;font-weight:bold;">ঘোষক</li>
                        @foreach($presentation_data[$key]['announcer'] as $anouncer_id)
                        <li>
                            @foreach($artist_info as $artkey => $artname)
                                {{$artkey==$anouncer_id ? $artname : ''}}
                            @endforeach
                        </li>
                        @endforeach
                        <li style="list-style:none;font-weight:bold;">লগ রাইটার</li>
                        @foreach($presentation_data[$key]['log_writer'] as $anouncer_id)
                        <li>
                            @foreach($artist_info as $artkey => $artname)
                                {{$artkey==$anouncer_id ? $artname : ''}}
                            @endforeach
                        </li>
                        @endforeach
                        <li style="list-style:none;font-weight:bold;">অফিসার ইনসার্স</li>
                        @foreach($presentation_data[$key]['officer_incharge'] as $anouncer_id)
                        <li>
                            @foreach($artist_info as $artkey => $artname)
                                {{$artkey==$anouncer_id ? $artname : ''}}
                            @endforeach
                        </li>
                        @endforeach
                        <li style="list-style:none;font-weight:bold;">
                            অফিস সহায়ক
                        </li>
                        @foreach($presentation_data[$key]['officer_assistent'] as $anouncer_id)
                        <li>
                            @foreach($artist_info as $artkey => $artname)
                                {{$artkey==$anouncer_id ? $artname : ''}}
                            @endforeach
                        </li>
                        @endforeach
                        <li style="list-style:none;font-weight:bold;">
                            ডিউটি অফিসার
                        </li>
                        @foreach($presentation_data[$key]['duty_officer'] as $anouncer_id)
                        <li>
                            @foreach($artist_info as $artkey => $artname)
                                {{$artkey==$anouncer_id ? $artname : ''}}
                            @endforeach
                        </li>
                        @endforeach
                    </ul>
                </td>
                @endforeach
                @endif
            </tr>
        </tbody>
</table>
    <?php
//            echo "<pre>";
//        print_r($plan_info);
//        exit;
    ?>
@foreach($plan_info as $plan)
    @php
    $schedule = json_decode($plan->content);
    @endphp


   

        <table class="table-bordered table">

            <thead>
                    <tr>
                        <td class="width8per">সময়</td>
                        <td class="width15per">চাংক</td>
                        <td>অনুষ্ঠানের নাম/ বিবরন</td>
                        <td>স্থিতি</td>
                        <td class="width15per">মন্তব্য</td>
                        <td>রেকর্ড</td>
                        <td>ক্রমিক</td>
                    </tr>
                    <!-- <tr>
                    <th>সময়</th>
                    <th colspan="2">অনুষ্ঠানের টাইটেল</th>
                    </tr> -->
            </thead>
            
            <tbody>
                    @foreach($schedule as  $parentKey => $value)
                        <tr>
                            <td style="width:150px;">{{(!empty($value->time))?eng2bnNumber($value->time):''}}</td>
                            <td>
                                <?php echo $value->chank; ?>
                            </td>
                            <td colspan="1">
                                   @php
                                       $program_info= get_schedule($plan->station_id,$plan->sub_station_id,
                                        $plan->date,$value->time);
                                   @endphp
                                @if($value->is_overwrite==true)
                                    {{ $value->overwrite_details}}
                                    @else
                                        @if(!empty($program_info))
                                           <a data-toggle="modal"
                                              data-target="#exampleModal3"
                                              onclick="programMagazineView('{{ $program_info->id }}')"  href="#"> {{
                                           $program_info->program_name
                                           }}</a>
                                         @else
                                            {{ $value->biboron }}
                                         @endif
                                @endif
                            </td>
                            <td>
                                <?php echo (!empty($value->stability ))? eng2bnNumber($value->stability)." মিনিট":''
                                ; ?>
                            </td>

                            <td>
                                <?php echo $value->comment; ?>
                            </td>

                            <td>
                                <?php echo ($value->is_recorded==1) ? '<span class="glyphicon
                                glyphicon-ban-circle"></span>':
                                    ''; ?>
                            </td>
                            <td>
                                <?php echo $value->sorting; ?>
                            </td>
                        </tr>
                    @endforeach
            </tbody>

            <tfoot>
                    <tr>
                        <td colspan="7">
                        </td>
                    </tr>
            </tfoot>

        </table>


@endforeach

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
     aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-sm-6">
                    <h5 class="modal-title" id="exampleModalLabel3"> অনুষ্ঠানের খরচ প্রদান
                    </h5>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="clearfix"></div>

            </div>
            <div class="modal-body">
                <div id="magazine_view">

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>