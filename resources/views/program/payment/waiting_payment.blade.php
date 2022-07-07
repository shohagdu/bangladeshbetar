@extends("master_program")
@section('title_area')
    :: {{ $page_title }}  ::
@endsection
@section('show_message')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert" style="margin-bottom:10px; ">
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
                <h2>{{ $page_title }}</h2>

                <a href="{{ url('waiting_payment') }}" class="btn btn-primary btn-xs"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-refresh"></i>
                    Refresh
                </a>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        {!! Form::open(['url' => '', 'method' => 'post','id' => 'searchPendingPaymentInfoForm',
                'class'=>'form-horizontal']) !!}
                        <div class="form-group">
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
                                        onclick="searchPendingPaymentInfo()"
                                        name="search_proposal"
                                ><i class="glyphicon glyphicon-search"></i> Search</button>
                            </div>


                        </div>
                        {!! Form::close() !!}
                        <div id="form_output">
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
                </div>
            </div>
        </div>
    </article>
@endsection