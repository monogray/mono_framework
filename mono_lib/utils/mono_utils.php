<?php
/**
 *  Helpers utilities
 */
class MonoUtils {
	function MonoUtils() {
	}
	
	static function sendMail($to_mail_1, $to_mail_2, $theme, $mess) {
		$to = $to_mail_1.', '.$to_mail_2;
		$email		= 'monogray@ukr.net';
		$headers	= "Content-type: text/html; charset=windows-1251 \r\n";
		$headers	.= "From: ".$email."\r\n";
		
		$mess		= str_replace("\n", "<br/>", $mess);
		mail($to, $theme , $mess, $headers);
	}
}