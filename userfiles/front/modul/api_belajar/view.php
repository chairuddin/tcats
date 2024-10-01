<?php
if($action=='material') {
  // sleep(5);

    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
    
    $userid=$post['userid'];
    $course_sub_id=$post['course_sub_id'];

    //category
    $category_id=$mysql->get1value(" SELECT category_id FROM app_course WHERE id IN (SELECT course_id FROM app_course_sub WHERE id='$course_sub_id')");

    //cek apakan sudah berlangganan?
    $now=date("Y-m-d");
    $order_id = $mysql->get1value("SELECT id FROM app_order WHERE member_id=$userid AND category_id=$category_id AND  expired_date>'$now'");
    $is_subscribe=$order_id>0?1:0;

    $data=$mysql->sql_get_assoc(" SELECT id,title,content, quiz_id,video_name,video_url,type,is_free,$is_subscribe is_subscribe,$category_id category_id FROM app_course_material WHERE course_sub_id='$course_sub_id'");
   // $data[0]['debug']="SELECT id FROM app_order WHERE member_id=$userid AND category_id=$category_id AND  expired_date>'$now'";
    header('Content-type: application/json');
    echo json_encode($data);
}

die();
?>