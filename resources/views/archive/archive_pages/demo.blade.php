<div class="col-sm-12">
   
    {!! Form::open(['url' => 'archive_book', 'method' => 'get','id' => 'searchPlanningInfoFrom',
'class'=>'form-horizontal']) !!}
    <button type="button" class="btn btn-info btn-xs" data-toggle="collapse" data-target="#demo">সংগীতের অন্যান্য কলাম সমূহ</button>
    <br/>
    <div id="demo" class="collapse">
        <div class="form-group">
            <div class="col-md-12">
                {{--                                                <label>টেবিলের কলাম নির্বাচন করুন</label>--}}
                <br/>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_first_line" value="1">গানের উপ প্রকার
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_name" value="">শিল্পী
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_name" value="">গীতিকার
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_name" value="">সুরকার
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_name" value="">রেটিং
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_name" value="">ব্যন্ড
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_name" value=""> এ্যালবাম
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_name" value="">ছায়াছবির নাম
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_name" value="">ছায়াছবির পরিচালক
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="song_name" value="">অভিনিত শিল্পী
                </label>
            </div>
        </div>
    </div>
    <br/>
    <div class="form-group">

        <div class="col-md-2">
            <label> কেন্দ্রের / ইউনিট নাম </label>
            <select id="station_id" required class="select2" onchange="getSubStation(this.value)"
                    name="station_id[]">
                <option value="">চিহ্নিত করুন</option>
                @if(!empty($station_info))
                    @foreach($station_info as $key=>$value)
                        <option {{ is_array(app('request')->input('station_id')) && in_array($key,app('request')->input('station_id'))?'selected':'' }} value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                @endif
            </select>

        </div>

        <div class="col-md-2">

            <input type="hidden" name="archive_type" value="1"/>
            <?php
            $item_type = [
                1,2,3,4,5,6,7,8,9,10
            ];
            foreach($item_type as $key_id){

                if(  ( isset($_GET['item_type']) && $_GET['item_type']==$key_id  )  || isset($_GET[get_songit_key_name($key_id)]) ) {

                    if(empty($_GET[get_songit_key_name($key_id)])) {
                        $_REQUEST[get_songit_key_name($key_id)] = [];
                    }
                    if( isset($_REQUEST['search']) && ( $_GET['item_type']==$key_id && (!empty($_GET['search_string'])) ) ) {
                        $_REQUEST[get_songit_key_name($key_id)][] = $_GET['search_string'];
                    }
                    if(!empty($_REQUEST[get_songit_key_name($key_id)])) {
                        foreach(array_unique($_REQUEST[get_songit_key_name($key_id)]) as $key => $value) {
                            echo '<input type="text" name="'.get_songit_key_name($key_id).'[]" value="'.$value.'"/>';
                        }
                    }
                }
            }

            ?>

            <label> অনুসন্ধান আইটেম </label>
            <select class="form-control" name="item_type">
                <option value="">বাছাই করুন</option>
                <option {{ app('request')->input('item_type')==1?'selected':'' }} value="1">
                    গানের প্রথম লাইন
                </option>
                <option {{ app('request')->input('item_type')==2?'selected':'' }} value="2">
                    গানের নাম
                </option>
                <option {{ app('request')->input('item_type')==3?'selected':'' }} value="3">
                    গানের প্রকার
                </option>
                <option {{ app('request')->input('item_type')==4?'selected':'' }} value="4">
                    শিল্পী
                </option>
                <option {{ app('request')->input('item_type')==5?'selected':'' }} value="5">
                    গীতিকার
                </option>
                <option {{ app('request')->input('item_type')==6?'selected':'' }} value="6">
                    সুরকার
                </option>
                <option {{ app('request')->input('item_type')==7?'selected':'' }} value="7">
                    ছায়াছবির নাম
                </option>
                <option {{ app('request')->input('item_type')==8?'selected':'' }} value="8">
                    গানের এ্যালবাম
                </option>
                <option {{ app('request')->input('item_type')==9?'selected':'' }} value="9">
                    ব্যন্ড
                </option>
                <option {{ app('request')->input('item_type')==10?'selected':'' }} value="10">
                    রেটিং
                </option>
            </select>
        </div>

        <div class="col-md-5">
            <label> অনুসন্ধান তথ্য </label>
            <input type="text" name="search_string"  class="form-control"
                   value="{{ app('request')->input('search_string')?app('request')->input('search_string'):'' }}"
                   placeholder="এখানে লিখুন"/>
        </div>

        <div class="col-md-3">
            <label></label>
            <button name="search" style="margin-top:22px" type="submit" class="btn btn-success btn-sm"
            ><i class="glyphicon glyphicon-search"></i> Search
            </button>
            <a href="{{ url('archive_book') }}">
                <button type="button" style="margin-top:22px"  class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-refresh"></i>
                    Refresh
                </button>
            </a>
        </div>

    </div>




</div>
{!! Form::close() !!}


<div class="row">

    <div class="col-sm-8">
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

        foreach($item_type as $key_id) {
        if(!empty($_GET[get_songit_key_name($key_id)]) || ( !empty($_GET['item_type']) &&  $_GET['item_type']==$key_id && (!empty($_GET['search_string']))  ) ) {
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
    <div class="col-sm-4">
        <audio style="float:right;margin-right:20px;" controls id="player">
            <source id="audioSource" src="" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
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
            <th>নাম</th>
            <th>প্রকার</th>
            <th>বেতার কেন্দ্র</th>
            <th>স্ট্যাটাস</th>
            <th>সংরক্ষণকারী</th>
            <th>আর্কাইভ টাইম</th>
            <th style="width: 130px"> পদক্ষেপ</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($archive_list)) {
        foreach($archive_list as $row) {
        $song_info = json_decode($row->songit_info);
        ?>
        <tr>
            <td>
                {{  get_name_by_id('branch_infos',['id'=>$row->station_id])->name }}
            </td>
            <td>
                <?php echo $song_info->first_line ?>
            </td>
            <td>
                <?php echo $song_info->name ?>
            </td>
            <td>
                <?php
                $category_info = get_name_by_id('archive_category', ['id' => $song_info->category]);
                echo $category_info->name;
                ?>
            </td>

            <td>
                <?php echo $row->sadin_bangla_betar == 0 ? 'NO' : 'YES' ?>
            </td>
            <td style="font-weight:bold;color:<?php echo $row->status == 0 ? 'red' : 'green'; ?>">
                <?php
                if($row->status == 0) {
                ?>
                <span style="cursor: pointer;color:darkred"
                      onclick="changeStatus(<?php echo $row->id ?>,1)">ইন একটিভ</span>
                <?php
                }
                else {
                ?>
                <span style="cursor: pointer;color:green"
                      onclick="changeStatus(<?php echo $row->id ?>,0)">একটিভ</span>
                <?php
                }
                ?>
            </td>
            <td>{{  get_name_by_id('employees',['id'=>$row->created_by])->emp_name }}</td>
            <td><?php echo date("Y-m-d H:i:a", strtotime($row->created_at)) ?></td>
            <td>

                <a href="javascript:void(0)" title="Play"
                   class="btn btn-primary btn-xs playbtn"
                   id="<?php echo "btn" . $row->id ?>"
                   onClick="audioAction('<?php  echo $song_info->file_directory . '/' . $song_info->file_name; ?>',<?php  echo $row->id; ?>);">
                    <i class="fa fa-play"></i></a>
                <a title="View" class="btn btn-info btn-xs"
                   href="{{ url('archive_item_view/'.$row->id) }}">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="javascript:void(0)" data-toggle="modal"
                   onclick="correction_message_modal(<?php echo $row->id; ?>)"
                   data-target="#correction_entry_modal" title="Need Correction"
                   class="btn btn-warning btn-xs"><i class="fa fa-repeat"></i></a>
                <a href="{{ url('archive_item_download/'.$row->id) }}" title="Download"
                   class="btn btn-success btn-xs">
                    <i class="fa fa-download"></i>
                </a>

                <a href="javascript:void(0)" onclick="addToPlaylist({{ $row->id  }});"
                   title="Add to playlist" class="btn btn-info btn-xs">
                    <i class="fa fa-music"></i>
                </a>
            </td>
        </tr>
        <?php
        }
        }
        ?>
        </tbody>
    </table>
</div>
