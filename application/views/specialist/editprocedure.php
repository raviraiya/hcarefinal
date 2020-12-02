<style type="text/css">
    .staff_text {
        padding: 0 0 30px!important;
    }
    .csize {
        width: 55px;
    }
    .createprocedure_step2_left_staff {
      padding: 0 0 30px!important;
    }
</style>
<div class="col-md-10 container_padding_none">
    <div class="content_right_dashboard">
        <div class="create_procedure_width">            
            <?php if($success !=""){  echo '<div class="alert alert-success">'.$success.'</div>';   }
            if($error !="" && $fail){ echo '<div class="alert alert-error  '.$fail.' ">'.$error.'</div>';  } ?>

            <div id="tabs">
                <ul><li><a href="#tabs-1">Edit Procedure</a></li></ul>

                <div id="tabs-1">
                    <form id='procedureCreate' method='POST' action=''  data-toggle = 'validator'>
                        <input type ="hidden" name ="editProcedure" value ="1"/>
                        <div class="select_procedure_slider_background"> 
                            <div class="createprocedure_step1">
                                <div class="createprocedure_step1_box_text">
                                    <h1>
                                        <span>
                                            <div class ="select-cat">
                                                <span class="cat-text">
                                                    <?php if(isset($icon)){
                                                        foreach($icon as $pics){
                                                            if($proced['procedure']->category_id == $pics['ID']){ ?>
                                                                <div class="item">
                                                                    <a href ="#" class ="icons-selected">
                                                                        <img src='<?php echo base_url().$pics['icon']?>' />
                                                                    </a>
                                                                    <input type ="hidden" name ="cat-name" value ="<?php echo $pics['category_name']?>" class ="cat-name-selection" />

                                                                    <input type ="hidden" name ="cat-id" value ="<?php echo $pics['ID']?>" class ="cat-id" />
                                                                </div>  <?php
                                                            }
                                                        }
                                                    }  ?>
                                                </span> 
                                                <span class="name-st"> <?php echo $proced['procedure']->category_name ?></span>
                                                <input type="hidden" name="procedure_cat" value="<?php echo $proced['procedure']->category_id ?>">
                                            </div>
                                        </span>
                                    </h1>

                                    <div class="select_procedure_name_width">
                                        <div class="createprocedure_step1_select_staff select-style">
                                            <div class ="procedure-name">
                                                <select name ="procedure_name" id="p-name"> 
                                                    <option value ="<?php echo $proced['procedure']->procedure_name ?>" selected><?php echo ucfirst($proced['procedure']->procedure_name) ?></option> 
                                                </select>                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4>Procedure Description</h4>
                                            <textarea name ="description" class ="prc-desc" ><?php echo $proced['procedure']->description ?></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label for ="slots">Appointment Per Slot</label><br>
                                            <div class="createprocedure_step1_procedure_description"> 
                                                <img src="<?php echo base_url();?>assets/images/appointment_per_slot_icon.png" />
                                                <div class="createprocedure_step1_quantity">
                                                    <div class="sp-quantity">
                                                        <div class="sp-minus fff">
                                                            <a class="counterNs" href="#" data-multi="-1">-</a>
                                                        </div>
                                                        <div class="sp-input">
                                                            <input type="text" class="quntity-input" required name ="appt_per_slots" value="<?php echo $proced['procedure']->hourly_appt ?>" />
                                                        </div>
                                                        <div class="sp-plus fff">
                                                            <a class="counterNs" href="#" data-multi="1">+</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="createprocedure_step1_box_amount">
                                    <div class="amount_warning"></div>
                                    <h1>From Amount</h1>
                                    <input placeholder="$00.00"  name ="from_amount" required="" class ="sp-amt" value ="<?php echo $proced['procedure']->from_price ?>" />
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="createprocedure_step1_box_amount">
                                    <h1>To Amount</h1>
                                    <input placeholder="$00.00"  name ="to_amount"  required="" class ="to-amt" value ="<?php echo $proced['procedure']->to_price ?>"/>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="createprocedure_step1_box_staff">
                                    <div class="alert"><div class ="showMessage"></div></div>
                                    <div class="row">
                                        <div class="col-md-2"> </div>
                                        <div class="col-md-8">
                                            <div class="createprocedure_step1_titel_staff"> <span>Staff</span>
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
                                                                    echo form_dropdown("staff_name_type[]", $staff, "", $extra); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2"> 
                                                            <a class="createprocedure_step1_plus_staff" id="moreStaffListing" href="#" > <i class="fa fa-plus"></i> </a> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-2"> </div>
                                    <div class="col-md-8">
                                        <div id="addedMoreCatgeory">
                                        </div>
                                    </div>
                                    <div class ="rmv"></div>
                                </div>
                                <?php //print_r($proced['staff']);?>
                                <div class="createprocedure_step1_slider">
                                    <div class="owl-createprocedure_step1_slider" id ="owl-createprocedure_step1_slider">
                                        <?php foreach($proced['staff'] as $st){  ?>
                                            <div class="item">
                                                <div class="createprocedure_step1_buttom_slider"> 
                                                    <img src="<?php  echo base_url().$st['staff_pic'] ?>" />
                                                    <div class="createprocedure_step1_buttom_slider1">
                                                        <h1><?php  echo $st['staff_name'] ?></h1>
                                                        <span><?php  echo $st['staff_cat_name'] ?></span> 
                                                    </div>
                                                    <a href ="#" class ="deleteStaff">
                                                        <div class="createprocedure_step1_delete_slider1"> 
                                                            <i class="fa fa-trash-o"></i>                                    
                                                        </div>
                                                    </a>
                                                    <input type="hidden" name="staff_pic[]" class="staff_pcs" value="<?php  echo $st['staff_pic']?>">
                                                    <input type="hidden" name="staff_cat_id[]" class="staff_cat_id" value="<?php  echo $st['staff_cat_id']?>"> 
                                                    <input type="hidden" name="staff_cat_type[]" class="staff_cat_check" value="<?php  echo $st['staff_cat_name']?>"> 

                                                    <input type="hidden" name="staff_id[]" class="staff_check" value="<?php echo $st['staff_id']?>">

                                                    <input type="hidden" name="staff_name[]" value="<?php echo $st['staff_name']?>">
                                                    
                                                    <?php if(empty($st['staff_id'])){ ?>
                                                        <input type="hidden" name="group_cat[]" class="group_select" value="<?php  echo $st['staff_cat_id']?>">
                                                    <?php } ?>

                                                    <div class ="staff-section">
                                                        <div class="createprocedure_step2_left_staff hideContent">
                                                            <img src="<?php  echo base_url().$st['staff_pic'] ?>" class="csize" />
                                                            <div class="createprocedure_step2_left_text">
                                                                <h2><?php  echo $st['staff_name'] ?></h2>
                                                                <span><?php  echo $st['staff_cat_name'] ?></span> 
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>                        
                                        <?php  }   ?>  
                                    </div>
                                </div>

                                <div class="createprocedure_step1_next_button">
                                    <button type ="button" id="createprocedure_step1_next" class ="nextClick btn btn-primary">Next</button> 
                                </div>
                            </div>
                        </div>

                        <div class="createprocedure_step2_background">
                            <div class="col-md-3 container_padding_none">
                                <div class="createprocedure_step2_left_content">
                                    <a href="#" class="createprocedure_step2_left_procedure_go_back">Go Back</a>
                                    <div class="createprocedure_step2_left_procedure">
                                        <h1>Procedure Category</h1>
                                        <a class="createprocedure_step2_left_eye" href="#">
                                            <i class="fa fa-eye"></i> <span class ="prtSelectedCat"></span>
                                        </a>

                                        <h1>Procedure Name</h1>
                                        <a class="createprocedure_step2_left_xyz" href="#">
                                            <span class ="prtSelectedName"></span>
                                        </a>

                                        <h1>Description</h1>
                                        <p class ="prcDesc"></p>

                                        <h1>Appointment Per Slot</h1>
                                        <a class="createprocedure_step2_left_calendar total-slots" href="#"></a>

                                        <input type ="hidden" name ="MPID" class ="mpid" value ="<?php echo $proced['procedure']->MPID ?>"/>
                                        <input type ="hidden" name ="procedure_name_selected" class ="pnamesS" />

                                        <h1>Staff</h1>
                                        <div class="createprocedure_step2_left_staff staff-block "></div>

                                        <h1>Amount</h1>
                                        <p class ="paid-amt-edit"></p><p class ="from-amt"></p>
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
                                                    <td>
                                                        <a class="createprocedure_calendar_click_button" href="#" id="createprocedure_calendar_click_content_mon"><img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png"></a>

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

                                                            <a href="#" class="createprocedure_calendar_popup_button" id="mon_add_slot">add</a>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <a class="createprocedure_calendar_click_button" href="#" id="createprocedure_calendar_click_content_tues" ><img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png"></a>

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
                                                            <a href="#" class="createprocedure_calendar_popup_button" id="tues_add_slot">add</a>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <a class="createprocedure_calendar_click_button"  id="createprocedure_calendar_click_content_wed" href="#"><img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png"></a>

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
                                                            <a href="#" class="createprocedure_calendar_popup_button" id="wed_add_slot">add</a>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <a class="createprocedure_calendar_click_button" id="createprocedure_calendar_click_content_thur" href="#"><img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png"></a>

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
                                                            <a href="#" class="createprocedure_calendar_popup_button" id="thus_add_slot" >add</a>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <a class="createprocedure_calendar_click_button" href="#" id="createprocedure_calendar_click_content_fri"><img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png"></a>

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
                                                            <a href="#" class="createprocedure_calendar_popup_button" id="fri_add_slot" >add</a>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <a class="createprocedure_calendar_click_button" id="createprocedure_calendar_click_content_sat" href="#"><img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png"></a>

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
                                                            <a href="#" class="createprocedure_calendar_popup_button" id="sat_add_slot">add</a>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <a class="createprocedure_calendar_click_button" href="#" id="createprocedure_calendar_click_content_sun"><img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png"></a>

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
                                                            <a href="#" class="createprocedure_calendar_popup_button" id="sun_add_slot">add</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php    $i = 1;   ?>                                               
                                                    <td id="mon_solts"> 
                                                        <?php  if(!empty($proced['slots'])){        
                                                            foreach($proced['slots'] as $slt){
                                                                if($slt['weekday'] == 1){ ?>
                                                                    <div class="createprocedure_calendar_date" id="mon_<?php echo $i ?>" data-slot-id ="<?php echo $slt['ID']; ?>"> 
                                                                        <a href="#" class="createprocedure_calendar_circle deleteTimeSlot suredelete"><i class="fa fa-times-circle"></i></a>

                                                                        <span><?php echo $slt['slot']?></span>

                                                                        <p>Seats</p>

                                                                        <input type="hidden" name="mon_slots[]" value="<?php echo $slt['slot']?>">
                                                                        <input type="hidden" name="mon_slots_update[]" value="<?php echo $slt['ID']?>">
                                                                        <div class="sp-quantity">
                                                                            <div class="sp-minus fff">
                                                                                <a class="counterNsMult" href="#" data-multi="-1">-</a>
                                                                            </div>
                                                                            <div class="sp-input">
                                                                                <input type="text" name="mon_slots_seats[]" class="slots-size" value="<?php echo $slt['seats']?>">
                                                                            </div>
                                                                            <div class="sp-plus fff">
                                                                                <a class="counterNsMult" href="#" data-multi="1">+</a>
                                                                            </div> 
                                                                        </div>
                                                                    </div>                                                      
                                                                <?php }
                                                                $i++;      
                                                            }
                                                        } ?>  
                                                    </td>
                                                            
                                                    <td id="tues_solts">                                                    
                                                        <?php if(!empty($proced['slots'])){  
                                                            foreach($proced['slots'] as $slt){ ?>
                                                                <?php if($slt['weekday'] == 2){ ?>
                                                                    <div class="createprocedure_calendar_date" id="tu_<?php echo $i ?>" data-slot-id ="<?php echo $slt['ID']; ?>">
                                                                        <a href="#" class="createprocedure_calendar_circle deleteTimeSlot"><i class="fa fa-times-circle"></i></a> 

                                                                        <span><?php echo $slt['slot']?></span>

                                                                        <p>Seats</p>

                                                                        <input type="hidden" name="tues_slots[]" value="<?php echo $slt['slot']?>">

                                                                        <input type="hidden" name="tues_slots_update[]" value="<?php echo $slt['ID']?>">

                                                                        <div class="sp-quantity">
                                                                            <div class="sp-minus fff">
                                                                                <a class="counterNsMult" href="#" data-multi="-1">-</a>
                                                                            </div>
                                                                            <div class="sp-input">
                                                                                <input type="text" name="tues_slots_seats[]" class="slots-size" value="<?php echo $slt['seats']?>">
                                                                            </div>
                                                                            <div class="sp-plus fff">
                                                                                <a class="counterNsMult" href="#" data-multi="1">+</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                      
                                                                <?php }
                                                               $i++;   
                                                            }
                                                        } ?>
                                                    </td>

                                                    <td id="wed_solts">
                                                        <?php if(!empty($proced['slots'])){  
                                                            foreach($proced['slots'] as $slt){
                                                                if($slt['weekday'] == 3){?>
                                                                    <div class="createprocedure_calendar_date" id="we_<?php echo $i ?>" data-slot-id ="<?php echo $slt['ID']; ?>">

                                                                        <a href="#" class="createprocedure_calendar_circle deleteTimeSlot"><i class="fa fa-times-circle"></i></a>

                                                                        <span><?php echo $slt['slot']?></span>

                                                                        <p>Seats</p>

                                                                        <input type="hidden" name="wed_slots[]" value="<?php echo $slt['slot']?>">

                                                                        <input type="hidden" name="wed_slots_update[]" value="<?php echo $slt['ID']?>">

                                                                        <div class="sp-quantity">
                                                                            <div class="sp-minus fff">
                                                                                <a class="counterNsMult" href="#" data-multi="-1">-</a>
                                                                            </div>
                                                                            <div class="sp-input">
                                                                                <input type="text" name="wed_slots_seats[]" class="slots-size" value="<?php echo $slt['seats']?>">
                                                                            </div>
                                                                            <div class="sp-plus fff">
                                                                                <a class="counterNsMult" href="#" data-multi="1">+</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                     
                                                                <?php }
                                                                $i++;
                                                            }
                                                        } ?>  
                                                    </td>

                                                    <td id="thus_solts">
                                                        <?php if(!empty($proced['slots'])){         
                                                            foreach($proced['slots'] as $slt){
                                                                if($slt['weekday'] == 4){ ?>
                                                                    <div class="createprocedure_calendar_date" id="thue_<?php echo $i ?>"  data-slot-id ="<?php echo $slt['ID']; ?>"> 

                                                                        <a href="#" class="createprocedure_calendar_circle deleteTimeSlot"><i class="fa fa-times-circle"></i></a>

                                                                        <span><?php echo $slt['slot']?></span>

                                                                        <p>Seats</p>

                                                                        <input type="hidden" name="thus_slots[]" value="<?php echo $slt['slot']?>">

                                                                        <input type="hidden" name="thus_slots_update[]" value="<?php echo $slt['ID']?>">

                                                                        <div class="sp-quantity"> 
                                                                            <div class="sp-minus fff">
                                                                                <a class="counterNsMult" href="#" data-multi="-1">-</a>
                                                                            </div>
                                                                            <div class="sp-input">
                                                                                <input type="text" name="thus_slots_seats[]" class="slots-size" value="<?php echo $slt['seats']?>">
                                                                            </div>
                                                                            <div class="sp-plus fff">
                                                                                <a class="counterNsMult" href="#" data-multi="1">+</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                      
                                                                <?php }
                                                                $i++;
                                                            }
                                                        } ?>                  
                                                    </td>

                                                    <td id="fri_solts"> 
                                                        <?php  if(!empty($proced['slots'])){  
                                                            foreach($proced['slots'] as $slt){
                                                                if($slt['weekday'] == 5){ ?>
                                                                    <div class="createprocedure_calendar_date" id="fri_<?php echo $i ?>" data-slot-id ="<?php echo $slt['ID']; ?>">  
                                                                        <a href="#" class="createprocedure_calendar_circle deleteTimeSlot"><i class="fa fa-times-circle"></i></a>

                                                                        <span><?php echo $slt['slot']?></span>

                                                                        <p>Seats</p>

                                                                        <input type="hidden" name="fri_slots[]" value="<?php echo $slt['slot']?>">

                                                                        <input type="hidden" name="fri_slots_update[]" value="<?php echo $slt['ID']?>">

                                                                        <div class="sp-quantity">
                                                                            <div class="sp-minus fff">
                                                                                <a class="counterNsMult" href="#" data-multi="-1">-</a>
                                                                            </div>
                                                                            <div class="sp-input">
                                                                                <input type="text" name="fri_slots_seats[]" class="slots-size" value="<?php echo $slt['seats']?>">
                                                                            </div>
                                                                            <div class="sp-plus fff">
                                                                                <a class="counterNsMult" href="#" data-multi="1">+</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                     
                                                                <?php }
                                                                $i++;
                                                            }
                                                        } ?>
                                                    </td>

                                                    <td id="sat_solts">
                                                        <?php if(!empty($proced['slots'])){
                                                            foreach($proced['slots'] as $slt){
                                                                if($slt['weekday'] == 6){ ?>
                                                                    <div class="createprocedure_calendar_date" id="sat_<?php echo $i ?>" data-slot-id ="<?php echo $slt['ID']; ?>"> 
                                                                        <a href="#" class="createprocedure_calendar_circle deleteTimeSlot"><i class="fa fa-times-circle"></i></a>

                                                                        <span><?php echo $slt['slot']?></span>

                                                                        <p>Seats</p>

                                                                        <input type="hidden" name="sat_slots[]" value="<?php echo $slt['slot']?>">

                                                                        <input type="hidden" name="sat_slots_update[]" value="<?php echo $slt['ID']?>">

                                                                        <div class="sp-quantity">
                                                                            <div class="sp-minus fff">
                                                                                <a class="counterNsMult" href="#" data-multi="-1">-</a>
                                                                            </div>
                                                                            <div class="sp-input">
                                                                                <input type="text" name="sat_slots_seats[]" class="slots-size" value="<?php echo $slt['seats']?>">
                                                                            </div>
                                                                            <div class="sp-plus fff">
                                                                                <a class="counterNsMult" href="#" data-multi="1">+</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                                $i++;
                                                            }
                                                        } ?>       
                                                    </td>

                                                    <td id="sun_solts">
                                                        <?php if(!empty($proced['slots'])){  
                                                            foreach($proced['slots'] as $slt){
                                                                if($slt['weekday'] == 7){ ?>
                                                                    <div class="createprocedure_calendar_date" id="sun_<?php echo $i ?>" data-slot-id ="<?php echo $slt['ID']; ?>"> 
                                                                        <a href="#" class="createprocedure_calendar_circle deleteTimeSlot"><i class="fa fa-times-circle"></i></a>

                                                                        <span><?php echo $slt['slot']?></span>  

                                                                        <p>Seats</p>

                                                                        <input type="hidden" name="sun_slots[]" value="<?php echo $slt['slot']?>">

                                                                        <input type="hidden" name="sun_slots_update[]" value="<?php echo $slt['ID']?>">

                                                                        <div class="sp-quantity">
                                                                            <div class="sp-minus fff">
                                                                                <a class="counterNsMult" href="#" data-multi="-1">-</a>
                                                                            </div>
                                                                            <div class="sp-input">
                                                                                <input type="text" name="sun_slots_seats[]" class="slots-size" value="<?php echo $slt['seats']?>">
                                                                            </div>
                                                                            <div class="sp-plus fff">
                                                                                <a class="counterNsMult" href="#" data-multi="1">+</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                     
                                                                <?php }
                                                                $i++;
                                                            }
                                                        }  ?>                                                                 
                                                    </td>
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
            </div>
        </div>
    </div>
</div>
<style>
    .left_sidebar_border{height: 800px !important;}
</style>
<SCRIPT TYPE="text/javascript">
    $(document).ready(function(){
      $('.owl-item img').click(function(){ 
        $('.owl-item img').removeClass("active");
        $(this).addClass("active");
    });

    $('.createprocedure_calendar_circle').click(function(){
        var ids = $(this).parent().attr('id');        
        $('#'+ids).remove();
           return false;
    })

    $(".counterNsMult").on("click", function () {
        var $button = $(this);
        var $input = $button.closest('.sp-quantity').find("input.slots-size");
        $input.val(function(i, value) {
            return +value + (1 * +$button.data('multi'));
        });
        return false;
    });

    var owl = $("#owl-createprocedure_step1_slider");
        owl.owlCarousel({
            margin:25,
            loop: true,
            responsive: {
                0: {

                    items: 1
                },

                600: {
                    items: 1

                },
                1000: {

                    items: 1
                }
            }
        });      
    });
</SCRIPT>