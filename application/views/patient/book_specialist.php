<div class="col-md-10 container_padding_none">
    <div class="content_right">
            <?php
                $time_slot = $this->input->get('time_slot' , TRUE);
                $doc_id = $this->input->get('docId', TRUE);
                $pr_id = $this->input->get('pr_id', TRUE);
                $date = $this->input->get('date', TRUE);    
                $city = $this->input->get('location', TRUE);    
                $zip = $this->input->get('zip', TRUE);    
                $procedure_name = $this->input->get('procedure_name', TRUE); 
                $procedure_cat_id = $this->input->get('procedure_cat_id', TRUE);    
                
              ?>
        <div class="content_right_appointments_titel">
            <h1>Book Appointment Detail</h1>
<a href="<?php echo base_url() ?>/patient/search?procedure_cat=<?php echo $procedure_cat_id ?>&procedure_name=<?php echo $procedure_name ?>&location=<?php echo $city ?>&zip=<?php echo $zip ?>  " ><i class="fa fa-chevron-left"></i> back to list</a>
        </div>
        <div class="findprocedure_detail">
           
            <div class="col-md-8 container_padding_none">
                <div class="findprocedure_detail_border">
                    <div class="findprocedure_detail_box_top">
                        <div class="findprocedure_detail_img"><img  src="<?php echo base_url().$spdata->picture?>" style ="border-radius: 50%;width: 110px;"/></div>
                        <div class="findprocedure_detail_box_top_right">
                            <div class="findprocedure_detail_box_left_titel">	<div class="findprocedure_detail_titel_top_left">
                                    <h1><?php echo $spdata->name?></h1>
                                    <span><?php echo $spdata->title ?></span>
                                </div>
                                <div class="findprocedure_detail_titel_top_right">
                                    <span>Price </span>
                                    <h2><?php  echo '$'.$procedure->from_price ?>  -  <?php echo '$'.$procedure->to_price ?></h2>
                                </div></div>

                            <div class="findprocedure_detail_box_top_bottom">
                                <h2>appointment </h2>
                                <a href="#" class="findprocedure_detail_box_pencil"><i class="fa fa-pencil"></i></a>
                                <div class="findprocedure_detail_box_top_bottom_white">
                                    <div class="findprocedure_detail_box_left_white">
                                        <span>day:</span>
                                        <h3><?php $dt = new DateTime($date); echo $dt->format("dS M Y");?></h3>
                                    </div>
                                    <div class="findprocedure_detail_box_right_white">
                                        <span>time:</span>
                                        <h3><?php echo $time_slot;?></h3>
                                    </div>
                                </div>
                            </div></div>
                    </div>
                    <div class="findprocedure_detail_box_center">
                        <span>procedures</span>
                        <?php 
                            echo $_GET['date'];
                        
                        ?>    
                        
                        <h1><?php echo $procedure->procedure_name ?></h1>
                        <h2><?php echo $procedure->description ?></h2>

                    </div>
                    <div class="findprocedure_detail_box_bottom">
                        <span>Any Detail</span>
                        
                        <form class ="saveBooking" method ="Post" action ="">
                            <input type ="hidden" name ="Saveslotdata"  />
                            <textarea name ="patient_desc"></textarea>
                            <input type ="hidden" name ="pr_id" value ="<?php echo $pr_id ?>" />
                            <input type ="hidden" name ="doc_id" value ='<?php echo $doc_id ?>' />
                            <input type ="hidden" name ="time_slot" value = '<?php echo $time_slot ?>'/>
                            <input type ="hidden" name ="date" value ='<?php echo $date ?>' />
                            <input type ="hidden" name ="home_phy_id" value ='<?php echo $home_ph_id->refered_by ?>' />

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4 container_padding_none">
                <div id="googleMap" class="findprocedure_detail_maps_img"></div>
              <!--   <div id="googleMap" class="findprocedure_detail_maps_img"></div> -->
                <div class="findprocedure_detail_content_right">
                   <!--  <div class="patient_content_right_box_reviews"> <span>REVIEWS</span>
                        <div class="patient_content_right_slider_reviews">
                            <div class="owl-carousel">
                                <div class="item">
                                    <div class="patient_content_right_text_reviews">
                                        <div class="patient_content_right_text_reviews_img"> <img src="<?php echo base_url();?>assets/images/reviews_on_procedures_box_position.png" /> <span>5</span> </div>
                                        <div class="patient_content_right_text_reviews_img_icon"> <img src="<?php echo base_url();?>assets/images/appointments_patients_icon2.png" /> </div>
                                        <div class="patient_content_right_text_reviews_content">
                                            <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>
                                            <span>WILLIAM</span> </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="patient_content_right_text_reviews">
                                        <div class="patient_content_right_text_reviews_img"> <img src="<?php echo base_url();?>assets/images/reviews_on_procedures_box_position.png" /> <span>5</span> </div>
                                        <div class="patient_content_right_text_reviews_img_icon"> <img src="<?php echo base_url();?>assets/images/appointments_patients_icon2.png" /> </div>
                                        <div class="patient_content_right_text_reviews_content">
                                            <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>
                                            <span>WILLIAM</span> </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="patient_content_right_text_reviews">
                                        <div class="patient_content_right_text_reviews_img"> <img src="<?php echo base_url();?>assets/images/reviews_on_procedures_box_position.png" /> <span>5</span> </div>
                                        <div class="patient_content_right_text_reviews_img_icon"> <img src="<?php echo base_url();?>assets/images/appointments_patients_icon2.png" /> </div>
                                        <div class="patient_content_right_text_reviews_content">
                                            <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>
                                            <span>WILLIAM</span> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
 -->

                </div>
                <div class="findprocedure_detail_content_right_button">
                    <a href="#" class="findprocedure_detail_book" id ="sendSlotData">book appointment</a>
                    <a href="#" class="findprocedure_detail_cancel">cancel</a>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
        $map[] = array( $spdata->latitude, $spdata->longitude );
        $spdetails[] =  array($spdata->name ,$spdata->address." ".$spdata->city);
        
  ?>
<script type="text/javascript">

    var cord = '<?php echo json_encode($map); ?>';
        

        var mapcord = JSON.parse(cord);
        var spdata = '<?php echo json_encode($spdetails); ?>';
        var spList = JSON.parse(spdata);
        if(cord.length > 0){
            function initialize(){
                var latlng = new google.maps.LatLng(53.3662363, -114.9974341);
                var myOptions = {
                    center: latlng,
                    zoom: 12,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,

                };
                var map = new google.maps.Map(document.getElementById("googleMap"),
                    myOptions);

                var marker
                var infowindow = new google.maps.InfoWindow({
                });
                var contentString
           var latlngs = new google.maps.LatLng(mapcord[0][0],mapcord[0][1]);
            map.setCenter(latlngs);
            map.panTo(latlngs);
                for(var k = 0 ; k < mapcord.length; k++){
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(mapcord[k][0],mapcord[k][1]),
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
                             var basurl = get_base_url();
                            var content="<div class='googlemap_min'><div class='googlemap_min_text'><h1>"+spList[k][0]+"</h1><p>"+spList[k][1]+"</p></div><div class='googlemap_min_icon'></div>"
                            infowindow.setContent(content);
                            infowindow.open(map, marker);
                        }

                    })(marker, k));
                }
                
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        }




</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/google_map_icon/js/map-icons.js"></script>