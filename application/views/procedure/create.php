<style type="text/css">
  .create_procedure_tabs2_reviews .fa {
      font-size: 18px!important;
      padding: 8px 5px 0 0!important;
  }
  .staff_text {
      padding: 0 0 30px!important;
  }
  #bulk-delete{
    border: 1px solid #0D92A7!important;
      background: #fff!important;
      padding: 4px 12px 5px 12px!important;
      font-size: 14px!important;
      color: #0D92A7!important;     
      /*margin: 0 0 0 15px!important;*/
      border-radius: 5px!important;
      text-transform: uppercase;
      font-weight: 100!important;
  }
  .staff_top_titel_button button .fa {
      padding: 0 0 0 5px;
      position: relative;
      top: 1px;
  }
</style>
<div class="col-md-10 container_padding_none">

  <div class="content_right_dashboard">

    <div class="create_procedure_width">

      

      <?php



            if($success !="" && $class){



                echo '<div class="alert alert-success  '.$class.' ">'.$success.'</div>';



            }



            if($error !="" && $fail){



                echo '<div class="alert alert-error  '.$fail.' ">'.$error.'</div>';



            }



            ?>

      <div id="tabs">

        <ul>

          <li><a href="#tabs-2">All Procedure</a></li>

          <li><a href="#tabs-1">Create Procedure</a></li>

        </ul>

        <div id="tabs-1">

          <form id='procedureCreate' method='POST' action=''  data-toggle = 'validator'>

            <div class="select_procedure_slider_background"> <span class="select_procedure_slider_titel">Select Procedure Category</span>

              <div class="select_procedure_slider">

                <div class="owl-select_procedure_slider">

                  <?php

                    if(isset($icon)){

                    foreach($icon as $pics){?>
<div class="item"> <a href ="#" class ="icons-selected"><img src='<?php echo base_url().$pics['icon']?>' title="<?php echo $pics['category_name']?>" /></a>

                            <input type ="hidden" name ="cat-name" value ="<?php echo $pics['category_name']?>" class ="cat-name-selection" />

                            <input type ="hidden" name ="cat-id" value ="<?php echo $pics['ID']?>" class ="cat-id" />

                          </div>

                  <?php
                            }

                        }

                ?>

                </div>

              </div>

              <div class="createprocedure_step1">

                <div class="createprocedure_step1_box_text">

                  <h1><span>

                    <div class ="select-cat"></div>

                    </span></h1>

                  <div class="select_procedure_name_width">

                    <div class="createprocedure_step1_select_staff select-style">

                      <div class ="procedure-name"></div>

                    </div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">

                      <h4>Procedure Description</h4>

                      <textarea name ="description" class ="prc-desc" ></textarea>

                    </div>

                    <div class="col-md-4">

                      <label for ="slots">Appointment Per Slot</label>

                      <br>

                      <div class="createprocedure_step1_procedure_description"> <img src="<?php echo base_url();?>assets/images/appointment_per_slot_icon.png" />

                        <div class="createprocedure_step1_quantity">

                          <div class="sp-quantity">

                            <div class="sp-minus fff"><a class="counterNs" href="#" data-multi="-1">-</a></div>

                            <div class="sp-input">

                              <input type="text" class="quntity-input" required name ="appt_per_slots" value="1" />

                            </div>

                            <div class="sp-plus fff"><a class="counterNs" href="#" data-multi="1">+</a></div>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

                <div class="createprocedure_step1_box_amount">
                  <div class="amount_warning"></div>

                  <h1>From Amount</h1>

                  <input placeholder="$00.00"  name ="from_amount" required="" class ="sp-amt"/>

                  <div class="help-block with-errors"></div>

                </div>

                <div class="createprocedure_step1_box_amount">

                  <h1>To Amount</h1>

                  <input placeholder="$00.00"  name ="to_amount"  required="" class ="to-amt"/>

                  <div class="help-block with-errors"></div>

                </div>

                <div class="createprocedure_step1_box_staff">

                  <div class="row">

                    <div class="col-md-2"> </div>

                    <div class="col-md-8">

                      <div class="createprocedure_step1_titel_staff"> <span>Staff</span>
                        <div class="alert">

                  <div class ="showMessage"></div>

                </div>
                        <div class="createprocedure_step1_shape_staff">

                          <div class="row">

                            <div class="col-md-5">

                              <div class="createprocedure_step1_select_staff select-style">

                                <div class="form-group">

                                  <?php

                                        $extra = 'id ="staffcat1" class = staffcatSelection';
                                        echo form_dropdown("staff_cat_id_type[]", $staffCat, "", $extra); ?>

                                </div>

                              </div>

                            </div>

                            <div class="col-md-5">

                              <div class="createprocedure_step1_select_staff select-style">

                                <div class="form-group">

                                  <?php

                                        $extra = 'id ="staff1" class="staffcatName staffonChange"';

                                        echo form_dropdown("staff_name_type[]", 'Select Staff' , "", $extra); ?>

                                </div>

                              </div>

                            </div>

                            <div class="col-md-2"> <a class="createprocedure_step1_plus_staff" id="moreStaffListing" href="#" > <i class="fa fa-plus"></i> </a> </div>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

                <div class="row">

                  <div class="col-md-2"> </div>

                  <div class="col-md-8">

                    <div id="addedMoreCatgeory"> </div>

                  </div>

                  <div class ="rmv"></div>

                </div>

                <div class="createprocedure_step1_slider">

                  <div id="owl-createprocedure_step1_slider" class="owl-createprocedure_step1_slider owl-carousel"> </div>

                  

                  <!--                <div class="customNavigation">--> 

                  

                  <!--                    <a class="prev prevarrow">Previous</a>--> 

                  

                  <!--                    <a class="next nextarrow" style ="float:right">Next</a>--> 

                  

                  <!--                </div>--> 

                  

                </div>

                <div class="createprocedure_step1_next_button">

                  <button type ="button" id="createprocedure_step1_next" class ="nextClick btn btn-primary">Next</button>

                </div>

              </div>

            </div>

            <div class="createprocedure_step2_background">

              <div class="col-md-3 container_padding_none">

                <div class="createprocedure_step2_left_content"> <a href="#" class="createprocedure_step2_left_procedure_go_back">Go Back</a>

                  <div class="createprocedure_step2_left_procedure">

                    <h1>Procedure Category</h1>

                    <a class="createprocedure_step2_left_eye" href="#"><i class="fa fa-eye"></i> <span class ="prtSelectedCat"></span></a>

                    <h1>Procedure Name</h1>

                    <a class="createprocedure_step2_left_xyz" href="#"><span class ="prtSelectedName"></span></a>

                    <h1>Description</h1>

                    <p class ="prcDesc"></p>

                    <h1>Appointment Per Slot</h1>

                    <a class="createprocedure_step2_left_calendar total-slots" href="#"></a>

                    <input type ="hidden" name ="MPID" class ="mpid"/>

                    <input type ="hidden" name ="procedure_name_selected" class ="pnamesS" />

                    <h1>Staff</h1>

                    <div class="createprocedure_step2_left_staff staff-block"> </div>

                    <h1>Amount</h1>
                    <p class ="paid-amts">From: <span class ="paid-amt" id ="from-amts-sp"></span></p>
                    <p class ="from-amts">To: <span class ="to-amt-sp"></span></p>

                  </div>

                </div>

              </div>

              <div class="col-md-9 container_padding_none">

                <div id="createprocedure_step2_calendar">

                  <div class="createprocedure_calendar_top"> <a href="#">import from Work hrs</a> </div>

                  <div class="createprocedure_calendar">

                    <table cellpadding="0" cellspacing="0">

                      <tbody>

                        <tr>

                          <th>mon</th>

                          <th>tue</th>

                          <th>wed</th>

                          <th>thur</th>

                          <th>fri</th>

                          <th>sat</th>

                          <th>sun</th>

                        </tr>

                        <tr>

                          <td><a class="createprocedure_calendar_click_button" href="#" id="createprocedure_calendar_click_content_mon"><img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png"> </a>

                            <div class="createprocedure_calendar_popup" id="createprocedure_calendar_popup_content_mon">

                              <div class="createprocedure_calendar_popup_caret_up"><i class="fa fa-caret-up"></i></div>

                              <div class="createprocedure_step1_select_staff select-style">

                                <select name="mon_hrs[]" id ="mon_hrs" required class="appmfrom selectpicker">

                                  <option value="" selected="selected">select time from</option>

                                  <option value="00:00">00:00</option>

                                  <option value="01:00">01:00</option>

                                  <option value="02:00">02:00</option>

                                  <option value="03:00">03:00</option>

                                  <option value="04:00">04:00</option>

                                  <option value="05:00">05:00</option>

                                  <option value="06:00">06:00</option>

                                  <option value="07:00">07:00</option>

                                  <option value="08:00">08:00</option>

                                  <option value="09:00">09:00</option>

                                  <option value="10:00">10:00</option>

                                  <option value="11:00">11:00</option>

                                  <option value="12:00">12:00</option>

                                  <option value="13:00">13:00</option>

                                  <option value="14:00">14:00</option>

                                  <option value="15:00">15:00</option>

                                  <option value="16:00">16:00</option>

                                  <option value="17:00">17:00</option>

                                  <option value="18:00">18:00</option>

                                  <option value="19:00">19:00</option>

                                  <option value="20:00">20:00</option>

                                  <option value="21:00">21:00</option>

                                  <option value="22:00">22:00</option>

                                  <option value="23:00">23:00</option>

                                </select>

                              </div>

                              <div class="createprocedure_step1_select_staff select-style">

                                <select name="mon_hrs_to[]" id ="mon_hrs" required class="appnto selectpicker">

                                  <option value="" selected="selected">select time to</option>

                                  <option value="00:00">00:00</option>

                                  <option value="01:00">01:00</option>

                                  <option value="02:00">02:00</option>

                                  <option value="03:00">03:00</option>

                                  <option value="04:00">04:00</option>

                                  <option value="05:00">05:00</option>

                                  <option value="06:00">06:00</option>

                                  <option value="07:00">07:00</option>

                                  <option value="08:00">08:00</option>

                                  <option value="09:00">09:00</option>

                                  <option value="10:00">10:00</option>

                                  <option value="11:00">11:00</option>

                                  <option value="12:00">12:00</option>

                                  <option value="13:00">13:00</option>

                                  <option value="14:00">14:00</option>

                                  <option value="15:00">15:00</option>

                                  <option value="16:00">16:00</option>

                                  <option value="17:00">17:00</option>

                                  <option value="18:00">18:00</option>

                                  <option value="19:00">19:00</option>

                                  <option value="20:00">20:00</option>

                                  <option value="21:00">21:00</option>

                                  <option value="22:00">22:00</option>

                                  <option value="23:00">23:00</option>

                                </select>

                              </div>

                              <a href="#" class="createprocedure_calendar_popup_button" id="mon_add_slot">add</a> </div></td>

                          <td><a class="createprocedure_calendar_click_button" href="#" id="createprocedure_calendar_click_content_tues" ><img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png"></a>

                            <div class="createprocedure_calendar_popup" id="createprocedure_calendar_popup_content_tues">

                              <div class="createprocedure_calendar_popup_caret_up"><i class="fa fa-caret-up"></i></div>

                              <div class="createprocedure_step1_select_staff select-style">

                                <select name="tues_hrs[]" id ="tues_hrs" required class="apptuesfrom">

                                  <option value="" selected="selected">select time from</option>

                                  <option value="00:00">00:00</option>

                                  <option value="01:00">01:00</option>

                                  <option value="02:00">02:00</option>

                                  <option value="03:00">03:00</option>

                                  <option value="04:00">04:00</option>

                                  <option value="05:00">05:00</option>

                                  <option value="06:00">06:00</option>

                                  <option value="07:00">07:00</option>

                                  <option value="08:00">08:00</option>

                                  <option value="09:00">09:00</option>

                                  <option value="10:00">10:00</option>

                                  <option value="11:00">11:00</option>

                                  <option value="12:00">12:00</option>

                                  <option value="13:00">13:00</option>

                                  <option value="14:00">14:00</option>

                                  <option value="15:00">15:00</option>

                                  <option value="16:00">16:00</option>

                                  <option value="17:00">17:00</option>

                                  <option value="18:00">18:00</option>

                                  <option value="19:00">19:00</option>

                                  <option value="20:00">20:00</option>

                                  <option value="21:00">21:00</option>

                                  <option value="22:00">22:00</option>

                                  <option value="23:00">23:00</option>

                                </select>

                              </div>

                              <div class="createprocedure_step1_select_staff select-style">

                                <select name="tues_hrs_to[]" id ="tues_hrs" required class="apptuesto">

                                  <option value="" selected="selected">select time to</option>

                                  <option value="00:00">00:00</option>

                                  <option value="01:00">01:00</option>

                                  <option value="02:00">02:00</option>

                                  <option value="03:00">03:00</option>

                                  <option value="04:00">04:00</option>

                                  <option value="05:00">05:00</option>

                                  <option value="06:00">06:00</option>

                                  <option value="07:00">07:00</option>

                                  <option value="08:00">08:00</option>

                                  <option value="09:00">09:00</option>

                                  <option value="10:00">10:00</option>

                                  <option value="11:00">11:00</option>

                                  <option value="12:00">12:00</option>

                                  <option value="13:00">13:00</option>

                                  <option value="14:00">14:00</option>

                                  <option value="15:00">15:00</option>

                                  <option value="16:00">16:00</option>

                                  <option value="17:00">17:00</option>

                                  <option value="18:00">18:00</option>

                                  <option value="19:00">19:00</option>

                                  <option value="20:00">20:00</option>

                                  <option value="21:00">21:00</option>

                                  <option value="22:00">22:00</option>

                                  <option value="23:00">23:00</option>

                                </select>

                              </div>

                              <a href="#" class="createprocedure_calendar_popup_button" id="tues_add_slot">add</a> </div></td>

                          <td><a class="createprocedure_calendar_click_button"  id="createprocedure_calendar_click_content_wed" href="#"> <img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png"> </a>

                            <div class="createprocedure_calendar_popup" id="createprocedure_calendar_popup_content_wed">

                              <div class="createprocedure_calendar_popup_caret_up"><i class="fa fa-caret-up"></i></div>

                              <div class="createprocedure_step1_select_staff select-style">

                                <select name="wed_hrs[]" id ="wed_hrs" class="apptwedfrom">

                                  <option value="" selected="selected">select time from</option>

                                  <option value="00:00">00:00</option>

                                  <option value="01:00">01:00</option>

                                  <option value="02:00">02:00</option>

                                  <option value="03:00">03:00</option>

                                  <option value="04:00">04:00</option>

                                  <option value="05:00">05:00</option>

                                  <option value="06:00">06:00</option>

                                  <option value="07:00">07:00</option>

                                  <option value="08:00">08:00</option>

                                  <option value="09:00">09:00</option>

                                  <option value="10:00">10:00</option>

                                  <option value="11:00">11:00</option>

                                  <option value="12:00">12:00</option>

                                  <option value="13:00">13:00</option>

                                  <option value="14:00">14:00</option>

                                  <option value="15:00">15:00</option>

                                  <option value="16:00">16:00</option>

                                  <option value="17:00">17:00</option>

                                  <option value="18:00">18:00</option>

                                  <option value="19:00">19:00</option>

                                  <option value="20:00">20:00</option>

                                  <option value="21:00">21:00</option>

                                  <option value="22:00">22:00</option>

                                  <option value="23:00">23:00</option>

                                </select>

                              </div>

                              <div class="createprocedure_step1_select_staff select-style">

                                <select name="wed_hrs_to[]" id ="wed_hrs" class="appwedto">

                                  <option value="" selected="selected">select time to</option>

                                  <option value="00:00">00:00</option>

                                  <option value="01:00">01:00</option>

                                  <option value="02:00">02:00</option>

                                  <option value="03:00">03:00</option>

                                  <option value="04:00">04:00</option>

                                  <option value="05:00">05:00</option>

                                  <option value="06:00">06:00</option>

                                  <option value="07:00">07:00</option>

                                  <option value="08:00">08:00</option>

                                  <option value="09:00">09:00</option>

                                  <option value="10:00">10:00</option>

                                  <option value="11:00">11:00</option>

                                  <option value="12:00">12:00</option>

                                  <option value="13:00">13:00</option>

                                  <option value="14:00">14:00</option>

                                  <option value="15:00">15:00</option>

                                  <option value="16:00">16:00</option>

                                  <option value="17:00">17:00</option>

                                  <option value="18:00">18:00</option>

                                  <option value="19:00">19:00</option>

                                  <option value="20:00">20:00</option>

                                  <option value="21:00">21:00</option>

                                  <option value="22:00">22:00</option>

                                  <option value="23:00">23:00</option>

                                </select>

                              </div>

                              <a href="#" class="createprocedure_calendar_popup_button" id="wed_add_slot">add</a> </div></td>

                          <td><a class="createprocedure_calendar_click_button" id="createprocedure_calendar_click_content_thur" href="#"> <img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png"> </a>

                            <div class="createprocedure_calendar_popup" id="createprocedure_calendar_popup_content_thur">

                              <div class="createprocedure_calendar_popup_caret_up"><i class="fa fa-caret-up"></i></div>

                              <div class="createprocedure_step1_select_staff select-style">

                                <select name="thues_hrs[]" id ="thus_hrs" class="apptthusfrom">

                                  <option value="" selected="selected">select time from</option>

                                  <option value="00:00">00:00</option>

                                  <option value="01:00">01:00</option>

                                  <option value="02:00">02:00</option>

                                  <option value="03:00">03:00</option>

                                  <option value="04:00">04:00</option>

                                  <option value="05:00">05:00</option>

                                  <option value="06:00">06:00</option>

                                  <option value="07:00">07:00</option>

                                  <option value="08:00">08:00</option>

                                  <option value="09:00">09:00</option>

                                  <option value="10:00">10:00</option>

                                  <option value="11:00">11:00</option>

                                  <option value="12:00">12:00</option>

                                  <option value="13:00">13:00</option>

                                  <option value="14:00">14:00</option>

                                  <option value="15:00">15:00</option>

                                  <option value="16:00">16:00</option>

                                  <option value="17:00">17:00</option>

                                  <option value="18:00">18:00</option>

                                  <option value="19:00">19:00</option>

                                  <option value="20:00">20:00</option>

                                  <option value="21:00">21:00</option>

                                  <option value="22:00">22:00</option>

                                  <option value="23:00">23:00</option>

                                </select>

                              </div>

                              <div class="createprocedure_step1_select_staff select-style">

                                <select name="thues_hrs_to[]" id ="thus_hrs" class="appthusto">

                                  <option value="" selected="selected">select time to</option>

                                  <option value="00:00">00:00</option>

                                  <option value="01:00">01:00</option>

                                  <option value="02:00">02:00</option>

                                  <option value="03:00">03:00</option>

                                  <option value="04:00">04:00</option>

                                  <option value="05:00">05:00</option>

                                  <option value="06:00">06:00</option>

                                  <option value="07:00">07:00</option>

                                  <option value="08:00">08:00</option>

                                  <option value="09:00">09:00</option>

                                  <option value="10:00">10:00</option>

                                  <option value="11:00">11:00</option>

                                  <option value="12:00">12:00</option>

                                  <option value="13:00">13:00</option>

                                  <option value="14:00">14:00</option>

                                  <option value="15:00">15:00</option>

                                  <option value="16:00">16:00</option>

                                  <option value="17:00">17:00</option>

                                  <option value="18:00">18:00</option>

                                  <option value="19:00">19:00</option>

                                  <option value="20:00">20:00</option>

                                  <option value="21:00">21:00</option>

                                  <option value="22:00">22:00</option>

                                  <option value="23:00">23:00</option>

                                </select>

                              </div>

                              <a href="#" class="createprocedure_calendar_popup_button" id="thus_add_slot" >add</a> </div></td>

                          <td><a class="createprocedure_calendar_click_button" href="#" id="createprocedure_calendar_click_content_fri"><img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png"></a>

                            <div class="createprocedure_calendar_popup" id="createprocedure_calendar_popup_content_fri">

                              <div class="createprocedure_calendar_popup_caret_up"><i class="fa fa-caret-up"></i></div>

                              <div class="createprocedure_step1_select_staff select-style">

                                <select name="fri_hrs[]" id ="fri_hrs" class="apptfrifrom">

                                  <option value="" selected="selected">select time from</option>

                                  <option value="00:00">00:00</option>

                                  <option value="01:00">01:00</option>

                                  <option value="02:00">02:00</option>

                                  <option value="03:00">03:00</option>

                                  <option value="04:00">04:00</option>

                                  <option value="05:00">05:00</option>

                                  <option value="06:00">06:00</option>

                                  <option value="07:00">07:00</option>

                                  <option value="08:00">08:00</option>

                                  <option value="09:00">09:00</option>

                                  <option value="10:00">10:00</option>

                                  <option value="11:00">11:00</option>

                                  <option value="12:00">12:00</option>

                                  <option value="13:00">13:00</option>

                                  <option value="14:00">14:00</option>

                                  <option value="15:00">15:00</option>

                                  <option value="16:00">16:00</option>

                                  <option value="17:00">17:00</option>

                                  <option value="18:00">18:00</option>

                                  <option value="19:00">19:00</option>

                                  <option value="20:00">20:00</option>

                                  <option value="21:00">21:00</option>

                                  <option value="22:00">22:00</option>

                                  <option value="23:00">23:00</option>

                                </select>

                              </div>

                              <div class="createprocedure_step1_select_staff select-style">

                                <select name="fri_hrs_to[]" id ="fri_hrs" class="apptfrito">

                                  <option value="" selected="selected">select time to</option>

                                  <option value="00:00">00:00</option>

                                  <option value="01:00">01:00</option>

                                  <option value="02:00">02:00</option>

                                  <option value="03:00">03:00</option>

                                  <option value="04:00">04:00</option>

                                  <option value="05:00">05:00</option>

                                  <option value="06:00">06:00</option>

                                  <option value="07:00">07:00</option>

                                  <option value="08:00">08:00</option>

                                  <option value="09:00">09:00</option>

                                  <option value="10:00">10:00</option>

                                  <option value="11:00">11:00</option>

                                  <option value="12:00">12:00</option>

                                  <option value="13:00">13:00</option>

                                  <option value="14:00">14:00</option>

                                  <option value="15:00">15:00</option>

                                  <option value="16:00">16:00</option>

                                  <option value="17:00">17:00</option>

                                  <option value="18:00">18:00</option>

                                  <option value="19:00">19:00</option>

                                  <option value="20:00">20:00</option>

                                  <option value="21:00">21:00</option>

                                  <option value="22:00">22:00</option>

                                  <option value="23:00">23:00</option>

                                </select>

                              </div>

                              <a href="#" class="createprocedure_calendar_popup_button" id="fri_add_slot" >add</a> </div></td>

                          <td><a class="createprocedure_calendar_click_button" id="createprocedure_calendar_click_content_sat" href="#"> <img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png"></a>

                            <div class="createprocedure_calendar_popup" id="createprocedure_calendar_popup_content_sat">

                              <div class="createprocedure_calendar_popup_caret_up"><i class="fa fa-caret-up"></i></div>

                              <div class="createprocedure_step1_select_staff select-style">

                                <select name="sat_hrs[]" id ="sat_hrs" class="apptsatfrom">

                                  <option value="" selected="selected">select time from</option>

                                  <option value="00:00">00:00</option>

                                  <option value="01:00">01:00</option>

                                  <option value="02:00">02:00</option>

                                  <option value="03:00">03:00</option>

                                  <option value="04:00">04:00</option>

                                  <option value="05:00">05:00</option>

                                  <option value="06:00">06:00</option>

                                  <option value="07:00">07:00</option>

                                  <option value="08:00">08:00</option>

                                  <option value="09:00">09:00</option>

                                  <option value="10:00">10:00</option>

                                  <option value="11:00">11:00</option>

                                  <option value="12:00">12:00</option>

                                  <option value="13:00">13:00</option>

                                  <option value="14:00">14:00</option>

                                  <option value="15:00">15:00</option>

                                  <option value="16:00">16:00</option>

                                  <option value="17:00">17:00</option>

                                  <option value="18:00">18:00</option>

                                  <option value="19:00">19:00</option>

                                  <option value="20:00">20:00</option>

                                  <option value="21:00">21:00</option>

                                  <option value="22:00">22:00</option>

                                  <option value="23:00">23:00</option>

                                </select>

                              </div>

                              <div class="createprocedure_step1_select_staff select-style">

                                <select name="sat_hrs_to[]" id ="sat_hrs" class="apptsatto">

                                  <option value="" selected="selected">select time to</option>

                                  <option value="00:00">00:00</option>

                                  <option value="01:00">01:00</option>

                                  <option value="02:00">02:00</option>

                                  <option value="03:00">03:00</option>

                                  <option value="04:00">04:00</option>

                                  <option value="05:00">05:00</option>

                                  <option value="06:00">06:00</option>

                                  <option value="07:00">07:00</option>

                                  <option value="08:00">08:00</option>

                                  <option value="09:00">09:00</option>

                                  <option value="10:00">10:00</option>

                                  <option value="11:00">11:00</option>

                                  <option value="12:00">12:00</option>

                                  <option value="13:00">13:00</option>

                                  <option value="14:00">14:00</option>

                                  <option value="15:00">15:00</option>

                                  <option value="16:00">16:00</option>

                                  <option value="17:00">17:00</option>

                                  <option value="18:00">18:00</option>

                                  <option value="19:00">19:00</option>

                                  <option value="20:00">20:00</option>

                                  <option value="21:00">21:00</option>

                                  <option value="22:00">22:00</option>

                                  <option value="23:00">23:00</option>

                                </select>

                              </div>

                              <a href="#" class="createprocedure_calendar_popup_button" id="sat_add_slot">add</a> </div></td>

                          <td><a class="createprocedure_calendar_click_button" href="#" id="createprocedure_calendar_click_content_sun"><img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png"></a>

                            <div class="createprocedure_calendar_popup" id="createprocedure_calendar_popup_content_sun">

                              <div class="createprocedure_calendar_popup_caret_up"><i class="fa fa-caret-up"></i></div>

                              <div class="createprocedure_step1_select_staff select-style">

                                <select name="sun_hrs[]" id ="sun_hrs" class="apptsunfrom">

                                  <option value="" selected="selected">select time from</option>

                                  <option value="00:00">00:00</option>

                                  <option value="01:00">01:00</option>

                                  <option value="02:00">02:00</option>

                                  <option value="03:00">03:00</option>

                                  <option value="04:00">04:00</option>

                                  <option value="05:00">05:00</option>

                                  <option value="06:00">06:00</option>

                                  <option value="07:00">07:00</option>

                                  <option value="08:00">08:00</option>

                                  <option value="09:00">09:00</option>

                                  <option value="10:00">10:00</option>

                                  <option value="11:00">11:00</option>

                                  <option value="12:00">12:00</option>

                                  <option value="13:00">13:00</option>

                                  <option value="14:00">14:00</option>

                                  <option value="15:00">15:00</option>

                                  <option value="16:00">16:00</option>

                                  <option value="17:00">17:00</option>

                                  <option value="18:00">18:00</option>

                                  <option value="19:00">19:00</option>

                                  <option value="20:00">20:00</option>

                                  <option value="21:00">21:00</option>

                                  <option value="22:00">22:00</option>

                                  <option value="23:00">23:00</option>

                                </select>

                              </div>

                              <div class="createprocedure_step1_select_staff select-style">

                                <select name="sun_hrs_to[]" id ="sun_hrs" class="appsunto">

                                  <option value="" selected="selected">select time to</option>

                                  <option value="00:00">00:00</option>

                                  <option value="01:00">01:00</option>

                                  <option value="02:00">02:00</option>

                                  <option value="03:00">03:00</option>

                                  <option value="04:00">04:00</option>

                                  <option value="05:00">05:00</option>

                                  <option value="06:00">06:00</option>

                                  <option value="07:00">07:00</option>

                                  <option value="08:00">08:00</option>

                                  <option value="09:00">09:00</option>

                                  <option value="10:00">10:00</option>

                                  <option value="11:00">11:00</option>

                                  <option value="12:00">12:00</option>

                                  <option value="13:00">13:00</option>

                                  <option value="14:00">14:00</option>

                                  <option value="15:00">15:00</option>

                                  <option value="16:00">16:00</option>

                                  <option value="17:00">17:00</option>

                                  <option value="18:00">18:00</option>

                                  <option value="19:00">19:00</option>

                                  <option value="20:00">20:00</option>

                                  <option value="21:00">21:00</option>

                                  <option value="22:00">22:00</option>

                                  <option value="23:00">23:00</option>

                                </select>

                              </div>

                              <a href="#" class="createprocedure_calendar_popup_button" id="sun_add_slot">add</a> </div></td>

                        </tr>

                        <tr>

                          <td id="mon_solts"></td>

                          <td id="tues_solts"></td>

                          <td id="wed_solts"></td>

                          <td id="thus_solts"></td>

                          <td id="fri_solts"></td>

                          <td id="sat_solts"></td>

                          <td id="sun_solts"></td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

              <div class="createprocedure_step1_next_button">

                <button  type="submit" name ="Submit" class ="btn btn-primary">Save</button>

              </div>

            </div>

          </form>

        </div>

        <div id="tabs-2">

          <div class="content_right1_patients content_create_procedure_tabs2">

            <div class="staff_top_titel">

              <h1>Showing <?php echo count($procedureDetails) ?> out of Total <?php echo count($total_procedure) ?></h1>

              <div class="staff_top_titel_button titel_button_create_procedure_tabs2"> 
                <label>Select All</label>
                <input type="checkbox" name="select_all" class="select_unselect" style="margin-top: 0px;">
                <button class="btn btn-default" id="bulk-delete">Delete<i class="fa fa-minus"></i></button>
                <a href="#" class ="addMoreProcedure" style="float: right;">add <i class="fa fa-plus"></i></a> </div>
            </div>

          </div>

          <div class="content_create_procedure_tabs2_right">
            <?php if(isset($procedureDetails)){ $count = 0; $row_count =0; $element =0;
              $total_rows = count($procedureDetails)/3;              
              if($total_rows > (int)$total_rows){
                $total_rows =(int)$total_rows + 1;
              }
              //echo $total_rows;
              foreach($procedureDetails as $procedure){ $element++;?>
                <?php if($count == 0){ $row_count ++;?>
                  <div class="row">
                <?php }?>
                  <div class="col-md-3">
                    <div class="content_create_procedure_tabs2_box">
                      <div class="content_create_procedure_tabs2_titel"><!--  <i class="fa fa-square"></i> -->
                        <input type="checkbox" name="procedure_<?php echo $procedure->procedureid ?>" id="<?php echo $procedure->procedureid ?>" class="fa procedure_check_list checkbox_class">
                        <h1>Procedure Category</h1>
                        <h2> <?php echo $procedure->category_name ?></h2>
                        <p>Procedure Name</p>
                        <span><?php echo $procedure->procedure_name ?></span> 
                      </div>
                      <div class="content_create_procedure_tabs2_icon">
                        <div class="content_create_procedure_tabs2_iconleft">
                          <p>Total Appointments</p>
                          <h2><i class="fa fa-calendar"></i>
                            <?php if(!empty($bookingStatus[$procedure->procedureid]['oStatus'])) {echo $bookingStatus[$procedure->procedureid]['oStatus'] ;}else {echo "0"; } ?>
                          </h2>
                        </div>
                        <div class="content_create_procedure_tabs2_iconright">
                          <p>Cancelled Appointments</p>
                          <h2 style="color:#F85F5F;"><i class="fa fa-calendar"></i>
                            <?php if(!empty($bookingStatus[$procedure->procedureid]['cStatus'])) { echo $bookingStatus[$procedure->procedureid]['cStatus']; }
                              else {echo "0"; }?>
                          </h2>
                        </div>
                      </div>
                      <div class="content_create_procedure_tabs2_icon">
                        <div class="content_create_procedure_tabs2_iconleft">
                          <p>Staff</p>
                          <h2><i class="fa fa-group"></i> <?php echo $procedure->staff ?></h2>
                        </div>
                        <div class="content_create_procedure_tabs2_iconright">
                          <p>Reviews</p>
                          <a href="javascript:void(0)" class="create_procedure_tabs2_reviews" id="create_procedure_tabs2_reviews"><i class="fa fa-star"></i> <?php echo $procedure->reviews ?></a>                      
                        </div>
                      </div>
                      <div class="content_create_procedure_tabs2_amount">
                        <p>Amount</p>
                        <span><?php echo " $".$procedure->from_price." - $".$procedure->to_price; ?></span> 
                      </div>
                      <div class="content_create_procedure_tabs2_icon content_create_procedure_tabs2_bottom">
                        <div class="content_create_procedure_tabs2_iconleft">
                          <h2><a href="<?php echo base_url()?>specialist/editprocedure/<?php echo $procedure->procedureid ?>"><i class="fa fa-pencil"></i></a></h2>
                        </div>
                        <div class="content_create_procedure_tabs2_iconright">
                          <h2><a href="javascript:void(0)" class="deleteprocedure" pkey="<?php echo $procedure->procedureid ?>" style="color:#F85F5F !important;"><i class="fa fa-trash-o"></i></a></h2>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-1"></div>
                  <?php $count++;?>
                <?php if($count == 3 && $element != count($procedureDetails)){
                  $count = 0;?>
                  </div>
                <?php } 
                /*echo $row_count."==".$total_rows."<br>";
                echo $count."!= 3<br>";
                echo $element."==".count($procedureDetails)."<br>";*/
                ?>
                <?php if($row_count==$total_rows && $count != 3 && $element == count($procedureDetails)){ ?>
                  </div>
                <?php } ?>
              <?php } 
              echo "<div class='pagination'>". $link.'</div>';

            }else { ?>
              <h2 class="msg">No Records Found !</h2>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>



    .left_sidebar_border{height: 800px !important;}

    .csize{
        width:55px;   
    }

</style>

<SCRIPT TYPE="text/javascript">
  $(".select_unselect").change(function(){  
    var status = this.checked; 
    $('.checkbox_class').each(function(){ 
        this.checked = status; 
    });
  });
  $('.checkbox_class').change(function(){ 
    if(this.checked == false){ 
        $(".select_unselect")[0].checked = false; 
    } 
    if ($('.checkbox_class:checked').length == $('.checkbox_class').length ){ 
        $(".select_unselect")[0].checked = true; 
    }
  });


$(document).ready(function(){
  $('#bulk-delete').click(function(){
    var procedure_ids = [];
    $(".checkbox_class:checked").each(function() {
        procedure_ids.push(this.id);
    });

    if(procedure_ids.length <1){
      bootbox.alert("Please Select atleast one Procedure");
      return false;
    }

    $.ajax({
      url: get_base_url()+'specialist/bulk_delete_procedure',
      data: {'procedureid' : procedure_ids},
      type: "POST",
      catche : false,
      dataType : "json",
      success : function(response){
        if(response.success == 1){
          bootbox.alert(response.message, function() {
              window.location.reload(); 
          });
        }else if(response.error == 1){
          bootbox.alert(response.message, function() {
            window.location.reload(); 
          });
        }
      }
    });
  });


  $('.owl-item img').click(function(){ 

    $('.owl-item img').removeClass("active");

    $(this).addClass("active");

});

  $(function () {
        $('[data-tap="tooltip"]').tooltip()
  })
});



</SCRIPT>