<div class="col-sm-12">
    {!! Form::open(['url' => 'archive_book', 'method' => 'get','id' => 'searchPlanningInfoFrom',
'class'=>'form-horizontal']) !!}
    <br/>
    <button type="button" class="btn btn-info btn-xs" data-toggle="collapse" data-target="#demo">অন্যান্য কলাম
        সমূহ
    </button>

    <audio  controls id="player">
        <source id="audioSource" src="" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <br/>

    <div id="demo" class="collapse <?php echo !empty($_GET['column']) ? 'in' : ''; ?>">
        <div class="form-group">
            <div class="col-md-12">
                <br/>
                <?php
                $extra_column = get_kobita_extra_column();
                foreach($extra_column as $value => $title) {
                ?>
                <label class="checkbox-inline">
                    <input type="checkbox"
                           {{  !empty($_GET['column']) && in_array($value,$_GET['column']) ? 'checked' : '' }} name="column[]"
                           value="<?php echo $value ?>"><?php echo $title ?>
                </label>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <br/>

    <div class="form-group">

        <div class="col-md-2">
            <select id="station_id"  class="select2" onchange="getSubStation(this.value)"
                    name="station_id[]">
                <option value="">কেন্দ্র / ইউনিট</option>
                <option value="all">সকল ইউনিট</option>
                @if(!empty($station_info))
                    @foreach($station_info as $key=>$value)
                        <option {{ is_array(app('request')->input('station_id')) && in_array($key,app('request')->input('station_id'))?'selected':'' }} value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                @endif
            </select>

        </div>

        <div class="col-md-2">

            <input type="hidden" name="archive_type" value="2"/>
            <?php
            $item_type = get_kobita_item_key();

            foreach ($item_type as $key_id) {
                if ((isset($_GET['item_type']) && $_GET['item_type'] == $key_id) || isset($_GET[get_kobita_key_name($key_id)])) {

                    if (empty($_GET[get_kobita_key_name($key_id)])) {
                        $_REQUEST[get_kobita_key_name($key_id)] = [];
                    }
                    if (isset($_REQUEST['search']) && ($_GET['item_type'] == $key_id && (!empty($_GET['search_string'])))) {
                        $_REQUEST[get_kobita_key_name($key_id)][] = $_GET['search_string'];
                    }
                    if (!empty($_REQUEST[get_kobita_key_name($key_id)])) {
                        foreach (array_unique($_REQUEST[get_kobita_key_name($key_id)]) as $key => $value) {
                            echo '<input type="hidden" name="' . get_kobita_key_name($key_id) . '[]" value="' . $value . '"/>';
                        }
                    }
                }
            }

            ?>
            <select class="form-control" name="item_type">
                <option value="">অনুসন্ধান আইটেম</option>
                <?php  $search_item = kobita_search_item()  ?>
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
            <a href="{{ url('archive_book?archive_type=2') }}">
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

        foreach($item_type as $key_id) {
            if(!empty($_GET[get_kobita_key_name($key_id)]) || (!empty($_GET['item_type']) && $_GET['item_type'] == $key_id && (!empty($_GET['search_string']))) ) {
            ?>
        <span class="badge">
                                                {{ get_kobita_key_text($key_id)  }}
            <?php
            foreach(array_unique($_REQUEST[get_kobita_key_name($key_id)]) as $index  =>  $value) {
            echo $value;
            ?>
                                                <a href="{{ get_request_url(get_kobita_key_name($key_id),$index)  }}">
                                                    <i style="color:darkred" class="fa fa-close"></i>
                                                </a>
                                                <?php
            }

            ?>

                                            </span>
        <?php } }  ?>


    </div>

</div>

<br/>
<div class="row">
    <div class="col-md-5">
        <ul style="float:left;margin-top:13px;" class="breadcrumb">
            <li>সর্বমোট সংখ্যা : <b>{{ $archive_list->total() }}</b> </li>
            <li>বর্তমান পেজ: <b>{{$archive_list->currentPage()}}</b></li>
            <li>প্রতি পেজ:  <select onchange="submitForm()" name="per_page">
                    <?php $dropdown = per_page_dropdown();
                    foreach($dropdown as $item) {
                    ?>
                    <option {{ app('request')->input('per_page')==$item?'selected':'' }} value="<?php echo $item; ?>"><?php echo $item; ?></option>
                    <?php
                    }
                    ?>
                </select></li>
        </ul>
    </div>
    <div  class="col-md-7">
        <div style="float:right;">
            {{ $archive_list->appends($_GET)->links() }}
        </div>

    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table id="dt_archive_" class="table table-striped table-bordered table-hover"
                   width="100%">
                <thead>
                <tr>
                    <th>প্রথম লাইন</th>
                    <th>রচয়িতা</th>
                    <th>আবৃতিকার</th>
                    <th>গল্প পাঠক</th>
                    <th>স্থিতি</th>
                    <th>আইডি</th>
                    <th>স্ট্যটাস</th>
                    <?php
                    if (!empty($_GET['column'])) {
                        foreach ($_GET['column'] as $value) {
                            echo "<th>" . get_kobita_column_title($value) . "</th>";
                        }
                    }
                    ?>
                    <th style="width: 130px"> পদক্ষেপ</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($archive_list)) {
                    foreach($archive_list as $row) {
                        $item_info = json_decode($row->kobita_info);
                        ?>
                     <tr>
                         <td>{{ !empty($item_info->first_line) ? $item_info->first_line :'' }}</td>
                         <td>
                             {{ !empty($item_info->rochoyita)  ? get_shilpi_name_by_ids($item_info->rochoyita) : ''  }}
                         </td>
                         <td>
                             {{ !empty($item_info->abritikar)  ? get_shilpi_name_by_ids($item_info->abritikar) : ''  }}
                         </td>
                         <td>
                             {{ !empty($item_info->golpo_pathok)  ? get_shilpi_name_by_ids($item_info->golpo_pathok) : ''  }}
                         </td>
                         <td>{{ !empty($item_info->stability) ? $item_info->stability :'' }}</td>
                         <td>{{ !empty($item_info->id) ? $item_info->id :'' }}</td>
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

                         <?php
                         if (!empty($_GET['column'])) {
                             foreach ($_GET['column'] as $value) {
                                 echo "<td>";
                                 if ($value == 'rating') {
                                     echo !empty($item_info->rating) ? $item_info->rating : '';
                                 }
                                 elseif ($value == 'type_id') {
                                     echo !empty($item_info->type_id) ? get_name_by_ids('archive_archiveing_type', $item_info->type_id) : '';
                                 }
                                 elseif ($value == 'name') {
                                     echo !empty($item_info->name) ? $item_info->name : '';
                                 }
                                 elseif ($value == 'station_id') {
                                     echo !empty($row->station_id) ? get_name_by_id("branch_infos",['id'=>$row->station_id])->name : '';
                                 }

                                 elseif ($value == 'created_by') {
                                     echo !empty($row->created_by) ? get_name_by_id("employees",['id'=>$row->created_by])->emp_name : '';
                                 }

                                 elseif ($value == 'created_at') {
                                     echo !empty($row->created_at) ? date("Y-m-d h:i:a",strtotime($row->created_at)) : '';
                                 }

                                 echo "</td>";
                             }
                         }
                         ?>


                         <td>
                             <a href="javascript:void(0)" title="Play"
                                class="btn btn-primary btn-xs playbtn"
                                id="<?php echo "btn" . $row->id ?>"
                                onClick="audioAction('{{get_file_path($row->id)}}',<?php  echo $row->id; ?>);">
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
            <div style="float:right;">
                {{ $archive_list->appends($_GET)->links() }}
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}