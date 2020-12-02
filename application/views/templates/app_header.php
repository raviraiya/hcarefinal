<!--<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en" ng-app="hcare">
  <!--<![endif]-->
  <head>
    <!-- Basic Page Needs    ================================================== -->
    <meta charset="utf-8">
    <title>
    <?php if(isset($title)){echo $title; }else {echo "Welcome To Hcare";} ?>
    </title>
    <!-- SEO Meta     ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="distribution" content="global">
    <meta name="revisit-after" content="2 Days">
    <meta name="robots" content="ALL">
    <meta name="rating" content="8 YEARS">
    <meta name="Language" content="en-us">
    <meta http-equiv="reply-to" content="">
    <meta name="GOOGLEBOT" content="NOARCHIVE">
    <!-- Mobile Specific Metas     ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS     ================================================== -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css?preventCache=<?php echo time() ?>">
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/homephysian.css"> -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/loader.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-switch.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/highlight.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/js/fancybox/jquery.fancybox.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap/css/jquery.timepicker.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/css/bootstrap-datepicker3.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-toogle.css">
    <!--[if lt IE 9]>
       <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
       <![endif]-->
    <!-- Favicons    ================================================== -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.html">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.html">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.html">
    <!--[if gte IE 9]>
       <style type="text/css">
           .gradient {
               filter: none;
           }
       </style>
       <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/ns-default.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/ns-style-growl.css" />
    <!-- JS       ================================================== -->
    <script src="<?php echo base_url();?>assets/js/base.js"></script>
    <script src="<?php echo base_url();?>assets/js/modernizr.custom.js"></script>    
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>-->
    <script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-switch.js"></script>
    <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/js/main.js"></script> -->
    <?php if(!isset($owl_version)) { ?>
      <script src="<?php echo base_url();?>assets/js/owl.carousel.js"></script>
    <?php } else { ?>
      <script src="<?php echo base_url();?>assets/js/owl.carousel.1.3.js"></script>
    <?php } ?>
    <!--    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui-range-slider.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/main.js"></script>
    <!-- Angular JS work -->
    <script src="<?php echo base_url();?>assets/angular/angular.js?preventCache=<?php echo time() ?>"></script>
    <?php if(isset($angular_js_file1)) {  ?>
      <script src="<?php echo base_url();?>assets/angular/script/<?php echo $angular_js_file1;?>"></script>
    <?php } ?>
    <?php if(!isset($angular_js_file)) {   ?>
      <script src="<?php echo base_url();?>assets/angular/script/app.js"></script>
    <?php } else { ?>
      <script src="<?php echo base_url();?>assets/angular/script/<?php echo $angular_js_file; ?>"></script>
    <?php } ?>
    <script src="<?php echo base_url();?>assets/angular/node_modules/angular-animate/angular-animate.js"></script>
    <script src="<?php echo base_url();?>assets/angular/node_modules/angular-aria/angular-aria.js"></script>
    <script src="<?php echo base_url();?>assets/angular/node_modules/angular-material/angular-material.js"></script>
    <script src="<?php echo base_url();?>assets/angular/node_modules/imgpreview/angular-media-preview.min.js"></script>
    <!-- Angular Js work end -->
    <script src="<?php echo base_url();?>assets/js/comman.js?preventCache=<?php echo time() ?>"></script>
    <script src="<?php echo base_url();?>assets/js/common.js?preventCache=<?php echo time() ?>"></script>
    <script src="<?php echo base_url();?>assets/js/appointment.js?preventCache=<?php echo time() ?>"></script>
    <script src="<?php echo base_url();?>assets/js/validator.js"></script>
    <script src="<?php echo base_url();?>assets/js/formValidations.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootbox.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>/assets/js/fancybox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.timepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.knob.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-toogle.js"></script>
    <!--    <script src="--><?php //echo base_url();?>
    <!--/assets/js/common.js"></script>-->
  </head>
  <body>
    <!-- loader start -->
    <div id="loading">
      <div id="loading-center">
        <div id="loading-center-absolute">
          <div class="object" id="object_one"></div>
          <div class="object" id="object_two"></div>
          <div class="object" id="object_three"></div>
          <div class="object" id="object_four"></div>
        </div>
      </div>
    </div>
    <!-- loader End --> 
    <!-- HEADER START -->
    <header>
      <div class="header">
        <div class="container-fluid container_padding_none">
          <div class="row">
            <div class="col-md-2 container_padding_none">
              <div class="logo">
                <a href="#">
                  <div><img src="<?php echo base_url();?><?php echo $this->session->userdata("hospital_logo");?>"/></div>
                </a>
              </div>
              <a href="javascript:void(0)" class="responsive_menu"></a> 
            </div>
            <div class="col-md-10 container_padding_none">
              <div class="header_search_left">
                <div class="header_search_box"> 
                  <a href="#" class="search_button"><i class="fa fa-search"></i></a>
                  <input class="header_search_input" placeholder="Search..." />
                </div>
                <!-- <button id="notification-trigger" class="progress-button">
                                 <span class="content">Show Notification</span>
                                 <span class="progress"></span>
                             </button>-->
                <div class="header_top_right"> 
                  <span>Welcome <span class="specialist_name">Dr. <?php echo $this->session->userdata("name");?></span></span> 
                  <img src="<?php echo base_url();?>assets/images/header_top_right_img.png" /> 
                  <div href="#" class="header_top_right_img">
                    <i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i>
                    <div class="header_top_right_menu">
                      <ul>
                        <li><a href="<?php echo base_url();?>specialist/settings">Profile</a></li>
                        <li><a href="#">Notificaiton</a></li>
                        <li><a href="<?php echo base_url();?>specialist/account">Account</a></li>
                        <li><a href="<?php echo base_url();?>/logout">Logout</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
    </header>
    <!-- HEADER END --> 
    <!-- CONTAINER START -->
    <section>
      <div class="content">
        <div class="container-fluid container_padding_none">
          <div class="row">
            <div class="col-md-2 container_padding_none">
              <div class="left_sidebar_border">
                <ul class="left_sidebar_menu">
                  <li class="dashboard_menu_icon currentmenu"><a href="<?php echo base_url(); ?>specialist">Dashboard</a></li>
                  <li class="procedure_menu_icon"><a href="<?php echo base_url(); ?>specialist/procedure">PROCEDURE</a></li>
                  <li class="patients_menu_icon"><a href="<?php echo base_url(); ?>specialist/patients">PATIENTS</a></li>
                  <li class="appointments_menu_icon"><a href="<?php echo base_url(); ?>specialist/appointment">APPOINTMENTS</a></li>
                  <li class="hospital_menu_icon"><a href="<?php echo base_url(); ?>specialist/hospital">HOSPITAL</a></li>
                  <li class="staff_menu_icon"><a href="<?php echo base_url(); ?>specialist/staff">STAFF</a></li>
                  <li class="reviews_menu_icon"><a href="<?php echo base_url(); ?>specialist/review">REVIEWS</a></li>
                  <!-- <li class="reports_menu_icon"><a href="#">REPORTS</a></li>
                  <li class="messages_menu_icon"><a href="#">MESSAGES</a><span>13</span></li> -->
                </ul>
                <!--<div class="left_sidebar_buttom1">
                 <div class="left_sidebar_emergency">
                   <h1>Emergency</h1>
                   <p>2 shot and jnured, coming in on 1st floor. Please make sure clients are not in the way. Thanks for your patience.</p>
                 </div>
                 <div class="left_sidebar_cancel">
                   <h1>Cancel</h1>
                   <p><strong>Sam Smith</strong> Cancled his recent appointment for 4:30.</p>
                  </div>
                </div>-->
                <div class="left_footer_logo"> 
                  <img src="<?php echo base_url();?>assets/images/left_footer_logo.png" /> 
                </div>
              </div>
            </div> 