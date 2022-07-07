<div class="col-sm-12">

    <?php echo Form::open(['url' => 'archive_book', 'method' => 'get','id' => 'searchPlanningInfoFrom',
'class'=>'form-horizontal']); ?>

    <br/>
    <button type="button" class="btn btn-info btn-xs" data-toggle="collapse" data-target="#demo"> অন্যান্য কলাম
        সমূহ
    </button>

    <audio controls id="player">
        <source id="audioSource" src="" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <br/>
    <div id="demo" class="collapse  <?php echo !empty($_GET['column']) ? 'in' : ''; ?>">
        <div class="form-group">
            <div class="col-md-12">
                <br/>
                <?php
                $extra_column = get_songit_extra_column();
                foreach($extra_column as $value => $title) {
                ?>
                <label class="checkbox-inline">
                    <input type="checkbox"
                           <?php echo e(!empty($_GET['column']) && in_array($value,$_GET['column']) ? 'checked' : ''); ?> name="column[]"
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
            <select id="station_id" class="select2"
                    name="station_id[]">
                <option value="">কেন্দ্র / ইউনিট</option>
                <option value="all">সকল ইউনিট</option>
                <?php if(!empty($station_info)): ?>
                    <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e(is_array(app('request')->input('station_id')) && in_array($key,app('request')->input('station_id'))?'selected':''); ?> value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </select>

        </div>

        <div class="col-md-3">

            <input type="hidden" name="archive_type" value="1"/>
            <?php
            $item_type = get_songit_item_key();
            foreach ($item_type as $key_id) {

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
                <option value="">সকল অনুসন্ধান আইটেম</option>
                <option <?php echo e(app('request')->input('item_type')==1?'selected':''); ?> value="1">
                    গানের প্রথম লাইন
                </option>
                <option <?php echo e(app('request')->input('item_type')==2?'selected':''); ?> value="2">
                    গানের নাম
                </option>
                <option <?php echo e(app('request')->input('item_type')==3?'selected':''); ?> value="3">
                    গানের প্রকার
                </option>
                <option <?php echo e(app('request')->input('item_type')==4?'selected':''); ?> value="4">
                    শিল্পী
                </option>
                <option <?php echo e(app('request')->input('item_type')==5?'selected':''); ?> value="5">
                    গীতিকার
                </option>
                <option <?php echo e(app('request')->input('item_type')==6?'selected':''); ?> value="6">
                    সুরকার
                </option>
                <option <?php echo e(app('request')->input('item_type')==7?'selected':''); ?> value="7">
                    ছায়াছবির নাম
                </option>
                <option <?php echo e(app('request')->input('item_type')==8?'selected':''); ?> value="8">
                    গানের এ্যালবাম
                </option>
                <option <?php echo e(app('request')->input('item_type')==9?'selected':''); ?> value="9">
                    ব্যন্ড
                </option>
                <option <?php echo e(app('request')->input('item_type')==10?'selected':''); ?> value="10">
                    রেটিং
                </option>
            </select>
        </div>

        <div class="col-md-4">
            <input type="text" name="search_string" class="form-control"
                   value="<?php echo e(app('request')->input('search_string')?app('request')->input('search_string'):''); ?>"
                   placeholder="অনুসন্ধান তথ্য"/>
        </div>

        <div class="col-md-3">
            <button name="search" type="submit" class="btn btn-success btn-sm"
            ><i class="glyphicon glyphicon-search"></i> Search
            </button>
            <a href="<?php echo e(url('archive_book?archive_type=1')); ?>">
                <button type="button" class="btn btn-danger btn-sm"><i
                            class="glyphicon glyphicon-refresh"></i>
                    Refresh
                </button>
            </a>
            <button type="button" onclick="print_report()" class="btn btn-info btn-sm"><i
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

                                            <?php echo e(is_array(app('request')->input('station_id')) && count(app('request')->input('station_id'))  >0 ? get_name_by_ids('branch_infos',app('request')->input('station_id')) :''); ?>

                                            <a href="<?php echo e(empty(get_request_url('station_id'))?'সকল ইউনিট':get_request_url('station_id')); ?>">
                                                <i style="color:darkred" class="fa fa-close"></i>
                                            </a>
                                        </span>
        <?php }  ?>

        <?php

        foreach($item_type as $key_id) {
        if(!empty($_GET[get_songit_key_name($key_id)]) || (!empty($_GET['item_type']) && $_GET['item_type'] == $key_id && (!empty($_GET['search_string']))) ) {
        ?>
        <span class="badge">
                                                <?php echo e(get_songit_key_text($key_id)); ?>

            <?php
            foreach(array_unique($_REQUEST[get_songit_key_name($key_id)]) as $index  =>  $value) {
            echo $value;
            ?>
                                                <a href="<?php echo e(get_request_url(get_songit_key_name($key_id),$index)); ?>">
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
<div class="row">
    <div class="col-md-5">
        <ul style="float:left;margin-top:13px;" class="breadcrumb">
            <li>সর্বমোট সংখ্যা : <b><?php echo e($archive_list->total()); ?></b> </li>
            <li>বর্তমান পেজ: <b><?php echo e($archive_list->currentPage()); ?></b></li>
            <li>প্রতি পেজ:  <select onchange="submitForm()" name="per_page">
                    <?php $dropdown = per_page_dropdown();
                    foreach($dropdown as $item) {
                    ?>
                    <option <?php echo e(app('request')->input('per_page')==$item?'selected':''); ?> value="<?php echo $item; ?>"><?php echo $item; ?></option>
                    <?php
                    }
                    ?>
                </select></li>
        </ul>
    </div>
    <div  class="col-md-7">
        <div style="float:right;">
            <?php echo e($archive_list->appends($_GET)->links()); ?>

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
                    <th>প্রকার</th>
                    <th>শিল্পী</th>
                    <th>গীতিকার</th>
                    <th>সুরকার</th>


                    <th>স্থিতি</th>
                    <th>আইডি</th>
                    <th>স্ট্যটাস</th>
                    <?php
                    if (!empty($_GET['column'])) {
                        foreach ($_GET['column'] as $value) {
                            echo "<th>" . get_songit_column_title($value) . "</th>";
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
                $song_info = json_decode($row->songit_info);
                $film_info = $song_info->film_info;
                ?>
                <tr>
                    <td>
                        <?php echo $song_info->first_line ?>
                    </td>

                    <td>
                        <?php
                        $category_info = get_name_by_id('archive_category', ['id' => $song_info->category]);
                        echo $category_info->name;
                        ?>
                    </td>
                    <td>
                        <?php echo e(!empty($song_info->artist)  ? get_shilpi_name_by_ids($song_info->artist) : ''); ?>

                    </td>
                    <td>
                        <?php echo e(!empty($song_info->gitikar)  ? get_shilpi_name_by_ids($song_info->gitikar) : ''); ?>

                    </td>

                    <td>
                        <?php echo e(!empty($song_info->surokar)  ? get_shilpi_name_by_ids($song_info->surokar) : ''); ?>

                    </td>

                    <td>
                        <?php echo e(!empty($song_info->stability)  ? $song_info->stability : ''); ?>

                    </td>
                    <td>
                        <?php echo $song_info->id ?>
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

                    <?php
                    if (!empty($_GET['column'])) {
                        foreach ($_GET['column'] as $value) {
                            echo "<td>";
                            if ($value == 'sub_category') {
                                echo !empty($song_info->sub_category) ? get_name_by_id('archive_category', ['id' => $song_info->sub_category])->name : '';
                            } elseif ($value == 'film_director') {
                                echo !empty($film_info->film_director) ? get_shilpi_name_by_ids($film_info->film_director) : '';
                            }
                            elseif ($value == 'film_actors') {
                                echo !empty($film_info->film_actors) ? get_shilpi_name_by_ids($film_info->film_actors) : '';
                            }
                            elseif ($value == 'rating') {
                                echo !empty($song_info->rating) ? $song_info->rating : '';
                            }
                            elseif ($value == 'film_name') {
                                echo !empty($film_info->film_name)  ? $film_info->film_name : '';
                            }
                            elseif ($value == 'band_id') {
                                echo !empty($song_info->band_id) ? get_name_by_id('archive_band', ['id' => $song_info->band_id])->name : '';
                            }
                            elseif ($value == 'album_id') {
                                echo !empty($song_info->album_id) ? get_name_by_ids('archive_albam', $song_info->album_id) : '';
                            }
                            elseif ($value == 'name') {
                                echo !empty($song_info->name) ? $song_info->name : '';
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
                           onClick="audioAction('<?php echo e(get_file_path($row->id)); ?>',<?php  echo $row->id; ?>);">
                            <i class="fa fa-play"></i></a>
                        <a title="View" class="btn btn-info btn-xs"
                           href="<?php echo e(url('archive_item_view/'.$row->id)); ?>">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="javascript:void(0)" data-toggle="modal"
                           onclick="correction_message_modal(<?php echo $row->id; ?>)"
                           data-target="#correction_entry_modal" title="Need Correction"
                           class="btn btn-warning btn-xs"><i class="fa fa-repeat"></i></a>
                        <a href="<?php echo e(url('archive_item_download/'.$row->id)); ?>" title="Download"
                           class="btn btn-success btn-xs">
                            <i class="fa fa-download"></i>
                        </a>

                        <a href="javascript:void(0)" onclick="addToPlaylist(<?php echo e($row->id); ?>);"
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
                <?php echo e($archive_list->appends($_GET)->links()); ?>

            </div>
        </div>
    </div>
</div>

<?php echo Form::close(); ?>