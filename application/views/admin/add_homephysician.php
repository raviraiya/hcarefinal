<style>
.today {
	border-bottom:1px solid #CCC
}
.setheight{
    height:65%;   
}
.sp-lds{
        margin-top:120px;
     position: absolute;
}
.adminSpEdit, .changestats,.adminHomephyEdit{
    color:#046676;   
}
    
</style>
<div class="col-md-10 container_padding_none">
  <div class="content_right_dashboard" >
    <div class="content_right_patients_titel">
      <h1>Homephysician</h1>
    </div>
    <div class="content_right_appointments_box">
      <center>
        <div style="height:10%" class=" ">
          <div class="btnClassReminder">
          <a href="#" class="btn btn-info" data-toggle="modal" data-target="#myModal" >Add</a>
            <!--<input type="button" value="Add" class="btn-addprocedure-hser">-->
          </div>
        </div>
      </center>
    </div>
  </div>
          <table class="table table-bordered table-hover">
            <thead class="thead-inverse">
              <tr>
                <th><div class='procedureheading'>Username</div></th>
                <th> <div class='procedureheading'>First name</div></th>
                  <th> <div class='procedureheading'>Last name</div></th>
                  <th> <div class='procedureheading'>Email</div></th>
                 
                  <th> <div class='procedureheading'>Status</div></th>
                  <th> <div class='procedureheading'>Licence Verification</div></th>
                   <th> <div class='procedureheading'>Action</div></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($sp as $key => $value){?>
              <tr>
                <th><div class='procedureheading'><?php echo $value['name'] ?></div></th>
                <td><div class='procedureheading'><?php echo $value['fname'] ?></div></td>
                <td><div class='procedureheading'><?php echo $value['lname'] ?></div></td>
                <td><div class='procedureheading'><?php echo $value['email'] ?></div></td>
               
                  <td><div class='procedureheading'> 
                    <?php if($value['status'] == 1){ ?>  
                <a href="#" class="changestatsHhy btn btn-info" id="statssp" spID="<?php echo $value['ID'] ?>">
                Enable</a>
                  <?php }else{?>
                   <a href="#" class="changestatsHhy btn btn-info" id="statssp" spID="<?php echo $value['ID'] ?>">
                    Disable</a>
                  <?php }?>
                  </div></td>
                  <td><div class='procedureheading'> 
                    <?php if($value['licence_status'] == 1){
                                $dis = 'disabled';
                                ?>
                                <button type="button" class="verifyLicenceHphy btn btn-success" style ="background-color: #5cb85c !important;" id="checkLicence" spID="<?php echo $value['ID'] ?>" <?php echo $dis; ?>>verified</button>
                            <?php }else{
                                 $dis = '';
                                ?>
                          <button type="button" class="verifyLicenceHphy btn btn-info" id="checkLicence" spID="<?php echo $value['ID'] ?>" <?php echo $dis; ?>>verify</button>
                        <?php   
                            } 
                      ?>
                  
                
                  </div></td>
                   <td><div class='procedureheading'> 
                        <a href="#" class="adminHomephyEdit" id="adminSpEdit" spID="<?php echo $value['ID'] ?>">
                        <i class="fa fa-pencil"></i>Edit</a></div></td>
                  
                 <div class ="editablesp"></div>
              <?php }?>
            </tbody>
          </table>
</div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Homephysician </h4>
                </div>
                <p class="errorMessage alert"></p>
                <div class="modal-body">
                     <div class="container_padding_none">
                          <div class="content_sign_up_page_right setheight">
                            <div class="content_sign_up_page_table_right">
                              <div class="content_sign_up_page_cell_right">
                                <div class ="centerLoder" style ="text-align: center;"><img src ="<?php echo base_url() ?>/assets/image/gif-load.gif" class ="sp-lds"> </div>
                                   <form name ="adminaddsp" method ="post" action = "" id ="adminaddPatient">
                                    <input placeholder="Enter first name" type="text" name="fname" />
                                    <input placeholder="Enter last name" type="text" name="lname" />
                                    <input placeholder="Enter username" type="text" name="name" class ="urname" />
                                    <input placeholder="Enter email address" type="email" name="email" class ="email" />
                                    <input placeholder="Enter password" type="password" name="password" class ="pass checkpasstype new_pass"  />
                                    <input placeholder="Confirm password" type="password" name="repassword" class ="cfpass checkBothPass" />
                                <a href="javascript:void(0)" class="content_sign_up_submit adminaddHpy" id="adminaddPHY" style ="width: 86px;">submit</a> 
                                </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>