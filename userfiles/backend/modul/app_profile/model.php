<?php
if($action=="view") {
$member_id=cleanInput($id);
$username=$mysql->get1value("SELECT username FROM quiz_member WHERE md5(md5(md5(id)))='".md5($member_id)."' ");

$sql="
SELECT * FROM (
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
	
UNION ALL 

SELECT concat('x-',id) id,0 score_master,kkm_total kkm,0 quiz_id,jadwal end_time,kompetensi title,0 material_id FROM app_competency_excel WHERE indeks='$username'
) x ORDER BY x.end_time DESC

";

b_load_lib('Paginator');
$limit =$mysql->get1value("SELECT title_id FROM web_config WHERE name='profile_pagination' ");

$limit = ($limit=="" or $limit<=0)?1:$limit;
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
	if (preg_match('/x-(\d+)/', $done['id'], $matches)) {
    //dari excel
	$excel_id = $matches[1]; // Ambil angka setelah "x-"
	//belum selesai
	$avg_score=$mysql->get1value(" SELECT avg(nilai) FROM app_competency_excel_detail WHERE competency_excel_id ='".$excel_id."' ");
	$quiz_done[$i]['avg_score']=$avg_score;
	$quiz_done[$i]['md5_quiz_done_id']="x_".md5($done['id']);
	
	
	} else {
		$avg_score=$mysql->get1value(" SELECT avg(score) FROM app_quiz_done_kd WHERE id_quiz_done ='".$done['id']."' ");
		$quiz_done[$i]['avg_score']=$avg_score;
		$quiz_done[$i]['md5_quiz_done_id']=md5($done['id']);
	}
	
/*
    $avg_score=$mysql->get1value(" SELECT avg(score) FROM app_quiz_done_kd WHERE id_quiz_done ='".$done['id']."' ");
    $quiz_done[$i]['avg_score']=$avg_score;
    $quiz_done[$i]['md5_quiz_done_id']=md5($done['id']);
*/
	
}

list($user)=$mysql->sql_get_assoc(" SELECT username,email,fullname,organization_unit_code,organization_unit,position_code,position,direct_supervisor_indeks,direct_supervisor_name,2nd_supervisor_indeks,2nd_supervisor_name,manager_indeks,manager_name FROM quiz_member WHERE  md5(md5(md5(id)))='".md5($member_id)."'");
$email=$user['email'];
$fullname=$user['fullname'];
$jurusan=$user['jurusan'];
$username=$user['username'];
$organization_unit_code=$user['organization_unit_code'];
$organization_unit_code=$user['organization_unit_code'];
$organization_unit=$user['organization_unit'];
$position_code=$user['position_code'];
$position=$user['position'];
$direct_supervisor_indeks=$user['direct_supervisor_indeks'];
$direct_supervisor_name=$user['direct_supervisor_name'];
$second_supervisor_indeks=$user['2nd_supervisor_indeks'];
$second_supervisor_name=$user['2nd_supervisor_name'];
$manager_indeks=$user['manager_indeks'];
$manager_name=$user['manager_name'];



}
?>