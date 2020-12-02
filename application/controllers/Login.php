<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends H_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->check_for_login_signup();

        $this->load->model('login_model');
        $this->load->model('Procedure_model');

        $this->load->helper('url');
        $this->load->helper('cookie');

        $this->load->library('session');
        $this->load->library('email');
        $this->load->library('form_validation');
    }

    /* @method : index
     * @params:
     * @desc: index method is used for login user
     */    
    public function index(){
        if($this->input->is_ajax_request()){           
            $remember = 0;
            $formData = array();
            parse_str($_POST['formdata'], $formData);
            $data['username'] = $formData["username"];
            $data['password'] = $formData["password"];

            if(isset($formData["remember"])){
                $remember = $formData["remember"]; 
            }

            $isvalidUser = $this->login_model->check_user($data);
            $bookingsuccess = 0;
            $bookingFound = 0;
            if($isvalidUser){
                if($remember == 1){
                    $cookie_1 = array('name'=> 'userid',
                                    'value'=>  $this->session->userdata('userid'),
                                    'expire' => 2592000,
                                    'secure' => false
                                   );

                    set_cookie($cookie_1);
                    $cookie_2 = array('name'=> 'usertype',
                                    'value'=>  $this->session->userdata('usertype'),
                                    'expire' => 2592000,
                                    'secure' => false
                                   );

                    set_cookie($cookie_2);

                    $cookie_3 = array('name'=> 'userpass',
                                    'value'=>  $this->session->userdata('password'),
                                    'expire' => 2592000,
                                    'secure' => false
                                   );

                    set_cookie($cookie_3);
                    //$this->session->set_userdata('remember_me', true);
                }

                $usertype = $this->session->userdata('usertype');
                $userid = $this->session->userdata('userid');

                if(isset($formData['booking']) && $formData['booking'] == '1' && $usertype == 'patient'){
                    $slotArry = array();                       

                    $slotArry['pr_id'] = $formData['procedure_name'];  // procedure id 
                    $slotArry['doc_id'] = $formData['docID'];  
                    $slotArry['time_slot'] = $formData['time_slot'];  
                    $slotArry['date'] = $formData['date'];
                    $slotArry['booking'] = $formData['booking'];
                    $slotArry['userid'] = $userid;
                    $checkBooking = $this->login_model->get_patinet_for_booking($slotArry);   

                    if($checkBooking == false){
                        $bookingsuccess =  $this->Procedure_model->save_register_booking_details($slotArry);  
                        //  var_dump($bookingsuccess);
                    }else{
                      $bookingFound = 1;   
                    }
                }

                $response['success'] = 1;
                $response['error'] = 0;

                if($usertype == "specialist"){
                    $replaceurl = "specialist";
                }else if($usertype == "homephysician"){
                    $replaceurl = "homephysician";
                }else if($usertype == "patient"){
                    $replaceurl = "patient";
                }

                $response['replaceurl'] = $replaceurl;
            }else{
                $response['success'] = 0;
                $response['error'] = 1;
                $response['message'] = "Invalid Credential.";
            }            

            if($bookingFound == 1){
                $response['replaceurl'] = 'patient/booking_alert';
                $response['success'] = 1;
                $response['error'] = 0;
                $response['message'] = "Login successful"; 
            }

            if($bookingsuccess != 0 ){ 
                $response['replaceurl'] = 'patient/booking_success';
                $response['success'] = 1;
                $response['error'] = 0;
                $response['message'] = "Login successful";
            }
            echo json_encode($response);
        }else{           

            $data = array("title"=>"Hcare Login");

            $this->load->view('login/login', $data);
        }
    }

    /* @method : forgot_password
     * @params:
     * @desc: forgot_password method is used for send user new password
     */
    public function forgot_password(){
        if($this->input->is_ajax_request()){
            $data['email'] = $this->input->post("email");
            $userdetails = $this->login_model->forgot_password($data);
            if(!empty($userdetails)){
                $isSend = $this->send_mail($userdetails);
                if($isSend){                
                    $response['success'] = 1;
                    $response['error'] = 0;
                    $response['message'] = "Reset link Sent to Email ".$data['email'];
                }else{
                    $response['success'] = 0;
                    $response['error'] = 1;
                    $response['message'] = "Email not found";
                }
            }else{
                $response['success'] = 0;
                $response['error'] = 1;
                $response['message'] = "Invalid email id.";
            }
            echo json_encode($response);
        }else{
            $data = array("title"=>"Hcare Login");
            $this->load->view('login', $data);
        }
    }

    /* @method : Reset Password
     * @params:
     * @desc: reset_passord method is used for change password / Forget Password
     */    
    public function reset_passord($reset_hash=''){
        if($reset_hash==''){
             redirect('login');
        } 
        $response = array();
        $reset_hash_auth = $this->login_model->reset_hash_authentication($reset_hash);
        $hash_auth_fail = '';
        if($reset_hash_auth==0){
           $hash_auth_fail = "This Reset link is expired Now.";
        }

        $data = array("title"=>"Hcare Reset Password","hash_auth_fail"=>$hash_auth_fail,"reset_hash"=>$reset_hash);
        //print_r($data); exit();
        $this->load->view('login/reset_passord', $data);
    }

    /* @method : Update Password
     * @params:
     * @desc: updatePassword method is used for Update password
     */    
    public function updatePassword(){        
        $response = array();           
        
        $update = $this->login_model->updatePassword($_POST['formdata']);       

        if($update == 1){
            $response['success'] = 1;
            $response['error'] = 0;
            $response['message'] = "Password Updated Successfully ";
        }else{
            $response['success'] = 0;
            $response['error'] = 1;
            $response['message'] = "Something Went Wrong";
        } 
        echo json_encode($response);
    }

    /* @method : send_mail
     * @params: $user
     * @desc: send_mail method is used to confirmation mail send
     */
    public function send_mail($user = array()) {
        $from_email = "matainja009@gmail.com";
        $to_email = $user['email'];
        //$message = "Hi, user your new password for login at HCare is: ".$user['password'];

        $message  =  "Hello Sir / Ma'am  ".$user['email']."<br><br>";
        $message .=  "Please click on the below link for Reset Password <br><br>";
        $message .=  "<p style='float:left;width:100%'><a href='".base_url()."login/reset_passord/".$user['reset_hash']."' style='width:auto;padding:10px;border-radius:5px;color:white;font-weight:bold;background-color:#4e9caf;text-decoration:none' target='_blank'>Click this to <span class='il'>reset</span> your password</a></p>";

        //print_r($message); exit();
        $this->email->set_mailtype("html");
        $this->email->from($from_email, 'HCARE Group');
        $this->email->to($to_email);
        $this->email->subject('HCare Group Login New Password');

        $this->email->message($message);
        //Send mail
        if($this->email->send())
            return true;
        else
            return FALSE;
    }

    /* @method : unameExistance
     * @params: $user
     * @desc: unameExistance method is used to check username existance in the system
     */
    public function unameExistance(){
        $response = array();
        $username = $this->input->post("username");
        $data = $this->login_model->unameExistance($username);
        if($data){                
            $response['success'] = '0';
            $response['error'] = '1';
        }else{
            $response['success'] = '1';
            $response['error'] = '0';
        }
        echo json_encode($response);
    }

    /* @method : uemailExistance
     * @params: $user
     * @desc: uemailExistance method is used to check email existance in the system
     */
    public function uemailExistance(){
        $response = array();
        $email = $this->input->post("email");
        $data = $this->login_model->uemailExistance($email);
        if($data){                
            $response['success'] = '0';
            $response['error'] = '1';
        }else{
            $response['success'] = '1';
            $response['error'] = '0';
        }
        echo json_encode($response);
    }

    /* @method : registration
     * @params: $user
     * @desc: registration method is used to check email existance in the system
     */
    public function registration(){
        $response = array();           
        
        $update = $this->login_model->registration($_POST['formdata']);       

        if($update == 1){
            $response['success'] = 1;
            $response['error'] = 0;
            $response['message'] = "New User Sign-up Successfully Done ";
        }else{
            $response['success'] = 0;
            $response['error'] = 1;
            $response['message'] = "Something Went Wrong";
        } 
        echo json_encode($response);
    }
} ?>