<div class="col-md-10 container_padding_none">

    <div class="content_right_dashboard">
       <?php if(isset($sucess)){?>
            <div class ="alert alert-success"><div class ="showMessage"><?php echo $sucess; ?></div></div>
        <?php } ?>
        <div class ="alert"><div class ="showMessage"></div></div>
            <div class="content_right_patients_titel">
                <h1>Account</h1>

            </div>
        <div class="content_right1_patients">
            <div class="appointments_width_block">

                <div class="settings_button_top_div">

                    <a href="<?php echo base_url()?>specialist/settings">profile</a>

                    <a href="#">notification</a>

                    <a href="/specialist/account" class="password-setting">account</a> </div>

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
                                    <label for="comment">Old Password</label>
                                    <input type ="password" name ="password" class="form-control checkpass"/>
                                </div>
                                <div class="form-group">
                                    <label for="comment">New Password</label>
                                    <input type ="password" name ="new_password" class="form-control checkpasstype new_pass"/>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Confirm New Password</label>
                                    <input type ="password" name ="confirm_password" class="form-control checkpasstype checkBothPass"/>
                                </div>
                                 <button type ="submit" name ="save" class="btn btn-primary" id="SavePasswordsd">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
                    <div class="col-md-2"></div>
        </div>

    </div>
</div>
















