<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Hospital extends H_Controller  {



    public function __construct(){

        parent::__construct();

        $this->load->model('home_physican_model');

        $this->load->model('Procedure_model');

        $this->load->model('Staff_model');

        $this->load->model('Specialist_model');

        $this->load->model('Patient_model');

        $this->load->model('booking_model');

        $this->load->model('hospital_model');

        $this->load->model('user');

        $this->load->helper('url');

        $this->load->helper('string');

        $this->load->library('session');

        //$this->load->library('email');

        $this->load->helper('form');

        $this->load->library('form_validation');

        $this->load->library('upload');

    }



    /* @method :index

     * @params:

     * @desc: index is used for hospital view page

     */



    public function index(){



        $this->session->set_userdata('hospital_id', '1');



        $this->session->set_userdata('user_id', '1');



        $hospital_id= $this->session->userdata('hospital_id');



        $data['hospital_working_hours']= $this->hospital_model->get_hospital_working_info($hospital_id);



        $data['hospital_facilities_info']= $this->hospital_model->get_hospital_facilities_info_details($hospital_id);



        $data['hospital_services_info']= $this->hospital_model->get_hospital_services_info_details($hospital_id);



        $data['hospital_staff_image']= $this->hospital_model->get_hospital_staff_info($hospital_id);



        $this->load->view('hospital_dashboard',$data);



    }



    /* @method :get_data_staff

     * @params:

     * @desc: get_data_staff is used for fetch data from hstaff table

     */



    public function get_data_staff(){



        $getstaffdetails= $this->hospital_model->get_hospital_staff_info();



        echo $getstaffdetails;



    }



    /* @method :get_data_hospital

     * @params:

     * @desc: get_data_hospital is used for fetch data from hhospital table

     */



    public function get_data_hospital(){



        $hospital_id= $this->session->userdata('hospital_id');



        $getstaffdetails= $this->hospital_model->get_hospital_user_info($hospital_id);



        echo $getstaffdetails;



    }



    /* @method :hospital_update

     * @params:

     * @desc: hospital_update is used for update hospital information

     */



    public function hospital_update(){



        $hospital_id= $this->session->userdata('hospital_id');



        $imgPhysicalPath = 'assets/hospital/original/';



        $NextimgPhysicalPath ='assets/hospital/';



        $imgDirPath = base_url().'assets/hospital/original/';



        //echo $imgPhysicalPath;

        //Validating Name Field

        $this->form_validation->set_rules('hospital_name', 'hospital_address Name', 'required|min_length[2]|max_length[50]');



        //Validating Email Field

        $this->form_validation->set_rules('hospital_address', 'hospital_address Description', 'required');



        //	die();

        if($this->form_validation->run() == FALSE) {

            redirect('hospital');

        }

        else {

            $new_name = time().$_FILES["file_logo"]['name'];



            $config['file_name'] = $new_name;

            $config['upload_path']   = $imgPhysicalPath;

            $config['allowed_types'] = 'gif|jpg|png';

            $config['max_size']      = 3456789;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            //$this->upload->initialize($config);



            if (!$this->upload->do_upload('file_logo')) {



                $data= array(

                    'name' => $this->input->post('hospital_name'),

                    'address '=> $this->input->post('hospital_address'),

                    'email '=> $this->input->post('hospital_email'),

                    'phone '=> $this->input->post('hospital_phone'),

                    'zip '=> $this->input->post('hospital_zip'),

                );

                //Transfering data to Model

                $this->hospital_model->update_hospital_data($data,$hospital_id);

                //Loading View

                $this->session->set_flashdata('success','Successfully updated');

                redirect('hospital');

            }

            else {

                $data= array(

                    'name' => $this->input->post('hospital_name'),

                    'address '=> $this->input->post('hospital_address'),

                    'email '=> $this->input->post('hospital_email'),

                    'phone '=> $this->input->post('hospital_phone'),

                    'zip '=> $this->input->post('hospital_zip'),

                    'logo_url' => $new_name

                );

                $this->hospital_model->update_hospital_data($data,$hospital_id);



                //Transfering data to Model

                $last_id=  $this->session->userdata('hospital_id');;



                $data = array('upload_data' => $this->upload->data());



                $id_directory= $NextimgPhysicalPath.$last_id;



                $image_200_200 = $id_directory.'/200*200/';



                if(!is_dir($id_directory))

                    mkdir($id_directory, 0777);		// Creating 760x450 directory



                if(is_file($imgPhysicalPath.$new_name))						//  this image for 485x220 directory

                {

                    //echo $imgPhysicalPath.$new_name;

                    if(!is_dir($image_200_200))

                        mkdir($image_200_200, 0777);		// Creating 760x450 directory

                    $settings = array('w'=>200,'h'=>200,'canvas-color'=>'#FFFFFF','Imrtype'=>'fixed','quality'=>100);

                    $imagepath= $this->customresize($imgPhysicalPath.$new_name,$settings,$image_200_200.$new_name);

                }



                $data['message'] = 'Sub Group Successfull Updated';

                //Loading View

                $this->session->set_flashdata('success','Hospital data is Successfull Updated');

                redirect('hospital');

            }

        }

    }



    /* @method :customresize

     * @params:

     * @desc: Resize Image by Imagemagic using convert exec, is working live server but not working in localhost

     */



    public function customresize($imagePath,$opts=null,$dpath)

    {

        # start configuration

        #Imrtype used for resize according to height/fixed/width

        #iscanvas used for suppose u have to rezise 380X260 , but yr imge resize after 300X135 . some part of 380x260 will be canvas color.



        if(!isset($opts['quality']))

            $quality = 90; # image quality to use for ImageMagick (0 - 100)

        else

            $quality = $opts['quality'];



        $path_to_convert = '/usr/bin/convert';'convert'; # this could be something like /usr/bin/convert or /opt/local/share/bin/convert



        ## you shouldn't need to configure anything else beyond this point



        if(isset($opts['w'])): $w = $opts['w']; endif;

        if(isset($opts['h'])): $h = $opts['h']; endif;



        $filename = md5_file($imagePath);



        $create = true;



        if($create == true):

            if(!empty($w) and !empty($h)):



                list($width,$height) = getimagesize($imagePath);

                $resize = $w;



                if($opts['Imrtype']=='fixed')

                {

                    $resize = $w."x".$h."\!";

                }

                elseif($opts['Imrtype']=='height')

                {

                    $resize = "x".$h;

                }

                elseif($opts['Imrtype']=='width')

                {

                    $resize = $w;

                }

                elseif($opts['Imrtype']=='ratio')

                {

                    if($width > $height):

                        $resize = $w;

                        if(isset($opts['crop']) && $opts['crop'] == true):

                            $resize = "x".$h;

                        endif;

                    else:

                        $resize = "x".$h;

                        if(isset($opts['crop']) && $opts['crop'] == true):

                            $resize = $w;

                        endif;

                    endif;

                }





                if(isset($opts['iscanvas']) && $opts['iscanvas'] == true):

                    $cmd = $path_to_convert." "."'".$imagePath."'"." -resize ".$resize." -size ".$w."x".$h." xc:".(isset($opts['canvas-color'])?$opts['canvas-color']:"transparent")." +swap -gravity center -composite -quality ".$quality." "."'".$dpath."'";





                else:

                    $cmd = $path_to_convert." "."'".$imagePath."'"." -resize ".$resize." -quality ".$quality." "."'".$dpath."'";



                endif;



            endif;



            $c = exec($cmd);



        endif;



        # return cache file path

        return $dpath;

    }



    /* @method :get_hospital_image

     * @params:

     * @desc: get_hospital_image is used for slider Image

     */



    public function get_hospital_image(){

        $hospital_id= $this->session->userdata('hospital_id');



        $getstaffdetails= $this->hospital_model->get_hospital_image($hospital_id);



        echo $getstaffdetails;



    }



    /* @method :remove_hospital_image

     * @params:

     * @desc: remove_hospital_image is used for remove the slider Image

     */



    public function remove_hospital_image(){



        $postdata = file_get_contents("php://input");



        $request = json_decode($postdata);



        $imageid = $request->ID;



        $getstaffdetails= $this->hospital_model->remove_hospital_image($imageid);



        //Loading View



        if($getstaffdetails){

            $this->session->set_flashdata('success','Your image successfully deleted');

            //redirect('hospital');

        }

        else{

            $this->session->set_flashdata('success','Something Problem');

            // redirect('hospital');

        }



    }



    /* @method :hospital_image_upload

     * @params:

     * @desc: remove_hospital_image is used for upload the slider Image

     */



    public function hospital_image_upload(){



        $hospital_id= $this->session->userdata('hospital_id');



        $imgPhysicalPath = 'assets/hospital/hospitalslider/original/';



        $NextimgPhysicalPath ='assets/hospital/hospitalslider/';



        $imgDirPath = base_url().'assets/hospital/hospitalslider/original/';



        if(!$_FILES) {



            redirect('hospital');





        }

        else {





            $new_name = time().str_replace(" ","_",$_FILES["file_logo"]['name']) ;



            $config['file_name'] = $new_name;

            $config['upload_path']   = $imgPhysicalPath;

            $config['allowed_types'] = 'gif|jpg|png';

            $config['max_size']      = 3456789;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            //$this->upload->initialize($config);



            if (!$this->upload->do_upload('file_logo')) {



                redirect('hospital');



            }





            else {



                $data= array('hospitalid' => $hospital_id,'picurl'  => $new_name);



                $this->hospital_model->hospital_image_upload($data);



                //Transfering data to Model

                $last_id=  $this->session->userdata('hospital_id');;



                $data = array('upload_data' => $this->upload->data());



                $id_directory= $NextimgPhysicalPath.$last_id;



                $image_200_200 = $id_directory.'/';







                if(is_file($imgPhysicalPath.$new_name))						//  this image for 485x220 directory

                {





                    $settings = array('w'=>200,'h'=>200,'canvas-color'=>'#FFFFFF','Imrtype'=>'fixed','quality'=>70);

                    $imagepath= $this->customresize($imgPhysicalPath.$new_name,$settings,$image_200_200.$new_name);





                    /*	echo $imgPhysicalPath.$new_name;



                        if(!is_dir($image_200_200)){





                        mkdir($image_200_200, 0777);		// Creating 760x450 directory



                        //die('svdvdfvdfvgfdgvf');



                        $settings = array('w'=>200,'h'=>200,'canvas-color'=>'#FFFFFF','Imrtype'=>'fixed','quality'=>100);

                        $imagepath= $this->customresize($imgPhysicalPath.$new_name,$settings,$image_200_200.$new_name);



                        }

                        else{

                            die('svdvdfvdfvgfdgvf');



                        $settings = array('w'=>200,'h'=>200,'canvas-color'=>'#FFFFFF','Imrtype'=>'fixed','quality'=>100);

                        $imagepath= $this->customresize($imgPhysicalPath.$new_name,$settings,$image_200_200.$new_name);*/



                    //}

                }











                //Loading View

                $this->session->set_flashdata('success','Hospital Image added Successfully');

                redirect('hospital');



            }







        }





    }



    /* @method :update_working_hours

     * @params:

     * @desc: update_working_hours is used for update of hospital working hours by using

     */



    public function update_working_hours(){



        $userid = $_REQUEST['userid'];



        $hospitalid = $_REQUEST['houseid'];



        $dayid = $_REQUEST['dayid'];



        $from_hr = $_REQUEST['from_hr'];



        $to_hr = $_REQUEST['to_hr'];



        //$status = $_REQUEST['status'];



        $getstaffdetails= $this->hospital_model->hospital_working_hours_add($userid,$hospitalid,$dayid,$from_hr,$to_hr);



        //Loading View



        if($getstaffdetails){

            $this->session->set_flashdata('success','Your Working Hours successfully Updated');

            //redirect('hospital');

        }

        else{

            $this->session->set_flashdata('success','Something Problem');

            // redirect('hospital');

        }



    }



    /* @method :get_working_hours_details

     * @params:

     * @desc: get_working_hours_details is used for fetching details of hospital working hours by using hospitalid

     */



    public function get_working_hours_details(){



        $hospital_id= $this->session->userdata('hospital_id');



        $getstaffdetails= $this->hospital_model->get_hospital_working_info($hospital_id);



        echo json_encode($getstaffdetails);



    }



    /* @method :delete_hfaciliy

     * @params:

     * @desc: delete_hfaciliy is used for delete facility of hospital

     */



    public function delete_hfaciliy(){



        $house_facility_id = $_REQUEST['hospitalId'];



        $tag = trim($_REQUEST['tag']);



        $hfacilityDelete= $this->hospital_model->delete_hfacility($house_facility_id, $tag);







    }



    /* @method :add_hfaciliy

     * @params:

     * @desc: add_hfaciliy is used for insert facility of hospital

     */



    public function add_hfaciliy(){



        $data= array(

            "userid" => $_REQUEST['userid'],

            "hospitalid"=> $_REQUEST['hospitalid'],

            "facility_name"=>$_REQUEST['facilityname'],

            // "facility_desc"=>$_REQUEST['facilitydesc'],

            //  "other"=>$_REQUEST['facilityothers']

        );



        $hfacilityadd= $this->hospital_model->add_hfacility($data);



        if($hfacilityadd){

            $this->session->set_flashdata('success','Hospital Facility is Successfull Added');

            $new['message']= "success";



        }

        else{

            $new['message']= "error";

        }

        echo json_encode($new);



    }



    /* @method :get_hfaciliy_details

     * @params:

     * @desc: get_hfaciliy_details is used for fetch facility using hospital id

     */



    public function get_hfaciliy_details(){



        $postdata = file_get_contents("php://input");



        $request = json_decode($postdata);



        $hospitalId = array(

            "hospitalid"=>$request->hospitalid

        );



        $hfacilityget= $this->hospital_model->get_hfacility_angular($hospitalId);



        echo json_encode($hfacilityget);



    }



    /* @method :delete_hfaciliy_details

     * @params:

     * @desc: delete_hfaciliy_details is used for removed facility

     */

    public function delete_hfaciliy_details(){



        $facilityId = array(

            "ID"=>$_REQUEST['facilityid']

        );

        $hfacilityget= $this->hospital_model->remove_hfacility_angular($facilityId);



        if($hfacilityget){

            $data['message']= "success";

        }

        else{

            $data['message']= "error";

        }

        echo json_encode($data);



    }



    /* @method :delete_hservice

     * @params:

     * @desc: delete_hservice is used for removed services

     */



    public function delete_hservice(){



        $house_facility_id = $_REQUEST['hospitalId'];



        $tag = trim($_REQUEST['tag']);



        $hfacilityDelete= $this->hospital_model->delete_hservice($house_facility_id, $tag);



        if($hfacilityDelete){

            $data['message'] ="Success";



        }

        else{



            $data['message'] ="error";



        }







        return json_encode($data);







    }



    /* @method :add_hservice

     * @params:

     * @desc: add_hservice is used for removed services

     */



    public function add_hservice(){



        $data= array(

            //"userid" => $_REQUEST['userid'],

            "hospitalid"=> $_REQUEST['hospitalid'],

            "service_name"=>$_REQUEST['servicename'],

            // "facility_desc"=>$_REQUEST['facilitydesc'],

            //  "other"=>$_REQUEST['facilityothers']

        );



        $hserviceadd= $this->hospital_model->add_hservice($data);



        if($hserviceadd){

            $this->session->set_flashdata('success','Hospital Service is Successfull Added');

            $new['message']= "success";



        }

        else{

            $new['message']= "error";

        }

        echo json_encode($new);



    }



    /* @method :invite_hstaff

     * @params:

     * @desc: invite_hstaff is used for insert specialistid and specialist email and send mail for this particular email

     */



    public function invite_hstaff(){



        $data= array(

            "specialist_id" => $_REQUEST['specialistId'],

            "specialist_email" => $_REQUEST['specialistemail'],

            "sent_date" =>date('Y-m-d H:i:s')

        );



        $specialist_invite= $this->hospital_model->invite_straff($data);



        if($specialist_invite){



            $this->send_mail($_REQUEST['specialistemail']);



            $this->session->set_flashdata('success','Staff invitition is Successfull');



            $new['message']= "success";



        }

        else{

            $new['message']= "error";

        }

        echo json_encode($new);



    }



    /* @method :send_mail

     * @params:

     * @desc: send_mail is used for sending mail

     */



    public function send_mail($email) {



        $from_email = "matainja003@gmail.com";

        $to_email = $email;



        //Load email library

        $this->load->library('email');



        $this->email->from($from_email, 'Your Name');

        $this->email->to($email);

        $this->email->subject('Email Test');

        $this->email->message('Testing the email class.');



        if (!$this->email->send()) {

            echo 'error';

        }

        else {

            echo 'Your e-mail has been sent!';

        }



    }







//---------------------------------------End Hospital Data --------------------------



    public function get_data_facilities(){



        $getstaffdetails= $this->hospital_model->get_hospital_facilities_info();



        $dataarray= array();



        foreach($getstaffdetails as $hfacilities){



            $dataarray['dataarray'][]= $hfacilities->desc;



        }



        $json_to_string= str_replace("[", "", json_encode($dataarray));

        echo str_replace("]", "", json_encode($json_to_string));





    }



}