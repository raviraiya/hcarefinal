<?php

class Procedure_model extends H_Model {

    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('hcareemail_helper');
    }

    /* @method : add_procedure_details
     * @params:
     * @desc: add_procedure_details method is used for adding procedure
     */
    public function add_procedure_details(){
        $this->db->trans_start();
        $user_id=$this->session->userdata('user_id');

        /*
         *  save data into procedure table
         */

        $data = array(
            'userid' => $user_id,
//            'hospitalid' => $hs_id,
            'procedure_cat_id'=> $this->input->post('procedure_cat_id'),
            'procedure_name'=> $this->input->post('procedure_name'),
            'hourly_appt' => $this->input->post('no_of_appt'),
            'description'=> $this->input->post('description'),
             'price' => $this->input->post('price')
        );
        $this->db->insert('hprocedure',$data);
        $pro_id = $this->db->insert_id();

        $StaffcatId = $this->input->post('staff_cat_id');
        $catName = $this->input->post('staff_name');
            $total = count($StaffcatId);
            for($i=0; $i < $total ;  $i++) {
                $data = array(
                    'procedure_id' => $pro_id,
                    'staff_cat_id' => $StaffcatId[$i],
                    'staff_name' => $catName[$i],
                );
                $this->db->insert('hprocedurestaff',$data);
            }

        $dates = $this->input->post('appointment_date');

        if(!empty($dates)){
            $icnt=1;
            $appt = $this->input->post('no_of_appt');

            foreach($dates as $date){
                $hours = $this->input->post('hour'.$icnt);
                foreach($hours as $hour){
                    $data = array(
                        'procedureid' => $pro_id,
                        'doctorid' => $user_id,
                        'date' => $date,
                         'no_of_appt' => $appt,
                         'time_slot' => $hour,
                    );
                    $this->db->insert('hproceduredate',$data);
                }
                $icnt++;
            }
        }

     $this->db->trans_complete();
        return true;
    }

    public function get_procedure_names($id){
        $this->db->select('ID');
        $this->db->select('procedure_name');
        $this->db->from('hmasterprocedure');
        $this->db->where('procedure_cat_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    /* @method : get_staff_cat
     * @params:
     * @desc: get_staff_cat method is used for fetching staff category
     */
    public function get_staff_cat(){
        $query = $this->db->get('hstaffcategory');
        $ress= $query->result();
        $output=array();
        $output[""] = "Select Staff Category";
        foreach($ress as $res){
            $output[$res->ID]=$res->staff_cat_name;
        }
        return $output;
    }

    /* @method : get_staff_list
     * @params:
     * @desc: get_staff_list method is used for fetching staff list
     */
    public function get_staff_list(){
        $query = $this->db->get('hstaff');
        $ress= $query->result();
        $output=array();
        $output[""]="Select Staff";
        foreach($ress as $res){
            $output[$res->ID]=$res->staff_name;
        }
        return $output;
    }

    /* @method : save_procedure_data
     * @params:
     * @desc: save_procedure_data method is used for saving procedure data
     */
    public function save_procedure_data(){
        $user_id = $this->session->userdata('userid');        

        /* data for time slotes  */
        $monday = $this->input->post('mon_slots');
        $tues = $this->input->post('tues_slots');
        $wed = $this->input->post('wed_slots');
        $thus = $this->input->post('thus_slots');
        $fri = $this->input->post('fri_slots');
        $sat = $this->input->post('sat_slots');
        $sunday = $this->input->post('sun_slots');

        /* data for slotes seats  */
        $mon_slots_seats = $this->input->post('mon_slots_seats');
        $tues_slots_seats = $this->input->post('tues_slots_seats');
        $wed_slots_seats = $this->input->post('wed_slots_seats');
        $thus_slots_seats = $this->input->post('thus_slots_seats');
        $fri_slots_seats = $this->input->post('fri_slots_seats');
        $sat_slots_seats = $this->input->post('sat_slots_seats');
        $sun_slots_seats = $this->input->post('sun_slots_seats');

        /* data for procedure  */
        $procedure_cat_id = $this->input->post('procedure_cat');
        $MPID = $this->input->post('MPID');
        $procedure_name = $this->input->post('procedure_name_selected');
        $hour_slot = $this->input->post('appt_per_slots');
        $description = $this->input->post('description');
        $from_amount = $this->input->post('from_amount');
        $to_amount = $this->input->post('to_amount');

        /* data for staff  */
        $staff_cat_id = $this->input->post('staff_cat_id');
        $staff_id = $this->input->post('staff_name');
        $staff_name = $this->input->post('staff_name');
        $staff_pic = $this->input->post('staff_pic');
        $staff_cat = $this->input->post('staff_cat_type');

        $prc = array(
                'user_id' => $user_id,
                'MPID' => $MPID,
                'procedure_cat_id' => $procedure_cat_id,
                'procedure_name' => $procedure_name ,
                'description' => $description ,
                'hourly_appt' => $hour_slot,
                'from_price' => $from_amount,
                'to_price' => $to_amount,
        );
        $this->db->insert('hprocedure', $prc );
        $proc_id = $this->db->insert_id();
        /* saving data into hprocedurestaff table */
        if(isset($staff_cat_id)){
            $totalstf = count($staff_cat_id);
            for($k=0; $k < $totalstf ;  $k++) {                
                $pic = (!empty($staff_pic)) ? $staff_pic[$k] : '';
                $name = (!empty($staff_name)) ? $staff_name[$k] : '';                
                $stf_id = (!empty($staff_id)) ? $staff_id[$k] : ''; 

                $staff = array(
                    'procedure_id' => $proc_id,
                    'staff_cat_id' => $staff_cat_id[$k] ,
                    'staff_id' => $staff_id[$k] ,
                    'staff_name' => $name ,
                    'staff_category' => $staff_cat[$k],
                    'staff_pic' => $pic,
                );
                $this->db->insert('hprocedurestaff', $staff );
            }
        }

        /*if(isset($staff_cat_id)){
            $total = count($staff_cat_id);
            for($i=0; $i < $total ;  $i++) {
                $staff = array(
                    'procedure_id' => $proc_id,
                    'staff_cat_id' => $staff_cat_id[$i] ,
                    'staff_name' => $staff_name[$i] ,
                    'staff_category' => $staff_cat[$i],
                    'staff_pic' => $staff_pic[$i],                    
                );
                $this->db->insert('hprocedurestaff', $staff );
            }
        }*/

        if(isset($monday)){
            $total = count($monday);
            for($i=0; $i < $total ;  $i++) {
                $data = array(
                    'specialist_id' => $user_id,
                    'procedure_id' => $proc_id,
                    'weekday' => 1,
                    'slot' => $monday[$i],
                    'seats' => $mon_slots_seats[$i],
                );
                $this->db->insert('hproceduretimeslot',$data);
            }
        }

        if(isset($tues)){
            $total = count($tues);
            for($i=0; $i < $total ;  $i++) {
                $data = array(
                    'specialist_id' => $user_id,
                    'procedure_id' => $proc_id,
                    'weekday' => 2,
                    'slot' => $tues[$i],
                    'seats' => $tues_slots_seats[$i],
                );
                $this->db->insert('hproceduretimeslot',$data);
            }

        }

        if(isset($wed)){
            $total = count($wed);
            for($i=0; $i < $total ;  $i++) {
                $data = array(
                    'specialist_id' => $user_id,
                    'procedure_id' => $proc_id,
                    'weekday' => 3,
                    'slot' => $wed[$i],
                    'seats' => $wed_slots_seats[$i],
                );
                $this->db->insert('hproceduretimeslot',$data);
            }
        }

        if(isset($thus)){
            $total = count($thus);
            for($i=0; $i < $total ;  $i++) {
                $data = array(
                    'specialist_id' => $user_id,
                    'procedure_id' => $proc_id,
                    'weekday' => 4,
                    'slot' => $thus[$i],
                    'seats' => $thus_slots_seats[$i],
                );
                $this->db->insert('hproceduretimeslot',$data);
            }
        }

        if(isset($fri)){
            $total = count($fri);
            for($i=0; $i < $total ;  $i++) {
                $data = array(
                    'specialist_id' => $user_id,
                    'procedure_id' => $proc_id,
                    'weekday' => 5,
                    'slot' => $fri[$i],
                    'seats' => $fri_slots_seats[$i],
                );
                $this->db->insert('hproceduretimeslot',$data);
            }
        }

        if(isset($sat)){
            $total = count($sat);
            for($i=0; $i < $total ;  $i++) {
                $data = array(
                    'specialist_id' => $user_id,
                    'procedure_id' => $proc_id,
                    'weekday' => 6,
                    'slot' => $sat[$i],
                    'seats' => $sat_slots_seats[$i],
                );
                $this->db->insert('hproceduretimeslot',$data);
            }
        }

        if(isset($sunday)){
            $total = count($sunday);
            for($i=0; $i < $total ;  $i++) {
                $data = array(
                    'specialist_id' => $user_id,
                    'procedure_id' => $proc_id,
                    'weekday' => 7,
                    'slot' => $sunday[$i],
                    'seats' => $sun_slots_seats[$i],
                );
                $this->db->insert('hproceduretimeslot',$data);
            }
        }
        return true;
    }






    /* @method : get_patient
     * @params:$id
     * @desc: get_patient method is used for fetching patient using id
     */
    public function get_patient($id){
        $query = $this->db->get_where('hpatient', array('ID' => $id));
        return $query->row_array();
    }

    /* @method : get_pro_cat_list
     * @params:$id
     * @desc: get_pro_cat_list method is used for fetching procedure category
     */
    public function get_pro_cat_list(){
        $query = $this->db->get('hprocedurecategory');
        $ress= $query->result();
        $output=array();
        $output[""]="Select Procedure Category";
        foreach($ress as $res){
            $output[$res->ID]=$res->category_name;
        }
        return $output;
    }


    /* @method : edit
     * @params:$id
     * @desc: edit method is used for update
     */
    public function edit($id){
        $this->db->trans_start();
        $data = array(
             'name'=>$this->input->post('name'),
             'dob'=>$this->input->post('dob'),
             'address'=>$this->input->post('address'),
             'city'=> $this->input->post('city'),
             'state'=> $this->input->post('state'),
             'zip'=> $this->input->post('zip'),
             'phone'=> $this->input->post('phone'),
             'email'=> $this->input->post('email'),
        );
        
        $this->db->where('ID', $id);
        $this->db->update('hpatient', $data);
        $this->db->trans_complete();
    }

    /* @method : view_details
     * @params:
     * @desc: view_details method is used for display details
     */
    public function view_details(){
        $query = $this->db->get('hpatient');
        return $query->row_array();
    }

    /* @method : get_pro_cat
     * @params: $id
     * @desc: get_pro_cat method is used for fetching procedure category listing
     */
    public function get_pro_cat($id){
        $this->db->select('*');
        $this->db->from('hprocedurecategory');
        $this->db->where('userid' , $id);
        $res =$this->db->get()->result_array();
        return $res;
    }

    /* @method : get_pro_name
     * @params: $id
     * @desc: get_pro_name method is used for fetching procedure name listing
     */
    public function get_pro_name($id){
        $this->db->select('*');
        $this->db->from('hprocedure');
        $this->db->where('userid' , $id);
        $res =$this->db->get()->result_array();
        return $res;
    }

    /* @method : get_pro_cat_name
     * @params: $id
     * @desc: get_pro_cat method is used for fetching procedure category name
     */
    public function get_pro_cat_name($id){
        $this->db->select('category_name');
        $this->db->from('hprocedurecategory');
        $this->db->where('ID' , $id);
        $res =$this->db->get()->row()->category_name;
        return $res;
    }
    /* @method : get_name
     * @params: $id
     * @desc: get_pro_name method is used for fetching procedure name
     */
    public function get_name($id){
        $this->db->select('procedure_name');
        $this->db->from('hprocedure');
        $this->db->where('ID' , $id);
        $res =$this->db->get()->row()->procedure_name;
        return $res;
    }

    /* @method : get_pro_cat_spec
     * @params:
     * @desc: get_pro_cat_spec method is used for fetching procedure procedure cat specialist
     */
    public function get_pro_cat_spec(){
        $query = $this->db->query("SELECT hpc.ID , hpc.category_name ,  hp.status ,hp.procedure_name FROM hprocedurecategory hpc inner join hprocedure hp on hpc.ID = hp.ID");
        $ress = $query->result_array();
        return $ress;
    }

    /* @method : get_procedure_status
     * @params:
     * @desc: get_procedure_status method is used for fetching procedure status
     */
    public function get_procedure_status(){
        $query = $this->db->query("SELECT hpc.ID , hpc.category_name , hp.status, hp.procedure_name FROM hprocedurecategory hpc inner join hprocedure hp on hpc.ID = hp.ID");
        $ress = $query->result_array();
        return $ress;
    }

    /* @method : get_all_pro_name
     * @params:
     * @desc: get_all_pro_name method is used for fetching procedure name
     */
    public function get_all_pro_name(){
        $query = $this->db->get('hprocedure');
        $ress= $query->result();
        $output=array();
        $output[""]="Select Procedure Name";
        foreach($ress as $res){
            $output[$res->ID]=$res->procedure_name  ;
        }
        return $output;
    }

    /* @method : get_all_pro_with_name
     * @params:
     * @desc: get_all_pro_with_name method is used for fetching procedure name
     */
    public function get_all_pro_with_name(){
        $query = $this->db->get('hprocedure');
        $ress= $query->result();
        $output=array();
        $output[""]="Select Procedure Name";
        foreach($ress as $res){
            $output[$res->procedure_name]=$res->procedure_name  ;
        }
        return $output;
    }

    /* @method : get_all_procedure_staff_id_name
     * @params:$proId
     * @desc: get_all_procedure_staff_id_name method is used for fetching staff name , staff cat id
     */
    public function get_all_procedure_staff_id_name($proId){
        $this->db->select('staff_cat_id');
        $this->db->select('staff_name');
        $this->db->from('hprocedurestaff');
        $this->db->where('procedure_id' , $proId);
        $res =$this->db->get()->result_array();
        return $res;
    }

    /* @method : get_time_slot
     * @params: $date
     * @desc: get_time_slot method is used for fetching hrs listing
     */
    public function get_time_slot($date){
        $this->db->select('*');
        $this->db->from('hproceduredate');
        $this->db->where('date' , $date);
        $this->db->where('availability' , '1');
        $res =array_column($this->db->get()->result_array(),'time_slot');
        $result =  array_map('trim',$res);
        return $result;
    }
    /* @method : change_time_slot_availability
     * @params: $date ,$time
     * @desc: change_time_slot_availability method is used for status availability change
     */
    public function change_time_slot_availability($date, $time){
        $this->db->select('ID');
        $this->db->select('no_of_appt');
        $this->db->select('no_of_booked_appt');
        $this->db->from('hproceduredate');
        $this->db->where('date' , $date);
        $this->db->where('time_slot' , $time);
        $res = $this->db->get()->row();
        if($res->no_of_appt == $res->no_of_booked_appt){
                $data = "Already booked";
                return $data;
        }else{
            $data = array(
                'availability' => '0',
            );
            $this->db->where('ID' , $res->ID);
            $this->db->update('hproceduredate', $data);
            $data = "availability changed";
            return $data;
        }

    }

    /* @method : get_all_hrs_range_date
     * @params: $date ,$uid
     * @desc: get_all_hrs_range_date method is used for status availability change
     */
    public function get_all_hrs_range_date($date,$uid){
        $this->db->select('time_slot');
        $this->db->from('hproceduredate');
        $this->db->where('date' , $date);
        $this->db->where('doctorid' , $uid);
        $res =array_column($this->db->get()->result_array(),'time_slot');
        $result =  array_map('trim',$res);
        return $result;
        }

    /* @method : get_no_of_appt
     * @params:$proId
     * @desc: get_no_of_appt method is used for fetching appointment
     */
    public function get_no_of_appt($proId){
        $this->db->select('no_of_appt');
        $this->db->from('hproceduredate');
        $this->db->where('procedureid' , $proId);
        $res =$this->db->get()->row();
        if(!empty($res)){
            return $res;
        }

    }
    /* @method : get_search_result
     * @params:$proId
     * @desc: get_search_result method is used for fetching search result
     */
    public function get_search_result(){
        $name = $this->input->post('procedure_name');
        $procedure_cat_id =  $this->input->post('procedure_cat_id');
        $query = $this->db->query("SELECT hp.ID,hp.procedure_name, hp.description, hs.userid ,hs.name FROM hprocedure hp INNER JOIN hspecialist hs ON hs.userid = hp.userid WHERE hp.procedure_name LIKE '%$name%' OR hp.procedure_cat_id LIKE '%$procedure_cat_id%' ");
        $res= $query->result_array();
        return $res;
    }

    /* @method : get_specialist
     * @params:$proId
     * @desc: get_specialist method is used for fetching specialist details
     */
    public function get_specialist_procedure_detail($id){
        $this->db->select('*');
        $this->db->from('hprocedure');
        $this->db->where('ID' , $id);
        $res = $this->db->get()->row();
        return $res;
    }

    /* @method : get_time_list_for_booking
     * @params: $date
     * @desc: get_time_list_for_booking method is used for fetching hrs listing
     */
    public function get_time_list_for_booking($date){
        $this->db->select('ID');
        $this->db->select('time_slot');
        $this->db->select('no_of_appt');
        $this->db->select('no_of_booked_appt');
        $this->db->from('hproceduredate');
        $this->db->where('date' , $date);
        $this->db->where('availability' ,1);
        $res =$this->db->get()->result_array();
        return $res;
    }



    /* @method : get_data_for_procedure
     * @params:
     * @desc: get_data_for_procedure method is used for fetching specialist details
     */

    public function get_data_for_procedure($pr_cat_id){
        $query = $this->db->query("SELECT (SELECT hs.name AS sname FROM hspecialist hs WHERE hp.userid = hs.userid) AS sname ,hp.ID ,hp.userid ,hp.procedure_name, hp.procedure_cat_id  FROM hprocedure hp WHERE hp.procedure_cat_id = '$pr_cat_id' ");
        $res= $query->result_array();
        return $res;
    }

    /* @method : get_total_procedure
     * @params:
     * @desc: get_total_procedure method is used for fetching total procedure
     */
    public function get_total_procedure($pr_id){
        $query = $this->db->query("SELECT count(*) AS count FROM hprocedure hp WHERE hp.procedure_cat_id = '$pr_id' ");
        foreach ($query->result() as $row){
            return $row->count;
        }
        return -1;
    }



    /* @method : get_slot
     * @params:
     * @desc: get_slot method is used for fetching time slot
     */
    function get_slot($date){
        $user_id=$this->session->userdata('user_id');
        $this->db->select('booking_time');
        $this->db->from('hbooking');
        $this->db->where('booking_date', $date);
        $this->db->where('specialist_user_id', $user_id);
        $res =array_column($this->db->get()->result_array(),'booking_time');
        $result =  array_map('trim',$res);
        return $result;
    }

    /* @method : get_slot_patient
     * @params:
     * @desc: get_slot_patient method is used for fetching patient name
     */
    function get_slot_patient($slot){
        $user_id=$this->session->userdata('user_id');
        $result = $this->db->query("SELECT hp.userid, hp.username FROM hpatient hp WHERE userid =(SELECT hb.patient_id FROM hbooking hb WHERE hb.specialist_user_id = '$user_id' AND hb.booking_time = '$slot')");
        $res= $result->result_array();
        return $res;
    }

    /* @method : get_procedure_status_list
     * @params:
     * @desc: get_procedure_status_list  method is used for fetch procedure status list
     */
    public function get_procedure_status_list($id){
        $this->db->select("status");
        $this->db->from("hprocedure");
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    /* @method : get_pro_cat_name_wise
     * @params:
     * @desc: get_pro_cat_name_wise method is used for fetching procedure category
     */
   public function get_pro_cat_name_wise(){
        $query = $this->db->get('hprocedurecategory');
        $ress= $query->result();
        $output=array();
        $output[""]="Select Procedure Category";
        foreach($ress as $res){
            $output[$res->ID]=$res->category_name;
        }
        return $output;
    }

    /* @method : change_status_procedure
     * @params:
     * @desc: change_status_procedure  method is used for updating procedure status
     */
    public function change_status_procedure($stats, $id){
        $data = array(
            'status' => $stats,
        );
        $this->db->where('ID', $id);
        $result = $this->db->update('hprocedure', $data);
        return $result;
    }

    /* @method : change_status_procedure
     * @params:
     * @desc: change_status_procedure  method is used for updating procedure status
     */
    public function get_all_hs_procedures(){
        $data =  $this->db->query("SELECT DISTINCT hp.procedure_name , hpc.category_name FROM (hprocedure hp INNER JOIN hprocedurecategory hpc ON hp.procedure_cat_id = hpc.ID) ");
        $rsr = $data->result_array();
        return $rsr;
    }

    /* @method : get_patient_procedure_search_details_by_id
     * @params: $id
     * @desc: get_patient_procedure_search_details_by_id method is used for fetching procedure details
     */
    public function get_patient_procedure_search_details_by_id($id){
        $user_id = $this->session->userdata('user_id');
        $data =  $this->db->query("SELECT DISTINCT hp.ID,hp.procedure_name ,hp.description, hp.price ,hs.name,hs.userid, husr.picture , (SELECT COUNT(*) FROM hrecommendedprocedure AS hrecmd WHERE hrecmd.specialist_user_id = hp.userid AND hrecmd.procedure_cat_id = hp.procedure_cat_id AND hrecmd.procedure_id = hp.ID and hrecmd.patient_user_id = '$user_id') AS recomend FROM (hspecialist hs INNER JOIN hprocedure hp ON hs.userid = hp.userid) INNER JOIN huser husr ON hs.userid = husr.ID WHERE hp.procedure_cat_id = '$id'");
        $rsr = $data->result_array();
        if(!empty($rsr)){
            $merge = array();
            foreach($rsr as $rs){
                $this->db->distinct();
                $this->db->select('weekday');
                $this->db->from('hworkinghours');
                $this->db->where('userid', $rs['userid']);
                $query = $this->db->get()->result_array();
                if(!empty($query)){
                    $newString = array();
                    foreach ($query as $value1){
                        foreach ($value1 as $value){
                            $newString[]=$value;
                        }
                    }
                    $string=implode(", ", $newString);
                    $rs['weekday']  = $string;
                }
                $merge[] = $rs;
            }
            return $merge;
        }
    }

    /* @method : get_patient_procedure_search_details
     * @params:
     * @desc: get_patient_procedure_search_details  method is used for fetching procedure details
     */
    public function get_patient_procedure_search_details(){
        $user_id = $this->session->userdata('user_id');
        $city = $this->input->post('city');
        $procedure_cat_id = $this->input->post('procedure_cat_id');
        $search = $this->input->post('search');
        //add all data to session
                $newdata = array(
                    'city'       => $city,
                    'procedure_cat_id'     => $procedure_cat_id,
                    'search'    => $search,
                );

            $this->session->set_userdata($newdata);

        $data =  $this->db->query("SELECT DISTINCT hp.ID,hp.procedure_name ,hp.description, hp.price ,hs.name, hs.latitude , hs.longitude, hs.userid,  husr.picture ,(SELECT COUNT(*) FROM hrecommendedprocedure AS hrecmd WHERE hrecmd.specialist_user_id = hp.userid AND hrecmd.procedure_cat_id = hp.procedure_cat_id AND hrecmd.procedure_id = hp.ID and hrecmd.patient_user_id = '$user_id') AS recomend FROM (hspecialist hs INNER JOIN hprocedure hp ON hs.userid = hp.userid) INNER JOIN huser husr ON hs.userid = husr.ID WHERE hs.city= '$city' AND hp.procedure_cat_id = '$procedure_cat_id' And hp.procedure_name like '%$search%' ");
        $rsr = $data->result_array();
        if(!empty($rsr)){
            $merge = array();
            foreach($rsr as $rs){
                $this->db->distinct();
                $this->db->select('weekday');
                $this->db->from('hworkinghours');
                $this->db->where('userid', $rs['userid']);
                $query = $this->db->get()->result_array();
                    if(!empty($query)){

                    foreach ($query as $value1){
                        foreach ($value1 as $value){
                            $newString[]=$value;
                        }
                    }
                    $string=implode(", ", $newString);
                    $rs['weekday']  = $string;
                }
                $merge[] = $rs;
            }
            return $merge;
        }
    }

    /* @method : get_filter_search_details_by_city
     * @params:
     * @desc: get_filter_search_details_by_city  method is used for fetching procedure details by city name
     */
    public function get_filter_search_details_by_city($city){
        $user_id = $this->session->userdata('user_id');
        $data =  $this->db->query("SELECT hp.procedure_name ,hp.ID, hp.description , hs.name,hs.latitude , hs.longitude, hp.price ,hs.userid, husr.picture, (SELECT COUNT(*) FROM hrecommendedprocedure AS hrecmd WHERE hrecmd.specialist_user_id = hp.userid AND hrecmd.procedure_cat_id = hp.procedure_cat_id AND hrecmd.procedure_id = hp.ID and hrecmd.patient_user_id = '$user_id') AS recomend FROM (hspecialist hs INNER JOIN hprocedure hp ON hs.userid = hp.userid) INNER JOIN huser husr ON hs.userid = husr.ID  WHERE hs.city = '$city' ");
        $rsr = $data->result_array();
        if(!empty($rsr)){
            $merge = array();
            $result=array();
            $dayM='';
            foreach($rsr as $rs){
                    if(!array_key_exists($rs['userid'], $merge)){
                    $this->db->distinct();
                    $this->db->select('weekday');
                    $this->db->from('hworkinghours');
                        $this->db->where('userid', $rs['userid']);
                        $query = $this->db->get()->result_array();
                        $newString= array();
                        if(!empty($query)   ){
                            foreach ($query as $value1){
                                foreach ($value1 as $value){
                                    $newString[]=$value;
                                }
                            }
                            $string = implode(", ", $newString);
                            $merge[$rs['userid']] = $string;
                            $result[] = array_merge( $rs, array('weekday'  => $string ) );
                        }
                }
                else{
                    $result[] = array_merge( $rs, array( 'weekday' => $merge[$rs['userid']] ) );
                }
            }
            return $result;
        }
    }



    /* @method : get_filter_search_data
     * @params:
     * @desc: get_filter_search_data method is used for fetching search filter details
     */
   public function get_filter_search_data($list){
       
       
        $city = $list['location'];
        $zip = $list['zip'];
        $miles = $list['km'];
        
        $procedure_name_id = $list['procedure_name'];
        $procedure_cat_id = $list['procedure_cat'];
      
        $icnt = 0;
        $user_id = $this->session->userdata('userid');
       //-----------CHECK lat long based on zip and city ---------------//

            $zips = $this->get_data_nearest_city($city, $zip, $miles);
          
      
        $query = "SELECT DISTINCT hp.ID, hp.procedure_name ,hp.description,hs.title, hp.from_price, hp.to_price, hs.name, hs.latitude, hs.longitude, hs.userid, hs.picture FROM (hspecialist hs INNER JOIN hprocedure hp ON hs.userid = hp.user_id) INNER JOIN huser husr ON hs.userid = husr.ID INNER JOIN hproceduretimeslot hslot on ( hslot.procedure_id=hp.ID AND hslot.specialist_id=hp.user_id) WHERE hs.location= '$city' AND hp.procedure_cat_id = '$procedure_cat_id' AND hs.zip IN (".$zips.") AND hp.MPID = '$procedure_name_id'  ";
       
       $icnt++;
        $weekdays = '';
        if(!empty($list['weekday'])){
            $days = implode(',', $list['weekday'] );
            if($icnt == 0){
                $weekdays = $days;
                 if( $weekdays != 'any'){
                    $query .= " WHERE hslot.weekday IN ($weekdays) " ;
                 }
            }else{
                $weekdays = $days;
                 if( $weekdays != 'any'){
                    $query .=  " AND hslot.weekday IN ('$weekdays') " ;
                 }
            }
            $icnt++;
        }

        if(isset($list['max_price']) && !empty($list['max_price'])){
            if($icnt == 0){
                 $max = $list['max_price'];
                 $min = $list['min_price'];
                $query .= " WHERE hp.from_price >= $min AND hp.to_price <= '$max' " ;
            }else{
                $max = $list['max_price'];
                 $min = $list['min_price'];
                $query .= " AND  hp.from_price >= $min AND hp.to_price <= '$max' " ;
            }
            $icnt++;
        }

        if(isset($list['hrs_from']) && !empty($list['hrs_from'] )){
            if($icnt == 0){
                $from = $list['hrs_from'];
                $to = $list['hrs_to'];
                $query .= " WHERE hslot.slot >='$from' AND hslot.slot <= '$to' " ;
            }else{
                $from = $list['hrs_from'];
                $to = $list['hrs_to'];
                $query .= " AND hslot.slot >='$from' AND hslot.slot <= '$to' " ;
            }
            $icnt++;
        }


        if(isset($list['language']) && !empty($list['language'])){
            if($icnt == 0){
                $language = implode(',', $list['language'] );
                if( $language != 'any'){
                    $query .= " WHERE hs.language like '$language' " ;
                }
            }else{
                $language = implode(',', $list['language'] );
                if( $language != 'any'){
                    $query .= " AND hs.language like '$language' " ;
                }
            }
            $icnt++;
        }

        if(isset($list['seeChild']) && $list['seeChild'] != ''){
            
            if($icnt == 0){
                $see_children = $list['seeChild'];
                $query .= " WHERE hs.see_children = '$see_children' " ;
            }else{
                $see_children = $list['seeChild'];
                $query .= " AND hs.see_children = '$see_children' " ;
            }
            $icnt++;
        }
       
        if($icnt > 0){
            $query .= " AND hp.status = 1 AND hs.status = 1 ";
        }
        else {
            $query .= " WHERE hp.status = 1 AND hs.status = 1 ";
        }
       
        $data =  $this->db->query($query);
        $rsr = $data->result_array();
        if(!empty($rsr)){
            $merge = array();
            foreach($rsr as $rs){
                $prid = $rs['ID'];
                $data =  $this->db->query("SELECT DISTINCT hmasterstaff.staff_name , hstf.staff_pic , hstaffcat.staff_cat_name FROM ( hprocedurestaff hmasterstaff INNER JOIN hstaff hstf ON hmasterstaff.staff_cat_id = hstf.staff_cat_id ) INNER JOIN hstaffcategory hstaffcat ON hstf.staff_cat_id = hstaffcat.ID  WHERE hmasterstaff.procedure_id = '$prid' ");
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
                $merge[] = $rs;
            }
           return $merge;
        }

     }

    /* @method : get_time_list_for_patient
     * @params: $data
     * @desc: get_time_list_for_patient method is used for fetching time slot
     */
    public function get_time_list_for_patient($data){

        $prID = base64_decode($data['prID_']);
        $spID = base64_decode($data['spID_']);

        $this->db->select('time_slot');
        $this->db->from('hproceduredate');
        $this->db->where('date' , $data['date']);
        $this->db->where('procedureid' , $prID );
        $this->db->where('doctorid' , $spID);
        $res =$this->db->get()->result_array();
        if(!empty($res)){
            return $res;
        }else{
            return false;
        }
    }
    
    
    /* @method : get_filter_slots_data
     * @params:
     * @desc: get_filter_slots_data method is used for fetch slot based on week dates data
     */
    public function get_filter_slots_data($prId, $dcId){

        $day_start = date( "d" );

        for ( $x = 0; $x < 7; $x++ ){
            $week_days[] = date( "w", mktime( 0, 0, 0, date( "m" ), $day_start + $x, date( "y" ) ) ); // create weekdays array.
        }
//        print_R($week_days);
        // week dates from cureent date //
        for ( $p = 0; $p < 7; $p++ ){
            $dates[] = date( "Y-m-d", mktime( 0, 0, 0, date( "m" ), $day_start + $p, date( "y" ) ) );
        }

        $output =array();
        $total = count($week_days);
        for ( $i = 0; $i < $total; $i++ ){
            if($week_days[$i] == 0){
                $week_days[$i] = 7;
            }
            $query = "SELECT slot,weekday FROM hproceduretimeslot WHERE specialist_id = '$dcId' AND procedure_id = '$prId' AND weekday = '$week_days[$i]'";
            $data =  $this->db->query($query);
            $output[] = $data->result_array();
        }

        $icnt=0;
        $output_working_solts=array();
        foreach($output as $current_date_slot_arr)
        {
            $query1 = "SELECT time_slot FROM hproceduredate WHERE doctorid = '$dcId' AND procedureid = '$prId' AND date = '$dates[$icnt]' AND  availability = '0' ";
            $data1 =  $this->db->query($query1);
            $slot_availbility_arr_2d = $data1->result_array();
            $output_working_solts[]=$this->removeElementWithValue($current_date_slot_arr,$slot_availbility_arr_2d);
            $icnt++;
        }
        return $output_working_solts;

    }


    /* @method : get_filter_slots_data_next_slots
     * @params:
     * @desc: get_filter_slots_data_next_slots method is used to fetch next and previous week slots based on dates
     */
    public function get_filter_slots_data_next_slots($prId, $dcId , $dates){

        $curday = $dates[0];
        $day_start = date($curday );
        for ( $x = 0; $x < 7; $x++ ){
//            $week_days[] = date( "w", mktime( 0, 0, 0, date( "m" ), $day_start + $x, date( "y" ) ) ); // create weekdays array.
            $week_days[]=date('N', strtotime($dates[$x]));
        }
//    print_R($week_days);
        
        $output_next =array();
        $total = count($week_days);
        for ( $i = 0; $i < $total; $i++ ){
            if($week_days[$i] == 0){
                $week_days[$i] = 7;
            }
            $query = "SELECT slot, weekday  FROM hproceduretimeslot WHERE specialist_id = '$dcId' AND procedure_id = '$prId' AND weekday = '$week_days[$i]'";
            $data1 =  $this->db->query($query);
            $output_next[] = $data1->result_array();
        }
 
        $icnt=0;
        $output_working_solts_next =array();
        foreach($output_next as $current_date_slot_arr1)
        {
            $query1 = "SELECT time_slot FROM hproceduredate WHERE doctorid = '$dcId' AND procedureid = '$prId' AND date = '$dates[$icnt]' AND  availability = '0' ";
            $data1 =  $this->db->query($query1);
            $slot_availbility_arr_2d_next = $data1->result_array();
            $output_working_solts_next[]=$this->removeElementWithValue($current_date_slot_arr1 , $slot_availbility_arr_2d_next);
            $icnt++;
        }
//        print_R($output_working_solts_next);
       return $output_working_solts_next;


    }


   public function removeElementWithValue($source_arrays, $remove_arrays){
       foreach ($remove_arrays as $singlevalue) {
           $icnt=0;
            foreach($source_arrays as $single_source_array)
            {
                if($singlevalue["time_slot"]==$single_source_array["slot"])
                {
                    break;
                }
                $icnt++;
            }
           unset($source_arrays[$icnt]);
           array_values($source_arrays);
       }
       return $source_arrays;
   }
    
    
    
    /* @method : save_booking_details
     * @params:
     * @desc: save_booking_details method is used for saving booking data
        
            *  this function is used when patient is looged in and  book appoitment    
     */
        public function save_booking_details(){
            
            //$this->db->trans_start()
                
            $user_id = $this->session->userdata('userid');
            
            $time_slot = $this->input->post('time_slot');
            $doc_id = $this->input->post('doc_id');
            $pr_id = $this->input->post('pr_id');
            $date = $this->input->post('date');
            $home_phy_id = $this->input->post('home_phy_id');

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
                    'patient_user_id' => $user_id,
                    'homephy_id' => $home_phy_id,
                );
                $this->db->insert('hbooking',$data);
                
                
                

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
                
                
                 return true;
            }
            else{
                return false;   
            }
            //$this->db->trans_complete();
    }
    
    
    /* @method : save_register_booking_details
     * @params:
     * @desc: save_register_booking_details method is used for saving user and booking data
     */
        public function save_register_booking_details($postdata){
            
            
            //$patient_id = $this->session->userdata('userid');
            
            $time_slot = $postdata['time_slot'];
            $doc_id = $postdata['doc_id'];
            $pr_name_id = $postdata['pr_id']; 
            $date = $postdata['date'];
            
            $patient_id = $postdata['userid'];
            
            //-------- looged in user  ------------- // 
            $this->db->select('refered_by');
            $this->db->from('hpatient');
            $this->db->where('userid' , $patient_id);
            $sp1 = $this->db->get()->row();
            $hp_user_id = $sp1->refered_by ;  // refered by id for home phy table user_id
         
             //-------- check if booking is already exist or not--------------- //
            
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
                    'patient_user_id' => $patient_id,
                );
                $this->db->insert('hbooking',$data); // Booking save done

            
            // -------- end of block ----------------//

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
             
             
              //-------------------------------end of block ----------------------------//
        
            // ------------- sending mail to patient about booking --------------------- //
            
//                $this->db->select('email, name');
//                $this->db->from('hspecialist');
//                $this->db->where('ID' , $doc_id);
//                $sp = $this->db->get()->row();
//                $emailSp = $sp->email ;  // for mailing purpose //
//                $nameSp = $sp->name ;
//
//                $this->db->select('procedure_name');
//                $this->db->from('hmasterprocedure');
//                $this->db->where('ID' , $pr_name_id);
//                $pr = $this->db->get()->row();
//                if(!empty($pr)){
//                    $prname = $pr->procedure_name ; 
//                }else{
//                   $prname = ''; 
//                }
//            
//                $this->db->select('from_price, to_price');
//                $this->db->from('hprocedure');
//                $this->db->where('user_id' , $doc_id);
//                $spprice = $this->db->get()->row();
//                $sppricefrom = $spprice->from_price ;  // for mailing purpose //
//                $sppriceto = $spprice->to_price ;
//            
//               
//                $email['fromname'] = "HCare";
//                $email['to'] = $emailp; 
//                $email['subject'] = "Booking with $nameSp at $date ";
//
//                
//                 $email['message'] = '<tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:30px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200"><p>Dear '.$firstname.' </p></td>
//
//                  </tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 6% 5px 7.5%;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>Thanks for making Booking with '.$nameSp.' Here is your Booking details
//                  <p> 
//                        Procedure Name : '.$prname.'
//                   </p>   
//                   <p> 
//                        Price : '.$sppricefrom.'-'.$sppriceto.'
//                   </p>
//                    <p> 
//                        Date : '.$date.'
//                   </p>   
//                   <p> 
//                        Time : '.$time_slot.'
//                   </p>
//                  <p></p></td></tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>Best,<br> Hcare Group</p></td></tr>';
//
//            $isSend = hcare_email($email);
                
            return true;
                
        }else{
            return false;    
                
         }
            
    }
    
    

    /* @method : list_procedure
     * @params:
     * @desc: list_procedure method is used for listing procedure details
     */
    public function list_procedure($limit='', $start=''){

        $userid = $this->session->userdata('userid');
        $this->db->select('hprocedure.ID AS procedureid, hprocedurecategory.category_name, hprocedure.procedure_name, hprocedure.to_price,                             hprocedure.from_price, COUNT(hprocedurestaff.ID) AS staff, COUNT(hreview.procedure_id) AS reviews');
        $this->db->from('hprocedurecategory');
        $this->db->join('hprocedure','hprocedurecategory.ID = hprocedure.procedure_cat_id');
        $this->db->join('hprocedurestaff','hprocedurestaff.procedure_id = hprocedure.ID', 'left');
        $this->db->join('hreview', 'hprocedure.ID = hreview.procedure_id', 'left');
        $this->db->group_by('hprocedure.ID');
        $this->db->where('hprocedure.status', 1);
        $this->db->where('hprocedure.user_id', $userid);
        if($limit!='' && $start!=''){ 
            
            $offset = ($start!='0') ? ($start - 1) * $limit : '0';
            $this->db->limit($limit, $offset); 
        }
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $result = $query->result();
            return $result;
        }
    }

    /* @method : procedure_booking_details
     * @params:
     * @desc: procedure_booking_details method is used for fetching procedure wise booking details
     */
    public function procedure_booking_details(){
        $this->db->select('hprocedure.ID AS pid, hbooking.ID as bookingid, hbooking.status');
        $this->db->from('hprocedure');
        $this->db->join('hbooking','hbooking.procedure_id = hprocedure.ID');
        $this->db->where('hprocedure.status', 1);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $result = $query->result();
            return $result;
        }
    }

    /* @method : bulk procedure_delete
     * @params: $procedureid
     * @desc:  bulk procedure_delete method is used for deleting a particular procedure
     */
    public function bulk_delete_procedure($procedureids){
        $ids = implode(',',$procedureids);
        $where = " ID IN (".$ids.")";
        $this->db->where($where);
        $this->db->update('hprocedure',array('status' => 0));
        if($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /* @method : procedure_delete
     * @params: $procedureid
     * @desc: procedure_delete method is used for deleting a particular procedure
     */
    public function procedure_delete($procedureid){
        $this->db->where('ID',$procedureid);
        $this->db->update('hprocedure',array('status' => 0));
        if($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
     public function get_procedure_names_wise($id){
        $this->db->select("ID, procedure_name");
        $this->db->from('hmasterprocedure');
        $this->db->where("procedure_cat_id",  $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    
     /* @method : update_procedure_data
     * @params:
     * @desc: update_procedure_data method is used for update procedure data
     */
    public function update_procedure_data($id){
        $id = $this->db->escape_str($id);  
        $user_id = $this->session->userdata('userid');

        /* data for time slotes  */
        $monday = $this->input->post('mon_slots');
        $tues = $this->input->post('tues_slots');
        $wed = $this->input->post('wed_slots');
        $thus = $this->input->post('thus_slots');
        $fri = $this->input->post('fri_slots');
        $sat = $this->input->post('sat_slots');
        $sunday = $this->input->post('sun_slots');           
         
        /* data for time new slotes  */
        $monday_new = $this->input->post('mon_slots_update');
        $tues_new = $this->input->post('tues_slots_update');
        $wed_new = $this->input->post('wed_slots_update');
        $thus_new = $this->input->post('thus_slots_update');
        $fri_new = $this->input->post('fri_slots_update');
        $sat_new = $this->input->post('sat_slots_update');
        $sunday_new = $this->input->post('sun_slots_update');
         
        /* data for slotes seats  */
        $mon_slots_seats = $this->input->post('mon_slots_seats');
        $tues_slots_seats = $this->input->post('tues_slots_seats');
        $wed_slots_seats = $this->input->post('wed_slots_seats');
        $thus_slots_seats = $this->input->post('thus_slots_seats');
        $fri_slots_seats = $this->input->post('fri_slots_seats');
        $sat_slots_seats = $this->input->post('sat_slots_seats');
        $sun_slots_seats = $this->input->post('sun_slots_seats');

        /* data for procedure  */
        $procedure_cat_id = $this->input->post('procedure_cat');
        $MPID = $this->input->post('MPID');
        $procedure_name = $this->input->post('procedure_name_selected');
        $hour_slot = $this->input->post('appt_per_slots');
        $description = $this->input->post('description');
        $from_amount = $this->input->post('from_amount');
        $to_amount = $this->input->post('to_amount');            

        $prc = array(
                 'user_id' => $user_id,
                 'MPID' => $MPID,
                 'procedure_cat_id' => $procedure_cat_id,
                 'procedure_name' => $procedure_name ,
                 'description' => $description ,
                 'hourly_appt' => $hour_slot,
                 'from_price' => $from_amount,
                 'to_price' => $to_amount,
        );
        $this->db->where('ID', $id); 
        $this->db->update('hprocedure', $prc );             
        // monday slot save and update//
         
        /* data for time new slotes  */
        $monday_new = $this->input->post('mon_slots_update');
        $tues_new = $this->input->post('tues_slots_update');
        $wed_new = $this->input->post('wed_slots_update');
        $thus_new = $this->input->post('thus_slots_update');
        $fri_new = $this->input->post('fri_slots_update');
        $sat_new = $this->input->post('sat_slots_update');
        $sunday_new = $this->input->post('sun_slots_update');             
         
        /* data for staff  */
        $staff_cat_id = $this->input->post('staff_cat_id');
        $staff_id = $this->input->post('staff_id');
        $staff_name = $this->input->post('staff_name');
        $staff_pic = $this->input->post('staff_pic');
        $staff_cat = $this->input->post('staff_cat_type');

        /* saving data into hprocedurestaff table */
        $this->db->where('procedure_id', $id);            
        $this->db->delete('hprocedurestaff');             
         
        if(isset($staff_cat_id)){
            $totalstf = count($staff_cat_id);
            for($k=0; $k < $totalstf ;  $k++) {                
                $pic = (!empty($staff_pic)) ? $staff_pic[$k] : '';
                $name = (!empty($staff_name)) ? $staff_name[$k] : '';                
                $stf_id = (!empty($staff_id)) ? $staff_id[$k] : ''; 

                $staff = array(
                    'procedure_id' => $id,
                    'staff_cat_id' => $staff_cat_id[$k] ,
                    'staff_id' => $staff_id[$k] ,
                    'staff_name' => $name ,
                    'staff_category' => $staff_cat[$k],
                    'staff_pic' => $pic,
                );
                $this->db->insert('hprocedurestaff', $staff );
            }
        }

        // saving and updating slot data //                
        $icnt = 0;
        if(!empty($monday)){
            foreach($monday_new as $slot){
                if($slot > 0){
                    $data = array(
                        'specialist_id' => $user_id,
                        'procedure_id' => $id,
                        'weekday' => 1,
                        'slot' => $monday[$icnt],
                        'seats' => $mon_slots_seats[$icnt],
                    );
                    $this->db->where('ID', $slot);
                    $this->db->update('hproceduretimeslot',$data);
                }else{
                    $data1 = array(
                        'specialist_id' => $user_id,
                        'procedure_id' => $id,
                        'weekday' => 1,
                        'slot' => $monday[$icnt],
                        'seats' => $mon_slots_seats[$icnt],
                    );
                    $this->db->insert('hproceduretimeslot',$data1);
                }
                $icnt++;
            }
        }
        
        // tues slot save and update//
        $icnt=0;
        if(!empty($tues)){
            foreach($tues_new as $tuesslot){
                if($tuesslot > 0){
                    $data = array(
                        'specialist_id' => $user_id,
                        'procedure_id' => $id,
                        'weekday' => 2,
                        'slot' => $tues[$icnt],
                        'seats' => $tues_slots_seats[$icnt],
                    );
                    $this->db->where('ID', $tuesslot);
                    $this->db->update('hproceduretimeslot',$data);
                }else{
                    $data1 = array(
                        'specialist_id' => $user_id,
                        'procedure_id' => $id,
                        'weekday' => 2,
                        'slot' => $tues[$icnt],
                        'seats' => $tues_slots_seats[$icnt],
                    );
                    $this->db->insert('hproceduretimeslot',$data1);
                }
                $icnt++;
            }
        }
         
        // wed slot save and update//             
        if(!empty($wed)){
            $icnt=0;
            foreach($wed_new as $wedslot){
                if($wedslot > 0){
                    $data = array(
                        'specialist_id' => $user_id,
                        'procedure_id' => $id,
                        'weekday' => 3,
                        'slot' => $wed[$icnt],
                        'seats' => $wed_slots_seats[$icnt],
                    );
                    $this->db->where('ID', $wedslot);
                    $this->db->update('hproceduretimeslot',$data);
                }else{
                    $data1 = array(
                        'specialist_id' => $user_id,
                        'procedure_id' => $id,
                        'weekday' =>3,
                        'slot' => $wed[$icnt],
                        'seats' => $wed_slots_seats[$icnt],
                    );
                    $this->db->insert('hproceduretimeslot',$data1);
                }
                $icnt++;
            }
        }
        
        // thues slot save and update//
        if(!empty($thus)){
            $icnt=0;
            foreach($thus_new as $thusslot){
                if($thusslot > 0){
                    $data = array(
                        'specialist_id' => $user_id,
                        'procedure_id' => $id,
                        'weekday' => 4,
                        'slot' => $thus[$icnt],
                        'seats' => $thus_slots_seats[$icnt],
                    );
                    $this->db->where('ID', $thusslot);
                    $this->db->update('hproceduretimeslot',$data);
                }else{
                    $data1 = array(
                        'specialist_id' => $user_id,
                        'procedure_id' => $id,
                        'weekday' => 4,
                        'slot' => $thus[$icnt],
                        'seats' => $thus_slots_seats[$icnt],
                    );
                    $this->db->insert('hproceduretimeslot',$data1);
                }
                $icnt++;
            }
        }
        
        // fri slot save and update//
        if(!empty($fri)){
            $icnt=0;
            foreach($fri_new as $frislot){
                if($frislot > 0){
                    $data = array(
                        'specialist_id' => $user_id,
                        'procedure_id' => $id,
                        'weekday' => 5,
                        'slot' => $fri[$icnt],
                        'seats' => $fri_slots_seats[$icnt],
                    );
                    $this->db->where('ID', $frislot);
                    $this->db->update('hproceduretimeslot',$data);
                }else{
                    $data1 = array(
                        'specialist_id' => $user_id,
                        'procedure_id' => $id,
                        'weekday' => 5,
                        'slot' => $fri[$icnt],
                        'seats' => $fri_slots_seats[$icnt],
                    );
                    $this->db->insert('hproceduretimeslot',$data1);
                }
                $icnt++;
            }
        }
         
        // sat slot save and update//
        if(!empty($sat)){
            $icnt=0;
            foreach($sat_new as $satslot){
                if($satslot > 0){
                    $data = array(
                        'specialist_id' => $user_id,
                        'procedure_id' => $id,
                        'weekday' => 6,
                        'slot' => $sat[$icnt],
                        'seats' => $sat_slots_seats[$icnt],
                    );
                    $this->db->where('ID', $satslot);
                    $this->db->update('hproceduretimeslot',$data);
                }else{
                    $data1 = array(
                         'specialist_id' => $user_id,
                         'procedure_id' => $id,
                         'weekday' => 6,
                         'slot' => $sat[$icnt],
                         'seats' => $sat_slots_seats[$icnt],
                    );
                    $this->db->insert('hproceduretimeslot',$data1);
                }
                $icnt++;
            }
        }
        
        // sun slot save and update//
        if(!empty($sunday)){
            $icnt=0;
            foreach($sunday_new as $sunslot){
                if($sunslot > 0){
                    $data = array(
                        'specialist_id' => $user_id,
                        'procedure_id' => $id,
                        'weekday' => 7,
                        'slot' => $sunday[$icnt],
                        'seats' => $sun_slots_seats[$icnt],
                    );
                    $this->db->where('ID', $sunslot);
                    $this->db->update('hproceduretimeslot',$data);
                }else{
                    $data1 = array(
                        'specialist_id' => $user_id,
                        'procedure_id' => $id,
                        'weekday' => 7,
                        'slot' => $sunday[$icnt],
                        'seats' => $sun_slots_seats[$icnt],
                    );
                    $this->db->insert('hproceduretimeslot',$data1);
                }
                $icnt++;
            }
        }
        return true;
    }

     /* get data based on zip location */
    
        public function get_data_nearest_city($city, $zip, $distance){
           
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
            
                
                    $dist = $distance / 1.609344;
                        $sql = "SELECT distinct zip, (((acos(sin((".$lat."*pi()/180)) * sin((Latitude*pi()/180))+cos((".$lat."*pi()/180)) * cos((Latitude*pi()/180)) * cos(((".$long."-Longitude)*pi()/180))))*180/pi())*60*1.1515) AS distance FROM hspecialist HAVING distance <= $dist ORDER BY distance";
                        $data =  $this->db->query($sql);
                        $output = $data->result_array();
                        $newString1 = array();
                        foreach ($output as $value1){
                            $newString1[]= "'" . $value1['zip'] . "'"; ;
                        }
                        $ziptemp = implode(",", $newString1);
            
                        return $ziptemp;
            
        }
    

}
