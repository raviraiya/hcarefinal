<!--<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <!-- Basic Page Needs================================================== -->
    <meta charset="utf-8">
    <title>Hcare Group</title>
    <!-- SEO Meta  ================================================== -->
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
    <!-- Mobile Specific Metas  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS ================================================== -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/style.css?preventCache=<?php echo time() ?>">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/jquery-ui.css">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Favicons ================================================== -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    <!--[if gte IE 9]>
    <style type="text/css">
        .gradient {
            filter: none;
        }
    </style>
    <![endif]-->
    <!-- JS ================================================== -->
    <script type="text/javascript" src="<?php echo base_url()?>/assets/js/base.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>/assets/js/jquery.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url()?>/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>/assets/js/bootbox.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>/assets/js/owl.carousel.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>/assets/js/registration.js?preventCache=<?php echo time() ?>"></script>
    <style type="text/css">
        input#reset_password {
            margin-bottom: 5px;
        }
        input#confrm_reset_password {
            margin-bottom: 5px;
        }
        span.pass_err {
            color: red;
            padding: 0 0 0 0;
            text-align: right;
            margin-bottom: 10px;
        }
        span.conf_pass_err {
            color: red;
            padding: 0 0 0 0;
            text-align: right;
            margin-bottom: 10px;
        }
    </style>
</head>
<body >
    <!-- HEADER START -->
    <header>
        <div class="header_left_logo">
            <div class="header_left_logo"> 
                <a href="javascript:void(0)"><img src="<?php echo base_url()?>/assets/images/logo.png" /></a> 
            </div>
        </div>
    </header>
    <!-- HEADER END --><!-- CONTAINER START -->
    <section>
        <div class="content_sign_up_page">
            <div class="container-fluid container_padding_none">
                <div class="row">
                    <div class="col-md-8 container_padding_none">
                        <div class="content_sign_up_page_left">
                            <div class="content_sign_up_page_banner1"> </div>
                            <div class="content_sign_up_page_slider">
                                <div class="content_sign_up_page_slider_table">
                                    <div class="content_sign_up_page_slider_left">
                                        <div class="owl-carousel">
                                            <div class="item">
                                                <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae</p>
                                            </div>
                                            <div class="item">
                                                <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae</p>
                                            </div>
                                            <div class="item">
                                                <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 container_padding_none">
                        <div class="content_sign_up_page_right">
                            <div class="content_sign_up_page_table_right">
                                <div class="content_sign_up_page_cell_right" id="logindiv">
                                    <form name ="loginfrm" id ="appResetPassword" >
                                        <h1>Reset Password</h1>
                                        <?php if(!empty($hash_auth_fail)){ ?>
                                            <div class="alert alert-danger">
                                              <strong>Warning!</strong> <?php echo $hash_auth_fail; ?>
                                              <a href="<?php echo base_url()?>login">Click Here</a>
                                            </div>
                                        <?php } ?>    
                                        <div id="verror" style="display:none"></div>                                    
                                        <input class="sign_in_password reset_password" placeholder="New Password" type="Password" name="reset_password" id="reset_password" onkeypress="$('.pass_err').html('');" />
                                        <span class="pass_err"></span>

                                        <input class="sign_in_password confrm_reset_password" placeholder="Confirm Password" type="Password" name="confrm_reset_password" id="confrm_reset_password" onkeypress="$('.conf_pass_err').html('');" />
                                        <span class="conf_pass_err"></span>

                                        <input type="hidden" name="reset_hash" value="<?php echo $reset_hash; ?>">                                        
                                    </form>
                                    <?php if(!empty($hash_auth_fail)){ ?>
                                        <a href="javascript:void(0)" class="content_sign_up_submit disabled">submit</a>
                                    <?php }else{ ?>
                                        <a href="javascript:void(0)" class="content_sign_up_submit" id="resetPassword">submit</a>
                                    <?php } ?> 
                                    
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTAINER END -->
    <!-- FOOTER START -->
    <footer> 
        <script>
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                margin:25,
                loop: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });
            
        </script>
    </footer>
    <!-- FOOTER END -->
</body>    
</html>