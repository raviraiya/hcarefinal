<div class="container login-wrapper">
    <div class="alert">
        <div class ="showMessage"></div>
    </div>

    <?php if (validation_errors() != "") {
        echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
    }?>
    <div class ="row">
        <div class ="col-sm-3"></div>
        <div class ="col-sm-6">
            <?php
            if(!empty($success)){
                echo '<div class="alert alert-success">'.$success.'</div>';
            }
            if(!empty($error)){
                echo '<div class="alert alert-danger">'.$error.'</div>';
            }
            ?>
            <div class="login-widget">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="pull-left">
                            <h3>forgot password</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php
                        $attribute= array('data-validate'=>"parsley" ,"novalidate"=>"" ,'id' => 'forgotForm', 'data-toggle' =>'validator', 'role' =>"form");
                        echo form_open('login/forgetpassword',$attribute); ?>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" placeholder="Email" name="email" required class="form-control input-sm parsley-validated bounceIn animation-delay4" data-required="true" data-required-message="User Name is required">
                        </div>
                        <div class="seperator"></div>
                        <hr/>
                        <button type="submit" class="btn btn-success btn-sm bounceIn animation-delay5 pull-right"><i class="fa fa-sign-in"></i> Submit</button>
                        </form>
                    </div>
                </div>
            </div><!-- /panel -->
        </div><!-- /login-widget -->
        <div class ="col-sm-3"></div>
    </div>
</div><!-- /login-wrapper -->


