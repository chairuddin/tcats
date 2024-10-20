
<?php
if($action=="view") {
    $id=cleanInput($id);
    $is_subscribe=1;
    //list($quiz_done)=$mysql->sql_get_assoc(" SELECT * FROM app_quiz_done WHERE course_material_id='$course_material_id' AND is_void=0 AND member_id=".$auth_data['id']);
    list($quiz_done)=$mysql->sql_get_assoc(" SELECT * FROM app_quiz_done WHERE md5(md5(id))='".md5($id)."' ");
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
}
if($action=="") {
    //periode data ujian
    $_REQUEST['date1']=$_REQUEST['date1']==""?date("01/m/Y"):$_REQUEST['date1'];
    $_REQUEST['date2']=$_REQUEST['date2']==""?date("d/m/Y"):$_REQUEST['date2'];
    $material_id=cleanInput($_REQUEST['material_id']);
    
    list($xd,$xm,$xy)=explode("/",$_REQUEST['date1']);
	$date1="$xy-$xm-$xd";
	
	list($xd,$xm,$xy)=explode("/",$_REQUEST['date2']);
	$date2="$xy-$xm-$xd";
	
    $sql_periode_data_ujian="
    SELECT 
    q.*,
    (sum(kd.score)/count(kd.id_quiz_done)) avg_score
    FROM 
    app_quiz_done q
    LEFT JOIN app_course_material m ON q.course_material_id=m.id
    LEFT JOIN app_quiz_done_kd kd on kd.id_quiz_done=q.id
    WHERE 
    date_format(q.start_time,'%Y-%m-%d') 
    BETWEEN '$date1' 
    AND '$date2' 
    AND q.course_material_id=$material_id
    AND m.quiz_type='posttest'
    AND q.is_void=0
    GROUP BY q.id
    ";

    //die($sql_periode_data_ujian);
    $periode_data_ujian=$mysql->sql_get_assoc($sql_periode_data_ujian);

    //var_dump( $periode_data_ujian);
    //10 ujian terakhir

}


?>