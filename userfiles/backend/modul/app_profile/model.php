<?php
if($action=="view") {
$member_id=cleanInput($id);
$sql="
SELECT
    d.id,d.score_master,d.kkm,d.quiz_id,d.end_time,s.title,m.id material_id 
FROM
    app_quiz_done d 
LEFT JOIN 
    app_course_material m ON d.course_material_id=m.id
LEFT JOIN 
    app_course_sub s ON s.id=m.course_sub_id
WHERE md5(md5(md5(d.member_id)))='".md5($member_id)."'
    AND m.quiz_type='posttest' 
    AND is_void=0
    AND is_done=1
ORDER BY d.end_time DESC

";

b_load_lib('Paginator');
$limit = 3;
$paginator = new Paginator($mysql, $sql, $limit);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$paginator->setPage($page);
$data = $paginator->getData();
$quiz_done=array();
while($row = $data->fetch_assoc()) {
    $quiz_done[]=$row;
}
//$quiz_done=$mysql->sql_get_assoc($sql);



foreach($quiz_done as $i => $done) { 
    $avg_score=$mysql->get1value(" SELECT avg(score) FROM app_quiz_done_kd WHERE id_quiz_done ='".$done['id']."' ");
    $quiz_done[$i]['avg_score']=$avg_score;
    $quiz_done[$i]['md5_quiz_done_id']=md5($done['id']);
}

list($user)=$mysql->sql_get_assoc(" SELECT username,email,fullname,jurusan FROM quiz_member WHERE id=$member_id");
$email=$user['email'];
$fullname=$user['fullname'];
$jurusan=$user['jurusan'];
$username=$user['username'];



}
?>