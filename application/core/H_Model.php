<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bigfoot2
 * Date: 7/18/14
 * Time: 1:46 PM
 * To change this template use File | Settings | File Templates.
 */

class H_Model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
       // $this->load->model("master_model");
        $this->load->library('email');
       $this->load->library('image_lib');
    }
    public function send_email($to,$subject,$message,$emailtitle)
    {
        date_default_timezone_set('Asia/Calcutta');

        $this->email->from(getfromemail() ,getfromname() );
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->set_mailtype("html");
        $data=array("emailtitle"=>$emailtitle,"emailcontent"=>$message);
        $msg = $this->load->view('email',$data,TRUE);
        $this->email->message($msg);
        $this->email->send();

    }
}