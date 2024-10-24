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
    $md5_pretest_quiz_done_id=md5($pretest_exist);
}

$is_competent=0;
$posttest_exist=$mysql->get1value("SELECT id FROM app_quiz_done WHERE course_material_id=$posttest_id AND is_void=0 AND is_done=1 AND member_id=$userid");
if($posttest_exist>0) {
    //sudah mengerjakan
    //cek hasilnya lulus atau tidak
    
	$sql2="
	SELECT 
    q.*,
    (sum(kd.score)/count(kd.id_quiz_done)) avg_score,sub.title
    FROM 
    app_quiz_done q
    LEFT JOIN app_course_material m ON q.course_material_id=m.id
	LEFT JOIN app_course_sub sub ON sub.id=m.course_sub_id
    LEFT JOIN app_quiz_done_kd kd on kd.id_quiz_done=q.id
    WHERE 
    m.quiz_type='posttest'
    AND q.is_void=0
    AND q. course_material_id=$posttest_id
    AND q.member_id=$userid
    GROUP BY q.id
	";
    
    list($hasil_posttest)=$mysql->sql_get_assoc($sql2);

    if($hasil_posttest['avg_score']>=$hasil_posttest['kkm']) {
        $is_competent=1;
    }

    $posttest_done=1;
    $md5_posttest_quiz_done_id=md5($posttest_exist);

    $pengajuan_aktif=0;
    $course_material_id=$hasil_posttest['course_material_id'];
    $q_cek_pengajuan=$mysql->query(" SELECT id,member_id,course_material_id,quiz_done_id FROM app_quiz_request WHERE (approved_by=0 AND disapprove_by=0) AND quiz_done_id=".$posttest_exist." AND course_material_id=$course_material_id AND member_id=$userid");
    if($q_cek_pengajuan and $mysql->num_rows($q_cek_pengajuan)>0) {
        $pengajuan_aktif=1;
    }
}



?>