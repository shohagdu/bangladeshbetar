<?php $__env->startSection('title_area'); ?>
    ::  Months Setup  ::

<?php $__env->stopSection(); ?>
<?php $__env->startSection('show_message'); ?>
    <?php echo e(Session::get('message')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content_area'); ?>
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2> Months Setup </h2>

                <button type="button"data-toggle="modal" onclick="addData()" data-target="#exampleModal" class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                    Add New
                </button>

            </header>

            <!-- widget div-->
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        
                            
                                
                                    
                                        
                                        
                                            
                                                
                                            
                                        
                                    
                                
                            
                        

                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th style="width:5%;">SL</th>
                                <th> Fiscal Year</th>
                                <th> Months Name</th>
                                <th> Start Date</th>
                                <th> End Date</th>
                                <th> Modify Last Date</th>
                                <th> Status </th>
                                <th> Sorting</th>
                                <th style="width: 10%"> #</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i=1;
                            ?>
                            <?php $__currentLoopData = $monthly_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>  <?php echo e($i++); ?></td>

                                    <td>  <?php echo e($singleData->fiscal_year_title); ?></td>
                                    <td>  <?php echo e($singleData->title); ?></td>
                                    <td>  <?php echo e(date('d-m-Y',strtotime($singleData->start_date))); ?></td>
                                    <td>  <?php echo e(date('d-m-Y',strtotime($singleData->end_date))); ?></td>
                                    <td>  <?php echo e(date('d-m-Y',strtotime($singleData->modify_last_date))); ?></td>
                                    <td>  <?php echo e(($singleData->status==1)?"Running":(($singleData->status==2)?"Previous":"Next")); ?></td>
                                    <td>  <?php echo e($singleData->sorting); ?></td>
                                    <td>
                                        <button type="button"data-toggle="modal" data-target="#exampleModal" onclick='updateData("<?php echo e($singleData->id); ?>","<?php echo e($singleData->title); ?>","<?php echo e(date('d-m-Y',strtotime($singleData->start_date))); ?>","<?php echo e(date('d-m-Y',strtotime($singleData->end_date))); ?>","<?php echo e(date('d-m-Y',strtotime($singleData->modify_last_date))); ?>","<?php echo e($singleData->status); ?>","<?php echo e($singleData->sorting); ?>","<?php echo e($singleData->fiscal_year_id); ?>" )' class="btn btn-primary btn-xs">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </button>
                                        <a href="<?php echo e(url('/delete_montly_open/'. $singleData->id  )); ?>" onclick="return confirm('Are you want to delete this record')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </a>
                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                          <!--  
                            
                                
                                    
                                
                                
                                    
                                
                            
                            -->
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>
    <script>

        function addData() {
            $("#monthly_opning")[0].reset();
            $("#title").val('');
            $("#start_date").val('');
            $("#end_date").val('');
            $("#changeLastDate").val('');
            $("#status_log").val('');
            $("#position").val('');
            $("#setting_id").val('');
            $("#updateBtn").hide();
            $("#saveBtn").show();
        }
        function updateData(id,title,start_date,end_date,last_modification,status_log,position,fiscal_year) {
            $("#monthly_opning")[0].reset();
            $("#fiscal_year").val(fiscal_year);
            $("#title").val(title);
            $("#start_date").val(start_date);
            $("#end_date").val(end_date);
            $("#changeLastDate").val(last_modification);
            $("#status_log").val(status_log);
            $("#position").val(position);
            $("#setting_id").val(id);


            $("#updateBtn").show();
            $("#saveBtn").hide();
        }
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-8">
                          <h5 class="modal-title" id="exampleModalLabel">Months Entry </h5>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php echo Form::open(['url' => '/save_montly_open', 'id'=>'monthly_opning', 'method' => 'post','class'=>'form-horizontal']); ?>

                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">


                        <div class="form-group">
                            <label class="col-md-4 control-label"> Fiscal Year</label>
                            <div class="col-md-8">
                                <select type="text"  id="fiscal_year" class="form-control"  required  name="fiscal_year">
                                    <option value="">Select</option>
                                    <?php if($get_fiscal_year): ?>
                                        <?php $__currentLoopData = $get_fiscal_year; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"> Months Name</label>
                            <div class="col-md-8">
                                <input type="text"  id="title" class="form-control" placeholder="Months Name" required value="" name="title"/>

                            </div>
                        </div>




                        <div class="form-group">
                            <label class="col-md-4 control-label">Start Date
                            </label>
                            <div class="col-md-8">
                                <input type="text"  id="start_date" class="form-control datepickerLong" placeholder="Start Date" readonly required value="" name="start_date"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">End Date
                            </label>
                            <div class="col-md-8">
                                <input type="text"  id="end_date" class="form-control datepickerLong" placeholder="End Date" readonly required value="" name="end_date"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Modify Last Date
                            </label>
                            <div class="col-md-8">
                                <input type="text"  id="changeLastDate" class="form-control datepickerLong" placeholder="Modify Last Date" readonly required value="" name="changeLastDate"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"> Status</label>
                            <div class="col-md-8">
                                <select  id="status_log" class="form-control" required name="status">
                                    <option value="">Select</option>
                                    <option value="1">Running</option>
                                    <option value="2">Previous</option>
                                    <option value="3">Next</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Sorting </label>
                            <div class="col-md-8">
                                <input type="text"  id="position" class="form-control" placeholder="পজিশন(Sorting)" required value="" name="position"/>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">

                    <button type="submit" name="saveBtn" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Save </button>
                    <button type="submit" name="updateBtn" id="updateBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i>Close</button>
                    <input type="hidden" name="setting_id" id="setting_id">

                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_hr", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>