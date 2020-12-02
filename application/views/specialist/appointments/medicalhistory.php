<?php header('Content-disposition: inline'); ?>
<div class="apointment_medicalhistory_right_content_tabs3">
  <div class="apointment_medicalhistory_left">
    <ul>
      <li class="active"><a href="javascript:void(0)" id="documents">documents</a></li>
      <li><a href="javascript:void(0);" id="conditionsAllergeis">Conditions allergeis</a></li>
      <li><a href="javascript:void(0);" id="immuniziation">immuniziation</a></li>
      <li><a href="javascript:void(0);" id="surgicalProcedure">surgical procedure</a></li>
      <!-- <li><a href="#">last appointment</a></li>-->
      <li><a href="javascript:void(0);" id="familyHistory">family history</a></li>
      <li><a href="javascript:void(0);" id="eyeSight">eye sight</a></li>
    </ul>
  </div>
  <div class="apointment_medicalhistory_right">
    <form id='mHistoryForm' enctype="multipart/form-data">
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
          <button  class="apointment_medicalhistory_submit" id="medicalhistory_submit">submit</button>
        </div>
      </div>
    </form>
    <div class="apointment_medicalhistory_box_img1">
      <!--<div class="apointment_medicalhistory_box_img_left">
        <h1>2D X-Ray</h1>
        <div class="apointment_medicalhistory_report1">         
        <iframe src='<?php //echo base_url();?>assets/patient/history/appointmentMedicalHistory_1_1470396810.docx&embedded=true' frameborder='0'></iframe>
          <div class="apointment_medicalhistory_report_button">
            <div class="apointment_medicalhistory_report_absolute"> <span><a href="#">report <i class="fa fa-arrow-down" ></i></a></span> </div>
          </div>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation </p>
        <h2>MRI</h2>
      </div>-->
      <!--<div class="apointment_medicalhistory_box_img_left">
        <h1>Biochemistry Reports</h1>
        <div class="apointment_medicalhistory_report1"> <img src="images/apointment_medicalhistory_img2.png" />
          <div class="apointment_medicalhistory_report_button">
            <div class="apointment_medicalhistory_report_absolute"> <span><a href="#">report <i class="fa fa-arrow-down" ></i></a></span> </div>
          </div>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation </p>
        <h2>CT Scan</h2>
      </div>-->
      
    </div>
    <div class="apointment_medicalhistory_box_img2"></div>
    <div class="apointment_medicalhistory_box_img3"></div>
    <div class="apointment_medicalhistory_box_img4"></div>
    <div class="apointment_medicalhistory_box_img5"></div>
    <div class="apointment_medicalhistory_box_img6" ></div>
  </div>
</div>