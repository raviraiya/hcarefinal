<?php

class Reviews_model extends H_Model

{

    function __construct()

    {

        // Call the Model constructor

        parent::__construct();

    }

    function getdata()

    {

        $userid=$this->session->userdata("userid");
        // $tablequery=$this->db->select('*')

        //     ->from('hreview')

        //     ->join('hspecialist','hspecialist.ID=hreview.specialist_id')

        //     ->join('hprocedure','hprocedure.ID=hreview.procedure_id')

        //     ->join('hpatient','hpatient.userID=hreview.patient_id')

        //     ->join('hprocedurecategory','hprocedure.procedure_cat_id=hprocedurecategory.ID')

        //     //->join('hhospital','hhospital.ID=hreview.hospital_id')

        //     ->join('hbooking','hbooking.procedure_id=hreview.procedure_id')

        //     ->where("hbooking.specialist_user_id",$userid)
        //     ->get();
        $tablequery=$this->db->query("SELECT distinct hreview.ID, hreview.review, hreview.rating, hspecialist.name as specialistname, hspecialist.picture as specialist_picture, hpatient.fname as patient_name, hpatient.picture as patient_picture, hprocedure.procedure_name FROM hreview JOIN hspecialist ON hspecialist.userID=hreview.specialist_id JOIN hprocedure ON hprocedure.ID=hreview.procedure_id JOIN hpatient ON hpatient.userID=hreview.patient_id  JOIN hprocedurecategory ON hprocedure.procedure_cat_id=hprocedurecategory.ID JOIN hbooking ON hbooking.procedure_id=hreview.procedure_id WHERE hbooking.specialist_user_id=".$userid);
        //$f=$this->db->last_query();
        
        //print_r($f);die('dd');

        return $tablequery->result();

    }



    function getFiletredData()

    {

        $procCat=$this->input->post('procCat');

        $procName=$this->input->post('procName');

        $datepicker=$this->input->post('datepicker');





        $tablequery=$this->db->select('*')

            ->from('hreview')

            ->join('hspecialist','hspecialist.ID=hreview.specialist_id')

            ->join('hprocedure','hprocedure.ID=hreview.procedure_id')

            ->join('hprocedurecategory','hprocedure.procedure_cat_id=hprocedurecategory.ID')

            ->join('hpatient','hpatient.ID=hreview.patient_id')

            //->join('hhospital','hhospital.ID=hreview.hospital_id')

            ->join('hbooking','hbooking.procedure_id=hreview.procedure_id')

            ->where('hprocedure.procedure_name',$procName)

            ->where('hprocedurecategory.category_name',$procCat)

            ->where('hreview.slot_date',$datepicker)

            ->get();



        echo $this->db->last_query();die();

        //$f=$tablequery->result();

        //print_r($f);die('dd');

        return $tablequery->result();

    }



    function category()

    {

        $category=$this->db->select('*')

            ->from('hprocedurecategory')->get();

        return $category->result();

    }

    function procedure()

    {

        $procedure=$this->db->select('*')->from('hprocedure')->get();

        //$data=$procedure->result();

        //print_r($data[0]->procedure_name);die();

        return $procedure->result();

    }

    function getFilterResult(){

        $data=array();

        $item_per_page=2;

        $procCat=$this->input->post('procCat');

        $procName=$this->input->post('procName');

        $datepicker=$this->input->post('datepicker');

        $page_number =$this->input->post('track_click');

        $position = ($page_number * $item_per_page);

        $tablequery=$this->db->select('*')

            ->from('hreview')

            ->limit(0, 2)

            ->order_by("hreview.ID", "asc")

            ->limit($position, 2)

            /*->join('hprocedure','hprocedure.ID=hreview.procedure_id')

            ->join('hpatient','hpatient.ID=hreview.patient_id')

            ->join('hprocedurecategory','hprocedure.procedure_cat_id=hprocedurecategory.ID')

            //->join('hhospital','hhospital.ID=hreview.hospital_id')

            ->join('hbooking','hbooking.procedure_id=hreview.procedure_id')

            ->where('hprocedurecategory.ID',$procCat)

            ->where('hreview.slot_date',$datepicker)

            ->where('hprocedure.ID',$procName)*/

            ->get();

        $data['rowcount'] = $tablequery->num_rows();

        $data['result'] = $tablequery->result();

        //print_r($data);die();

        //echo $this->db->last_query();die();

        //$f=$tablequery->result();

        //print_r($f);die('dd');

        return $data;



    }

    function getFilterResult1(){

        $procCat=$this->input->post('procCat');

        $procName=$this->input->post('procName');

        $datepicker=$this->input->post('datepicker');

        $start = $this->input->post('start');

        $limit = $this->input->post('limit');

        $tablequery=$this->db->select('*')

            ->from('hreview')

            ->limit( $start,$limit)

            /*->join('hprocedure','hprocedure.ID=hreview.procedure_id')

            ->join('hpatient','hpatient.ID=hreview.patient_id')

            ->join('hprocedurecategory','hprocedure.procedure_cat_id=hprocedurecategory.ID')

            //->join('hhospital','hhospital.ID=hreview.hospital_id')

            ->join('hbooking','hbooking.procedure_id=hreview.procedure_id')

            ->where('hprocedurecategory.ID',$procCat)

            ->where('hreview.slot_date',$datepicker)

            ->where('hprocedure.ID',$procName)*/

            ->get();

        //echo $this->db->last_query();die();

        //$f=$tablequery->result();

        //print_r($f);die('dd');

        return $tablequery->result();



    }

     function gethomephydata()

    {

        $userid=$this->session->userdata("userid");
       
        $tablequery=$this->db->query("SELECT distinct hreview.ID, hreview.review, hreview.rating, hspecialist.name as specialistname, hspecialist.picture as specialist_picture, hpatient.fname as patient_name, hpatient.picture as patient_picture, hprocedure.procedure_name FROM hreview JOIN hspecialist ON hspecialist.userID=hreview.specialist_id JOIN hprocedure ON hprocedure.ID=hreview.procedure_id JOIN hpatient ON hpatient.userID=hreview.patient_id  JOIN hprocedurecategory ON hprocedure.procedure_cat_id=hprocedurecategory.ID JOIN hbooking ON hbooking.procedure_id=hreview.procedure_id WHERE hbooking.homephy_id=".$userid);
      

        return $tablequery->result();

    }


}