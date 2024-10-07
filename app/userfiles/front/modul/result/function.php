<?php

$auth_data=check_session();
$quiz_done_id_md5=md5(cleanInput($action));
//$course_material_id_md5=md5(cleanInput($action));

$userid=$auth_data['id'];
$auth_token=$_COOKIE['qr_token'];

//$course_material_id=$mysql->get1value("SELECT id FROM app_course_material WHERE md5(md5(id))='$course_material_id_md5'");


//$course_sub_id=$mysql->get1value("SELECT course_sub_id FROM app_course_material WHERE id=$course_material_id");

//category

//cek apakan sudah berlangganan?
$now=date("Y-m-d");
//$order_id = $mysql->get1value("SELECT id FROM app_order WHERE member_id=$userid AND category_id=$category_id AND  expired_date>'$now'");

$is_subscribe=1;//$order_id>0?1:0;

//list($quiz_done)=$mysql->sql_get_assoc(" SELECT * FROM app_quiz_done WHERE course_material_id='$course_material_id' AND is_void=0 AND member_id=".$auth_data['id']);
list($quiz_done)=$mysql->sql_get_assoc(" SELECT * FROM app_quiz_done WHERE md5(md5(id))='$quiz_done_id_md5' ");
$course_material_id=$quiz_done['course_material_id'];
list($detail)=$mysql->sql_get_assoc(" SELECT id,title,content, quiz_id,video_name,quiz_type,video_url,video_embed_url,type,is_free,$is_subscribe is_subscribe FROM app_course_material WHERE id='$course_material_id'");



$quiz_done_kd = $mysql->sql_get_assoc("SELECT qd.nama_kd,qd.score,kd.score_max,kd.kkm FROM app_quiz_done_kd qd LEFT JOIN quiz_kd kd ON kd.id=qd.id_quiz_kd WHERE qd.id_quiz_done=".$quiz_done['id']." ORDER BY qd.id_quiz_kd");

$data_kd=array();
$nilai=1;
$r_join_code=array();
$r_join_score=array();
$r_join_treshold=array();
foreach($quiz_done_kd as $x =>$kd) {
    $data_kd[]=array('kode'=>'C'.$nilai,'nama'=>$kd['nama_kd'],'score'=>$kd['score'],'max'=>$kd['max'],'kkm'=>$kd['kkm']);
    $r_join_code[]='C'.$nilai;
    $r_join_score[]=$kd['score']+0;
    $r_join_treshold[]=$kd['kkm']+0;
    $nilai++;
}
$join_code='"'.join('","',$r_join_code).'"';
$join_score=join(",",$r_join_score);
$join_treshold=join(",",$r_join_treshold);

?>