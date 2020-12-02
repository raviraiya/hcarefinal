<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Procedurecategory extends H_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->model('Procedure_cat_model');
		$this->load->helper('url');
		$this->load->helper('string');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

    /* @method : index
     * @params:
     * @desc: index method is used for adding procedure category
     */
	public function index(){
		$this->form_validation->set_rules('category_name', 'category Name', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
            $success = '';
            $error = '';
                $data = array('success' => $success,'error' => $error);
                $this->load->view('templates/header');
                $this->load->view('add_procedure_cat', $data);
                $this->load->view('templates/footer');
		}else{
            $result = $this->Procedure_cat_model->add_pro_cat();
            $success = '';
            $error = '';
            if ($result == TRUE) {
                $success = 'Procedure category added Successfully !';
                $data = array('success' => $success,'error' => $error);
                $this->load->view('templates/header');
                $this->load->view('add_procedure_cat', $data);
                $this->load->view('templates/footer');
            } else {
                $error ='error saving data';
                $data = array('success' => $success,'error' => $error);
                $this->load->view('templates/header');
                $this->load->view('add_procedure_cat', $data);
                $this->load->view('templates/footer');
            }
        }
	}


    /* @method : edit_patient
     * @params:$id
     * @desc: edit_patient method is used for updating patient
     */
	public function edit_patient($id){
        $res = $this->Patient_model->get_patient($id);
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data = array("title"=>"Edit Physican", "phy" => $res);
            $this->load->view('edit_patient',$data);
        }else{
            $this->Patient_model->edit($id);
            $this->load->view('templates/header');
            redirect('patient/view_patient', 'refresh');
            $this->load->view('templates/footer');
        }
	}
    /* @method : view_patient
     * @params
     * @desc: view_patient method is used for showing patient details
     */
	public function view_patient(){
		$result = $this->Patient_model->view_details();
		$this->load->view('templates/header');
		$data = array("title"=>"Edit Physican", "physican"=>$result);
		$this->load->view('view_patient',$data);
		 $this->load->view('templates/footer');
	}
		
}
?>
