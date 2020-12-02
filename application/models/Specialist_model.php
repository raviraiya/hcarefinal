<?php

class Specialist_model extends CI_Model {

    public function __construct(){

        parent::__construct();

        $this->load->database();

        $this->load->library('session');

        $this->load->library('encrypt');

        $this->load->helper('common');

        //$this->load->library('image_lib');

    }


    public function specialist_hospital($specialist_id){
        $this->db->select("name");
        $this->db->from("hhospital");
        $this->db->where("userid",$specialist_id);
        $query = $this->db->get();
        return $query->row()->name;
    }

    /* @method : add_specialist

     * @params:

     * @desc: add_specialist method is used for adding specialist details

     */

    public function specialist_registration(){

        $data=array(

              'name'=> $this->input->post('name'),

              'password'=> MD5($this->input->post('password')),

              'email'=>  $this->input->post('email'),

              'usertype' => 'specialist',

        );

        $this->db->insert('huser',$data);

        $userID = $this->db->insert_id();

        return $userID;

    }

    

    /* @method : specialistdocadd

     * @params:

     * @desc: specialistdocadd method is used for adding specialist document

     */

    public function specialist_docadd($data = array()){

        $this->db->insert('hdoctordocs',$data);

        $documentID= $this->db->insert_id();

        return $documentID;

    }

    /* @method : get_sp_detail

     * @params:

     * @desc: get_sp_detail method is used for fetching sp detail

     */

    public function get_sp_detail(){

        $user_id = $this->session->userdata('userid');

        $query = "SELECT hsp.picture , hsp.name ,hsp.title , hsp.desc FROM (huser hus INNER JOIN hspecialist hsp ON hus.ID = hsp.userid) WHERE hus.ID = '$user_id' ";

        $data =  $this->db->query($query);

        $rsr = $data->row();

        return $rsr;

    }

    /* @method : save_sp_info

     * @params:

     * @desc: save_sp_info method is used for update specialist details

     */

    public function save_sp_info(){

        $user_id = $this->session->userdata('userid');

      

        if(!empty($_FILES['file']['name'])){

            $config['upload_path']    = './assets/specialist/';                 #the folder placed in the root of project

            $config['allowed_types']  = 'gif|jpg|png|bmp|jpeg';      #allowed types description

            $config["allowed_types"] ="*";

//            $config['max_size']       = '130';                          #max size

//

//            $config['max_width']      = '130';                          #max width

//

//            $config['max_height']     = '200';                          #max height

            $config['encrypt_name']   = true;

            $type = strstr($_FILES['file']['name'], '.' );

            $fileName =  md5(uniqid(mt_rand())).''.$type;

            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if(!$this->upload->do_upload('file')){

                $uploadedDetails = array('error' => $this->upload->display_errors());

            }else{

                $uploadedDetails = $this->upload->data();

            }

            

          

            $imageUrl = './assets/specialist/'.$uploadedDetails['file_name'];

            $des_imageUrl_300 ='./assets/specialist/'.'300_'.$uploadedDetails['file_name'];

            $des_imageUrl_100 ='./assets/specialist/'.'100_'.$uploadedDetails['file_name'];

         

            $resizes300 = resize_image($imageUrl, $des_imageUrl_300,300,300);

            

            $resizes100= resize_image($imageUrl, $des_imageUrl_100,100,100);

        }

        

        if(isset($uploadedDetails['file_name']) && !empty($uploadedDetails['file_name'])){

                $name = $_POST['name'];

                $desc = $_POST['desc'];

                $pic= '/assets/specialist/'.$uploadedDetails['file_name'];

                $data = array(

                    'name' => $name,

                    'desc'=> $desc,

                    'picture' => $pic,

                );

                $this->db->where('userid', $user_id);

                $this->db->update('hspecialist',$data);

                return true;

        }else{

            $name = $_POST['name'];

            $desc = $_POST['desc'];

            $data = array(

                'name' => $name,

                'desc'=> $desc,

            );

            $this->db->where('userid', $user_id);

            $this->db->update('hspecialist',$data);   

             return true;

            

        }

    }

    /* @method : change_child_status

     * @params:

     * @desc: change_child_status method is used for update specialist status for seeing child or not

     */

    public function change_child_status($status){

        $user_id = $this->session->userdata('userid');

        if($status == 'true'){

            $sts = 1;

        }else{

            $sts = 0;

        }

        $data = array(

            'see_children' => $sts,

        );

        $this->db->where('userid', $user_id);

        $this->db->update('hspecialist',$data);

        return true;

    }

    public function get_language_list(){

        $user_id = $this->session->userdata('userid');

        return $data;

    }

    /* @method : save_specialist_langauge

     * @params:

     * @desc: save_specialist_langauge method is used for adding specialist language

     */

    public function save_specialist_langauge($lang){

        $user_id = $this->session->userdata('userid');

        $this->db->select('language');

        $this->db->from('hspecialist');

        $this->db->where('userid', $user_id);

        $data =  $this->db->get()->row();

        $dblang = $data->language;

        

//        print_r($dblang);

        $langs = array();

        if(empty($dblang)){

            $langs[] = $lang;

            $saveLang = json_encode($langs);

        }else{

             $decodeLang = json_decode($dblang);

             array_push($decodeLang ,$lang);

            $saveLang = json_encode($decodeLang);

        }

        $data = array(

            'language' => $saveLang

        );

        $this->db->where('userid', $user_id);

        $this->db->update('hspecialist',$data);

        return true;

    }

    public function save_specialist_specialization($spc){

        $user_id = $this->session->userdata('userid');

        $this->db->select('specialization');

        $this->db->from('hspecialist');

        $this->db->where('userid', $user_id);

        $data =  $this->db->get()->row();

        $dbspecialization = $data->specialization;

        $langs = array();

        if(empty($dbspecialization)){

            $langs[] = $spc;

            $saveLang = json_encode($langs);

        }else{

            $decodeLang = json_decode($dbspecialization);

            array_push($decodeLang ,$spc);

            $saveLang = json_encode($decodeLang);

        }

        $data = array(

            'specialization' => $saveLang

        );

        $this->db->where('userid', $user_id);

        $this->db->update('hspecialist',$data);

        return true;

    }

    public function save_specialist_awards($awrdTxt, $date){

        $user_id = $this->session->userdata('userid');

        $award = array();

        $award['award-text'] = $awrdTxt;

        $award['award-date'] = $date;

        // get award data

        $this->db->select('award');

        $this->db->from('hspecialist');

        $this->db->where('userid', $user_id);

        $data =  $this->db->get()->row();

        $dbaward = $data->award;

        $newAwrd = array();

        if(empty($dbaward)){

            $newAwrd[] = $award;

            $enc = json_encode($newAwrd);

        }else{

            $decodeaward = json_decode($dbaward);

            array_push($decodeaward , $award);

            $enc = json_encode($decodeaward);

        }

        $data = array(

            'award' => $enc,

        );

        $this->db->where('userid', $user_id);

        $this->db->update('hspecialist',$data);

        return true;

    }

    public function save_sp_general_info(){

        $user_id = $this->session->userdata('userid');

//        print_r($this->input->post('dob'));exit;

        $dt= new DateTime($this->input->post('dob'));

       

        $data = array(

                'dob'=>  $dt->format("y-m-d"),

                'address'=> $this->input->post('address'),

                'city'=>  $this->input->post('city'),

                'zip'=>  $this->input->post('zip'),

                'email'=>  $this->input->post('email'),

                'phone'=>  $this->input->post('phone'),

        );

        $this->db->where('userid', $user_id);

        $this->db->update('hspecialist',$data);

        return true;

    }

    public function save_sp_licence_info(){

        $user_id = $this->session->userdata('userid');

        $data = array(

            'licence_no'=> $this->input->post('licence_no'),

            'licence_state'=> $this->input->post('licence_state'),

            'licence_city'=>  $this->input->post('licence_city'),

            'licence_zip'=>  $this->input->post('licence_zip'),

        );

        $this->db->where('userid', $user_id);

        $this->db->update('hspecialist',$data);

        return true;

    }

    public function save_sp_educationInfo(){

        $user_id = $this->session->userdata('userid');

        $edu =  $this->input->post('education');

      

        $from_d = $this->input->post('from_date');

       

        $to_date = $this->input->post('to_date');

        $countEdu = count($edu);

        

        $this->db->where('specialist_id',$user_id);

        $out = $this->db->delete('hspecialisteducation');

        

        if(isset($edu)){

            $total = count($from_d);

           

            for($i = 0; $i < $total ;  $i++) {

                    

                $dtnew = new DateTime($from_d[$i]);

               

                $fromdate = $dtnew->format("y-m-d");

                $dtnew1 = new DateTime($to_date[$i]);

                

                $todate = $dtnew1->format("y-m-d");

             

                $dataedu = array(

                    'specialist_id'=> $user_id,

                    'education' => $edu[$i],

                    'from_date' => $fromdate,

                    'to_date' => $todate,

                );

                $this->db->insert('hspecialisteducation', $dataedu );    

               

            }

            

        }

        return true;

       

    }

    public function get_time_slots(){

        $user_id = $this->session->userdata('userid');

        $this->db->select('*');

        $this->db->from(' hspecialistworkinghrs');

        $this->db->where('userid', $user_id);

        $query = $this->db->get();

        return $query->result_array();

    }

    public function delete_specialist_slots($slot){

        $this->db->where('ID', $slot);

        $this->db->delete('hspecialistworkinghrs');

        return true;

    }

    public function save_editable_working_hrs(){

        $user_id = $this->session->userdata('userid');

        /* data for time slotes  */

        $monday = $this->input->post('mon_slots');

        $tues = $this->input->post('tues_slots');

        $wed = $this->input->post('wed_slots');

        $thus = $this->input->post('thus_slots');

        $fri = $this->input->post('fri_slots');

        $sat = $this->input->post('sat_slots');

        $sunday = $this->input->post('sun_slots');

        if(isset($monday)){

            $total = count($monday);

            for($i=0; $i < $total ;  $i++) {

                $data = array(

                    'userid' => $user_id,

                    'weekday' => 1,

                    'hour' => $monday[$i],

                );

                $this->db->insert('hspecialistworkinghrs',$data);

            }

        }

        if(isset($tues)){

            $total = count($tues);

            for($i=0; $i < $total ;  $i++) {

                $data = array(

                    'userid' => $user_id,

                    'weekday' => 2,

                    'hour' => $tues[$i],

                );

                $this->db->insert('hspecialistworkinghrs',$data);

            }

        }

        if(isset($wed)){

            $total = count($wed);

            for($i=0; $i < $total ;  $i++) {

                $data = array(

                    'userid' => $user_id,

                    'weekday' => 3,

                    'hour' => $wed[$i],

                );

                $this->db->insert('hspecialistworkinghrs',$data);

            }

        }

        if(isset($thus)){

            $total = count($thus);

            for($i=0; $i < $total ;  $i++) {

                $data = array(

                    'userid' => $user_id,

                    'weekday' => 4,

                    'hour' => $thus[$i],

                );

                $this->db->insert('hspecialistworkinghrs',$data);

            }

        }

        if(isset($fri)){

            $total = count($fri);

            for($i=0; $i < $total ;  $i++) {

                $data = array(

                    'userid' => $user_id,

                    'weekday' => 5,

                    'hour' => $fri[$i],

                );

                $this->db->insert('hspecialistworkinghrs',$data);

            }

        }

        if(isset($sat)){

            $total = count($sat);

            for($i=0; $i < $total ;  $i++) {

                $data = array(

                    'userid' => $user_id,

                    'weekday' => 6,

                    'hour' => $sat[$i],

                );

                $this->db->insert('hspecialistworkinghrs',$data);

            }

        }

        if(isset($sunday)){

            $total = count($sunday);

            for($i=0; $i < $total ;  $i++) {

                $data = array(

                    'userid' => $user_id,

                    'weekday' => 7,

                    'hour' => $sunday[$i],

                );

                $this->db->insert('hspecialistworkinghrs',$data);

            }

        }

        return true;

    }

    public function remove_sp_lang($langs){

        $user_id = $this->session->userdata('userid');

        $this->db->select('language');

        $this->db->from('hspecialist');

        $this->db->where('userid' , $user_id);

        $output = $this->db->get()->row();

        $lang = $output->language;

        $arr = json_decode($lang);

        $pos = array_search( $langs , $arr);

        unset($arr[$pos]);

        $newLang = json_encode($arr);

        $data = array(

            'language' => $newLang

        );

        $this->db->where('userid', $user_id);

        $this->db->update('hspecialist',$data);

        return true;

    }

    public function delete_sp_specialization($langs){

        $user_id = $this->session->userdata('userid');

        $this->db->select('specialization');

        $this->db->from('hspecialist');

        $this->db->where('userid' , $user_id);

        $output = $this->db->get()->row();

        $lang = $output->specialization;

        $arr = json_decode($lang);

        $pos = array_search( $langs , $arr);

        unset($arr[$pos]);

        if(!empty($arr)){

            $newLang = json_encode($arr);

        }else{

            $newLang = '';

        }

        $data = array(

            'specialization' => $newLang

        );

        $this->db->where('userid', $user_id);

        $this->db->update('hspecialist',$data);

        return true;

    }

    public function delete_sp_award($langs){

        $user_id = $this->session->userdata('userid');

        $this->db->select('award');

        $this->db->from('hspecialist');

        $this->db->where('userid' , $user_id);

        $output = $this->db->get()->row();

        $lang = $output->award;

        $arr = json_decode($lang);

        $postData = explode(" Year: ", $langs );

        $icnt=0;

        foreach($arr as $arrs) {

            if($postData[0]==$arrs->award_text )

            {

               break;

            }

        $icnt++;

        }

        unset($arr[$icnt]);

        $arr = array_values($arr);

        if(!empty($arr)){

            $newaward = json_encode($arr);

        }else{

            $newaward = '';

        }

        $data = array(

            'award' => $newaward

        );

        $this->db->where('userid', $user_id);

        $this->db->update('hspecialist',$data);

        return true;

    }

    public function delete_sp_edu($id){

        $user_id = $this->session->userdata('userid');

        $this->db->where('ID', $id);

        $this->db->delete('hspecialisteducation');

        return true;

    }

    

    /* @method : appointment_list

     * @params:

     * @desc: appointment_list method is used for fetching specialist

     */

    public function appointment_list(){

        $currentDate = date('Y-m-d');

        $this->db->select('hpatient.fname, hpatient.lname, hpatient.picture, hbooking.*');

        $this->db->from('hbooking');

        $this->db->join('hpatient', 'hpatient.userid = hbooking.patient_user_id');

        $this->db->where('hbooking.specialist_user_id', $this->session->userdata('userid'));    //$data['specialistID']

        $this->db->where('hbooking.booking_date', $currentDate);

        $this->db->where('hbooking.status', 0);

        $this->db->order_by('hbooking.booking_time');

        $query = $this->db->get();

        if($query->num_rows() > 0){

            $appointment = $query->result(); 

            return $appointment;

        }

    }

    

    /* @method : checkup_details

     * @params: $bookingid

     * @desc: checkup_details method is used for fetching patient checkup details based upon booking id

     */

    public function checkup_details($data = array()){

        $query = $this->db->get_where('hpatientcheckup', array('booking_id' => $data['booking_id']));

        if($query->num_rows() > 0){

            $this->db->where('booking_id', $data['booking_id']);

            $this->db->update('hpatientcheckup', $data); 

            if($this->db->affected_rows() > 0){

                return TRUE;

            }else{

                return FALSE;

            }

        }else{

            $this->db->insert('hpatientcheckup', $data);

            $checkupID = $this->db->insert_id();    

            if($checkupID > 0){

                return TRUE;

            }else{

                return FALSE;

            }

        }

    }

    

    /* @method : checkup_details

     * @params: $bookingid

     * @desc: checkup_details method is used for fetching patient checkup details based upon booking id

     */

    public function getPatientcheckupDetails(){

        $result = array();

        $bookingid = $this->input->post('bookingID');

        $query = $this->db->get_where('hpatientcheckup', array('booking_id' => $bookingid));

        if($query->num_rows() > 0){

            $result = $query->result(); 

        }

        return $result;

    }

    

    /* @method : checkup_details

     * @params: $bookingid

     * @desc: checkup_details method is used for fetching patient checkup details based upon booking id

     */

    public function getPatientpastcheckupDetails(){

        $result = array();

        $patientid = $this->input->post('patientID');

        $bookingid = $this->input->post('bookingID');

        $this->db->from('hpatientcheckup');

        $this->db->where(array('patient_id' => $patientid, 'booking_id<' => $bookingid));

        $this->db->order_by("ID", "desc"); 

        $this->db->limit(1);        

        $query = $this->db->get();

        

        if($query->num_rows() > 0){

            $result = $query->result(); 

        }

        return $result;

    }

    

    /* @method : get_today_appointment_count

     * @params:

     * @desc: it will give you total today appointment made and also give you how much appointment has been finished

     */

    public  function get_today_appointment_count()

    {   $currentDate = date('Y-m-d');

        $this->db->select('total_appt,complete_appt,cancel_appt');

        $this->db->from('hspecialist_today_appointment');

        $this->db->where('date', $currentDate);

        $this->db->where('user_id', $this->session->userdata('user_id'));

        $query = $this->db->get();

        if($query->num_rows() > 0){

            $today_appointment = $query->result();

            return $today_appointment;

        }

        return null;

    }

    /* @method : Total Procedure Listed

     * @params:

     * @desc: it will give you Total Procedure Listed

     */

    public function get_listed_procedures()

    {

        $this->db->select('count(*) as total');

        $this->db->from('hprocedure');

        $this->db->where('status', 1);

        $this->db->where('user_id', $this->session->userdata('userid'));

        $query = $this->db->get();

        

        if($query->num_rows() > 0){

            $total_proced = $query->result();

            return $total_proced;

        }

        return null;

    }

    /* @method : get_current_time_patients

     * @params:

     * @desc: get current hour patient of current logged in specialist

     */

    public function get_current_time_patients()

    {

        $currentDate = date('Y-m-d');

        $currenttime=date("h").":00";

        $this->db->select('count(*) as total');

        $this->db->from('hbooking');

        $this->db->where('specialist_user_id', $this->session->userdata('userid'));

        $this->db->where('status', 0);

        $this->db->where('booking_date', $currentDate);

        $this->db->where('booking_time', $currenttime);

        $query = $this->db->get();

        if($query->num_rows() > 0){

            $total_proced = $query->result();

            return $total_proced;

        }

        else

        {

            $object = (object) [

                'total' => 0,

            ];

            return $object;

        }

    }

    

    /* @method : category

     * @params:

     * @desc: category method is used for fetch procedure

     */

    public function category(){

        $procedureCategoryID = $this->input->post('category');

        $userid = $this->session->userdata('userid');

        $query = $this->db->get_where('hprocedure', array('procedure_cat_id' => $procedureCategoryID, 'user_id'=>$userid, 'status'=>1));

        if($query->num_rows() > 0){

            $procedure = $query->result();

            return $procedure;

        }

    }

   

    function categoryList()

    {

        $category=$this->db->select('*')

            ->from('hprocedurecategory')->get();

            return $category->result();                         

    }

       

    

    public function procedure(){

        $category = $this->db->select('*')->from('hprocedurecategory')->get();

        return $category->result();       

    }

    

    public function createDateRangeArray($strDateFrom,$strDateTo)

    {

        // takes two dates formatted as YYYY-MM-DD and creates an

        // inclusive array of the dates between the from and to dates.

        $aryRange=array();

        $dayRange=array();

        $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));

        $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

        if ($iDateTo>=$iDateFrom)

        {

            array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry

            while ($iDateFrom<$iDateTo)

            {

                $iDateFrom+=86400; // add 24 hours

                array_push($aryRange,date('Y-m-d',$iDateFrom));

            }

        }

        foreach($aryRange as $val){

            $date = DateTime::createFromFormat("Y-m-d", $val);

            //array_push($dayRange,$date->format("d M"));

            array_push($dayRange,$date->format("Y-m-d"));

        }

         

        return $dayRange;

    }   

    

    public function dbDate($date){

        return date("Y-m-d", strtotime($date) );

    }

    

    public function masterprocedurecategory(){

        $procedureCategoryID = $this->input->post('category');

        $userid = $this->session->userdata('userid');

        $query = $this->db->get_where('hmasterprocedure', array('procedure_cat_id' => $procedureCategoryID));

        

        if($query->num_rows() > 0){

            $procedure = $query->result(); 

        return $procedure;

        }

    }

        

    public function reportFetch(){

        $catName=$this->input->post('catName');

        $procName=$this->input->post('procName');

        $from=$this->dbDate($this->input->post('from'));

        $to=$this->dbDate($this->input->post('to'));

        $result['dateRange']=$this->createDateRangeArray($from,$to);

        $specialistuseid=$this->session->userdata('userid');

        

        $this->db->select('DATE_FORMAT(date, "%d-%m-%Y") AS display_date, total_appt, cancel_appt, old_patient, new_patient');

        $this->db->from('hspecialist_pro_appointment');

        $this->db->join('hmasterprocedure','hmasterprocedure.ID=hspecialist_pro_appointment.procedure_id');

        $this->db->join('hprocedurecategory','hmasterprocedure.procedure_cat_id=hprocedurecategory.ID');

        $this->db->where('hspecialist_pro_appointment.userid', $specialistuseid);

        $this->db->where('hmasterprocedure.ID', $procName);

        $this->db->where('hprocedurecategory.ID', $catName);

        $this->db->where('hspecialist_pro_appointment.date BETWEEN "'. $from. '" and "'. $to.'"');

        $tablequery = $this->db->get();

        

        $result=$tablequery->result();

        

        return $result;

        

        

        }

        

    public function reportFetchAll(){

        $specialistuseid=$this->input->post('specialistuseid');

        $tablequery=$this->db->select('*')

            ->from('hspecialist_pro_appointment')

            ->join('hmasterprocedure','hmasterprocedure.ID=hspecialist_pro_appointment.procedure_id')

            ->join('hprocedurecategory','hmasterprocedure.procedure_cat_id=hprocedurecategory.ID')

            ->where('hspecialist_pro_appointment.userid', $specialistuseid)

            ->get();

        /*$f=$this->db->last_query();

        print_r($f);die('dd');*/

        $result['dataRange']=$tablequery->result();

        return $result;

        

        

        }

/* @method : getBookingdetails

* @params:

* @desc: get booking details of specialist patient wise

*/

public function getBookingdetails(){

    $patientDetails=array();

    $patName=$this->input->post('patName');

    $catName=$this->input->post('catName');

    $procName=$this->input->post('procName');

    $specialistid = $this->session->userdata("userid");

    

    

        $patientDetails=array();

        $individualpatientDetails = array();

        

        $this->db->select('DISTINCT(patient_user_id)');

        $this->db->from('hbooking');

        $this->db->where('hbooking.specialist_user_id',$specialistid);  

        $query_1 = $this->db->get();

        

        if($query_1->num_rows() > 0){

            foreach($query_1->result() as $patient){

                $patient_user_id = $patient->patient_user_id;

                

                $this->db->select('SUM(IF(status = "0", 1,0)) AS btotal, SUM(IF(status = "1", 1,0)) AS ctotal, SUM(IF(status = "-1", 1,0)) AS cancel');

                $this->db->from('hbooking');

                $this->db->where('hbooking.patient_user_id', $patient_user_id); 

                $query_2 = $this->db->get();

                

                if($query_2->num_rows() > 0){

                    foreach($query_2->result() as $booking){

                        $totalBooking = ($booking->btotal + $booking->ctotal);

                        $cancelBooking = $booking->cancel;

                    }

                    

                    $this->db->select('hpatient.username,hpatient.picture as patientpic,hspecialist.name,

                                       hspecialist.picture specialistpic,hprocedure.procedure_name, hprocedurecategory.category_name, temp, 

                                       heartbit, BD, BG, weight, water_level, body_fat');

                    $this->db->from('hbooking');

                    $this->db->join('hpatient','hpatient.userid=hbooking.patient_user_id');

                    $this->db->join('hspecialist','hspecialist.ID=hbooking.specialist_user_id');

                    $this->db->join('hprocedure','hprocedure.ID=hbooking.procedure_id');

                    $this->db->join('hprocedurecategory','hprocedurecategory.ID=hprocedure.procedure_cat_id');

                    $this->db->join('hpatientcheckup','hpatientcheckup.booking_id=hbooking.ID');

                    $this->db->where('hbooking.patient_user_id', $patient_user_id); 

                    if($patName !=""){

                        $this->db->where('hprocedure.ID', $procName);

                    }   

                    if($catName !=""){

                        $this->db->where('hprocedurecategory.ID', $catName);

                    }

                    if($patName !=""){

                        $this->db->like('hpatient.fname', $patName);

                    }

                    $this->db->order_by("hbooking.ID", "desc"); 

                    $this->db->limit(1);

                    $query_3 = $this->db->get(); 

                    

                    if($query_3->num_rows() > 0){

                        $individualpatientDetails['patient_user_id'] = $patient_user_id;

                        $individualpatientDetails['totalbooking'] = $totalBooking;

                        $individualpatientDetails['cancelbooking'] = $cancelBooking;

                        $individualpatientDetails['bookingdetails'] = $query_3->result();

                    }

                }

            

                $patientDetails[] = $individualpatientDetails;

                $individualpatientDetails = array();

            }

        }

        

        return $patientDetails;      

}

    

public function get_specialist_Booking_details(){

    $specialistid= $this->session->userdata("userid");

     $this->db->distinct();

    //$tablequery=$this->db->select('*')

     $tablequery= $this->db->select('hpatient.*')

     

        ->from('hbooking')

        ->join('hpatient','hpatient.userid=hbooking.patient_user_id')

        ->join('hprocedure','hprocedure.ID=hbooking.procedure_id')

        ->join('hprocedurecategory','hprocedure.procedure_cat_id=hprocedurecategory.ID')

        ->where('hbooking.specialist_user_id', $specialistid)

        ->get();

    

    return $tablequery->result();

}

/* @method : getPatientDetails

     * @params: 

     * @desc: getPatientDetails method is used to fetch particular patient details 

     */

    public function getPatientDetails(){

        $bookingID = $this->input->post('bookingID');

        $patientID = $this->input->post('patientID');

        

        $this->db->select('hpatient.*');

        $this->db->from('hbooking');

        $this->db->join('hpatient', 'hbooking.patient_user_id = hpatient.userid', 'left');

        $this->db->where('hbooking.ID', $bookingID);

        $query = $this->db->get(); 

        

        if($query->num_rows() > 0){

            $patDetails = $query->result();

            return $patDetails;

        }

    }

/* @method : updatebooking

     * @params: 

     * @desc: updatebooking method is used to update particular booking details 

     */

    public function updatebooking($bookingid = '' ,$tag= ''){

           if($tag == 1)

           { $this->db->where('ID', $bookingid);

             $this->db->update('hbooking', array('status' => 1,'prescription' => 1));

               }

               else

               {

        $this->db->where('ID', $bookingid);

        $this->db->update('hbooking', array('status' => 1));

               }

        if($this->db->affected_rows() > 0){

            return TRUE;

        }else{

            return FALSE;

        }

    }

/* @method : appointmentFilter

     * @params: 

     * @desc: appointmentFilter method is used to filter appointment list

     */

    public function appointmentFilter(){

        $procCat=$this->input->post('procCat');

        $procName=$this->input->post('procName');

        $datepicker=$this->input->post('datepicker');

        $this->db->select('hpatient.fname, hpatient.lname, hpatient.picture, hbooking.ID as hbookingID, hbooking.*,hprocedure.*,hprocedurecategory.*');

        $this->db->from('hbooking');

        $this->db->join('hpatient', 'hpatient.userid = hbooking.patient_user_id');

        $this->db->join('hprocedure', 'hprocedure.ID = hbooking.procedure_id');

        $this->db->join('hprocedurecategory', 'hprocedure.procedure_cat_id = hprocedurecategory.ID');

        $this->db->where('hbooking.specialist_user_id', $this->session->userdata('userid'));

        $this->db->where('hbooking.booking_date', $datepicker);

        $this->db->where('hprocedure.ID', $procName);

        $this->db->order_by('hprocedurecategory.ID',$procCat);

        $query = $this->db->get();

        

        if($query->num_rows() > 0){

            $appointment = $query->result(); 

            return $appointment;

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

    

    

    public function get_procedure_data_for_edit($id){

        
         $id = $this->db->escape_str($id); 

       $user_id = $this->session->userdata('user_id');

       $procdata =   $data=$this->db->query("SELECT DISTINCT hp.ID, hp.MPID , hpcat.category_name, hpcat.ID as category_id,  hp.procedure_name , hp.description , hp.from_price , hp.to_price,  hp.hourly_appt FROM hprocedure hp INNER JOIN hprocedurecategory hpcat ON hp.procedure_cat_id = hpcat.ID WHERE hp.ID= ".$id)->row();

        

        $output = array();

        $output['procedure'] = $procdata ;

        if(!empty($procdata)){
        /* echo   "SELECT DISTINCT hpstaff.ID, hpstaff.staff_cat_id , hpstaff.staff_name ,hpstaff.staff_pic, hstaffcat.staff_cat_name FROM (hprocedure hp INNER JOIN hprocedurestaff hpstaff ON hp.ID = hpstaff.procedure_id) INNER JOIN hstaffcategory hstaffcat ON hpstaff.staff_cat_id = hstaffcat.ID  WHERE hp.ID= ".$id; exit();*/


                $staff =   $data=$this->db->query("SELECT DISTINCT hpstaff.ID, hpstaff.staff_cat_id , hpstaff.staff_name ,hpstaff.staff_pic, hstaffcat.staff_cat_name, hpstaff.staff_id FROM (hprocedure hp INNER JOIN hprocedurestaff hpstaff ON hp.ID = hpstaff.procedure_id) INNER JOIN hstaffcategory hstaffcat ON hpstaff.staff_cat_id = hstaffcat.ID  WHERE hp.ID= ".$id ." order by hpstaff.ID");

          $staff_out = $staff->result_array();

           $output['staff'] = $staff_out;   

            

             $slots =  $this->db->query("SELECT hpslot.ID, hpslot.weekday, hpslot.slot, hpslot.seats FROM ( hproceduretimeslot hpslot INNER JOIN hprocedure hp ON hpslot.procedure_id = hp.ID ) WHERE hpslot.procedure_id = ".$id);

                

                $rst = $slots->result_array();

                if(!empty($rst)){

                        foreach ($rst as $value1){

                           $newArry = array();

                            

                           $newArry['weekday']= $value1['weekday'];

                           $newArry['slot']= $value1['slot'];

                           $newArry['seats']= $value1['seats'];

                            $newArry['ID']= $value1['ID'];

                            $output['slots'][]  = $newArry;

                         }

                     

                }

             return $output;

        }

        

    }

    

    /* @method : prescription_details

     * @params: $data

     * @desc: prescription_details method is used for adding patient prescription details based upon booking id

     */

    public function prescription_details($data = array(), $flag, $bookinID){

       if($flag==1)

        {

        $this->db->insert_batch('hprescriptions', $data); 

        $prescriptionID = $this->db->insert_id();

            if($prescriptionID > 0){

                $this->db->where('hbooking.ID', $bookinID);

                $this->db->update('hbooking',array('prescription'=>1)); 

                return TRUE;

            }else{

                return FALSE;

            }

        }else{

        $this->db->insert_batch('hprescriptions', $data); 

        $prescriptionID = $this->db->insert_id();

            if($prescriptionID > 0){

                return TRUE;

            }else{

                return FALSE;

            }

        }

    }

   /* @method : getdata

    * @params:

    * @desc: get review details of specialist 

    */ 

    public function get_dashboard_reviewdata(){
        $result = array();

        $userid=$this->session->userdata("userid");

        $this->db->select("DISTINCT(hreview.ID), hreview.review, hreview.rating, hpatient.picture as patient_picture, hprocedure.procedure_name");

        $this->db->from('hreview');

        $this->db->join('hspecialist', 'hspecialist.userID = hreview.specialist_id');           

        $this->db->join('hprocedure', 'hprocedure.ID = hreview.procedure_id');      

        $this->db->join('hpatient', 'hpatient.userID = hreview.patient_id');    

        $this->db->join('hprocedurecategory', 'hprocedure.procedure_cat_id = hprocedurecategory.ID');   

        $this->db->join('hbooking', 'hbooking.procedure_id = hreview.booking_id');

        $this->db->where('hbooking.specialist_user_id', $userid);

        $currentDate = date('Y-m-d');

        $last15th_date = date('Y-m-d', strtotime($currentDate.'-15 days')); //exit();

        $where = "hreview.slot_date >='".$last15th_date."' ";
        $this->db->where($where);

        $this->db->order_by('hreview.slot_date','desc');

        $this->db->limit('5', '0');

        $query = $this->db->get();

        

        if($query->num_rows() > 0){

            $result = $query->result();

        }

        return $result;
    }

    public function getdata(){

        $result = array();

        $userid=$this->session->userdata("userid");

        $this->db->select("DISTINCT(hreview.ID), hreview.review, hreview.rating, hpatient.picture as patient_picture, hprocedure.procedure_name");

        $this->db->from('hreview');

        $this->db->join('hspecialist', 'hspecialist.userID = hreview.specialist_id');           

        $this->db->join('hprocedure', 'hprocedure.ID = hreview.procedure_id');      

        $this->db->join('hpatient', 'hpatient.userID = hreview.patient_id');    

        $this->db->join('hprocedurecategory', 'hprocedure.procedure_cat_id = hprocedurecategory.ID');   

        $this->db->join('hbooking', 'hbooking.procedure_id = hreview.booking_id');

        $this->db->where('hbooking.specialist_user_id', $userid);        

        $this->db->order_by('hreview.slot_date','desc');        

        $query = $this->db->get();      

        if($query->num_rows() > 0){

            $result = $query->result();

        }

        return $result;

    }

    public function get_lastweek_appointment_count()

    {

        $today_appointment = array();

        $previous_week = strtotime("-1 week +1 day");

        $start_week = strtotime("last sunday midnight",$previous_week);

        $end_week = strtotime("next saturday",$start_week);

        $start_week = date("Y-m-d",$start_week);

        $end_week = date("Y-m-d",$end_week);

        $i=0;

         while (strtotime($start_week) <= strtotime($end_week)) {

                $start_week = date ("Y-m-d", strtotime("+1 day", strtotime($start_week)));

                $alldates[]=  $start_week;

                $this->db->select('date,total_appt,cancel_appt,old_patient,new_patient');

                $this->db->from('hspecialist_today_appointment');

                $this->db->where('date', $start_week);

                $this->db->where('user_id', $this->session->userdata('userid'));

                $this->db->order_by("hspecialist_today_appointment.ID", "desc");

                $this->db->limit(1);

                $query = $this->db->get();

                    if($query->num_rows() > 0){

                       $today_appointment[$i] = $query->result();

                       $i++;

                      }

            }

                

                return $today_appointment;

    }   

    public function get_pending_prescriptions(){
        $user_id = $this->session->userdata('userid');

        $this->db->select('(hbooking.ID) as bookingID,hbooking.patient_user_id,hpatient.fname,hpatient.lname,hpatient.picture,hbooking.booking_date,hbooking.booking_time');

        $this->db->from('hbooking');

        $this->db->join('hpatient', 'hbooking.patient_user_id = hpatient.userid');

        $this->db->where('hbooking.specialist_user_id', $user_id);

        $this->db->where('hbooking.prescription', 0);        

        $this->db->order_by('hbooking.booking_date','desc');

        $pendingpres = $this->db->get()->result();

        $result = array();

        //$arrayresult=array();

        foreach($pendingpres as $pescrips)

        {

        $result['booking_id']=$pescrips->bookingID;

        $result['patientUserID']=   $pescrips->patient_user_id;

        $result['patient_name']=$pescrips->fname.' '.$pescrips->lname;  

        $result['patient_pic']=$pescrips->picture;

        $result['patient_booking_date']=$pescrips->booking_date;

        $result['patient_booking_time']=$pescrips->booking_time;

        $this->db->select('*');

        $this->db->from('hpatientcheckup');

        $this->db->where('hpatientcheckup.booking_id', $pescrips->bookingID);

        $pendingprescheckup = $this->db->get()->row();

        //if(!empty($pendingprescheckup))

        //{

            $result['pendingprescheckup']=$pendingprescheckup;

            //}

        $arrayresult[] =$result;

        $result = array();

            }

        if(!empty($arrayresult))    //print_r($arrayresult);die();

        {return $arrayresult;}

        else

        {return $arrayresult=array();}
    }

    public function get_dashboard_pending_prescriptions(){  

        $user_id = $this->session->userdata('userid');

        $this->db->select('(hbooking.ID) as bookingID,hbooking.patient_user_id,hpatient.fname,hpatient.lname,hpatient.picture,hbooking.booking_date,hbooking.booking_time');

        $this->db->from('hbooking');

        $this->db->join('hpatient', 'hbooking.patient_user_id = hpatient.userid');

        $this->db->where('hbooking.specialist_user_id', $user_id);

        $this->db->where('hbooking.prescription', 0);

        $currentDate = date('Y-m-d');

        $last15th_date = date('Y-m-d', strtotime($currentDate.'-15 days')); //exit();

        $where = "hbooking.booking_date >='".$last15th_date."' ";
        $this->db->where($where);

        $this->db->order_by('hbooking.booking_date','desc');

        $this->db->limit('5', '0');
        $pendingpres = $this->db->get()->result();

        $result = array();

        //$arrayresult=array();

        foreach($pendingpres as $pescrips)

        {

        $result['booking_id']=$pescrips->bookingID;

        $result['patientUserID']=   $pescrips->patient_user_id;

        $result['patient_name']=$pescrips->fname.' '.$pescrips->lname;  

        $result['patient_pic']=$pescrips->picture;

        $result['patient_booking_date']=$pescrips->booking_date;

        $result['patient_booking_time']=$pescrips->booking_time;

        $this->db->select('*');

        $this->db->from('hpatientcheckup');

        $this->db->where('hpatientcheckup.booking_id', $pescrips->bookingID);

        $pendingprescheckup = $this->db->get()->row();

        //if(!empty($pendingprescheckup))

        //{

            $result['pendingprescheckup']=$pendingprescheckup;

            //}

        $arrayresult[] =$result;

        $result = array();

            }

        if(!empty($arrayresult))    //print_r($arrayresult);die();

        {return $arrayresult;}

        else

        {return $arrayresult=array();}

    }  

    public function addMedicalHistory($data)

    {    

        $this->db->insert('hpatienthistory',$data);

        $userID = $this->db->insert_id();

        return $userID;

        } 

    public function medicalHistory()

    {   $date=date('Y-m-d');

        $bookingID = $this->input->post('bookingID');

        $user_id = $this->session->userdata('userid');

        $patientID = $this->input->post('patientID');

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

     public function selectMedicalHistorybyLastID($id)

        {

        $this->db->select('*');

        $this->db->from('hpatienthistory');

        $this->db->where('hpatienthistory.ID', $id);

        $medicalHistoryLastResult = $this->db->get()->row();

        //print_r($medicalHistory);

        return $medicalHistoryLastResult;

    }

    public function patient_details($specialistid, $limit='', $start=''){
        $patientDetails=array();

        $individualpatientDetails = array();        

        $this->db->select('DISTINCT(patient_user_id)');

        $this->db->from('hbooking');

        $this->db->where('hbooking.specialist_user_id',$specialistid);  

        if($limit!='' && $start!=''){ 
            
            $offset = ($start!='0') ? ($start - 1) * $limit : '0';
            $this->db->limit($limit, $offset); 
        }

        $query_1 = $this->db->get();        

        if($query_1->num_rows() > 0){
            foreach($query_1->result() as $patient){
                $patient_user_id = $patient->patient_user_id;               

                $this->db->select('SUM(IF(status = "0", 1,0)) AS btotal, SUM(IF(status = "1", 1,0)) AS ctotal, SUM(IF(status = "-1", 1,0)) AS cancel');

                $this->db->from('hbooking');

                $this->db->where('hbooking.patient_user_id', $patient_user_id); 

                $query_2 = $this->db->get();                

                if($query_2->num_rows() > 0){
                    foreach($query_2->result() as $booking){
                        $totalBooking = ($booking->btotal + $booking->ctotal);

                        $cancelBooking = $booking->cancel;
                    }                   

                    $this->db->select('hpatient.username,hpatient.picture as patientpic,hspecialist.name,

                                       hspecialist.picture specialistpic,hprocedure.procedure_name, hprocedurecategory.category_name, temp, 

                                       heartbit, BD, BG, weight, water_level, body_fat');

                    $this->db->from('hbooking');

                    $this->db->join('hpatient','hpatient.userid=hbooking.patient_user_id');

                    $this->db->join('hspecialist','hspecialist.ID=hbooking.specialist_user_id');

                    $this->db->join('hprocedure','hprocedure.ID=hbooking.procedure_id');

                    $this->db->join('hprocedurecategory','hprocedurecategory.ID=hprocedure.procedure_cat_id');

                    $this->db->join('hpatientcheckup','hpatientcheckup.booking_id=hbooking.ID');

                    $this->db->where('hbooking.patient_user_id', $patient_user_id); 

                    $this->db->order_by("hbooking.ID", "desc"); 

                    $this->db->limit(1);

                    $query_3 = $this->db->get();                    

                    if($query_3->num_rows() > 0){
                        $individualpatientDetails['patient_user_id'] = $patient_user_id;

                        $individualpatientDetails['totalbooking'] = $totalBooking;

                        $individualpatientDetails['cancelbooking'] = $cancelBooking;

                        $individualpatientDetails['bookingdetails'] = $query_3->result();
                    }
                }           

                $patientDetails[] = $individualpatientDetails;

                $individualpatientDetails = array();
            }
        }
        return $patientDetails;
    }

}

