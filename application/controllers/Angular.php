<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Angular extends CI_Controller {



	/**

	 * Index Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://example.com/index.php/welcome

	 *	- or -

	 * 		http://example.com/index.php/welcome/index

	 *	- or -

	 * Since this controller is set as the default controller in

	 * config/routes.php, it's displayed at http://example.com/

	 *

	 * So any other public methods not prefixed with an underscore will

	 * map to /index.php/welcome/<method_name>

	 * @see https://codeigniter.com/user_guide/general/urls.html

	 */

    public function __construct(){

        parent::__construct();

        $this->load->model('Admin_model');

        $this->load->model('hospital_model');

        $this->load->model('procedure_model');



        $this->load->model('Specialist_model');

        $this->load->model('booking_model');

        $this->load->model('user');

        $this->load->model('Staff_model');

        $this->load->helper('url');

        $this->load->helper('common');

        $this->load->library('session');

    }

	public function index()

	{

		$remoteData = array();

		$remoteData = array(

		0=>array(

				"image" => "sample1.jpeg",

				"title" => "Anirban",

				"designation" => "Web Developer",

				),

		1=>array(

				"image" => "sample1.jpeg",

				"title" => "Suman",

				"designation" => "Web Developer",

				),

		2=>array(

				"image" => "sample1.jpeg",

				"title" => "Subho",

				"designation" => "Web Developer",

				),

		3=>array(

				"image" => "sample1.jpeg",

				"title" => "Anirban",

				"designation" => "Web Developer",

				),

		4=>array(

				"image" => "sample1.jpeg",

				"title" => "Suman",

				"designation" => "Web Developer",

				),

		5=>array(

				"image" => "sample1.jpeg",

				"title" => "Subho",

				"designation" => "Web Developer",

				),

		6=>array(

				"image" => "sample1.jpeg",

				"title" => "Anirban",

				"designation" => "Web Developer",

				),

		7=>array(

				"image" => "sample1.jpeg",

				"title" => "Suman",

				"designation" => "Web Developer",

				),

		8=>array(

				"image" => "sample1.jpeg",

				"title" => "Subho",

				"designation" => "Web Developer",

				),

		9=>array(

				"image" => "sample1.jpeg",

				"title" => "Anirban",

				"designation" => "Web Developer",

				)

		);

		 

		echo json_encode($remoteData);

	}

	

	public function cardLayout()

	{

		$this->load->helper('url');

		$this->load->view('angular');

	}



	public function edit()

	{

		$this->load->helper('url');

		$this->load->view('angular/angularedit');

	}



	public function editdata()

	{

     $second_array = array(

    array( "name" => "SUMAN", "email" => "suman@gmail.com","message" => "how are you buddy",));

		echo json_encode($second_array);

	}



	public function postdata()

	{

     $post_date = file_get_contents("php://input");

     $data = json_decode($post_date);

     

	 

	echo json_encode($data);

     

		//saving to database

		//save query

		 

		//now i am just printing the values

		//echo "Name : ".$data->name."n";

		//echo "Email : ".$data->email."n";

		//echo "Message : ".$data->message."n";

 

	}

    public function get__pro_categories_dropdown(){



        $query = $this->db->get('hprocedurecategory');

        $ress= $query->result();

        $output=array();

        $output[]= array("ID"=>-1, "category_name"=> "Select Prodcedure Category" ) ;

        foreach($ress as $res)

        {

            $output[]= array("ID"=>$res->ID, "category_name"=> $res->category_name);



        }

        echo json_encode($output);





    }

    public function get_procedures_dropdown(){



        $query = $this->db->get('hprocedurecategory');

        $ress= $query->result();

        $output=array();

        $output[]= array("ID"=>-1, "category_name"=> "Select Prodcedure Category" ) ;

        foreach($ress as $res)

        {

            $output[]= array("ID"=>$res->ID, "category_name"=> $res->category_name);



        }

        echo json_encode($output);





    }

    

    

    public function get_procedure_cat_icon(){

        $this->db->select('*');

        $this->db->from('hprocedurecategory');

        $query = $this->db->get();

        $ress= $query->result_array();

        echo json_encode($ress);

    }



    public function get_procedures($caid){



        $user_id = $this->session->userdata('user_id');

        $this->db->select('ID','procedure_name');

        $this->db->from('hprocedure');

        $this->db->where('procedure_cat_id' , $caid);

        $query = $this->db->get();

        $ress= $query->result();

        $output=array();

        $output[]= array("-1"=> "Select Procedure Name" ) ;

        foreach($ress as $res)

        {

            $output[]= array("name"=> $res->ID, "Procedure_name"=> $res->procedure_name);



        }

        echo json_encode($output);

    }





    public function get_staff_name(){



        $user_id = $this->session->userdata('user_id');

        $this->db->select('staff_name');

        $this->db->from('hstaff');

        $this->db->where('userid' , $user_id);

        $query = $this->db->get();

        $ress= $query->result();

        $output=array();

        $output[]= array("staff_name"=> "Select staff Name" ) ;

        foreach($ress as $res)

        {

            $output[]= array("name"=> $res->staff_name, "Procedure_name"=> $res->staff_name);



        }

        echo json_encode($output);



    }



    public function get_specialist_details_for_setting(){

        $user_id = $this->session->userdata('user_id');

        $query = "SELECT hsp.picture, hsp.picture as thumbnail , hsp.name , hsp.title, hsp.desc FROM (huser hus INNER JOIN hspecialist hsp ON hus.ID = hsp.userid) WHERE hus.ID = '$user_id' ";

        $data =  $this->db->query($query);

        $rsr = $data->row();
       
        $rsr->thumbnail=get_image_differnt_size($rsr->picture,"100_");
       
        echo json_encode($rsr);

    }



    public function get_specialist_general_info(){

        $user_id = $this->session->userdata('user_id');

        $query = "SELECT DATE_FORMAT(hsp.dob,'%d-%m-%Y') as dob ,hsp.address, hsp.city,hsp.zip, hsp.email, hsp.phone FROM hspecialist hsp WHERE hsp.userid = '$user_id' ";

        $data =  $this->db->query($query);

        $rsr = $data->row();

        echo json_encode($rsr);

    }

    public function get_specialist_license_info(){

        $user_id = $this->session->userdata('user_id');

        $query = "SELECT hsp.licence_no ,hsp.licence_state, hsp.licence_city,  hsp.licence_zip  FROM hspecialist hsp WHERE hsp.userid = '$user_id' ";

        $data =  $this->db->query($query);

        $rsr = $data->row();

        echo json_encode($rsr);

    }
    
    public function get_sp_hospital(){

        $user_id = $this->session->userdata('user_id');

        $this->db->select('name,logo_url');

        $this->db->from('hhospital');

        $this->db->where('userid' , $user_id);

        $output = $this->db->get()->row();

        echo json_encode($output);

    }

    
    


    public function get_specialist_language(){

        $user_id = $this->session->userdata('user_id');

        $this->db->select('language');

        $this->db->from('hspecialist');

        $this->db->where('userid' , $user_id);

        $output = $this->db->get()->row();

        echo json_encode($output);

    }



    public function get_specialist_specialization(){

        $user_id = $this->session->userdata('user_id');

        $this->db->select('specialization');

        $this->db->from('hspecialist');

        $this->db->where('userid' , $user_id);

        $output = $this->db->get()->row();

        echo json_encode($output);

    }



    public function get_specialist_award(){

        $user_id = $this->session->userdata('user_id');

        $this->db->select('award');

        $this->db->from('hspecialist');

        $this->db->where('userid' , $user_id);

        $output = $this->db->get()->row();

        echo json_encode($output);

    }



    public function get_specialist_education_list(){

        $user_id = $this->session->userdata('user_id');

        $this->db->select('ID, education, DATE_FORMAT(from_date,"%d-%m-%Y") as from_date , DATE_FORMAT(to_date,"%d-%m-%Y") as to_date');

        $this->db->from('hspecialisteducation');

        $this->db->where('specialist_id' , $user_id);

        $output = $this->db->get()->result_array();

        echo json_encode($output);

    }



}

