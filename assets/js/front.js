$(document).ready(function() {



  // ---------- checked login user -------------//
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


        // ------------ end of block ---------------------------------------//

        //----------- search validation for procedure search  --------------//

        $('#search').click(function(){

              var prcatid = $('#procedureCat').val();
               var name = $('#procedureName').val();  
               var lc = $('.location').val();
               var zip = $('.zip').val();
               
                var error = [];
                if(prcatid == ''){
                     var invalid = false;
                     var ct1 = 'showerror1';
                     error['procedureCat'] = 'Please select procedure category';
                }else{
                    error['procedureCat'] = '';
                     var invalid = true;
                      var remv1 = 'removeError'; 
                      var ct1 = '';

                }
                if(name == ''){
                     var invalid = false;
                     var ct2 = 'showerror2';
                    error['procedurename'] = 'Please select procedure name';
                }else{
                    error['procedurename'] = '';
                     var invalid = true;
                      var rmv2 = 'removeError'; 

                }
                if(lc == ''){
                     var invalid = false;
                     var ct3 = 'showerror3';
                    error['location'] = 'Please enter location';
                }else{
                        error['location'] ='';
                        var  invalid = true;
                        var rmv3= 'removeError'; 
                }

                if(zip == ''){
                     var invalid = false;
                     var ct4 = 'showerror4';
                    error['zip'] = 'Please enter zip';
                }else{
                     error['zip'] ='';
                    var rmv4 = 'removeError'; 
                    var invalid = true;
                }

                if(invalid != true){

                    bootbox.dialog({
                            title: "Error Message",
                                message: '<p style ="color: #f5f5f5;background: #0D92A7; padding: 11px;font-size: 15px;text-align: center;"> <span class ="'+ct1+''+remv1+'">'+error['procedureCat']+' <br> </span>  <span class ="'+ct2+'">'+error['procedurename']+' <br> </span> <span class ="'+ct3+'">'+error['location']+' </span>  <br> <span class= "'+ct4+'">'+error['zip']+' <br></span> </p>'

                        });
                     return false;
                }

        })
      
       // --------------end od block ------------// 

      // ---------- week day and language on change showing day and language based on change event (default to Any ) ----------------//

      $("#weekdayChange :input").change(function() {
                if($("#weekdayChange input:checked").is(":checked")) {
                    var stats = $(this).attr('id');
                      if(stats != 'option1'){
                        $('#anyweek').removeClass('active');
                        $('#option1').attr('checked', false);
                      }else{
                           $('.removeactive').removeClass('active');
                           $('#'+stats).attr("checked", true);
                      }
                }

      });

       $("#languageChange :input").change(function() {
                if($("#languageChange input:checked").is(":checked")) {
                    var stats = $(this).attr('id');
                      if(stats != 'optionlang1'){
                        $('#removeactiveLng').removeClass('active');
                        $('#optionlang1').attr('checked', false);
                      }else{
                           $('.removelng').removeClass('active');
                           $('#'+stats).attr("checked", true);
                      }
                }

      });

 // --------------end of block ---------------------------------------------//
    

// -------------------filter search  start --------------------------------//

        $('.solidSearch').on('click',function(){
               
             var seletedPrc = $('#procedureCat').val();
              if(seletedPrc == ''){
                   bootbox.alert("Please find procedure first");
                   return false; 
              }else{
                    var search = [];
                    var frmdata = $('#search_prc').serialize() ;
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
                                        get_specialist(data);
                                    }

                                });
                            }
                        }, 1000
                    );
                    setTimeout( function(){$('#notFounds').hide();} , 1000);
                    return false;
        }
            
});

function get_specialist(data){

      var response = JSON.parse(data);
        if(response['message'] == "SUCCESS") {
            var data = response['search'] ;
            var mapCords= [];
            var alerts = ' <div class ="alert"><div class ="showMessage"></div></div>';
            var searchData ='<div class ="showSlots"></div>';
            searchData +=' <div class= "modal fade" id="book_appt" role="dialog"></div>';
            for(var i = 0 ; i < data.length; i++){
                mapCords.push([data[i]['latitude'], data[i]['longitude'],data[i]['name'], data[i]['picture'],data[i]['ID'],data[i]['userid'] ]);
                     searchData += '<div class="patient_content_right_box_border_bottom" id ="search_'+(i+1)+'">'+
                                    '<div class="patient_content_right_box_top">'+
                                        '<div class="patient_book_appointment_left">'+
                                          '<img src= "'+base_url+data[i]['picture']+'"  id ="sp-img" style ="border-radius: 51%; width: 59px; height: 59px; padding: 0px !important;"/>'+
                                             '<div class="patient_book_appointment_left_text">'+
                                                '<h1 class ="sp-name">'+data[i]['name']+'</h1>'+
                                                      '<span>'+data[i].title+'</span></div>'+
                                                '</div>'+
                                                '<div class="patient_book_appointment_right">'+
                                                    '<h1 class ="sp-price">Price: ' +data[i]['from_price']+'  - '+data[i]['to_price']+' </h1>'+
                                                     '<a href="#" class="fancybox getHrsSlots" data-toggle="modal" data-target="#modalslots" data-search="search_'+(i+1)+'"  data-pr-id = "'+data[i]['ID']+'" data-dtr ="'+data[i]['userid']+'">BOOK APPOINTMENT</a>'+
                                                     '<a href="#" class="fancybox getRecmdPat" data-toggle="modal" data-target="#modalslotsRecomd" data-search="recmd_'+(i+1)+'"  data-pr-id = "'+data[i]['ID']+'" data-dtr ="'+data[i]['userid']+'">Recommend</a>'+
                                                 '</div>'+
                                                '</div>'+
                                                '<div class="patient_content_right_box_bottom">'+
                                                    '<div class="patient_content_right_box_eye_checkup"> <span>PROCEDURES</span>'+
                                                        '<h2>'+data[i]['procedure_name']+'</h2>'+
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

        }

        else{
            var resp = response['search'] ;
              if(resp == null){
                  $('#search-item').empty();
                  $('.wholeSearchdata').empty();
                  $('.alert').addClass('alert-danger').show();
                  $('.showMessage').text('Procedure not found for this search');
                  return false;
            }
        }

}


// -----------end of filter search block -----------------------------------------------//

//---------- Recommend patient for home phys ------------------//


   $('body').on( 'click', '.getRecmdPat', function() {

        var MPid = $(this).attr('data-mp-id');
        var docId = $(this).attr('data-dtr'); // sp id in case if needed

          var url = base_url+'/Ajax/get_recomd_patient ';
          $.ajax({
            url : url,
            data: {MPid : MPid , docId:  docId},
             type:'POST',
               success: function(data){

                 var response = JSON.parse(data);
                 var output = '<div class="modal fade" id="modalslotsRecomd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">'+
                      '<div class="modal-dialog" role="document">'+
                      '<div class="modal-content">'+
                      '<p class ="errorMessage"> </p>'+
                      '<div class="modal-header">'+
                      '<button type="button" data-dismiss="modal" class="bootbox-close-button close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+
                      '<div id="modal-switch-label" class="modal-title"> Recommend Procedure</div>'+
                      '<div class="modal-body"> '+
                      '<div class ="centerLoder"><img src ="'+base_url+'/assets/image/gif-load.gif" class ="lds"> </div>';
                    if(response['message'] == "SUCCESS") {

                       if(response['pat'] != false){

                            // dropdown for patient //
                             var patients = response['pat']['refered_patient'];
                            output +=  '<form id ="recmdPat" method= "POST"  action = "" >'; 
                            output += '<div class ="row">'+
                                         '<div class ="col-sm-6">'+
                                            '<select name="patient_name" id ="pname" class="parsley-validated form-control s-pat-recmd" data-required="true">';
                                output +=  '<option value=""> Patient name</option>';
                                 output += '<div class ="ptselect">';

                                  $.each(patients, function (ptindex , ptitem) {
                                         output += '<option value='+ ptitem['userid']  +'>' + ptitem['patient_name'] + '</option>';
                                  });
                              output += '</div></select>';

                              output += '</div>'; // end of col-sm-6 


                                output += '<div class ="col-sm-6">'+
                                            '<img src = "'+base_url+'/assets/image/plus-512222.png"  class ="addReccommedPat" /></div>';
                               output += '</div>' ; //end of row

                                 output += '<input type ="hidden" name ="MPid" value ="'+MPid+'" />'+
                                           '<input type ="hidden" name ="docid" value ="'+docId+'" />';

                            output += '</form>' ;

                                var pat = response['pat']['rc'];
                                 output += '<div class ="rc_pt">';
                                  var recPatId = response['pat']['Ids'];
                                  var icnt = 0;

                                  $.each(pat, function (index ,item) {
                                      $.each(item, function (key , val) {
                                            var pic = val['picture'];
                                         output += '<div class="row top-margis" id ="rmv_'+icnt+'"><div class="col-sm-2">'+
                                                          '<img src ="'+base_url+''+pic+'"  />'+
                                                      '</div>'+
                                                      '<div class="col-sm-3">'+
                                                        '<p> ' +val['username']+'</p>'+
                                                    '</div><a href= "#" data-rec-id = '+recPatId[icnt]+' class ="RemoveReccommedPat" id ="rmv_'+icnt+'" ><img src = "'+base_url+'/assets/image/PngThumb-Wrong-sign-3303ss.png"  /></a></div>';
                                       });  
                                       icnt++; 
                                  });
                                  output +='</div>';
                              }
                      // end of success section
                    }else{
                            output +=  '<div class ="erro_recm"> You dont have any patient </div>';
                    } 
                   output += '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>';
                      $(".showRecmd").empty();            
                      $(".showRecmd").html(output);
                      $('#modalslotsRecomd').modal('show');
                      $('.centerLoder').hide();

          }

          });

   })

  
// ---------------end of block------------------------------------//


  //------------------ save recommed patient -----------------//

$('body').on( 'click', '.addReccommedPat', function() {

    var st = $('#pname').val();

      if(st != ''){

           $('.centerLoder').show();
            var frmdata = $('#recmdPat').serialize();
             var url = base_url+'/Ajax/save_recomd_patient';
                $.ajax({
                  url : url,
                    type:'POST',
                    data: {frmdatas:frmdata },
                     success: function(data){
                          var response = JSON.parse(data);
                          if(response['message'] == "SUCCESS") {
                            setTimeout(function(){
                              $('.errorMessage').addClass('alert alert-success').show();
                              $('.alert-success').text('Recommendation saved successfuly');
                                setTimeout(function(){
                                  $('.alert-success').slideToggle();
                                 } , 1000) ;


                               $('.centerLoder').hide();
                                 setTimeout(function(){
                                        $('.getRecmdPat').trigger('click'); 
                                 } , 400) ;
                          } , 
                          500 );
                          }else{
                              $('.errorMessage').addClass('alert alert-danger').show();
                              $('.alert-danger').text('You have already Recommend this patient, please choose other');
                              $('.centerLoder').hide();
                                setTimeout(function(){
                                  $('.alert-danger').slideToggle();
                                 } , 500) ;
                          }  
                     }

                   });
        }else{
            $('.errorMessage').addClass('alert alert-success').show();
            $('.alert-success').text('please select patient name');
            setTimeout(function(){
                $('.errorMessage').slideToggle();
            }, 1000)
            return false
        }
  })


  // ---------end of block -----------------//

 //------------------ REMOVE recommed patient -----------------//


   $('body').on( 'click', '.RemoveReccommedPat', function() {

      var id = $(this).attr('data-rec-id');
      var rmvid = $(this).attr('id');
        bootbox.confirm("Are you sure you want to delete this ?", function(result) {
            if(result == true){
              $('.centerLoder').show();
                var url = base_url+'/Ajax/delete_recomd_patient ';
                $.ajax({
                  url : url,
                    data: { rcid :id } ,
                    type:'POST',
                    success: function(data){
                     var response = JSON.parse(data);
                            if(response['message'] == "SUCCESS") {
                              setTimeout(function(){
                                $('.errorMessage').addClass('alert alert-success').show();
                                $('.alert-success').text('Recommendation removed successfuly');
                                 $('.centerLoder').hide();
                                 $('#'+rmvid).remove();
                            } , 700 );

                                 setTimeout(function(){
                                  $('.alert-success').slideToggle();
                                 } , 1000) ;

                            }  
                       }

                  })
            }

        }); 

  });

 //------------------ END  -----------------//

// ---------------- pop up to show working hrs -------------------------------------//
    

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
                newmths = "0" + newmth;
            }
           
            var year = nextday.getFullYear();
            var mktime = nextday.getTime();
            dates.push(year + "-" + newmths + "-" + day);
            weekdate.push(day+" "+ monthNames[month]);
            dayname.push(whichDay(year + "-" + newmth + "-" + day));
        }

        // get query string values //
     
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++){
            hash = hashes[i].split('=');
            vars[hash[0]] = hash[1];
        }
        

        var proc_cat_id = vars['procedure_cat'];
        var proc_name_id = vars['procedure_name'];  
        var location = vars['location'];  
        var zip = vars['zip'];
        var km = vars['km'];


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
                    var newpopupdata = ''  
                    var output ='<div id="modalslots" tabindex="-1" role="dialog" aria-labelledby="modal-switch-label" class="modal fade">'+
                        '<div class="modal-dialog"><div id="left-icons"><a href ="#" class ="slotSearchLeft" prid ="'+prid+'" DocId = "'+docId+'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></div>'+
                        '<div class="modal-content">'+
                        '<div class="modal-header">'+
                        '<button type="button" data-dismiss="modal" class="bootbox-close-button close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+
                        '<div id="modal-switch-label" class="modal-title">Book Appointment</div>'+
                        '<div class="modal-body">' +
                        '<div class ="centerLoder"><img src ="'+base_url+'/assets/image/gif-load.gif" class ="lds"> </div>'+
                        '<div id="modelSlots" class="book_appointment_pupup"><div id="r-icons"><a href ="#" class ="slotSearchRight"  prid ="'+prid+'" DocId = "'+docId+'" ><i class="fa fa-arrow-right" aria-hidden="true"></i><a/></div>'+
                        '<div class ="newAppendedItems"><div>'+
                        '<div class="findprocedure_calendar removeoldItems">'+
                        '<table cellspacing="0" cellpadding="0">'+
                        '<tbody>'+
                        '<tr>';
                    var strClass;
                    for(var k = 0 ;  k<weekdate.length;  k++ ){
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
                       var usrid = response['userid'];
                       var utype = response['utype'];
                        $.each(slots, function (index ,item) {
                            SlotsStructure="";
                            SlotsStructure += '<td>';
                             $.each(item, function (index1 ,availableSlot) {
                                var d=new Date(dates[cnt]);
                                 var weekslot = availableSlot['weekday'];

                                 if(usrid != -1){
                                        if(utype = "homephysician"){
                                             SlotsStructure +=  '<div class="createprocedure_calendar_date"> ' +
                                                                        '<span>'+availableSlot['slot']+'</span>' +
                                                                        '<a class="book_button  withoutLoginRegister"  data-popupid="newRegisterModal'+icnt+'" href="'+base_url+'/homephysician/book_specialist?pr_id='+prid+'&docId='+docId+'&time_slot='+availableSlot['slot']+'&procedure_cat='+proc_cat_id+'&date='+dates[cnt]+'&procedure_name='+proc_name_id+'&location='+location+'&zip='+zip+'&km='+km+'">book</a> ' +
                                                           '</div>';
                                        }else{

                                        SlotsStructure +=   '<div class="createprocedure_calendar_date"> ' +
                                                                        '<span>'+availableSlot['slot']+'</span>' +
                                                                        '<a class="book_button  withoutLoginRegister"  data-popupid="newRegisterModal'+icnt+'" href="'+base_url+'/patient/book_specialist?pr_id='+prid+'&docId='+docId+'&time_slot='+availableSlot['slot']+'&procedure_cat='+proc_cat_id+'&date='+dates[cnt]+'&procedure_name='+proc_name_id+'&location='+location+'&zip='+zip+'&km='+km+'">book</a> ' +
                                                           '</div>';
                                           }                

                                 } else{
                                    SlotsStructure +=   '<div class="createprocedure_calendar_date"> ' +
                                                                    '<span>'+availableSlot['slot']+'</span>' +
                                                                    '<a class="book_button  withoutLoginRegister"  data-popupid="newRegisterModal'+icnt+'" href="#">Book</a> ' +
                                                       '</div>';
                                 }

                               modal_html  += '<div id ="newRegisterModal'+icnt+'">'+
                                     '<div class="modal-dialog">'+
                                          '<div class="modal-content newheightwidth">'+
                                              '<div class="modal-header">'+
                                                  '<div class="modal-footerd">'+
                                                    '<p class ="errorMessage"> </p>'+
                                                     '<p class ="showingerrormsg"> </p>'+ 
                                                      '<button type="button" class="closebtn" data-dismiss="modal">X</button>'+
                                                  '</div>'+
                                                  '<div style ="clear:both">'+
                                                '<div class ="row bgstyle">'+
                                                    '<div class ="col-sm-6">'+  
                                                      
                                                     '</div>'+
                                                     '<div class ="col-sm-6">'+
                                                      '<h4 class="modal-title">Register <a href ="/login?pr_id='+prid+'&docID='+docId+'&time_slot='+availableSlot['slot']+'&date='+dates[cnt]+'&booking=1" class="signin"> sign in </a>'+
                                                       '</h4>'+
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
                                                '<div>'+
                                                 '<div class="findprocedure_detail_box_top removebtmbrd">'+
                                                  '<div class="findprocedure_detail_img">'+
                                                    '<img src="'+img+'">'+
                                                   '</div>'+
                                                      '<div class="findprocedure_detail_box_top_right">'+
                                                       '<div class="findprocedure_detail_box_left_titel"> '+
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
                                                               '<div class="content_right_menu_input content_right_menu_input_location removeicon">'+
                                                                    '<input type="email" name="hp_email" placeholder="Home Phy email" class = "hp_email_check" value ="" />'+
                                                               '</div>'+ 
                                                               '<input type ="hidden" name ="pr_id" value ="'+prid+'" />'+
                                                               '<input type ="hidden" name ="doc_id" value ="'+docId+'" />'+
                                                               '<input type ="hidden" name ="time_slot" value ="'+availableSlot['slot']+'" />'+
                                                               '<input type ="hidden" name ="date" value ="'+dates[cnt]+'" />'+
                                                               '<input type ="hidden" name ="procedure_cat_id" value ="'+proc_cat_id+'" />'+
                                                               '<input type ="hidden" name ="procedure_name" value ="'+proc_name_id+'" />'+
                                                               '<input type ="hidden" name ="location" value ="'+location+'" />'+
                                                               '<input type ="hidden" name ="zip" value ="'+zip+'" />'+ 
                                                               '<input type ="hidden" name ="hp_user_id" class ="addhpid" />'+ 
                                                               '<input type ="hidden" name ="hp_id" class ="addid" />'+ 
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
                  // get_new_popup(newdata);
                modal_html+="</div>";
                var temp_out=output+modal_html;
                  $(".showSlots").html(temp_out);
                  $('#modalslots').modal('show');

                $('body').on( 'click', '.book_button', function() {
                      if(loggedin == 'false'){  
                        var popupid=$(this).attr("data-popupid");
                        var ff=$('#'+popupid,"#modpopup").html();
                        $("#book_appt").html('');
                              $("#book_appt").html(ff);
                              $("#book_appt").modal('show');
                      }else{
                         var getClass = $(this).next().attr('class');
                            $('.'+getClass).submit();
                      }

                  });

                 var todaydate = new Date();
                  var c_month = todaydate.getMonth() + 1;
                  var c_year = todaydate.getFullYear();
                  if(todaydate.getDate() == 31){
                      var c_day =  todaydate.getDate();
                  }else{
                      var c_day =  todaydate.getDate();
                  }

                  if(c_month < 9 ){
                      c_mn = "0" + c_month;
                  }else{
                      c_mn = c_month;
                  }

                  var today_date = c_year + "-" + c_mn + "-" + c_day;
                  var found = false;
                    for(var  ic =0; ic < dates.length; ic++) {
                          if (dates[ic] == today_date) {
                            found = true;
                          }
                    }
                    if(found == true){
                       $('.slotSearchLeft').hide(); 
                    }

                      $('.centerLoder').hide();

                }else{

                }

            }  // end of sucesss
        });
      
        return false;

    })
// ---------------------------end of section -----------------------------------------------//

// ------------  save new user and book appt section -----------------------------------//

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
                                 window.location = base_url+'/search/booking_alert'; 
                                 return false;  
                            }
                        }
                    });
                return false;
    })

  // -------------- end of section -------------------//



  //----------- check password for strength -------------//

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

  // ------------end of block ---------------//

// --------- check both password --------------//

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
// --------------- end of block ------------------//
   

  // ------- check home phy email --------------//

    $('body').on( 'blur', '.hp_email_check', function() {

            var hpmail=  $(this).val();
            if(hpmail != ''){
                var url = base_url+'/Ajax/check_hp_email_id';
                $.ajax({
                    url: url,
                    type:'POST',
                    data: {data:hpmail},
                    success: function(data){
                            var response = JSON.parse(data);
                            if(response['message'] == "fail") {
                                $('.errorMessage').addClass('alert-danger').show();
                                $('.alert-danger').text('homephysican email not found, please enter correct email id');
                                return false; 
                            }else{
                                  var resp = response['list'];
                                  var userid = resp['userid'];
                                  var id = resp['ID'];
                                  $('.addhpid').val(userid);
                                  $('.addid').val(id);
                                  $('.errorMessage').removeClass('alert-danger').hide();
                            }
                        }
                    });
                    return false;
            }else{
                    $('.errorMessage').addClass('alert-danger').show();
                    $('.alert-danger').text('enter homephysican email');
                    return false; 
            }

    });

  // ----------- check unique username -------------//

    $('body').on( 'blur', '.urname', function() {
            var urname=  $(this).val();
            if(urname != ''){
                var url = base_url+'/Ajax/check_unique_username';
                $.ajax({
                    url: url,
                    type:'POST',
                    data: {data:urname},
                    success: function(data){
                            var response = JSON.parse(data);
                            if(response['message'] == "SUCCESS") {
                                $('.errorMessage').addClass('alert-danger').show();
                                $('.alert-danger').text('username already exits');
                                return false; 
                            }
                        }
                    });
                return false;
            }else{
                    $('.errorMessage').addClass('alert-danger').show();
                    $('.alert-danger').text('enter username');
                    return false; 
            }

    });

   // ----------- end of block ----------------//


   // --------- check uinque email ------------//

     $('body').on( 'blur', '.email', function() {
            var email=  $(this).val();
            if(email != ''){
                var url = base_url+'/Ajax/check_unique_email';
                $.ajax({
                    url: url,
                    type:'POST',
                    data: {data:email},
                    success: function(data){
                            var response = JSON.parse(data);
                            if(response['message'] == "SUCCESS") {
                                $('.errorMessage').addClass('alert-danger').show();
                                $('.alert-danger').text('email already exits');
                                return false; 
                            }
                        }
                    });
                return false;
            }else{
                $('.errorMessage').addClass('alert-danger').show();
                $('.alert-danger').text('enter email');
                return false; 
            }
    });

    // ---------- end of block -----------------// 


    $('body').on( 'click', '#sendSlotData', function() {
        $('.saveBooking').submit();
    })


    function whichDay(dateString) {
        return ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'][new Date(dateString).getDay()];
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

}); // end of document ready section


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
        

//--------------------- get slots for next  week -----------------------------------------//

    $('.slotSearchRight').on( 'click',  function() {

       $('.centerLoder').show();


        var prid = $(this).attr('prid');
        var docId = $(this).attr('docId');

        var lastDate = $('#datewise_6').find('input').attr('value');

        var c_Date = $('#datewise_0').find('input').attr('value');

        $('.slotSearchLeft').show(); 

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
        for(var i = 0 ; i < 7 ; i++){
            var next = new Date(latestdate1.getTime());
            next.setDate(first + i);
            var day = next.getDate();
            var month1 = next.getMonth();

            var newmnt = month1 + 1;

             if(newmnt < 9 ){

                newmnts = "0" + newmnt;
            }

            var year = next.getFullYear();
            var mktime = next.getTime();
            dates1.push(year + "-" + newmnts + "-" + day);
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
                    var icnt = 0;

                  var output ='<div class="findprocedure_calendar removeoldItems">'+
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

                            SlotsStructure += '<div class="createprocedure_calendar_date"> ' +
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
                        '</div>';

                    setTimeout(function(){

                    $('.centerLoder').hide();
                    $('.removeoldItems').empty();
                    $(".newAppendedItems").html(output);

                    }, 500) ;  

                }else{

                }
            }
        });
        return false;
    });


    //----------------------- get slots for preview week ---------------------------------//

    $('.slotSearchLeft').click(function() {

        $('.centerLoder').show();

        var prid = $(this).attr('prid');
        var docId = $(this).attr('docId');

        var lastDate = $('#datewise_0').find('input').attr('value');

        var Curntdate = new Date(lastDate);

        if(Curntdate.getDate() == 31){
            var day1 =  Curntdate.getDate();
        }else{
            var day1 =  Curntdate.getDate() - 1;
        }

        var month11 = Curntdate.getMonth() + 1;
         if(month11 < 9 ){
                month11 = "0" + month11;
         }

        var year1 = Curntdate.getFullYear();

        var previousLastDate = year1 + "-" + month11 + "-" + day1;

        var previousLastDateStd = new Date(previousLastDate);

               monthsArray = [];
                monthsArray[1] = 'Jan';
                monthsArray[2] = 'Feb';
                monthsArray[3] = 'Mar';
                monthsArray[4] = 'Apr';
                monthsArray[5] = 'May';
                monthsArray[6] = 'June';
                monthsArray[7] = 'July';
                monthsArray[8] = 'Aug';
                monthsArray[9] = 'Sep';
                monthsArray[10] = 'Oct';
                monthsArray[11] = 'Nov';
                monthsArray[12] = 'Dec';

        var previousWeekdate = [];
        var previousDates = [];
        var daynamePrev =[];
        var first = previousLastDateStd.getDate();

        for(var i = 0 ; i < 7 ; i++ ){
            var nextdates = new Date(previousLastDateStd.getTime());
            nextdates.setDate(first - i);
            var day = nextdates.getDate();
            var monthleft = nextdates.getMonth() + 1;
             if(monthleft < 9 ){
                new_mn = "0" + monthleft;
            }

            var year = nextdates.getFullYear();
            var mktime = nextdates.getTime();
            previousDates.push(year + "-" + new_mn  + "-" + day);
            previousWeekdate.push(day +" "+ monthsArray[monthleft]);
            daynamePrev.push(whichDay(year + "-" + monthleft + "-" + day));
        }
            

        //---------- show , hide arrows based on current date----------------- // 

          var todaydate = new Date();
          var c_month = todaydate.getMonth() + 1;
          var c_year = todaydate.getFullYear();
          if(todaydate.getDate() == 31){
              var c_day =  todaydate.getDate();
          }else{
              var c_day =  todaydate.getDate();
          }

          if(c_month < 9 ){
              c_mn = "0" + c_month;
          }else{
              c_mn = c_month;
          }

          var today_date = c_year + "-" + c_mn + "-" + c_day;
          var found = false;

            for(var  p =0; p < previousDates.length; p++) {
                  if (previousDates[p] == today_date) {
                    found = true;
                  }
            }

            if(found == true){
               $('.slotSearchLeft').hide(); 
            }

        previousDates = previousDates.reverse();
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
                    var output ='<div class="findprocedure_calendar removeoldItems">'+
                          '<table cellspacing="0" cellpadding="0">'+
                          '<tbody>'+
                          '<tr>';
                    var strClassSlot;
                   var counterSt = 0;

                    for(var ks =  previousWeekdate.length - 1 ; ks >= 0 ; ks-- ){
                        if(ks == 0 || ks == 6){
                            strClassSlot = 'getdates';
                        }else{
                            strClassSlot = '';
                        }

                        output += '<th id ="datewise_'+counterSt+'">'+daynamePrev[ks]+'<span>'+previousWeekdate[ks]+'</span><input type ="hidden" name ="dayDates" class =""  value ="'+previousDates[ks]+'"></th>';
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
                        '</div>';

                  setTimeout(function(){

                    $('.centerLoder').hide();
                    $('.removeoldItems').empty();
                    $(".newAppendedItems").html(output);

                    }, 500) ;  
                  
                }else{

                }
               
            } // end of sucess
        });
        return false;
    });

    function whichDay(dateString) {
        return ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'][new Date(dateString).getDay()];
    }

});