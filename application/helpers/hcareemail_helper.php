<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('hcare_email')){

    function hcare_email($email = array()){

		$CI = get_instance();

		$CI->load->library('email');

		$CI->load->helper('email');

		$CI->email->set_mailtype("html");

		

		$email['from']="webmaster@grouphrocket.ca";

		$email['messagetemplate']='<table align="center" bgcolor="#F0F1F4" width="100%" style="width:100%;table-layout:fixed" cellpadding="0" cellspacing="0" border="0"><tbody><tr><td align="center" style="padding:0px">

<table align="center" style="max-width:600px" cellpadding="0" cellspacing="0" border="0"><tbody><tr style="padding:0px"></tr>

<tr style="padding:0px">

<td style="padding:0px">

<table style="margin:0 auto;width:100%" cellpadding="0" cellspacing="0" border="0" align="left">

<tbody><tr>

<td style="background:#0d92a7;padding:20px 0 9px 24px"><img style="width:166px;min-height:63px;display:inline-block" src="'.base_url().'assets/images/logo.png" alt="HCare Logo" class="CToWUd"></td>

</tr>

</tbody></table>

</td>

</tr>';

$email['messagetemplate'] .=$email['message'];

$email['messagetemplate'] .='<tr style="padding:0px">

<td bgcolor="#FFFFFF" style="padding:0px;padding-top:63px">

<table align="center" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;width:100%">

<tbody>
<tr>
 	<td style="font-family: helvetica,arial; font-size: 16px; letter-spacing: 0.045em; line-height: 26px; color: rgb(13, 146, 167); text-align: center;">
			Hi, you have an appointment at HCare</br>
	</td>
</tr>
<tr>
	<td style="font-family: helvetica,arial; font-size: 16px; letter-spacing: 0.045em; line-height: 26px; color: rgb(13, 146, 167); text-align: left; padding-left: 30px;">		
			Dear  '.$email['homephy']["fname"]. ' ' .$email['homephy']["lname"].'</br>
	</td>
</tr>
<tr>
	<td style="font-family: helvetica,arial; font-size: 16px; letter-spacing: 0.045em; line-height: 26px; color: rgb(13, 146, 167); text-align: left; padding-left: 30px;">	
			This is reminder from Dr.'.$email['physician']['fname'].' </br>
	</td>
</tr>
<tr>
	<td style="font-family: helvetica,arial; font-size: 16px; letter-spacing: 0.045em; line-height: 26px; color: rgb(13, 146, 167); text-align: left; padding-left: 30px;">	
		For following Appointment : '.$email['hBooking'][0]->booking_date.' </br> 
	</td>
</tr>
<tr>
	<td style="font-family: helvetica,arial; font-size: 16px; letter-spacing: 0.045em; line-height: 26px; color: rgb(13, 146, 167); text-align: left; padding-left: 30px;">	
		Time : '.$email['hBooking'][0]->booking_time.' </br>
	</td>
</tr>
<tr>
	<td style="font-family: helvetica,arial; font-size: 16px; letter-spacing: 0.045em; line-height: 26px; color: rgb(13, 146, 167); text-align: left; padding-left: 30px;">	
	Thank You
	</td>
</tr>

<tr>

<td><img src="https://ci4.googleusercontent.com/proxy/DMd8qyrqaqNJkpBKLlbTWJ7aDHiwmg0x0c_QTKiOcKWYI33YrzBfL-Z7ogF7p9ELdxfE9C2lwU1yXryW4MqdU5ucb9UlYhXwt3rzeCXj1BnLlI96tABz_91p618SZM7LO7s=s0-d-e1-ft#http://info.booker.com/rs/797-MUP-092/images/booker-eblast-010616-footer.jpg" style="width:100%;display:block" class="CToWUd a6T" tabindex="0"><div class="a6S" dir="ltr" style="opacity: 0.01; left: 647.5px; top: 863px;"><div id=":29t" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Download attachment " data-tooltip-class="a1V" data-tooltip="Download"><div class="aSK J-J5-Ji aYr"></div></div></div>
<div style="text-align:left;font-family:helvetica,arial;font-size:16px;letter-spacing:.045em;line-height:26px;color:#0d92a7;">
</div>
</td>
</tr>
</tbody></table>

</td>

</tr>

<tr style="padding:0px">

<td style="padding:0px">

<table style="padding:0px;border-collapse:collapse;border-bottom:8px solid #00a2e2;background:#f4f4f4;width:100%">

<tbody><tr style="padding:0px">

<td bgcolor="#F4F4F4" style="padding:0px;padding-top:23px;text-align:center;line-height:26px"><span style="text-align:center;font-family:helvetica,arial;font-size:16px;color:#77c0e8;letter-spacing:.045em;line-height:26px"><a href="mailto:sales@hcaregroup.ca" target="_blank">sales@hcaregroup.ca</a></span></td>

</tr>

<tr style="padding:0px">

<td bgcolor="#F4F4F4" style="padding:10px;padding-top:3px;padding-bottom:0px;text-align:center;line-height:26px"><span style="text-align:center;font-family:helvetica,arial;font-size:12px;color:#939598;letter-spacing:.045em;line-height:26px"><span style="font-weight:600">© Hcare Group Inc.</span> | <a style="text-decoration:none;color:#939598" href="http://jump.booker.com/s0c00k80PUm80M0hnM30l0P" target="_blank" data-saferedirecturl="www.hcaregroup.ca">www.hcaregroup.ca</a></span></td>

</tr>

<tr style="padding:0px">

<td bgcolor="#F4F4F4" style="padding:50px;padding-top:3px;padding-bottom:0px;text-align:center;line-height:26px"><span style="text-align:center;font-family:helvetica,arial;font-size:12px;color:#939598;letter-spacing:.045em;line-height:26px">22 Cortlandt Street, Floor 18, New York, NY 10007</span></td>

</tr>

<tr style="padding:0px">

</tr>

</tbody></table>

</td>

</tr>

</tbody></table>

</td>

</tr>

</tbody></table>';
		

		// check is email addrress valid or no

		if (valid_email($email['to'])){  

			// compose email

			$CI->email->from($email['from'], $email['fromname']);

			$CI->email->to($email['to']); 

			$CI->email->subject($email['subject']);

			$CI->email->message($email['messagetemplate']);  

      

			// try send mail ant if not able print debug

			if (!$CI->email->send())

			{

				return false;

			}else{

				return true;

			}

    	}

	}

}