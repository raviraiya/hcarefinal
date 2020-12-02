<div class="col-md-10 container_padding_none">

<div class="content_right_dashboard">

  <div class="content_right_patients_titel">

    <h1>Reports</h1>

  </div>

  <div class="content_right1_patients">

    <div class="appointments_width_block reports_content_left">

      <div class="patients_select reports_datepicker width27per">

        <label class="date_label">

          <input type="text" value="From" id="datepicker2" class='hasDatepicker'>

        </label>

      </div>

      <div class="patients_select reports_datepicker width27per">

        <label class="date_label">

          <input type="text" value="to" id="datepicker1" class='hasDatepicker'>

        </label>

      </div>

      <div class="patients_select appointments_button_go patients_input_width select-style"> <a href="javascript:void(0)" class="popup_button_go" id='reportSearch'>GO</a> </div>

      <div class="reports_right_button">

        <div class="staff_top_titel_button"> <a href="#">report <i class="fa fa-arrow-down"></i></a> <a href="#">Print <i class="fa fa-print"></i></a> </div>

      </div>

    </div>

  </div>

</div>

<div class="content_right_appointments_box">

  <div class="row reports_content">

    <div class="content_right_dashboard_last_week2"> <span><img src="<?php echo base_url()?>assets/images/last_week_patients_icon.png" /> Booked vs Cancel</span></div>

    <div class="col-md-12" id="booked_vs_cancel" style="height:300px; width:100%"  ></div>

    <div class="dashboard_homephy_slidr_right" style="display:none" id="booked_vs_cancel_res"> 
	    <div class="dashboard_slider_box">
	      <div class="item">
	          <div class="dashboard_slider_content"> <h3>No Record Found</h3></div>
	      </div>
	    </div>
  	</div>

  </div>

</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 

<script type="text/javascript">



$(document).ready(function(){

	$("#datepicker1, #datepicker2").datepicker({

			format: 'dd-mm-yyyy',

			autoclose: true

	});

	var baseUrl = "<?php echo base_url();?>";

	function charts(data,ChartType){

		var c = ChartType;

		var jsonData = data;	

		google.charts.load('current', {'packages':['corechart', 'bar']});

		google.charts.setOnLoadCallback(drawAreaChart);

	

		function drawAreaChart(){

			var data = google.visualization.arrayToDataTable([]);

	

			data.addColumn('string', 'display_date');

			data.addColumn('number', 'Total Appointment');

			data.addColumn('number', 'cancel Appointment');

			

			$.each(jsonData, function(i,jsonData)

			{

				var display_date = jsonData.display_date;

				var total_appt = jsonData.total_appt;

				var cancel_appt = jsonData.cancel_appt;

				data.addRows([ [display_date, total_appt, cancel_appt]]);

			});

			

			var options = {

				chart: {

					title: 'Booked Vs Cancel',

				},

				hAxis: {

					title: 'Booked Patients',

				},

				vAxis: {

					title: 'Cancel Patients'

				}

			};



			var chart = new google.visualization.AreaChart(document.getElementById('booked_vs_cancel'));

			chart.draw(data, options);

      	}

	}

	

	jQuery(document).on('click', '#reportSearch', function(e){

		var from=$("#datepicker2").val();

		var to=$("#datepicker1").val();  

		

		jQuery.ajax({

			url: baseUrl+'homephysician/homephysicianreport',

			data: {'from':from, 'to':to, 'tag':'report'},

			type:"POST",

			dataType:"json",

			success: function(response){
				if(response[0].mess != 'No Record Found'){
					console.log(response);

					charts(response,"AreaChart");
				}
				else{
					jQuery('#booked_vs_cancel_res').show();
    				jQuery('#booked_vs_cancel').hide();
				}
			},

			error: function(response){

				console.log("Error");

			}

		});

 	});

});

</script> 

