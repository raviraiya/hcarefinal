<?php



class Register_model extends CI_Model {

    public function __construct(){

        parent::__construct();

        $this->load->database();

    }



    /* @method : specialist_registration

     * @params:

     * @desc: specialist_registration method is used for register specialist

     */

    public function specialist_registration(){

        $data=array(

			'fname'=> $this->input->post('fname'),

			'lname'=> $this->input->post('lname'),

            'name'=> $this->input->post('name'),

            'password'=> md5($this->input->post('password')),

            'email'=>  $this->input->post('email'),

            'usertype' => 'specialist',

        );

        $this->db->insert('huser',$data);



        $userID = $this->db->insert_id();

        $data=array(
            "userid"=>$userID,
            "name"=> $this->input->post('fname')." ".$this->input->post('lname'),
            'email'=>  $this->input->post('email'),

            );
         $this->db->insert('hspecialist',$data);

          $data=array(
            "userid"=>$userID,
           
            );
         $this->db->insert('hhospital',$data);

          $hospitalID = $this->db->insert_id();

        return  array("userid"=>$userID,"hospitalid"=>$hospitalID);

    }



    /* @method : home_physician_registration

     * @params:

     * @desc: home_physician_registration method is used for register home physician

     */

    public function home_physician_registration(){

        $data=array(

			'fname'=> $this->input->post('fname'),

			'lname'=> $this->input->post('lname'),

            'name'=> $this->input->post('name'),

            'password'=> md5($this->input->post('password')),

            'email'=>  $this->input->post('email'),

            'usertype' => 'homephysician',

        );

        $this->db->insert('huser',$data);



        $userID = $this->db->insert_id();

        return $userID;

    }

}