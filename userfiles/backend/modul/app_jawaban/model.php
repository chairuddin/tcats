
<?php
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
    (sum(kd.score)/count(kd.id_quiz_done)) avg_score,s.title kompetensi
    FROM 
    app_quiz_done q
    LEFT JOIN app_course_material m ON q.course_material_id=m.id
    LEFT JOIN app_course_sub s ON s.id=m.course_sub_id
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