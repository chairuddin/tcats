<?php
die('a');
    $kirim_link=false;
    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
    $nama = cleanInput($post['nama']);
    $wa = cleanInput($post['wa']);
    $email= cleanInput($post['email']);
    $password= $post['password'];
    $valid=true;
    if($nama=='' || $wa=='' || $email == '' || $password=='') {
        $valid=false;
        $msg='Masih ada isian yang kosong';
    }

    //cek jika email sudah terdaftar tidak boleh register melainkan coba klik lupa password
    $aktif=$mysql->get1value("SELECT id FROM quiz_member WHERE username='$email'");
    if($aktif) {
        $valid=false;
        $msg='User anda telah terdaftar silakan klik lupa password';
    }

    //cek jika email sudah terdaftar namun belum melakukan aktivasi
    $id_register=$mysql->get1value("SELECT id FROM app_register WHERE email='$email'");
    if($id_register and !$aktif) {
        $kirim_link=true;
        $valid=false;
        $msg='User telah terdaftar silakan cek email anda dan klik link aktivasi';
    }

  
    if($valid) {
        $kirim_link=true;
        $waktu=date("Y-m-d H:i:s");
        $password=md5("quizroom_".$password);
        $q=$mysql->query("INSERT INTO app_register SET nama='$nama', wa='$wa', email='$email',password='$password',created_date='$waktu' ");
        $id_register = $mysql->insert_id();
    }

    if($kirim_link) {
        b_load_lib('LoginApp');
        $login = new Login();
        $stamp = md5('aktivasi_'.$id_register);
        $login->send_email_aktivasi($nama,$stamp,$email);
    }
    
    if($valid && $id_register>0) {
        $data=array(
                'success'=>1,
                'msg'=>'Pendaftaran berhasil silakan cek email anda dan klik link aktivasi'
                );
    } else {
        $data=array(
            'success'=>0,
            'msg'=>$msg
            );
    }

    header('Content-type: application/json');
    echo json_encode($data);
    die();
?>