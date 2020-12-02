<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends H_Controller{
	public function __construct(){
       parent::__construct();
       	$token = get_cookie('usertoken');
	    if(!empty($token))
	    	$this->admin_check_logged_in();

	    //print_r($token); exit();
		//$this->admin_check_for_usertype("admin");
        $this->load->model('admin_model');
        $this->load->helper('url');
        $this->load->helper('cookie');
        //$this->load->library('session');

        $this->load->library('form_validation');
        $this->load->library('email');
		$this->load->library('image_lib');
		$this->load->library('upload');
    }	

	public function index(){
		$adminsessiondetails = $this->session->userdata('newdata'); 
		//print_r($adminsessiondetails); exit();
        if($adminsessiondetails['usertype'] == 'admin'){
			$total_proced=$this->admin_model->get_listed_procedures();
			$todayAppt=$this->admin_model->get_today_appointment_count();

			$data = array("title"=>"Hcare Admin Login","today_appt"=>$todayAppt,"total_proced"=>$total_proced);
			$this->load->view('templates/admin_header');
            $this->load->view('admin/admin_dashboard', $data); 
			$this->load->view('templates/admin_footer');
        }else{
			redirect('admin/login');
        }
    }	

    /* @method : login
     * @params:
     * @desc: login method is used for admin login
     */
    public function login(){
    	if(!empty($this->session->userdata('newdata'))){
    		redirect("/admin","refresh");
    	}    	
        if($this->input->is_ajax_request()){
			$remember = 1;
            $username = $this->input->post("username");
            $password = $this->input->post("password");
           	//$remember = $this->input->post('remember');

            $isvalidUser = $this->admin_model->admin_login($username,$password);
            if($isvalidUser){
				 if($remember == 1){
				 	$set = array();
				 	$encoded_pass = $password."|-@@-|".strtotime(date('Y-m-d H:i:s'));
				 	$token = base64_encode($encoded_pass);
				 	$set['token'] = $token;
				 	$set['user_id'] = $this->session->userdata['newdata']['user_id'];

				 	$this->admin_model->update_token($set);

					$cookie_1 = array('name'=> 'usertoken',
									'value'=>  $token,
									'expire' => 2592000,
									'secure' => false
								   );
					set_cookie($cookie_1);

					$cookie_2 = array('name'=> 'usertype',
									'value'=>  $this->session->userdata['newdata']['usertype'],
									'expire' => 2592000,
									'secure' => false
								   );
					set_cookie($cookie_2);
					//$this->session->set_userdata('remember_me', true);
				}

				$response['success'] = 1;
                $response['error'] = 0;
				$response['replaceurl'] = 'admin';
            }else{
                $response['success'] = 0;
                $response['error'] = 1;
                $response['message'] = "Invalid Credential.";
            }
            echo json_encode($response);
        }else{
            $data = array("title"=>"Hcare Admin Login");
            $this->load->view('admin/admin_login', $data);
        }
    }

    public function logout(){
		delete_cookie('usertoken');
		$this->admin_model->emptyToken($this->session->userdata['newdata']['user_id']);
		$this->session->sess_destroy();
		redirect('admin', 'refresh');
    }

    /* @method : forgot_password
     * @params:
     * @desc: forgot_password method is used for send user new password
     */
    public function forgot_password(){
        if($this->input->is_ajax_request()){
            $data['email'] = $this->input->post("email");

            $userdetails = $this->admin_model->forgot_password($data);

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
        $reset_hash_auth = $this->admin_model->reset_hash_authentication($reset_hash);
        $hash_auth_fail = '';
        if($reset_hash_auth==0){
           $hash_auth_fail = "This Reset link is expired Now.";
        }

        $data = array("title"=>"Hcare Reset Password","hash_auth_fail"=>$hash_auth_fail,"reset_hash"=>$reset_hash);
        //print_r($data); exit();
        $this->load->view('admin/reset_passord', $data);
    }

    /* @method : Update Password
     * @params:
     * @desc: updatePassword method is used for Update password
     */    
    public function updatePassword(){        
        $response = array();           
        
        $update = $this->admin_model->updatePassword($_POST['formdata']);       

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
        $message .=  "<p style='float:left;width:100%'><a href='".base_url()."admin/reset_passord/".$user['reset_hash']."' style='width:auto;padding:10px;border-radius:5px;color:white;font-weight:bold;background-color:#4e9caf;text-decoration:none' target='_blank'>Click this to <span class='il'>reset</span> your password</a></p>";

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

    /* @method : specialist
     * @params:
     * @desc: specialist method is used for admin side specialist add , edit , status update
     */
    public function specialist(){
        $query = "SELECT husr.ID , husr.name, husr.fname, husr.lname , husr.email , husr.status ,hsp.licence_status from huser husr INNER JOIN hspecialist hsp ON husr.ID = hsp.userid WHERE husr.usertype = 'specialist' " ;       

        $data =  $this->db->query($query);
        $sp = $data->result_array();       

        $editSpdata = $this->input->post('editSpdata');  

        if(isset($editSpdata)){
            $res =  $this->admin_model->update_sp_data();
            if($res){
                redirect($_SERVER['REQUEST_URI'], 'refresh');
            }
        }
        $data = array("title"=>"Add specialist",'sp' => $sp);
        $this->load->view('templates/admin_header' , $data);
		$this->load->view('admin/add_specialist', $data);
		$this->load->view('templates/admin_footer');
    }    

    /* @method : patient
     * @params:
     * @desc: patient method is used for admin side patient add , edit , status update
     */
    public function patient(){
        $this->db->select("*");
        $this->db->from("huser");
        $this->db->where('usertype', 'patient');
        $sp = $this->db->get()->result_array(); 
        $editSpdata = $this->input->post('editSpdata');  
        if(isset($editSpdata)){
            $res =  $this->admin_model->update_sp_data();
            redirect($_SERVER['REQUEST_URI'], 'refresh');
        }
        $data = array("title"=>"Add patient",'sp' => $sp);
        $this->load->view('templates/admin_header' , $data);
		$this->load->view('admin/add_patient', $data);
		$this->load->view('templates/admin_footer');
    }   

    /* @method : homephysician
     * @params:
     * @desc: homephysician method is used for admin side homephysician add , edit , status update 
     */  
    public function homephysician(){
        $query = "SELECT husr.ID , husr.name, husr.fname, husr.lname , husr.email , husr.status , hphy.licence_status from huser husr INNER JOIN hhomephysician hphy ON husr.ID = hphy.userid WHERE husr.usertype = 'homephysician'  ";    

        $data =  $this->db->query($query);
        $sp = $data->result_array();     

        $editSpdata = $this->input->post('editSpdata');  
        if(isset($editSpdata)){
            $res =  $this->admin_model->update_sp_data();
            redirect($_SERVER['REQUEST_URI'], 'refresh');
        }        

        $data = array("title"=>"Add homephysician",'sp' => $sp);
        $this->load->view('templates/admin_header' , $data);
		$this->load->view('admin/add_homephysician', $data);
		$this->load->view('templates/admin_footer');
    }	

	/* @method : appointment
     * @params:
     * @desc: appointment method is used for displaying current, past and upcoming appointments
     */ 
	public function appointment(){
		$data['today_appointment'] = $this->admin_model->today_appointment();
		$data['procedure_category'] = $this->admin_model->procedure_category();
		$this->load->view('templates/admin_header');
		$this->load->view('admin/admin_appointment',$data);
		$this->load->view('templates/admin_footer');	
	}

	public function ajaxData(){
        if($this->input->is_ajax_request()){
            if($this->input->post('tag') == 'procedurecategory'){
                $procedurecategoryDetails = $this->admin_model->masterprocedurecategory();
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

			/*if($this->input->post('tag') == 'reportChartList'){
				$oldNewStr = '';
				$bookAppointmentStr = '';
				//$chartdata[] = array();
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
				//print_r($chartdata); die();
				//var_dump($chartdata);die();
				echo json_encode($chartdata);
				exit(0);
			}

			if($this->input->post('tag') == 'reportChartListAll'){
				$reportChartListData = $this->specialist_model->reportFetchAll();
				echo json_encode($reportChartListData);	
			}*/
        }
    }	

	public function appointmentSearch(){
		if($this->input->is_ajax_request()){
			$procedureCat = $this->input->post('procedureCat');	
			$procedureName = $this->input->post('procedureName');
			$date = $this->input->post('date');		

			$result=$this->admin_model->fetchDetails($procedureCat,$procedureName,$date);
			if(!empty($result)){
				$response['success'] = 1;
				$response['error'] = 0;
				$response['appointmentsearch'] = $result;
			}else{
				$response['success'] = 0;
				$response['error'] = 1;
				$response['appointmentsearch'] = $result;
			}

			echo json_encode($response); 
			exit(0);
		}
	} 

	public function todayappointment(){
		if($this->input->is_ajax_request()){
			$todayappointmentDetails = $this->admin_model->today_appointment();
			if($todayappointmentDetails){
                $response['success'] = 1;
                $response['error'] = 0;
                $response['todayappointment'] = $todayappointmentDetails;
            }else{
                $response['success'] = 0;
                $response['error'] = 1;
                $response['todayappointment'] = $todayappointmentDetails;
            }
            echo json_encode($response); 
            exit(0);
		}
	}

	public function futureappointment(){
		if($this->input->is_ajax_request()){
			$futureappointmentDetails = $this->admin_model->future_appointment();
			if($futureappointmentDetails){
				$response['success'] = 1;
				$response['error'] = 0;
				$response['futureappointment'] = $futureappointmentDetails;
			}else{
				$response['success'] = 0;
				$response['error'] = 1;
				$response['futureappointment'] = $futureappointmentDetails;
			}
			echo json_encode($response); 
			exit(0);
		}
	}	 

	public function pastappointment(){
		if($this->input->is_ajax_request())
			$pastappointmentDetails = $this->admin_model->past_appointment();

		if($pastappointmentDetails){
            $response['success'] = 1;
            $response['error'] = 0;
            $response['pastappointment'] = $pastappointmentDetails;
        }else{
            $response['success'] = 0;
            $response['error'] = 1;
            $response['pastappointment'] = $pastappointmentDetails;
        }
        echo json_encode($response); 
        exit(0);
	}

	public function procedurecategory(){
		if($this->input->is_ajax_request()){
			if($this->input->post('tag') == 'fetchdetails'){
				$categorydetails = array();
				$categoryid = $this->input->post('categoryid'); 
				$categorydetails = $this->admin_model->get_procedure_cat($categoryid);
				if(!empty($categorydetails)){
                    $response['success'] = 1;
                    $response['error'] = 0;
                    $response['categorydetails'] = $categorydetails;
                }else{
					$response['success'] = 0;
					$response['error'] = 1;
					$response['categorydetails'] = $categorydetails;
            	}
				echo json_encode($response); 
				exit(0);
			}else if($this->input->post('tag') == 'edit'){
				$isUpdate = '';
				$response = array();
				$categoryid = $this->input->post('ID');
				if(!empty($_FILES)){
					$uploadedfiles = $_FILES;
					$fileName = 'category_'.time().$uploadedfiles['categorypic']['name'];
					$config = array(
						'upload_path' => './assets/category/',
						'allowed_types' => "jpg|png|jpeg|",
						'file_name' => $fileName
					);
					$data['icon'] = base_url()."assets/category/".$config['file_name'];
					$data['category_name'] = $this->input->post('category_name');			
					$this->upload->initialize($config);
					if($this->upload->do_upload('categorypic')){
						$isUpdate = $this->admin_model->update_procedure_cat($categoryid, $data);
					}else{
						$error = $this->upload->display_errors();
					}
				}else{
					$data['category_name'] = $this->input->post('category_name');
					$isUpdate = $this->admin_model->update_procedure_cat($categoryid, $data);
				}
				if($isUpdate){
                    $response['success'] = 1;
                    $response['error'] = 0;
                    $response['message'] = "Successfully updated the category details";
                }else{
					$response['success'] = 0;
					$response['error'] = 1;
					$response['message'] = "Fail to updated the category details";
            	}
				echo json_encode($response);
				exit(0);
			}
		}else{
			$data['procedures'] = $this->admin_model->get_procedure_cat();
			$this->load->view('templates/admin_header');
			$this->load->view('admin/admin_procedurecategory', $data);
			$this->load->view('templates/admin_footer');
		}
	}

	public function add_category(){
		$this->form_validation->set_rules('category_name', 'Category Name', 'required');	
		if ($this->input->is_ajax_request()){
            $response = array();
            $uploadedfiles = $_FILES;
            $fileName = 'category_'.time().$uploadedfiles['categorypic']['name'];
            $config = array(
                'upload_path' => './assets/category/',
                'allowed_types' => "jpg|png|jpeg|",
                'file_name' => $fileName
            );
			$data['category_name'] = $this->input->post('category_name');
            $data['icon'] = base_url()."assets/category/".$config['file_name'];
            $this->upload->initialize($config);
            if($this->upload->do_upload('categorypic')){
                $result = $this->admin_model->add_procedure_cat($data);
            }else{
                $error = $this->upload->display_errors();
            }
			if($result){
                $response['success'] = 1;
                $response['error'] = 0;
                $response['message'] = "Category added successfully.";
            }else{
                $response['success'] = 0;
                $response['error'] = 1;
                $response['message'] = $error;
            }
            echo json_encode($response);
        }
	}	

	public function procedure(){
		if($this->input->is_ajax_request()){
			$id = $this->input->post('ID');
			$data['procedure_cat_id'] = $this->input->post('procedure_cat_id');
			$data['procedure_name'] = $this->input->post('procedure_name');
			$isUpdate = $this->admin_model->update_procedure($id, $data);
			if($isUpdate){
                    $response['success'] = 1;
                    $response['error'] = 0;
                    $response['message'] = "Procedure updated successfully.";
			}else{
				$response['success'] = 0;
				$response['error'] = 1;
				$response['message'] = "Fail to updated procedure";
			}
			echo json_encode($response);
		}else{
			$data['categoryList'] = array();
			if($this->admin_model->get_procedure_cat()){
				$data['categoryList'] = $this->admin_model->get_procedure_cat();
			}
			$data['procedure'] = $this->admin_model->get_all_procedure();
			$this->load->view('templates/admin_header');
			$this->load->view('admin/admin_procedure', $data);
			$this->load->view('templates/admin_footer');
		}
	}

	public function add_procedure(){
		if ($this->input->is_ajax_request()){
            $response = array();
			$data['procedure_name'] = $this->input->post('procedure_name');
			$data['procedure_cat_id'] = $this->input->post('procedurecategory');
            $result = $this->admin_model->add_procedure($data);
            if($result){
                $response['success'] = 1;
                $response['error'] = 0;
                $response['message'] = "Category added successfully.";
            }else{
                $response['success'] = 0;
                $response['error'] = 1;
                $response['message'] = $error;
            }
            echo json_encode($response);
        }
	}    
}