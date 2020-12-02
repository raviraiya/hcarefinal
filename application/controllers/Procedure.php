<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Procedure extends H_Controller {
	
	public function Procedure(){
		parent::__construct();
        $this->load->model('Procedure_model');
        $this->load->model('Staff_cat_model');
        $this->load->model('procedure_cat_model');
        $this->load->model('Staff_model');
		$this->load->helper('url');
		$this->load->helper('string');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	/* @method : index
     * @params: $id
     * @desc: index method is used for adding procedure details     
	 */
	public function index(){

    	$this->form_validation->set_rules('procedure_name', 'procedure Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $list = $this->Procedure_model->get_pro_cat_list();
            $catName = $this->Procedure_model->get_procedure_name();
            $staff_cat = $this->Procedure_model->get_staff_cat();
            $staff = $this->Procedure_model->get_staff_list();
            $success = '';
            $error = '';
            $data = array("title"=> "Add staff", 'success' => $success ,'catName' => $catName, 'error' => $error,"list"=> $list,'staffCat' => $staff_cat,'staff' => $staff);
            $this->load->view('templates/header');
           $this->load->view('add_procedure',$data);
            $this->load->view('templates/footer');
        }
        else{
            $catName = $this->Procedure_model->get_procedure_name();
            $list = $this->Procedure_model->get_pro_cat_list();
            $staff_cat = $this->Procedure_model->get_staff_cat();
            $staff = $this->Procedure_model->get_staff_list();
           $res = $this->Procedure_model->add_procedure_details();
            $success="";
            $error="";
            if($res){
                $success= "Procedure Entry Saved successfully.";
            }else{
                $error="Entry not Saved";
            }

            $data = array("title"=> "Add staff", "list"=> $list,'catName' => $catName,'staffCat' => $staff_cat,'staff' => $staff,'success' => $success , 'error' => $error);
            $this->load->view('templates/header');
            $this->load->view('add_procedure',$data);
            $this->load->view('templates/footer');
        }
	}

	public function edit_procedure($id){
        $res = $this->Patient_model->get_patient($id);
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data = array("title"=>"Edit Physican", "phy" => $res);
            $this->load->view('edit_procedure',$data);
        }else{
            $this->Patient_model->edit($id);
            redirect('patient/view_patient', 'refresh');
        }
	}


    /* @method : Create
     * @params:
     * @desc: Create is used to create prodcedures
     */
    public function create()
    {
        $pro_cat=$this->procedure_cat_model->get_categories_dropdown();
        $staff_cat = $this->Procedure_model->get_staff_cat();
        $staff = $this->Procedure_model->get_staff_list();
        $sucess = '';
        $errro = '';
        $class = '';
        $classF = '';
        $procedure_name = $this->input->post('procedure_name');
        if(isset($procedure_name) && !empty($procedure_name)){
            $saveData = $this->Procedure_model->save_procedure_data();
            if($saveData){
                $sucess = 'Procedure added successfully';
                $class = "success";
            }else{
                $errro = 'Procedure not added';
                $classF = "fail";
            }
        }
        $data = array("title"=>"Create Procedure","pro_cat"=> $pro_cat, 'success' => $sucess, 'error' => $errro , 'class' => $class, 'fail'=> $classF,'angular_js_file'=>"procedure.js" , 'staffCat' => $staff_cat,'staff' => $staff);
        $this->load->view('templates/app_header',$data);
        $this->load->view('procedure/create',$data);
        $this->load->view('templates/app_footer');
    }


}
