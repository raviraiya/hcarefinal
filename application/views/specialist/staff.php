<div class="col-md-10 container_padding_none" ng-controller="staffListCtrl">
  <div class="content_right_dashboard">
    <div class="content_right_patients_titel">
      <h1>Staff</h1>
    </div>
    <div class="content_right1_patients">
      <div class="staff_top_titel">
        <h1>Total {{datailslists.length}}</h1>
        <div class="staff_top_titel_button">
          <div id="inline1" style="width:300px;display: none;">
            <div class="staff_popup_button_complete">
              <h1>Add Staff</h1>
              <select class="category-input" id="staffcategory" name="staff_category">
                <option value="" selected>Select category</option>
                <?php foreach($categoryList as $key => $value){ ?>
                <option value="<?php echo $key ?>"><?php echo $value ?></option>
                <?php }?>
              </select>
              <div class="staff_popup_button_input">
                <input class="name-input" placeholder="Enter full name" id="staffName" name="staff_name">
                <input class="name-input" type="file" name="staffpic" id="addstaffImage">
                <div class="hospital_facilities"> <a href="javascript:void(0)" class="save" id="addStaff">Save</a></div>
              </div>
            </div>
          </div>
          <a href="#inline1" class="fancybox">add staff <i class="fa fa-plus"></i></a>
          <div id="inline2" style="width:300px;display: none;">
            <div class="staff_popup_button_complete">
              <h1>Add Category</h1>
              <div class="staff_popup_button_input">
                <input placeholder="Enter New Category" id="newCategory" name="staff_cat_name" />
                <a href="javascript:void(0)" id="addCategory">add</a> </div>
              <div class="error" style="display:none"></div>
              <div class="hospital_facilities">
                <select multiple data-role="tagsinput" id="test">
                  <?php foreach($categoryList as $key => $value){ ?>
                  <option value="<?php echo $value ?>"><?php echo $value ?></option>
                  <?php } ?>
                </select>
                <?php /*?><input type="text" value="<?php echo $category ?>" data-role="tagsinput" /><?php */?>
              </div>
            </div>
          </div>
          <a href="#inline2" class="fancybox">Staff Category <i class="fa fa-plus"></i></a> </div>
      </div>
    </div>
    <div id="inline3" style="width:300px;display: none;">
      <div class="staff_popup_button_complete">
        <h1>Edit Staff Details</h1>
        <select class="category-input" id="editstaffCategory" name="staff_category">
          <option value="" selected>Select category</option>
          <?php
          foreach($categoryList as $key => $value){ ?>
          <option value="<?php echo $key ?>"><?php echo $value ?></option>
          <?php } ?>
        </select>
        <div class="staff_popup_button_input">
          <input class="name-input" type="file" name="staffpic" id="editstaffImage">
          <input class="name-input" placeholder="Enter full name" id="editstaffName" name="staff_name">
          <input type="hidden" id="staffID" />
          <div class="hospital_facilities"> <a href="javascript:void(0)" class="save" id="staffEdit">Update</a></div>
        </div>
      </div>
    </div>
    <div class="content_right_patients_box" ng-init="showData()">
      <div class="row">
        <p ng-show="datailslists.length == 0">No Record Found</p>
        <div class="col-md-4" ng-repeat="item in datailslists | limitTo: paginationLimit()" flex="3">
          <div class="content_right_patients_box_bg staff_box_bg_button"> <img class="img-circle" src="<?php echo base_url()?>{{item.staff_pic  || 'no-profileimage.png' }}"> <span>{{item.staff_name}}</span>
            <h2>{{item.staff_cat_name}}</h2>
            <a href="#inline4" id="deleteStaff"  class="fancybox" staffid="{{item.ID}}"><i class="fa fa-trash-o"></i></a> <a href="#inline3" class="fancybox" id="staffDetails" staffid="{{item.ID}}"><i class="fa fa-pencil"></i></a></div>
        </div>
      </div>
      <a href="javascript:void(0)" class="content_right_patients_load_more" ng-show="hasMoreItemsToShow()" ng-click="showMoreItems()">load more</a> </div>
  </div>
</div>

<div id="inline4" style="width:300px;display: none;">
		<div class="popup_button_complete">
        	<h1>Are you Sure?</h1>
            <p>You want to detete.</p>
            <input type="hidden" id='staffdeleteid'/>
            <div class="popup_button_complete_button">
            	<a href="javascript:void(0)" id = "staffDelete" class="active">yes</a>
                <a href="javascript:void(0)" id = "cancelDelete" >no</a>
            </div>
        </div>
	</div>

<style>
.name-input {
margin-left: 65px;
margin-top: 20px;
}
.category-input {
  border: 1px solid #046676;
  height: 30px;
  width: 100%;
}
.save {
  margin-top: 35px;
}
</style>
