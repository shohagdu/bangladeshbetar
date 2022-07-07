<!DOCTYPE html>
<html lang="en-us">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <script>
        var base_url = '<?php echo url('');?>';
    </script>
    <title> <?php echo $__env->yieldContent('title_area'); ?> </title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo e(asset('fontView')); ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo e(asset('fontView')); ?>/assets/css/font-awesome.min.css">
    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo e(asset('fontView')); ?>/assets/css/smartadmin-production-plugins.min.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo e(asset('fontView')); ?>/assets/css/smartadmin-production.min.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo e(asset('fontView')); ?>/assets/css/smartadmin-skins.min.css">

    <!-- SmartAdmin RTL Support  -->
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo e(asset('fontView')); ?>/assets/css/smartadmin-rtl.min.css">
    <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo e(asset('fontView')); ?>/assets/css/demo.min.css">
    <!-- FAVICONS -->
    <link rel="shortcut icon" href="<?php echo e(asset('fontView')); ?>/assets/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo e(asset('fontView')); ?>/assets/img/favicon/favicon.ico" type="image/x-icon">
    <!-- GOOGLE FONT -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    <!-- Specifying a Webpage Icon for Web Clip -->
    <link rel="apple-touch-icon" href="<?php echo e(asset('fontView')); ?>/assets/img/splash/sptouch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(asset('fontView')); ?>/assets/img/splash/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120"
          href="<?php echo e(asset('fontView')); ?>/assets/img/splash/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152"
          href="<?php echo e(asset('fontView')); ?>/assets/img/splash/touch-icon-ipad-retina.png">

    <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Startup image for web apps -->
    <link rel="apple-touch-startup-image" href="<?php echo e(asset('fontView')); ?>/assets/img/splash/ipad-landscape.png"
          media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="<?php echo e(asset('fontView')); ?>/assets/img/splash/ipad-portrait.png"
          media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="<?php echo e(asset('fontView')); ?>/assets/img/splash/iphone.png"
          media="screen and (max-device-width: 320px)">
    <!--- For Yajra Datatable----start--->
    <script src="<?php echo e(asset('fontView')); ?>/assets/yajra_datatable/js/jquery.min.js"></script>
    <script src="<?php echo e(asset('fontView')); ?>/assets/yajra_datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('fontView')); ?>/assets/yajra_datatable/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo e(asset('fontView')); ?>/assets/yajra_datatable/css/dataTables.bootstrap.min.css"/>
    <!--- For Yajra Datatable----end--->
    <link rel="stylesheet" href="<?php echo e(asset('fontView')); ?>/assets/modules/css/custom.css">
</head>


<body data-ng-app="myApp" class="">

<!-- HEADER -->
<?php echo $__env->make('template.include.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- END HEADER -->

<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<?php echo $__env->make('template.include.left_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- END NAVIGATION -->

<!-- MAIN PANEL -->
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <span class="ribbon-button-alignment">
            <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh" rel="tooltip"
                  data-placement="bottom"
                  data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings."
                  data-html="true">
                <i class="fa fa-refresh"></i>
            </span>
        </span>

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><a href="<?php  echo asset('/home');?>">Dashboard</a></li>
            <li><?php echo $__env->yieldContent('title_area'); ?></li>
        </ol>

    </div>
    <!-- END RIBBON -->

    <!-- MAIN CONTENT -->

    <div id="content">
        <div class="col-sm-12">
            <?php echo $__env->yieldContent('show_message'); ?>
        </div>

        <div class="col-sm-12" style="margin-bottom:30px;">
            <div class="row">
                <?php echo $__env->yieldContent('main_content_area'); ?>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN PANEL -->

<!-- PAGE FOOTER -->
<div class="page-footer">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <span class="txt-color-white no-print">  All right reserved at 2019-<?php echo date('Y') ?>.  Design &
                Developed By <span class="hidden-xs">  <a href="http://www.betar.gov.bd/"
                                               target="_blank">Bangladesh Betar</a> </span></span>
        </div>
        <div class="col-xs-6 col-sm-6 text-right hidden-xs">
            <div class="txt-color-white inline-block">
            </div>
        </div>
    </div>
</div>

<!--================================================== -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }'
        src="<?php echo e(asset('fontView')); ?>/assets/js/plugin/pace/pace.min.js"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->

<script>
    if (!window.jQuery) {
        document.write("<script src='<?php echo e(asset("fontView")); ?>/assets/js/libs/jquery-2.1.1.min.js'><\/script>");
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="assets/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
    }
</script>

<!-- IMPORTANT: APP CONFIG -->
<script src="<?php echo e(asset('fontView')); ?>/assets/js/app.config.js"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="<?php echo e(asset('fontView')); ?>/assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="<?php echo e(asset('fontView')); ?>/assets/js/bootstrap/bootstrap.min.js"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="<?php echo e(asset('fontView')); ?>/assets/js/notification/SmartNotification.min.js"></script>

<!-- JARVIS WIDGETS -->
<script src="<?php echo e(asset('fontView')); ?>/assets/js/smartwidgets/jarvis.widget.min.js"></script>

<!-- EASY PIE CHARTS -->
<script src="<?php echo e(asset('fontView')); ?>/assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

<!-- SPARKLINES -->
<script src="<?php echo e(asset('fontView')); ?>/assets/js/plugin/sparkline/jquery.sparkline.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="<?php echo e(asset('fontView')); ?>/assets/js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!-- JQUERY MASKED INPUT -->
<script src="<?php echo e(asset('fontView')); ?>/assets/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="<?php echo e(asset('fontView')); ?>/assets/js/plugin/select2/select2.min.js"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="<?php echo e(asset('fontView')); ?>/assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

<!-- browser msie issue fix -->
<script src="<?php echo e(asset('fontView')); ?>/assets/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

<!-- FastClick: For mobile devices -->
<script src="<?php echo e(asset('fontView')); ?>/assets/js/plugin/fastclick/fastclick.min.js"></script>

<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->

<!-- Demo purpose only -->
<script src="<?php echo e(asset('fontView')); ?>/assets/js/demo.min.js"></script>
<!-- MAIN APP JS FILE -->
<script src="<?php echo e(asset('fontView')); ?>/assets/js/app.min.js"></script>
<script src="<?php echo e(asset('fontView')); ?>/assets/sweet_alert/sweetalert.min.js"></script>
<!-- Moduele js file JS FILE -->
<script src="<?php echo e(asset('fontView')); ?>/assets/modules/js/employee_info.js"></script>
<script src="<?php echo e(asset('fontView')); ?>/assets/modules/js/setup_info.js"></script>
<script src="<?php echo e(asset('fontView')); ?>/assets/modules/js/leave_info.js"></script>
<script src="<?php echo e(asset('fontView')); ?>/assets/modules/js/programInfo.js"></script>
<script src="<?php echo e(asset('fontView')); ?>/assets/modules/js/asset_info.js"></script>
<script src="<?php echo e(asset('fontView')); ?>/assets/modules/js/employee_payrole.js"></script>


<script src="<?php echo e(asset('fontView')); ?>/assets/time_picker/moment.min.js"></script>
<link rel="stylesheet" href="<?php echo e(asset('fontView')); ?>/assets/time_picker/bootstrap-datetimepicker.min.css">
<script src="<?php echo e(asset('fontView')); ?>/assets/time_picker/bootstrap-datetimepicker.min.js"></script>


</body>
</html>