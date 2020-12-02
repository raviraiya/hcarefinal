<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homephysician extends H_Controller  {

	public function __construct(){

		parent::__construct();

        $this->check_logged_in();

        $this->check_for_usertype("homephysician");

        $this->load->model('home_physician_model');

        $this->load->model('Procedure_model');

        $this->load->model('Staff_model');

        $this->load->model('specialist_model');

        $this->load->model('Patient_model');

        $this->load->model('booking_model');

        $this->load->model('Reviews_model');

        //$this->load->model('user');

		$this->load->helper('url');

		$this->load->helper('string');

		$this->load->library('session');

		$this->load->library('upload');

		//$this->load->library('email');

		$this->load->helper('form');

		$this->load->helper('hcareemail_helper');

		$this->load->library('form_validation');

	}

	

	/* @method : index

	 * @params: 

	 * @desc: index method is used for home physician dashboard

	 */

	public function index()

	{ 

		$data = $this->home_physician_model->homePhysian_totalpatient();

		

		//print_r($data);die();

		$result['totaldata'] = count($data);

		if(!empty($data)){

			foreach($data as $row){

				if($row->status == '0'){

					$statusForZero[]=$row->ID;

				}

			}

			if(!empty($statusForZero)){

				$result['statusforzero'] = count($statusForZero);

			}

		}	 

		//$result['totalpatientfortoday'] = $this->home_physician_model->homePhysian_totalpatientfortoday();

		//$currentuser= $this->session->set_userdata('userid','1');

		$patients = $this->home_physician_model->getPatientByCurrentDate();

		$result['reviews'] = $this->Reviews_model->gethomephydata();

		#echo "<PRE>";print_r($patients);die();

		if(!empty($patients)){

			$result['patients'] = $patients;

		}else{

			$result['patients'] = array();

		}

		

		$suffix = $this->datesuffix(date('d')); 

		$result['todaysDate'] = date('d').$suffix.date(' F, Y');

		//print_r($result['patients']);die();

	

		$this->load->view('templates/home_phy_header');

		$this->load->view('homephysician/dashboard',$result);

		$this->load->view('templates/home_phy_footer');

	}

	

	

	/* @method : account */

	public function account(){

		$userid = $this->session->userdata('userid');

		$profiledetails = $this->input->post();

		if(isset($profiledetails['save'])){

			$response = $this->home_physician_model->edit($userid);

        	//$data = array("title"=>"Account", 'success' => $sucess, 'error' => $errro );

			if($_REQUEST > 0){

				$data['profiledetails'] = [];

				$data['isupdate'] = 1;	

			}

		}

		$data['profiledetails'] = $this->home_physician_model->get_physican($userid); 

		$this->load->view('templates/home_phy_header');

		$this->load->view('homephysician/account', $data);

		$this->load->view('templates/home_phy_footer');

    }



		

	/* @method : appointment

     * @params: 

     * @desc: appointment method is used to book home physician appointment 

     */

	public function appointment(){ 

		$data = array();

		$details = array();

		$appointmentList = array();

		$slotwiseAppointment = array();

		$index = 0;

		$appointmentSlot = array(9,10,11,12,13,14,15,16,17,18);

		$suffix = $this->datesuffix(date('d'));

		$data['todaysdate'] = date('d').$suffix.date(' F').' ,'.date('Y');

		$appointmentlist = $this->home_physician_model->appointment_list();

		$data['totalpatient'] = count($appointmentlist);

		//print_r($appointmentlist);

		$data['procedure'] = $this->specialist_model->procedure();

   		

		if(!empty($appointmentlist)){

			foreach($appointmentlist as $appointment){ 

				if((int)$appointment->booking_time == $appointmentSlot[0]){

					$details['bookingID'] = $appointment->ID; 

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['09:00 AM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[1]){ 

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['10:00 AM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[2]){

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['11:00 AM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[3]){ 

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['12:00 PM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[4]){ 

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['01:00 PM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[5]){ 

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['02:00 PM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[6]){ 

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['03:00 PM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[7]){ 

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['04:00 PM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[8]){ 

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['05:00 PM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[9]){

					$details['bookingID'] = $appointment->ID; 

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['06:00 PM'][$index] = $details;

					$index++;

					$details = array();

				}

			}

			$data['slotwiseAppointment'] = $slotwiseAppointment;

		}else{

			$data['slotwiseAppointment'] = array();

		}

		

		$data['title'] = "Home Physicain Appoinment";

	    

		$this->load->view('templates/home_phy_header');

		$this->load->view('homephysician/physicianappointment', $data, $appointmentlist);

		$this->load->view('templates/home_phy_footer');

	}	

	

	/* @method : appointment_filter

     * @params: 

     * @desc: appointment_filter method is used to fetch home physiian appointment list for a particualr date & category

     */

	public function appointment_filter(){	

		$data = array();

		$details = array();

		$appointmentList = array();

		$slotwiseAppointment = array();

		$index = 0;

		$appointmentSlot = array(9,10,11,12,13,14,15,16,17,18);

		

		$filterDate = $this->input->post('datepicker');

		$suffix = $this->datesuffix(date('d', strtotime($filterDate)));

		$data['filterDate'] = date('d', strtotime($filterDate)).$suffix.date(' F', strtotime($filterDate)).', '.date('Y', strtotime($filterDate));

		$appointmentlist = $this->home_physician_model->appointment_list($filterDate);		

		$data['totalpatient'] = count($appointmentlist);

		   		

		if(!empty($appointmentlist)){

			foreach($appointmentlist as $appointment){ 

				if((int)$appointment->booking_time == $appointmentSlot[0]){

					$details['bookingID'] = $appointment->ID; 

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['09:00 AM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[1]){ 

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['10:00 AM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[2]){

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['11:00 AM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[3]){ 

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['12:00 PM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[4]){ 

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['01:00 PM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[5]){ 

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['02:00 PM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[6]){ 

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['03:00 PM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[7]){ 

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['04:00 PM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[8]){ 

					$details['bookingID'] = $appointment->ID;

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['05:00 PM'][$index] = $details;

					$index++;

					$details = array();

				}else if((int)$appointment->booking_time == $appointmentSlot[9]){

					$details['bookingID'] = $appointment->ID; 

					$details['patientID'] = $appointment->patient_user_id; 

					$details['name'] = $appointment->fname.' '.$appointment->lname; 

					$details['pic'] = $appointment->picture;

					$slotwiseAppointment['06:00 PM'][$index] = $details;

					$index++;

					$details = array();

				}

			}

			$data['slotwiseAppointment'] = $slotwiseAppointment;

		}else{

			$data['slotwiseAppointment'] = array();

		}

		

		echo json_encode($data);

	}	

	

		

	/* @method : physicianappointment_details

     * @params: 

     * @desc: physicianappointment_details method is used to fetch particular appointment details

     */

	public function physicianappointment_details(){

		$response = array();

		$bookingid = $this->input->post('bookingid');

		$appointmentdetails = $this->home_physician_model->physicianappointment_details($bookingid);

		$medicalHistory = $this->home_physician_model->medicalHistory();

		

		if(!empty($appointmentdetails)){

			$response['success'] = 1;

			$response['error'] = 0;

			$response['appointmentdetails'] = $appointmentdetails;

			$response['medicalHistory'] = $medicalHistory;

		}

		echo json_encode($response);

	}

	

	/* @method : getTotalPatient

     * @params: 

     * @desc: getTotalPatient method is used to fetch total patient on a particular day

     */

	public function getTotalPatient(){

		$totalInvitedPatient = $this->home_physician_model->homePhysian_totalpatientfortoday();

		echo json_encode($totalInvitedPatient);	

	}

	

	/* @method : physician_patient_reminder

     * @params: 

     * @desc: physician_patient_reminder method is used to remind apointment details to patient

     */

	public function physician_patient_reminder(){

		$bookingid = $this->input->post('bookingid');

		$bookingdetails = $this->home_physician_model->booking_details($bookingid);

		

		$userid = $this->session->userdata('userid');

		$physician = $this->home_physician_model->physician_details($userid); 

		$email['from'] = $physician['email'];

		$email['fromname'] = "HCare";

		$email['to'] = $bookingdetails[0]->email; 

		$email['subject'] = "HCare Patient Reminder";

		$email['message'] = 'Hi, '.$bookingdetails[0]->fname.' '.$bookingdetails[0]->lname.' Your have an specialist booking on '.

							$bookingdetails[0]->booking_date.' at '.$bookingdetails[0]->booking_time;

		

		$isSend = hcare_email($email);

		

		if($isSend){

			$response['success'] = 1;

			$response['error'] = 0;

			$response['message'] = "Reminder send successfully.";

		}else{

			$response['success'] = 0;

			$response['error'] = 1;

			$response['message'] = "Failed to send reminder.";

		}

		echo json_encode($response);

	}

	

	/* @method : booking_cancel

     * @params: 

     * @desc: booking_cancel method is used to cancel a particular booking

     */

	public function booking_cancel(){

		if($this->input->is_ajax_request()){ 	

			$bookingid = $this->input->post('bookingid');

			$isCancel = $this->home_physician_model->cancel_booking($bookingid);

			

			if($isCancel){ 

				$response['success'] = 1;

				$response['error'] = 0;

				$response['message'] = "Booking cancel successfully.";

		 	}else{ 

				$response['success'] = 0;

				$response['error'] = 1;

				$response['message'] = "Failed to cancel booking.";

		 	}

		 	echo json_encode($response);

		}

	} 

		

	/* @method : datesuffix

     * @params: $date

     * @desc: datesuffix method is used to add suffix after a date 

     */

	public function datesuffix($date){

		if($date >= 1 && $date <= 31){

			if ($date >= 11 && $date <= 13){

        		return "th";

    		}else{

				switch ($date % 10) {

					case 1:  return "st";

					case 2:  return "nd";

					case 3:  return "rd";

					default: return "th";

				}

			}

		} 

	}	

	

	public function patients(){

		 $resultdata['angular_js_file']="homephysician.js?preventCache=".time();

		 $result['userid'] = $this->session->userdata('userid');

		 $result['patient_details'] = $this->home_physician_model->get_patient_details($result['userid']);

		 //echo "<PRE>";print_r($result['patient_details']); die();

		 $this->load->view('templates/home_phy_header',$resultdata);

		 $this->load->view('homephysician/patients',$result);

		 $this->load->view('templates/home_phy_footer');

	}

	

    public function angular_patients(){

		 $postdata = file_get_contents("php://input");

		 $request = json_decode($postdata);

		 $userid = $request->hphy_id;

		// $userid = $this->session->userdata("userid");

		 $data=$this->home_physician_model->get_patient_details($userid);

		 $data = array_values($data);
		 header('Content-Type: application/json');
		 echo json_encode($data);

	}

	

    public function angular_patients_review(){

		$postdata = file_get_contents("php://input");

		$request = json_decode($postdata);

		$userid = $request->hphy_id;

		$patientid= $request->patientid;

		$data=$this->home_physician_model->get_patient_review($userid,$patientid);

		$data = array_values($data);
		echo json_encode($data);

	}	

		

	public function physician_patient_reminder_mail(){

		$userid = $this->session->userdata('userid');

		$physician = $this->home_physician_model->physician_details($userid); 

		$email['from'] = $physician['email'];

		$email['fromname'] = "HCare";

		$emailArr = explode('$#$',$this->input->post('email'));
		
		$reminderUserId = $emailArr[1];
		$bID = $emailArr[2];

		$email['to'] = $emailArr[0];

		$email['subject'] = "HCare Patient Reminder";

		$email['message'] = 'Hi, you have an appointment at HCare';

		$email['physician'] = $physician;

		$email['homephy'] = $this->home_physician_model->physician_details($reminderUserId);
		
		$email['hBooking'] = $this->home_physician_model->booking_details($bID);
		#echo "<PRE>";print_r($email);exit; 

		$isSend = hcare_email($email);

		

		if($isSend){

			$response['success'] = 1;

			$response['error'] = 0;

		}else{

			$response['success'] = 0;

			$response['error'] = 1;

		}

		echo json_encode($response);

	}	

	#######################################################################################################################	

	

	

	

	/* @method : send email

     * @params: $id

     * @desc: send_email method is used to confirmation mail send

     */

	public function send_mail($email) { 

         $from_email = "webmaster@grouphrocket.ca"; 

         $to_email = $email; 

   

         $this->email->from($from_email, 'Matainja Technologies Pvt Ltd'); 

         $this->email->to($to_email);

         $this->email->subject('For Registration Confirmation Email'); 

         $this->email->message('Thank you for registration.'); 

   

         //Send mail 

         if($this->email->send()) 

         $this->session->set_flashdata("email_sent","Email sent successfully."); 

         else 

         $this->session->set_flashdata("email_sent","Error in sending Email."); 

        // $this->load->view('home_physican_view_add'); 

      } 

	

	

	/* @method : register

     * @params: $id

     * @desc: register method is used for adding home physican details

     */

	 

	 public function register(){

		 

		$this->form_validation->set_rules('name', 'Name', 'trim|required');

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[huser.email]');

		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|required|matches[cpassword]');

		$this->form_validation->set_rules('cpassword', 'password confirmation', 'trim');

		//validate form input

        if ($this->form_validation->run() == FALSE)

        {

            // fails

			$this->load->view('templates/header');

            $this->load->view('home_physican_view_add');

			$this->load->view('templates/footer');

        }

        else

        {

            //insert the user registration details into database

            $data = array(

                'name' => $this->input->post('name'),

                'email' => $this->input->post('email'),

                'password' => md5($this->input->post('password')),

				'usertype' => 'homephysican',

				'fname' => $this->input->post('name')

            );

            

            // insert form data into database

            if ($this->home_physician_model->add_home_physican($data))

            {

				$this->send_mail($this->input->post('email'));

				// successfully sent data

                    //$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>You are Successfully Registered! Please check your mail </strong></div>');

                    //redirect('homephysican/register');

					$data = array("title"=>"Hcare Physician Resigrataion");

					$this->load->view('templates/header');

					$this->load->view('thanksforregistration');

					$this->load->view('templates/footer');

					

			}

			else

			{

				// error

				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops! Error.  Please try again later!!!</strong></div>');

				redirect('homephysican/register');

		    }

			

			

		}

		

		

	}

    /* @method : edit_physican

     * @params:$id

     * @desc: edit_physican method is used for update physican details

     */

	public function edit_physican($id){

        $res = $this->home_physician_model->get_physican($id);

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() === FALSE){

            $data = array("title"=>"Edit Physican", "phy"=>$res);

            $this->load->view('templates/header');

            $this->load->view('home_physican_edit',$data);

            $this->load->view('templates/footer');

        }else{

            $this->home_physician_model->edit($id);

            redirect('/Homephysican/view_physican', 'refresh');

        }

	}

    /* @method : view_physican

     * @params:

     * @desc: view_physican method is used for showing physican details

     */

	public function view_physican(){

		$result = $this->home_physician_model->view_details();

		$this->load->view('templates/header');

		$data = array("title"=>"Edit Physican", "physican"=>$result);

		$this->load->view('home_physican_view',$data);

		$this->load->view('templates/footer');

	}

    /* @method : procedure_search

     * @params:

     * @desc: procedure_search method is used for search procedure

     */

    public function procedure_search(){

        $this->form_validation->set_rules('procedure_name', 'Procedure Name', 'required');

        if ($this->form_validation->run() === FALSE){

            $list = $this->Procedure_model->get_pro_cat_list();

            $data = array("title"=>"Edit Physican", "list"=>$list);

            $this->load->view('templates/header');

            $this->load->view('search_specialist',$data);

            $this->load->view('templates/footer');

        }else{

            $result = $this->Procedure_model->get_search_result();

            $list = $this->Procedure_model->get_pro_cat_list();

            $data = array("title"=>"Search", "list"=> $list , 'procedure' => $result);

            $this->load->view('templates/header');

            $this->load->view('search_specialist',$data);

            $this->load->view('templates/footer');

        }

    }

    /* @method : bookSpecialist

     * @params:

     * @desc: bookSpecialist method is used for booking

     */

    public function bookSpecialist($id){

        $user_id = $this->session->userdata('user_id');

        $this->form_validation->set_rules('date', 'Appointment Date', 'required');

        if ($this->form_validation->run() === FALSE){

            $getPatient = $this->Patient_model->get_patient_name_id($user_id);

            $result = $this->Procedure_model->get_specialist_procedure_detail($id);//  used to fetch specialist procedure detail   //

            $specialist_id = $result->userid;

            $spec = $this->Specialist_model->get_specialist_by_id($specialist_id);

            $staff = $this->Staff_model->get_specialist_staff($specialist_id); //  used to fetch specialist staff detail   //

            $error = "";

            $success = "";

            $data = array("title"=>"Edit Physican",'patient' => $getPatient,  "staff"=>$staff,'success' => $success , 'error'  => $error , 'procedure' => $result,'spec' => $spec, 'userid' => $specialist_id ,'procedure_id' => $id);

            $this->load->view('templates/header');

            $this->load->view('bookSpecialist',$data);

            $this->load->view('templates/footer');

        }else{

            $saveResult = $this->booking_model->save_booking_details($data = null);

            $result = $this->Procedure_model->get_specialist_procedure_detail($id);//  used to fetch specialist procedure detail   //

            $specialist_id = $result->userid;

            $spec = $this->Specialist_model->get_specialist_by_id($specialist_id);

            $staff = $this->Staff_model->get_specialist_staff($specialist_id); //  used to fetch specialist staff detail   //

            $getPatient = $this->Patient_model->get_patient_name_id($user_id);

            $error = "";

            $success = "";

            if($saveResult){

                $success = "Booking has been saved";

            }else{

                $error = "You have already booked this hour for appointment , please select other hour from available slot";

            }

            $data = array("title"=>"Edit Physican", "staff"=> $staff, 'patient' => $getPatient, 'success' => $success , 'error'  => $error ,'procedure' => $result,'spec' => $spec, 'userid' => $specialist_id ,'procedure_id' => $id);

            $this->load->view('templates/header');

            $this->load->view('bookSpecialist',$data);

            $this->load->view('templates/footer');

        }

    }

    /* @method : bookSpecialist

     * @params:

     * @desc: bookSpecialist method is used for booking

     */

    public function cancel_booking(){

        $this->form_validation->set_rules('date', 'Appointment date', 'required');

        if ($this->form_validation->run() === FALSE){

            $date = $this->input->post('date');

            $data = array("title"=>"Cancel Booking",'date'=> $date);

            $this->load->view('templates/header');

            $this->load->view('cancel_booking',$data);

            $this->load->view('templates/footer');

        }else{

            $date = $this->input->post('date');

            $result = $this->booking_model->check_booking_details();

            $data = array("title"=>"Cancel Booking", 'data'=> $result,'date' => $date);

            $this->load->view('templates/header');

            $this->load->view('cancel_booking',$data);

            $this->load->view('templates/footer');

        }

    }

    /* @method : settings

     * @params:

     * @desc: settings method is used for physican setting

     */

    public function settings(){

        $states = $this->Specialist_model->get_all_state();

        $city = $this->Specialist_model->get_all_city();

        $existDetails = $this->Specialist_model->get_licence_state_city_lcno();

        $status = $this->Specialist_model->get_licence_status();

        $success ="";

        $error = "";

        if(isset($_POST['changePass'])){

            $result = $this->user->change_password();

            if ($result == true) {

                $success = "Your password has been changed";

            }else{

                $error = "data not saved";

            }

        }

        if(isset( $_POST['changeNotification'])){

            $result = $this->home_physician_model->save_notification_specialist();

            if ($result == TRUE) {

                $success = "notification has been saved";

            }else{

                $error = "data not saved";

            }

        }

        if(isset( $_POST['licenceStatus'])){

            $result = $this->home_physician_model->save_licence_detail();

            if ($result == TRUE) {

                $success = "Licence details has been saved";

            }else{

                $error = "data not saved";

            }

        }

        $this->load->view('templates/header');

        $data = array("title"=>"specialist setting", 'success' => $success ,'error' => $error ,'state' =>$states ,'city' => $city ,'existState' => $existDetails,'status' => $status );

        $this->load->view('home_physican_setting',$data);

    }

    /* @method : bookSpecialist

     * @params:

     * @desc: bookSpecialist method is used for booking

     */

    public function recommendation($page=1){

        $this->form_validation->set_rules('procedure_cat_id', 'procedure category', 'required');

        if ($this->form_validation->run() === FALSE){

            $user_id = $this->session->userdata('user_id');

            $pr_cat_id = $this->input->post('procedure_cat_id');

            $getData = $this->Procedure_model->get_data_for_procedure($pr_cat_id);

            $getPatient = $this->Patient_model->get_patient_name_id($user_id);

            $pro_name = $this->Procedure_model->get_pro_cat_list();

            $prc = $this->home_physician_model->check_already_recommend_procedure($pr_cat_id);

            $success ="";

            $error = "";

            $data = array("title"=>"recommendation", 'success' => $success ,'error' => $error ,'patient'=> $getPatient,'pro' => $pro_name ,'prc' => $prc, 'list' => $getData);

            $this->load->view('templates/header');

            $this->load->view('recommend_specialist',$data);

            $this->load->view('templates/footer');

        }else{

            $user_id = $this->session->userdata('user_id');

            $pr_cat_id = $this->input->post('procedure_cat_id');

            $getData = $this->Procedure_model->get_data_for_procedure($pr_cat_id);

            $getPatient = $this->Patient_model->get_patient_name_id($user_id);

            $pro_name = $this->Procedure_model->get_pro_cat_list();

            $prc = $this->Procedure_model->check_already_recommend_procedure($pr_cat_id);

             $save = $this->home_physician_model->save_recommendation();

            $success ="";

            $error = "";

            if ($save == true) {

                $success = "Your recommendation has been saved";

            }else{

                $error = "recommendation not saved";

            }

            $data = array("title"=>"recommendation", 'success' => $success ,'error' => $error , 'patient'=> $getPatient, 'pro' => $pro_name ,'prc' => $prc, 'list' => $getData);

            $this->load->view('templates/header');

            $this->load->view('recommend_specialist',$data);

            $this->load->view('templates/footer');

        }

    }

	public function sendemail(){  

	   $homePhy_name = $this->session->userdata("username");

		

		$emails = $_POST['email'];

		if(is_array($emails))

		{

		  foreach($emails as $email)

		          {  

				    $result = $this->home_physician_model->invitation_code($email);

					$url = base_url()."signup/patient/".$result->invitationcode;

					$email=array('fromname' => 'HCare',

					             'to'=>$email,

					             'subject'=>'Patient Invition mail',

								 'message' => '<tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:30px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200"><p>Hi '.$result->patientfname.' </p></td>

					</tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 6% 5px 7.5%;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>'.ucfirst($homePhy_name).' sent you invitation to join our application. Please clik on following link :</p>

					<p> <a href="'.$url.'">Join Now</a>.</p>

					<p></p></td></tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>Best,<br> Hcare Group</p></td></tr>',);

					$isSend = hcare_email($email);

					if($isSend){

							$response['success'] = 1;

							$response['error'] = 0;

					}else{

							$response['success'] = 0;

							$response['error'] = 1;

					}

					echo json_encode($response);

				}

	    }

	   else{ 

			  $result = $this->home_physician_model->invitation_code($emails);

			  $url = base_url()."signup/patient/".$result->invitationcode;

			  $email['fromname'] = "HCare";

		      $email['to'] = $emails;

		      $email['subject'] = "Patient Invition mail";

	          $email['message'] = '<tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:30px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200"><p>Hi '.$result->patientfname.', </p></td>

</tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 6% 5px 7.5%;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>'.ucfirst($homePhy_name).' sent you invitation to join our application. Please clik on following link :</p>

<p> <a href="'.$url.'">Join Now</a>.</p>

<p></p></td></tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>Best,<br> Hcare Group</p></td></tr>';

	          $isSend = hcare_email($email);

		      if($isSend){

		            	$response['success'] = 1;

			            $response['error'] = 0;

		      }else{

		             	$response['success'] = 0;

			            $response['error'] = 1;

		      }

		     echo json_encode($response);

	   }

   }

	public function patient_invite(){
		$result=array();
		$invite=array();
		$todaysDate  = date('Y-m-d');
		$result = $this->home_physician_model->invitation_list();
		foreach($result as $value)
		{

			if($value['issuedate']==date('Y-m-d'))

			{

				$list['name']=$value['patientfname'].' '.$value['patientlname'];

				$list['email']=$value['email'];	

				$data['invite']['Today'][]=$list;

			}else if($value['issuedate'] == date('Y-m-d', strtotime('-1 day', strtotime($todaysDate)))){

				$list['name']=$value['patientfname'].' '.$value['patientlname'];

				$list['email']=$value['email'];	

				$data['invite']['Yesterday'][] = $list;

			}else{

				$list['name']=$value['patientfname'].' '.$value['patientlname'];

				$list['email']=$value['email'];	

				$data['invite']['More than two days'][] = $list;

			}
		}
		$resultdata['angular_js_file']="homephysician.js?preventCache=".time();

		$this->load->view('templates/home_phy_header', $resultdata);	
		$this->load->view('homephysician/patient_invite', $data);
		$this->load->view('templates/home_phy_footer');	
	}

	public function angular_patients_invite_today(){
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		
		$result=array();
		$invite=array();
		$todaysDate  = date('Y-m-d');
		$result = $this->home_physician_model->invitation_list();
		foreach($result as $value)
		{
			if($value['issuedate'] == date('Y-m-d'))
			{
				$list['name']=$value['patientfname'].' '.$value['patientlname'];
				$list['email']=$value['email'];	
				$data[]=$list;
			}
		}

		//$data = array_values($data);
		echo json_encode($data);
	}

	public function angular_patients_invite_yesterday(){
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		
		$result=array();
		$invite=array();
		$todaysDate  = date('Y-m-d');
		$result = $this->home_physician_model->invitation_list();
		foreach($result as $value)
		{
			if($value['issuedate'] == date('Y-m-d', strtotime('-1 day', strtotime($todaysDate)))){
				$list['name']=$value['patientfname'].' '.$value['patientlname'];
				$list['email']=$value['email'];	
				$data[] = $list;
			}
		}

		//$data = array_values($data);
		echo json_encode($data);
	}

	public function angular_patients_invite_less(){
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		
		$result=array();
		$invite=array();
		$todaysDate  = date('Y-m-d');
		$result = $this->home_physician_model->invitation_list();
		foreach($result as $value)
		{
			if($value['issuedate'] != date('Y-m-d') && $value['issuedate'] != date('Y-m-d', strtotime('-1 day', strtotime($todaysDate))))
			{
				$list['name']=$value['patientfname'].' '.$value['patientlname'];
				$list['email']=$value['email'];	
				$data[]=$list;
			}
		}

		//$data = array_values($data);
		echo json_encode($data);
	}

	public function sendInvite(){

		 $homePhy_name = $this->session->userdata("username");

		

         $checkinvitormail = $this->home_physician_model->check_invition($this->input->post('pemail'));

		 if(!empty($checkinvitormail))

			   { 

				    $userid = $this->session->userdata('userid');

					$physician = $this->home_physician_model->physician_details($userid); 

					$url = base_url()."signup/patient/".$checkinvitormail->invitationcode;

					$email['from'] = $physician['email'];

					$email['fromname'] = "HCare";

					$email['to'] = $this->input->post('pemail');

					$email['subject'] = "".ucfirst($homePhy_name)." Invited you to Join HCare";

					$email['message'] = '<tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:30px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200"><p>Hi '.$checkinvitormail->patientfname.' </p></td>

					</tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 6% 5px 7.5%;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>Reminder : "'.ucfirst($homePhy_name).'" Invited you to Join HCare</p>

					<p> <a href="'.$url.'">Join Now</a>.</p>

					<p></p></td></tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>Best,<br> Hcare Group</p></td></tr>';

					$isSend = hcare_email($email);

					if($isSend){

						$response['success'] = true;

						$response['error'] = false;

						$response['message'] = "Successfully added invitation";

					  }

				    echo json_encode($response);

				   }

		 else

			   { $result = $this->home_physician_model->sendInvitationInsert();

				 if($result){

					$userid = $this->session->userdata('userid');

					$physician = $this->home_physician_model->physician_details($userid);

					$insertDetails = $this->home_physician_model->getInvitionLastInsertDetails($result);

					$url = base_url()."signup/patient/".$insertDetails->invitationcode; 

					$email['from'] = $physician['email'];

					$email['fromname'] = "HCare";

					$email['to'] = $this->input->post('pemail');

					$email['subject'] = "HCare Specialist Patient Invite";

					$email['message'] = '<tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:30px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200"><p>Hi '.$insertDetails->patientfname.' </p></td>

					</tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 6% 5px 7.5%;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>'.ucfirst($homePhy_name).'From HCare send you a invitation for checkup.</p>

					<p> <a href="'.$url.'">Join Now</a>.</p>

					<p></p></td></tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>Best,<br> Hcare Group</p></td></tr>';

					$isSend = hcare_email($email);

					if($isSend){

						$response['success'] = true;

						$response['error'] = false;

						$response['message'] = "Successfully add invitation";

					  }

				}else{

					$response['success'] = false;

					$response['error'] = true;

					$response['message'] = "Fail to add invitation";

				}

		

				echo json_encode($response);

		  }  

	}	

	public function review(){

        $resultdata['procedure']=$this->Reviews_model->procedure();

        $resultdata['val']=$this->Reviews_model->category();

        $resultdata["angular_js_file"]="homephysician.js?preventCache=".time();

        $this->load->view('templates/home_phy_header',$resultdata);

        $this->load->view('homephysician/review',$resultdata);

        $this->load->view('templates/home_phy_footer');

    }

    public function get_reviews(){

        //$this->load->view('templates/header');

        $result=$this->Reviews_model->gethomephydata();

        $resultdata=  array( );

        foreach($result as $val){

            // $slot_date=$val->slot_date;

            // $slotDateArr=explode("-",$slot_date);

            // $newdate=$slotDateArr[2].'-'.$slotDateArr[1].'-'.$slotDateArr[0];

            // $newdate=array("newDate"=>$newdate);

            $val1=(array)$val;

            $resultdata[] = array_merge($val1);

        }

       

        echo json_encode($resultdata);

     

    }

     /* @method : search

     * @params:

     * @desc: search method is used for search data

     */

    //-----------old function not in use (not sure) ------------------// 

    public function searchs(){

        $search = $this->input->post('patientSearch');

        $posted_data=array();

        $prcSearch = '';

        if(isset($search)){

            $prcSearch = $this->specialist_model->get_sp_search_details();

            if(!empty($prcSearch)){

                $prcSearch;

            }

            $out = $this->Procedure_model->get_procedure_names_wise($this->input->post("procedure_cat"));

           

            $posted_data=array(

                "cat_id"=>$this->input->post("procedure_cat"),

                "procedures"=>$out,

                "pro_id"=>$this->input->post("procedure_name"),

            );

        }

        

        $prc = $this->Procedure_model->get_pro_cat_name_wise();

        $data = array("title"=>"search",'prcCat' => $prc, 'prSearch' => $prcSearch );

        $data["pro_cat"]=$this->Procedure_model->get_pro_cat_list();

        $data["posted_data"]=$posted_data;

        $this->load->view('templates/home_phy_search_header',$data);

        $this->load->view('patient/search',$data);

        $this->load->view('templates/home_phy_search_footer');

    }

    

     /* @method : book_specialist

     * @params:

     * @desc: book_specialist method is used for booking specialist data

     

     */

        //--- not sure this funtion  is used or not -----------//

    

      public function book_specialist_old_one(){

           $time_slot = $this->input->post('time_slot');

          if(  $time_slot==""){

              redirect("patient/search","refersh");

          }

        $user_id = $this->session->userdata('user_id');

        $time_slot = $this->input->post('time_slot');

        $doc_id = $this->input->post('doc_id');

        $pr_id = $this->input->post('pr_id');

        $date = $this->input->post('date');

        $query = "SELECT hsp.picture , hsp.name ,hsp.title, hsp.desc, hsp.latitude, hsp.longitude,hsp.address,hsp.city FROM (huser hus INNER JOIN hspecialist hsp ON hus.ID = hsp.userid) WHERE hus.ID = '$doc_id' ";

        $data =  $this->db->query($query);

        $rsr = $data->row();

        $this->db->select('refered_by');

        $this->db->from('hpatient');

        $this->db->where('userid' , $user_id);

        $hp_id = $this->db->get()->row();

        $this->db->select('from_price, to_price ,description, procedure_name');

        $this->db->from('hprocedure');

        $this->db->where('ID' , $pr_id);

        $this->db->where('user_id' , $doc_id);

        $output = $this->db->get()->row();

        $Saveslotdata = $this->input->post('Saveslotdata');

        if(isset($Saveslotdata)){

            $save= $this->Procedure_model->save_booking_details();

            $data1 = array("title"=>"Book Appointment", 'spdata' => $rsr, 'procedure' => $output,'home_ph_id' => $hp_id, 'time_slot' => $time_slot, 'doc_id' => $doc_id, 'pr_id' => $pr_id, 'date' => $date);

            $data1["msg"]="Your appointment request has booked. ";

            $this->load->view('templates/patient_search_header',$data1);

            $this->load->view('patient/booking_success',$data1);

            $this->load->view('templates/patient_search_footer');

        }

        else {

             $data1 = array("title"=>"Book Appointment", 'spdata' => $rsr, 'procedure' => $output,'home_ph_id' => $hp_id, 'time_slot' => $time_slot, 'doc_id' => $doc_id, 'pr_id' => $pr_id, 'date' => $date);

            $this->load->view('templates/patient_search_header',$data1);

            $this->load->view('patient/book_specialist',$data1);

            $this->load->view('templates/patient_search_footer');

        }

       

    }

    

    public function search_procedure(){

        

        $search = $this->input->get('procedure_cat', TRUE);   

        $posted_data=array();

        $prcSearch = '';

        if(isset($search)){

            $prcSearch = $this->Patient_model->get_sp_search_details();

            if(!empty($prcSearch)){

                $prcSearch;

            }

            $out = $this->Procedure_model->get_procedure_names_wise($this->input->get("procedure_cat"));

            $posted_data=array(

                "cat_id"=> $this->input->get('procedure_cat', TRUE),

                "procedures"=> $out,

                "pro_id"=> $this->input->get('procedure_name', TRUE) 

            );

        }

        

        $prc = $this->Procedure_model->get_pro_cat_name_wise();

        $data = array("title"=>"search",'prcCat' => $prc, 'prSearch' => $prcSearch );

        $data["pro_cat"]=$this->Procedure_model->get_pro_cat_list();

        $data["posted_data"]=$posted_data;

        $data["km"]= $this->input->get('distance', TRUE) ;

        $this->load->view('templates/search_header',$data);

        $this->load->view('homephysician/search',$data);

        $this->load->view('templates/search_footer');

  }

    

    

    

     /* @method : book_specialist

     * @params:

     * @desc: book_specialist method is used for booking specialist data

     */

      public function book_specialist(){

          

        $user_id = $this->session->userdata('user_id');

//        $this->input->get('procedure_cat', TRUE);

        $time_slot = $this->input->get('time_slot' , TRUE);

        $doc_id = $this->input->get('docId', TRUE);

        $pr_id = $this->input->get('pr_id', TRUE);

        $date = $this->input->get('date', TRUE);

          

        $query = "SELECT hsp.picture , hsp.name ,hsp.title, hsp.desc, hsp.latitude, hsp.longitude,hsp.address,hsp.city FROM (huser hus INNER JOIN hspecialist hsp ON hus.ID = hsp.userid) WHERE hus.ID = '$doc_id' ";

          

        $data =  $this->db->query($query);

        $rsr = $data->row();

          

          

        $this->db->select('refered_by');

        $this->db->from('hpatient');

        $this->db->where('userid' , $user_id);

        $hp_id = $this->db->get()->row();

          

          

        $this->db->select('from_price, to_price ,description, procedure_name');

        $this->db->from('hprocedure');

        $this->db->where('ID' , $pr_id);

        $this->db->where('user_id' , $doc_id);

        $output = $this->db->get()->row();

          

        $Saveslotdata = $this->input->post('Saveslotdata');

            

        $getPat = $this->home_physician_model->get_home_phy_patient();  

          $error ='';

        if(isset($Saveslotdata)){

            $save= $this->home_physician_model->save_booking_details();

            

            $data1 = array("title"=>"Book Appointment", 'spdata' => $rsr, 'procedure' => $output,'home_ph_id' => $hp_id, 'time_slot' => $time_slot, 'doc_id' => $doc_id, 'pr_id' => $pr_id, 'date' => $date , 'plist' => $getPat, 'error' => $error );

                

            if($save == true){

                    $data1["msg"]="Your appointment request has booked";

                    $this->load->view('templates/patient_search_header',$data1);

                    $this->load->view('homephysician/booking_success',$data1);

                    $this->load->view('templates/patient_search_footer');

            }else{

                    $data11["msg"] = "You already have appointment on this time, please choose other";

                    $this->load->view('templates/patient_search_header',$data11);

                    $this->load->view('homephysician/booking_success',$data11);

                    $this->load->view('templates/patient_search_footer');

            }

        }

        else {

             $data1 = array("title"=>"Book Appointment", 'spdata' => $rsr, 'procedure' => $output,'home_ph_id' => $hp_id, 'time_slot' => $time_slot, 'doc_id' => $doc_id, 'pr_id' => $pr_id, 'date' => $date , 'plist' => $getPat , 'error' => $error );

            $this->load->view('templates/patient_search_header',$data1);

            $this->load->view('homephysician/book_specialist',$data1);

            $this->load->view('templates/patient_search_footer');

        }

       

    } 

    

     public function booking_success(){

        $data1["msg"]="Your booking is saved successfully. ";

        $this->load->view('templates/patient_search_header',$data1);

        $this->load->view('homephysician/booking_success',$data1);

        $this->load->view('templates/patient_search_footer');   

        

    }

	public function medicalHistory()

	  {

		  $date = date('Y-m-d');

		if($this->input->post('tag') != 'isImage'){

			unset($_FILES);

		}

		if(isset($_FILES['medicalhistoryFile']['name']))

			{

			if (!is_dir('assets/patient/')) { 

					mkdir('./assets/patient/', 0777, true); 

						  } 

			if (!is_dir('assets/patient/history')) { 

					mkdir('./assets/patient/history/', 0777, true); 

					 }

                                    $config = array(); 

									$config['upload_path'] = 'assets/patient/history/'; 

									$config['allowed_types'] = '*';

									$config['file_name'] =  'appointmentMedicalHistory_'.time(); 

									$this->upload->initialize($config); 

									 if ($this->upload->do_upload('medicalhistoryFile')) 

										 { 

											$img = $this->upload->data(); 

											$data=array('patient_id'=>$this->input->post('patientid_name'),

											            'user_id'=>$this->session->userdata('user_id'),

														'date'=>$date,

														'booking_id'=>$this->input->post('bookingid_name'),

														'history_type'=>$this->input->post('history_type'),

														'historytitle'=>$this->input->post('report_name'),

														'desc'=>$this->input->post('desc'),

														'files'=>'assets/patient/history/'.$img['file_name']

														);

											$lastInsertedID=$this->specialist_model->addMedicalHistory($data);

											$resultdata = $this->specialist_model->selectMedicalHistorybyLastID($lastInsertedID);

											if($resultdata)

											   { $result = array('success'=>1,'error'=>0,'data'=>$resultdata,'message'=>'Medical history Added successfully.');

												 echo json_encode($result);

												}

												else

												{

												 $result = array('success'=>0,'error'=>1,'data'=>array(),'message'=>'Failed to add medical history.');

												 echo json_encode($result);

												}						 

										 }

										 else

										  { $counterror[]=$i;

										  $totalValue='('.count($counterror).')';

											  $error = array('message' => $this->upload->display_errors().$totalValue);

											 print_r($error);

											} 	 

			}

			else

			{ 

				$data=array('patient_id'=>$this->input->post('patientid_name'),

							'user_id'=>$this->session->userdata('user_id'),

							'date'=>$date,

							'booking_id'=>$this->input->post('bookingid_name'),

							'history_type'=>$this->input->post('history_type'),

							'historytitle'=>$this->input->post('report_name'),

							'desc'=>$this->input->post('desc'),

							

							);

				$lastInsertedID=$this->specialist_model->addMedicalHistory($data);

				$resultdata = $this->specialist_model->selectMedicalHistorybyLastID($lastInsertedID);

				//echo $resultdata;	

				if($resultdata)

				   { $result = array('success'=>1,'error'=>0,'data'=>$resultdata,'message'=>'Medical history Added successfully.');

					 echo json_encode($result);

					}

					else

					{

					 $result = array('success'=>0,'error'=>1,'data'=>array(),'message'=>'Failed to add medical history.');

					 echo json_encode($result);

					}

				}

		}

		

    public function report()

	{

		$this->load->view('templates/home_phy_header');

		$this->load->view('homephysician/homephysicianreport');

		$this->load->view('templates/home_phy_footer');

	}

	

    public function homephysicianreport(){

        if($this->input->is_ajax_request()){

			$data['userid'] = $this->session->userdata('userid');

			if($this->input->post('tag') == 'dashboard'){

				$data['tag'] = 'dashboard'; 

				$reportdata = $this->home_physician_model->homephysicianreport($data);

			}else if($this->input->post('tag') == 'report'){

				$data['fromdate'] = date('Y-m-d', strtotime($this->input->post('from')));

				$data['todate'] = date('Y-m-d', strtotime($this->input->post('to')));

				$data['tag'] = 'report'; 

				$reportdata = $this->home_physician_model->homephysicianreport($data);

			}

			
			if(!empty($reportdata)){
				foreach($reportdata as $report){

					$reportdata['display_date'] = date('d M', strtotime($report->date));

					$reportdata['total_appt'] = (int)$report->total_appt; 

					$reportdata['cancel_appt'] = (int)$report->cancel_appt;  

					$reportdata['mess'] = 'Record Found';	

					$chartdata[] = $reportdata;

					$reportdata = array();

				}
			}
			else{
				$reportdata['mess'] = 'No Record Found';
				$chartdata[] = $reportdata;
				$reportdata = array();
			}

			echo json_encode($chartdata);	

			exit(0);	

        }

    }

}

