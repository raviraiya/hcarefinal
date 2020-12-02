<?php

class Procedure_cat_model extends CI_Model {

	
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /* @method : add_pro_cat
     * @params:
     * @desc: add_pro_cat method is used to create procedure category
     */
    public function add_pro_cat(){
        $data=array(
            'category_name'=>$this->input->post('category_name'),
        );
        if($this->db->insert('hprocedurecategory',$data)){
            return true;
        }

    }
    /* @method : index
     * @params:
     * @desc: add_pro_cat method is used to get procedure categories
     */
    public function get_categories_dropdown(){
        $query = $this->db->get('hprocedurecategory');
        $ress= $query->result();
        $output=array();
        $output[""]="Select Prodcedure Category";
        foreach($ress as $res)
        {
            $output[$res->ID]=$res->category_name;
        }
        return $output;
    }
}