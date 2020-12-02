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
                <th><div class='procedureheading'>Procedure</div></th>
                <th> <div class='procedureheading'>Icon</div></th>
                  <th> <div class='procedureheading'>Action</div></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($procedure as $key => $value){?>
              <tr>
                <th><div class='procedureheading'><?php echo $value->category_name ?></div></th>
                <td><div class='procedureheading'><?php echo $value->procedure_name ?></div></td>
                <td><div class='procedureheading'> 
                <a href="#inline2" class="fancybox procedureedit topclr" id="masterprocedureedit" pKey="<?php echo $value->ID ?>" pcatid="<?php echo $value->procedure_cat_id ?>">
                <i class="fa fa-pencil"></i>Edit</a></div></td>
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
    <h1>Edit Procedure Details</h1>
    <div class="staff_popup_button_input">
      <select class="admin_procedure" id="editprocedureCategory" name="prosecure_category">
          <option value="" selected>Select category</option>
          <?php
          foreach($categoryList as $key => $value){ ?>
          	<option value="<?php echo $value->ID ?>"><?php echo $value->category_name ?></option>
          <?php
          }
          ?>
        </select>
      <input class="name-input" placeholder="Enter procedure name" id="editprocedureName" name="procedure_name">
      <input type="hidden" id="mastercategoryID" value=''/>
      <div class="hospital_facilities"> <a href="javascript:void(0)" class="save" id="procedureEdit">Update</a></div>
    </div>
  </div>
</div>



<div id="inline1" style="width:300px;display: none;">
  <div class="staff_popup_button_complete">
    <h1>Add Procedure Details</h1>
    <div class="staff_popup_button_input">
     <select class="admin_procedure" id="addprocedureCategory" name="prosecure_category">
          <option value="" selected>Select category</option>
          <?php
          foreach($categoryList as $key => $value){ ?>
          <option value="<?php echo $value->ID ?>"><?php echo $value->category_name ?></option>
          <?php
          }
          ?>
        </select>
      <input class="name-input" placeholder="Enter procedure name" id="addprocedureName" name="procedure_name">
      <div class="hospital_facilities"> <a href="javascript:void(0)" class="save" id="procedureAdd">Add</a></div>
    </div>
  </div>
</div>
