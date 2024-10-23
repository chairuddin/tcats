<?php
    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
    $email = cleanInput($post['email']);
    $data=array(
      'success'=>0,
      'msg'=>'Gagal reset password'
      );
  // $email='roemly@gmail.com';
    $valid=true;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid=false;
        $msg = 'Format email salah';
    }

    $aktif=$mysql->get1value("SELECT id FROM user WHERE email='$email'");

    if($valid && $aktif>0) {

            if($email!="") {
            	b_load_lib('LoginAdmin');
            	$email=cleanInput($email);
            	$login = new Login();

            	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            		$msg = 'Email tidak valid';
            	} else {
            		$request=$login->request_reset($email,'apps');
            		if($request) {
                        
            		} else {
            			$data['success']==1?'':$data['success'];
            		}
            	}

            }

            $data=array(
            'success'=>1,
            'msg'=>'Berhasil reset password, silakan cek email anda.'
            );
    } else {
            $data=array(
            'success'=>0,
            'msg'=>'Gagal reset password'
            );
    }



    header('Content-type: application/json');
    echo json_encode($data);
    die();

?>