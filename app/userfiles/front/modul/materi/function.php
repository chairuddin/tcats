<?php
$auth_data=check_session();
$course_sub_id_md5=md5(cleanInput($action));

$userid=$auth_data['id'];
$course_sub_id=$mysql->get1value("SELECT id FROM app_course_sub WHERE md5(md5(id))='$course_sub_id_md5'");
;
//category
$category_id=$mysql->get1value(" SELECT category_id FROM app_course WHERE id IN (SELECT course_id FROM app_course_sub WHERE md5(md5(id))='$course_sub_id_md5')");

//cek apakan sudah berlangganan?
$now=date("Y-m-d");
$order_id = $mysql->get1value("SELECT id FROM app_order WHERE member_id=$userid AND category_id=$category_id AND  expired_date>'$now'");

$is_subscribe=1;//$order_id>0?1:0;

$data=$mysql->sql_get_assoc(" SELECT id,title,content, quiz_id,video_name,video_url,type,is_free,$is_subscribe is_subscribe,$category_id category_id FROM app_course_material "); //WHERE course_sub_id='$course_sub_id'

?>