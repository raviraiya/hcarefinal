$(document).ready(function(){
$(document).on('click','.updateworkingdetails', function(){
    var dayid= $(this).attr('dir');

    var frm_val= $("#timepickerfrm"+dayid).val();

    var to_val= $("#timepickerto"+dayid).val();

    // var status= $("#workingstatus"+dayid).val();

    var hospital_id= $(".hospitalid"+dayid).val();

    var user_id= $(".userid"+dayid).val();

    $.ajax({
        type: 'POST',
        url: base_url+'specialist/update_working_hours',
        data: {'userid': user_id,'houseid': hospital_id,'dayid':dayid,'from_hr':frm_val,'to_hr':to_val},
        success: function(response) {
            window.location.href=base_url+"specialist/hospital";
        }
    });
});

$(document).on("click","#facilityAdd",function(){

    var hospitalid= $(".hospital_id").val();
    var userid= $(".useridhidden").val();
    var facilityname= $(".facilityNamePopup").val();
    //var facilitydesc= $(".facilitydesc").val();
    //var facilityothers= $(".facilityothers").val();

    if(facilityname==""){
        $(".error").empty();
        $(".error").append("Please fill Up All Fields");
    }
    else{
        $(".error").empty();
        $.ajax({
            type: 'POST',
            url: base_url+'specialist/add_hfaciliy',
            dataType:"json",
            data: {'userid': userid,'hospitalid': hospitalid,'facilityname':facilityname},
            success: function(response) {


                if(response.message=='success'){
                    window.location.href=base_url+"specialist/hospital";
                }
            }
        });
    }

})

$(document).on("click",".facilityDelete",function(){
    var facilityid= $(this).attr('id');
    $.ajax({
        type: 'POST',
        url: base_url+'/hospital/delete_hfaciliy_details',
        dataType:"json",
        data: {'facilityid': facilityid},
        success: function(response) {
            if(response.message=='success'){
                window.location.href=base_url+"specialist/hospital";
            }
        }
    });

})

$(document).on("click","#serviceAdd",function(){

    var hospitalid= $(".hospital_id").val();
    var userid= $(".useridhidden").val();
    var servicename= $(".serviceNamePopup").val();
    //var facilitydesc= $(".facilitydesc").val();
    //var facilityothers= $(".facilityothers").val();


    if(servicename==""){
        $(".errorservice").empty();
        $(".errorservice").append("Please fill the Fields");
    }
    else{
        $(".errorservice").empty();
        $.ajax({
            type: 'POST',
            url: base_url+'specialist/add_hservice',
            dataType:"json",
            data: {'userid': userid,'hospitalid': hospitalid,'servicename':servicename},
            success: function(response) {


                if(response.message=='success'){
                    window.location.href=base_url+"specialist/hospital";
                }
            }
        });
    }

})

$(document).on("click","#invitestaff",function(){

    var specialistId= $("#specialistId").val();
    var specialistemail= $("#specialistemail").val();


    if(specialistId=="" | specialistemail==""){
        $(".errorinvitestaff").empty();
        $(".errorinvitestaff").append("Please fill the Fields");
    }
    else{
        $(".errorinvitestaff").empty();
        $.ajax({
            type: 'POST',
            url: base_url+'specialist/invite_hstaff',
            dataType:"json",
            data: {'specialistId': specialistId,'specialistemail': specialistemail},
            success: function(response) {
                console.log(response);

                if(response.message=='success'){

                    console.log(response);
                    //window.location.href=base_url+"/hospital";
                }
            }
        });
    }

})



jQuery('#facilityPopup').on('beforeItemRemove', function(event){
    event.preventDefault();
    var strconfirm = confirm("Are you sure you want to delete?");
    if (strconfirm == true){
        var tag = event.item;
        var hospitalId=jQuery('.hospital_id').val();
        // Do some processing here

        if (!event.options || !event.options.preventPost) {
            jQuery.ajax({
                url: base_url+"specialist/delete_hfaciliy",
                data: {'tag':tag,'hospitalId':hospitalId},
                type:"POST",
                cache:false,
                dataType:"json",
                success: function(response){
                    console.log(response);

                },
                error: function(response){
                    console.log(response);
                    console.log("Error");
                }
            });
        }
    }else{
        return false;
    }

});

<!--------------------------Used for remove facilities from input tag----------------------------->

jQuery('#facility').on('beforeItemRemove', function(event){
    event.preventDefault();
    var strconfirm = confirm("Are you sure you want to delete?");
    if (strconfirm == true){
        var tag = event.item;
		 var hospitalId=jQuery('.hospital_id').val();
//var hospitalId= "<?php echo $this->session->userdata('hospital_id'); ?>";
// Do some processing here

        if (!event.options || !event.options.preventPost) {
            jQuery.ajax({
                url: base_url+"specialist/delete_hfaciliy",
                data: {'tag':tag,'hospitalId':hospitalId},
                type:"POST",
                cache:false,
                dataType:"json",
                success: function(response){
                    console.log(response);
					 console.log("success");
					 window.location.href=base_url+"specialist/hospital";

                },
                error: function(response){
                    console.log(response);
                    alert("Error");
                }
            });
        }
    }else{
        return false;
    }

});

<!--------------------------Used for remove services from input tag----------------------------->

jQuery('#services').on('beforeItemRemove', function(event){
    event.preventDefault();
    var strconfirm = confirm("Are you sure you want to delete?");
	 var hospitalid= $(".hospital_id_server").val();
    if (strconfirm == true){
        var tag = event.item;

//var hospitalId= <?php echo $this->session->userdata('hospital_id'); ?>
// Do some processing here

        if (!event.options || !event.options.preventPost) {
            jQuery.ajax({
                url: base_url+"specialist/delete_hservice",
                data: {'tag':tag,'hospitalId':hospitalid},
                type:"POST",
                cache:false,
                dataType:"json",
                success: function(response){
                    // alert('success');
                    console.log(response);
					 window.location.href=base_url+"/specialist/hospital";
                }
            });
        }
    }else{
        return false;
    }

});
<!--------------------------Used for remove services from input tag----------------------------->

jQuery('#servicePopup').on('beforeItemRemove', function(event){
    event.preventDefault();
    var strconfirm = confirm("Are you sure you want to delete?");
	var hospitalid= $(".hospital_id").val();
    if (strconfirm == true){
        var tag = event.item;

//var hospitalId= <?php echo $this->session->userdata('hospital_id'); ?>
// Do some processing here

        if (!event.options || !event.options.preventPost) {
            jQuery.ajax({
                url: base_url+"specialist/delete_hservice",
                data: {'tag':tag,'hospitalId':hospitalId},
                type:"POST",
                cache:false,
                dataType:"json",
                success: function(response){
                    // alert('success');
                    console.log(response);

                }
            });
        }
    }else{
        return false;
    }

});


});
    
                
         