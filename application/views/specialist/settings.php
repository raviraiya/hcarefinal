<div class="col-md-10 container_padding_none">

<div class="content_right_dashboard">

<div class="content_right_patients_titel">

    <h1>Settings</h1>

</div>

<div class="content_right1_patients">

    <div class="appointments_width_block">

        <div class="settings_button_top_div">

            <a href="<?php echo base_url()?>specialist/settings" > profile</a>

            <a href="#">notification</a>

            <a href="/specialist/account" class ="password-setting">account</a> </div>

    </div>





</div>

<div class="content_right_settings"  ng-app="hcare" ng-controller="specialistcntrl">

<div class="settings_center_content" ng-init="getspecialistdetail()">

    <div class="settings_center_conten_img">

        <img ng-src="<?php echo base_url();?>{{spDetails.thumbnail}}" alt="Description" class ="sp-img" style ="border-radius: 50%;" />

    </div>

    <div class="settings_center_content_text">

        <h1>{{spDetails.name}}</h1>

        <h2>{{spDetails.title}}</h2>

        <p>{{spDetails.desc}}</p>

            <button type="button" class="btn btn-info settings_center_button_edit sp_edit" data-toggle="modal" data-target="#myModal" >Edit</button>  </div>

</div>
 

<div class ="editSplist"></div>



<div class="settings_box_content_width">

    <div class="row">

        <div class="col-md-6">

            <div class="settings_box_content" ng-init="gethospitalDetails()">

                <h1>Hospital</h1>

                <div class="settings_box_hospital">
                <img ng-src="<?php echo base_url();?>{{hospital.logo_url}}" alt="Description" class ="hs-img" style ="max-width: 160px;" />

                    <h2>{{hospital.name}}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="settings_box_content">
                <div class ="alert" ><div class ="showMessage"></div></div>
                <div class="settings_see_children_content">

                    <h1>See Children</h1>
                    
                     <div class="left_sidebar_patient_filter_padding">
                           <div class="left_sidebar_patient_filter_menu">
                            <div class="btn-group btn-group1 navecation navecation1 setWidth"  data-toggle="buttons" id ="ChildSwitch">
                                <label class="btn btn-primary <?php echo ($seeChild->see_children == 1) ? 'SeeChildsp' :'' ?>" id ="topSelect1">
                    <input type="radio" name="see_child " id="option1" <?php echo ($seeChild->see_children == 1) ? 'checked' :'' ?> autocomplete="off"  class ="seeChild " value="true"> Yes
                                </label>

                                <label class="btn btn-primary <?php echo ($seeChild->see_children == 0) ? 'SeeChildsp' :'' ?>" id ="topSelect2">
                                    <input type="radio" name="see_child" id="option2" <?php echo ($seeChild->see_children == 0)?'checked':'' ?> autocomplete="off"  class ="seeChild  " value="false"> NO
                                </label>
                            </div>
                        </div>
                  </div>
                   
                </div>

            </div>


        </div>

    </div>

    <div class="row">

        <div class="col-md-6">

            <div class="settings_box_content" ng-init="getspecialistLanguages()">



                <h1>Languages</h1>

                <div class="settings_box_hospital">

                    <div class="hospital_facilities">



                            <input type="text"  name="countries"  class ="langs" data-role="tagsinput" />

                          <h3>  <button data-toggle="modal" data-target="#modal-switch" class="addLanguage btn btn-primary">Add Language</button></h3>

                    </div>

                </div>

            </div>

        </div>



        <div id="modal-switch" tabindex="-1" role="dialog" aria-labelledby="modal-switch-label" class="modal fade">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" data-dismiss="modal" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                        <div id="modal-switch-label" class="modal-title">Add Language</div>

                        <div class="alert"><div class ="showMessage"></div>

                    </div>

                    <div class="modal-body">

                        <div class ="row">

                            <div class ="col-sm-6">

                                <div class="form-group">

                                    <?php

                                    $lang = $this->config->item('languages');

                                    $extra = 'id ="langSelected" required class="form-control input-sm parsley-validated"';

                                    echo form_dropdown("language", $lang, "", $extra); ?>

                                </div>

                            </div>

                            <div class ="col-sm-6">

                                <button type ="button" name ="save" class="btn btn-primary" id="SaveLang">Save</button>

                            </div>

                        </div>



                    </div>

                </div>

            </div>

        </div>

        </div>



        <div class="col-md-6">

            <div class="settings_box_content" ng-init ="getspecialistSpecialization()">



                <h1>Specialist</h1>

                <div class="settings_box_hospital">

                    <div class="hospital_facilities">

                        <input type="text" class ="specl"  data-role="tagsinput" />

                        <h3>  <button data-toggle="modal" data-target="#modal2" class="addSpecialization btn btn-primary">Add Specialization</button></h3>

                    </div>

                </div>

            </div>



        </div>

        <div id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal-switch-label" class="modal fade">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" data-dismiss="modal" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                        <div id="modal-switch-label" class="modal-title">Add Specialization</div>

                        <div class="alert"><div class ="showMessage"></div>

                        </div>

                        <div class="modal-body">

                            <div class ="row">

                                <div class ="col-sm-8">

                                    <div class="form-group">

                                        <label for="comment">Specialization</label>

                                        <textarea name ="specialization" class="form-control" rows="5" id="specialization-Sp"></textarea>

                                    </div>

                                    <button type ="button" name ="save" class="btn btn-primary" id="Savespecialization">Save</button>

                                </div>



                            </div>



                        </div>

                    </div>

                </div>

            </div>

        </div>





    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="settings_box_content" ng-init ="getspecialistAward()">

                <h1>Awards</h1>

                <div class="settings_box_hospital">

                    <div class="hospital_facilities">

                        <input type="text" class ="awards" data-role="tagsinput" />

                        <h3>  <button data-toggle="modal" data-target="#modal3" class="addAward btn btn-primary">Add Award</button></h3>

                    </div>

                </div>

            </div>

        </div>



        <div id="modal3" tabindex="-1" role="dialog" aria-labelledby="modal-switch-label" class="modal fade">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" data-dismiss="modal" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                        <div id="modal-switch-label" class="modal-title">Add Specialization</div>

                        <div class="alert"><div class ="showMessage"></div>

                        </div>

                        <div class="modal-body">

                            <div class ="row">

                                <div class ="col-sm-8">

                                    <div class="form-group">

                                        <label for="comment">Award</label>

                                        <textarea name ="award" class="form-control" rows="5" id="award-Sp"></textarea>

                                    </div>

                                    <div class="form-group">

                                        <label for="comment">Date</label>

                                        <input type="text" name ="award_date" class="form-control award-date hasDatepicker1" value="MM/DD/YYYY" id="datepicker" />

                                    </div>

                                    <button type ="button" name ="save" class="btn btn-primary" id="Saveaward">Save</button>

                                </div>



                            </div>



                        </div>

                    </div>

                </div>

            </div>

        </div>











    </div>



</div>

<div class="settings_box_content_width_tabs">

<div class="settings_box_content_width">

<div class="settings_tabs" id="tabs">

<ul class="appointments_right_menu">

    <li><a href="#tabs-1">personal information</a></li>

    <li><a href="#tabs-2">education experience</a></li>

    <li><a href="#tabs-3">license</a></li>

    <li><a href="#tabs-4">working hours</a></li>

</ul>

<div id="tabs-1">

    <div class ="specialist-general-info" ng-init="getspecialistgeneralInfo()">

    <form id='specialistEditForm' method='POST' action=''  data-toggle = 'validator'>
        <div class="genInfo"><button  type="submit" name ="Submit" class ="btn btn-primary gnrlinfo">Save</button></div>
        <div class="form-group">

            <input type="hidden" name ="generalInfo" class="form-control" />

        </div>

            <div class="row">

                <div class="col-sm-4">

                    <div class="form-group">

                        <label for="comment">Date of Birth</label>

                        <input type="text" name ="dob" class="form-control genralInfodatepicker" value="{{spinfo.dob}}" id="genralInfodatepicker" />

                        <div class="help-block with-errors"></div>

                    </div>

                 </div>

                <div class="col-sm-4">

                    <div class="form-group">

                        <label for="comment">Address</label>

                        <input type="text" name ="address" class="form-control" value="{{spinfo.address}}" />

                        <div class="help-block with-errors"></div>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-sm-4">

                    <div class="form-group">

                        <label for="comment">City</label>

                        <input type="text" name ="city" class="form-control" value="{{spinfo.city}}" />

                        <div class="help-block with-errors"></div>

                    </div>

                </div>

                <div class="col-sm-4">

                    <div class="form-group">

                        <label for="comment">Zip</label>

                        <input type="text" name ="zip" class="form-control" value="{{spinfo.zip}}" />

                        <div class="help-block with-errors"></div>

                    </div>

                </div>

            </div>

            <div class="row">

                 <div class="col-sm-4">

                    <div class="form-group">

                        <label for="comment">Email</label>

                        <input type="text" name ="email" class="form-control" value="{{spinfo.email}}"/>

                        <div class="help-block with-errors"></div>

                    </div>

                 </div>

                     <div class="col-sm-4">

                    <div class="form-group">

                        <label for="comment">Phone</label>

                        <input type="text" name ="phone" class="form-control" value="{{spinfo.phone}}"/>

                        <div class="help-block with-errors"></div>

                    </div>

                  </div>

            </div>

        

    </form>

    </div>

</div>

<div id="tabs-2">

    <div class="settings_tabs_2">

        <div class="settings_tabs_license_number" ng-init = "getspecialistEducation()">
            <form id='specialistEditForm' method='POST' action=''  data-toggle = 'validator'>
                <div class="settings_tabs_license_save_div">

                    <button  type="submit" name ="Submit" class ="btn btn-primary settings_tabs_license_save_button">Save</button>

                   </div>
                
                <div class="form-group">

                    <input type="hidden" name ="educationInfo" class="form-control" />

                </div>

                 <div class="row" ng-repeat="edu in spEdu">
                <div class="col-md-4">

                    <h1>Education</h1>

                    <textarea name ="education[]" />{{edu.education}}</textarea>

                </div>

                <div class="col-md-3">
                    <h1>From</h1>
                    <input type="text" name ="from_date[]" class="datepicker" value ="{{edu.from_date}}" id="datepicker" />
                </div>

                <div class="col-md-3">

                    <h1>To</h1>
                    <input type="text" name ="to_date[]" class="datepicker" value ="{{edu.to_date}}" id="datepicker" />
                   
                </div>
                  <div class="col-md-2">
                    <a href="#" class="btn btn-default removeEdu" data ="edu-{{edu.ID}}" style ="margin-top: 50px;">Remove</a>
                </div>

            </div>

            <div class ="moreEducation"></div>

            <a href="#" class="settings_tabs_2_add_more_button" id="MoreEdu">add more</a>

                

           </form>

        </div>



    </div>

</div>

<div id="tabs-3">

    <div class="settings_tabs_1">

        <form id='specialistLicence' method='POST' action=''  data-toggle = 'validator'>
            
             <div class="settings_tabs_license_save_div">

                <button  type="submit" name ="Submit" class ="btn btn-primary settings_tabs_license_save_button">Save</button>

            </div>
            
            <div class="form-group">

                <input type="hidden" name ="specialistLicence" class="form-control" />

            </div>

        <div class="settings_tabs_license_number" ng-init ="getspecialistLicense()">

            <h1>License Number</h1>

            <div class="row">

                <div class="col-md-6">

                    <input placeholder="Enter License Number" name ="licence_no" value ="{{spLicence.licence_no}}" /> </div>

            </div>

            <div class="row">

                    <div class="col-md-3">

                        <div class="select-s">

                            <input placeholder="Enter License Number" name ="licence_state" value ="{{spLicence.licence_state}}" /> </div>

                    </div>

                    <div class="col-md-3">

                        <div class="select-s">

                            <input placeholder="Enter License Number" name ="licence_city" value ="{{spLicence.licence_city}}" /> </div>

                    </div>

                <div class="col-md-3">

                    <div class="select-s">

                        <input placeholder="licence_zip" name ="licence_zip" value ="{{spLicence.licence_zip}}" />

                    </div>

                </div>

            </div>

           

        </form>

        </div>

    </div>

</div>

<div id="tabs-4">

    <div>

        <div class="popup_button_complete">

            <form id='specialistWorkingHrs' method='POST' action=''  data-toggle = 'validator'>

                <div class="form-group">

                    <input type="hidden" name ="editableWorkingHrs" class="form-control" value="1"/>

                </div>

                <div class="settings_tabs_license_save_div">

                    <button  type="submit" name ="Submit" class ="btn btn-primary">Save</button>

                </div>

             <div class="alert"><div class ="showMessage"></div></div>

            <div class="createprocedure_calendar">



                            <table cellpadding="0" cellspacing="0">

                                <tbody><tr>

                                    <th>mon</th>

                                    <th>tue</th>

                                    <th>wed</th>

                                    <th>thur</th>

                                    <th>fri</th>

                                    <th>sat</th>

                                    <th>sun</th>

                                </tr>

                                <tr>

                                    <td><a class="createprocedure_calendar_click_button" href="#" id="createprocedure_calendar_click_content_mon"><img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png">

                                        </a>

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
                                                            <select name="mon_hrs_to[]" id ="mon_hrsto" required class="appnto selectpicker">
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

                                            <a href="#" class="createprocedure_calendar_popup_button" id="mon_add_slot_edit">add</a>

                                        </div>

                                    </td>

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
                                            <a href="#" class="createprocedure_calendar_popup_button" id="tues_add_slot_edit">add</a>

                                        </div>



                                    </td>

                                    <td>

                                        <a class="createprocedure_calendar_click_button"  id="createprocedure_calendar_click_content_wed" href="#">

                                            <img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png">

                                        </a>

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

                                            <a href="#" class="createprocedure_calendar_popup_button" id="wed_add_slot_edit">add</a>

                                        </div>





                                    </td>

                                    <td>

                                        <a class="createprocedure_calendar_click_button" id="createprocedure_calendar_click_content_thur" href="#">

                                            <img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png">

                                        </a>

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



                                            <a href="#" class="createprocedure_calendar_popup_button" id="thus_add_slot_edit" >add</a>

                                        </div>

                                    </td>

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

                                            <a href="#" class="createprocedure_calendar_popup_button" id="fri_add_slot_edit" >add</a>

                                        </div>







                                    </td>

                                    <td><a class="createprocedure_calendar_click_button" id="createprocedure_calendar_click_content_sat" href="#">

                                            <img src="<?php echo base_url(); ?>assets/images/createprocedure_step2_icon2.png"></a>

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
                                            <a href="#" class="createprocedure_calendar_popup_button" id="sat_add_slot_sat">add</a>

                                        </div>

                                    </td>

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
                                            <a href="#" class="createprocedure_calendar_popup_button" id="sun_add_slot_edit">add</a>

                                        </div>

                                    </td>

                                </tr>

                                <?php

                                $weekCounter = 1;

                                $monsolts="";

                                $tuessolts="";

                                $wedsolts="";

                                $thussolts="";

                                $frdsolts="";

                                $satsolts="";

                                $sunsolts="";

                                foreach($slots as $slot){

                                if($slot['weekday'] == '1'){

                                    $monsolts.= '<div class="createprocedure_calendar_date" id ="rowCount'.$weekCounter.'"> <a href="#" class="createprocedure_calendar_circle deleteSlots">

                                                    <i class="fa fa-times-circle"></i></a> <span>'.$slot['hour'].'<input type ="hidden" name ="slotid" class ="rp" value ="'.$slot['ID'].'" /></span>

                                                   </div>';

                                }elseif($slot['weekday'] == '2'){

                                    $tuessolts.= '<div class="createprocedure_calendar_date" id ="rowCount'.$weekCounter.'"> <a href="#" class="createprocedure_calendar_circle deleteSlots">

                                                    <i class="fa fa-times-circle"></i> </a> <span>'.$slot['hour'].'<input type ="hidden" name ="slotid" class ="rp" value ="'.$slot['ID'].'" /></span>

                                                   </div>';



                                }elseif($slot['weekday'] == '3'){

                                    $wedsolts.= '<div class="createprocedure_calendar_date" id ="rowCount'.$weekCounter.'">

                                                    <a href="#" class="createprocedure_calendar_circle deleteSlots">

                                                    <i class="fa fa-times-circle"></i>

                                                    </a> <span>'.$slot['hour'].'<input type ="hidden" name ="slotid" class ="rp" value ="'.$slot['ID'].'" /></span>

                                                   </div>';



                                }elseif($slot['weekday'] == '4'){

                                    $thussolts .= '<div class="createprocedure_calendar_date" id ="rowCount'.$weekCounter.'"> <a href="#" class="createprocedure_calendar_circle deleteSlots">

                                                    <i class="fa fa-times-circle"></i></a> <span>'.$slot['hour'].'<input type ="hidden" name ="slotid" class ="rp" value ="'.$slot['ID'].'" /></span>

                                                   </div>';



                                }elseif($slot['weekday'] == '5'){

                                    $frdsolts.= '<div class="createprocedure_calendar_date" id ="rowCount'.$weekCounter.'"> <a href="#" class="createprocedure_calendar_circle deleteSlots">

                                                    <i class="fa fa-times-circle"></i></a> <span>'.$slot['hour'].'<input type ="hidden" name ="slotid" class ="rp"  value ="'.$slot['ID'].'" /></span>

                                                   </div>';



                                }elseif($slot['weekday'] == '6'){

                                    $satsolts.= '<div class="createprocedure_calendar_date" id ="rowCount'.$weekCounter.'"> <a href="#" class="createprocedure_calendar_circle deleteSlots">

                                                    <i class="fa fa-times-circle"></i></a> <span>'.$slot['hour'].'<input type ="hidden" name ="slotid" class ="rp" value ="'.$slot['ID'].'" /></span>

                                                   </div>';



                                }elseif($slot['weekday'] == '7'){

                                    $sunsolts.= '<div class="createprocedure_calendar_date" id ="rowCount'.$weekCounter.'"> <a href="#" class="createprocedure_calendar_circle deleteSlots">

                                                    <i class="fa fa-times-circle"></i></a> <span>'.$slot['hour'].'<input type ="hidden" name ="slotid" class ="rp"  value ="'.$slot['ID'].'" /></span>

                                                   </div>';



                                }

                                    $weekCounter++;

                                }

                                ?>



                                <tr>

                                    <td id="mon_solts">

                                    <?php

                                      echo $monsolts;

                                    ?>

                                    </td>

                                    <td id="tues_solts">

                                        <?php

                                        echo   $tuessolts;

                                        ?>

                                    </td>

                                    <td id="wed_solts">

                                        <?php

                                        echo $wedsolts;

                                        ?>

                                    </td>

                                    <td id="thus_solts">

                                        <?php

                                        echo $thussolts;

                                        ?>

                                    </td>

                                    <td id="fri_solts">

                                        <?php

                                        echo $frdsolts;

                                        ?>

                                    </td>

                                    <td id="sat_solts">

                                        <?php

                                        echo $satsolts;

                                        ?>

                                    </td>

                                    <td id="sun_solts">

                                        <?php

                                        echo $sunsolts;

                                        ?>

                                    </td>

                                </tr>

                                </tbody>



                            </table>



            </form>

        </div>

    </div>

</div>



</div>

</div>

</div>

</div>

</div>

</div>


