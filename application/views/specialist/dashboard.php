<script>
var flagvar=1;
</script>
<?php $oldNewStr='';$bookAppointmentStr="";
//print_r($lastweek_appt);die();
if(!empty($lastweek_appt)){
    foreach($lastweek_appt as $lastweek_ap){
        $dateSplit=explode( '-',$lastweek_ap[0]->date) ;
        $dateOrder =$dateSplit[2].'-'. $dateSplit[1].'-'.$dateSplit[0];
        $oldNewStr .= "['".$dateOrder."', ".$lastweek_ap[0]->old_patient.", ".$lastweek_ap[0]->new_patient."],";
        $bookAppointmentStr .= " ['".$dateOrder."',".$lastweek_ap[0]->total_appt.",".$lastweek_ap[0]->cancel_appt."],";
    }
}else{
    $oldNewStr = "['00-00-0000',0,0]";
    $dateOrder='';
    $bookAppointmentStr = "['00-00-0000',0,0]";
}
    //print_r($oldNewStr);die();
    //echo $oldNewStr;die();
    //print_r($bookAppointmentStr);die();?>
<style type="text/css">
    .pending_prescrip{
        background: #046676;
        padding: 5px 14px;
        font-size: 13px;
        margin: 0 0 0 15px;
        color: #fff;
        display: inline-block;
        border-radius: 20px;
        text-decoration: none;

    }    
    .pending_prescrip:focus,.pending_prescrip:visited,.pending_prescrip:active, .pending_prescrip:hover {
        color: fff;        
        text-decoration: none;
    }
</style>
<div class="col-md-10 container_padding_none">
    <div class="content_right_dashboard">
        <div class="content_right_dashboard_titel">
            <h1>Dashboard</h1>
            <span><i class="fa fa-calendar"></i> <?php echo date("d M Y");?></span> 
        </div>
        <div class="content_right1_dashboard">
            <div class="row">
                <div class="col-md-4">
                    <div class="content_right_dashboard_current1">
                        <h2>Current HRS</h2>
                        <span><i class="fa fa-clock-o"></i> <?php echo date('h').":00 ".date('A') ;?> </span> 
                        <a href="<?php echo base_url()?>specialist/patients"><i class="fa fa-user"></i> <?php echo $current_hrs_patients[0]->total;?> PATIENTS ON A QUEUE</a> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="content_right_dashboard_current1">
                        <h2>Today Appointments</h2>
                        <div class="layout">
                            <div class="layout-slider" style="width: 100%">
                                <div id="total_app_div"></div>
                                <div class="away_div_min">
                                    <div class="Away2_left"> <i class="fa fa-user"></i>
                                        <div id="nights"></div>
                                        <p>Completed</p>
                                    </div>
                                    <div class="Away3_right"> <i class="fa fa-user"></i>
                                        <div id="nights1"></div>
                                        <p>Pending</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="content_right_dashboard_current1 content_right_dashboard_current3">
                        <h2>Total Procedures</h2>
                        <span><img src="<?php echo base_url();?>assets/images/total_listed_icon.png" /> <?php echo $total_proced[0]->total;?>  Listed</span> 
                        <a href="<?php echo base_url();?>/specialist/procedure"><i class="fa fa-user"></i> 1 new added</a> 
                    </div>
                </div>
            </div>
        </div>
        <div class="content_right_dashboard_last_week">
            <div class="row">
                <div class="col-md-6">
                    <div class="content_right_dashboard_last_week1"> 
                        <span>Last Week Appointment</span> 
                        <a href="javascript:void(0)" id="printbookedvscancel">report <i class="fa fa-arrow-down"></i></a> 
                    </div>

                    <div class="content_right_dashboard_last_week2"> 
                        <span><i class="fa fa-calendar"></i> Booked vs Canceled</span>
                        <div class="content_right_dashboard_last_week3">
                            <p class="content_right_dashboard_booked"><i class="fa fa-circle" aria-hidden="true"></i> booked</p>
                            <p class="content_right_dashboard_cancel"><i class="fa fa-circle" aria-hidden="true"></i> canceled</p>
                        </div>
                    </div>
                    <?php  if($bookAppointmentStr!="['00-00-0000',0,0]"){?>
                        <div id="booked_vs_cancel"></div>
                    <?php  } else{ ?> 
                        <div class="item"  id="booked_vs_cancel">
                            <div class="pending_advise_box1"> 
                                <div class="pending_advise_box_content1">
                                    <h3 class="pending_advise-no-result">No Records Found !</h3> 
                                </div>
                            </div>
                        </div>
                    <?php  } ?>
                    <!-- <img class="content_right_dashboard_img_last_week1" src="<?php echo base_url();?>assets/images/content_right_dashboard_last_week1.png" /> --> 
                </div>

                <div class="col-md-6">
                    <div class="content_right_dashboard_last_week1"> 
                        <span>Last Week Patients</span> 
                        <a href="javascript:void(0)" id="printoldvsnew">report <i class="fa fa-arrow-down"></i></a> 
                    </div>

                    <div class="content_right_dashboard_last_week2"> 
                        <span><img src="<?php echo base_url();?>assets/images/last_week_patients_icon.png" /> Existing vs New Patient</span>
                        <div class="content_right_dashboard_last_week3">
                            <p class="content_right_dashboard_booked"><i class="fa fa-circle" aria-hidden="true"></i> new</p>
                            <p style="color:#046676;" class="content_right_dashboard_cancel"><i class="fa fa-circle" aria-hidden="true"></i> existing</p>
                        </div>
                    </div>
                    <?php if(trim($oldNewStr)!="['00-00-0000',0,0]"){  ?>
                        <div id="old_vs_new" style="width:100%;height:300px;" ></div>
                    <?php } else{ ?> 
                        <div class="item" id="old_vs_new" >
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
        <div class="content_right_dashboard_pending_advise">
            <div class="col-md-6">
                <h1><a class="pending_prescrip" target="_blank" href="<?php echo base_url()?>specialist/pending_prescriptions"><i class="fa fa-user"></i>&nbsp;<?php echo count($pendingPrescriptions)?> Pending Prescriptions</a> </h1>
                <div class="">
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

                                                <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon3.png" /><span><?php echo isset($pendingPrescription['pendingprescheckup']->BD)?$pendingPrescription['pendingprescheckup']->BD:"No check;"?></span></li>
                                            </ul>
                                            <a href="#" data-toggle = "modal" data-target = "#pendingPrescrps" class="advise_button" bkey="<?php echo $pendingPrescription['booking_id'];?>" pkey="<?php echo $pendingPrescription['patientUserID'];?>">Advise</a> 
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
            <div class="col-md-6">
                <h1><a class="pending_prescrip" target="_blank" href="<?php echo base_url()?>specialist/review"><i class="fa fa-user"></i>&nbsp;<?php echo count($specialist_reviews)?> Reviews on Procedures</a></h1>
                <div class="">
                    <?php if(!empty($specialist_reviews)){
                        foreach($specialist_reviews as $review){ ?>
                            <div class="item">
                                <div class="reviews_on_procedures_box1"> \
                                    <span class="reviews_on_procedures_box_titel">PROCEDURES NAME: <?php echo $review->procedure_name ?></span>
                                    <div class="reviews_on_procedures_box1_display">
                                        <div class="reviews_on_procedures_box2"> 
                                            <img class="reviews_on_procedures_img1" src="<?php echo base_url().$review->patient_picture ?>" />
                                            <div class="reviews_on_procedures_box_position">
                                                <img src="<?php echo base_url();?>assets/images/reviews_on_procedures_box_position.png" /><span><?php echo $review->rating ?></span>
                                            </div>
                                        </div>
                                        <div class="reviews_on_procedures_box_text">
                                            <p><?php echo $review->review ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else{ ?>
                        <div class="item">
                            <div class="pending_advise_box1">
                                <h3 class="pending_advise-no-result">No Records Found !</h3>
                            </div>
                        </div>
                    <?php } ?> 
                </div>
            </div>
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
<input type="hidden" name="specialist_hospital" value="<?php echo $specialist_hospital; ?>">
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--<div id="inline" style="width:300px;display: none;">
                                <div class="popup_button_complete">
                                    <h1>Are you Sure?</h1>
                                    <p>You want to Save.</p>
                                    <div class="popup_button_complete_button"> <a href="javascript:void(0)" class="active savebtn11">yes</a><a href="javascript:void(0)" id="fancyboxClose">no</a><input type="hidden" id="bookingid"  /></div>
                                </div>
</div>-->
<?php  if(!empty($today_appt)){ ?>
    <script>
        $(function() {
            $( "#total_app_div" ).slider({
                range: true,
                min: 0,
                max: <?php  echo $today_appt[0]->total_appt; ?>,
                values: [ 0, <?php echo $today_appt[0]->complete_appt;?>     ],
                disabled: true
            });

            $("#nights").html(<?php echo $today_appt[0]->complete_appt;?>   );
            $("#nights1").html(<?php echo $today_appt[0]->total_appt-$today_appt[0]->complete_appt;?>   );
        });
    </script>
<?php } else { ?>
    <script>
        $(function() {
            $( "#total_app_div" ).slider({
                range: true,
                min: 0,
                max: 99,
                values: [ 0, 0   ],
                disabled: true
            });
            $("#nights").html(0   );
            $("#nights1").html(0  );
        });
    </script>
<?php } ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart', 'bar'],});
    <?php  if($bookAppointmentStr!="['00-00-0000',0,0]"){  ?>
        google.charts.setOnLoadCallback(booked_vs_cancel);
        //google.charts.setOnLoadCallback(old_vs_new);
        function booked_vs_cancel() {
            var data = google.visualization.arrayToDataTable([
              ['Date', 'Booked', 'Canceled'],
               <?php echo $bookAppointmentStr;?>
            ]);

            var options = {
              title: '',
              hAxis: {title: 'Date',  titleTextStyle: {color: '#333', fontName:'Roboto', italic: false }},
              colors: ['#0E92A7','#DC3912'],
              vAxis: {minValue: 0},
              width:525,
              height:300,
              chartArea:{left:50,top:20,width:"67%",height:"80%"},
              legend:{textStyle:{fontSize:'14', fontName:'Roboto', fill:'#757575'}},
              tooltip:{textStyle:{fontSize:'14', fontName:'Roboto', fill:'#757575'}}
            };
            var chart = new google.visualization.AreaChart(document.getElementById('booked_vs_cancel'));
            chart.draw(data, options);
        }
    <?php  } ?>    
</script>

<script type="text/javascript">
    // google.charts.load('current', {packages: ['corechart', 'bar']});
    /*google.charts.setOnLoadCallback(drawMaterial);
    function drawMaterial() {
        var data = new google.visualization.DataTable();
                      data.addColumn('date', 'Date');
                      data.addColumn('number', 'Existing');
                      data.addColumn('number', 'New Patient');
                      data.addRows([
                      <?php  //echo $oldNewStr;?>
                      ]);
                      var options = {
                        title: '',
                        hAxis: {
                          title: 'Date',
                          format: 'M/d/yy',
                        },
                        colors: ['#D3D3D3', '#0E92A7'],
                        vAxis: {
                          title: ''
                        },
                        legend: 'none'
                      };
                      var material = new google.charts.Bar(document.getElementById('old_vs_new'));
                      material.draw(data, options);
    } */
    <?php if(trim($oldNewStr)!="['00-00-0000',0,0]"){  ?>
    google.charts.setOnLoadCallback(drawMaterial);
    function drawMaterial() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Existing', 'New Patient'],
           <?php echo $oldNewStr;?>
        ]);
        var options = {
            title: '',
            hAxis: {
              title: 'Date',
              format: 'M/d/yy',
            },
            colors: ['#D3D3D3', '#0E92A7'],
            vAxis: {
              title: ''
            },
            legend: 'none'
        };

        var material = new google.charts.Bar(document.getElementById('old_vs_new'));
        material.draw(data, options);
    }
    <?php } ?>

    $('#printbookedvscancel').click(function(){
        printDiv('booked_vs_cancel');
    });

    $('#printoldvsnew').click(function(){
        printDiv('old_vs_new');
    }); 
    
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var hospitallogo = $('.logo').html();
        var specialist_hospital = $('input[name=specialist_hospital]').val();
        var specialist = $('.specialist_name').html();
        var html = '<html>';
            html +=     '<head>';
            html +=         '<title>Hcare</title>';
            html +=         '<style>';
            html +=             '.printeble_div div div{ margin:0 auto}';
            html +=             '.printeble_div_specialist{ text-align: right;vertical-align: bottom;}';
            html +=             '.printeble_div_logo{ float:left}';
            html +=             '.printeble_div{ text-align: center; margin-top: 120px;}';
            html +=             '.printeble_div_specialist_hp{ text-align: right;}';
            html +=         '</style>';
            html +=     '</head>';
            html += '<body>';
            html +=     '<div>';
            html +=         '<table style="width:100%">';
            html +=             '<tr>';
            html +=                 '<td class="printeble_div_logo">'+hospitallogo+'</td>';
            html +=                 '<td class="printeble_div_specialist">'+specialist+'</td>';
            html +=             '</tr>';
            html +=             '<tr>';
            html +=                 '<td></td>';
            html +=                 '<td class="printeble_div_specialist_hp">'+specialist_hospital+'</td>';
            html +=             '</tr>';
            html +=             '<tr>';
            html +=                 '<td></td>';
            html +=                 '<td></td>';
            html +=             '</tr>';
            html +=             '<tr>';
            html +=                 '<td colspan="2" class="printeble_div">'+printContents+'</td>';
            html +=             '</tr>';
            html +=         '</table>';
            html +=     '<div>';
            html += '</body>';
            html += '<script type="text/javascript">window.print();<'+'/script>'
            html += '</html>';
        /*$('.modal-body').html(html);
        $('#myModal').modal('show');*/
        
        var yourDOCTYPE = "<!DOCTYPE html>"; 
        var printDocument = window.open('about:blank', '', "resizable=yes,scrollbars=yes,status=yes,menubar=yes");
        printDocument.document.write(yourDOCTYPE+html);
    }
</script>
<style>
    .pending_advise-no-result{
        text-align:center;
    }
</style>