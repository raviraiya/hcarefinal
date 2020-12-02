<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaQc_TckUzz8OlWAZKuoQFRIlPnKpczBU "

  type="text/javascript"></script>

<script>

var myCenter=new google.maps.LatLng(51.508742,-0.120850);



function initialize()

{

var mapProp = {

  center:myCenter,

  zoom:5,

  mapTypeId:google.maps.MapTypeId.ROADMAP

  };



var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);



var marker=new google.maps.Marker({

  position:myCenter,

  });



marker.setMap(map);



var infowindow = new google.maps.InfoWindow({

  content:" "

  });



google.maps.event.addListener(marker, 'click', function() {

  infowindow.open(map,marker);

  });

}



google.maps.event.addDomListener(window, 'load', initialize);

</script>

<script>

	var specialistID = <?php echo $specialistid;?>

</script>



<div class="col-md-10 container_padding_none" ng-controller="specialistForPatientCtrl" >

  <div class="content_right">

    <div class="content_right_appointments_titel">

      <h1>Specialists</h1>

      <a href="#"><i class="fa fa-chevron-left"></i> back to list</a> </div>

    <div class="findprocedure_detail">

      <div class="col-md-8 container_padding_none">

        <div class="findprocedure_detail_border">

          <div class="findprocedure_detail_box_top specialistprofile_box_top" ng-repeat="hspecialistpatient in hspecialistpatients">

            <div class="findprocedure_detail_img"><img  src="<?php echo base_url(); ?>{{hspecialistpatient.specialistpic}}" /></div>

            <div class="findprocedure_detail_box_top_right">

              <div class="findprocedure_detail_box_left_titel">

                <div class="findprocedure_detail_titel_top_left">

                  <h1>Dr. {{hspecialistpatient.name}}</h1>

                  <span>{{hspecialistpatient.education}}</span>

                  <div class="specialistprofile_hospital_logo"> <span>Assoicated with H</span> <img class="specialistprofile_hospital_logo_img1" src="<?php echo base_url(); ?>assets/images/hospital_img1.png" /> <img class="specialistprofile_hospital_logo_img2" src="<?php echo base_url(); ?>assets/images/hospital_img2.png" /> </div>

                </div>

                <div class="findprocedure_detail_titel_top_right">

                  <div class="specialistprofile_titel_top_right">

                    <h3><i class="fa fa-star"></i><span>5</span></h3>

                    <a href="#">read review</a> </div>

                </div>

              </div>

            </div>

          </div>

          <div class="specialistprofile_text_content">

            <p>{{hspecialistpatient.title}}</p>

          </div>

          <div class="specialistprofile_button_children">

            <h1>see the children</h1>

            <a href="#">Yes</a> </div>

          <?php foreach($patients as $patient) {

                         $arr = $patient->language;

						 $removeBrace = str_replace("[","",$arr);

						  $removeBrace = str_replace('"',"",$removeBrace);

						  $removeBrace = str_replace(']',"",$removeBrace);

/* $str will now be a string with the value "Glue This Into A String Please" */

                          $arr1 = $patient->specialization;

						  $removeBrace1 = str_replace("[","",$arr1);

						  $removeBrace1 = str_replace('"',"",$removeBrace1);

						  $removeBrace1 = str_replace(']',"",$removeBrace1);

                          }

						 

						  ?>

          <div class="specialistprofile_button_languages">

            <h1>languages</h1>

            <div class="hospital_facilities">

              <input type="text" value="<?php echo $removeBrace;?>" data-role="tagsinput" />

            </div>

          </div>

          <div class="specialistprofile_button_languages specialistprofile_specialization">

            <h1>specialization</h1>

            <div class="hospital_facilities">

              <input type="text" value="<?php echo $removeBrace1;?>" data-role="tagsinput" />

            </div>

          </div>

          <div class="specialistprofile_button_languages">

            <h1>qualifications</h1>

            <ul>

              <li><i class="fa fa-circle" aria-hidden="true"></i>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. </li>

              <li><i class="fa fa-circle" aria-hidden="true"></i>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. </li>

              <li class="list"><i class="fa fa-circle" aria-hidden="true"></i>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. </li>

            </ul>

          </div>

          <div class="specialistprofile_button_languages specialistprofile_specialization">

            <h1>experience</h1>

            <ul>

              <li><i class="fa fa-circle" aria-hidden="true"></i>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. </li>

              <li><i class="fa fa-circle" aria-hidden="true"></i>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. </li>

              <li class="list"><i class="fa fa-circle" aria-hidden="true"></i>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. </li>

            </ul>

          </div>

          

          <!-----------------------------------------------START AWARDS SECTION----------------------------------->

          

          <div class="specialistprofile_button_languages specialistprofile_box_awards" >

            <h1>awards</h1>

            <div class="row">

              <?php foreach($patients as $patient) {

                         $arr = $patient->award;

						

                         $dataarray= json_decode($arr);

					    foreach($dataarray as $dataarray11) {

					  ?>

              <div class="col-md-4"> <img src="<?php echo base_url(); ?>assets/images/specialistprofile_awards.png" />

                <p><?php echo $dataarray11->award_text; ?></p>

                <p><?php echo $dataarray11->award_date; ?></p>

              </div>

              <?php

                          }}

						  ?>

            </div>

          </div>

          <!-----------------------------------------------EXIT AWARDS SECTION----------------------------------->

          <div class="specialistprofile_button_languages specialistprofile_reviews_slider">

            <h1>REVIEWS</h1>

            <div class="patient_content_right_box_reviews">

              <div class="patient_content_right_slider_reviews">

                <div class="owl-carousel">

                  <div class="item">

                    <div class="patient_content_right_text_reviews">

                      <div class="patient_content_right_text_reviews_img"> <img src="<?php echo base_url(); ?>assets/images/reviews_on_procedures_box_position.png" /> <span>5</span> </div>

                      <div class="patient_content_right_text_reviews_img_icon"> <img src="<?php echo base_url(); ?>assets/images/appointments_patients_icon2.png" /> </div>

                      <div class="patient_content_right_text_reviews_content">

                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>

                        <span>WILLIAM</span> </div>

                    </div>

                  </div>

                  <div class="item">

                    <div class="patient_content_right_text_reviews">

                      <div class="patient_content_right_text_reviews_img"> <img src="<?php echo base_url(); ?>assets/images/reviews_on_procedures_box_position.png" /> <span>5</span> </div>

                      <div class="patient_content_right_text_reviews_img_icon"> <img src="<?php echo base_url(); ?>assets/images/appointments_patients_icon2.png" /> </div>

                      <div class="patient_content_right_text_reviews_content">

                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>

                        <span>WILLIAM</span> </div>

                    </div>

                  </div>

                  <div class="item">

                    <div class="patient_content_right_text_reviews">

                      <div class="patient_content_right_text_reviews_img"> <img src="<?php echo base_url(); ?>assets/images/reviews_on_procedures_box_position.png" /> <span>5</span> </div>

                      <div class="patient_content_right_text_reviews_img_icon"> <img src="<?php echo base_url(); ?>assets/images/appointments_patients_icon2.png" /> </div>

                      <div class="patient_content_right_text_reviews_content">

                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>

                        <span>WILLIAM</span> </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

      <div class="col-md-4 container_padding_none">

        <div id="googleMap" class="findprocedure_detail_maps_img"></div>

        <!--<div class="book_appointment_pupup findprocedure_specialistprofile_calendar">

          <h1 class="findprocedure_calendar_titel">Book Appointment</h1>

          <div class="findprocedure_calendar">

            <table cellspacing="0" cellpadding="0">

              <tbody>

                <tr>

                  <th>mon<span>11th July</span></th>

                  <th>tue<span>12th July</span></th>

                  <th>wed<span>13th July</span></th>

                  <th>thur<span>14th July</span></th>

                  <th>fri<span>15th July</span></th>

                </tr>

                <tr>

                  <td><div class="createprocedure_calendar_date"> <a class="createprocedure_calendar_circle" href="#"><i class="fa fa-times-circle"></i></a> <span>12:00 to 01:00</span><a class="book_button" href="#">book</a> </div></td>

                  <td></td>

                  <td><div class="createprocedure_calendar_date"> <a class="createprocedure_calendar_circle" href="#"><i class="fa fa-times-circle"></i></a> <span>12:00 to 01:00</span><a class="book_button" href="#">book</a> </div></td>

                  <td></td>

                  <td><div class="createprocedure_calendar_date"> <a class="createprocedure_calendar_circle" href="#"><i class="fa fa-times-circle"></i></a> <span>12:00 to 01:00</span><a class="book_button" href="#">book</a> </div></td>

                </tr>

                <tr>

                  <td></td>

                  <td><div class="createprocedure_calendar_date"> <a class="createprocedure_calendar_circle" href="#"><i class="fa fa-times-circle"></i></a> <span>12:00 to 01:00</span><a class="book_button" href="#">book</a> </div></td>

                  <td></td>

                  <td><div class="createprocedure_calendar_date"> <a class="createprocedure_calendar_circle" href="#"><i class="fa fa-times-circle"></i></a> <span>12:00 to 01:00</span><a class="book_button" href="#">book</a> </div></td>

                  <td></td>

                </tr>

              </tbody>

            </table>

          </div>

        </div>-->

      </div>

    </div>

  </div>

</div>

