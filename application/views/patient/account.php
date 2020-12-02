<div class="col-md-10 container_padding_none">

    <div class="content_right_dashboard">
       <?php //if(isset($sucess)){?>
            <div class ="alert alert-success"><div class ="showMessage"><?php //echo $sucess; ?></div></div>
        <?php //} ?>
        <div class ="alert"><div class ="showMessage"></div></div>
            <div class="content_right_patients_titel">
                <h1>Account</h1>

            </div>
        <div class="content_right1_patients">
            <div class="appointments_width_block">

                <div class="settings_button_top_div">

                    <a href="#">notification</a>

                    <a href="/patient/account" class="password-setting">account</a> </div>

            </div>
        </div>
                <div class ="row account-set">
                    <div class="col-md-4 container_padding_none"></div>
                    <div class="col-md-6 container_padding_none">
                <div class="account">
                    <form id='UpdatePassword' method='POST' action=''  data-toggle = 'validator' >
                       
                        <input type ="hidden" name ="password-setting" value ="1" class="form-control"   />
                        <div class ="row">
                        
                            <div class ="col-sm-8">
                                <div class="form-group">
                                    <label for="comment">First Name</label>
                                    <input type ="text" name ="fname" class="form-control" value="<?php echo $patientprofile['fname'] ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Last Name</label>
                                    <input type ="text" name ="lname" class="form-control" value="<?php echo $patientprofile['lname'] ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Address</label>
                                    <input type ="text" name ="address" class="form-control" value="<?php echo $patientprofile['address'] ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="comment">City</label>
                                    <input type ="text" name ="city" class="form-control" value="<?php echo $patientprofile['city'] ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="comment">State</label>
                                    <input type ="text" name ="state" class="form-control" value="<?php echo $patientprofile['state'] ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Zip</label>
                                    <input type ="text" name ="zip" class="form-control" value="<?php echo $patientprofile['zip'] ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Phone</label>
                                    <input type ="text" name ="phone" class="form-control" value="<?php echo $patientprofile['phone'] ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Email</label>
                                    <input type ="email" name ="email" class="form-control" value="<?php echo $patientprofile['email'] ?>"/>
                                </div>
                                 <button type ="submit" name ="save" class="btn btn-primary" id="patientupdate">Save</button>  
                        	</div>
                            
                        </div>
                    </form>
                </div>
            </div>
                    <div class="col-md-2"></div>
        </div>

    </div>
</div>
