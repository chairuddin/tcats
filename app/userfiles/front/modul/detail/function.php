<?php

$auth_data=check_session();

$course_material_id_md5=md5(cleanInput($action));

$userid=$auth_data['id'];
$auth_token=$_COOKIE['qr_token'];

$course_material_id=$mysql->get1value("SELECT id FROM app_course_material WHERE md5(md5(id))='$course_material_id_md5'");


$course_sub_id=$mysql->get1value("SELECT course_sub_id FROM app_course_material WHERE id=$course_material_id");

//category

//cek apakan sudah berlangganan?
$now=date("Y-m-d");
//$order_id = $mysql->get1value("SELECT id FROM app_order WHERE member_id=$userid AND category_id=$category_id AND  expired_date>'$now'");

$is_subscribe=1;//$order_id>0?1:0;

list($detail)=$mysql->sql_get_assoc(" SELECT id,title,content, quiz_id,video_name,video_url,video_embed_url,type,is_free,$is_subscribe is_subscribe FROM app_course_material WHERE id='$course_material_id'");

?>