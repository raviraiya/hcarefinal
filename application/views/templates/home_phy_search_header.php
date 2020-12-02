<!--<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>


    <!-- Basic Page Needs
      ================================================== -->
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
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
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/patient_procedure_search.css?preventCache=<?php echo time() ?>">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/loader.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-switch.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/highlight.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.fancybox.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-toogle.css">

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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/google_map_icon/css/map-icons.css">


    <script src="<?php echo base_url();?>assets/js/modernizr.custom.js"></script>
    <!-- JS
        ================================================== -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/base.js"></script>


   

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>


    <script type="text/javascript" src="<?php echo base_url();?>assets/js/main.js"></script>
    <script src="<?php echo base_url();?>assets/js/owl.carousel.1.3.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<!--    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui-range-slider.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/main.js"></script>
    <!-- Angular JS work -->
    <script src="<?php echo base_url();?>assets/angular/node_modules/angular/angular.js"></script>
    <?php if(!isset($angular_js_file)) {
    ?>
    <script src="<?php echo base_url();?>assets/angular/script/app.js"></script>
    <?php } else { ?>
        <script src="<?php echo base_url();?>assets/angular/script/<?php echo $angular_js_file; ?>"></script>
    <?php } ?>
    <script src="<?php echo base_url();?>assets/angular/component/classified.ctr.js"></script>
    <script src="<?php echo base_url();?>assets/angular/node_modules/angular-animate/angular-animate.js"></script>
    <script src="<?php echo base_url();?>assets/angular/component/classified.ctr.js"></script>
    <script src="<?php echo base_url();?>assets/angular/node_modules/angular-aria/angular-aria.js"></script>
    <script src="<?php echo base_url();?>assets/angular/node_modules/angular-material/angular-material.js"></script>
    <!-- Angular Js work end -->
    <script src="<?php echo base_url();?>assets/js/comman.js?preventCache=<?php echo time() ?>"></script>
    <script src="<?php echo base_url();?>assets/js/appointment.js"></script>
    <script src="<?php echo base_url();?>assets/js/validator.js"></script>
    <script src="<?php echo base_url();?>assets/js/formValidations.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootbox.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.fancybox.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-switch.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-toogle.js"></script>
    <script src="<?php echo base_url();?>assets/js/search.js?preventCache=<?php echo time() ?>"></script>
<!--    <script src="--><?php //echo base_url();?><!--assets/js/nouislider.js"></script>-->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCK-d21EqqSrl-c_IfTQIpXIiaHQrkR_ds"></script>
<!--    <script-->
<!--        src="http://maps.googleapis.com/maps/api/js">-->
<!--    </script>-->
<!--    <script src="--><?php //echo base_url();?><!--/assets/js/common.js"></script>-->
    <script>



    </script>
</head>

<?php
 $controller = $this->uri->segment(1);
  $method = $this->uri->segment(2);
?>
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
                    <div class="logo"><a href="#">

                      <div><img src="<?php echo base_url();?>/assets/images/logo.png"></div>

                      </a></div>
                    
                    <a href="#" class="responsive_menu">Open Menu</a>
                </div>
                <div class="col-md-10 container_padding_none">
                    <div class="header_search_left">
                        <div class="header_search_box"> <a href="#" class="search_button"><i class="fa fa-search"></i></a>
                            <input class="header_search_input" placeholder="Search..." />
                        </div>
                       <!-- <button id="notification-trigger" class="progress-button">
                            <span class="content">Show Notification</span>
                            <span class="progress"></span>
                        </button>-->
                        <div class="header_top_right"> <span>Welcome Dr. <?php echo $this->session->userdata("name");?></span>
                            <img src="<?php echo base_url();?>assets/images/header_top_right_img.png" /> <a href="#" class="header_top_right_img"><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></a>
                        
                        <div class="header_top_right_menu">
                                  <ul>

                                    <li><a href="#">Profile</a></li>

                                    <li><a href="#">Notificaiton</a></li>

                                    <li><a href="#">Setting</a></li>

                                    <li><a href="<?php echo base_url();?>/logout">Logout</a></li>

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
                <?php
                if($controller == 'patient' || $method == 'search'){?>
                    <div class="col-md-2 container_padding_none">
                        <div class="left_sidebar_border">
                            <div class="responsive_menu_icon_bg"><a href="#" class="responsive_menu">Menu</a> </div>
                            <div class="left_sidebar_patient_menu">
                                 <ul class="left_sidebar_patient_menu_ul">
                                  <li class="dashboard_menu_icon currentmenu"><a href="<?php echo base_url(); ?>homephysician">Dashboard</a>  </li>

                                  <li class="patients_menu_icon"><a href="<?php echo base_url(); ?>homephysician/patients">PATIENTS</a></li>

                                  <li class="appointments_menu_icon"><a href="<?php echo base_url(); ?>homephysician/appointment">APPOINTMENTS</a></li>

                                  <li class="reviews_menu_icon"><a href="<?php echo base_url(); ?>homephysician/patient_invite">Invite</a></li>

                                  <li class="reviews_menu_icon"><a href="<?php echo base_url(); ?>homephysician/review">REVIEWS</a></li>

                                </ul>
                            </div>
                            <?php
                            $attribute = array('id' => 'search_prc','data-validate' => 'parsley');
                            echo form_open('patient/search', $attribute); ?>
                            <div class="left_sidebar_patient_filter">
                                <h2>Filter</h2>

                                <div class="left_sidebar_patient_filter_padding">
                                    <div class="left_sidebar_patient_filter_price">
                                        <h3>Price</h3>
                                        <div class="layout-slider" style="width: 100%">
                                            <div id="nights_div"></div>
                                            <div class="away_div_min">
                                                <div class="Away2_left"> $
                                                    <div id="nights"></div>
                                                </div>
                                                <div class="Away3_right"> $
                                                    <div id="nights1"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="left_sidebar_patient_filter_price_input">
                                            <div class="left_sidebar_patient_filter_price_input_lefts min-value-style"> <span>Min.</span>
                                                <input type= "text" name ="min_price" id ="minprcValue"/>
                                            </div>

                                            <div class="left_sidebar_patient_filter_price_input_rights  max_value_style"> <span>Max.</span>
                                                <input type= "text" name ="max_price" class ="maxprcValue" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="left_sidebar_patient_filter_padding">
                                    <div class="left_sidebar_patient_filter_menu">
                                        <h3>Weekday</h3>
                                        <div class="btn-group btn-group1 navecation navecation1"  data-toggle="buttons">
                                                <label class="btn btn-primary" >
                                                    <input type="checkbox" name="weekday[]" id="option1" autocomplete="off"  value="any"> ANY
                                                </label>

                                            <label class="btn btn-primary">
                                                <input type="checkbox" name="weekday[]" id="option2" autocomplete="off"  value="1"> M
                                            </label>


                                            <label class="btn btn-primary">
                                                <input type="checkbox" name="weekday[]" id="option3" autocomplete="off" value="2"> T
                                            </label>



                                            <label class="btn btn-primary">
                                                <input type="checkbox" name="weekday[]" id="option3" autocomplete="off" value="3"> W
                                            </label>


                                            <label class="btn btn-primary">
                                                <input type="checkbox" name="weekday[]" id="option3" autocomplete="off" value="4"> T
                                            </label>


                                            <label class="btn btn-primary">
                                                <input type="checkbox" name="weekday[]" id="option3" autocomplete="off" value="5"> F
                                            </label>

                                            <label class="btn btn-primary">
                                                <input type="checkbox" name="weekday[]" id="option3" autocomplete="off" value="6"> S
                                            </label>

                                            <label class="btn btn-primary">
                                                <input type="checkbox" name="weekday[]" id="option3" autocomplete="off" value="7"> S
                                            </label>
                                         </div>
                                    </div>
                                </div>

                                <hr/>


                                <div class="left_sidebar_patient_filter_padding">
                                    <div class="left_sidebar_patient_filter_menu">
                                        <h3>Language</h3>

                                        <div class="btn-group btn-group1 navecation navecation1"  data-toggle="buttons">
                                            <label class="btn btn-primary">
                                                <input type="checkbox" name="language[]" id="option1" autocomplete="off"  value="any"> ANY
                                            </label>

                                            <label class="btn btn-primary">
                                                <input type="checkbox" name="language[]" id="option2" autocomplete="off"  value="english"> ENG
                                            </label>
                                            <label class="btn btn-primary">
                                                <input type="checkbox" name="language[]" id="option1" autocomplete="off"  value="French"> FR
                                            </label>

                                            <label class="btn btn-primary">
                                                <input type="checkbox" name="language[]" id="option2" autocomplete="off"  value="PU"> PU
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <hr/>

                                <div class="left_sidebar_patient_filter_padding">

                                    <div class="left_sidebar_patient_filter_menu left_sidebar_patient_filter_children">
                                        <h3>see children</h3>
                                        <div class="btn-group btn-group3 navecation navecation3" data-toggle="buttons">
                                            <label class="btn btn-primary">
                                    <input type="radio" name="seeChild" id="option1" class ="seechildVal" autocomplete="off" value="1" > YES
                                            </label>
                                            <label class="btn btn-primary">
                                        <input type="radio" name="seeChild" id="option2" class ="seechildVal" autocomplete="off" value="0" > NO
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="left_sidebar_patient_filter_padding">
                                    <div class="left_sidebar_patient_filter_price">
                                        <h3>hours</h3>
                                        <div class="left_sidebar_patient_filter_price_input left_sidebar_patient_filter_select">
                                            <div class="left_sidebar_patient_filter_price_input_left bottom-spacer"> <span>From</span>
                                                    <div class ="content_right_menu_select_category content_right_menu_select_radius_search">
                                                    <div class="select-style">
                                                            <select name="hrs_from" id ="hrsSelectedfrom">
                                                                <option value="" selected="selected">select time slot</option>
                                                                <option value="00:00">00:00</option>
                                                                <option value="01:00">01:00</option>
                                                                <option value="02:00">02:00</option>
                                                                <option value="03:00">03:00</option>
                                                                <option value="04:00">04:00</option>
                                                                <option value="05:00">05:00</option>
                                                                <option value="06:00">06:00</option>
                                                                <option value="07:00">07:00</option>
                                                                <option value="08:00">08:00</option>
                                                                <option value="09:00">09:00</option>
                                                                <option value="10:00">10:00</option>
                                                                <option value="11:00">11:00</option>
                                                                <option value="12:00">12:00</option>
                                                                <option value="13:00">13:00</option>
                                                                <option value="14:00">14:00</option>
                                                                <option value="15:00">15:00</option>
                                                                <option value="16:00">16:00</option>
                                                                <option value="17:00">17:00</option>
                                                                <option value="18:00">18:00</option>
                                                                <option value="19:00">19:00</option>
                                                                <option value="20:00">20:00</option>
                                                                <option value="21:00">21:00</option>
                                                                <option value="22:00">22:00</option>
                                                                <option value="23:00">23:00</option>
                                                         </select>
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="left_sidebar_patient_filter_price_input_right"> <span>To</span>
                                                <div class ="content_right_menu_select_category content_right_menu_select_radius_search">
                                                    <div class="select-style">
                                                        <select name="hrs_to" id ="hrsSelectedfrom">
                                                            <option value="" selected="selected">select time slot</option>
                                                            <option value="00:00">00:00</option>
                                                            <option value="01:00">01:00</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="06:00">06:00</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="13:00">13:00</option>
                                                            <option value="14:00">14:00</option>
                                                            <option value="15:00">15:00</option>
                                                            <option value="16:00">16:00</option>
                                                            <option value="17:00">17:00</option>
                                                            <option value="18:00">18:00</option>
                                                            <option value="19:00">19:00</option>
                                                            <option value="20:00">20:00</option>
                                                            <option value="21:00">21:00</option>
                                                            <option value="22:00">22:00</option>
                                                            <option value="23:00">23:00</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="bounceIn solidSearch findSolidBtn"><i class="fa fa-sign-in"></i> Find</button>
                                <hr/>
                            </div>
                            <?php echo form_close();?>

                        </div>
                    </div>
                <?php }else{?>

                <div class="col-md-2 container_padding_none">
                    <div class="left_sidebar_border">
                        <ul class="left_sidebar_menu">
                            <li class="dashboard_menu_icon currentmenu"><a href="#">Dashboard</a></li>
                            <li class="procedure_menu_icon"><a href="#">PROCEDURE</a></li>
                            <li class="patients_menu_icon"><a href="#">PATIENTS</a></li>
                            <li class="appointments_menu_icon"><a href="#">APPOINTMENTS</a></li>
                            <li class="hospital_menu_icon"><a href="#">HOSPITAL</a></li>
                            <li class="staff_menu_icon"><a href="#">STAFF</a></li>
                            <li class="reviews_menu_icon"><a href="#">REVIEWS</a></li>
                            <li class="reports_menu_icon"><a href="#">REPORTS</a></li>
                            <li class="messages_menu_icon"><a href="#">MESSAGES</a><span>13</span></li>
                        </ul>
                        <div class="left_sidebar_buttom1">
                            <div class="left_sidebar_emergency">
                                <h1>Emergency</h1>
                                <p>2 shot and jnured, coming in on 1st floor. Please make sure clients are not in the way. Thanks for your patience.</p>
                            </div>
                            <div class="left_sidebar_cancel">
                                <h1>Cancel</h1>
                                <p><strong>Sam Smith</strong> Cancled his recent appointment for 4:30.</p>
                            </div>
                        </div>

                    </div>
                </div>
               <?php } ?>