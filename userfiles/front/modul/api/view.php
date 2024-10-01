<?php
if($action=='firebase_is_exist') {
   
    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
//    $token=cleanInput($post['token']);
  //  $user_id=$mysql->get1value("SELECT id FROM quiz_member WHERE token='$token' AND token<>'' ");
    //$post['category']=1;
//    $data=array();
    
    $name = cleanInput($post['name']);
    $email = cleanInput($post['email']);
    $provider = cleanInput($post['provider']);
    $picture = cleanInput($post['picture']);
    
    $now= date("Y-m-d H:i:s");
    $is_new=1;
    
    $data=array();
    $sql="SELECT id FROM quiz_member WHERE email='$email' and email<>''";
    $member_id=$mysql->get1value("SELECT id FROM quiz_member WHERE email='$email' and email<>''");
  
    //cek apakah member sudah terdaftar sebelumnya
    $quiz_member_id=$mysql->get1value("SELECT id FROM quiz_member WHERE email='$email' ");
    
    //cek email terdaftar di firebase auth
    $q=$mysql->query("SELECT * FROM app_firebase_auth WHERE email='$email' AND provider='$provider'");
    
    if($q and $mysql->num_rows($q)>0) {
    //firebase terdaftar
        if($quiz_member_id>0) {
             $is_new=0;
            //member sudah terdaftar langsung login saja
             
        }    
    
    } else {
    //firebase baru
    //insert dulu, nanti update member_id setelah mengisi form isi nama.
    $insert_firebase_auth = $mysql->query("INSERT INTO app_firebase_auth SET name='$name',email='$email',provider='$provider',picture='$picture',member_id='0',created_date='$now' ");
   
    }
    
    
    $data['sql']=$sql;
    $data['is_new']=$is_new;
    $data['email']=$email;
    $data['member_id']=$member_id;
    
    
    header('Content-type: application/json');
    echo json_encode($data);
}
if($action=='firebase_daftar') {
   /*
    $json_data= file_get_contents('php://input');
    
    $nama = cleanInput($post['nama']);
    $provider = cleanInput($post['provider']);
    $wa = cleanInput($post['wa']);
    $email= cleanInput($post['email']);
    $password= $post['password'];
    $password=md5("quizroom_".$password);
    $valid=true;
    
    if($nama=='' || $wa=='' || $email == '' || $password=='') {
        $valid=false;
        $msg='Masih ada isian yang kosong';
    }
    
    $now= date("Y-m-d H:i:s");
    
    $picture=$mysql->get1value(" SELECT picture FROM app_firebase_auth WHERE email='$email' and picture<>'' ORDER BY id desc limit 1");
    
    $register_to_quiz_member=$mysql->query("
        INSERT INTO quiz_member SET
        username='$email',
        password='$password',
        class='APPS',
        fullname='$nama',
        created_date='$now',
        status='1',
        email='$email',
        wa='$wa'
        ".($picture!=''?",picture_url='$picture'":'')."
       
    ");
    $sql="
        INSERT INTO quiz_member SET
        username='$email',
        password='$password',
        class='APPS',
        fullname='$nama',
        created_date='$now',
        status='1',
        email='$email',
        wa='$wa'
        ".($picture!=''?",picture_url='$picture'":'')."
       
    ";
    
    $member_id=$mysql->insert_id();
    $update_firebase_auth = $mysql->query("
        UPDATE app_firebase_auth SET member_id='$member_id' WHERE email='$email' 
    ");
    
    if($register_to_quiz_member or $update_firebase_auth) {
        $valid=false;
        $msg='Gagal registrasi, silakan cek data anda #1';
    }
    
    if($valid) {
        $msg='Berhasil';
        $msg=$sql;
        $data=array(
            'success'=>1,
            'msg'=>$msg
        );
    
    } else {
        $data=array(
            'success'=>0,
            'msg'=>$msg
        ); 
    }
    
    header('Content-type: application/json');
    echo json_encode($data);
    */
}
if($action=='info_product') {
   
    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
    $token=cleanInput($post['token']);
    $user_id=$mysql->get1value("SELECT id FROM quiz_member WHERE token='$token' AND token<>'' ");
   // $post['category']=1;
    $data=array();
    
    $image_default=fileurl("app_asset/education.png");
    
    $now=date("Y-m-d");
    $data['token']=$token;
    $data['product']=$mysql->sql_get_assoc("
    SELECT
        a.id,
        a.title,
        a.subtitle,
        a.category_id,
        if(LENGTH(a.image)<=0,'$image_default',a.image) image,
        concat('Rp ',FORMAT(a.price, 0,'id_ID')) price,
        concat('Rp ',FORMAT(a.price_promo, 0,'id_ID')) price_promo,
        a.content,
        a.content_short,
        IFNULL(o.product_id,'') order_product_id,
        IFNULL( o.is_paid,0) is_paid
        FROM
        app_product a
        LEFT JOIN
        app_order o ON (a.id=o.product_id AND o.member_id=$user_id AND o.expired_date>'$now' )
        WHERE
        a.category_id IN (SELECT id FROM app_category  WHERE publish=1)
        AND
        a.publish=1
        GROUP BY a.id
        ORDER BY a.title
        
    ");


    header('Content-type: application/json');
    echo json_encode($data);
}
if($action=='info_course') {
   
    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
   // $post['category']=1;
    $data=array();
   
    $image_default=fileurl("app_asset/book.png");
    
    $data['course']=$mysql->sql_get_assoc(" SELECT id,title,category_id,'$image_default' image FROM app_course WHERE category_id=".$post['category']);
    
    $data['course_qty']=strval(count($data['course']));
    $data['course_sub']=$mysql->sql_get_assoc(" SELECT id,title,course_id,if(LENGTH(image)<=0,'$image_default',image) image,is_free FROM app_course_sub WHERE course_id IN (SELECT id FROM app_course WHERE category_id=".$post['category'].")");

    
    header('Content-type: application/json');
    echo json_encode($data);
}
if($action=='info_awal') {
    $apps_url_decoration=fileurl("app_decoration");
	$data=array();
	$r_asset=$mysql->sql_get_assoc(" SELECT concat(basename,'.',extension) image,type,caption  FROM app_decoration ");
	$data['slideshow']=array();
	$path_decoration=filepath("app_decoration");
	$url_decoration=fileurl("app_decoration");

//	$apps_url=fileurl("app_decoration");

	foreach($r_asset as $i => $image) {
		if($image['type']=='slide')  {
			$data['slideshow'][$apps_url_decoration."/".$image['image']]=$image['caption'];
		}
		if($image['type']=='logo')  {
			$data['logo']=$apps_url_decoration."/".$image['image'];
		}
	}
	
	$data['product']=$mysql->sql_get_assoc(" SELECT id,title,category_id,price,price_promo,content_short FROM app_product WHERE category_id IN (SELECT id FROM app_category  WHERE publish=1) ");
	$data['category']=$mysql->sql_get_assoc(" SELECT id,title,grup FROM app_category  WHERE publish=1");
    $data['category_default_selected']=$data['category'][0];
   
   
    
   // $data['course']=$mysql->sql_get_assoc(" SELECT id,title,category_id FROM app_course WHERE category_id=".$data['category_default_selected']['id']);
    
    $data['app_version_update']='1';
    
	header('Content-type: application/json');
	echo json_encode($data);
}

$data=array();

if($action=="login") {
  
    b_load_lib("Login");
    $login = new Login();
    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
   // $post['username']='08179388230';
    //$post['password']='08179388230';
    $user_id=$login->dologin($post['username'],$post['password']);
    
    if($user_id>0) {
     $token=md5($user_id."-".uniqid());
     $login->set_token($token,$user_id);
     
     $update_token=$mysql->query("UPDATE quiz_member SET token='$token' WHERE id=$user_id");
        
    $user_data=$login->search_user_by_id($user_id);
        
     $data=array(
     'success'=>1,
     'msg' =>'Success',
     'token'=> $user_data['token'],
     'userid'=> $user_data['id'],
     'username'=>  $user_data['username'],
     'name'=> $user_data['fullname'],
     'picture'=> $user_data['picture_url'],
     'lastLogin'=> date("Y-m-d H:i:s"),
     'email'=> $user_data['email']);
    } else {
        
    $data=array(
     'success'=>0,
     'username'=>$post['username'],
     'msg'=>'Username atau Password salah',
     'post'=>"$json_data = $user_id",
     );
        
    }
    header('Content-Type: application/json');
    echo json_encode($data);
}

if($action=='info_point') {
    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
    $xp="20 xp";
    $coin="10";
    $diamond="10";
    $progress=0.01;
    $point=array(
        'xp' => $xp,
        'coin' => $coin,
        'diamond' =>$diamond,
        'progress' =>$progress,
        'userid'=>$post['userid'],
    );
    header('Content-Type: application/json');
    echo json_encode($point);
    
    
}
if($action=="checktoken") {
  
    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
    b_load_lib("Login");
    $login = new Login();
    $user_data=$login->search_user_by_token($post['token']);
    if($user_data['id']!="" and $post['token']!="") {
    
     $data=array(
     'success'=>1,
     'msg' =>'Success',
     'token'=> $user_data['token'],
     'userid'=> $user_data['id'],
     'username'=>  $user_data['username'],
     'name'=> $user_data['fullname'],
     'lastLogin'=> date("Y-m-d H:i:s"),
     'email'=> $user_data['email']);
    } else {
        
    $data=array(
     'success'=>0,
     'username'=>$post['username'],
     'msg'=>'Token salah',
     'post'=>$json_data,
     );
        
    }
    header('Content-Type: application/json');
    echo json_encode($data);
}

/*

if($action=='firebase_is_exist') {
    
    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
    b_load_lib("Login");
    $login = new Login();
    $user_data=$login->search_user_by_email($post['email']);
    
    if($user_data['id']!="") {
    
     $data=array(
     'success'=>1,
     'msg' =>'Success',
     'token'=> $user_data['token'],
     'userid'=> $user_data['id'],
     'username'=>  $user_data['username'],
     'name'=> $user_data['fullname'],
     'lastLogin'=> date("Y-m-d H:i:s"),
     'email'=> $user_data['email']);
    } else {
        
    $data=array(
     'success'=>0,
     'username'=>$post['username'],
     'msg'=>'Token salah',
     'post'=>$json_data,
     );
        
    }
    header('Content-Type: application/json');
    echo json_encode($data);
}
*/
if($action=="login_firebase") {
  
    b_load_lib("Login");
    $login = new Login();
    $json_data= file_get_contents('php://input');
    $post=json_decode($json_data,true);
   // $post['username']='08179388230';
    //$post['password']='08179388230';
    $email=$post['username'];
    $user_id=0;
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $user_id=$mysql->get1value("SELECT id FROM quiz_member WHERE email='$email' and email<>'' ");
    }
    if($user_id>0) {
     $token=md5($user_id."-".uniqid());
     $login->set_token($token,$user_id);
     
     $update_token=$mysql->query("UPDATE quiz_member SET token='$token' WHERE id=$user_id");
        
    $user_data=$login->search_user_by_id($user_id);
        
     $data=array(
     'success'=>1,
     'msg' =>'Success',
     'token'=> $user_data['token'],
     'userid'=> $user_data['id'],
     'username'=>  $user_data['username'],
     'name'=> $user_data['fullname'],
     'lastLogin'=> date("Y-m-d H:i:s"),
     'email'=> $user_data['email'],
     'picture'=>$user_data['picture_url']
     );
    } else {
        
    $data=array(
     'success'=>0,
     'username'=>$post['username'],
     'msg'=>'Username atau Password salah',
     'post'=>"SELECT id FROM quiz_member WHERE email='$email' and email<>'' ",
     );
        
    }
    header('Content-Type: application/json');
    echo json_encode($data);
}

die();
?>
