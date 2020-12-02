<style>
.today {
	border-bottom:1px solid #CCC
}
</style>
<div class="col-md-10 container_padding_none">
  <div class="content_right_dashboard" >
    <div class="content_right_patients_titel">
      <h1>Procedure Category</h1>
    </div>
    <div class="content_right_appointments_box">
      <center>
        <div style="height:10%" class=" ">
          <div class="btnClassReminder">
          <a href="#inline1" class="fancybox btn-addprocedure-hser" id="procedureadd" >Add</a>
            <!--<input type="button" value="Add" class="btn-addprocedure-hser">-->
          </div>
        </div>
        <div class="" style="width:70%;margin:30px auto">
          <table class="table table-bordered table-hover">
            <thead class="thead-inverse">
              <tr>
                <th><div class='procedureheading'>Category</div></th>
                <th> <div class='procedureheading'>Icon</div></th>
                    <th> <div class='procedureheading'>Action</div></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($procedures as $key => $procedure){?>
              <tr>
                <th><div class='procedureheading'><?php echo $procedure->category_name ?></div></th>
                <td><div class='procedureheading'><img src="<?php echo $procedure->icon ?>" alt="image" /></div></td>
                <td><div class='procedureheading'> <a href="#inline2" class="fancybox procedureedit topclr" id="procedureedit" pKey="<?php echo $procedure->ID ?>"><i class="fa fa-pencil"></i>Edit</a></div></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </center>
    </div>
  </div>
</div>
<div id="inline2" style="width:300px;display: none;">
  <div class="staff_popup_button_complete">
    <h1>Edit Category Details</h1>
    <div class="staff_popup_button_input">
      <input class="name-input" placeholder="Enter category name" id="editcategoryName" name="category_name">
      <input class="name-input" type="file" name="categorypic" id="editcategoryImage">
      <input type="hidden" id="categoryID" />
      <div class="hospital_facilities"> <a href="javascript:void(0)" class="save" id="categoryEdit">Update</a></div>
    </div>
  </div>
</div>
<div id="inline1" style="width:300px;display: none;">
  <div class="staff_popup_button_complete">
    <h1>Add Category Details</h1>
    <div class="staff_popup_button_input">
      <input class="name-input" placeholder="Enter category name" id="addcategoryName" name="category_name">
      <input class="name-input" type="file" name="categorypic" id="addcategoryImage">
      <div class="hospital_facilities"> <a href="javascript:void(0)" class="save" id="categoryAdd">Add</a></div>
    </div>
  </div>
</div>
