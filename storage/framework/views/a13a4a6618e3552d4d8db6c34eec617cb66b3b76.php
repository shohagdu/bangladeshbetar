
<?php $__env->startSection('title_area'); ?>
    :: State Management :: Land Information   ::

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
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>Land Information </h2>

                <button type="button" data-toggle="modal" onclick="addLandInfo()" data-target="#exampleModal"
                        class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    Add New
                </button>

            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <table id="land_data" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th data-class="expand"> Land No</th>
                                <th data-class="expand"> Location</th>
                                <th data-class="expand"> Details</th>
                                <th data-class="expand"> Khotian No</th>
                                <th data-class="expand"> Dag No</th>
                                <th data-class="expand"> Muza No</th>
                                <th data-class="expand"> Quantity(কাঠা)</th>
                                <th data-class="expand"> Last Tax Pay</th>
                                <th data-class="expand"> Status</th>
                                <th data-hide="phone,tablet" style="width:120px;"> #</th>

                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </article>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title"></span></h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>
                <?php echo Form::open(['url' => '/save_land_info', 'method' => 'post', 'id' => 'land_info_form','class'=>'form-horizontal']); ?>

                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Land No</label>
                            <div class="col-md-4">
                                <input type="text" id="land_no" class="form-control" placeholder="Land No"  name="land_no">
                            </div>
                            <label class="col-md-2 control-label">Station Name</label>
                            <div class="col-md-4">
                                <select id="station_name" class="form-control"  name="station_name">
                                    <option value="">Select Branch</option>
                                    <?php if(!empty($branch_info)): ?>
                                        <?php $__currentLoopData = $branch_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>


                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Location</label>
                            <div class="col-md-10">
                                <textarea type="text" id="address" class="form-control" placeholder="Address"  name="address"></textarea>
                            </div>

                        </div>


                        <div class="form-group">

                            <label class="col-md-2 control-label">Details</label>
                            <div class="col-md-10">
                                <textarea type="text" id="details" class="form-control" placeholder="Details"  name="details"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Khotian(খতিয়ান) No</label>
                            <div class="col-md-4">
                                <input type="text" id="kotian_no" class="form-control" placeholder="Khotian(খতিয়ান) No"  name="kotian_no"/>
                            </div>
                            <label class="col-md-2 control-label">Dag(দাগ) No </label>
                            <div class="col-md-4">
                                <input type="text" id="dag_no" class="form-control" placeholder="Dag(দাগ) No"  name="dag_no"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Mouza(মৌজা) No</label>
                            <div class="col-md-4">
                                <input type="text" id="mouza" class="form-control" placeholder="Mouza(মৌজা) No"  name="mouza"/>
                            </div>
                            <label class="col-md-2 control-label">Zer(জের) No </label>
                            <div class="col-md-4">
                                <input type="text" id="zer_no" class="form-control" placeholder="Zer(জের) No"  name="zer_no"/>

                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label">Last of Pay Tax (কর) </label>
                            <div class="col-md-4">
                                <input type="text" id="land_tax_pay_dt" class="form-control datepickerinfo" placeholder="Last of Pay Tax (কর) No" value="<?php echo e(date('d-m-Y')); ?>"  name="land_tax_pay_dt"/>
                            </div>
                            <label class="col-md-2 control-label">Land Quantity(কাঠা) </label>
                            <div class="col-md-4">
                                <input type="text" id="land_qty" class="form-control" placeholder="Land Quantity(কাঠা)"  name="land_qty"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Case(মামলা)</label>
                            <div class="col-md-4">
                                <select id="is_case" class="form-control"  name="is_case">
                                    <option value="1">No</option>
                                    <option value="2">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div id="case_info" style="display: none;">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Case Details</label>
                                <div class="col-md-10">
                                    <textarea id="case_details" class="form-control" placeholder="Case Details"  name="case_details"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Case Last Update</label>
                                <div class="col-md-10">
                                    <textarea id="case_last_update" class="form-control" placeholder="Case Last Update"  name="case_last_update"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Case Status</label>
                                <div class="col-md-4">
                                    <select id="case_status" class="form-control"  name="case_status">
                                        <option value="">Select</option>
                                        <option value="1">Pending</option>
                                        <option value="2">Complete</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <div class=" col-sm-7 text-left">
                        <span class="text-left" id="error_land_info"></span>
                    </div>
                    <div class=" col-sm-5">
                        <button type="button"  onclick="saveLandInfo()" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i>
                            Save
                        </button>
                        <button type="button" id="updateBtn"  onclick="saveLandInfo()" class="btn btn-success"><i
                                    class="glyphicon glyphicon-save"></i> Update
                        </button>
                        <button type="button"  class="btn btn-danger" data-dismiss="modal"><i
                                    class="glyphicon glyphicon-remove"></i> Close
                        </button>
                        <input type="hidden" name="land_id" id="land_id">
                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_state", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>