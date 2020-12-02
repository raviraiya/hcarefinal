<div class="col-md-10 container_padding_none">
    <div class="content_right_dashboard">
        <div class="content_right_patients_titel">
            <h1>Medical History</h1>
        </div>
        
        <div class="content_right_appointments_box">
            <div class="col-md-3 container_padding_none " style="padding-top: 22px;">
                <div class="apointment_medicalhistory_patient_left">
    <ul>
      <li class="active"><a id="patientDocuments" href="javascript:void(0)">documents</a></li>
      <li><a href="javascript:void(0);" id="patientConditionsAllergeis">Conditions allergeis</a></li>
      <li><a href="javascript:void(0);" id="patientImmuniziation">immuniziation</a></li>
      <li><a href="javascript:void(0);" id="patientSurgicalProcedure">surgical procedure</a></li>
      <li><a href="javascript:void(0);" id="patientFamilyHistory">family history</a></li>
      <li><a href="javascript:void(0);" id="patientEyeSight">eye sight</a></li>
    </ul>
  </div>
            </div>
            <div style="" class="col-md-9 container_padding_none" id="patientDetails">
                <div class="appointments_right_padding">
                    
                    <div class="appointments_right_tabs">
                     
                        <div class="tab-content clearfix">
                            <div id="appointments" class="tab-pane">
                                                            </div>
                            <div id="prescription" class="tab-pane appointments_right_content_tabs">
                                                            </div>
                            <div id="medicalhistory" class="tab-pane appointments_right_content_tabs active">
                               <div class="apointment_medicalhistory_right_content_tabs3">
  
  <div class="apointment_medicalhistory_right">
    <form enctype="multipart/form-data" id="patientmHistoryForm" class="ng-pristine ng-valid">
      <div class="apointment_medicalhistory_right_upload">
        <h1 class="report_text">upload new report</h1>
        <div class="apointment_medicalhistory_right_upload_button">
          <input type="file" id="original" class="medicalhistoryFile" name="medicalhistoryFile">
           <div id="my-button">Choose File</div>
        </div>
        <div class="apointment_medicalhistory_right_input">
          <input required="required" name="report_name" class="report_name" placeholder="Name" />
          <textarea placeholder="Add Description" required="required" name="desc" class="desc"></textarea>
          <input type="text" class="year" name="reportYear" required="required" style="display:none" placeholder="Year"/>
          <input type="hidden" class="history_type" name="history_type" value="eyeSight">
          <input type="hidden" id="bookingid" name="bookingid_name">
          <input type="hidden" id="patientid" name="patientid_name">
           
          <button id="patient_medicalhistory_submit" class="apointment_medicalhistory_submit">submit</button>
        </div>
      </div>
      <input type="hidden" value="" id="patientID"/>
    </form>
	    <div class="apointment_medicalhistory_patient_tab1"></div> 
        <div class="apointment_medicalhistory_patient_tab2"></div>
        <div class="apointment_medicalhistory_patient_tab3"></div>
        <div class="apointment_medicalhistory_patient_tab4"></div>
        <div class="apointment_medicalhistory_patient_tab5"></div>
        <div class="apointment_medicalhistory_patient_tab6"></div>
  </div>
</div>                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(window).load(function() {
		window.arrayvar =[];
		jQuery(".apointment_medicalhistory_patient_tab1, .apointment_medicalhistory_patient_tab2,.apointment_medicalhistory_patient_tab3,.apointment_medicalhistory_patient_tab4,.apointment_medicalhistory_patient_tab5,.apointment_medicalhistory_patient_tab6").empty();
        jQuery("#patientDetails").show();
       // $("#appointments_time h1 i").text('');
      //  $("#appointments_name h1").text('');
      //  var time=jQuery(this).closest('ul').prev("h1").text();
      //  var name =jQuery(this).find('span').text();
        //var patientID =jQuery(this).find('span .patientid').val();
        //var bookingID =jQuery(this).find('span .bookingId').val();
        jQuery.ajax({
            url: baseUrl+'patient/getPatientDetails',
            type:"POST",
            cache:false,
            dataType:"json",
            success: function(response){
				console.log(response.medicalHistory);
				
					jQuery.each(response.medicalHistory,function(key,val){
						
						window.arrayvar.push(val);
						
                });
				    
				    jQuery('.apointment_medicalhistory_patient_left ul li:first').addClass("active");
				    jQuery(".history_type").val('documents');
				    jQuery('.apointment_medicalhistory_patient_tab1').empty();
				    jQuery(".apointment_medicalhistory_patient_tab2, .apointment_medicalhistory_patient_tab3,.apointment_medicalhistory_patient_tab4,.apointment_medicalhistory_patient_tab5,.apointment_medicalhistory_patient_tab6").css("display", "none");
				    jQuery(".apointment_medicalhistory_patient_tab1").css("display", "block");
				    jQuery.each(window.arrayvar, function(document_key, value) {
					    if(value.history_type == 'documents')
					    {
						jQuery('.apointment_medicalhistory_patient_tab1').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+value.historytitle+"</h1><div class='apointment_medicalhistory_report1'><div class='apointment_medicalhistory_report_button'><div class='apointment_medicalhistory_report_absolute'><span><a href='"+base_url+value.files+"'  target='_blank'>report <i class='fa fa-arrow-down' ></i></a></span></div></div></div><p>"+value.desc+"</p><h2></h2></div>");
						}
						});	
					}
				});
        //jQuery("#appointments_time h1 i").text(time);
       
})
jQuery(document).ready(function(){   
		     
      jQuery(document).on('click', '.apointment_medicalhistory_patient_left li', function(e){ 
 		  var resultArray =[]; 
		  var currentbutton= jQuery(this);
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
	     
		jQuery('.apointment_medicalhistory_patient_left li').removeClass("active"); 
	    currentbutton.addClass('active'); 
		var getID = currentbutton.children().attr('id'); 
		if(getID == 'patientDocuments') 
		{   jQuery('.apointment_medicalhistory_patient_tab1').empty(); 
			jQuery(".report_name").show(); 
			jQuery(".year").hide(); 
			jQuery(".desc").show(); 
			jQuery(".apointment_medicalhistory_right_upload_button").show(); 
			jQuery(".report_text").show(); 
			jQuery(".history_type").val("documents"); 
			jQuery(".apointment_medicalhistory_patient_tab2, .apointment_medicalhistory_patient_tab3,.apointment_medicalhistory_patient_tab4,.apointment_medicalhistory_patient_tab5,.apointment_medicalhistory_patient_tab5").css("display", "none"); 
			jQuery(".apointment_medicalhistory_patient_tab1").css("display", "block"); 
			     
			jQuery.each(resultArray, function(document_key, docvalue) { 
				if(docvalue.hasOwnProperty("documents") ){ 
					jQuery('.apointment_medicalhistory_patient_tab1').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.documents.historytitle+"</h1><div class='apointment_medicalhistory_report1'><div class='apointment_medicalhistory_report_button'><div class='apointment_medicalhistory_report_absolute'><span><a href='"+base_url+docvalue.documents.files+"'  target='_blank'>report <i class='fa fa-arrow-down' ></i></a></span></div></div></div><p>"+docvalue.documents.desc+"</p><h2></h2></div>"); 
				} 
                            }); 
			jQuery('input[name=report_name]').val(''); 
			jQuery('textarea[name=desc]').val('');				 
			} 
	    else if(getID == 'patientConditionsAllergeis') 
		{   
		     jQuery('.apointment_medicalhistory_patient_tab2').empty();  
			jQuery(".apointment_medicalhistory_right_upload_button").hide(); 
			jQuery(".report_name").show(); 
			jQuery(".year").hide(); 
			jQuery(".desc").show(); 
			jQuery(".report_text").hide(); 
			jQuery(".history_type").val("conditionsAllergeis"); 
			jQuery(".apointment_medicalhistory_patient_tab1, .apointment_medicalhistory_patient_tab3,.apointment_medicalhistory_patient_tab4,.apointment_medicalhistory_patient_tab5,.apointment_medicalhistory_patient_tab6").css("display", "none");  jQuery(".apointment_medicalhistory_patient_tab2").css("display", "block"); 
			jQuery.each(resultArray, function(conditionsAllergeis, docvalue) { 
				if(docvalue.hasOwnProperty("conditionsAllergeis") ){ 
					jQuery('.apointment_medicalhistory_patient_tab2').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.conditionsAllergeis.historytitle+"</h1><p>"+docvalue.conditionsAllergeis.desc+"</p><h2></h2></div>"); 
				} 
			 
                            }); 
			jQuery('input[name=report_name]').val(''); 
			jQuery('textarea[name=desc]').val('');				 
			} 
		else if(getID == 'patientImmuniziation') 
		{ 
			jQuery('.apointment_medicalhistory_patient_tab3').empty(); 
			jQuery(".apointment_medicalhistory_right_upload_button").hide(); 
			jQuery(".report_name").show(); 
			jQuery(".year").hide(); 
			jQuery(".desc").show(); 
			jQuery(".report_text").hide(); 
			jQuery(".history_type").val("immuniziation"); 
			jQuery(".apointment_medicalhistory_patient_tab1, .apointment_medicalhistory_patient_tab2,.apointment_medicalhistory_patient_tab4,.apointment_medicalhistory_patient_tab5,.apointment_medicalhistory_patient_tab6").css("display", "none"); 
			jQuery(".apointment_medicalhistory_patient_tab3").css("display", "block"); 
			jQuery.each(resultArray, function(immuniziation, docvalue) { 
			if(docvalue.hasOwnProperty("immuniziation") ){ 
					jQuery('.apointment_medicalhistory_patient_tab3').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.immuniziation.historytitle+"</h1><p>"+docvalue.immuniziation.desc+"</p><h2></h2></div>"); 
				} 
                            }); 
			jQuery('input[name=report_name]').val(''); 
			jQuery('textarea[name=desc]').val('');				 
			} 
		else if(getID == 'patientSurgicalProcedure') 
		{    
		    jQuery('.apointment_medicalhistory_patient_tab4').empty(); 
			jQuery(".apointment_medicalhistory_right_upload_button").hide(); 
			jQuery(".report_name").show(); 
			jQuery(".desc").show();
			jQuery(".year").show();  
			jQuery(".report_text").hide(); 
			jQuery(".history_type").val("surgicalProcedure"); 
			jQuery(".apointment_medicalhistory_patient_tab1, .apointment_medicalhistory_patient_tab2,.apointment_medicalhistory_patient_tab3,.apointment_medicalhistory_patient_tab5,.apointment_medicalhistory_patient_tab6").css("display", "none"); 
			jQuery(".apointment_medicalhistory_patient_tab4").css("display", "block"); 
			jQuery.each(resultArray, function(surgicalProcedure, docvalue) { 
				if(docvalue.hasOwnProperty("surgicalProcedure") ){ 
					jQuery('.apointment_medicalhistory_patient_tab4').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.surgicalProcedure.historytitle+"</h1><p>"+docvalue.surgicalProcedure.desc+"</p><h2></h2></div>"); 
				} 
			 
                            }); 
			jQuery('input[name=report_name]').val(''); 
			jQuery('textarea[name=desc]').val('');				 
			} 
		else if(getID == 'patientFamilyHistory') 
		{    
		    jQuery('.apointment_medicalhistory_patient_tab5').empty(); 
			jQuery(".apointment_medicalhistory_right_upload_button").hide(); 
			jQuery(".report_name").show(); 
			jQuery(".desc").show(); 
			jQuery(".year").hide(); 
			jQuery(".report_text").hide(); 
			jQuery(".history_type").val("familyHistory"); 
			jQuery(".apointment_medicalhistory_patient_tab1, .apointment_medicalhistory_patient_tab2,.apointment_medicalhistory_patient_tab3,.apointment_medicalhistory_patient_tab4,.apointment_medicalhistory_patient_tab6").css("display", "none"); 
			jQuery(".apointment_medicalhistory_patient_tab5").css("display", "block"); 
			jQuery.each(resultArray, function(familyHistory, docvalue) { 
				if(docvalue.hasOwnProperty("familyHistory") ){ 
					jQuery('.apointment_medicalhistory_patient_tab5').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.familyHistory.historytitle+"</h1><p>"+docvalue.familyHistory.desc+"</p><h2></h2></div>"); 
				} 
			 
                            }); 
			jQuery('input[name=report_name]').val(''); 
			jQuery('textarea[name=desc]').val('');				 
			} 
		else if(getID == 'patientEyeSight') 
		{ 
			 jQuery('.apointment_medicalhistory_patient_tab6').empty(); 
			jQuery(".apointment_medicalhistory_right_upload_button").hide(); 
			jQuery(".report_name").show(); 
			jQuery(".desc").show(); 
			jQuery(".year").hide(); 
			jQuery(".report_text").hide(); 
			jQuery(".history_type").val("eyeSight"); 
			jQuery(".apointment_medicalhistory_patient_tab1, .apointment_medicalhistory_patient_tab2,.apointment_medicalhistory_patient_tab3,.apointment_medicalhistory_patient_tab4,.apointment_medicalhistory_patient_tab5").css("display", "none"); 
			jQuery(".apointment_medicalhistory_patient_tab6").css("display", "block"); 
			jQuery.each(resultArray, function(eyeSight, docvalue) { 
				if(docvalue.hasOwnProperty("eyeSight") ){ 
					jQuery('.apointment_medicalhistory_patient_tab6').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.eyeSight.historytitle+"</h1><p>"+docvalue.eyeSight.desc+"</p><h2></h2></div>"); 
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
						//formData.append("patientid_name", $('input[name=patientid_name]').val()); 
						formData.append("tag", 'isImage'); 
				   } 
				else{ 
						formData.append("report_name", $('input[name=report_name]').val()); 
						formData.append("desc", $('textarea[name=desc]').val()); 
						formData.append("history_type", history_type); 
						formData.append("bookingid_name", $('input[name=bookingid_name]').val()); 
						//formData.append("patientid_name", $('input[name=patientid_name]').val()) 
					} 
				jQuery.ajax({ 
							url: base_url+'patient/addMedicalHistory', 
							data:formData, 
							type:"POST", 
							cache:false, 
							dataType:"json", 
       					    contentType: false, 
                            processData: false, 
						    encode : true, 
							success: function(response){ 
							if(response.success == 1){ 
							   bootbox.alert(response.message, function() { 
										//window.location.reload(); 
								if(response.data.history_type == 'documents'){ 
					                  jQuery('.apointment_medicalhistory_patient_tab1').prepend("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><div class='apointment_medicalhistory_report1'><div class='apointment_medicalhistory_report_button'><div class='apointment_medicalhistory_report_absolute'><span><a href='"+base_url+response.data.files+"'  target='_blank'>report <i class='fa fa-arrow-down' ></i></a></span></div></div></div><p>"+response.data.desc+"</p><h2></h2></div>"); 
									  window.arrayvar.unshift(response.data); 
									   
				                                } 
				                else if(response.data.history_type == 'conditionsAllergeis'){ 
					                  jQuery('.apointment_medicalhistory_patient_tab2').prepend("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>"); 
									  window.arrayvar.unshift(response.data); 
				                                } 
						 		else if(response.data.history_type == 'immuniziation'){ 
					                  jQuery('.apointment_medicalhistory_patient_tab3').prepend("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>"); 
									  window.arrayvar.unshift(response.data); 
				                                } 
								else if(response.data.history_type == 'surgicalProcedure'){ 
					                  jQuery('.apointment_medicalhistory_patient_tab4').prepend("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>"); 
									  window.arrayvar.unshift(response.data); 
				                                } 
								else if(response.data.history_type == 'familyHistory'){ 
					                  jQuery('.apointment_medicalhistory_patient_tab5').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>"); 
									  window.arrayvar.unshift(response.data); 
				                                } 
								else if(response.data.history_type == 'eyeSight'){ 
					                  jQuery('.apointment_medicalhistory_patient_tab6').prepend("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>"); 
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