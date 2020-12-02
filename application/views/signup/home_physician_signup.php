<html lang="en">
<!--<![endif]-->
<head>
<!-- Basic Page Needs
  ================================================== -->
<meta charset="utf-8">
<title>Hcare Group</title>
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

<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/style.css?preventCache=<?php echo time() ?>">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/jquery-ui.css">

<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<!-- Favicons
	================================================== -->
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
<!-- JS
	================================================== -->
<script type="text/javascript" src="<?php echo base_url()?>/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/assets/js/owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/assets/js/registration.js?preventCache=<?php echo time() ?>"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootbox.js"></script>
</head>
<body >
<!-- HEADER START -->
<header>
  <div class="header_left_logo"> <a href="javascript:void(0)"><img src="<?php echo base_url()?>/assets/images/logo.png" /></a> </div>
</header>
<!-- HEADER END --> 
<!-- CONTAINER START -->

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
              <div class="content_sign_up_page_cell_right">
                <h1>Sign Up</h1>
                <span>for home physician</span>
                <div id="verror" class='errorDiv' style="display:none;" ></div>
                	<input placeholder="Enter first name" type="text" name="fname" />
                    <input placeholder="Enter last name" type="text" name="lname" />
                    <input placeholder="Enter username" type="text" name="name" />
                    <input placeholder="Enter email address" type="text" name="email"/>
                    <input placeholder="Enter password" type="password" name="password" />
                    <input placeholder="Confirm password" type="password" name="repassword" />
                <a href="javascript:void(0)" class="content_sign_up_submit" id="hpregister">submit</a> </div>
            </div>
            <p class="sign_up_page_footer_text">Already Member? <a href="<?php echo base_url()?>login"> Sign In</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- CONTAINER END --> 
<!-- FOOTER START -->

<footer> </footer>

<!-- FOOTER END -->

</body>
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
</html>
