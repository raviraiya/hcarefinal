<?php  

  class hospital_model extends H_Model {  

      public function __construct(){  

          parent::__construct();  

          $this->load->database();  

      }  

      /* @method : add_hospital_info  

       * @params:  

       * @desc: add_hospital_info is used for saving and updating Hospital, doctor and facility information  

       */  

      public function get_hospital_staff_info(){  

          $userid=$this->session->userdata("userid"); 

          $query=$this->db->query("SELECT hstaff.ID as StaffID,hstaff.userid,hstaff.staff_cat_id,hstaff.staff_name,hstaff.other_info,hstaff.staff_pic,hstaffcategory.staff_cat_name  FROM hstaff inner join  hstaffcategory on hstaff.staff_cat_id= hstaffcategory.ID where hstaff.userid=".

		  $userid);  

         return $query->result();  

      }  

      /* @method : get_hospital_user_info  

       * @params:  

       * @desc: get_hospital_user_info is used for getting information hhospital table  

       */  

      public function get_hospital_user_info($hospital_id){  

          $this->db->select('*');  

          $this->db->from('hhospital');  

          //$this->db->join('hhospitalphoto', 'hhospitalphoto.hospitalid = hhospital.userid');  

          $this->db->where('ID', $hospital_id);  

          $query = $this->db->get();  

          $result= $query->result();  

          return $result;  

      }  

      /* @method : update_hospital_data  

       * @params:  

       * @desc: update_hospital_data is used for update information hhospital table  

       */  

      public function update_hospital_data($data,$hospital_id){  

          $this->db->where('ID', $hospital_id);  

         $query = $this->db->update('hhospital', $data);  

  	   if($query){return true;}  

       }  

  	/* @method : get_hospital_image  

       * @params:  

       * @desc: get_hospital_image is used for fet information hhospitalphoto table  

       */  

      public function get_hospital_image($hospital_user_id){  

          $this->db->select('*');  

          $this->db->from('hhospitalphoto');  

          //$this->db->join('hhospitalphoto', 'hhospitalphoto.hospitalid = hhospital.userid');  

          $this->db->where('hospitalid', $hospital_user_id);  

          $query = $this->db->get();  

          $result= $query->result();  

          return json_encode($result);  

      }  

      /* @method : get_hospital_facilities_info_details  

       * @params:  

       * @desc: get_hospital_facilities_info_details is used for get facility information hhospital table  

       */  

      public function get_hospital_facilities_info_details($hospital_id){  

          $this->db->select("facility_name");  

          $this->db->where('hospitalid',$hospital_id);  

          $query= $this->db->get("hhospitalfacilities");  

          $result= $query->result();  

          return $result;  

      }  

      /* @method : get_hospital_services_info_details  

       * @params:  

       * @desc: get_hospital_services_info_details is used for get facility information hhospital table  

       */  

      public function get_hospital_services_info_details($hospital_id){  

          $this->db->select("service_name");  

          $this->db->where('hospitalid',$hospital_id);  

          $query= $this->db->get("hhospitalservices");  

          $result= $query->result();  

          return $result;  

      }  

      /* @method : delete_hfacility  

       * @params:  

       * @desc: get_hospital_services_info_details is used for get facility information hhospital table  

       */  

      public function delete_hfacility($hospital_id,$tag){  

          $data= array(  

              "hospitalid" => $hospital_id,  

              "facility_name" => $tag  

          );  

          $this->db->where($data);  

          $query= $this->db->delete("hhospitalfacilities"); 

          return $query;  

      }  

      /* @method : add_hfacility  

       * @params:  

       * @desc: add_hfacility is used for get facility information hhospital table  

       */  

      public function add_hfacility($data){  

          $query= $this->db->insert("hhospitalfacilities",$data);  

          return $query;  

      }  

      /* @method : remove_hfacility_angular  

       * @params:  

       * @desc: remove_hfacility_angular is used for get facility information hhospital table  

       */  

      public function remove_hfacility_angular($data){  

          $query= $this->db->delete("hhospitalfacilities",$data);  

          return $query;  

      }  

      /* @method : add_hfacility  

       * @params:  

       * @desc: add_hfacility is used for get facility information hhospital table  

       */  

      public function get_hfacility_angular($data){  

          $query= $this->db->get_where("hhospitalfacilities",$data);  

          $result= $query->result();  

          return $result;  

      }  

      /* @method : get_hospital_facilities_info  

       * @params:  

       * @desc: get_hospital_facilities_info is used for get facility information hhospital table  

       */  

      public function get_hospital_facilities_info(){  

          $query= $this->db->get("hhospital");  

          $result= $query->result();  

          return $result;  

      }  

      /* @method : remove_hospital_image  

       * @params:  

       * @desc: remove_hospital_image is used for get facility information hhospital table  

       */  

      public function remove_hospital_image($hospital_user_id){  

          $this->db->where('ID', $hospital_user_id);  

          $result= $this->db->delete('hhospitalphoto');  

          return $result;  

      }  

      public function hospital_image_upload($data){  

          $insert= $this->db->insert('hhospitalphoto', $data);  

          return $insert;  

      }  

      public function hospital_working_hours_add($userid,$hospitalid,$dayid,$frm_hrs,$to_hrs){  

          $data1= array(  

              'userid' => $userid,  

              'hospitalid' => $hospitalid,  

              'weekday' => $dayid  

          );  

          $query= $this->db->get_where('hworkinghours',$data1);  

          $queryresult= $query->result();  

          if($queryresult){  

              $dataupdate= array(  

                  'userid' => $userid,  

                  'hospitalid' => $hospitalid,  

                  'weekday' => $dayid  

              );  

              $exitupdate= array(  

                  'frm_hrs' => $frm_hrs,  

                  'to_hrs' => $to_hrs,  

                  //'status' => $status  

              );  

              $this->db->where($dataupdate);  

              $update= $this->db->update('hworkinghours', $exitupdate);  

              echo 'update';  

              return $update;  

          }  

          else  

          {  

              $data= array(  

                  'userid' => $userid,  

                  'hospitalid' => $hospitalid,  

                  'weekday' => $dayid,  

                  'frm_hrs' => $frm_hrs,  

                  'to_hrs' => $to_hrs,  

                  // 'status' => $status  

              );  

              $insert= $this->db->insert('hworkinghours', $data);  

              echo 'insert';  

              return $insert;  

          }  

      }  

      public function get_hospital_working_info($hospital_id){  

          $this->db->select('*');  

          $this->db->from('hweekname');  

          $this->db->join('hworkinghours', 'hworkinghours.weekday = hweekname.weekid AND hworkinghours.hospitalid='.$hospital_id);  

          $this->db->group_by("hweekname.weekid");  

          $this->db->order_by("hworkinghours.weekday", "ASC");  

          $query = $this->db->get();  

          $result= $query->result();  

          return $result;  

      }  

      /* @method : delete_hservice  

       * @params:  

       * @desc: delete_hservice is used for remove services from hservice table  

       */  

      public function delete_hservice($hospital_id,$tag){  

          $data= array(  

              "hospitalid" => $hospital_id,  

              "service_name" => $tag  

          );  

          $this->db->where($data);  

          $query= $this->db->delete("hhospitalservices");  

          if($query){  

              return $query;  

          }  

          else{  

              return false;  

          }  

      }  

      /* @method : add_hfacility  

       * @params:  

       * @desc: add_hfacility is used for get facility information hhospital table  

       */  

      public function add_hservice($data){  

          $query= $this->db->insert("hhospitalservices",$data);  

          return $query;  

      }  

      /* @method : invite_straff  

       * @params:  

       * @desc: invite_straff is used for insert data to hspecialistinvite  

       */  

      public function invite_straff($data){  

          $query= $this->db->insert("hspecialistinvite",$data);  

          return $query;  

      }  

      /* @method : add_hospital_info  

       * @params:  

       * @desc: add_hospital_info is used for saving and updating Hospital, doctor and facility information  

       */  

      public function add_hospital_info(){  

  //        $this->db->trans_start();  

          $user_id = $this->session->userdata('user_id');  

          /*  

           *      save working hours for all week  

           */  

          $monday = $this->input->post('monhour');  

          $tues = $this->input->post('tueshour');  

          $wed = $this->input->post('wedhour');  

          $thus = $this->input->post('thuhour');  

          $fri = $this->input->post('fridhour');  

          $sat = $this->input->post('sathour');  

          $sunday = $this->input->post('sunhour');  

          $hs = $this->get_hospital();  

          if(count($hs) > 0 ){  

              $hs_id =  $hs->ID;  

              /*  

              *    update hospital details  

              */  

              $data = array(  

                  'userid' => $user_id,  

                  'name'=> $this->input->post('name'),  

                  'desc'=> $this->input->post('desc'),  

              );  

              $this->db->where('ID', $hs_id);  

              $this->db->update('hhospital', $data);  

              /*  

               *  delete working hrs before saving edit entry  

               */  

              $this->db->where('hospitalid', $hs_id);  

              $this->db->delete('hworkinghours');  

              if(isset($monday)){  

                  $total = count($monday);  

                  for($i=0; $i < $total ;  $i++) {  

                      $data = array(  

                          'userid' => $user_id,  

                          'hospitalid' => $hs_id,  

                          'weekday' => 1,  

                          'hour' => $monday[$i],  

                      );  

                      $this->db->insert('hworkinghours',$data);  

                  }  

              }  

              if(isset($tues)){  

                  $total = count($tues);  

                  for($i=0; $i < $total ;  $i++) {  

                      $data = array(  

                          'userid' => $user_id,  

                          'hospitalid' => $hs_id,  

                          'weekday' => 2,  

                          'hour' => $tues[$i],  

                      );  

                      $this->db->insert('hworkinghours',$data);  

                  }  

              }  

              if(isset($wed)){  

                  $total = count($wed);  

                  for($i=0; $i < $total ;  $i++) {  

                      $data = array(  

                          'userid' => $user_id,  

                          'hospitalid' => $hs_id,  

                          'weekday' => 3,  

                          'hour' => $wed[$i],  

                      );  

                      $this->db->insert('hworkinghours',$data);  

                  }  

              }  

              if(isset($thus)){  

                  $total = count($thus);  

                  for($i=0; $i < $total ;  $i++) {  

                      $data = array(  

                          'userid' => $user_id,  

                          'hospitalid' => $hs_id,  

                          'weekday' => 4,  

                          'hour' => $thus[$i],  

                      );  

                      $this->db->insert('hworkinghours',$data);  

                  }  

              }  

              if(isset($fri)){  

                  $total = count($fri);  

                  for($i=0; $i < $total ;  $i++) {  

                      $data = array(  

                          'userid' => $user_id,  

                          'hospitalid' => $hs_id,  

                          'weekday' => 5,  

                          'hour' => $fri[$i],  

                      );  

                      $this->db->insert('hworkinghours',$data);  

                  }  

              }  

              if(isset($sat)){  

                  $total = count($sat);  

                  for($i=0; $i < $total ;  $i++) {  

                      $data = array(  

                          'userid' => $user_id,  

                          'hospitalid' => $hs_id,  

                          'weekday' => 6,  

                          'hour' => $sat[$i],  

                      );  

                      $this->db->insert('hworkinghours',$data);  

                  }  

              }  

              if(isset($sunday)){  

                  $total = count($sunday);  

                  for($i=0; $i < $total ;  $i++) {  

                      $data = array(  

                          'userid' => $user_id,  

                          'hospitalid' => $hs_id,  

                          'weekday' => 7,  

                          'hour' => $sunday[$i],  

                      );  

                      $this->db->insert('hworkinghours',$data);  

                  }  

              }  

              /*  

               *  delete  hospital Holiday  first then save edited records  

               */  

              $this->db->where('hospitalid', $hs_id);  

              $this->db->delete('hhospitalholiday');  

              /*  

              *  save  hospital Holiday details  

              */  

              $date = $this->input->post('holiday_date');  

              $count = count($date);  

              for($i=0; $i < $count ;  $i++) {  

                  $data = array(  

                      'userid' => $user_id,  

                      'hospitalid' => $hs_id,  

                      'holiday_date'=> $date[$i],  

                  );  

                  $this->db->insert('hhospitalholiday',$data);  

              }  

              /*  

               *  delete  hospital doctor details first then save edited records  

               */  

              $this->db->where('hospitalid', $hs_id);  

              $this->db->delete('hhospitaldoctor');  

              $doc_name = $this->input->post('doc_name');  

              $doc_desc = $this->input->post('doc_desc');  

              $qualification = $this->input->post('qualification');  

              $speciality =$this->input->post('speciality');  

              $department = $this->input->post('department');  

              $count = count($doc_name);  

              for($i=0; $i < $count ;  $i++) {  

                  $data = array(  

                      'userid' => $user_id,  

                      'hospitalid' => $hs_id,  

                      'doc_name'=>$doc_name[$i],  

                      'doc_desc'=> $doc_desc[$i],  

                      'qualification'=> $qualification[$i],  

                      'speciality'=> $speciality[$i],  

                      'department'=> $department[$i],  

                  );  

                  $this->db->insert('hhospitaldoctor',$data);  

              }  

              /*  

              *  delete  hhospital facilities  details first then save edited records  

              */  

              $this->db->where('hospitalid', $hs_id);  

              $this->db->delete('hhospitalfacilities');  

              $fac_name = $this->input->post('facility_name');  

              $fac_desc = $this->input->post('facility_desc');  

              $count = count($fac_name);  

              for($i=0; $i < $count ;  $i++) {  

                  $data = array(  

                      'userid' => $user_id,  

                      'hospitalid' => $hs_id,  

                      'facility_name'=> $fac_name[$i],  

                      'facility_desc'=> $fac_desc[$i],  

                  );  

                  $this->db->insert('hhospitalfacilities',$data);  

              }  

          }else{  

              /*  

               * hospital logo and detail  

               */  

              $attachName =  'logo_url';  

              if(!empty($_FILES[$attachName]['name'])){  

                  $config['upload_path']    = './assets/hlogo/';                 #the folder placed in the root of project  

                  $config['allowed_types']  = 'gif|jpg|png|bmp|jpeg';      #allowed types description  

                  $config["allowed_types"] ="*";  

                  $config['max_size']       = '130';                          #max size  

                  $config['max_width']      = '130';                          #max width  

                  $config['max_height']     = '200';                          #max height  

                  $config['encrypt_name']   = true;  

                  $type = strstr($_FILES[$attachName]['name'], '.' );  

                  $fileName =  md5(uniqid(mt_rand())).''.$type;  

                  $images[] = $fileName;  

                  $config['file_name'] = $fileName;  

                  $this->load->library('upload', $config);  

                  $this->upload->initialize($config);  

                  if(!$this->upload->do_upload('logo_url')){  

                      $uploadedDetails = array('error' => $this->upload->display_errors());  

                  }else{  

                      $uploadedDetails = $this->upload->data();  

                  }  

                  $imageUrl = base_url().'assets/hlogo/'.$uploadedDetails['file_name'];  

              }else{  

                  $imageUrl = '';  

              }  

              $address = $this->input->post('address');  

              $region = $this->input->post('city');  

              $map = get_lat_long($address,$region);  

              $data = array(  

                  'userid' => $user_id,  

                  'name'=> $this->input->post('name'),  

                  'desc'=> $this->input->post('desc'),  

                  'logo_url' => $imageUrl,  

                  'address' => $this->input->post('address'),  

                  'city'=>  $this->input->post('city'),  

                  'state' =>  $this->input->post('state'),  

                  'zip'=>  $this->input->post('zip'),  

                  'phone'=> $this->input->post('phone'),  

                  'email' => $this->input->post('email'),  

                  'latitude' => $map['lat'],  

                  'longitude' => $map['long']  

              );  

              $this->db->insert('hhospital',$data);  

              $hs_id = $this->db->insert_id();  

              /*  

          *      save hospital photo  

          */  

              $config['upload_path']    = './assets/hsimages/';                 #the folder placed in the root of project  

              $config['allowed_types']  = 'gif|jpg|png|bmp|jpeg';      #allowed types description  

              $config["allowed_types"] ="*";  

              $config['max_size']       = '11100';                          #max size  

              $config['max_width']      = '12000';                          #max width  

              $config['max_height']     = '3300';                          #max height  

              $config['encrypt_name']   = true;  

              $files = $_FILES;  

              $attachName = 'hPic';  

              if(!empty($_FILES['hPic']['name'])){  

                  $count = count($_FILES[$attachName]['name']);  

                  for ($i = 0; $i < $count; $i++) {  

                      $_FILES[$attachName]['name'] = $files[$attachName]['name'][$i];  

                      $_FILES[$attachName]['type'] = $files[$attachName]['type'][$i];  

                      $_FILES[$attachName]['tmp_name'] = $files[$attachName]['tmp_name'][$i];  

                      $_FILES[$attachName]['error'] = $files[$attachName]['error'][$i];  

                      $_FILES[$attachName]['size'] = $files[$attachName]['size'][$i];  

                      $type = strstr($_FILES[$attachName]['name'], '.' );  

                      $fileNamehs =  md5(uniqid(mt_rand())).''.$type;  

                      $images[] = $fileNamehs;  

                      $config['file_name'] = $fileNamehs;  

                      $this->load->library('upload', $config);  

                      $this->upload->initialize($config);  

                      if(!$this->upload->do_upload('hPic')){  

                          $error = array('error' => $this->upload->display_errors());  

                      }else{  

                          $success = $this->upload->data();  

                          $this->createThumbnail($success);  

                      }  

                      if(!empty($success)){  

                          $imageUrl = base_url().'assets/hsimages/'.$success['file_name'];  

                      }else{  

                          $imageUrl ='';  

                      }  

                      $file_data = array(  

                          'hospitalid' => $hs_id,  

                          'picurl' => $imageUrl,  

                      );  

                      $this->db->insert('hhospitalphoto', $file_data);  

                  }  

              }  

              /*  

               *  save hospital working hrs details  

               */  

              if(isset($monday)){  

                  $total = count($monday);  

                  for($i=0; $i < $total ;  $i++) {  

                      $data = array(  

                          'userid' => $user_id,  

                          'hospitalid' => $hs_id,  

                          'weekday' => 1,  

                          'hour' => $monday[$i],  

                      );  

                      $this->db->insert('hworkinghours',$data);  

                  }  

              }  

              if(isset($tues)){  

                  $total = count($tues);  

                  for($i=0; $i < $total ;  $i++) {  

                      $data = array(  

                          'userid' => $user_id,  

                          'hospitalid' => $hs_id,  

                          'weekday' => 2,  

                          'hour' => $tues[$i],  

                      );  

                      $this->db->insert('hworkinghours',$data);  

                  }  

              }  

              if(isset($wed)){  

                  $total = count($wed);  

                  for($i=0; $i < $total ;  $i++) {  

                      $data = array(  

                          'userid' => $user_id,  

                          'hospitalid' => $hs_id,  

                          'weekday' => 3,  

                          'hour' => $wed[$i],  

                      );  

                      $this->db->insert('hworkinghours',$data);  

                  }  

              }  

              if(isset($thus)){  

                  $total = count($thus);  

                  for($i=0; $i < $total ;  $i++) {  

                      $data = array(  

                          'userid' => $user_id,  

                          'hospitalid' => $hs_id,  

                          'weekday' => 4,  

                          'hour' => $thus[$i],  

                      );  

                      $this->db->insert('hworkinghours',$data);  

                  }  

              }  

              if(isset($fri)){  

                  $total = count($fri);  

                  for($i=0; $i < $total ;  $i++) {  

                      $data = array(  

                          'userid' => $user_id,  

                          'hospitalid' => $hs_id,  

                          'weekday' => 5,  

                          'hour' => $fri[$i],  

                      );  

                      $this->db->insert('hworkinghours',$data);  

                  }  

              }  

              if(isset($sat)){  

                  $total = count($sat);  

                  for($i=0; $i < $total ;  $i++) {  

                      $data = array(  

                          'userid' => $user_id,  

                          'hospitalid' => $hs_id,  

                          'weekday' => 6,  

                          'hour' => $sat[$i],  

                      );  

                      $this->db->insert('hworkinghours',$data);  

                  }  

              }  

              if(isset($sunday)){  

                  $total = count($sunday);  

                  for($i=0; $i < $total ;  $i++) {  

                      $data = array(  

                          'userid' => $user_id,  

                          'hospitalid' => $hs_id,  

                          'weekday' => 7,  

                          'hour' => $sunday[$i],  

                      );  

                      $this->db->insert('hworkinghours',$data);  

                  }  

              }  

              /*  

             *  save  hospital Holiday details  

             */  

              $date = $this->input->post('holiday_date');  

              $count = count($date);  

              for($i=0; $i < $count ;  $i++) {  

                  $data = array(  

                      'userid' => $user_id,  

                      'hospitalid' => $hs_id,  

                      'holiday_date'=> $date[$i],  

                  );  

                  $this->db->insert('hhospitalholiday',$data);  

              }  

              /*  

               *  save hospital doctors details  

               */  

              $config['upload_path'] = './assets/docImage/';  

              $config['allowed_types']  = 'gif|jpg|png|bmp|jpeg';       #allowed types description  

              $config['allowed_types']  = '*';  

              $config['max_size']       = '5000';                          #max size  

              $config['max_width']      = '5000';                          #max width  

              $config['max_height']     = '5000';                          #max height  

              $config['encrypt_name']   = true;                         #encrypt name of the uploaded file  

              $files = $_FILES;  

  //            $count = count($_FILES['uploadDocPic']['name']);  

              $attachName = 'doc_pic';  

              $doc_name = $this->input->post('doc_name');  

              $doc_desc = $this->input->post('doc_desc');  

              $qualification = $this->input->post('qualification');  

              $speciality =$this->input->post('speciality');  

              $department = $this->input->post('department');  

              $count = count($doc_name);  

              for($i=0; $i < $count ;  $i++) {  

                  if(isset($_FILES['doc_pic']) && !empty($_FILES['doc_pic']['name'])){  

                      $_FILES[$attachName]['name'] = $files[$attachName]['name'][$i];  

                      $_FILES[$attachName]['type'] = $files[$attachName]['type'][$i];  

                      $_FILES[$attachName]['tmp_name'] = $files[$attachName]['tmp_name'][$i];  

                      $_FILES[$attachName]['error'] = $files[$attachName]['error'][$i];  

                      $_FILES[$attachName]['size'] = $files[$attachName]['size'][$i];  

                      $type = strstr($_FILES[$attachName]['name'], '.' );  

                      $fileNameDoc =  md5(uniqid(mt_rand())).''.$type;  

                      $images[] = $fileNameDoc;  

                      $config['file_name'] = $fileNameDoc;  

                      $this->load->library('upload', $config);  

                      $this->upload->initialize($config);  

                      if(!$this->upload->do_upload('doc_pic')){  

                          $uploadedDetailsDoc = array('error' => $this->upload->display_errors());  

                      }else{  

                          $uploadedDetailsDoc = $this->upload->data();  

                      }  

                      if(!empty($uploadedDetailsDoc['file_name'])){  

                          $imageUrlDoc = base_url().'assets/docImage/'.$uploadedDetailsDoc['file_name'];  

                      }else{  

                          $imageUrlDoc = "";  

                      }  

                  }  

                  $data = array(  

                      'userid' => $user_id,  

                      'hospitalid' => $hs_id,  

                      'doc_name'=>$doc_name[$i],  

                      'doc_desc'=> $doc_desc[$i],  

                      'qualification'=> $qualification[$i],  

                      'speciality'=> $speciality[$i],  

                      'department'=> $department[$i],  

                      'doc_pic' => $imageUrlDoc  

                  );  

                  $this->db->insert('hhospitaldoctor',$data);  

              }  

              $fac_name = $this->input->post('facility_name');  

              $fac_desc = $this->input->post('facility_desc');  

              $count = count($fac_name);  

              for($i=0; $i < $count ;  $i++) {  

                  $data = array(  

                      'userid' => $user_id,  

                      'hospitalid' => $hs_id,  

                      'facility_name'=> $fac_name[$i],  

                      'facility_desc'=> $fac_desc[$i],  

                  );  

                  $this->db->insert('hhospitalfacilities',$data);  

              }  

              $service_name = $this->input->post('service');  

              $count = count($service_name);  

              for($i=0; $i < $count ;  $i++) {  

                  $data = array(  

                      'hospitalid' => $hs_id,  

                      'service_name'=> $service_name[$i],  

                  );  

                  $this->db->insert('hhospitalservices',$data);  

              }  

          }  

  //        $this->db->trans_complete();  

          return true;  

      }  

      /* @method : get_hospital  

       * @params:  

       * @desc: get_hospital method is used for fetching hospital details  

       */  

      public function get_hospital(){  

          $user_id = $this->session->userdata('user_id');  

          $hsp = $this->db->get_where("hhospital",array("userid" => $user_id))->row();  

          return $hsp;  

      }  

      /* @method : createThumbnail  

       * @params: $data (image data for creating thumbnail)  

       * @desc: createThumbnail method is used for creating thumbnail for image  

       */  

      function createThumbnail($data) {  

          $count = count($data['file_name']);  

          if(!empty($data['file_name'])){  

              for ($i = 0; $i < $count; $i++) {  

                  $fileName = $data['file_name'];  

                  $config['image_library'] = 'gd2';  

                  $config['source_image'] = $data['full_path'];  

                  $config['new_image'] = './assets/thumbnail/'.$fileName;  

                  $config['create_thumb'] = TRUE;  

                  $config['maintain_ratio'] = TRUE;  

                  $config['width'] = 100;  

                  $config['height'] = 100;  

                  $this->image_lib->initialize($config);  

                  $this->image_lib->resize();  

                  if ( !$this->image_lib->resize()){  

                      $error =  $this->image_lib->display_errors();  

                      echo $error;  

                  }  

              }  

          }  

      }  

      /* @method : get_hospital  

       * @params:  

       * @desc: get_hospital method is used for fetching hospital details  

       */  

      public function get_hospital_by_id(){  

          $hsp = $this->db->get("hhospital")->row();  

          return $hsp;  

      }  

      /* @method : get_doctor  

       * @params: $id  

       * @desc: get_doctor method is used for fetching doctor details against hospital id  

       */  

      public function get_doctor($id){  

          $this->db->select("*");  

          $this->db->from("hhospitaldoctor");  

          $this->db->where('hospitalid', $id);  

          $query = $this->db->get();  

          return $query->result();  

      }  

      /* @method : get_facility  

       * @params: $id  

       * @desc: get_facility method is used for fetching facility details against to hospital id  

       */  

      public function get_facility($id){  

          $fac = $this->db->get_where("hhospitalfacilities",array("hospitalid" => $id));  

          return $fac->result();  

      }  

      /* @method : working_hours  

       * @params: $id  

       * @desc: working_hours method is used for fetching working hours details against to hospital id  

       */  

      public function working_hours($id){  

          $hrs = $this->db->get_where("hworkinghours",array("hospitalid" => $id));  

          return $hrs->result();  

      }  

      /* @method : working_hours  

       * @params: $id, $uid  

       * @desc: working_hours method is used for fetching working hours details against to hospital id  

       */  

      public function get_working_hrs_mon_list($id,$uid){  

          $this->db->select('hour');  

          $this->db->from('hworkinghours');  

          $this->db->where('userid' , $uid);  

          $this->db->where("hospitalid", $id);  

          $this->db->where('weekday' , '1');  

          $res =array_column($this->db->get()->result_array(),'hour');  

          return array_map('trim',$res);  

      }  

      /* @method : get_working_hrs_tues_list  

       * @params: $id, $uid  

       * @desc: get_working_hrs_tues_list method is used for fetching working hours details against to hospital id  

       */  

      public function get_working_hrs_tues_list($id,$uid){  

          $this->db->select('hour');  

          $this->db->from('hworkinghours');  

          $this->db->where('userid' , $uid);  

          $this->db->where("hospitalid", $id);  

          $this->db->where('weekday' , '2');  

          $res =array_column($this->db->get()->result_array(),'hour');  

          return array_map('trim',$res);  

      }  

      /* @method : get_working_hrs_wed_list  

       * @params: $id,$uid  

       * @desc: get_working_hrs_wed_list method is used for fetching working hours details against to hospital id  

       */  

      public function get_working_hrs_wed_list($id,$uid){  

          $this->db->select('hour');  

          $this->db->from('hworkinghours');  

          $this->db->where('userid' , $uid);  

          $this->db->where("hospitalid", $id);  

          $this->db->where('weekday' , '3');  

          $res =array_column($this->db->get()->result_array(),'hour');  

          return array_map('trim',$res);  

      }  

      /* @method : get_working_hrs_thus_list  

       * @params: $id,$uid  

       * @desc: get_working_hrs_thus_list method is used for fetching working hours details against to hospital id  

       */  

      public function get_working_hrs_thus_list($id,$uid){  

          $this->db->select('hour');  

          $this->db->from('hworkinghours');  

          $this->db->where('userid' , $uid);  

          $this->db->where("hospitalid", $id);  

          $this->db->where('weekday' , '4');  

          $res =array_column($this->db->get()->result_array(),'hour');  

          return array_map('trim',$res);  

      }  

      /* @method : get_working_hrs_fri_list  

       * @params: $id, $uid  

       * @desc: get_working_hrs_fri_list method is used for fetching working hours details against to hospital id  

       */  

      public function get_working_hrs_fri_list($id,$uid){  

          $this->db->select('hour');  

          $this->db->from('hworkinghours');  

          $this->db->where('userid' , $uid);  

          $this->db->where("hospitalid", $id);  

          $this->db->where('weekday' , '5');  

          $res =array_column($this->db->get()->result_array(),'hour');  

          return array_map('trim',$res);  

      }  

      /* @method : get_working_hrs_sat_list  

       * @params: $id, $uid  

       * @desc: get_working_hrs_sat_list method is used for fetching working hours details against to hospital id  

       */  

      public function get_working_hrs_sat_list($id,$uid){  

          $this->db->select('hour');  

          $this->db->from('hworkinghours');  

          $this->db->where('userid' , $uid);  

          $this->db->where("hospitalid", $id);  

          $this->db->where('weekday' , '6');  

          $res =array_column($this->db->get()->result_array(),'hour');  

          return array_map('trim',$res);  

      }  

      /* @method : get_working_hrs_sun_list  

       * @params: $id, $uid  

       * @desc: get_working_hrs_sun_list method is used for fetching working hours details against to hospital id  

       */  

      public function get_working_hrs_sun_list($id,$uid){  

          $this->db->select('hour');  

          $this->db->from('hworkinghours');  

          $this->db->where('userid' , $uid);  

          $this->db->where("hospitalid", $id);  

          $this->db->where('weekday' , '7');  

          $res =array_column($this->db->get()->result_array(),'hour');  

          return array_map('trim',$res);  

      }  

      /* @method : get_holiday  

       * @params: $id  

       * @desc: get_holiday method is used for fetching holiday details against to hospital id  

       */  

      public function get_holiday($id){  

          $this->db->select('*');  

          $this->db->from('hhospitalholiday');  

          $this->db->where("hospitalid", $id);  

          $res = $this->db->get()->result();  

          return $res;  

      }  

      /* @method : get_hrs_list  

       * @params: $date  

       * @desc: get_holiday_list method is used for fetching holiday lists against to hospital date  

       */  

      public function get_holiday_list($date){  

          $this->db->select('holiday_date');  

          $this->db->from('hhospitalholiday');  

          $this->db->where('holiday_date',$date);  

          $res = $this->db->get()->result();  

          return $res;  

      }  

      /* @method : get_hrs_list  

       * @params: $weekDay  

       * @desc: get_hrs_list method is used for fetching hrs lists against weekDay  

       */  

      public function get_hrs_list($weekDay, $userId){  

          $dayofweek = date('w', strtotime($weekDay));  

          $this->db->select('hour');  

          $this->db->from(' hworkinghours');  

          $this->db->where("userid", $userId);  

          $this->db->where('weekday',$dayofweek);  

          $res =array_column($this->db->get()->result_array(),'hour');  

          return array_map('trim',$res);  

      }  

      /* @method : get_all_day_hrs  

       * @params: $weekDay , $hid  

       * @desc: get_all_day_hrs method is used for fetching hrs lists against weekDay , hid  

       */  

      public function get_all_day_hrs($weekDay, $hid){  

          $cnt = count($weekDay);  

          $res =array();  

          for($i=0 ;$i< $cnt ; $i++){  

              $this->db->select('hour');  

              $this->db->from(' hworkinghours');  

              $this->db->where("hospitalid",$hid);  

              $this->db->where('weekday',$weekDay[$i]);  

              $res[$weekDay[$i]] = array_column($this->db->get()->result_array(),'hour');  

          }  

          return $res;  

      }  

      /* @method : check_holiday_date  

       * @params:  $hid  

       * @desc: check_holiday_date method is used for fetching holiday dates against hid  

       */  

      public function check_holiday_date($hid){  

          $this->db->select('holiday_date');  

          $this->db->from(' hhospitalholiday');  

          $this->db->where("hospitalid",$hid);  

          $res = array_column($this->db->get()->result_array(),'holiday_date');  

          return $res;  

      }  

      /* @method : check_holiday_date  

       * @params:  $hid  

       * @desc: check_holiday_date method is used for fetching holiday dates against hid  

       */  

      public function get_working_days_list($hid){  

          $this->db->select('weekday');  

          $this->db->from('hworkinghours');  

          $this->db->where("hospitalid",$hid);  

          $this->db->distinct();  

          $res = array_column($this->db->get()->result_array(),'weekday');  

          return $res;  

      }  

      /* @method : generateRandomString  

       * @params:  $length  

       * @desc: generateRandomString method is used for generating random string  

       */  

      function generateRandomString($length = 10) {  

          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';  

          $charactersLength = strlen($characters);  

          $randomString = '';  

          for ($i = 0; $i < $length; $i++) {  

              $randomString .= $characters[rand(0, $charactersLength - 1)];  

          }  

          return $randomString;  

      }  

      /* @method : get_hospital_data  

       * @params:  

       * @desc: get_hospital_data method is used for fetching hospital details  

       */  

      public function get_hospital_data(){  

          $this->db->select('*');  

          $this->db->from('hhospital');  

          $res = $this->db->get()->result();  

          return $res;  

      }  

      /* @method : get_hospital_data  

       * @params:  

       * @desc: get_hospital_data method is used for fetching hospital details  

       */  

      public function get_hospital_images(){  

          $this->db->select('picurl');  

          $this->db->from('hhospitalphoto');  

          $res = $this->db->get()->result();  

          return $res;  

      }  

      /* @method : get_all_doctors  

       * @params:  

       * @desc: get_all_doctors method is used for fetching doctors details  

       */  

      public function get_all_doctors(){  

          $this->db->select('*');  

          $this->db->from('hhospitaldoctor');  

          $res = $this->db->get()->result();  

          return $res;  

      }  

      /* @method : get_all_services  

       * @params:  

       * @desc: get_all_services method is used for fetching service details  

       */  

      public function get_all_services(){  

          $this->db->select('service_name');  

          $this->db->from('hhospitalservices');  

          $res = $this->db->get()->result();  

          return $res;  

      }  

      /* @method : get_all_working_hrs  

       * @params:  

       * @desc: get_all_working_hrs method is used for fetching hrs details  

       */  

      public function get_all_working_hrs(){  

          $this->db->select('weekday');  

          $this->db->select('hour');  

          $this->db->from('hworkinghours');  

          $res = $this->db->get()->result();  

          return $res;  

      }  

      /* @method : get_all_reviews  

       * @params:  

       * @desc: get_all_reviews method is used for fetching review details  

       */  

      public function get_all_reviews(){  

          $this->db->select('*');  

          $this->db->from('hhospitalreview');  

          $res = $this->db->get()->result();  

          return $res;  

      }  

      public function get_all_weekday($data)  

      { $this->db->select('*');  

          $this->db->from('hweekname');  
          if(!empty( $data))
          $this->db->where_not_in('hweekname.weekid', $data);  

          $res = $this->db->get()->result();  

          return $res;  

      }  

      public function add_hospital_scheduleForADay($data)  

      {  

          $this->db->insert('hworkinghours',$data);  

          return $this->db->insert_id();  

      }  

	  public function getSatffDetailsByID($staffID)

	  {  

	      $this->db->select('hstaff.ID as StaffID,hstaff.userid,hstaff.staff_cat_id,hstaff.staff_name,hstaff.other_info,hstaff.staff_pic,,hstaffcategory.staff_cat_name ');  

          $this->db->from('hstaff');

		  $this->db->join('hstaffcategory','hstaff.staff_cat_id = hstaffcategory.ID','inner');

		  $this->db->where("hstaff.ID",$staffID);  

          $res = $this->db->get()->row(); 

          return $res;  

		  }

  }