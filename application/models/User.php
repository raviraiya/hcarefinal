
<?php

class user extends H_Model {


    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('common');
    }

    function check_login($email,$password){
        $this->db->where("email",$email);
        $this->db->where("password",MD5($password));

        $query = $this->db->get("huser");

        if($query->num_rows()>0)
        {
            foreach($query->result() as $rows)
            {
                //add all data to session
                $newdata = array(
                    'user_id'       => $rows->id,
                    'user_name'     => $rows->name,
                    'user_email'    => $rows->email,
                    'logged_in'     => TRUE,
                );
            }
            $this->session->set_userdata($newdata);
            return true;
        }
        return false;
    }
    public function add_user(){
        $str = $this->generateRandomString();
        $configUpload['upload_path']    = 'application/uploads';                 #the folder placed in the root of project
        $configUpload['allowed_types']  = 'gif|jpg|png|bmp|jpeg';       #allowed types description
        $configUpload['max_size']       = '0';                          #max size
        $configUpload['max_width']      = '0';                          #max width
        $configUpload['max_height']     = '0';                          #max height
        $configUpload['encrypt_name']   = true;                         #encrypt name of the uploaded file
        $this->load->library('upload', $configUpload);                  #init the upload class
        if(!$this->upload->do_upload('picture')){
            $uploadedDetails    = $this->upload->display_errors();
        }else{
            $uploadedDetails    = $this->upload->data('picture');
        }
        $image_path = $this->upload->data();

        $data=array(
            'username'=>$this->input->post('username'),
            'password'=>md5($this->input->post('password')),
            'fname'=>$this->input->post('fname'),
            'lname'=>$this->input->post('lname'),
            'email'=>$this->input->post('email'),
            'picture'=> $image_path['full_path'],
            'confirm_code'=> $str,
        );

        if($this->db->insert('huser',$data)){
            return true;
        }

    }

    public function sign_in($username, $password){

        $this ->db->select('*');
        $this ->db-> from('huser');
        $this->db->where('name', $username);
        $this->db->where('password', MD5($password));
        $this ->db-> limit(1);

        $query = $this->db->get();

        return $query;

    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /* @method : checkpass
     * @params:
     * @desc: checkpass method is used for checking user password
     */
    public function checkpass($pass){
        $user_id = $this->session->userdata('userid');
        $this ->db->select('password');
        $this ->db-> from('huser');
        $this->db->where('ID', $user_id);
        $this->db->where('password', MD5($pass));
        $query = $this->db->get()->row();
        return $query;

    }
    /* @method : update_password
     * @params:
     * @desc: update_password method is used for update user password
     */
    public function update_password(){
        $user_id = $this->session->userdata('userid');
        $pass = $this->input->post('new_password');
        $data = array(
            'password' => MD5($pass),
        );
        $this->db->where('ID', $user_id);
        $this->db->update('huser',$data);
        return true;
    }

    public function checkMail()
    {
        $email=$this->input->post('email');
        $this ->db->select('id');
        $this ->db-> from('huser');
        $this->db->where("email",$email);
        $query = $this->db->get()->row();
        if(!empty($query)){
            $password= random_string('alnum', 8);
            $this->db->where("id", $query->id );
            $this->db->update('huser',array('confirm_code' => $password));
            $id = encode_id($query->id);
            $url = "http://localhost/Hcarebetamaster/login/resetpassword/$password/$id ";
            $html = '<p style ="font-size:20px;">On you request for new password, please click on below link</p>';
            $html .= '<p><a href ='.$url.' style ="background: #297cac; padding: 12px; border-radius: 4px;color: #fff; font-size: 16px;text-decoration: none;">Reset password</a></p>';
            $this->email->from('kamboj@gmail.com', 'admin');
            $this->email->to($email);
            $this->email->subject('Forgot password');
            $this->email->message($html);
            if ($this->email->send()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function validateCode($code, $id){
        $this ->db->select('id');
        $this ->db-> from('huser');
        $this->db->where("id",$id);
        $this->db->where("confirm_code",$code);
        $query = $this->db->get()->row();
        if(!empty($query)){
            return true;
        }else{
            return true;
        }
    }



    public function changepassword(){
        $id = $this->input->post('userid');
        $data=array(
            'password'=> md5($this->input->post('password')),
        );
        $this->db->where("id",$id);
        $this->db->insert('huser',$data);
        return true;
    }


    public function updateuserpassword($data){

        $pass = $data['password'];
        $id = $data['userid'];
        $data = array(
            'password' => MD5($pass),
            'confirm_code' => '',
        );
        $this->db->where('ID', $id);
        $this->db->update('huser',$data);
        return true;
    }


}
