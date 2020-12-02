<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular-sanitize.js"></script>
<div class="col-md-10 container_padding_none">
<div class="content_right_dashboard">
<div class="row" style="background:#fff;border-bottom: 1px solid #cacaca; border-top: 1px solid #e6eced;">
  <div class="col-md-4 col-sm-4">
    <div class="content_right_patients_titel">
      <h1 style="border:none;">Hospital</h1>
    </div>
  </div>
  <div class="col-md-8 col-sm-8">
    <?php if($this->session->flashdata('success')){ ?>
    <div class="alert alert-success" style="width: 56%; margin: 3px 0px 0px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong><?php echo $this->session->flashdata('success'); ?></strong> </div>
    <?php } ?>
  </div>
</div>
<div class="content_right1_patients">
<div class="hospital_content_padding">
<!---start Fetch data using angularjs for hospital basic details and the controller name is hospital_logo_user_dataCtrl and js path assets/angular/script/procedure.js  -->
                <div  ng-controller="hospital_logo_user_dataCtrl" class="hopital_logo">
             
                    <div class="hospital_content_logo" ng-repeat="hhospitalLogoUserData1 in hhospitalLogoUserData">
                        <div class="col-md-7 container_padding_none">
                            <div class="hospital_content_logo_img"> <img src="<?php echo base_url();?>{{hhospitalLogoUserData1.logo_url}}" style="width: 332px; height: 150px;" /> </div>
                        </div>
                        <div class="col-md-5 container_padding_none">
                            <div class="hospital_content_edit_button">
                                <a href="#" data-toggle = "modal" data-target = "#myModal" >Edit</a>
                                <p><strong>{{hhospitalLogoUserData1.name}}</strong> <br/>
                                    {{hhospitalLogoUserData1.address}} <br/>
                                    {{hhospitalLogoUserData1.city}}-{{hhospitalLogoUserData1.zip}} <br/>
                                    Phone Number- {{hhospitalLogoUserData1.phone}} </p> 
                            </div>
                        </div>
                    </div>
                </div>
                <!---start Fetch data using angularjs for hospital basic details and the controller name is hospital_logo_user_dataCtrl and js path assets/angular/script/procedure.js  -->
                <div class="hospital_content_images">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="hospital_content_images_slider1">
                                <div class="hospital_content_images_titel">
                                    <h1>Images</h1>
                                    <a href="#" data-toggle = "modal" data-target = "#image_upload_section">Upload</a> </div>
                                <!---start Fetch data using angularjs for hospital slider image and the controller name is hospital_profile_imageCtrl and js path assets/angular/script/procedure.js  -->
                                <div ng-controller="hospital_profile_imageCtrl" id="slides_control">
                                    <div>
                                        <carousel interval="myInterval">
                                            <slide ng-repeat="slide in slides" active="slide.active"> <img ng-src="<?php echo base_url();?>assets/hospital/hospitalslider/original/{{slide.picurl}}">
                                                <div class="carousel-caption"> </div>
                                            </slide>
                                        </carousel>
                                    </div>
                                </div>
                                <!---End Fetch data using angularjs for hospital slider image and the controller name is hospital_profile_imageCtrl and js path assets/angular/script/procedure.js  -->
                            </div>
                        </div>
                        <!---start Fetch data using angularjs and the controller name is hospital_working_hours_list and js path assets/angular/script/procedure.js  -->
                        <div class="col-md-4" ng-controller="hospital_working_hours_list">
                       
                            <div class="hospital_content_images_right" >
                                <div class="hospital_content_images_titel">
                                    <h1>Working Hours</h1>
                                    <a href="#"  data-toggle = "modal" data-target = "#working_time_section">Edit</a> </div>
                                <ul  ng-repeat="working_hour in working_hours">
                                    <li><span>{{working_hour.name}}</span>
                                        <p>{{working_hour.frm_hrs}} TO {{working_hour.to_hrs}} </p>
                                    </li>
                                </ul>
                                <!--<ul  ng-repeat="working_hours in working_hours" ng-if="working_hours.frm_hrs==''">
                                    <li><span>{{working_hours.name}}</span>
                                        <p style="color:#F00">CLOSE</p>
                                    </li>
                                </ul>-->
                            </div>
                        </div>
                        <!---End Fetch data using angularjs and the controller name is hospital_working_hours_list and js path assets/angular/script/procedure.js  -->
                    </div>
                </div>
                <!-----------------------------Add staff details and slider------------------------>
              <div class="hospital_content_slider_staff"  ng-controller="editStaffCtrl"> 
               <div class="hospital_content_images_titel">
                    <h1>Staff</h1>
                     <!--<a href="#invitestaffpopup" class="fancybox">invite</a>-->
                </div>
              <div class="createprocedure_step1_slider">
                        <div class="owl-createprocedure_step1_slider">
                        <?php 
						foreach($hospital_staff_image as $hospital_staff_image1) { ?>
                              <div class="item">
                            <div class="createprocedure_step1_buttom_slider"> <img class="img-circle" src="<?php echo base_url().$hospital_staff_image1->staff_pic;?>" />
                              <div class="createprocedure_step1_buttom_slider1">
                                <h1><?php echo $hospital_staff_image1->staff_name;?></h1>
                                <span><?php echo $hospital_staff_image1->staff_cat_name;?></span> </div>
                                <div class="createprocedure_step1_delete_slider1 editstaff" >
                                <a href="#"  data-toggle = "modal" data-target = "#staff_edit" class="staffEdit" dir="<?php echo $hospital_staff_image1->StaffID ?>" > <i class="fa fa-pencil-square-o"></i></a> </div>
                                 <input type="hidden" class="staff" value="<?php echo $this->session->userdata('hospital_id'); ?>">
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                        <div class = "modal fade" id = "staff_edit" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                    &times;
                </button>
                <h4 class = "modal-title" id = "myModalLabel">
                    Edit Staff
                </h4>
            </div>
            <?php echo form_open_multipart('specialist/staff_update'); ?>
            <div class = "modal-body">
                <fieldset class="form-group">
                    <label for="HospitalName">Staff Name</label>
                    <input type="text" name="hospital_name" class="form-control" id="exampleInputEmail1" placeholder="Hospital Name" value ="" required>
                </fieldset>
                <fieldset class="form-group">
                    <label for="haddres">Other Info</label>
                    <input type="text" name="hospital_address" class="form-control" id="exampleInputPassword1" value ="" required>
                </fieldset>
                </fieldset>
                <fieldset class="form-group">
                    <label for="haddres">Staff Category Name</label>
                    <input type="text" name="hospital_email" class="form-control" id="hospital_email_id" value =""  required>
                </fieldset>
                
                
                <div class="row">
                    <div class="col-sm-6">
                        <fieldset class="form-group">
                            <div class="fileUpload btn btn-primary">
                                <span>Upload</span>
                                <input type="file" name="file_logo" class="upload"  ng-model="myModel" preview-class="img-thumbnail" preview-container="mediaHere" media-preview />
                            </div>
                        </fieldset>
                        <small class="text-muted" style="color:#F00">Please Upload Clear Image, appropriate image width height 150*150</small>
                    </div>
                    <div class="col-sm-6">
                        <div id="mediaHere" style="position:absolute; right:10%;" class="custom-preview"></div>
                        <img src="<?php echo base_url().'assets/hospital/original'; ?>" class="img-preview img-responsive" style="height:140px; width:250px">
                    </div>
                </div>
            </div>
            <div class = "modal-footer">
                <button type= "button" class = "btn btn-default" data-dismiss = "modal">
                    Close
                </button>
                <button type = "submit" class = "btn btn-primary">
                    Submit Changes
                </button>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
                      
                 </div>  
                <!----------------------------end staff details and slider------------------------>
                <div class="hospital_content_facilities_div" ng-controller="hospitalfacilitiesCtrl">
                    <div class="row">
                        <!----------------------------Start facilities details------------------------>
                        <div class="col-md-6">
                            <div class="hospital_content_facilities">
                                <div class="hospital_content_images_titel">
                                    <h1>Facilities</h1>
                                    <a href="#inline2" class="fancybox">Edit</a>
                                    <div id="inline2" style="width:300px;display: none; height:100%">
                                        <div class="staff_popup_button_complete">
                                            <h1>Add Facilities</h1>
                                            <div class="staff_popup_button_input">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input type="hidden" class="hospital_id" value="<?php echo $this->session->userdata('hospital_id'); ?>">
                                                        <input type="hidden" class="useridhidden" value="<?php echo $this->session->userdata('hospital_id'); ?>">
                                                        <input type="text" name="facilityName" class="form-froup facilityNamePopup" placeholder="Facility Name">
                                                        <a href="javascript:void(0)" class="btn btn-primary" id="facilityAdd">Add</a> </div>
                                                    <div class="error col-sm-12" style="color:#F00;color: rgb(255, 0, 0);text-align: center;"></div>
                                                </div>
                                            </div>
                                            <?php
                                            //$items = array();
                                            if(!empty($hospital_facilities_info)){
                                                foreach($hospital_facilities_info as $hospital_facilities) {
                                                    $hfacilityPopup[] = $hospital_facilities->facility_name;
                                                }
                                                ?>
                                                <div class="hospital_facilities">
                                                    <input id="facilityPopup" type="text" value="<?php echo implode (", ", $hfacilityPopup); ?>" data-role="tagsinput" />
                                                </div>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <div class="hospital_facilities">
                                                    <input type="text" id="facilityPopup" value="" data-role="tagsinput" class="facilities" />
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $items = array();
                                if(!empty($hospital_facilities_info)){
                                    foreach($hospital_facilities_info as $hospital_facilities) {
                                        $hfacility[] = $hospital_facilities->facility_name;
                                    }
                                    ?>
                                    <div class="hospital_facilities">
                                        <input type="text" id="facility" value="<?php echo implode (", ", $hfacility); ?>" data-role="tagsinput" class="facilities" />
                                    </div>
                                    <?php
                                }
                                else{
                                    ?>
                                    <div class="hospital_facilities">
                                        <input type="text" id="facility" value="" data-role="tagsinput" class="facilities" />
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!----------------------------End facilities details------------------------>
                        <!----------------------------Start services details------------------------>
                        <div class="col-md-6">
                            <div class="hospital_content_facilities">
                                <div class="hospital_content_images_titel">
                                    <h1>Services</h1>
                                    <a href="#inline3" class="fancybox">Edit</a> </div>
                                <div id="inline3" style="width:300px;display: none; height:100%">
                                    <div class="staff_popup_button_complete">
                                        <h1>Add Services</h1>
                                        <div class="staff_popup_button_input">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="hidden" class="hospital_id_server" value="<?php echo $this->session->userdata('hospital_id'); ?>">
                                                    <input type="hidden" class="useridhidden" value="<?php echo $this->session->userdata('hospital_id'); ?>">
                                                    <input type="text" name="serviceName" class="form-froup serviceNamePopup" placeholder="Service Name">
                                                    <a href="javascript:void(0)" class="btn btn-primary" id="serviceAdd">Add</a> </div>
                                                <div class="errorservice col-sm-12" style="color:#F00;color: rgb(255, 0, 0);text-align: center;"></div>
                                            </div>
                                        </div>
                                        <?php
                                        if(!empty($hospital_services_info)){
                                            foreach($hospital_services_info as $hospital_service) {
                                                $hservices[] = $hospital_service->service_name;
                                            }
                                            ?>
                                            <div class="hospital_facilities">
                                                <input id="servicePopup" type="text" value="<?php echo implode (',', $hservices); ?>" data-role="tagsinput"/>
                                            </div>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <div class="hospital_facilities">
                                                <input type="text" id="facilityPopup" value="" data-role="tagsinput" class="facilities" />
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php
                                if(!empty($hospital_services_info)){
                                    foreach($hospital_services_info as $hospital_service) {
                                        $hservices[] = $hospital_service->service_name;
                                    }
                                    ?>
                                    <div class="hospital_facilities">
                                        <input type="text"  id="services" value="<?php echo implode (',', $hservices); ?>" data-role="tagsinput" />
                                    </div>
                                    <?php
                                }
                                else{
                                    ?>
                                    <div class="hospital_facilities">
                                        <input type="text" id="services" value="" data-role="tagsinput" class="facilities" />
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!----------------------------End services details------------------------>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</section>
<!-- CONTAINER END -->
<div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">
    <div class = "modal-dialog" ng-controller="hospitalDataCtrl">
        <div class = "modal-content">
            <div class = "modal-header">
                <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                    &times;
                </button>
                <h4 class = "modal-title" id = "myModalLabel">
                    Hospital Details
                </h4>
            </div>
            <?php echo form_open_multipart('specialist/hospital_update'); ?>
            <div class = "modal-body" ng-repeat="hhospital_data_each in hhospital_data">
                <fieldset class="form-group">
                    <label for="HospitalName">Hospital Name</label>
                    <input type="text" name="hospital_name" class="form-control" id="exampleInputEmail1" placeholder="Hospital Name" value="{{hhospital_data_each.name}}" required>
                </fieldset>
                <fieldset class="form-group">
                    <label for="haddres">Hospital Address</label>
                    <input type="text" name="hospital_address" class="form-control" id="exampleInputPassword1" placeholder="Hospital Address" value="{{hhospital_data_each.address}}" required>
                </fieldset>
                </fieldset>
                <fieldset class="form-group">
                    <label for="haddres">Hospital Email</label>
                    <input type="text" name="hospital_email" class="form-control" id="hospital_email_id" placeholder="Hospital Email Address" value="{{hhospital_data_each.email}}" required>
                </fieldset>
                <fieldset class="form-group">
                    <label for="haddres">Hospital Phone Number</label>
                    <input type="text" name="hospital_phone" class="form-control" id="hospital_phone_id" placeholder="Hospital Phone Number" value="{{hhospital_data_each.phone}}" required>
                </fieldset>
                <fieldset class="form-group">
                    <label for="haddres">Hospital Zip Code</label>
                    <input type="text" name="hospital_zip" class="form-control" id="hospital_zip_code" placeholder="Hospital Zip Code" value="{{hhospital_data_each.zip}}" required>
                </fieldset>
                <div class="row">
                    <div class="col-sm-6">
                        <fieldset class="form-group">
                            <div class="fileUpload btn btn-primary">
                                <span>Upload</span>
                                <input type="file" name="file_logo" class="upload"  ng-model="myModel" preview-class="img-thumbnail" preview-container="mediaHere" media-preview />
                            </div>
                        </fieldset>
                        <small class="text-muted" style="color:#F00">Please Upload Clear Image, appropriate image width height 150*150</small>
                    </div>
                    <div class="col-sm-6">
                        <div id="mediaHere" style="position:absolute; right:10%;" class="custom-preview"></div>
                        <img src="<?php echo base_url()?>{{hhospital_data_each.logo_url}}" class="img-preview img-responsive" style="height:140px; width:250px">
                    </div>
                </div>
            </div>
            <div class = "modal-footer">
                <button type= "button" class = "btn btn-default" data-dismiss = "modal">
                    Close
                </button>
                <button type = "submit" class = "btn btn-primary">
                    Submit changes
                </button>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class ="modal fade" id ="image_upload_section" tabindex = "-1" role= "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">
    <div class = "modal-dialog" ng-controller="hospital_profile_images_info">
        <div class = "modal-content">
            <div class = "modal-header">
                <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                    &times;
                </button>
                <h4 class = "modal-title" id = "myModalLabel">
                   Hospital Images
                </h4>
            </div>
            <div class = "modal-body">
                <div class="row">
                    <div class="col-sm-4" style="padding: 10px; background: rgb(242, 242, 242) none repeat scroll 0% 0%; text-align: center;" ng-repeat="slide in slides">
                        <img src="<?php echo base_url();?>assets/hospital/hospitalslider/original/{{slide.picurl}}" class="" style="width:170px; height:170px">
                        <button class="btn btn-primary" ng-click="delete(slide.ID)" id="del{{slide.ID}}" ><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </div>
                </div>
                <?php echo form_open_multipart('specialist/hospital_image_upload'); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <fieldset class="form-group">
                            <div class="fileUpload btn btn-primary">
                                <span>Upload</span>
                                <input type="file" name="file_logo" class="upload"  ng-model="myModel" preview-class="img-thumbnail" preview-container="mediaHere" media-preview />
                            </div>
                        </fieldset>
                        <small class="text-muted" style="color:#F00">Please Upload Clear Image, appropriate image width height 150*150</small>
                    </div>
                    <div class="col-sm-6">
                        <div id="mediaHere" style="right:10%;" class="custom-preview"></div>
                    </div>
                </div>
            </div>
            <div class = "modal-footer">
                <button type = "submit" class = "btn btn-primary">
                    Upload Image
                </button>
                <?php echo form_close(); ?>
                <button type= "button" class = "btn btn-default" data-dismiss = "modal">
                    Close
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class ="modal fade" id ="working_time_section" tabindex = "-1" role= "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">
    <div class = "modal-dialog" ng-controller="hospital_working_timeCtrl" style="width: 64%;">
        <div class = "modal-content">
            <div class = "modal-header">
                <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                    &times;
                </button>
                <h4 class = "modal-title" id = "myModalLabel">
                   Hospital Working Hours
                </h4>
            </div>
            <div class = "modal-body">
                <div class="row addFormForDate" style="display:none;">
                    <form class="form-horizontal" role="form">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <select class="form-control" id="all_weekday" name="weekdays[]" > <?php foreach($all_weekdays as $all_weekday){?><option value="<?php echo $all_weekday->weekid;?>"><?php echo $all_weekday->name;?></option><?php };?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input id="timepickerfrmStatic" type="text" class="form-control" id="email" placeholder="Enter Form">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input id="timepickertoStatic" type="text" class="form-control" id="pwd" placeholder="Enter To">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary submitbtnfordate">Add</button>
                                        <button type="button" class="btn closeBtnFortimeDate" >Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <table class="table table-bordered">
                        <thead class="workinghourhead">
                        <tr>
                            <th>Working Hours</th>
                            <th>From</th>
                            <th>To</th>
                            <th><button class="btn btn-primary addTimeForDate">Add</button></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($hospital_working_hours as $result){ ?>
                            <tr>
                                <td hidden="hidden" class="userid">
                                    <input type="hidden" value="<?php echo $result->userid; ?>" class="userid<?php echo $result->weekday; ?>">
                                </td>
                                <td hidden="hidden" class="hospitalid">
                                    <input type="hidden" value="<?php echo $result->hospitalid; ?>" class="hospitalid<?php echo $result->weekday; ?>">
                                </td>
                                <td><?php echo $result->name; ?></td>
                                <td>
                                    <div class="input-group bootstrap-timepicker timepicker">
                                        <?php
                                        if($result->frm_hrs==""){
                                            $formvalue="";
                                        }
                                        else{
                                            $formvalue= $result->frm_hrs;
                                        }
                                        ?>
                                        <input id="timepickerfrm<?php echo $result->weekday; ?>" type="text" value="<?php echo $formvalue; ?>" class="form-control input-small">
                <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i>
                </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group bootstrap-timepicker timepicker">
                                        <?php
                                        if($result->to_hrs==""){
                                            $tovalue="";
                                        }
                                        else{
                                            $tovalue= $result->to_hrs;
                                        }
                                        ?>
                                        <input id="timepickerto<?php echo $result->weekday; ?>" type="text" value="<?php echo $tovalue; ?>" class="form-control input-small">
                <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i>
                </span>
                                    </div>
                                </td>
                                <?php /*?><td>
                <div class="form-group">
                <select class="form-control" id="workingstatus<?php echo $result->weekday; ?>">
                <?php if($result->status==1){ ?>
                <option value="1" selected>Enable</option>
                <option value="0">Disable</option>
                
                <?php } else{ ?>
                <option value="1">Enable</option>
                <option value="0" selected>Disable</option>
                
                <?php } ?>
                
                </select>
                </div>
                </td><?php */?>
                                <td><button class="btn btn-primary updateworkingdetails" dir="<?php echo $result->weekday; ?>">Update</button></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class = "modal-footer">
                <button type= "button" class = "btn btn-default" data-dismiss = "modal">
                    Close
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class ="modal fade" id ="hfacility" tabindex = "-1" role= "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">
    <div class = "modal-dialog" ng-controller="hospital_working_timeCtrl" style="width: 64%;">
        <div class = "modal-content">
            <div class = "modal-header">
                <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                    &times;
                </button>
                <h4 class = "modal-title" id = "myModalLabel">
                    Hospital Facility List
                </h4>
            </div>
            <div class = "modal-body">
                <div class="row">
                    <div class="col-sm-12" style="width: 100%; padding: 23px;">
                        <input type="hidden" class="hospital_id" value="<?php echo $this->session->userdata('hospital_id'); ?>">
                        <input type="hidden" class="useridhidden" value="<?php echo $this->session->userdata('hospital_id'); ?>">
                        <input type="text" name="facilityName" class="form-froup facilityName" placeholder="Facility Name">
                        <input type="text" name="facilitydesc" class="form-froup facilitydesc" placeholder="Facility Description">
                        <input type="text" name="facilityothers" class="form-froup facilityothers" placeholder="Facility Others">
                        <button class="btn btn-primary" id="facilityAdd"> Add Facility</button>
                    </div>
                    <div class="error col-sm-12" style="color:#F00;color: rgb(255, 0, 0); background: rgb(238, 238, 238) none repeat scroll 0% 0%; width: 100%; text-align: center;"></div>
                </div>
                <div class="row">
                    <table class="table table-bordered" style="width:95%;" ng-controller="hfaciltyCtrl">
                        <thead class="workinghourhead">
                        <tr>
                            <th>Facility Name</th>
                            <th>Facility Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                      
                        <tbody ng-init="get_facility_data(<?php echo $this->session->userdata('hospitalid'); ?>)">
                        <tr ng-repeat="hfacilitydatasinglevalue in hfacilitydata">
                            <td hidden="hidden" class="userid">
                                <input type="hidden" value="{{hfacilitydatasinglevalue.facility_name}}" class="userid<?php if(isset($result)){ echo $result->weekday;} ?>">
                            </td>
                            <td hidden="hidden" class="hospitalid">
                                <input type="hidden" value="{{hfacilitydatasinglevalue.facility_name}}" class="hospitalid<?php if(isset($result)){ echo $result->weekday;}  ?>">
                            </td>
                            <td>
                                {{hfacilitydatasinglevalue.facility_name}}
                            </td>
                            <td>
                                {{hfacilitydatasinglevalue.facility_desc}}
                            </td>
                            <td>
                                <button class="btn btn-primary facilityDelete" id="{{hfacilitydatasinglevalue.ID}}" >Delete</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class = "modal-footer">
                <button type= "button" class = "btn btn-default" data-dismiss = "modal">
                    Close
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script src="<?php echo base_url();?>assets/js/hospital.js?preventCache=<?php echo time() ?>"></script>
<script src="<?php echo base_url();?>assets/angular/node_modules/imgpreview/angular-media-preview.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
           var owl = $('.owl-createprocedure_step1_slider');
      owl.owlCarousel({
        margin:25,
       
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 2
          },
          1000: {
            items: 3
          }
        }
      });
        <!--------------------------Used for time picker which used in update working hours----------------------------->
        $('#timepickerfrm1').timepicker();
        $('#timepickerto1').timepicker();
        $('#timepickerfrm2').timepicker();
        $('#timepickerto2').timepicker();
        $('#timepickerfrm3').timepicker();
        $('#timepickerto3').timepicker();
        $('#timepickerfrm4').timepicker();
        $('#timepickerto4').timepicker();
        $('#timepickerfrm5').timepicker();
        $('#timepickerto5').timepicker();
        $('#timepickerfrm6').timepicker();
        $('#timepickerto6').timepicker();
        $('#timepickerfrm7').timepicker();
        $('#timepickerto7').timepicker();
        <!--------------------------end Used for time picker which used in update working hours----------------------------->
        $('#timepickerfrmStatic').timepicker();
        $('#timepickertoStatic').timepicker();
        $('#thursdaytimepicker1').timepicker();
        $('#thursdaytimepicker2').timepicker();
        $('#wednesdaytimepicker1').timepicker();
        $('#wednesdaytimepicker2').timepicker();
        $('#fridaytimepicker1').timepicker();
        $('#fridaytimepicker2').timepicker();
        $('#saturdaytimepicker1').timepicker();
        $('#saturdaytimepicker2').timepicker();
        $('#sundaytimepicker1').timepicker();
        $('#sundaytimepicker2').timepicker();
        $(document).on('click','.addTimeForDate',function(e){
            $(".addFormForDate").css('display','block');
        });
        $(document).on('click','.closeBtnFortimeDate',function(e){
            $(".addFormForDate").css('display','none');
        });
		
		$(document).on("click",'.staffEdit', function(){
			var base_url= "<?php echo  base_url();?>";
			var staffEdit = $(this);
			var staff_id= $(this).attr("dir");
			$.ajax({
                url:"<?php echo base_url()?>specialist/getSatffDetails",
                data:{'staff_id':staff_id},
                method:"POST",
                dataType:"json",
                success:function(res){
                    $('#exampleInputEmail1').val(res.staff_name);
					$('#exampleInputPassword1').val(res.other_info);
					$('#hospital_email_id').val(res.staff_cat_name);
					
					//$('#mediaHere').append("<img src="+base_url+"assets/specialist/staff/"+res.staff_pic);
					//staffEdit.next("img").attr("src").replace("over.gif", ".gif");
                }
            });
			
			})
		
        $(document).on('click','.submitbtnfordate',function(e){
            //$(".addFormForDate").css('display','none');
            var days=$('#all_weekday').val();
            var timepickerfrmStatic=$('#timepickerfrmStatic').val();
            var timepickertoStatic=$('#timepickertoStatic').val();
            $.ajax({
                url:"<?php echo base_url()?>specialist/addHospitalScheduleForADay",
                data:{"days":days,"timepickerfrmStatic":timepickerfrmStatic,"timepickertoStatic":timepickertoStatic},
                method:"POST",
                dataType:"json",
                success:function(res){
                    window.location.reload();
                    $('#working_time_section').modal('show');
                }
            });
        });
    });
</script>
<style>
.hopital_logo{ display:block;}
</style>>>>>>>>>>>