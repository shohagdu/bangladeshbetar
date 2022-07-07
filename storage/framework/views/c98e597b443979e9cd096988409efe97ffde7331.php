<?php $__env->startSection('title_area'); ?>
    :: <?php echo e($page_title); ?>  ::
<?php $__env->stopSection(); ?>
<?php $__env->startSection('show_message'); ?>
    <?php if(Session::has('message')): ?>
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert"
             style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo e(Session::get('message')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content_area'); ?>
    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2><?php echo e($page_title); ?></h2>
                <a href="<?php echo e(url('archive_playlist_create')); ?>" class="btn btn-info btn-xs"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-plus"></i>
                    New Playlist
                </a>
            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;">
                            <input type="hidden" id="playlist_id" name="playlist_id" value="<?php //echo $active_playlist->playlist_id ?>"/>
                        </div>
                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>কেন্দ্র</th>
                                    <th>প্লে লিস্ট</th>
                                    <th>পরিকল্পনাকারী</th>
                                    <th>আইটেম সংখ্যা </th>
                                    <th>স্ট্যটাস</th>
                                    <th>তৈরির সময়</th>
                                    <th style="width: 130px"> #</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(!empty($playlist)) {
                                foreach($playlist as $row) { ?>
                                <tr class="<?php echo  $row->status==1 && $row->active_user==$current_user?'success':'' ?>">
                                <td>
                                    <?php echo $row->station_name; ?>
                                </td>
                                <td>
                                    <?php echo $row->name ?>
                                </td>
                                <td>
                                    <?php echo $row->emp_name ?>
                                </td>
                                <td>
                                    <?php echo empty($row->item_info)?0:count(json_decode($row->item_info,true)) ?>
                                </td>
                                <td>
                                    <?php if( $row->status==0 ) { ?>
                                    <span  style="cursor: pointer" onclick="playListStatus(<?php echo $row->id.','.$row->status; ?>)" class="label label-danger">Inactive</span>
                                    <?php
                                    }
                                    elseif(($row->status==1) && ($row->active_user==$current_user)) {
                                    ?>
                                    <span  style="cursor: pointer" onclick="playListStatus(<?php echo $row->id.','.$row->status; ?>)" class="label label-<?php echo $row->status==1?'success':'danger' ?>"><?php echo $row->status==1?'Active':'Inactive'; ?></span>
                                    <?php } else { ?>
                                        <span  class="label label-success">Active another</span>
                                    <?php  } ?>
                                </td>
                                <td>
                                    <?php echo date("Y-m-d H:i:A",strtotime($row->created_time)); ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(url('edit_playlist/'.$row->id)); ?>"
                                       class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="<?php echo e(url('donwloadMultipleFile/'.$row->id)); ?>">
                                        <button class="btn btn-info btn-xs" title="Download"><i class="fa fa-download"></i></button>
                                    </a>
                                    <a href="<?php echo e(url('play_playlist/'.$row->id)); ?>">
                                        <button class="btn btn-success btn-xs" title="Play"><i class="fa fa-play"></i></button>
                                    </a>

                                    <a href="<?php echo e(url('view_playlist/'.$row->id)); ?>" class="btn btn-primary btn-xs" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button class="btn btn-danger btn-xs" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
                                </td>
                                </tr>
                                <?php 
                                }
                            }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:40%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel4">  রেকডিং তথ্য
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
                    <form action="" method="post" id="broadcast_form">

                        <div class="checkbox">
                            <label><input type="checkbox" id="is_recorded" name="is_recorded" onclick="is_recorded_check(this);"> রেকর্ড সম্পন্ন হয়েছে ?</label>
                           <div class="col-sm-12" style="height: 20px;"></div>
                            <input type="text" class="form-control datepickerLong" placeholder="রেকর্ড তারিখ" name="record_complete_date" id="record_complete_date"/>
                        </div>
                        <br/>

                        <div class="modal-footer">
                            <div class=" col-sm-7 text-left">
                                <span class="text-left" id="form_output"></span>
                            </div>
                            <div class=" col-sm-5">

                                <button type="button" id="broadcastbtn" class="btn
                                btn-success" onclick="saveBroadcastInfo();"><i
                                            class="glyphicon glyphicon-save"></i> Save
                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                            class="glyphicon glyphicon-remove"></i> Close
                                </button>
                                <input type="hidden" value="" name="programid" id="programid">
                                <input type="hidden" value="" name="record_date" id="record_date">
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_archive", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>