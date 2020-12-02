<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staffcategory  extends H_Controller  {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('staff_cat_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    /*
	 * @method : index
	 * @params:
	 * @desc: index method is used for showing staff cat form  	
	 */
    public function index(){
        $this->load->view('templates/header');
        $this->load->view('add_staff_cat');
        $this->load->view('templates/footer');
    }

    /*
    * @method : add
    * @params:
    * @desc: add method is used for adding staff category
    */
    public function add(){
        $this->form_validation->set_rules('staff_cat_name', 'Staff Category Name', 'required');
        if ($this->form_validation->run()){
            if($this->input->is_ajax_request()){
                $response = array();
                $result = $this->staff_cat_model->add_staff_category();
                if($result){
                    $response['success'] = 1;
                    $response['error'] = 0;
                    $response['message'] = "Category added successfully.";
                }else{
                    $response['success'] = 0;
                    $response['error'] = 1;
                    $response['message'] = "Problem in adding new category.";
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
            $this->load->view('Staffcategory/add_staff_cat',$data);
        }
    }

    /*
    * @method : delete
    * @params:
    * @desc: delete method is used for adding staff category
    */
    public function delete(){
        if($this->input->is_ajax_request()){
            $response = array();
            $tag = $this->input->post('tag');
            $result = $this->staff_cat_model->delete_staff_category($tag);
            if($result){
                $response['success'] = 1;
                $response['error'] = 0;
                $response['message'] = "Category deleted successfully.";
            }else{
                $response['success'] = 0;
                $response['error'] = 1;
                $response['message'] = "Problem in deleting category.";
            }
            echo json_encode($response);
        }
    }

    /*
    * @method : edit
    * @params:
    * @desc: edit method is used for updating staff details
    */
    public function edit($id){
        $res=$this->Staff_cat_model->get_staff_category($id);
        $this->form_validation->set_rules('staff_cat_name', 'Staff Category Name', 'required');
        if ($this->form_validation->run() === FALSE){
            $data= array("title"=>"Edit Staff Category");
            $this->load->view('templates/header', $data);
            $this->load->view('edit_staff_category',$data);
            $this->load->view('templates/footer');
        }
        else{
            $this->Staff_cat_model->edit_staff_category($id);
            redirect('/Staffcategory/', 'refresh');
        }
    }


}