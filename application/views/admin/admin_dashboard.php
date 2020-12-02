<div class="col-md-10 container_padding_none">

  <div class="content_right_dashboard">

    <div class="content_right_dashboard_titel">

      <h1>Dashboard</h1>

      <span><i class="fa fa-calendar"></i> <?php echo date("d M Y");?></span> </div>

    <div class="content_right1_dashboard">

      <div class="row">

        <?php /*?><div class="col-md-4">

          <div class="content_right_dashboard_current1">

            <h2>Current HRS</h2><?php */?>

              <?php

                if(isset($current_hrs_patients) && !empty($current_hrs_patients)){

                   $total_patient =  $current_hrs_patients[0]->total;

                }else{

                    $total_patient = '';    

                }



                if(!empty($total_proced)){

                   $total_proced =  $total_proced[0]->total;

                }else{

                    $total_proced = '';    

                }



              ?>

              

           <?php /*?> <span><i class="fa fa-clock-o"></i> <?php echo date('h').":00 ".date('A') ;?> </span> <a href="#"><i class="fa fa-user"></i> <?php echo $total_patient;?> PATIENTS ON A QUEUE</a> </div>

        </div><?php */?>

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

            <span><img src="<?php echo base_url();?>assets/images/total_listed_icon.png" /> <?php echo $total_proced ;?> Listed</span> <a href="http://demo.grouperocket.ca/specialist/procedure"><i class="fa fa-user"></i> 1 new added</a> </div>

        </div>

      </div>

    </div>

    <div class="content_right_dashboard_last_week">

      <div class="row">

        <div class="col-md-6">

          <div class="content_right_dashboard_last_week1"> <span>Last Week Appointment</span> <a href="#">report <i class="fa fa-arrow-down"></i></a> </div>

          <div class="content_right_dashboard_last_week2"> <span><i class="fa fa-calendar"></i> Booked vs Cancel</span>

            <div class="content_right_dashboard_last_week3">

              <p class="content_right_dashboard_booked"><i class="fa fa-circle" aria-hidden="true"></i> booked</p>

              <p class="content_right_dashboard_cancel"><i class="fa fa-circle" aria-hidden="true"></i> cancel</p>

            </div>

          </div>

          <div id="booked_vs_cancel" style="width:100%;height:300px;" ></div>

          <!-- <img class="content_right_dashboard_img_last_week1" src="<?php echo base_url();?>assets/images/content_right_dashboard_last_week1.png" /> --> </div>

        <div class="col-md-6">

          <div class="content_right_dashboard_last_week1"> <span>Last Week Patients</span> <a href="#">report <i class="fa fa-arrow-down"></i></a> </div>

          <div class="content_right_dashboard_last_week2"> <span><img src="<?php echo base_url();?>assets/images/last_week_patients_icon.png" /> Old vs New</span>

            <div class="content_right_dashboard_last_week3">

              <p class="content_right_dashboard_booked"><i class="fa fa-circle" aria-hidden="true"></i> new</p>

              <p style="color:#046676;" class="content_right_dashboard_cancel"><i class="fa fa-circle" aria-hidden="true"></i> old</p>

            </div>

          </div>

          <div id="old_vs_new" style="width:100%;height:300px;" ></div>

          <!--  <img class="content_right_dashboard_img_last_week1" src="<?php echo base_url();?>assets/images/content_right_dashboard_last_week2.png" />  --></div>

      </div>

    </div>

    <?php /*?><div class="content_right_dashboard_pending_advise">

      <h1>Pending Prescriptions (5)</h1>

      <div class="owl-carousel">

        <div class="item">

          <div class="pending_advise_box1"> <img class="pending_advise_img1" src="<?php echo base_url();?>assets/images/pending_advise_img1.png" />

            <div class="pending_advise_box_content1">

              <div class="pending_advise_box_content2">

                <h2>Sarah Mclean</h2>

                <h3>22nd June, 2016 at 11:30am</h3>

              </div>

              <div class="pending_advise_box_content3">

                <ul>

                  <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon1.png" /><span>130</span></li>

                  <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon2.png" /><span>5'9</span></li>

                  <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon3.png" /><span>105</span></li>

                </ul>

                <a href="#" class="advise_button">advise</a> </div>

            </div>

          </div>

        </div>

        <div class="item">

          <div class="pending_advise_box1"> <img class="pending_advise_img1" src="<?php echo base_url();?>assets/images/pending_advise_img1.png" />

            <div class="pending_advise_box_content1">

              <div class="pending_advise_box_content2">

                <h2>Sarah Mclean</h2>

                <h3>22nd June, 2016 at 11:30am</h3>

              </div>

              <div class="pending_advise_box_content3">

                <ul>

                  <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon1.png" /><span>130</span></li>

                  <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon2.png" /><span>5'9</span></li>

                  <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon3.png" /><span>105</span></li>

                </ul>

                <a href="#" class="advise_button">advise</a> </div>

            </div>

          </div>

        </div>

        <div class="item">

          <div class="pending_advise_box1"> <img class="pending_advise_img1" src="<?php echo base_url();?>assets/images/pending_advise_img1.png" />

            <div class="pending_advise_box_content1">

              <div class="pending_advise_box_content2">

                <h2>Sarah Mclean</h2>

                <h3>22nd June, 2016 at 11:30am</h3>

              </div>

              <div class="pending_advise_box_content3">

                <ul>

                  <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon1.png" /><span>130</span></li>

                  <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon2.png" /><span>5'9</span></li>

                  <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon3.png" /><span>105</span></li>

                </ul>

                <a href="#" class="advise_button">advise</a> </div>

            </div>

          </div>

        </div>

        <div class="item">

          <div class="pending_advise_box1"> <img class="pending_advise_img1" src="<?php echo base_url();?>assets/images/pending_advise_img1.png" />

            <div class="pending_advise_box_content1">

              <div class="pending_advise_box_content2">

                <h2>Sarah Mclean</h2>

                <h3>22nd June, 2016 at 11:30am</h3>

              </div>

              <div class="pending_advise_box_content3">

                <ul>

                  <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon1.png" /><span>130</span></li>

                  <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon2.png" /><span>5'9</span></li>

                  <li><img src="<?php echo base_url();?>assets/images/pending_advise_icon3.png" /><span>105</span></li>

                </ul>

                <a href="#" class="advise_button">advise</a> </div>

            </div>

          </div>

        </div>

      </div>

      <h1>Reviews on Procedures</h1>

        <?php 

            if(isset($specialist_reviews) && !empty($specialist_reviews)){

        ?>

      <div class="owl-carousel">

          

        <?php foreach($specialist_reviews as $review){?>

        <div class="item">

          <div class="reviews_on_procedures_box1"> <span class="reviews_on_procedures_box_titel">PROCEDURES NAME: <?php echo $review->procedure_name ?></span>

            <div class="reviews_on_procedures_box1_display">

              <div class="reviews_on_procedures_box2"> <img class="reviews_on_procedures_img1" src="<?php echo base_url().$review->patient_picture ?>" />

                <div class="reviews_on_procedures_box_position"><img src="<?php echo base_url();?>assets/images/reviews_on_procedures_box_position.png" /><span><?php echo $review->rating ?></span></div>

              </div>

              <div class="reviews_on_procedures_box_text">

                <p><?php echo $review->review ?></p>

              </div>

            </div>

          </div>

        </div>

        <?php }

          

            }?>

      </div>

    </div><?php */?>

  </div>

</div>

<?php  if(!empty($today_appt)){ ?>

<script>

    $(function() {

        $( "#total_app_div" ).slider({

            range: true,

            min: 0,

            max: <?php  echo $today_appt[0]->total_appt; ?>,

            values: [ 0, <?php echo $today_appt[0]->complete_appt;?>   ],

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

      google.charts.setOnLoadCallback(booked_vs_cancel);

       //google.charts.setOnLoadCallback(old_vs_new);

      function booked_vs_cancel() {

        var data = google.visualization.arrayToDataTable([

          ['Date', 'Booked', 'Cancel'],

          ['21-07-2016',  10,      2],

          ['22-07-2016',  15,      2],

          ['23-07-2016',  9,       1],

          ['24-07-2016',  6,      0]

        ]);

        var options = {

          title: '',

          hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},

          vAxis: {minValue: 0},

          width:450,

          height:300,

           chartArea:{left:50,top:20,width:"70%",height:"80%"}

        };

        var chart = new google.visualization.AreaChart(document.getElementById('booked_vs_cancel'));

        chart.draw(data, options);

      }

      

      

    </script> 

<script type="text/javascript">

   // google.charts.load('current', {packages: ['corechart']});

google.charts.setOnLoadCallback(drawMaterial);

function drawMaterial() {

      var data = new google.visualization.DataTable();

      data.addColumn('date', 'Date');

      data.addColumn('number', 'Old Patients');

      data.addColumn('number', 'New Patient');

      data.addRows([

        [{v: new Date(2016, 07, 20), f: '20-07-2016'}, 5, 2],

        [{v: new Date(2016, 07, 21) , f: '21-07-2016'}, 2, 5],

        [{v: new Date(2016, 07, 22) , f: '22-07-2016'}, 8, 2],

        [{v: new Date(2016, 07, 23), f: '23-07-2016'}, 9, 6],

        [{v: new Date(2016, 07, 24), f: '24-07-2016'}, 3, 1],

      ]);

      var options = {

        title: '',

        hAxis: {

          title: 'Date',

        

        },

        vAxis: {

          title: ''

        },

        legend: 'none'

      };

      var material = new google.charts.Bar(document.getElementById('old_vs_new'));

      material.draw(data, options);

    }

    </script>