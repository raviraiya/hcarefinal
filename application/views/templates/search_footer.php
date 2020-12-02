<footer> </footer>

<!-- FOOTER END -->

</body>
<script>
   
$(".header_top_right_img").click(function(){
  $(".header_top_right_menu").toggleClass("is-active");
  $(".header_top_right_img").toggleClass("is_active");
});

$(".responsive_menu").click(function(){
  $(".left_sidebar_patient_menu").toggleClass("is-active");
  $(".responsive_menu").toggleClass("is_active");
});
$(document).ready(function(){
  $('#navecation li').click(function(){ 
    $('#navecation li').removeClass("active");
    $(this).addClass("active");return false;
});
});
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
                items: 2
            }
        }
    });
    $(document).ready(function() {

        var dynamic = $('.content_right_dashboard');
        var static = $('.left_sidebar_border');

        static.height(dynamic.height());

         $('#loading').fadeOut( "slow", function() {

            // Animation complete.

        });

    });

</script>
<script src="<?php echo base_url();?>assets/js/classie.js"></script>
<script src="<?php echo base_url();?>assets/js/notificationFx.js"></script>
<script>
    // (function() {
    //     var bttn = document.getElementById( 'notification-trigger' );

    //     // make sure..
    //     bttn.disabled = false;

    //     bttn.addEventListener( 'click', function() {
    //         // simulate loading (for demo purposes only)
    //         classie.add( bttn, 'active' );
    //         setTimeout( function() {

    //             classie.remove( bttn, 'active' );

    //             // create the notification
    //             var notification = new NotificationFx({
    //                 message : '<p>This notification has slight elasticity to it thanks to <a href="http://bouncejs.com/">bounce.js</a>.</p>',
    //                 layout : 'growl',
    //                 effect : 'slide',
    //                 type : 'notice', // notice, warning or error
    //                 onClose : function() {
    //                     bttn.disabled = false;
    //                 }
    //             });

    //             // show the notification
    //             notification.show();

    //         }, 1200 );

    //         // disable the button (for demo purposes only)
    //         this.disabled = true;
    //     } );
    // })();
</script>

</html>
