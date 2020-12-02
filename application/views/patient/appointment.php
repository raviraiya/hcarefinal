<div class="col-md-10 container_padding_none">
  <div class="content_right">
    <div class="content_right_appointments_titel">
      <h1>Appointments</h1>
      </div>
    <div class="content_right1_appointments_table">
      <form id ="patientAppt" method="POST" action="">
        <div class="appointments_width_block">
          <input type ="hidden" name ="patientAppt">
          <div class="patients_select patients_select_width select-style">
            <select name='procCat' id='procCat' class ="apptProcedure" ng-model='cc.category_name'>
              <?php  foreach($pro_category as $key => $val ) { ?>
              <option value="<?php echo $key; ?>" > <?php echo $val; ?></option>
              <?php }?>
            </select>
          </div>
          <div class="patients_select patients_select_width select-style">
            <select name="procedure_name_id" id ="procedureNameAppt"  required class="form-control input-sm parsley-validated">
            </select>
          </div>
          <div class="patients_select">
            <label class="date_label">
              <input type="text" id="datepicker" name ="date" value="select date" class="hasdatepicker_class">
            </label>
          </div>
          <div class="patients_select appointments_button_go patients_input_width select-style">
            <button type ="submit" name ="save" class="btn btn-" id="search">Go</button>
          </div>
        </div>
      </form>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="findprocedure_appointments_min_titel">
          <h1>Today's Appointments</h1>
        </div>
        <div class="findprocedure_appointments_content" >
          <?php foreach ($today_appointment as $tappointment) { ?>
          <div class="row todayApporepeatDiv" style="display:none;">
            <div class="col-md-3">
              <div class="findprocedure_appointments_content_date">
                <h1><strong>
                  <?php $dt = new DateTime($tappointment->booking_date); echo $dt->format('dS');     
				  ?>
                  </strong><br/>
                  <?php echo $dt->format('M'); ?><br/>
                  <font size=2><?php $time = $tappointment->booking_time;
				        echo date('h:i a',strtotime($time));
				   ?></font>
                  </h1>
              </div>
            </div>
            <div class="col-md-9">
              <div class="findprocedure_appointments_procedure_name"> <span>Procedure Name</span>
                <h2><?php echo $tappointment->procedure_name;?> </h2>
                <p><?php echo $tappointment->description;?></p>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6">
            <img src="<?php echo base_url().$tappointment->specialistpic;?>">
            <?php echo $tappointment->name ?>
            </div>
            <div class="col-md-6" style="margin-top:17px">
            <a href="#inline1" id="pbcancel" class="fancybox appointment_cancel" bid="<?php echo $tappointment->ID ?>">Cancel</a>
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="findprocedure_button"><a class="content_right_patients_load_more todayAppoloadMore" href="javascript:void(0)">load more</a></div>
        <div class="alert alert-success todaynorecord text-center" style="display:none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>No Record Found!</strong>
  </div>
      </div>
      <div class="col-md-6">
        <div class="findprocedure_appointments_min_titel">
          <h1>Upcoming's Appointments</h1>
        </div>
        <div class="findprocedure_appointments_content">
          <?php foreach ($upcoming_appointment as $uappointment) { ?>
          <div class="row upcomingApporepeatDiv" style="display:none;">
            <div class="col-md-3">
              <div class="findprocedure_appointments_content_date">
                <h1><strong>
                  <?php $dt = new DateTime($uappointment->booking_date); echo $dt->format('dS'); ?>
                  </strong><br/>
                  <?php echo $dt->format('M'); ?><br/>
                  <font size=2><?php $time = $uappointment->booking_time;
				        echo date('h:i a',strtotime($time));
				   ?></font>
                  </h1>
              </div>
            </div>
            <div class="col-md-9">
              <div class="findprocedure_appointments_procedure_name"> <span>Procedure Name</span>
                <h2><?php echo $uappointment->procedure_name;?> </h2>
                <p><?php echo $uappointment->description;?></p>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6">
            <img src="<?php echo base_url().$uappointment->specialistpic;?>">
            <?php echo $uappointment->name ?>
            </div>
            <div class="col-md-6" style="margin-top:17px">
			<a href="#inline1" id="pbcancel" class="fancybox appointment_cancel" bid="<?php echo $uappointment->ID ?>">Cancel</a>
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="findprocedure_button"><a class="content_right_patients_load_more upcomingLoadMore" href="javascript:void(0)">load more</a></div>
        <div class="alert alert-success upcomingnorecord text-center" style="display:none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>No Record Found!</strong>
  </div>
      </div>
    </div>
    <div id="inline1" style="width:300px;display: none;">
        <div class="popup_button_complete">
            <h1>Are you Sure?</h1>
            <p>You want to mark complete.</p>
            <div class="popup_button_complete_button"> <a href="javascript:void(0)" id="bcancel" class="active">yes</a> 
            <a href="javascript:void(0)" id="fancyboxClose">no</a> </div>
        </div>
    </div>
    <div class="findprocedure_appointments_min_titel">
      <h1>Past Appointments</h1>
     </div>
     <div class="pastappointmentDiv"> 
	<?php foreach($past_appointment as $pappointment){?>
        <div class="findprocedure_appointments_content repeatDiv" style="display:none;">
          <div class="row">
            <div class="col-md-6">
            
              <div class="findprocedure_appointments_content_date">
                <h1><strong>
                  <?php $dt = new DateTime($pappointment->booking_date); echo $dt->format('dS'); ?>
                  </strong><br/>
                  <?php echo $dt->format('M'); ?><br/>
                  <font size=2><?php $time = $pappointment->booking_time;
				        echo date('h:i a',strtotime($time));
				   ?></font>
                  </h1>
              </div>
              <div class="findprocedure_appointments_procedure_name"> <span>Procedure Name</span>
                <h2><?php echo $pappointment->procedure_name ?></h2>
                <p><?php echo $pappointment->description ?></p>
                <h3><span>Price</span> $<?php echo $pappointment->from_price ?> - $<?php echo $pappointment->to_price ?></h3>
              </div>
            </div>
            <div class="col-md-6">
              <div class="findprocedure_appointments_box_right">
                <div class="patient_book_appointment_left"> <img src="<?php echo base_url().$pappointment->specialistpic ?>">
                  <div class="patient_book_appointment_left_text">
                    <h1><?php echo $pappointment->name ?></h1>
                    <span><?php 
					//$specialization = array();
					$specialization = $pappointment->specialization; 
					$removeBrace = str_replace("[","",$specialization);
       				$removeBrace = str_replace('"', "",$removeBrace);
                    $removeBrace = str_replace(']', "",$removeBrace);
					echo $removeBrace; 
					?></span> 
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2"> </div>
            <div class="col-md-8">
              <ul class="findprocedure_appointments_menu_table">
                <li><a href="javascript:void(0)" data-toggle ="modal" class="pastprescription" data-target="#pendingPrescrps" bookingkey="<?php echo $pappointment->ID?>">
                Prescription</a></li>
                <li><a href="#">medical history</a></li>
                <li class="list"><a href="#">message</a></li>
              </ul>
            </div>
            <div class="col-md-2"> </div>
          </div>
        </div>
    <?php }?>
    </div>
    <div class="findprocedure_button"><a class="content_right_patients_load_more loadMore" href="javascript:void(0)">load more</a></div>
    <div class="alert alert-success norecord text-center" style="display:none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>No Record Found!</strong>
  </div>
</div>

<!-- Modal -->
<div id="pendingPrescrps" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Prescription Details</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
	var shown =  3;
	var todayApposhown = 5;
	var upcomingApposhown = 5;
	
	var $divs = $(".repeatDiv");
	var $div = $(".todayApporepeatDiv");
	var $upcomingdiv = $(".upcomingApporepeatDiv");
	
	var itemspast =  $(".repeatDiv").size();
	var itemstoday =  $(".todayApporepeatDiv").size();
	var itemsupcoming = $(".upcomingApporepeatDiv").size();
	
	$('.repeatDiv:lt(3)').show();
	$('.todayApporepeatDiv:lt(5)').show();
	$('.upcomingApporepeatDiv:lt(5)').show();
	
	shownVisible = $('.repeatDiv:visible').size();
	if(shownVisible == itemspast) {
		$('.loadmore').hide();
        $('.norecord').show();
	}
	
	todayApposhownVisible = $('.todayApporepeatDiv:visible').size();
	if(todayApposhownVisible == itemstoday) {
		$('.todayAppoloadMore').hide();
        $('.todaynorecord').show();
	}
	
	upcomingApposhownVisible = $('.upcomingApporepeatDiv:visible').size();
	if(upcomingApposhownVisible == itemsupcoming) {
		$('.upcomingLoadMore').hide();
		$('.upcomingnorecord').show();
	}
	
	
	
	
	
	$('.loadMore').click(function () {
		var itemspast =  $(".repeatDiv").size();
   		shown = $('.repeatDiv:visible').size()+3;
   		if(shown <= itemspast) {
	  		$('.repeatDiv:lt('+shown+')').show();
   		}
        else {
			$('.repeatDiv:lt('+itemspast+')').show();
          	$('.loadmore').hide();
          	$('.norecord').show();
      	}
    });
	
	$('.todayAppoloadMore').click(function () {
		var itemstoday =  $(".todayApporepeatDiv").size();
   		todayApposhown = $('.todayApporepeatDiv:visible').size()+5;
   		if(todayApposhown <= itemstoday) {
	  		$('.todayApporepeatDiv:lt('+todayApposhown+')').show();
   		}
        else {
			$('.todayApporepeatDiv:lt('+itemstoday+')').show();
          	$('.todayAppoloadMore').hide();
          	$('.todaynorecord').show();
      	}
    });
	
	$('.upcomingLoadMore').click(function () {
		var itemsupcoming =  $(".upcomingApporepeatDiv").size();
   		upcomingApposhown = $('.upcomingApporepeatDiv:visible').size()+5;
   		if(upcomingApposhown <= itemsupcoming) {
	  		$('.upcomingApporepeatDiv:lt('+upcomingApposhown+')').show();
   		}
        else {
			$('.upcomingApporepeatDiv:lt('+itemsupcoming+')').show();
          	$('.upcomingLoadMore').hide();
          	$('.upcomingnorecord').show();
      	}
    });
	
});	
</script>