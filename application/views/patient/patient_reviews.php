      
<style>
.es-carousel ul li a img {
	border: medium none;
	display: block;
	height: 250px;
	width: 250px;
}
.es-carousel ul li {
	height: auto;
	padding: 16px;
}
.es-carousel {
	background: transparent none repeat scroll 0 0;
	overflow: hidden;
}
.es-carousel-wrapper {
	background: transparent none repeat scroll 0 0;
	border-radius: 0;
	box-shadow: none;
}
.round {
    
    border-radius: 100%;
    height: 104px;
    overflow: hidden;
    padding: 1px;
    width: 109px;
}
.patient_recent_reviews_border_bottom {
    border-bottom: 1px solid #cdcdcd;
    margin: 0 0 7px;
    padding-bottom: 18px;
}
.patient_content_right_text_reviews_img {
    float: left;
    padding: 8px 58px 22px;
    position: relative;
}
.patient_recent_reviews_border_bottom {
   
    padding-bottom: 5px !important;
}
</style>

        
        <div class="col-md-10 container_padding_none" ng-controller="patientReviewCtrl">
          <div class="content_right">
            <div class="content_right_appointments_titel">
              <h1>Reviews</h1> 
              </div>
            <div class="patient_reviews_content"> 
                   	<h1 class="patient_reviews_content_titel">Pending Reviews (5)</h1>
                    <div class="patient_reviews_slider">
                    	<div class="owl-carousel">
                        
                        <?php foreach($pending_patient_review as $pending_patient_review){?> 
                       
                      <div class="item"><div class="patient_reviews_slider_box">
                    		<span>Procedure:</span>
                            <h1><?php echo $pending_patient_review->description; ?></h1>
                            <img src="<?php echo base_url();?><?php echo $pending_patient_review->specialistpic; ?>" style="height:150px" />
                            <h2>Dr. <?php echo $pending_patient_review->name; ?></h2>
                            <a href="#">review</a>
                    	</div></div>
                        
                          <?php } ?>  
                        
                        </div>
                    </div>
                </div>                 
                  <div class="patient_recent_reviews_content"> 
                   	<h1 class="patient_reviews_content_titel">Recent Reviews</h1>
                    
                    
                   <div class="patient_recent_reviews_border_bottom" ng-repeat="hpatientRecentreview in hpatientRecentreview |limitTo:limit">
                <div class="row">
                  <div class="col-md-3">
                    <div class="findprocedure_appointments_content_date">
                      <h1><strong>{{hpatientRecentreview.slot_date | date:'d'}}th</strong><br/>
                      {{hpatientRecentreview.slot_date | date:'MMM'}}</h1>
                    </div>
                    <div class="findprocedure_appointments_procedure_name"> <span>Procedure Name</span>
                      <h2>{{hpatientRecentreview.procedure_name}}</h2>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="findprocedure_appointments_box_right">
                     <div class="patient_book_appointment_left">
                     <div class="round">
                     <img style="width:150px; height:150px;" src="<?php echo base_url();?>{{hpatientRecentreview.specialistpic}}">
                     </div>
                        
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                  <div class="patient_book_appointment_left_text">
                          <h1>Dr.{{hpatientRecentreview.name}}</h1>
                          <span>{{hpatientRecentreview.procedure_name}}</span> </div>
                  
                  </div>
                  <div class="col-md-2">
                   <div class="patient_content_right_text_reviews_img">
                   <img src="<?php echo base_url();?>assets/image/reviews_on_procedures_box_position.png" /> <span>5</span> </div>
                  
                  </div>
                  <div class="col-md-3 text-right">
                    <div class="patient_content_right_text_reviews_content">
                                <p>{{hpatientRecentreview.review}}</p>
                                </div>
                  </div>
                </div>
              </div>
                    
                    
                    <div ng-show="message"><div class="alert alert-success text-center">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>No record found</strong>
</div></div>
                  
                  
                  <div class="findprocedure_button"><a href="javascript:void(0)" ng-hide="loadmore" ng-click='loadMore()' class="content_right_patients_load_more">load more</a></div>
               </div>
            </div>
            </div>
          
       </div>
    </div>
  </div>
</section>
<script type="text/javascript">

var patient_id= '<?php echo $patient_id; ?>';
	 
  </script>    
       