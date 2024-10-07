<?php
$auth_data=check_session();
$email=$auth_data['email'];
$fullname=$auth_data['fullname'];
$jurusan=$auth_data['jurusan'];




if($action=="") {
    $member_id=$auth_data['id'];
} 
if($action!="") {
    $action=md5(cleanInput($action));
    $member_id=$mysql->get1value("SELECT id FROM quiz_member WHERE md5(md5(md5(id)))='$action'");
}
$quiz_done=$mysql->sql_get_assoc("
SELECT
    d.id,d.score_master,d.kkm,d.quiz_id,d.end_time,s.title,m.id material_id 
FROM
    app_quiz_done d 
LEFT JOIN 
    app_course_material m ON d.course_material_id=m.id
LEFT JOIN 
    app_course_sub s ON s.id=m.course_sub_id
WHERE d.member_id='".$member_id."'
    AND m.quiz_type='posttest' 
    AND is_void=0
    AND is_done=1
ORDER BY d.end_time DESC

");



foreach($quiz_done as $i => $done) { 
    $avg_score=$mysql->get1value(" SELECT avg(score) FROM app_quiz_done_kd WHERE id_quiz_done ='".$done['id']."' ");
    $quiz_done[$i]['avg_score']=$avg_score;
    $quiz_done[$i]['md5_quiz_done_id']=md5($done['id']);
}

?>
