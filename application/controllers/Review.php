<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reviews extends H_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Patient_model');
        $this->load->model('Procedure_model');
        $this->load->model('Specialist_model');
        $this->load->model('Reviews_model');
        $this->load->helper('url');
        $this->load->helper('string');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    /* @method : index
     * @params:
     * @desc: index method is used for displaying add view
     */
    public function index(){
        /*if(!empty($_POST)){
            $resultdata=$this->Reviews_model->getFiletredData();
        ;}*/
        $this->load->view('templates/app_header');
        $resultdata['procedure']=$this->Reviews_model->procedure();
        $resultdata['val']=$this->Reviews_model->category();
        // print_r($resultdata['procedure']);die();
        $this->load->view('specialist/reviews',$resultdata);
        $this->load->view('templates/app_footer');
    }


    public function dataList(){
        //$this->load->view('templates/header');
        $result=$this->Reviews_model->getdata();
        foreach($result as $val){
            $slot_date=$val->slot_date;
            $slotDateArr=explode("-",$slot_date);
            $newdate=$slotDateArr[2].'-'.$slotDateArr[1].'-'.$slotDateArr[0];
            $newdate=array("newDate"=>$newdate);
            $val=(array)$val;
            $resultdata[] = array_merge($val, $newdate);
        }
        //$slot_date=$resultdata[0]->slot_date;
        //$slotDateArr=explode("-",$slot_date);
        //print_r($resultdata);die();
        echo json_encode($resultdata);
        die();
        // $this->load->view('reviews',$resultdata);
        // $this->load->view('templates/footer');
    }

    public function dataList11()
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

    public function dataListnew()
    {
        $result=$this->Reviews_model->getFilterResult();
        //print_r($result);die('f');
        echo json_encode($result);
        //print_r($_POST);die();
    }
    public function dataListnew1()
    {
        $result=$this->Reviews_model->getFilterResult1();
        //print_r($result);die('f');
        echo json_encode($result);
        //print_r($_POST);die();
    }


}
