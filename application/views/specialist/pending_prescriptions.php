<style type="text/css">
    .pending_advise_box_content3 ul li {        
        width: 90px!important;
    }
</style>
<div class="col-md-10 container_padding_none">
    <div class="content_right_dashboard">
        <div class="content_right_patients_titel">
            <h1>Pending Prescription</h1>            
        </div>  
        <div class="content_right1_patients">
            <div class="staff_top_titel">
                <h1>Total <?php echo count($pendingPrescriptions)?></h1>
                <div class="staff_top_titel_button">
                    <div id="inline1" style="display: block;">
                        <span><i class="fa fa-calendar"></i> <?php echo date("d M Y");?></span>
                    </div>
                </div>
            </div>
        </div>      
        <div class="content_right_dashboard_pending_advise">                
            <?php  $i=0;
            if(!empty($pendingPrescriptions)){
                foreach($pendingPrescriptions as $pendingPrescription) { 
                    $prescriptiondate = date('j', strtotime($pendingPrescription['patient_booking_date']));
                    $patientBookingDate = explode('-',$pendingPrescription['patient_booking_date']);
                    $ch =$patientBookingDate[1];
                    switch($ch)
                    {
                        case '01' : $month = "January";
                        break;
        
                        case '02' : $month = "February";
                        break;

                        case '03' : $month = "March";
                        break;

                        case '04' : $month = "April";
                        break;

                        case '05' : $month = "May";
                        break;

                        case '06' : $month = "June";
                        break;

                        case '07' : $month = "July";
                        break;

                        case '08' : $month = "August";
                        break;

                        case '09' : $month = "September";
                        break;

                        case '10' : $month = "October";
                        break;

                        case '11' : $month = "November";
                        break;

                        case '12' : $month =  "December";
                        break;                                             
                    } ?>
                    <div class="col-md-6">
                        <div class="item">
                            <div class="pending_advise_box1"> 
                                <img class="pending_advise_img1" src="<?php echo base_url().$pendingPrescription['patient_pic'];?>" />
                                <div class="pending_advise_box_content1">
                                    <div class="pending_advise_box_content2">
                                        <h2><?php echo $pendingPrescription['patient_name']?></h2>
                                        <h3><?php echo $month.' ';?><?php echo $prescriptiondate.'th';?>, <?php echo $patientBookingDate[0];?> at <?php echo $pendingPrescription['patient_booking_time'];?></h3>
                                    </div>
                                    <div class="pending_advise_box_content3">
                                        <ul>
                                            <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon1.png" /><span><?php echo isset($pendingPrescription['pendingprescheckup']->weight)?$pendingPrescription['pendingprescheckup']->weight:'No Check';?></span></li>

                                            <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon2.png" /><span><?php echo isset($pendingPrescription['pendingprescheckup']->body_fat)?$pendingPrescription['pendingprescheckup']->body_fat:"No check";?></span></li>

                                            <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon3.png" /><span><?php echo isset($pendingPrescription['pendingprescheckup']->BD)?$pendingPrescription['pendingprescheckup']->BD:"No check"?></span></li>
                                        </ul>
                                        <a href="#" data-toggle = "modal" data-target = "#pendingPrescrps" class="advise_button" bkey="<?php echo $pendingPrescription['booking_id'];?>" pkey="<?php echo $pendingPrescription['patientUserID'];?>">Advise</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } 
            }else{ ?> 
                <div class="item">
                    <div class="pending_advise_box1"> 
                        <div class="pending_advise_box_content1">
                            <h3 class="pending_advise-no-result">No Records Found !</h3> 
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class = "modal fade" id = "pendingPrescrps" tabindex = "-1" role = "dialog" aria-labelledby = "pendingPrescrpsLabel" aria-hidden = "true">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;</button>
                <h4 class = "modal-title" id = "pendingPrescrpsLabel">Prescription</h4>
            </div>
            <?php include('appointments/prescription.php'); ?>
            <input type="hidden" id="bookingid" />
            <input type="hidden" id="patientid" />
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<style>
    .pending_advise-no-result{
		text-align:center;
	}
</style>