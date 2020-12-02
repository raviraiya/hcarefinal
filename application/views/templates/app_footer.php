</div>

 </div>

 </div>

 </section>

 <footer> </footer>

 <!-- FOOTER END -->

 </body>

 <script src="<?php echo base_url();?>assets/js/classie.js"></script>

 <script src="<?php echo base_url();?>assets/js/notificationFx.js"></script>

 <script>

     $(".header_top_right_img").click(function(){

         $(".header_top_right_menu").toggleClass("is-active");

         $(".header_top_right_img").toggleClass("is_active");

     });

     $(".responsive_menu").click(function(){

         $(".left_sidebar_border").toggleClass("is-active");

         $(".responsive_menu").toggleClass("is_active");

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

                 items: 2

             },

             1000: {

                 items: 2

             }

         }

     });

 	

 	var owl = $('.owl-carousel_homephy');

       owl.owlCarousel({

        // margin:25,

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

 	  	   var owl = $('.owl-carousel_reminder');

       owl.owlCarousel({

         margin:0,

         loop: true,

         responsive: {

           0: {

             items: 1

           },

           600: {

             items: 4

           },

           1000: {

             items: 4

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

         $('.fancybox').fancybox();

     });

$(".openMenu").click(function(){
//alert($(".openMenu").next().css('display'));
if($(".openMenu").next().css('display') == 'none')
{
  $(".openMenu").next().show();
  $(".openMenu").html("-");
}
else{$(".openMenu").next().hide();
  $(".openMenu").html("+");}
  return false;
   
});


$(".header_top_right").hover(function(){
  
  $(".header_top_right_menu").addClass("is-active");
  $(".header_top_right_img").addClass("is_active");
}, function () {
 $(".header_top_right_menu").removeClass("is-active");
  $(".header_top_right_img").toggleClass("is_active");
    
});

$(".responsive_menu").click(function(){
  $(".left_sidebar_border").toggleClass("is-active");
  $(".responsive_menu").toggleClass("is_active");
});


 </script>

 <!--<script>-->

 <!--    (function() {-->

 <!--        var bttn = document.getElementById( 'notification-trigger' );-->

 <!---->

 <!--        // make sure..-->

 <!--        bttn.disabled = false;-->

 <!---->

 <!--        bttn.addEventListener( 'click', function() {-->

 <!--            // simulate loading (for demo purposes only)-->

 <!--            classie.add( bttn, 'active' );-->

 <!--            setTimeout( function() {-->

 <!---->

 <!--                classie.remove( bttn, 'active' );-->

 <!---->

 <!--                // create the notification-->

 <!--                var notification = new NotificationFx({-->

 <!--                    message : '<p>This notification has slight elasticity to it thanks to <a href="http://bouncejs.com/">bounce.js</a>.</p>',-->

 <!--                    layout : 'growl',-->

 <!--                    effect : 'slide',-->

 <!--                    type : 'notice', // notice, warning or error-->

 <!--                    onClose : function() {-->

 <!--                        bttn.disabled = false;-->

 <!--                    }-->

 <!--                });-->

 <!---->

 <!--                // show the notification-->

 <!--                notification.show();-->

 <!---->

 <!--            }, 1200 );-->

 <!---->

 <!--            // disable the button (for demo purposes only)-->

 <!--            this.disabled = true;-->

 <!--        } );-->

 <!--    })();-->

 <!--</script>-->

 </html>