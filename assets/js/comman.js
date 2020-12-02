/**
 * Created with JetBrains PhpStorm.
 * User: Bigfoot3
 * Date: 3/14/16
 * Time: 10:08 AM
 * To change this template use File | Settings | File Templates.
 */
var nfs = [];
var base_url = get_base_url();

window.arrayvar =[];
$(document).ready(function() {
    $('.showlx').on('change',function(){
        var ids =$(this).val();
        var url = base_url+'/Ajax/get_patient_pic_name';
        $.ajax({
            url: url ,
            type : 'POST',
            data : {pid : ids },
            success: function(data){   
                var response = JSON.parse(data);
                 if(response['message'] == "SUCCESS") {
                    var data = response['plist'] ;
                        var tabdata = '<div class ="row">'+
                                        '<div class ="col-sm-3">'+
                                            '<p class ="p">' +data.username+ '</p>'+
                                         '</div>'+
                                        '<div class ="col-sm-3">'+ 
                                            '<p><img src ="'+base_url+data.picture+'" class ="fside"/> </p>'+ 
                                         '</div>'+
                                    '</div>'; 
                    $('.showPtPics').empty();    
                    $('.showPtPics').append(tabdata);
                }else{

                }
            }
        })
    })

    $('body').on('focus',".datepicker", function(){
        $(this).datepicker({format: 'dd-mm-yyyy',  startDate: '-3y'});
    });

    $('body').on('focus',".hasDatepickers", function(){
        $(this).datepicker({format: 'dd-mm-yyyy',  startDate: '-3y'});
    });

    $(".genralInfodatepicker").datepicker({
        format: 'dd-mm-yyyy'
    });

    /*$('.suredelete').click(function(){        
        var slot_id = $(this).parent().attr('id');
        var id = $('#slot_id').attr('data-slot-id');
        alert(slot_id);
    })*/

    $(function() {
        $( "#tabs" ).tabs();
    });

    $(".header_top_right_img").click(function(){
        $(".header_top_right_menu").toggleClass("is-active");
        $(".header_top_right_img").toggleClass("is_active");
    });

    $("#createprocedure_step1_next").click(function(){        
        var catg = $('.prcCatname').val();
        var procedName = $("#p-name option:selected").text();
        var Mpid = $("#p-name option:selected").val();
        var des = $('.prc-desc').val();
        var slots = $('.quntity-input').val();
        var amt = $('.sp-amt').val();
        var to_amt = $('.to-amt').val();
        var staffHtml = [];
        var procedure_cat = $('input[name=procedure_cat]').val();

        if(procedure_cat =='' || typeof procedure_cat=='undefined'){
            alert(procedure_cat);
            var alert_html = '<div class="alert alert-danger fade in alert-dismissable">'+
                        '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+
                        '<strong>Warning!</strong> Procedure Category is mandatory.'+
                    '</div>';
            $('.p-cat-warning').html(alert_html);        
            $('.p-cat-warning .alert-dismissable').css('display','block');
            $('html,body').animate({
                scrollTop: $('.p-cat-warning').offset().top},
            'slow');
            return false;
        }

        if(Mpid =='' || typeof Mpid=='undefined'){
            alert(Mpid);
            var alert_html = '<div class="alert alert-danger fade in alert-dismissable">'+
                        '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+
                        '<strong>Warning!</strong> Procedure Name is mandatory.'+
                    '</div>';
            $('.p-name-warning').html(alert_html);        
            $('.p-name-warning .alert-dismissable').css('display','block');
            $('html,body').animate({
                scrollTop: $('.p-name-warning').offset().top},
            'slow');
            return false;
        }

        if(to_amt.trim() =='' || amt.trim()==''){
            var alert_html = '<div class="alert alert-danger fade in alert-dismissable">'+
                        '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+
                        '<strong>Warning!</strong> From and to Price is mandatory.'+
                    '</div>';
            $('.amount_warning').html(alert_html);        
            $('.amount_warning .alert-dismissable').css('display','block');
            $('html,body').animate({
                scrollTop: $('.amount_warning').offset().top},
            'slow');
            return false;
        }

        if(parseFloat(amt) > parseFloat(to_amt)){             
            var alert_html = '<div class="alert alert-danger fade in alert-dismissable">'+
                        '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+
                        '<strong>Warning!</strong> From amount should be less than To amount .'+
                    '</div>';
            $('.amount_warning').html(alert_html);        
            $('.alert-dismissable').css('display','block');
            $('html,body').animate({
                scrollTop: $('.amount_warning').offset().top},
            'slow');
            return false;
        }

        $('.staff-section').each(function(){
            $('.createprocedure_step2_left_staff').removeClass('hideContent');
            var content = $(this).html();
            staffHtml.push(content);
        });

        $('.staff-block').html(staffHtml);
        $('.prtSelectedCat').text(catg);
        $('.prtSelectedName').text(procedName);
        $('.prcDesc').text(des);
        $('.total-slots').text(slots);        
        $('.paid-amt-edit').text(amt+'$');
        var from_amts  = amt.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        var to_amts =  to_amt.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $('#from-amts-sp').text(from_amts+'$');
        $('.to-amt-sp').text(to_amts+'$');
        $('.mpid').val(Mpid);
        $('.pnamesS').val(procedName);
        $(".select_procedure_slider_background").toggleClass("is-active");
        $(".createprocedure_step2_background").toggleClass("is_active");

        var catg = $('.name-st').text();
        var procedName = $("#p-name option:selected").text();
        var Mpid = $("#p-name option:selected").val();
        var des = $('.prc-desc').val();
        var slots = $('.quntity-input').val();
        var amt = $('.sp-amt').val();
        var staffHtml = [];
        $('.staff-section').each(function(){
            $('.createprocedure_step2_left_staff').removeClass('hideContent');
             var content = $(this).html();
             staffHtml.push(content);
        });

        $('.staff-block').html(staffHtml);        
        $('.prtSelectedCat').text(catg);
        $('.prtSelectedName').text(procedName);
        $('.prcDesc').text(des);
        $('.total-slots').text(slots);
        $('.paid-amt').text(amt);
        $('.mpid').val(Mpid);
        $('.pnamesS').val(procedName);
        return false;
    });

    var owl1 = $('.owl-select_procedure_slider');
    owl1.owlCarousel({
        items :10,
        margin:25,
        loop: true,
        rewindNav: true,
        scrollPerPage: true,
        navigation: true,
        navigationText: ["prev","next"]
    })

    $('.btn-group2 label').click(function(){
        $('.btn-group2 label').removeClass("active");
        $(this).addClass("active");return false;
    });

    $('.btn-group3 label').click(function(){
        $('.btn-group3 label').removeClass("active");
        $(this).addClass("active");return false;
    });

    $('#procedureCat').on('change',function(){
        var catId = $(this).val();
        var url = base_url+'/Ajax/get_procedure_name_cat_wise';
        $.ajax({
            url: url,
            type:'POST',
            data: {CatID :catId},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    var names = response['list'];
                    var tableData;
                    var text = 'Select Procedure';
                    $.each(names, function (index ,item) {
                        tableData ='<option value="">'+text+'</option>';
                        tableData +='<option value="'+item.ID+'">'+item.procedure_name+'</option>';
                    });

                    $('#procedureName').empty().append(tableData);
                } else {
                    $('#procedureName').empty();
                }
            }
        });
        return false;
    })

    $('.apptProcedure').on('change',function(){
        var catId = $(this).val();
        var url = base_url+'/Ajax/get_procedure_name_cat_wise';
        $.ajax({
            url: url,
            type:'POST',
            data: {CatID :catId},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    var names = response['list'];
                    var tableData;
                    var text = 'please select name';
                    $.each(names, function (index ,item) {
                        tableData ='<option value="please select name">'+text+'</option>';
                        tableData +='<option value="'+item.ID+'">'+item.procedure_name+'</option>';
                    });
                    $('#procedureNameAppt').empty().append(tableData);
                } else {
                       $('#procedureNameAppt').empty();
                }
            }
        });
        return false;
    })

    $( "#nights_div" ).slider({
        range: true,
        min: 0,
        max: 40000,
        values: [ 0, 100000 ],
        slide: function( event, ui ) {
            $("#nights").html( ui.values[ 0 ] ) ;
            $("#nights1").html( ui.values[ 1 ]    );
        }
    });

    $("#nights").html($( "#nights_div" ).slider( "values", 0 ) + "$"  );
    $("#nights1").html($( "#nights_div" ).slider( "values", 1 )  + "$" );

    var minprc = '';
    var maxprc = '';

    $('#nights_div').slider().bind('slidechange',function(event,ui){
        var min1= $("#nights").html($( "#nights_div" ).slider( "values", 0 )  + "$"    );
        var max1 = $("#nights1").html($( "#nights_div" ).slider( "values", 1 )   + "$"   );
        var minprc = min1[0].innerHTML;
        var maxprc = max1[0].innerHTML;
        var minPrice = minprc.replace("$","");
        var maxPrice = maxprc.replace("$","");
        $('#minprcValue').val(minPrice);
        $('.maxprcValue').val(maxPrice);
    });

    var owl = $("#owl-createprocedure_step1_slider");
    owl.owlCarousel({
        items : 3,
        rewindNav: true,
        scrollPerPage: true,
        navigation: true,
        navigationText: ["prev","next"]
    }),

    $(".header_top_right_img").click(function(){
        $(".header_top_right_menu").toggleClass("is-active");
        $(".header_top_right_img").toggleClass("is_active");
    });

    $(".createprocedure_step2_left_procedure_go_back").click(function(){
        $(".select_procedure_slider_background").removeClass("is-active");
        $(".createprocedure_step2_background").removeClass("is_active");
        return false;
    });

    $("#createprocedure_calendar_click_content_mon").click(function(){
        $("#createprocedure_calendar_popup_content_mon").toggleClass("is-active");
        return false;
    });

    $("#createprocedure_calendar_click_content_tues").click(function(){
        $("#createprocedure_calendar_popup_content_tues").toggleClass("is-active");
        return false;
    });

    $("#createprocedure_calendar_click_content_wed").click(function(){
        $("#createprocedure_calendar_popup_content_wed").toggleClass("is-active");
        return false;
    });

    $("#createprocedure_calendar_click_content_thur").click(function(){
        $("#createprocedure_calendar_popup_content_thur").toggleClass("is-active");
        return false;
    });

    $("#createprocedure_calendar_click_content_fri").click(function(){
        $("#createprocedure_calendar_popup_content_fri").toggleClass("is-active");
        return false;
    });

    $("#createprocedure_calendar_click_content_sat").click(function(){
        $("#createprocedure_calendar_popup_content_sat").toggleClass("is-active");
        return false;
    });

    $("#createprocedure_calendar_click_content_sun").click(function(){
        $("#createprocedure_calendar_popup_content_sun").toggleClass("is-active");
        return false;
    });

    $(".responsive_menu").click(function(){
        $(".left_sidebar_border").toggleClass("is-active");
        $(".responsive_menu").toggleClass("is_active");
    });

    $(".counterNs").on("click", function () {
        var $button = $(this);
        var $input = $button.closest('.sp-quantity').find("input.quntity-input");
        $input.val(function(i, value) {
            return +value + (1 * +$button.data('multi'));
        });
        return false;
    });

    $('.addMoreProcedure').click(function(){
        var index = $('.tabs ul').index($('#tabs-1')); 
        $('#tabs').tabs("option", "active", index);
        return false;
    })

    var dynamic = $('.content_right_dashboard');
    var static = $('.left_sidebar_border');
    static.height(dynamic.height());
    var wk = 1;
    $('#mon_add_slot').click(function(){
        var mon_hrs = $('#mon_hrs').val();
        var mon_to = $('.appnto').val();
        if(mon_hrs == ''){
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">'+
                         'Please, enter a time slot before you continue</p>'
            });
            return false;
        }else{
            var total_slots = $('.quntity-input').val();
            var start_val = mon_hrs.split(":");
            var end_val =  mon_to.split(":");  
            for(var i = start_val[0] ; i <= end_val[0] ; i ++){
                var slots_val = parseFloat(i) ;
                if(slots_val <= 9){
                    var new_slot_val = '0' + slots_val;    
                }else{
                    var new_slot_val =  slots_val;    
                }
                var slots_new = new_slot_val +':00';
                $("#mon_solts").append('<div class="createprocedure_calendar_date" id ="m'+i+'">'+
                    '<a href="#" class="createprocedure_calendar_circle deleteTimeSlot">'+
                    '<i class="fa fa-times-circle"></i></a> <span>'+slots_new+'</span>'+
                    '<input type ="hidden" name ="mon_slots_update[]" value ="-1">'+
                    '<p>Seats</p>'+
                    '<input type ="hidden" name ="mon_slots[]" value ='+slots_new+'>'+
                    '<div class="sp-quantity">'+
                    '<div class="sp-minus fff"><a class="counterNsMult" href="#" data-multi="-1">-</a></div>'+
                    '<div class="sp-input">'+
                    '<input type="text" name ="mon_slots_seats[]" class="slots-size" value='+total_slots+'>'+
                    '</div>'+
                    '<div class="sp-plus fff"><a class="counterNsMult" href="#" data-multi="1">+</a></div>'+
                    ' </div>');
                wk++;
            }

            $('.createprocedure_calendar_popup').removeClass('is-active');

            $(".counterNsMult").on("click", function () {
                var $button = $(this);
                var $input = $button.closest('.sp-quantity').find("input.slots-size");
                $input.val(function(i, value) {
                    return +value + (1 * +$button.data('multi'));
                });
                return false;
            });

            $('.createprocedure_calendar_circle').click(function(){
                var ids = $(this).parent().attr('id');                
                $('#'+ids).remove();
                   return false;
            })
            return false;
        }
    });

    var j=1;
    $('#tues_add_slot').click(function(){
        var tues_hrs= $('#tues_hrs').val();
        var tues_to = $('.apptuesto').val();
        if(tues_hrs == ''){
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">'+
                         'Please, enter a time slot before you continue</p>'
            });
            return false;
        }else{
            var total_slots = $('.quntity-input').val();
            var start_val = tues_hrs.split(":");
            var end_val =  tues_to.split(":");  
            for(var i = start_val[0] ; i <= end_val[0] ; i ++){
                var slots_val =  parseFloat(i) ;
                if(slots_val <= 9){
                    var new_slot_val = '0' + slots_val;    
                }else{
                    var new_slot_val =  slots_val;    
                }
                var slots_new_tues = new_slot_val +':00';
                $("#tues_solts").append('<div class="createprocedure_calendar_date" id ="tu'+j+'">'+
                    '<a href="#" class="createprocedure_calendar_circle"><i class="fa fa-times-circle"></i></a>'+
                    '<span>'+slots_new_tues+'</span>'+
                    '<input type ="hidden" name ="tues_slots_update[]" value ="-1">'+
                    '  <p>Seats</p>'+
                    '<input type ="hidden" name ="tues_slots[]" value ='+slots_new_tues+'>'+
                    '<div class="sp-quantity">'+
                    ' <div class="sp-minus fff"><a class="counterNsMult" href="#" data-multi="-1">-</a></div>'+
                    '<div class="sp-input">'+
                    '<input type="text" name ="tues_slots_seats[]" class="slots-size" value='+total_slots+'>'+
                    '</div>'+
                    '<div class="sp-plus fff"><a class="counterNsMult" href="#" data-multi="1">+</a></div>'+
                    ' </div>');
                j++;
            }

            $('.createprocedure_calendar_popup').removeClass('is-active');
            $(".counterNsMult").on("click", function () {
                var $button = $(this);
                var $input = $button.closest('.sp-quantity').find("input.slots-size");
                $input.val(function(i, value) {
                    return +value + (1 * +$button.data('multi'));
                });
                return false;
            });
            $('.createprocedure_calendar_circle').click(function(){
                var ids = $(this).parent().attr('id');
                $('#'+ids).remove();
                return false;
            })
            return false;
        }
    });

    var k =1;
    $('#wed_add_slot').click(function(){
        var wed_hrs= $('#wed_hrs').val();
        var wed_hrs_to= $('.appwedto').val();
        var total_slots = $('.quntity-input').val();
        if(wed_hrs == ''){
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">'+
                'Please, enter a time slot before you continue</p>'
            });
            return false;
        }else{
            var start_val = wed_hrs.split(":");
            var end_val =  wed_hrs_to.split(":");  
            for(var i = start_val[0] ; i <= end_val[0] ; i ++){
                var slots_val = parseFloat(i) ;
                if(slots_val <= 9){
                    var new_slot_val = '0' + slots_val;  
                }else{
                    var new_slot_val =  slots_val;    
                }

                var slots_new_wed = new_slot_val +':00';
                $("#wed_solts").append('<div class="createprocedure_calendar_date" id ="wed'+k+'">'+
                    '<a href="#" class="createprocedure_calendar_circle">' +
                    '<i class="fa fa-times-circle"></i></a> <span>'+slots_new_wed+'</span>'+
                    '<input type ="hidden" name ="wed_slots_update[]" value ="-1">'+
                    '  <p>Seats</p>'+
                    '<input type ="hidden" name ="wed_slots[]" value ='+slots_new_wed+'>'+
                    '<div class="sp-quantity">'+
                    ' <div class="sp-minus fff"><a class="counterNsMult" href="#" data-multi="-1">-</a></div>'+
                    '<div class="sp-input">'+
                    '<input type="text" name ="wed_slots_seats[]" class="slots-size" value='+total_slots+'>'+
                    '</div>'+
                    '<div class="sp-plus fff"><a class="counterNsMult" href="#" data-multi="1">+</a></div>'+
                    ' </div>');
                k++;
            }

            $('.createprocedure_calendar_popup').removeClass('is-active');
            $(".counterNsMult").on("click", function () {
                var $button = $(this);
                var $input = $button.closest('.sp-quantity').find("input.slots-size");
                $input.val(function(i, value) {
                    return +value + (1 * +$button.data('multi'));
                });
                return false;
            });
            $('.createprocedure_calendar_circle').click(function(){
                var ids = $(this).parent().attr('id');
                $('#'+ids).remove();
                return false;
            })
            return false;
        }
    });

    var m =1;
    $('#thus_add_slot').click(function(){
        var thus_hrs= $('#thus_hrs').val();
        var thus_hrs_to= $('.appthusto').val();
        var total_slots = $('.quntity-input').val();
        if(thus_hrs == ''){
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">'+
                'Please, enter a time slot before you continue</p>'
            });
            return false;
        }else{
            var start_val = thus_hrs.split(":");
            var end_val =  thus_hrs_to.split(":");  
            for(var i = start_val[0] ; i <= end_val[0] ; i ++){
                var slots_val = parseFloat(i) ;
                if(slots_val <= 9){
                    var new_slot_val = '0' + slots_val;    
                }else{
                    var new_slot_val =  slots_val;    
                }
                var slots_new_thues = new_slot_val +':00';
                $("#thus_solts").append('<div class="createprocedure_calendar_date" id ="tus'+m+'">'+
                    '<a href="#" class="createprocedure_calendar_circle">' +
                    '<i class="fa fa-times-circle"></i></a> <span>'+slots_new_thues+'</span>'+
                    '<input type ="hidden" name ="thus_slots_update[]" value ="-1">'+
                    '  <p>Seats</p>'+
                    '<input type ="hidden" name ="thus_slots[]" value ='+slots_new_thues+'>'+
                    '<div class="sp-quantity">'+
                    ' <div class="sp-minus fff"><a class="counterNsMult" href="#" data-multi="-1">-</a></div>'+
                    '<div class="sp-input">'+
                    '<input type="text" name ="thus_slots_seats[]" class="slots-size"  value='+total_slots+'>'+
                    '</div>'+
                    '<div class="sp-plus fff"><a class="counterNsMult" href="#" data-multi="1">+</a></div>'+
                    ' </div>');
                m++;
            }
    
            $('.createprocedure_calendar_popup').removeClass('is-active');
                $(".counterNsMult").on("click", function () {
                    var $button = $(this);
                    var $input = $button.closest('.sp-quantity').find("input.slots-size");
                    $input.val(function(i, value) {
                        return +value + (1 * +$button.data('multi'));
                    });
                    return false;
                });
                $('.createprocedure_calendar_circle').click(function(){
                    var ids = $(this).parent().attr('id');
                    $('#'+ids).remove();
                    return false;
                })
                return false;
            } 
    });

    var f =1;
    $('#fri_add_slot').click(function(){
        var fri_hrs =  $('#fri_hrs').val();
        var fri_hrs_to = $('.apptfrito').val();
        var total_slots = $('.quntity-input').val();
        if(fri_hrs == ''){
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">'+
                'Please, enter a time slot before you continue</p>'
            });
            return false;
        }else{
            var start_val = fri_hrs.split(":");
            var end_val =  fri_hrs_to.split(":");  
            for(var i = start_val[0] ; i <= end_val[0] ; i ++){ 
                var slots_val =  parseFloat(i) ;
                if(slots_val <= 9){
                    var new_slot_val = '0' + slots_val; 
                }else{
                    var new_slot_val =  slots_val; 
                }
                var slots_new_fri = new_slot_val +':00';
                $("#fri_solts").append('<div class="createprocedure_calendar_date" id ="fr'+f+'">'+
                    '<a href="#" class="createprocedure_calendar_circle">' +
                    '<i class="fa fa-times-circle"></i></a> <span>'+slots_new_fri+'</span>'+
                    '<input type ="hidden" name ="fri_slots_update[]" value ="-1">'+
                    '  <p>Seats</p>'+
                    '<input type ="hidden" name ="fri_slots[]" value ='+slots_new_fri+'>'+
                    '<div class="sp-quantity">'+
                    ' <div class="sp-minus fff"><a class="counterNsMult" href="#" data-multi="-1">-</a></div>'+
                    '<div class="sp-input">'+
                    '<input type="text" name ="fri_slots_seats[]" class="slots-size"  value='+total_slots+'>'+
                    '</div>'+
                    '<div class="sp-plus fff"><a class="counterNsMult" href="#" data-multi="1">+</a></div>'+
                    ' </div>');
                f++;
            }
            $('.createprocedure_calendar_popup').removeClass('is-active');
            $(".counterNsMult").on("click", function () {
                var $button = $(this);
                var $input = $button.closest('.sp-quantity').find("input.slots-size");
                $input.val(function(i, value) {
                    return +value + (1 * +$button.data('multi'));
                });
                return false;
            });
            $('.createprocedure_calendar_circle').click(function(){
                var ids = $(this).parent().attr('id');
                $('#'+ids).remove();
                return false;
            })
            return false;
        }     
    });

    var s =1;
    $('#sat_add_slot').click(function(){
        var sat_hrs= $('#sat_hrs').val();
        var sat_hrs_to= $('.apptsatto').val();
        var total_slots = $('.quntity-input').val();
        if(sat_hrs == ''){
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">'+
                'Please, enter a time slot before you continue</p>'
            });
            return false;
        }else{
            var start_val = sat_hrs.split(":");
            var end_val =  sat_hrs_to.split(":");  
            for(var i = start_val[0] ; i <= end_val[0] ; i ++){
                var slots_val =  parseFloat(i) ;
                if(slots_val <= 9){
                    var new_slot_val = '0' + slots_val;    
                }else{
                    var new_slot_val =  slots_val; 
                }
                var slots_new_sat = new_slot_val +':00';
                $("#sat_solts").append('<div class="createprocedure_calendar_date" id ="sat'+s+'">'+
                    '<a href="#" class="createprocedure_calendar_circle">' +
                    '<i class="fa fa-times-circle"></i></a> <span>'+slots_new_sat+'</span>'+
                    '<input type ="hidden" name ="sat_slots_update[]" value ="-1">'+
                    '  <p>Seats</p>'+
                    '<input type ="hidden" name ="sat_slots[]" value ='+slots_new_sat+'>'+
                    '<div class="sp-quantity">'+
                    ' <div class="sp-minus fff"><a class="counterNsMult" href="#" data-multi="-1">-</a></div>'+
                    '<div class="sp-input">'+
                    '<input type="text" name ="sat_slots_seats[]" class="slots-size" value='+total_slots+'>'+
                    '</div>'+
                    '<div class="sp-plus fff"><a class="counterNsMult" href="#" data-multi="1">+</a></div>'+
                    ' </div>');
                 s++;
            }
            $('.createprocedure_calendar_popup').removeClass('is-active');
            $(".counterNsMult").on("click", function () {
                var $button = $(this);
                var $input = $button.closest('.sp-quantity').find("input.slots-size");
                $input.val(function(i, value) {
                    return +value + (1 * +$button.data('multi'));
                });
                return false;
            });

            $('.createprocedure_calendar_circle').click(function(){
                var ids = $(this).parent().attr('id');
                $('#'+ids).remove();
                return false;
            })
        }        
        return false;
    });

    var p =1;
    $('#sun_add_slot').click(function(){
        var sun_hrs= $('#sun_hrs').val();
         var sun_hrs_to= $('.appsunto').val();
        var total_slots = $('.quntity-input').val();
        if(sun_hrs == ''){
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">'+
                'Please, enter a time slot before you continue</p>'
            });
            return false;
        }else{
            var start_val = sun_hrs.split(":");
            var end_val =  sun_hrs_to.split(":");  
            for(var i = start_val[0] ; i <= end_val[0] ; i ++){
                var slots_val =  parseFloat(i) ;
                if(slots_val <= 9){
                    var new_slot_val = '0' + slots_val;    
                }else{
                    var new_slot_val =  slots_val;    
                }
                var slots_new_sun = new_slot_val +':00';
                $("#sun_solts").append('<div class="createprocedure_calendar_date" id ="sun'+p+'">'+
                    '<a href="#" class="createprocedure_calendar_circle">' +
                        '<i class="fa fa-times-circle"></i></a> <span>'+slots_new_sun+'</span>'+
                        '<input type ="hidden" name ="sun_slots_update[]" value ="-1">'+
                        '  <p>Seats</p>'+
                        '<input type ="hidden" name ="sun_slots[]" value ='+slots_new_sun+'>'+
                        '<div class="sp-quantity">'+
                        ' <div class="sp-minus fff"><a class="counterNsMult" href="#" data-multi="-1">-</a></div>'+
                        '<div class="sp-input">'+
                        '<input type="text" name ="sun_slots_seats[]" class="slots-size"  value='+total_slots+'>'+
                        '</div>'+
                        '<div class="sp-plus fff"><a class="counterNsMult" href="#" data-multi="1">+</a></div>'+
                        ' </div>');
                p++;
            }
            $('.createprocedure_calendar_popup').removeClass('is-active');
            $(".counterNsMult").on("click", function () {
                var $button = $(this);
                var $input = $button.closest('.sp-quantity').find("input.slots-size");
                $input.val(function(i, value) {
                    return +value + (1 * +$button.data('multi'));
                });
                return false;
            });

            $('.createprocedure_calendar_circle').click(function(){
                var ids = $(this).parent().attr('id');
                $('#'+ids).remove();
                return false;
            })
            return false;
        }  
    });

    $('.createprocedure_step2_left_procedure_go_back').click(function(){
        $('.createprocedure_step2_left_staff').addClass('hideContent');
    })

    var sk = 1;
    var countClk = 0;
    $('.customNavigation').hide();
    $('.nextarrow').hide();
    $('#moreStaffListing').on('click',function(){
        var staffNameid = $('.staffcatName option:selected').val();
        var staff_cat_id = $('.staffcatSelection option:selected').val();
        var staff_catid = $('.staffcatSelection option:selected').val();
        var staffName = $('.staffcatName option:selected').text();
        var staffCat = $('.staffcatSelection option:selected').text();
        
        if(staffName == 'Select Staff'){
            staffName ='';
        }
        $('.customNavigation').show();
        var checkStaffDetails = [];
        var checkgroupDetails = [];

        var staff_cat_id;
        var staff_name;        
        $(".staff_check").each(function() {
            var staff_id = $(this).val();
            checkStaffDetails.push(staff_id);
        });
        checkStaffDetails.push(staffNameid);
    
        $(".group_select").each(function() {
            var group_id = $(this).val();
            checkgroupDetails.push(group_id);
        });
        checkgroupDetails.push(staff_catid);       
        
        var found = false;
        if( checkIfArrayIsUnique(checkgroupDetails)==true){
            found = true;
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">'+
                'This Staff Category is already added, please choose another</p>'
            });
            return false;
        }  

        var found = false;
        if( checkIfArrayIsUnique(checkStaffDetails)==true){
            found = true;            
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">'+
                'This staff is already added, please choose another</p>'
            });
            return false; 
        }    

        countClk++;            
        var url = base_url+'/Ajax/get_staff_person_img';
        $.ajax({
            url: url,
            type:'POST',
            data: {staffid : staffNameid, staff_catid : staff_catid},
            success: function(data){
                var response = JSON.parse(data);
                var staffs = response['staff'];
                var pic;
                if(typeof staffs !== "undefined"){
                    pic = base_url + staffs.staff_pic; 
                }else{ 
                      pic = '#';  
                }
                
                var tables ='<div class="item" id ="staff_'+sk+'"><div class="createprocedure_step1_buttom_slider">'
                    +'<img src="'+pic+'" />'
                    +'<div class="createprocedure_step1_buttom_slider1">'
                    +'<h1>'+staffName+'</h1>'
                    +'<span>'+staffCat+'</span> </div>'
                    +'<a href ="#" class ="deleteStaff"><div class="createprocedure_step1_delete_slider1">'
                    +'<i class="fa fa-trash-o"></i> </div></a>'
                    +'</div>' 
                    +'<input type= "hidden" name ="staff_pic[]" class ="staff_pcs" value ="'+staffs.staff_pic+'" />'     
                    +'<input type ="hidden" name = "staff_cat_id[]" class ="staff_cat_id"  value = "'+staff_catid+'" />'
                    +'<input type ="hidden" name = "staff_cat_type[]" class ="staff_cat_check" value = "'+staffCat+'" />';
                tables +='<input type ="hidden" name = "staff_id[]" class ="staff_check" value = "'+staffNameid+'" />';     
                tables +='<input type ="hidden" name = "staff_name[]" value = "'+staffName+'" />';                   
                if(staffName ==''){
                    tables +='<input type ="hidden" name = "group_cat[]" class="group_select" value = "'+staff_catid+'" />'; 
                }
                tables +='<div class ="staff-section">' +
                    '<div class="createprocedure_step2_left_staff hideContent">' +
                    '<img src="'+pic+'"  class ="csize"/>' +
                    '<div class="createprocedure_step2_left_text staff_text"><h2>'+staffName+'</h2>'+
                    '<span>'+staffCat+'</span> </div>'+
                    '</div>'
                tables +='</div>';
                sk++;
                // console.log(tables);
                var owl = $("#owl-createprocedure_step1_slider");
                owl.data('owlCarousel').addItem(tables);
                owl.data('owlCarousel').reinit({
                    items : 3,
                    rewindNav: true,
                    scrollPerPage: true,
                    navigation: true,
                    navigationText: ["prev","next"]
                });
                //// Custom Navigation Events
                $(".next").click(function(){
                    owl.trigger('owl.next');
                })
                $(".prev").click(function(){
                    owl.trigger('owl.prev');
                })

                $(".play").click(function(){
                    owl.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
                })

                $(".stop").click(function(){
                    owl.trigger('owl.stop');
                })
            }
        });
        return false;
    })

    //----------------------------------- editable working hrs section -----------------------------------------//
    var wr = 1;
    $('#mon_add_slot_edit').click(function(){
        var mon_hrs= $('#mon_hrs').val();
        var mon_to = $('.appnto').val();
        var total_slots = $('.quntity-input').val();
        var start_val = mon_hrs.split(":");
        var end_val =  mon_to.split(":");  
        if(mon_hrs == ''){
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">'+
                'Please, enter a time slot before you continue</p>'
            });
            return false;
        }else{
            for(var i = start_val[0] ; i <= end_val[0] ; i ++){
                var slots_val = parseFloat(i) ;
                if(slots_val <= 9){
                    var new_slot_val = '0' + slots_val;    
                }else{
                    var new_slot_val =  slots_val;    
                }
                var slots_new = new_slot_val +':00';
                $("#mon_solts").append('<div class="createprocedure_calendar_date" id ="m'+wr+'">' +
                    ' <a href="#" class="createprocedure_calendar_circle deleteTimeSlot">' +
                    '<input type ="hidden" name ="mon_slots[]" value ='+slots_new+'>'+
                    '<i class="fa fa-times-circle"></i></a> <span>'+slots_new+'</span>'+
                 '</div>');
                wr++;
            }
            $('.createprocedure_calendar_popup').removeClass('is-active');
            $('.createprocedure_calendar_circle').click(function(){
                var ids = $(this).parent().attr('id');
                $('#'+ids).remove();
                return false;
            })
            return false;
        }  
    });

    var j=1;
    $('#tues_add_slot_edit').click(function(){
        var tues_hrs= $('#tues_hrs').val();
        var total_slots = $('.quntity-input').val();
        var tues_to = $('.apptuesto').val();
        if(tues_hrs == ''){
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">'+
                'Please, enter a time slot before you continue</p>'
            });
            return false;
        }else{
            var total_slots = $('.quntity-input').val();
            var start_val = tues_hrs.split(":");
            var end_val =  tues_to.split(":");  
            for(var i = start_val[0] ; i <= end_val[0] ; i ++){
                var slots_val =  parseFloat(i) ;
                if(slots_val <= 9){
                    var new_slot_val = '0' + slots_val;    
                }else{
                    var new_slot_val =  slots_val;    
                }
                var slots_new_tues = new_slot_val +':00';
                $("#tues_solts").append('<div class="createprocedure_calendar_date" id ="tu'+j+'"> ' +
                    '<a href="#" class="createprocedure_calendar_circle">' +
                    '<input type ="hidden" name ="tues_slots[]" value ='+slots_new_tues+'>'+
                    '<input type ="hidden" name ="tues_slots_new[]" value ="-1">'+
                    '<i class="fa fa-times-circle"></i></a> <span>'+slots_new_tues+'</span>'+
                    '</div>');
                j++;
            } 

            $('.createprocedure_calendar_popup').removeClass('is-active');
            $('.createprocedure_calendar_circle').click(function(){
                var ids = $(this).parent().attr('id');
                $('#'+ids).remove();
                return false;
            })
            return false;
        }           
    });

    var k =1;
    $('#wed_add_slot_edit').click(function(){
        var wed_hrs= $('#wed_hrs').val();
        var total_slots = $('.quntity-input').val();
        var wed_hrs_to= $('.appwedto').val();
        if(wed_hrs == ''){
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">'+
                'Please, enter a time slot before you continue</p>'
            });
            return false;
        }else{
            var start_val = wed_hrs.split(":");
            var end_val =  wed_hrs_to.split(":");  
            for(var i = start_val[0] ; i <= end_val[0] ; i ++){
                var slots_val = parseFloat(i) ;
                if(slots_val <= 9){
                    var new_slot_val = '0' + slots_val;    
                }else{
                    var new_slot_val =  slots_val;    
                }
                var slots_new_wed = new_slot_val +':00';
                $("#wed_solts").append('<div class="createprocedure_calendar_date" id ="wed'+k+'">'+
                    '<a href="#" class="createprocedure_calendar_circle">' +
                    '<input type ="hidden" name ="wed_slots[]" value ='+slots_new_wed+'>'+
                    '<input type ="hidden" name ="wed_slots_new[]" value ="-1">'+
                    '<i class="fa fa-times-circle"></i></a> <span>'+slots_new_wed+'</span>'+
                ' </div>');
                k++;
            }                               
            $('.createprocedure_calendar_popup').removeClass('is-active');
            $('.createprocedure_calendar_circle').click(function(){
                var ids = $(this).parent().attr('id');
                $('#'+ids).remove();
                return false;
            })
            return false;
        }                       
    });

    var m =1;
    $('#thus_add_slot_edit').click(function(){
        var thus_hrs= $('#thus_hrs').val();
        var total_slots = $('.quntity-input').val();
        var thus_hrs_to= $('.appthusto').val();
        if(thus_hrs == ''){
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">Please, enter a time slot before you continue</p>'
            });
            return false;
        }else{
            var start_val = thus_hrs.split(":");
            var end_val =  thus_hrs_to.split(":");  
            for(var i = start_val[0] ; i <= end_val[0] ; i ++){
                var slots_val = parseFloat(i) ;
                if(slots_val <= 9){
                    var new_slot_val = '0' + slots_val;    
                }else{
                    var new_slot_val =  slots_val;    
                }
                var slots_new_thues = new_slot_val +':00';
                $("#thus_solts").append('<div class="createprocedure_calendar_date" id ="tus'+m+'">'+
                    '<a href="#" class="createprocedure_calendar_circle">' +
                    '<input type ="hidden" name ="thus_slots[]" value ='+slots_new_thues+'>'+
                    '<input type ="hidden" name ="thus_slots_new[]" value ="-1">'+
                    '<i class="fa fa-times-circle"></i></a> <span>'+slots_new_thues+'</span>'+
                    ' </div>');
                m++;
            }       
            $('.createprocedure_calendar_popup').removeClass('is-active');
            $('.createprocedure_calendar_circle').click(function(){
                var ids = $(this).parent().attr('id');
                $('#'+ids).remove();
                return false;
            })
            return false;
        }   
    });

    var f =1;
    $('#fri_add_slot_edit').click(function(){
        var fri_hrs= $('#fri_hrs').val();
        var total_slots = $('.quntity-input').val();
        var fri_hrs_to= $('.apptfrito').val();
        if(fri_hrs == ''){
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">'+
                'Please, enter a time slot before you continue</p>'
            });
            return false;
        }else{
            var start_val = fri_hrs.split(":");
            var end_val =  fri_hrs_to.split(":");  
            for(var i = start_val[0] ; i <= end_val[0] ; i ++){
                var slots_val = parseFloat(i) ;
                if(slots_val <= 9){
                    var new_slot_val = '0' + slots_val;    
                }else{
                    var new_slot_val =  slots_val;    
                }
                var slots_new_fri = new_slot_val +':00';
                $("#fri_solts").append('<div class="createprocedure_calendar_date" id ="fr'+f+'"> <a href="#" class="createprocedure_calendar_circle">' +
                    '<input type ="hidden" name ="fri_slots[]" value ='+slots_new_fri+'>'+
                    '<input type ="hidden" name ="fri_slots_new[]" value ="-1">'+
                    '<i class="fa fa-times-circle"></i></a> <span>'+slots_new_fri+'</span>'+
                    ' </div>');
                f++;
            } 
            $('.createprocedure_calendar_popup').removeClass('is-active');
            $('.createprocedure_calendar_circle').click(function(){
                var ids = $(this).parent().attr('id');
                $('#'+ids).remove();
                return false;
            })
            return false;
        }
    });

    var s =1;
    $('#sat_add_slot_sat').click(function(){
        var sat_hrs= $('#sat_hrs').val();
        var total_slots = $('.quntity-input').val();
        var sat_hrs_to= $('.apptsatto').val();
        if(sat_hrs == ''){
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">'+
                'Please, enter a time slot before you continue</p>'
            });
            return false;
        }else{
            var start_val = sat_hrs.split(":");
            var end_val =  sat_hrs_to.split(":");  
            for(var i = start_val[0] ; i <= end_val[0] ; i ++){
                var slots_val = parseFloat(i) ;
                if(slots_val <= 9){
                    var new_slot_val = '0' + slots_val;    
                }else{
                    var new_slot_val =  slots_val;    
                }
                var slots_new_sat_edit = new_slot_val +':00';   
                $("#sat_solts").append('<div class="createprocedure_calendar_date" id ="sat'+s+'">'+
                    '<a href="#" class="createprocedure_calendar_circle">' +
                    '<input type ="hidden" name ="sat_slots[]" value ='+slots_new_sat_edit+'>'+
                    '<input type ="hidden" name ="sat_slots_new[]" value ="-1">'+
                    '<i class="fa fa-times-circle"></i></a> <span>'+slots_new_sat_edit+'</span>'+
                    ' </div>');
                s++;
            }        
            $('.createprocedure_calendar_popup').removeClass('is-active');
            $('.createprocedure_calendar_circle').click(function(){
                var ids = $(this).parent().attr('id');
                $('#'+ids).remove();
                return false;
            })
            return false;
        }               
    });

    var p =1;
    $('#sun_add_slot_edit').click(function(){
        var sun_hrs= $('#sun_hrs').val();
        var total_slots = $('.quntity-input').val();
        var sun_hrs_to = $('.appsunto').val();
        if(sun_hrs == ''){
            bootbox.dialog({
                title: "Error Message",
                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;">'+
                'Please, enter a time slot before you continue</p>'
            });
            return false;
        }else{
            var start_val = sun_hrs.split(":");
            var end_val =  sun_hrs_to.split(":");  
            for(var i = start_val[0] ; i <= end_val[0] ; i ++){
                var slots_val = parseFloat(i) ;
                if(slots_val <= 9){
                    var new_slot_val = '0' + slots_val;    
                }else{
                    var new_slot_val =  slots_val;    
                }
                var slots_new_sun_edit = new_slot_val +':00';   
                $("#sun_solts").append('<div class="createprocedure_calendar_date" id ="sun'+p+'">'+
                    '<a href="#" class="createprocedure_calendar_circle">' +
                    '<input type ="hidden" name ="sun_slots[]" value ='+slots_new_sun_edit+'>'+
                    '<input type ="hidden" name ="sun_slots_new[]" value ="-1">'+
                    '<i class="fa fa-times-circle"></i></a> <span>'+slots_new_sun_edit+'</span>'+
                    ' </div>');
                p++;
            }       

            $('.createprocedure_calendar_popup').removeClass('is-active');
            $('.createprocedure_calendar_circle').click(function(){
                var ids = $(this).parent().attr('id');
                $('#'+ids).remove();
                return false;
            })
            return false;
        }                                                                 
    });
    //------------------------------- editable working hrs section end -------------------------------------//
    $('body').on( 'click', '.icons-selected', function() {
        var name = $(this).next().val();
        var id = $(this).next().next().val();
        var seleted = '<div class ="seleted-cat"><span class ="cat-text">Selected category:</span>'+
            '<span class="name-st"> '+name+'</span>'+
            '<input type ="hidden" name ="procedure_cat" value = '+id+' />' +
            '</div>'
        $('.select-cat').html(seleted);
        var url = base_url+'/Ajax/get_procedure_name';
        $.ajax({
            url: url,
            type:'POST',
            data: {code : id},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    var list = response['procedureName'];
                    var tableData = '' +
                        '<h5>Procedure</h5><select name="procedure_name" id ="p-name" class="parsley-validated" '+
                            'data-required="true" data-required-message="Staff Category is required">';
                        tableData +=  '<option value="">Select Procedure Name</option>';
                        $.each(list, function (index ,item) {
                            var str = item.procedure_name;
                            str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                                return letter.toUpperCase();
                            });
                            tableData += '<option value='+ item.ID  +'>' +str+
                            '</option>';
                        });

                        tableData +='</select>';
                    $('.procedure-name').html('');
                    $('.procedure-name').html(tableData);
                } else {
                    var  msg = 'Procedure name not found for this category';
                    $('.procedure-name').html('');
                    $('.procedure-name').html(msg);
                }
            }
        });
        return false;
    });

    $('.sp_edit').click(function(){
        var url = base_url+'/Ajax/get_specialist_data_for_edit';
        $.ajax({
            url: url,
            type:'GET',
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    var list = response['splist'];
                    var sp= list.desc;
                    $('.desc-sp').innerHTML =sp ;
                    var tableData;
                    tableData += '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" '+
                        ' aria-labelledby="myModalLabel" aria-hidden="true" >'+
                        '<div class="modal-dialog">'+
                        <!-- Modal content-->
                        '<div class="modal-content">'+
                        '<div class="modal-header">'+
                        '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
                        '<h4 class="modal-title">Specialist information</h4>'+
                        '</div>'+
                        '<div class="alert"><div class ="showMessage"></div>' +
                        '</div>'+
                        '<div class="modal-body">'+
                        '<form id ="editSpDetail" method ="POST" enctype="multipart/form-data">'+
                        '<div class="form-group"> <h5>Name </h5>'+
                        '<input type="text" name="name" class="form-control input-sm parsley-validated desc-sp" '+
                        ' id="usr" value ="'+list.name+'"  />'+
                        '</div>'+
                        '<div class="form-group"><h5>Description </h5>'+
                        '<textarea cols="55" rows="8" name="desc" class="form-control input-sm '+
                        ' parsley-validated desc-sp"> '+list.desc+'</textarea>'+
                        '</div>'+
                        '<div class="form-group"><h5>Change Image </h5>'+
                        '<input type="file" id="file" name="file" class="form-control img-sp input-sm parsley-validated" />'+
                        '<img src ="'+base_url+list.picture+'"  class ="spseting"/>'+
                        '<div class ="spimg"></div>'+
                        '</div>'+
                        '<div class="form-group">'+
                        '<button type="submit" class="btn btn-success saveRecords">'+
                        '<i class="fa fa-sign-in"></i> Submit</button>'+
                        '</div>'+
                        '</form>'+
                        '</div>'+
                        '<div class="modal-footer"><button type="button" class="btn btn-default" '+
                        ' data-dismiss="modal">Close</button>' +
                        '</div>'+
                        '</div></div></div>';
                        $('.editSplist').html(tableData);
                        $('#myModal').modal('show');
                            //                        $('.fancybox').fancybox();
                    } else {
                    var  msg = 'data not found';
                }
            }
        });
        return false;
    })

    $("#ChildSwitch :input").change(function() {
        if($("input:radio[name='see_child']").is(":checked")) {
            var stats = $(this).attr('id');
            var cls = $('#'+stats).addClass('SeeChildsp');
            var ids;
            if(stats == 'option1'){
                ids = "topSelect2"; 
            }else{
                ids = "topSelect1";
            }
            $('#'+ids).removeClass('SeeChildsp');
        }
        var chd = $(this).val();
        var url = base_url+'/Ajax/change_child_check_status';
        $.ajax({
            url: url,
            type:'POST',
            data: {code :chd},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    $('.alert').show();
                    $('.alert').addClass('alert-success').show();
                    $('.showMessage').text('Your see child status is changed successfully');
                    setTimeout(function () { 
                        $('.alert').slideToggle();
                    }, 
                    3000);
                    // setTimeout(function () { location.reload(1); }, 2000);
                } else {
                }
            }
        });
        return false;
    });

    $('#SaveLang').click(function(){
        var lang = $('#langSelected option:selected').text();
        var url = base_url+'/Ajax/save_sp_langauges';
        $.ajax({
            url: url,
            type:'POST',
            data: {langs : lang},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                     $('.alert').addClass('alert-success').show();
                     $('.showMessage').text('Your language is added successfully');
                     setTimeout(function () { location.reload(1); }, 3000);
                } else {
                }
            }
        });
        return false;
    });

    $('#Savespecialization').click(function(){
        var specialization = $('#specialization-Sp').val();
        var url = base_url+'/Ajax/save_sp_specialization';
        $.ajax({
            url: url,
            type:'POST',
            data: {spc : specialization},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    $('.alert').addClass('alert-success').show();
                    $('.showMessage').text('Your specialization is added successfully');
                    setTimeout(function () { location.reload(1); }, 3000);
                } else {
                }
            }
        });
        return false;
    });

    $('.langs').on('beforeItemRemove', function(event) {
        var tag = event.item;
        bootbox.confirm("Are you sure you want to delete this?", function(result) {
            if(result == 'true'){
                var url = base_url+'/Ajax/remove_sp_language';
                $.ajax({
                    url: url,
                    type:'POST',
                    data: {taglang : tag},
                    success: function(data){
                        var response = JSON.parse(data);
                        if(response['message'] == "SUCCESS") {
                            $('.alert').addClass('alert-success').show();
                            $('.showMessage').text('Your language is remove successfully');
                            setTimeout(function () { location.reload(1); }, 3000);
                        } else {
                            // $('.alert').addClass('alert-success').show();
                            // $('.showMessage').text('Your language is not remove');
                            // setTimeout(function () { location.reload(1); }, 3000);
                        }
                    }
                });
                return false;
            }else{
                // return false;
            }
        });
    });

    $('.specl').on('beforeItemRemove', function(event) {
        var tag = event.item;
        bootbox.confirm("Are you sure you want to delete this?", function(result) {
            if(result == true){
                var url = base_url+'/Ajax/remove_sp_specialization';
                $.ajax({
                    url: url,
                    type:'POST',
                    data: {tagsp : tag},
                    success: function(data){
                        var response = JSON.parse(data);
                        if(response['message'] == "SUCCESS") {
                            $('.alert').addClass('alert-success').show();
                            $('.showMessage1').show();
                            $('.showMessage1').text('Your specialization is remove successfully');
                            setTimeout(function () { location.reload(1); }, 3000);
                        } else {
                        }
                    }
                });
                return false;
            }else{
                // setTimeout(function () { location.reload(1); }, 1000);
            }
        });
    });

    $('.awards').on('beforeItemRemove', function(event) {
        var tag = event.item;
        bootbox.confirm("Are you sure you want to delete this?", function(result) {
            if(result == true){
                var url = base_url+'/Ajax/remove_sp_award';
                $.ajax({
                    url: url,
                    type:'POST',
                    data: {award : tag},
                    success: function(data){
                        var response = JSON.parse(data);
                        if(response['message'] == "SUCCESS") {
                            $('.alert').addClass('alert-success').show();
                            $('.showMessage1').show();
                            $('.showMessage1').text('Your specialization is remove successfully');
                            setTimeout(function () { location.reload(1); }, 3000);
                        } else {
                        }
                    }
                });
            }else{
                // setTimeout(function () { location.reload(1); }, 1000);
                // return false;
            }
        });
    });

    $('body').on( 'click', '.removeEdu', function() {
        var eduID = $(this).attr('data');
        var rowID =  eduID.replace("edu-", "");
        alert(rowID);
        bootbox.confirm("Are you sure you want to delete this ?", function(result) {
            if(result == true){
                var url = base_url+'/Ajax/remove_sp_education';
                $.ajax({
                    url: url,
                    type:'POST',
                    data: {edid : rowID},
                    success: function(data){
                        var response = JSON.parse(data);
                        if(response['message'] == "SUCCESS") {
                            $('.alert').addClass('alert-success').show();
                            $('.showMessage1').show();
                            $('.showMessage1').text('Your Education details is remove successfully');
                            setTimeout(function () { location.reload(1); }, 100);
                                // $('html, body').animate({
                                //     scrollTop: 0
                                // }, 800);
                        } else {
                        }
                    }
                });
            }else{
                // setTimeout(function () { location.reload(1); }, 1000);
                // return false;
            }
        });
        return false;
    });

    $('#navecation li').click(function(){
        $('#navecation li').removeClass("active");
        $(this).addClass("active");return false;
    });

    $('#language li').click(function(){
        $('#language li').removeClass("active");
        $(this).addClass("active");return false;
    });

    $('#see_children li').click(function(){
        $('#see_children li').removeClass("active");
        $(this).addClass("active");return false;
    });

    var owl = $('.owl-carousel');
    owl.owlCarousel({
        margin:25,
        loop: true,
        responsive: {
            0: {
               items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // var myCenter=new google.maps.LatLng(51.508742,-0.120850);
    function initialize(){
        var mapProp = {
            center:myCenter,
            zoom:5,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
        var marker=new google.maps.Marker({
            position:myCenter,
        });
        marker.setMap(map);
        var infowindow = new google.maps.InfoWindow({
            content:"<div class='googlemap_min'><img src='images/appointments_patients_icon2.png' />"+
            "<div class='googlemap_min_text'><h1>Dr. Mathew Wilson</h1><a href='#'>book appointment</a></div>"+
            "<div class='googlemap_min_icon'><i class='fa fa-star'></i><span>4.5</span></div>"
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
    }
    //google.maps.event.addDomListener(window, 'load', initialize);
    $('#Saveaward').click(function(){
        var awardtext = $('#award-Sp').val();
        var date = $('.award-date').val();
        var url = base_url+'/Ajax/save_sp_award';
        $.ajax({
            url: url,
            type:'POST',
            data: {spc : awardtext, awrdDate : date},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    $('.alert').addClass('alert-success').show();
                    $('.showMessage').text('Your award details is added successfully');
                    setTimeout(function () { location.reload(1); }, 3000);
                } else {
                }
            }
        });
        return false;
    });

    $('.deleteSlots').click(function(){
        var ids = $(this).parent().find("input[name=slotid]").val()
        var secID = $(this).parent().attr('id');
        var url = base_url+'/Ajax/delete_time_slot';
        $.ajax({
            url: url,
            type:'POST',
            data: {slot : ids},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    $('#'+secID).remove();
                    $('.alert').addClass('alert-success').show();
                    $('.showMessage').text('Your slot delete successfully');
                    setTimeout(function () { location.reload(1); }, 3000);
                } else {
                }
            }
        });
        return false;
    })

    $(".hasDatepicker1").datepicker({format: 'yy-mm-dd'});
    //  for medical history document
    var pl = 0;
    var ck = 1;
    $('a#MoreEdu').click(function(){
        var d1 = pl+1;
        var d2 = ck+1;
        var tableData = '<div class ="row" id ="new-items-'+pl+' "><div class="col-md-4"><h1>Education</h1>'+
            '<textarea name ="education[]" /></textarea> </div>';

        tableData +='<div class="col-md-3"> <h1>From</h1>'+
            '<input type="text" name ="from_date[]" class="Datepickers" value="" id="settings_datepicker_'+d1+'" /></div>';

        tableData +='<div class ="col-md-3"><h1>To</h1>'+
            '<input type="text" name ="to_date[]" class="Datepickeres2" value="" id="settings_datepicker_'+d2+'"></div>';

        tableData += '<a href="#" class="btn btn-default remove removePtk" data ="new-items-'+
            pl+'" style ="margin-top: 50px;">Remove</a></div>';

        $(".moreEducation").append(tableData);
        $('body').on('focus',".Datepickers", function(){
            $(this).datepicker({format: 'dd-mm-yyyy'});
        });

        $('body').on('focus',".Datepickeres2", function(){
            $(this).datepicker({format: 'dd-mm-yyyy'});
        });

        //$("#settings_datepicker_"+d1).datepicker({dateFormat: 'dd-mm-yyyy'});
        //$("#settings_datepicker_"+d2).datepicker({dateFormat: 'dd-mm-yyyy' });
        pl++;
        ck++
        return false;
    });

    $(document).on('click','.removePtk', function(){
        var rowID = $(this).attr('data');
        $('#'+rowID).remove();
        return false;
    });

    $( "#SavePassword" ).click(function( event ) {
        event.preventDefault();
        var formdata = $('.new_pass').val();
        url = base_url+'/Ajax/save_new_password/';
        $.ajax({
            url: url,
            type:'POST',
            data:{pass:formdata},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    $('.alert').addClass('alert-success').show();
                    $('.showMessage').show();
                    $('.showMessage').text('password has been saved');
                    setTimeout(function() {
                        location.reload();
                    }, 4000);
                    return false;
                }else{
                    $('.alert').addClass('alert-danger').show();
                    $('.showMessage').show();
                    $('.showMessage').text('password not saved');
                    return false;
                }
            }
        });
    })

    // This button will increment the value
    $('.qtyplus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });

    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });

    var ns =1;
    var moreDocPic =1;
    var moreDocument = 1;
    var Docs=1;
    var recommend=1;
    $(".changeStatusClass").click(function(e){
        e.preventDefault();
        var temp = $(this);
        var encryption = $(this).attr("encryption");
        url = base_url+'Ajax/changePatientStatus/';
        $.ajax({
            url: url,
            type:'POST',
            data: {code:encryption},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    if(response['status'] == 0){
                        //   temp.text("open");
                        setTimeout(function () { location.reload(1); }, 2000);
                    } else {
                        //  temp.text("close");
                        setTimeout(function () { location.reload(1); }, 2000);
                    }
                } else {
                    bootbox.alert("Some Unexpected Error occur");
                }
            }
        });
        return false;
    });

    $(".changeStatusPhys").click(function(e){
        e.preventDefault();
        var temp = $(this);
        var id = $(this).attr("encryption");
        url = base_url+'Ajax/changePhysicanStats';
        $.ajax({
            url: url,
            type:'POST',
            data: {code:id},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    if(response['status'] == 0){
                        setTimeout(function () { location.reload(1); }, 2000);
                    } else {
                        setTimeout(function () { location.reload(1); }, 2000);
                    }
                } else{
                    bootbox.alert("Some Unexpected Error occur");
                }
            }
        });
        return false;
    });

    $(".changeStatusSpecialist").click(function(e){
        e.preventDefault();
        var temp = $(this);
        var id = $(this).attr("encryption");
        url = base_url+'Ajax/change_status_specialist';
        $.ajax({
            url: url,
            type:'POST',
            data: {code:id},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    if(response['status'] == 0){
                        setTimeout(function () { location.reload(1); }, 2000);
                    } else {
                        setTimeout(function () { location.reload(1); }, 2000);
                    }
                } else{
                    bootbox.alert("Some Unexpected Error occur");
                }
            }
        });
        return false;
    });

    /*for doctor pic */
    $('#showDocPic').hide();
    $('.removeDocImg').hide();
    $("#uploadDocPic").on("change", function(){
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
                    $("#uploadDocPic").val('');
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                }else{
                    $('#showDocPic').show();
                    $('#showDocPic').append('<img src="' + e.target.result + '" class ="thmb"/>');
                    $("#uploadDocPic").hide();
                    $('.removeDocImg').show();
                    $('.cancelDoc').show();
                }
            }
        };
        reader.readAsDataURL(files);
    }

    $("#uploadDocPic"+moreDocPic).on("change", function(){
        var file = this.files[0];
        displayPreviewMoreDocPic(file);
    });

    function displayPreviewMoreDocPic(files,res) {
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
                    $("#uploadDocPic").val('');
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                }else{
                    $(res).append('<img src="' + e.target.result + '" class ="thmb"/>');
                }
            }
        };
        reader.readAsDataURL(files);
    }

    $('a#more').on('click', function(){
        var newfield = '<div class="row" id="rowId"><div class="form-group col-xs-2">'+
        '<input type="text" placeholder="Doctor Name" name="doc_name[]" class="form-control"></div>'+
        '<div class="form-group col-xs-2">'+
        '<input type="text" name="doc_desc[]" value="" placeholder="Doctor description" class="form-control" /></div>'+
        '<div class="form-group col-xs-2">'+
        '<input type="text" name="qualification[]" placeholder="qualification" class="form-control"/></div>'+
        '<div class="form-group col-xs-2">'+
        '<select id="procd" name="speciality[]" class="form-control input-sm parsley-validated">'+collaboration+'</select>'+
        '</div><div class="form-group col-xs-2">'+
        '<input type="text" name="experience[]" placeholder="experience"  class="form-control"/></div>'+
        '<div class="form-group col-xs-2">'+
        '<input type="text" name="department[]" placeholder="department" value="" class="form-control" />'+
        '<input type="file" name="doc_pic[]" id="uploadDocPic'+moreDocPic+'" '+
        ' accept="image/jpg,image/png,image/jpeg,image/gif" class="dc" value="" />'+
        '<div id ="docPicture'+moreDocPic+'"></div></div><a href="#" class="btn btn-default remove">Remove</a></div>';

        $('#addedRows').append(newfield);
        $("#uploadDocPic"+moreDocPic).on("change", function(){
            var file = this.files[0];
            var res=  '#docPicture'+(moreDocPic-1);
            displayPreviewMoreDocPic(file, res);
        });
        moreDocPic++;
        return false;
    });

    $(document).on('click','.remove', function(){
        $(this).parent('div').remove();
        return false;
    });

    $('a#Morefacility').on('click', function(){
        var newfield = '<div class="row" id="rowId"><div class="form-group col-xs-2">'+
        '<input type="text" name="facility_name[]" placeholder="Facility name" class="form-control" /></div>'+
        '<div class="form-group col-xs-2">'+
        '<input type="text" name="facility_desc[]" placeholder="Facility Desc" class="form-control" /></div>'+
        '<a href="#" class="btn btn-default remove">Remove</a></div>';

        $('#addedMorefacility').append(newfield);
        return false;
    });

    $(document).on('click','.remove', function(){
        $(this).parent('div').remove();
        return false;
    });

    $('a#moreHoliday').on('click', function(){
        var newfield = '<div class="row" id="rowId"><div class="form-group col-xs-2">'+
        '<input type="text" placeholder="date" name="holiday_date[]" value="" class="form-control"></div>'+
        '<a href="#" class="btn btn-default remove">Remove</a></div>';

        $('#addedRowsHoliday').append(newfield);
        return false;
    });

    $('.deleteRow').click(function(){
        var id = $(this).attr('id');
        $('#'+id).remove();
        return false;
    });

    $(document).on('click','.remove', function(){
        $(this).parent('div').remove();
        return false;
    });

    $('.deleteRowfac').click(function(){
        var id = $(this).attr('id');
        $('#'+id).remove();
        return false;
    });

    $('.saveBtn').hide();

    $('.checknext').click(function(){
        $(this).hide();
        $('.saveBtn').show();
    })

    $('.PreviousClick').click(function(){
        $('.checknext').removeClass('nextActive').show();
        $('.saveBtn').hide();
    })

    $( 'body' ).on( 'click', '.getProd', function() {
        if($(this).is(':checked')){
            var id = $(this).val();
            var cl = $(this).closest('td').next().find('input[type=checkbox]').attr('class')
            var prd = $(this).closest('td').next().next().find('input[type=checkbox]').attr('class');
            $('.'+cl).attr('checked',true);
            $('.'+prd).attr('checked',true);
            var sp = $('.'+cl).attr('id');
            var pid = $('.'+prd).attr('id');
            $('.'+cl).val(sp);
            $('.'+prd).val(pid);
        }else{
            var cl = $(this).closest('td').next().find('input[type=checkbox]').attr('class')
            var prd = $(this).closest('td').next().next().find('input[type=checkbox]').attr('class');
            $('.'+cl).attr('checked',false);
            $('.'+prd).attr('checked',false);
            var sp = $('.'+cl).attr('id');
            var pid = $('.'+prd).attr('id');
            $('.'+cl).val('');
            $('.'+prd).val('');
        }
    });

    $( 'body' ).on( 'click', '.getProd', function() {
        if(!$(this).is(':checked')){
            var id = $(this).val();
            var spid = $(this).closest('td').next().find('input[type=checkbox]').attr('class')
            var prd = $(this).closest('td').next().next().find('input[type=checkbox]').attr('class');
            var sp = $('.'+spid).attr('id');
            url = base_url+'Ajax/remove_recommendation/';
            $.ajax({
                url: url,
                type:'POST',
                data:{pr_id:id , sp_id: sp},
                success: function(data){
                    var response = JSON.parse(data);
                    if(response['message'] == "SUCCESS") {
                        $('.alert').addClass('alert-success').show();
                        $('.showMessage').text('Your Recommended procedure has been deleted');
                        $('html, body').animate({
                            scrollTop: 0
                        }, 800);
                        return false;
                    }else{
                        // $('.alert').addClass('alert-danger').show();
                        // $('.showMessage').text('Your Recommended procedure not deleted');
                        // $('html, body').animate({
                        // scrollTop: 0
                        // }, 800);
                        // return false;
                    }
                }
            });
        }
    });

    $('.alert').hide();

    $('.checkpass').on('blur',function(){
        var pass = $(this).val();
        if(pass != ''){
            url = base_url+'/Ajax/checkpassword/';
            $.ajax({
                url: url,
                type:'POST',
                data:{pass:pass},
                success: function(data){
                    var response = JSON.parse(data);
                    if(response['message'] == "SUCCESS") {
                        $('.alert').removeClass('alert-danger');
                        $('.alert').hide();
                        return false;
                    }else{
                        $('.alert').addClass('alert-danger').show();
                        $('.showMessage').show();
                        $('.showMessage').text('Your old password does not match over record, please enter correct password');
                        $('html, body').animate({
                            scrollTop: 0
                        }, 800);
                        return false;
                    }
                }
            });
        }
    })

    $( ".saveAd" ).click(function( event ) {
        event.preventDefault();
        var list = $('.ptAdvice').find("input[type='hidden'], :input:not(:hidden)").serialize();
        //        var list = $('.ptAdvice').serialize();
        var rowID = $(this).closest('tr').attr('id');
        url = base_url+'Ajax/save_Patient_Advice/';
        $.ajax({
            url: url,
            type:'POST',
            data:{data:list},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    $('.alert').addClass('alert-success').show();
                    $('.showMessage').text('Advice has been saved');
                    setTimeout(function(){
                        $(".modal").hide();
                        $(".modal-backdrop").remove();
                    }, 2000)
                    setTimeout(function() {   //calls click event after a certain time
                        $('#'+rowID).remove();
                    }, 2000);
                    return false;
                }else{
                    $('.alert').addClass('alert-danger').show();
                    $('.showMessage').text('Advice not saved');
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                }
            }
        });
    })

    $('.setVisible').click(function(){
        var id = $(this).closest('td').next('td').attr('class');
        $('.'+id).addClass('openModalPop');
        if($('.'+id).hasClass('openModalPop')){
            $('.'+id).css('visibility', 'visible');
        }
    })

    $( ".saveAdviceForSp" ).click(function( event ) {
        event.preventDefault();
        var formClass = $(this).parents('form').attr('class');
        var list = $('.'+formClass).find("input[type='hidden'], :input:not(:hidden)").serialize();
        var rowID = $(this).closest('tr').attr('id');
        url = base_url+'Ajax/save_specialist_Advice/';
        $.ajax({
            url: url,
            type:'POST',
            data:{data:list},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    $('.alert').addClass('alert-success').show();
                    $('.showMessage').text('Advice has been saved');
                    setTimeout(function(){
                        $(".modal").hide();
                        $(".modal-backdrop").remove();
                    }, 2000)
                    setTimeout(function() {   //calls click event after a certain time
                        $('#'+rowID).remove();
                    }, 2000);
                    return false;
                }else{
                    $('.alert').addClass('alert-danger').show();
                    $('.showMessage').text('Advice not saved');
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                }
            }
        });
    })

    $( '.popAdvices').on( 'click', function() {
        var docID = $(this).attr('id');
        var p_id = $('#'+docID).attr('patient_id');
        url = base_url+'Ajax/get_physican_document/';
        $.ajax({
            url: url,
            type:'POST',
            data:{data: p_id },
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    var doc = response['list'];
                    var tableData = '<div class ="row">';
                    tableData +='<table class="table table-bordered"><thead><tr><th>History type</th>'+
                        '<th>History title </th><th>Descrption</th><th>Documents</th></tr></thead>'

                    $.each(doc, function (index ,item) {
                        tableData += '<div class ="col-sm-4">';
                        tableData += '<tr><td>'+item.history_type+'</td>'+
                                     '<td>'+item.historytitle+'</td>'+
                                     '<td>'+item.desc+'</td>'+
                                     '<td><a href='+item['files']+' data-fancybox-group="gallery" class="docPOPup fancybox '+
                                        ' btn btn-primary">Docs</a></td></tr>';
                    });

                    tableData +='</table>';
                    tableData +='</div>';
                    $(".slider2").html(tableData);
                    $('#myModal').modal('show');
                    return false;
                }else{
                    $('.alert-message').addClass('alert-danger').show();
                    $('.alert-danger').text('history not available for this patient');
                    setTimeout(function(){
                        $(".alert-message").hide();
                    }, 2000)
                    return false;
                }
            }
        });
    });

    $( ".saveLicenceStats" ).click(function( event ) {
       event.preventDefault();
        var formClass = $(this).parents("form").attr("class");
        var list = $('.'+formClass).serialize();
        var rowID = $(this).closest('tr').attr('id');
        url = base_url+'Ajax/change_Licence_status/';
        $.ajax({
            url: url,
            type:'POST',
            data:{data:list},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    $('.alert').addClass('alert-success').show();
                    $('.showMessage').text('Licence Status has been Changed');
                    setTimeout(function(){
                        $(".modal").hide();
                        $(".modal-backdrop").remove();
                    }, 2000)
                    setTimeout(function() {   //calls click event after a certain time
                        $('#'+rowID).remove();
                    }, 2000);
                    return false;
                }else{
                    $('.alert').addClass('alert-danger').show();
                    $('.showMessage').text('Licence Status not Changed');
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                }
            }
        });
    })

    $('#procedureSelection').on('change',function(){
        var patientId = $('#patientSelect').val();
        var prod_cat_id = $(this).val();
        url = base_url+'Ajax/get_procedure_specialist_for_recommendation/';
        $.ajax({
            url: url,
            type:'POST',
            data:{data:prod_cat_id, patient_id : patientId},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    var spec = response['list'];
                    var p_id = response['p_id'];
                    var tableData ='<form action ="Homephysican/recommendation" method="post">';
                    var pr_id = "pr_id";
                    tableData += '<div class ="tableRow" style ="margin-top: 30px"><table class="table table-bordered"><thead><tr><td>Procedure Name</td> <td>Specialist Name</td><td>Recommend</td></tr></thead>';
                    $.each(spec, function (index ,item) {
                        tableData += '<tr><td>' +  item["procedure_name"] + '</td><td>' +  item["sname"] + '</td><td><input type ="checkbox" name ="recommend"  value = "'+item["procedure_cat_id"]+'"  class ="recommendProcedure"  /></td><td style ="visibility: hidden"><input type ="checkbox" name ="procedure_id[]"  value = "'+item["ID"]+'"  class ="prid'+recommend+'"  /></td><td style ="visibility: hidden"><input type ="checkbox" name ="user_id[]"  value = "'+item["userid"]+'"  class ="userid'+recommend+'"  /></td><td style ="visibility: hidden"><input type ="hidden" name ="patient_id" class ="p_id'+recommend+'" value = "'+p_id+'" /></td></tr>';
                        recommend++;
                    });
                    tableData += '<tr><td><a href="#" id="moreDocumentPatient" class="btn btn-default"  style ="margin-top:20px">Add More</a><input type="file" name="document_files[]" value="" style ="margin-top:20px"/> <br> <div class="row"><div id="Document-patient"></div></div></div> </td></tr>'
                    tableData +='</table></div><button  type ="submit" class ="btn btn-primary updateBookingStatus">Submit</button></form>';
                    $(".recommendation_list").html(tableData);
                }else{
                    $('.alert').addClass('alert-danger').show();
                    $('.showMessage').text('No Result found against this match');
                    setTimeout(function() {   //calls click event after a certain time
                        $('.alert-danger').hide();
                    }, 2000);
                }
            }
        });
    })

    $( 'body' ).on( 'click', '#moreDocumentPatient', function() {
        var newfield = '<div class="row" id="rowId'+moreDocument+'">'+
            '<div class="col-sm-4"><input type="file" name="document_files[]" value="" style ="margin-top:20px"/></div>'+
            '<div class="col-sm-4"><a href="#" class="btn btn-default removeDocument">Remove</a></div></div>';

        var data = $("#Document-patient").append(newfield);
        moreDocument++;
    });

    $( 'body' ).on( 'click', '.removeDocument', function() {
        var id = $(this).closest("div.row").attr('id');
        $('#'+id).remove();
        return false;
    });

    $( 'body' ).on( 'change', '.recommendProcedure ', function() {
        if($(this).is(':checked')){
            var cname =  $(this).closest("td").next().find("input[type='checkbox']").attr("class");
            var cname1 =  $(this).closest("td").next().next().find("input[type='checkbox']").attr("class");
            $("."+cname).attr('checked', 'checked');
            $("."+cname1).attr('checked', 'checked');
        }else{
            var cname =  $(this).closest("td").next().find("input[type='checkbox']").attr("class");
            var cname1 =  $(this).closest("td").next().next().find("input[type='checkbox']").attr("class");
            var cname2 =  $(this).closest("td").next().next().next().find("input[type='checkbox']").attr("class")
            $("."+cname).removeAttr("checked");
            $("."+cname1).removeAttr("checked");
        }
    });

    $('.city').on('change', function(e){
        var city = $(this).val();
        url = base_url+'Ajax/get_city_filter_data/';
        $('#map').remove();
        $.ajax({
            async:false,
            url: url,
            type:'POST',
            data:{cityname:city },
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    var doc = response['list'];
                        //                    console.log(doc);
                    var mapCords = [];
                    var valueToPush = { };
                    var tableData = '<ul id ="list">';
                    var cnts = 1;
                    for(var i = 0 ; i < doc.length ; i++){
                        mapCords.push([doc[i]['latitude'], doc[i]['longitude'],doc[i]['name'], doc[i]['picture'] ]);
                        if(doc[i]['recomend'] == "1" ){
                            tableData += '<li><div id ="wholeSeacrhData'+cnts+'">'+
                                '<div class ="viewListing" style="border:1px solid #f0f0f0;margin-top: 10px ; padding: 20px;">'+
                                '<p class ="hpyRcds"> Recommended by HomePhysican </p>';

                            tableData += '<div class="prTitle">';
                            tableData += '<span><label>Procedure Name:</label> '+doc[i]['procedure_name']+'</span>'+'</div>';
                            tableData += ' <div class="prDesc">';
                            tableData += '<span><label>Procedure description:</label> '+doc[i]['description']+'</span>'+'</div>';
                            tableData += ' <div class="prSpName">';
                            tableData += '<span><label>Specialist Name:</label> '+doc[i]['name']+'</span>';
                            tableData += '<span class ="sp_img">';
                            if(doc[i]['picture'] != ''){
                                tableData +=  '<img src ="'+doc[i]['picture']+'" class ="img-sp"/>' ;
                            }

                            tableData += '</span> </div>';
                            tableData += ' <span class ="wrkHrs">';
                            var addClass;
                            var day = doc[i]['weekday'];
                            var dayArry = day.split(',');
                            var dayList = [];
                            $.each(dayArry, function (index ,item) {
                                dayList[ index+1] = item;
                            });

                            tableData += '<ul class="weekdays">';
                            for(var k = 1 ; k<=dayList.length; k++ ){
                                if(dayList[k] == 1){
                                    tableData += '<li class="days_1 active"><a href="#">M</a></li>';
                                }

                                if(dayList[k] == 2){
                                    tableData +='<li class="days_2 active"><a href="#">T</a></li>';
                                }

                                if(dayList[k] == 3){
                                    tableData += '<li class="days_3 active"><a href="#">W</a></li>';
                                }

                                if(dayList[k] == 4){
                                    tableData += '<li class="days_4 active"><a href="#">TH</a></li>';
                                }

                                if(dayList[k] == 5){
                                    tableData +='<li class="days_5 active"><a href="#">FR</a></li>';
                                }

                                if(dayList[k] == 6){
                                    tableData += '<li class="days_6 active"><a href="#">ST</a></li>';
                                }

                                if(dayList[k] == 7){
                                    tableData +=  '<li class="days_7 active"><a href="#">SU</a></li>';
                                }
                            }

                            var prID = btoa(doc[i]['ID']);
                            var spID = btoa(doc[i]['userid']);
                            tableData +='</ul>';
                            tableData += '</span></span>';
                            tableData += '<div class="prPrice">';
                            tableData +='<span><label>Price:</label> '+doc[i]['price']+'</span>';
                            tableData +=' </div>';
                            tableData +='<input type="text" name="date" class="form-control getSlotsData input-sm parsley-validated" '+
                                ' id ="search'+cnts+'" data-required="true" placeholder ="date" /><div class ="appendedTimeSlots'+cnts+'"></div>';

                            tableData +='<input type ="hidden" name ="prID" class="prClass" value ="'+prID+'" />';
                            tableData +='<input type ="hidden" name ="spID" class="spClass" value ="'+spID+'" />';
                            tableData +='</div> </div></li>';

                            $(document).delegate("#search"+cnts ,"change",function(e){
                                displaySlots(this );
                            });
                        }else{
                            var prID = btoa(doc[i]['ID']);
                            var spID = btoa(doc[i]['userid']);

                            tableData += '<li><div id ="wholeSeacrhData'+cnts+'">'+
                                '<div class ="viewListing" style="border:1px solid #f0f0f0;margin-top: 10px ; padding: 20px;">';

                            tableData += '<div class="prTitle">';
                            tableData += '<span><label>Procedure Name:</label> '+doc[i]['procedure_name']+'</span>'+'</div>';
                            tableData += ' <div class="prDesc">';
                            tableData += '<span><label>Procedure description:</label> '+doc[i]['description']+'</span>'+'</div>';
                            tableData += ' <div class="prSpName">';
                            tableData += '<span><label>Specialist Name:</label> '+doc[i]['name']+'</span>';
                            tableData += '<span class ="sp_img">';
                            if(doc[i]['picture'] != ''){
                                tableData +=  '<img src ="'+doc[i]['picture']+'" class ="img-sp"/>' ;
                            }

                            tableData +='</span></div>';
                            tableData += ' <span class ="wrkHrs">';

                            var addClass;
                            var day = doc[i]['weekday'];
                            var dayArry = day.split(',');
                            var dayList = [];
                            $.each(dayArry, function (index ,item) {
                                dayList[ index+1] = item;
                            });

                            tableData += '<ul class="weekdays">';
                            for(var k = 1 ; k<=dayList.length; k++ ){
                                if(dayList[k] == 1){
                                    tableData += '<li class="days_1 active"><a href="#">M</a></li>';
                                }

                                if(dayList[k] == 2){
                                    tableData +='<li class="days_2 active"><a href="#">T</a></li>';
                                }

                                if(dayList[k] == 3){
                                    tableData += '<li class="days_3 active"><a href="#">W</a></li>';
                                }

                                if(dayList[k] == 4){
                                    tableData += '<li class="days_4 active"><a href="#">TH</a></li>';
                                }

                                if(dayList[k] == 5){
                                    tableData +='<li class="days_5 active"><a href="#">FR</a></li>';
                                }

                                if(dayList[k] == 6){
                                    tableData += '<li class="days_6 active"><a href="#">ST</a></li>';
                                }

                                if(dayList[k] == 7){
                                    tableData +=  '<li class="days_7 active"><a href="#">SU</a></li>';
                                }
                            }
                            tableData +='</ul>';
                            tableData += '</span></span>';
                            //                            tableData += '</div>';
                            tableData += '<div class="prPrice">';
                            tableData +='<span><label>Price:</label> '+doc[i]['price']+'</span>';
                            tableData +=' </div>';
                            tableData +=' <input type="text" name="date" class="form-control getSlotsData input-sm parsley-validated"data-required="true" '+
                                ' id ="search'+cnts+'" placeholder ="date"  /><div class ="appendedTimeSlots'+cnts+'"></div>';

                            tableData +='<input type ="hidden" name ="prID" class="prClass" value ="'+prID+'" />';
                            tableData +='<input type ="hidden" name ="spID" class="spClass" value ="'+spID+'" />';
                            tableData +='</div></div></li>';

                            $(document).delegate("#search"+cnts ,"change",function(e){
                                displaySlots(this);
                            });
                        }
                        cnts++;
                    }
                    tableData +='</ul>';
                    $('.viewListing').remove();
                    $(".newListing").append(tableData);
                    $('#list').paginate({itemsPerPage: 3});
                    $('.notFD').hide();
                    $('#Citymap').css({'width': '1170px', 'height': '450px'});
                    var latlng = new google.maps.LatLng(mapCords[0][0], mapCords[0][1]);
                    var myOptions = {
                        zoom: 2,
                        center: latlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };

                    var map = new google.maps.Map(document.getElementById("Citymap"),
                        myOptions);

                    var base_url=get_base_url();
                    var marker
                    var infowindow = new google.maps.InfoWindow({
                    });

                    var contentString
                    for(var k = 0 ; k < mapCords.length; k++){
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(mapCords[k][0], mapCords[k][1]),
                            offset: '0',
                            map: map,
                            center: latlng,
                            icon: {
                                    path: MAP_PIN,
                                    fillColor: '#0d92a7',
                                    fillOpacity: 1,
                                    strokeColor: '',
                                    strokeWeight: 0
                                },
                            map_icon_label: '<span class="map-icon map-icon-health"></span>'
                        });

                        google.maps.event.addListener(marker, 'mouseover', (function(marker, k) {
                            return function() {
                                contentString = '<div class="row maprow" id="content">'+
                                    '<div class="col-sm-4">'+
                                    '<img src ="'+base_url+mapCords[k][3]+'" class="img-circle">'+
                                    '</div>'+
                                    '<div class="col-sm-4">'+
                                    '<h4 id="firstHeading" class="firstHeading"> '+mapCords[k][2]+'</h4>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="row maprow">'+
                                    '<div class="col-sm-6">'+
                                    '<a href="#" class ="btn btn-primary btn-group-lg">'+
                                    'Booking Now </a> '+
                                    '</div>'+
                                    '</div>';
                                infowindow.setContent(contentString);
                                infowindow.open(map, marker);
                            }
                        })(marker, k));
                    }
                }else{
                    $('#Citymap').empty();
                    $('#Citymap').css({width:'',height:''});
                    $('.alert').addClass('alert-danger').show();
                    $('#notFounds').text('result not found');
                    $('.viewListing').remove();
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                }
            }
        });
        setTimeout( function(){$('#notFounds').hide();} , 3000);
    });

    var resultElement = document.getElementById('result');
    if(resultElement != null){
        noUiSlider.create(resultElement, {
            start: [1, 50000],
            step: 1000,
            connect: true,
            range: {
                'min': 1,
                'max': 50000
            }
        });

        var hrsRange = document.getElementById('hrsRanges');
        noUiSlider.create(hrsRange, {
            start: [1, 24],
            snap: true,
            range: {
                'min': 0.00,
                '2%':  0.30,
                '4%': 1.00,
                '6%': 1.30,
                '8%': 2.00,
                '10%': 2.30,
                '12%': 3.00,
                '14%': 3.30,
                '16%': 4.00,
                '18%': 4.30,
                '20%': 5.00,
                '22%': 5.30,
                '24%': 6.00,
                '26%': 6.30,
                '28%': 7.00,
                '30%': 7.30,
                '32%': 8.00,
                '34%': 8.30,
                '36%': 9.00,
                '38%': 09.30,
                '40%': 10.00,
                '42%': 10.30,
                '44%': 11.00,
                '46%': 11.30,
                '48%': 12.00,
                '50%': 12.30,
                '52%': 13.00,
                '54%': 13.30,
                '56%': 14.00,
                '58%': 14.30,
                '60%': 15.00,
                '62%': 15.30,
                '64%': 16.00,
                '66%': 16.30,
                '68%': 17.00,
                '70%': 17.30,
                '72%': 18.00,
                '74%': 18.30,
                '76%': 19.00,
                '78%': 19.30,
                '80%': 20.00,
                '82%': 20.30,
                '84%': 21.00,
                '86%': 21.30,
                '88%': 22.00,
                '90%': 22.30,
                '92%': 23.00,
                '94%': 23.30,
                'max': 24.00
            }
        });

        var hrranges = '';
        var PRranges = '';
        resultElement.noUiSlider.on('change', function( values, handle ) {
            PRranges =  resultElement.noUiSlider.get();
        });

        hrsRange.noUiSlider.on('change', function( values, handle ) {
            hrranges =  hrsRange.noUiSlider.get();
        });
    }

    var rp = 1;
    var arr= ["Lab Report", "MRI Scan", "X-Ray", "City Scan"];
    $('a#addMedicalMorerow').click(function(){
        var tableData = '<div class ="row itm" id ="new-items-'+rp+' ">' +
            '<div class ="col-sm-3"><div class ="form-group">' +
            '<h5>History Type</h5><select name="history_type[]" id ="hist" class="form-control input-sm parsley-validated"  '+
                ' data-required="true" data-required-message="Staff Category is required">';
        $.each(arr, function (index ,item) {
            tableData += '<option value='+ item  +'>' +item+ '</option>';
        });

        tableData +='</select></div></div>';

        tableData +='<div class ="col-sm-3"><div class="form-group"><h5>History Title</h5>'+
            '<input type="text" name="historytitle[]"  class="form-control" value=""/></div></div>';
        
        tableData +='<div class ="col-sm-3"><div class="form-group"><h5>History Description</h5>'+
            '<input type="text" name="desc[]"  class="form-control" value=""/></div></div>';

        tableData +='<div class ="col-sm-3"><div class="form-group"><h5>File Upload</h5>'+
            '<input type="file" name="history_files[]" value=""/></div></div>';

        tableData += '<a href="#" class="btn btn-default remove removePt" data ="new-items-'+rp+'">Remove</a>';

        $(".morePatientDoc").append(tableData);
        rp++;
        return false;
    });

    $(document).on('click','.removePt', function(){
        var rowID = $(this).attr('data');
        $('#'+rowID).remove();
        return false;
    });

    /*  AJAX CALL FOR PATIENT APPOINTMENT BOOKING */
    $('.saveApptData').click(function(){
        var formData = $('.saveBookingForPatient').serialize();
        url = base_url+'Ajax/save_patient_appt';
        $.ajax({
            url: url,
            type:'POST',
            data: {data:formData},
            cache: false,
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    var img = "<img src = http://localhost/hcareproject/assets/images/31.gif class ='loaders'/>"
                    $('.responseLoad').append(img);
                    setTimeout(function(){
                        $('.responseLoad').hide();
                        $('.viewListing').empty();
                        var book = '<div class ="BookMsg">';
                            book += '<p class="dispalyMsg"> Your Booking has been completed';
                            book += '</p></div>';
                        $('.viewListing').remove();
                        $('.addApptDetails').append(book);
                    }, 4000);
                    setTimeout(function(){
                        $('#myModal').modal('hide');
                    }, 9000);
                }else{
                    $('.addApptDetails').append('some error has occurred');
                }
            }
        });
    });

    $('.closeModal').click(function(){
        $('#myModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    })

    $('#procedure_cat_id').on('change',function (){
        var prCatID = $(this).val();
        url = base_url+'Ajax/get_pr_name_against_cat';
        $.ajax({
            url: url,
            type:'POST',
            data: {data:prCatID},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    var list = response['list'];
                    var opt = [];
                        //                        var defaults = 'select procedure name';
                    $.each(list, function (index ,item) {
                        if(list.length  > 1){
                        }else{
                            var temp = $('.showMessage');
                            $('.alert').addClass('alert-danger').show();
                            temp.text('Procedure name not available for selected category');
                            $('html, body').animate({
                                scrollTop: 0
                            }, 800);
                            setTimeout(function(){
                                $('.alert-danger').slideToggle();
                            },4000);
                            return false;
                        }
                        if(index == '0'){
                            opt += '<option value  selected = "selected">' + item.please_select + '</option>';
                        }else{
                            opt += '<option value= "'+item.ID+'">' +item.procedure_name+ '</option>';
                        }
                    });

                    $('#procedure_name_id').empty().append(opt);
                }else{
                    $('#procedure_name_id').empty();
                }
            }
        });
    });

    $('#procedure_name_id').on('change', function(){
        var name = $("#procedure_name_id option:selected").text();
        $('.hdnName').val(name);
    });

    $('.process_delete').click(function(){
        var btnid = $(this).attr('id');
        var appts =  $('.encString').attr('id');
        var json = $('#'+appts).attr('pquy');
        var tmp_date = $('#'+btnid).prev('input').prev('input').attr('xuys');
        if(json  == 'apptFixed'){
            bootbox.confirm("You have appointment on this date. Are you sure you want to delete this ?", function(result) {
                if(result){
                    var ids = $('#'+btnid).closest('ul').attr('id');
                    $('#'+ids).remove();
                    url = base_url+'Ajax/change_procedure_date_status';
                    $.ajax({
                        url: url,
                        type:'POST',
                        data :{code:tmp_date},
                        success: function(data){
                            var response = JSON.parse(data);
                            if(response['message'] == "SUCCESS") {
                            }
                        }
                    });
                    return false;
                    setTimeout(function(){
                        location.reload();
                    },3000);
                    return false;
                }
            });
        }
        if(json  == 'apptNotFixed'){
            bootbox.confirm("Are you sure you want to delete this?", function(result) {
                if(result){
                    var ids = $('#'+btnid).closest('ul').attr('id');
                    $('#'+ids).remove();
                    url = base_url+'Ajax/change_procedure_date_status';
                    $.ajax({
                        url: url,
                        type:'POST',
                        data :{code:tmp_date},
                        success: function(data){
                            var response = JSON.parse(data);
                            if(response['message'] == "SUCCESS") {
                            }
                        }
                    });
                    return false;
                    setTimeout(function(){
                        location.reload();
                    },3000);
                    return false;
                }
            });
        }
    });

    $('#spNameList').on('change',function(){
        var sp_id = $(this).val();
        setTimeout(function(){
            var rand = 1;
            url = base_url+'Ajax/get_specialist_procedure_for_Admin';
            $.ajax({
                url: url,
                type:'POST',
                data :{code:sp_id},
                success: function(data){
                    var response = JSON.parse(data);
                    if(response['message'] == "SUCCESS") {
                        var pr = response['prList'];
                        if(pr.length != 0){
                            var lt = response['list'];
                            var  tableData = '<div class ="tableRow container" style ="margin-top: 30px">' +
                             '<table class="table table-bordered"><thead><tr><th>Specialist Name </th> </th>'+
                             '<th>Procedure Catgeory</th><th>Procedure Name</th> <th>Action</th></tr></thead>';
                            $.each(pr, function (index ,item) {
                                var catg = lt[item['procedure_cat_id']];
                                var encodedString = btoa(item['ID']);
                                tableData += '<tr id = '+ encodedString +' data-row-id ='+rand+' ><td>' +  item["name"] + '</td>'+
                                    '<td>' +  catg + '</td><td>' +  item["procedure_name"] + '</td>';
                                
                                tableData +=  '<td><a href="#" class="btn btn-primary xtdisable" data-row-id='+rand+' id="xt-'+rand+'"  '+
                                    ' style="margin-top:20px">Enable</a></td></tr>';
                               rand++;
                            });
                            $ (".prced_list").html(tableData);
                        }else{
                            $('.alert').addClass('alert-danger').show();
                            $('.showMessage').text('Procedure Name not found against this match');
                            $(".prced_list").empty();
                            setTimeout(function() {   //calls click event after a certain time
                                $('.alert-danger').hide();
                            }, 2000);
                        }
                    }
                }
            });
        },2000);
    })

    $('body').on( 'click', '.xtdisable', function() {
        var rowsID = $(this).closest('tr').attr('data-row-id');
        var rowID = $(this).closest('tr').attr('id');
        var decodedString = btoa(rowID);
        var temps = $(this).attr('id');
        url = base_url+'Ajax/change_specialist_procedure_status';
        $.ajax({
            url: url,
            type:'POST',
            data :{code:decodedString},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    $('#'+temps).text("Disable");
                    $('.alert').addClass('alert-danger').show();
                    $('.showMessage').text('Status has been changed');
                    setTimeout(function() {   //calls click event after a certain time
                        $('.alert-danger').hide();
                    }, 3000);
                    return false;
                }else{
                    $('.alert').addClass('alert-danger').show();
                    $('.showMessage').text('Status not changed');
                    setTimeout(function() {   //calls click event after a certain time
                        $('.alert-danger').hide();
                    },3000);
                    return false;
                }
            }
        });
        return false;
    })

    $('.book-from').datepicker({
        format: 'yyyy-mm-dd'
    });

    $('.book-to').datepicker({
        format: 'yyyy-mm-dd'
    });

    $('.hpy-dob').datepicker({
        format: 'yyyy-mm-dd'
    });

    $('.showMessageBook').hide();

    $('.check-book').click(function(){
        var formdata = $('#admin_book').serialize();
        var rand =1;
        var url = base_url+'Ajax/get_booking_search_result';
        $.ajax({
            url :url,
            type:'POST',
            data :{list:formdata},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    var book = response['booking'];
                    var  tableData = '<div class="types well index"><div class ="tableRow container" style ="margin-top: 30px">' +
                        '<table cellpadding="0" cellspacing="0"  class="table table-striped table-bordered table_header booked-tab">'+
                        '<thead><tr><th>Specialist Name</th><th>Patient Name</th><th>Procedure Name</th><th>Booking date</th>'+
                        '<th>Booking time</th><th>Status</th> <th>More Info</th></tr></thead>';

                    $.each(book, function (index ,item) {
                        tableData += '<tr><td>' +  item['name'] + '</td><td>' +  item["username"] + '</td>'+
                        '<td>' +  item["procedure_name"] + '</td><td>' +  item["booking_date"] + '</td><td>' +  item["booking_time"] + '</td>';
     
                        if(item['status'] == 0){
                            tableData += '<td> Pending </td>';
                        }

                        if(item['status'] == 1){
                            tableData += '<td> completed </td>';
                        }

                        if(item['status'] == -1){
                            tableData += '<td> cancel </td>';
                        }

                        tableData +=  '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal'+rand+'">'+
                            'More Info</button></td></tr>';
                            rand++;
                    });

                    tableData += '<div></div>';
                    $('.all-bookings').remove();
                    $(".show-booking").html(tableData);
                 }else{
                    $('.index').remove();
                    $('.showMessageBook').show();
                    $('.showMessageBook').text('Result not found against this match');
                    setTimeout(function() {   //calls  event after a certain time
                        $('.showMessageBook').hide();
                    },4000);
                    return false;
                }
            }
        });
        return false;
    })

    $('.getProcedureList').click(function(){
        var pr_id = $(this).attr('data');
        var rand = 1;
        var url = base_url+'Ajax/get_procedure_list_for_specialist';
        $.ajax({
            url :url,
            type:'POST',
            data :{id:pr_id},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    var pr = response['pr'];
                    var prCat = response['prCat'];
                    var  tableData = '<div class="types well index">';
                    $.each(pr, function (index ,item) {
                        tableData  += '<div class ="prd-aps"><span class = "prname"> Procedure name : </span>'+
                            '<span class ="pr-name"> '+ item["procedure_name"] + '</span></div><br>';

                        tableData  += '<div class ="prd-aps"><span class = "prname"> Procedure Catgeory : </span>'+
                            '<span class ="pr-name-cat"> '+ prCat[item['procedure_cat_id']] + '</span></div><br>';

                        tableData  += '<div class ="prd-aps"><span class = "prname"> Description : </span>'+
                            '<span class ="pr-desc"> '+ item["description"] + '</span></div><br>';

                        tableData  += '<div class ="prd-aps"><span class = "prname"> Price : </span>'+
                            '<span class ="pr-price"> '+ item["price"] + '</span></div>';
                    });

                    tableData += '<div>';
                    $(".show-prced").html(tableData);
                    $('#myModalProcedure').modal('show');
                }else{
                }
            }
        });
        return false;
    })

    $('.getPatientList').click(function(){
        var p_id = $(this).attr('data');
        var rand = 1;
        var url = base_url+'Ajax/get_patient_list_for_specialist';
        $.ajax({
            url :url,
            type:'POST',
            data :{id:p_id},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    var pr = response['pt'];
                    var  tableData = '<div class="types well index">' +
                        '<table cellpadding="0" cellspacing="0"  class="table table-striped table-bordered table_header booked-tab">'+
                        '<thead><tr><th>Patient Name</th><th>Patient Address</th><th>Patient Phone</th><th>Patient city</th></tr></thead>';
                    $.each(pr, function (index ,item) {
                        tableData += '<tr><td>' +  item['username'] + '</td><td>' +  item["address"] + '</td>'+
                            '<td>' +  item["phone"] + '</td><td>' +  item["city"] + '</td>';
                        tableData +=  '</tr>';
                        rand++;
                    });
                    tableData += '<div>';
                    $(".show-Patient").html(tableData);
                    $('#myModalPatient').modal('show');
                }else{
                }
            }
        })
        var url = base_url+'Ajax/get_patient_history';
        $.ajax({
            url :url,
            type:'POST',
            data :{id:p_id},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    var phist = response['pthistory'];
                    var  tableData = '<p class ="hs-det" style ="font-size: 20px;"> History Details</p><div class="types well index">' +
                        '<table cellpadding="0" cellspacing="0"  class="table table-striped table-bordered table_header booked-tab">'+
                        '<thead><tr><th>History Type</th><th>History title</th><th>History Desc</th><th>Doc</th></tr></thead>';

                    $.each(phist, function (index ,item) {
                        tableData += '<tr><td>' +  item["history_type"] + '</td><td>' +  item["historytitle"] + '</td>'+
                        '<td>' +  item["desc"] + '</td><td>'+
                        '<a href = '+ item['files'] +' data-fancybox-group="gallery" class ="docPOPup fancybox btn btn-primary">Docs</a></td>';

                        tableData +=  '</tr>';
                        rand++;
                    });

                    tableData += '<div>';
                    $(".show-Patient-history").html(tableData);
                    $('#myModalPatient').modal('show');
                }else{
                    var msg = '<p class ="error-msg">History not available for this patient</p>'
                    $(".show-Patient-history").html(msg);
                    $('#myModalPatient').modal('show');
                }
            }
        });
        return false;
    })
});

function displaySlots(nts){
    var id = nts.id;
    var html =  $('#'+id).prev('div').attr('class');
    var prPrice = $('.'+html).clone().html();
    var htmls =  $('#'+id).prev('div').prev('span').prev('div').attr('class');
    var spname  = $('.'+htmls).clone().html();
    var title =  $('#'+id).prev('div').prev('span').prev('div').prev('div').prev('div').attr('class');
    var prTitle = $('.'+title).clone().html();
    var date= nts.value;
    if(date != ''){
        var prID = $('#'+id).next().next().attr('value');
        var spID =  $('#'+id).next().next().next().attr('value');
        var staffIds= id.replace("search", "");
        var dateData =  $("#"+id).serialize()+'&prID =' + prID+ '&spID =' + spID;
        var appends =  $("#"+id).next('div').attr("class");
        url = base_url+'Ajax/get_available_time_slot_for_patient';
        $.ajax({
            url: url,
            type:'POST',
            data: {codes:dateData},
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    var list = response['time'];
                    $('.'+appends).empty();
                    var opt = [];
                    var data = '<p class ="headings">Time Slot </p><ul class="slots-view searchSlotsData">';
                    for(var i = 0 ; i< list.length ; i++){
                       data +='<li class="time-select-div inactive btn-default day timeSlotsAV">';
                        data += '<div class="timeslots">';
                        data += '<div class="hour-row time_interval_15">';
                        data +='<div class="time-select-div space">';
                        data += '<div class="mns" data-toggle="buttons">';
                        data +='<label class="btn btn-primary btn-size-cm">';
                        data += '<input type="checkbox" name="timeSlots" class="hrsCheckValidate" '+
                            ' autocomplete="off" value=" '+list[i].time_slot+'"> '+list[i].time_slot+' </label>';
                        data += '</div></div></div></div>';
                    }
                    data += '<ul>';
                    $('.'+appends).empty().append(data);
                    return false;
                }else{
                    var html = '<p class ="notAval"> Time slot not available on this date</p>';
                    $('.'+appends).empty().append(html);
                    setTimeout(function(){
                        $('.notAval').hide();
                    }, 4000);
                    return false;
                }
            }
        });

        $('body').on( 'click', '.btn', function() {
            var slot = $(this).parent().find('input').val();
            var ids = $(this).attr('id');
                var HtmlData = '<div class="viewListing" style="border:1px solid #f0f0f0;margin-top: 10px ; padding: 20px;">';
                    HtmlData += '<div class ="prTitle">'+prTitle+'</div>';
                    HtmlData += '<div class="prSpName">'+spname+'</div>';
                    HtmlData += '<div class="prPrice">'+prPrice+'</div>';
                    HtmlData += '<div class="time"><label>Time: </label>  '+slot+' </div>';
                    HtmlData += '<div class="dates"><label>Date: </label> '+date+'</div>';
                    HtmlData += '<div class ="bookAppt">';
                    HtmlData += '<form method="post" class ="saveBookingForPatient">';
                    HtmlData += '<input type="hidden" name ="procedure_id" value="'+prID+'"/>';
                    HtmlData += '<input type="hidden" name ="specialist_id" value="'+spID+'"/>';
                    HtmlData += '<input type="hidden" name ="booking_date" value="'+date+'"/>';
                    HtmlData += '<input type="hidden" name ="booking_time" value="'+slot+'"/>';
                    HtmlData += '</form>';
                    HtmlData +='</div></div>';
            $(".addApptDetails").empty().append(HtmlData);
            $('.popup').css('visibility','visible')
            $('#myModal').modal('show');
        });
        return false;
    }
}

$(document).ajaxComplete(function () {
    $('.getSlotsData').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-3d'
    });

    $('.deleteStaff').click(function(e){
        e.preventDefault();
        //var staffIds = $(this).closest('.item').closest('.owl-item').index();
        var staffIds=$(e.target).parents('.owl-item').index();
        if( staffIds >=0){
            var owl = $("#owl-createprocedure_step1_slider");
            owl.data('owlCarousel').removeItem(staffIds);
        }
        return false;
    })

    $('#editSpDetail').on('submit',function(e){
        e.preventDefault();
        var url = base_url+'/Ajax/specialist_info_update';
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData(this),
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,
            success: function(data){
                var response = JSON.parse(data);
                if(response['message'] == "SUCCESS") {
                    $('.alert').addClass('alert-success').show();
                    $('.showMessage').text('Your information has been updated successfully');
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                    return false;
                } else {
                }
            }
        });
        return false;
    })
});

/* anirban Changes */
$(document).ready(function(){
    var counter=1;
    var flag=0;
    var baseUrl = get_base_url();
    jQuery("#datepicker").datepicker({
        //format: 'dd-mm-yyyy',
        format: 'yyyy-mm-dd',
        autoclose: true
    });
    
    //For removing staff
    jQuery(document).on('click', '#deleteStaff', function(){
        var staffid = jQuery(this).attr('staffid');
        jQuery("#staffdeleteid").val(staffid);
    });

    jQuery(document).on('click', '#staffDelete', function(e){
        e.preventDefault();
        var staffid = jQuery("#staffdeleteid").val();
        jQuery.ajax({
            url: baseUrl+'specialist/staff_delete',
            data:{'staffid' : staffid},
            type:"POST",
            cache:false,
            dataType:"json",
            success: function(response){
                console.log("Success");
                jQuery(".fancybox-overlay").hide();
                if(response.success == 1){
                    bootbox.alert(response.message, function() {
                        window.location.reload();
                    });
                }else if(response.error == 1){
                    bootbox.alert(response.message, function() {
                        window.location.reload();
                    });
                }
            },
            error: function(response){console.log(response);
                console.log("Error");
            }
        });
    });

    jQuery(document).on('click', '#cancelDelete', function(){
        jQuery(".fancybox-overlay").hide();
    });

    //For add new category
    jQuery(document).on('click', '#addCategory', function(e){
        e.preventDefault();
        var category = jQuery("#newCategory").val();
        if(category != ''){
            jQuery.ajax({
                url: baseUrl+'staffcategory/add',
                data:{'staff_cat_name' : category},
                type:"POST",
                cache:false,
                dataType:"json",
                success: function(response){
                    console.log("Success");
                    jQuery(".fancybox-overlay").hide();
                    if(response.success == 1){
                        bootbox.alert(response.message, function() {
                            window.location.reload();
                        });
                    }else if(response.error == 1){
                        bootbox.alert(response.message, function() {
                            window.location.reload();
                        });
                    }
                },
                error: function(response){console.log(response);
                    console.log("Error");
                }
            });
        }else{
            jQuery(".error").html("<strong>Category name is required.</strong>").show();
        }
    });

    //For add new staff
    jQuery(document).on('click', '#addStaff', function(e){
        e.preventDefault();
        var formData = new FormData();
        var file = jQuery("#addstaffImage")[0].files[0];
        var staffname = jQuery("#staffName").val();
        var staffcategory = jQuery("#staffcategory").val();
        if(staffname == ''){
            bootbox.alert("Staff name is required.");
        }else if(staffcategory == ''){
            bootbox.alert("Staff Category is required.");
        }else if(file == ''){
            bootbox.alert("Staff image required.");
        }else{
            formData.append("staffpic", file);
            formData.append("staff_name", staffname);
            formData.append("staff_cat_id", staffcategory);
            //console.log(formData);
            jQuery.ajax({
                url: baseUrl+'specialist/add_staff',
                data:formData,
                type:"POST",
                cache:false,
                dataType:"json",
                contentType: false,
                processData: false,
                global: false,
                success: function(response){
                    console.log("Success");
                    jQuery(".fancybox-overlay").hide();     
                    if(response.success == 1){
                        bootbox.alert(response.message, function() {
                            window.location.reload();
                        });
                    }else if(response.error == 1){
                        bootbox.alert(response.message, function() {
                            window.location.reload();
                        });
                    }
                },
                error: function(response){console.log(response);
                    console.log("Error");
                }
            });
        }
    });

    //For fetching staff details
    jQuery(document).on('click', '#staffDetails', function(e){
        e.preventDefault();
        var staffid = jQuery(this).attr('staffid');
        jQuery.ajax({
            url: baseUrl+'specialist/get_staff_details',
            data:{'staffid' : staffid},
            type:"POST",
            cache:false,
            dataType:"json",
            success: function(response){
                //console.log("Success");
                jQuery("#editstaffCategory option").each(function(index, value){
                    if(jQuery(this).val() == response.category_id){
                        jQuery(this).attr('selected', 'selected');
                    }
                });
                jQuery(".staff_popup_button_input #editstaffName").val(response.staff_name);
                jQuery("#staffID").val(response.id);
            },
            error: function(response){console.log(response);
                console.log("Error");
            }
        });
    });

    //For edit staff details
    jQuery(document).on('click', '#staffEdit', function(e){
        e.preventDefault();
        var formData = new FormData();
        var file = jQuery("#editstaffImage")[0].files[0];
        var staffname = jQuery("#editstaffName").val();
        var staffcategory = jQuery("#editstaffCategory").val();
        var staff_id = jQuery("#staffID").val();

        formData.append("ID", staff_id);
        formData.append("staffpic", file);
        formData.append("staff_name", staffname);
        formData.append("staff_cat_id", staffcategory);
        jQuery.ajax({
            url: baseUrl+'specialist/staff_edit',
            data: formData,
            type:"POST",
            cache:false,
            dataType:"json",
            contentType: false,
            processData: false,
            global: false,
            success: function(response){
                console.log("Success");
                jQuery(".fancybox-overlay").hide();
                if(response.success == 1){
                    bootbox.alert(response.message, function() {
                        window.location.reload();
                    });
                }else if(response.error == 1){
                    bootbox.alert("No changes found for update", function() {
                        window.location.reload();
                    });
                }
            },
            error: function(response){console.log(response);
                console.log("Error");
            }
        });
    });

    //For fetching particular patient appointment details
    jQuery(document).on('click', '#appointmentDetails', function(e){
        e.preventDefault();
        window.arrayvar =[];
        jQuery(".apointment_medicalhistory_box_img1, .apointment_medicalhistory_box_img2,.apointment_medicalhistory_box_img3").empty();
        jQuery(".apointment_medicalhistory_box_img4,.apointment_medicalhistory_box_img5,.apointment_medicalhistory_box_img6").empty();

        jQuery("#temperature").val('');
        jQuery("#heartbeat").val('');
        jQuery("#bloodpreassure").val('');
        jQuery("#bloodsugar").val('');
        jQuery("#patientDetails").show();

        $("#appointments_time h1 i").text('');
        $("#appointments_name h1").text('');

        var bookingid = jQuery(this).attr('bookingid');
        var patientid = jQuery(this).attr('patientid');

        jQuery("#bookingid").val(bookingid);
        jQuery("#patientid").val(patientid);

        var time=jQuery(this).closest('ul').prev("h1").text();
        var name =jQuery(this).find('span').text();
        var patientID =jQuery(this).find('span .patientid').val();
        var bookingID =jQuery(this).find('span .bookingId').val();

        jQuery.ajax({
            url: 'getPatientDetails',
            data: {'patientID':patientID, 'bookingID':bookingID},
            type:"POST",
            cache:false,
            dataType:"json",
            success: function(response){
                jQuery.each(response.patientDetails,function(key,val){
                    jQuery("#appointments_name h1").text(val.fname+" "+val.lname);
                    jQuery("#appointments_pic").attr("src", baseUrl+val.picture);
                    jQuery("#appointments_pic").css("display", 'block');
                    dob = new Date(val.dob);
                    var today = new Date();
                    var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                    jQuery(".appointments_left_block_text p").text(val.sex+'  • '+age+' years');
                });

                jQuery.each(response.checkupDetails,function(key,val){
                    jQuery("#temperature").val(val.temp);
                    jQuery("#heartbeat").val(val.heartbit);
                    jQuery("#bloodpreassure").val(val.BD);
                    jQuery("#bloodsugar").val(val.BG);
                    jQuery("#waterlevel").val(val.weight);
                    jQuery("#weight").val(val.water_level);
                    jQuery("#bodyfat").val(val.body_fat);
                });

                console.log(response.medicalHistory);
                jQuery.each(response.medicalHistory,function(key,val){
                    window.arrayvar.push(val);
                });
            }
        });
        jQuery("#appointments_time h1 i").text(time);
    });

    jQuery(document).on('click', '#addPrescription', function(e){
        e.preventDefault();
        var imagelink = '';
        var html = '';
        var medicinedetails = jQuery("#medicineDetails").val();
        var medicinedose = jQuery("#medicineDose").val();
        var medicinetime = jQuery("#medicineTime").val();

        if(medicinedetails == '' || medicinedose == '' || medicinetime == ''){
            alert("All field are required");
        }else{
            if(medicinetime == "morning"){
                imagelink = "apointment_perscription_icon1.png";
            }else if(medicinetime == "afternoon"){
                imagelink = "apointment_perscription_icon2.png";
            }else if(medicinetime == "evening"){
                imagelink = "apointment_perscription_icon1.png";
            }else if(medicinetime == "night"){
                imagelink = "apointment_perscription_icon3.png";
            }

            html = "<div class='col-md-3 container_padding_none' id='mainContainer"+counter+"'>"+
                 "<div class='apointment_perscription_icon'><img src='"+baseUrl+"assets/image/"+imagelink+"' />"+
                 "<div class='apointment_perscription_content'>"+
                 "<h2><span id='medicinetimeSpan'>"+medicinetime+"</span> - <span id='medicinedoseSpan'>"+
                 "<strong>"+medicinedose+"</strong></span></h2><span id='medicinedetailsSpan'>"+medicinedetails+"</span></div></div></div>";

            jQuery("#prescriptionDetails").append(html);
        }
    });

    jQuery(document).on('click', '#savePrescription', function(e){
        e.preventDefault(); 
        var tag = "prescription";
        var bookingid = jQuery("#bookingid").val();
        var patientid = jQuery("#patientid").val();
        var validfor = jQuery(".validfor").val();

        prescriptionArr = new Array();

        jQuery("#prescriptionDetails div[id^='mainContainer']").each(function( index,obj ){
            var medicinetime =  jQuery( this )
                                    .find("div[class^='apointment_perscription_icon']")
                                    .find("div[class^='apointment_perscription_content'] h2 #medicinetimeSpan").text();

            var medicinedoseSpan = jQuery( this )
                                    .find("div[class^='apointment_perscription_icon']")
                                    .find("div[class^='apointment_perscription_content'] h2 #medicinedoseSpan").text();

            var medicinedetailsSpan = jQuery( this )
                                        .find("div[class^='apointment_perscription_icon']")
                                        .find("div[class^='apointment_perscription_content'] #medicinedetailsSpan").text();

            prescriptionArr.push([medicinetime,medicinedoseSpan,medicinedetailsSpan]);
        });

        prescriptionJson=JSON.stringify(prescriptionArr);
        console.log(prescriptionArr);
        jQuery.ajax({
            url: baseUrl+'specialist/appointment',
            data: {'bookingid':bookingid, 'patientid':patientid, 'prescription':prescriptionJson,
                   'validfor':validfor, 'tag':tag,'flagvar':flagvar},
            type:"POST",
            dataType:"json",
            success: function(response){
                console.log("Success");
                if(response.success == 1){
                    bootbox.alert(response.message, function() {
                        window.location.reload()
                    });
                }else if(response.error == 1){
                    bootbox.alert(response.message, function() {
                        window.location.reload()
                    });
                }
            },
            error: function(response){
                console.log("Error");
            }
        });
    });

    jQuery(document).on('click', '#goBtn', function(e){
        e.preventDefault();
        var procCat = jQuery("#procedure").val();
        var procName = jQuery("#procedureCategory").val();
        var datepicker = jQuery("#datepicker").val();
        if(procCat=='' || procName=='' || datepicker==''){
           bootbox.alert("All fields are required.");
        }
        else{
            jQuery.ajax({
                url: 'appointmentFilter',
                data: {'procCat':procCat,'procName':procName,'datepicker':datepicker},
                type:"POST",
                cache:false,
                dataType:"json",
                success: function(response){
                    var count=response.length;
                    jQuery(".content_right_appointments_menu,.content_right_appointments_patients").html("");
                    jQuery(".content_right_appointments_patients").html(response.totalpatient+" patients");
                    jQuery(".content_right_appointments_titel a:eq(0)").html("");
                    jQuery(".content_right_appointments_titel a:eq(0)").html('<i class="fa fa-calendar"></i>'+response.filterDate);
                    var dataShow='';
                    jQuery.each( response.slotwiseAppointment, function( skey, sval ){
                        jQuery.each( sval, function( key, val ){
                            dataShow += '<div class="appointmentList"><h1><i class="fa fa-clock-o"></i> '+skey+'</h1>'+
                            '<ul><li> <a id="appointmentDetails" bookingid="'+val.bookingID+'" patientid="'+val.patientID+'" '+
                            ' href="javascript:void(0)"> <img src="'+baseUrl+val.pic+'">'+
                            '<span>'+val.name+'<input type="hidden" class="patientid" value="'+val.patientID+'">'+
                            '<input type="hidden" class="bookingId" value="'+val.bookingID+'"></span> </a> </li></ul></div>';
                        });
                    });
                    jQuery(".content_right_appointments_menu").append(dataShow);
                }
            });
        }
    });

    jQuery(document).on('click', '#markComplete', function(e){
        e.preventDefault();
        var bookingid = jQuery("#bookingid").val();
        //alert(bookingid);
        //var tag=0;
        if(bookingid == ''){
            bootbox.alert("Please select the patient first."); 
        }else{
            jQuery.ajax({
                url: base_url+'specialist/updatebooking',
                data: {'bookingid':bookingid,'tag':tag},
                type:"POST",
                cache:false,
                dataType:"json",
                success: function(response){
                    if(response.success == 1){
                        jQuery(".fancybox-overlay").hide();
                        bootbox.alert(response.message, function() {
                            window.location.reload();
                        });
                    }else if(response.error == 1){
                        jQuery(".fancybox-overlay").hide();
                        bootbox.alert(response.message, function() {
                            window.location.reload();
                        });
                    }
                }
            });
        }
    });

    jQuery(document).on('change', '#procedure', function(e){
        var category = jQuery('#procedure option:selected').val();
        var tag = "procedurecategory";
        var html = '';
        jQuery.ajax({
            url: baseUrl+'specialist/appointment',
            data: {'category':category, 'tag':tag},
            type:"POST",
            dataType:"json",
            success: function(response){
                console.log("Success");
                if(response.success == 1){
                    html = '<option value="">Select Procedure Category</option>';
                    if(response.procedurecategory != 0){
                        jQuery(response.procedurecategory).each(function(index, value){
                            html = html+'<option value="'+value.ID+'">'+value.procedure_name+'</option>';
                        });
                    }
                    
                    jQuery("#procedureCategory").html('');
                    jQuery("#procedureCategory").html(html);
                }else if(response.error == 1){
                }
            },
            error: function(response){
                console.log("Error");
            }
        });
    });

    jQuery(document).on('click', '#pbookingCancel', function(e){
        e.preventDefault();
        var bookingid = jQuery("#bookingid").val();
        if(bookingid != ''){
            jQuery.ajax({
                url: 'booking_cancel',
                data: {'bookingid': bookingid},
                type:"POST",
                cache:false,
                dataType:"json",
                success: function(response){
                    // console.log("Success");
                    if(response.success == 1){
                        bootbox.alert(response.message, function() {
                            window.location.reload();
                        });
                    }else if(response.error == 1){
                        bootbox.alert(response.message, function() {
                            window.location.reload();
                        });
                    }
                },
            });
        }else{
            bootbox.alert("Select Patient First");
        }
    });

    jQuery(document).on('click', '#fancyboxClose', function(){
        jQuery(".fancybox-overlay").hide();
    });
});

/* end of changes */
jQuery(document).on('click', '.deleteprocedure', function(e){
    e.preventDefault();
    var procedureid = jQuery(this).attr('pkey');
    //bootbox.alert(procedureid);
    if(procedureid != '') {
        jQuery.ajax({
            url: base_url+'specialist/delete_procedure',
            data: {'procedureid' : procedureid},
            type: "POST",
            catche : false,
            dataType : "json",
            success : function(response){
                if(response.success == 1){
                    bootbox.alert(response.message, function() {
                        window.location.reload();   
                    });
                }else if(response.error == 1){
                    bootbox.alert(response.message, function() {
                        window.location.reload();   
                    });
                }
            }
        });
    }
});

jQuery(document).on('click', '.advise_button', function(e){
    jQuery('#bookingid').val(jQuery(this).attr('bkey'));
    jQuery('#patientid').val(jQuery(this).attr('pkey'));
});

jQuery(document).ready(function(){  
    jQuery(document).on('click', '.medicalHis',function() {
        jQuery('.apointment_medicalhistory_left ul li:first').addClass("active");
        jQuery(".history_type").val('documents');
        jQuery('.apointment_medicalhistory_box_img1').empty();
        jQuery(".apointment_medicalhistory_box_img2, .apointment_medicalhistory_box_img3").css("display", "none");
        jQuery(".apointment_medicalhistory_box_img4").css("display", "none");
        jQuery(".apointment_medicalhistory_box_img5,.apointment_medicalhistory_box_img6").css("display", "none");

        jQuery(".apointment_medicalhistory_box_img1").css("display", "block");
        //console.log(window.arrayvar);
        jQuery.each(window.arrayvar, function(document_key, value) {
            if(value.history_type == 'documents'){
                jQuery('.apointment_medicalhistory_box_img1').append("<div class='apointment_medicalhistory_box_img_left'>"+
                        "<h1>"+value.historytitle+"</h1><div class='apointment_medicalhistory_report1'>"+
                        "<img src='"+base_url+"assets/images/apointment_medicalhistory_img1.png' />"+
                        "<div class='apointment_medicalhistory_report_button'><div class='apointment_medicalhistory_report_absolute'>"+
                        "<span><a href='"+base_url+value.files+"'  target='_blank'>report <i class='fa fa-arrow-down' ></i></a>"+
                        "</span></div></div></div><p>"+value.desc+"</p><h2></h2></div>");
            }
        }); 
    });     

    jQuery(document).on('click', '.apointment_medicalhistory_left li', function(e){
        var resultArray =[];
        if(window.arrayvar != ''){
            jQuery.each(window.arrayvar,function(key,value){
                if(value.history_type == 'documents'){  
                    resultArray.push({'documents'  : value});
                }
                      
                if(value.history_type == 'conditionsAllergeis')
                    {resultArray.push({'conditionsAllergeis' : value});}

                if(value.history_type == 'immuniziation')
                    {resultArray.push({'immuniziation' :  value});}

                if(value.history_type == 'surgicalProcedure')
                    {resultArray.push({'surgicalProcedure' : value});}

                if(value.history_type == 'familyHistory')
                    {resultArray.push({'familyHistory' :  value});}

                if(value.history_type == 'eyeSight')
                    {resultArray.push({'eyeSight' : value});}
            });
        }

        // console.log(resultArray);
        var currentbutton= jQuery(this); 
        jQuery('.apointment_medicalhistory_left li').removeClass("active");
        currentbutton.addClass('active');
        var getID = currentbutton.children().attr('id');
        if(getID == 'documents'){   
            jQuery('.apointment_medicalhistory_box_img1').empty();
            jQuery(".report_name").show();
            jQuery(".desc").show();
            jQuery(".apointment_medicalhistory_right_upload_button").show();
            jQuery(".report_text").show();
            jQuery(".history_type").val(getID);
            jQuery(".apointment_medicalhistory_box_img2, .apointment_medicalhistory_box_img3").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img4").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img5,.apointment_medicalhistory_box_img6").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img1").css("display", "block");

            jQuery.each(resultArray, function(document_key, docvalue) {
                if(docvalue.hasOwnProperty("documents") ){
                    jQuery('.apointment_medicalhistory_box_img1').append("<div class='apointment_medicalhistory_box_img_left'>"+
                            "<h1>"+docvalue.documents.historytitle+"</h1><div class='apointment_medicalhistory_report1'>"+
                            "<img src='"+base_url+"assets/images/apointment_medicalhistory_img1.png' />"+
                            "<div class='apointment_medicalhistory_report_button'><div class='apointment_medicalhistory_report_absolute'><span>"+
                            "<a href='"+base_url+docvalue.documents.files+"'  target='_blank'>report <i class='fa fa-arrow-down' ></i></a></span>"+
                            "</div></div></div><p>"+docvalue.documents.desc+"</p><h2></h2></div>");
                }
            });

            jQuery('input[name=report_name]').val('');
            jQuery('textarea[name=desc]').val('');              
        }else if(getID == 'conditionsAllergeis'){
            jQuery('.apointment_medicalhistory_box_img2').empty(); 
            jQuery(".apointment_medicalhistory_right_upload_button").hide();
            jQuery(".report_name").show();
            jQuery(".desc").show();
            jQuery(".report_text").hide();
            jQuery(".history_type").val(getID);
            jQuery(".apointment_medicalhistory_box_img1")
            jQuery(".apointment_medicalhistory_box_img3,.apointment_medicalhistory_box_img4").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img5,.apointment_medicalhistory_box_img6").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img2").css("display", "block");

            jQuery.each(resultArray, function(conditionsAllergeis, docvalue) {
                if(docvalue.hasOwnProperty("conditionsAllergeis") ){
                    jQuery('.apointment_medicalhistory_box_img2').append("<div class='apointment_medicalhistory_box_img_left'>"+
                        "<h1>"+docvalue.conditionsAllergeis.historytitle+"</h1><p>"+docvalue.conditionsAllergeis.desc+"</p><h2></h2></div>");
                }
            });
            jQuery('input[name=report_name]').val('');
            jQuery('textarea[name=desc]').val('');              
        }else if(getID == 'immuniziation'){
            jQuery('.apointment_medicalhistory_box_img3').empty();
            jQuery(".apointment_medicalhistory_right_upload_button").hide();
            jQuery(".report_name").show();
            jQuery(".desc").show();
            jQuery(".report_text").hide();
            jQuery(".history_type").val(getID);
            jQuery(".apointment_medicalhistory_box_img1, .apointment_medicalhistory_box_img2").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img4").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img5,.apointment_medicalhistory_box_img6").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img3").css("display", "block");
            jQuery.each(resultArray, function(immuniziation, docvalue) {
                if(docvalue.hasOwnProperty("immuniziation") ){
                    jQuery('.apointment_medicalhistory_box_img3').append("<div class='apointment_medicalhistory_box_img_left'>"+
                        "<h1>"+docvalue.immuniziation.historytitle+"</h1><p>"+docvalue.immuniziation.desc+"</p><h2></h2></div>");
                }
            });
            jQuery('input[name=report_name]').val('');
            jQuery('textarea[name=desc]').val('');              
        }else if(getID == 'surgicalProcedure'){   
            jQuery('.apointment_medicalhistory_box_img4').empty();
            jQuery(".apointment_medicalhistory_right_upload_button").hide();
            jQuery(".report_name").show();
            jQuery(".desc").show();
            jQuery(".report_text").hide();
            jQuery(".history_type").val(getID);
            jQuery(".apointment_medicalhistory_box_img1, .apointment_medicalhistory_box_img2").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img3").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img5,.apointment_medicalhistory_box_img6").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img4").css("display", "block");
            jQuery.each(resultArray, function(surgicalProcedure, docvalue) {
                if(docvalue.hasOwnProperty("surgicalProcedure") ){
                    jQuery('.apointment_medicalhistory_box_img4').append("<div class='apointment_medicalhistory_box_img_left'>"+
                        "<h1>"+docvalue.surgicalProcedure.historytitle+"</h1><p>"+docvalue.surgicalProcedure.desc+"</p><h2></h2></div>");
                }
            });

            jQuery('input[name=report_name]').val('');
            jQuery('textarea[name=desc]').val('');              
        }else if(getID == 'familyHistory'){   
            jQuery('.apointment_medicalhistory_box_img5').empty();
            jQuery(".apointment_medicalhistory_right_upload_button").hide();
            jQuery(".report_name").show();
            jQuery(".desc").show();
            jQuery(".report_text").hide();
            jQuery(".history_type").val(getID);
            jQuery(".apointment_medicalhistory_box_img1, .apointment_medicalhistory_box_img2").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img3").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img4,.apointment_medicalhistory_box_img6").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img5").css("display", "block");
            jQuery.each(resultArray, function(familyHistory, docvalue) {
                if(docvalue.hasOwnProperty("familyHistory") ){
                    jQuery('.apointment_medicalhistory_box_img5').append("<div class='apointment_medicalhistory_box_img_left'>"+
                        "<h1>"+docvalue.familyHistory.historytitle+"</h1><p>"+docvalue.familyHistory.desc+"</p><h2></h2></div>");
                }
            });
            jQuery('input[name=report_name]').val('');
            jQuery('textarea[name=desc]').val('');              
        }else if(getID == 'eyeSight'){
            jQuery('.apointment_medicalhistory_box_img6').empty();
            jQuery(".apointment_medicalhistory_right_upload_button").hide();
            jQuery(".report_name").show();
            jQuery(".desc").show();
            jQuery(".report_text").hide();
            jQuery(".history_type").val(getID);
            jQuery(".apointment_medicalhistory_box_img1, .apointment_medicalhistory_box_img2").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img3").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img4,.apointment_medicalhistory_box_img5").css("display", "none");
            jQuery(".apointment_medicalhistory_box_img6").css("display", "block");
            jQuery.each(resultArray, function(eyeSight, docvalue) {
                if(docvalue.hasOwnProperty("eyeSight") ){
                    jQuery('.apointment_medicalhistory_box_img6').append("<div class='apointment_medicalhistory_box_img_left'>"+
                        "<h1>"+docvalue.eyeSight.historytitle+"</h1><p>"+docvalue.eyeSight.desc+"</p><h2></h2></div>");
                }
            });
            jQuery('input[name=report_name]').val('');
            jQuery('textarea[name=desc]').val('');                  
        }
    });

    jQuery('#mHistoryForm').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        var history_type = jQuery(".history_type").val();
        var data = new Array();
        if(history_type == 'documents'){    
            formData.append("medicalhistoryFile", $('input[name=medicalhistoryFile]').val());
            formData.append("report_name", $('input[name=report_name]').val());
            formData.append("desc", $('textarea[name=desc]').val());
            formData.append("history_type", $('input[name=history_type]').val());
            formData.append("bookingid_name", $('input[name=bookingid_name]').val());
            formData.append("patientid_name", $('input[name=patientid_name]').val());
            formData.append("tag", 'isImage');
        }else{
            formData.append("report_name", $('input[name=report_name]').val());
            formData.append("desc", $('textarea[name=desc]').val());
            formData.append("history_type", history_type);
            formData.append("bookingid_name", $('input[name=bookingid_name]').val());
            formData.append("patientid_name", $('input[name=patientid_name]').val())
        }
        
        jQuery.ajax({
            url: base_url+'specialist/medicalHistory',
            data:formData,
            type:"POST",
            cache:false,
            dataType:"json",
            contentType: false,
            processData: false,
            encode : true,
            success: function(response){
                //console.log(response);
                if(response.success == 1){
                    bootbox.alert(response.message, function() {
                        //window.location.reload();
                        if(response.data.history_type == 'documents'){
                          jQuery('.apointment_medicalhistory_box_img1').prepend("<div class='apointment_medicalhistory_box_img_left'>"+
                            "<h1>"+response.data.historytitle+"</h1><div class='apointment_medicalhistory_report1'>"+
                            "<img src='"+base_url+"assets/images/apointment_medicalhistory_img1.png' />"+
                            "<div class='apointment_medicalhistory_report_button'><div class='apointment_medicalhistory_report_absolute'><span>"+
                            "<a href='"+base_url+response.data.files+"'  target='_blank'>report <i class='fa fa-arrow-down' ></i></a></span>"+
                            "</div></div></div><p>"+response.data.desc+"</p><h2></h2></div>");
                            window.arrayvar.unshift(response.data);
                        }else if(response.data.history_type == 'conditionsAllergeis'){
                            jQuery('.apointment_medicalhistory_box_img2').prepend("<div class='apointment_medicalhistory_box_img_left'>"+
                                "<h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>");
                                    window.arrayvar.unshift(response.data);
                        }else if(response.data.history_type == 'immuniziation'){
                            jQuery('.apointment_medicalhistory_box_img3').prepend("<div class='apointment_medicalhistory_box_img_left'>"+
                                "<h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>");
                            window.arrayvar.unshift(response.data);
                        }else if(response.data.history_type == 'surgicalProcedure'){
                            jQuery('.apointment_medicalhistory_box_img4').prepend("<div class='apointment_medicalhistory_box_img_left'>"+
                                "<h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>");
                            window.arrayvar.unshift(response.data);
                        }else if(response.data.history_type == 'familyHistory'){
                            jQuery('.apointment_medicalhistory_box_img5').append("<div class='apointment_medicalhistory_box_img_left'>"+
                                "<h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>");
                            window.arrayvar.unshift(response.data);
                        }else if(response.data.history_type == 'eyeSight'){
                            jQuery('.apointment_medicalhistory_box_img6').prepend("<div class='apointment_medicalhistory_box_img_left'>"+
                                "<h1>"+response.data.historytitle+"</h1><p>"+response.data.desc+"</p><h2></h2></div>");
                            window.arrayvar.unshift(response.data);
                        }   

                        jQuery('input[name=report_name]').val('');
                        jQuery('textarea[name=desc]').val('');                                                                      
                    });
                }else if(response.error == 1){
                    bootbox.alert(response.message, function() {
                    });
                }
            },
            error: function(response){
                console.log(response);
                console.log("Error");
            }
        });
    });
});

function checkIfArrayIsUnique(myArray) 
{
    for (var i = 0; i < myArray.length; i++) 
    {
        for (var j = 0; j < myArray.length; j++) 
        {
            if (i != j) 
            {                    
                if (myArray[i] == myArray[j] && myArray[i].trim()!='') 
                {
                    return true; // means there are duplicate values
                }
            }
        }
    }
    return false; // means there are no duplicate values.
}