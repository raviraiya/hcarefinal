<div class="col-md-10 container_padding_none">
  	<div class="content_right_dashboard">
	    <div class="content_right_patients_titel">
	      	<h1>Patients</h1>
	    </div>

    	<div class="content_right1_patients">
	      	<div class="patients_select patients_select_width select-style" style="width:auto">
		        <select name='bookingProcCat' class='selectProcedureCat' id='bookingProcCat'>
			          <option selected="selected" value=''>Select Procedure Category</option>
			          <?php foreach($category as $resultcategory) { ?>
			          	<option value='<?php echo $resultcategory->ID;?>'><?php echo $resultcategory->category_name;?></option>
			          <?php } ?>
		        </select>
	      	</div>

      		<div class="patients_select patients_select_width select-style" style="width:auto">
		        <select name='bookingProcName' class='selectProcedure' id='bookingProcName'>
		          	<option selected="selected" value=''>Select Procedure</option>
		        </select>
	      	</div>

      		<div class="patients_select patients_input_width select-style" >
        		<input type='text' placeholder="search by name" id='patientName'>
        		<a href="javascript:void(0);" id='searchData'>GO</a> 
        	</div>

      		<div class="patients_select patients_right_width select-style">
        		<select ng-model='sortColumn'>
          			<option selected="selected" value=''>Sort By</option>
          			<option value='fname'>Name ASC</option>
          			<option value='-fname'>Name DESC</option>
        		</select>
      		</div>
    	</div>

    	<div>
      		<div class="row appenddata"></div>
      		<a href="javascript:void(0)" class="content_right_patients_load_more loadmore">load more</a>

      		<div class="alert alert-success norecord text-center" style="display:none"> 
      			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
      			<strong>No Record Found!</strong> 
      		</div>
   		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		var base_url;
		var shown =  3;
		var $divs = $(".testAppend");
		var html = "";
		var html2 = "";
		jQuery.ajax({
			url: get_base_url()+'specialist/specialistdata',
			type:"POST",
			dataType:"json",
			success: function(response){
				$(".appenddata").empty();
				console.log(response);
				if(response != ''){
					$.each(response , function (index, value){
						$.each(value.bookingdetails, function (key, val){
							if(val.specialistpic == ''){
								val.specialistpic = '/assets/specialist/no-profile-image.png';
							}
							html = html + 
							'<div class="patients_homephy_right testAppend" style="display:none;">'+
							    '<div class="patients_homephy_left_box">'+
								    '<div class="patientinnerdiv">'+ 
								        '<img class="patientimage" src="<?php echo base_url()?>'+val.patientpic+'">'+
								    '</div>'+
									'<h1 style="text-transform:capitalize;">'+val.username+'</h1>'+
									'<ul>'+
										'<li>'+
											'<p>Total Appt.</p><span>'+
										  	'<i class="fa fa-calendar"></i>'+value.totalbooking+'</span>'+ 
										'</li>'+
										'<li class="list">'+
											'<p>Cancel Appt.</p>'+
											'<span><i class="fa fa-calendar"></i>'+value.cancelbooking+'</span>'+
										'</li>'+
									'</ul>'+
								'</div>'+
								'<div class="patients_homephy_right_box">'+
									'<div class="patients_homephy_right_border">'+
										'<div class="patients_homephy_top_div">'+
										  	'<div class="patients_homephy_titel_button"><h1>Last Appointments</h1></div>'+
											'<div class="appointments_homephy_right">'+
												'<div class="appointments_homephy_left">'+
												  	'<img src="<?php echo base_url()?>'+val.specialistpic+'">'+
												'</div>'+
										  		'<div class="appointments_homephy_right_box">'+
										  			'<ul class="appointments_homephy_right_menu">'+
										  				'<li>'+
										  					'<span>Specialist Name</span>'+
														  	'<h1 style="text-transform:capitalize;">'+val.name+'</h1>'+
														'</li>'+
													'</ul>'+
												'</div>'+
											'</div>'+
											'<div class="patients_homephy_titel_button">'+
										  		'<h1 style="padding:0px;">Last Checkup</h1>'+
										  	'</div>'+
										  	'<div class="patients_homephy_content">'+
										  		'<div class="col-md-3 container_padding_none">'+
										  			'<p class="patients_homephy_titel_font">body temperature</p>'+
											  		'<div class="appointments_last_checkup_maps_right patients_homephy_content_checkup_maps_img1">'+ 
													  	'<img src="<?php echo base_url()?>assets/images/appointments_maps_img1.png">'+
													  	'<div class="appointments_last_checkup_maps_right1">'+
											  				'<p>Normal</p>'+
											  				'<span class="ng-binding">'+val.temp+'<sup>O</sup></span>'+
											  			'</div>'+
											  		'</div>'+
											  	'</div>'+
											  	'<div class="col-md-3 container_padding_none">'+
											  		'<p class="patients_homephy_titel_font">heart beat</p>'+
											  		'<div class="appointments_last_checkup_maps_right">'+
													  	'<img src="<?php echo base_url()?>assets/images/appointments_maps_img2.png">'+
													  	'<div class="appointments_last_checkup_maps_right1">'+
													  		'<h2 class="ng-binding">'+val.heartbit+'<sup>bpm</sup></h2>'+
													  	'</div>'+
													'</div>'+
												'</div>'+
											  	'<div class="col-md-3 container_padding_none">'+
											  		'<p class="patients_homephy_titel_font">blood sugar</p>'+
												  	'<div class="appointments_last_checkup_maps_right">'+
										  				'<img src="<?php echo base_url()?>assets/images/appointments_maps_icon3.png" style="padding:0 5px 0 0;">'+
													  	'<div class="appointments_last_checkup_maps_right1 appointments_last_checkup_maps_left">'+
													  		'<h3 class="ng-binding">'+val.BG+' mg/dl</h3>'+
														'</div>'+
														'<ul>'+
															'<li>Low Blood<br>Pressure</li>'+
															'<li><p>Normal</p></li>'+
															'<li>High Blood <br>Pressure</li>'+
														'</ul>'+
											  			'<img src="<?php echo base_url()?>assets/images/patients_homephy_content_maps_icon2.png" class="patients_homephy_content_maps_icon2">'+
											  		'</div>'+
											  	'</div>'+
											  	'<div class="col-md-3 container_padding_none">'+
											  		'<p class="patients_homephy_titel_font">blood pressure</p>'+
											  		'<div class="appointments_last_checkup_maps_right">'+
													  	'<div class="appointments_last_checkup_maps_right1 appointments_last_checkup_maps_left">'+
													  		'<h3>'+val.BD+'</h3>'+
														'</div>'+
														'<ul>'+
												  			'<li>Low Blood<br>Pressure</li>'+
												  			'<li><p>Normal</p></li>'+
												  			'<li>High Blood <br>Pressure</li>'+
												  		'</ul>'+
											  			'<img src="<?php echo base_url()?>assets/images/patients_homephy_content_maps_icon2.png" class="patients_homephy_content_maps_icon2">'+
											  		'</div>'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
							'<div class="clearfix"></div>';
						});
					});
				}

				$(".appenddata").append(html);		
				$('.testAppend:lt('+shown+')').show();
				var items =  $(".testAppend").size();
				shownVisible = $('.testAppend:visible').size();
				if(shownVisible == items) {
					$('.loadmore').hide();
	        		$('.norecord').show();
				}
				console.log("success");
			},
			error: function(response){
				console.log(response);
			}
		});		

		jQuery(document).on('change', '.selectProcedureCat', function(e){
			//var category = jQuery('.selectProcedureCat option:selected').val();
			$("#bookingProcName").html("");
			html = '<option value="">Select Procedure </option>';
			$("#bookingProcName").html(html);
			var category = $(this).find('option:selected').val();
			var tag = "procedurecategory";
			var html = '';
			jQuery.ajax({
				url: get_base_url()+'specialist/ajaxData',
				data: {'category':category, 'tag':tag},
				type:"POST",
				dataType:"json",
				success: function(response){
					console.log("Success");
					if(response.success == 1){
						html = '<option value="">Select Procedure</option>';
						jQuery(response.procedurecategory).each(function(index, value){
							html = html+'<option value="'+value.ID+'">'+value.procedure_name+'</option>';
	    				});
						jQuery(".selectProcedure").html('');
						jQuery(".selectProcedure").html(html);
					}else if(response.error == 1){
					}
				},
				error: function(response){
					console.log(response);
				}

			});	
		});	

		jQuery(document).on('click', '#searchData', function(e){
			$('.loadmore').show();
			$('.norecord').hide();
			var procName=$("#bookingProcName").val();
			var patName=$("#patientName").val();
			var catName=$("#bookingProcCat").val();
			jQuery.ajax({
				url: get_base_url()+'specialist/dataList',
				data: {'procName':procName, 'patName':patName, 'catName':catName},
				type:"POST",
				dataType:"json",
				success: function(response){
					$(".appenddata").html('');
					if(response != ''){
						$.each(response , function (index, value){
							$.each(value.bookingdetails, function (key, val){
								if(val.specialistpic == ''){
									val.specialistpic = '/assets/specialist/no-profile-image.png';
								}
								html2 = html2 + 
								'<div class="patients_homephy_right testAppend" style="display:none;">'+
									'<div class="patients_homephy_left_box">'+
 									    '<div class="patientinnerdiv">'+ 
  										    '<img class="patientimage" src="<?php echo base_url()?>'+val.patientpic+'">'+
  										'</div>'+
										'<h1 style="text-transform:capitalize;">'+val.username+'</h1>'+
										'<ul>'+
											'<li>'+
												'<p>Total Appt.</p>'+
											  	'<span><i class="fa fa-calendar"></i>'+value.totalbooking+'</span>'+ 
										    '</li>'+
										    '<li class="list">'+
										    	'<p>Cancel Appt.</p>'+
										    	'<span><i class="fa fa-calendar"></i>'+value.cancelbooking+'</span>'+
										    '</li>'+
										'</ul>'+
									'</div>'+
									'<div class="patients_homephy_right_box">'+
										'<div class="patients_homephy_right_border">'+
										    '<div class="patients_homephy_top_div">'+
											  	'<div class="patients_homephy_titel_button"><h1>Last Appointments</h1></div>'+
											  	'<div class="appointments_homephy_right">'+
										    		'<div class="appointments_homephy_left">'+
													  	'<img src="<?php echo base_url()?>'+val.specialistpic+'">'+
										    		'</div>'+
											  		'<div class="appointments_homephy_right_box">'+
										    			'<ul class="appointments_homephy_right_menu">'+
										    				'<li>'+
										    					'<span>Specialist Name</span>'+
											  					'<h1 style="text-transform:capitalize;">'+val.name+'</h1>'+
										    				'</li>'+
										    			'</ul>'+
										    		'</div>'+
										    	'</div>'+
										    	'<div class="patients_homephy_titel_button">'+
												  	'<h1 style="padding:0px;">Last Checkup</h1>'+
										    	'</div>'+
										    	'<div class="patients_homephy_content">'+
											  		'<div class="col-md-3 container_padding_none">'+
										    			'<p class="patients_homephy_titel_font">body temperature</p>'+
											  			'<div class="appointments_last_checkup_maps_right patients_homephy_content_checkup_maps_img1">'+ 
														  	'<img src="<?php echo base_url()?>assets/images/appointments_maps_img1.png">'+
										    				'<div class="appointments_last_checkup_maps_right1">'+
			  											    	'<p>Normal</p>'+
										    					'<span class="ng-binding">'+val.temp+'<sup>O</sup></span>'+
										    				'</div>'+
										    			'</div>'+
										    		'</div>'+
										    		'<div class="col-md-3 container_padding_none">'+
											  			'<p class="patients_homephy_titel_font">heart beat</p>'+
											  			'<div class="appointments_last_checkup_maps_right">'+
											  				'<img src="<?php echo base_url()?>assets/images/appointments_maps_img2.png">'+
											  				'<div class="appointments_last_checkup_maps_right1">'+
											  					'<h2 class="ng-binding">'+val.heartbit+'<sup>bpm</sup></h2>'+
											  				'</div>'+
											  			'</div>'+
											  		'</div>'+
											  		'<div class="col-md-3 container_padding_none">'+
											  			'<p class="patients_homephy_titel_font">blood sugar</p>'+
											  			'<div class="appointments_last_checkup_maps_right">'+
														  	'<img src="<?php echo base_url()?>assets/images/appointments_maps_icon3.png" style="padding:0 5px 0 0;">'+
															'<div class="appointments_last_checkup_maps_right1 appointments_last_checkup_maps_left">'+
															'<h3 class="ng-binding">'+val.BG+' mg/dl</h3>'+
											  			'</div>'+
											  			'<ul>'+
											  				'<li>Low Blood<br>Pressure</li>'+
											  				'<li><p>Normal</p></li>'+
											  				'<li>High Blood <br>Pressure</li>'+
											  			'</ul>'+
											  			'<img src="<?php echo base_url()?>assets/images/patients_homephy_content_maps_icon2.png" class="patients_homephy_content_maps_icon2">'+
											  			'</div>'+
											  		'</div>'+
											  		'<div class="col-md-3 container_padding_none">'+
											  			'<p class="patients_homephy_titel_font">blood pressure</p>'+
											  			'<div class="appointments_last_checkup_maps_right">'+
											  				'<div class="appointments_last_checkup_maps_right1 appointments_last_checkup_maps_left">'+
											  					'<h3>'+val.BD+'</h3>'+
											  				'</div>'+
											  				'<ul>'+
											  					'<li>Low Blood<br>Pressure</li>'+
											  					'<li><p>Normal</p></li>'+
											  					'<li>High Blood <br>Pressure</li>'+
											  				'</ul>'+
											  				'<img src="<?php echo base_url()?>assets/images/patients_homephy_content_maps_icon2.png" class="patients_homephy_content_maps_icon2">'+
											  			'</div>'+
											  		'</div>'+
											  	'</div>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>'+
								'<div class="clearfix"></div>';	
							});
						});
					}

					$(".appenddata").append(html2);
					$('.testAppend:lt('+shown+')').show();
					var items =  $(".testAppend").size();
					shownVisibleFilter = $('.testAppend:visible').size();
					if(shownVisibleFilter == items) {
						$('.loadmore').hide();
	        			$('.norecord').show();
					}
					console.log("Success");
				},
				error: function(response){
					console.log(response);
				}
			});
		});

		$('.loadMore').click(function () {
			var items =  $(".testAppend").size();
	   		shown = $('.testAppend:visible').size()+shown;
	   		if(shown <= items) {
		  		$('.testAppend:lt('+shown+')').show();
	   		}
	        else {
				$('.testAppend:lt('+items+')').show();
	          	$('.loadmore').hide();
	          	$('.norecord').show();
	      	}
	    });

		$('.ng-valid').on('change', function (e) {
			var optionSelected = $("option:selected", this);
			var valueSelected = this.value;
			if(valueSelected === 'fname'){
				var alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
					return $(a).find("span").text() < $(b).find("span").text();
				});

				$(".appenddata").empty();
				$(".appenddata").html(alphabeticallyOrderedDivs);
			}

			if(valueSelected === '-fname'){
				var alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
					return $(a).find("span").text() > $(b).find("span").text();
				});
				$(".appenddata").empty();
				$(".appenddata").html(alphabeticallyOrderedDivs);
			} 
		});
	});
</script>
<style>
	.patientinnerdiv{
		border-radius: 100%; 
	    overflow: hidden; 
	    width: 140px; 
	    height: 140px; 
	    margin: 15px auto; 
	    border: 5px solid rgb(255, 255, 255); 
	    box-shadow: 1px 2px 3px rgb(193, 193, 193);
	}

	.patientimage{
		width: 143px; 
	    height: 144px; 
	    margin: 0px !important;
	    padding: 0px !important;
	}
</style>