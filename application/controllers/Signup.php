<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends H_Controller {

    public function __construct(){

        parent::__construct();
         $this->check_for_login_signup();
        $this->load->model('register_model');

        $this->load->helper('url');

		$this->load->helper('hcareemail_helper');

        $this->load->library('email');

        $this->load->library('session');

        $this->load->library('form_validation');

    }



    /* @method : specialist

     * @params:

     * @desc: specialist method is used for register specialist

     */

    public function specialist(){

       

        if($this->input->is_ajax_request()){

			$this->form_validation->set_rules('fname','First Name','trim|required');

			$this->form_validation->set_rules('lname','Last Name','trim|required');

            $this->form_validation->set_rules('name','Name','trim|required|is_unique[huser.name]');

            $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[huser.email]', array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        ));

            $this->form_validation->set_rules('password','Password','trim|required');

            $this->form_validation->set_rules('repassword','Re Type Password','trim|required|matches[password]');



            if($this->form_validation->run() == TRUE)

            {

                $registrationID = $this->register_model->specialist_registration();

                if($registrationID["userid"] > 0){

					$email['fromname'] = "HCare";

					$email['to'] = $this->input->post('email');

					$email['message'] = '<tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:30px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200"><p>Hi,'+$this->input->post("fname")+'</p></td>

					</tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 6% 5px 7.5%;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>Specialist thanks for register at HCare. Admin will be contact you very soon.</p><p></p></td></tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>Best,<br> Hcare Group</p></td></tr>';

					$email['subject'] = "HCare Registration";

					

                    hcare_email($email);

                    $response['success'] = 1;

                    $response['error'] = 0;

                    //$response['message'] = "Your specialist account created successfully.";
                       $newdata = array(

                        'user_id' => $registrationID["userid"],

                        'userid' => $registrationID["userid"],

                        'username' => $this->input->post("name"),

                        'name' => $this->input->post("fname")." ".$this->input->post("lname"),

                        'email' => $this->input->post("email"),

                        'usertype' =>"specialist",
                        "hospitalid"=>  $registrationID["hospitalid"], 
                        "hospital_logo"=>  "", 

                    );
                        $this->session->set_userdata($newdata);
                    //redirect("specialist","refersh");
                     $response['redirect']= base_url()."specialist";

                }

            }else{

                $response['success'] = 0;

                $response['error'] = 1;

                $response['message'] = validation_errors();

            }

            echo json_encode($response);

        }else{

            $data = array("title"=>"Hcare Specialist Resigrataion");

            $this->load->view('signup/specialist_signup', $data);

        }

    }

    

    /* @method : home_physician

     * @params:

     * @desc: home_physician method is used for home physician specialist

     */

    public function homephysician(){

        if($this->input->is_ajax_request()){

			$this->form_validation->set_rules('fname','First Name','trim|required');

			$this->form_validation->set_rules('lname','Last Name','trim|required');

            $this->form_validation->set_rules('name','Name','trim|required|is_unique[huser.name]');

            $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[huser.email]');

            $this->form_validation->set_rules('password','Password','trim|required');

            $this->form_validation->set_rules('repassword','Re Type Password','trim|required|matches[password]');



            if($this->form_validation->run() == TRUE)

            {

                $registrationID = $this->register_model->home_physician_registration();

                if($registrationID > 0){

                    $email['fromname'] = "HCare";

					$email['to'] = $this->input->post('email');

					$email['message'] = '<tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:30px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200"><p>Hi,</p></td>



					</tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 6% 5px 7.5%;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>Home physician thanks for register at HCare. Admin will be contact you very soon.</p><p></p></td></tr><tr style="padding:0px"><td bgcolor="#FFFFFF" style="padding:27px 7.5% 5px;text-align:left;line-height:29px;font-family:helvetica,arial;font-size:18px;color:#58595b;font-weight:200;letter-spacing:-.005em"><p>Best,<br> Hcare Group</p></td></tr>';

					$email['subject'] = "HCare Registration";

					

                    hcare_email($email);

                    $response['success'] = 1;

                    $response['error'] = 0;

                    $response['message'] = "Your home physician account created successfully.";

                }

            }else{

                $response['success'] = 0;

                $response['error'] = 1;

                $response['message'] = validation_errors();

            }

            echo json_encode($response);

        }else{

            $data = array("title"=>"Hcare Home Physician Resigrataion");

            $this->load->view('signup/home_physician_signup', $data);

        }

    }

}



