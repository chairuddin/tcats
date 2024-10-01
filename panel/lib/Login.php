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
    function dologin($username="",$password="") {
       
        $username=md5($username);
        $password=md5("quizroom_".$password);
        
        $q=$this->db->query("SELECT id,username,class,jurusan,ruang,fullname,md5(password) password,foto FROM quiz_member WHERE (md5(username)='$username' OR md5(email)='$username' ) AND password='$password' AND status=1");
        
        
        if($q && $this->db->num_rows($q)>0) {
            $d=$this->db->fetch_assoc($q);
            return $d['id'];
        } else {
            return 0;
        }
    }
    function search_user_by_id($id) {
        list($data)=$this->db->query_data("SELECT * FROM quiz_member WHERE id='$id'");
        return $data;
    }
    function search_user_by_token($token) {
     
        list($data)=$this->db->query_data("SELECT * FROM quiz_member WHERE token='$token'");
        return $data;
    }
	function search_username($username) {
		list($data)=$this->db->query_data("SELECT * FROM quiz_member WHERE username='$username'");
		return $data;
	} 
	function search_username_by_email($email) {
		list($data)=$this->db->query_data(" SELECT * FROM quiz_member WHERE email='$email' ");
		return $data;
	} 
	
	function request_reset($email,$from='web') {
		$data=$this->search_username_by_email($email);
		if($data['id']>0) {
			$waktu=date("Y-m-d h:i:s");
			$stamp=md5($waktu.$email.uniqid());
			$update_kode=$this->db->query("UPDATE quiz_member SET kode_reset='$stamp',request_reset='$waktu',reset_from='$from' WHERE email='$email'");
			if($from=='apps') {
			$send_email=$this->send_email_reset_apps($data['fullname'],$stamp,$email);
			} else {
			$send_email=$this->send_email_reset($data['fullname'],$stamp,$email);
			}

			return $send_email;
		} else {
			return 0;
		}
	}
	function mail_content_reset() {
		return '
		Hai $fullname,
		Silahkan klik link berikut untuk melakukan reset password anda: 
		$link_reset
		';
	}

	function send_email_reset($fullname,$stamp,$email) {
		$mail_content_reset=$this->mail_content_reset();
		$value_code_reset=fronturl("siswa/reset_password/$stamp");
		$mail_content_reset=str_replace('$link_reset',$value_code_reset,$mail_content_reset);
		$mail_content_reset=str_replace('$fullname',$fullname,$mail_content_reset);
	
		return $this->send_email($email,"Reset Password",$mail_content_reset);			
	}
	function send_email_reset_apps($fullname,$stamp,$email) {
    		$mail_content_reset=$this->mail_content_reset();
    		$value_code_reset=fronturl("app_reset_password/$stamp");
    		$mail_content_reset=str_replace('$link_reset',$value_code_reset,$mail_content_reset);
    		$mail_content_reset=str_replace('$fullname',$fullname,$mail_content_reset);

    		return $this->send_email($email,"Reset Password",$mail_content_reset);
    	}

	function is_request_reset($stamp) {
		$hari_ini=date("Y-m-d H:i:s");
		$cek=$this->db->query("SELECT * FROM quiz_member WHERE kode_reset='$stamp' AND request_reset < DATE_ADD('$hari_ini', INTERVAL 1 DAY) ");
		if($cek AND $this->db->num_rows($cek)>0 ) {
			return 1;
		} else {
			return 0;
		}
	}
	function get_data_member($stamp) {
		$hari_ini=date("Y-m-d H:i:s");
		$cek=$this->db->query("SELECT * FROM quiz_member WHERE kode_reset='$stamp' AND request_reset < DATE_ADD('$hari_ini', INTERVAL 1 DAY) ");
		if($cek AND $this->db->num_rows($cek)>0 ) {
			return $this->db->fetch_assoc($cek);
		} else {
			return 0;
		}
	}
	function renew_password($password,$email) {
		$password=md5("quizroom_".$password);
		$update_password=$this->db->query("UPDATE quiz_member SET kode_reset='',request_reset='',password='$password' WHERE email='$email'");
		return $update_password;
	}
    function set_token($token,$id) {
      
        $update_token=$this->db->query("UPDATE quiz_member SET token='$token',WHERE id='$id'");
        return $update_token;
    }

	function send_email($emailto,$subject,$message,$emailfrom="",$namefrom="",$attach=array())
	{
	   // var_dump("$emailto,$subject,$message,$emailfrom,$namefrom");
	
/*	
    $headers = 'From: noreply@wifiukai.com'       . "\r\n" .
                 'Reply-To: noreply@wifiukai.com' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

    return mail($emailto, $subject, $message, $headers);
    die();
*/    


		b_load_lib("class.smtp");
		b_load_lib("class.phpmailer");
		b_load_lib("class.verifyEmail");
		
		//kirim email
		$mail = new PHPMailer();
		
		// setting
		
        $mail->IsSMTP();  // send via SMTP
        $mail->Mailer = "mail";
        $mail->SMTPSecure = "ssl";
        $mail->SMTPDebug = 2;
            
        $mail->SetLanguage("en");

		/*
			mail.bizkit.id
			SMTP Port: 465 
			email: noreply@bizkit.id
			pass: X[o_R-bnxnfb
		*/

        $mail->Host     = "mail.bizkit.id"; // SMTP servers 25/587 / POP 110
        $mail->Port     = "465"; // SMTP servers 25/587 / POP 110
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "noreply@bizkit.id";  // SMTP username
        $mail->Password = "X[o_R-bnxnfb"; // SMTP password
        
        /*
        $mail->IsSMTP();  // send via SMTP
        $mail->Mailer = "mail";
        $mail->SMTPSecure = "tls";
        $mail->SMTPDebug = 2;
            
        $mail->SetLanguage("en");
        $mail->Host     = "smtp.gmail.com"; // SMTP servers 25/587 / POP 110
        $mail->Port     = "587"; // SMTP servers 25/587 / POP 110
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "wifiukai@gmail.com";  // SMTP username
        $mail->Password = "Berjaya23"; // SMTP password
      */
		
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
