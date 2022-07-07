<div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
        <button onclick="print_fun_landscape()"
                class="btn btn-warning btn-xs no-print" style="float:right;margin-top:5px;margin-right:5px;"><i
                    class="glyphicon glyphicon-print"></i>
            Print
        </button>
    </header>

    <div>
        <div class="widget-body no-padding">
            <div class="col-sm-12">
                <div class="col-sm-12" style="height: 10px;"></div>
                <table class="print_table-no-border " style="width:100%;border: 1px solid #fff !important;">
                    <tr>
                        <td    style="text-align: center;width:40%;border: 1px solid #fff!important" >
                            <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  </div>

                            <div style="font-size:14px;">{{ !empty($heading_info->name)?$heading_info->name:''
                                    }}</div>
                            <div style="font-size:14px;">{{ !empty($heading_info->address)?$heading_info->address:''
                                    }}</div>
                            <div style="font-size:14px;">{{ !empty($heading_info->fequencey_data)?$heading_info->fequencey_data:''
                                    }}</div>

                            <div class="clearfix"></div>
                            <span style="font-weight: bold;font-size:14px;"> {{ (!empty
                                    ($heading_fixed_data['title']))?
                                $heading_fixed_data['title']:'' }} </span>
                            <div class="clearfix"></div>
                            <span style="padding-left:10px;"> {{ (!empty($heading_fixed_data['date_range']))?
                                $heading_fixed_data['date_range']:'' }}</span>

                        </td>
                    </tr>
                </table>
                <table style="width:100%;border:1px solid #d0d0d0" rules="all" class="table table-bordered "
                       id="table-style">
                    <thead>
                        <tr>
                            <th style="width:10%;">নং</th>
                            <th nowrap>শিল্পীর নাম</th>
                            <th>ঠিকান</th>
                            <th nowrap>মোবাইল</th>
                            <th nowrap>প্রচার তাং</th>

                            <th nowrap> পূর্ববতী তাং</th>
                            <th nowrap="">পরবর্তী তাং</th>



                            <th nowrap>বুকিং সংখ্যা</th>
                            <th nowrap>মোট সম্মানী</th>
                            <th class="width5per">মন্তব্য</th>
                        </tr>
                    </thead>

                    <?php
                    $i = 1;
                    $total_amount = '0.00';
                    //echo "<pre>";
                    //  print_r($program_info);
                    if(!empty($program_info)) {
                    foreach ($program_info as $key=> $row) {
                    ?>
                    <tr>
                        <td>
                            {{ $row->presentation_identification_id }}
                        </td>
                        <td>
                            {{ $row->artist_name }}
                        </td>

                        <td>{{ $row->address }}</td>
                        <td>
                            <?php
                            if (!empty($row->artist_mobile)) {
                                $artist_mobile = !empty($row->artist_mobile) ? json_decode
                                ($row->artist_mobile, true) : '';
                                echo $artist_mobile[0];
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if (!empty($row->presentation_date)) {
                                echo  !empty($row->presentation_date) ?$row->presentation_date : '';
                            }
                            ?>
                        </td>
                        <td></td>
                        <td></td>

                        <td class="text-center">1</td>
                        <td class="text-right">
                            {{ $row->total_amount }}
                            @php
                                $total_amount+=$row->total_amount;
                            @endphp
                        </td>
                        <td></td>

                    </tr>
                    <?php } } ?>
                    <tr>
                        <th colspan="8" class="text-right">মোট ব্যয়</th>
                        <td colspan="2">{{ number_format($total_amount,
                        2,'.','') }}</td>
                    </tr>
                </table>
                <table style="width: 100%;margin-bottom: 20px;margin-top: 50px;" class="no-border">
                    <tr>

                        <td style="width:33%;text-align: center;" class="no-border"> <span style="border-top:1px solid #333;">সহকারী
                                পরিচালক</span>
                        </td>
                        <td style="width:33%;text-align: center;" class="no-border"><span style="border-top:1px solid #333;">উপ
                                পরিচালক</span></td>
                        <td style="width:33%;text-align: center;" class="no-border"><span style="border-top:1px solid #333;">আঞ্চলিক
                                পরিচালক</span></td>
                    </tr>
                </table>
            </div>

        </div>

