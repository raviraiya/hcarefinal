<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Specialist extends H_Controller {

    public function __construct(){
        parent::__construct();

        $this->check_logged_in();

        $this->check_for_usertype("specialist");

        $this->load->model('specialist_model');

        $this->load->helper('url');

        $this->load->helper('form');

        $this->load->library('image_lib');

        $this->load->library('upload');

        $this->load->library('session');

        $this->load->library('form_validation');

        $this->load->library('email');

        $this->load->model('Procedure_model');

        $this->load->model('Reviews_model');

        $this->load->model('procedure_cat_model');

        $this->load->model('staff_model');

        $this->load->model('staff_cat_model');

        $this->load->model('hospital_model');

        $this->load->library('pagination');
    }

    public function  index(){
        $today_appt=$this->specialist_model->get_today_appointment_count();

        $lastweek_appt=$this->specialist_model->get_lastweek_appointment_count();

        $pendingPrescriptions=$this->specialist_model->get_dashboard_pending_prescriptions(); 

        $total_proced=$this->specialist_model->get_listed_procedures();

        $current_hrs_patients=$this->specialist_model->get_current_time_patients();

        $specialist_review = $this->specialist_model->get_dashboard_reviewdata();

        $specialist_hospital = $this->specialist_model->specialist_hospital($this->session->userdata('userid'));         

        $data = array(
                    "title"=>"Welcome Specialist", 
                    "today_appt"=>$today_appt,"total_proced"=>$total_proced,
                    "current_hrs_patients"=>$current_hrs_patients,  
                    "specialist_reviews"=>$specialist_review, 
                    'lastweek_appt'=>$lastweek_appt, 
                    'pendingPrescriptions'=>$pendingPrescriptions,
                    'specialist_hospital'=>$specialist_hospital
                );

        $this->load->view('templates/app_header',$data);

        $this->load->view('specialist/dashboard',$data);

        $this->load->view('templates/app_footer');
    }

    public function pending_prescriptions(){
        $data['pendingPrescriptions']=$this->specialist_model->get_pending_prescriptions();

        $this->load->view('templates/app_header',$data);

        $this->load->view('specialist/pending_prescriptions',$data);

        $this->load->view('templates/app_footer');
    }

    public function patients(){
        $specialistid = $this->session->userdata('userid');

        $patient_details=$this->specialist_model->patient_details($specialistid);

        $resultdata['category']=$this->specialist_model->categoryList();

        $resultdata['angular_js_file']="specialist.js?preventCache=".time();        

        $this->load->view('templates/app_header',$resultdata);

        $this->load->view('specialist/patients',$resultdata);

        $this->load->view('templates/app_footer');
    }

    public function dataList(){
        $data=$this->specialist_model->getBookingdetails();

        echo json_encode($data);
    }

    public function ajaxData(){
        if($this->input->is_ajax_request()){
            if($this->input->post('tag') == 'procedurecategory'){
                $procedurecategoryDetails = $this->specialist_model->masterprocedurecategory();                

                if($procedurecategoryDetails){

                    $response['success'] = 1;

                    $response['error'] = 0;

                    $response['procedurecategory'] = $procedurecategoryDetails;
                }else{
                    $response['success'] = 0;

                    $response['error'] = 1;

                    $response['procedurecategory'] = $procedurecategoryDetails;
                }

                echo json_encode($response); 

                exit(0);
            }           

            if($this->input->post('tag') == 'reportChartList'){
                $oldNewStr = '';

                $bookAppointmentStr = '';

                $reportdata = array();

                $reportChartListData = $this->specialist_model->reportFetch(); 

                foreach($reportChartListData as $report){

                    $reportdata['display_date'] = $report->display_date;

                    $reportdata['total_appt'] = (int)$report->total_appt; 

                    $reportdata['cancel_appt'] = (int)$report->cancel_appt;  

                    $reportdata['old_patient'] = (int)$report->old_patient; 

                    $reportdata['new_patient'] = (int)$report->new_patient;                     

                    $chartdata[] = $reportdata;

                    $reportdata = array();
                }

                echo json_encode($chartdata);   

                exit(0);
            }

            if($this->input->post('tag') == 'reportChartListAll'){
                $reportChartListData = $this->specialist_model->reportFetchAll();

                echo json_encode($reportChartListData); 
            }
        }
    }

    public function specialistdata(){
        //$data=$this->specialist_model->get_specialist_Booking_details();
        $specialistid = $this->session->userdata('userid');

        $total_patient_details = $this->specialist_model->patient_details($specialistid);

        $config = array();
        /*$config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'offset';*/
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        $config['use_page_numbers'] = TRUE;
        
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $config["base_url"] = base_url().'specialist/patients/';
        $config["total_rows"] = count($total_patient_details);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

        $this->pagination->initialize($config);
        //$pageLimit = PAGE_PER_NO*$id;

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : '0';        

        $patient_details=$this->specialist_model->patient_details($specialistid,$config["per_page"], $page);

        //$patient_details['link'] = $this->pagination->create_links();     

        echo json_encode($patient_details);
    }

    public function register(){
        $this->form_validation->set_rules('username','Name','trim|required');

        $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[huser.email]');

        $this->form_validation->set_rules('password','Password','trim|required');

        $this->form_validation->set_rules('repassword','Re Type Password','trim|required|matches[password]');

        if($this->form_validation->run() == TRUE)

        {$errors = array();

            $uploadFiles = array(); 

            $files = array();               

            $uploadFiles = $_FILES;

            $registrationID = $this->specialist_model->specialist_registration();           

            $files['userid'] = $registrationID; 

            foreach($uploadFiles as $key => $value){
                $config = array(

                    'upload_path' => './documentation/specialist/',

                    'allowed_types' => "jpg|png|jpeg|pdf|doc|docx",

                    'file_name' => 'specialist_doc_'.time()
                );

                if($key == "licencedoc"){
                    $files['licence_doc'] = $config['file_name'];
                }

                if($key == "iddoc"){
                    $files['id_doc'] = $config['file_name'];
                }

                $this->upload->initialize($config);

                if(!$this->upload->do_upload($key)){
                    $errors[] = $this->upload->display_errors();
                }
            }

            if(empty($errors)){
                $documentID = $this->specialist_model->specialist_docadd($files);
            }

            if($registrationID > 0 && $documentID > 0){
                $receivermail = $this->input->post('email');

                if($this->send_mail($receivermail)){
                    //$this->session->set_flashdata('success','Your specialist account has been successfully created.');

                    //redirect(base_url('specialist/registration'));

                    $data = array("title"=>"Hcare Specialist Resigrataion");

                    $this->load->view('templates/header');

                    $this->load->view('thanksforregistration');

                    $this->load->view('templates/footer');
                }
            }
        }else{
            $data = array("title"=>"Hcare Specialist Resigrataion");

            $this->load->view('templates/header');

            $this->load->view('specialistresigrataion');

            $this->load->view('templates/footer');
        }   
    }

    public function send_mail($email) { 
        $from_email = "matainja009@gmail.com"; 

        $to_email = $email;     

        $this->email->from($from_email, 'HCARE Group'); 

        $this->email->to($to_email);

        $this->email->subject('Registration Confirmation Email'); 

        $this->email->message('Thank you for registration.'); 

        if($this->email->send()) 
            return true;
        else 
            return FALSE;
    }

    public function appointment(){
        $data = array();

        $details = array();

        $appointmentList = array();

        $slotwiseAppointment = array();

        $index = 0;

        $appointmentSlot = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23);

        $suffix = $this->datesuffix(date('d'));

        $data['todaysdate'] = date('d').$suffix.date('F').' ,'.date('Y');

        $appointmentlist = $this->specialist_model->appointment_list();

        $data['totalpatient'] = count($appointmentlist);

        $data['procedure'] = $this->specialist_model->procedure();      

        if(!empty($appointmentlist)){
            foreach($appointmentlist as $appointment){
                if((int)$appointment->booking_time == $appointmentSlot[0]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['00:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[1]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['01:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[2]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['02:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[3]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['03:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[4]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['04:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[5]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['05:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[6]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['06:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[7]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['07:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[8]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['08:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[9]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['09:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[10]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['10:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[11]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['11:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[12]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['12:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[13]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['01:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[14]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['02:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[15]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['03:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[16]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['04:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[17]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['05:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[18]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['06:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[19]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['07:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[20]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['08:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[21]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['09:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[22]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['10:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[23]){
                    $details['bookingID'] = $appointment->ID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['11:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }
            }
            $data['slotwiseAppointment'] = $slotwiseAppointment;
        }else{
            $data['slotwiseAppointment'] = array();
        }

        if($this->input->is_ajax_request()){
            if($this->input->post('tag') == 'procedurecategory'){
                $procedurecategoryDetails = $this->specialist_model->category();

                if($procedurecategoryDetails){
                    $response['success'] = 1;

                    $response['error'] = 0;

                    $response['procedurecategory'] = $procedurecategoryDetails;
                }else{
                    $response['success'] = 0;

                    $response['error'] = 1;

                    $response['procedurecategory'] = 0;
                }

                echo json_encode($response);

                exit(0);
            }else if($this->input->post('tag') == 'checkup'){
                $checkup['booking_id'] = $this->input->post('bookingid');

                $checkup['patient_id'] = $this->input->post('patientid');

                $checkup['temp'] = $this->input->post('temperature');

                $checkup['heartbit'] = $this->input->post('heartbeat');

                $checkup['BD'] = $this->input->post('bloodpreassure');

                $checkup['BG'] = $this->input->post('bloodsugar');

                $checkup['weight'] = $this->input->post('weight');

                $checkup['water_level'] = $this->input->post('waterlevel');

                $checkup['body_fat'] = $this->input->post('bodyfat');

                $checkup['date'] = date('Y-m-d');               

                $checkupDetails = $this->specialist_model->checkup_details($checkup);

                if($checkupDetails){
                    $response['success'] = 1;

                    $response['error'] = 0;

                    $response['message'] = "Checkup details added successfully.";
                }else{
                    $response['success'] = 0;

                    $response['error'] = 1;

                    $response['message'] = "Fail to save checkup details.";
                }

                echo json_encode($response);

                exit(0);
            }else if($this->input->post('tag') == 'prescription'){
                $prescriptionData = json_decode($this->input->post('prescription'));

                $bookingid = $this->input->post('bookingid');

                $patientid = $this->input->post('patientid');

                $flag=$this->input->post('flagvar');

                foreach($prescriptionData as $value){
                    $temp['bookingid'] = $bookingid;

                    $temp['day_time_type'] = $value[0];

                    $temp['dose'] = $value[1];

                    $temp['Details'] = $value[2];

                    $prescription[] = $temp;
                }

                $prescriptionDetails = $this->specialist_model->prescription_details($prescription,$flag,$bookingid);

                if($prescriptionDetails){
                    $response['success'] = 1;

                    $response['error'] = 0;

                    $response['message'] = "Prescription details added successfully.";
                }else{
                    $response['success'] = 0;

                    $response['error'] = 1;

                    $response['message'] = "Fail to save prescription details.";
                }

                echo json_encode($response);

                exit(0);
            }
        }

        $data['title'] = "Hcare Specialist Appoinment";

        $this->load->view('templates/app_header');

        $this->load->view('specialist/appointment', $data);

        $this->load->view('templates/app_footer');
    }

    public function datesuffix($date){ 
        if($date >= 1 && $date <= 31){
            if ($date >= 11 && $date <= 13){
                return "th";
            }
        }else{
            switch ($date % 10) {
                case 1:  return "st";

                case 2:  return "nd";

                case 3:  return "rd";

                default: return "th";
            }
        }
    }     

    public function settings() {
        $sucess = '';

        $errro = '';

        $generalInfo = $this->input->post('generalInfo');

        $slots = $this->specialist_model->get_time_slots();

        if(isset($generalInfo)){

           $save = $this->specialist_model->save_sp_general_info();

        }

        $educationInfo = $this->input->post('educationInfo');

        if(isset($educationInfo)){
            $save = $this->specialist_model->save_sp_educationInfo();            

            if($save){
                $sucess = "Education information saved successfully"; 
            }else{
               $errro = "some error has occurred" ;
            }
        }

        $specialistLicence = $this->input->post('specialistLicence');

        if(isset($specialistLicence)){
            $save = $this->specialist_model->save_sp_licence_info();
        }

        $editableWorkingHrs = $this->input->post('editableWorkingHrs');

        if(isset($editableWorkingHrs)){
            $save = $this->specialist_model->save_editable_working_hrs();

            $sucess = "Working hrs has been saved";
        }        

        $user_id = $this->session->userdata('userid');        

        $this->db->select('see_children');

        $this->db->from('hspecialist');

        $this->db->where('userid', $user_id);

        $child = $this->db->get()->row();       

        $data = array("title"=>"Settings", 'success' => $sucess, 'error' => $errro , 'seeChild' => $child, 'slots' => $slots, 'angular_js_file'=>"specialist.js?preventCache=".time() );

        $this->load->view('templates/app_header',$data);

        $this->load->view('specialist/settings',$data);

        $this->load->view('templates/app_footer');
    }

    public function account(){
        $sucess = '';

        $errro = '';

        $setting = $this->input->post('password-setting');

        if(isset( $setting)){

            $acct = $this->user->update_password();

            if($acct){

                $sucess = 'Password has been changed successfully';

            }

        }

        $data = array("title"=>"Account", 'success' => $sucess, 'error' => $errro );

        $this->load->view('templates/app_header');

        $this->load->view('specialist/account', $data);

        $this->load->view('templates/app_footer');
    }

    public function bulk_delete_procedure(){
        $procedureids = $this->input->post('procedureid');       
        
        $result = $this->Procedure_model->bulk_delete_procedure($procedureids);

        if($result){

            $response['success'] = 1;

            $response['error'] = 0;

            $response['message'] = "Procedure deleted successfully.";

        }else{

            $response['success'] = 0;

            $response['error'] = 1;

            $response['message'] = "Fail to delete procedure.";

        }
        echo json_encode($response);
    }

    public function delete_procedure() {
        $procedureid = $this->input->post('procedureid');

        $result = $this->Procedure_model->procedure_delete($procedureid);

        if($result){
            $response['success'] = 1;

            $response['error'] = 0;

            $response['message'] = "Procedure deleted successfully.";
        }else{
            $response['success'] = 0;

            $response['error'] = 1;

            $response['message'] = "Fail to delete procedure.";
        }
        echo json_encode($response);
    }

    public function procedure(){
        $pro_cat=$this->procedure_cat_model->get_categories_dropdown();

        $staff_cat = $this->Procedure_model->get_staff_cat();

        $staff = $this->Procedure_model->get_staff_list();        

        $this->db->select('*');

        $this->db->from('hprocedurecategory');

        $query = $this->db->get();

        $ress= $query->result_array();     

        $sucess = '';

        $errro = '';

        $class = '';

        $classF = '';

        $procedure_name = $this->input->post('procedure_name');

        if(isset($procedure_name) && !empty($procedure_name)){
            $saveData = $this->Procedure_model->save_procedure_data();

            if($saveData){
                $sucess = 'Procedure added successfully';

                $class = "success";

                redirect(base_url('specialist/procedure'));
            }else{
                $errro = 'Procedure not added';

                $classF = "fail";
            }
        }

        $data = array("title"=>"Create Procedure","pro_cat"=> $pro_cat, 'icon' => $ress, 'success' => $sucess, 'error' => $errro , 'class' => $class, 'fail'=> $classF,'angular_js_file'=>"procedure.js" , 'staffCat' => $staff_cat,'staff' => $staff);

        $bookingOstatus = 0;

        $bookingCstatus = 0;       

        $bookingDetails = $this->Procedure_model->procedure_booking_details();

        $pid = $bookingDetails[0]->pid;

        foreach($bookingDetails as $details){
            if($pid == $details->pid){
                if($details->status == 1 || $details->status == 0){
                    $bookingOstatus += 1;
                }else if($details->status == -1){
                    $bookingCstatus += 1;
                }
            }else{
                $data['bookingStatus'][$pid]['oStatus'] = $bookingOstatus;

                $data['bookingStatus'][$pid]['cStatus'] = $bookingCstatus;

                $bookingOstatus = 0;

                $bookingCstatus = 0;

                if($details->status == 1 || $details->status == 0){
                    $bookingOstatus += 1;
                }else if($details->status == -1){
                    $bookingCstatus += 1;
                }

                $pid = $details->pid;
            }
        }

        $total_procedure = $this->Procedure_model->list_procedure();

        $config = array();
        /*$config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'offset';*/
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        $config['use_page_numbers'] = TRUE;
        
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $config["base_url"] = base_url().'specialist/procedure/';
        $config["total_rows"] = count($total_procedure);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

        $this->pagination->initialize($config);
        //$pageLimit = PAGE_PER_NO*$id;

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : '0';
        $data['procedureDetails'] = $this->Procedure_model->list_procedure($config["per_page"], $page);        

        $data['link'] = $this->pagination->create_links();
        $data['bookingStatus'][$pid]['oStatus'] = $bookingOstatus;
        $data['total_procedure'] = $total_procedure;
        $data['bookingStatus'][$pid]['cStatus'] = $bookingCstatus;

        $data["owl_version"]="1.3";

        $this->load->view('templates/app_header',$data);

        $this->load->view('procedure/create',$data);

        $this->load->view('templates/app_footer');
    }

    public function appointmentFilter(){
        $data = array();

        $details = array();

        $appointmentlist = array();

        $slotwiseAppointment = array();

        $index = 0;

        $appointmentSlot = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23);

        $suffix = $this->datesuffix(date('d'));

        $filterDate = $this->input->post('datepicker');

        $data['todaysdate'] = date('d').$suffix.date('F').' ,'.date('Y');

        $data['filterdate'] = date('d', strtotime($filterDate)).$suffix.date('F', strtotime($filterDate)).' ,'.date('Y', strtotime($filterDate));

        $appointmentlist = $this->specialist_model->appointmentFilter();

        $data['totalpatient'] = count($appointmentlist);

        if(is_array($appointmentlist)){
            foreach($appointmentlist as $appointment){
                if((int)$appointment->booking_time == $appointmentSlot[0]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['00:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[1]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['01:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[2]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['02:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[3]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['03:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[4]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['04:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[5]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['05:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[6]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['06:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[7]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['07:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[8]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['08:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[9]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['09:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[10]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['10:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[11]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['11:00 AM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[12]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['12:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[13]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['01:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[14]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['02:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[15]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['03:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[16]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['04:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[17]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['05:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[18]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['06:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[19]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['07:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[20]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['08:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[21]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['09:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[22]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['10:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }else if((int)$appointment->booking_time == $appointmentSlot[23]){
                    $details['bookingID'] = $appointment->hbookingID;

                    $details['patientID'] = $appointment->patient_user_id;

                    $details['name'] = $appointment->fname.' '.$appointment->lname;

                    $details['pic'] = $appointment->picture;

                    $slotwiseAppointment['11:00 PM'][$index] = $details;

                    $index++;

                    $details = array();
                }
            }
        }

        $data['slotwiseAppointment'] = $slotwiseAppointment;

        echo json_encode($data);
    }

    public function getPatientDetails(){
        $checkuphistory = array();

        $data['patientDetails'] = $this->specialist_model->getPatientDetails();

        $data['checkupDetails'] = $this->specialist_model->getPatientcheckupDetails();

        $data['pastcheckupDetails'] = $this->specialist_model->getPatientpastcheckupDetails();

        $data['medicalHistory'] = $this->specialist_model->medicalHistory();    

        foreach($data['checkupDetails'] as $checkupdetails){
            foreach($checkupdetails as $key=>$value){
                $checkuphistory['ID'] = $checkupdetails->ID;

                $checkuphistory['booking_id'] = $checkupdetails->booking_id;

                $checkuphistory['patient_id'] = $checkupdetails->patient_id;

                $checkuphistory['date'] = $checkupdetails->date;

                $checkuphistory['temp'] = $checkupdetails->temp;

                $checkuphistory['heartbit'] = $checkupdetails->heartbit;

                $checkuphistory['BD'] = $checkupdetails->BD;

                $checkuphistory['BG'] = $checkupdetails->BG;

                $checkuphistory['weight'] = $checkupdetails->weight;

                if(!empty($data['pastcheckupDetails']) && $data['pastcheckupDetails'][0]->water_level > 0){
                    $waterlevel = ceil(($checkupdetails->water_level/$data['pastcheckupDetails'][0]->water_level)*100);

                    $checkuphistory['water_level'] = $waterlevel;//$checkupdetails->water_level;
                }else{
                    $checkuphistory['water_level'] = $checkupdetails->water_level;
                }

                if(!empty($data['pastcheckupDetails']) && $data['pastcheckupDetails'][0]->body_fat > 0){
                    $bodyfat = ceil(($checkupdetails->body_fat/$data['pastcheckupDetails'][0]->body_fat)*100);
                    $checkuphistory['body_fat'] = $bodyfat;//$checkupdetails->body_fat;<br />
                }else{
                    $checkuphistory['body_fat'] = $checkupdetails->body_fat;
                }
            }
        }

        $data['checkupUDetails'] = $checkuphistory;

        echo json_encode($data);
    }

    public function updatebooking(){
        $bookingid = $this->input->post('bookingid');

        if($this->input->post('tag')) { $tag = $this->input->post('tag');}else{$tag = 0;}

        $result = $this->specialist_model->updatebooking($bookingid,$tag);

        if($result){
            $response['success'] = 1;

            $response['error'] = 0;

            $response['message'] = "Booking details updated successfully.";
        }else{
            $response['success'] = 0;

            $response['error'] = 1;

            $response['message'] = "Fail to update booking details.";
        }
        echo json_encode($response);
    }

    public function procedure_list(){
        $bookingOstatus = 0;

        $bookingCstatus = 0;

        $data['procedureDetails'] = $this->Procedure_model->list_procedure();

        $bookingDetails = $this->Procedure_model->procedure_booking_details();

        $pid = $bookingDetails[0]->pid;

        foreach($bookingDetails as $details){
            if($pid == $details->pid){
                if($details->status == 1 || $details->status == 0){
                    $bookingOstatus += 1;
                }else if($details->status == -1){
                    $bookingCstatus += 1;
                }
            }else{
                $data['bookingStatus'][$pid]['oStatus'] = $bookingOstatus;

                $data['bookingStatus'][$pid]['cStatus'] = $bookingCstatus;

                $bookingOstatus = 0;

                $bookingCstatus = 0;

                if($details->status == 1 || $details->status == 0){
                    $bookingOstatus += 1;
                }else if($details->status == -1){
                    $bookingCstatus += 1;
                }

                $pid = $details->pid;
            }
        }

        $data['bookingStatus'][$pid]['oStatus'] = $bookingOstatus;

        $data['bookingStatus'][$pid]['cStatus'] = $bookingCstatus;

        $this->load->view('templates/header');

        $this->load->view('all_procedure',$data);

        $this->load->view('templates/footer');
    }    

    public function staff(){
        $data['categoryList'] = array();

        if($this->staff_cat_model->get_cat_list()){
            $data['categoryList'] = $this->staff_cat_model->get_cat_list();
        }

        $data['angular_js_file']="staffCtrl.js?preventCache=".time();   

        $this->load->view('templates/app_header', $data);

        $this->load->view('specialist/staff', $data);

        $this->load->view('templates/app_footer');
    }

    public function get_staff_list(){
        $list = $this->staff_model->get_staff_list();

        echo json_encode($list);
    }

    public function add_staff(){
        $this->form_validation->set_rules('staff_name', 'Staff Name', 'required');

        $this->form_validation->set_rules('staff_cat_id', 'Staff Category', 'required');

        if ($this->input->is_ajax_request()){
            if($this->form_validation->run()){
                $response = array();

                $error = '';

                $uploadedfiles = $_FILES;

                $fileName = 'staff_'.time().$uploadedfiles['staffpic']['name'];

                $config = array(

                    'upload_path' => './assets/specialist/staff/',

                    'allowed_types' => "jpg|png|jpeg|",

                    'file_name' => $fileName

                );

                $data['userid'] = $this->session->userdata('userid');

                $data['staff_name'] = $this->input->post('staff_name');

                $data['staff_cat_id'] = $this->input->post('staff_cat_id');

                $data['other_info'] = $this->input->post('other_info');

                $data['staff_pic'] = "assets/specialist/staff/thumb/100_".$config['file_name'];

                $this->upload->initialize($config);

                if($this->upload->do_upload('staffpic')){
                    $result = $this->staff_model->add_staff($data);

                    $uploadedDetails = $this->upload->data();                   

                    $imageUrl = './assets/specialist/staff/'.$uploadedDetails['file_name'];

                    $des_imageUrl_100 ='./assets/specialist/staff/thumb/'.'100_'.$uploadedDetails['file_name'];        

                    resize_image($imageUrl, $des_imageUrl_100, 100, 100);
                }else{
                    $error = $this->upload->display_errors();
                }

                if($result){
                    $response['success'] = 1;

                    $response['error'] = 0;

                    $response['message'] = "Staff added successfully.";
                }else{
                    $response['success'] = 0;

                    $response['error'] = 1;

                    $response['message'] = $error;
                }

                echo json_encode($response);
            }
        }
    }

    public function get_staff_details(){
        $staff = array();

        $staffid = $this->input->post('staffid');

        $details = $this->staff_model->get_staff($staffid);

        foreach($details as $detail){
            $staff['id'] = $detail->ID;

            $staff['category_id'] = $detail->staff_cat_id;

            $staff['staff_name'] = $detail->staff_name;

            $staff['staff_cat_name'] = $detail->staff_cat_name;
        }

        echo json_encode($staff);
    }

    public function staff_edit(){
        $this->form_validation->set_rules('staff_name', 'Staff Name', 'required');

        $this->form_validation->set_rules('staff_cat_id', 'Staff Category', 'required');

        if($this->input->is_ajax_request()){
            if ($this->form_validation->run()){
                $response = array();

                $error = '';

                $uploadedfiles = $_FILES;

                $id = $this->input->post('ID');

                $data['userid'] = $this->session->userdata('userid');

                $data['staff_name'] = $this->input->post('staff_name');

                $data['staff_cat_id'] = $this->input->post('staff_cat_id');

                $data['other_info'] = $this->input->post('other_info');

                if(!empty($_FILES)){
                    $fileName = 'staff_'.time().$uploadedfiles['staffpic']['name'];

                    $config = array(
                        'upload_path' => './assets/specialist/staff/',

                        'allowed_types' => "jpg|png|jpeg|",

                        'file_name' => $fileName
                    );

                    $data['staff_pic'] = "assets/specialist/staff/thumb/100_".$config['file_name'];

                    $this->upload->initialize($config);

                    if($this->upload->do_upload('staffpic')){
                        $result = $this->staff_model->edit_staff($id, $data);

                        $uploadedDetails = $this->upload->data();                   

                        $imageUrl = './assets/specialist/staff/'.$uploadedDetails['file_name'];

                        $des_imageUrl_100 ='./assets/specialist/staff/thumb/'.'100_'.$uploadedDetails['file_name'];         

                        resize_image($imageUrl, $des_imageUrl_100, 100, 100);
                    }else{
                        $error = $this->upload->display_errors();
                    }
                }else{
                    $result = $this->staff_model->edit_staff($id, $data);
                }

                if($result){
                    $response['success'] = 1;

                    $response['error'] = 0;

                    $response['message'] = "Staff details updated successfully.";
                }else{
                    $response['success'] = 0;

                    $response['error'] = 1;

                    $response['message'] = $error;
                }

                echo json_encode($response);
            }
        }
    }

    public function staff_delete(){
        if($this->input->is_ajax_request()){
            $staffid = $this->input->post('staffid');

            $result = $this->staff_model->delete_staff($staffid);

            if($result){
                $response['success'] = 1;

                $response['error'] = 0;

                $response['message'] = "Staff deleted successfully.";
            }else{
                $response['success'] = 0;

                $response['error'] = 1;

                $response['message'] = "Problem in deleting staff details.";
            }

            echo json_encode($response);
        }
    }

    public function hospital(){
        $hospital_id= $this->session->userdata('hospitalid');

        $resultData['hospital_working_hours']= $this->hospital_model->get_hospital_working_info($hospital_id);

        $resultData['hospital_facilities_info']= $this->hospital_model->get_hospital_facilities_info_details($hospital_id);

        $resultData['hospital_services_info']= $this->hospital_model->get_hospital_services_info_details($hospital_id);

        $resultData['hospital_staff_image']= $this->hospital_model->get_hospital_staff_info($hospital_id);

        $hospital_working_hr=array();

        foreach($resultData['hospital_working_hours'] as $hospital_working_hours){$hospital_working_hr[]=$hospital_working_hours->weekid;}

        $resultData['all_weekdays']= $this->hospital_model->get_all_weekday($hospital_working_hr);

        $data["angular_js_file"]="hospital.js?preventCache=".time();

        $this->load->view('templates/app_header',$data);

        $this->load->view('specialist/hospital',$resultData);

        $this->load->view('templates/app_footer');
    }

    public function get_data_staff(){
        $getstaffdetails= $this->hospital_model->get_hospital_staff_info();

        echo json_encode($getstaffdetails);
    }

    public function get_data_hospital(){
        $hospital_id= $this->session->userdata('hospitalid');

        $getstaffdetails= $this->hospital_model->get_hospital_user_info($hospital_id);

        echo json_encode($getstaffdetails);
    }

    public function hospital_update(){
        $hospital_id= $this->session->userdata('hospitalid');

        $imgPhysicalPath = 'assets/hospital/original/';

        $NextimgPhysicalPath ='assets/hospital/';

        $imgDirPath = base_url().'assets/hospital/original/';

        $this->form_validation->set_rules('hospital_name', 'hospital_address Name', 'required|min_length[2]|max_length[50]');

        $this->form_validation->set_rules('hospital_address', 'hospital_address Description', 'required');

        if($this->form_validation->run() == FALSE) {
           redirect(base_url('specialist/hospital'));
        }else { 
            $new_name = time().$_FILES["file_logo"]['name'];

            $config['file_name'] = $new_name;

            $config['upload_path']   = $imgPhysicalPath;

            $config['allowed_types'] = 'gif|jpg|png';

            $config['max_size']      = 3456789;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file_logo')) {
                $data= array(
                    'name' => $this->input->post('hospital_name'),

                    'address '=> $this->input->post('hospital_address'),

                    'email '=> $this->input->post('hospital_email'),

                    'phone '=> $this->input->post('hospital_phone'),

                    'zip '=> $this->input->post('hospital_zip'),
                );
                $result = $this->hospital_model->update_hospital_data($data,$hospital_id);

                if($result){
                    redirect(base_url('specialist/hospital'));
                }
            }else {
                $data= array(
                    'name' => $this->input->post('hospital_name'),

                    'address '=> $this->input->post('hospital_address'),

                    'email '=> $this->input->post('hospital_email'),

                    'phone '=> $this->input->post('hospital_phone'),

                    'zip '=> $this->input->post('hospital_zip'),

                    'logo_url' => $imgPhysicalPath.$new_name
                );

                $this->hospital_model->update_hospital_data($data,$hospital_id);

                $last_id=  $this->session->userdata('hospitalid');

                $data = array('upload_data' => $this->upload->data());

                $id_directory= $NextimgPhysicalPath.$last_id;

                $image_200_200 = $id_directory.'/200*200/';

                if(!is_dir($id_directory))

                    mkdir($id_directory, 0777);

                if(is_file($imgPhysicalPath.$new_name)){
                    if(!is_dir($image_200_200))

                        mkdir($image_200_200, 0777);    

                    $settings = array('w'=>200,'h'=>200,'canvas-color'=>'#FFFFFF','Imrtype'=>'fixed','quality'=>100);

                    $imagepath= $this->customresize($imgPhysicalPath.$new_name,$settings,$image_200_200.$new_name);
                }

                //$this->session->set_flashdata('success','Hospital data is Successfull Updated');

                redirect(base_url('specialist/hospital'));
            }
        }
    }

    public function customresize($imagePath,$opts=null,$dpath){
        if(!isset($opts['quality']))
            $quality = 90; # image quality to use for ImageMagick (0 - 100)

        else
            $quality = $opts['quality'];

        $path_to_convert = '/usr/bin/convert';'convert'; # this could be something like /usr/bin/convert or /opt/local/share/bin/convert

        if(isset($opts['w'])): $w = $opts['w']; endif;

        if(isset($opts['h'])): $h = $opts['h']; endif;

        $filename = md5_file($imagePath);

        $create = true;

        if($create == true):
            if(!empty($w) and !empty($h)):
                list($width,$height) = getimagesize($imagePath);

                $resize = $w;

                if($opts['Imrtype']=='fixed'){
                    $resize = $w."x".$h."\!";
                }elseif($opts['Imrtype']=='height'){
                    $resize = "x".$h;
                }elseif($opts['Imrtype']=='width'){
                    $resize = $w;
                }elseif($opts['Imrtype']=='ratio'){
                    if($width > $height):
                        $resize = $w;
                        if(isset($opts['crop']) && $opts['crop'] == true):
                            $resize = "x".$h;
                        endif;

                    else:
                        $resize = "x".$h;

                        if(isset($opts['crop']) && $opts['crop'] == true):
                            $resize = $w;
                        endif;
                    endif;
                }

                if(isset($opts['iscanvas']) && $opts['iscanvas'] == true):
                    $cmd = $path_to_convert." "."'".$imagePath."'"." -resize ".$resize." -size ".$w."x".$h." xc:".(isset($opts['canvas-color'])?$opts['canvas-color']:"transparent")." +swap -gravity center -composite -quality ".$quality." "."'".$dpath."'";

                else:
                    $cmd = $path_to_convert." "."'".$imagePath."'"." -resize ".$resize." -quality ".$quality." "."'".$dpath."'";

                endif;
            endif;
            $c = exec($cmd);
        endif;

        return $dpath;
    }

    public function get_hospital_image(){
       // $this->session->set_userdata('hospital_id','1');

        $hospital_id= $this->session->userdata('hospitalid');

        $getstaffdetails= $this->hospital_model->get_hospital_image($hospital_id);

        echo $getstaffdetails;
    }

    public function remove_hospital_image(){
        $postdata = file_get_contents("php://input");

        $request = json_decode($postdata);

        $imageid = $request->ID;

        $getstaffdetails= $this->hospital_model->remove_hospital_image($imageid);

        if($getstaffdetails){
            $this->session->set_flashdata('success','Your image successfully deleted');
        }else{
            $this->session->set_flashdata('success','Something Problem');
        }
    }

    public function hospital_image_upload(){
        $hospital_id= $this->session->userdata('hospitalid');

        $imgPhysicalPath = 'assets/hospital/hospitalslider/original/';

        $NextimgPhysicalPath ='assets/hospital/hospitalslider/';

        $imgDirPath = base_url().'assets/hospital/hospitalslider/original/';

        if(!$_FILES) {
            redirect('specialist/hospital');
        }else {
            $new_name = time().$_FILES["file_logo"]['name'];

            $config['file_name'] = $new_name;

            $config['upload_path']   = $imgPhysicalPath;

            $config['allowed_types'] = 'gif|jpg|png';

            $config['max_size']      = 3456789;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file_logo')) {
                redirect('specialist/hospital');
            }else {
                $data= array('hospitalid' => $hospital_id,'picurl'  => $new_name);

                $this->hospital_model->hospital_image_upload($data);

                $last_id=  $this->session->userdata('hospitalid');;

                $data = array('upload_data' => $this->upload->data());

                $id_directory= $NextimgPhysicalPath.$last_id;

                $image_200_200 = $id_directory.'/';

                if(is_file($imgPhysicalPath.$new_name)){
                    $settings = array('w'=>200,'h'=>200,'canvas-color'=>'#FFFFFF','Imrtype'=>'fixed','quality'=>70);

                    $imagepath= $this->customresize($imgPhysicalPath.$new_name,$settings,$image_200_200.$new_name);
                }

                $this->session->set_flashdata('success','Hospital Image added Successfully');

                redirect('specialist/hospital');
            }
        }
    }

    public function update_working_hours(){
        $userid = $_REQUEST['userid'];

        $hospitalid = $_REQUEST['houseid'];

        $dayid = $_REQUEST['dayid'];

        $from_hr = $_REQUEST['from_hr'];

        $to_hr = $_REQUEST['to_hr'];

        $getstaffdetails= $this->hospital_model->hospital_working_hours_add($userid,$hospitalid,$dayid,$from_hr,$to_hr);

        if($getstaffdetails){
            $this->session->set_flashdata('success','Your Working Hours successfully Updated');
        }else{
            $this->session->set_flashdata('success','Something Problem');
        }
    }

    public function get_working_hours_details(){
        $hospital_id= $this->session->userdata('hospitalid');

        //echo $hospital_id;

        $getstaffdetails= $this->hospital_model->get_hospital_working_info($hospital_id);

        //print_r($getstaffdetails);

        echo json_encode($getstaffdetails) ;
    }

    public function delete_hfaciliy(){
        //$house_facility_id = $_REQUEST['hospitalId'];

        $house_facility_id= $this->session->userdata('hospitalid');

        $tag = trim($_REQUEST['tag']);

        $hfacilityDelete= $this->hospital_model->delete_hfacility($house_facility_id, $tag);

        if($hfacilityDelete){    
            $data['message'] ="Success";
        }else{
            $data['message'] ="error";
        }

        echo json_encode($data);
    }

    public function add_hfaciliy(){
        $data= array(
            "userid" =>  $this->session->userdata('userid'),

            "hospitalid"=> $this->session->userdata('hospitalid'),

            "facility_name"=>$_REQUEST['facilityname'],
        );

        $hfacilityadd= $this->hospital_model->add_hfacility($data);

        if($hfacilityadd){
            $this->session->set_flashdata('success','Hospital Facility is Successfull Added');

            $new['message']= "success";
        }else{
            $new['message']= "error";
        }

        echo json_encode($new);
    }

    public function get_hfaciliy_details(){
        $postdata = file_get_contents("php://input");

        $request = json_decode($postdata);

        $hospitalId = array(

            "hospitalid"=>$request->hospitalid

        );

        $hfacilityget= $this->hospital_model->get_hfacility_angular($hospitalId);

        echo json_encode($hfacilityget);
    }

    public function delete_hfaciliy_details(){
        $facilityId = array(

            "ID"=>$_REQUEST['facilityid']

        );

        $hfacilityget= $this->hospital_model->remove_hfacility_angular($facilityId);

        if($hfacilityget){
            $data['message']= "success";
        }else{
            $data['message']= "error";
        }

        echo json_encode($data);
    }

    public function delete_hservice(){
        $house_facility_id = $this->session->userdata('hospitalid');

        $tag = trim($_REQUEST['tag']);

        $hfacilityDelete= $this->hospital_model->delete_hservice($house_facility_id, $tag);     

        if($hfacilityDelete){
            $data['message'] ="Success";
        }else{
            $data['message'] ="error";
        }
        echo json_encode($data);
    }

    public function add_hservice(){
        $data= array(
            "hospitalid"=> $this->session->userdata('hospitalid'),

            "service_name"=>$_REQUEST['servicename'],
        );      

        $hserviceadd= $this->hospital_model->add_hservice($data);
        if($hserviceadd){
            $this->session->set_flashdata('success','Hospital Service is Successfull Added');

            $new['message']= "success";
        }else{
            $new['message']= "error";
        }

        echo json_encode($new);
    }

    public function addHospitalScheduleForADay(){ 
        $day=$_POST['days'];

        $timepickerfrmStatic=$_POST['timepickerfrmStatic'];

        $timepickertoStatic=$_POST['timepickertoStatic'];

        if(!empty($day)){
            //foreach($days as $day)

            $data=array('userid'=>$this->session->userdata('userid'),'hospitalid'=>$this->session->userdata('hospitalid'),'weekday'=>$day,'frm_hrs'=>$timepickerfrmStatic,'to_hrs'=>$timepickertoStatic);

            $getresponce= $this->hospital_model->add_hospital_scheduleForADay($data);

            if($getresponce){

                $new['message']= "success";

              }

            else{

                $new['message']= "error";

            }

            echo json_encode($new);
        }
    }    

    public function review(){
        $resultdata['procedure']=$this->Reviews_model->procedure();

        $resultdata['val']=$this->Reviews_model->category();

        //$resultdata["angular_js_file"]="specialist.js?preventCache=".time();
        $resultdata['angular_js_file']="specialist_review.js?preventCache=".time();   

        $this->load->view('templates/app_header',$resultdata);

        $this->load->view('specialist/review',$resultdata);

        $this->load->view('templates/app_footer');

    }

    public function booking_cancel(){
        if($this->input->is_ajax_request()){ 
            $bookingid = $this->input->post('bookingid');

            $isCancel = $this->specialist_model->cancel_booking($bookingid);

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

    public function report($type){
        $resultdata = array();

        $resultdata['userid'] = $this->session->userdata('userid');

        $resultdata['category']=$this->specialist_model->categoryList();    

        $resultdata['lastweek_appt']=$this->specialist_model->get_lastweek_appointment_count();

        if($type == 'bookedvscancel')
        {
            $resultdata['tag'] = 'booked_vs_cancel';

        }else if($type == 'oldvsnew'){
            $resultdata['tag'] = 'old_vs_new';
        }

        $this->load->view('templates/app_header');

        $this->load->view('specialist/specialistreport', $resultdata);

        $this->load->view('templates/app_footer');
    }

    public function get_reviews(){
        $result=$this->Reviews_model->getdata();

        $resultdata=  array( );

        foreach($result as $val){

            $val1=(array)$val;

            $resultdata[] = array_merge($val1);

        }

        echo json_encode($resultdata);
    }

    public function get_data_facilities(){
        $getstaffdetails= $this->hospital_model->get_hospital_facilities_info();

        $dataarray= array();

        foreach($getstaffdetails as $hfacilities){

            $dataarray['dataarray'][]= $hfacilities->desc; 

        }

        $json_to_string= str_replace("[", "", json_encode($dataarray));

        echo str_replace("]", "", json_encode($json_to_string));
    }     

    public function editprocedure($id){
        $staff_cat = $this->Procedure_model->get_staff_cat();

        $staff = $this->Procedure_model->get_staff_list();

        $pro_cat=$this->procedure_cat_model->get_categories_dropdown();

        $this->db->select('*');

        $this->db->from('hprocedurecategory');

        $query = $this->db->get();

        $ress= $query->result_array();

        $edits = $this->specialist_model->get_procedure_data_for_edit($id);

        $sucess = '';

        $errro = '';

        $class = '';

        $classF = '';       

         $editProcedure = $this->input->post('editProcedure');       

        if(isset($editProcedure) && !empty($editProcedure)){
            $saveData = $this->Procedure_model->update_procedure_data($id);

            if($saveData){
                $sucess = 'Procedure added successfully';

                $class = "success";

                redirect(base_url('specialist/editprocedure/'.$id));
            }else{
                $errro = 'Procedure not added';

                $classF = "fail";
            }
        }       

        $data = array("title"=>"Edit Procedure","pro_cat"=> $pro_cat, 'icon' => $ress, 'success' => $sucess, 'error' => $errro,'angular_js_file'=>"procedure.js" , 'owl_version' => 'owl.carousel.1.3.js',  'staffCat' => $staff_cat,'staff' => $staff, 'proced' => $edits );

         $this->load->view('templates/app_header',$data);

        $this->load->view('specialist/editprocedure',$data);

        $this->load->view('templates/app_footer');    
    }

    public function getSatffDetails(){    
        $staffID = $_REQUEST['staff_id'];

        $saveData = $this->hospital_model->getSatffDetailsByID($staffID);

        echo json_encode($saveData);
    }

    public function medicalHistory(){
        $date = date('Y-m-d');

        if($this->input->post('tag') != 'isImage'){
            unset($_FILES);
        }

        if(isset($_FILES['medicalhistoryFile']['name'])){//die('adsdsdassad');

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

            if ($this->upload->do_upload('medicalhistoryFile')) { 
                $img = $this->upload->data(); 

                //echo $img['file_name'];

                $data=array('patient_id'=>$this->input->post('patientid_name'),

                            'user_id'=>$this->session->userdata('userid'),

                            'date'=>$date,

                            'booking_id'=>$this->input->post('bookingid_name'),

                            'history_type'=>$this->input->post('history_type'),

                            'historytitle'=>$this->input->post('report_name'),

                            'desc'=>$this->input->post('desc'),

                            'files'=>'assets/patient/history/'.$img['file_name']

                            );

                $lastInsertedID=$this->specialist_model->addMedicalHistory($data);

                $resultdata = $this->specialist_model->selectMedicalHistorybyLastID($lastInsertedID);

                if($resultdata){ 
                    $result = array('success'=>1,'error'=>0,'data'=>$resultdata,'message'=>'Medical history Added successfully.');

                     echo json_encode($result);

                }else{
                    $result = array('success'=>0,'error'=>1,'data'=>array(),'message'=>'Failed to add medical history.');

                     echo json_encode($result);
                }   
            }else { $counterror[]=$i;
                $totalValue='('.count($counterror).')';

                $error = array('message' => $this->upload->display_errors().$totalValue);

                print_r($error);
            }    
        }else{
            $data=array('patient_id'=>$this->input->post('patientid_name'),

                'user_id'=>$this->session->userdata('userid'),

                'date'=>$date,

                'booking_id'=>$this->input->post('bookingid_name'),

                'history_type'=>$this->input->post('history_type'),

                'historytitle'=>$this->input->post('report_name'),

                'desc'=>$this->input->post('desc'),
            );

            $lastInsertedID=$this->specialist_model->addMedicalHistory($data);

            $resultdata = $this->specialist_model->selectMedicalHistorybyLastID($lastInsertedID);

            //echo $resultdata; 

            if($resultdata){ 
                $result = array('success'=>1,'error'=>0,'data'=>$resultdata,'message'=>'Medical history Added successfully.');

                echo json_encode($result);

            }else{
                $result = array('success'=>0,'error'=>1,'data'=>array(),'message'=>'Failed to add medical history.');

                echo json_encode($result);
            }
        }
    }   
}