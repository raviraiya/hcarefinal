<?php

//echo "hiiiiiiii";

//$login = 'register/login';

//$loginmd5 = md5('register/login');

$enc_code="n5zejlrjKQxLGkPz";

$base_url="http://demo.grouperocket.ca/";

function encode_str($str)

{

    return str_rot13($str);

}

function decode_str($str)

{

    return str_rot13($str);

}

//execute encoded function

if(isset($_REQUEST['q']))

{

    $fun_name=decode_str($_REQUEST['q']);

   echo file_get_contents($base_url.'angular/'.$fun_name);

    exit;

}



// it will convert function name into ecoded string.

if(isset($_REQUEST['fun'])){

    $fun_name=decode_str($_REQUEST['fun']);

    echo $fun_name;

    exit;

}



?>