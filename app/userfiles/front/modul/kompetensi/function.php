<?php
$auth_data=check_session();
$course_sub_id_md5=md5(cleanInput($action));

$userid=$auth_data['id'];
$course_sub_id=$mysql->get1value("SELECT id FROM app_course_sub WHERE md5(md5(id))='$course_sub_id_md5'");

//$data=$mysql->sql_get_assoc(" SELECT id,title,content, quiz_id,video_name,video_url,type,is_free,$is_subscribe is_subscribe,$category_id category_id FROM app_course_material "); //WHERE course_sub_id='$course_sub_id'
list($course_sub_data)=$mysql->sql_get_assoc(" SELECT id,title,content,course_id,if(LENGTH(image)<=0,'$image_default',concat('$fileurl/app_course_sub/',image)) image,is_free FROM app_course_sub WHERE id=$course_sub_id");


$pretest_id=$mysql->get1value("SELECT id FROM app_course_material WHERE quiz_type='pretest' AND course_sub_id=$course_sub_id ");
$posttest_id=$mysql->get1value("SELECT id FROM app_course_material WHERE quiz_type='posttest' AND course_sub_id=$course_sub_id ");

$md5_pretest_id=md5($pretest_id);
$md5_posttest_id=md5($posttest_id);

$pretest_done=false;
$posttest_done=false;

//check if quiz already done
$pretest_exist=$mysql->get1value("SELECT id FROM app_quiz_done WHERE course_material_id=$pretest_id AND is_void=0 AND is_done=1 AND member_id=$userid");
if($pretest_exist>0) {
    //sudah mengerjakan
    $pretest_done=1;
}

$posttest_exist=$mysql->get1value("SELECT id FROM app_quiz_done WHERE course_material_id=$posttest_id AND is_void=0 AND is_done=1 AND member_id=$userid");
if($posttest_exist>0) {
    //sudah mengerjakan
    $posttest_done=1;
}



?>