<?php



if ( ! defined('BASEPATH')) exit('No direct script access allowed');







class Ajax  extends H_Controller  {







    public function __construct(){



        parent::__construct();



        $this->load->model('Admin_model');



        $this->load->model('hospital_model');



        $this->load->model('Procedure_model');

        

        $this->load->model('Home_physician_model');

        

        $this->load->model('Login_model');

        

        $this->load->model('Patient_model');

        

        $this->load->model('Search_model');



        $this->load->model('Specialist_model');



        $this->load->model('booking_model');



        $this->load->model('user');



        $this->load->model('Staff_model');



        $this->load->helper('url');



        $this->load->helper('common');



        $this->load->library('session');



    }



  



    /* @method : changePatientStatus



     * @params: $id



     * @desc: changePatientStatus method is used for changing the status of patient



     */



    public function changePatientStatus(){



        $code = $_POST['code'];



        $id = $this->decode_str($code);



        $filterSet = $this->Admin_model->get_patient_status($id);



        $intFilter = $filterSet->status;



        if($intFilter == 1) {



            $result = 0;



        } else if($intFilter == 0) {



            $result = 1;



        }



        $save = $this->Admin_model->change_status($result, $id);



        if($save){



            echo json_encode(array("message" => "SUCCESS", "status" => $result));



        } else {



            echo json_encode(array("message" => "FAIL"));



        }



    }







    /* @method : changePhysicanStats



     * @params: $id



     * @desc: changePhysicanStats method is used for changing the status of Home Physican



     */



    public function changePhysicanStats(){



        $code = $_POST['code'];



        $id = $this->decode_str($code);



        $filterSet = $this->Admin_model->get_Homephysican_status($id);



        $intFilter = $filterSet->status;



        if($intFilter == 1) {



            $result = 0;



        } else if($intFilter == 0) {



            $result = 1;



        }



        $save = $this->Admin_model->change_phys_status($result, $id);



        if($save){



            echo json_encode(array("message" => "SUCCESS", "status" => $result));



        } else {



            echo json_encode(array("message" => "FAIL"));



        }



    }



    /* @method : check_hospital_holiday



     * @params:



     * @desc: check_hospital_holiday method is used for checking holiday



     */



    public function check_hospital_holiday(){



        $user_id = $this->session->userdata('user_id');



        $date = $_POST['code'];



        $dates = $this->hospital_model->get_holiday_list($date);



        if(!empty($dates)){



            echo json_encode(array("message" => "SUCCESS",''));



        } else {



            $hrsList = $this->hospital_model->get_hrs_list($date , $user_id);



            echo json_encode(array("message" => "fail",'res'=> $hrsList));



        }



    }







    /* @method : get_staff_cat_list



     * @params:



     * @desc: get_staff_cat_list method is used for fetching staff list



     */



    public function get_staff_cat_list(){



        $user_id = $this->session->userdata('user_id');



        $date = $_POST['code'];



        $dates = $this->hospital_model->get_holiday_list($date);



        if($dates){



            echo json_encode(array("message" => "SUCCESS"));



        } else {



            $dayofweek = date('w', strtotime($date));



            $hrsList = $this->hospital_model->get_hrs_list($dayofweek,$user_id);



            echo json_encode(array("message" => "fail",'res'=> $hrsList));



        }



    }







    /* @method : get_staff



     * @params:



     * @desc: get_staff method is used for fetching staff cat list for



     */



    function get_staff_cat(){



        $data = $this->Procedure_model->get_staff_cat();



        echo json_encode($data);



    }







    /* @method : get_staff_name



     * @params:



     * @desc: get_staff_name method is used for fetching staff  list for adding



     */



    function get_staff_name(){



        $data = $this->Procedure_model->get_staff_list();



        echo json_encode($data);



    }







    /* @method : get_staff_list_by_cat



     * @params:



     * @desc: get_staff_list_by_cat method is used for fetching staff category



     */



    function get_staff_list_by_cat(){



        $user_id = $this->session->userdata('user_id');



        $staff_id = $_POST['code'];



        $cat = $this->Staff_model->get_staff_catgory_list($staff_id, $user_id);



        if($cat){



            echo json_encode(array("message" => "SUCCESS",'cat' => $cat));



        } else {



            echo json_encode(array("message" => "FAIL"));



        }



    }







    /* @method : get_bulk_hr_list



     * @params:



     * @desc: get_bulk_hr_list method is used for fetching hrs listing



     */



    function get_bulk_hr_list(){



        $from = $_POST['from'];



        $to = $_POST['to'];



        $start    = new DateTime($from);



        $end      = new DateTime($to);



        $interval = DateInterval::createFromDateString('1 day');



        $period   = new DatePeriod($start, $interval, $end);



        $h_id = $this->hospital_model->get_hospital_by_id();



        $hid = $h_id->ID;



        $dataRange = array();



       foreach ($period as $dt){



           $dataRange[] = $dt->format("Y-m-d");



        }



        $dataRange[] = $end->format("Y-m-d");



        $datesList = $this->hospital_model->check_holiday_date($hid);



        foreach($datesList as $num) {



            if (($key = array_search($num, $dataRange)) !== FALSE) {



                unset($dataRange[$key]);



            }



        }



        $dataRange = array_values($dataRange);



        $weekday = array();



        foreach($dataRange as $date){



            $weekday[]= date('w', strtotime( $date));



        }



        $hrsList = $this->hospital_model->get_working_days_list($hid);



       for($ihrs=0;$ihrs<count($hrsList);$ihrs++){



           $hrsList[$ihrs]=$hrsList[$ihrs]-1;



       }



        $icnt=0;



        foreach($dataRange as $date){



            $weekday=date('w', strtotime( $date));



            if(!in_array($weekday ,$hrsList)){



                unset($dataRange[$icnt]);



            }



            $icnt++;



        }



        $dataRange = array_values($dataRange);



        echo json_encode($dataRange);



    }







    /* @method : get_all_time_slot_list



     * @params:



     * @desc: get_all_time_slot_list method is used for fetching hrs listing



     */



    function get_all_time_slot_list(){



        $date = $_POST['code'];



        $dates = $this->hospital_model->get_holiday_list($date);



        if($dates){



            echo json_encode(array("message" => "SUCCESS"));



        } else {



            $dates = $this->Procedure_model->get_time_slot($date);



            echo json_encode(array("message" => "FAIL",'hrs' => $dates));



        }



    }







    /* @method : get_all_time_slot_list



     * @params:



     * @desc: get_all_time_slot_list method is used for fetching hrs listing



     */



    function get_all_time_slot_list_for_booking(){



        $date = $_POST['code'];



        $dates = $this->hospital_model->get_holiday_list($date);



        if($dates){



            echo json_encode(array("message" => "SUCCESS"));



        } else {



            $dates = $this->Procedure_model->get_time_list_for_booking($date);



            echo json_encode(array("message" => "FAIL",'hrs' => $dates));



        }



    }







    /* @method : change_time_slot_status



     * @params:



     * @desc: change_time_slot_status method is used for change status



     */



    function change_time_slot_status(){



        $date = $_POST['date'];



        $time = $_POST['time'];



        $dates = $this->Procedure_model->change_time_slot_availability($date,$time);



        if($dates == "Already booked"){



            echo json_encode(array("message" => "Already booked"));



        } else {



            echo json_encode(array("message" => "availability changed"));



        }



    }







    /* @method : get_all_hr_list_between_date



     * @params:



     * @desc: get_all_hr_list_between_date method is used for fetching hrs listing



     */



    public function get_all_hr_list_between_date(){



        $user_id = $this->session->userdata('user_id');



        $date = $_POST['code'];



        $hrsList = $this->Procedure_model->get_all_hrs_range_date($date,$user_id);



        if(!empty($hrsList)){



            echo json_encode(array("message" => "SUCCESS", 'res'=> $hrsList));



        } else {



            echo json_encode(array("message" => "fail"));



        }



    }







    /* @method : get_pro_cat_list_search



     * @params:



     * @desc: get_pro_cat_list_search method is used for fetching procedure category list



     */



    public function get_pro_cat_list_search(){



        $user_id = $this->session->userdata('user_id');



        $name = $_POST['pName'];



        $List = $this->Procedure_model->get_all_cat_list_name($name);



    }







    /* @method : cancel_booking



     * @params:



     * @desc: cancel_booking method is used for cancel_booking



     */



    function cancel_booking(){



        $user_id = $this->session->userdata('user_id');



        $id = $_POST['id'];



        $List = $this->booking_model->cancel_booking($id, $user_id);



        if($List){



            echo json_encode(array("message" => "SUCCESS"));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }







    /* @method : get_procedure_name_for_doc



     * @params:



     * @desc: get_procedure_name_for_doc method is used fetching procedure names



     */



    public function get_procedure_name_for_doc(){



        $List = $this->Procedure_model->get_all_pro_with_name();



        if($List){



            echo json_encode(array("message" => "SUCCESS",'list' => $List));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }







    /* @method : get_all_procedure_spec_name



     * @params:



     * @desc: get_all_procedure_spec_name method is used fetching procedure, specialist names



     */



    public function get_all_procedure_spec_name(){



        $data = $_POST['code'];



        $limit = $_POST['limit'];



        $last = $_POST['last'];



        $prc = $this->Home_physican_model->check_already_recommend_procedure($data);



        $List =  $this->Procedure_model->get_data_for_procedure($data, $limit ,$last);



        $total_pr =  $this->Procedure_model->get_total_procedure($data);



        if($List){



            echo json_encode(array("message" => "SUCCESS",'list' => $List , 'prc' => $prc ,'total' => $total_pr));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }







    /* @method : remove_recommendation



     * @params:



     * @desc: remove_recommendation method is used remove home physican recommendation



     */



    public function remove_recommendation(){



        $pr_id = $_POST['pr_id'];



        $sp_id = $_POST['sp_id'];



        $prc = $this->Home_physician_model->remove_recommend_procedure($pr_id,$sp_id);



        if($prc){



            echo json_encode(array("message" => "SUCCESS"));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }



    /* @method : get_time_slot



     * @params:



     * @desc: get_time_slot method is used fetching time slot for a date



     */



    public function get_time_slot(){



        $date = $_POST['date'];



        $prc = $this->Procedure_model->get_slot($date);



        if($prc){



            echo json_encode(array("message" => "SUCCESS",'slot' => $prc));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }







    /* @method : get_patient



     * @params:



     * @desc: get_patient method is used fetching patient list



     */



    public function get_patient(){



        $slot = $_POST['slot'];



        $prc = $this->Procedure_model->get_slot_patient($slot);



        if($prc){



            echo json_encode(array("message" => "SUCCESS",'pt' => $prc));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }







    /* @method : checkpassword



     * @params:



     * @desc: checkpassword method is used check user password matching in database



     */



    public function checkpassword(){



       $pass = $_POST['pass'];



       $data =  $this->user->checkpass($pass);



        if($data){



            echo json_encode(array("message" => "SUCCESS"));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }







    /* @method : save_Patient_Advice



     * @params:



     * @desc: save_Patient_Advice method is used save Patient Advice



     */



    public function save_Patient_Advice(){



        $formData = array();



        parse_str($_POST['data'], $formData);



        $res =  $this->Patient_model->patient_advices($formData);



        if($res){



            echo json_encode(array("message" => "SUCCESS"));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }







    /* @method : save_Patient_Advice



     * @params:



     * @desc: save_Patient_Advice method is used save Patient Advice



     */



    public function save_specialist_Advice(){



        $formData = array();



        parse_str($_POST['data'], $formData);



        $res =  $this->Specialist_model->save_specialist_advices($formData);



        if($res){



            echo json_encode(array("message" => "SUCCESS"));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }











//    /* @method : get_specialist_booking_list



//     * @params:



//     * @desc: get_specialist_booking_list method is used for fetching booking list



//     */



//    public function get_specialist_booking_list(){



//        $date = $_POST['date'];



//        $res =  $this->booking_model->get_booking_list($date);



//



//



//        if(!empty($res)){



//            echo json_encode(array("message" => "SUCCESS", 'list' => $res, 'prc' => $prc));



//        }else {



//            echo json_encode(array("message" => "fail"));



//        }



//    }







    /* @method : get_specialist_booking_list_for_admin



     * @params:



     * @desc: get_specialist_booking_list_for_admin method is used fetching booking detail



     */



    public function get_specialist_booking_list_for_admin(){



        $date = $_POST['date'];



        $res =  $this->booking_model->get_booking_list_admin($date);



        if(!empty($res)){



            echo json_encode(array("message" => "SUCCESS", 'list' => $res));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }







    /* @method : change_specialist_booking_status



     * @params:



     * @desc: change_specialist_booking_status method is used updating status



     */



    public function change_specialist_booking_status(){



        $date = $_POST['date'];



        $res =  $this->booking_model->change_booking_status_specialist($date);



        if(!empty($res)){



            echo json_encode(array("message" => "SUCCESS", 'list' => $res));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }







    /* @method : change_status_specialist



     * @params:



     * @desc: change_status_specialist method is used updating status



     */



    public function change_status_specialist(){



        $code = $_POST['code'];



        $id = $this->decode_str($code);



        $filterSet = $this->Admin_model->get_specialist_status($id);



        $intFilter = $filterSet->status;



        if($intFilter == 1) {



            $result = 0;



        } else if($intFilter == 0) {



            $result = 1;



        }



        $save = $this->Admin_model->change_specialist_status($result, $id);



        if($save){



            echo json_encode(array("message" => "SUCCESS", "status" => $result));



        } else {



            echo json_encode(array("message" => "FAIL"));



        }



    }



    /* @method : change_Lience_status



     * @params:



     * @desc: change_Lience_status method is used updating  Licence status



     */



    public function change_Licence_status(){



        $formData = array();



        parse_str($_POST['data'], $formData);



        $res =  $this->Specialist_model->change_status_for_sp_phy($formData);



        if($res == true){



            echo json_encode(array("message" => "SUCCESS"));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }

    /* @method : get_procedure_specialist_for_recommendation



     * @params:



     * @desc: get_procedure_specialist_for_recommendation  method is used  for recommendation



     */



    public function get_procedure_specialist_for_recommendation(){



        $ids = $_POST['data'];



        $p_id = encode_id($_POST['patient_id']);



        $res =  $this->Procedure_model->get_data_for_procedure($ids);



        if(!empty($res)){



            echo json_encode(array("message" => "SUCCESS", 'list' => $res,'p_id' => $p_id));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }



    /* @method : get_physican_document



     * @params:



     * @desc: get_physican_document  method is used  for fetching document data



     */



    public function get_physican_document(){



        $ids = $_POST['data'];



        $id = decode_id($ids);



        $res =  $this->Specialist_model->get_homePhy_docs($id);



        if(!empty($res)){



            echo json_encode(array("message" => "SUCCESS", 'list' => $res));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }

    /* @method : get_search_data_for_filter



     * @params:



     * @desc: get_search_data_for_filter method is used  for fetching pricing data



     */



    public function get_search_data_for_filter(){



        $formData = array();



        parse_str($_POST['list'], $formData);



        $res =  $this->Procedure_model->get_filter_search_data($formData);



        if(!empty($res)){



            echo json_encode(array("message" => "SUCCESS", 'search' => $res));



        }else {



            echo json_encode(array("message" => "fail", 'search' => $res));



        }



    }

    

     /* @method : get_available_slots_for_booking

     * @desc: get_available_slots_for_booking method is used  for fetching slots data

     */

    public function get_available_slots_for_booking(){

        $prid = $_POST['procid'];

        $dcID = $_POST['docID'];

        $userid=$this->session->userdata("userid");

        $utype = $this->session->userdata("usertype");

        

        if($userid=="")

            $userid =-1;

        

        $res =  $this->Procedure_model->get_filter_slots_data($prid,$dcID);

        if(!empty($res)){

            echo json_encode(array("message" => "SUCCESS", 'search' => $res,"userid"=>$userid, 'utype' => $utype));

        }else {

            echo json_encode(array("message" => "fail",'search' => $res,"userid"=>$userid , 'utype' => $utype));

        }

    }

    

    /* @method : get_available_slots_for_booking_next_slots

     * @params:

     * @desc: get_available_slots_for_booking_next_slots method is used  for fetching slots data

     */

    public function get_available_slots_for_booking_next_slots(){

        $prid = $_POST['procid'];

        $dcID = $_POST['docID'];

        $dates = $_POST['dates'];



        $res =  $this->Procedure_model->get_filter_slots_data_next_slots($prid, $dcID , $dates);

        if(!empty($res)){

            echo json_encode(array("message" => "SUCCESS", 'search' => $res));

        }else {

            echo json_encode(array("message" => "fail",'search' => $res));

        }

    }

    

    /* @method : pass_slot_data_to_booking_view

     * @params:

     * @desc: pass_slot_data_to_booking_view method is used for booking purpose

     */

    public function pass_slot_data_to_booking_view(){

        $formData = array();

        parse_str($_POST['frmdata'], $formData);

        $res =  $this->Procedure_model->get_filter_slots_data($formData);

        if(!empty($res)){

            echo json_encode(array("message" => "SUCCESS", 'search' => $res));

        }else {

            echo json_encode(array("message" => "fail",'search' => $res));

        }

    }

    

    /* @method : get_search_data_for_days



     * @params:



     * @desc: get_search_data_for_days method is used  for fetching working days data



     */



    public function get_search_data_for_days(){



        $days = $_POST['list'];



        $res =  $this->Procedure_model->get_working_days_data($days);



        if(!empty($res)){



            echo json_encode(array("message" => "SUCCESS", 'list' => $res));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }

    /* @method : get_hrs_filter_data



     * @params:



     * @desc: get_hrs_filter_data method is used  for fetching hrs data



     */



    public function get_price_filter_data(){



        $priceOrder = $_POST['priceOrder'];



        $res =  $this->Procedure_model->get_price_filter_data($priceOrder);



        if(!empty($res)){



            echo json_encode(array("message" => "SUCCESS", 'list' => $res));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }

    /* @method : get_city_filter_data



     * @params:



     * @desc: get_city_filter_data method is used  for fetching city data



     */



    public function get_city_filter_data(){



        $city = $_POST['cityname'];



        $res =  $this->Procedure_model->get_filter_search_details_by_city($city);



        if(!empty($res)){



            echo json_encode(array("message" => "SUCCESS", 'list' => $res));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }

    /* @method : get_available_time_slot_for_patient



     * @params:



     * @desc: get_available_time_slot_for_patient method is used  for fetching time slots



     */



    public function get_available_time_slot_for_patient(){



        $formData = array();



        parse_str($_POST['codes'], $formData);



        $res =  $this->Procedure_model->get_time_list_for_patient($formData);



        if(!empty($res)){



            echo json_encode(array("message" => "SUCCESS", 'time' => $res));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }

    /* @method : save_patient_appt



     * @params:



     * @desc: save_patient_appt method is used  for saving patient appt



     */



    public function save_patient_appt(){



        $formData = array();



        parse_str($_POST['data'], $formData);



        $res =  $this->booking_model->save_booking_details($formData);



        if(!empty($res)){



            echo json_encode(array("message" => "SUCCESS"));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }



    /* @method : get_pr_name_against_cat



     * @params:



     * @desc: get_pr_name_against_cat method is used for fetching procedure name



     */



    public function get_pr_name_against_cat(){



        $cat = $_POST['data'];



        $res =  $this->Procedure_model->get_filter_procd_name($cat);



        if(!empty($res)){



            echo json_encode(array("message" => "SUCCESS", 'list' => $res));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }







    /* @method : change_procedure_date_status



     * @params:



     * @desc: change_procedure_date_status method is used updating procedure status



     */



    public function change_procedure_date_status(){



        $code = $_POST['code'];



        $filterSet = $this->Specialist_model->get_procedure_status($code);



        $intFilter = $filterSet->status;



        if($intFilter == 1) {



            $result = 0;



        } else if($intFilter == 0) {



            $result = 1;



        }



        $save = $this->Specialist_model->change_procedure_status($result, $code);



        if($save){



            echo json_encode(array("message" => "SUCCESS"));



        } else {



            echo json_encode(array("message" => "FAIL"));



        }



    }



    /* @method : get_specialist_procedure_for_Admin



     * @params:



     * @desc: get_specialist_procedure_for_Admin method is used fetching procedure related to specialist



     */



    public function get_specialist_procedure_for_Admin(){



        $code = $_POST['code'];



        $filterSet = $this->Admin_model->get_procedure_name_list($code);



        $procedureCatList =  $this->Procedure_model->get_pro_cat_list();



        if($filterSet){



            echo json_encode(array("message" => "SUCCESS",'list' => $procedureCatList, 'prList' => $filterSet));



        } else {



            echo json_encode(array("message" => "FAIL"));



        }



    }



    /* @method : change_specialist_procedure_status



     * @params:



     * @desc: change_specialist_procedure_status method is used to change procedure status



     */



    public function change_specialist_procedure_status(){



        $code = $_POST['code'];



        $save = $this->Admin_model->change_procedure_status($code);



        if($save){



            echo json_encode(array("message" => "SUCCESS"));



        } else {



            echo json_encode(array("message" => "FAIL"));



        }

    }



    /* @method : get_booking_search_result



     * @params:



     * @desc: get_booking_search_result method is used to fetch booking details



     */



    public function get_booking_search_result(){



        $formData = array();



        parse_str($_POST['list'], $formData);



        $filterSet = $this->Admin_model->get_booking_list($formData);



        if($filterSet){



            echo json_encode(array("message" => "SUCCESS",'booking' => $filterSet));



        } else {



            echo json_encode(array("message" => "FAIL"));



        }



    }







    /* @method : get_booking_search_result



     * @params:



     * @desc: get_booking_search_result method is used to fetch booking details



     */



    public function change_booking_status_by_specialist(){



        $id = $_POST['id'];



        $res =  $this->booking_model->save_booking_status($id);



        if(!empty($res)){



            echo json_encode(array("message" => "SUCCESS"));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }





     function get_procedure_name(){



       $ids = $_POST['code'];



       $res =  $this->Procedure_model->get_procedure_names($ids);







       if(!empty($res)){



           echo json_encode(array("message" => "SUCCESS",  'procedureName' => $res ));



       }else {



           echo json_encode(array("message" => "fail"));



       }



   }



    public function get_staff_person_img(){
        $staff = $_POST['staffid'];
        $staff_cat = $_POST['staff_catid'];

        $cat = $this->Staff_model->get_staff_img($staff,$staff_cat);

        if($cat){
            //print_r(json_encode(array('staff' => $cat))); exit();
            echo json_encode(array('staff' => $cat));
        } else {
            echo json_encode(array("message" => "FAIL"));
        }
        exit();
    }







    public function get_specialist_data_for_edit(){



        $list = $this->Specialist_model->get_sp_detail();



        if($list){



            echo json_encode(array("message" => "SUCCESS",'splist' => $list));



        } else {



            echo json_encode(array("message" => "FAIL"));



        }







    }







    public function specialist_info_update(){



        $list = $this->Specialist_model->save_sp_info();



        if($list){



            echo json_encode(array("message" => "SUCCESS",'splist' => $list));



        } else {



            echo json_encode(array("message" => "FAIL"));



        }







    }







    public function change_child_check_status(){



        $sts = $_POST['code'];



        $cat = $this->Specialist_model->change_child_status($sts);



        if($cat){



            echo json_encode(array("message" => "SUCCESS"));



        } else {



            echo json_encode(array("message" => "FAIL"));



        }



    }







    public function save_sp_langauges(){



        $lang = $_POST['langs'];



        $cat = $this->Specialist_model->save_specialist_langauge($lang);



        if($cat){



            echo json_encode(array("message" => "SUCCESS"));



        } else {



            echo json_encode(array("message" => "FAIL"));



        }







    }



    public function save_sp_specialization(){



        $spliz = $_POST['spc'];



        $cat = $this->Specialist_model->save_specialist_specialization($spliz);



        if($cat){



            echo json_encode(array("message" => "SUCCESS"));



        } else {



            echo json_encode(array("message" => "FAIL"));



        }







    }







    public function save_sp_award(){



        $awardText = $_POST['spc'];



        $date = $_POST['awrdDate'];



        $cat = $this->Specialist_model->save_specialist_awards($awardText,$date);



        if($cat){



            echo json_encode(array("message" => "SUCCESS"));



        } else {



            echo json_encode(array("message" => "FAIL"));



        }







    }







    public function delete_time_slot(){



        $slot = $_POST['slot'];



        $cat = $this->Specialist_model->delete_specialist_slots($slot);



        if($cat){



            echo json_encode(array("message" => "SUCCESS"));



        } else {



            echo json_encode(array("message" => "FAIL"));



        }







    }



    /* @method : save_new_password



     * @params:



     * @desc: save_new_password method is used for update password



     */



    public function save_new_password(){



        $frm = $_POST['pass'];



        $data =  $this->user->update_password($frm);



        if($data){



            echo json_encode(array("message" => "SUCCESS"));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }







    /* @method : remove_sp_language



     * @params:



     * @desc: remove_sp_language method is used for remove language



     */



    public function remove_sp_language(){



        $frm = $_POST['taglang'];



        $data =  $this->Specialist_model->remove_sp_lang($frm);



        if($data){



            echo json_encode(array("message" => "SUCCESS"));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }



    /* @method : remove_sp_specialization



     * @params:



     * @desc: remove_sp_specialization method is used for remove specialization



     */



    public function remove_sp_specialization(){



        $frm = $_POST['tagsp'];



        $data =  $this->Specialist_model->delete_sp_specialization($frm);



        if($data){



            echo json_encode(array("message" => "SUCCESS"));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }







    /* @method : remove_sp_award



     * @params:



     * @desc: remove_sp_award method is used for remove award



     */



    public function remove_sp_award(){



        $frm = $_POST['award'];



        $data =  $this->Specialist_model->delete_sp_award($frm);



        if($data){



            echo json_encode(array("message" => "SUCCESS"));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }







    /* @method : remove_sp_education



     * @params:



     * @desc: remove_sp_education method is used for remove edu



     */



    public function remove_sp_education(){



        $frm = $_POST['edid'];



        $data =  $this->Specialist_model->delete_sp_edu($frm);



        if($data){



            echo json_encode(array("message" => "SUCCESS"));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }



   public function get_procedure_name_cat_wise(){

        $frm = $_POST['CatID'];

        $data =  $this->Procedure_model->get_procedure_names_wise($frm);

        if($data){

            echo json_encode(array("message" => "SUCCESS",'list' => $data));

        }else {

            echo json_encode(array("message" => "fail", 'list' => $data));

        }

    }

    

    

     public function get_specialist_details_for_view(){

        $prid = $_POST['procid'];

        $dcID = $_POST['docID'];

        $res =  $this->Patient_model->get_specialist_record($prid,$dcID);

        if(!empty($res)){

            echo json_encode(array("message" => "SUCCESS", 'search' => $res));

        }else {

            echo json_encode(array("message" => "fail",'search' => $res));

        }

    }

    

    

     /* @method : save_user_booking_data



     * @params:



     * @desc: save_user_booking_data method is used save Patient Advice



     */



    public function save_user_booking_data(){



        $formData = array();



        parse_str($_POST['data'], $formData);



        $res =  $this->Search_model->save_register_booking_details($formData);



        if($res){



            echo json_encode(array("message" => "SUCCESS"));



        }else {



            echo json_encode(array("message" => "fail"));



        }



    }



    public function get_sorted_order_data(){

        $frm = $_POST['order'];

        $data =  $this->Patient_model->get_sorted_results($frm);

        if($data){

            echo json_encode(array("message" => "SUCCESS",'list' => $data));

        }else {

            echo json_encode(array("message" => "fail", 'list' => $data));

        }

    }

    

    

     public function check_unique_username(){

        $frm = $_POST['data'];

        $data =  $this->Login_model->get_unique_name($frm);

        if($data){

            echo json_encode(array("message" => "SUCCESS", 'list' => $data));

        }else {

            echo json_encode(array("message" => "fail", 'list' => $data));

        }

    }

    

                    

     public function check_unique_email(){

        $frm = $_POST['data'];

        $data =  $this->Login_model->get_unique_email($frm);

        if($data){

            echo json_encode(array("message" => "SUCCESS", 'list' => $data));

        }else {

            echo json_encode(array("message" => "fail", 'list' => $data));

        }

    }

    

    public function check_hp_email_id(){

        $frm = $_POST['data'];

        $data =  $this->Home_physician_model->get_hp_email($frm);

        if($data){

            echo json_encode(array("message" => "SUCCESS", 'list' => $data));

        }else {

            echo json_encode(array("message" => "fail", 'list' => $data));

        }

    }

    

    

    public function check_booking_details_exits_before_save(){

        $formData = array();

        parse_str($_POST['data'], $formData);

        $res =  $this->Login_model->get_patinet_for_booking($formData);

        if($res){

            echo json_encode(array("message" => "SUCCESS"));

        }else {

            echo json_encode(array("message" => "fail"));



        }

    }

    

     /* @method : get_recomd_patient

     * @params:

     * @desc: get_recomd_patient method is used to fetch recommended patient

     */ 

    public function get_recomd_patient(){

        $mpid = $_POST['MPid'];

        $dcID = $_POST['docId'];

        $data =  $this->Home_physician_model->get_recommend_patient($mpid,$dcID);

        if($data){

            echo json_encode(array("message" => "SUCCESS", 'pat' => $data));

        }else {

            echo json_encode(array("message" => "fail", 'pat' => $data));

        }

    }

    

    

    /* @method : save_recomd_patient

     * @params:

     * @desc: save_recomd_patient method is used to save recommended patient

     */ 

            

     public function save_recomd_patient(){

        $formData = array();

        parse_str($_POST['frmdatas'], $formData);

        $res =  $this->Home_physician_model->save_recommended_patient($formData);

        if($res){

            echo json_encode(array("message" => "SUCCESS"));

        }else {

            echo json_encode(array("message" => "fail"));



        }

    }   



       /* @method : delete_recomd_patient

     * @params:

     * @desc: delete_recomd_patient method is used to delete recommended patient

     */ 

    public function delete_recomd_patient(){

        $rcid = $_POST['rcid'];

        $data =  $this->Home_physician_model->delete_recommend_patient($rcid);

        if($data){

            echo json_encode(array("message" => "SUCCESS"));

        }else {

            echo json_encode(array("message" => "fail"));

        }

    }   

    

    

     /* @method : get_patient_pic_name

     * @params:

     * @desc: get_patient_pic_name method is used to fetch patient pic 

     */ 

     public function get_patient_pic_name(){

        $pid = $_POST['pid'];

        $prc = $this->Home_physician_model->get_patient_name_pic($pid);

        if($prc){

            echo json_encode(array("message" => "SUCCESS",'plist' => $prc));

        }else {

            echo json_encode(array("message" => "fail" , 'plist' => $prc));

        }



    }

    

    

    /* @method : save_admin_sp_detail

     * @params:

     * @desc: save_admin_sp_detail method is used to save sp details

     */ 

    public function save_admin_sp_detail(){

        $formData = array();

        parse_str($_POST['fmdata'], $formData);

        $res =  $this->Admin_model->save_admin_sp_data($formData);

        if($res){

            echo json_encode(array("message" => "SUCCESS"));

        }else {

            echo json_encode(array("message" => "fail"));



        }

    }

    

    

     /* @method : admin_edit_sp_detail

     * @params:

     * @desc: admin_edit_sp_detail method is used to fetch sp details for edit

     */ 

       public function admin_edit_sp_detail(){

        $id = $_POST['id'];

        $prc = $this->Admin_model->get_sp_data($id);

        if($prc){

            echo json_encode(array("message" => "SUCCESS",'splist' => $prc));

        }else {

            echo json_encode(array("message" => "fail" , 'splist' => $prc));

        }



    }   

    

     /* @method : admin_edit_patient_detail

     * @params:

     * @desc: admin_edit_patient_detail method is used to fetch patient details for edit

     */ 

       public function admin_edit_patient_detail(){

        $id = $_POST['id'];

        $prc = $this->Admin_model->get_patient_data($id);

        if($prc){

            echo json_encode(array("message" => "SUCCESS",'splist' => $prc));

        }else {

            echo json_encode(array("message" => "fail" , 'splist' => $prc));

        }



    }    

     /* @method : admin_edit_homephy_detail

     * @params:

     * @desc: admin_edit_homephy_detail method is used to fetch patient details for edit

     */ 

       public function admin_edit_homephy_detail(){

        $id = $_POST['id'];

        $prc = $this->Admin_model->get_homephy_data($id);

        if($prc){

            echo json_encode(array("message" => "SUCCESS",'splist' => $prc));

        }else {

            echo json_encode(array("message" => "fail" , 'splist' => $prc));

        }



    }    

    

     /* @method : save_updated_sp_detail

     * @params:

     * @desc: save_updated_sp_detail method is used to update sp details

     */ 

    public function save_updated_sp_detail(){

        $formData = array();

        parse_str($_POST['fmdata'], $formData);

        $res =  $this->Admin_model->update_sp_data($formData);

        if($res){

            echo json_encode(array("message" => "SUCCESS"));

        }else {

            echo json_encode(array("message" => "fail"));



        }

    }

    

    

     /* @method : save_admin_patient_detail

     * @params:

     * @desc: save_admin_patient_detail method is used to save patient details

     */ 

    

     public function save_admin_patient_detail(){

        $formData = array();

        parse_str($_POST['fmdata'], $formData);

        $res =  $this->Admin_model->save_patient_data($formData);

        if($res){

            echo json_encode(array("message" => "SUCCESS"));

        }else {

            echo json_encode(array("message" => "fail"));

        }

    }

    

    

     /* @method : save_admin_homephy_detail

     * @params:

     * @desc: save_admin_homephy_detail method is used to save homephy details

     */  

    

     public function save_admin_homephy_detail(){

        $formData = array();

        parse_str($_POST['fmdata'], $formData);

        $res =  $this->Admin_model->save_homephy_data($formData);

        if($res){

            echo json_encode(array("message" => "SUCCESS"));

        }else {

            echo json_encode(array("message" => "fail"));



        }

    }

    

     /* @method : change_sp_status

     * @params:

     * @desc: change_sp_status method is used to update specialist status

     */  

      public function change_sp_status(){

        $id = $_POST['sid'];

        $prc = $this->Admin_model->change_status_sp($id);

        if($prc){

            echo json_encode(array("message" => "SUCCESS",'splist' => $prc));

        }else {

            echo json_encode(array("message" => "fail" , 'splist' => $prc));

        }



    }  

    

      /* @method : change_patient_status

     * @params:

     * @desc: change_patient_status method is used to update patient status

     */  

      public function change_patient_status(){

        $id = $_POST['sid'];

        $prc = $this->Admin_model->change_status_patient($id);

        if($prc){

            echo json_encode(array("message" => "SUCCESS",'splist' => $prc));

        }else {

            echo json_encode(array("message" => "fail" , 'splist' => $prc));

        }



    } 

    

    

     /* @method : change_hphy_status

     * @params:

     * @desc: change_hphy_status method is used to update homephy status

     */           

    public function change_hphy_status(){

        $id = $_POST['sid'];

        $prc = $this->Admin_model->change_status_hphy($id);

        if($prc){

            echo json_encode(array("message" => "SUCCESS",'splist' => $prc));

        }else {

            echo json_encode(array("message" => "fail" , 'splist' => $prc));

        }



    }     

    

    

    /* @method : get_sp_licence_list

     * @params:

     * @desc: get_sp_licence_list method is used to fetch licence details for specialist

     */

     public function get_sp_licence_list(){

        $id = $_POST['id'];

        $prc = $this->Admin_model->get_sp_licence_details($id);

        if($prc){

            echo json_encode(array("message" => "SUCCESS", 'splist' => $prc));

        }else {

            echo json_encode(array("message" => "fail" , 'splist' => $prc));

        }

    }

    

    /* @method : change_licence_status_for_sp

     * @params:

     * @desc: change_licence_status_for_sp method is used to update licence status for specialist

     */

    public function change_licence_status_for_sp(){

        $id = $_POST['sid'];

        $prc = $this->Admin_model->change_licence_stats_sp($id);

        if($prc){

            echo json_encode(array("message" => "SUCCESS",));

        }else {

            echo json_encode(array("message" => "fail" ));

        }



    }    



     /* @method : get_hphy_licence_list

     * @params:

     * @desc: get_hphy_licence_list method is used to fetch licence detail 

     */

     public function get_hphy_licence_list(){

        $id = $_POST['id'];

        $prc = $this->Admin_model->get_hphy_licence_details($id);

        if($prc){

            echo json_encode(array("message" => "SUCCESS", 'splist' => $prc));

        }else {

            echo json_encode(array("message" => "fail" , 'splist' => $prc));

        }

    }

    

     /* @method : change_licence_status_for_Hphy

     * @params:

     * @desc: change_licence_status_for_Hphy method is used for change licence status for home phy 

     */

    

     public function change_licence_status_for_Hphy(){

        $id = $_POST['sid'];

        $prc = $this->Admin_model->change_licence_stats_homephy($id);

        if($prc){

            echo json_encode(array("message" => "SUCCESS",));

        }else {

            echo json_encode(array("message" => "fail" ));

        }

    }    





}



