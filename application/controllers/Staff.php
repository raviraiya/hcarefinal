<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff  extends H_Controller  {

    public function __construct()
    {
        parent::__construct();
		$this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->library('image_lib');
		$this->load->library('upload');
        $this->load->model('staff_model');
        $this->load->model('staff_cat_model');
    }
	
	/*
    * @method : add
    * @params:
    * @desc: add method is used for adding staff category
    */
    public function add(){
		$this->form_validation->set_rules('staff_name', 'Staff Name', 'required');
		$this->form_validation->set_rules('staff_cat_id', 'Staff Category', 'required');
        if ($this->input->is_ajax_request()){
			if($this->form_validation->run()){
				$response = array();
				$error = '';
				$uploadedfiles = $_FILES;
				$fileName = 'staff_'.time().$uploadedfiles['staffpic']['name'];
				$config = array(
					'upload_path' => './documentation/staff/',
					'allowed_types' => "jpg|png|jpeg|",
					'file_name' => $fileName
				);
				
				$data['userid'] = 1; //$this->session->userdata('user_id');
				$data['staff_name'] = $this->input->post('staff_name');
				$data['staff_cat_id'] = $this->input->post('staff_cat_id');
				$data['other_info'] = $this->input->post('other_info');
				$data['pic'] = "documentation/staff/".$config['file_name'];
				
				$this->upload->initialize($config);
				if($this->upload->do_upload('staffpic')){ 
					$result = $this->staff_model->add_staff($data);
				}else{
					$error = $this->upload->display_errors();
				}
		
				if($result){
					$response['success'] = 1;
					$response['error'] = 0;
					$response['message'] = "Staff added successfully.";
				}else{
					$response['success'] = 0;
					$response['error'] = 1;
					$response['message'] = $error;
				}
				echo json_encode($response);
			}else{
				$data= array("title"=>"Add Staff Category");
				$this->load->view('templates/header', $data);
				$this->load->view('Staffcategory/add_staff_cat',$data);
				$this->load->view('templates/footer');
			}
        }
        else{
            $this->staff_cat_model->add_staff_category();
            redirect('Staffcategory/add', 'refresh');
        }
    }
	
	/*
    * @method : get_staff_details
    * @params:
    * @desc: get_staff_details method is used for fetching individual staff details
    */
	public function edit(){	
		$this->form_validation->set_rules('staff_name', 'Staff Name', 'required');
		$this->form_validation->set_rules('staff_cat_id', 'Staff Category', 'required');
        if($this->input->is_ajax_request()){
			if ($this->form_validation->run()){
				$error = '';
				$uploadedfiles = $_FILES;
				$fileName = 'staff_'.time().$uploadedfiles['staffpic']['name'];
				$id = $this->input->post('ID');
				$data['staff_name'] = $this->input->post('staff_name');
				$data['staff_cat_id'] = $this->input->post('staff_cat_id');
				$data['pic'] = "documentation/staff/".$fileName.".jpeg";

				$config = array(
					'upload_path' => './documentation/staff/',
					'allowed_types' => "jpg|png|jpeg|",
					'file_name' => $fileName
				);
				$this->upload->initialize($config);
				if($this->upload->do_upload('pic')){ 
					$result = $this->staff_model->edit_staff($id, $data);
				}else{
					$error = $this->upload->display_errors();
				}
				
				if($result){
					$response['success'] = 1;
					$response['error'] = 0;
					$response['message'] = "Staff details updated successfully.";
				}else{
					$response['success'] = 0;
					$response['error'] = 1;
					$response['message'] = $error;
				}
				echo json_encode($response);
        	}
		}
    }
	
	/*
    * @method : staff_delete
    * @params:
    * @desc: staff_delete method is used for delete staff details
    */
	public function staff_delete(){
		if($this->input->is_ajax_request()){
			$staffid = $this->input->post('staffid');
			$result = $this->staff_model->delete_staff($staffid);
			if($result){
				$response['success'] = 1;
				$response['error'] = 0;
				$response['message'] = "Staff deleted successfully.";
			}else{
				$response['success'] = 0;
				$response['error'] = 1;
				$response['message'] = "Problem in deleting staff details.";
			}
			echo json_encode($response);
		}
	}
	
	/*
     * @method : get_staff_details
     * @params:
     * @desc: get_staff_details method is used for fetching individual staff details
     */
	public function get_staff_details(){
		$staff = array();
		$staffid = $this->input->post('staffid');
    	$details = $this->staff_model->get_staff($staffid);	
		foreach($details as $detail){
			$staff['id'] = $detail->ID; 
			$staff['category_id'] = $detail->staff_cat_id; 
			$staff['staff_name'] = $detail->staff_name;
			$staff['staff_cat_name'] = $detail->staff_cat_name;
		}	
		echo json_encode($staff);
    }
	
	/*
     * @method : staff_list
     * @params:
     * @desc: staff_list method is used for fetching all staff details
     */
	public function staff_list(){
		$data['categoryList'] = array();
		if($this->staff_cat_model->get_cat_list()){
			$data['categoryList'] = $this->staff_cat_model->get_cat_list();
		}
		
		$this->load->view('templates/header');
		$this->load->view('stafflist', $data);
		$this->load->view('templates/footer');
	}
	
	/*
    * @method : get_staff_list
    * @params:
    * @desc: get_staff_list method is used for fetching all staff details by angular js
    */
    public function get_staff_list(){
    	$list = $this->staff_model->get_staff_list();
		echo json_encode($list);
    }
	
	
	
	
	###################################
    
	
	
	
    public function view_staff(){
    	$list = $this->Staff_cat_model->get_cat_list();
        $result = $this->Staff_model->view_details();
		$this->load->view('templates/header');
		$data = array("title"=>"View staff", "staff"=> $result,"list"=> $list);
		$this->load->view('view_staff',$data);
		 $this->load->view('templates/footer');
    }
    
    
    	
    


}
