<?php



class Staff_model extends CI_Model {



    public function __construct(){

        parent::__construct();

        $this->load->database();

    }

	

	/* @method : add_staff

	 * @params:

	 * @desc: add_staff method is used for adda new staff details

	*/

	public function add_staff($data = array()){

		$this->db->insert('hstaff', $data); 

		

		if($this->db->insert_id() > 0){

			return TRUE;

		}else{

			return FALSE;	

		}

	}	

	

	/* @method : edit_staff

	 * @params: $id

	 * @desc: edit_staff method is used update staff details

	*/

	public function edit_staff($id = '', $data = array()){

		$this->db->where('ID', $id);

		$this->db->update('hstaff', $data);

		

		if($this->db->affected_rows() > 0){

			return TRUE;

		}else{

			return FALSE;

		}

	}

	

	/* @method : delete_staff

	 * @params:

	 * @desc: delete_staff method is used for deleting staff details

	 */	

	public function delete_staff($staffid = ''){

		$this->db->where('ID', $staffid);

		$this->db->delete('hstaff'); 

		

		if($this->db->affected_rows() > 0){

			return TRUE;

		}else{

			return FALSE;	

		}

	}	



	/* @method : get_staff

	 * @params:

	 * @desc: get_staff method is used for fetching staff details

	 */

	public function get_staff($staffid){

		$this->db->select('hstaff.*, hstaffcategory.staff_cat_name');

		$this->db->from('hstaff');

		$this->db->join('hstaffcategory', 'hstaff.staff_cat_id = hstaffcategory.ID');

		$this->db->where('hstaff.ID', $staffid);

		$query = $this->db->get();

	

		if($query->num_rows()>0){

			$result = $query->result();

			return $result;

		}else{

			return false;	

		}

	}



    /* @method : get_staff_list

	 * @params:

	 * @desc: get_staff_list method is used for fetching staff details

	 */

	public function get_staff_list(){

		$result = array();

		$user_id = $this->session->userdata('userid');

		$this->db->select('hstaff.*, hstaffcategory.staff_cat_name');

		$this->db->from('hstaff');

		$this->db->join('hstaffcategory', 'hstaffcategory.ID = hstaff.staff_cat_id');

		$this->db->where('hstaff.userid', $user_id);

		$query = $this->db->get();

	

		if($query->num_rows()>0){

			$result = $query->result();

		}

		

		return $result;

	}

	

	

		

		

		

		

		

	######################################################################

	

	

    /* @method : get_patient

     * @params: $id

     * @desc: get_patient method is used for fetching patient

     */

    public function get_patient($id){

    	$query = $this->db->get_where('hstaff', array('ID' => $id));

        return $query->row_array();

    }



    



    public function view_details(){

    	$query = $this->db->get('hstaff');

        return $query->row_array();

    }





    /* @method : get_staff_catgory_list

     * @params:

     * @desc: get_staff_catgory_list method is used for fetching staff cat list

     */

    public function get_staff_catgory_list($staff_id, $user_id){

        $this->db->select('ID, staff_name');

        $this->db->from('hstaff');

        $this->db->where('staff_cat_id' , $staff_id);

        $res = $this->db->get()->result_array();

        return $res;

    }

    /* @method : get_specialist_staff

     * @params:

     * @desc: get_specialist_staff method is used for fetching staff cat list

     */

    public function get_specialist_staff($sid){

        $this->db->select('staff_name');

        $this->db->from('hstaff');

        $this->db->where('userid' , $sid);

        $res =array_column($this->db->get()->result_array(),'staff_name');

        return array_map('trim',$res);

    }



    public function get_staff_img($staff_id='',$staff_cat_id=''){
    	$res = array();
        $this->db->select('staff_pic');
        $this->db->from('hstaff');
        if($staff_id!=''){$this->db->where('ID' , $staff_id); }
        $this->db->where('staff_cat_id' , $staff_cat_id);
        $res = $this->db->get()->row();
        $file_path = getcwd().'/'.$res->staff_pic; 
        if(!empty($res->staff_pic) && !file_exists($file_path)){ 
            $res->staff_pic = 'assets/specialist/no-profile-image.png';
        }
        if($staff_id==''){
        	$res->staff_pic = 'assets/specialist/first-aid.png';
        }

        return $res;
        exit();
    }
}