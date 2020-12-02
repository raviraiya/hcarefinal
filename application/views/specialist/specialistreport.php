<?php $oldNewStr='';$bookAppointmentStr="";

foreach($lastweek_appt as $lastweek_ap){
	$dateSplit=explode( '-',$lastweek_ap[0]->date) ;
	$dateOrder =$dateSplit[2].'-'. $dateSplit[1].'-'.$dateSplit[0];
	$oldNewStr .= "[{v: new Date(".$dateSplit[0].",". $dateSplit[1].",". $dateSplit[2]."), f: '".$dateOrder."'}, ".$lastweek_ap[0]->old_patient.", ".$lastweek_ap[0]->new_patient."],";
	
	$bookAppointmentStr .= " ['".$dateOrder."',".$lastweek_ap[0]->total_appt.",".$lastweek_ap[0]->cancel_appt."],";
	}

?>
<div class="col-md-10 container_padding_none">
  <div class="content_right_dashboard">
    <div class="content_right_patients_titel">
      <h1>Reports</h1>
    </div>  
    <div class="content_right1_patients"> 
       
       <div class="appointments_width_block reports_content_left">
          <div class="patients_select patients_select_width select-style">
            <select name='specialistReportProcCat' class='selectProcedureCat' id='specialistReportProcCat'>
              <option selected="selected" value=''>Select Procedure Category</option>
              <?php foreach($category as $resultcategory) { ?>
              <option value='<?php echo $resultcategory->ID;?>'><?php echo $resultcategory->category_name;?></option>
              <?php } ?>
            </select>
          </div> 
          <div class="patients_select patients_select_width select-style">
            <select name='specialistReportProcName' class='selectProcedure' id='specialistReportProcName'>
                <option selected="selected" value=''>Select Procedure</option>
              <?php foreach($procedure as $procedurename) { ?>
              <option ><?php echo $procedurename->procedure_name; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="patients_select reports_datepicker">
             <label class="date_label">
                    <input type="text" value="From" id="datepicker2" class='hasDatepicker'></label>
          </div> 
            <div class="patients_select reports_datepicker">
             <label class="date_label">
                    <input type="text" value="to" id="datepicker1" class='hasDatepicker'></label>
          </div> 
          <div class="patients_select appointments_button_go patients_input_width select-style"> 
            <a href="javascript:void(0)" class="popup_button_go" id='reportSearch'>GO</a>
             
            
             </div> 
             <div class="reports_right_button">
             <div class="staff_top_titel_button">
                     
                      
                    <a href="#">report <i class="fa fa-arrow-down"></i></a>
                    <a href="#">Print <i class="fa fa-print"></i></a> 
                 </div>
             </div>
       </div>  
      </div> 
      <div class="content_right_appointments_box">
      
   <div class="row reports_content">
   		 <div id="bookeddiv" style="display:none">
         <div class="content_right_dashboard_last_week2"> <span><img src="<?php echo base_url()?>assets/images/last_week_patients_icon.png" /> Booked vs Cancel</span></div>
         <div class="col-md-12" id="booked_vs_cancel" style="height:300px; width:100%"  ></div></div>
         <div id="olddiv" style="display:none">
         <div class="content_right_dashboard_last_week2"> <span><img src="<?php echo base_url()?>assets/images/last_week_patients_icon.png" /> Old vs New</span></div>
         <div class="col-md-12"  id="old_vs_new" style="height:300px; width:100%" ></div></div>
    </div>
  </div>
</div>
<input type="hidden" id="tag" value="<?php echo $tag ?>" />  
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	var baseUrl = "<?php echo base_url();?>";
	function charts(data,ChartType){
		var c = ChartType;
		var jsonData = data;	
		google.charts.load('current', {'packages':['corechart', 'bar']});
		if(ChartType == "BarChart"){
			google.charts.setOnLoadCallback(drawBarChart);
		}else if(ChartType == "AreaChart"){
			google.charts.setOnLoadCallback(drawAreaChart);
		}
		
		function drawBarChart(){
			var data = google.visualization.arrayToDataTable([]);
			
			data.addColumn('string', 'display_date');
			data.addColumn('number', 'Existing Patients');
			data.addColumn('number', 'New Patients');
			
			$.each(jsonData, function(i,jsonData)
			{
				var display_date = jsonData.display_date;
				var total_appt = jsonData.total_appt;
				var cancel_appt = jsonData.cancel_appt;
				data.addRows([ [display_date, total_appt, cancel_appt]]);
			});
				
			var options = {
				chart: {
					//title: 'Old Vs New',
				},
				hAxis: {
					title: 'Existing Patients',
				},
				vAxis: {
					title: 'New Patients'
				}
			};
		
			var chart = new google.charts.Bar(document.getElementById('old_vs_new'));
			chart.draw(data, google.charts.Bar.convertOptions(options));
		}

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
	
	$("#datepicker2, #datepicker1").datepicker({
			format: 'dd-mm-yyyy',
			autoclose: true
	});
	
	jQuery(document).on('change', '.selectProcedureCat', function(e){
		//var category = jQuery('.selectProcedureCat option:selected').val();
		var category = $(this).find('option:selected').val();
		var tag = "procedurecategory";
		var html = '';
		jQuery.ajax({
			url: baseUrl+'specialist/ajaxData',
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
					jQuery(".selectProcedure").html('');
					jQuery(".selectProcedure").html(html);
				}else if(response.error == 1){
					
				}
			},
			error: function(response){
				console.log("Error");
			}
		});	
	});
	
	jQuery(document).on('click', '#reportSearch', function(e){
		var catName=$("#specialistReportProcCat").val();
		var procName=$("#specialistReportProcName").val();
		var from=$("#datepicker2").val();
		var to=$("#datepicker1").val();  
		
		jQuery.ajax({
				url: baseUrl+'specialist/ajaxData',
				data: {'procName':procName, 'from':from, 'to':to, 'catName':catName, 'tag':'reportChartList'},
				type:"POST",
				dataType:"json",
				success: function(response){
					console.log(response);
					<?php if($tag == 'booked_vs_cancel'){ ?>
						charts(response,"AreaChart");
						jQuery("#bookeddiv").css('display', 'block');
					<?php }elseif($tag == 'old_vs_new'){ ?>
						charts(response,"BarChart");
						jQuery("#olddiv").css('display', 'block');
					<?php }?>
				},
				error: function(response){
					console.log("Error");
				}
			});
 	});
});
</script>

     