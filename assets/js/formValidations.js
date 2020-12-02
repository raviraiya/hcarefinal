
$(document).ready(function() {

        var $sections = $('.select_procedure_slider_background');

        function navigateTo(index) {
            // Mark the current section with the class 'current'
            $sections
                .removeClass('current')
                .eq(index)
                .addClass('current');
            // Show only the navigation buttons that make sense for the current section:
            $('.form-navigation .previous').toggle(index > 0);
            var atTheEnd = index >= $sections.length - 1;
            $('.form-navigation .next').toggle(!atTheEnd);
            $('.form-navigation [type=submit]').toggle(atTheEnd);
        }

        function curIndex() {
            // Return the current index by looking at which section has the class 'current'
            return $sections.index($sections.filter('.current'));
        }

        // Previous button is easy, just go back
        $('.form-navigation .previous').click(function() {
            navigateTo(curIndex() - 1);
        });

        // Next button goes forward iff current block validates
        $('.form-navigation .next').click(function() {
            if ($('#procedureCreate').parsley().validate({group: 'block-' + curIndex()}))
                navigateTo(curIndex() + 1);
        });

        // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
        $sections.each(function(index, section) {
            $(section).find(':input').attr('data-parsley-group', 'block-' + index);
        });
        navigateTo(0); // Start at the beginning





//            $('#signupForm').validator().on('submit', function (e) {
//                if (e.isDefaultPrevented()) {
//                    // handle the invalid form...
//                } else {
//                    // everything looks good!
//                }
//            })
//
//
//    $('#procedureCreate').validator().on('submit', function (e) {
//        if (e.isDefaultPrevented()) {
//            // handle the invalid form...
//        } else {
//            // everything looks good!
//        }
//    })
//
//
//    $('#signupFormss').validator().on('submit', function (e) {
//        if (e.isDefaultPrevented()) {
//            // handle the invalid form...
//        } else {
//            // everything looks good!
//        }
//    })


//    $("#signupForms").validate({
//        rules: {
//            username: "required",
//            password: "required",
//            username: {
//                required: true
//            },
//            password: {
//                required: true
//            }
//        },
//        messages: {
//            username: {
//                required: "Please enter username"
//            },
//            password: {
//                required: "Please enter password"
//            }
//        }
//    });
//
//    $("#registerForm").validate({
//        rules: {
//            username: {
//                required: true
//            },
//            password: {
//                required: true
//            },email: {
//                required: true,
//                email: true
//            },
//            fname: {
//                required: true
//            },lname: {
//                required: true
//            },usertype: {
//                required: true
//            }
//        },
//        messages: {
//            username: {
//                required: "Please enter username"
//            },
//            password: {
//                required: "Please enter password"
//            },email: {
//                required: "Please enter email"
//            },
//            fname: {
//                required: "Please enter First name"
//            },lname: {
//                required: "Please enter last name"
//            },
//            usertype: {
//                required: "Please enter User Type"
//            }
//        }
//    });
//
//    $("#AdminLogin").validate({
//        rules: {
//            username: "required",
//            password: "required",
//            username: {
//                required: true
//            },
//            password: {
//                required: true
//            },email: {
//                required: true,
//                email: true
//            }
//        },
//        messages: {
//            username: {
//                required: "Please enter username"
//            },
//            password: {
//                required: "Please enter password"
//            }
//        }
//    });
//
//    $("#AdminAdd").validate({
//        rules: {
//            username: {
//                required: true
//            },
//            password: {
//                required: true
//            },email: {
//                required: true,
//                email: true
//            }
//        },
//        messages: {
//            username: {
//                required: "Please enter username"
//            },
//            password: {
//                required: "Please enter password"
//            },email: {
//                required: "Please enter email"
//            }
//        }
//    });
//
//
//    $("#AddHospital").validate({
//        rules: {
//            name: {
//                required: true
//            },desc: {
//                required: true
//            },
//            'monhour[]': {
//                required: true,
//                minlength: 1
//            },'tueshour[]': {
//                required: true,
//                minlength: 1
//            },'wedhour[]':{
//                required: true,
//                minlength: 1
//            },'thuhour[]':{
//                required: true,
//                minlength: 1
//            },'fridhour[]' :{
//                required: true,
//                minlength: 1
//            },'sathour[]' :{
//                required: true,
//                minlength: 1
//            },'sunhour[]':{
//                required: true,
//                minlength: 1
//            }
//        },
//        messages: {
//            name: {
//                required: "Please enter hospital name"
//            },
//            desc: {
//                required: "Please enter hospital Description"
//            },
//            'monhour[]':{
//                required: "Please add you working hours"
//            } ,
//           'tueshour[]':{
//                    required: "Please add you working hours"
//            },'wedhour[]':{
//                required: "Please add you working hours"
//            },'thuhour[]':{
//                required: "Please add you working hours"
//            },'fridhour[]' :{
//                required: "Please add you working hours"
//            },'sathour[]':{
//                required: "Please add you working hours"
//            }, 'sunhour[]':{
//                required: "Please add you working hours"
//            }
//        }
//    });
//
//    $("#addMedicalHistory").validate({
//        rules: {
//           'history_type[]':{
//                required: true,
//               minlength: 1
//            },historytitle:{
//                required: true
//            }
//        },
//        messages: {
//           'history_type[]':{
//                required: "Please enter history type"
//            },historytitle:{
//                required: "Please enter history title"
//            }
//        }
//    });
//
//    $("#addPatient").validate({
//        rules: {
//            username: {
//                required: true
//            },
//            email: {
//                required: true,
//                email: true
//            },phone: {
//                required: true
//            }
//        },
//        messages: {
//            username: {
//                required: "Please enter username"
//            },
//           email: {
//                required: "Please enter email"
//            },phone: {
//                required: "Please enter phone"
//            }
//        }
//    });
//
//
//
//    $('.saveBtn').hide();
//    $('.checknext').click(function(){
//        var form = $("#addProcedure");
//        form.validate({
//            rules: {
//                procedure_cat_id: {
//                    required: true
//                },
//                procedure_name: {
//                    required: true
//                },no_of_appt: {
//                    required: true
//                },'appointment_date[]':{
//                    required: true
//                }
//            },
//            messages: {
//                procedure_cat_id: {
//                    required: "Please enter Procedure Category"
//                },
//                procedure_name: {
//                    required: "Please enter procedure name"
//                },no_of_appt: {
//                    required: "Please enter no of appointment"
//                },'appointment_date[]':{
//                    required: "Please enter date"
//                }
//            }
//        });
//        if (form.valid() === true){
//            $(this).hide();
//            $('.saveBtn').show();
//            $('#tab2').show();
//            $('#tab1').hide();
//        }
//    })
//
//    $('.PreviousClick').click(function(){
//        $('.checknext').removeClass('nextActive').show();
//        $('.saveBtn').hide();
//    })
//
//
//    $("#ProcedureCat").validate({
//        rules: {
//            category_name: {
//                required: true
//            }
//        },
//        messages: {
//            category_name: {
//                required: "Please enter Procedure category name"
//            }
//        }
//    });
//
//
//    $("#addSpecialist").validate({
//        rules: {
//            name: {
//                required: true
//            },
//            email: {
//                required: true,
//                email: true
//            },password: {
//                required: true
//            },licence_no:{
//                required: true
//            }
//        },
//        messages: {
//            username: {
//                required: "Please enter username"
//            },
//            email: {
//                required: "Please enter email"
//            },password: {
//                required: "Please enter password"
//            },licence_no:{
//                required: "Please enter licence no"
//            }
//        }
//    });
//
//    $("#staff").validate({
//        rules: {
//            staff_name: {
//                required: true
//            }
//        },
//        messages: {
//            staff_name: {
//                required: "Please enter staff name"
//            }
//
//        }
//    });
//
//    $("#staff_cat").validate({
//        rules: {
//            staff_cat_name: {
//                required: true
//            }
//        },
//        messages: {
//            staff_cat_name: {
//                required: "Please enter staff category name"
//            }
//
//        }
//    });
//
//    $("#AdminAddUser").validate({
//        rules: {
//            username: {
//                required: true
//            },
//            password: {
//                required: true
//            },passconf:{
//                required: true,
//                equalTo: "#password"
//            },
//            email: {
//                required: true,
//                email: true
//            },
//            fname: {
//                required: true
//            },lname: {
//                required: true
//            },usertype: {
//                required: true
//            }
//        },
//        messages: {
//            username: {
//                required: "Please enter username"
//            },
//            password: {
//                required: "Please enter password"
//            },passconf:{
//                required: "Please retype your password",
//                equalTo: "Please enter the same password as above"
//            },email: {
//                    required: "Please enter email"
//                }, fname: {
//                required: "Please enter First name"
//            },lname: {
//                required: "Please enter last name"
//            },
//            usertype: {
//                required: "Please enter User Type"
//            }
//        }
//    });
//
//    $("#spAdvice").validate({
//        rules: {
//            date: {
//                required: true
//            },
//            advice: {
//                required: true
//            }
//        },
//        messages: {
//            date: {
//                required: "Please enter date"
//            },
//            advice: {
//                required: "Please enter advice"
//            }
//        }
//    });
//
//    $("#bookSpecialists").validate({
//        rules: {
//            date: {
//                required: true
//            },
//            patient_id: {
//                required: true
//            }
//        },
//        messages: {
//            date: {
//                required: "Please enter date"
//            },
//            patient_id: {
//                required: "Please select patient"
//            }
//        }
//    });
//
//    $("#spCancelBooking").validate({
//        rules: {
//            date: {
//                required: true
//            }
//       },
//        messages: {
//            date: {
//                required: "Please enter date"
//            }
//        }
//    });
//
//    $("#MyprocedureEdit").validate({
//        rules: {
//            'appointment_date[]': {
//                required: true
//            },appointment_date_from:{
//                required: true
//            },appointment_date_to:{
//                required: true
//            }
//        },
//        messages: {
//        'appointment_date[]': {
//                required: "Please enter Appointment date"
//            },appointment_date_from:{
//                required: "Please enter Appointment date from"
//            },appointment_date_to:{
//                required: "Please enter Appointment date to"
//            }
//        }
//    });
//
//    $("#HomephysicanAdd").validate({
//        rules: {
//            name: {
//                required: true
//            },
//            licence_no: {
//                required: true
//            },email: {
//                required: true,
//                email: true
//            },
//            phone: {
//                required: true
//            }
//        },
//        messages: {
//            name: {
//                required: "Please enter name"
//            },
//            licence_no: {
//                required: "Please enter licence no"
//            },phone: {
//                required: "Please enter phone"
//            },email:{
//                required: "Please enter email"
//            }
//
//        }
//    });
//    $("#patient_invite").validate({
//        rules: {
//            patientfname: {
//                required: true
//            },
//            patientlname: {
//                required: true
//            },email: {
//                required: true,
//                email: true
//            }
//
//        },
//        messages: {
//            patientfname: {
//                required: "Please enter patient first name"
//            },
//            patientlname: {
//                required: "Please enter patient last name"
//            },email:{
//                required: "Please enter email"
//            }
//
//        }
//    });
//
//    $("#ptAdvice").validate({
//        rules: {
//            advice: {
//                required: true
//            }
//        },
//        messages: {
//            advice: {
//                required: "Please enter Advice"
//            }
//        }
//    });
//    $("#HomephysicanRecommendation").validate({
//        rules: {
//            patient_id: {
//                required: true
//            },
//            procedure_cat_id: {
//                required: true
//            }
//        },
//        messages: {
//            patient_id: {
//                required: "Please select patient"
//            },
//            procedure_cat_id: {
//                required: "Please select procedure category"
//            }
//
//        }
//    });
//
//    $("#procedure_search").validate({
//        rules: {
//            procedure_name: {
//                required: true
//            },
//            procedure_cat_id: {
//                required: true
//            }
//        },
//        messages: {
//            procedure_name: {
//                required: "Please enter procedure name"
//            },
//            procedure_cat_id: {
//                required: "Please select procedure category"
//            }
//
//        }
//    });
//
//    $("#specialist_setting").validate({
//        rules: {
//            password: {
//                required: true
//            },new_password:{
//                required: true
//            },
//            confirm_password: {
//                required: true,
//                equalTo: "#new_password"
//            }
//        },
//        messages: {
//
//            password: {
//                required: "Please enter password"
//            },new_password:{
//                required: "Please enter your new password"
//            },confirm_password: {
//                required: "Please enter password",
//                equalTo: "Please enter the same password as above"
//            }
//        }
//    });
//    $("#notification_options").validate({
//        rules: {
//            notification: {
//                required: true,
//                minlength: 1
//            }
//        },
//        messages: {
//            notification: {
//                required: "Please select notification type"
//            }
//        }
//    });
//
//    $("#accept_invite").validate({
//        rules: {
//            password: {
//                required: true,
//                minlength: 1
//            },passconf: {
//                required: true,
//                equalTo: "#password"
//            },email: {
//                required: true,
//                email: true
//            }
//        },
//        messages: {
//            password: {
//                required: "Please enter password"
//            },passconf: {
//                required: "Please enter password",
//                equalTo: "Please enter the same password as above"
//            },email:{
//                required: "Please enter email"
//            }
//        }
//    });

});
