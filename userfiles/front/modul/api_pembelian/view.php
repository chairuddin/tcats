<?php
if($action=='riwayat') {
   
    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
    
    $userid=$post['userid'];
    $data=$mysql->sql_get_assoc(" SELECT id,title,subtitle,FORMAT(total,0,'id_ID') total,category_id,is_paid FROM app_order o WHERE member_id=$userid ORDER BY id desc" );

    header('Content-type: application/json');
    echo json_encode($data);
    
}
if($action=='insert') {
   
    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
    
    if($post['token']!='') {
        $token=$post['token'];
        $userid=$mysql->get1value("SELECT id FROM quiz_member WHERE md5(token)=md5('$token')");
    } else {
        $userid=$post['userid'];
    }
    
    $payment = $post['payment'];//belum ada, apakah dikirim dari apps?
    
    $product_id=$post['product_id'];
    
    list($category_id,$price,$time_limit,$title,$subtitle,$content)=$mysql->fetch_row($mysql->query("SELECT category_id,price,time_limit,title,subtitle,content FROM app_product WHERE id=$product_id "));
    
    $content = addslashes($content);
    
    
    $waktu=date('Y-m-d H:i:s');
    $tanggal=date('Y-m-d');
    
    $data=array();
    
    //cek if exist order in same date
    $q_exist=$mysql->query("SELECT id FROM app_order WHERE member_id='$userid' and date_format(created_date,'%Y-%m-%d')='$tanggal' AND product_id='$product_id' ");
    if($mysql->num_rows($q_exist)>0 ) {
        
        list($order_id)=$mysql->fetch_row($q_exist);
        $data['order_id']=$order_id;
        if( $data['order_id']>0 ) {
            $data['md5']=md5($order_id);
            $data['success']="1";
        } else {
            $data['success']="0";
        }
        
    } else {
        $sql="
            INSERT INTO
                app_order
            SET
                member_id='$userid',
                product_id='$product_id',
                category_id='$category_id',
                created_date='$waktu',
                subtotal='$price',
                time_limit='$time_limit',
                title='$title',
                subtitle='$subtitle',
                content='$content'
            
        ";
        
        $q=$mysql->query($sql);
        
        $last_id=$mysql->insert_id();
        
        $subtotal=$price;
		$unique_nominal=$last_id%900;
		$total=$subtotal+$unique_nominal;
		if($subtotal<=0) {
		 $now=date("Y-m-d H:i:s");
         $currentDate = new DateTime(date("Y-m-d"));
         // Add  month limit to the current date
         $currentDate->modify('+'.$time_limit.' months');
        // Store the new date in a variable
         $expired_date = $currentDate->format('Y-m-d');
    
		 $update_total=$mysql->query("UPDATE app_order SET unique_nominal='0',total='0',is_paid=1,payment_date='$now',expired_date='$expired_date' WHERE id=$last_id ");
		} else {
		 $update_total=$mysql->query("UPDATE app_order SET unique_nominal='$unique_nominal',total='$total' WHERE id=$last_id ");   
		}
		
	
		
        //$sql="SELECT category_id,price,time_limit FROM app_product WHERE product_id=$product_id ";
        
        
        $data['order_id']=$last_id;
        $data['md5']=md5($data['order_id']);
        if( $data['order_id']>0 ) {
            $data['success']="1";
            $data['total']=$total;
           
        } else {
            $data['success']="0";
        }
    }
    //
    
  
    //$data['sql']=$sql;
    
    header('Content-type: application/json');
    echo json_encode($data);
}
die();
?>