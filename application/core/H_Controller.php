<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class H_Controller  extends CI_Controller  {

    protected $modules = null;

    public function __construct()

    {

        parent::__construct();

//        $this->load->helper('common');

        $this->load->helper('url');

        $this->load->library('session');

        $this->load->library('encrypt');

        $this->load->library('image_lib');

        $this->load->helper('url');

        $this->load->helper('cookie');

        $this->load->database();

//        $this->load->model('profile');

       // $this->check_logged_in();

       // $this->modules= $this->profile->get_all_module_right();

       // $this->session->set_userdata('user_id', '19');

        //$this->session->set_userdata('hospital_id',"1");

    }

    function  check_logged_in()

    {

        $user_id=$this->session->userdata('userid');

        $remember_userid = get_cookie('userid');

        

        if(empty($user_id) && empty($remember_userid))

        {

            //redirect(base_url());

            redirect("login","refresh");

            die();

        }else if(!empty($remember_userid)){

            $this->session->set_userdata('userid', $remember_userid);

        }

      

    }

    

    function  admin_check_logged_in()
    {   if(empty($this->session->userdata('newdata'))){
            $remember_usertoken = get_cookie('usertoken');
            $decode_token = base64_decode($remember_usertoken);
            $ency_pass = explode('|-@@-|', $decode_token);
            $this->db->select('*');
            $this->db->from('hadmin');
            $this->db->where('rem_token' , $remember_usertoken);
            $data = $this->db->get()->row();
            
            if(empty($remember_usertoken))
            {
                redirect("admin/login","refresh");
                exit(0);
            }else if(!empty($data)){
                $newdata = array(
                        'usertype'     =>'admin',
                        'user_id'       => $data->ID,
                        'user_name'     => $data->username,
                        'user_email'    => $data->email,
                        'logged_in'     => TRUE,
                    );
                $this->session->set_userdata('newdata',$newdata);
                //print_r($this->session->userdata('newdata')); exit();
                redirect("/admin","refresh");
                exit(0);
            }
        }        
    }
    //only for signup and login
    function check_for_login_signup()
    {   $user_id=$this->session->userdata('userid');

       

        if(empty($user_id))

        {

           //redirect(base_url());

           // redirect("login","refresh");

            //die();

        }

        else

        {

             $usertype=$this->session->userdata('usertype');

             redirect("/".$usertype,"refersh");

        }

    }

    function check_for_usertype($usertype)

    {

        $usertype1= $this->session->userdata('usertype');

        $remember_usertype = get_cookie('usertype');

        if($usertype1!= $usertype  && empty($remember_usertype))

        {

            $this->session->sess_destroy();

            redirect('login', 'refresh');

            die();

        }else if(!empty($remember_userid)){

            $this->session->set_userdata('usertype', $remember_usertype);

        }

    }

    

    function admin_check_for_usertype($usertype)

    {

        $usertype1= $this->session->userdata('usertype');

        $remember_usertype = get_cookie('usertype');

        if($usertype1!= $usertype  && empty($remember_usertype))

        {

            $this->session->sess_destroy();

            redirect("admin/login","refresh");

            exit(0);

        }else if(!empty($remember_userid)){

            $this->session->set_userdata('usertype', $remember_usertype);

        }

    }

    

    function encode_str($str)

    {

        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->config->item("encryption_key"),$str , MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));

    }

    function decode_str($str)

    {

        return   trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->config->item("encryption_key"), base64_decode($str), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));

    }

    function check_right($module)

    {

        if(!$this->profile->check_right($module))

        {

            redirect("not_authorized","refresh");

        }

    }

}