<?php

class booking_model extends H_Model {

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /* @method : save_booking_details
     * @params:
     * @desc: save_booking_details method is used for saving booking details
     */
    public function save_booking_details($data){
            if(isset($data) && !empty($data)){
                $user_id = $this->session->userdata('user_id');
                $this->db->select('refered_by');
                $this->db->from('hpatient');
                $this->db->where('userid' , $user_id);
                $res =$this->db->get()->row();
                $prID = base64_decode($data['procedure_id']);
                $spID = base64_decode($data['specialist_id']);

                $this->db->select('ID');
                $this->db->from('hproceduredate');
                $this->db->where('date',$data['booking_date']);
                $this->db->where('time_slot' , trim($data['booking_time']));
                $pr_slot_id = $this->db->get()->row();
                $save = array(
                    'specialist_user_id' => $spID,
                    'procedure_id' => $prID,
                    'procedure_slot_id' => $pr_slot_id->ID,
                    'booking_date' => $data['booking_date'],
                    'booking_time' => $data['booking_time'],
                    'patient_user_id' => $user_id,
                    'homephy_id' => $res->refered_by,
                );

                $this->db->insert('hbooking',$save);
                $this->db->select('no_of_booked_appt');
                $this->db->from('hproceduredate');
                $this->db->where('ID' , $pr_slot_id->ID);
                $bookedApt = $this->db->get()->row();
                $totalAppt = $bookedApt->no_of_booked_appt + 1;
                $save = array(
                    'no_of_booked_appt' => $totalAppt,
                );
                $this->db->where('ID' , $pr_slot_id->ID);
                $this->db->update('hproceduredate',$save);
                return true;

            }else{
                $homePhy_id=$this->session->userdata('user_id');
                $date = $this->input->post('date');
                $hrs = $this->input->post('hour');
                $slot = $this->input->post('procedure_slot_id');
                $userid = $this->input->post('userid');
                $procedure_id = $this->input->post('procedure_id');
                $patient_id = $this->input->post('patient_id');
                if(!empty($date)){
                    $this->db->select('booking_time');
                    $this->db->from('hbooking');
                    $this->db->where('booking_time' , $hrs);
                    $this->db->where('homephy_id' , $homePhy_id);
                    $res = $this->db->get()->row();
                    if($res){
                        return false;
                    }else{
                        $data = array(
                            'specialist_user_id' => $userid,
                            'procedure_id' => $procedure_id,
                            'procedure_slot_id' => $slot,
                            'booking_date' => $date,
                            'booking_time' => $hrs,
                            'patient_user_id' => $patient_id,
                            'homephy_id' => $homePhy_id
                        );
                        // saving data into booking table//
                        $this->db->insert('hbooking',$data);

                        // GET data for no_of_booked_appt //
                        $this->db->select('no_of_booked_appt');
                        $this->db->from('hproceduredate');
                        $this->db->where('ID' , $slot);
                        $res1 = $this->db->get()->row();
                        $totalAppt = $res1->no_of_booked_appt + 1;
                        $save = array(
                            'no_of_booked_appt' => $totalAppt,
                        );
                        $this->db->where('ID' , $slot);
                        $this->db->update('hproceduredate',$save);
                        return true;
                    }
                }
            }
    }

    /* @method : check_booking_details
     * @params:
     * @desc: check_booking_details method is used for fetching booking detail
     */
    public function check_booking_details(){
        $date = $this->input->post('date');
        $query = $this->db->query("SELECT hb.ID ,hb.booking_date, hb.procedure_slot_id , hb.procedure_id,  hs.procedure_name  FROM hbooking hb INNER JOIN hprocedure hs ON hs.ID = hb.procedure_id WHERE hb.booking_date = '$date' ");
        $res= $query->result_array();
        return $res;
    }


    /* @method : cancel_appointment
     * @params:
     * @desc: cancel_appointment method is used for cancel appointment
     */
    public function cancel_booking($Pid,$uid){
        $save = array(
            'status' => '0',
        );
        $this->db->where('procedure_slot_id' , $Pid);
        $this->db->where('homephy_id' , $uid);
        $this->db->update('hbooking',$save);

        $this->db->select('no_of_booked_appt');
        $this->db->from('hproceduredate');
        $this->db->where('ID' , $Pid);
        $res = $this->db->get()->row();
        $totlaAppt = $res->no_of_booked_appt - 1;

        $data = array(
            'no_of_booked_appt' => $totlaAppt,
            'availability' => '1'
        );

        $this->db->where('ID' , $Pid);
        $this->db->update('hproceduredate',$data);
        return true;
    }

    /* @method : get_booking_list
     * @params:
     * @desc: get_booking_list method is used for fetching booking list
     */
    public function get_booking_list($date){
        $user_id = $this->session->userdata('user_id');
        $data =  $this->db->query("SELECT hb.ID,hb.booking_time,hb.procedure_id,hpt.username FROM (hbooking hb INNER JOIN hpatient hpt ON hb.patient_user_id = hpt.userid) WHERE hb.booking_date = '$date' AND hb.specialist_user_id = '$user_id' AND hb.status = '0' GROUP BY booking_time;");
        $rsr = $data->result_array();
        return $rsr;
    }

    /* @method : get_booking_list_admin
     * @params:
     * @desc: get_booking_list_admin method is used for fetching booking list for admin
     */
    public function get_booking_list_admin($date){
        $data =  $this->db->query("SELECT hpd.no_of_booked_appt, hp.procedure_name , hs.name FROM (hbooking hb INNER JOIN hprocedure hp ON hb.procedure_id = hp.procedure_cat_id)INNER JOIN hspecialist hs ON hb.specialist_user_id = hs.userid INNER JOIN hproceduredate hpd ON hb.procedure_id = hpd.procedureid WHERE hb.booking_date = '$date' ");
        $rsr = $data->result_array();
        return $rsr;
    }

    /* @method : change_specialist_booking_status
     * @params:
     * @desc: change_specialist_booking_status method is used for updating booking status
     */
    public function change_specialist_booking_status($data){
        foreach($data as $Key['appointment'] => $val ){
            foreach($val as $k => $s){
                $ID =  $k;
                $status = $s;
                $save = array(
                    'status' =>  $status,
                );
                $this->db->where('ID',$ID );
                $this->db->update('hbooking',$save);
            }
        }
    }

    /* @method : save_booking_status
     * @params:
     * @desc: save_booking_status method is used for updating booking status changed by specialist
     */
      public function save_booking_status($id){
          $data = array(
              'status' => 1,
          );
          $this->db->where('ID',$id );
          $this->db->update('hbooking',$data);
          return true;
      }


}