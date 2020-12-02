<div class="col-md-10 container_padding_none">
  <div class="content_right_dashboard" >
    <div class="content_right_patients_titel">
      <h1>Appointment</h1>
    </div>
    <div class="content_right_appointments_box">
      <center>
      <div class="content_right1_patients">
            <div class="appointments_width_block">
                <div class="patients_select patients_select_width select-style">
                    <select class="ProcedureCat" id="ProcedureCat">
                        <option value="">Select Procedure</option>
                        <?php foreach($procedure_category as $procedureDetails) { ?>
                            <option value='<?php echo $procedureDetails->ID;?>'><?php echo $procedureDetails->category_name;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="patients_select patients_select_width select-style">
                    <select class="adminselectProcedure" id="adminselectProcedure">
                        <option value="">Select Procedure</option>
                    </select>
                </div>
                <div class="patients_select">
                    <label class="date_label">
                        <input id="datepicker" class="hasDatepicker" type="text">
                    </label>
                </div>
                <div class="patients_select appointments_button_go patients_input_width select-style"> <a id='searchBtn' href="javascript:void(0)" class="">GO</a> </div>
            </div>
        </div>
        <div style="height:10%" class=" ">
          <div class="btnClassReminder">
          <a href="javascript:void(0)" class="fancybox btn-addprocedure-hser" id="todayAppointment" >Today</a>
          <a href="javascript:void(0)" class="fancybox btn-addprocedure-hser" id="pastAppointment" >Past</a>
          <a href="javascript:void(0)" class="fancybox btn-addprocedure-hser" id="futureAppointment" >Future</a>
            <!--<input type="button" value="Add" class="btn-addprocedure-hser">-->
          </div>
        </div>
        <div class="" style="width:70%;margin:30px auto">
          <table class="table table-bordered table-hover" id="appointmentTbl">
            <thead class="thead-inverse">
              <tr>
                <th><div class='procedureheading'>Specialist Name</div></th>
                <th> <div class='procedureheading'>Patient Name</div></th>
                  <th> <div class='procedureheading'>Date</div></th>
                  <th> <div class='procedureheading'>Time</div></th>
                  <th> <div class='procedureheading'>Procedure</div></th>
                  <th> <div class='procedureheading'>Procedure Category</div></th>
                  <th> <div class='procedureheading'>Status</div></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($today_appointment as $todayAppo){?>
              <tr>
                <th><div class='procedureheading'><?php echo $todayAppo->name ?></div></th>
                <td><div class='procedureheading'><?php echo $todayAppo->username ?></div></td>
                <td><div class='procedureheading'><?php echo $todayAppo->booking_date?></div></td>
                <td><div class='procedureheading'><?php echo $todayAppo->booking_time?></div></td>
                <td><div class='procedureheading'><?php echo $todayAppo->procedure_name?></div></td>
                <td><div class='procedureheading'><?php echo $todayAppo->category_name?></div></td>
                <td><div class='procedureheading'><?php if($todayAppo->status == 0){
													echo "Booked";}else if($todayAppo->status == 1){echo "Complete";}else if($todayAppo->status == -1){
														echo "Cancel";}
					                            ?></div></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
          <div class="norecord"> </div>
      </center>
    </div>
  </div>
</div>
<script>
jQuery(document).ready(function(){
	var baseUrl = "http://demo.grouperocket.ca/";
	jQuery(document).on('click', '#todayAppointment', function(){
		var status;
		var html;
		jQuery.ajax({
					url: baseUrl+'admin/todayappointment',
					//data: {'tag':tag},
					type:"POST",
					cache:false,
					dataType:"json",
					success: function(response){
						if(response.success == 1){
							html = html + "<thead class='thead-inverse'><tr><th><div class='procedureheading'>Specialist Name</div></th><th><div class='procedureheading'>Patient Name</div></th><th> <div class='procedureheading'>Date</div></th><th><div class='procedureheading'>Time</div></th><th><div class='procedureheading'>Procedure</div></th><th><div class='procedureheading'>Procedure Category</div></th><th><div class='procedureheading'>Status</div></th></tr></thead><tbody>";
					  jQuery(response.todayappointment).each(function(index, value){
						  
						if(value.status == 0){ 
							status = "Booked";
						}else if(value.status ==  1){
							status = "Complete";
						}else if(value.status == -1){
							status = "Cancel";
						}
						
						html = html + "<tr><th><div class='procedureheading'>"+value.name+"</div></th><td><div class='procedureheading'>"+value.username+"</div></td><td><div class='procedureheading'>"+value.booking_date+"</div></td><td><div class='procedureheading'>"+value.booking_time+"</div></td><td><div class='procedureheading'>"+value.procedure_name+"</div></td><td><div class='procedureheading'>"+value.category_name+"</div></td><td><div class='procedureheading'>"+status+"</div></td></tr>"; 
				  		});
						  html = html + "</tbody>";
					
						  jQuery("#appointmentTbl").empty();
					      jQuery("#appointmentTbl").append(html);
						}
						//jQuery("#appointmentTbl").empty();
						//jQuery("#appointmentTbl").append(response);
						},
					error: function(response){console.log(response);
						console.log("Error");
					}
				});
		});
	jQuery(document).on('click', '#futureAppointment', function(){
		var status;
		var html;
		jQuery.ajax({
			url: baseUrl+'admin/futureappointment',
			//data: {'tag':tag},
			type:"POST",
			cache:false,
			dataType:"json",
			success: function(response){
				if(response.success == 1){
					html = html + "<thead class='thead-inverse'><tr><th><div class='procedureheading'>Specialist Name</div></th><th><div class='procedureheading'>Patient Name</div></th><th> <div class='procedureheading'>Date</div></th><th><div class='procedureheading'>Time</div></th><th><div class='procedureheading'>Procedure</div></th><th><div class='procedureheading'>Procedure Category</div></th><th><div class='procedureheading'>Status</div></th></tr></thead><tbody>";
					jQuery(response.futureappointment).each(function(index,value){
						if(value.status == 0){ 
							status = "Booked";
						}else if(value.status ==  1){
							status = "Complete";
						}else if(value.status == -1){
							status = "Cancel";
						}
						
						html = html + "<tr><th><div class='procedureheading'>"+value.name+"</div></th><td><div class='procedureheading'>"+value.username+"</div></td><td><div class='procedureheading'>"+value.booking_date+"</div></td><td><div class='procedureheading'>"+value.booking_time+"</div></td><td><div class='procedureheading'>"+value.procedure_name+"</div></td><td><div class='procedureheading'>"+value.category_name+"</div></td><td><div class='procedureheading'>"+status+"</div></td></tr>"; 
					});
					html = html + "</tbody>";
					
					jQuery("#appointmentTbl").empty();
					jQuery("#appointmentTbl").append(html);
				}
			},
			error: function(response){console.log(response);
				console.log("Error");
			}
		});
	});
	jQuery(document).on('click', '#pastAppointment', function(){
		var status;
		var html;
		jQuery.ajax({
					url: baseUrl+'admin/pastappointment',
					//data: {'tag':tag},
					type:"POST",
					cache:false,
					dataType:"json",
					success: function(response){
						//jQuery("#appointmentTbl").empty();
						if(response.success == 1){
							
							html = html + "<thead class='thead-inverse'><tr><th><div class='procedureheading'>Specialist Name</div></th><th><div class='procedureheading'>Patient Name</div></th><th> <div class='procedureheading'>Date</div></th><th><div class='procedureheading'>Time</div></th><th><div class='procedureheading'>Procedure</div></th><th><div class='procedureheading'>Procedure Category</div></th><th><div class='procedureheading'>Status</div></th></tr></thead><tbody>";
							jQuery(response.pastappointment).each(function(index,value){
								if(value.status == 0){ 
									status = "Booked";
								}else if(value.status ==  1){
									status = "Complete";
								}else if(value.status == -1){
									status = "Cancel";
								}
						
							html = html + "<tr><th><div class='procedureheading'>"+value.name+"</div></th><td><div class='procedureheading'>"+value.username+"</div></td><td><div class='procedureheading'>"+value.booking_date+"</div></td><td><div class='procedureheading'>"+value.booking_time+"</div></td><td><div class='procedureheading'>"+value.procedure_name+"</div></td><td><div class='procedureheading'>"+value.category_name+"</div></td><td><div class='procedureheading'>"+status+"</div></td></tr>"; 
					});
					html = html + "</tbody>";
					
					jQuery("#appointmentTbl").empty();
					jQuery("#appointmentTbl").append(html);
				
							//jQuery("#appointmentTbl").append(response);
							//jQuery(".norecord").text('');
						}//else{
							//jQuery(".norecord").append("<h1>No Records Found.</h1>");
						
					},
					error: function(response){console.log(response);
						console.log("Error");
					}
				});
		});
	jQuery(document).on('change', '.ProcedureCat', function(e){
		//var category = jQuery('.selectProcedureCat option:selected').val();
		var category = $(this).find('option:selected').val();
		var tag = "procedurecategory";
		var html = '';
		jQuery.ajax({
			url: baseUrl+'admin/ajaxData',
			data: {'category':category, 'tag':tag},
			type:"POST",
			dataType:"json",
			success: function(response){
				console.log("Success");
				if(response.success == 1){
					html = '<option value="">Select Procedure Category</option>';
					jQuery(response.procedurecategory).each(function(index, value){
						html = html+'<option value="'+value.ID+'">'+value.procedure_name+'</option>';
    				});
					jQuery(".adminselectProcedure").html('');
					jQuery(".adminselectProcedure").html(html);
				}else if(response.error == 1){
					
				}
			},
			error: function(response){
				console.log("Error");
			}
		});	
	});
	jQuery(document).on('click', '#searchBtn', function(){
		var status;
		var html;
		var procedureCat = $("#ProcedureCat").val();
		var procedureName=$("#adminselectProcedure").val();
		var date=$("#datepicker").val();
		jQuery.ajax({
			url: baseUrl+'admin/appointmentSearch',
			data: {'procedureCat':procedureCat, 'procedureName':procedureName,'date':date},
			type:"POST",
			dataType:"json",
			success: function(response){
				alert();
				if(response.success == 1){
					html = html + "<thead class='thead-inverse'><tr><th><div class='procedureheading'>Specialist Name</div></th><th><div class='procedureheading'>Patient Name</div></th><th> <div class='procedureheading'>Date</div></th><th><div class='procedureheading'>Time</div></th><th><div class='procedureheading'>Procedure</div></th><th><div class='procedureheading'>Procedure Category</div></th><th><div class='procedureheading'>Status</div></th></tr></thead><tbody>";
					jQuery(response.appointmentsearch).each(function(index,value){
						if(value.status == 0){ 
							status = "Booked";
						}else if(value.status ==  1){
							status = "Complete";
						}else if(value.status == -1){
							status = "Cancel";
						}
						
						html = html + "<tr><th><div class='procedureheading'>"+value.name+"</div></th><td><div class='procedureheading'>"+value.username+"</div></td><td><div class='procedureheading'>"+value.booking_date+"</div></td><td><div class='procedureheading'>"+value.booking_time+"</div></td><td><div class='procedureheading'>"+value.procedure_name+"</div></td><td><div class='procedureheading'>"+value.hprocedurecategoryName+"</div></td><td><div class='procedureheading'>"+status+"</div></td></tr>"; 
					});
					html = html + "</tbody>";
					
					jQuery("#appointmentTbl").empty();
					jQuery("#appointmentTbl").append(html);
				}
			},
			error: function(response){
				console.log("Error");
			}
		});	
	});
});
</script>