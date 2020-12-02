<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patient extends H_Controller {

	

	public function __construct(){

		parent::__construct();

		$this->check_logged_in();

		$this->check_for_usertype("patient");

		$this->load->model('Patient_model');

		$this->load->model('Procedure_model');

		$this->load->model('Specialist_model');

		$this->load->helper('url');

		$this->load->helper('string');

		$this->load->library('session');

		$this->load->library('email');

		$this->load->library('upload');

		$this->load->helper('form');

		$this->load->library('form_validation');

	}

    

    

    

    public function index(){

        $prc = $this->Procedure_model->get_pro_cat_name_wise();

      

        $data["prcCat"]=$prc ;

        $data["patient_checkups"]=$this->Patient_model->get_dashboard_checkup();

        $data["patient_today_appt"]=$this->Patient_model->get_dashboard_today_appointment();

		$data["patient_pending_reviews"]=$this->Patient_model->patient_pending_reviews();

		 

		$data['patient_today_prescription'] = $this->Patient_model->fetch_today_prescription();

        $this->load->view('templates/patient_header');

        $this->load->view('patient/dashboard',$data);

        $this->load->view('templates/patient_footer');

   

  }

    /* @method : add

     * @params:

     * @desc: add method is used for add patient details

     */

	public function register(){

		if(!empty($_POST)){

			$result = $this->Patient_model->add_patient();

			if ($result == TRUE) {//if successfull

				$success ="Patient added Successfully ";

				$error = "";

				$data = array("title"=>"Patient Add" ,'success' => $success ,'error' => $error);

				//print_r($data);die();

				$receivermail = $this->input->post('email');

    			if($this->send_mail($receivermail)){

					$this->load->view('templates/header');

					$this->load->view('add_patient',$data);

					$this->load->view('templates/footer');

				}

			} else {//if not successful upload

				$success ="error saving data";

				$error = "";

				$data = array("title"=>"Patient Add" ,'success' => $success ,'error' => $error);

				//print_r($data);die();

				$this->load->view('templates/header');

				$this->load->view('add_patient',$data);

				$this->load->view('templates/footer');

			}	

		}

		else{

			$this->load->view('templates/header');

		    $this->load->view('add_patient');

            $this->load->view('templates/footer');

		}

		

		

	}

	

	

	

	 /* @method : send_mail

     * @params: $id

     * @desc: send_mail method is used to confirmation mail send

     */

		public function send_mail($email) { 

		$from_email = "matainja009@gmail.com"; 

		$to_email = $email; 

		

		$this->email->from($from_email, 'HCARE Group'); 

		$this->email->to($to_email);

		$this->email->subject('Registration Confirmation Email'); 

		$this->email->message('Thank you for registration.'); 

		

		//Send mail 

		if($this->email->send()) 

		return true;

		else 

		return FALSE;

		}

    /* @method : edit_patient

     * @params: $id

     * @desc: edit_patient method is used for update patient details

     */

	public function edit_patient($id){

        $res = $this->Patient_model->get_patient($id);

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() === FALSE){

            $data = array("title"=>"Edit Physican", "phy" => $res);

            $this->load->view('edit_patient',$data);

        }else{

            $this->Patient_model->edit($id);

            redirect('patient/view_patient', 'refresh');

        }

	}

    /* @method : view_patient

     * @params:

     * @desc: view_patient method is used for display patient details

     */

	public function view_patient(){

		$result = $this->Patient_model->view_details();

		$this->load->view('templates/header');

		$data = array("title"=>"Edit Physican", "physican"=>$result);

		$this->load->view('view_patient',$data);

		 $this->load->view('templates/footer');

	}

    /* @method : accept_invite

     * @params:

     * @desc: accept_invite method is used for accept invitation for patient and save patient data

     */

    public function accept_invite($code){

        $this->form_validation->set_rules('username', 'user name', 'required');

        $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');

        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');

        $checkCode = $this->Patient_model->checkCode($code);

        if(!empty($checkCode)){

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('templates/header');

                $data = array("title"=>"Patient invite" ,'code' => $code ,'patientdata' => $checkCode);

                $this->load->view('accept_invite',$data);

                $this->load->view('templates/footer');

            }else {

                $referId = $checkCode->userid;

                $result = $this->Patient_model->add_patient_invite($referId);

                $success ="";

                $error = "";

                if ($result == TRUE) {

                    $success = "Patient details has been saved successfully";

                }

                $data = array('code' => $code,'success' => $success ,'error' => $error,'patientdata' => $checkCode );

                $this->load->view('templates/header');

                $this->load->view('accept_invite', $data);

                $this->load->view('templates/footer');

            }

        }else{

            $error = "Their is some error with your invitation code, please contact to admin";

            $data = array('code' => $code, 'error' => $error);

            $this->load->view('templates/header');

            $this->load->view('invitation_code_error', $data);

            $this->load->view('templates/footer');

        }

    }

    /* @method : get_advice

     * @params:

     * @desc: get_advice method is used for fetching  advice for patient

     */

    public function get_advice(){

        $list = $this->Patient_model->get_advice_for_patient();

        $this->load->view('templates/header');

        $data = array("title"=>"Patient Advice",'list' => $list);

        $this->load->view('patient_advice',$data);

        $this->load->view('templates/footer');

    }

    /* @method : patient_recommendation

     * @params:

     * @desc: patient_recommendation method is used for giving patient recommendation

     */

    public function patient_recommendation(){

        $this->form_validation->set_rules('advice', 'Advice', 'required');

        $checkCode = $this->Patient_model->get_patient_booking_details();

        if(!empty($checkCode)){

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('templates/header');

                $data = array("title"=>"Patient invite" ,'patientdata' => $checkCode);

                $this->load->view('patient_recommendation',$data);

                $this->load->view('templates/footer');

            }else {

                $result = $this->Patient_model->patient_advices();

                $success ="";

                $error = "";

                if ($result == TRUE) {

                    $success = "Patient details has been saved successfully";

                }

                $data = array('success' => $success ,'error' => $error, 'patientdata' => $checkCode );

                $this->load->view('templates/header');

                $this->load->view('patient_recommendation', $data);

                $this->load->view('templates/footer');

            }

        }else{

            $error = "Their is some error with your invitation code, please contact to admin";

            $data = array('error' => $error);

            $this->load->view('templates/header');

            $this->load->view('patient_recommendation', $data);

            $this->load->view('templates/footer');

        }

    }

    /* @method : procedure_search

     * @params:

     * @desc: procedure_search method is used for find procedure

     */

    public function procedure_search(){

        $this->form_validation->set_rules('search', 'search', 'required');

            if ($this->form_validation->run() == FALSE) {

                $prc = $this->Procedure_model->get_pro_cat_name_wise();

                $result = $this->Procedure_model->get_pro_cat_list();

                $CITY = $this->Specialist_model->get_all_city();

                $this->load->view('templates/header');

                $data = array("title"=>"procedure search" , 'list' => $result ,'city' => $CITY , 'prc' => $prc);

                $this->load->view('procedure_search',$data);

                $this->load->view('templates/footer');

            }

    }

    /* @method : search_result

     * @params:

     * @desc: search_result method is used for get search data

     */

    public function search_result($id = null){

        if(!empty($id)){

            $listing = $this->Procedure_model->get_patient_procedure_search_details_by_id($id);

        }else{

            $listing = '';

        }

        $result = $this->Procedure_model->get_patient_procedure_search_details();

        $procedure = $this->Procedure_model->get_pro_cat_list();

        $CITY = $this->Specialist_model->get_all_city();

        $location = $this->Specialist_model->get_all_location();

        $data = array("title"=>"procedure search" , 'list' => $result , 'listing' => $listing, 'procedure' => $procedure ,'city' => $CITY,'location' => $location);

        $this->load->view('templates/header');

        $this->load->view('list_procedure_search', $data);

        $this->load->view('templates/footer');

    }

    /* @method : filter_search_result

     * @params:

     * @desc: filter_search_result method is used for filter search data

     */

    public function filter_search_result(){

        if(isset($_POST['city'])){

            $result1 = $this->Procedure_model->get_filter_search_details_by_city();

        }else{

            $result1 ='';

        }

        if(isset($_POST['procedure_cat_id'])){

            $result = $this->Procedure_model->get_filter_search_details_by_procedure_id();

        }else{

            $result = '';

        }

        $procedure = $this->Procedure_model->get_pro_cat_list();

        $CITY = $this->Specialist_model->get_all_city();

        $location = $this->Specialist_model->get_all_location();

        $data = array("title"=>"procedure search" , 'lists' => $result , 'list' => $result1,'procedure' => $procedure ,'city' => $CITY,'location' => $location);

        $this->load->view('templates/header');

        $this->load->view('list_procedure_search', $data);

        $this->load->view('templates/footer');

    }

    

    

     /* @method : search

     * @params:

     * @desc: search method is used for search data

     */

    public function search(){

        

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

                "cat_id"=>$this->input->get("procedure_cat"),

                "procedures"=>$out,

                "pro_id"=>$this->input->get("procedure_name"),

            );

        }

        

        $sort = $this->input->post('sortOrder');  

        

        if(isset($sort) && !empty($sort)){

             $prcSearch = $this->Patient_model->get_sp_search_details();

        }

        

        

        $prc = $this->Procedure_model->get_pro_cat_name_wise();

        $data = array("title"=>"search",'prcCat' => $prc, 'prSearch' => $prcSearch );

        $data["pro_cat"]=$this->Procedure_model->get_pro_cat_list();

        $data["posted_data"]=$posted_data;

        $this->load->view('templates/patient_search_header',$data);

        $this->load->view('patient/search',$data);

        $this->load->view('templates/patient_search_footer');

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

    

	public function specialist($id){  

		$data['specialistid'] = $id;

		$resultdata['angular_js_file']="patient.js?preventCache=".time();

		$data['patients'] = $this->Patient_model->angular_specialist_patient($data['specialistid']);   

		$this->load->view('templates/patient_header',$resultdata);

		$this->load->view('patient/specialist',$data);

		$this->load->view('templates/patient_footer');

	}

	

	public function  angular_specialist_patient()

	{

		$postdata = file_get_contents("php://input");

		$request = json_decode($postdata);

		$specialistID = $request->specialistID;

		$specialist_patient = $this->Patient_model->angular_specialist_patient($specialistID);

		//print_r($specialist_patient);die();

		echo json_encode($specialist_patient);

	}

	

	public function review(){	 

		$data['patient_id'] = $this->session->userdata('userid');

		$data['pending_patient_review'] = $this->Patient_model->angular_pending_review($data['patient_id']);

		$resultdata['angular_js_file']="patient.js?preventCache=".time();

		$this->load->view('templates/patient_header',$resultdata);

		$this->load->view('patient/patient_reviews',$data);

		$this->load->view('templates/patient_footer');

	}

	 

	public function angular_recent_review(){

		 $postdata = file_get_contents("php://input");

		 $request = json_decode($postdata);

		 $patient_id = $request->patientid;

		 $patient_review = $this->Patient_model->angular_recent_review($patient_id);

		 echo json_encode($patient_review);

	 } 

	 

     public function medicalhistory(){

		 $appointmentlist = $this->Patient_model->appointment_list();

		$data['medicalHistory'] = $this->Patient_model->medicalHistory($appointmentlist->ID);

		$resultdata['angular_js_file']="patient.js?preventCache=".time();

		$this->load->view('templates/patient_header',$resultdata);

		$this->load->view('patient/medicalhistory');

		$this->load->view('templates/patient_footer');

     }

     public function appointment(){
        $patient_id = $this->session->userdata('userid');  
        $searchAppt = $this->input->post('patientSearch');
        $data['today_appointment'] = $this->Patient_model->today_appointment_list($patient_id); 
        $data['upcoming_appointment'] = $this->Patient_model->upcoming_appointment_list($patient_id); 
        $data['past_appointment'] = $this->Patient_model->past_appointment_list($patient_id);   
        //$data['appointments'] = $this->Patient_model->get_recent_appointments();
        $data["pro_category"]=$this->Procedure_model->get_pro_cat_list();
        $resultdata['angular_js_file']="patient.js?preventCache=".time();
        $this->load->view('templates/patient_header',$resultdata);
        $this->load->view('patient/appointment',$data);
        $this->load->view('templates/patient_footer');
     }

	 

	 public function pending_reviews(){

		 $result = $this->Patient_model->submit_pending_reviews();

		 if($result)

		 {

		 	$response['success'] = 1; 

			$response['error'] = 0;

			$response['message'] = "Your review has been submitted successfully";

		 }else{

			$response['success'] = 0; 

			$response['error'] = 1;

			$response['message'] = "Fail to submit";

		 }

		 echo json_encode($response);

	 }

	 

	 public function past_appointmentList(){

		$patient_id = $this->session->userdata('userid');

	 	$appo_list['past_appo'] = $this->Patient_model->past_appointment_list($patient_id);	 

		print_r($appo_list['past_appo']);

	 }

	 

	 public function cancel_booking(){

		 $bookingId = $this->input->post('ID');

		 $result = $this->Patient_model->cancel_booking($bookingId);

		 if($result){

			$response['success'] = 1; 

			$response['erro'] = 0;

			$response['message'] = "Booking has been canceled successfully";

		 }else{

			$response['success'] = 0; 

			$response['error'] = 1;

			$response['message'] = "Fail to cancel";

		 }

		 echo json_encode($response);

	}

    

	public function past_booking_details(){

		$data['patient_user_id'] = $this->session->userdata('userid');

		$data['bookingid'] = $this->input->post('bookingid');

		$result = $this->Patient_model->past_booking_details($data);



		if(!empty($result)){

			$response['success'] = 1; 

			$response['error'] = 0;

			$response['prescription'] = $result;

		}else{

			$response['success'] = 0; 

			$response['error'] = 1;

			$response['prescription'] = $result;

		}

		echo json_encode($response);

	}

    

     public function booking_alert(){

        $data1["msg"]="You have already Booking on this time , please choose other time for booking";

        $this->load->view('templates/patient_search_header',$data1);

        $this->load->view('patient/booking_alert',$data1);

        $this->load->view('templates/patient_search_footer');   

        

      }

    

     public function booking_success(){

        $data1["msg"]="Your booking is saved successfully.";

        $this->load->view('templates/patient_search_header',$data1);

        $this->load->view('patient/booking_success',$data1);

        $this->load->view('templates/patient_search_footer');   

        

    }

    

     public function getPatientDetails(){

		 if($this->input->is_ajax_request()){

			  $appointmentlist = $this->Patient_model->appointment_list();

		      $data['medicalHistory'] = $this->Patient_model->medicalHistory($appointmentlist->ID);

              echo json_encode($data);

		}

    }

    public function addMedicalHistory()

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

											            'user_id'=>$this->session->userdata('userid'),

														'date'=>$date,

														'booking_id'=>$this->input->post('bookingid_name'),

														'history_type'=>$this->input->post('history_type'),

														'historytitle'=>$this->input->post('report_name'),

														'desc'=>$this->input->post('desc'),

														'files'=>'assets/patient/history/'.$img['file_name']

														);

											$lastInsertedID=$this->Patient_model->addMedicalHistory($data);

											$resultdata = $this->Patient_model->selectMedicalHistorybyLastID($lastInsertedID);

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

							'user_id'=>$this->session->userdata('userid'),

							'date'=>$date,

							'booking_id'=>$this->input->post('bookingid_name'),

							'history_type'=>$this->input->post('history_type'),

							'historytitle'=>$this->input->post('report_name'),

							'desc'=>$this->input->post('desc'),

							

							);

				$lastInsertedID=$this->Patient_model->addMedicalHistory($data);

				$resultdata = $this->Patient_model->selectMedicalHistorybyLastID($lastInsertedID);

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
	public function account(){
		$id = $this->session->userdata('userid');
		$profiledetails = $this->input->post();
		if(isset($profiledetails['save'])){
			$response = $this->Patient_model->edit($id);
				if($_REQUEST > 0){
				$data['profiledetails'] = [];
				$data['isupdate'] = 1; 
   			}
		}
		$data['patientprofile'] = $this->Patient_model->get_patient($id);	
		$this->load->view('templates/app_header');
		$this->load->view('patient/account',$data);	
		$this->load->view('templates/app_footer');
		
		
	}
}

