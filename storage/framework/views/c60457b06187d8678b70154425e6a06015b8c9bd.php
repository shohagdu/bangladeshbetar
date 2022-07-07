
<?php $__env->startSection('main_content_area'); ?>
    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <h2 class="no-print"> <?php echo e($page_title); ?></h2>
                <a href="<?php echo e(url('program_planning_approved')); ?>" class="btn btn-info btn-xs no-print "
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                    প্রস্তাব (Proposal)
                </a>
                <a href="<?php echo e(url('proposal_khata')); ?>" class="btn btn-primary btn-xs no-print"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-refresh"></i>
                    Refresh
                </a>

            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <?php echo Form::open(['url' => '', 'method' => 'post','id' => 'searchProposalInfoFrom',
                'class'=>'form-horizontal']); ?>

                        <div class="form-group no-print" >

                            <div class="col-md-2">
                                <label> কেন্দ্রের / ইউনিট নাম </label>
                                <select id="station_id"  required class="form-control" onchange="getSubStation(this.value)"  name="station_id">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($station_info)): ?>
                                        <?php $__currentLoopData = $station_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>


                                </select>

                            </div>
                            <div class="col-md-2">
                                <label> ফ্রিকোয়েন্সি </label>
                                <select id="sub_station_id" required class="form-control" name="fequency_id">
                                    <option value="">চিহ্নিত করুন</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label> শুরুর তারিখ </label>
                                <input type="text" value="<?php echo e(date('01-m-Y')); ?>" class="form-control
                                        datepicker"
                                       name="from_date">
                            </div>


                            <div class="col-md-2">
                                <label > শেষ তারিখ </label>
                                <input type="text" value="<?php echo e(date('d-m-Y')); ?>"  class="form-control
                                        datepicker" name="to_date">
                            </div>
                            <div class="col-md-3">
                                <label > অনুষ্ঠানের নাম </label>
                                <select name="program_name"  class="select2" id="program_name">
                                    <option value="">চিহ্নিত করুন</option>
                                    <?php if(!empty($all_program_name)): ?>
                                        <?php $__currentLoopData = $all_program_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="col-md-1" style="margin-top:22px;">
                                <button type="button" class="btn btn-success btn-sm"
                                        onclick="searchProposalInfo()"
                                        name="search_proposal"
                                ><i class="glyphicon glyphicon-search"></i> Search</button>
                            </div>
                        </div>

                        <?php echo Form::close(); ?>

                        <div id="form_output"></div>

                    </div>
                </div>
            </div>
        </div>
    </article>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("master_program", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>