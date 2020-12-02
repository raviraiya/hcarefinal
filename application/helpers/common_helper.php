<?php
function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}
function randompassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
function getfromemail()
{
    return "webmaster@hirealwayer.co.in";
}
function getfromname()
{
    return "webmaster";
}
function encode_str($str)
{
    $CI =& get_instance();
    return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $CI->config->item("encryption_key"),$str , MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));

}
function decode_str($str)
{
    $CI =& get_instance();
    return   trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $CI->config->item("encryption_key"), base64_decode($str), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
}


//    function resize_image_300($sourcePath, $desPath)
//    {
//        $this->image_lib->clear();
//        $config['image_library'] = 'gd2';
//        $config['source_image'] = $sourcePath;
//        $config['new_image'] = $desPath;
//        $config['quality'] = '100%';
//        $config['create_thumb'] = TRUE;
//        $config['maintain_ratio'] = true;
//        $config['thumb_marker'] = '';
//        $config['width'] = '300';
//        $config['height'] = '300';
//        $this->image_lib->initialize($config);
// 
//        if ($this->image_lib->resize())
//            return true;
//        return false;
//    }


    function resize_image($sourcePath, $desPath,$height,$width)
    {
        $CI =& get_instance();
       
       
        $config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath;
        $config['new_image'] = $desPath;
        $config['quality'] = '100%';
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = true;
//        $config['thumb_marker'] = '';
        $config['width'] = $width;
        $config['height'] = $height;
        $CI->image_lib->clear();
        $CI->image_lib->initialize($config);
       
       if ( $CI->image_lib->resize())
       {
            return true;
       }
        return false;


    }


  function get_image_differnt_size($pic,$size)
  {
    
       $pic_array=explode("/",$pic);
       
        $icnt=count($pic_array);
        if($icnt>0)
        {
           $pic_array[$icnt-1]=$size.$pic_array[$icnt-1];
        }
       return implode("/",$pic_array);
  }

function getLatLong($address){
    if(!empty($address)){
        //Formatted address
        $formattedAddr = str_replace(' ','+',$address);
        //Send request and receive json data by address
        $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false'); 
        $output = json_decode($geocodeFromAddr);
        //Get latitude and longitute from json data
        $data['latitude']  = $output->results[0]->geometry->location->lat; 
        $data['longitude'] = $output->results[0]->geometry->location->lng;
        //Return latitude and longitude of the given address
        if(!empty($data)){
            return $data;
        }else{
            return false;
        }
    }else{
        return false;   
    }
}



