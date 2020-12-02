<?php

class Search_model extends CI_Model {
    
    public function __construct(){

        parent::__construct();

        $this->load->model('Admin_model');

        $this->load->model('hospital_model');

        $this->load->model('Procedure_model');
        
        $this->load->model('Home_physician_model');
        
        $this->load->model('Login_model');
        
        $this->load->model('Patient_model');

        $this->load->model('Specialist_model');

        $this->load->model('booking_model');

        $this->load->model('user');

        $this->load->model('Staff_model');

        $this->load->helper('url');

        $this->load->helper('common');

        $this->load->library('session');

    }
    
        /* @method : save_register_booking_details
     * @params:
     * @desc: save_register_booking_details method is used for saving user and booking data
     */
        public function save_register_booking_details($postdata){
        
                $time_slot = $postdata['time_slot'];
                $doc_id = $postdata['doc_id'];
    //            $pr_id = $postdata['pr_id'];
                $pr_name_id = $postdata['pr_id']; 
                $date = $postdata['date'];
                $hp_user_id = $postdata['hp_user_id'] ; // refered by id for home phy table user_id
                $hp_id = $postdata['hp_id']; // home phy id
            
                // save user data first //
                $firstname = $postdata['firstname'];
                $lastname = $postdata['lastname'];
                $username = $postdata['username'];
                $emailp = $postdata['email'];
                $pass = $postdata['password'];

               $data = array(
                    'name' => $username,
                    'fname' => $firstname,
                    'lname'=> $lastname,
                    'password' => md5($pass),
                    'email' => $emailp,
                    'usertype' => 'patient'
                );

                $this->db->insert('huser',$data);
            
                $lastId = $this->db->insert_id(); // patient id from huser table and userid of hpatient table
                
                $userdata = array('user_id' => $lastId, 'userid' => $lastId ,  'fname' => $firstname,'lname'=> $lastname,'name' => $username , 'email' => $emailp,'usertype' => 'patient' );
                
                $this->session->set_userdata($userdata); // create new session for register patient
            
            // -----------end of block----------------------//
           
            //------ add new patinet details into hpatient table -------- //
                 
                $pats = array(
                    'userid' => $lastId,
                    'refered_by' => $hp_user_id, 
                    'username' => $username,
                    'fname' => $firstname,
                    'lname'=> $lastname,
                    'email' => $emailp,
                );
                $this->db->insert('hpatient',$pats);
            // ----------end of block -------------//
            
            
            // ------ saving booking data in db ------------- //
            
            
            
            $this->db->select('ID');
            $this->db->from('hbooking');
            $this->db->where('specialist_user_id' , $doc_id);
            $this->db->where('procedure_id' , $pr_name_id);
            $this->db->where('booking_date' , $date);
            $this->db->where('booking_time' , $time_slot);
            $queryBooking = $this->db->get();
            
            $bookingFoundPrc = 0;
            
            if($queryBooking->num_rows() > 0){
                $bookingFoundPrc = 1;
            }

            //-------- check if booking is already exist or not--------------- //
            
            if($bookingFoundPrc != 1){

                $this->db->select('ID, seats ');
                $this->db->from('hproceduretimeslot');
                $this->db->where('specialist_id' , $doc_id);
                $this->db->where('procedure_id' , $pr_name_id);
                $this->db->where('slot' , $time_slot);
                $pr_slot_data = $this->db->get()->row();
            
                $data = array(
                    'specialist_user_id' => $doc_id,
                    'procedure_id' => $pr_name_id,
                    'procedure_slot_id' => $pr_slot_data->ID,
                    'homephy_id' => $hp_user_id,
                    'booking_date' => $date,
                    'booking_time' => $time_slot,
                    'patient_user_id' => $lastId,
                   
                );
                $this->db->insert('hbooking',$data);         // Booking save done
            
            // -------------------------------------- end of block -------------------------------------//

             //----------------------------------- check slot avaialable -------------------------------------//
            
            $this->db->select('no_of_booked_appt');
            $this->db->from('hproceduredate');
            $this->db->where('doctorid' , $doc_id);
            $this->db->where('procedureid' , $pr_name_id);
            $this->db->where('time_slot' , $time_slot);
            $aval_slot_data = $this->db->get()->row();

            if(empty($aval_slot_data)){
                
                $no_of_booked_appt = 1;
                $hbooking = array(
                    'doctorid' => $doc_id,
                    'procedureid' => $pr_name_id,
                    'date' => $date,
                    'time_slot' => $time_slot,
                    'no_of_appt' => $pr_slot_data->seats,
                    'no_of_booked_appt' => $no_of_booked_appt,
                );
                $this->db->insert('hproceduredate',$hbooking);
            }else{
                $no_of_booked_appt = $aval_slot_data->no_of_booked_appt + 1;
                $data1 = array(
                    'doctorid' => $doc_id,
                    'procedureid' => $pr_name_id,
                    'date' => $date,
                    'time_slot' => $time_slot,
                    'no_of_appt' => $pr_slot_data->seats,
                    'no_of_booked_appt' => $no_of_booked_appt,

                );
                $this->db->where('procedureid' , $pr_name_id);
                $this->db->where('time_slot' , $time_slot);
                $this->db->where('doctorid' , $doc_id);
                $this->db->update('hproceduredate',$data1);
            }
            //---------- end of block --------------------//
            
            //---------------- checking data exist in hspecialist_pro_appointment ----------------//
            
            $this->db->select('ID, total_appt');
            $this->db->from('hspecialist_pro_appointment');
            $this->db->where('userid' , $doc_id);
            $this->db->where('procedure_id' , $pr_name_id);
            $this->db->where('date' , $date);
            $avaldata = $this->db->get()->row();
            $proId ="";
            if(!empty($avaldata)){
                
                $totalappts = $avaldata->total_appt + 1;
                $proadd = array(
                    'total_appt' => $totalappts,
                    );
                 $proId = $avaldata->ID;
                 $this->db->where('ID' , $proId);
                 $this->db->update('hspecialist_pro_appointment',$proadd);
                
            }else{
                 $proaddnew = array(
                    'userid' => $doc_id,
                    'procedure_id' => $pr_name_id,
                    'date' => $date,
                    'total_appt' => 1,
                    );
                $this->db->insert('hspecialist_pro_appointment',$proaddnew);
                $proId = $this->db->insert_id();
                
            }
            
            //----------------------------------- end of this block------------------------------------- //
           
            
            //------------------ checking old patient vs new patient-------------------- // 
            
            
            $todayDate = date('Y-m-d');
            
            $this->db->select('ID');
            $this->db->from('hbooking');
            $this->db->where('specialist_user_id' , $doc_id);
            $this->db->where('procedure_id' , $pr_name_id);
            $this->db->where('booking_date <' , $todayDate);
            $foundRc = $this->db->get()->row();

            if(!empty($foundRc)){
                //------------- old one-------------- //
                $this->db->select('old_patient');
                $this->db->from('hspecialist_pro_appointment');
                $this->db->where('ID' , $proId);
                $olds = $this->db->get()->row();
                
                $totalold = $olds->old_patient + 1;
                $proOld = array(
                    'old_patient' => $totalold,
                    );
                
                 $this->db->where('ID' , $proId);
                 $this->db->update('hspecialist_pro_appointment',$proOld);
            }else{
                
                // --- new one -------------// 
                
                $this->db->select('new_patient');
                $this->db->from('hspecialist_pro_appointment');
                $this->db->where('ID' , $proId);
                
                $new = $this->db->get()->row();
                $totalnew = $new->new_patient + 1;
                 $pronew = array(
                    'new_patient' => $totalnew,
                    );
                
                $this->db->where('ID' , $proId);
                $this->db->update('hspecialist_pro_appointment',$pronew);
                
            }
            
            // ----------end of block --------------------------//
            
            
            
            // --- get existing data for hhomepy_today_appointment AND SAVE ---//
                  
                    $this->db->select('ID, total_appt ');
                    $this->db->from('hhomepy_today_appointment');
                    $this->db->where('user_id' , $hp_user_id);
                    $this->db->where('date' , $date);
                    $rcd = $this->db->get()->row();
                    if(!empty($rcd)){
                        $ID = $rcd->ID;
                        $totolappt = $rcd->total_appt + 1;
                        $newappt = array(
                                'total_appt' => $totolappt,
                        );

                     $this->db->where('ID' , $ID);
                     $this->db->update('hhomepy_today_appointment',$newappt);
                            
                    }else{
                        $hhomepy_today_appointment = array(
                            'user_id' => $hp_user_id,
                            'date' => $date,
                            'total_appt' => 1,
                        );
                        $this->db->insert('hhomepy_today_appointment',$hhomepy_today_appointment);
                        
                    }
               
                // ---------------------------END ---------------------------//
                
                
                
                 // --- get existing data for hspecialist_today_appointment AND SAVE ----------------//
                
                            
                    $this->db->select('ID,total_appt');
                    $this->db->from('hspecialist_today_appointment');
                    $this->db->where('user_id' , $doc_id);
                    $this->db->where('date' , $date);
                    $spt = $this->db->get()->row();
                    
                    $hstoday_appointmentID = '';
                    if(!empty($spt)){
                        
                        $hstoday_appointmentID = $spt->ID;
                        
                        $totolappt = $spt->total_appt + 1;
                        $newapptsp = array(
                                'total_appt' => $totolappt,
                        );

                     $this->db->where('ID' , $hstoday_appointmentID);
                     $this->db->update('hspecialist_today_appointment',$newapptsp);
                            
                    }else{
                        $hspecialist_today_appointment = array(
                                'user_id' => $doc_id,
                                'date' => $date,
                                'total_appt' => 1,
                        );  
                        $this->db->insert('hspecialist_today_appointment',$hspecialist_today_appointment);
                        $hstoday_appointmentID = $this->db->insert_id();
                        
                    }
                // ---------------------------END ---------------------------//
                
                
                     
            // checking data for old vs new patient in hspecialist_today_appointment and save ------------------//
     
                $todayDateforsp = date('Y-m-d');

                $this->db->select('ID');
                $this->db->from('hbooking');
                $this->db->where('specialist_user_id' , $doc_id);
                $this->db->where('procedure_id' , $pr_name_id);
                $this->db->where('booking_date <' , $todayDateforsp);
                $foundsptoday = $this->db->get()->row();

                if(!empty($foundsptoday)){
                    
                    // old one //
                    
                    $this->db->select('old_patient');
                    $this->db->from('hspecialist_today_appointment');
                    $this->db->where('ID' , $hstoday_appointmentID);
                    $olds = $this->db->get()->row();

                    $totalold = $olds->old_patient + 1;
                    $proOldTODAY = array(
                        'old_patient' => $totalold,
                        );

                     $this->db->where('ID' , $hstoday_appointmentID);
                     $this->db->update('hspecialist_today_appointment',$proOldTODAY);
                }else{
                    
                    $this->db->select('new_patient');
                    $this->db->from('hspecialist_today_appointment');
                    $this->db->where('ID' , $hstoday_appointmentID);
                    $new = $this->db->get()->row();
                    
                    $totalnew = $new->new_patient + 1;
                    
                     $pronewTODAY = array(
                        'new_patient' => $totalnew,
                        );

                    $this->db->where('ID' , $hstoday_appointmentID);
                    $this->db->update('hspecialist_today_appointment', $pronewTODAY);

                }
             
              //----------end of block ----------------//
        
            
                
            // --------- sending mail to new register user -------------- //
            
            
                    $this->email->set_mailtype("html");
        //            $email['from'] = $emailp;
                    $email['fromname'] = "HCare";
                    $email['to'] = $emailp; 
                    $email['subject'] = "Welcome to Hcare";

                    $email['message'] = '<tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:30px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200"><p>Dear '.$firstname.' </p></td>

                            </tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 6% 5px 7.5%;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>Thanks for Registering with us, Here is your following details

                            <p> 
                            Username : '.$username.'
                           </p>	
                           <p> 
                           Password : '.$pass.'
                           </p>

                            <p></p></td></tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>Best,<br> Hcare Group</p></td></tr>';


                    $isSend = hcare_email($email);
             
            
            // -----------end of send mail block----------------- //
            
            // ------------- sending mail to patient about booking --------------------- //
            
                $this->db->select('email, name');
                $this->db->from('hspecialist');
                $this->db->where('ID' , $doc_id);
                $sp = $this->db->get()->row();
                $emailSp = $sp->email ;  // for mailing purpose //
                $nameSp = $sp->name ;

                $this->db->select('procedure_name');
                $this->db->from('hmasterprocedure');
                $this->db->where('ID' , $pr_name_id);
                $pr = $this->db->get()->row();
                if(!empty($pr)){
                    $prname = $pr->procedure_name ; 
                }else{
                   $prname = ''; 
                }
            
                $this->db->select('from_price, to_price');
                $this->db->from('hprocedure');
                $this->db->where('user_id' , $doc_id);
                $spprice = $this->db->get()->row();
                $sppricefrom = $spprice->from_price ;  // for mailing purpose //
                $sppriceto = $spprice->to_price ;
            
               
                $email['fromname'] = "HCare";
                $email['to'] = $emailp; 
                $email['subject'] = "Booking with $nameSp at $date ";

                
                 $email['message'] = '<tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:30px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200"><p>Dear '.$firstname.' </p></td>

					</tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 6% 5px 7.5%;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>Thanks for making Booking with '.$nameSp.' Here is your Booking details
					<p> 
                        Procedure Name : '.$prname.'
                   </p>	
                   <p> 
                        Price : '.$sppricefrom.'-'.$sppriceto.'
                   </p>
                    <p> 
                        Date : '.$date.'
                   </p>	
                   <p> 
                        Time : '.$time_slot.'
                   </p>
					<p></p></td></tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>Best,<br> Hcare Group</p></td></tr>';

            $isSend = hcare_email($email);
            return true;
        }else{
            return false;        
                
        }
            
    }
    
    
    
}