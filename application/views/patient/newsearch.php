<section>
<div class="content">
<div class="container-fluid container_padding_none">
<div class="srow">

<div class="col-md-10 container_padding_none">
<div class="content_right">
<div class="content_right_titel">
    <h1>Find Procedure</h1>
    <span><i class="fa fa-calendar"></i> <?php echo date('d-m-Y'); ?></span> </div>

<form id ="procedureSearch" method="GET" action="">
<ul class="content_right_menu_top_ul">
    <li class="content_right_menu_select_category">
        <div class="select-style">
            
             <select name="procedure_cat" id="procedureCat" required="" class="form-control input-sm parsley-validated">
                 <?php
                    $selectedcat="";
                    if(!empty($posted_data))
                    {
                        $selectedcat=$posted_data["cat_id"];
                    }
               
                    foreach($pro_cat as $key => $val ) { ?>
                      <option value="<?php echo $key; ?>" <?php if( $selectedcat == $key ) { echo "selected" ; } ?> > <?php echo $val; ?>       </option>
                        
                <?php }?>
                 
                  
            </select>
            
        </div>
    </li>
    <li class="content_right_menu_select_category">
        <div class="select-style">
            <?php
            
            $default = 'select procedure name';
            $extra = 'id ="procedureName" required class="form-control input-sm parsley-validated"';
            
                    $selectedpro="";
                    if(!empty(  $posted_data))
                    {
                        $selectedpro=$posted_data["pro_id"];
                        $procedures = $posted_data["procedures"]; 
                        echo '<select name="procedure_name" id ="procedureName"  required class="form-control input-sm parsley-validated">';
                          foreach($procedures as $pro ) { ?>
                      <option value="<?php echo $pro['ID']; ?>" <?php if( $selectedpro == $pro['ID'] ) { echo "selected" ; } ?> > <?php echo  $pro['procedure_name']; ?></option>                      
                <?php }
                     echo '</select>';
            
           
                    }
                    else 
                {?>
                        
                    <select name="procedure_name" id ="procedureName"  required class="form-control input-sm parsley-validated">    
                        <option value ="" selected>Please select name</option>        
                </select>    
                   
            <?php    }  ?>
        </div>
    </li>
    <li class="content_right_menu_input content_right_menu_input_location">
        <input type ="text" name ="location" placeholder="Location" value="<?php echo isset($_GET['location']) ? $_GET['location'] : '' ?>"/>
    </li>
    <li class="content_right_menu_input content_right_menu_input_zipcode">
        <input type ="text" name ="zip" placeholder="Zipcode" value="<?php echo isset($_GET['zip']) ? $_GET['zip'] : '' ?>" />
    </li>
    <li class="content_right_menu_select_category content_right_menu_select_radius">
        <div class="select-style">
            <select name ="km" id ="milessort">
                <option value ="5" <?php if( $km == "5" ) { echo "selected" ; } ?>>5</option>
                <option value ="10" <?php if( $km == "10" ) { echo "selected" ; } ?> >10</option>
                <option value ="15" <?php if( $km == "15" ) { echo "selected" ; } ?>>15</option>
                <option value ="20" <?php if( $km == "20" ) { echo "selected" ; } ?> >20</option>
                <option value ="25" <?php if( $km == "25" ) { echo "selected" ; } ?>>25</option>
            </select>
        </div>
    </li>
    <li class="content_right_menu_find_button"> <button type ="submit" id="search">find</button></li>
</ul>
</form>

<div class="patient_maps"> <div id="googleMap" style="width:100%; height:320px;"></div></div>
<div class="patient_maps"> <div id="Searchmap"></div></div>
<?php 
         $procedure_cat_id = $this->input->get('procedure_cat', TRUE);   
         $procedure_name_id = $this->input->get('procedure_name_id', TRUE);   
         $city = strtolower($this->input->get('location', TRUE));   
         $zip = strtolower($this->input->get('zip', TRUE));   
        $order = $this->input->get('km', TRUE);                   
?>
<div class="patient_select_style_left1">
    <div class="select-style">
        <form name ="selctedOrder" id ="orderSearch" method ="GET">
            
            <input type="hidden" name="procedure_cat" value="<?php echo $procedure_cat_id ?>">
            <input type="hidden" name="procedure_name_id" value="<?php echo $procedure_name_id ?>">
            <input type="hidden" name="location" value="<?php echo $city ?>">
            <input type="hidden" name="zip" value="<?php echo $zip ?>">
              <input type="hidden" name="km" value="<?php echo $order ?>">
            <select name ="order" id ="searchSort">
                 <option value ="" seleted>Select </option>    
                <option value ="asc">Asc</option>
                <option value ="desc">Desc</option>
            </select>
        </form>   
    </div>
</div>
    <div class ="alert"><div class ="showMessage"></div></div>
    <div id ="search-item"></div>
    <?php
         $map = array();  
        $spdetails = array();

        $icntCOUNT = 1;
        if(!empty($prSearch)){
//            print_r($prSearch);
        foreach($prSearch as $search){
    ?>

<div class="patient_content_right_box_border_bottom" id ="search_<?php echo $icntCOUNT?>">
    <div class="patient_content_right_box_top">
        <div class="patient_book_appointment_left"> <img src="<?php echo base_url()."/".$search['picture']?>"  id = "sp-img" style ="border-radius: 51%; width: 68px;"/>
            <div class="patient_book_appointment_left_text">
                <h1 class ="sp-name"><?php echo $search['name']?></h1>
                <span class ="sp-title"><?php echo $search['title']?></span> </div>
        </div>
        <div class="patient_book_appointment_right">
            <h1 class ="sp-price">Price: $<?php echo $search['from_price']?> - $<?php echo $search['to_price']?>  </h1>
            <a href="#" class="fancybox getHrsSlots" data-toggle="modal" data-search="search_<?php echo $icntCOUNT?>" data-target="#modalslots" data-pr-id = "<?php echo $search['ID'] ?>" data-dtr ="<?php echo $search['userid'] ?>" >BOOK APPOINTMENT</a>
        </div>
    </div>
    <div class ="showSlots"></div>
    <div class="modal fade " id="book_appt" role="dialog" ></div>
    <div class="patient_content_right_box_bottom">
        <div class="patient_content_right_box_eye_checkup"> <span>PROCEDURES</span>
            <h2 class ="pr-name"><?php echo $search['procedure_name']?></h2>
            <p><?php echo $search['description']?></p>
        </div>
        <div class="patient_content_right_box_staff"> <span>STAFF</span>
            <div class="patient_content_right_slider_staff">
                <div class="owl-carousel">
                    <div class="item">
                        <div class="patient_content_right_box_staff_text">
                            <?php 
                                if(!empty($search['staff_pic'])){?>
                                <img src="<?php echo base_url();?><?php echo $search['staff_pic']?>" style ="border-radius: 51%; width: 68px;" />
                                <?php }
                            ?>
                          
                            <div class="patient_content_right_staff_text">
                                <?php 
                                    if(!empty($search['staff_name']) && !empty($search['staff_cat_name'])){
                                            $sname = $search['staff_name'];
                                            $scatname = $search['staff_cat_name'];
                                    }else{
                                        $sname = '';
                                        $scatname = '';
                                    }
                                ?>
                                <h2><?php echo $sname ?></h2>
                                <span><?php echo $scatname ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="patient_content_right_box_reviews"> <span>REVIEWS</span>
            <div class="patient_content_right_slider_reviews">
                <div class="owl-carousel">
                    <div class="item">
                        <div class="patient_content_right_text_reviews">
                            <div class="patient_content_right_text_reviews_img"> <img src="<?php echo base_url()?>/assets/images/reviews_on_procedures_box_position.png" /> <span>5</span> </div>
                            <div class="patient_content_right_text_reviews_img_icon"> <img src="<?php echo base_url()?>/assets/images/appointments_patients_icon2.png" /> </div>
                            <div class="patient_content_right_text_reviews_content">
                                <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>
                                <span>WILLIAM</span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
            $map[] = array($search['latitude'], $search['longitude']);
            $spdetails[] =  array($search['name'] ,$search['picture']);
            
      ?>
        
    <?php 
        $icntCOUNT++;
        }

        }?>

<!--<div class="findprocedure_button"><a class="content_right_patients_load_more" href="#">load more</a></div>-->
</div>
</div>
</div>
</div>
</div>
</section>

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
                    zoom: 6,
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
                             var usrid= <?php if(!empty( $search)){echo $search['userid'];} else { echo 0;} ?>;
                             var pid= <?php if(!empty( $search)){echo $search['ID'];} else { echo 0;} ?>;
                            var content="<div class='googlemap_min'><img src="+basurl+spList[k][1]+" style ='border-radius: 51%; width: 68px;'/><div class='googlemap_min_text'><h1>"+spList[k][0]+"</h1><a href='#' class='fancybox getHrsSlots' data-search='search_"+(k+1)+"' data-toggle='modal' data-target='#modalslots' data-pr-id='"+pid+"' data-dtr='"+usrid+"'>book appointment</a></div><div class='googlemap_min_icon'><i class='fa fa-star'></i><span>4.5</span></div>"
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