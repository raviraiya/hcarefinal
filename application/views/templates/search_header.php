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
<script type="text/javascript" src="<?php echo base_url();?>assets/js/base.js?preventCache=<?php echo time() ?>"></script>


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
    <script src="<?php echo base_url();?>assets/js/appointment.js?preventCache=<?php echo time() ?>"></script>
    <script src="<?php echo base_url();?>assets/js/validator.js"></script>
    <script src="<?php echo base_url();?>assets/js/formValidations.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootbox.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.fancybox.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-switch.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-toogle.js"></script>
    <script src="<?php echo base_url();?>assets/js/front.js?preventCache=<?php echo time() ?>"></script>
<!--    <script src="--><?php //echo base_url();?><!--assets/js/nouislider.js"></script>-->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
<!--    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCK-d21EqqSrl-c_IfTQIpXIiaHQrkR_ds"></script>-->
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
                            <?php
                            //$attribute = array('id' => 'search_prc','data-validate' => 'parsley');
                            //echo form_open('patient/search', $attribute); ?>
                            <form method="GET" id ="search_prc" action="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
                            <div class="left_sidebar_patient_filter">
                                <h2>Filter</h2>

                                <div class="left_sidebar_patient_filter_padding">
                                    <div class="left_sidebar_patient_filter_price">
                                        <h3>Price</h3>
                                        <div class="layout-slider" style="width: 100%">
                                            <div id="nights_div"></div>
                                            <div class="away_div_min">
                                                <div class="Away2_left">
                                                    <div id="nights"></div>
                                                </div>
                                                <div class="Away3_right">
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
                                        <div class="btn-group btn-group1 navecation navecation1"  id="weekdayChange" data-toggle="buttons">
                                                <label class="btn btn-primary active" id ="anyweek">
                                                    <input type="checkbox" name="weekday[]" id="option1" checked autocomplete="off"  value="any"> ANY
                                                </label>

                                            <label class="btn btn-primary removeactive">
                                                <input type="checkbox" name="weekday[]" id="option2" autocomplete="off"  value="1"> M
                                            </label>


                                            <label class="btn btn-primary removeactive">
                                                <input type="checkbox" name="weekday[]" id="option3" autocomplete="off" value="2"> T
                                            </label>



                                            <label class="btn btn-primary removeactive">
                                                <input type="checkbox" name="weekday[]" id="option3" autocomplete="off" value="3"> W
                                            </label>


                                            <label class="btn btn-primary removeactive">
                                                <input type="checkbox" name="weekday[]" id="option3" autocomplete="off" value="4"> T
                                            </label>


                                            <label class="btn btn-primary removeactive">
                                                <input type="checkbox" name="weekday[]" id="option3" autocomplete="off" value="5"> F
                                            </label>

                                            <label class="btn btn-primary removeactive">
                                                <input type="checkbox" name="weekday[]" id="option3" autocomplete="off" value="6"> S
                                            </label>

                                            <label class="btn btn-primary removeactive">
                                                <input type="checkbox" name="weekday[]" id="option3" autocomplete="off" value="7"> S
                                            </label>
                                         </div>
                                    </div>
                                </div>

                                <hr/>


                                <div class="left_sidebar_patient_filter_padding">
                                    <div class="left_sidebar_patient_filter_menu">
                                        <h3>Language</h3>
                                        <div class="btn-group btn-group1 navecation navecation1" id="languageChange" data-toggle="buttons">
                                            <label class="btn btn-primary active" id ="removeactiveLng">
                                                <input type="checkbox" name="language[]" id="optionlang1" checked="checked" autocomplete="off"  value="any"> ANY
                                            </label>

                                            <label class="btn btn-primary removelng">
                                                <input type="checkbox" name="language[]" id="optionlang2" autocomplete="off"  value="english"> ENG
                                            </label>
                                            <label class="btn btn-primary removelng">
                                                <input type="checkbox" name="language[]" id="optionlang3" autocomplete="off"  value="French"> FR
                                            </label>

                                            <label class="btn btn-primary removelng">
                                                <input type="checkbox" name="language[]" id="optionlang4" autocomplete="off"  value="PU"> PU
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <hr/>

                                <div class="left_sidebar_patient_filter_padding">
                                     <h3>See Children</h3>
                            <div class="btn-group btn-group1 navecation navecation1 setWidth" id="ChildSeeStats" data-toggle="buttons">
                                            <label class="btn btn-primary">
                                    <input type="radio" name="seeChild" id="option1" class ="seechildVal seeChild " autocomplete="off" value="1" > YES
                                            </label>
                                            <label class="btn btn-primary">
                                        <input type="radio" name="seeChild" id="option2" class ="seechildVal seeChild" autocomplete="off" value="0" > NO
                                            </label>
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
                                                                <option value="" selected="selected">select time</option>
                                                                <option value="00:00">12:00 AM</option>
                                                                <option value="01:00">01:00 AM</option>
                                                                <option value="02:00">02:00 AM </option>
                                                                <option value="03:00">03:00 AM </option>
                                                                <option value="04:00">04:00 AM</option>
                                                                <option value="05:00">05:00 AM</option>
                                                                <option value="06:00">06:00 AM </option>
                                                                <option value="07:00">07:00 AM </option>
                                                                <option value="08:00">08:00 AM </option>
                                                                <option value="09:00">09:00 AM </option>
                                                                <option value="10:00">10:00 AM </option>
                                                                <option value="11:00">11:00 AM </option>
                                                                <option value="12:00">12:00 PM </option>
                                                                <option value="13:00">13:00 PM </option>
                                                                <option value="14:00">14:00 PM </option>
                                                                <option value="15:00">15:00 PM </option>
                                                                <option value="16:00">16:00 PM </option>
                                                                <option value="17:00">17:00 PM </option>
                                                                <option value="18:00">18:00 PM </option>
                                                                <option value="19:00">19:00 PM </option>
                                                                <option value="20:00">20:00 PM </option>
                                                                <option value="21:00">21:00 PM </option>
                                                                <option value="22:00">22:00 PM </option>
                                                                <option value="23:00">23:00 PM </option>
                                                         </select>
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="left_sidebar_patient_filter_price_input_right"> <span>To</span>
                                                <div class ="content_right_menu_select_category content_right_menu_select_radius_search">
                                                    <div class="select-style">
                                                        <select name="hrs_to" id ="hrsSelectedfrom">
                                                            <option value="" selected="selected">select time</option>
                                                            <option value="00:00">12:00 AM</option>
                                                            <option value="01:00">01:00 AM </option>
                                                            <option value="02:00">02:00 AM </option>
                                                            <option value="03:00">03:00 AM</option>
                                                            <option value="04:00">04:00 AM </option>
                                                            <option value="05:00">05:00 AM</option>
                                                            <option value="06:00">06:00 AM </option>
                                                            <option value="07:00">07:00 AM </option>
                                                            <option value="08:00">08:00 AM </option>
                                                            <option value="09:00">09:00 AM</option>
                                                            <option value="10:00">10:00 AM </option>
                                                            <option value="11:00">11:00 AM </option>
                                                            <option value="12:00">12:00 PM </option>
                                                            <option value="13:00">13:00 PM </option>
                                                            <option value="14:00">14:00 PM </option>
                                                            <option value="15:00">15:00 PM </option>
                                                            <option value="16:00">16:00 PM</option>
                                                            <option value="17:00">17:00 PM </option>
                                                            <option value="18:00">18:00 PM </option>
                                                            <option value="19:00">19:00 PM</option>
                                                            <option value="20:00">20:00 PM </option>
                                                            <option value="21:00">21:00 PM </option>
                                                            <option value="22:00">22:00 PM </option>
                                                            <option value="23:00">23:00 PM </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <?php
                                     $procedure_cat_id = $this->input->get('procedure_cat', TRUE);   
                                     $procedure_name_id = $this->input->get('procedure_name', TRUE);   
                                     $city = strtolower($this->input->get('location', TRUE));   
                                     $zip = strtolower($this->input->get('zip', TRUE));
                                     $miles = $this->input->get('km', TRUE); 
                                
                                    ?>      
                                 <input type= "hidden" name ="procedure_cat" value ="<?php echo isset($procedure_cat_id) ? $procedure_cat_id  : "" ?>" />
                                  <input type= "hidden" name ="procedure_name" value ="<?php echo isset($procedure_name_id) ? $procedure_name_id  : "" ?>"/>
                                  <input type= "hidden" name ="location" value ="<?php echo isset($city) ? $city  : "" ?>" />
                                 <input type= "hidden" name ="zip" value ="<?php echo isset($zip) ? $zip  : "" ?>" />
                                 <input type= "hidden" name ="km"  value ="<?php echo isset($miles) ? $miles : ""?>"/>
                                </div>
                                
                                <button type="button" class="bounceIn solidSearch findSolidBtn"><i class="fa fa-sign-in"></i> Find</button>
                                <hr/>
                            </div>
                            <?php echo form_close();?>

                        </div>
                    </div>
 
            