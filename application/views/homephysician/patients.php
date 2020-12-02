<script>

  var hphy_id = "<?php echo $this->session->userdata('userid')?>";

</script>
<div class="col-md-10 container_padding_none"  ng-controller="hphysican_patients_Ctrl">
  <div class="content_right_dashboard">
    <div class="content_right_patients_titel">
      <h1>Patients</h1>
    </div>
    <div class="content_right1_patients"> 
     <div class="staff_top_titel">
      <h1>Total {{hpatientdataObj.length}} Patients</h1>
      <div class="staff_top_titel_button">
        <a class="" href="<?php echo base_url();?>homephysician/patient_invite">invite</a> 
      </div>
    </div>
  </div>
  <div class="patients_homephy_right" ng-repeat="hpatientdata in hpatientdataObj | limitTo:limit"> 
   <div class="patients_homephy_left_box">
    <div style="border-radius: 100%; overflow: hidden; width: 140px; height: 140px; margin: 15px auto; border: 5px solid rgb(255, 255, 255); box-shadow: 1px 2px 3px rgb(193, 193, 193);">
      <img src="<?php echo base_url(); ?>{{hpatientdata.patientPic ? hpatientdata.patientPic : 'assets/patient/no-profile-image.png'}}" style="width: 143px; height: 144px; margin: 0px; padding: 0px;" class="" />
    </div>
    <h1 style="text-transform:capitalize;">{{hpatientdata.username}} </h1>
    <ul>
      <li>
       <p>Total Appt.</p>
       <span><i class="fa fa-calendar"></i>{{hpatientdata.total}}</span>
     </li>
     <li class="list">
       <p>Cancel Appt.</p>
       <span><i class="fa fa-calendar"></i> {{hpatientdata.cancle}}</span>
     </li>
   </ul>
   <!--    <a class="patients_homephy_medical_history_button" href="#">medical history</a> -->
 </div>
 <div class="patients_homephy_right_box">
  <div class="patients_homephy_right_border">
   <div class="patients_homephy_top_div">
    
    <div class="patients_homephy_titel_button">
      <h1>Last Appointments</h1>
      <p class="todayAppointment">
        <a href="javascript:void(0)" ng-if="hpatientdata.hBookresult">  
          reminder
        </a>
      </p>
        <input type="hidden" value="{{hpatientdata.hBookresult.email}}$#${{hpatientdata.hBookresult.patient_user_id}}$#${{hpatientdata.hBookresult.bID}}" />
    </div>
    <div class="appointments_homephy_right" ng-if="hpatientdata.specialist">
      <div class="appointments_homephy_left">
        <img src="<?php echo base_url();?>{{hpatientdata.specialist.specialistpic ? hpatientdata.specialist.specialistpic : 'assets/specialist/no-profile-image.png'}}">
      </div>
      <div class="appointments_homephy_right_box">
         <ul class="appointments_homephy_right_menu">
           <li>
             <span>Specialist Name</span>
             <h1 style="text-transform:capitalize;">{{hpatientdata.specialist.name}}</h1>
           </li>
           <li>
             <span>Procedure Category</span>
             <h2 class="appointments_homephy_right_eye"><i class="fa fa-eye"></i>{{hpatientdata.procedurecategory.category_name}}</h2>
           </li>
           <li>
             <span>Procedure Name</span>
             <h2>{{hpatientdata.procedure.procedure_name}} </h2>
           </li>
         </ul>
      </div>
    </div>

    <div class="patients_homephy_content" ng-if="!hpatientdata.specialist">
      <div class="row">
        <div class="col-sm-12" style="color: rgb(13, 146, 167); height: 43px; background: rgb(231, 231, 231) none repeat scroll 0% 0%; margin-top: 7px; margin-bottom: 16px;">
          <h4 class="text-center"> No Record Found!</h4>
        </div>
      </div>
    </div>

  <div class="patients_homephy_titel_button">
    <h1 style="padding:0px;">Last Checkup</h1>
  </div>

  <div class="patients_homephy_content" ng-if="hpatientdata.checkup">
    <div class="col-md-3 container_padding_none">
      <p class="patients_homephy_titel_font">body temperature</p>
      <div class="appointments_last_checkup_maps_right patients_homephy_content_checkup_maps_img1">
        <img src="<?php echo base_url();?>assets/images/appointments_maps_img1.png">
        <div class="appointments_last_checkup_maps_right1">
          <p>Normal</p>
          <span>{{hpatientdata.checkup.temp}}<sup>O</sup></span>
        </div>
      </div>
    </div>
    <div class="col-md-3 container_padding_none">
     <p class="patients_homephy_titel_font">heart beat</p>
      <div class="appointments_last_checkup_maps_right">
       <img src="<?php echo base_url();?>assets/images/appointments_maps_img2.png">
       <div class="appointments_last_checkup_maps_right1"><h2>{{hpatientdata.checkup.heartbit}}<sup>bpm</sup></h2></div>
      </div>
    </div>
    <div class="col-md-3 container_padding_none">
      <p class="patients_homephy_titel_font">blood sugar</p>
      <div class="appointments_last_checkup_maps_right"> 
        <img style="padding:0 5px 0 0;" src="<?php echo base_url();?>assets/images/appointments_maps_icon3.png">
        <div class="appointments_last_checkup_maps_right1 appointments_last_checkup_maps_left"> <h3>{{hpatientdata.checkup.BG}} mg/dl</h3>
        </div>
        <ul>
          <li>Low Blood<br> Pressure</li>
          <li><p>Normal</p></li>
          <li>High Blood <br>Pressure</li>
        </ul>
        <img class="patients_homephy_content_maps_icon2" src="<?php echo base_url();?>assets/images/patients_homephy_content_maps_icon2.png">
      </div>
    </div>
    <div class="col-md-3 container_padding_none">
      <p class="patients_homephy_titel_font">blood pressure</p>
      <div class="appointments_last_checkup_maps_right"> 
        <div class="appointments_last_checkup_maps_right1 appointments_last_checkup_maps_left"><h3>110/70</h3></div>
        <ul>
          <li>Low Blood<br> Pressure</li>
          <li><p>Normal</p></li>
          <li>High Blood <br>Pressure</li>
        </ul>
        <img class="patients_homephy_content_maps_icon2" src="<?php echo base_url();?>assets/images/patients_homephy_content_maps_icon2.png">
      </div>
    </div>
  </div>

  <div class="patients_homephy_content" ng-if="!hpatientdata.checkup">
    <div class="row">
      <div class="col-sm-12" style="color: rgb(13, 146, 167); height: 43px; background: rgb(231, 231, 231) none repeat scroll 0% 0%; margin-top: 7px; margin-bottom: 16px;">
        <h4 class="text-center"> No Record Found!</h4>
      </div>
    </div>
  </div>



             <!-----------------------------------------------Start Review slider--------------------------------------------->



            <div class="patientid">



            <div>



            



             <!---start Fetch data using angularjs for hospital slider image and the controller name is hospital_profile_imageCtrl and js path assets/angular/script/procedure.js  -->



            <div ng-controller="get_patient_reviewCtrl" ng-init="get_patient_review(hpatientdata.patient_user_id)" id="slides_control">
              <div>
                <carousel interval="myInterval">
                  <slide ng-repeat="hpatientreview in hpatientreview" active="slide.active">
                    <div style="height:25px;padding:15px;" class="" >
                      <div class="row">
                        <div class="col-sm-3">
                          <div class="reviews_content_box_left">
                            <h1>PROCEDURES NAME:  </h1>
                            <h2>{{hpatientreview.procedure_name}}</h2>
                          </div>
                        </div>
                        <div class="col-sm-1">
                          <div class="reviews_content_box_center">
                            <img src="<?php echo base_url();?>assets/images/reviews_on_procedures_box_position.png">
                            <span>{{hpatientreview.reviewRating}}</span>
                          </div>
                        </div>
                        <div class="col-sm-5 text-left">
                          <div class="reviews_content_box_right text-center">
                            <h1>specialist name:  </h1>
                            <h2>dr. {{hpatientreview.name}}</h2>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="reviews_content_box_bottom"> 
                            <div class="reviews_content_box_bottom_right">
                              <p>{{hpatientreview.review}}</p>
                            </div>
                          </div>
                        </div>
                      </div>                                
                    </div>
                  </slide>
                  <div ng-show="nofound">
                    <div class="">
                      <div class="row">
                        <div class="col-sm-12" style="color: rgb(13, 146, 167); height: 43px; background: rgb(231, 231, 231) none repeat scroll 0% 0%; margin-top: 7px; margin-bottom: 16px;">
                          <h4 class="text-center"> No Review Found!</h4>
                        </div>
                      </div>
                    </div>
                  </div>  
                </carousel>
              </div>
            </div>



        <!---End Fetch data using angularjs for hospital slider image and the controller name is hospital_profile_imageCtrl and js path assets/angular/script/procedure.js  -->



      </div>



    </div>



    <!-----------------------------------------------End Review slider---------------------------------------------->



  </div>



</div>



</div>



</div>



<div ng-show="message"><div class="alert alert-success text-center">



  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>



  <strong>No record found</strong>



</div></div>



<div class="homephy_patients_button_padding"> 



  <a href="javascript:void(0)" ng-hide="loadmore" ng-click='loadMore()' class="content_right_patients_load_more">load more</a>



</div>



</div>



</div>  