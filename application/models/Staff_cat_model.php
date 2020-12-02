<?php

class Staff_cat_model extends CI_Model {

	
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
	/* @method : get_cat_list
	 * @params:
	 * @desc: get_cat_list method is used for fetching category details
	 */
	public function get_cat_list(){
		$category = array();
		$query = $this->db->get('hstaffcategory');
		
		if($query->num_rows()>0){
			$result = $query->result();
			foreach($result as $category){
				$categoryList[$category->ID]=$category->staff_cat_name;
			}
			return $categoryList;
		}else{
			return false;	
		}
	}
	
	/* @method : get_cat_list
	* @params:
	* @desc: get_cat_list method is used for fetching category details
	*/
	public function add_staff_category(){
		$user_id = 1;//$this->session->userdata('user_id');
		$data = array(
			'userid' => $user_id,
			'staff_cat_name' => $this->input->post('staff_cat_name'),
		);
		if($this->db->insert('hstaffcategory',$data)){
			return TRUE;
		}
	}
    
	/* @method : get_cat_list
	* @params:
	* @desc: get_cat_list method is used for fetching category details
	*/
	public function delete_staff_category($tag){
		$this->db->where('staff_cat_name', $tag);
		$this->db->delete('hstaffcategory');

		if($this->db->affected_rows() > 0){
			return TRUE;
		}
	}
	
	public function edit($id){
        $this->db->trans_start();
        $user_id=$this->session->userdata('user_id');
        $data = array(
        		'userid' => $user_id,
                'staff_cat_name'=>$this->input->post('staff_cat_name'),
	        
        );
        
        $this->db->where('ID', $id);
        $this->db->update(' hstaffcategory', $data);
        $this->db->trans_complete();
    }
	
	
    
}