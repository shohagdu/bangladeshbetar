<div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
        <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>

        <h2><span class="no-print">{{ $page_title }}  </span></h2>

        <button onclick="print_fun()"
                class="btn btn-warning btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                    class="glyphicon glyphicon-print"></i>
            Print
        </button>
    </header>

    <div>
        <div class="widget-body no-padding">
            <div class="col-sm-12">
                <div class="col-sm-12" style="height: 10px;"></div>
                {!! Form::open(['url' => '', 'method' => 'post','id' => 'makePaymentProgramForm',
             'class'=>'form-horizontal']) !!}
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
                    </tr>

                    <?php
                    $i = 1;
                    $total_amount = '0.00';
                    if(!empty($program_info)) {
                    foreach ($program_info as $key=> $row) {
                    ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="program_id[{{ $row->id }}]" id="program_planning_info_id_{{
                            $row->id }}">
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
                            <textarea rows="1" class="form-control" name="payment_comments[{{$row->id }}]"
                                       id="payment_comments_{{
                            $row->id
                            }}"></textarea>
                        </td>

                    </tr>
                    <?php } } ?>
                    <tr>
                        <th colspan="8" class="text-right">মোট ব্যয়</th>
                        <td colspan="2">{{ number_format($total_amount,
                        2,'.','') }}</td>
                    </tr>
                    <tr>
                        <td colspan="10">
                            <button id="make_payment" type="button"  onclick="makePaymentProgram()" class="btn btn-success btn-sm">
                                <i class="glyphicon
                            glyphicon-forward"></i> Make Payment</button>
                        </td>
                    </tr>
                </table>
                {!! Form::close() !!}
                <div id="form_output_make_payment"></div>

            </div>

        </div>

