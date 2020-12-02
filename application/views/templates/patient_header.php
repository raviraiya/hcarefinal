<!--<!DOCTYPE html>







<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->



<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->



<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->



<!--[if (gte IE 9)|!(IE)]><!-->



<html lang="en" ng-app="hcare">



<!--<![endif]-->



<head>



<!-- Basic Page Needs







      ================================================== -->



<meta charset="utf-8">

<title>

<?php if(isset($title)){echo $title; }else {echo "Welcome To Hcare";} ?>

</title>



<!-- SEO Meta







      ================================================== -->



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



<!-- Mobile Specific Metas







      ================================================== -->



<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">



<!-- CSS







      ================================================== -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style1.css?preventcache=<?php echo time()?>">






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

<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap/css/jquery.timepicker.css" />-->

<link rel="stylesheet" href="<?php echo base_url()?>/assets/css/bootstrap-datepicker3.css"/>



<!--[if lt IE 9]>







    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>







    <![endif]-->



<!-- Favicons







        ================================================== -->



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



<script src="<?php echo base_url();?>assets/js/base.js"></script>

<script src="<?php echo base_url();?>assets/js/modernizr.custom.js"></script>



<!-- JS







        ================================================== -->



<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>



<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>-->



<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>assets/js/bootstrap-switch.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/main.js"></script>

<?php if(!isset($owl_version)) { ?>

<script src="<?php echo base_url();?>assets/js/owl.carousel.js"></script>

<?php } else { ?>

<script src="<?php echo base_url();?>assets/js/owl.carousel.1.3.js"></script>

<?php } ?>

<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>



<!--    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>-->



<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui-range-slider.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/main.js"></script>



<!-- Angular JS work -->



<script src="<?php echo base_url();?>assets/angular/angular.js"></script>

<?php if(isset($angular_js_file1)) {







        ?>

<script src="<?php echo base_url();?>assets/angular/script/<?php echo $angular_js_file1;?>"></script>

<?php } ?>

<?php if(!isset($angular_js_file)) {







    ?>

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

<script src="<?php echo base_url();?>assets/js/appointment.js"></script>

<script src="<?php echo base_url();?>assets/js/validator.js"></script>

<script src="<?php echo base_url();?>assets/js/formValidations.js"></script>

<script src="<?php echo base_url();?>assets/js/bootstrap-tagsinput.min.js"></script>

<script src="<?php echo base_url();?>assets/js/bootbox.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>/assets/js/fancybox/jquery.fancybox.js"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>

<script src="<?php echo base_url();?>assets/bootstrap/js/jquery.timepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.knob.min.js"></script>

<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>



    <script> 

       var baseUrl ="<?php echo base_url();?>";

   </script>



</head>



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
          <div class="logo"><a href="#"><img src="<?php echo base_url();?>assets/images/logo.png" /></a></div>
        </div>
        <div class="col-md-10 container_padding_none">
          <div class="header_search_left">
            <div class="header_search_box"> <a href="#" class="search_button"><i class="fa fa-search"></i></a>
              <input class="header_search_input" placeholder="Search..." />
            </div>
            <div class="header_top_right"> <span>Welcome <?php echo $this->session->userdata("name");?></span> <img src="<?php echo base_url();?>assets/images/header_top_right_img.png" /> <a href="#" class="header_top_right_img"><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></a>
              <div class="header_top_right_menu">
                <ul>
                  <!--<li><a href="#">Profile</a></li>-->
                  <li><a href="#">Notificaiton</a></li>
                  <!--<li><a href="#">Setting</a></li>-->
                  <li><a href="<?php echo base_url()?>patient/account">Account</a></li>
                  <li><a href="<?php echo base_url();?>logout">Logout</a></li>
                </ul>
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
          <div class="left_sidebar_border left_sidebar_menu_new">
            <div class="responsive_menu_icon_bg"><a href="javascript:void(0)" class="responsive_menu">Menu</a> </div>
            <div class="left_sidebar_patient_menu">
                <ul class="left_sidebar_patient_menu_ul">
            <li class="dashboard_menu_icon active"><a href="<?php echo base_url();?>patient">Dashboard</a></li>
<!--            <li class="find_a_lab_menu"><a href="#">FIND A LAB</a></li>-->
            <li class="find_a_procedure_menu"><a href="<?php echo base_url();?>patient/search">find a procedure</a></li>
            <li class="appointments_menu"><a href="<?php echo base_url();?>patient/appointment">APPOINTMENTS</a></li>
<!--            <li class="prescription_menu"><a href="#">Prescription</a></li>-->
<!--            <li class="medical_history_menu"><a href="#">Medical History</a></li>-->
            <li class="reviews_menu"><a href="<?php echo base_url();?>patient/review">REVIEWS</a></li>
<!--            <li class="messages_menu"><a href="#">MESSAGES</a><span>13</span></li>-->
        </ul>
            </div>
            <div class="left_footer_logo"> <img src="<?php echo base_url();?>assets/images/left_footer_logo.png" /> </div>
          </div>
        </div>




