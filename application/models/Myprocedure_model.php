<?php

class Myprocedure_model extends H_Model {


    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('common');
    }


    public function add_procedure_listing($pro_id){
//        $this->db->trans_start();
        $user_id = $this->session->userdata('user_id');

        /*
         *  save data into procedure table
         */
        $data = array(
            'category_name'=> $this->input->post('category_name'),
        );
        $this->db->where('ID', $pro_id);
        $this->db->update('hprocedurecategory', $data);;

        $data = array(
            'procedure_name'=> $this->input->post('procedure_name'),
        );
        $this->db->where('ID', $pro_id);
        $this->db->update('hprocedure', $data);;

        $StaffcatId = $this->input->post('staff_cat_id');
        $catName = $this->input->post('staff_name');
        $total = count($StaffcatId);
        for($i=0; $i < $total ;  $i++) {
            $data = array(
                'procedure_id' => $pro_id,
                'staff_cat_id' => $StaffcatId[$i],
                'staff_name' => $catName[$i],
            );
            $this->db->where('ID', $pro_id);
            $this->db->update('hprocedurestaff',$data);
        }

        $dates = $this->input->post('appointment_date');
        $dateArry =array_values(array_filter($dates));
        if(!empty($dateArry)){
            foreach($dateArry  as $date){
                $this->db->select('time_slot');
                $this->db->from('hproceduredate');
                $this->db->where('date' , $date);
                $res =array_column($this->db->get()->result_array(),'time_slot');
                $result[] =  array_map('trim',$res);
            }
        }
        foreach($result as $subArray){
            foreach($subArray as $val){
                $newArray[] = $val;
            }
        }

        if(!empty($dateArry)){
            $icnt=1;
            $appt = $this->input->post('no_of_appt');
            foreach($dateArry as $date){
                $hours = $this->input->post('hour'.$icnt);
                foreach($hours as $hour){
                    if (!in_array($hour, $newArray)){
                        $data = array(
                                'procedureid' => $pro_id,
                                'doctorid' => $user_id,
                                'date' => $date,
                                'no_of_appt' => $appt,
                                'time_slot' => $hour,
                        );
                        $this->db->insert('hproceduredate',$data);
                    }
                }
                $icnt++;
            }
        }

//        $this->db->trans_complete();
        return true;
    }

}
