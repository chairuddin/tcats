<?php

    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);

    $data=array(
        'success'=>0,
        'msg'=>'Data tidak valid'
        );
    if($post['code']!='') {
        
        //cek firebase
        $md5_member_id=md5(cleanInput($post['code']));
        $q=$mysql->query("SELECT id FROM quiz_member WHERE md5(md5(md5(id))) = '$md5_member_id' ");
    
        
        if($q and $mysql->num_rows($q)>0) {
         $d=$mysql->fetch_assoc($q);
         $data=array(
                'success'=>1,
                'msg'=>'Ditemukan',
                'member_id'=>md5(md5($d['id']))
                );
         } else {
            $data=array(
                'success'=>0,
                'msg'=>'Data tidak ditemukan'
                );
        }
        
    }

    header('Content-type: application/json');
    echo json_encode($data);
    die();
?>