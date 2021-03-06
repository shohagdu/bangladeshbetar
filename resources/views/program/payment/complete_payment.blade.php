@extends("master_program")
@section('main_content_area')
    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2 class="no-print">{{ $page_title }}</h2>

                <a href="{{ url('complete_payment') }}" class="btn btn-primary btn-xs"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-refresh"></i>
                    Refresh
                </a>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12 " >
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        {!! Form::open(['url' => '', 'method' => 'post','id' => 'searchCompletePaymentInfoForm',
                'class'=>'form-horizontal']) !!}
                        <div class="form-group no-print">
                            <label class="col-md-2 control-label"> From Date </label>
                            <div class="col-md-3">
                                <input type="text" value="{{ date('01-m-Y')  }}" class="form-control
                                        datepicker"
                                       name="from_date">
                            </div>
                            <label class="col-md-2 control-label"> To Date </label>
                            <div class="col-md-3">
                                <input type="text" value="{{ date('d-m-Y')  }}"  class="form-control
                                        datepicker" name="to_date">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success btn-sm"
                                        onclick="searchCompletePaymentInfo()"
                                        name="search_proposal"
                                ><i class="glyphicon glyphicon-search"></i> Search</button>
                            </div>


                        </div>
                        {!! Form::close() !!}
                        <div id="form_output">
                            <div class="col-sm-12">
                                <table class="print_table-no-border "  id="table-style" style="width:100%;border: 1px solid #fff
                    !important;">
                                    <tr>
                                        <td  style="text-align: center;width:40%;border: 1px solid #fff !important;
                                padding-bottom:20px !important;" >
                                            <img src = "{{ url('images/logo/logo.jpg') }}" style="height:50px; margin:0px;
                                    padding:0px;"/>
                                            <div style="font-size:15px;font-weight: bold;">?????????????????????????????????????????? ???????????????????????? ???????????????  </div>
                                            <div style="font-size:15px;font-weight: bold;"> ???????????????????????? ???????????????  </div>
                                            <b><u>{{ $page_title }} </u></b>
                                        </td>
                                    </tr>
                                </table>
                                <table style="width:100%;border:1px solid #d0d0d0" rules="all" class="table table-bordered "
                                       id="table-style">
                                    <tr>
                                        <th style="width:3%;">#</th>
                                        <th style="width:5%;">??????</th>
                                        <th>????????????????????? ?????????</th>
                                        <th style="width:20%;">???????????????</th>
                                        <th>??????????????????</th>
                                        <th>???????????????????????? ?????????</th>
                                        <th>???????????????????????? ????????????</th>
                                        <th>????????????????????? ??????</th>
                                        <th > ?????????????????????</th>
                                        <th style="width: 10%">?????????????????????</th>
                                        <th style="width: 10%">???????????????????????? ????????????</th>
                                        <th style="width: 5%">????????????</th>
                                    </tr>

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
                                        <td>
                                            <a href="{{ url('payment/pdf/vouchar.php?id='.sha1($row->id)) }}"
                                               target="_blank" class="btn btn-primary btn-xs"><i
                                                        class="glyphicon glyphicon-print"></i> ????????????</a>
                                        </td>

                                    </tr>
                                    <?php } } ?>
                                    <tr>
                                        <th colspan="8" class="text-right">????????? ????????????</th>
                                        <td colspan="3">{{ number_format($total_amount,
                        2,'.','') }}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection