<?php

class Home_physician_model extends CI_Model {

    public function __construct(){

        parent::__construct();

        $this->load->database();

    }

	

	/* @method : homePhysian_totalpatient

	* @params:

	* @desc: homePhysian_totalpatient method is used for fetch homePhyscian total patient 

	*/

	public function homePhysian_totalpatient(){ 

      	$this->db->select('*');

        $this->db->from('hpatientinvite');

		//$this->db->where('status',0);

		$query = $this->db->get();

		if($query->num_rows() > 0){

			return $query->result();

		}

        

	}

	

	/* @method : homePhysian_totalpatientfortoday

	* @params:

	* @desc: homePhysian_totalpatientfortoday method is used for fetch homePhyscian total patient for today

	*/

	public function homePhysian_totalpatientfortoday(){

		$userid = $this->session->userdata('userid');

		$date = date('Y-m-d'); 

		$this->db->select('*');

		$this->db->from('hhomepy_today_appointment');

		$this->db->where('date',$date);

		$this->db->where('user_id',$userid);

		$query = $this->db->get(); 

		

		if($query->num_rows() > 0){

			return  $query->result();

	    }

	} 

	

	/* @method : physicianappointment_details

     * @params:

     * @desc: physicianappointment_details method is used for fetching physician specialist details

     */

	public function physicianappointment_details($bookingid = '')

	{

		$this->db->select('hspecialist.name, hspecialist.picture as specpic, hspecialist.rating, hprocedure.procedure_name, hprocedure.from_price, 

						  hprocedure.to_price, hspecialist.desc as description, hprocedurecategory.category_name, hpatient.*');

		$this->db->from('hbooking');

		$this->db->join('hspecialist','hspecialist.userid = hbooking.specialist_user_id');

		$this->db->join('hhomephysician','hhomephysician.userid = hbooking.homephy_id');

		$this->db->join('hprocedure','hprocedure.ID = hbooking.procedure_id');

		$this->db->join('hprocedurecategory','hprocedurecategory.ID = hprocedure.procedure_cat_id');

		$this->db->join('hpatient','hpatient.userid = hbooking.patient_user_id');

		$this->db->where('hbooking.ID', $bookingid);

		$query = $this->db->get(); 

		if($query->num_rows() > 0){

			$appointmentdetails = $query->result(); 

			return $appointmentdetails;

		}

	}

	

	public function getPatientByCurrentDate(){

		$userid = $this->session->userdata('userid');

        $date = date('Y-m-d');

        $time = date('H:i:s');

        $timestamp = $time + 60*60;

        $time = date('H:i:s', $timestamp);

        $this->db->select('hbooking.ID as bID,hbooking.*,hpatient.*');

        $this->db->from('hbooking');

        $this->db->join('hpatient', 'hpatient.userid = hbooking.patient_user_id','left');

        $this->db->where('hbooking.booking_date',$date); 

        $this->db->where('hbooking.booking_time >=', $time);

        $this->db->where('hbooking.homephy_id', $userid);

		

        $res =$this->db->get();
        #echo $this->db->last_query();exit;

		if($res->num_rows() > 0){

			return  $res->result();

	    }

	}

	

	/* @method : booking_details

     * @params:

     * @desc: booking_details method is used for fetching particular booking details

     */

	 

	public function booking_details($bookingid = '')

	{

		$this->db->select('hpatient.fname, hpatient.lname, hpatient.email, hbooking.booking_date, hbooking.booking_time');

		$this->db->from('hbooking');

		$this->db->join('hpatient','hpatient.userid = hbooking.patient_user_id');

		$this->db->where('hbooking.ID', $bookingid);

		$query = $this->db->get(); 

		if($query->num_rows() > 0){

			$bookingdetails = $query->result(); 

			return $bookingdetails;

		}

	}

	

	/* @method : cancel_booking

     * @params:

     * @desc: cancel_booking method is used to cancel particular booking details

     */

	 

	public function cancel_booking($bookingid = '')

	{

		$this->db->where('ID', $bookingid);

        $this->db->update('hbooking', array('status'=>'-1'));

		if($this->db->affected_rows() > 0){

			return TRUE;

		}else{

			return FALSE;

		}

	}

	

	

	 /* @method : get_patient_details

     * @params:

     * @desc: get_patient_details method is used for fetching patient details by using hphysican_id

     */

	/*public function get_patient_details($userid){

	    $this->db->select('*');

		$this->db->from('hbooking');

		$this->db->join('hspecialist', 'hbooking.specialist_user_id = hspecialist.ID','left');

		$this->db->join('hpatient', 'hbooking.patient_user_id = hpatient.userid','left');

		$this->db->join('hprocedure', 'hbooking.procedure_id = hprocedure.ID','left');

	    $this->db->join('hpatientcheckup', 'hbooking.ID = hpatientcheckup.patient_id','left');

		$this->db->join('hprocedurecategory', 'hbooking.procedure_id = hprocedurecategory.ID','left');

		$this->db->where(array('hbooking.homephy_id' => $userid));

	    $query= $this->db->get(); 

		$result= $query->result();

		return $result;

	}*/

	public function get_patient_details($userid){

		

		$queries = $this->db->query('SELECT * FROM hpatient WHERE refered_by = "'.$userid.'"');

		$patient=array();

		$i=0; $j=0;

		foreach($queries->result() as $query)

		{   

			$result['username']= $query->username;
            $result['patient_user_id']= $query->userid;

			$result['patientPic']= $query->picture;

            $date = date('Y-m-d');
            $time = date('H:i:s');
            $timestamp = $time + 60*60;
            $time = date('H:i:s', $timestamp);
            $this->db->select('hbooking.ID as bID,hbooking.*,hpatient.*');
            $this->db->from('hbooking');
            $this->db->join('hpatient', 'hpatient.userid = hbooking.patient_user_id','left');
            $this->db->where('hbooking.patient_user_id', $query->userid); 
            $this->db->where('hbooking.booking_date', $date); 
            $this->db->where('hbooking.booking_time >=', $time);
            $this->db->where('hbooking.homephy_id', $userid);
            $hBookquery = $this->db->get();
            $hBookresult = $hBookquery->result();
            $result['hBookresult'] = !empty($hBookresult[0]) ? $hBookresult[0] : '';

			$queries1 = $this->db->query('SELECT * FROM hbooking WHERE hbooking.patient_user_id = '.$query->userid);

			foreach($queries1->result() as $query1)

			{ 

				if($query1->status == '0' || $query1->status == '-1' )

			{$statusvalue0[$i++] = $query1->status;  }

			if($query1->status == '1')

			{$statusvalue1[$j++]=$query1->status; }

			$specialist = $query1->specialist_user_id;

			$procedureID = $query1->procedure_id;

			}

			//echo $procedureID ;

			$i = 0; $j=0;

			$result['cancle']=count($statusvalue0);

			$result['total']=count($statusvalue0) + count($statusvalue1);

			$queries2 = $this->db->query('SELECT * FROM hspecialist WHERE hspecialist.ID = '.$specialist);

			$result['specialist'] = $queries2->row();

			$queries3 = $this->db->query('SELECT * FROM hpatientcheckup WHERE hpatientcheckup.patient_id = '.$query->userid .' AND hpatientcheckup.date = (SELECT MAX(date) FROM hpatientcheckup where hpatientcheckup.patient_id = '.$query->userid .') ORDER  BY hpatientcheckup.ID DESC LIMIT 1');

			$result['checkup'] = $queries3 ->row();

			$queries4 = $this->db->query('SELECT * FROM hprocedure WHERE hprocedure.ID = '.$procedureID );

			//echo ($queries4 ->row()->procedure_cat_id);

			$result['procedure'] = $queries4 ->row();

			$queries5 = $this->db->query('SELECT * FROM hprocedurecategory WHERE hprocedurecategory.ID = '.$queries4 ->row()->procedure_cat_id );

			$result['procedurecategory'] = $queries5 ->row();

			$patient[$query->userid]=$result;

			$result=array();

			$statusvalue0=array();

			$statusvalue1 = array();

	  }  

			return $patient;

			//print_r($patient);

			//die();

		

	}

	

	

	public function get_patient_review($userid,$patientid){

		$this->db->select('hreview.rating as reviewRating, hreview.*, hspecialist.*, hprocedure.*');

		$this->db->from('hreview');

		$this->db->join('hspecialist', 'hreview.specialist_id = hspecialist.ID');

		$this->db->join('hprocedure', 'hreview.procedure_id = hprocedure.ID');

		$this->db->where(array('patient_id' => $patientid));

        $this->db->order_by('hreview.ID', 'DESC');

        $this->db->limit(1);

	    $query= $this->db->get();
        
		$result= $query->result();

		return $result;

	}	

	

	/* @method : add_home_physican

     * @params:

     * @desc: add_physican method is used for adding homePhyscian details

     */

	 public function add_home_physican($data){

		 

		  $this->db->insert('huser', $data);

		  $lastinsertedid= $this->db->insert_id();

		  $homephysicandata= array(

									'userid' => $lastinsertedid,

									'name' => $data['name'],

									);

		  $this->db->insert('hhomephysician', $homephysicandata);

		  $hhomephysiciandocumentdata= array(

											'home_phy_userid' => $lastinsertedid,

											);

		  return $this->db->insert(' hhomephysiciandocument', $hhomephysiciandocumentdata);

		 

		 

		 }

	 

    /* @method : add_physican

     * @params:

     * @desc: add_physican method is used for adding homePhyscian details

     */

    public function add_physican(){

        $data=array(

            'name'=> $this->input->post('name'),

            'password'=> MD5($this->input->post('password')),

            'email'=>  $this->input->post('email'),

            'address' => $this->input->post('address'),

            'city'=>  $this->input->post('city'),

            'state' =>  $this->input->post('state'),

            'zip'=>  $this->input->post('zip'),

            'usertype' => 'homephysican',

        );

        $this->db->insert('huser',$data);

        $user_id = $this->db->insert_id();

        $query = $this->db->get_where('huser', array('ID' => $user_id));

        $list = $query->row();

        $encode = json_encode($_POST['language']);

        	$data=array(

                'userid' => $user_id,

                'name' => $list->name,

                'email' => $list->email,

                'desc'=>$this->input->post('desc'),

                'licence_no'=>$this->input->post('licence_no'),

                'licence_city'=>$this->input->post('licence_city'),

                'licence_state'=>$this->input->post('licence_state'),

                'dob'=> $this->input->post('dob'),

                'gender' => $this->input->post('gender'),

                'see_children' => $this->input->post('see_children'),

                'language' => $encode,

                 'address'=>$this->input->post('address'),

                 'city'=> $this->input->post('city'),

                 'state'=> $this->input->post('state'),

                 'zip'=> $this->input->post('zip'),

                 'phone'=> $this->input->post('phone'),

            );

        	$this->db->insert('hhomephysician',$data);

            return true;

    }

    /* @method : get_physican

     * @params: $id

     * @desc: get_physican method is used for fetching physican details by id

     */

    public function get_physican($id){

    	$query = $this->db->get_where('hhomephysician', array('userid' => $id)); 

        return $query->row_array();

    }

    /* @method : edit

     * @params: $id

     * @desc: edit method is used for update physican details by userid

     */

	public function edit($id){

        $this->db->trans_start();

        $data = array(

             'name'=>$this->input->post('name'),

	         'desc'=>$this->input->post('desc'),

	         'licence_no'=>$this->input->post('licence_no'),

	         'dob'=>$this->input->post('dob'),

	         'address'=>$this->input->post('address'),

	         'city'=> $this->input->post('city'),

	         'state'=> $this->input->post('state'),

	         'zip'=> $this->input->post('zip'),

	         'phone'=> $this->input->post('phone'),

	         'email'=> $this->input->post('email'),

        );

        $this->db->where('userid', $id);

        $this->db->update('hhomephysician', $data); 

		$response = $this->db->affected_rows();

        $this->db->trans_complete();

    }

    /* @method : view_details

     * @params:

     * @desc: view_details method is used for viewing physican details

     */

    public function view_details(){

    	$query = $this->db->get('hhomephysician');

        return $query->row_array();

    }

    /* @method : patient_invite

     * @params:

     * @desc: patient_invite method is used for homephysician send invitation to patient

     */

    function patient_invite(){

        $user_id=$this->session->userdata('user_id');

        $str=$this->generateRandominvitecode();

        $date= date('y-m-d');

        $expirydate= date('Y-m-d', strtotime("+48 hours"));

        $data=array(

            'userid' => $user_id,

            'patientfname'=>$this->input->post('patientfname'),

            'patientlname'=>$this->input->post('patientlname'),

            'email'=>$this->input->post('email'),

            'invitationcode'=>$str,

            'issuedate'=>$date,

            'expirydate'=>$expirydate,

        );

        if($this->db->insert('hpatientinvite',$data)){

            return true;

        }

    }

    /* @method : generateRandominvitecode

     * @params:

     * @desc: generateRandominvitecode method is used for homephysician generate invitation code

     */

    function generateRandominvitecode($length = 15) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {

            $randomString .= $characters[rand(0, $charactersLength - 1)];

        }

        return $randomString;

    }

    /* @method : add_medical_history

     * @params:

     * @desc: add_medical_history method is used for adding medical history

     */

    function add_medical_history($id){

        $historyType = $this->input->post('history_type');

        $historytitle = $this->input->post('historytitle');

        $desc = $this->input->post('desc');

        $insert_id = array();

        for ($i = 0; $i < count($historyType); $i++) {

            $data=array(

                'patientid'=> $id,

                'history_type'=> $historyType[$i],

                'historytitle'=> $historytitle[$i],

                'desc'=> $desc[$i],

            );

            $this->db->insert('hpatienthistory',$data);

            $insert_id[] = $this->db->insert_id();

        }

        $config['upload_path']    = './assets/historyfiles/';                 #the folder placed in the root of project

        $config['allowed_types']  = 'gif|jpg|png|bmp|jpeg';      #allowed types description

        $config["allowed_types"] ="*";

        $config['max_size'] = '5000';                          #max size

        $config['max_width'] = '5000';                          #max width

        $config['max_height'] = '5000';                          #max height

        $config['encrypt_name'] = true;

        $attachName =  'history_files';

        $files = $_FILES;

        $fls = array_filter($_FILES[$attachName]['name']);

        for ($i = 0; $i < count($fls); $i++) {

            if(!empty($_FILES['history_files']['name'][$i])){

                $_FILES[$attachName]['name'] = $files[$attachName]['name'][$i];

                $_FILES[$attachName]['type'] = $files[$attachName]['type'][$i];

                $_FILES[$attachName]['tmp_name'] = $files[$attachName]['tmp_name'][$i];

                $_FILES[$attachName]['error'] = $files[$attachName]['error'][$i];

                $_FILES[$attachName]['size'] = $files[$attachName]['size'][$i];

                $type = strstr($_FILES[$attachName]['name'], '.' );

                $fileNamehs =  md5(uniqid(mt_rand())).''.$type;

                $config['file_name'] = $fileNamehs;

                $this->load->library('upload', $config);

                $this->upload->initialize($config);

                if(!$this->upload->do_upload('history_files')){

                    $error = array('error' => $this->upload->display_errors());

                }else{

                    $success = $this->upload->data();

                }

                $imageUrl = base_url().'assets/historyfiles/'.$success['file_name'];

                $data=array(

                    'patientid'=> $id ,

                     'patient_history_id' =>$insert_id[$i],

                    'history_files'=> $imageUrl,

                );

                $this->db->insert('hpatienthistoryfiles',$data);

            }

        }

    }

    /* @method : get_patient_detail

     * @params:

     * @desc: get_patient_detail method is used for fetching patient details

     */

    function get_patient_detail($id){

        $this->db->select('*');

        $this->db->from('hpatient');

        $this->db->where('ID' , $id);

        return $this->db->get()->row();

    }

    /* @method : get_licence_state

     * @params:

     * @desc: get_licence_state method is used for fetching state

     */

    public function get_licence_state_city_lcno(){

        $user_id=$this->session->userdata('user_id');

        $this->db->select('licence_state');

        $this->db->select('licence_city');

        $this->db->select('licence_no');

        $this->db->select('licence_status');

        $this->db->from('hhomephysician');

        $this->db->where('userid' , $user_id);

        $res = $this->db->get()->row();

        return $res;

    }

    /* @method : save_notification_specialist

     * @params:

     * @desc: save_notification_specialist method is used for saving notification for specialist

     */

    public function save_notification_specialist(){

        $user_id=$this->session->userdata('user_id');

        $ntf = $this->input->post('notification');

        $data = array(

            'userid' => $user_id,

            'notification' => $ntf,

        );

        $this->db->insert('husersetting', $data);

        return true;

    }

    /* @method : save_licence_detail

     * @params:

     * @desc: save_licence_detail method is used for saving licence detail for specialist

     */

    public function save_licence_detail(){

        $user_id = $this->session->userdata('user_id');

        $lno = $this->input->post('licence_no');

        $lState = $this->input->post('licence_city');

        $lCity = $this->input->post('licence_state');

        $data = array(

            'userid' => $user_id,

            'licence_no' => $lno,

            'licence_city' => $lState,

            'licence_state' => $lCity,

        );

        $this->db->where('userid' , $user_id);

        $this->db->update('hhomephysician', $data);

        return true;

    }

    /* @method : save_recommendation

     * @params:

     * @desc: save_recommendation method is used for save recommended procedure

     */

    public function save_recommendation(){

        $homePhy_id = $this->session->userdata('user_id');

        $recommend = $this->input->post('recommend');

        $patient_id = $this->input->post('patient_id');

        $procedure_id = $this->input->post('procedure_id');

        $user_id = $this->input->post('user_id');

        $config['upload_path']    = './assets/homePhysicanDocuments/';

        $config['allowed_types']  = 'gif|jpg|png|bmp|jpeg';

        $config["allowed_types"] ="*";

        $config['max_size']       = '11100';                          #max size

        $config['max_width']      = '12000';                          #max width

        $config['max_height']     = '3300';                          #max height

        $config['encrypt_name']   = true;

        $files = $_FILES;

        if(isset($_FILES['document_files']['name'])){

            $attachName = 'document_files';

            if(!empty($_FILES['document_files']['name'])){

                $count = count($_FILES[$attachName]['name']);

                for ($i = 0; $i < $count; $i++) {

                    $_FILES[$attachName]['name'] = $files[$attachName]['name'][$i];

                    $_FILES[$attachName]['type'] = $files[$attachName]['type'][$i];

                    $_FILES[$attachName]['tmp_name'] = $files[$attachName]['tmp_name'][$i];

                    $_FILES[$attachName]['error'] = $files[$attachName]['error'][$i];

                    $_FILES[$attachName]['size'] = $files[$attachName]['size'][$i];

                    $type = strstr($_FILES[$attachName]['name'], '.' );

                    $fileNamehs =  md5(uniqid(mt_rand())).''.$type;

                    $images[] = $fileNamehs;

                    $config['file_name'] = $fileNamehs;

                    $this->load->library('upload', $config);

                    $this->upload->initialize($config);

                    $success = '';

                    if(!$this->upload->do_upload('document_files')){

                        $error = array('error' => $this->upload->display_errors());

                    }else{

                        $success = $this->upload->data();

                    }

                    if(!empty($success['file_name'])){

                        $imageUrl = base_url().'assets/homePhysicanDocuments/'.$success['file_name'];

                    }else{

                        $imageUrl = '';

                    }

                    $file_data = array(

                        'home_phy_userid' => $homePhy_id,

                        'patient_user_id' => $patient_id,

                        'procedure_cat_id' => $recommend,

                        'document_url' => $imageUrl,

                    );

                    $this->db->insert('hhomephysiciandocument', $file_data);

                }

            }

        }

        for($i = 0 ; $i<count($procedure_id); $i++){

            $data = array(

                'patient_user_id' => $patient_id,

                'homephy_user_id' => $homePhy_id,

                'procedure_cat_id' => $recommend,

                'procedure_id' => $procedure_id[$i],

                'specialist_user_id' => $user_id[$i],

            );

            $this->db->insert('hrecommendedprocedure',$data);

        }

        return true;

    }

    /* @method : remove_recommend_procedure

     * @params:

     * @desc: remove_recommend_procedure method is used for remove recommended procedure

     */

    public function remove_recommend_procedure($prID, $spID){

        $this->db->select('procedure_cat_id');

        $this->db->select('specialist_user_id');

        $this->db->from('hrecommendedprocedure');

        $this->db->where('procedure_cat_id',$prID);

        $this->db->where('specialist_user_id',$spID);

        $res =$this->db->get()->result_array();

        if(!empty($res)){

            $result = $this->db->delete('hrecommendedprocedure', array('procedure_cat_id' => $prID,"	specialist_user_id"=>$spID));

            return $result;

        }else{

            return false;

        }

    }

    /* @method : check_already_recommend_specialist

     * @params:

     * @desc: check_already_recommend_specialist method is used for fetching procedure details

     */

    public function check_already_recommend_procedure($data){

        $query = $this->db->query("SELECT hrc.procedure_cat_id,hrc.specialist_user_id FROM hrecommendedprocedure hrc WHERE hrc.procedure_cat_id = '$data' ");

        $res= $query->result_array();

        return $res;

    }

	

	/* @method : appointment_list

     * @params:

     * @desc: appointment_list method is used for fetching patient list

     */

    public function appointment_list($filterDate = ''){

		if(empty($filterDate)){

			$filterDate = date('Y-m-d');

		}

		$physicianID = $this->session->userdata('userid');

		$status = 0;

		

		$this->db->select('hpatient.fname, hpatient.lname, hpatient.picture, hbooking.*');

		$this->db->from('hbooking');

		$this->db->join('hpatient', 'hpatient.userid = hbooking.patient_user_id');

		$this->db->where('hbooking.homephy_id', $physicianID);	

		$this->db->where('hbooking.booking_date', $filterDate);

		$this->db->where('hbooking.status', $status);

		$this->db->order_by('hbooking.booking_time');

		$query = $this->db->get(); 

	

		if($query->num_rows() > 0){

			$appointment = $query->result(); 

			return $appointment;

		}

    }

    public function invitation_list(){

        $this->db->order_by('issuedate', 'desc');

        $result = $this->db->get('hpatientinvite')->result_array(); 

        if(!empty($result)){

            return $result;

        }else{

            return false;

        }

    }

  public function sendInvitationInsert(){

        $patientfname = $this->input->post('pname');

         $email = $this->input->post('pemail');

        if(!empty($patientfname) && !empty($email)){

                $username = $this->session->userdata('username');

                $data['patientfname'] = $this->input->post('pname');

                $data['email'] = $this->input->post('pemail');

                $data['userid'] =$this->session->userdata('userid');

                /*$pnameArr=explode(" ", $pname);

                $pfname=$pname[0];

                $plname=$pname[0];*/

                $time=time();

                $data['invitationcode'] = md5("hcare".$time.$username);

                $data['issuedate'] = date('Y-m-d');

                $data['issuetime'] = $time;

                $data['expirydate'] = date('Y-m-d', strtotime('+1 month', strtotime($data['issuedate'])));

                $data['status'] = 0;

                $this->db->insert('hpatientinvite', $data);

                if($this->db->insert_id() > 0){

                    return $this->db->insert_id();

                }else{

                    return FALSE;   

                }

            }

        }

      

	/* @method : physician_details

	* @params: $id

	* @desc: physician_details method is used for fetching physican details by id

	*/

    public function physician_details($id){

    	$query = $this->db->get_where('huser', array('ID' => $id)); 

        return $query->row_array();

       }

	

	public function invitation_code($email)

	   {

		$this->db->select('patientfname,invitationcode');

		$this->db->from('hpatientinvite');

		$this->db->where('email', $email);

		$getQuery = $this->db->get();

		return $getQuery->row();

		}

	public function check_invition($email)

	{

		$this->db->select('*');

		$this->db->from('hpatientinvite');

		$this->db->where('email', $email);

		$getQuery = $this->db->get();

		if($getQuery->num_rows() > 0)

		{return $getQuery->row();}

		else

		{return false;}

		}

	public function getInvitionLastInsertDetails($id)

	{

		$this->db->select('*');

		$this->db->from('hpatientinvite');

		$this->db->where('ID', $id);

		$getQuery = $this->db->get();

		if($getQuery->num_rows() > 0)

		{return $getQuery->row();}

		else

		{return false;}

		}

    

    

    public function get_hp_email($email) {

		$this->db->select('ID, userid');

		$this->db->from('hhomephysician');

		$this->db->where('email', $email);

		$getQuery = $this->db->get();

		return $getQuery->row();

    }

    

    public function get_recommend_patient($mpid, $dcID){

        

        $physicianID = $this->session->userdata('userid');

        

        $this->db->select('ID, patient_id');

		$this->db->from('hrecommendedprocedure');

		$this->db->where('homephy_id', $physicianID);

        $this->db->where('mp_id', $mpid);

        $this->db->where('specialist_id', $dcID);

		$getQueryData = $this->db->get()->result_array();

        

       

        

        $referdArray = array();

        $idsarray = array();

        $rcm =array();

        if(!empty($getQueryData)){

            foreach($getQueryData as $val){

                

                $this->db->select('username, picture');

		        $this->db->from('hpatient');

                $this->db->where('userid', $val['patient_id']);

                $patData = $this->db->get()->result_array();

                

                $rcm['rc'][] = $patData;

                $idsarray['Ids'][][] = $val['ID'];

            }

            // get home phy patient for recommedation //    

            

            $this->db->select('userid , username as patient_name');

            $this->db->from('hpatient');

            $this->db->where('refered_by', $physicianID);

            $refdData = $this->db->get()->result_array();

            $referdArray['refered_patient'] =  $refdData;

           

            $newdata = array_merge($rcm, $referdArray, $idsarray);

//            print_r($newdata);

             return $newdata;

            

        }else{

            return false; 

        }

        

    }

    

    

    public function save_recommended_patient($postData){

        

            $physicianID = $this->session->userdata('userid');

            $pt_id = $postData['patient_name'];

            $mpid = $postData['MPid'];

            $docid = $postData['docid'];

                

            // get procedure cat id //

             

            $this->db->select('procedure_cat_id');

            $this->db->from('hmasterprocedure');

            $this->db->where('ID', $mpid);

            $catId = $this->db->get()->row();

            

            if(!empty($catId)){

                $catids = $catId->procedure_cat_id;

            }else{

                $catids = '';             

            }

            

            $this->db->select('ID');

            $this->db->from('hrecommendedprocedure');

            $this->db->where('patient_id', $pt_id);

        

            $exist = $this->db->get()->row();

            if(empty($exist)){

               $data = array(

                'patient_id' => $pt_id,

                'homephy_id' => $physicianID,

                'procedure_cat_id' => $catids,

                'mp_id' => $mpid,

                'specialist_id' => $docid

            );

             $this->db->insert(' hrecommendedprocedure', $data);

             return true;    

                

            }else{

                return false;   

            }

        

    }

     public function delete_recommend_patient($id){

        $result = $this->db->delete('hrecommendedprocedure', array('ID' => $id));

        return $result;

     }

    

    

     public function get_home_phy_patient(){

         

            $physicianID = $this->session->userdata('userid');

//            print_r($physicianID);exit;

            $this->db->select('userid , username');

            $this->db->from('hpatient');

            $this->db->where('refered_by', $physicianID);

            $refdData = $this->db->get()->result_array();

            return $refdData;

     }

    

    

    

    

     

    /* @method : save_booking_details

     * @params:

     * @desc: save_booking_details method is used for saving booking data

     */

        public function save_booking_details(){

                

                //$phyid 

             

                $home_phyid = $this->session->userdata('userid'); // logged in home phy id

            

//                print_R($home_phyid);



                $time_slot = $this->input->post('time_slot');

                $doc_id = $this->input->post('doc_id');

                $pr_id = $this->input->post('pr_id');

                $date = $this->input->post('date');

                $home_phy_id = $this->input->post('home_phy_id');

                $pat_user_id = $this->input->post('patien_name_id');  // selected patient id 

                $patient_desc = $this->input->post('patient_desc');

            

            

            // -------- check if already exist booking for patient --------------///

            

                $bookingFoundPrc = 0;

            

                $this->db->select('ID');

                $this->db->from('hbooking');

                $this->db->where('specialist_user_id', $doc_id);

                $this->db->where('procedure_id', $pr_id);

                $this->db->where('booking_date', $date);

                $this->db->where('booking_time', $time_slot);



                $queryBooking = $this->db->get();

            

                if($queryBooking->num_rows() > 0){

                    $bookingFoundPrc = 1;

                }



                if($bookingFoundPrc != 1){



                    // get procedure_slot_id //

                    $this->db->select('ID, seats ');

                    $this->db->from('hproceduretimeslot');

                    $this->db->where('specialist_id' , $doc_id);

                    $this->db->where('procedure_id' , $pr_id);

                    $this->db->where('slot' , $time_slot);

                    $pr_slot_data = $this->db->get()->row();





                    $data = array(

                        'specialist_user_id' => $doc_id,

                        'procedure_id' => $pr_id,

                        'procedure_slot_id' => $pr_slot_data->ID,

                        'booking_date' => $date,

                        'booking_time' => $time_slot,

                        'patient_user_id' => $pat_user_id,

                        'homephy_id' => $home_phyid,

                        'patient_desc' => $patient_desc

                    );

                    $this->db->insert('hbooking',$data);



                     //----------- check slot avaialable ---------------- //

                    $this->db->select('no_of_booked_appt');

                    $this->db->from('hproceduredate');

                    $this->db->where('doctorid' , $doc_id);

                    $this->db->where('procedureid' , $pr_id);

                    $this->db->where('time_slot' , $time_slot);

                    $aval_slot_data = $this->db->get()->row();



                    if(empty($aval_slot_data)){

                        $no_of_booked_appt = 1;

                        $hbooking = array(

                            'doctorid' => $doc_id,

                            'procedureid' => $pr_id,

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

                            'procedureid' => $pr_id,

                            'date' => $date,

                            'time_slot' => $time_slot,

                            'no_of_appt' => $pr_slot_data->seats,

                            'no_of_booked_appt' => $no_of_booked_appt,



                        );

                        $this->db->insert('hproceduredate',$data1);

                    }



                 //------------------ checking old patient vs new patient-------------------- // 

                // hspecialist_pro_appointment ----------//

                

                    $this->db->select('ID, total_appt');

                    $this->db->from('hspecialist_pro_appointment');

                    $this->db->where('userid' , $doc_id);

                    $this->db->where('procedure_id' , $pr_id);

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

                            'procedure_id' => $pr_id,

                            'date' => $date,

                            'total_appt' => 1,

                            );

                        $this->db->insert('hspecialist_pro_appointment',$proaddnew);

                        $proId = $this->db->insert_id();



                    } 



                 // ---------check data for old vs new patien and save start here  ---------------------//   

            

                    $todayDate = date('Y-m-d');



                    $this->db->select('ID');

                    $this->db->from('hbooking');

                    $this->db->where('specialist_user_id' , $doc_id);

                    $this->db->where('procedure_id' , $pr_id);

                    $this->db->where('booking_date <' , $todayDate);

                    $foundRc = $this->db->get()->row();



                    if(!empty($foundRc)){

                        // old one //

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

                    $this->db->where('user_id' , $home_phyid);

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

                            'user_id' => $home_phyid,

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

                $this->db->where('procedure_id' , $pr_id);

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

                     // new one //

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

                  return true;

                // ------------------------end of block ------------------------------------------------------------------// 

              

            } else{

                    

                 // booking found //

                    

                return false;   

            }

    }

    

    

        public function get_patient_name_pic($id){

            $this->db->select('username, picture');

            $this->db->from('hpatient');

            $this->db->where('userid' , $id);

            $otput = $this->db->get()->row();

            return $otput;

        

    }

	public function medicalHistory()

	{   $date=date('Y-m-d');

		$bookingID = $this->input->post('bookingid');

        $user_id = $this->session->userdata('user_id');

        $patientID = $this->input->post('patientid');

		$this->db->select('*');

        $this->db->from('hpatienthistory');

		$this->db->where('hpatienthistory.booking_id', $bookingID);

		$this->db->where('hpatienthistory.patient_id', $patientID);

		$this->db->where('hpatienthistory.user_id', $user_id);

		$this->db->where('hpatienthistory.date', $date);

		$this->db->order_by("hpatienthistory.ID","desc");

		$medicalHistory = $this->db->get()->result();

		//print_r($medicalHistory);

		return $medicalHistory;

	}

	

	public function homephysicianreport($data = array()){

		$result = array();

        $this->db->select('*');

		$this->db->from('hhomepy_today_appointment');

		$this->db->where('hhomepy_today_appointment.user_id', $data['userid']);

		if($data['tag'] == 'report'){

			$this->db->where(array('date >='=>$data['fromdate'], 'date<='=>$data['todate']));

		}
        else if($data['tag'] == 'dashboard'){
            $todate = date("Y-m-d");
            $fromdate = date("Y-m-d", strtotime("+6 days ago"));
            
            $this->db->where(array('date >='=>$fromdate, 'date<='=>$todate));

        }

		$query = $this->db->get(); 
        
		if($query->num_rows() > 0){

			$result = $query->result();

		}

		

		return $result;

	}

}