window.arrayvar =[];

$(document).ready(function() {

	var baseUrl = get_base_url();

	

	/*jQuery("#addSpecialistSecond").hide();

    jQuery(document).on('click', '#specialistFirst', function(){

		jQuery("#addSpecialistFirst").hide();

		jQuery("#addSpecialistSecond").show();		

	});

	jQuery(document).on('click', '#specialistSecond', function(){

		jQuery("#addSpecialistFirst").show();

		jQuery("#addSpecialistSecond").hide();		

	});*/

	/*$('#addPatient').validator().on('submit', function (e) {

		var invite=$('#invite_code').val();

		var license=$('#h_p_licence_no').val();

		if(invite=='' && license==''){

			

			$("#invite_code,#h_p_licence_no").css({"border-color": "#a94442", "box-shadow": "0 1px 1px rgba(0, 0, 0, 0.075) inset;"});

			$('#invite_code,#h_p_licence_no').next('.help-block').html('Invite Code or License Number must not empty');

			e.preventDefault();

		}

		if(invite!='' && license!=''){

			$("#invite_code,#h_p_licence_no").css({"border-color": "#a94442", "box-shadow": "0 1px 1px rgba(0, 0, 0, 0.075) inset;"});

			$('#invite_code,#h_p_licence_no').next('.help-block').html('<style="color: #a94442">Sould fill Invite Code or License Number at a time.</style>');

			e.preventDefault();

		}

		/*if (e.isDefaultPrevented()) {

			alert("not validated");

		// handle the invalid form...

		} else {

			alert("validated");

		// everything looks good!

		}

	});*/

	

	//For edit staff details

	/*jQuery(document).on('click', '#staffEdit', function(e){

		e.preventDefault();

		var formData = new FormData();

		var file = '';

		if (jQuery('#File1').val()){  

			file = jQuery("#staffImage")[0].files[0];

		}

		var staffname = jQuery("#editstaffName").val();

		var staffcategory = jQuery("#editstaffCategory").val();

		var staff_id = jQuery("#staffID").val();

		

		formData.append("ID", staff_id);

		formData.append("pic", file);

		formData.append("staff_name", staffname);

		formData.append("staff_cat_id", staffcategory);

		

		jQuery.ajax({

			url: baseUrl+'specialist/staff_edit',

			data: formData,

			type:"POST",

			cache:false,

			dataType:"json",

			contentType: false,

            processData: false,

   			global: false,

			success: function(response){

				console.log("Success");

				if(response.success == 1){

					bootbox.alert(response.message, function() {

							window.location.reload();

					});

				}else if(response.error == 1){

					bootbox.alert(response.message, function() {

							window.location.reload();

					});

				}

			},

			error: function(response){console.log(response);

				console.log("Error");

			}

		});

	});*/

	jQuery('#test').on('beforeItemRemove', function(event){

		event.preventDefault();

		var strconfirm = confirm("Are you sure you want to delete?");

		if (strconfirm == true){

			var tag = event.item;

			// Do some processing here

			if (!event.options || !event.options.preventPost) {

				  jQuery.ajax({

					url: baseUrl+'staffcategory/delete',

					data: {'tag':tag},

					type:"POST",

					cache:false,

					dataType:"json",

					success: function(response){

						console.log("Success");

						jQuery(".fancybox-overlay").hide();

						if(response.success == 1){

							bootbox.alert(response.message);

							window.location.reload();

						}else if(response.error == 1){

							bootbox.alert(response.message);

							window.location.reload();

						}

					},

					error: function(response){console.log(response);

						console.log("Error");

					}

				});

			}

        }else{

			return false;

		}

	});

	

	//For fetching particular patient appointment details 

	jQuery(document).on('click', '#appointmentDetails', function(e){

		e.preventDefault();

		

		var bookingid = jQuery(this).attr('bookingid');

		var patientid = jQuery(this).attr('patientid');

		jQuery("#bookingid").val(bookingid);

		jQuery("#patientid").val(patientid);

		jQuery(".appointments_right_tabs ul li").removeClass("active");

		jQuery(".appointments_right_tabs ul li:eq(0)").addClass("active");

		jQuery(".tab-content div").removeClass("active");

		jQuery(".tab-content div:eq(0)").addClass("active");	

	});

	

	jQuery(document).on('click', '#checkupSave', function(e){

		e.preventDefault();

		

		var bookingid = jQuery("#bookingid").val();

		var patientid = jQuery("#patientid").val();

		var temperature = jQuery("#temperature").val();

		var heartbeat = jQuery("#heartbeat").val();

		var bloodpreassure = jQuery("#bloodpreassure").val();

		var bloodsugar = jQuery("#bloodsugar").val();

		var waterlevel = jQuery("#waterlevel").val();

		var weight = jQuery("#weight").val();

		var bodyfat = jQuery("#bodyfat").val();

		var tag = "checkup";

				

		jQuery.ajax({

			url: baseUrl+'specialist/appointment',

			data: {'bookingid':bookingid, 'patientid':patientid, 'temperature':temperature, 'heartbeat':heartbeat, 'bloodpreassure':bloodpreassure, 

				   'bloodsugar':bloodsugar, 'waterlevel':waterlevel, 'weight':weight, 'bodyfat':bodyfat, 'tag':tag},

			type:"POST",

			dataType:"json",

			success: function(response){

				console.log("Success");

				if(response.success == 1){

					bootbox.alert(response.message, function() {

  						window.location.reload();

					});

				}else if(response.error == 1){

					bootbox.alert(response.message, function() {

  						window.location.reload();

					});

				}

			},

			error: function(response){

				console.log("Error");

			}

		});

	});

	

	jQuery(document).on('click', '#physicianAppointmentDetails', function(e){

		var bookingid = jQuery(this).attr('bookingid');

		var patientid = jQuery(this).attr('patientid');

		window.arrayvar =[];

		jQuery(".apointment_medicalhistory_tab1, .apointment_medicalhistory_tab2,.apointment_medicalhistory_tab3,.apointment_medicalhistory_tab4,.apointment_medicalhistory_tab5,.apointment_medicalhistory_tab6").empty();

		

		//alert(bookingid+'----'+patientid);

		var time = jQuery(this).closest('ul').prev("h1").text();

		jQuery("#bookingid").val(bookingid);

		jQuery("#patientid").val(patientid);

		

		jQuery.ajax({

			url: 'physicianappointment_details',

			data: {'bookingid':bookingid,'patientid':patientid},

			type:"POST",

			cache:false,

			dataType:"json",

			success: function(response){

				if(response.success == 1){

					jQuery("#physicianappointmentDetails").show();

					jQuery(response.appointmentdetails).each(function(index, value){

						var dob = new Date(value.dob);

						var today = new Date();

						var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));

					

        				jQuery(".appointments_homephy_right_menu li h1").text(value.name);

						jQuery(".appointments_homephy_right_menu li:eq(1) h2 ").text(value.category_name);

						jQuery(".appointments_homephy_right_menu li:eq(2) h2 ").text(value.procedure_name);

						jQuery(".appointments_homephy_right_menu li:eq(3) h2 ").text(value.from_price+' - '+value.to_price);

						jQuery(".appointments_homephy_right_content p").text(value.description);

						jQuery(".appointments_homephy_left img").attr('src', baseUrl+value.specpic);

						jQuery(".appointments_homephy_left img").css('display', 'block');	

						jQuery(".appointments_left_block_text h1").text(value.fname+' '+value.lname);

						jQuery(".appointments_left_block_text p").text(value.sex+'  • '+age+' years');

						jQuery(".appointments_left_block img").attr('src', baseUrl+value.picture);	

						jQuery(".appointments_left_block img").css('display', 'block');

						jQuery(".appointments_homephy_left_price").html('');

						jQuery(".appointments_homephy_left_price").html('<i class="fa fa-star"></i> <span>'+value.rating+'</span>' );

    				});

					

						jQuery.each(response.medicalHistory,function(key,val){

						           window.arrayvar.push(val);

                   });

				

					jQuery(".appointments_right_block h1 i").text(time);

				}else{

					jQuery("#physicianappointmentDetails").hide();

				}

			}

		});	

	});

	

	jQuery(document).on('click', '#filterHphysician', function(e){

		e.preventDefault();

		var procedureCategory = jQuery("#procedure").val();

		var procedureName = jQuery("#procedureCategory").val();

		var datepicker = jQuery("#datepicker").val();

		if(procedureCategory == '' || procedureName == '' || datepicker == ''){

			bootbox.alert("All fields are required.");	

		}

		else{

			jQuery.ajax({

				url: 'appointment_filter',

				data: {'procedureCategory': procedureCategory,'procedureName': procedureName, 'datepicker': datepicker},

				type:"POST",

				cache:false,

				dataType:"json",

				success: function(response){

					var count=response.length;

					jQuery(".content_right_appointments_menu,.content_right_appointments_patients").html("");

					jQuery(".content_right_appointments_patients").html(response.totalpatient+" patients");

					jQuery(".content_right_appointments_titel a:eq(0)").html("");

					jQuery(".content_right_appointments_titel a:eq(0)").html('<i class="fa fa-calendar"></i>'+response.filterDate);

					var dataShow='';

					jQuery.each( response.slotwiseAppointment, function( skey, sval ){

						dataShow += '<div class="appointmentList"><h1><i class="fa fa-clock-o"></i> '+skey+'</h1>';

						jQuery.each( sval, function( key, val ){

							dataShow += '<ul><li> <a id="physicianAppointmentDetails" bookingid="'+val.bookingID+'" patientid="'+val.patientID+'" href="javascript:void(0)"> <img src="'+baseUrl+val.pic+'"> <span>'+val.name+'<input type="hidden" class="patientid" value="'+val.patientID+'"><input type="hidden" class="bookingId" value="'+val.bookingID+'"></span> </a> </li></ul></div>';

						});

					});

					jQuery(".content_right_appointments_menu").append(dataShow);

				}

			});	

		}

	});

	

	jQuery(document).on('click', '#physicianReminder', function(e){

		e.preventDefault();

		var bookingid = jQuery("#bookingid").val();

		

		if(bookingid != ''){

			jQuery.ajax({

				url: 'physician_patient_reminder',

				data: {'bookingid': bookingid},

				type:"POST",

				cache:false,

				dataType:"json",

				success: function(response){

					jQuery(".fancybox-overlay").hide();

					if(response.success == 1){

						bootbox.alert(response.message);

					}else if(response.error == 1){

						bootbox.alert(response.message);

					}

				}

			});	

		}else{

			bootbox.alert("Select Patient First");	

		}

	});

	

	jQuery("#inline1").find('.popup_button_complete_button a:eq(1)').click(function(){

		jQuery('.fancybox-overlay').css('display', 'none');

	});

	

	jQuery("#inline2").find('.popup_button_complete_button a:eq(1)').click(function(){

		jQuery('.fancybox-overlay').css('display', 'none');

	});

	

	jQuery(document).on('click', '#bookingCancel', function(e){

		e.preventDefault();

		var bookingid = jQuery("#bookingid").val();

		

		if(bookingid != ''){

			jQuery.ajax({

				url: 'booking_cancel',

				data: {'bookingid': bookingid},

				type:"POST",

				cache:false,

				dataType:"json",

				success: function(response){

					jQuery('.fancybox-overlay').hide();

					//jQuery(".fancybox-overlay").css('display','none');

					if(response.success == 1){

						bootbox.alert(response.message, function() {

							window.location.reload();

						});

					}else if(response.error == 1){

						bootbox.alert(response.message, function() {

							window.location.reload();

						});

					}

				}

			});	

		}else{

			alert("Select Patient First");	

		}

	});

	

	//Start Home Physican Dashboard js page................................

	/*knob function start*/

	$(".round_slider").knob({});

	$(".appointmentTime").on("click",function(){

	//var appointmentTime = $(this);

	var currentTime = $(this).html();

	//alert(value);

	$.ajax({ 

	type:"POST",                                    

	url:  baseUrl+'homephysican/currentAppointmentList',

	data:{'currentTime':currentTime},

	dataType: 'json',      

	success: function(response)

	{

	alert(response);

	}

	});

	});

	$(document).on("click",".todayAppointment",function(){

		var todayAppointment = $(this);

		var email = todayAppointment.next().val();

		//alert(email);

		todayAppointment.find("a").html('');

		$.ajax({ 

			type:"POST",                                    

			url:  baseUrl+'homephysician/physician_patient_reminder_mail',

			data:{'email':email},

			dataType: 'json',      

			success: function(response){   

				if(response.success == 1){
					todayAppointment.find("a").addClass('active'); 
					todayAppointment.find("a").append('<img src="'+base_url+'assets/images/sent_icon.png" />');
					todayAppointment.find("a").append('send');
					todayAppointment.removeClass();
				}
				else{
					todayAppointment.find("a").addClass('active'); 
					todayAppointment.find("a").append('Please Try Again');
					//todayAppointment.removeClass();	
				}
			}
		});
	});

	$(document).on("click",".reviewBtn",function(){

		jQuery('#bookingId').val($(this).attr('key'));

	});

	$(document).on("click","#reviewSubmit",function(){

		var bookingid = jQuery('#bookingId').val();

		var rating = jQuery('input[name=rating]').val();

		var comment = jQuery('textarea#comment').val();

		$.ajax({ 

			type:"POST",                                    

			url:  baseUrl+'patient/pending_reviews',

			data:{'rating':rating, 'comment':comment, 'bookingid':bookingid},

			dataType: 'json',      

			success: function(response){   

				if(response.success == 1){

					bootbox.alert(response.message, function() {

						window.location.reload();

					});	

				}else if(response.error == 1){

					bootbox.alert(response.message, function() {

							window.location.reload();

					});

				}	

			}

		});

	});

	

//End Home Physican Dashboard js page................................



	/* Add category in admin */

	jQuery(document).on('click', '#categoryAdd', function(e){

			e.preventDefault();

			var formData = new FormData();

			var file = jQuery("#addcategoryImage")[0].files[0];

			var categoryname = jQuery("#addcategoryName").val();

			if(categoryname == ''){

				bootbox.alert("Category name is required.");

			}else if(file == ''){

				bootbox.alert("Category image required.");

			}else{

				formData.append("categorypic", file);

				formData.append("category_name", categoryname);

				console.log(formData);

				jQuery.ajax({

					url: baseUrl+'admin/add_category',

					data:formData,

					type:"POST",

					cache:false,

					dataType:"json",

					contentType: false,

					processData: false,

					global: false,

					success: function(response){

						console.log("Success");

						jQuery(".fancybox-overlay").hide();		

						if(response.success == 1){

							bootbox.alert(response.message, function() {

								window.location.reload();

							});

						}else if(response.error == 1){

							bootbox.alert(response.message, function() {

								window.location.reload();

							});

						}

					},

					error: function(response){console.log(response);

						console.log("Error");

					}

				});

			}

		});

	

	jQuery(document).on("click",".procedureedit",function(){

		jQuery("#categoryID").val(jQuery(this).attr('pKey'));

	});	

	jQuery(document).on("click",".procedureedit",function(){

		var categoryid =  jQuery("#categoryID").val();

			jQuery.ajax({ 

				type:"POST",                                    

				url:  baseUrl+'admin/procedurecategory',

				data:{'categoryid':categoryid, 'tag': 'fetchdetails'},

				dataType: 'json',      

				success: function(response){   

					if(response.success == 1){

						console.log("Success");

						jQuery("#editcategoryName").val(response.categorydetails[0].category_name);

					}else if(response.error == 1){

						console.log("RError");

					}	

				},

				error: function(response){   

					console.log("Error");

				}

		});

	});	

	

	jQuery(document).on("click","#categoryEdit",function(e){

		e.preventDefault();

		var categoryid = jQuery("#categoryID").val();

		var formData = new FormData();

		var file = jQuery("#editcategoryImage")[0].files[0];

		var categoryname = jQuery("#editcategoryName").val();



		formData.append("categorypic", file);

		formData.append("category_name", categoryname);

		formData.append("ID", categoryid);

		formData.append("tag", 'edit');

		console.log(formData);

		jQuery.ajax({

			url:  baseUrl+'admin/procedurecategory',

			data: formData,

			type:"POST",

			cache:false,

			dataType:"json",

			contentType: false,

			processData: false,

			global: false,

			success: function(response){

				console.log("Success");

				jQuery(".fancybox-overlay").hide();		

				if(response.success == 1){

					bootbox.alert(response.message, function() {

						window.location.reload();

					});

				}else if(response.error == 1){

					bootbox.alert(response.message, function() {

						window.location.reload();

					});

				}

			},

			error: function(response){

				console.log("Error");

			}

		});

	});	

	

	jQuery(document).on('click', '#procedureAdd', function(e){

			e.preventDefault();

			var procedurecategory = jQuery("#addprocedureCategory option:selected").val();

			var procedure_name = jQuery("#addprocedureName").val();

			if(procedure_name == ''){

				bootbox.alert("Procedure name is required.");

			}else{

				jQuery.ajax({

					url: baseUrl+'admin/add_procedure',

					data:{'procedurecategory':procedurecategory, 'procedure_name':procedure_name},

					type:"POST",

					cache:false,

					dataType:"json",

					success: function(response){

						console.log("Success");

						jQuery(".fancybox-overlay").hide();		

						if(response.success == 1){

							bootbox.alert(response.message, function() {

								window.location.reload();

							});

						}else if(response.error == 1){

							bootbox.alert(response.message, function() {

								window.location.reload();

							});

						}

					},

					error: function(response){console.log(response);

						console.log("Error");

					}

				});

			}

	});

	

	jQuery(document).on("click","#masterprocedureedit",function(){

		var pkey=jQuery(this).attr('pKey');

		var mpckey=jQuery(this).attr('pcatid');

		

		jQuery("#mastercategoryID").val(pkey);

		jQuery("#mastercategoryID").attr('mpckey',mpckey );

		//$("#editprocedureCategory option").prop("selected", false);

		$('#editprocedureCategory').find('option[value="'+mpckey+'"]').attr("selected",true);

		var html = $(this).closest('tr').find('td div').html();

  		$("#editprocedureName").val(html);

	});	

	

	jQuery(document).on("click","#procedureEdit",function(){

		var procedure_cat_id = jQuery("#editprocedureCategory option:selected").val();

		var procedure_name = jQuery("#editprocedureName").val();

		var ID = jQuery("#mastercategoryID").val();

		

		jQuery.ajax({

			url: baseUrl+'admin/procedure',

			data:{'ID':ID, 'procedure_cat_id':procedure_cat_id, 'procedure_name':procedure_name},

			type:"POST",

			cache:false,

			dataType:"json",

			success: function(response){

				console.log("Success");

				jQuery(".fancybox-overlay").hide();		

				if(response.success == 1){

					bootbox.alert(response.message, function() {

						window.location.reload();

					});

				}else if(response.error == 1){

					bootbox.alert(response.message, function() {

						window.location.reload();

					});

				}

			},

			error: function(response){

				console.log("Error");

			}

		});

	});

	jQuery(document).on("click","#pbcancel",function(){

		var bookingid = jQuery(this).attr('bid');

		jQuery('#bcancel').attr('bid',bookingid);

	});

	jQuery(document).on("click","#bcancel",function(){

		var bookingid = jQuery(this).attr('bid');

		jQuery.ajax({

			url: baseUrl+'patient/cancel_booking',

			data:{'ID':bookingid},

			type:"POST",

			cache:false,

			dataType:"json",

			success: function(response){

				console.log("Success");

				jQuery(".fancybox-overlay").hide();		

				if(response.success == 1){

					bootbox.alert(response.message, function() {

						window.location.reload();

					});

				}else if(response.error == 1){

					bootbox.alert(response.message, function() {

						window.location.reload();

					});

				}

			},

			error: function(response){

				console.log("Error");

			}

		});

	});	

	

	jQuery(document).on("click",".pastprescription",function(){

		var html = '';

		var bookingid = jQuery(this).attr('bookingkey');

		jQuery.ajax({

			url: baseUrl+'patient/past_booking_details',

			data:{'bookingid':bookingid},

			type:"POST",

			cache:false,

			dataType:"json",

			success: function(response){

				console.log("Success");

				if(response.success == 1){

					html = '<div class="table-responsive"><table  class="table  table-hover"><tr><th>Details</th><th>Dose</th><th>Time</th>';

					jQuery(response.prescription).each(function(index, value){

						html = html + '<tr><td>'+value.Details+'</td><td>'+value.dose+'</td><td>'+value.day_time_type+'</td></tr>';

					});

					html = html + '</table></div>';

					jQuery(".modal-body").html('');

					jQuery(".modal-body").html(html);

				}else if(response.error == 1){

					var html = "<strong>No Data Found</strong>";

					jQuery(".modal-body").html('');

					jQuery(".modal-body").html(html);

				}

			},

			error: function(response){

				console.log("Error");

			}

		});

	});

});

jQuery(document).ready(function(){   

	  jQuery(document).on('click', '.homePhyMedicalHis',function() { 

	 // console.log(window.arrayvar);

		jQuery('.apointment_medicalhistory_left_homePhy ul li:first').addClass("active"); 

		jQuery(".history_type").val('documents'); 

		jQuery('.apointment_medicalhistory_tab1').empty(); 

		jQuery(".apointment_medicalhistory_tab2, .apointment_medicalhistory_tab3,.apointment_medicalhistory_tab4,.apointment_medicalhistory_tab5,.apointment_medicalhistory_tab6").css("display", "none"); 

		jQuery(".apointment_medicalhistory_tab1").css("display", "block"); 

		//console.log(window.arrayvar); 

		jQuery.each(window.arrayvar, function(document_key, value) { 

			if(value.history_type == 'documents') 

			{ 

				jQuery('.apointment_medicalhistory_tab1').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+value.historytitle+"</h1><div class='apointment_medicalhistory_report1'><img src='"+base_url+"assets/images/apointment_medicalhistory_img1.png' /><div class='apointment_medicalhistory_report_button'><div class='apointment_medicalhistory_report_absolute'><span><a href='"+base_url+value.files+"'  target='_blank'>report <i class='fa fa-arrow-down' ></i></a></span></div></div></div><p>"+value.desc+"</p><h2></h2></div>"); 

				} 

			 

				});	 

		});      

      jQuery(document).on('click', '.apointment_medicalhistory_left_homePhy li', function(e){ 

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

	    var currentbutton= jQuery(this);  

		jQuery('.apointment_medicalhistory_left_homePhy li').removeClass("active"); 

	    currentbutton.addClass('active'); 

		var getID = currentbutton.children().attr('id'); 

		if(getID == 'homePhyDocuments') 

		{   jQuery('.apointment_medicalhistory_tab1').empty(); 

			jQuery(".report_name").show(); 

			jQuery(".desc").show(); 

			jQuery(".apointment_medicalhistory_right_upload_button").show(); 

			jQuery(".report_text").show(); 

			jQuery(".history_type").val("documents"); 

			jQuery(".apointment_medicalhistory_tab2, .apointment_medicalhistory_tab3,.apointment_medicalhistory_tab4,.apointment_medicalhistory_tab5,.apointment_medicalhistory_tab6").css("display", "none"); 

			jQuery(".apointment_medicalhistory_tab1").css("display", "block"); 

			     

			jQuery.each(resultArray, function(document_key, docvalue) { 

				if(docvalue.hasOwnProperty("documents") ){ 

					jQuery('.apointment_medicalhistory_tab1').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.documents.historytitle+"</h1><div class='apointment_medicalhistory_report1'><img src='"+base_url+"assets/images/apointment_medicalhistory_img1.png' /><div class='apointment_medicalhistory_report_button'><div class='apointment_medicalhistory_report_absolute'><span><a href='"+base_url+docvalue.documents.files+"'  target='_blank'>report <i class='fa fa-arrow-down' ></i></a></span></div></div></div><p>"+docvalue.documents.desc+"</p><h2></h2></div>"); 

				} 

                            }); 

			jQuery('input[name=report_name]').val(''); 

			jQuery('textarea[name=desc]').val('');				 

			} 

	    else if(getID == 'homePhyconditionsAllergeis') 

		{   

		     jQuery('.apointment_medicalhistory_tab2').empty();  

			jQuery(".apointment_medicalhistory_right_upload_button").hide(); 

			jQuery(".report_name").show(); 

			jQuery(".desc").show(); 

			jQuery(".report_text").hide(); 

			jQuery(".history_type").val("conditionsAllergeis"); 

			jQuery(".apointment_medicalhistory_tab1, .apointment_medicalhistory_tab3,.apointment_medicalhistory_tab4,.apointment_medicalhistory_tab5,.apointment_medicalhistory_tab6").css("display", "none");  jQuery(".apointment_medicalhistory_tab2").css("display", "block"); 

			jQuery.each(resultArray, function(conditionsAllergeis, docvalue) { 

				if(docvalue.hasOwnProperty("conditionsAllergeis") ){ 

					jQuery('.apointment_medicalhistory_tab2').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.conditionsAllergeis.historytitle+"</h1><p>"+docvalue.conditionsAllergeis.desc+"</p><h2></h2></div>"); 

				} 

			 

                            }); 

			jQuery('input[name=report_name]').val(''); 

			jQuery('textarea[name=desc]').val('');				 

			} 

		else if(getID == 'homePhyimmuniziation') 

		{ 

			jQuery('.apointment_medicalhistory_tab3').empty(); 

			jQuery(".apointment_medicalhistory_right_upload_button").hide(); 

			jQuery(".report_name").show(); 

			jQuery(".desc").show(); 

			jQuery(".report_text").hide(); 

			jQuery(".history_type").val("immuniziation"); 

			jQuery(".apointment_medicalhistory_tab1, .apointment_medicalhistory_tab2,.apointment_medicalhistory_tab4,.apointment_medicalhistory_tab5,.apointment_medicalhistory_tab6").css("display", "none"); 

			jQuery(".apointment_medicalhistory_tab3").css("display", "block"); 

			jQuery.each(resultArray, function(immuniziation, docvalue) { 

			if(docvalue.hasOwnProperty("immuniziation") ){ 

					jQuery('.apointment_medicalhistory_tab3').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.immuniziation.historytitle+"</h1><p>"+docvalue.immuniziation.desc+"</p><h2></h2></div>"); 

				} 

                            }); 

			jQuery('input[name=report_name]').val(''); 

			jQuery('textarea[name=desc]').val('');				 

			} 

		else if(getID == 'homePhysurgicalProcedure') 

		{    

		    jQuery('.apointment_medicalhistory_tab4').empty(); 

			jQuery(".apointment_medicalhistory_right_upload_button").hide(); 

			jQuery(".report_name").show(); 

			jQuery(".desc").show(); 

			jQuery(".report_text").hide(); 

			jQuery(".history_type").val("surgicalProcedure"); 

			jQuery(".apointment_medicalhistory_tab1, .apointment_medicalhistory_tab2,.apointment_medicalhistory_tab3,.apointment_medicalhistory_tab5,.apointment_medicalhistory_tab6").css("display", "none"); 

			jQuery(".apointment_medicalhistory_tab4").css("display", "block"); 

			jQuery.each(resultArray, function(surgicalProcedure, docvalue) { 

				if(docvalue.hasOwnProperty("surgicalProcedure") ){ 

					jQuery('.apointment_medicalhistory_tab4').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.surgicalProcedure.historytitle+"</h1><p>"+docvalue.surgicalProcedure.desc+"</p><h2></h2></div>"); 

				} 

			 

                            }); 

			jQuery('input[name=report_name]').val(''); 

			jQuery('textarea[name=desc]').val('');				 

			} 

		else if(getID == 'homePhyfamilyHistory') 

		{    

		    jQuery('.apointment_medicalhistory_tab5').empty(); 

			jQuery(".apointment_medicalhistory_right_upload_button").hide(); 

			jQuery(".report_name").show(); 

			jQuery(".desc").show(); 

			jQuery(".report_text").hide(); 

			jQuery(".history_type").val("familyHistory"); 

			jQuery(".apointment_medicalhistory_tab1, .apointment_medicalhistory_tab2,.apointment_medicalhistory_tab3,.apointment_medicalhistory_tab4,.apointment_medicalhistory_tab6").css("display", "none"); 

			jQuery(".apointment_medicalhistory_tab5").css("display", "block"); 

			jQuery.each(resultArray, function(familyHistory, docvalue) { 

				if(docvalue.hasOwnProperty("familyHistory") ){ 

					jQuery('.apointment_medicalhistory_tab5').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.familyHistory.historytitle+"</h1><p>"+docvalue.familyHistory.desc+"</p><h2></h2></div>"); 

				} 

			 

                            }); 

			jQuery('input[name=report_name]').val(''); 

			jQuery('textarea[name=desc]').val('');				 

			} 

		else if(getID == 'homePhyeyeSight') 

		{ 

			 jQuery('.apointment_medicalhistory_tab6').empty(); 

			jQuery(".apointment_medicalhistory_right_upload_button").hide(); 

			jQuery(".report_name").show(); 

			jQuery(".desc").show(); 

			jQuery(".report_text").hide(); 

			jQuery(".history_type").val("eyeSight"); 

			jQuery(".apointment_medicalhistory_tab1, .apointment_medicalhistory_tab2,.apointment_medicalhistory_tab3,.apointment_medicalhistory_tab4,.apointment_medicalhistory_tab5").css("display", "none"); 

			jQuery(".apointment_medicalhistory_box_img6").css("display", "block"); 

			jQuery.each(resultArray, function(eyeSight, docvalue) { 

				if(docvalue.hasOwnProperty("eyeSight") ){ 

					jQuery('.apointment_medicalhistory_tab6').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+docvalue.eyeSight.historytitle+"</h1><p>"+docvalue.eyeSight.desc+"</p><h2></h2></div>"); 

				} 

			 

                            }); 

		    jQuery('input[name=report_name]').val(''); 

			jQuery('textarea[name=desc]').val('');					 

			} 

        }); 

		 

	  jQuery('#homePhyMedicalhistory').submit(function(e){ 

			  e.preventDefault(); 

			 var formData = new FormData(this); 

			 var history_type = jQuery(".history_type").val(); 

			 var data = new Array(); 

				if(history_type == 'documents') 

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

							url: base_url+'homephysician/medicalHistory', 

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

					                  jQuery('.apointment_medicalhistory_tab1').prepend("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><div class='apointment_medicalhistory_report1'><img src='"+base_url+"assets/images/apointment_medicalhistory_img1.png' /><div class='apointment_medicalhistory_report_button'><div class='apointment_medicalhistory_report_absolute'><span><a href='"+base_url+response.data.files+"'  target='_blank'>report <i class='fa fa-arrow-down' ></i></a></span></div></div></div><p>"+response.data.desc+"</p><h2></h2></div>"); 

									  window.arrayvar.unshift(response.data); 

									   

				                                } 

				                else if(response.data.history_type == 'conditionsAllergeis'){ 

					                  jQuery('.apointment_medicalhistory_tab2').prepend("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>"); 

									  window.arrayvar.unshift(response.data); 

				                                } 

						 		else if(response.data.history_type == 'immuniziation'){ 

					                  jQuery('.apointment_medicalhistory_tab3').prepend("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>"); 

									  window.arrayvar.unshift(response.data); 

				                                } 

								else if(response.data.history_type == 'surgicalProcedure'){ 

					                  jQuery('.apointment_medicalhistory_tab4').prepend("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>"); 

									  window.arrayvar.unshift(response.data); 

				                                } 

								else if(response.data.history_type == 'familyHistory'){ 

					                  jQuery('.apointment_medicalhistory_tab5').append("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>"); 

									  window.arrayvar.unshift(response.data); 

				                                } 

								else if(response.data.history_type == 'eyeSight'){ 

					                  jQuery('.apointment_medicalhistory_tab6').prepend("<div class='apointment_medicalhistory_box_img_left'><h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>"); 

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