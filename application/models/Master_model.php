<?php
class Master_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    /* Common work */
    public function update_table($id_column_name,$id_value,$table_name,$data_array)
    {
        $this->db->trans_start();
        $data = $data_array;
        $this->db->where($id_column_name, $id_value);
        $this->db->update($table_name, $data);

        $this->db->trans_complete();
    }
    public function insert_row_table($table_name,$data_array)
    {
        $this->db->trans_start();
        $data = $data_array;
        $this->db->insert($table_name, $data);
        $this->db->trans_complete();
    }
    public function get_column_table($id_column_name,$id_value,$table_name,$columns)
    {

        $this->db->select(implode(",",$columns) );
        $query=$this->db->where($table_name, array($id_column_name =>  $id_value));
        return $query->row_array();
    }
    public function get_multi_column_table($condition,$table_name,$columns)
    {

        $this->db->select(implode(",",$columns) );
        $query=$this->db->where($table_name,$condition);
        return $query->row_array();
    }
    public function delete_tablerow($tablename,$arraycondition)
    {
        $this->db->delete($tablename,(array)$arraycondition);


    }
    /* end common work */



    /*species work start here */
    public function add_species()
    {
        $this->db->trans_start();
        $data = array(
            'sname' => $this->input->post('species'),
            'scode' => $this->input->post('speciescode'),
            'createdby' => $this->session->userdata("userid"),
            'createddate' => date("Y-m-d")
        );
        $this->db->insert('species', $data);

        $this->db->trans_complete();
    }
    public function edit_species($id)
    {
        $this->db->trans_start();
        $data = array(
            'sname' => $this->input->post('species'),
            'scode' => $this->input->post('speciescode')
        );
        $this->db->where('species_id', $id);
        $this->db->update('species', $data);;

        $this->db->trans_complete();
    }
    public function get_species($id)
    {
        $query = $this->db->get_where('species', array('species_id' => $id));
        return $query->row_array();
    }
    public function delete_species($id)
    {
        $this->db->delete('species', array('species_id' => $id));

    }
    public function species_combo()
    {

        $query = $this->db->get('species');
        $ress= $query->result();
        $output=array();
        $output[""]="Select Species";
        foreach($ress as $res)
        {
            $output[$res->species_id]=$res->sname;

        }

        return $output;
    }
    public function species_code_combo()
    {

        $query = $this->db->get('species');
        $ress= $query->result();
        $output=array();
        $output[""]="Select Species Code";
        foreach($ress as $res)
        {
            $output[$res->species_id]=$res->scode;

        }

        return $output;
    }
    /* species work end here */
    /*breed work start */
    public function add_breed()
    {
        $this->db->trans_start();
        $data = array(
            'bname' => $this->input->post('breed'),
            'bcode' => $this->input->post('breedcode'),
            "species_id"=> $this->input->post('species'),
            'createdby' => $this->session->userdata("userid"),
            'createddate' => date("Y-m-d")
        );
        $this->db->insert('breed', $data);
        $id= $this->db->insert_id();
        $data = array(
        'breed_id' => $id,
        'expheataftercalving' => $this->input->post('expheataftercalving'),
        'intsubheats' => $this->input->post('intsubheats'),
        'pd1' => $this->input->post('pd1'),
        'pd2' => $this->input->post('pd2'),
        'pregdrybefore' => $this->input->post('pregdrybefore'),
        'insurduedate' => $this->input->post('insurduedate'),
        'milkinterval' => $this->input->post('milkinterval'),
        'preparecalving' => $this->input->post('preparecalving'),
        'firstserviceaftercalving' => $this->input->post('firstserviceaftercalving'),
        'heiferage' => $this->input->post('heiferage'),
        'adultmaleage' => $this->input->post('adultmaleage'),
        'almageatfirstheat' => $this->input->post('almageatfirstheat'),
        'almaiproblem' => $this->input->post('almaiproblem'),
        'almgestationdays' => $this->input->post('almgestationdays'),
        'almpregencyrate' => $this->input->post('almpregencyrate'),
        'almmilkyield' => $this->input->post('almmilkyield'),
        'almlactationyield' => $this->input->post('almlactationyield'),
        'almvariationmillkprod' => $this->input->post('almvariationmillkprod'),
        'herdmilkyieldperday' => $this->input->post('herdmilkyieldperday'),
        'herdpeakyield' => $this->input->post('herdpeakyield'),
        'herdpeakday' => $this->input->post('herdpeakday'),
        'herdopenperiod' => $this->input->post('herdopenperiod'),
        'herddryperiod' => $this->input->post('herddryperiod'),
        'herd305daymilkyield' => $this->input->post('herd305daymilkyield'),
        'herdlactationlength' => $this->input->post('herdlactationlength'),
        'milk10' => $this->input->post('milk10'),
        'avg10' => $this->input->post('avg10'),
        'milk20' => $this->input->post('milk20'),
        'avg20' => $this->input->post('avg20'),
        'milk30' => $this->input->post('milk30'),
        'avg30' => $this->input->post('avg30'),
        'milk40' => $this->input->post('milk40'),
        'avg40' => $this->input->post('avg40'),
        'milk50' => $this->input->post('milk50'),
        'avg50' => $this->input->post('avg50'),
        'milk60' => $this->input->post('milk60'),
        'avg60' => $this->input->post('avg60'),
        'milk70' => $this->input->post('milk70'),
        'avg70' => $this->input->post('avg70'),
        'milk80' => $this->input->post('milk80'),
        'avg80' => $this->input->post('avg80'),
        'milk90' => $this->input->post('milk90'),
        'avg90' => $this->input->post('avg90'),
        'milk100' => $this->input->post('milk100'),
        'avg100' => $this->input->post('avg100'),
        'milk110' => $this->input->post('milk110'),
        'avg110' => $this->input->post('avg110'),
        'milk120' => $this->input->post('milk120'),
        'avg120' => $this->input->post('avg120'),
        'milk130' => $this->input->post('milk130'),
        'avg130' => $this->input->post('avg130'),
        'milk140' => $this->input->post('milk140'),
        'avg140' => $this->input->post('avg140'),
        'milk150' => $this->input->post('milk150'),
        'avg150' => $this->input->post('avg150'),
        'milk160' => $this->input->post('milk160'),
        'avg160' => $this->input->post('avg160'),
        'milk170' => $this->input->post('milk170'),
        'avg170' => $this->input->post('avg170'),
        'milk180' => $this->input->post('milk180'),
        'avg180' => $this->input->post('avg180'),
        'milk190' => $this->input->post('milk190'),
        'avg190' => $this->input->post('avg190'),
        'milk200' => $this->input->post('milk200'),
        'avg200' => $this->input->post('avg200'),
        'milk210' => $this->input->post('milk210'),
        'avg210' => $this->input->post('avg210'),
        'milk220' => $this->input->post('milk220'),
        'avg220' => $this->input->post('avg220'),
        'milk230' => $this->input->post('milk230'),
        'avg230' => $this->input->post('avg230'),
        'milk240' => $this->input->post('milk240'),
        'avg240' => $this->input->post('avg240'),
        'milk250' => $this->input->post('milk250'),
        'avg250' => $this->input->post('avg250'),
        'milk260' => $this->input->post('milk260'),
        'avg260' => $this->input->post('avg260'),
        'milk270' => $this->input->post('milk270'),
        'avg270' => $this->input->post('avg270'),
        'milk280' => $this->input->post('milk280'),
        'avg280' => $this->input->post('avg280'),
        'milk290' => $this->input->post('milk290'),
        'avg290' => $this->input->post('avg290'),
        'milk300' => $this->input->post('milk300'),
        'avg300' => $this->input->post('avg300'),
        'milk310' => $this->input->post('milk310'),
        'avg310' => $this->input->post('avg310'),
        'milk320' => $this->input->post('milk320'),
        'avg320' => $this->input->post('avg320'),
        'milk330' => $this->input->post('milk330'),
        'avg330' => $this->input->post('avg330'),
        'milk340' => $this->input->post('milk340'),
        'avg340' => $this->input->post('avg340'),
        'milk350' => $this->input->post('milk350'),
        'avg350' => $this->input->post('avg350'),
        'fat' => $this->input->post('fat'),
        'snf' => $this->input->post('snf'),
        'lactose' => $this->input->post('lactose'),
        'protein' => $this->input->post('protein')
    );
        $this->db->insert('breedmeta', $data);
        $this->db->trans_complete();
    }
    public function edit_breed($id)
    {
        $this->db->trans_start();
        $data = array(
            'bname' => $this->input->post('breed'),
            'bcode' => $this->input->post('breedcode'),
            "species_id"=> $this->input->post('species')
        );
        $this->db->where('breed_id', $id);
        $this->db->update('breed', $data);;
        $data = array(
            'breed_id' => $id,
            'expheataftercalving' => $this->input->post('expheataftercalving'),
            'intsubheats' => $this->input->post('intsubheats'),
            'pd1' => $this->input->post('pd1'),
            'pd2' => $this->input->post('pd2'),
            'pregdrybefore' => $this->input->post('pregdrybefore'),
            'insurduedate' => $this->input->post('insurduedate'),
            'milkinterval' => $this->input->post('milkinterval'),
            'preparecalving' => $this->input->post('preparecalving'),
            'firstserviceaftercalving' => $this->input->post('firstserviceaftercalving'),
            'heiferage' => $this->input->post('heiferage'),
            'adultmaleage' => $this->input->post('adultmaleage'),
            'almageatfirstheat' => $this->input->post('almageatfirstheat'),
            'almaiproblem' => $this->input->post('almaiproblem'),
            'almgestationdays' => $this->input->post('almgestationdays'),
            'almpregencyrate' => $this->input->post('almpregencyrate'),
            'almmilkyield' => $this->input->post('almmilkyield'),
            'almlactationyield' => $this->input->post('almlactationyield'),
            'almvariationmillkprod' => $this->input->post('almvariationmillkprod'),
            'herdmilkyieldperday' => $this->input->post('herdmilkyieldperday'),
            'herdpeakyield' => $this->input->post('herdpeakyield'),
            'herdpeakday' => $this->input->post('herdpeakday'),
            'herdopenperiod' => $this->input->post('herdopenperiod'),
            'herddryperiod' => $this->input->post('herddryperiod'),
            'herd305daymilkyield' => $this->input->post('herd305daymilkyield'),
            'herdlactationlength' => $this->input->post('herdlactationlength'),
            'herdcalvinginterval' => $this->input->post('herdcalvinginterval'),
            'milk10' => $this->input->post('milk10'),
            'avg10' => $this->input->post('avg10'),
            'milk20' => $this->input->post('milk20'),
            'avg20' => $this->input->post('avg20'),
            'milk30' => $this->input->post('milk30'),
            'avg30' => $this->input->post('avg30'),
            'milk40' => $this->input->post('milk40'),
            'avg40' => $this->input->post('avg40'),
            'milk50' => $this->input->post('milk50'),
            'avg50' => $this->input->post('avg50'),
            'milk60' => $this->input->post('milk60'),
            'avg60' => $this->input->post('avg60'),
            'milk70' => $this->input->post('milk70'),
            'avg70' => $this->input->post('avg70'),
            'milk80' => $this->input->post('milk80'),
            'avg80' => $this->input->post('avg80'),
            'milk90' => $this->input->post('milk90'),
            'avg90' => $this->input->post('avg90'),
            'milk100' => $this->input->post('milk100'),
            'avg100' => $this->input->post('avg100'),
            'milk110' => $this->input->post('milk110'),
            'avg110' => $this->input->post('avg110'),
            'milk120' => $this->input->post('milk120'),
            'avg120' => $this->input->post('avg120'),
            'milk130' => $this->input->post('milk130'),
            'avg130' => $this->input->post('avg130'),
            'milk140' => $this->input->post('milk140'),
            'avg140' => $this->input->post('avg140'),
            'milk150' => $this->input->post('milk150'),
            'avg150' => $this->input->post('avg150'),
            'milk160' => $this->input->post('milk160'),
            'avg160' => $this->input->post('avg160'),
            'milk170' => $this->input->post('milk170'),
            'avg170' => $this->input->post('avg170'),
            'milk180' => $this->input->post('milk180'),
            'avg180' => $this->input->post('avg180'),
            'milk190' => $this->input->post('milk190'),
            'avg190' => $this->input->post('avg190'),
            'milk200' => $this->input->post('milk200'),
            'avg200' => $this->input->post('avg200'),
            'milk210' => $this->input->post('milk210'),
            'avg210' => $this->input->post('avg210'),
            'milk220' => $this->input->post('milk220'),
            'avg220' => $this->input->post('avg220'),
            'milk230' => $this->input->post('milk230'),
            'avg230' => $this->input->post('avg230'),
            'milk240' => $this->input->post('milk240'),
            'avg240' => $this->input->post('avg240'),
            'milk250' => $this->input->post('milk250'),
            'avg250' => $this->input->post('avg250'),
            'milk260' => $this->input->post('milk260'),
            'avg260' => $this->input->post('avg260'),
            'milk270' => $this->input->post('milk270'),
            'avg270' => $this->input->post('avg270'),
            'milk280' => $this->input->post('milk280'),
            'avg280' => $this->input->post('avg280'),
            'milk290' => $this->input->post('milk290'),
            'avg290' => $this->input->post('avg290'),
            'milk300' => $this->input->post('milk300'),
            'avg300' => $this->input->post('avg300'),
            'milk310' => $this->input->post('milk310'),
            'avg310' => $this->input->post('avg310'),
            'milk320' => $this->input->post('milk320'),
            'avg320' => $this->input->post('avg320'),
            'milk330' => $this->input->post('milk330'),
            'avg330' => $this->input->post('avg330'),
            'milk340' => $this->input->post('milk340'),
            'avg340' => $this->input->post('avg340'),
            'milk350' => $this->input->post('milk350'),
            'avg350' => $this->input->post('avg350'),
            'fat' => $this->input->post('fat'),
            'snf' => $this->input->post('snf'),
            'lactose' => $this->input->post('lactose'),
            'protein' => $this->input->post('protein')
        );
        $this->db->where('breed_id', $id);
        $this->db->update('breedmeta', $data);;
        $this->db->trans_complete();
    }
    public function get_breed($id)
    {
        $query = $this->db->get_where('breed', array('breed_id' => $id));
        return $query->row_array();
    }
    public function get_breedmeta($breedid)
    {
        $query = $this->db->get_where('breedmeta', array('breed_id' => $breedid));
        return $query->row_array();
    }
    public function delete_breed($id)
    {
        $this->db->delete('breedmeta', array('breed_id' => $id));
        $this->db->delete('breed', array('breed_id' => $id));

    }
    public function breed_combo()
    {

        $query = $this->db->get('breed');
        $ress= $query->result();
        $output=array();
        $output[""]="Select Breed";
        foreach($ress as $res)
        {
            $output[$res->breed_id]=$res->bname;

        }

        return $output;
    }
    public function get_ajax_breed_combo($species_id)
    {
        $query = $this->db->query("select breed_id,bname from breed where species_id=".$species_id."");
        //$query = $this->db->get('breed');
        $ress= $query->result();

        $result="<option value=''>Select Breed</option>";
        foreach($ress as $res)
        {
            $result.="<option value='".$res->breed_id."'>".$res->bname."</option>";

        }

        echo $result;
    }
    public function get_ajax_breed_code_combo($species_id)
    {
        $query = $this->db->query("select breed_id,bcode from breed where species_id=".$species_id."");
        //$query = $this->db->get('breed');
        $ress= $query->result();

        $result="<option value=''>Select Breed</option>";
        foreach($ress as $res)
        {
            $result.="<option value='".$res->breed_id."'>".$res->bcode."</option>";

        }

        echo $result;
    }
    public function get_breed_combo($species_id)
    {

        $query = $this->db->query("select breed_id,bname from breed where species_id=".$species_id."");
        $ress= $query->result();
        $output=array();
        $output[""]="Select Breed";
        foreach($ress as $res)
        {
            $output[$res->breed_id]=$res->bname;

        }

        return $output;
    }
    public function breed_code_combo()
    {

        $query = $this->db->get('breed');
        $ress= $query->result();
        $output=array();
        $output[""]="Select Breed Code";
        foreach($ress as $res)
        {
            $output[$res->breed_id]=$res->bcode;

        }

        return $output;
    }
    public function get_breed_meta_by_user($breedid,$userid)
    {
        $query = $this->db->get_where('breedmeta', array('breed_id' => $breedid,"user_id"=>$userid));
        return $query->row_array();
    }
    /*breed work end */
    /* sire work start */
    public function add_sire()
    {
        $this->db->trans_start();
        $data = array(
            'sirecode' => $this->input->post('sirecode'),
            'sirename' => $this->input->post('sirename'),
            'dob' => $this->input->post('dob'),
            'birthweight' => $this->input->post('birthweight'),
            'species_id' => $this->input->post('species'),
            'breed_id' => $this->input->post('breed'),
            'minstock' => $this->input->post('minstock'),
            'openqty' => $this->input->post('openqty'),
            'rate' => $this->input->post('rate'),
            'openamt' => $this->input->post('openamt'),
            'suspended' => $this->input->post('suspended'),
            "createdby"=> $this->session->userdata('createdby')
        );
        $this->db->insert('sire', $data);

        $this->db->trans_complete();
    }
    public function edit_sire($id)
    {
        $this->db->trans_start();
        $data = array(
            'sirecode' => $this->input->post('sirecode'),
            'sirename' => $this->input->post('sirename'),
            'dob' => $this->input->post('dob'),
            'birthweight' => $this->input->post('birthweight'),
            'species_id' => $this->input->post('species'),
            'breed_id' => $this->input->post('breed'),
            'minstock' => $this->input->post('minstock'),
            'openqty' => $this->input->post('openqty'),
            'rate' => $this->input->post('rate'),
            'openamt' => $this->input->post('openamt'),
            'suspended' => $this->input->post('suspended')

        );
        $this->db->where('sire_id', $id);
        $this->db->update('sire', $data);;

        $this->db->trans_complete();
    }
    public function get_sire($id)
    {
        $query = $this->db->get_where('sire', array('sire_id' => $id,"createdby"=> $this->session->userdata("userid")));
        return $query->row_array();
    }
    public function delete_sire($id)
    {
        $this->db->delete('sire', array('sire_id' => $id,"createdby"=> $this->session->userdata("userid")));

    }
    public function sire_combo()
    {

        $query = $this->db->get_where('sire', array('suspended' => 0,"createdby"=> $this->session->userdata("userid")));
        $ress= $query->result();
        $output=array();
        $output[""]="Select Sire";
        foreach($ress as $res)
        {
            $output[$res->sire_id]=$res->sirename;

        }

        return $output;
    }
    /*sire work end */
    /*staff category work start */
    public function add_staff_category()
    {
        $this->db->trans_start();
        $data = array(
            'staffcatname' => $this->input->post('staffcatname'),
            "createdby"=> $this->session->userdata("userid")
        );
        $this->db->insert('staffcategory', $data);

        $this->db->trans_complete();
    }
    public function edit_staff_category($id)
    {
        $this->db->trans_start();
        $data = array(
            'staffcatname' => $this->input->post('staffcatname')

        );
        $this->db->where('staffcat_id', $id);
        $this->db->update('staffcategory', $data);;

        $this->db->trans_complete();
    }
    public function get_staff_category($id)
    {
        $query = $this->db->get_where('staffcategory', array('staffcat_id' => $id,"createdby"=> $this->session->userdata("userid")));
        return $query->row_array();
    }
    public function delete_staff_category($id)
    {
        $this->db->delete('staffcategory', array('staffcat_id' => $id,"createdby"=> $this->session->userdata("userid")));
    }
    public function staff_category_combo()
    {
        $query = $this->db->get_where('staffcategory', array("createdby"=> $this->session->userdata("userid")));
        $ress= $query->result();
        $output=array();
        $output[""]="Select Staff Category";
        foreach($ress as $res)
        {
            $output[$res->staffcat_id]=$res->staffcatname;

        }
        return $output;
    }
    /* staff category work end */
    /*Staff work start here */
    public function add_staff()
    {
        $this->db->trans_start();
        $data = array(
            'scode' => $this->input->post('scode'),
            'sname' => $this->input->post('sname'),
            'staffcat_id' => $this->input->post('staffcat'),
            'address' => $this->input->post('address'),
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'phone' => $this->input->post('phone'),
            'mobile' => $this->input->post('mobile'),
            'email' => $this->input->post('email'),
            'saltype' => $this->input->post('saltype'),
            'salary' => $this->input->post('salary'),
            'suspended' => $this->input->post('suspended'),
            "createdby"=> $this->session->userdata("userid")

        );
        $this->db->insert('staff', $data);

        $this->db->trans_complete();
    }
    public function edit_staff($id)
    {
        $this->db->trans_start();
        $data = array(
            'scode' => $this->input->post('scode'),
            'sname' => $this->input->post('sname'),
            'staffcat_id' => $this->input->post('staffcat'),
            'address' => $this->input->post('address'),
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'phone' => $this->input->post('phone'),
            'mobile' => $this->input->post('mobile'),
            'email' => $this->input->post('email'),
            'saltype' => $this->input->post('saltype'),
            'salary' => $this->input->post('salary'),
            'suspended' => $this->input->post('suspended')

        );
        $this->db->where('staff_id', $id);
        $this->db->update('staff', $data);;

        $this->db->trans_complete();
    }
    public function get_staff($id)
    {
        $query = $this->db->get_where('staff', array('staff_id' => $id,"createdby"=> $this->session->userdata("userid")));
        return $query->row_array();
    }
    public function delete_staff($id)
    {
        $this->db->delete('staff', array('staff_id' => $id,"createdby"=> $this->session->userdata("userid")));
    }
    public function staff_combo()
    {
        $query = $this->db->get_where('staff', array('suspended' => 0,"createdby"=> $this->session->userdata("userid")));
        $ress= $query->result();
        $output=array();
        $output[""]="Select Staff";
        foreach($ress as $res)
        {
            $output[$res->staff_id]=$res->sname;

        }
        return $output;
    }
    /*Staff work end here */

    /*Herd work start */
    public function add_herd()
    {
        $this->db->trans_start();
        $data = array(
            'hcode' => $this->input->post('hcode'),
            'hname' => $this->input->post('hname'),
            'description' => $this->input->post('description'),
            'breed_id' => $this->input->post('breed'),
            'createdby' => $this->session->userdata("userid"),
            'createddate' =>date("Y-m-d")
        );
        $this->db->insert('herd', $data);

        $this->db->trans_complete();
    }
    public function edit_herd($id)
    {
        $this->db->trans_start();
        $data = array(
            'hcode' => $this->input->post('hcode'),
            'hname' => $this->input->post('hname'),
            'breed_id' => $this->input->post('breed'),
            'description' => $this->input->post('description')

        );
        $this->db->where('herd_id', $id);
        $this->db->update('herd', $data);;

        $this->db->trans_complete();
    }
    public function get_herd($id)
    {
        $query = $this->db->get_where('herd', array('herd_id' => $id,"createdby"=> $this->session->userdata("userid")));
        return $query->row_array();
    }
    public function delete_herd($id)
    {
        $this->db->delete('herd', array('herd_id' => $id,"createdby"=> $this->session->userdata("userid")));
    }
    public function herd_combo()
    {
        $query = $this->db->get_where('herd', array("createdby"=> $this->session->userdata("userid")));
        $ress= $query->result();
        $output=array();
        $output[""]="Select Herd";
        foreach($ress as $res)
        {
            $output[$res->herd_id]=$res->hname;

        }
        return $output;
    }
    public function get_ajax_herd_combo($breed)
    {
        //$query = $this->db->get('lot');
        $query = $this->db->query("select herd_id,hname from herd where breed_id=".$breed." and createdby=".$this->session->userdata("userid"));
        $ress= $query->result();
        $result="<option value=''>Select Herd</option>";
        foreach($ress as $res)
        {
            $result.="<option value='".$res->herd_id."'>".$res->hname."</option>";

        }
        echo $result;
    }
    /* Herd work end */

    /*LOT work start */
    public function add_lot()
    {
        $this->db->trans_start();
        $data = array(
            'lcode' => $this->input->post('lcode'),
            'lname' => $this->input->post('lname'),
            'herd_id' => $this->input->post('herd'),
            'staff_id' =>$this->input->post('emp'),
            'description' =>$this->input->post('description'),
            'createdby' => $this->session->userdata("userid"),
            'createddate' =>date("Y-m-d")
        );
        $this->db->insert('lot', $data);

        $this->db->trans_complete();
    }
    public function edit_lot($id)
    {
        $this->db->trans_start();
        $data = array(
            'lcode' => $this->input->post('lcode'),
            'lname' => $this->input->post('lname'),
            'herd_id' => $this->input->post('herd'),
            'staff_id' =>$this->input->post('emp'),
            'description' =>$this->input->post('description')
        );
        $this->db->where('lot_id', $id);
        $this->db->update('lot', $data);;

        $this->db->trans_complete();
    }
    public function get_lot($id)
    {
        $query = $this->db->get_where('lot', array('lot_id' => $id,'createdby' => $this->session->userdata("userid")));
        return $query->row_array();
    }
    public function delete_lot($id)
    {
        $this->db->delete('lot', array('lot_id' => $id,'createdby' => $this->session->userdata("userid")));
    }
    public function lot_combo()
    {
        $query = $this->db->get_where('lot', array('createdby' => $this->session->userdata("userid")));
        $ress= $query->result();
        $output=array();
        $output[""]="Select LOT";
        foreach($ress as $res)
        {
            $output[$res->lot_id]=$res->lname;

        }
        return $output;
    }
    public function get_ajax_lot_combo($herd)
    {
        //$query = $this->db->get('lot');
        $query = $this->db->query("select lot_id,lname from lot where herd_id=".$herd." and createdby=".$this->session->userdata("userid"));
        $ress= $query->result();
        $result="<option value=''>Select Lot</option>";
        foreach($ress as $res)
        {
            $result.="<option value='".$res->lot_id."'>".$res->lname."</option>";

        }
        echo $result;
    }
    public function get_ajax_lot_code_combo($herd)
    {
        //$query = $this->db->get('lot');
        $query = $this->db->query("select lot_id,lcode from lot where herd_id=".$herd." and createdby=".$this->session->userdata("userid"));
        $ress= $query->result();
        $result="<option value=''>Select Lot</option>";
        foreach($ress as $res)
        {
            $result.="<option value='".$res->lot_id."'>".$res->lcode."</option>";

        }
        echo $result;
    }
    public function get_lot_combo($herd)
    {
        $query = $this->db->query("select lot_id,lname from lot where herd_id=".$herd." and createdby=".$this->session->userdata("userid"));
        $ress= $query->result();
        $output=array();
        $output[""]="Select LOT";
        foreach($ress as $res)
        {
            $output[$res->lot_id]=$res->lname;

        }
        return $output;
    }
    public function get_herd_lot_combo()
    {
        $query = $this->db->query("select a.lot_id,a.lname,b.hname from lot a inner join herd b on a.herd_id=b.herd_id and a.createdby=".$this->session->userdata("userid"));
        $ress= $query->result();
        $output=array();
        $output[""]="Select LOT";
        foreach($ress as $res)
        {
            $output[$res->lot_id]=$res->hname."->".$res->lname;

        }
        return $output;
    }
    /* LOT work end */


    /*cattle work start */
    public function add_cattle()
    {
        $this->db->trans_start();
        $dob = new DateTime($this->input->post('birthdate'));
        $data = array(
            'idno' => $this->input->post('idno'),
            'cname' => $this->input->post('cname'),
            'species_id' => $this->input->post('species'),
            'breed_id' => $this->input->post('breed'),
            'herd_id' => $this->input->post('herd'),
            'lot_id' => $this->input->post('lot'),
            'parity' => $this->input->post('parity'),
            'animaltype'=>  $this->input->post('animaltype'),
            'hornstatus'=>  $this->input->post('hornstatus'),
            'dob' =>$dob->format("Y-m-d"),
            'suspended' => $this->input->post('suspended'),
            'birthweight' =>$this->input->post('birthweight'),
            'sex' =>$this->input->post('sex'),
            'psireid' =>$this->input->post('psireid'),
            'pdamid' =>$this->input->post('pdamid'),
            'psireptamilk' =>$this->input->post('psireptamilk'),
            'psireptafat' =>$this->input->post('psireptafat'),
            'psireptaprotein' =>$this->input->post('psireptaprotein'),
            'pdamptamilk' =>$this->input->post('pdamptamilk'),
            'pdamptafat' =>$this->input->post('pdamptafat'),
            'pdamptaprotein' =>$this->input->post('pdamptaprotein'),
            'psireindex' =>$this->input->post('psireindex'),
            'pdamyield' =>$this->input->post('pdamyield'),
            'p1sireid' =>$this->input->post('p1sireid'),
            'p1damid' =>$this->input->post('p1damid'),
            'p1sireptamilk' =>$this->input->post('p1sireptamilk'),
            'p1sireptafat' =>$this->input->post('p1sireptafat'),
            'p1sireptaprotein' =>$this->input->post('p1sireptaprotein'),
            'p1damptamilk' =>$this->input->post('p1damptamilk'),
            'p1damptafat' =>$this->input->post('p1damptafat'),
            'p1damptaprotein' =>$this->input->post('p1damptaprotein'),
            'p1sireindex' =>$this->input->post('p1sireindex'),
            'p1damyield' =>$this->input->post('p1damyield'),
            'p2sireid' =>$this->input->post('p2sireid'),
            'p2damid' =>$this->input->post('p2damid'),
            'p2sireptamilk' =>$this->input->post('p2sireptamilk'),
            'p2sireptafat' =>$this->input->post('p2sireptafat'),
            'p2sireptaprotein' =>$this->input->post('p2sireptaprotein'),
            'p2damptamilk' =>$this->input->post('p2damptamilk'),
            'p2damptafat' =>$this->input->post('p2damptafat'),
            'p2damptaprotein' =>$this->input->post('p2damptaprotein'),
            'p2sireindex' =>$this->input->post('p2sireindex'),
            'p2damyield' =>$this->input->post('p2damyield'),
            'suspended' =>$this->input->post('suspended'),
            'createdby' => $this->session->userdata("userid"),
            'createddate' => date("Y-m-d")
        );
        $this->db->insert('cattle', $data);

        $this->db->trans_complete();
    }
    public function edit_cattle($id)
    {
        $this->db->trans_start();
        $dob = new DateTime($this->input->post('birthdate'));

        $data = array(
            'idno' => $this->input->post('idno'),
            'cname' => $this->input->post('cname'),
            'species_id' => $this->input->post('species'),
            'breed_id' => $this->input->post('breed'),
            'herd_id' => $this->input->post('herd'),
            'lot_id' => $this->input->post('lot'),
            'parity' => $this->input->post('parity'),
            'animaltype'=>  $this->input->post('animaltype'),
            'hornstatus'=>  $this->input->post('hornstatus'),
            'dob' =>$dob->format("Y-m-d"),
            'suspended' => $this->input->post('suspended'),
            'birthweight' =>$this->input->post('birthweight'),
            'sex' =>$this->input->post('sex'),
            'psireid' =>$this->input->post('psireid'),
            'pdamid' =>$this->input->post('pdamid'),
            'psireptamilk' =>$this->input->post('psireptamilk'),
            'psireptafat' =>$this->input->post('psireptafat'),
            'psireptaprotein' =>$this->input->post('psireptaprotein'),
            'pdamptamilk' =>$this->input->post('pdamptamilk'),
            'pdamptafat' =>$this->input->post('pdamptafat'),
            'pdamptaprotein' =>$this->input->post('pdamptaprotein'),
            'psireindex' =>$this->input->post('psireindex'),
            'pdamyield' =>$this->input->post('pdamyield'),
            'p1sireid' =>$this->input->post('p1sireid'),
            'p1damid' =>$this->input->post('p1damid'),
            'p1sireptamilk' =>$this->input->post('p1sireptamilk'),
            'p1sireptafat' =>$this->input->post('p1sireptafat'),
            'p1sireptaprotein' =>$this->input->post('p1sireptaprotein'),
            'p1damptamilk' =>$this->input->post('p1damptamilk'),
            'p1damptafat' =>$this->input->post('p1damptafat'),
            'p1damptaprotein' =>$this->input->post('p1damptaprotein'),
            'p1sireindex' =>$this->input->post('p1sireindex'),
            'p1damyield' =>$this->input->post('p1damyield'),
            'p2sireid' =>$this->input->post('p2sireid'),
            'p2damid' =>$this->input->post('p2damid'),
            'p2sireptamilk' =>$this->input->post('p2sireptamilk'),
            'p2sireptafat' =>$this->input->post('p2sireptafat'),
            'p2sireptaprotein' =>$this->input->post('p2sireptaprotein'),
            'p2damptamilk' =>$this->input->post('p2damptamilk'),
            'p2damptafat' =>$this->input->post('p2damptafat'),
            'p2damptaprotein' =>$this->input->post('p2damptaprotein'),
            'p2sireindex' =>$this->input->post('p2sireindex'),
            'p2damyield' =>$this->input->post('p2damyield'),
            'suspended' =>$this->input->post('suspended')
        );
        $this->db->where('cattle_id', $id);
        $this->db->update('cattle', $data);;

        $this->db->trans_complete();
    }
    public function update_cattle_parity($id,$parity)
    {
        $this->db->trans_start();
        $data = array(
            'parity' => $parity
        );
        $this->db->where('cattle_id', $id);
        $this->db->update('cattle', $data);;

        $this->db->trans_complete();
    }
    public function get_cattle($id)
    {
        $query = $this->db->get_where('cattle', array('cattle_id' => $id,'createdby' => $this->session->userdata("userid")));
        return $query->row_array();
    }
    public function get_cattle_via_idno($idno)
    {
        $query = $this->db->get_where('cattle', array('idno' => $idno,'createdby' => $this->session->userdata("userid")));
        return $query->row_array();
    }
    public function delete_cattle($id)
    {
        $this->db->delete('cattle', array('cattle_id' => $id,'createdby' => $this->session->userdata("userid")));
    }
    public function cattle_combo()
    {
        $query = $this->db->get_where('cattle', array('createdby' => $this->session->userdata("userid")));
        $ress= $query->result();
        $output=array();

        foreach($ress as $res)
        {
            $output[$res->cattle_id]=$res->idno;

        }
        return $output;
    }
    public function get_ajax_lot_cattle_combo($lot)
    {
        $query = $this->db->query("select cattle_id,idno from cattle where lot_id=".$lot." and createdby=".$this->session->userdata("userid"));
        $ress= $query->result();
        $result="<option value=''>Select Cattle IDNO</option>";
        foreach($ress as $res)
        {
            $result.="<option value='".$res->cattle_id."'>".$res->idno."</option>";

        }
        echo $result;

    }
    public function get_json_lot_milking_cattle($lot)
    {
        $query = $this->db->query("select idno from cattle where lot_id=".$lot." and milking=1 and createdby=".$this->session->userdata("userid"));
        $ress= $query->result_array();
        echo json_encode($ress);

    }
    public function get_ajax_check_lot_cattle_idno($lotid,$cattleidno)
    {
        $query = $this->db->query("select cattle_id,idno from cattle where lot_id=".$lotid." and idno='".$cattleidno."'  and createdby=".$this->session->userdata("userid"));
        $ress= $query->result_array();
      //  echo "select cattle_id,idno from cattle where lot_id=".$lotid." and idno='".$cattleidno."'";
       //var_dump($ress);
        if(count($ress))
        {
            echo "true";
            exit();
        }
        echo "false";
    }
    public function get_dashboard_cattle_count_by_species()
    {

        $query = $this->db->query("SELECT UPPER(animaltype) as label, count(a.cattle_id) as value FROM cattle a where  a.createdby=".$this->session->userdata("userid")." and a.suspended=0 and a.sold=0 and a.dead=0 and a.createdby=".$this->session->userdata("userid")." group by animaltype");
        $ress= $query->result_array();
        return json_encode($ress);
    }
    public function get_dashboard_heifer_for_first_heat()
    {
        $query = $this->db->query("SELECT count(a.idno) as total FROM `cattle` a inner join breedmeta b on a.breed_id=b.breed_id and pregnant=0 and milking=0 and parity=0 and (DATEDIFF(curdate(),a.dob))> (b.heiferage*30)  and (Select count(insemination_id) from insemination c where c.cattle_id=a.cattle_id)<1 and a.createdby=".$this->session->userdata("userid"));
        $res=$query->row_array();
        return json_encode($res);
    }
    public function report_heifer_for_first_heat()
    {
        $query = $this->db->query("SELECT cattle_id, idno,period_diff(date_format(curdate(), '%Y%m'), date_format(dob, '%Y%m'))  as age FROM `cattle` a inner join breedmeta b on a.breed_id=b.breed_id and pregnant=0 and milking=0 and parity=0 and (DATEDIFF(curdate(),a.dob))> (b.heiferage*30) and (Select count(insemination_id) from insemination c where c.cattle_id=a.cattle_id)<1 and a.createdby=".$this->session->userdata("userid"));
        $res=$query->result_array();
        return $res;
    }
    public function get_dashboard_first_heat_after_calving()
    {
        $query = $this->db->query("SELECT COUNT( a.idno ) AS total
                        FROM  cattle a
                        INNER JOIN breedmeta b ON a.breed_id = b.breed_id
                        AND a.pregnant =0
                        AND a.milking =1
                        INNER JOIN calving c ON a.cattle_id = c.cattle_id
                        AND a.parity = ( c.parity +1 )
                        AND DATEDIFF( CURDATE( ) , c.calvingdate ) >= b.expheataftercalving
                        AND (

                        SELECT COUNT( * )
                        FROM insemination d
                        WHERE a.cattle_id = d.cattle_id
                        AND a.parity = d.parity
                        ) <1  and a.createdby=".$this->session->userdata("userid"));
        $res=$query->row_array();
        return json_encode($res);
    }
    public function report_first_heat_after_calving()
    {
        $query = $this->db->query("SELECT  a.idno, DATEDIFF( CURDATE( ) , c.calvingdate ) as daysaftercalving
                        FROM  cattle a
                        INNER JOIN breedmeta b ON a.breed_id = b.breed_id
                        AND a.pregnant =0
                        AND a.milking =1
                        INNER JOIN calving c ON a.cattle_id = c.cattle_id
                        AND a.parity = ( c.parity +1 )
                        AND DATEDIFF( CURDATE( ) , c.calvingdate ) >= b.expheataftercalving
                        AND (

                        SELECT COUNT( * )
                        FROM insemination d
                        WHERE a.cattle_id = d.cattle_id
                        AND a.parity = d.parity
                        ) <1  and a.createdby=".$this->session->userdata("userid"));
        $res=$query->result_array();
        return $res;
    }
    public function corn_first_heat_after_calving($superuser_id)
    {
        $query = $this->db->query("SELECT  a.idno, DATEDIFF( CURDATE( ) , c.calvingdate ) as daysaftercalving
                        FROM  cattle a
                        INNER JOIN breedmeta b ON a.breed_id = b.breed_id
                        AND a.pregnant =0
                        AND a.milking =1
                        INNER JOIN calving c ON a.cattle_id = c.cattle_id
                        AND a.parity = ( c.parity +1 )
                        AND DATEDIFF( CURDATE( ) , c.calvingdate ) >= b.expheataftercalving
                        AND (

                        SELECT COUNT( * )
                        FROM insemination d
                        WHERE a.cattle_id = d.cattle_id
                        AND a.parity = d.parity
                        ) <1  and a.createdby=".$superuser_id);
        $res=$query->result_array();
        return $res;
    }
    public function get_dashboard_cattle_ready_for_calving()
    {
        $query = $this->db->query("SELECT count(a.idno) as total FROM `cattle` a inner join breedmeta b on
         a.breed_id=b.breed_id and a.pregnant=1 and a.milking=0 inner join  insemination c
         where a.cattle_id=c.cattle_id and a.parity=c.parity and (c.pd1='pregnant' or c.pd2='pregnant')
         and DATE_ADD(heatdate,INTERVAL (b.almgestationdays- b.preparecalving) DAY)>= curdate()");
        $res=$query->row_array();
        return json_encode($res);
    }
    public function report_cattle_ready_for_calving()
    {
        $query = $this->db->query("SELECT a.idno as total FROM `cattle` a inner join breedmeta b on
         a.breed_id=b.breed_id and a.pregnant=1 and a.milking=0 inner join  insemination c
         where a.cattle_id=c.cattle_id and a.parity=c.parity and (c.pd1='pregnant' or c.pd2='pregnant')
         and DATE_ADD(heatdate,INTERVAL (b.almgestationdays- b.preparecalving) DAY)>= curdate()");
        $res=$query->result_array();
        return $res;
    }

    public function get_ajax_check_cattle_idno($cattleidno)
    {
        $query = $this->db->query("select cattle_id,idno from cattle where idno='".$cattleidno."'  and createdby=".$this->session->userdata("userid"));
        $ress= $query->result_array();
        //  echo "select cattle_id,idno from cattle where lot_id=".$lotid." and idno='".$cattleidno."'";
        //var_dump($ress);
        if(count($ress))
        {
            echo "true";
            exit();
        }
        echo "false";
    }
    public function report_cattle_detail_lotwise($lotid)
    {
        $query= $this->db->query("select a.idno,cname,period_diff(date_format(curdate(), '%Y%m'), date_format(dob, '%Y%m'))  as age,parity,dob,b.weight from cattle a left outer join currentbodyweight b on a.cattle_id=b.cattle_id where a.lot_id=".$lotid);
        return $query->result_array();
    }
    public function report_current_bodyweight($lotid)
    {
        $query= $this->db->query("select a.idno,cname,b.weight from cattle a left outer join currentbodyweight b on a.cattle_id=b.cattle_id where a.lot_id=".$lotid);
        return $query->result_array();
    }
    public function add_cattle_died_entry()
    {
        $cattle=$this->master_model->get_cattle_via_idno($this->input->post('idno'));
        $data=array(
            "cattle_id"=>$cattle["cattle_id"],
            "deathdate" =>format_date_for_mysql($this->input->post("deathdate")),
            "note" =>$this->input->post("note"),
        );
        $this->db->trans_start();
        $this->db->insert("diedentry",$data);
        $data=array("dead"=>1,"suspended"=>1);
        $this->db->where("cattle_id",$cattle["cattle_id"]);
        $this->db->update("cattle",$data);
        $this->db->trans_complete();
    }
    public function add_cattle_sold_entry()
    {
        $cattle=$this->master_model->get_cattle_via_idno($this->input->post('idno'));
        $data=array(
            "cattle_id"=>$cattle["cattle_id"],
            "saledate" =>format_date_for_mysql($this->input->post("saledate")),
            "amt" =>$this->input->post("price"),
            "note" =>$this->input->post("note"),
        );
        $this->db->trans_start();
        $this->db->insert("soldentry",$data);
        $data=array("sold"=>1,"suspended"=>1);
        $this->db->where("cattle_id",$cattle["cattle_id"]);
        $this->db->update("cattle",$data);
        $this->db->trans_complete();
    }
    /* cattle work end */

    /* Animal Transfer work start */
    public function add_transfer_lot()
    {
        $fromlot=$this->input->post("fromlot");
        $tolot=$this->input->post("tolot");
        $tocattles=explode(",",$this->input->post("tocattle"));
        $this->db->trans_start();
        foreach($tocattles as $cattle)
        {
            //$data=array("cname");
            $query= $this->db->get_where('cattle', array('cattle_id' => $cattle,'createdby' => $this->session->userdata("userid")));
            $result= $query->result_array();
            $data=array("cattle_id"=> $result[0]["cattle_id"],
                        "idno"=> $result[0]["idno"],
                        "fromlotid"=> $fromlot,
                        "tolotid"=> $tolot,
                        "transferdate"=> date("Y-m-d")
                        );
            $this->db->insert("transferlot",$data);
            $data1=array("lot_id"=>$tolot);
            $this->db->where('cattle_id', $result[0]["cattle_id"]);
            $this->db->update('cattle', $data1);;
        }
        $this->db->trans_complete();
    }
    /* Animal Transfer Work End */
    /* change animal tag work start */
    public function change_cattle_tag()
    {
        $this->db->trans_start();
        $query= $this->db->get_where('cattle', array('cattle_id' => $this->input->post("fromidno"),'createdby' => $this->session->userdata("userid")));
        $result= $query->result_array();

        $data=array("cattle_id"=> $result[0]["cattle_id"],
            "oldidno"=> $result[0]["idno"],
            "newidno"=> $this->input->post("toidno"),
            "changedate"=> date("Y-m-d")
        );
        $this->db->insert("changetaghistory",$data);
        $data1=array("idno"=>$this->input->post("toidno"));
        if($this->input->post("changename"))
            $data1["cname"]=$this->input->post("toidno");
        $this->db->where('cattle_id',$this->input->post("fromidno"));
        $this->db->update('cattle', $data1);;
        $this->db->trans_complete();
    }
    /* change animal tag work end */
    public function add_parity_history($cattle_id,$idno,$calving_id)
    {
        $this->db->trans_start();
        $data=array("cattle_id"=> $cattle_id,
            "idno"=> $idno,
            "calving_id"=> $calving_id

        );
        $this->db->insert('parityhistory', $data);;
        $this->db->trans_complete();

    }
    /*medicinetype work start here */
    public function add_medicine_type()
    {
        $this->db->trans_start();
        $data = array(
            'medtypename' => $this->input->post('medicinetypename'),
            'createdby' => $this->session->userdata("userid"),
            'createddate' => date("Y-m-d")
        );
        $this->db->insert('medicinetype', $data);

        $this->db->trans_complete();
    }
    public function edit_medicine_type($id)
    {
        $this->db->trans_start();
        $data = array(
            'medtypename' => $this->input->post('medicinetypename')

        );

        $this->db->where('medtype_id', $id);
          $this->db->update('medicinetype', $data);;

        $this->db->trans_complete();
    }
    public function get_medicine_type($id)
    {
        $query = $this->db->get_where('medicinetype', array('medtype_id' => $id,'createdby' => $this->session->userdata("userid")));
        return $query->row_array();
    }
    public function delete_medicine_type($id)
    {
        $this->db->delete('medicinetype', array('medtype_id' => $id,'createdby' => $this->session->userdata("userid")));

    }
    public function medicine_type_array()
    {
        /*$this->db->select("medtype_id");
        $this->db->select("medtypename");
        $query = $this->db->get_where('medicinetype',array('createdby' => $this->session->userdata("userid"))); */
        $query=$this->db->query("select medtype_id as medtype, medtypename as typename from medicinetype where createdby=".$this->session->userdata("userid"));
        $ress= $query->result_array();
        $object = new stdClass();
        $object->medtype="";
        $object->typename="Select Medicine Type";
        array_unshift($ress, $object);

        return $ress;
    }
    public function medicine_type_combo()
    {

        $query = $this->db->get_where('medicinetype',array('createdby' => $this->session->userdata("userid")));
        $ress= $query->result();
        $output=array();
        $output[""]="Select Medicine Type";
        foreach($ress as $res)
        {
            $output[$res->medtype_id]=$res->medtypename;

        }

        return $output;
    }

    /*medicinetype work end here */

    /*medicine work start here */
    public function add_medicine()
    {
        $this->db->trans_start();
        $data = array(
            'medtype_id' => $this->input->post('medtype'),
            'medicinecode' => $this->input->post('medicinecode'),
            'medicinename' => $this->input->post('medicinename'),
            'genricname' => $this->input->post('genricname'),
            'unit' => $this->input->post('unit'),
            'route' => $this->input->post('route'),
            'createdby' => $this->session->userdata("userid"),
            'createddate' => date("Y-m-d")
        );
        $this->db->insert('medicine', $data);

        $this->db->trans_complete();
    }
    public function edit_medicine($id)
    {
        $this->db->trans_start();
        $data = array(
            'medtype_id' => $this->input->post('medtype'),
            'medicinecode' => $this->input->post('medicinecode'),
            'medicinename' => $this->input->post('medicinename'),
            'genricname' => $this->input->post('genricname'),
            'unit' => $this->input->post('unit'),
            'route' => $this->input->post('route')

        );

        $this->db->where('medicine_id', $id);
        $this->db->update('medicine', $data);;

        $this->db->trans_complete();
    }
    public function get_medicine($id)
    {
        $query = $this->db->get_where('medicine', array('medicine_id' => $id,'createdby' => $this->session->userdata("userid")));
        return $query->row_array();
    }
    public function delete_medicine($id)
    {
        $this->db->delete('medicine', array('medicine_id' => $id,'createdby' => $this->session->userdata("userid")));

    }
    public function medicine_combo()
    {

        $query = $this->db->get_where('medicine',array('createdby' => $this->session->userdata("userid")));
        $ress= $query->result();
        $output=array();
        $output[""]="Select Medicine";
        foreach($ress as $res)
        {
            $output[$res->medicine_id]=$res->medicinename;

        }

        return $output;
    }
    public function medicine_text_combo()
    {

        $query = $this->db->get_where('medicine',array('createdby' => $this->session->userdata("userid")));
        $ress= $query->result();
        $output=array();
        $output[""]="Select Medicine";
        foreach($ress as $res)
        {
            $output[$res->medicinename]=$res->medicinename;

        }

        return $output;
    }
    public function get_medicine_combo($medtype)
    {
        $query = $this->db->get_where('medicine',array("medtype_id"=>$medtype,'createdby' => $this->session->userdata("userid")));
        $ress= $query->result();

        $output="<option value=''>Select Medicine</option>";
        foreach($ress as $res)
        {

            $output.="<option value='".$res->medicine_id."'>".$res->medicinename."</option>";
        }
        return $output;
    }
    public function get_medicine_text_combo($medtype)
    {
        $query = $this->db->get_where('medicine',array("medtype_id"=>$medtype,'createdby' => $this->session->userdata("userid")));
        $ress= $query->result();

        $output="<option value=''>Select Medicine</option>";
        foreach($ress as $res)
        {

            $output.="<option value='".$res->medicinename."'>".$res->medicinename."</option>";
        }
        return $output;
    }
    public function medicine_code_combo()
    {

        $query = $this->db->get_where('medicine',array('createdby' => $this->session->userdata("userid")));
        $ress= $query->result();
        $output=array();
        $output[""]="Select Medicine";
        foreach($ress as $res)
        {
            $output[$res->medicine_id]=$res->medicinecode;

        }

        return $output;
    }
    /*medicine work end here */
    /*disease work start here */
    public function add_disease()
    {

        $data = array(
            'diseasename' => $this->input->post('diseasename'),
            "species_id" =>$this->input->post('species'),
            "breed_id" =>$this->input->post('breed'),
            'age' => $this->input->post('age'),
            "reptreatment" => $this->input->post('repeat'),
            "uptoage" => $this->input->post('uptoage'),
            'mandatory' => $this->input->post('mandatory'),
            'createdby' => $this->session->userdata("userid"),
            'createddate' => date("Y-m-d")
        );
        $this->db->trans_start();
        $this->db->insert('disease', $data);
        $this->db->trans_complete();
    }
    public function edit_disease($id)
    {

        $data = array(
            'diseasename' => $this->input->post('diseasename'),
            "species_id" =>$this->input->post('species'),
            "breed_id" =>$this->input->post('breed'),
            'age' => $this->input->post('age'),
            "reptreatment" => $this->input->post('repeat'),
            "uptoage" => $this->input->post('uptoage'),
            'mandatory' => $this->input->post('mandatory'),
        );
        $this->db->trans_start();
        $this->db->where('disease_id', $id);
        $this->db->update('disease', $data);
        $this->db->trans_complete();
    }
    public function delete_disease($id)
    {

        $this->db->delete('disease', array('disease_id' => $id));

    }
    public function get_disease($id)
    {

        $query=$this->db->get_where('disease', array('disease_id' => $id));
        return $query->row_array();
    }
    public function disease_combo()
    {

        $query = $this->db->get('disease');
        $ress= $query->result();
        $output=array();
        $output[""]="Select Disease";
        foreach($ress as $res)
        {
            $output[$res->disease_id]=$res->diseasename;

        }

        return $output;
    }
    public function disease_text_combo()
    {

        $query = $this->db->get('disease');
        $ress= $query->result();
        $output=array();
        $output[""]="Select Disease";
        foreach($ress as $res)
        {
            $output[$res->diseasename]=$res->diseasename;

        }

        return $output;
    }
    /* disease work end here */
    /*cattle group work start here */
    public function add_cattle_group()
    {

        $data = array(
            'groupname' => $this->input->post('groupname'),
            'staff_id' => $this->input->post('staff'),
            'createdby' => $this->session->userdata("userid"),
            'createddate' => date("Y-m-d")
        );
        $this->db->trans_start();
        $this->db->insert('cattlegroup', $data);
        $groupid=$this->db->insert_id();
        $cattleids=$this->input->post('tocattle');

        foreach ( $cattleids as $cattleid) {
            $detail_data = array(
                'cattlegroup_id' => $groupid,
                'cattle_id' => $cattleid
            );
            $this->db->insert('cattlegroupdetails', $detail_data);
        }

        $this->db->trans_complete();
    }
    public function edit_cattle_group($id)
    {
        $this->db->trans_start();
        $data = array(
            'groupname' => $this->input->post('groupname'),
            'staff_id' => $this->input->post('staff'),
        );
        $this->db->where('cattlegroup_id', $id);
        $this->db->update('cattlegroup', $data);;
        $cattleids=$this->input->post('tocattle');
        $this->db->delete('cattlegroupdetails', array('cattlegroup_id' => $id));
        foreach ( $cattleids as $cattleid) {
            $detail_data = array(
                'cattlegroup_id' => $id,
                'cattle_id' => $cattleid
            );
            $this->db->insert('cattlegroupdetails', $detail_data);
        }

        $this->db->trans_complete();
    }
    public function get_cattle_group($id)
    {
        $query = $this->db->get_where('cattlegroup', array('cattlegroup_id' => $id,"createdby"=>$this->session->userdata("userid")));
        return $query->row_array();
    }
    public function delete_cattle_group($id)
    {
        $this->db->delete('cattlegroup', array('cattlegroup_id' => $id));

    }
    public function cattle_group_combo()
    {

        $query = $this->db->get_where('cattlegroup', array("createdby"=>$this->session->userdata("userid")));
        $ress= $query->result();
        $output=array();
        $output[""]="Select Cattle Group";
        foreach($ress as $res)
        {
            $output[$res->cattlegroup_id]=$res->groupname;

        }

        return $output;
    }
    public function get_cattle_group_details($id)
    {
        $query = $this->db->query("select a.cattle_id,a.idno from cattle a inner join cattlegroupdetails b on a.cattle_id=b.cattle_id where b.cattlegroup_id=".$id);
        return $query->result_array();
    }
    /* cattle group work end here */
    /* Calf feed work start here */
    public function add_calffeed()
    {
        $data = array(
            'species_id' => $this->input->post('species'),
            'breed_id' => $this->input->post('breed'),
            'fromage' => $this->input->post('fromage'),
            'toage' => $this->input->post('toage'),
            'agetype' => $this->input->post('agetype'),
            'frombodyweight' => $this->input->post('frombodyweight'),
            'tobodyweight' => $this->input->post('tobodyweight'),
            'weighttype' => $this->input->post('weighttype'),
            'calffeedtype' => $this->input->post('calffeedtype'),
            'calffeedqty' => $this->input->post('calffeedqty'),
            'feedqtytype' => $this->input->post('feedqtytype'),
            'repfeed' => $this->input->post('repfeed')
        );
        $this->db->trans_start();
        $this->db->insert('calffeed', $data);
        $this->db->trans_complete();
    }
    public function edit_calffeed($id)
    {
        $data = array(
            'species_id' => $this->input->post('species'),
            'breed_id' => $this->input->post('breed'),
            'fromage' => $this->input->post('fromage'),
            'toage' => $this->input->post('toage'),
            'agetype' => $this->input->post('agetype'),
            'frombodyweight' => $this->input->post('frombodyweight'),
            'tobodyweight' => $this->input->post('tobodyweight'),
            'weighttype' => $this->input->post('weighttype'),
            'calffeedtype' => $this->input->post('calffeedtype'),
            'calffeedqty' => $this->input->post('calffeedqty'),
            'feedqtytype' => $this->input->post('feedqtytype'),
            'repfeed' => $this->input->post('repfeed')
        );
        $this->db->trans_start();
        $this->db->where("calffeed_id",$id);
        $this->db->update('calffeed', $data);
        $this->db->trans_complete();
    }
    public function delete_calffeed($id)
    {
        $this->db->delete('calffeed', array('calffeed_id' => $id));
    }
    public function get_calffeed($id)
    {
        $query = $this->db->get_where('calffeed', array('calffeed_id' => $id));
        return $query->row_array();
    }
    /* Calf feed Work end here */

    /*customer work start here */
    public function add_customer()
    {
        $this->db->trans_start();
        $data = array(
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'customercode' => $this->input->post('customercode'),
            'customergroup_id' => $this->input->post('customergroup'),
            'address' => $this->input->post('address'),

            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'phone' => $this->input->post('phone'),
            'mobile' => $this->input->post('mobile'),
            'email' => $this->input->post('email'),
            "createdby"=> $this->session->userdata("userid"),
            "createddate" => date("Y-m-d")

        );
        $this->db->insert('customer', $data);

        $this->db->trans_complete();
    }
    public function edit_customer($id)
    {
        $this->db->trans_start();
        $data = array(
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'customercode' => $this->input->post('customercode'),
            'customergroup_id' => $this->input->post('customergroup'),
            'address' => $this->input->post('address'),
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'phone' => $this->input->post('phone'),
            'mobile' => $this->input->post('mobile'),
            'email' => $this->input->post('email'),

        );
        $this->db->where('customer_id', $id);
        $this->db->update('customer', $data);;

        $this->db->trans_complete();
    }
    public function get_customer($id)
    {
        $query = $this->db->get_where('customer', array('customer_id' => $id,"createdby"=> $this->session->userdata("userid")));
        return $query->row_array();
    }
    public function delete_customer($id)
    {
        $this->db->delete('customer', array('customer_id' => $id,"createdby"=> $this->session->userdata("userid")));
    }
    public function customer_combo()
    {
        $query = $this->db->get_where('customer', array("createdby"=> $this->session->userdata("userid")));
        $ress= $query->result();
        $output=array();
        $output[""]="Select customer";
        foreach($ress as $res)
        {
            $output[$res->customer_id]=$res->fname." ".$res->lname;

        }
        return $output;
    }
    public function get_customer_by_group($customergroup)
    {
        $query = $this->db->get_where('customer', array("customergroup_id"=>$customergroup,"createdby"=> $this->session->userdata("userid")));
        $ress= $query->result();
        $output="<option value=''>Select customer</option>";
        foreach($ress as $res)
        {
            $output.="<option value='".$res->customer_id."'>".$res->fname." ".$res->lname." [".$res->customercode."]</option>";

        }
        return $output;
    }
    public function check_customer_code($customercode)
    {
        $query = $this->db->get_where('customer', array("customercode"=>$customercode,"createdby"=> $this->session->userdata("userid")));
        $ress= $query->row_array();
        if(count($ress))
        {
            return true;
        }
        return false;
    }
    public function get_customer_by_code($customercode)
    {
        $query = $this->db->get_where('customer', array("customercode"=>$customercode,"createdby"=> $this->session->userdata("userid")));
        $ress= $query->row_array();

        return $ress;
    }
    public function get_farm($user_id)
    {
        $query=$this->db->query("select * from farm where superuser_id=".$user_id);

        return $query->row_array();

    }

    public function get_current_membership()
    {
        $query=$this->db->get_where("farmsetting",array("farm_id"=>$this->session->userdata("farm_id")));
        $res=$query->row_array();
        $memtype="personal";
        if($res["membership_id"]=="1")
        {
            $memtype="personal";
        }
        elseif($res["membership_id"]==2)
        {
            $memtype="commercial";
        }
        return array("membership"=>$memtype) ;
    }
    /*customer work end here */

    function get_farm_user()
    {
        $query=$this->db->query("select * From user where superuser_id=".$this->session->userdata("userid"));
        return $query->result_array();

    }

    public function add_customer_group()
    {
        $this->db->trans_start();
        $data = array(
            'customergroupname' => $this->input->post('customergroupname'),
            'milkprice' => $this->input->post('milkprice'),
            "createdby"=> $this->session->userdata("userid")
        );
        $this->db->insert('customergroup', $data);

        $this->db->trans_complete();
    }
    /*staff category work start */

    public function edit_customer_group($id)
    {
        $this->db->trans_start();
        $data = array(
            'customergroupname' => $this->input->post('customergroupname'),
            'milkprice' => $this->input->post('milkprice'),

        );
        $this->db->where('customergroup_id', $id);
        $this->db->update('customergroup', $data);;

        $this->db->trans_complete();
    }

    public function get_customer_group($id)
    {
        $query = $this->db->get_where('customergroup', array('customergroup_id' => $id,"createdby"=> $this->session->userdata("userid")));
        return $query->row_array();
    }

    public function delete_customer_group($id)
    {
        $this->db->delete('customergroup', array('customergroup_id' => $id,"createdby"=> $this->session->userdata("userid")));
    }

    public function customer_group_combo()
    {
        $query = $this->db->get_where('customergroup', array("createdby"=> $this->session->userdata("userid")));
        $ress= $query->result();
        $output=array();
        $output[""]="Select Customer Group";
        foreach($ress as $res)
        {
            $output[$res->customergroup_id]=$res->customergroupname;

        }
        return $output;
    }

    public function get_customer_group_milk_price($id)
    {
        $query = $this->db->get_where('customergroup', array('customergroup_id' => $id,"createdby"=> $this->session->userdata("userid")));
        $res=$query->row_array();
        return $res["milkprice"];

    }

    public function get_milk_price_by_customer_code($code)
    {
        $query = $this->db->query("select b.milkprice from customer a inner join customergroup b on a.customergroup_id=b.customergroup_id and a.customercode='".$code."' and a.createdby=".$this->session->userdata("userid"));

        $res=$query->row_array();
        return $res["milkprice"];

    }

    public function get_farm_milk_rate($superuserid)
    {
        $farmetting=$this->get_farmsetting($superuserid);
        if(count($farmetting))
        {
            return $farmetting["milkrate"];
        }
        return 0;
    }

    public function get_farmsetting($user_id)
    {
        $query=$this->db->query("select * from farmsetting where superuser_id=".$user_id);

        return $query->row_array();

    }
    /* staff category work end */

   public function add_email_alert()
   {
       $data = array(
           "email" => $this->input->post("email"),
           "farm_id"=>$this->session->userdata('farm_id') ,
           "superuser_id"=>$this->session->userdata('userid')
       );
       $this->db->insert('emailalert', $data);
   }
   public function delete_email_alert($email)
   {
       $this->db->delete('emailalert', array('email' => $email,"superuser_id"=> $this->session->userdata("userid")));
   }
    public function add_mobile_alert()
    {
        $data = array(
            "mobile" => $this->input->post("mobile"),
            "farm_id"=>$this->session->userdata('farm_id') ,
            "superuser_id"=>$this->session->userdata('userid')
        );
        $this->db->insert('mobilealert', $data);
    }
    public function delete_mobile_alert($mobile)
    {
        $this->db->delete('mobilealert', array('mobile' => $mobile,"superuser_id"=> $this->session->userdata("userid")));
    }
}