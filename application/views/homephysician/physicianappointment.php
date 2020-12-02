<div class="col-md-10 container_padding_none">

  <div class="content_right_dashboard">

    <div class="content_right_patients_titel">

      <h1>Appointments</h1>

    </div>

    <div class="content_right1_patients">

      <div class="appointments_width_block">

        <div class="patients_select patients_select_width select-style">

          <select id="procedure">

            <option value="">Select Procedure Category</option>

            <?php foreach($procedure as $procedureDetails) { ?>

            <option value='<?php echo $procedureDetails->ID;?>'><?php echo $procedureDetails->category_name;?></option>

            <?php } ?>

          </select>

        </div>

        <div class="patients_select patients_select_width select-style">

          <select id="procedureCategory">

            <option value="">Select Procedure</option>

          </select>

        </div>

        <div class="patients_select">

          <label class="date_label">

            <input id="datepicker" class="hasDatepicker" type="text">

          </label>

        </div>

        <div class="patients_select appointments_button_go patients_input_width select-style"> <a id='filterHphysician' href="javascript:void(0)" class="">GO</a> </div>

      </div>

    </div>

    <div class="content_right_appointments_box">

      <div class="col-md-3 container_padding_none">

        <div class="content_right_appointments_left_box">

          <div class="content_right_appointments_titel"> <a href="javascript:void(0)"><i class="fa fa-calendar"></i> <?php echo $todaysdate ?></a>

          <a href="javascript:void(0)" class="content_right_appointments_patients"><?php echo $totalpatient ?> patients</a> </div>

          

          <div class="content_right_appointments_menu">

            <?php foreach($slotwiseAppointment as $key => $value){ ?>

            <div class="appointmentList">

              <h1><i class="fa fa-clock-o"></i> <?php echo $key ?></h1>

              <ul>

                <?php foreach($value as $appKey => $appointmentName){ ?>

                <li> <a href="javascript:void(0)" patientid="<?php echo $appointmentName['patientID'] ?>" bookingid="<?php echo $appointmentName['bookingID']?>"
                 id="physicianAppointmentDetails"> <img src="<?php echo base_url(); ?><?php echo $appointmentName['pic'] ?>" /> <span><?php echo $appointmentName['name'] ?>

                  <input type="hidden" class="patientid" value="<?php echo $appointmentName['patientID'] ?>">

                  <input type="hidden" class="bookingId" value="<?php echo $appointmentName['bookingID'] ?>">

                  </span> </a> </li>

                <?php } ?>

              </ul>

            </div>

            <?php } ?>

          </div>

        </div>

      </div>

      <div id="physicianappointmentDetails" class="col-md-9 container_padding_none" style="display:none">

        <div class="appointments_right_padding">

          <div class="appointments_right_overflow">

            <div class="appointments_left_block"> <img src="" style="display:none" alt="patient image"/>

              <div class="appointments_left_block_text">

                <h1></h1>

                <p></p>

              </div>

            </div>

            <div class="appointments_right_block">

              <h1><i class="fa fa-clock-o"></i> </h1>

              <a href="#inline1" class="fancybox appointments_right_button_complete">Reminder</a>

              <div id="inline1" style="width:300px;display: none;">

                <div class="popup_button_complete">

                  <h1>Are you Sure?</h1>

                  <div class="popup_button_complete_button"> <a href="javascript:void(0)" class="active" id="physicianReminder">yes</a> 

                  <a href="javascript:void(0)">no</a> </div>

                </div>

              </div>

              <a href="#inline2" class="fancybox appointments_right_button_cancel">cancel</a> </div>

              <div id="inline2" style="width:300px;display: none;">

                <div class="popup_button_complete">

                  <h1>Do You want to cancel Booking?</h1>

                  <div class="popup_button_complete_button"> <a href="javascript:void(0)" class="active" id="bookingCancel">yes</a> 

                  <a href="javascript:void(0)">no</a> </div>

                </div>

              </div>

          </div>
          <div class="appointments_homephy_right">

            <div class="appointments_homephy_left"> <img src=""  style="display:none" alt="specialist image"/>

              <div class="appointments_homephy_left_price"> <i class="fa fa-star"></i> <span></span> </div>

            </div>

            <div class="appointments_homephy_right_box">

              <ul class="appointments_homephy_right_menu">

                <li> <span>Specialist Name</span>

                  <h1></h1>

                </li>

                <li> <span>Procedure Category</span>

                  <h2 class="appointments_homephy_right_eye"></h2>

                </li>

                <li> <span>Procedure Name</span>

                  <h2> </h2>

                </li>

                <li> <span>Price</span>

                  <h2></h2>

                </li>

              </ul>

              <div class="appointments_homephy_right_content">

                <p></p>

              </div>

            </div>

          </div>
          <div class="appointments_right_tabs">

                     <ul class="nav appointments_right_menu">

                            <li class="active"><a href="#appointments" data-toggle="tab">checkup</a></li>

                            <li><a href="#prescription" data-toggle="tab">prescription</a></li>

                             <li><a href="#medicalhistory" data-toggle="tab" class="homePhyMedicalHis">medical history</a></li>

                             <!--<li><a href="#message" data-toggle="tab">message</a></li> -->

                       </ul>

                        <div class="tab-content clearfix">

                            <div class="tab-pane  active " id="appointments">

                                <?php //include('appointments/appointments.php'); ?>

                            </div>

                            <div class="tab-pane appointments_right_content_tabs" id="prescription">

                                <?php //include('appointments/prescription.php'); ?>

                            </div>

                            <div class="tab-pane appointments_right_content_tabs" id="medicalhistory">

                               <?php include('appointments/medicalhistory.php'); ?>

                            </div>

                           <!-- <div class="tab-pane appointments_right_content_tabs" id="message">

                                <?php //include('includes/message.php'); ?>

                            </div>-->

                        </div>

                    </div>

        </div>

      </div>

    </div>

  </div>

</div>

<input type="hidden" id="bookingid" />

<input type="hidden" id="patientid" />

