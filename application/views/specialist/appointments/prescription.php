<div class="apointment_perscription_right_titel"> 
Days <input type="number" class="validfor">
<a id='savePrescription' href="javascript:void(0)">Save</a> 
<a href="javascript:void(0)" id="printprescription" style="margin-right:10px">Print <i class="fa fa-print"></i></a> 
</div>
<div class="apointment_perscription_right_details">
  <div class="apointment_perscription_right_details1">
    <input placeholder="Details" id="medicineDetails" />
  </div>
  <div class="apointment_perscription_right_details1 apointment_perscription_right_details1_input2">
    <input placeholder="Dose" id="medicineDose"  />
  </div>
  <div class="apointment_perscription_right_details1 apointment_perscription_right_details1_select">
    <div class="select-style">
      <select id="medicineTime">
        <option value="">Select Time</option>
        <option value="morning">Morning</option>
        <option value="afternoon">Afternoon</option>
        <option value="evening">Evening</option>
        <option value="night">Night</option>
      </select>
    </div>
  </div>
  <div class="apointment_perscription_right_details1 apointment_perscription_right_details_plus"> <a href="javascript:void(0)" id="addPrescription"><i class="fa fa-plus"></i></a> </div>
</div>
<div class="apointment_perscription_right_border_bg"> </div>
<div class="apointment_perscription_box_background">
  <div class="apointment_perscription_box1_background" id="prescriptionDetails"> </div>
</div>
<script>
$('#printprescription').click(function(){
		printDiv('prescriptionDetails');
		  });	
		function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
</script>