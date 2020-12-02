<?php
class Patient_model extends CI_Model {
	
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    /* @method : add_patient
     * @params:
     * @desc: add_patient method is used adding patient details
     */
    public function add_patient(){//for patient registration
		//print_r($_POST);die();
			$usertype='patient';
			$name=$this->input->post('p_name');
			$email=$this->input->post('p_email');
			$invitecode=$this->input->post('invite_code');
			$licenseCode=$this->input->post('h_p_licence_no');
			if(isset($invitecode) && !empty($invitecode)){//if invitecode used
				$this->db->select('userid');
				$this->db->from('hpatientinvite');
				//$this->db->where('email', $email );
				$this->db->where('invitationcode', $invitecode );
    			$query = $this->db->get();
				$row = $query->row_array();
				//echo $this->db->last_query();
				//echo $query->num_rows();die();
				if ( $query->num_rows() > 0 ){
					$userData1=array('confirm_code'=>$invitecode,'status'=>'1');
					$patientData1=array('refered_by'=>$row['userid'],'status'=>'1');
				}
				else{
					$userData1=array('status'=>'-1');
					$patientData1=array('status'=>'-1');
				}
			}
			if(isset($licenseCode) && !empty($licenseCode)){
				$patientData1=array('status'=>'-1');
				$userData1=array('home_phy_licence'=>$licenseCode,'status'=>'-1');
			}
			if(empty($invitecode) && empty($licenseCode) ){return false;}
    		//$user_id=$this->session->userdata('userid');
			$userData2=array(
	             'name'=>$this->input->post('p_name'),
				 'fname'=>$this->input->post('p_name'),
				 'password'=>MD5($this->input->post('password')),
				 'email'=>$this->input->post('p_email'),
				 'usertype'=>$usertype,
            );
			$patientData2=array(
	             'username'=>$name,
				 'fname'=>$name,
	        	 'email'=> $email,
            );
			if(!empty($userData1)){$userData=array_merge($userData2,$userData1);}
			else{$userData=$userData2;}
			
			$patientData3=array_merge($patientData2,$patientData1);
			$this->db->select('*');
			$this->db->from('huser');
			$this->db->where('email', $email );
    		$query = $this->db->get();
   			if ( $query->num_rows() < 1 ){
				if($this-> db->insert('huser', $userData)){
					$userID = $this->db->insert_id();
					$patientData4=array(
						 'userid' => $userID, 
					);
					$patientData=array_merge($patientData3,$patientData4);
					if($this->db->insert('hpatient',$patientData)){
						return true;
					}
				}
			}
			else{echo "get duplicate from user table";}
        	
    }
    /* @method : get_patient
     * @params: $id
     * @desc: get_patient method is used get patient details using id
     */
    public function get_patient($id){
    	$query = $this->db->get_where('hpatient', array('userid' => $id));
        return $query->row_array();
    }
    /* @method : edit
     * @params: $id
     * @desc: edit method is used update patient details using id
     */
	public function edit($id){
        $this->db->trans_start();
        $data = array(
             'fname'=>$this->input->post('fname'),
	         'lname'=>$this->input->post('lname'),
	         'address'=>$this->input->post('address'),
	         'city'=> $this->input->post('city'),
	         'state'=> $this->input->post('state'),
	         'zip'=> $this->input->post('zip'),
	         'phone'=> $this->input->post('phone'),
	         'email'=> $this->input->post('email'),
        );
        
        $this->db->where('userid', $id);
        $this->db->update('hpatient', $data);
        $this->db->trans_complete();
    }
    public function view_details(){
    	$query = $this->db->get('hpatient');
        return $query->row_array();
    }
    /* @method : add_patient_invite
     * @params:
     * @desc: add_patient_invite method is used add patient
     */
    public function add_patient_invite($referId){
            $save = array(
                'fname'=>$this->input->post('fname'),
                'lname'=>$this->input->post('lname'),
                'email'=> $this->input->post('email'),
                'username'=>$this->input->post('username'),
                'password'=> md5($this->input->post('password')),
                'usertype'=> 'patient',
                'address'=> $this->input->post('address'),
                'city'=>  $this->input->post('city'),
                'state'=> $this->input->post('state'),
                'zip'=> $this->input->post('zip'),
            );
            $this->db->insert('huser',$save);
            $userId = $this->db->insert_id();
            /*
             *
             *  save data in patient table
             */
            $save = array(
                'userid' => $userId,
                'refered_by'=> $referId,
                'username'=>$this->input->post('username'),
                'fname'=>$this->input->post('fname'),
                'lname'=>$this->input->post('lname'),
                'email'=> $this->input->post('email'),
                'address'=> $this->input->post('address'),
                'city'=>  $this->input->post('city'),
                'state'=> $this->input->post('state'),
                'zip'=> $this->input->post('zip'),
//                'phone'=> $this->input->post('phone'),
            );
            $this->db->insert('hpatient',$save);
            return true;
    }
    /* @method : get_patient_name_id
     * @params:$id
     * @desc: get_patient_name_id method is used get patient details
     */
     public function get_patient_name_id($id){
        $this->db->select('userid');
        $this->db->select('username');
        $this->db->where('refered_by' ,$id);
        $query = $this->db->get('hpatient');
        $ress= $query->result();
        $output=array();
        $output[""]="Select Patient";
        foreach($ress as $res){
            $output[$res->userid]=$res->username;
        }
        return $output;
     }
    /* @method : get_advice_for_patient
     * @params:$id
     * @desc: get_advice_for_patient  method is used get patient advices
     */
    public function get_advice_for_patient(){
        $user_id=$this->session->userdata('userid');
        $data =  $this->db->query("SELECT DISTINCT hAd.ID, hAd.advice, hb.booking_time,hb.booking_date,hs.name FROM (happointmentadvice hAd INNER JOIN hbooking hb ON hAd.patientid = hb.patient_user_id) INNER JOIN  hspecialist hs ON hAd.doctorid = hs.userid WHERE hAd.patientid = '$user_id';");
        $rsr = $data->result_array();
        return $rsr;
    }
    /* @method : checkCode
     * @params:$code
     * @desc: checkCode  method is used to verify patient
     */
    public function checkCode($code){
        $this->db->select('*');
        $this->db->from('hpatientinvite');
        $this->db->where('invitationcode' ,$code);
        $data = $this->db->get()->row();
        return $data;
    }
    /* @method : get_patient_booking_details
     * @params:$code
     * @desc: get_patient_booking_details  method is used to fetch patient booking list
     */
    public function get_patient_booking_details(){
        $user_id=$this->session->userdata('userid');
        $data =  $this->db->query("SELECT  hb.ID, hb.specialist_user_id, hb.procedure_id, hb.booking_time,hb.booking_date,hb.homephy_id, hs.name ,hp.procedure_name FROM (hbooking hb INNER JOIN hspecialist hs ON hb.specialist_user_id = hs.userid)INNER JOIN hprocedure hp ON hb.procedure_id = hp.procedure_cat_id where hb.ID NOT IN (SELECT DISTINCT hr.booking_id AS ID FROM hreview hr INNER JOIN hbooking hb ON hr.specialist_id = hb.specialist_user_id AND hr.patient_id = hb.patient_user_id) AND hb.patient_user_id = '$user_id'" );
        $rsr = $data->result_array();
        return $rsr;
    }
    /* @method : patient_advices
     * @params:$code
     * @desc: patient_advices  method is used to save patient advice
     */
    public function patient_advices($formData){
        $user_id=$this->session->userdata('userid');
        $this->db->select('ID');
        $this->db->from('hhospital');
        $id = $this->db->get()->row();
        $hs_ID = $id->ID;
        $save = array(
            'booking_id'=>$formData['bookingID'],
            'hospital_id' => $hs_ID,
            'specialist_id'=>$formData['specialist_id'],
            'procedure_id'=>$formData['procedure_id'],
            'patient_id' => $user_id,
            'slot_date'=> $formData['slot_date'],
            'slot_time'=>$formData['slot_time'],
            'review'=>  $formData['advice'],
        );
        $this->db->insert('hreview',$save);
        return true;
    }
    public function get_dashboard_checkup()
    {
        $user_id=$this->session->userdata('userid');
        $this->db->limit(2);
        $this->db->where('patient_id' ,$user_id);
        $this->db->order_by("date", "desc");
        $query = $this->db->get('hpatientcheckup');
        $ress= $query->result();   
        return $ress;
    }
    public function get_dashboard_today_appointment()
    {
         $user_id=$this->session->userdata('userid');
		 $this->db->select('hbooking.ID, booking_date, booking_time, procedure_name, description, name, specialistpic, name');
		 $this->db->from('hbooking');
		 $this->db->join('hprocedure', 'hprocedure.ID = hbooking.procedure_id');
		 $this->db->join('hspecialist', 'hspecialist.userid = hbooking.specialist_user_id');
		 $this->db->where('hbooking.patient_user_id',$user_id);
		 $this->db->where('hbooking.status',0);
		 $this->db->where('hbooking.booking_date', date('Y-m-d'));
		 $query = $this->db->get();
        /*$query = $this->db->query('SELECT  hb.ID, hb.specialist_user_id, hb.procedure_id, hb.booking_time,hb.booking_date,hb.homephy_id, hs.name, hs.picture ,hp.procedure_name FROM (hbooking hb INNER JOIN hspecialist hs ON hb.specialist_user_id = hs.userid) INNER JOIN hprocedure hp ON hb.procedure_id = hp.id
where hb.booking_date="'.date("Y-m-d").'" and hb.patient_user_id='.$user_id);*/
        $ress= $query->result();   
      
        return $ress;
    }
	
	public function angular_specialist_patient($specialistID)
	{
		$this->db->select('*');
		$this->db->from('hspecialist');
		$this->db->join('hspecialisteducation', 'hspecialist.ID = hspecialisteducation.specialist_id','left');
		$this->db->where(array('hspecialist.userID' => $specialistID));
		$query= $this->db->get();
		$result= $query->result();
		return $result;
	} 
	public function angular_pending_review($patient_id){
		//echo $patient_id;die();
		$this->db->select('*');
		$this->db->from('hbooking');
		$this->db->join('hspecialist', 'hbooking.specialist_user_id = hspecialist.ID','left');
		//$this->db->join('hpatient', 'hbooking.id = hpatient.userid');
		$this->db->join('hprocedure', 'hbooking.procedure_id = hprocedure.ID','left');
		$this->db->join('hpatientcheckup', 'hbooking.patient_user_id = hpatientcheckup.patient_id','left');
		//$this->db->join('hprocedurecategory', 'hbooking.procedure_id = hprocedurecategory.userid');
		//$this->db->join('hreview', 'hbooking.patient_user_id = hreview.patient_id');
		$this->db->where(array('hbooking.patient_user_id' => $patient_id,'reviews'=> 0));
	    $query= $this->db->get();
		$result= $query->result();
		return $result;
	}
	
	/* @method : angular_pending_review
     * @params:$code
     * @desc: angular_pending_review  method is used to fetch patient review which review 0 in table hbooking 
     */
    public function angular_recent_review($patient_id){
		
		//$data= array('patient_user_id' => $patient_id, 'reviews'=> 0);
		$this->db->select('*');
		$this->db->from('hreview');
		$this->db->join('hspecialist', 'hreview.specialist_id = hspecialist.ID','left');
		//$this->db->join('hpatient', 'hbooking.id = hpatient.userid');
		$this->db->join('hprocedure', 'hreview.procedure_id = hprocedure.ID','left');
		//$this->db->join('hpatientcheckup', 'hbooking.patient_user_id = hpatientcheckup.patient_id');
		//$this->db->join('hprocedurecategory', 'hbooking.procedure_id = hprocedurecategory.userid');
		//$this->db->join('hreview', 'hbooking.patient_user_id = hreview.patient_id');
		
		$this->db->where(array('hreview.patient_id' => $patient_id));
		$this->db->order_by('hreview.slot_date','DESC');
	    $query= $this->db->get();
		$result= $query->result();
		return $result;
	}
    public function get_recent_appointments(){
          $searchAppt = $this->input->post('patientAppt');
         $userid=$this->session->userdata("userid");
         $procCat_id = $this->input->post('procCat');
         $procedure_name_id = $this->input->post('procedure_name_id');
         $date = $this->input->post('date');
        $query=null;
        
        if(!isset($searchAppt)){
           
          
            $query= $this->db->query("Select hb.ID, hs.name,hs.title,hs.picture,        hb.booking_date,hpr.procedure_name,hpr.description,hpr.from_price, hpr.to_price From hbooking hb inner join hpatient hp on hb.patient_user_id=hp.userid inner join hspecialist hs on hs.userid=hb.specialist_user_id inner join hprocedure hpr on hpr.ID=hb.procedure_id where hb.patient_user_id=".$userid." AND  hb.status=1");
        }
        else
        {
          
            $query= $this->db->query("Select hb.ID, hs.name,hs.title,hs.picture, hb.booking_date,hpr.procedure_name,hpr.description,hpr.from_price, hpr.to_price From hbooking hb inner join hpatient hp on hb.patient_user_id=hp.userid inner join hspecialist hs on hs.userid=hb.specialist_user_id inner join hprocedure hpr on hpr.ID=hb.procedure_id where ( hpr.ID=".$procedure_name_id." or hpr.procedure_cat_id=". $procCat_id ." or hb.booking_date='".$date."' )AND  hb.patient_user_id=".$userid." AND  hb.status=1");
        }
         
        return $query->result();
    }
	
	/* @method : fetch_today_prescription
     * @params:
     * @desc: used for fetching prescription for a patient 
     */
	 public function fetch_today_prescription(){
		 $patientuser_id = $this->session->userdata('userid');
		 $currentdate = date('Y-m-d');
		 $this->db->select('*');
		 $this->db->from('hprescriptions');
		 //$this->db->where('pdate <=' .$currentdate. ' AND expiredate >='.$currentdate);
		 $this->db->where('"'.$currentdate.'" >= pdate AND "' .$currentdate. '"<= expiredate');
		 $this->db->where('patient_user_id',$patientuser_id);
		 $query = $this->db->get();
		 if($query->num_rows() > 0){
		 	return $query->result();
		 }else{
			 return FALSE;
		 }
	
	 }
    
     /* @method : get_patient_procedure_search_details
     * @params:
     * @desc: get_patient_procedure_search_details  method is used for fetching procedure details
     */
    public function get_sp_search_details(){
        
         $user_id = $this->session->userdata('userid');
         $procedure_cat_id = $this->input->get('procedure_cat', TRUE);   
         $procedure_name_id = $this->input->get('procedure_name', TRUE);   
         $city = strtolower($this->input->get('location', TRUE));   
         $zip = strtolower($this->input->get('zip', TRUE));
         $miles = $this->input->get('km', TRUE);   
        
        //add all data to session
        $newdata = array(
            'procedure_cat_id'       => $procedure_cat_id,
            'procedure_name'     => $procedure_name_id,
            'city'    => $city,
            'zip' => $zip,
        );
        $this->session->set_userdata($newdata);
        
        $order = $this->input->get('order', TRUE);
        if(isset($order)){
            $cond = " ORDER BY hp.from_price $order , hp.to_price $order , hp.ID "; 
        }else{
            $cond = '';
        }
        
        // code for searching data according to miles
        
        
            $distance = $miles;
        
            $this->db->select('latitude');
            $this->db->select('longitude');
            $this->db->from('hspecialist');
            $this->db->where('zip', $zip);
            $query1 = $this->db->get()->row();
            if(!empty($query1)){
                $lat = $query1->latitude;
                $long = $query1->longitude;
            }else{
                $this->db->select('zip,latitude, longitude');
                $this->db->from('hspecialist');
                $this->db->where('location', $city);
                $citysearch = $this->db->get()->row();
                if(!empty($citysearch)){
                    $zipnew = $citysearch->zip;
                    $lat = $citysearch->latitude;
                    $long = $citysearch->longitude;
                }
            }
             
            if(!empty($lat) && !empty($long)){
                
                    $dist = $distance / 1.609344;
                        $sql = "SELECT distinct zip, (((acos(sin((".$lat."*pi()/180)) * sin((Latitude*pi()/180))+cos((".$lat."*pi()/180)) * cos((Latitude*pi()/180)) * cos(((".$long."-Longitude)*pi()/180))))*180/pi())*60*1.1515) AS distance FROM hspecialist HAVING distance <= $dist ORDER BY distance";
//              print_r($sql);
                        $data =  $this->db->query($sql);
                        $output = $data->result_array();
                        $newString1 = array();
                        foreach ($output as $value1){
                            $newString1[]= "'" . $value1['zip'] . "'"; ;
                        }
                        $ziptemp = implode(",", $newString1);
                
//hs.location= '$city' AND// 
                
                $data= $this->db->query("SELECT DISTINCT hp.ID,hp.MPID, hp.procedure_name , hp.description , hp.from_price , hp.to_price,  hs.name, hs.email, hs.title, hs.latitude , hs.longitude, hs.userid,  hs.picture FROM (hspecialist hs INNER JOIN hprocedure hp ON hs.userid = hp.user_id) INNER JOIN huser husr ON hs.userid = husr.ID INNER JOIN hproceduretimeslot hslot on ( hslot.procedure_id=hp.ID AND hslot.specialist_id=hp.user_id) WHERE hp.procedure_cat_id = '$procedure_cat_id' And hp.status = 1 AND hp.MPID = '$procedure_name_id' AND hs.zip IN (".$ziptemp.")  $cond ");
// print_r($this->db->last_query());
                   $rsr = $data->result_array();
                
                    if(!empty($rsr)){
                        $merge = array();
                        foreach($rsr as $rs){
                            $prid = $rs['ID'];
                            $spid = $rs['userid'];
                            
                            $data =  $this->db->query("SELECT DISTINCT hmasterstaff.staff_name ,hstf.staff_pic , hstaffcat.staff_cat_name FROM ( hprocedurestaff hmasterstaff INNER JOIN hstaff hstf ON hmasterstaff.staff_cat_id = hstf.staff_cat_id ) INNER JOIN hstaffcategory hstaffcat ON hstf.staff_cat_id = hstaffcat.ID  WHERE hmasterstaff.procedure_id = '$prid' ");
                            
                             
                            
                            $rsr1 = $data->result_array();
                            if(!empty($rsr1)){
                                foreach ($rsr1 as $value1){

                                    $newString['staff_name']= $value1['staff_name'];
                                    $newString['staff_pic']= $value1['staff_pic'];
                                    $newString['staff_cat_name']= $value1['staff_cat_name'];
                                }
                                $rs['staff_name']  = $newString['staff_name'];
                                $rs['staff_pic']  = $newString['staff_pic'];
                                $rs['staff_cat_name']  = $newString['staff_cat_name'];
                            }
                        
                            $dataRevw =  $this->db->query("SELECT DISTINCT hrvw.review , hrvw.rating , hpt.username, hpt.picture FROM ( hreview hrvw INNER JOIN hpatient hpt ON hrvw.patient_id = hpt.userid ) WHERE hrvw.specialist_id = '$spid' AND hrvw.procedure_id = '$prid' ");    
                            $rsrRw = $dataRevw->row();
                                 if(!empty($rsrRw)){
                                        $rs['review']  = $rsrRw->review;
                                        $rs['rating']  = $rsrRw->rating;
                                        $rs['username']  = $rsrRw->username;
                                        $rs['patientpicture']  = $rsrRw->picture;
                                 }
                            $merge[] = $rs;
                            
                        }
                        return $merge;
                    }
            }else{
                
                return false;   
                
            }
        
    }
  
    
	public function patient_pending_reviews()
    {
		$result = array();
        $userid = $this->session->userdata('userid');
		$this->db->select('hbooking.ID, booking_date, booking_time, procedure_name');
		$this->db->from('hbooking');
		$this->db->join('hprocedure', 'hprocedure.ID = hbooking.procedure_id');
        $this->db->where('patient_user_id', $userid);
		$this->db->where('reviews',0);
        $query = $this->db->get(); 
		
		if($query->num_rows() > 0){
			$result = $query->result();   
		}
		return $result;
    }
	
	public function submit_pending_reviews()
	{
		$bookingId = $this->input->post('bookingid');
		$updateData = array('reviews'=>1);
		$data = array('rating'=>$this->input->post('rating'),
		              'review'=>$this->input->post('comment'),
					  'booking_id'=>$this->input->post('bookingid')
					 );
		$this->db->insert('hreview',$data);
		if($this->db->insert_id() > 0){
			$this->db->where('ID',$bookingId);
			$this->db->update('hbooking',$updateData);
			if($this->db->affected_rows() > 0){
				//echo "xxxxxxxxxxxxxxxx"; die();
				return TRUE;
			}
			else{
				//echo "qqqqqqqqqqqqqqqqqqqqqqq"; die();
				return FALSE;
			}
		}
	}
	
	public function today_appointment_list($patient_id){
        $result = array();
       	$this->db->select('hbooking.ID, booking_date, booking_time, procedure_name, description, name, specialistpic, name');
		$this->db->from('hbooking');
		$this->db->join('hprocedure', 'hprocedure.ID = hbooking.procedure_id');
		$this->db->join('hspecialist', 'hspecialist.userid = hbooking.specialist_user_id');
		$this->db->where('hbooking.patient_user_id',$patient_id);
		$this->db->where('hbooking.status',0);
		$this->db->where('hbooking.booking_date', date('Y-m-d'));
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result();	
		}
		return $result;
	}
	
	public function upcoming_appointment_list($patient_id){
        $result = array();
       	$this->db->select('hbooking.ID, booking_date, booking_time, procedure_name, description, name, specialistpic');
		$this->db->from('hbooking');
		$this->db->join('hprocedure', 'hprocedure.ID = hbooking.procedure_id');
		$this->db->join('hspecialist', 'hspecialist.userid = hbooking.specialist_user_id');
		$this->db->where('patient_user_id',$patient_id);
		$this->db->where('hbooking.status',0);
		$this->db->where('hbooking.booking_date >', date('Y-m-d'));
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result();	
		}
		return $result;
	}
	
	public function past_appointment_list($patient_id)
	{
		$result = array();
		$this->db->select('hbooking.ID, booking_date, booking_time, procedure_name, description, from_price, to_price, name, specialization, rating, specialistpic');
		$this->db->from('hbooking');
		$this->db->join('hprocedure', 'hprocedure.ID = hbooking.procedure_id');
		$this->db->join('hspecialist', 'hspecialist.userid = hbooking.specialist_user_id');
		$this->db->where('patient_user_id',$patient_id);
		$this->db->where('hbooking.status',1);
		$this->db->order_by('booking_date','desc');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result();	
		}
		return $result;
	}
	
	public function cancel_booking($bookingId)
	{
		$data = array('status' => -1);
		$this->db->where('ID', $bookingId);
		$this->db->update('hbooking',$data);
		if($this->db->affected_rows() > 0){
			return TRUE;
		}else{
			return FALSE;	
		}
		
	}
	
	public function past_booking_details($data = array())
	{
		$result = array();
		$this->db->select('*');
		$this->db->from('hprescriptions');
		$this->db->where('patient_user_id', $data['patient_user_id']);
		$this->db->where('bookingid', $data['bookingid']);
		$query = $this->db->get(); 
		
		if($query->num_rows() > 0){
			$result = $query->result();	
		}
		return $result;	
	}
   
    public function appointment_list($filterDate = ''){
		if(empty($filterDate)){
			$filterDate = date('Y-m-d');
		}
		$PatientID= $this->session->userdata('user_id');
		//echo $PatientID;
		$status = 0;
		
		$this->db->select('hbooking.*');
		$this->db->from('hbooking');
		//$this->db->join('hpatient', 'hpatient.userid = hbooking.patient_user_id');
		$this->db->where('hbooking.patient_user_id', $PatientID);	
		$this->db->where('hbooking.booking_date', $filterDate);
		$this->db->where('hbooking.status', $status);
		$this->db->order_by('hbooking.ID','desc');
		$this->db->limit('1');
		$query = $this->db->get(); 
	
		if($query->num_rows() > 0){
			$appointment = $query->row(); 
			return $appointment;
		}
    }
    
//    public function check_booking_exist($frmdata){
//        $prid = $frmdata['pr_id'];
//        $docid = $frmdata['doc_id'];   
//        $time_slot = $frmdata['time_slot'];
//        $date = $frmdata['date'];
//        
//        $this->db->select('ID');
//		$this->db->from('hbooking');
//		$this->db->where('specialist_user_id', $docid);
//		$this->db->where('procedure_id',$prid);
//        $this->db->where('booking_date', $date);
//		$this->db->where('booking_time', $time_slot);
//		$query = $this->db->get(); 
//		if($query->num_rows() > 0){
//			return true;
//		}else{
//            return false;	
//        }
//        
//    }
//    
    public function medicalHistory($bookingID = '')
	{   $date=date('Y-m-d');
		//$bookingID = $this->input->post('bookingID');
        $user_id = $this->session->userdata('user_id');
       // $patientID = $this->input->post('patientID');
		$this->db->select('*');
        $this->db->from('hpatienthistory');
		$this->db->where('hpatienthistory.booking_id', $bookingID);
		$this->db->where('hpatienthistory.patient_id', $user_id);
		//$this->db->where('hpatienthistory.user_id', $user_id);
		$this->db->where('hpatienthistory.date', $date);
		$this->db->order_by("hpatienthistory.ID","desc");
		$medicalHistory = $this->db->get()->result();
		return $medicalHistory;
		}
    public function addMedicalHistory($data)
	{    
		$this->db->insert('hpatienthistory',$data);
		$userID = $this->db->insert_id();
        return $userID;
		} 
	 public function selectMedicalHistorybyLastID($id)
		{
		$this->db->select('*');
        $this->db->from('hpatienthistory');
		$this->db->where('hpatienthistory.ID', $id);
		$medicalHistoryLastResult = $this->db->get()->row();
		//print_r($medicalHistory);
		return $medicalHistoryLastResult;
	}	
    
}
