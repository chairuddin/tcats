<?php
if($action=='history') {
   
    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
    
    $userid=$post['userid'];
    $data=$mysql->sql_get_assoc(" SELECT id,title,subtitle FROM app_notifikasi  WHERE member_id=$userid ORDER BY id desc");

    header('Content-type: application/json');
    echo json_encode($data);
}
if($action=='last') {

    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
    $userid=$post['userid'];
    $data=$mysql->sql_get_assoc(" SELECT last_notifikasi FROM app_notifikasi_read  WHERE member_id=$userid");
    header('Content-type: application/json');
    echo json_encode($data);
}
if($action=='read') {

    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
    $userid=$post['userid'];
    $update=$mysql->query(" UPDATE app_notifikasi_read  SET last_notifikasi=(SELECT last_notifikasi FROM app_notifikasi_read  WHERE member_id=$userid) WHERE member_id=$userid");
    
    
    $data=$mysql->sql_get_assoc(" SELECT last_notifikasi FROM app_notifikasi_read  WHERE member_id=$userid");
    header('Content-type: application/json');
    echo json_encode($data);
    
}


die();
?>

