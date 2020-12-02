<?php //print_r($procedure);die(); ?>



<?php



define('FIRST', 2);



define('LIMIT', 4);







?>







<div class="col-md-10 container_padding_none">



    <div class="content_right_dashboard"  ng-controller="specialistreviews">



        <div class="content_right_patients_titel">



            <h1>Reviews</h1>



        </div>



        <div class="content_right1_patients">







            <div class="appointments_width_block">



                <div class="patients_select patients_select_width select-style"  >



                    <select name='procCat' id='procCat' ng-model='cc.category_name'>



                        <option selected="selected" value=''>Select Procedure Category</option>



                        <?php foreach($val as $resultcategory) { ?>



                            <option value='<?php echo $resultcategory->ID;?>'><?php echo $resultcategory->category_name;?></option>



                        <?php } ?>



                        <!--<option>procedure category</option>



                        <option>procedure category</option>



                        <option>brain</option>



                        <option>procedure category</option>-->



                    </select>



                </div>



                <div class="patients_select patients_select_width select-style">



                    <select name='procName' id='procName' ng-model='cc.procedure_name' >



                        <option selected="selected" value=''>Select Procedure</option>



                        <?php foreach($procedure as $procedurename) { ?>



                            <option value='<?php echo $procedurename->ID;?>'><?php echo $procedurename->procedure_name; ?></option>



                        <?php } ?>



                        <!--<option>procedure</option>



                        <option>bone</option>



                        <option>procedure</option>



                        <option>procedure</option>-->



                    </select>







                </div>



                <div class="patients_select">



                    <label class="date_label">



                        <input class="hasDatepicker" value="" id="datepicker" name="datepicker"  type="text" ng-model='cc.newDate'></label>



                </div>



                <div class="patients_select appointments_button_go patients_input_width select-style">



                    <a href="#" class="popup_button_go search">GO</a>



                </div>



            </div>



        </div>



        <div class="content_right_appointments_box">







            <div class="content_right_patients_box" >



                <div class="row" id='resultDiv' ng-init="showData()" >



                    <div class="col-md-6" ng-repeat="item in classifieds | limitTo: paginationLimit() | filter:cc"  flex="3">



                        <div class="reviews_content_box">



                            <div class="reviews_content_box_top">



                                <div class="reviews_content_box_left">



                                    <h1>PROCEDURES NAME:  </h1>



                                    <h2>{{item.procedure_name}}</h2>



                                </div>



                                <div class="reviews_content_box_center">



                                    <img src="<?php echo base_url();?>assets/image/reviews_on_procedures_box_position.png">



                                    <span>{{item.rating}}</span>



                                </div>



                                <div class="reviews_content_box_right">

                                   

                                       <h1>specialist name:  </h1>



                                    <h2>{{item.specialistname}}</h2>



                                </div>



                            </div>



                            <div class="reviews_content_box_bottom">

                              



                                <div class="reviews_content_box_bottom_left">



                                    <img src="<?php echo base_url();?>{{item.patient_picture}}">



                                    <span>{{item.patient_name}}</span>



                                </div>



                                <div class="reviews_content_box_bottom_right">



                                    <p>{{item.review}}</p>



                                </div>



                            </div>



                        </div>



                    </div>











                </div>



                <!-- <div class="row">



        <div class="col-md-6">



            <div class="reviews_content_box">



                <div class="reviews_content_box_top"> 



                    <div class="reviews_content_box_left">



                        <h1>PROCEDURES NAME:  </h1>



                        <h2>oral SURGERY</h2>



                    </div>



                    <div class="reviews_content_box_center">



                        <img src="<?php echo base_url();?>assets/reviews/images/reviews_on_procedures_box_position.png">



                        <span>5</span>



                    </div>



                    <div class="reviews_content_box_right">



                        <h1>specialist name:  </h1>



                        <h2>dr. anthony</h2>



                    </div>



                </div>



                <div class="reviews_content_box_bottom"> 



                    <div class="reviews_content_box_bottom_left">



                        <img src="<?php echo base_url();?>assets/reviews/images/appointments_patients_icon2.png">



                        <span>William</span>



                    </div>



                    <div class="reviews_content_box_bottom_right">



                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>



                    </div>



                </div>



            </div>



        </div>



        <div class="col-md-6">



            <div class="reviews_content_box">



                <div class="reviews_content_box_top"> 



                    <div class="reviews_content_box_left">



                        <h1>PROCEDURES NAME:  </h1>



                        <h2>kin treatment</h2>



                    </div>



                    <div class="reviews_content_box_center">



                        <img src="<?php echo base_url();?>assets/reviews/images/reviews_on_procedures_box_position.png">



                        <span>4.5</span>



                    </div>



                    <div class="reviews_content_box_right">



                        <h1>specialist name:  </h1>



                        <h2>dr. wilson</h2>



                    </div>



                </div>



                <div class="reviews_content_box_bottom"> 



                    <div class="reviews_content_box_bottom_left">



                        <img src="<?php echo base_url();?>assets/reviews/images/appointments_patients_icon3.png">



                        <span>alex young</span>



                    </div>



                    <div class="reviews_content_box_bottom_right">



                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>



                    </div>



                </div>



            </div>



        </div>



        



        </div>



          <div class="row">



        <div class="col-md-6">



            <div class="reviews_content_box">



                <div class="reviews_content_box_top"> 



                    <div class="reviews_content_box_left">



                        <h1>PROCEDURES NAME:  </h1>



                        <h2>oral SURGERY</h2>



                    </div>



                    <div class="reviews_content_box_center">



                        <img src="<?php echo base_url();?>assets/reviews/images/reviews_on_procedures_box_position.png">



                        <span>5</span>



                    </div>



                    <div class="reviews_content_box_right">



                        <h1>specialist name:  </h1>



                        <h2>dr. anthony</h2>



                    </div>



                </div>



                <div class="reviews_content_box_bottom"> 



                    <div class="reviews_content_box_bottom_left">



                        <img src="<?php echo base_url();?>assets/reviews/images/appointments_patients_icon2.png">



                        <span>William</span>



                    </div>



                    <div class="reviews_content_box_bottom_right">



                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>



                    </div>



                </div>



            </div>



        </div>



        <div class="col-md-6">



            <div class="reviews_content_box">



                <div class="reviews_content_box_top"> 



                    <div class="reviews_content_box_left">



                        <h1>PROCEDURES NAME:  </h1>



                        <h2>kin treatment</h2>



                    </div>



                    <div class="reviews_content_box_center">



                        <img src="<?php echo base_url();?>assets/reviews/images/reviews_on_procedures_box_position.png">



                        <span>4.5</span>



                    </div>



                    <div class="reviews_content_box_right">



                        <h1>specialist name:  </h1>



                        <h2>dr. wilson</h2>



                    </div>



                </div>



                <div class="reviews_content_box_bottom"> 



                    <div class="reviews_content_box_bottom_left">



                        <img src="<?php echo base_url();?>assets/reviews/images/appointments_patients_icon3.png">



                        <span>alex young</span>



                    </div>



                    <div class="reviews_content_box_bottom_right">



                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>



                    </div>



                </div>



            </div>



        </div>



        



        </div>



        <div class="row">



        <div class="col-md-6">



            <div class="reviews_content_box">



                <div class="reviews_content_box_top"> 



                    <div class="reviews_content_box_left">



                        <h1>PROCEDURES NAME:  </h1>



                        <h2>oral SURGERY</h2>



                    </div>



                    <div class="reviews_content_box_center">



                        <img src="<?php echo base_url();?>assets/reviews/images/reviews_on_procedures_box_position.png">



                        <span>5</span>



                    </div>



                    <div class="reviews_content_box_right">



                        <h1>specialist name:  </h1>



                        <h2>dr. anthony</h2>



                    </div>



                </div>



                <div class="reviews_content_box_bottom"> 



                    <div class="reviews_content_box_bottom_left">



                        <img src="<?php echo base_url();?>assets/reviews/images/appointments_patients_icon2.png">



                        <span>William</span>



                    </div>



                    <div class="reviews_content_box_bottom_right">



                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>



                    </div>



                </div>



            </div>



        </div>



        <div class="col-md-6">



            <div class="reviews_content_box">



                <div class="reviews_content_box_top"> 



                    <div class="reviews_content_box_left">



                        <h1>PROCEDURES NAME:  </h1>



                        <h2>kin treatment</h2>



                    </div>



                    <div class="reviews_content_box_center">



                        <img src="<?php echo base_url();?>assets/reviews/images/reviews_on_procedures_box_position.png">



                        <span>4.5</span>



                    </div>



                    <div class="reviews_content_box_right">



                        <h1>specialist name:  </h1>



                        <h2>dr. wilson</h2>



                    </div>



                </div>



                <div class="reviews_content_box_bottom"> 



                    <div class="reviews_content_box_bottom_left">



                        <img src="<?php echo base_url();?>assets/reviews/images/appointments_patients_icon3.png">



                        <span>alex young</span>



                    </div>



                    <div class="reviews_content_box_bottom_right">



                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>



                    </div>



                </div>



            </div>



        </div>



        



        </div>-->



                <input type="hidden" id="first" value="<?php echo FIRST; ?>" />



                <input type="hidden" id="limit" value="<?php echo LIMIT; ?>" >



                <a href="#" class="content_right_patients_load_more loadmore" ng-show="hasMoreItemsToShow()" ng-click="showMoreItems()">load more</a>



            </div>



















        </div>



    </div>



</div>











<div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>



<script>



    $(document).ready(function(){

        var baseUrl = get_base_url();

        $("#datepicker").datepicker({



            format: 'dd-mm-yyyy',



            autoclose: true



        });



        $(".search").click(function(e){



            e.preventDefault();



            var procCat=$("#procCat").val();



            var procName=$("#procName").val();



            var datepicker=$("#datepicker").val();



            var newDatepicker=datepicker.split("-");



            var datepicker1=newDatepicker[2]+"-"+newDatepicker[1]+'-'+newDatepicker[0];



            var track_click = 0;



            //alert(newDatepicker[0]);



            //alert(procCat+procName+datepicker);



            $.ajax({



                type:"POST",



                url: baseUrl+'reviews/dataListnew',



                data:{procCat:procCat,procName:procName,datepicker:datepicker1,track_click:track_click,},



                dataType: 'json',



                success: function(result)



                {



                    $("#resultDiv").empty();



                    $.each( result.result, function( key, value ) {



                        //alert( value.ID );







                        $("#resultDiv").append('<div class="col-md-6" flex="3"><div class="reviews_content_box"><div class="reviews_content_box_top"><div class="reviews_content_box_left"><h1>PROCEDURES NAME:</h1><h2>'+value.procedure_name+'</h2></div><div class="reviews_content_box_center"><img src="<?php echo base_url();?>assets/image/reviews_on_procedures_box_position.png"><span>'+value.rating+'</span></div><div class="reviews_content_box_right"><h1>specialist name:</h1><h2>'+value.name+'</h2></div></div><div class="reviews_content_box_bottom"><div class="reviews_content_box_bottom_left"><img src="<?php echo base_url();?>'+value.pic+'"><span>'+value.fname+'</span></div><div class="reviews_content_box_bottom_right"><p>'+value.review+'</p></div></div></div></div>');



                    })



                    var numrows=result.rowcount;



                    //alert(numrows);



                    var total_pages=result.rowcount/2;



                    //track user click on "load more" button, righ now it is 0 click



                    //alert(total_pages);



                    $(".loadmore").click(function (e) { //user clicks on button



                        if(track_click <= total_pages) //user click number is still less than total pages



                        {



                            //post page number and load returned data into result element



                            $.post('fetch_pages.php',{'page': track_click}, function(data) {



                                $(".load_more").show(); //bring back load more button



                                $("#results").append(data); //append data received from server



                                //scroll page smoothly to button id



                                $("html, body").animate({scrollTop: $("#load_more_button").offset().top}, 500);



                                //hide loading image



                                $('.animation_image').hide(); //hide loading image once data is received



                                track_click++; //user click increment on load button



                            }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?



                                alert(thrownError); //alert with HTTP error



                                //$(".load_more").show(); //bring back load more button



                                //$('.animation_image').hide(); //hide loading image once data is received



                            });



                            if(track_click >= total_pages-1) //compare user click with page number



                            {



                                //reached end of the page yet? disable load button



                                $(".load_more").attr("disabled", "disabled");



                            }



                        }



                    });



                }



            });



        });



        /*$('.loadmore').click(function(e){



         //alert("f");



         e.preventDefault();



         first = $('#first').val();



         limit = $('#limit').val();



         var procCat=$("#procCat").val();



         var procName=$("#procName").val();



         var datepicker=$("#datepicker").val();



         var newDatepicker=datepicker.split("-");



         var datepicker1=newDatepicker[2]+"-"+newDatepicker[1]+'-'+newDatepicker[0];



         $.ajax({



         type:"POST",



         url: 'reviews/dataListnew1',



         data:{procCat:procCat,procName:procName,datepicker:datepicker1,start : first, limit : limit},



         dataType: 'json',



         success: function(result)



         {



         if (!$.trim(result)){



         $('.loadmore').hide();



         }



         else{



         $("#resultDiv").empty();



         $.each( result, function( key, value ) {







         // alert( value.ID );







         $("#resultDiv").append('<div class="col-md-6" flex="3"><div class="reviews_content_box"><div class="reviews_content_box_top"><div class="reviews_content_box_left"><h1>PROCEDURES NAME:</h1><h2>'+value.procedure_name+'</h2></div><div class="reviews_content_box_center"><img src="<?php echo base_url();?>assets/image/reviews_on_procedures_box_position.png"><span>'+value.rating+'</span></div><div class="reviews_content_box_right"><h1>specialist name:</h1><h2>'+value.name+'</h2></div></div><div class="reviews_content_box_bottom"><div class="reviews_content_box_bottom_left"><img src="<?php echo base_url();?>'+value.pic+'"><span>'+value.fname+'</span></div><div class="reviews_content_box_bottom_right"><p>'+value.review+'</p></div></div></div></div>');



         })



         //alert('ff');



         first = parseInt($('#first').val());



         limit = parseInt($('#limit').val());



         $('#first').val( first+limit );



         }



         }



         });







         });*/



        /*$("#datepicker").on("change",function(){



         $("#datepicker").focus();



         //var datePickerVal=$("#datepicker").val();



         //$("#datepicker").val(datePickerVal+" ");



         var e = jQuery.Event("keypress");



         e.which = 32; // # Some key code value



         e.keyCode = 32;



         $("#datepicker").trigger(e);



         $("#datepicker").focusout();



         });*/



    });



</script>