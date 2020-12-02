<?php
class Login_model extends H_Model {
    public function __construct(){
       parent::__construct();
        $this->load->database();
    }

    public function check_user($data = array()){
        $where = "(`name` = '".$data['username']."' OR `email` = '".$data['username']."')";
        $this->db->where($where);
        $this->db->where('password', md5($data['password']));
        $query = $this->db->get("huser");
        if($query->num_rows() > 0){
            foreach($query->result() as $rows){
                $newdata = array(
                    'user_id' => $rows->ID,
                    'userid' => $rows->ID,
                    'username' => $rows->name,
                    "fname" => $rows->fname,
                    "lname" =>  $rows->lname,
                    'name' => $rows->fname." ".$rows->lname, 
                    'email' => $rows->email,
                    'usertype' => $rows->usertype,
                );
            }
            $this->db->where("userid",$newdata["userid"]);
            $query1 = $this->db->get("hhospital");
            if($query1->num_rows() > 0) {
                $res=$query1->result();
                $newdata["hospitalid"]=$res[0]->ID;
                $newdata["hospital_logo"]=$res[0]->logo_url;
            }

            $this->session->set_userdata($newdata);
            return true;
        }
        return false;
    }

    public function forgot_password($data = array()){
        $data['password'] = $this->generate_random_password(6);
        $current_date = date('Y-m-d H:i:s');
        $user_name = $this->get_user_name_byEmail($data['email']);        

        $data['reset_hash'] = md5($current_date.$user_name);
        $data['reset_date'] = $current_date;

        $this->db->where('email', $data['email']);
        //$this->db->update('huser', array('password' => md5($data['password'])));
        $this->db->update('huser', array('reset_hash' => $data['reset_hash'], 'reset_date' => $data['reset_date']));

        if($this->db->affected_rows() > 0){
            return $data;
        }else{
            return false;
        }
    }

    public function updatePassword($postData = array()){        
        parse_str($postData, $formData);  
        //print_r($formData); exit();   
        $data['reset_password'] = $formData["reset_password"];
        $data['confrm_reset_password'] = $formData["confrm_reset_password"];
        $data['reset_hash'] = $formData["reset_hash"];  
        $this->db->where('reset_hash', $data['reset_hash']);
        $this->db->update('huser', array('password' => md5($data['reset_password']),'reset_hash' => ''));
        
        if($this->db->affected_rows() > 0){
            return true;
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

    public function get_unique_name($name){
            $this->db->select('ID');
            $this->db->from('huser');
            $this->db->where('name' , $name);
            $data = $this->db->get()->row();
            if(!empty($data)){
                return true;
            }else{
                 return false;
            }
    }

    public function get_unique_email($email){
            $this->db->select('ID');
            $this->db->from('huser');
            $this->db->where('email' , $email);
            $data = $this->db->get()->row();
            if(!empty($data)){
                return true;
            }else{
                 return false;
            }
    }   

    public function get_patinet_for_booking($pt){
        $checkbooking=false;
        if(!empty($pt['userid'])){
              $userid = $pt['userid'];
        }else{
            $userid = $this->session->userdata('userid');  
        }

        $this->db->select('ID');
        $this->db->where('specialist_user_id', $pt['doc_id']);
        $this->db->where('procedure_id',$pt['pr_id']);
        $this->db->where('booking_date', $pt['date']);
        $this->db->where('booking_time', $pt['time_slot']);
        $this->db->where('patient_user_id', $userid);
        $qb1 = $this->db->get('hbooking');
        $qoutput1= $qb1->row_array();       

        if($qoutput1 != ""){
            $checkbooking=true;
            return $checkbooking;
        }        

        $this->db->select('ID');
        $this->db->where('booking_date', $pt['date']);
        $this->db->where('booking_time', $pt['time_slot']);
        $this->db->where('patient_user_id', $userid);
        $queryBooking1 = $this->db->get('hbooking'); 
        $queryBooking1 =$queryBooking1->row();

        if($queryBooking1 != ""){
            $checkbooking=true;
        }
        return $checkbooking;
    }

    public function get_user_name_byEmail($email=''){
        $this->db->select('name');
        $this->db->from('huser');
        $this->db->where('email' , $email);
        $data = $this->db->get()->row();
        if(!empty($data)){
            return $data->name;
        }else{
             return false;
        }
    }

    public function reset_hash_authentication($reset_hash){
        $this->db->select('reset_date');
        $this->db->from('huser');
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

    public function unameExistance($uname){
        $this->db->select('name');
        $this->db->from('huser');
        $this->db->where('name' , $uname);
        $data = $this->db->get()->row();
        if(!empty($data)){
            return true;
        }else{
             return false;
        }
    }

    public function uemailExistance($email){
        $this->db->select('email');
        $this->db->from('huser');
        $this->db->where('email' , $email);
        $data = $this->db->get()->row();
        if(!empty($data)){
            return true;
        }else{
             return false;
        }
    }

    public function registration($postData = array()){
        parse_str($postData, $formData); 
        $data=array();
        $data['name'] = $formData['uname'];
        $data['email'] = $formData['email'];
        $data['usertype'] = $formData['roles'];
        $data['password'] = md5($formData['password']);
        $data['fname'] = $formData['fname'];
        $data['lname'] = $formData['lname'];

        $huser= $this->db->insert('huser', $data);
        if(!empty($huser)){
            return $huser;
        }else{
            return false;
        }

    }
}