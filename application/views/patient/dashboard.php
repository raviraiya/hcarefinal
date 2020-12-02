<div class="col-md-10 container_padding_none">
  <div class="content_right">
    <div class="content_right_titel">
      <h1>Dashboard</h1>
      <span><i class="fa fa-calendar"></i> <?php echo date("d M Y");?></span></div>
    <div class="dashboard2_top_background">
      <div class="row">
        <div class="col-md-6">
          <h1>Search for Procedures</h1>
          <div class="dashboard2_search_for_procedures">
            <form id ="procedureSearch" method="GET" action="<?php echo base_url();?>/patient/search">
             
              <ul class="content_right_menu_top_ul">
                <li class="content_right_menu_select_category">
                  <div class="select-style">
                    <?php
						$extra = 'id ="procedureCat" required class="parsley-validated"';
						echo form_dropdown("procedure_cat", $prcCat, "", $extra); ?>
                  </div>
                </li>
                <li class="content_right_menu_select_category">
                  <div class="select-style">
                    <?php
						$default = 'select procedure name';
						$extra = 'id ="procedureName" required class="parsley-validated"';
						echo form_dropdown("procedure_name", '', $default, $extra); ?>
                  </div>
                </li>
                <li class="content_right_menu_input dashboard2_input_enter_search ">
                  <input type ="text" name ="location" placeholder="Location" />
                  <input type ="text" name ="zip" placeholder="Zipcode" />
                </li>
                <li class="content_right_menu_find_button">
                  <input type="submit" Value="Search"/>
                </li>
              </ul>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <h1>Today Appointments</h1>
          <div class="dashboard2_search_today_appointments">
            <div id="today_appt" class="owl-carousel">
              <?php
				 //print_r($patient_today_appt );die();
				   //foreach($patient_today_appt as $toda_appt){
				  $icnt=0;
				 // print_r($icnt);
				// echo count($patient_today_appt);
				//print_r($patient_today_appt);
				  while($icnt <= (count($patient_today_appt)-1)){
					if (array_key_exists($icnt,$patient_today_appt)){ 
					$toda_appt=$patient_today_appt[$icnt];
					$icnt++;?>
					
				 <div class="item">
                <ul>
                  <li class="dashboard2_search_today_appointments_menu1"><a href="javascript:void();"><?php echo $toda_appt->procedure_name; ?></a></li>
                  <li class="dashboard2_search_today_appointments_menu2"><a href="#"><img class="sp_thumb" src="<?php echo base_url();?>/<?php echo $toda_appt->specialistpic; ?>" /><?php echo $toda_appt->name; ?></a></li>
                  <li class="dashboard2_search_today_appointments_menu3"><a href="#"><i class="fa fa-clock-o"></i> <?php echo $toda_appt->booking_time;?></a></li>
                  
                  <!-- <li class="dashboard2_search_today_appointments_menu4"><a href="#">cancel</a></li> -->
                  
                </ul>	
					
					
					<?php } 
					if (array_key_exists($icnt,$patient_today_appt)){
					$toda_appt1=$patient_today_appt[$icnt];
					$icnt++;
					
			  ?>
             
                <ul>
                  <li class="dashboard2_search_today_appointments_menu1"><a href="javascript:void();"><?php echo $toda_appt1->procedure_name; ?></a></li>
                  <li class="dashboard2_search_today_appointments_menu2"><a href="#"><img class="sp_thumb" src="<?php echo base_url();?>/<?php echo $toda_appt1->specialistpic; ?>" /><?php echo $toda_appt1->name; ?></a></li>
                  <li class="dashboard2_search_today_appointments_menu3"><a href="#"><i class="fa fa-clock-o"></i> <?php echo $toda_appt1->booking_time;?></a></li>
                  
                  <!-- <li class="dashboard2_search_today_appointments_menu4"><a href="#">cancel</a></li> -->
                  
                </ul>
              </div>
              <?php } } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="dashboard2_center_background">
      <div class="dashboard2_center_background_padding">
        <div class="row">
          <?php
                  $latest_temp=0;
                  $last_temp=0;
                  $latest_heart=0;
                  $last_heart=0;
                  $latest_bp="000/00";
                  $last_bp="000/00";
                  $latest_water_level=00.00;
                  $last_water_level=00.00;
                  $latest_suger=00;
                  $last_suger=00;
                  $lastest_weight=0;
                  $last_weight=0;
                  $latest_body_fat=0;
                  $last_body_fat=0;
                  if(!empty($patient_checkups)){
                      $cnt=0;
                      foreach ($patient_checkups as $patient_checkup) {
                          if($cnt==0)
                          {
                            $latest_temp=$patient_checkup->temp;
                            $latest_heart=$patient_checkup->heartbit;
                            $latest_bp=$patient_checkup->BD;
                            $latest_water_level=$patient_checkup->water_level;
                            $latest_suger=$patient_checkup->BG;
                            $lastest_weight=$patient_checkup->weight;
                            $latest_body_fat=$patient_checkup->body_fat;
                            
                          }else {
                            $last_temp=$patient_checkup->temp;
                            $last_heart=$patient_checkup->heartbit;
                            $last_bp=$patient_checkup->BD;
                            $last_water_level=$patient_checkup->water_level;
                            $last_suger=$patient_checkup->BG;
                            $last_weight=$patient_checkup->weight;
                            $last_body_fat=$patient_checkup->body_fat;
                          }
                          $cnt++;
                      }
                  }
                  ?>
          <div class="col-md-4">
            <div class="dashboard2_center_box dashboard2_center_temperature">
              <h1 class="dashboard2_center_background_titel_box">Temperature</h1>
              <h2><?php echo $latest_temp;?><sup>O</sup></h2>
              <div class="dashboard2_center_background_maps"> <img src="<?php echo base_url();?>/assets/images/appointments_maps_img1.png" /><span>Normal</span> </div>
              <p>Last checkup<span> <?php echo $last_temp;?><sup>O</sup></span></p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="dashboard2_center_box dashboard2_center_heart_rate">
              <h1 class="dashboard2_center_background_titel_box">Heart Rate</h1>
              <div class="dashboard2_center_heart_rate1">
                <h2><?php echo $latest_heart;?><sub>bpm</sub> </h2>
                <img src="<?php echo base_url();?>/assets/images/appointments_maps_img2.png" /></div>
              <div class="dashboard2_center_heart_rate2"> <img src="<?php echo base_url();?>/assets/images/dashboard2_center_heart_rate_icon.png" />
                <div class="dashboard2_center_heart_rate3">
                  <p>Last checkup</p>
                  <h3><i class="fa fa-caret-down"></i> <?php echo $last_heart;?><sub>bpm</sub></h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="dashboard2_center_box dashboard2_center_blood_pressure">
              <h1 class="dashboard2_center_background_titel_box">Blood Pressure</h1>
              <h2><?php echo $latest_bp;?> </h2>
              <ul class="dashboard2_center_blood_pressure_table">
                <li>Low Blood<br>
                  Pressure</li>
                <li>
                  <p>Normal</p>
                </li>
                <li>High Blood <br>
                  Pressure</li>
              </ul>
              <img class="dashboard2_center_blood_pressure_maps_icon2" src="<?php echo base_url();?>/assets/images/appointments_maps_icon2.png" />
              <p class="dashboard2_center_blood_pressure_text">Last checkup <span><i class="fa fa-caret-down"></i> <?php echo $last_bp;?></span></p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="dashboard2_center_box dashboard2_center_temperature">
            <h1 class="dashboard2_center_background_titel_box">Water Levels</h1>
            <div class="dashboard2_center_water_levels">
              <h2><?php echo $latest_water_level;?><sub>%</sub></h2>
              <div class="dashboard2_center_water_levels_right"> <i style="color:#14DCFF;" class="fa fa-tint"></i> <i style="color:#14DCFF;" class="fa fa-tint"></i> <i style="color:#95A5A6;" class="fa fa-tint"></i> <i style="color:#95A5A6;" class="fa fa-tint"></i> <i style="color:#95A5A6;" class="fa fa-tint"></i> <i style="color:#95A5A6;" class="fa fa-tint"></i> <i style="color:#95A5A6;" class="fa fa-tint"></i> <i style="color:#95A5A6;" class="fa fa-tint"></i> <i style="color:#95A5A6;" class="fa fa-tint"></i> <i style="color:#95A5A6;" class="fa fa-tint"></i> <i style="color:#95A5A6;" class="fa fa-tint"></i> <i style="color:#95A5A6;" class="fa fa-tint"></i> </div>
            </div>
            <div class="dashboard2_center_background_maps"> <img src="<?php echo base_url();?>/assets/images/appointments_maps_img1.png" /><span>Normal</span> </div>
            <p>Last checkup<span><?php echo $last_water_level;?><sub>%</sub></span></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="dashboard2_center_box dashboard2_center_heart_rate">
            <h1 class="dashboard2_center_background_titel_box">Blood Sugar</h1>
            <div class="dashboard2_center_heart_rate1 dashboard2_center_blood_sugar"> <img src="<?php echo base_url();?>/assets/images/dashboard2_center_blood_sugar.png" />
              <h2><?php echo $latest_suger;?><sub>mg/dl</sub> </h2>
            </div>
            <ul class="dashboard2_center_blood_pressure_table">
              <li>Low Blood<br/>
                Sugar</li>
              <li>
                <p>Normal</p>
              </li>
              <li>High Blood<br/>
                Sugar</li>
            </ul>
            <img class="dashboard2_center_blood_pressure_maps_icon2" src="<?php echo base_url();?>/assets/images/appointments_maps_icon2.png" />
            <p class="dashboard2_center_blood_pressure_text">Last checkup <span><i class="fa fa-caret-down"></i> <?php echo $last_suger;?> mg/dl</span></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="dashboard2_center_box dashboard2_center_weight">
            <h1 class="dashboard2_center_background_titel_box">Weight <i class="fa fa-circle"></i></h1>
            <div class="dashboard2_center_weight_titel">
              <h2><?php echo $lastest_weight;?> </h2>
              <div class="dashboard2_center_weight_titel1"><span>Body Fat <i class="fa fa-circle"></i></span>
                <h3> <?php echo $latest_body_fat; ?><sub>%</sub> </h3>
              </div>
            </div>
            <img class="dashboard2_center_blood_pressure_maps_icon2" src="<?php echo base_url();?>/assets/images/dashboard2_center_weight.png" />
            <p class="dashboard2_center_blood_pressure_text">Last checkup <span><i class="fa fa-caret-up"></i> <?php echo $last_weight;?>/<?php echo $last_body_fat; ?></span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="dashboard2_bottom_background">
      <div class="row">
        <div class="col-md-3">
          <div class="dashboard2_bottom_box">
            <h1>Today Prescription</h1>
            <div class="dashboard2_bottom_prescription">
                <?php
                   
                    if(!empty($patient_today_prescription)){
                ?>
              <?php foreach($patient_today_prescription as $today_prescription){?>
              <div class="dashboard2_bottom_prescription1">
                <?php $day_time = $today_prescription->day_time_type;
							      if($day_time == 'morning'){
							 ?>
                <img src="<?php echo base_url();?>/assets/images/apointment_perscription_icon1.png" />
                <?php } else if($day_time == 'evening'){?>
                <img src="<?php echo base_url();?>/assets/images/apointment_perscription_icon2.png" />
                <?php }else if($day_time == 'night'){?>
                <img src="<?php echo base_url();?>/assets/images/apointment_perscription_icon3.png" />
                <?php }else if($day_time == 'afternoon'){?>
                <img src="<?php echo base_url();?>/assets/images/apointment_perscription_icon1.png" />
                <?php }?>
                <div class="dashboard2_bottom_prescription_box"> <span><?php echo ucfirst($today_prescription->day_time_type) ?> - <strong><?php echo $today_prescription->dose?></strong></span>
                  <p><?php echo $today_prescription->Details?></p>
                </div>
              </div>
              <?php }
                }
                ?>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="dashboard2_bottom_box">
            <h1>Pending Reviews</h1>
            <div class="dashboard2_bottom_pending_reviews">
              <?php foreach($patient_pending_reviews as $review){?>
              <ul class="dashboard2_bottom_pending_reviews1">
                <li class="dashboard2_bottom_pending_reviews_skin"><a href="javascript:void(0)"><?php echo ucfirst($review->procedure_name) ?></a></li>
                <li>
                  <p><?php echo date('d/m/Y', strtotime($review->booking_date)) ?><br/>
                    at <?php echo ($review->booking_time) ?></p>
                </li>
                <li class="dashboard2_bottom_pending_reviews_button"><a href="javascript:void(0)" class="reviewBtn" data-toggle="modal" data-target="#reviewmodal" key="<?php echo $review->ID ?>">review</a></li>
              </ul>
              <?php }?>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
          <div class="dashboard2_bottom_box">
            <h1>Quick Links</h1>
            <div class="dashboard2_bottom_quick_links"> <a href="#"> <img src="<?php echo base_url();?>/assets/images/dashboard2_bottom_quick_links_icon1.png"/> <span>Disease Guide</span> <i class="fa fa-angle-right"></i> </a><a href="#"> <img src="<?php echo base_url();?>/assets/images/dashboard2_bottom_quick_links_icon2.png"/> <span>Symptiom Checklist</span> <i class="fa fa-angle-right"></i> </a><a href="#"> <img src="<?php echo base_url();?>/assets/images/dashboard2_bottom_quick_links_icon1.png"/> <span>Drug Guide</span> <i class="fa fa-angle-right"></i> </a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal -->
<div id="reviewmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">HCare Patient Review</h4>
      </div>
      <div class="modal-body">
  <div class="col-md-4" style="margin-bottom:10px;">
    <input placeholder="Put your rating" name="rating" typ="text" class="form-control"></div>
  <div class="col-md-12"><textarea  rows="4" class="form-control" name="reviews" id="comment" placeholder="Put your comment"></textarea></div>
  <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="reviewSubmit" data-dismiss="modal">Submit</button>
        <input type="hidden" name="bookingid" id="bookingId" />
      </div>
    </div>

  </div>
</div>
