<?php $__env->startSection('title_area'); ?>
    :: User Information   ::

<?php $__env->stopSection(); ?>
<?php $__env->startSection('show_message'); ?>
    <?php if(Session::has('message')): ?>
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert" style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo e(Session::get('message')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content_area'); ?>
    <article class="col-sm-12 col-md-12 col-lg-12">

        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2><?php echo e(($type==1)?'User':'Customer'); ?> Information  </h2>
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
                                <th> Name</th>
                                <th> Mobile</th>
                                <th> Email</th>
                                <th style="width: 120px"> #</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i=1;
                            ?>
                            <?php $__currentLoopData = $user_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>  <?php echo e($i++); ?></td>
                                    <td>  <?php echo e($singleData->name); ?></td>
                                    <td>  <?php echo e($singleData->mobile); ?></td>
                                    <td>  <?php echo e($singleData->email); ?></td>
                                    <td>
                                        <button type="button"data-toggle="modal" data-target="#exampleModal" onclick="updateData('<?php echo e($singleData->id); ?>','<?php echo e($singleData->name); ?>','<?php echo e($singleData->mobile); ?>','<?php echo e($singleData->email); ?>','<?php echo e(''); ?>','<?php echo e($singleData->employee_id); ?>')" class="btn btn-primary btn-xs">
                                            <i class="glyphicon glyphicon-pencil"></i> Update
                                        </button>
                                        <button type="button" title="Impersonate"  onclick="impersonateUserAccount('<?php echo e($singleData->id); ?>')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-share-alt"></i> Access </button>
                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>
    <script>

        function updateData(id,name,mobile,email,address,employee_id) {
            $("#name").val(name);
            $("#mobile").val(mobile);
            $("#email").val(email);
            $("#address").val(address);


            $("#setting_id").val(id);
            $("#employee_id").val(employee_id);
            $('#form_output').html('');
            $("#saveBtn").hide();
            $("#updateBtn").show();
            $("#heading-title").html('Update ')

        }

      function createUser() {
          $.ajax({
              type: "POST",
              url: "<?php  echo url('/save_user_customer_info');?>",
              data: $('form').serialize(),
              'dataType': 'json',
              success: function (response) {
                 if(response.status=='error'){
                     $('#form_output').html("<div class='alert alert-danger'>"+response.message+"</div>");
                 }else {
                     var data = response.message;
                     if (data.error.length > 0) {
                         var error_html = '';
                         for (var count = 0; count < data.error.length; count++) {
                             error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                         }
                         $('#form_output').html(error_html);
                     } else {
                         $('#exampleModal').modal().hide();
                         $('#formData')[0].reset();
                         $('#form_output').html('');
                         swal({
                             text: data.success,
                             icon: "success",
                         }).then(function () {
                             location.reload();
                             // $('#dt_basic').DataTable();
                         });
                     }
                 }
              }
          });
      }

        function impersonateUserAccount(id) {
            swal({
                title: "Are you sure?",
                text: "Impersonate in this user access",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: "<?php  echo url('/delete_user_customer_info')?>",
                            data: {id: id},
                            'dataType': 'json',
                            success: function (response) {
                                if (response.status == 'success') {
                                    swal({
                                        text: response.message,
                                        icon: "success",
                                    }).then(function() {
                                        location.reload();
                                    });

                                } else {
                                    swal(response.message, {
                                        icon: "warning",
                                    });
                                }
                            }
                        });
                    } else {
                        swal("Cancelled Now!");
                    }
                });
        }

    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="float: left" id="exampleModalLabel"><span id="heading-title"></span> Update Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="clearfix"></div>
                </div>
                <div class="col-sm-12" >
                        <div id="form_output"></div>
                </div>
                <?php echo Form::open(['url' => '/save_user_customer_info', 'id' => 'formData', 'method' => 'post','class'=>'form-horizontal']); ?>

                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Employee ID </label>
                            <div class="col-md-9">
                                <input type="text" readonly  id="employee_id" class="form-control" placeholder="Name" required value="" name="employee_id"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Employee Name </label>
                            <div class="col-md-9">
                                <input type="text" readonly id="name" class="form-control" placeholder="Name" required value="" name="name"/>

                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-3 control-label">Mobile </label>
                            <div class="col-md-9">
                                <input type="text" readonly id="mobile" class="form-control" placeholder="Mobile" required value="" name="mobile"/>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Login Access</label>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> Email</label>
                            <div class="col-md-9">
                                <input type="text" readonly  id="email" class="form-control" placeholder="Email" required value="" name="email"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">New Password</label>
                            <div class="col-md-9">
                                <input type="password"  id="password" class="form-control" placeholder="New Password"  value="" name="password">

                            </div>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="createUser()" id="updateBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
                    <input type="hidden" name="setting_id" id="setting_id">
                    <input type="hidden" name="type" value="<?php echo e($type); ?>" id="type">
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_hr", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>