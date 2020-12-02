/**



 * Created with JetBrains PhpStorm.



 * User: Bigfoot3



 * Date: 3/18/16



 * Time: 9:56 AM



 * To change this template use File | Settings | File Templates.



 */



//var base_url= get_base_url();


$(document).ready(function() {



    //var base_url= window.location.origin;
    var base_url= get_base_url();
    //alert(base_url);

    var days=1;



    var appt=2;



    var staffid = 2;



    var day=1;



    var num =2;



    var  rowStaff = 1;



    $('.hideDefault').hide();



    $('.hideDefaultnext').hide();







    $('.bulk').click(function(){



         $('.showBulk').slideToggle();



    })







    var nowDate = new Date();



    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);







    $('.datepicker').datepicker({



        format: 'yyyy-mm-dd',



        startDate: today



    });







    $(".datepicker").on("change",function(){







       var  pDate= $(this).val();



        var temp = $('.showMessage');



         if(pDate < date){



             $('.alert').addClass('alert-danger').show();



             temp.text('Your date selection should be greater then current date');



             $('html, body').animate({



                 scrollTop: 0



             }, 800);



             return false;



         }







        url = base_url+'Ajax/check_hospital_holiday/';

        //alert(url);

        $.ajax({



            url: url,



            type:'POST',



            data: {code:pDate},



            success: function(data){



                var response = JSON.parse(data);



                if(response['message'] == "SUCCESS") {



                    $('.alert').addClass('alert-danger').show();



                    $('.showMessage').text('The date you selected is hospital holiday, please select some other date');



                    $('html, body').animate({



                        scrollTop: 0



                    }, 800);



                    return false;



                }else{



             $('.hideDefault').show();



//                        if(response['res'] != null){



                var listing = response['res'];



                $('.alert').hide();



                var items=[];



                $.each(hrs, function (index, item) {



                    if ($.inArray(item, listing) != -1){



                                    var list = '<div class="col-sm-1 time-select-div inactive btn-default day appointment active">'



                                                    +'<div class="timeslots">'



                                                        +'<div class="hour-row time_interval_15">' +'<div class="time-select-div space">' +'<div class="mns" data-toggle="buttons">' +



                                                            '<label class="btn btn-primary btn-size-cm active hrsCheck">' +



                                                                    '<input type="checkbox" checked name="hour'+days+'[]" class ="hrsEvent"  value="'+item+'">'+item+



                                                                        '</label>' +



                                                                    '</div> ' +



                                                                '</div>' +



                                                            '</div>' +



                                                        '</div>' +



                                                '</div>';



                                items.push(list);







                            }else{



                                var list = '<div class="col-sm-1 time-select-div inactive btn-default day appointment">' +



                                                '<div class="timeslots">' +



                                                    '<div class="hour-row time_interval_15">' +



                                                           '<div class="time-select-div space">' +



                                                                '<div class="mns" data-toggle="buttons">' +



                                                                    '<label class="btn btn-primary btn-size-cm hrsCheck">' +



                                                                         '<input type="checkbox"  name="hour'+days+'[]" class ="hrsEvent" autocomplete="off"  value="'+item+'">'+item+



                                                                    '</label>' +



                                                                '</div> ' +



                                                            '</div>' +



                                                        '</div>' +



                                                    '</div>' +



                                                '</div>';



                                items.push (list);



                            }







                    });



                        $(".hrsList").html(items.join(""));



                    days++;



                }



//                }



            }



        });







    });











    $('.datepickerBulk').datepicker({



        format: 'yyyy-mm-dd',



        startDate: today



    });



    $('.datepickerBulk2').datepicker({



        format: 'yyyy-mm-dd',



        startDate: today



    });







    $("#get").on("click",function(){



        var from = $('.datepickerBulk').val();



        var  to = $('.datepickerBulk2').val();







        if ($('#get').hasClass("clicked-once")) {



            $('.removeBulkSelection').remove();



        }



        else {



            $('#get').addClass("clicked-once");



        }











        var temp = $('.showMessage');



        url = base_url+'Ajax/get_bulk_hr_list/';



        $.ajax({



            url: url,



            type:'POST',



            data: {from:from ,to: to},



            success: function(data){



                var dates = JSON.parse(data);



                for(var i=0; i<dates.length;i++){



                    $('.removeBulkSelection').addClass("load_remove");



                    var newfield = '<div class ="removeBulkSelection"><div class="col-md-12"><div class="panel panel-default"><div class="panel-body"><div class="form-group"><div class="form-group col-xs-2"><input type="text" name="appointment_date[]" id ="datepick'+appt+'" value="'+dates[i]+'" class="datepicker form-control input-sm parsley-validated getDate" /></div><div class="row"><div id="appt'+appt+'"></div></div></div><a href="#" class="btn btn-default remove">Remove</a></div></div></div></div>';



                    $('#addedMoreAppt').append(newfield);







                    $("#datepick"+appt).datepicker({



                        format: 'yyyy-mm-dd',



                        startDate: '-3d'



                    });







                    $("#datepick"+appt).on("change",function(){



                        var devid =  $("#datepick"+appt).attr('id');



                        var appdivid=  devid.replace("datepick", "");



                        var pDate = $("#datepick"+appt).val();



                        var temp = $('.showMessage');



                        var dates = [];



                        var setCond = false;



                            url = base_url+'Ajax/check_hospital_holiday/';



                            $.ajax({



                                url: url,



                                type:'POST',



                                data: {code:pDate},



                                success: function(data){



                                    var response = JSON.parse(data);



                                    if(response['message'] == "SUCCESS") {



//                                        $('.alert').addClass('alert-danger').show();



//                                        $('.showMessage').text('The date you selected is hospital holiday, please select some other date');



//                                        return false;



                                    }else{



                                        $('.hideDefault').show();



                                        var listing = response['res'];



                                        $('.alert').hide();



                                        var items=[];



                                        $.each(hrs, function (index, item) {



                                            if ($.inArray(item, listing) != -1){



                                                var list = '</div><div class="col-sm-1 time-select-div inactive btn-default day appointment active">'



                                                    +'<div class="timeslots">'



                                                    +'<div class="hour-row time_interval_15">' +'<div class="time-select-div space">' +'<div class="mns" data-toggle="buttons">' +



                                                    '<label class="btn btn-primary btn-size-cm active">' +



                                                    '<input type="checkbox" checked name="hour'+days+'[]"   autocomplete="off" value="'+item+'"> '+item+



                                                    '</label>' +



                                                    '</div> ' +



                                                    '</div>' +



                                                    '</div>' +



                                                    '</div>' +



                                                    '</div>';



                                                items.push (list);







                                            }else{



                                                var list = '<div class="col-sm-1 time-select-div inactive btn-default day appointment">' +



                                                    '<div class="timeslots">' +



                                                    '<div class="hour-row time_interval_15">' +



                                                    '<div class="time-select-div space">' +



                                                    '<div class="mns" data-toggle="buttons">' +



                                                    '<label class="btn btn-primary btn-size-cm">' +



                                                    '<input type="checkbox" name="hour'+days+'[]"  autocomplete="off" value="'+item+'"> '+item+



                                                    '</label>' +



                                                    '</div> ' +



                                                    '</div>' +



                                                    '</div>' +



                                                    '</div>' +



                                                    '</div>';



                                                items.push (list);



                                            }



                                        });



                                        $('#appt'+appdivid).html(items.join(""));



                                        days++;



                                    }



                                }



                            });







                    });



                    $("#datepick"+appt).trigger( "change" );



                    appt++;



                }







            }



        });



        return false;



    });











    $('a#moreAppointments').on('click', function(){



        var newfield = '<div class="col-md-12"><div class="panel panel-default"><div class="panel-body"><div class="form-group"><div class="form-group col-xs-2"><label>Appointment Date<span class="fieldRequired">*</span></label><input type="text" name="appointment_date[]"  placeholder="Appointment Date" id ="datepick'+appt+'"  class="datepicker form-control input-sm parsley-validated getDate" /></div><div class="row"><div id="appt'+appt+'"></div></div></div><a href="#" class="btn btn-default remove">Remove</a></div></div></div>';



        $('#addedMoreAppt').append(newfield);







        $('.datepicker').datepicker({



            format: 'yyyy-mm-dd',



            startDate: '-3d'



        });







        $(".datepicker").on("change",function(){



            var devid =  $(this).attr('id');



            var appdivid=  devid.replace("datepick", "");



            var pDate = $(this).val();



            var temp = $('.showMessage');



            if(pDate < date){



                $('.alert').addClass('alert-danger').show();



                temp.text('Your date selection should be greater then current date');



                $('html, body').animate({



                    scrollTop: 0



                }, 800);



                return false;



            }



            var dates = [];



            var setCond = false;



            $( "input[name='appointment_date[]']" ).each(function() {



                if(jQuery.inArray(pDate, dates) != -1) {



                    $('.alert').addClass('alert-danger').show();



                    temp.text('date is already selected , please select other date');



                    if (setCond){



                        $('html, body').animate({



                            scrollTop: 0



                        }, 800);



                        return false;



                    }



                    setCond = true;



                }



                dates.push($(this).val());



            });







            if(setCond == false){



                url = base_url+'Ajax/check_hospital_holiday/';



                $.ajax({



                    url: url,



                    type:'POST',



                    data: {code:pDate},



                    success: function(data){



                        var response = JSON.parse(data);



                        if(response['message'] == "SUCCESS") {



                            $('.alert').addClass('alert-danger').show();



                            $('.showMessage').text('The date you selected is hospital holiday, please select some other date');



                            return false;



                        }else{



                            $('.hideDefault').show();



                            var listing = response['res'];



                            $('.alert').hide();



                            var items=[];



                            $.each(hrs, function (index, item) {



                                if ($.inArray(item, listing) != -1){



                                    var list = '</div><div class="col-sm-1 time-select-div inactive btn-default day appointment active">'



                                        +'<div class="timeslots">'



                                        +'<div class="hour-row time_interval_15">' +'<div class="time-select-div space">' +'<div class="mns" data-toggle="buttons">' +



                                        '<label class="btn btn-primary btn-size-cm active">' +



                                        '<input type="checkbox" checked name="hour'+days+'[]"   autocomplete="off" value="'+item+'"> '+item+



                                        '</label>' +



                                        '</div> ' +



                                        '</div>' +



                                        '</div>' +



                                        '</div>' +



                                        '</div>';



                                    items.push (list);







                                }else{



                                    var list = '<div class="col-sm-1 time-select-div inactive btn-default day appointment">' +



                                        '<div class="timeslots">' +



                                        '<div class="hour-row time_interval_15">' +



                                        '<div class="time-select-div space">' +



                                        '<div class="mns" data-toggle="buttons">' +



                                        '<label class="btn btn-primary btn-size-cm">' +



                                        '<input type="checkbox" name="hour'+days+'[]"  autocomplete="off" value="'+item+'"> '+item+



                                        '</label>' +



                                        '</div> ' +



                                        '</div>' +



                                        '</div>' +



                                        '</div>' +



                                        '</div>';



                                    items.push (list);



                                }



                            });



                            $('#appt'+appdivid).html(items.join(""));



                            days++;



                        }



                        }



                    });



            }



        });



        appt++;



        return false;



    });







    $(document).on('click','.remove', function(){



        $(this).parent('div').remove();



        return false;



    });























    $(document).on('click','.removeStaffCatNameRow', function(){



        var rowID  = $(this).parents().attr('id');



        $('#'+rowID).remove();



        return false;



    });











    $(document).on('click','.removeSTAFF', function(){



        var rowID  = $('.removeRow').attr('id');



            $('#'+rowID).remove();



        return false;



    });







// ajax call for fetch staff data against staff catg







    $('.staffcatSelection').on( 'change', function() {
        var staffId =  $(this).attr('id');
        var staffIds=  staffId.replace("staffcat", "");
        var optVal =  $(this).val();
        if(optVal != ''){
            url = base_url+'/Ajax/get_staff_list_by_cat';
            $.ajax({
                url: url,
                type:'POST',
                data: {code:optVal},
                success: function(data){
                    var response = JSON.parse(data);
                    if(response['message'] == "SUCCESS") {
                        var list = response['cat'];
                        var opt = [];
                        opt += '<option value= "">Select Staff</option>';
                        $.each(list, function (index ,item) {
                             opt += '<option value='+  item['ID']+'>' +  item['staff_name']  + '</option>';
                        });
                        $('#staff'+staffIds).empty().append(opt);
                    }else{
                        var opt = [];
                        opt += '<option value= "">Select Staff</option>';
                        var temp = $('.showMessage');
                        $('#staff'+staffIds).empty().append(opt);
                        $('.alert').addClass('alert-danger').show();
                        temp.text('staff name not found');
                        /*$('html, body').animate({
                            scrollTop: 0
                        }, 800);*/
                        setTimeout(function(){
                            $('.alert-danger').slideToggle();
                        },4000);
                        return false;
                    }
                }
            });
        }
    });







    //var base_url= window.location.origin;


    // alert(base_url);
    var staff = $.ajax({type: "GET", url: base_url+"/Ajax/get_staff_name/", async: false}).responseText;







    var staffCat = $.ajax({type: "GET", url: base_url+"/Ajax/get_staff_cat/", async: false}).responseText;







    $('a#moreCategory').on('click', function(){







        var staffId =  $(this).attr('id');



        var staffId=  staffId.replace("staffcat", "");



        var newfield = [];



        var response = JSON.parse(staffCat);







        var staffs = JSON.parse(staff);



        var tableData = '<div class ="row staffCats createprocedure_step1_shape_staff" id ="staffRow'+rowStaff+'"><div id ="stafsss" class ="removeRow"><div class="form-group col-md-5"><div class="createprocedure_step1_select_staff select-style"><select name="staff_cat_id[]" id ="staffcat'+staffid+'" class="staffcatSelection">';



//            tableData += '<option value='+ index  +'></option>';



        $.each(response, function (index ,item) {



            tableData += '<option value='+ index  +'>' +item+ '</option>';



        });



        tableData +='</select></div></div></div>';



        tableData += '<div  class ="removeRow"><div class="form-group col-sm-5"><div class="createprocedure_step1_select_staff select-style"><select name="staff_name[]"  id ="staff'+staffid+'" class ="staffonChange">';



        $.each(staffs, function (index ,item) {



            tableData += '<option value='+ index  +'>' +item+



                '</option>';



        });



        tableData +='</select></div></div></div><a href="#" class="removeStaffCatNameRow createprocedure_step1_plus_staff"><i class="fa fa-minus"></i></a></div>';



        $("#addedMoreCatgeory").append(tableData);



        rowStaff++;



        staffid++;



        // ajax call for fetch staff data against staff catg











        return false;



    });























    // $('.btn').on( 'click', function() {

        

    //         if($(this).hasClass('active')){



    //             var date = ( $(this).parents('.row').prev().find('.datepickerEdit').val());



    //             var slot = $(this).parent().find('input').val();



    //             var ids = $(this).attr('id');



    //             var url = base_url+'/Ajax/change_time_slot_status';



    //             $.ajax({



    //                 url: url,



    //                 type:'POST',



    //                 data: {date:date, time : slot},



    //                 success: function(data){



    //                     var response = JSON.parse(data);



    //                     if(response['message'] == "availability changed") {



    //                         $('.alert').addClass('alert-success').show();



    //                         $('.showMessage').text('time slot is available');



    //                         $('html, body').animate({



    //                             scrollTop: 0



    //                         }, 800);



    //                         return false;



    //                     }else{



    //                         $('#'+ids).addClass('active');



    //                        $('.alert').addClass('alert-danger').show();



    //                        $('.showMessage').text('You can not change the time slot , appointment for this hour is completed , please choose some other slot');



    //                        $('html, body').animate({



    //                             scrollTop: 0



    //                         }, 800);



    //                         return false;



    //                     }



    //                 }



    //             });



    //         }else{







    //         }



    // });







/*



        display hrs data according to date in edit mode



 */







    $('.datepickerEdit').datepicker({



        format: 'yyyy-mm-dd',



        startDate: '-3d'



    });







    $(".datepickerEdit").on("change",function(){



        var  pDate= $(this).val();



        var temp = $('.showMessage');



        if(pDate < date){



            $('.alert').addClass('alert-danger').show();



            temp.text('Your date selection should be greater then current date');



            $('html, body').animate({



                scrollTop: 0



            }, 800);



            return false;



        }







        url = base_url+'Ajax/get_all_time_slot_list/';



        $.ajax({



            url: url,



            type:'POST',



            data: {code:pDate},



            success: function(data){



                var response = JSON.parse(data);



                if(response['message'] == "SUCCESS") {



                    $('.alert').addClass('alert-danger').show();



                    $('.showMessage').text('The date you selected is hospital holiday, please select some other date');



                    $('html, body').animate({



                        scrollTop: 0



                    }, 800);



                    return false;



                }else{



                    $('.hideDefault').show();



                    var listing = response['hrs'];



                    $('.alert').hide();



                    var items=[];



                    var id = 1;



                    $.each(hrs, function (index, item) {



                                if ($.inArray(item, listing) != -1){



                                    var list = '<div class="col-sm-1 time-select-div inactive btn-default day appointment active">'



                                        +'<div class="timeslots">'



                                        +'<div class="hour-row time_interval_15">' +'<div class="time-select-div space">' +'<div class="mns" data-toggle="buttons">' +



                                        '<label class="btn btn-primary btn-size-cm active hrsCheck" id ="input'+id+'">' +



                                        '<input type="checkbox" checked name="hour'+days+'[]" class ="hrsEvent"  value="'+item+'">'+item+



                                        '</label>' +



                                        '</div> ' +



                                        '</div>' +



                                        '</div>' +



                                        '</div>' +



                                        '</div>';



                                    items.push(list);



                                }



                        else{



                            var list = '<div class="col-sm-1 time-select-div inactive btn-default day appointment">' +



                                '<div class="timeslots">' +



                                '<div class="hour-row time_interval_15">' +



                                '<div class="time-select-div space">' +



                                '<div class="mns" data-toggle="buttons">' +



                                '<label class="btn btn-primary btn-size-cm hrsCheck" id ="input'+id+'">' +



                                '<input type="checkbox"  name="hour'+days+'[]" class ="hrsEvent" autocomplete="off"  value="'+item+'">'+item+



                                '</label>' +



                                '</div> ' +



                                '</div>' +



                                '</div>' +



                                '</div>' +



                                '</div>';



                            items.push (list);



                        }



                        id++;



                    });







                    $(".hrsList").html(items.join(""));



                    days++;







                }



            }



        });







    });











    $("#getEdit").on("click",function(){



        var from = $('.datepickerBulk').val();



        var  to = $('.datepickerBulk2').val();







        if ($('#getEdit').hasClass("clicked-once")) {



            $('.removeBulkSelection').remove();



        }



        else {



            $('#getEdit').addClass("clicked-once");



        }



        var temp = $('.showMessage');



        url = base_url+'Ajax/get_bulk_hr_list/';



        $.ajax({



            url: url,



            type:'POST',



            data: {from:from ,to: to},



            success: function(data){



                var dates = JSON.parse(data);



                for(var i=0; i<dates.length;i++){



                    $('.removeBulkSelection').addClass("load_remove");



                    var newfield = '<div class ="removeBulkSelection"><div class="col-md-12"><div class="panel panel-default"><div class="panel-body"><div class="form-group"><div class="form-group col-xs-2"><input type="text" name="appointment_date[]" id ="datepick'+appt+'" value="'+dates[i]+'" class="datepickerEdit form-control input-sm parsley-validated getDate" /></div><div class="row"><div id="appt'+appt+'"></div></div></div><a href="#" class="btn btn-default remove">Remove</a></div></div></div></div>';



                    $('#addedMoreAppt').append(newfield);







                    $("#datepick"+appt).datepicker({



                        format: 'yyyy-mm-dd',



                        startDate: '-3d'



                    });







                    $("#datepick"+appt).on("change",function(){



                        var devid =  $("#datepick"+appt).attr('id');



                        var appdivid=  devid.replace("datepick", "");



                        var pDate = $("#datepick"+appt).val();



                        var temp = $('.showMessage');







                        var dates = [];



                        var setCond = false;



                        url = base_url+'Ajax/get_all_hr_list_between_date/';



                        $.ajax({



                            url: url,



                            type:'POST',



                            data: {code:pDate},



                            success: function(data){



                                var response = JSON.parse(data);



                                if(response['message'] == "SUCCESS") {



                                    $('.hideDefault').show();



                                    var listing = response['res'];







                                    $('.alert').hide();



                                    var items=[];



                                    var id = 1;



                                    $.each(hrs, function (index, item) {



                                        if ($.inArray(item, listing) != -1){



                                            var list = '</div><div class="col-sm-1 time-select-div inactive btn-default day appointment active">'



                                                +'<div class="timeslots">'



                                                +'<div class="hour-row time_interval_15">' +'<div class="time-select-div space">' +'<div class="mns" data-toggle="buttons">' +



                                                '<label class="btn btn-primary btn-size-cm active" id ="input'+id+'">' +



                                                '<input type="checkbox" checked name="hour'+day+'[]"   autocomplete="off" value="'+item+'"> '+item+



                                                '</label>' +



                                                '</div> ' +



                                                '</div>' +



                                                '</div>' +



                                                '</div>' +



                                                '</div>';



                                            items.push (list);







                                        }else{



                                            var list = '<div class="col-sm-1 time-select-div inactive btn-default day appointment">' +



                                                '<div class="timeslots">' +



                                                '<div class="hour-row time_interval_15">' +



                                                '<div class="time-select-div space">' +



                                                '<div class="mns" data-toggle="buttons">' +



                                                '<label class="btn btn-primary btn-size-cm" id ="input'+id+'">' +



                                                '<input type="checkbox" name="hour'+day+'[]"  autocomplete="off" value="'+item+'"> '+item+



                                                '</label>' +



                                                '</div> ' +



                                                '</div>' +



                                                '</div>' +



                                                '</div>' +



                                                '</div>';



                                            items.push (list);



                                        }







                                        id++;



                                    });



                                    $('#appt'+appdivid).html(items.join(""));



                                    day++;



                                }



                            }



                        });







                    });



                    $("#datepick"+appt).trigger( "change" );



                    appt++;



                }



            }



        });



        return false;



    });











    $('a#moreAppointmentsEdit').on('click', function(){



        var newfield = '<div class="col-md-12"><div class="panel panel-default"><div class="panel-body"><div class="form-group"><div class="form-group col-xs-2"><input type="text" name="appointment_date[]" id ="datepick'+appt+'"  class="datepickerEdit form-control input-sm parsley-validated getDate" /></div><div class="row"><div id="appt'+appt+'"></div></div></div><a href="#" class="btn btn-default remove">Remove</a></div></div></div>';



        $('#addedMoreAppt').append(newfield);







        $('.datepickerEdit').datepicker({



            format: 'yyyy-mm-dd',



            startDate: '-3d'



        });







        $(".datepickerEdit").on("change",function(){



            var devid =  $(this).attr('id');



            var appdivid=  devid.replace("datepick", "");



            var pDate = $(this).val();



            var temp = $('.showMessage');



            if(pDate < date){



                $('.alert').addClass('alert-danger').show();



                temp.text('Your date selection should be greater then current date');



                $('html, body').animate({



                    scrollTop: 0



                }, 800);



                return false;



            }



            var dates = [];



            var setCond = false;



            $( "input[name='appointment_date[]']" ).each(function() {



                if(jQuery.inArray(pDate, dates) != -1) {



                    $('.alert').addClass('alert-danger').show();



                    temp.text('date is already selected , please select other date');



                    if (setCond){



                        $('html, body').animate({



                            scrollTop: 0



                        }, 800);



                        return false;



                    }



                    setCond = true;



                }



                dates.push($(this).val());



            });







            if(setCond == false){



                url = base_url+'Ajax/get_all_time_slot_list/';



                $.ajax({



                    url: url,



                    type:'POST',



                    data: {code:pDate},



                    success: function(data){



                        var response = JSON.parse(data);



                        if(response['message'] == "SUCCESS") {



                            $('.alert').addClass('alert-danger').show();



                            $('.showMessage').text('The date you selected is hospital holiday, please select some other date');



                            $('html, body').animate({



                                scrollTop: 0



                            }, 800);



                            return false;



                        }else{



                            var listing = response['hrs'];



                            $('.alert').hide();



                            var items=[];



                            var id = 1;



                            $.each(hrs, function (index, item) {



                                if ($.inArray(item, listing) != -1){



                                    var list = '</div><div class="col-sm-1 time-select-div inactive btn-default day appointment active">'



                                        +'<div class="timeslots">'



                                        +'<div class="hour-row time_interval_15">' +'<div class="time-select-div space">' +'<div class="mns" data-toggle="buttons">' +



                                        '<label class="btn btn-primary btn-size-cm active" id ="input'+id+'">' +



                                        '<input type="checkbox" checked name="hour'+days+'[]"   autocomplete="off" value="'+item+'"> '+item+



                                        '</label>' +



                                        '</div> ' +



                                        '</div>' +



                                        '</div>' +



                                        '</div>' +



                                        '</div>';



                                    items.push (list);







                                }else{



                                    var list = '<div class="col-sm-1 time-select-div inactive btn-default day appointment">' +



                                        '<div class="timeslots">' +



                                        '<div class="hour-row time_interval_15">' +



                                        '<div class="time-select-div space">' +



                                        '<div class="mns" data-toggle="buttons">' +



                                        '<label class="btn btn-primary btn-size-cm" id ="input'+id+'">' +



                                        '<input type="checkbox" name="hour'+days+'[]"  autocomplete="off" value="'+item+'"> '+item+



                                        '</label>' +



                                        '</div> ' +



                                        '</div>' +



                                        '</div>' +



                                        '</div>' +



                                        '</div>';



                                    items.push (list);



                                }



                                id++;



                            });



                            $('#appt'+appdivid).html(items.join(""));



                            days++;



                        }



                    }



                });



            }



        });



        appt++;



        return false;



    });



    $('.bookDatePicker').datepicker({



        format: 'yyyy-mm-dd',



        startDate: '-3d'



    });







    $(".bookDatePicker").on("change",function(){



        var  pDate= $(this).val();



        var temp = $('.showMessage');



//        if(pDate < date){



//            $('.alert').addClass('alert-danger').show();



//            temp.text('Your date selection should be greater then current date');



//            $('html, body').animate({



//                scrollTop: 0



//            }, 800);



//            return false;



//        }







       var url = base_url+'Ajax/get_all_time_slot_list_for_booking/';



        $.ajax({



            url: url,



            type:'POST',



            data: {code:pDate},



            success: function(data){



                var response = JSON.parse(data);



                if(response['message'] == "SUCCESS") {



                    $('.alert').addClass('alert-danger').show();



                    $('.showMessage').text('The date you selected is hospital holiday, please select some other date');



                    $('html, body').animate({



                        scrollTop: 0



                    }, 800);



                    return false;



                }else{



                    $('.hideDefault').show();



//                  if(response['res'] != null){



                    var listing = response['hrs'];



                    $('.alert').hide();



                    var items=[];



                    var id = 1;



                    for(var i =0 ; i < listing.length ; i++){



                        var appt =  listing[i].no_of_appt;



                        var booked_appt = listing[i].no_of_booked_appt



                        var avaliable_Appt = appt - booked_appt;



                        if(appt != booked_appt){



                                var list = '<div class="col-sm-1 time-select-div inactive btn-default day appointment">'



                                    +'<div class="timeslots">'



                                    +'<div class="hour-row time_interval_15">' +'<div class="time-select-div space">' +'<div class="mns" data-toggle="buttons">' +



                                    '<label class="btn btn-primary btn-size-cm  hrsClicked" id ="input'+id+'">' +



                                    '<input type="checkbox" name="hour" class ="hrsEvent"  value="'+listing[i].time_slot+'">'+listing[i].time_slot+



                                    '<input type="hidden" id="'+listing[i].ID+'" name="procedure_slot_id" class ="slotClass" value="">'+



                                    '</div>'+



                                    '</label><div class ="noOfappt" style ="text-align:center"><i class="fa fa-user"></i>   '+ avaliable_Appt +



                                    '</div>' +



                                    '</div>' +



                                    '</div>' +



                                    '</div>' +



                                    '</div>';



                                items.push(list);



                            }else{







                        }



                        id++;



                    }







                    $(".hrsList").html(items.join(""));



                    days++;







                }



//                }



            }



        });







    });







    $('#MoreService').click(function(){



        var newfield = '<div class="col-md-12"><div class="panel panel-default"><div class="panel-body"><div class="form-group"><div class="form-group col-sm-4"><input type="text" name="service[]"  placeholder="Service name" class="form-control" /></div></div><a href="#" class="btn btn-default remove" style ="float: right;">Remove</a></div></div></div>';



        $('#addedMoreService').append(newfield);



        return false;



    });











    $('.hrsClicked').on( 'click', function() {



            $(this).addClass('show');



            $(this).parent().next('.noOfappt').addClass('show');



            var slot = $(this).find('.slotClass').attr('id');



            $('.slotClass').val(slot);



            $('.hrsClicked:not(.show)').attr("disabled", true);



            $('.noOfappt:not(.show)').hide();



            $('.resetHrs').removeClass('rmv');



            var link = '<a href ="#" class ="resetList btn btn-primary">Reset</a>';



            $('.resetHrs').html(link);



            $('.resetHrs').show();











    });







    $('.resetList').on( 'click', function() {



        $('.hrsClicked').removeClass('show');



        $('.noOfappt').removeClass('show');



        $('.hrsClicked').removeClass('active');



        $('.hrsClicked').removeAttr('disabled');



        $('.noOfappt').show();



        $('.resetHrs').addClass('rmv');



        $('.rmv').hide();



    });







    $('.cancelBook').click(function(){



        var proid = $(this).attr('id');



        var url = base_url+'Ajax/cancel_booking/';



        $.ajax({



            url: url,



            type:'POST',



            data: {id:proid},



            success: function(data){



                    var response = JSON.parse(data);



                    if(response['message'] == "SUCCESS") {



                        $('.alert').addClass('alert-success').show();



                        $('.showMessage').text('Booking has been canceled');



                        $('html, body').animate({



                            scrollTop: 0



                        }, 800);



                        setTimeout(function(){



                            location.reload();



                        },3000);



                        return false;



                    }else{



                        $('.alert').addClass('alert-danger').show();



                        $('.showMessage').text('some error has occurred');



                    }



                }



            });



        return false;



    });







    /*



       for showing hospital logo



     */







    $('#imagePreview').hide();



    $('.removeImg').hide();



    $('#uploadFile').on( 'change', function() {



        var file = this.files[0];



        displayPreview(file);



    });







    function displayPreview(files) {



        var reader = new FileReader();



        var img = new Image();



        reader.onload = function (e) {



            img.src = e.target.result;



            img.onload = function () {



                var wid = this.width;



                var ht = this.height;



                var imgsrc = this.src;



                if(wid > 130 && ht > 130){



                    $('.alert').addClass('alert-danger').show();



                    $('.showMessage').text('image is large to upload, please select image size of 100*100');



                    setTimeout(function() { $(".alert-danger").hide(); }, 5000);



                    $("#uploadFile").val('');



                }else{



                    $('#imagePreview').append('<img src="' + e.target.result + '" class ="thmb"/>');



                    $('#imagePreview').show();



                    $('.removeImg').show();



                }



            }



        };



        reader.readAsDataURL(files);



    }











    $('.cancel').click(function(){



         $('#imagePreview').remove();



        $('.removeImg').hide();



        $("#uploadFile").val('');



         return false;



    })



    /*



     end of logo code



     */







    /*



        for showing procedure category icon



     */







    $('#imagePreview').hide();



    $('.removeImg').hide();







    $('#uploadFileIcon').on( 'change', function() {



        var file = this.files[0];



        displayPreview(file);



    });







    function displayPreview(files) {



        var reader = new FileReader();



        var img = new Image();



        reader.onload = function (e) {



            img.src = e.target.result;



            img.onload = function () {



                var wid = this.width;



                var ht = this.height;



                var imgsrc = this.src;



                if(wid > 50 && ht > 50){



                    $('.alert').addClass('alert-danger').show();



                    $('.showMessage').text('image is large to upload, please select image size of 50*50');



                    setTimeout(function() { $(".alert-danger").hide(); }, 5000);



                    $("#uploadFileIcon").val('');



                }else{



                    $('#imagePreview').append('<img src="' + e.target.result + '" class ="thmb"/>');



                    $('#imagePreview').show();



                    $('.removeImg').show();



                }



            }



        };



        reader.readAsDataURL(files);



    }











    $('.cancel').click(function(){



        $('#imagePreview').remove();



        $('.removeImg').hide();



        $("#uploadFileIcon").val('');



        return false;



    })



    /*



     end of logo code



     */







    $( '#hsPhoto'+num).on( 'change', function() {



        var file = this.files[0];



        displayPreviewMore(file);



    });







    function displayPreviewMore(files) {



        var img = new Image();



        var reader = new FileReader(); // instance of the FileReader



        reader.readAsDataURL(files); // read the local file



        reader.onload = function(){ // set image data as background of div



            $('#hsPhotos'+num).append('<img src="' + this.result + '" class ="thmbs"/>');



        }



    }







    function displayPreviewMores(files,res) {



        var img = new Image();



        var reader = new FileReader(); // instance of the FileReader



        reader.readAsDataURL(files); // read the local file



        reader.onload = function(){ // set image data as background of div



            $(res).append('<img src="' + this.result + '" class ="thmbs"/>');



        }



    }







    $('a#morePhoto').on('click', function(){



        var newfield = '<div class="col-md-12"><div class="panel panel-default"><div class="panel-body"><div class="form-group"><div class="form-group col-sm-4"><input type="file" name="hPic[]" id="hsPhoto'+num+'" accept="image/jpg,image/png,image/jpeg,image/gif" value="" /><div id="hsPhotos'+num+'"></div></div></div><a href="#" class="btn btn-default remove" style ="float: right;">Remove</a></div></div></div>';



        $('#addedMorePhoto').append(newfield);



        $( '#hsPhoto'+num).change(function(){



            var file = this.files[0];



            var res=  '#hsPhotos'+(num-1);



            displayPreviewMores(file, res);



        });



        num++;



        return false;



    })







    /*



        specialst advice



     */



        $('.advicePicker').datepicker({



            format: 'yyyy-mm-dd',



            startDate: '-3d'



        });







    $('.advicePicker').change(function(){



        this.form.submit();



    });







    $('.getPatient').on( 'change', function() {



            var slot = $(this).val();



            var url = base_url+'Ajax/get_patient/';



            $.ajax({



                url: url,



                type:'POST',



                data: {slot:slot},



                success: function(data){



                    var response = JSON.parse(data);



                    if(response['message'] == "SUCCESS") {



                        var patient = response['pt'];



                        var tableData = '<div class ="removeRow"><label>Patient</label><select name="patient" class="form-control input-sm parsley-validated" data-required="true"><option value ="select Patient" selected>select Patient </option>';



                        $.each(patient, function (index ,item) {



                            tableData += '<option value='+ patient[index]['userid'] +'>' +patient[index]['username']+



                                '</option>';



                        });



                        tableData +='</select></div>';



                        $("#patient").html(tableData);



                        return false;



                    }else{



                        $('.alert').addClass('alert-danger').show();



                        $('.showMessage').text('some error has occurred,false');



                    }



                }



            });



            return false;



        });







    $('.spBooking').datepicker({



        format: 'yyyy-mm-dd',



        startDate: '-3d'



    });







    $('.spBooking').on( 'change',  function() {



        var slot = $(this).val();



        var rs = 1;



        var stats = null;



        var url = base_url+'Ajax/get_specialist_booking_list/';



        $.ajax({



            url: url,



            type:'POST',



            data: {date:slot},



            success: function(data){



                var response = JSON.parse(data);



                if(response['message'] == "SUCCESS") {



                    var dt = new Date();



                    var time = dt.getHours() + ":" + dt.getMinutes();



                    var booking = response['list'];



                    var pctCat = response['prc'];



                    var tableData ='<form action ="update_booking_status" method="post">';



                        tableData += '<div class ="tableRow"><table class="table table-bordered"><thead><tr><th>Booking Time</th><th>Patient Name</th><th>Procedure Name</th> <th>Status</th><th>Action</th></tr></thead>';



                        $.each(booking, function (index ,item) {



//                        console.log(item);



                            if(item["booking_time"] == time ){



                                    var currentTime = "current_time";



                            }else{



                                var currentTime = "";



                            }



                        tableData += '<tr><td class ="book-time-slot '+currentTime+' ">' +  item["booking_time"] + '</td><td>' +  item["username"] + '</td><td>' +  pctCat[item["procedure_id"]] + '</td><td><a href ="#" class="pend-book stats-change" id="checkstats-'+rs+'"  data ="'+item['ID']+'" >Pending</a></td><td><a href ="#" class="cancel-book btn btn-primary" id="book-cancel-'+rs+'" data ="'+item['ID']+'" >Cancel</a></td></tr>';



                        rs++;



                    });



                    tableData +='</table></div><button  type ="submit" class ="btn btn-primary updateBookingStatus">Submit</button></form>';



                    $("#bookingList").html(tableData);







//                    return false;



                }else{



                    $('.alert').addClass('alert-danger').show();



                    $('.showMessage').text('No Booking on this Date');



                }



            }



        });







        return false;



    });







    $(document).on('click','.stats-change', function(){



        var rowId = $(this).attr('data');



        var Id = $(this).attr('id');



        var cancelid = $(this).parent().next('td').find('a').attr('id');



         var url = base_url+'Ajax/change_booking_status_by_specialist/';



         $.ajax({



             url: url,



             type:'POST',



             data: {id:rowId},



             success: function(data){



                 var response = JSON.parse(data);



                 if(response['message'] == "SUCCESS") {



                     $('#'+Id).addClass('new-shape');



                     $('#'+Id).removeClass('pend-book');



                     $('#'+Id).text('completed');



                     $('#'+Id).attr('disabled','disabled');



                     $('#'+cancelid).attr('disabled','disabled');



                 }



             }



         });



     })



























    $('.apptComp').on( 'change',  function() {



        $(".aptCompelete").prop('checked', $(this).prop("checked"));



    });







    $( '.apptCancel' ).on( 'change', function() {



        $(".aptCancel").prop('checked', $(this).prop("checked"));



    });







    $('#uncheck').on( 'click', function() {



            $('.aptCancel').removeAttr("checked");



            $('.apptCancel').removeAttr("checked");



            $('.apptComp').removeAttr("checked");



            $('.aptCompelete').removeAttr("checked");



            return false;



     });







    $('.CheckBooking').datepicker({



        format: 'yyyy-mm-dd',



        startDate: '-3d'



    });







    $('.CheckBooking').on( 'change', function() {



        var slot = $(this).val();



        var url = base_url+'Ajax/get_specialist_booking_list_for_admin/';



        $.ajax({



            url: url,



            type:'POST',



            data: {date:slot},



            success: function(data){



                var response = JSON.parse(data);



                if(response['message'] == "SUCCESS") {



                    var booking = response['list'];



                    var tableData = '<div class ="tableRow"><table class="table table-bordered"><thead><tr><th>Specialist Name</th> <th>Procedure Name</th><th>Booked Appointment</th></tr></thead>';



                    $.each(booking, function (index ,item) {



                        tableData += '<tr><td>' +  item["name"] + '</td><td>' +  item["procedure_name"] + '</td><td>' +  item["no_of_booked_appt"] + '</td></tr>';



                    });



                    tableData +='</table></div>';



                    $("#bookingLists").html(tableData);



                }else{



                    $('.alert').addClass('alert-danger').show();



                    $('.showMessage').text('No Booking on this Date');



                    $("#bookingLists").html('');



                }



            }



        });



        return false;



    });







});







$(document).ajaxComplete(function () {



    $( '.staffcatSelections' ).on( 'change',function() {



        var staffId =  $(this).attr('id');



        var staffIds=  staffId.replace("staffcat", "");



        var optVal =  $(this).val();



        url = base_url+'Ajax/get_staff_list_by_cat';



        $.ajax({



            url: url,



            type:'POST',



            data: {code:optVal},



            success: function(data){



                var response = JSON.parse(data);



                if(response['message'] == "SUCCESS") {



                    var list = response['cat'];



                    var opt = [];



                    $.each(list, function (index ,item) {



                        var newValue = parseInt(index) + 1



                        opt += '<option value='+ newValue  +'>' + item  + '</option>';



                    });



                    $('#staff'+staffIds).empty().append(opt);



                }else{



                    $('#staff'+staffIds).empty();



                }



            }



        });



    })















});



