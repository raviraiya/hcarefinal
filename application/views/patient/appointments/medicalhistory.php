<?php header('Content-disposition: inline'); ?>
<div class="apointment_medicalhistory_right_content_tabs3">
  <div class="apointment_medicalhistory_patient_left">
    <ul>
      <li class="active"><a href="javascript:void(0)" id="patientDocuments">documents</a></li>
      <li><a href="javascript:void(0);" id="patientConditionsAllergeis">Conditions allergeis</a></li>
      <li><a href="javascript:void(0);" id="patientImmuniziation">immuniziation</a></li>
      <li><a href="javascript:void(0);" id="patientSurgicalProcedure">surgical procedure</a></li>
      <!-- <li><a href="#">last appointment</a></li>-->
      <li><a href="javascript:void(0);" id="patientFamilyHistory">family history</a></li>
      <li><a href="javascript:void(0);" id="patientEyeSight">eye sight</a></li>
    </ul>
  </div>
  <div class="apointment_medicalhistory_right">
    <form id='patientmHistoryForm' enctype="multipart/form-data">
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
          <button  class="apointment_medicalhistory_submit" id="patient_medicalhistory_submit">submit</button>
        </div>
      </div>
    </form>
    <div class="apointment_medicalhistory_box_img1"></div>
    <div class="apointment_medicalhistory_box_img2"></div>
    <div class="apointment_medicalhistory_box_img3"></div>
    <div class="apointment_medicalhistory_box_img4"></div>
    <div class="apointment_medicalhistory_box_img5"></div>
    <div class="apointment_medicalhistory_box_img6" ></div>
  </div>
</div>