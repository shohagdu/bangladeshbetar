<div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
        <span class="widget-icon no-print" > <i class="fa fa-check txt-color-green"></i> </span>

        <h2 class="no-print"><span class="no-print">{{ $page_title }}  </span></h2>

        <button onclick="print_fun_landscape()"
                class="btn btn-warning btn-xs no-print" style="float:right;margin-top:5px;margin-right:5px;"><i
                    class="glyphicon glyphicon-print"></i>
            Print
        </button>
    </header>

    <div>
        <div class="widget-body no-padding">
            <div class="col-sm-12">
                <table class="print_table-no-border "  id="table-style" style="width:100%;border: 1px solid #fff
                    !important;">
                    <tr>
                        <td  style="text-align: center;width:40%;border: 1px solid #fff !important;
                                padding-bottom:20px !important;" >
                            <img src = "{{ url('images/logo/logo.jpg') }}" style="height:50px; margin:0px;
                                    padding:0px;"/>
                            <div style="font-size:15px;font-weight: bold;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  </div>
                            <div style="font-size:15px;font-weight: bold;"> বাংলাদেশ বেতার  </div>
                            <b><u>{{ $page_title }} </u></b>
                        </td>
                    </tr>
                </table>
                <table style="width:100%;border:1px solid #d0d0d0" rules="all" class="table table-bordered "
                       id="table-style">
                    <tr>
                        <th style="width:3%;">#</th>
                        <th style="width:5%;">নং</th>
                        <th>শিল্পীর নাম</th>
                        <th style="width:20%;">ঠিকান</th>
                        <th>মোবাইল</th>
                        <th>ব্যাংকের নাম</th>
                        <th>ব্যাংকের শাখা</th>
                        <th>একাউন্ট নং</th>
                        <th > সম্মানী</th>
                        <th style="width: 10%">মন্তব্য</th>
                        <th style="width: 10%">পেমেনটের তথ্য</th>
                    </tr>

                    <?php
                    $i = 1;
                    $total_amount = '0.00';
                    if(!empty($program_info)) {
                    foreach ($program_info as $key=> $row) {
                    ?>
                    <tr>
                        <td>
                           {{ $i++ }}
                        </td>
                        <td>
                            {{ $row->program_identity }}
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

                        <td> {{!empty( $row->bank_name_title)?$row->bank_name_title:'' }} </td>
                        <td> {{!empty( $row->bank_branch_name)?$row->bank_branch_name:'' }} </td>
                        <td> {{!empty( $row->bank_account_no)?$row->bank_account_no:'' }} </td>
                        <td>
                            {{ $row->total_amount }}
                            @php
                                $total_amount+=$row->total_amount;
                            @endphp
                        </td>

                        <td>
                           {{ $row->payment_comments   }}
                        </td>
                        <td>
                           {{ !empty($row->payment_complete_date) ? date('d-m-Y h:i a',
                           strtotime($row->payment_complete_date)) :''  }}
                             {{ !empty($row->payment_complete_by) ? $employee_info[$row->payment_complete_by] :''  }}


                        </td>


                    </tr>
                    <?php } } ?>
                    <tr>
                        <th colspan="8" class="text-right">মোট ব্যয়</th>
                        <td colspan="3">{{ number_format($total_amount,
                        2,'.','') }}</td>
                    </tr>

                </table>
            </div>
        </div>

