<?php

    $kirim_link=false;
    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
    $username = cleanInput($post['username']);
    $nama = cleanInput($post['nama']);
    $wa = cleanInput($post['wa']);
    $email= cleanInput($post['email']);
    $provider = cleanInput($post['provider']);
    $password= $post['password'];
    $valid=true;
    if($nama=='' || $wa=='' || $email == '' || $password=='') {
        $valid=false;
        $msg='Masih ada isian yang kosong';
    }
    if($provider!='') {
        //cek firebase
        $q=$mysql->query("SELECT id FROM app_firebase_auth WHERE provider='$provider' AND email='$email' ");
        if($q and $mysql->num_rows($q)>0) {
            $picture=$mysql->get1value(" SELECT picture FROM app_firebase_auth WHERE email='$email' and picture<>'' ORDER BY id desc limit 1");
            
            $now=date("Y-m-d H:i:s");
            $password=md5("quizroom_".$password);
            $register_to_quiz_member=$mysql->query("
                INSERT INTO quiz_member SET
                username='$username',
                password='$password',
                class='APPS',
                fullname='$nama',
                created_date='$now',
                status='1',
                email='$email',
                wa='$wa'
                ".($picture!=''?",picture_url='$picture'":'')."
                ");
            $member_id = $mysql->insert_id();    
            if( !$register_to_quiz_member) {
                $valid=false;
                $msg='Gagal simpan data #1';
            }  else {
                //update firebase id_member
                $update_id_member=$mysql->query("UPDATE app_firebase_auth SET member_id=$member_id WHERE provider='$provider' AND email='$email' ");
                if(!$update_id_member) {
                    $valid=false;
                    $msg='Gagal simpan data #2';
                }
                
            } 
                
        } else {
            //data belum ada silakan ulangi dari depan
            $valid=false;
            $msg='Login menggunakan '.$provider.' gagal #3';
        }
        
        if($valid && $member_id>0) {
        $data=array(
                'success'=>1,
                'msg'=>'Selamat registrasi telah berhasil'
                );
         } else {
            $data=array(
                'success'=>0,
                'msg'=>$msg
                );
        }
    } else {
        //cek jika username sudah terdaftar tidak boleh register melainkan coba klik lupa password
        $aktif=$mysql->get1value("SELECT id FROM quiz_member WHERE username='$username'");
        if($aktif) {
            $valid=false;
            $msg='Indeks/KIT anda telah terdaftar silakan klik lupa password';
        }

         //cek jika email sudah terdaftar tidak boleh register melainkan coba klik lupa password
         if($aktif) {
            $aktif=$mysql->get1value("SELECT id FROM quiz_member WHERE email='$email'");
            if($aktif) {
                $valid=false;
                $msg='Email anda telah terdaftar silakan klik lupa password';
            }
        }
    
        //cek jika email sudah terdaftar namun belum melakukan aktivasi
        $id_register=$mysql->get1value("SELECT id FROM app_register WHERE email='$email' OR username='$username'");
        if($id_register and !$aktif) {
            $kirim_link=true;
            $valid=false;
            $msg='User telah terdaftar silakan cek email anda dan klik link aktivasi';
        }
    
      
        if($valid) {
            $kirim_link=true;
            $waktu=date("Y-m-d H:i:s");
            $password=md5("quizroom_".$password);
            $q=$mysql->query("INSERT INTO app_register SET username='$username',  nama='$nama', wa='$wa', email='$email',password='$password',created_date='$waktu' ");
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
        
    }
    
    

    header('Content-type: application/json');
    echo json_encode($data);
    die();
?>