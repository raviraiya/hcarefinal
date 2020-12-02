<div class="col-md-10 container_padding_none">
    <div class="content_right_dashboard">
        <div class="content_right_patients_titel">
            <h1>Appointments</h1>
        </div>
        <div class="content_right1_patients">
            <div class="appointments_width_block">
                <div class="patients_select patients_select_width select-style">
                    <select id="procedure">
                        <option value="">Select Procedure</option>
                        <?php foreach($procedure as $procedureDetails) { ?>
                            <option value='<?php echo $procedureDetails->ID;?>'><?php echo $procedureDetails->category_name;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="patients_select patients_select_width select-style">
                    <select id="procedureCategory">
                        <option value="">Select Procedure</option>
                    </select>
                </div>
                <div class="patients_select">
                    <label class="date_label">
                        <input id="datepicker" class="hasDatepicker" type="text">
                    </label>
                </div>
                <div class="patients_select appointments_button_go patients_input_width select-style"> <a id='goBtn' href="javascript:void(0)" class="">GO</a> </div>
            </div>
        </div>
        <div class="content_right_appointments_box">
            <div class="col-md-3 container_padding_none">
                <div class="content_right_appointments_left_box">
                    <div class="content_right_appointments_titel"> <a href="javascript:void(0)"><i class="fa fa-calendar"></i> <?php echo $todaysdate ?></a> <a href="#" class="content_right_appointments_patients"><?php echo $totalpatient ?> patients</a> </div>
                    <div class="content_right_appointments_menu">
                        <?php foreach($slotwiseAppointment as $key => $value){ ?>
                            <div class="appointmentList">
                                <h1><i class="fa fa-clock-o"></i> <?php echo $key ?></h1>
                                <ul>
                                    <?php foreach($value as $appKey => $appointmentName){ ?>
                                        <li> <a href="javascript:void(0)" patientid="<?php echo $appointmentName['patientID'] ?>" bookingid="<?php echo $appointmentName['bookingID'] ?>" id="patientAppointmentDetails"> <img src="<?php echo base_url(); ?><?php echo $appointmentName['pic'] ?>" /> <span><?php echo $appointmentName['name'] ?>
                                                    <input type="hidden" class="patientid" value="<?php echo $appointmentName['patientID'] ?>"><input type="hidden" class="bookingId" value="<?php echo $appointmentName['bookingID'] ?>"></span> </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div id="patientDetails" class="col-md-9 container_padding_none" style="display:none">
                <div class="appointments_right_padding">
                    <div class="appointments_right_overflow">
                        <div class="appointments_left_block"> <img id='appointments_pic' src="" style="display:none"/>
                            <div class="appointments_left_block_text" id='appointments_name'>
                                <h1></h1>
                                <p id='appointments_age'></p>
                            </div>
                        </div>
                        <div class="appointments_right_block" id='appointments_time'>
                            <h1><i class="fa fa-clock-o"></i></h1>
                            <a href="#inline1" class="fancybox appointments_right_button_complete">complete</a>
                            <div id="inline1" style="width:300px;display: none;">
                                <div class="popup_button_complete">
                                    <h1>Are you Sure?</h1>
                                    <p>You want to mark complete.</p>
                                    <div class="popup_button_complete_button"> <a href="javascript:void(0)" id="markComplete" class="active">yes</a> <a href="javascript:void(0)" id="fancyboxClose">no</a> </div>
                                </div>
                            </div>
                            <a href="#inline2" class="fancybox appointments_right_button_cancel">cancel</a> </div>
                        <div id="inline2" style="width:300px;display: none;">
                            <div class="popup_button_complete">
                                <h1>Do You want to cancel Booking?</h1>
                                <div class="popup_button_complete_button"> <a href="javascript:void(0)" class="active" id="pbookingCancel">yes</a>
                                    <a href="javascript:void(0)" id="fancyboxClose">no</a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="appointments_right_tabs">
                     <ul class="nav appointments_right_menu">
                            <li class="active"><a href="#appointments" data-toggle="tab">checkup</a></li>
                            <li><a href="#prescription" data-toggle="tab">prescription</a></li>
                             <li><a href="#medicalhistory" data-toggle="tab" class="patientMedicalHis">medical history</a></li>
                             <!--<li><a href="#message" data-toggle="tab">message</a></li> -->
                       </ul>
                        <div class="tab-content clearfix">
                            <div class="tab-pane  active " id="appointments">
                                <?php //include('appointments/appointments.php'); ?>
                            </div>
                            <div class="tab-pane appointments_right_content_tabs" id="prescription">
                                <?php //include('appointments/prescription.php'); ?>
                            </div>
                            <div class="tab-pane appointments_right_content_tabs" id="medicalhistory">
                               <?php include('appointments/medicalhistory.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="bookingid" />
<input type="hidden" id="patientid" />
<style>
    .left_sidebar_border{min-height: 900px !important;  }
</style>
<script>
jQuery(document).ready(function(){
    jQuery(document).on('click', '#patientAppointmentDetails', function(e){
		window.arrayvar =[];
		var bookingid = jQuery(this).attr('bookingid');
        var patientid = jQuery(this).attr('patientid');
		jQuery(".apointment_medicalhistory_box_img1, .apointment_medicalhistory_box_img2,.apointment_medicalhistory_box_img3,.apointment_medicalhistory_box_img4,.apointment_medicalhistory_box_img5,.apointment_medicalhistory_box_img6").empty();
       // jQuery("#temperature").val('');
        //jQuery("#heartbeat").val('');
       // jQuery("#bloodpreassure").val('');
        //jQuery("#bloodsugar").val('');
        jQuery("#patientDetails").show();
        $("#appointments_time h1 i").text('');
        $("#appointments_name h1").text('');
        jQuery("#bookingid").val(bookingid);
        jQuery("#patientid").val(patientid);
        var time=jQuery(this).closest('ul').prev("h1").text();
        var name =jQuery(this).find('span').text();
        var patientID =jQuery(this).find('span .patientid').val();
        var bookingID =jQuery(this).find('span .bookingId').val();
        jQuery.ajax({
            url: baseUrl+'patient/getPatientDetails',
            data: {'patientID':patientID, 'bookingID':bookingID},
            type:"POST",
            cache:false,
            dataType:"json",
            success: function(response){
               /* jQuery.each(response.patientDetails,function(key,val){
                    jQuery("#appointments_name h1").text(val.fname+" "+val.lname);
                    jQuery("#appointments_pic").attr("src", baseUrl+val.picture);
                    jQuery("#appointments_pic").css("display", 'block');
                    dob = new Date(val.dob);
                    var today = new Date();
                    var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                    jQuery(".appointments_left_block_text p").text(val.sex+'  • '+age+' years');
                });
				jQuery.each(response.checkupDetails,function(key,val){
                    jQuery("#temperature").val(val.temp);
					jQuery("#heartbeat").val(val.heartbit);
					jQuery("#bloodpreassure").val(val.BD);
					jQuery("#bloodsugar").val(val.BG);
					jQuery("#waterlevel").val(val.weight);
					jQuery("#weight").val(val.water_level);
					jQuery("#bodyfat").val(val.body_fat);
                });*/
				console.log(response.medicalHistory);
				
					jQuery.each(response.medicalHistory,function(key,val){
						
						window.arrayvar.push(val);
						
                });
				    
		jQuery('.apointment_medicalhistory_patient_left ul li:first').addClass("active");
		jQuery(".history_type").val('documents');
		jQuery('.apointment_medicalhistory_box_img1').empty();
		jQuery(".apointment_medicalhistory_box_img2, .apointment_medicalhistory_box_img3,.apointment_medicalhistory_box_img4,.apointment_medicalhistory_box_img5,.apointment_medicalhistory_box_img6").css("display", "none");
		jQuery(".apointment_medicalhistory_box_img1").css("display", "block");
		//console.log(window.arrayvar);
		jQuery.each(window.arrayvar, function(document_key, value) {
			if(value.history_type == 'documents')
			{
				jQuery('.apointment_medicalhistory_box_img1').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+value.historytitle+"</h1><div class='apointment_medicalhistory_report1'><img src='"+base_url+"assets/images/apointment_medicalhistory_img1.png' /><div class='apointment_medicalhistory_report_button'><div class='apointment_medicalhistory_report_absolute'><span><a href='"+base_url+value.files+"'  target='_blank'>report <i class='fa fa-arrow-down' ></i></a></span></div></div></div><p>"+value.desc+"</p><h2></h2></div>");
				}
			
				});	
		
            }
        });
        jQuery("#appointments_time h1 i").text(time);
       });
	   
    jQuery(document).on('click', '.patientMedicalHis',function() {
		jQuery('.apointment_medicalhistory_patient_left ul li:first').addClass("active");
		jQuery(".history_type").val('documents');
		jQuery('.apointment_medicalhistory_box_img1').empty();
		jQuery(".apointment_medicalhistory_box_img2, .apointment_medicalhistory_box_img3,.apointment_medicalhistory_box_img4,.apointment_medicalhistory_box_img5,.apointment_medicalhistory_box_img6").css("display", "none");
		jQuery(".apointment_medicalhistory_box_img1").css("display", "block");
		//console.log(window.arrayvar);
		jQuery.each(window.arrayvar, function(document_key, value) {
			if(value.history_type == 'documents')
			{
				jQuery('.apointment_medicalhistory_box_img1').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+value.historytitle+"</h1><div class='apointment_medicalhistory_report1'><img src='"+base_url+"assets/images/apointment_medicalhistory_img1.png' /><div class='apointment_medicalhistory_report_button'><div class='apointment_medicalhistory_report_absolute'><span><a href='"+base_url+value.files+"'  target='_blank'>report <i class='fa fa-arrow-down' ></i></a></span></div></div></div><p>"+value.desc+"</p><h2></h2></div>");
				}
			
				});	
		});  
		
    jQuery(document).on('click', '.apointment_medicalhistory_patient_left li', function(e){
		  var resultArray =[];
		  if(window.arrayvar != ''){
		  jQuery.each(window.arrayvar,function(key,value){
			  if(value.history_type == 'documents')
			  {resultArray.push({'documents'  : value});
			  }
			   if(value.history_type == 'conditionsAllergeis')
			  {resultArray.push({'conditionsAllergeis' : value});}
			  if(value.history_type == 'immuniziation')
			  {resultArray.push({'immuniziation' :  value});}
			
			  if(value.history_type == 'surgicalProcedure')
			  {resultArray.push({'surgicalProcedure' : value});}
			 
			  if(value.history_type == 'familyHistory')
			  {resultArray.push({'familyHistory' :  value});}
			  
			  if(value.history_type == 'eyeSight')
			  {resultArray.push({'eyeSight' : value});}
			  });
		  }
		// console.log(resultArray);
	    var currentbutton= jQuery(this); 
		jQuery('.apointment_medicalhistory_patient_left li').removeClass("active");
	    currentbutton.addClass('active');
		var getID = currentbutton.children().attr('id');
		if(getID == 'patientDocuments')
		{   jQuery('.apointment_medicalhistory_box_img1').empty();
			jQuery(".report_name").show();
			jQuery(".desc").show();
			jQuery(".apointment_medicalhistory_right_upload_button").show();
			jQuery(".report_text").show();
			jQuery(".history_type").val("documents");
			jQuery(".apointment_medicalhistory_box_img2, .apointment_medicalhistory_box_img3,.apointment_medicalhistory_box_img4,.apointment_medicalhistory_box_img5,.apointment_medicalhistory_box_img6").css("display", "none");
			jQuery(".apointment_medicalhistory_box_img1").css("display", "block");
			    
			jQuery.each(resultArray, function(document_key, docvalue) {
				if(docvalue.hasOwnProperty("documents") ){
					jQuery('.apointment_medicalhistory_box_img1').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.documents.historytitle+"</h1><div class='apointment_medicalhistory_report1'><img src='"+base_url+"assets/images/apointment_medicalhistory_img1.png' /><div class='apointment_medicalhistory_report_button'><div class='apointment_medicalhistory_report_absolute'><span><a href='"+base_url+docvalue.documents.files+"'  target='_blank'>report <i class='fa fa-arrow-down' ></i></a></span></div></div></div><p>"+docvalue.documents.desc+"</p><h2></h2></div>");
				}
                            });
			jQuery('input[name=report_name]').val('');
			jQuery('textarea[name=desc]').val('');				
			}
	    else if(getID == 'patientConditionsAllergeis')
		{  
		     jQuery('.apointment_medicalhistory_box_img2').empty(); 
			jQuery(".apointment_medicalhistory_right_upload_button").hide();
			jQuery(".report_name").show();
			jQuery(".desc").show();
			jQuery(".report_text").hide();
			jQuery(".history_type").val("conditionsAllergeis");
			jQuery(".apointment_medicalhistory_box_img1, .apointment_medicalhistory_box_img3,.apointment_medicalhistory_box_img4,.apointment_medicalhistory_box_img5,.apointment_medicalhistory_box_img6").css("display", "none");  jQuery(".apointment_medicalhistory_box_img2").css("display", "block");
			jQuery.each(resultArray, function(conditionsAllergeis, docvalue) {
				if(docvalue.hasOwnProperty("conditionsAllergeis") ){
					jQuery('.apointment_medicalhistory_box_img2').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.conditionsAllergeis.historytitle+"</h1><p>"+docvalue.conditionsAllergeis.desc+"</p><h2></h2></div>");
				}
			
                            });
			jQuery('input[name=report_name]').val('');
			jQuery('textarea[name=desc]').val('');				
			}
		else if(getID == 'patientImmuniziation')
		{
			jQuery('.apointment_medicalhistory_box_img3').empty();
			jQuery(".apointment_medicalhistory_right_upload_button").hide();
			jQuery(".report_name").show();
			jQuery(".desc").show();
			jQuery(".report_text").hide();
			jQuery(".history_type").val("immuniziation");
			jQuery(".apointment_medicalhistory_box_img1, .apointment_medicalhistory_box_img2,.apointment_medicalhistory_box_img4,.apointment_medicalhistory_box_img5,.apointment_medicalhistory_box_img6").css("display", "none");
			jQuery(".apointment_medicalhistory_box_img3").css("display", "block");
			jQuery.each(resultArray, function(immuniziation, docvalue) {
			if(docvalue.hasOwnProperty("immuniziation") ){
					jQuery('.apointment_medicalhistory_box_img3').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.immuniziation.historytitle+"</h1><p>"+docvalue.immuniziation.desc+"</p><h2></h2></div>");
				}
                            });
			jQuery('input[name=report_name]').val('');
			jQuery('textarea[name=desc]').val('');				
			}
		else if(getID == 'patientSurgicalProcedure')
		{   
		    jQuery('.apointment_medicalhistory_box_img4').empty();
			jQuery(".apointment_medicalhistory_right_upload_button").hide();
			jQuery(".report_name").show();
			jQuery(".desc").show();
			jQuery(".report_text").hide();
			jQuery(".history_type").val("surgicalProcedure");
			jQuery(".apointment_medicalhistory_box_img1, .apointment_medicalhistory_box_img2,.apointment_medicalhistory_box_img3,.apointment_medicalhistory_box_img5,.apointment_medicalhistory_box_img6").css("display", "none");
			jQuery(".apointment_medicalhistory_box_img4").css("display", "block");
			jQuery.each(resultArray, function(surgicalProcedure, docvalue) {
				if(docvalue.hasOwnProperty("surgicalProcedure") ){
					jQuery('.apointment_medicalhistory_box_img4').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.surgicalProcedure.historytitle+"</h1><p>"+docvalue.surgicalProcedure.desc+"</p><h2></h2></div>");
				}
			
                            });
			jQuery('input[name=report_name]').val('');
			jQuery('textarea[name=desc]').val('');				
			}
		else if(getID == 'patientFamilyHistory')
		{   
		    jQuery('.apointment_medicalhistory_box_img5').empty();
			jQuery(".apointment_medicalhistory_right_upload_button").hide();
			jQuery(".report_name").show();
			jQuery(".desc").show();
			jQuery(".report_text").hide();
			jQuery(".history_type").val("familyHistory");
			jQuery(".apointment_medicalhistory_box_img1, .apointment_medicalhistory_box_img2,.apointment_medicalhistory_box_img3,.apointment_medicalhistory_box_img4,.apointment_medicalhistory_box_img6").css("display", "none");
			jQuery(".apointment_medicalhistory_box_img5").css("display", "block");
			jQuery.each(resultArray, function(familyHistory, docvalue) {
				if(docvalue.hasOwnProperty("familyHistory") ){
					jQuery('.apointment_medicalhistory_box_img5').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.familyHistory.historytitle+"</h1><p>"+docvalue.familyHistory.desc+"</p><h2></h2></div>");
				}
			
                            });
			jQuery('input[name=report_name]').val('');
			jQuery('textarea[name=desc]').val('');				
			}
		else if(getID == 'patientEyeSight')
		{
			 jQuery('.apointment_medicalhistory_box_img6').empty();
			jQuery(".apointment_medicalhistory_right_upload_button").hide();
			jQuery(".report_name").show();
			jQuery(".desc").show();
			jQuery(".report_text").hide();
			jQuery(".history_type").val("eyeSight");
			jQuery(".apointment_medicalhistory_box_img1, .apointment_medicalhistory_box_img2,.apointment_medicalhistory_box_img3,.apointment_medicalhistory_box_img4,.apointment_medicalhistory_box_img5").css("display", "none");
			jQuery(".apointment_medicalhistory_box_img6").css("display", "block");
			jQuery.each(resultArray, function(eyeSight, docvalue) {
				if(docvalue.hasOwnProperty("eyeSight") ){
					jQuery('.apointment_medicalhistory_box_img6').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.eyeSight.historytitle+"</h1><p>"+docvalue.eyeSight.desc+"</p><h2></h2></div>");
				}
			
                            });
		    jQuery('input[name=report_name]').val('');
			jQuery('textarea[name=desc]').val('');					
			}
        });
		
	jQuery('#patientmHistoryForm').submit(function(e){
			  e.preventDefault();
			 var formData = new FormData(this);
			 var history_type = jQuery(".history_type").val();
			 var data = new Array();
				if(history_type == 'patientDocuments')
				   {    formData.append("medicalhistoryFile", $('input[name=medicalhistoryFile]').val());
						formData.append("report_name", $('input[name=report_name]').val());
						formData.append("desc", $('textarea[name=desc]').val());
						formData.append("history_type", $('input[name=history_type]').val());
						formData.append("bookingid_name", $('input[name=bookingid_name]').val());
						formData.append("patientid_name", $('input[name=patientid_name]').val());
						formData.append("tag", 'isImage');
				   }
				else{
						formData.append("report_name", $('input[name=report_name]').val());
						formData.append("desc", $('textarea[name=desc]').val());
						formData.append("history_type", history_type);
						formData.append("bookingid_name", $('input[name=bookingid_name]').val());
						formData.append("patientid_name", $('input[name=patientid_name]').val())
					}
				jQuery.ajax({
							url: baseUrl+'patient/medicalHistory',
							data:formData,
							type:"POST",
							cache:false,
							dataType:"json",
       					    contentType: false,
                            processData: false,
						    encode : true,
							success: function(response){
								//console.log(response);
								
							if(response.success == 1){
							   bootbox.alert(response.message, function() {
										//window.location.reload();
								if(response.data.history_type == 'documents'){
					                  jQuery('.apointment_medicalhistory_box_img1').prepend("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><div class='apointment_medicalhistory_report1'><img src='"+base_url+"assets/images/apointment_medicalhistory_img1.png' /><div class='apointment_medicalhistory_report_button'><div class='apointment_medicalhistory_report_absolute'><span><a href='"+base_url+response.data.files+"'  target='_blank'>report <i class='fa fa-arrow-down' ></i></a></span></div></div></div><p>"+response.data.desc+"</p><h2></h2></div>");
									  window.arrayvar.unshift(response.data);
									  
				                                }
				                else if(response.data.history_type == 'conditionsAllergeis'){
					                  jQuery('.apointment_medicalhistory_box_img2').prepend("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>");
									  window.arrayvar.unshift(response.data);
				                                }
						 		else if(response.data.history_type == 'immuniziation'){
					                  jQuery('.apointment_medicalhistory_box_img3').prepend("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>");
									  window.arrayvar.unshift(response.data);
				                                }
								else if(response.data.history_type == 'surgicalProcedure'){
					                  jQuery('.apointment_medicalhistory_box_img4').prepend("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>");
									  window.arrayvar.unshift(response.data);
				                                }
								else if(response.data.history_type == 'familyHistory'){
					                  jQuery('.apointment_medicalhistory_box_img5').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>");
									  window.arrayvar.unshift(response.data);
				                                }
								else if(response.data.history_type == 'eyeSight'){
					                  jQuery('.apointment_medicalhistory_box_img6').prepend("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>");
									  window.arrayvar.unshift(response.data);
				                                }	
									jQuery('input[name=report_name]').val('');
									jQuery('textarea[name=desc]').val('');																		
									});
								}else if(response.error == 1){
								   bootbox.alert(response.message, function() {
								   });
								}
							},
							error: function(response){
								console.log(response);
			
								console.log("Error");
			
							}
			
						});
				});
		  
	   });
</script>
