<?php

Class Login
{
	private $db;
	function __construct() {
		$db=$this->connect_db();
	}
	private function connect_db() {
		global $mysql;
		$this->db=$mysql;

	}

	function mail_content_aktivasi() {
    		return '
    		Hai $fullname,
    		Silahkan klik link berikut untuk melakukan aktivasi akun anda:

    		$link_aktivasi

    		';
    	}

	function send_email_aktivasi($fullname,$stamp,$email) {

    		$mail_content_aktivasi=$this->mail_content_aktivasi();
    		$value_code_aktivasi=fronturl("app_aktivasi/$stamp");
    		$mail_content_aktivasi=str_replace('$link_aktivasi',$value_code_aktivasi,$mail_content_aktivasi);
    		$mail_content_aktivasi=str_replace('$fullname',$fullname,$mail_content_aktivasi);

    		 $this->send_email('roemly@gmail.com',"Testing - Aktivasi akun anda $email ".time(),$mail_content_aktivasi);
    		return $this->send_email($email,"Wifiukai - Aktivasi akun anda",$mail_content_aktivasi);
    	}


	function  send_email($emailto,$subject,$message,$emailfrom="",$namefrom="",$attach=array())
	{
	
	global $mail_host,$mail_port,$mail_smtp_auth,$mail_username,$mail_password;
        /*

    $headers = 'From: noreply@wifiukai.com'       . "\r\n" .
                 'Reply-To: noreply@wifiukai.com' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

    return mail($emailto, $subject, $message, $headers);
	*/
		b_load_lib("class.smtp");
		b_load_lib("class.phpmailer");
		b_load_lib("class.verifyEmail");
		
		//kirim email
		$mail = new PHPMailer();
		
        
        // setting
         $mail->IsSMTP();  // send via SMTP
        $mail->Mailer = "mail";
        $mail->SMTPSecure = $mail_smtp_secure;
        $mail->SMTPDebug = $mail_smptp_debug;
            
        $mail->SetLanguage("en");

		$mail->Host     = $mail_host; // SMTP servers 25/587 / POP 110
        $mail->Port     = $mail_port; // SMTP servers 25/587 / POP 110
        $mail->SMTPAuth = $mail_smtp_auth;     // turn on SMTP authentication
        $mail->Username = $mail_username;  // SMTP username
        $mail->Password = $mail_password; // SMTP password 
		$emailfrom=$emailfrom==""?$mail->Username:$emailfrom;						
		$namefrom=$namefrom==""?$mail->Username:$namefrom;						
		
		
		
		// pengirim
		$mail->From     = $emailfrom;
		$mail->FromName = $namefrom;	
		$mail->Sender   = $emailfrom;
		$mail->AddReplyTo($emailfrom, $namefrom);
		$mail->AddAddress($emailto);
		$mail->Subject  = $subject;
		$mail->MsgHTML($message);
		$mail->IsHTML(true);    

		if ($mail->Send())
		{
			return true;
		}
		else
		{

			return false;
		}
		


	}
}
?>
