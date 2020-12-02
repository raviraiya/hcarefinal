<?php
class Admin_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /* @method : add_admin
     * @params:
     * @desc: add_admin method is used for adding admin
     */
    public function add_admin(){
        $configUpload['upload_path']    = '/application/uploads/';                 #the folder placed in the root of project
        $configUpload['allowed_types']  = 'gif|jpg|png|bmp|jpeg';       #allowed types description
        $configUpload['max_size']       = '0';                          #max size
        $configUpload['max_width']      = '0';                          #max width
        $configUpload['max_height']     = '0';                          #max height
        $configUpload['encrypt_name']   = true;                         #encrypt name of the uploaded file
        $this->load->library('upload', $configUpload);                  #init the upload class
        if(!$this->upload->do_upload('picture')){
            $uploadedDetails = $this->upload->display_errors();
        }else{
            $uploadedDetails = $this->upload->data();
        }
        $image_path = $this->upload->data('picture');
        $data=array(
            'username'=>$this->input->post('username'),
            'password'=> md5($this->input->post('password')),
            'email'=>$this->input->post('email'),
            'picture' => $image_path['full_path'],
        );

        if($this->db->insert('hadmin',$data)){
            return true;
        }
    }

    /* @method : admin_login
     * @params:
     * @desc: admin_login method is used for admin login
     */
    function admin_login($username,$password){
        $this->db->where("username",$username);
        $this->db->where("password",MD5($password));
        $query = $this->db->get("hadmin");
        //echo $this->db->last_query();die(); 
        if($query->num_rows() > 0){
            foreach($query->result() as $rows){
                //add all data to session
                $newdata = array(
                    'usertype'     =>'admin',
                    'user_id'       => $rows->ID,
                    'user_name'     => $rows->username,
                    'user_email'    => $rows->email,
                    'logged_in'     => TRUE,
                );
            }

            $this->session->set_userdata('newdata',$newdata);
            return true;
        }
        return false;
    }

    function emptyToken($user_id){
        $this->db->where('ID', $user_id);
        $this->db->update('hadmin', array('rem_token' => ''));
        
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function update_token($set = array()){
        $this->db->where('ID', $set['user_id']);
        $this->db->update('hadmin', array('rem_token' => $set['token']));
        
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /* @method : get_physican
     * @params:
     * @desc: get_physican method is used for get data of home physican
     */
    public function get_physican($id){
        $query = $this->db->get_where('hhomephysician', array('ID' => $id));
        return $query->row_array();
    }

    /* @method : get_patient
     * @params:
     * @desc: get_patient method is used for get data of patient
     */
    public function get_patient(){
        $this->db->select("*");
        $this->db->from("hpatient");
        $query = $this->db->get();
        return $query->result();
    }

    /* @method : get_procedure_cat
     * @params:
     * @desc: get_procedure_cat method is used for get data of procedure category
     */
    public function get_procedure_cat($id = ''){
        $this->db->select("*");
        $this->db->from("hprocedurecategory");
        if(!empty($id)){
            $this->db->where('ID', $id);
        }
        $query = $this->db->get();
        return $query->result();
    }   

    /* @method : add_procedure_cat
     * @params:
     * @desc: add_procedure_cat method is used add data of procedure category
     */
    public function add_procedure_cat($data){
        $this->db->insert("hprocedurecategory",$data);
        if($this->db->insert_id() > 0){
            return TRUE;
        }else{
            FALSE;
        }
    }   

    /* @method : add_procedure
     * @params:
     * @desc: add_procedure method is used add data of procedure 
     */
    public function add_procedure($data){
        $this->db->insert("hmasterprocedure",$data);
        if($this->db->insert_id() > 0){
            return TRUE;
        }else{
            FALSE;
        }
    }   

    /* @method : update_procedure_cat
     * @params:
     * @desc: update_procedure_cat method is used update data of procedure category
     */
    public function update_procedure_cat($id, $data){
        $this->db->where('ID', $id); 
        $this->db->update("hprocedurecategory",$data);
        if($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            FALSE;
        }
    }

    /* @method : get_patient_status
     * @params:
     * @desc: get_patient_status method is used for get data of physican status
     */
    public function get_patient_status($id){
        $this->db->select("status");
        $this->db->from("hpatient");
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    /* @method : get_patient_status
     * @params:
     * @desc: get_patient_status method is used for get data of physican status
     */

    public function get_specialist_status($id){
        $this->db->select("status");
        $this->db->from("hspecialist");
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    /* @method : get_Homephysican_status
     * @params:
     * @desc: get_Homephysican_status method is used for get data of home physican status
     */
    public function get_Homephysican_status($id){
        $this->db->select("status");
        $this->db->from("hhomephysician");
        $this->db->where('id', $id);

        return $this->db->get()->row();
    }

    /* @method : change_status
     * @params:
     * @desc: change_status method is used for change status of patient 
     */
    public function change_status($stats, $id){
        $data = array(
            'status' => $stats,
        );
        $this->db->where('ID', $id);
        $reuslt = $this->db->update('hpatient', $data);
        return $reuslt;
    }

    /* @method : change_status
     * @params:
     * @desc: change_status method is used for change status of patient
     */
    public function change_specialist_status($stats, $id){
        $data = array(
            'status' => $stats,
        );
        $this->db->where('ID', $id);
        $result = $this->db->update('hspecialist', $data);
        return $result;
    }

    /* @method : change_phys_status
     * @params:
     * @desc: change_phys_status method is used for change status of physican
     */
    public function change_phys_status($stats, $id){
        $data = array(
            'status' => $stats,
        );
        $this->db->where('ID', $id);
        $reuslt = $this->db->update('hhomephysician', $data);
        return $reuslt;
    }

    /* @method : get_home_physican
     * @params:
     * @desc: get_home_physican method is used for get data of home physican
     */
    public function get_home_physican(){
        $this->db->select("*");
        $this->db->from("hhomephysician");
        $query = $this->db->get();
        return $query->result();
    }

    /* @method : edit
     * @params:
     * @desc: edit method is used for edit data of home physican
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

        $this->db->where('ID', $id);
        $this->db->update('hhomephysician', $data);
        $this->db->trans_complete();
    }

    /* @method : view_details
     * @params:
     * @desc: view_details method is used for get details of home physican
     */
    public function view_details(){
        $query = $this->db->get('hhomephysician');
        return $query->row_array();
    }

    /* @method : edit_user
     * @params:
     * @desc: edit_user method is used for edit data of user
     */
    public function edit_user($id){
        $this->db->trans_start();
        $data=array(
            'username'=>$this->input->post('username'),
            'fname'=>$this->input->post('fname'),
            'lname'=>$this->input->post('lname'),
            //'picture'=> $image_path['full_path'],
        );

        $this->db->where('ID', $id);
        $this->db->update('huser', $data);
        $this->db->trans_complete();
    }

    /* @method : get_specialist_details
     * @params:
     * @desc: get_specialist_details method is used for fetching specialist details
     */
    public function get_specialist_details(){
        $query = $this->db->get('hspecialist');
        return $query->result();
    }

    /* @method : get_user
     * @params:
     * @desc: get_user method is used for get data of user
     */
    public function get_user() {
        $this->db->select("*");
        $this->db->from("huser");
        $query = $this->db->get();
        return $query->result();
    }

    /* @method : get_user_detail
     * @params:
     * @desc: get_user_detail method is used for get details of user
     */
    public function get_user_detail($id){
        $query = $this->db->get_where('huser', array('ID' => $id));
        return $query->row_array();
    }

    /* @method : get_all_sp_phy_list
     * @params:
     * @desc: get_all_sp_phy_list method is used for get details of all specialist and phy
     */
    public function get_all_sp_phy_list(){
        $data =  $this->db->query("SELECT hs.ID,hs.name, hs.address, hs.licence_no, hs.licence_city , hs.licence_state , hu.usertype FROM (hspecialist hs INNER JOIN huser hu ON hs.userid = hu.ID)");

        $rsr = $data->result_array();

        $data2 =  $this->db->query("SELECT hphy.ID, hphy.name, hphy.address, hphy.licence_no, hphy.licence_city , hphy.licence_state , hu.usertype FROM (hhomephysician hphy INNER JOIN huser hu ON hphy.userid = hu.ID)");

        $rsr2 = $data2->result_array();
        $output = array_merge($rsr,$rsr2);
        return $output;
    }

    /* @method : save_location
     * @params:
     * @desc: save_location method is used for saving locations
     */
    public function save_location(){
        $data=array(
            'city_id'=>$this->input->post('city_id'),
            'state_id'=>$this->input->post('state_id'),
            'location'=> $this->input->post('location'),
        );

        $this->db->insert(' hlocation', $data);
        return true;
    }

    /* @method : save_admin_procedures
     * @params:
     * @desc: save_admin_procedures method is used for saving admin procedure
     */
    public function save_admin_procedures(){
        $data=array(
            'procedure_cat_id' =>$this->input->post('procedure_cat'),
            'procedure_name' =>$this->input->post('procedure_name'),
        );
        $this->db->insert('hadminprocedure', $data);
        return true;
    }

    /* @method : add_admin_procedures
     * @params:
     * @desc: add_admin_procedures method is used for saving admin procedure
     */
    public function add_admin_procedures(){
        $data=array(
            'procedure_cat_id' =>$this->input->post('procedure_cat_id'),
            'procedure_name' =>$this->input->post('procedure_name'),
        );
        $this->db->insert('hmasterprocedure', $data);
        return true;
    }

    /* @method : get_admin_procedure_listing
     * @params:
     * @desc: get_admin_procedure_listing method is used for fetching all procedure
     */
    public function get_admin_procedure_listing(){
        $this->db->select("*");
        $this->db->from("hadminprocedure");
        $query = $this->db->get();
        return $query->result_array();
    }

    /* @method : get_admin_pro_cat_by_id
     * @params: $id
     * @desc: get_admin_pro_cat_by_id  method is used for fetching procedure by id
     */
    public function get_admin_pro_cat_by_id($id){
        $this->db->select("procedure_cat_id");
        $this->db->from("hadminprocedure");
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    /* @method : get_admin_all_procedure_listing
     * @params:
     * @desc: get_admin_all_procedure_listing method is used for fetching all procedure
     */
    public function get_admin_all_procedure_listing(){
        $this->db->select("*");
        $this->db->from("hmasterprocedure");
        $query = $this->db->get();
        return $query->result_array();
    }

    /* @method : get_admin_pro_cat_name
     * @params: $id
     * @desc: get_admin_pro_cat_name  method is used for fetching procedure name by id
     */
    public function get_admin_pro_cat_name($id){
        $this->db->select("procedure_name");
        $this->db->from("hadminprocedure");
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    /* @method : edit_admin_procedures
     * @params: $id
     * @desc: edit_admin_procedures  method is used for update procedure name by id
     */
    public function edit_admin_procedures($id){
        $data=array(
            'procedure_cat_id' => $this->input->post('procedure_cat'),
            'procedure_name' => $this->input->post('procedure_name'),
        );
        $this->db->where('id', $id);
        $this->db->update('hadminprocedure', $data);
        return true;
    }

    /* @method : get_admin_procedure
     * @params: $id
     * @desc: get_admin_procedure  method is used for fetching procedure by id
     */
    public function get_admin_procedure($id){
        $this->db->select("*");
        $this->db->from("hmasterprocedure");
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    /* @method : update_admin_procedures
     * @params: $id
     * @desc: update_admin_procedures  method is used for updating admin procedure by id
     */
    public function update_admin_procedures($id){
        $data = array(
            'procedure_cat_id' => $this->input->post('procedure_cat_id'),
            'procedure_name' => $this->input->post('procedure_name'),
        );

        $this->db->where('ID', $id);
        $this->db->update('hmasterprocedure', $data);

        $data = array(
            'procedure_cat_id' => $this->input->post('procedure_cat'),
            'procedure_name' => $this->input->post('procedure_name'),
        );
        $this->db->where('MPID', $id);
        $this->db->update('hprocedure', $data);
        return true;
    }

    /* @method : get_all_specialist_name
     * @params:
     * @desc: get_all_specialist_name  method is used for fetching specialist name
     */
    public function get_all_specialist_name(){
        $query = $this->db->get('hspecialist');
        $ress= $query->result();
        $output=array();
        foreach($ress as $res){
            $output[$res->userid]=$res->name;
        }
        return $output;
    }

    /* @method : get_procedure_name_list
     * @params: $id
     * @desc: get_procedure_name_list  method is used for fetching procedure by user id
     */
    public function get_procedure_name_list($userid){
        $ids = implode(',', $userid);
        $query = "SELECT hp.ID,hs.name, hp.procedure_name, hp.procedure_cat_id FROM (hprocedure hp INNER JOIN hspecialist hs ON hp.userid = hs.userid)";
        $query .= " WHERE hp.userid IN ($ids) ";
        $data =  $this->db->query($query);
        $temps = $data->result_array();
        return $temps;
        //        print_R($temps);
    }

    /* @method : get_sp_procedure_status
     * @params:
     * @desc: get_sp_procedure_status  method is used to fetch procedure status
     */
    public function get_sp_procedure_status($id){
        $this->db->select("status");
        $this->db->from("hprocedure");
        $this->db->where('ID', $id);
        return $this->db->get()->row();
    }

    /* @method : change_procedure_status
     * @params:
     * @desc: change_procedure_status  method is used for change procedure status
     */
    public function change_procedure_status($id){
        $data = array(
            'status' => '0'
        );
        $this->db->where('ID', $id);
        $this->db->update('hprocedure', $data);
        return true;
    }

    /* @method : get_all_booking_for_admin
     * @params:
     * @desc: get_all_booking_for_admin  method is used to fetch all booking
     */
    public function get_all_booking_for_admin(){
        $icnt = 0;
        $query = "SELECT DISTINCT hp.procedure_name , hb.booking_date , hb.booking_time, hb.status, hs.name , hpt.username FROM (hbooking hb INNER JOIN hprocedure hp ON hb.procedure_id = hp.ID ) INNER JOIN hspecialist hs ON hb.specialist_user_id = hs.userid INNER JOIN hpatient hpt ON hb.patient_user_id =  hpt.userid";

        $flag = $this->input->post('set_search_filter');
        if(isset($flag)){
            $sp_name = $this->input->post('sp_name');
            $status = $this->input->post('status');
            $booking_to = $this->input->post('booking_to');
            $booking_from = $this->input->post('booking_from');
            if(isset($sp_name) && $sp_name != ''){
                $query .= " WHERE hs.name = '$sp_name' ";
                $icnt++;
            }

            if(isset($status) && $status != ''){
                if($icnt == 0){
                    $query .= " WHERE hb.status =  '$status' " ;
                }else{
                    $query .= " AND hb.status = '$status' " ;
                }
                $icnt++;
            }

            if(isset($booking_from) && $booking_from != ''){
                if($icnt == 0){
                    $query .= " WHERE hb.booking_date BETWEEN '$booking_from' AND '$booking_to' " ;
                }else{
                    $query .= " AND hb.booking_date BETWEEN '$booking_from' AND '$booking_to' "  ;
                }
                $icnt++;
            }
        }

        $data =  $this->db->query($query);
        $rsr = $data->result_array();
        return $rsr;
    }

    /* @method : get_all_specalist_name
     * @params:
     * @desc: get_all_specalist_name  method is used to fetch all specialist name
     */
    public function get_all_specalist_name(){
        $query = $this->db->get('hspecialist');
        $ress= $query->result();
        $output=array();
        $output[""]="Select Specialist Name";
        foreach($ress as $res){
            $output[$res->name]=$res->name  ;
        }
        return $output;
    }

    /* @method : get_booking_list
     * @params:
     * @desc: get_booking_list  method is used to fetch all booking details
     */
    public function get_booking_list($list){
        $icnt = 0;
        $query = "SELECT DISTINCT hp.procedure_name , hb.booking_date , hb.booking_time, hb.status, hs.name , hpt.username FROM (hbooking hb INNER JOIN hprocedure hp ON hb.procedure_id = hp.ID ) INNER JOIN hspecialist hs ON hb.specialist_user_id = hs.userid INNER JOIN hpatient hpt ON hb.patient_user_id =  hpt.userid";

        if(isset($list['sp_name']) && $list['sp_name'] != ''){
            $sp_name = $list['sp_name'];
            $query .= " WHERE hs.name = '$sp_name' ";
            $icnt++;
        }

        if(isset($list['status']) && $list['status'] != ''){
            if($icnt == 0){
                $status = $list['status'];
                $query .= " WHERE hb.status =  '$status' " ;
            }else{
                $status = $list['status'];
                $query .= " AND hb.status = '$status' " ;
            }
            $icnt++;
        }

        if(isset($list['booking_from']) && $list['booking_from'] != ''){
            if($icnt == 0){
                $booking_from =  $list['booking_from'];
                $booking_to =  $list['booking_to'];
                $query .= " WHERE hb.booking_date BETWEEN '$booking_from' AND '$booking_to' " ;
            }else{
                $booking_from =  $list['booking_from'];
                $booking_to =  $list['booking_to'];
                $query .= " AND hb.booking_date BETWEEN '$booking_from' AND '$booking_to' "  ;
            }
            $icnt++;
        }
        $data =  $this->db->query($query);
        $rsr = $data->result_array();
        return $rsr;
    }

    /* @method : get_angular_specialist
     * @params:
     * @desc: get_angular_specialist method is used to fetch all specialist details
     */
    public function get_angular_specialist($qry){
        $data =  $this->db->query($qry);
        $rsr = $data->result();
        return $rsr;
    }

    /* @method : get_angulay_home_physican
     * @params:
     * @desc: get_angulay_home_physican method is used to fetch all homephysican details
     */
    public function get_angular_home_physican($qry){
        $data =  $this->db->query($qry);
        $rsr = $data->result();
        json_encode($rsr);
    }

    /* @method : get_angulay_home_physican
     * @params:
     * @desc: get_angulay_home_physican method is used to fetch all homephysican details
     */
    public function get_angular_patient($qry){
        $data =  $this->db->query($qry);
        $rsr = $data->result();
        json_encode($rsr);
    }

    /* @method : get_angular_all_booking_for_admin
     * @params:
     * @desc: get_angular_all_booking_for_admin  method is used to fetch all booking
     */
    public function get_angular_all_booking_for_admin($query){
        $icnt = 0;
        $flag = $this->input->post('set_search_filter');
        if(isset($flag)){
            $sp_name = $this->input->post('sp_name');
            $status = $this->input->post('status');
            $booking_to = $this->input->post('booking_to');
            $booking_from = $this->input->post('booking_from');
            if(isset($sp_name) && $sp_name != ''){
                $query .= " WHERE hs.name = '$sp_name' ";
                $icnt++;
            }

            if(isset($status) && $status != ''){
                if($icnt == 0){
                    $query .= " WHERE hb.status =  '$status' " ;
                }else{
                    $query .= " AND hb.status = '$status' " ;
                }
                $icnt++;
            }

            if(isset($booking_from) && $booking_from != ''){
                if($icnt == 0){
                    $query .= " WHERE hb.booking_date BETWEEN '$booking_from' AND '$booking_to' " ;
                }else{
                    $query .= " AND hb.booking_date BETWEEN '$booking_from' AND '$booking_to' "  ;
                }
                $icnt++;
            }
        }

        $data =  $this->db->query($query);
        $rsr = $data->result_array();
        json_encode($rsr);
    }

    /* @method : get_admin_all_procedure_listing
     * @params:
     * @desc: get_admin_all_procedure_listing method is used for fetching all procedure
     */
    public function get_angular_admin_all_procedure_listing($qry){
        $data =  $this->db->query($qry);
        $rsr = $data->result_array();
        json_encode($rsr);
    }

    /* @method : get_admin_procedure_listing
     * @params:
     * @desc: get_admin_procedure_listing method is used for fetching all procedure
     */
    public function get_angular_admin_procedure_listing($qry){
        $data =  $this->db->query($qry);
        $rsr = $data->result_array();
        json_encode($rsr);
    }

    /* @method : angular_get_all_sp_phy_list
     * @params:
     * @desc: angular_get_all_sp_phy_list method is used for get details of all specialist and phy
     */
    public function angular_get_all_sp_phy_list($qry1 ,$qry2){
        $rsr = $qry1->result_array();
        $rsr2 = $qry2->result_array();
        $output = array_merge($rsr,$rsr2);
        json_encode($output);
    } 

    public function get_all_procedure(){
        $result = array();
        $this->db->select('hmasterprocedure.ID AS ID, procedure_cat_id, category_name, procedure_name');
        $this->db->from('hprocedurecategory');
        $this->db->join('hmasterprocedure', 'hprocedurecategory.ID = hmasterprocedure.procedure_cat_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result();
        }
        return $result;
    }

    public function update_procedure($id ='', $data = array()){
        $this->db->where('ID', $id);
        $this->db->update('hmasterprocedure', $data);
        if($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function save_admin_sp_data($list){
        $fname = $list['fname'];
        $lname = $list['lname'];
        $name = $list['name'];
        $email = $list['email'];
        $password = $list['password'];
        $saveHsuer = array(
                'name' => $name,
                'password' => md5($password),
                'email' => $email,
                'fname' => $fname,
                'lname' => $lname,
                'usertype' => 'specialist'
            );           

        $this->db->insert('huser', $saveHsuer);
        $last_id = $this->db->insert_id();

        $saveHsp = array(
            'userid' => $last_id,
            'name' => $name,
            'email' => $email,
        );

        $this->db->insert('hspecialist', $saveHsp);
        return true;        
    }    

    public function get_sp_data($id){
        $this->db->select("*");
        $this->db->from("huser");
        $this->db->where('ID', $id);
        $this->db->where('usertype', 'specialist');
        $sp = $this->db->get()->row();   
        return $sp;
    }

    public function get_patient_data($id){
        $this->db->select("*");
        $this->db->from("huser");
        $this->db->where('ID', $id);
        $this->db->where('usertype', 'patient');
        $sp = $this->db->get()->row();   
        return $sp;
    }

    public function get_homephy_data($id){
        $this->db->select("*");
        $this->db->from("huser");
        $this->db->where('ID', $id);
        $this->db->where('usertype', 'homephysician');
        $sp = $this->db->get()->row();   
        return $sp;
    }      

    public function update_sp_data(){
        $ID = $this->input->post('id');
        $fname = $this->input->post('fname');
        $lname =$this->input->post('lname');
        $name =  $this->input->post('name');
        $email = $this->input->post('email');
        $saveHsuer1 = array(
                'name' => $name,
                'email' => $email,
                'fname' => $fname,
                'lname' => $lname,
            );
        $this->db->where('ID', $ID);
        $this->db->update('huser', $saveHsuer1);
        $saveHsp1 = array(
            'name' => $name,
            'email' => $email,
        );
        $this->db->where('userid', $ID);
        $this->db->update('hspecialist', $saveHsp1);
        //        print_r($this->db->last_query());
        return true;        
    }   

    public function update_patient_data(){
        $ID = $this->input->post('id');
        $fname = $this->input->post('fname');
        $lname =$this->input->post('lname');
        $name =  $this->input->post('name');
        $email = $this->input->post('email');
        $saveHsuer1 = array(
                'name' => $name,
                'email' => $email,
                'fname' => $fname,
                'lname' => $lname,
            );
        $this->db->where('ID', $ID);
        $this->db->update('huser', $saveHsuer1);
            $saveHsp1 = array(
                'name' => $name,
                'email' => $email,
            );
        $this->db->where('userid', $ID);
        $this->db->update('hspecialist', $saveHsp1);
     
        return true;        
    }   

    public function update_hphy_data(){
        $ID = $this->input->post('id');
        $fname = $this->input->post('fname');
        $lname =$this->input->post('lname');
        $name =  $this->input->post('name');
        $email = $this->input->post('email');
        $saveHsuer1 = array(
                'name' => $name,
                'email' => $email,
                'fname' => $fname,
                'lname' => $lname,
            );
        $this->db->where('ID', $ID);
        $this->db->update('huser', $saveHsuer1);
        
        $saveHsp1 = array(
                'name' => $name,
                'email' => $email,
            );
        $this->db->where('userid', $ID);
        $this->db->update('hspecialist', $saveHsp1);
        return true;        
    }    

    public function save_patient_data($list){
        $fname = $list['fname'];
        $lname = $list['lname'];
        $name = $list['name'];
        $email = $list['email'];
        $password = $list['password'];
        $saveHsuer = array(
            'name' => $name,
            'password' => md5($password),
            'email' => $email,
            'fname' => $fname,
            'lname' => $lname,
            'usertype' => 'patient'
        );            

        $this->db->insert('huser', $saveHsuer);
        $last_id = $this->db->insert_id();

        $saveHsp = array(
            'userid' => $last_id,
            'username' => $name,
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
        );

        $this->db->insert(' hpatient', $saveHsp);
        return true;        
    }

    public function save_homephy_data($list){
        $fname = $list['fname'];
        $lname = $list['lname'];
        $name = $list['name'];
        $email = $list['email'];
        $password = $list['password'];
        $saveHsuer = array(
                'name' => $name,
                'password' => md5($password),
                'email' => $email,
                'fname' => $fname,
                'lname' => $lname,
                'usertype' => 'homephysician'
            );           

            $this->db->insert('huser', $saveHsuer);
            $last_id = $this->db->insert_id();       

            $saveHsp = array(
                'userid' => $last_id,
                'username' => $name,
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
            );

        $this->db->insert('hhomephysician', $saveHsp);
        return true;        
    }   

    public function change_status_sp($id){
        $this->db->select("status");
        $this->db->from("huser");
        $this->db->where('ID', $id);
        $this->db->where('usertype', 'specialist');
        $sp = $this->db->get()->row();   
        $status = $sp->status;
        if($status == 1){
            $int = 0 ; 
        }else{
            $int = 1;           
        }
        $data = array(
            'status' => $int
        );                     

        $this->db->where('ID', $id);
        $this->db->update('huser', $data);
        return true;
    }    

    public function change_status_patient($id){
        $this->db->select("status");
        $this->db->from("huser");
        $this->db->where('ID', $id);
        $this->db->where('usertype', 'patient');
        $sp = $this->db->get()->row();   
        $status = $sp->status;
        if($status == 1){
            $int = 0 ; 
        }else{
            $int = 1;           
        }
        $data = array(
            'status' => $int
        );                     

        $this->db->where('ID', $id);
        $this->db->update('huser', $data);
        return true;    
    }   

    public function change_status_hphy($id){
        $this->db->select("status");
        $this->db->from("huser");
        $this->db->where('ID', $id);
        $this->db->where('usertype', 'homephysician');
        $sp = $this->db->get()->row();   
        $status = $sp->status;
        if($status == 1){
            $int = 0 ; 
        }else{
            $int = 1;           
        }
        $data = array(
            'status' => $int
        );           

        $this->db->where('ID', $id);
        $this->db->update('huser', $data);
        return true;    
    }   

    public function change_licence_stats_sp($id){
        $this->db->select("licence_status");
        $this->db->from("hspecialist");
        $this->db->where('userid', $id);
        $sp = $this->db->get()->row();  
        $status = $sp->licence_status;
        if($status == 1){
            $int = 0 ; 
        }else{
            $int = 1;           
        }
        $data = array(
            'licence_status' => $int
        );                    

        $this->db->where('userid', $id);
        $this->db->update('hspecialist', $data);
        return true;    
    }

    public function change_licence_stats_homephy($id){
        $this->db->select("licence_status");
        $this->db->from("hhomephysician");
        $this->db->where('userid', $id);
        $sp = $this->db->get()->row();  
        $status = $sp->licence_status;
        if($status == 1){
            $int = 0 ; 
        }else{
            $int = 1;           
        }
        $data = array(
            'licence_status' => $int
        );                   

        $this->db->where('userid', $id);
        $this->db->update('hhomephysician', $data);
        return true;    
    }

    public function get_sp_licence_details($id){
        $this->db->select("userid , licence_no, licence_state , licence_city, licence_zip");
        $this->db->from("hspecialist");
        $this->db->where('userid', $id);
        $sp = $this->db->get()->row();  
        return $sp;    
    }    

    public function get_hphy_licence_details($id){
        $this->db->select("userid , licence_no, licence_state , licence_city, licence_zip");
        $this->db->from("hhomephysician");
        $this->db->where('userid', $id);
        $sp = $this->db->get()->row();  
        return $sp;    
    }   

    public function today_appointment(){ 
        $result = array();
        $this->db->select('hbooking.*, hspecialist.*, hprocedure.*,hprocedurecategory.*, hpatient.*,hbooking.status as status');
        $this->db->from('hbooking');
        $this->db->join('hpatient','hpatient.userid = hbooking.patient_user_id');
        $this->db->join('hprocedure', 'hprocedure.ID = hbooking.procedure_id');
        $this->db->join('hprocedurecategory', 'hprocedurecategory.ID = hprocedure.procedure_cat_id');
        $this->db->join('hspecialist', 'hspecialist.userid = hbooking.specialist_user_id');
        //$this->db->where('hbooking.status',0);
        $this->db->where('hbooking.booking_date', date('Y-m-d'));
        
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result();
        }
        return $result; 
    }   

    public function future_appointment(){ 
        $result = array();
        $this->db->select('hbooking.*, hspecialist.*, hprocedure.*,hprocedurecategory.*, hpatient.*,hbooking.status as status');
        $this->db->from('hbooking');
        $this->db->join('hpatient','hpatient.userid = hbooking.patient_user_id');
        $this->db->join('hprocedure', 'hprocedure.ID = hbooking.procedure_id');
        $this->db->join('hprocedurecategory', 'hprocedurecategory.ID = hprocedure.procedure_cat_id');
        $this->db->join('hspecialist', 'hspecialist.userid = hbooking.specialist_user_id');
        //$this->db->where('hbooking.status',0);
        $this->db->where('hbooking.booking_date >', date('Y-m-d'));
        
        $query = $this->db->get();
        //print_r($query->result());
        if($query->num_rows() > 0){
            $result = $query->result();
        }
        return $result; 
    }   

    public function past_appointment(){ 
        $result = array();
        $this->db->select('hbooking.*, hspecialist.*, hprocedure.*,hprocedurecategory.*, hpatient.*,hbooking.status as status');
        $this->db->from('hbooking');
        $this->db->join('hpatient','hpatient.userid = hbooking.patient_user_id');
        $this->db->join('hprocedure', 'hprocedure.ID = hbooking.procedure_id');
        $this->db->join('hprocedurecategory', 'hprocedurecategory.ID = hprocedure.procedure_cat_id');
        $this->db->join('hspecialist', 'hspecialist.userid = hbooking.specialist_user_id');
        //$this->db->where('hbooking.status',0);
        $this->db->where('hbooking.booking_date <', date('Y-m-d')); 

        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result();
        }
        return $result; 
    }   

    public function fetchDetails($procedureCat,$procedureName,$date){
        $result = array();
        $this->db->select("hbooking.*, hspecialist.*, hprocedure.*,hprocedurecategory.ID as hprocedurecategoryID, hprocedurecategory.category_name as hprocedurecategoryName, hpatient.*,hbooking.status as status");

        $this->db->from('hbooking');

        $this->db->join('hpatient','hpatient.userid = hbooking.patient_user_id');
        $this->db->join('hprocedure', 'hprocedure.ID = hbooking.procedure_id');
        $this->db->join('hprocedurecategory', 'hprocedurecategory.ID = hprocedure.procedure_cat_id');
        $this->db->join('hspecialist', 'hspecialist.userid = hbooking.specialist_user_id');
        //$this->db->where('hbooking.status',0);
        $this->db->where('hbooking.booking_date', $date);
        $this->db->where('hbooking.procedure_id', $procedureName);
        $this->db->where('hprocedurecategory.ID', $procedureCat);
        $query = $this->db->get();
        //echo $this->db->last_query();die();
        //print_r($query->result());
        //print_r($query->result());
        if($query->num_rows() > 0){
            $result = $query->result();
        }
        //print_r($result); die();
        return $result; 
    }  

    public  function get_today_appointment_count(){   
        $currentDate = date('Y-m-d');
        $this->db->select('total_appt,complete_appt,cancel_appt');
        $this->db->from('hhomepy_today_appointment');
        $this->db->where('date', $currentDate);
        $query = $this->db->get();
        //print_r($query->result());
        if($query->num_rows() > 0){
            $today_appointment = $query->result();
            return $today_appointment;
        }else
          {return null;}
        // return null;
    }   

    public function procedure_category(){
        $category = $this->db->select('*')->from('hprocedurecategory')->get();
        return $category->result();       
    }   

    public function masterprocedurecategory(){
        $procedureCategoryID = $this->input->post('category');
        //$userid = $this->session->userdata('userid');
        $query = $this->db->get_where('hmasterprocedure', array('procedure_cat_id' => $procedureCategoryID));
        if($query->num_rows() > 0){
            $procedure = $query->result(); 
            return $procedure;
        }
    }

    public function get_listed_procedures(){
        $this->db->select('count(*) as total');
        $this->db->from('hprocedure');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $total_proced = $query->result();
            return $total_proced;
        }
        return null;
    }

    public function forgot_password($data = array()){        
        $data['password'] = $this->generate_random_password(6);
        $current_date = date('Y-m-d H:i:s');
        $user_name = $this->get_user_name_byEmail($data['email']);        

        $data['reset_hash'] = md5($current_date.$user_name);
        $data['reset_date'] = $current_date;

        $this->db->where('email', $data['email']);
        //$this->db->update('huser', array('password' => md5($data['password'])));
        $this->db->update('hadmin', array('reset_hash' => $data['reset_hash'], 'reset_date' => $data['reset_date']));

        if($this->db->affected_rows() > 0){
            return $data;
        }else{
            return false;
        }
    }

    public function reset_hash_authentication($reset_hash){
        $this->db->select('reset_date');
        $this->db->from('hadmin');
        $this->db->where('reset_hash' , $reset_hash);
        $data = $this->db->get()->row();        

        if(!empty($data))
        {            
            $valid_time = date('Y-m-d H:i:s', strtotime($data->reset_date.'+2 hour'));
            $current_date = date('Y-m-d H:i:s'); 
            if(strtotime($current_date) <= strtotime($valid_time) ){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function get_user_name_byEmail($email=''){
        $this->db->select('username');
        $this->db->from('hadmin');
        $this->db->where('email' , $email);
        $data = $this->db->get()->row();
        if(!empty($data)){
            return $data->username;
        }else{
             return false;
        }
    }

    public function generate_random_password($length = 6) {
        $alphabets = range('A','Z');
        $numbers = range('0','9');
        $additional_characters = array('_','.');
        $final_array = array_merge($alphabets,$numbers,$additional_characters);
        $password = '';
        while($length--) {
            $key = array_rand($final_array);
            $password .= $final_array[$key];
        }
        return $password;
    } 

    public function updatePassword($postData = array()){        
        parse_str($postData, $formData);  
        //print_r($formData); exit();   
        $data['reset_password'] = $formData["reset_password"];
        $data['confrm_reset_password'] = $formData["confrm_reset_password"];
        $data['reset_hash'] = $formData["reset_hash"];  
        $this->db->where('reset_hash', $data['reset_hash']);
        $this->db->update('hadmin', array('password' => md5($data['reset_password']),'reset_hash' => ''));
        
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }   
} 