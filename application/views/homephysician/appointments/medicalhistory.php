<?php header('Content-disposition: inline'); ?>
<div class="apointment_medicalhistory_right_content_tabs3">
  <div class="apointment_medicalhistory_left_homePhy">
    <ul>
      <li class="active"><a href="javascript:void(0)" id="homePhyDocuments">documents</a></li>
      <li><a href="javascript:void(0);" id="homePhyconditionsAllergeis">Conditions allergeis</a></li>
      <li><a href="javascript:void(0);" id="homePhyimmuniziation">immuniziation</a></li>
      <li><a href="javascript:void(0);" id="homePhysurgicalProcedure">surgical procedure</a></li>
      <!-- <li><a href="#">last appointment</a></li>-->
      <li><a href="javascript:void(0);" id="homePhyfamilyHistory">family history</a></li>
      <li><a href="javascript:void(0);" id="homePhyeyeSight">eye sight</a></li>
    </ul>
  </div>
  <div class="apointment_medicalhistory_right">
    <form id='homePhyMedicalhistory' enctype="multipart/form-data">
      <div class="apointment_medicalhistory_right_upload">
        <h1 class="report_text">upload new report</h1>
        <div class="apointment_medicalhistory_right_upload_button">
          <input type="file" name="medicalhistoryFile" class="medicalhistoryFile" id="original"/>
           <div id="my-button">Choose File</div>
        </div>
        <div class="apointment_medicalhistory_right_input">
          <input placeholder="Name"  class="report_name" name="report_name" required="required"/>
          <textarea class="desc" name="desc" required="required" placeholder="Add Description"></textarea>
          <input type="hidden" name="history_type" class="history_type"/>
          <input type="hidden" name="bookingid_name" id="bookingid"/>
          <input type="hidden" name="patientid_name"  id="patientid"/>
          <button  class="apointment_medicalhistory_submit" id="homePhyMedicalhistory_submit">submit</button>
        </div>
      </div>
    </form>
    <div class="apointment_medicalhistory_tab1"></div>
    <div class="apointment_medicalhistory_tab2"></div>
    <div class="apointment_medicalhistory_tab3"></div>
    <div class="apointment_medicalhistory_tab4"></div>
    <div class="apointment_medicalhistory_tab5"></div>
    <div class="apointment_medicalhistory_tab6" ></div>
  </div>
</div>
<style>
.apointment_medicalhistory_left_homePhy {
    float: left;
    width: 20%;
}
.apointment_medicalhistory_left_homePhy ul {
    margin: 0;
}
.apointment_medicalhistory_left_homePhy ul li.active a {
    background: #0d92a7 none repeat scroll 0 0;
    color: #fff;
}
.apointment_medicalhistory_left_homePhy ul li a {
    color: #000;
    display: block;
    font-size: 15px;
    padding: 15px 20px;
    text-transform: uppercase;
}
</style>