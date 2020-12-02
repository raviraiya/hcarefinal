<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	

	public function __construct(){

		parent::__construct();

    
		$this->load->helper('url');
        $this->load->model('Procedure_model');
         $this->load->model('Specialist_model');
         $this->load->model('Patient_model');
		$this->load->helper('string');

		$this->load->library('session');

		$this->load->library('email');

		$this->load->helper('form');

		$this->load->library('form_validation');

	}

    

    

    

    public function index(){
        
        $search = $this->input->get('procedure_cat', TRUE);   
        
        //$search = $this->input->post('patientSearch');
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
        $this->load->view('front/newsearch',$data);
        $this->load->view('templates/search_footer');

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

      

    }

    

     /* @method : book_specialist

     * @params:

     * @desc: book_specialist method is used for booking specialist data

     */

      public function book_specialist(){
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

     public function appointment(){
         
       $searchAppt = $this->input->post('patientSearch');
       
            $data['appointments'] = $this->Patient_model->get_recent_appointments();
       
        $data["pro_category"]=$this->Procedure_model->get_pro_cat_list();

        $resultdata['angular_js_file']="patient.js?preventCache=".time();

        $this->load->view('templates/patient_header',$resultdata);

        $this->load->view('patient/appointment',$data);

        $this->load->view('templates/patient_footer');
     }

    public function check_logged_user(){
       
      echo $user_id = $this->session->userdata("userid");
           if(!empty($user_id)){ 
                echo "true"; exit; 
            }else{
            echo "false";
           }
           
    }
    
    /* @method : book_specialist

     * @params:

     * @desc: book_specialist method is used for booking specialist data

     */

      public function success(){
            $data1 = array("title"=>"Book Appointment");
            $data1["msg"]="Your appointment request has booked. ";
            $this->load->view('templates/patient_header',$data1);

            $this->load->view('patient/booking_success',$data1);

            $this->load->view('templates/patient_footer');

    }
    
    
    public function booking_alert(){
        $data1["msg"]="You have already Booking at this time , please choose other time for booking . ";
        $this->load->view('templates/patient_search_header',$data1);
        $this->load->view('front/booking_alert',$data1);
        $this->load->view('templates/patient_search_footer');   
        
    }
    

}

