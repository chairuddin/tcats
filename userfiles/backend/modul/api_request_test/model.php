<?php

    $request_id = cleanInput($_POST['request_id']);
    $mode = cleanInput($_POST['mode']);
    $data=array(
      'success'=>0,
      'msg'=>' Request gagal #1 '
      );
  
    $now=date("Y-m-d H:i:s");
    $sql_r=array();
    if($mode=='accept'){
        $sql_r[]="approved_by=$id_user";
        $sql_r[]="approved_at='$now'";
    }

    if($mode=='deny'){
        $sql_r[]="disapprove_by=$id_user";
        $sql_r[]="disapprove_at='$now'";
    }
    
    $join_sql=join(",",$sql_r);
    $q_update = $mysql->query("UPDATE app_quiz_request SET $join_sql WHERE id=$request_id");
    if($q_update) {
        if($mode=='accept') {
            $quiz_done_id=$mysql->get1value("SELECT quiz_done_id FROM app_quiz_request WHERE id=$request_id");
            $void_ujian=$mysql->query("UPDATE app_quiz_done SET course_material_id_void=course_material_id,is_void=1,token=concat('void_',token),course_material_id=0 WHERE id=$quiz_done_id");
        }
        $data=array(
            'success'=>1,
            'msg'=>'Request berhasil'
            );
    } else {
        $data=array(
            'success'=>0,
            'msg'=>'Request gagal #2'
            );
    }
    



    header('Content-type: application/json');
    echo json_encode($data);
    die();

?>