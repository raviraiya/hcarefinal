<?php  

      $alltodaypatients =count($patients);

      $totaltodaypatients = ceil($alltodaypatients / 3);

?>

<div class="col-md-10 container_padding_none">

  <div class="content_right_dashboard">

    <div class="content_right_dashboard_titel">

      <h1>Dashboard</h1>

      <span><i class="fa fa-calendar"></i><?php echo date("d M Y");?></span> </div>

    <div class="content_right1_dashboard">

      <div class="row">

        <div class="col-md-1"></div>

        <div class="col-md-4">

          <div class="content_right_dashboard_current1">

            <div class="dashboard_homephy_left_titel">

              <h2>Today Patients Appointment</h2>

              <span></span> </div>

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

        <div class="col-md-1"></div>

        <div class="col-md-6">

          <div class="dashboard_homephy_round_slider">

            <input class="round_slider" data-bgcolor="#0D92A7" data-fgColor="#60D7E8" data-thickness=".4" readonly value="<?php echo $totaldata;?>" data-width="100%">

          </div>

          <div class="dashboard_homephy_round_text">

            <h2>Patients</h2>

            <span><i style="color:#0D92A7;" class="fa fa-circle"></i> <?php echo ($totaldata-$statusforzero);?> Joined</span> <span><i style="color:#60D7E8;" class="fa fa-circle"></i><?php echo $statusforzero;?> Pending</span> </div>

        </div>

      </div>

    </div>

  </div>

  <div class="content_right_dashboard_last_week">

    <div class="row">

      <div class="col-md-6">

        <div class="content_right_dashboard_last_week1"> <span>Last Week Appointment</span> <a id="printbookedvscancel" href="javascript:void(0)">report <i class="fa fa-arrow-down"></i></a> </div>

        <div class="content_right_dashboard_last_week2"> <span><i class="fa fa-calendar"></i> Booked vs Cancel</span>

          <div class="content_right_dashboard_last_week3">

            <p class="content_right_dashboard_booked"><i class="fa fa-circle" aria-hidden="true"></i> booked</p>

            <p class="content_right_dashboard_cancel"><i class="fa fa-circle" aria-hidden="true"></i> cancel</p>

          </div>

        </div>

          <div id ="hmchart_div" style="width:100%;height:300px;"></div>
          
          <div class="dashboard_homephy_slidr_right" style="display:none" id="hmchart_div_res"> 
            <div class="dashboard_slider_box">
              <div class="item">
                  <div class="dashboard_slider_content"> <h3>No Record Found</h3></div>
              </div>
            </div>
          </div>

          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

          <script type="text/javascript">
              	function charts(data){

              	  var jsonData = data;
                    google.charts.load('current', {'packages':['corechart'],});

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



              			var chart = new google.visualization.AreaChart(document.getElementById('hmchart_div'));

              			chart.draw(data, options);

                    	}
                }
          </script>

        </div>

      <div class="col-md-6">

        <div class="content_right_dashboard_last_week1"> <span>Appointment Reminder</span> </div>

        <div class="content_right_dashboard_last_week2"> <span class="dashboard_homephy_today_text">Today <i class="fa fa-angle-down"></i></span>

          <!-- <div class="content_right_dashboard_last_week3"> <a href="#" class="dashboard_homephy_button_am">am</a> <a href="#" class="dashboard_homephy_button_am active">pm</a> </div> -->

        </div>

        <div class="dashboard_homephy_slidr_right"> 

          <!--<div class="dashboard_homephy_new_top_box_slider"> 

                             <div class="owl-carousel_reminder">

                <div class="item">	<span>01:00</span> </div>              

                          <div class="item">	      <span>02:00</span>  </div>  

                         <div class="item">	       <span>03:00</span>    </div>  

                          <div class="item">	      <span>04:00</span> </div>

                           <div class="item">	     <span>05:00</span>  </div>             

                           <div class="item">	     <span>06:00</span>  </div>  

                           <div class="item">	     <span>07:00</span> </div>     

                                <span>08:00</span> </div></div>-->

          

          <div class="dashboard_slider_box">

          <?php if($totaltodaypatients > 1){ ?>

            <div class="owl-carousel_homephy">

              <?php

				if(!empty($patients)){

                        $k=0;

                         $m=2;

                 for($i=0;$i<$totaltodaypatients;$i++){?>

              <div class="item">

                <?php

            for($j=$k;$j<=$m;$j++){

               if(array_key_exists($j,$patients)){  ?>

                <div class="dashboard_slider_content"> <img src="<?php echo  base_url().$patients[$j]->picture;?>" />

                  <ul>

                    <li>

                      <p><?php echo $patients[$j]->fname.' '.$patients[$j]->lname ; ?></p>

                    </li>

                    <li>

                      <p style="text-align:center;"><i class="fa fa-clock-o"></i> <?php echo $patients[$j]->booking_time ; ?></p>

                    </li>
                    <li   class="todayAppointment"><a><img src="<?php echo  base_url(); ?>assets/images/reminder_icon.png" /> reminder</a> </li>

                    <input type="hidden" value="<?php echo $patients[$j]->email.'$#$'.$patients[$j]->userid; ?>" />

                  </ul>

                </div>

                <?php }}

							 $k=$k+3;

                             $m=$m+3;

							?>

              </div>

              <?php }}?>

              

              

            </div>

            <?php }else if($totaltodaypatients == 1){?>

            <div class="item">

                <?php

            for($j=0;$j<=2;$j++){

               if(array_key_exists($j,$patients)){  ?>

                <div class="dashboard_slider_content"> <img src="<?php echo  base_url().$patients[$j]->picture;?>" />

                  <ul>

                    <li>

                      <p><?php echo $patients[$j]->fname.' '.$patients[$j]->lname ; ?></p>

                    </li>

                    <li>

                      <p style="text-align:center;"><i class="fa fa-clock-o"></i> <?php echo $patients[$j]->booking_time ; ?></p>

                    </li>

                    <li   class="todayAppointment"><a><img src="<?php echo  base_url(); ?>assets/images/reminder_icon.png" /> reminder </a></li>

                    <input type="hidden" value="<?php echo $patients[$j]->email.'$#$'.$patients[$j]->userid.'$#$'.$patients[$j]->bID; ?>" />

                  </ul>

                </div>

                <?php }}?>

              </div>

            <?php }else { ?>

            <div class="item">

                <div class="dashboard_slider_content"> <h3>No Appointment for Today</h3></div>

              </div>

              <?php }?>

          </div>

        </div>

      </div>

    </div>

    <div class="content_right_dashboard_pending_advise homephy_dashboard_bottom_slider">

      <h1>Reviews on Procedures</h1>

      <div class="owl-carousel">

      	<?php foreach($reviews as $review){?>

        <div class="item">

          <div class="reviews_content_box">

            <div class="reviews_content_box_top">

              <div class="reviews_content_box_left">

                <h1>PROCEDURES NAME: </h1>

                <h2><?php echo $review->procedure_name ?></h2>

              </div>

              <div class="reviews_content_box_center"> <img src="<?php echo  base_url();?>assets/images/reviews_on_procedures_box_position.png"> <span><?php echo $review->rating ?></span> </div>

              <div class="reviews_content_box_right">

                <h1>specialist name: </h1>

                <h2><?php echo $review->specialistname ?></h2>

              </div>

            </div>

            <div class="reviews_content_box_bottom">

              <div class="reviews_content_box_bottom_left"> <img src="<?php echo  base_url().$review->patient_picture ?>"> <span><?php echo $review->patient_name ?></span> </div>

              <div class="reviews_content_box_bottom_right">

                <p><?php echo $review->review ?></p>

              </div>

            </div>

          </div>

        </div>

        <?php }?>

      </div>

    </div>

  </div>

</div>

<div>

  <h4 id="para2"></h4>

  <h3 id="para3"></h3>

</div>

<script>

 

 $(function() {

	 /*slider function start*/

	$.ajax({ 

		type:"POST",                                    

		url: '<?php echo base_url() ?>homephysician/getTotalPatient',

		dataType: 'json',      

		success: function(response)

		{

      if(response != null){

          $(response).each(function(key, value){

        $(".dashboard_homephy_left_titel span:eq(0)").text('Total: '+value.total_appt);

        $( "#total_app_div" ).slider({

          range: true,

          min: 0,

          max: value.total_appt,

          values: [value.complete_appt,value.total_appt],

          slide: function( event, ui ) {

            $("#nights").html(ui.values[ 0 ]);

            $("#nights1").html(ui.values[ 1 ]);

          }

        });

        $("#nights").html($("#total_app_div").slider("values", 0));

        $("#nights1").html(value.cancel_appt);

      });

      }

      else{

        $(".dashboard_homephy_left_titel span:eq(0)").text('Total: 0');

          $( "#total_app_div" ).slider({

                range: true,

                min: 0,

                max: 99,

                values: [ 0, 0   ],

                disabled: true

            });

            $("#nights").html(0   );

            $("#nights1").html(0  );

            

      }

			

			

		}

	});

    /*slider function end*/

	 

	 

	 /*knob function start*/

	 $(".round_slider").knob({});

	$(".appointmentTime").on("click",function(){

			//var appointmentTime = $(this);

			var currentTime = $(this).html();

			//alert(value);

		$.ajax({ 

			type:"POST",                                    

			url: 'homephysician/currentAppointmentList',

			data:{'currentTime':currentTime},

			dataType: 'json',      

			success: function(response)

			{alert(response);

			}

		});

	});

	

	jQuery.ajax({

		url: 'homephysician/homephysicianreport',

		data: {'tag':'dashboard'},

		type:"POST",

		dataType:"json",

		success: function(response){
      if(response[0].mess != 'No Record Found'){
        console.log(response);
        charts(response);
      }
      else{
        jQuery('#hmchart_div_res').show();
        jQuery('#hmchart_div').hide();
      }
		},

		error: function(response){

			console.log("Error");

		}

	});

});

$('#printbookedvscancel').click(function(){
    printDiv('hmchart_div');
});

function printDiv(divName) {
  var printContents = document.getElementById(divName).innerHTML;
  var hospitallogo = $('.logo').html();
  var specialist_hospital = '';//$('input[name=specialist_hospital]').val();
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