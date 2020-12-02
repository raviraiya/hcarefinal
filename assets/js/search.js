$(document).ready(function() {


//---------- check logged user ------------------//

  var base_url = get_base_url();
  var loggedin="";

  var url = base_url+'/Search/check_logged_user';
  	$.ajax({

  		url : url,
  		data : '',
  		 type:'GET',

  		   success: function(data){

  			loggedin = data;
  		}

  	});

      //  ---------- admin side add sp --------------------//
    $('.centerLoder').hide();
    $('.adminaddsp').click(function(){
            var frm = $('#adminAddSp').serialize();
            url = base_url+'Ajax/save_admin_sp_detail'
            $('.centerLoder').show();
             $.ajax({
                   url : url ,
                   type : 'POST',
                   data : {fmdata : frm } ,                    
                   success: function(data){    
                        var response = JSON.parse(data);
                         if(response['message'] == "SUCCESS") {
                            setTimeout(function(){
                                $('.alert').addClass('alert-success').show();
                                $('.alert-success').text('specialist saved successfuly');
                                $('.centerLoder').hide();   
                                return false;
                                 } , 700) ;
                               
                          }else{
                               $('.alert').addClass('alert-danger').show();
                               $('.alert-danger').text('some errro has occurred');
                               return false; 
                          }
                    },
                    error: function (xhr, status, error) {
                            console.log(error);
                }

             });
         return false;   

    })
//-------------------end of block-------------------------//

//--------------------- admin add patient details -------------------//

    $('.centerLoder').hide();
    $('.adminaddPat').click(function(){
            var frm = $('#adminaddPatient').serialize();
            url = base_url+'Ajax/save_admin_patient_detail'
            $('.centerLoder').show();
             $.ajax({
                   url : url ,
                   type : 'POST',
                   data : {fmdata : frm } ,                    
                   success: function(data){    
                        var response = JSON.parse(data);
                         if(response['message'] == "SUCCESS") {
                            setTimeout(function(){
                                $('.alert').addClass('alert-success').show();
                                $('.alert-success').text('Patient saved successfuly');
                                $('.centerLoder').hide();  
                                    location.reload();   
                                 } , 700) ;
                               
                          }else{
                               $('.alert').addClass('alert-danger').show();
                               $('.alert-danger').text('some errro has occurred');
                               location.reload();
                          }
                    },
                    error: function (xhr, status, error) {
                            console.log(error);
                }
             });
              return false;      
    })

 // ----------------end of block---------------------------//

// -------------- admin add homephy details ------------------//

$('.centerLoder').hide();
    $('.adminaddHpy').click(function(){
            var frm = $('#adminaddPatient').serialize();
            url = base_url+'Ajax/save_admin_homephy_detail'
            $('.centerLoder').show();
             $.ajax({
                   url : url ,
                   type : 'POST',
                   data : {fmdata : frm } ,                    
                   success: function(data){    
                        var response = JSON.parse(data);
                         if(response['message'] == "SUCCESS") {
                            setTimeout(function(){
                                $('.alert').addClass('alert-success').show();
                                $('.alert-success').text('Patient saved successfuly');
                                $('.centerLoder').hide();  
                                    location.reload();   
                                 } , 700) ;
                               
                          }else{
                               $('.alert').addClass('alert-danger').show();
                               $('.alert-danger').text('some errro has occurred');
                               location.reload();
                          }
                    },
                    error: function (xhr, status, error) {
                            console.log(error);
                }

             });
             return false;   

    })

 // -------------------end of block---------------------//

// ----- change status for specialist--------------------//

    $('.changestats').click(function(){
             var id = $(this).attr('spid');

             url = base_url+'Ajax/change_sp_status'
               $.ajax({
                   url : url ,
                   type : 'POST',
                   data : {sid : id } ,                    
                   success: function(data){    
                        var response = JSON.parse(data);
                         if(response['message'] == "SUCCESS") {
                            setTimeout(function(){
                                    location.reload();   
                                 } , 300) ;
                               
                          }else{
                               $('.alert').addClass('alert-danger').show();
                               $('.alert-danger').text('some errro has occurred');
                               location.reload();
                               return false;
                          }
                    },
                    error: function (xhr, status, error) {
                            console.log(error);
                }

             });
             return false;   

    });


//------------------------- end of block-----------------------------------------//

//-------------------- change status for patient ------------------------//

$('.changestatsPat').click(function(){
             var id = $(this).attr('spid');

             url = base_url+'Ajax/change_patient_status'
               $.ajax({
                   url : url ,
                   type : 'POST',
                   data : {sid : id } ,                    
                   success: function(data){    
                        var response = JSON.parse(data);
                         if(response['message'] == "SUCCESS") {
                            setTimeout(function(){
                                    location.reload();   
                                 } , 300) ;
                               
                          }else{
                               $('.alert').addClass('alert-danger').show();
                               $('.alert-danger').text('some errro has occurred');
                               location.reload();
                               return false;
                          }
                    },
                    error: function (xhr, status, error) {
                            console.log(error);
                }

             });
             return false;   
    });

// -------------end of block-----------------------------//


// --------------- change status for homephy ------------------------//

    $('.changestatsHhy').click(function(){
             var id = $(this).attr('spid');
             url = base_url+'Ajax/change_hphy_status'
               $.ajax({
                   url : url ,
                   type : 'POST',
                   data : {sid : id } ,                    
                   success: function(data){    
                        var response = JSON.parse(data);
                         if(response['message'] == "SUCCESS") {
                            setTimeout(function(){
                                    location.reload();   
                                 } , 300) ;
                               
                          }else{
                               $('.alert').addClass('alert-danger').show();
                               $('.alert-danger').text('some errro has occurred');
                               location.reload();
                               return false;
                          }
                    },
                    error: function (xhr, status, error) {
                            console.log(error);
                }

             });
             return false;   
    });

//---------------------end of block----------------//

//---------------- admin edit specialist detail -----------------------// 

    $('.adminSpEdit').click(function(){
            var ids = $(this).attr('spid');
            url = base_url+'Ajax/admin_edit_sp_detail'
             $.ajax({
                   url : url ,
                   type : 'POST',
                   data : {id : ids } ,                    
                   success: function(data){    
                        var response = JSON.parse(data);
                         if(response['message'] == "SUCCESS") {
                            var splist = response['splist'];
                               var pd = '<div class ="editablesp"></div>';
                              var frmshow = '<div id="myModaleditSp" class="modal fade" role="dialog">'+
                                            '<div class="modal-dialog">'+
                                                <!-- Modal content-->
                                                '<div class="modal-content">'+
                                                    '<div class="modal-header">'+
                                                        '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
                                                        '<h4 class="modal-title">Edit Specialist </h4>'+
                                                    '</div>'+
                                                    '<p class="errorMessage alert"></p>'+
                                                    '<div class="modal-body">'+
                                                         '<div class="container_padding_none">'+
                                                              '<div class="content_sign_up_page_right setheight">'+
                                                                '<div class="content_sign_up_page_table_right">'+
                                                                  '<div class="content_sign_up_page_cell_right">'+
                                                                       '<form name ="adminaddsp" method ="post" action = "" id ="editSp">'+
                                                                        '<input placeholder="Enter first name" type="hidden" name="editSpdata" value ="1" />'+ 
                                                                        '<input placeholder="Enter first name" type="hidden" name="id" value ="'+splist.ID+'" />'+ 
                                                                        '<input placeholder="Enter first name" type="text" name="fname" value ="'+splist.fname+'" />'+
                                                                        '<input placeholder="Enter last name" type="text" name="lname" value ="'+splist.lname+'"  />'+
                                                                        '<input placeholder="Enter username" type="text" name="name" class ="urname" value ="'+splist.name+'" />'+
                                                                        '<input placeholder="Enter email address" type="email" name="email" class ="email" value ="'+splist.email+'" />'+
                                                                         '<button type ="submit" class ="registerAndBooksd"  id ="registerAndBooktyt"> save </button>'+
                                                                    '</div>'+
                                                                    '</div>'+
                                                            '</div>'+
                                                        '</form>'+
                                                    '</div></div></div></div></div> </div> </div> </div>';      

                                                    $(".editablesp").html(frmshow);
                                                    $("#myModaleditSp").modal('show');
                               
                          }else{
                               $('.alert').addClass('alert-danger').show();
                               $('.alert-danger').text('some errro has occurred');
                               return false; 
                          }
                    },
                    error: function (xhr, status, error) {
                            console.log(error);
                }

             });
             return false;   

    })
 // -------------------end of block-------------------------//


//---------------- admin edit patient detail -----------------------// 

    $('.adminPatEdit').click(function(){
            var ids = $(this).attr('spid');
            console.log(ids);
            url = base_url+'Ajax/admin_edit_patient_detail'
             $.ajax({
                   url : url ,
                   type : 'POST',
                   data : {id : ids } ,                    
                   success: function(data){    
                        var response = JSON.parse(data);

                          console.log(response);

                         if(response['message'] == "SUCCESS") {
                            var splist = response['splist'];
                               var pd = '<div class ="editablesp"></div>';
                              var frmshow = '<div id="myModaleditSp" class="modal fade" role="dialog">'+
                                            '<div class="modal-dialog">'+
                                                <!-- Modal content-->
                                                '<div class="modal-content">'+
                                                    '<div class="modal-header">'+
                                                        '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
                                                        '<h4 class="modal-title">Edit Specialist </h4>'+
                                                    '</div>'+
                                                    '<p class="errorMessage alert"></p>'+
                                                    '<div class="modal-body">'+
                                                         '<div class="container_padding_none">'+
                                                              '<div class="content_sign_up_page_right setheight">'+
                                                                '<div class="content_sign_up_page_table_right">'+
                                                                  '<div class="content_sign_up_page_cell_right">'+
                                                                       '<form name ="adminaddsp" method ="post" action = "" id ="editSp">'+
                                                                        '<input placeholder="Enter first name" type="hidden" name="editSpdata" value ="1" />'+ 
                                                                        '<input placeholder="Enter first name" type="hidden" name="id" value ="'+splist.ID+'" />'+ 
                                                                        '<input placeholder="Enter first name" type="text" name="fname" value ="'+splist.fname+'" />'+
                                                                        '<input placeholder="Enter last name" type="text" name="lname" value ="'+splist.lname+'"  />'+
                                                                        '<input placeholder="Enter username" type="text" name="name" class ="urname" value ="'+splist.name+'" />'+
                                                                        '<input placeholder="Enter email address" type="email" name="email" class ="email" value ="'+splist.email+'" />'+
                                                                         '<button type ="submit" class ="registerAndBooksd"  id ="registerAndBooktyt"> save </button>'+
                                                                    '</div>'+
                                                                    '</div>'+
                                                            '</div>'+
                                                        '</form>'+
                                                    '</div></div></div></div></div> </div> </div> </div>';      

                                                    $(".editablesp").html(frmshow);
                                                    $("#myModaleditSp").modal('show');
                               
                          }else{
                               $('.alert').addClass('alert-danger').show();
                               $('.alert-danger').text('some errro has occurred');
                               return false; 
                          }
                    },
                    error: function (xhr, status, error) {
                            console.log(error);
                }

             });
             return false;   

    })
 // -------------------end of block-------------------------//


//---------------- admin edit homephy detail -----------------------// 

    $('.adminHomephyEdit').click(function(){
            var ids = $(this).attr('spid');
            url = base_url+'Ajax/admin_edit_homephy_detail'
             $.ajax({
                   url : url ,
                   type : 'POST',
                   data : {id : ids } ,                    
                   success: function(data){    
                        var response = JSON.parse(data);
                         if(response['message'] == "SUCCESS") {
                            var splist = response['splist'];
                               var pd = '<div class ="editablesp"></div>';
                              var frmshow = '<div id="myModaleditSp" class="modal fade" role="dialog">'+
                                            '<div class="modal-dialog">'+
                                                <!-- Modal content-->
                                                '<div class="modal-content">'+
                                                    '<div class="modal-header">'+
                                                        '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
                                                        '<h4 class="modal-title">Edit Specialist </h4>'+
                                                    '</div>'+
                                                    '<p class="errorMessage alert"></p>'+
                                                    '<div class="modal-body">'+
                                                         '<div class="container_padding_none">'+
                                                              '<div class="content_sign_up_page_right setheight">'+
                                                                '<div class="content_sign_up_page_table_right">'+
                                                                  '<div class="content_sign_up_page_cell_right">'+
                                                                       '<form name ="adminaddsp" method ="post" action = "" id ="editSp">'+
                                                                        '<input placeholder="Enter first name" type="hidden" name="editSpdata" value ="1" />'+ 
                                                                        '<input placeholder="Enter first name" type="hidden" name="id" value ="'+splist.ID+'" />'+ 
                                                                        '<input placeholder="Enter first name" type="text" name="fname" value ="'+splist.fname+'" />'+
                                                                        '<input placeholder="Enter last name" type="text" name="lname" value ="'+splist.lname+'"  />'+
                                                                        '<input placeholder="Enter username" type="text" name="name" class ="urname" value ="'+splist.name+'" />'+
                                                                        '<input placeholder="Enter email address" type="email" name="email" class ="email" value ="'+splist.email+'" />'+
                                                                         '<button type ="submit" class ="registerAndBooksd"  id ="registerAndBooktyt"> save </button>'+
                                                                    '</div>'+
                                                                    '</div>'+
                                                            '</div>'+
                                                        '</form>'+
                                                    '</div></div></div></div></div> </div> </div> </div>';      

                                                    $(".editablesp").html(frmshow);
                                                    $("#myModaleditSp").modal('show');
                               
                          }else{
                               $('.alert').addClass('alert-danger').show();
                               $('.alert-danger').text('some errro has occurred');
                               return false; 
                          }
                    },
                    error: function (xhr, status, error) {
                            console.log(error);
                }

             });
             return false;   

    })
 // -------------------end of block-------------------------//


    
// ------------- verify licence for specialist ----------------//


    $('.verifyLicence').click(function(){
            var ids = $(this).attr('spID');
            url = base_url+'Ajax/get_sp_licence_list'
             $.ajax({
                   url : url ,
                   type : 'POST',
                   data : {id : ids } ,                    
                   success: function(data){    
                        var response = JSON.parse(data);
                         if(response['message'] == "SUCCESS") {
                            var splist = response['splist'];
                               var pd = '<div class ="editablesp"></div>';
                              var frmshow = '<div id="myModaleditSp" class="modal fade" role="dialog">'+
                                            '<div class="modal-dialog">'+
                                                <!-- Modal content-->
                                                '<div class="modal-content">'+
                                                    '<div class="modal-header">'+
                                                        '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
                                                        '<h4 class="modal-title">Verify Licence </h4>'+
                                                    '</div>'+
                                                    '<p class="errorMessage alert"></p>'+
                                                    '<div class="modal-body">'+
                                                    '<div class ="centerLoder" style ="text-align: center; z-index: 99999;position: relative; display:none;"><img src ="'+base_url+'/assets/image/gif-load.gif" class ="sp-lds"> </div>'+
                                                         '<div class="container_padding_none">'+
                                                              '<div class="content_sign_up_page_right setheight">'+
                                                                '<div class="content_sign_up_page_table_right">'+
                                                                  '<div class="content_sign_up_page_cell_right">'+
                                                                       '<form name ="adminaddsp" method ="post" action = "" id ="editSp">'+
                                                                        '<input  type="hidden" name="userid" class ="spverfy" value ="'+splist.userid+'" />'+ 
                                                                            '<h5> Licence no</h5>'+ 
                                                                        '<input placeholder="Enter last name" type="text" name="licence_no" value ="'+splist.licence_no+'"  />'+
                                                                          '<h5> Licence city</h5>'+ 
                                                                        '<input placeholder="Enter first name" type="text" name="licence_city" value ="'+splist.licence_city+'" />'+
                                                                            '<h5> Licence state</h5>'+ 
                                                                        '<input placeholder="Enter username" type="text" name="name" class ="licence_state" value ="'+splist.licence_state+'" />'+
                                                                            '<h5> Licence zip</h5>'+ 
                                                                        '<input placeholder="Enter email address" type="text" name="licence_zip" class ="licencezip" value ="'+splist.licence_zip+'" />'+
                                                                         '<button type ="button" class ="vefirynow"  id ="vefirynows" idsp = "'+splist.userid+'"> verify </button>'+
                                                                    '</div>'+
                                                                    '</div>'+
                                                            '</div>'+
                                                        '</form>'+
                                                    '</div></div></div></div></div> </div> </div> </div>';      

                                                    $(".editablesp").html(frmshow);
                                                    $("#myModaleditSp").modal('show');
                               
                          }else{
                               $('.alert').addClass('alert-danger').show();
                               $('.alert-danger').text('some errro has occurred');
                               return false; 
                          }
                    },
                    error: function (xhr, status, error) {
                            console.log(error);
                }
             }) ;
        return false;
    })


 $('body').on( 'click', '.vefirynow', function(e) {
            var kid  = $(this).attr('idsp')
             $('.centerLoder').show();
            url = base_url+'Ajax/change_licence_status_for_sp'
               $.ajax({
                   url : url ,
                   type : 'POST',
                   data : {sid : kid } ,                    
                   success: function(data){    
                        var response = JSON.parse(data);
                         if(response['message'] == "SUCCESS") {

                            setTimeout(function(){
                                $('.alert').addClass('alert-success').show();
                                $('.alert-success').text('licence status saved successfuly');
                                $('.centerLoder').hide();   
                                location.reload();
                                return false;
                                 } , 700) ;
                               
                          }else{
                               $('.alert').addClass('alert-danger').show();
                               $('.alert-danger').text('some errro has occurred');
                               // location.reload();
                               return false;
                          }
                    },
                    error: function (xhr, status, error) {
                            console.log(error);
                }

             });

            return false;

    })
// ---------------------- end of block -----------------------------//



//---------------------verify licence for homephysican ------------------------//

$('.verifyLicenceHphy').click(function(){

            var ids = $(this).attr('spID');
            url = base_url+'Ajax/get_hphy_licence_list'
             $.ajax({
                   url : url ,
                   type : 'POST',
                   data : {id : ids } ,                    
                   success: function(data){    
                        var response = JSON.parse(data);
                         if(response['message'] == "SUCCESS") {
                            var splist = response['splist'];
                               var pd = '<div class ="editablesp"></div>';
                              var frmshow = '<div id="myModaleditSp" class="modal fade" role="dialog">'+
                                            '<div class="modal-dialog">'+
                                                <!-- Modal content-->
                                                '<div class="modal-content">'+
                                                    '<div class="modal-header">'+
                                                        '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
                                                        '<h4 class="modal-title">Verify Licence </h4>'+
                                                    '</div>'+
                                                    '<p class="errorMessage alert"></p>'+
                                                    '<div class="modal-body">'+
                                                    '<div class ="centerLoder" style ="text-align: center; z-index: 99999;position: relative; display:none;"><img src ="'+base_url+'/assets/image/gif-load.gif" class ="sp-lds"> </div>'+
                                                         '<div class="container_padding_none">'+
                                                              '<div class="content_sign_up_page_right setheight">'+
                                                                '<div class="content_sign_up_page_table_right">'+
                                                                  '<div class="content_sign_up_page_cell_right">'+
                                                                       '<form name ="adminaddsp" method ="post" action = "" id ="editSp">'+
                                                                        '<input  type="hidden" name="userid" class ="spverfy" value ="'+splist.userid+'" />'+ 
                                                                         '<h5> Licence no</h5>'+ 
                                                                        '<input placeholder="Enter last name" type="text" name="licence_no" value ="'+splist.licence_no+'"  />'+
                                                                           '<h5> Licence city</h5>'+ 
                                                                        '<input placeholder="Enter first name" type="text" name="licence_city" value ="'+splist.licence_city+'" />'+
                                                                         '<h5> Licence state</h5>'+ 
                                                                        '<input placeholder="Enter username" type="text" name="name" class ="licence_state" value ="'+splist.licence_state+'" />'+
                                                                         '<h5> Licence zip</h5>'+ 
                                                                        '<input placeholder="Enter email address" type="text" name="licence_zip" class ="licencezip" value ="'+splist.licence_zip+'" />'+
                                                                         '<button type ="button" class ="vefirynowhPHY"  id ="vefirynowphy" idsp = "'+splist.userid+'"> verify </button>'+
                                                                    '</div>'+
                                                                    '</div>'+
                                                            '</div>'+
                                                        '</form>'+
                                                    '</div></div></div></div></div> </div> </div> </div>';      
                                                    $(".editablesp").html(frmshow);
                                                    $("#myModaleditSp").modal('show');
                               
                          }else{
                               $('.alert').addClass('alert-danger').show();
                               $('.alert-danger').text('some errro has occurred');
                               return false; 
                          }
                    },
                    error: function (xhr, status, error) {
                            console.log(error);
                }

             })   
    })


$('body').on( 'click', '.vefirynowhPHY', function(e) {
             var kid  = $(this).attr('idsp')
             $('.centerLoder').show();
              url = base_url+'Ajax/change_licence_status_for_Hphy'
               $.ajax({
                   url : url ,
                   type : 'POST',
                   data : {sid : kid } ,                    
                   success: function(data){    
                        var response = JSON.parse(data);
                         if(response['message'] == "SUCCESS") {
                            setTimeout(function(){
                                $('.alert').addClass('alert-success').show();
                                $('.alert-success').text('licence status saved successfuly');
                                $('.centerLoder').hide();   
                                location.reload();
                                return false;
                                 } , 700) ;
                               
                          }else{
                               $('.alert').addClass('alert-danger').show();
                               $('.alert-danger').text('some errro has occurred');
                               // location.reload();
                               return false;
                          }
                    },
                    error: function (xhr, status, error) {
                            console.log(error);
                }

             });
            return false;
    })


//--------------------end of block---------------------------------------//


 // ------------------search block-------------------------//


        $('.solidSearch').on('click',function(){

                if($('.btn').hasClass('active')){
                        var child = $('.active').find('input').attr('value');
                }
                 
              if(child == undefined){
                   child = ''; 
              } 

             var seletedPrc = $('#procedureCat').val();
              if(seletedPrc == ''){
                   bootbox.alert("Please find procedure first");
                   return false; 
              }else{
                    var search = [];
                    var frmdata = $('#search_prc').serialize()+'&childcheck =' + child ;
                    var request, timeout;
                    var processing=false;
                    timeout = setTimeout(function(){
                            if (!processing){
                                processing=true;
                                var url = base_url+'/Ajax/get_search_data_for_filter';
                                request = $.ajax({
                                    url: url,
                                    type:  'POST',
                                    data: {list:frmdata},
                                    success: function(data){
                                        var response = JSON.parse(data);
                                        if(response['message'] == "SUCCESS") {
                                            var data = response['search'] ;
                                            var mapCords= [];
                                            var searchData='<div class ="showSlots"></div>';
                                            for(var i = 0 ; i < data.length; i++){
                                                mapCords.push([data[i]['latitude'], data[i]['longitude'],data[i]['name'], data[i]['picture'],data[i]['ID'],data[i]['userid'] ]);
                                                     searchData += '<div class="patient_content_right_box_border_bottom">'+
                                                                    '<div class="patient_content_right_box_top">'+
                                                                        '<div class="patient_book_appointment_left">'+
                                                                          '<img src= "'+base_url+data[i]['picture']+'"  id ="sp-img"  style ="border-radius: 51%; width: 68px;"/>'+
                                                                             '<div class="patient_book_appointment_left_text">'+
                                                                                '<h1 class ="sp-name">'+data[i]['name']+'</h1>'+
                                                                                      '<span>'+data[i].title+'</span></div>'+
                                                                                '</div>'+
                                                                                '<div class="patient_book_appointment_right">'+
                                                                                    '<h1 class ="sp-price">Price: ' +data[i]['from_price']+'  - '+data[i]['to_price']+' </h1>'+
                                                                                     '<a href="#" class="fancybox getHrsSlots" data-toggle="modal" data-target="#modalslots" data-search="search_'+(i+1)+'"  data-pr-id = "'+data[i]['ID']+'" data-dtr ="'+data[i]['userid']+'">BOOK APPOINTMENT</a>'+
                                                                                 '</div>'+
                                                                                '</div>'+
                                                                                '<div class="patient_content_right_box_bottom">'+
                                                                                    '<div class="patient_content_right_box_eye_checkup"> <span>PROCEDURES</span>'+
                                                                                        '<h2 class ="pr-name">'+data[i]['procedure_name']+'</h2>'+
                                                                                         '<p>'+data[i]['description']+'</p>'+
                                                                                   '</div>'+
                                                                                    '<div class="patient_content_right_box_staff"> <span>STAFF</span>'+
                                                                                    '<div class="patient_content_right_slider_staff">'+
                                                                                    '<div class="owl-carousel">'+
                                                                                        '<div class="item">'+
                                                                                            '<div class="patient_content_right_box_staff_text">';
                                                                                                 if(data[i]['staff_pic'] != null ){
                                                                                                     searchData +=  '<img src="'+base_url+data[i]['staff_pic']+'" style ="border-radius: 51%; width: 68px;" />';
                                                                                                 }
                                                                                            searchData += '<div class="patient_content_right_staff_text">';
                                                                                                if(data[i]['staff_name'] != null ){
                                                                                                    searchData +=  '<h2>'+data[i]['staff_name']+'</h2>';
                                                                                                }
                                                                                                if(data[i]['staff_cat_name'] != null ){
                                                                                                    searchData +=  '<span>'+data[i]['staff_cat_name']+'</span>';
                                                                                                }

                                                                                    searchData += '</div>'+
                                                                                            '</div>'+
                                                                                        '</div>'+
                                                                                     '</div>'+
                                                                                    '</div>'+
                                                                                 '</div>'+
                                                                                '<div class="patient_content_right_box_reviews"> <span>REVIEWS</span>'+
                                                                                    '<div class="patient_content_right_slider_reviews">'+
                                                                                        '<div class="owl-carousel">'+
                                                                                            '<div class="item">'+
                                                                                                '<div class="patient_content_right_text_reviews">'+
                                                                                                    '<div class="patient_content_right_text_reviews_img">';
                                                                                                        if(data[i]['staff_pic'] != null ){
                                                                                                            searchData += '<img src="'+base_url+data[i]['staff_pic']+'" style ="border-radius: 51%; width: 68px;" />';
                                                                                                        }
                                                                                                    searchData += '<span></span> </div>'+
                                                                                                        '<div class="patient_content_right_text_reviews_img_icon">' +
                                                                                                            '<img src="" /></div>'+
                                                                                                            '<div class="patient_content_right_text_reviews_content">'+
                                                                                                                '<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>'+
                                                                                                                '<span>WILLIAM</span> </div>'+
                                                                                                         '</div>'+
                                                                                                       '</div>'+
                                                                                                '</div>'+
                                                                                            '</div>'+
                                                                                        '</div>'+
                                                                                    '</div>'+
                                                                            '</div>';

                                                        }
                                                         $('.alert').removeClass('alert-success').remove();
                                                           $('.patient_content_right_box_border_bottom').remove();
                                                           $('#search-item').html(searchData);

                                                        $('#googleMap').remove();
                                                        $('#Searchmap').css({'width': '100%', 'height': '287px'});
                                                        var latlng = new google.maps.LatLng(mapCords[0][0], mapCords[0][1]);
                                                        var myOptions = {
                                                            zoom: 11,
                                                            center: latlng,
                                                            mapTypeId: google.maps.MapTypeId.ROADMAP
                                                        };
                                                        var map = new google.maps.Map(document.getElementById("Searchmap"),
                                                            myOptions);

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
                                                                    var content="<div class='googlemap_min'><img src="+base_url+mapCords[k][3]+" style ='border-radius: 51%; width: 68px;'/><div class='googlemap_min_text'><h1>"+mapCords[k][2]+"</h1><a href='#' class='fancybox getHrsSlots' data-search='search_"+(k+1)+"'data-toggle='modal' data-target='#modalslots' data-pr-id = '"+mapCords[k][4]+"' data-dtr ='"+mapCords[k][5]+"'>book appointment</a></div><div class='googlemap_min_icon'><i class='fa fa-star'></i><span>4.5</span></div>"
                                                                    infowindow.setContent(content);
                                                                    infowindow.open(map, marker);
                                                                }
                                                            })(marker, k));
                                                        }

                                        }else{
                                            var data = response['search'] ;
                                            if(data == null){
                                                $('#search-item').empty();
                                                $('.alert').addClass('alert-success').show();
                                                $('.showMessage').text('Procedure not found this search');
                                                return false;
                                            }
                                        }
                                    }

                                });
                            }
                        }, 1000
                    );
                    setTimeout( function(){$('#notFounds').hide();} , 3000);
                    return false;

        }
});
//---------------end of block-----------------------------//





    $('body').on( 'click', '.getHrsSlots', function() {

        var prid = $(this).attr('data-pr-id');
        var docId = $(this).attr('data-dtr');

        var rowid = $(this).attr('data-search');

        var img = $("#sp-img", '#'+rowid).attr('src');
        var name = $(".sp-name", '#'+rowid).html();
        var prname = $(".pr-name", '#'+rowid).html();
        var price = $(".sp-price", '#'+rowid).html();
        var curr = new Date; // get current date
        var first = curr.getDate();//to set first day on monday, not on sunday, first+1 :

        var monthNames = [
            "Jan", "Feb", "Mar",
            "Apr", "May", "Jun", "Jul",
            "Aug", "Sep", "Oct",
            "Nov", "Dec"
        ];

        var weekdate = [];
        var dates = [];
        var dayname=[];
        for(var i = 0 ; i < 7;i++){
            var next = first + i;
            var nextday = new Date(curr.setDate(next));

            var day = nextday.getDate();
            var month = nextday.getMonth();
            var newmth = month + 1;

            if(newmth < 9 ){

                newmth = "0" + newmth;
            }

            var year = nextday.getFullYear();
            var mktime = nextday.getTime();
            dates.push(year + "-" + newmth + "-" + day);
            weekdate.push(day+" "+ monthNames[month]);
            dayname.push(whichDay(year + "-" + newmth + "-" + day));
        }

        // get query string values //

     
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars[hash[0]] = hash[1];
        }
          
       	var proc_cat_id = vars['procedure_cat'];
       	var proc_name_id = vars['procedure_name'];	
       	var location = vars['location'];	
       	var zip = vars['zip'];			
        var  url = base_url+'/Ajax/get_available_slots_for_booking';
        $.ajax({
            url: url,
            type:'POST',
            data: {procid : prid , docID:  docId},
            success: function(data){
                var response = JSON.parse(data);
                var slots = response['search'];
                var now = new Date();
                var curr_day_of_week = now.getDay();
                if(response['message'] == "SUCCESS") {
                    var SlotsStructure;
                    var icnt=0;
                    var output ='<div id="modalslots" tabindex="-1" role="dialog" aria-labelledby="modal-switch-label" class="modal fade">'+
                        '<div class="modal-dialog"><div id="left-icons"><a href ="#" class ="slotSearchLeft" prid ="'+prid+'" DocId = "'+docId+'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></div>'+
                        '<div class="modal-content">'+
                        '<div class="modal-header">'+
                        '<p class ="errorMessage"> </p>'+
                        '<button type="button" data-dismiss="modal" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+
                        '<div id="modal-switch-label" class="modal-title">Book Appointment</div>'+
                        '<div class="modal-body">' +
                        '<div id="modelSlots" class="book_appointment_pupup"><div id="r-icons"><a href ="#" class ="slotSearchRight"  prid ="'+prid+'" DocId = "'+docId+'" ><i class="fa fa-arrow-right" aria-hidden="true"></i><a/></div>'+
                        '<div class="findprocedure_calendar">'+
                        '<table cellspacing="0" cellpadding="0">'+
                        '<tbody>'+
                        '<tr>';
                    var strClass;
                    for(var k = 0 ;k<weekdate.length; k++ ){
                        if(k == 0 || k == 6){
                             strClass = 'getdates';
                        }else{
                            strClass = '';
                        }
                        output += '<th id ="datewise_'+k+'">'+dayname[k]+'<span>'+weekdate[k]+'</span><input type ="hidden" name ="dayDates" class ="'+strClass+'"value ="'+dates[k]+'"></th>';
                    }
                    output +=  '</tr>';
                    output +="<tr>";
                        var cnt = 0;
                        var icnt=1;
                       var modal_html ='<div id="modpopup">';
                       var usrid= response['userid'];
                        $.each(slots, function (index ,item) {
                            SlotsStructure="";
                            SlotsStructure += '<td>';
                             $.each(item, function (index1 ,availableSlot) {
                             	  var d=new Date(dates[cnt]);
                                 var weekslot = availableSlot['weekday'];
                                 if(usrid != -1){
                                    SlotsStructure +=  '<div class="createprocedure_calendar_date"> ' +
                                                                '<a class="createprocedure_calendar_circle" href="#"><i class="fa fa-times-circle"></i></a> ' +
                                                                    '<span>'+availableSlot['slot']+'</span>' +
                                                                    '<a class="book_button " id ="withoutLoginRegister" href="'+base_url+'/patient/book_specialist?pr_id='+prid+'&docId='+docId+'&time_slot='+availableSlot['slot']+'&procedure_cat='+proc_cat_id+'&date='+dates[cnt]+'&procedure_name='+proc_name_id+'&location='+location+'&zip='+zip+'">book</a> ' +

                                                                    '<form class ="checkingBookingdetails" id ="checkbookpt'+icnt+'" method ="Post" action ="">'+
                                                                    '<input type ="hidden" name ="pr_id" value ="'+prid+'" />'+
                                                                   '<input type ="hidden" name ="doc_id" value ="'+docId+'" />'+
                                                                   '<input type ="hidden" name ="time_slot" value ="'+availableSlot['slot']+'" />'+
                                                                   '<input type ="hidden" name ="date" value ="'+dates[cnt]+'" />'+
                                                                '</form>'+ 
                                                       '</div>';
                                 } else {
                                    SlotsStructure +=   '<div class="createprocedure_calendar_date"> ' +
                                                                '<a class="createprocedure_calendar_circle" href="#"><i class="fa fa-times-circle"></i></a> ' +
                                                                    '<span>'+availableSlot['slot']+'</span>' +
                                                                    '<a class="book_button  withoutLogindRegister"  data-popupid="newRegisterModal'+icnt+'" href="#">Book</a> ' +
                                                       '</div>';
                                 }

                             	 modal_html  += '<div id ="newRegisterModal'+icnt+'">'+
							                       '<div class="modal-dialog">'+
							                            '<div class="modal-content newheightwidth">'+
							                                '<div class="modal-header">'+
							                                    '<div class="modal-footerd">'+
							                                      '<p class ="errorMessage"> </p>'+
							                                        '<button type="button" class="closebtn" data-dismiss="modal">X</button>'+
							                                    '</div>'+
							                                    '<div style ="clear:both">'+
							                                	'<div class ="row bgstyle">'+
							                                     	'<div class ="col-sm-6">'+	
							                                    	 '</div>'+
							                                    	 '<div class ="col-sm-6">'+	
							                                    		'<h4 class="modal-title">Register <a href ="login?pr_id='+prid+'&docID='+docId+'&time_slot='+availableSlot['slot']+'&date='+dates[cnt]+'&booking=1" class="signin"> sign in </a></h4>'+
							                                    	 '</div>'+
							                                    '</div>'+	 
							                                '</div>'+
							                                '<div class="modal-body">'+
							                                     '<div class ="row">'+
							                                     	'<div class ="col-sm-6">'+
							                                     		'<div class="findprocedure_detail_border">'+
                                                          '<div class="popbgsection">'+
                                                                  '<div class="findprocedure_detail_box_top_bottom_white">'+
                                                                   '<div class="findprocedure_detail_box_left_white whitecolor">'+
                                                                      '<span>On:</span>'+
                                                                      '<h3><i class="fa fa-calendar" aria-hidden="true"></i> '+d.toDateString()+'</h3>'+
                                                                  '</div>'+
                                                                  '<div class="findprocedure_detail_box_right_white whitecolor">'+
                                                                      '<span>At:</span>'+
                                                                      '<h3><i class="fa fa-clock-o" aria-hidden="true"></i> '+availableSlot['slot']+'</h3>'+
                                                                  '</div>'+
                                                                  '</div>'+
                                                           '</div>'+

													                     	'<div><div class="findprocedure_detail_box_top removebtmbrd">'+
													                    		'<div class="findprocedure_detail_img">'+
													                    		 	'<img src="'+img+'">'+
													                    		 '</div>'+
													                            '<div class="findprocedure_detail_box_top_right">'+
													                             '<div class="findprocedure_detail_box_left_titel">	'+
													                                '<div class="findprocedure_detail_titel_top_left">'+
													                                	'<h1 class ="spbkname">'+name+'</h1>'+
													                                '</div>'+
													                               
													                           	'</div>'+
													                          '</div><div style="clear:both"></div></div>'+
                                                           '<div class="popbgsection">'+
                                                                '<div class="findprocedure_detail_box_top_bottom_white">'+
                                                                 '<div class="findprocedure_detail_box_left_white whitecolor">'+
                                                                    '<span>Procedure:</span>'+
                                                                    '<h3> '+prname+'</h3>'+
                                                                '</div>'+
                                                                '<div class="findprocedure_detail_box_right_white whitecolor">'+
                                                                    '<span>Price:</span>'+
                                                                    '<h3> '+String(price).replace("Price: ","")+'</h3>'+
                                                                '</div>'+
                                                                '</div>'+
                                                          '</div>'+      
													                       '</div>'+
													                      '</div>'+  	 		
							                                     	 '</div>'+
							                                     	 '<div class ="col-sm-6" >'+
							                                     	 	 '<form class ="booksp" id ="registerSaveBooksp'+icnt+'" method ="Post" action ="">'+
							                                     	 	 	   '<div class="content_right_menu_input content_right_menu_input_location removeicon">'+
                              																	'<input type="text" name="firstname" placeholder="First Name" class = "fname" value ="" />'+
                         																			 '</div>'+
                         																			 '<div class="content_right_menu_input content_right_menu_input_location removeicon">'+
                              																			'<input type="text" name="lastname" placeholder="Last Name"  class = "lname" value ="" />'+
                         																			 '</div>'+
                      							                                '<div class="content_right_menu_input content_right_menu_input_location removeicon">'+
                              																			'<input type="text" name="username" placeholder="User Name" class = "urname"  value ="" />'+
                         																			 '</div>'+
                         																			 '<div class="content_right_menu_input content_right_menu_input_location removeicon">'+
                              																			'<input type="email" name="email" placeholder="Email" class = "email" value ="" />'+
                         																			 '</div>'+
                         																			 '<div class="content_right_menu_input content_right_menu_input_location removeicon passSlection">'+
                              																			'<input type="password" name="password" placeholder="Password" class = "pass checkpasstype new_pass" value ="" />'+
                         																			 '</div>'+
                         																			 '<div class="content_right_menu_input content_right_menu_input_location removeicon">'+
                              																			'<input type="password" name="confirmpassword" placeholder="Confirm Password " class = "cfpass checkBothPass" value ="" />'+
                         																			 '</div>'+	

                                                               '<input type ="hidden" name ="pr_id" value ="'+prid+'" />'+
                                                               '<input type ="hidden" name ="doc_id" value ="'+docId+'" />'+
                                                               '<input type ="hidden" name ="time_slot" value ="'+availableSlot['slot']+'" />'+
                                                               '<input type ="hidden" name ="date" value ="'+dates[cnt]+'" />'+
                                                               '<input type ="hidden" name ="procedure_cat_id" value ="'+proc_cat_id+'" />'+
                                                               '<input type ="hidden" name ="procedure_name" value ="'+proc_name_id+'" />'+
                                                               '<input type ="hidden" name ="location" value ="'+location+'" />'+
                                                               '<input type ="hidden" name ="zip" value ="'+zip+'" />'+	
                                           	  		             '<button type ="submit" class ="registerAndBook"  id ="registerAndBook'+icnt+'"> Register </button>'+
                                                                '<img src="'+base_url+'/assets/image/ajax-loader1.gif" class ="loaderset"/>'+   
                      																	 '</form>'+
							                                     	 '</div>'+
							                                     '</div>'+   
							                                '</div>'+
							                            '</div>'+
							                        '</div>'+
							                    '</div></div>';  
							                    icnt++;
                        });
                            SlotsStructure += '</td>';
                            output +=SlotsStructure;
                            cnt++;
                    });
                    output += '</tr>';
                    output += '</tbody>'+
                        '</table>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>';

					modal_html+="</div>";
					var temp_out=output+modal_html;
                    $(".showSlots").html(temp_out);
                    $('#modalslots').modal('show');
					           $('body').on( 'click', '.book_button', function(e) {
    							         e.preventDefault();
                           e.stopPropagation();
                          var src=$(this).attr("href");
                          var  frmid = $(this).next("form").attr('id');
                          var bookChk = $('#'+frmid).serialize();
                          var url = base_url+'/Ajax/check_booking_details_exits_before_save';
                                $.ajax({
                                    url: url,
                                    type:'POST',
                                    data: {data:bookChk},
                                    success: function(data){
                                            var response = JSON.parse(data);
                                                  console.log(response);
                                                    if(response['message'] == "SUCCESS") {
                                                       $('.errorMessage').addClass('alert-danger').show();
                                                          $('.alert-danger').text('You already have appointment on this time. Please choose time');
                                                        return false;
                                                    }
                                                    else{
                                                      window.location=src;
                                                    }

                                        } // end of sucess
                                    });
                                  return false;
						           });

                }else{

                }
            }
        });
        return false;
    })


// ----------- save booking data ------------------//

		 $('body').on( 'click', '.registerAndBook', function(e) {
          e.preventDefault();
          var form = $(this).parents('form:first');
          var frmdata = form.serialize();
          var url = base_url+'/Ajax/save_user_booking_data';
          $('.loaderset').show();
          $.ajax({
              url: url,
              type:'POST',
              data: {data:frmdata},
              success: function(data){
                      var response = JSON.parse(data);
                      if(response['message'] == "SUCCESS") {
                          window.location = base_url+'/search/success';
                          return false;
                      }else{
                          $('.alert').addClass('alert-danger').show();
                          $('.alert-danger').text('some error has occurred');
                      }
                  }
              });
          return false;
		})

// ----------------end of block----------------------------//


// --------------------check pass for validation and empty---------------------// 

 		$('body').on( 'blur', '.pass', function() {
            var pass=  $(this).val();
            if(pass != ''){
                var regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,}$/;
                if(!regularExpression.test(pass)){
                    $('.errorMessage').addClass('alert-danger').show();
                    $('.alert-danger').text('please enter minimum 6 character ,alphabet and special character like !@#$%^&"');
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                }else{
                    $('.errorMessage').removeClass('alert-danger');
                    $('.errorMessage').hide();
                    return false;
                }

            }else{
					$('.errorMessage').addClass('alert-danger').show();
                    $('.alert-danger').text('please enter you password');
                    $('html, body').animate({
                        scrollTop: 0

                    }, 800);
                    return false;
            }
    });
 
  //-------------------------------- end of block---------------------------------//


// ---------------- check password and confirm pass -----------------//

	$('body').on( 'blur', '.checkBothPass', function() {

         var form = $(this).parents('form:first');
         var passwd =  form.find('.pass').val();
            var c_pass=  $(this).val();
            if(c_pass != '') {
                if(passwd != c_pass) {
                    $('.errorMessage').addClass('alert-danger').show();
                    $('.alert-danger').text('New password and confirm password does not match');
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                }else{
                    $('.errorMessage').removeClass('alert-danger');
                    $('.errorMessage').hide();
                    return false;
                }
            }else{
            		$('.errorMessage').addClass('alert-danger').show();
                    $('.alert-danger').text('please enter confirm password');
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
            }

    });
//-----------------end of block---------------------------//
   

    $('body').on( 'click', '#sendSlotData', function() {
        $('.saveBooking').submit();
    })


    function whichDay(dateString) {
        return ['Sun','Mon','Tues','Wed','Thu','Fri','Sat'][new Date(dateString).getDay()];
    }


    $('#searchSort').on('change',function(){
         var seletedPrc = $('#procedureCat').val();
          if(seletedPrc == ''){
               bootbox.alert("Please find procedure first");
               return false; 
          }else{
                 var sorts = $(this).val();
                $('#orderSearch').submit();
            }
    })

});


$(document).ajaxComplete(function () {

    var owls = $(".owl-carousel");
    //init carousel
    owls.owlCarousel({
        items : 3,
        rewindNav: true,
        scrollPerPage: true,
        navigation: true,
        navigationText: ["prev","next"]
    })

//---------------------- get slots for next  week -----------------------------//

    $('.slotSearchRight').on( 'click',  function() {

        var prid = $(this).attr('prid');
        var docId = $(this).attr('docId');

        var lastDate = $('#datewise_6').find('input').attr('value');
        var Curntdate = new Date(lastDate);
        if(Curntdate.getDate() == 31){
            var day1 =  Curntdate.getDate();
        }else{
            var day1 =  Curntdate.getDate()+1;
        }

        var month11 = Curntdate.getMonth()+1;
        var year1 = Curntdate.getFullYear();

        var latestdate = year1 + "-" + month11 + "-" + day1;
        var latestdate1 = new Date(latestdate);
        var first1 = latestdate1.getDate();//to set first day on monday, not on sunday, first+1 :
        var monthNames1 = [
            "Jan", "Feb", "Mar",
            "Apr", "May", "Jun", "Jul",
            "Aug", "Sep", "Oct",
            "Nov", "Dec"
        ];

        var weekdate1 = [];
        var dates1 = [];
        var dayname1=[];
        var first = latestdate1.getDate();
        var firstday = (new Date(latestdate1.setDate(first))).toString();
        for(var i = 0;i < 7 ; i++){
            var next = new Date(latestdate1.getTime());
            next.setDate(first + i);
            var day = next.getDate();
            var month1 = next.getMonth();
            var newmnt = month1 + 1;
            var year = next.getFullYear();
            var mktime = next.getTime();
            dates1.push(year + "-" + newmnt + "-" + day);
            weekdate1.push(day+" "+ monthNames1[month1]);
            dayname1.push(whichDay(year + "-" + newmnt + "-" + day));
        }
        var url = base_url+'/Ajax/get_available_slots_for_booking_next_slots';
        $.ajax({
            url: url,
            type:'POST',
            data: {procid : prid , docID:  docId,  dates: dates1},
            success: function(data){
                var response = JSON.parse(data);
                var slots = response['search'];
                var now = new Date();
                var curr_day_of_week = now.getDay();
                if(response['message'] == "SUCCESS") {

                    var SlotsStructure;
                    var icnt=0;
                    var output ='<div id="modalslots" tabindex="-1" role="dialog" aria-labelledby="modal-switch-label" class="modal fade">'+
                        '<div class="modal-dialog"><div id="left-icons"><a href ="#" class ="slotSearchLeft" prid ="'+prid+'" DocId = "'+docId+'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></div>'+
                        '<div class="modal-content">'+
                        '<div class="modal-header">'+
                        '<p class ="errorMessage"> </p>'+
                        '<button type="button" data-dismiss="modal" class="close slotCheck"><span aria-hidden="true" class ="cancelMd">&times;</span><span class="sr-only">Close</span></button>'+
                        '<div id="modal-switch-label" class="modal-title">Book Appointment</div>'+
                        '<div class="modal-body">'+
                        '<div id="modelSlots" class="book_appointment_pupup"><div id="r-icons"><a href ="#" class ="slotSearchRight"  prid ="'+prid+'" DocId = "'+docId+'" ><i class="fa fa-arrow-right" aria-hidden="true"></i><a/></div>'+
                        '<div class="findprocedure_calendar">'+
                        '<table cellspacing="0" cellpadding="0">'+
                        '<tbody>'+
                        '<tr>';
                    var strClassSlot;
                    for(var k = 0 ;k< weekdate1.length; k++ ){
                        if(k == 0 || k == 6){
                            strClassSlot = 'getdates';
                        }else{
                            strClassSlot = '';
                        }
                        output += '<th id ="datewise_'+k+'">'+dayname1[k]+'<span>'+weekdate1[k]+'</span><input type ="hidden" name ="dayDates" class ="'+strClassSlot+'"value ="'+dates1[k]+'"></th>';
                    }
                    output +=  '</tr>';
                    output +="<tr>";
                    var cnt = 0;

                    $.each(slots, function (index ,item) {
                        SlotsStructure="";
                        SlotsStructure += '<td>';
                        $.each(item, function (index1 ,availableSlot) {
                            var weekslot = availableSlot['weekday'];
                            SlotsStructure +=   '<div class="createprocedure_calendar_date"> ' +
                                '<a class="createprocedure_calendar_circle" href="#"><i class="fa fa-times-circle"></i></a> ' +
                                '<span>'+availableSlot['slot']+'</span>' +
                                '<a class="book_button" href="#">book</a> ' +
                                '<form class ="slotdata_'+cnt+'" method ="Post" action ="book_specialist/">'+
                                '<input type ="hidden" name ="slotdata"  />'+
                                '<input type ="hidden" name ="pr_id" value ="'+prid+'" />'+
                                '<input type ="hidden" name ="doc_id" value ="'+docId+'" />'+
                                '<input type ="hidden" name ="time_slot" value ="'+availableSlot['slot']+'" />'+
                                '<input type ="hidden" name ="date" value ="'+dates1[cnt]+'" />'+
                                '</form>'+
                                '</div>';
                        });
                        SlotsStructure += '</td>';
                        output +=SlotsStructure;
                        cnt++;
                    });
                    output += '</tr>';
                    output += '</tbody>'+
                        '</table>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>';
                    $(".showSlots").html(output);
                    $('#modalslots').modal('show');
                    $('.modal-backdrop').css('background-color', 'transparent');
                }else{

                }
            }
        });
        return false;
    });

//-------------------- get slots for preview week------------------------- //

    $('.slotSearchLeft').click(function() {

        var prid = $(this).attr('prid');
        var docId = $(this).attr('docId');
        var lastDate = $('#datewise_0').find('input').attr('value');
        var Curntdate = new Date(lastDate);

        if(Curntdate.getDate() == 31){
            var day1 =  Curntdate.getDate();
        }else{
            var day1 =  Curntdate.getDate() - 1;
        }

        var month11 = Curntdate.getMonth()+1;
        var year1 = Curntdate.getFullYear();

        var previousLastDate = year1 + "-" + month11 + "-" + day1;

        var previousLastDateStd = new Date(previousLastDate);
        var first1 = previousLastDateStd.getDate();//to set first day on monday, not on sunday, first+1 :

        var monthNames1 = [
            "Jan", "Feb", "Mar",
            "Apr", "May", "Jun", "Jul",
            "Aug", "Sep", "Oct",
            "Nov", "Dec"
        ];

        var previousWeekdate = [];
        var previousDates = [];
        var daynamePrev =[];
        var first = previousLastDateStd.getDate();
        var firstday = (new Date(previousLastDateStd.setDate(first))).toString();
        for(var i = 0; i < 7 ; i++ ){
            var nextdates = new Date(previousLastDateStd.getTime());
            nextdates.setDate(first - i);
            var day = nextdates.getDate();
            var month1 = nextdates.getMonth();
            var newmnt = month1 + 1;
            if(newmth < 9 ){

                newmth = "0" + newmth;
            }
            var year = nextdates.getFullYear();
            var mktime = nextdates.getTime();
            previousDates.push(year + "-" + newmnt + "-" + day);
            previousWeekdate.push(day+" "+ monthNames1[month1]);
            daynamePrev.push(whichDay(year + "-" + newmnt + "-" + day));
        }

        var url = base_url+'/Ajax/get_available_slots_for_booking_next_slots';
        $.ajax({
            url: url,
            type:'POST',
            data: {procid : prid , docID:  docId,  dates: previousDates},
            success: function(data){
                var response = JSON.parse(data);
                var slots = response['search'];
                var now = new Date();
                var curr_day_of_week = now.getDay();
                if(response['message'] == "SUCCESS") {
                    var SlotsStructure;
                    var icnt=0;
                    var output ='<div id="modalslots" tabindex="-1" role="dialog" aria-labelledby="modal-switch-label" class="modal fade">'+
                        '<div class="modal-dialog"><div id="left-icons"><a href ="#" class ="slotSearchLeft" prid ="'+prid+'" DocId = "'+docId+'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></div>'+
                        '<div class="modal-content">'+
                        '<div class="modal-header">'+
                        '<button type="button" data-dismiss="modal" class="close cancelpop"><span aria-hidden="true" class ="fadePop">&times;</span><span class="sr-only">Close</span></button>'+
                        '<div id="modal-switch-label" class="modal-title">Book Appointment</div>'+
                        '<div class="modal-body">'+
                        '<div id="modelSlots" class="book_appointment_pupup"><div id="r-icons"><a href ="#" class ="slotSearchRight"  prid ="'+prid+'" DocId = "'+docId+'" ><i class="fa fa-arrow-right" aria-hidden="true"></i><a/></div>'+
                        '<div class="findprocedure_calendar">'+
                        '<table cellspacing="0" cellpadding="0">'+
                        '<tbody>'+
                        '<tr>';
                    var strClassSlot;
                   var counterSt = 0;
                    for(var k =  previousWeekdate.length ; k > 0; k-- ){
                        if(k == 0 || k == 6){
                            strClassSlot = 'getdates';
                        }else{
                            strClassSlot = '';
                        }

                        output += '<th id ="datewise_'+counterSt+'">'+daynamePrev[k-1]+'<span>'+previousWeekdate[k-1]+'</span><input type ="hidden" name ="dayDates" class ="'+strClassSlot+'"value ="'+previousDates[k-1]+'"></th>';
                        counterSt++;
                    }
                    output +=  '</tr>';
                    output +="<tr>";
                    var cnt = 0;

                    $.each(slots, function (index ,item) {
                        SlotsStructure="";
                        SlotsStructure += '<td>';
                        $.each(item, function (index1 ,availableSlot) {
                            var weekslot = availableSlot['weekday'];
                            SlotsStructure +=   '<div class="createprocedure_calendar_date"> ' +
                                '<a class="createprocedure_calendar_circle" href="#"><i class="fa fa-times-circle"></i></a> ' +
                                '<span>'+availableSlot['slot']+'</span>' +
                                '<a class="book_button" href="#">book</a> ' +
                                '<form class ="slotdata_'+cnt+'" method ="Post" action ="book_specialist/">'+
                                '<input type ="hidden" name ="slotdata"  />'+
                                '<input type ="hidden" name ="pr_id" value ="'+prid+'" />'+
                                '<input type ="hidden" name ="doc_id" value ="'+docId+'" />'+
                                '<input type ="hidden" name ="time_slot" value ="'+availableSlot['slot']+'" />'+
                                '<input type ="hidden" name ="date" value ="'+previousDates[cnt]+'" />'+
                                '</form>'+
                                '</div>';

                        });
                        SlotsStructure += '</td>';
                        output +=SlotsStructure;
                        cnt++;
                    });
                    output += '</tr>';
                    output += '</tbody>'+
                        '</table>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>';
                    $(".showSlots").html(output);
                    $('#modalslots').modal('show');
                    $('.modal-backdrop').css('background-color', 'transparent');
                }else{

                }
            }
        });
        return false;
    });

    function whichDay(dateString) {
        return ['Sun','Mon','Tues','Wed','Thurs','Fri','Sat'][new Date(dateString).getDay()];
    }

});