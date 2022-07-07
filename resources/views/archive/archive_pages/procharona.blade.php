<div class="col-sm-12">

    {!! Form::open(['url' => 'archive_book', 'method' => 'get','id' => 'searchPlanningInfoFrom',
'class'=>'form-horizontal']) !!}
    <br/>
    <button type="button" class="btn btn-info btn-xs" data-toggle="collapse" data-target="#demo">অন্যান্য কলাম
        সমূহ
    </button>

    <audio controls id="player">
        <source id="audioSource" src="" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <br/>

    <div id="demo" class="collapse">
        <div class="form-group">
            <div class="col-md-12">
                <br/>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_first_line" value="1">রেটিং
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_name" value="">স্থিতি
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_name" value="">আঙ্গিক
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_name" value="">মন্ত্রণালয়
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_name" value="">দপ্তর
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_name" value="">শিল্পী
                </label>
            </div>
        </div>
    </div>
    <br/>
    <div class="form-group">

        <div class="col-md-2">
            <select id="station_id" required class="select2" onchange="getSubStation(this.value)"
                    name="station_id[]">
                <option value="">কেন্দ্রের / ইউনিট নাম</option>
                <option value="all">সকল ইউনিট</option>
                @if(!empty($station_info))
                    @foreach($station_info as $key=>$value)
                        <option {{ is_array(app('request')->input('station_id')) && in_array($key,app('request')->input('station_id'))?'selected':'' }} value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                @endif
            </select>

        </div>

        <div class="col-md-2">

            <input type="hidden" name="archive_type" value="8"/>
            <?php  $search_item = procharona_search_item();
            foreach ($search_item as $key_id => $name) {

                if ((isset($_GET['item_type']) && $_GET['item_type'] == $key_id) || isset($_GET[get_songit_key_name($key_id)])) {

                    if (empty($_GET[get_songit_key_name($key_id)])) {
                        $_REQUEST[get_songit_key_name($key_id)] = [];
                    }
                    if (isset($_REQUEST['search']) && ($_GET['item_type'] == $key_id && (!empty($_GET['search_string'])))) {
                        $_REQUEST[get_songit_key_name($key_id)][] = $_GET['search_string'];
                    }
                    if (!empty($_REQUEST[get_songit_key_name($key_id)])) {
                        foreach (array_unique($_REQUEST[get_songit_key_name($key_id)]) as $key => $value) {
                            echo '<input type="hidden" name="' . get_songit_key_name($key_id) . '[]" value="' . $value . '"/>';
                        }
                    }
                }
            }

            ?>

            <select class="form-control" name="item_type">
                <option value="">অনুসন্ধান আইটেম</option>
                <?php  $search_item = procharona_search_item()  ?>
                @foreach($search_item as $key => $name)
                    <option {{ app('request')->input('item_type')==$key?'selected':'' }} value="{{$key}}">
                        {{$name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <input type="text" name="search_string" class="form-control"
                   value="{{ app('request')->input('search_string')?app('request')->input('search_string'):'' }}"
                   placeholder="অনুসন্ধান তথ্য"/>
        </div>

        <div class="col-md-4">
            <button name="search"  type="submit" class="btn btn-success btn-sm"
            ><i class="glyphicon glyphicon-search"></i> Search
            </button>
            <a href="{{ url('archive_book?archive_type=8') }}">
                <button type="button"  class="btn btn-danger btn-sm"><i
                            class="glyphicon glyphicon-refresh"></i>
                    Refresh
                </button>
            </a>
            <button type="button" onclick="print_report()"  class="btn btn-info btn-sm"><i
                        class="glyphicon glyphicon-print"></i>
                Print
            </button>
        </div>

    </div>

    {!! Form::close() !!}

</div>



<div class="row">

    <div class="col-sm-12">
        <?php if(!empty($_GET['station_id'])) { ?>
        <span class="badge">
                                            কেন্দ্রঃ
                                            {{ is_array(app('request')->input('station_id')) && count(app('request')->input('station_id'))  >0 ? get_name_by_ids('branch_infos',app('request')->input('station_id')) :'' }}
                                            <a href="{{  get_request_url('station_id')   }}">
                                                <i style="color:darkred" class="fa fa-close"></i>
                                            </a>
                                        </span>
        <?php }  ?>

        <?php

        foreach($search_item as $key_id => $name) {
        if(!empty($_GET[get_songit_key_name($key_id)]) || (!empty($_GET['item_type']) && $_GET['item_type'] == $key_id && (!empty($_GET['search_string']))) ) {
        ?>
        <span class="badge">
                                                {{ get_songit_key_text($key_id)  }}
            <?php
            foreach(array_unique($_REQUEST[get_songit_key_name($key_id)]) as $index  =>  $value) {
            echo $value;
            ?>
                                                <a href="{{ get_request_url(get_songit_key_name($key_id),$index)  }}">
                                                    <i style="color:darkred" class="fa fa-close"></i>
                                                </a>
                                                <?php
            }

            ?>

                                            </span>
        <?php } } ?>


    </div>
</div>
<br/>
<div class="col-sm-12">
    <table id="dt_archive" class="table table-striped table-bordered table-hover"
           width="100%">
        <thead>
        <tr>
            <th>কেন্দ্র</th>
            <th>প্রথম লাইন</th>
            <th>বিষয়</th>
            <th>বেতার কেন্দ্র</th>
            <th>স্ট্যাটাস</th>
            <th>সংরক্ষণকারী</th>
            <th>সংরক্ষণ টাইম</th>
            <th style="width: 130px"> পদক্ষেপ</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($archive_list)) {
            foreach($archive_list as $row) {
                ?>

        <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>
