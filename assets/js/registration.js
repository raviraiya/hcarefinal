// JavaScript Document
var baseUrl =  get_base_url();

jQuery(document).ready(function(e) {

    jQuery(document).on('click', '#sregister', function(e){
        e.preventDefault();

        var fname = jQuery("input[name='fname']").val();

        var lname = jQuery("input[name='lname']").val();

        var name = jQuery("input[name='name']").val();

        var email = jQuery("input[name='email']").val();

        var password = jQuery("input[name='password']").val();

        var repassword = jQuery("input[name='repassword']").val();

        jQuery.ajax({

            url: baseUrl+'signup/specialist',

            data: {'fname':fname,'lname':lname,'name' : name, 'email': email, 'password': password, 'repassword': repassword},

            type: "POST",

            catche : false,

            dataType : "json",

            success : function(response){

                console.log(response);

                if(response.success == 1){

                    window.location.replace( response.redirect);

                    //window.location = response.redirect;

                    //window.lcoation=response.redirect;

                    //window.location.assign(response.redirect)

                    //bootbox.alert(response.message, function() {

                    //window.location.reload();

                    //});

                }else if(response.error == 1){

                    jQuery("#verror").html(response.message).css('display','block');

                }

            }

        });
    });

    jQuery(document).on('click', '#hpregister', function(e){
        e.preventDefault();

        var fname = jQuery("input[name='fname']").val();

        var lname = jQuery("input[name='lname']").val();

        var name = jQuery("input[name='name']").val();

        var email = jQuery("input[name='email']").val();

        var password = jQuery("input[name='password']").val();

        var repassword = jQuery("input[name='repassword']").val();

        jQuery.ajax({

            url: baseUrl+'signup/homephysician',

            data: {'fname':fname,'lname':lname,'name' : name, 'email': email, 'password': password, 'repassword': repassword},

            type: "POST",

            catche : false,

            dataType : "json",

            success : function(response){

                if(response.success == 1){

                    bootbox.alert(response.message, function() {

                        window.location.reload();

                    });

                }else if(response.error == 1){

                    jQuery("#verror").text(response.message).css('display','block');

                }

            }

        });
    });

    jQuery(document).on('click', '#signin', function(e){
        e.preventDefault();

        var appform = $('#appLogin').serialize();

        jQuery.ajax({

            url: baseUrl+'login',

            data: {'formdata' : appform},

            type: "POST",

            catche : false,

            dataType : "json",

            success : function(response){
                console.log(response);
                if(response.success == 1){

                    window.location.replace(baseUrl+response.replaceurl);

                }else if(response.error == 1){

                    var html = "<strong>"+response.message+"</strong>";

                    jQuery("#verror").html(html).css('display','block');

                }

            },

            error : function(response){

                // console.log(response);

            }

        });
    });

    jQuery(document).on('click', '#resetPassword', function(e){
        e.preventDefault();

        var reset_pass = $('#reset_password').val().trim();
        var confirm_reset_pass = $('#confrm_reset_password').val().trim();
        
        if(reset_pass=='' || typeof reset_pass=='undefined')
        {   
            var msg = "Please First Fill value in Password Field";
            $('.pass_err').html(msg);
            return false;
        }

        if(reset_pass.length < 6){
            var msg = "Password Length must be Minimum 6 latters";
            $('.pass_err').html(msg);
            return false;
        }

        if (!reset_pass.match(/([!,%,&,@,#,$,^,*,?,_,~])/)){
            var msg = "Password Must Contain atleast 1 special character";
            $('.pass_err').html(msg);
            return false;
        }

        if(confirm_reset_pass=='' || typeof confirm_reset_pass=='undefined')
        {   
            var msg = "Please First Fill value in Confirm Password Field";
            $('.conf_pass_err').html(msg);
            return false;
        }

        if(reset_pass!=confirm_reset_pass)
        {   
            var msg = "Confirm Password not matches with Password";
            $('.pass_err').html(msg);
            $('.conf_pass_err').html(msg);
            return false;
        }
        
        $('.pass_err').html('');
        $('.conf_pass_err').html('');
        
        var appform = $('#appResetPassword').serialize();

        jQuery.ajax({

            url: baseUrl+'login/updatePassword',

            data: {'formdata' : appform},

            type: "POST",

            catche : false,

            dataType : "json",

            success : function(response){
                console.log(response);
                if(response.success == 1){

                    window.location.href = baseUrl+'login';

                }else if(response.error == 1){

                    var html = "<strong>"+response.message+"</strong>";

                    jQuery("#verror").html(html).css('display','block');

                }

            },

            error : function(response){

                // console.log(response);

            }

        });
    });

    jQuery(document).on('click', '#adminresetPassword', function(e){
        e.preventDefault();

        var reset_pass = $('#reset_password').val().trim();
        var confirm_reset_pass = $('#confrm_reset_password').val().trim();
        
        if(reset_pass=='' || typeof reset_pass=='undefined')
        {   
            var msg = "Please First Fill value in Password Field";
            $('.pass_err').html(msg);
            return false;
        }

        if(reset_pass.length < 6){
            var msg = "Password Length must be Minimum 6 latters";
            $('.pass_err').html(msg);
            return false;
        }

        if (!reset_pass.match(/([!,%,&,@,#,$,^,*,?,_,~])/)){
            var msg = "Password Must Contain atleast 1 special character";
            $('.pass_err').html(msg);
            return false;
        }

        if(confirm_reset_pass=='' || typeof confirm_reset_pass=='undefined')
        {   
            var msg = "Please First Fill value in Confirm Password Field";
            $('.conf_pass_err').html(msg);
            return false;
        }

        if(reset_pass!=confirm_reset_pass)
        {   
            var msg = "Confirm Password not matches with Password";
            $('.pass_err').html(msg);
            $('.conf_pass_err').html(msg);
            return false;
        }
        
        $('.pass_err').html('');
        $('.conf_pass_err').html('');
        
        var appform = $('#appResetPassword').serialize();

        jQuery.ajax({

            url: baseUrl+'admin/updatePassword',

            data: {'formdata' : appform},

            type: "POST",

            catche : false,

            dataType : "json",

            success : function(response){
                console.log(response);
                if(response.success == 1){

                    window.location.href = baseUrl+'admin';

                }else if(response.error == 1){

                    var html = "<strong>"+response.message+"</strong>";

                    jQuery("#verror").html(html).css('display','block');

                }

            },

            error : function(response){

                // console.log(response);

            }

        });
    }); 

    jQuery(document).on('click', '#new-signup', function(e){
        e.preventDefault();

        var uname = $('#uname').val().trim();
        var email = $('#email').val().trim();
        var role = $('#sign_up_roles').val().trim();
        var reset_pass = $('#password').val().trim();
        var confirm_reset_pass = $('#confrm_reset_password').val().trim();
        
        if(uname=='' || typeof uname=='undefined'){   
            var msg = "Please First Fill value in Username Field";
            $('.uname_err').html(msg);
            return false;
        }else{
            jQuery.ajax({
                url: baseUrl+'login/unameExistance',
                data: {'username' : uname},
                type: "POST",
                catche : false,
                dataType : "json",
                success : function(response){                    
                    if(response.error == 1){
                        var msg = "This Username already taken by Some one.";
                        $('.uname_err').html(msg);
                        return false;
                    }
                },
                error : function(response){
                    var msg = "Something went wrong";
                    $('.uname_err').html(msg);
                    return false;
                }
            });
        }

        if(email=='' || typeof email=='undefined'){
            var msg = "Please First Fill value in Email Field";
            $('.email_err').html(msg);
            return false; 
        }else{
            if( !isValidEmailAddress( email ) ) {
                var msg = "Please Fill Correct Format of Email Field";
                $('.email_err').html(msg);
                return false;  
            }else{
                jQuery.ajax({
                    url: baseUrl+'login/uemailExistance',
                    data: {'email' : email},
                    type: "POST",
                    catche : false,
                    dataType : "json",
                    success : function(response){                    
                        if(response.error == 1){
                            var msg = "This Email Id already in Use.";
                            $('.email_err').html(msg);
                            return false;
                        }
                    },
                    error : function(response){
                        var msg = "Something went wrong";
                        $('.email_err').html(msg);
                        return false;
                    }
                });
            }
        }

        if(role=='' || typeof role=='undefined'){
            var msg = "Please First Select Role Field";
            $('.roles_err').html(msg);
            return false; 
        }

        if(reset_pass=='' || typeof reset_pass=='undefined')
        {   
            var msg = "Please First Fill value in Password Field";
            $('.pass_err').html(msg);
            return false;
        }

        if(reset_pass.length < 6){
            var msg = "Password Length must be Minimum 6 latters";
            $('.pass_err').html(msg);
            return false;
        }

        if (!reset_pass.match(/([!,%,&,@,#,$,^,*,?,_,~])/)){
            alert(reset_pass);
            var msg = "Password Must Contain atleast 1 special character";
            $('.pass_err').html(msg);
            return false;
        }

        if(confirm_reset_pass=='' || typeof confirm_reset_pass=='undefined')
        {   
            var msg = "Please First Fill value in Confirm Password Field";
            $('.conf_pass_err').html(msg);
            return false;
        }

        if(reset_pass!=confirm_reset_pass)
        {   
            var msg = "Confirm Password not matches with Password";
            $('.pass_err').html(msg);
            $('.conf_pass_err').html(msg);
            return false;
        }
        
        $('.pass_err').html('');
        $('.conf_pass_err').html('');
        
        var appform = $('#appsignup').serialize();

        jQuery.ajax({

            url: baseUrl+'login/registration',

            data: {'formdata' : appform},

            type: "POST",

            catche : false,

            dataType : "json",

            success : function(response){
                console.log(response);
                if(response.success == 1){

                    window.location.href = baseUrl+'login';

                }else if(response.error == 1){

                    var html = "<strong>"+response.message+"</strong>";

                    jQuery("#vserror").html(html).css('display','block');

                }

            },

            error : function(response){

                // console.log(response);

            }

        });
    });

    jQuery(document).on('click', '#admin_signin', function(e){
        e.preventDefault();

        var name = jQuery("input[name='username']").val();

        var password = jQuery("input[name='password']").val();

        // var booking = jQuery("input[name='booking']").val();

        jQuery.ajax({

            url: baseUrl+'admin/login',

            data: {'username' : name, 'password': password},

            type: "POST",

            catche : false,

            dataType : "json",

            success : function(response){

                if(response.success == 1){

                    window.location.replace(baseUrl+response.replaceurl);

                }else if(response.error == 1){

                    var html = "<strong>"+response.message+"</strong>";

                    jQuery("#verror").html(html).css('display','block');

                }

            }

        });
    });

    jQuery("#txtpassword").on("keypress", function(e){
        var code = (e.keyCode ? e.keyCode : e.which);

        if (code == 13) {

            e.preventDefault();

            e.stopPropagation();

            var appform = $('#appLogin').serialize();

            if(appform != ''){

                    jQuery.ajax({

                        url: baseUrl+'login',

                        data: {'formdata' : appform},

                        type: "POST",

                        catche : false,

                        dataType : "json",

                        success : function(response){

                            if(response.success == 1){

                                window.location.replace(baseUrl+response.replaceurl);

                            }else if(response.error == 1){

                                var html = "<strong>"+response.message+"</strong>";

                                jQuery("#verror").html(html).css('display','block');

                            }

                        }

                    });

            }

        }
    });

    jQuery("#txtadminpassword").on("keypress", function(e){
        var code = (e.keyCode ? e.keyCode : e.which);

        if (code == 13) {

            e.preventDefault();

            e.stopPropagation();

            //var appform = $('#appLogin').serialize();

            var rememberme = 0;

            var name = jQuery("input[name='username']").val();

            var password = jQuery("input[name='password']").val();

            if ($('#sign_in_checkbox').is(":checked"))

            {

                rememberme = jQuery("input[type='checkbox']").val();

            }

            alert(rememberme);          

            

            if(name != '' && password != ''){

                    jQuery.ajax({

                        url: baseUrl+'admin/login',

                        data: {'username' : name, 'password': password, 'remember': rememberme},

                        type: "POST",

                        catche : false,

                        dataType : "json",

                        success : function(response){

                            if(response.success == 1){

                                window.location.replace(baseUrl+response.replaceurl);

                            }else if(response.error == 1){

                                var html = "<strong>"+response.message+"</strong>";

                                jQuery("#verror").html(html).css('display','block');

                            }

                        }

                    });

            }

        }
    }); 

    jQuery(document).on('click', '#forgotpassword', function(e){
        e.preventDefault();

        jQuery('#logindiv').hide();
        jQuery('#signupdiv').hide();
        jQuery('#forgotpassworddiv').show();
    });

    jQuery(document).on('click', '#login', function(e){
        e.preventDefault();

        jQuery('#logindiv').show();
        jQuery('#signupdiv').hide();
        jQuery('#forgotpassworddiv').hide();
    });

    jQuery(document).on('click', '#signup', function(e){
        e.preventDefault();

        jQuery('#logindiv').hide();
        jQuery('#signupdiv').show();
        jQuery('#forgotpassworddiv').hide();
    });

    jQuery(document).on('click', '#sendpassword', function(e){
        e.preventDefault();

        var email = jQuery("input[name='useremail']").val();

        jQuery.ajax({

            url: baseUrl+'login/forgot_password',

            data: {'email': email},

            type: "POST",

            catche : false,

            dataType : "json",

            success : function(response){

                if(response.success == 1){                   
                    
                    jQuery('#logindiv').show();
                    jQuery('#forgotpassworddiv').hide();
                    var html = "<strong>"+response.message+"</strong>";

                    jQuery("#vsuccess").html(html).css('display','block');
                    $("#appLogin").find("input[type=text]").val("");
                }else if(response.error == 1){

                    var html = "<strong>"+response.message+"</strong>";

                    jQuery("#fpverror").html(html).css('display','block');

                }

            }

        });
    });

    jQuery(document).on('click', '#sendAdminpassword', function(e){
        e.preventDefault();

        var email = jQuery("input[name='useremail']").val();

        jQuery.ajax({

            url: baseUrl+'admin/forgot_password',

            data: {'email': email},

            type: "POST",

            catche : false,

            dataType : "json",

            success : function(response){

                if(response.success == 1){                   
                    
                    jQuery('#logindiv').show();
                    jQuery('#forgotpassworddiv').hide();
                    var html = "<strong>"+response.message+"</strong>";

                    jQuery("#vsuccess").html(html).css('display','block');
                    $("#appLogin").find("input[type=text]").val("");
                }else if(response.error == 1){

                    var html = "<strong>"+response.message+"</strong>";

                    jQuery("#fpverror").html(html).css('display','block');

                }

            }

        });
    });

    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    }
});