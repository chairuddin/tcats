<?php
$auth_data=check_session();
/*
$url_decoration='https://wifiukai.com/cbt/userfiles/file/quiz/app_decoration';
$data=array();
$r_asset=$mysql->sql_get_assoc(" SELECT concat(basename,'.',extension) image,type,caption  FROM app_decoration ");
$slide_show=array();

//	$apps_url=fileurl("app_decoration");

foreach($r_asset as $i => $image) {
	if($image['type']=='slide')  {
		$slide_show['slideshow'][$url_decoration."/".$image['image']]=$image['caption'];
	}
	if($image['type']=='logo')  {
		$slide_show['logo']=$url_decoration."/".$image['image'];
	}
}


$image_default="default.jpeg";

$category=$mysql->sql_get_assoc(" SELECT id,title,grup FROM app_category  WHERE publish=1");
$category_default_selected=$_GET['category']==''?md5($category[0]['id']):cleanInput($_GET['category'],'number');
$category_name_selected=$mysql->get1value("SELECT title FROM app_category WHERE md5(md5(id))='".md5($category_default_selected)."'");
*/

//$courses=$mysql->sql_get_assoc(" SELECT id,title  FROM app_course WHERE md5(md5(category_id))='".md5($category_default_selected)."'");

$course_id_md5=md5($action);
$keyword = cleanInput($_GET['keyword']);
$sql_search='';
if($keyword!="") {
	$sql_search=" AND title like '%$keyword%' ";
}

$course_sub=$mysql->sql_get_assoc(" SELECT id,title,course_id,if(LENGTH(image)<=0,'$image_default',concat('$fileurl/app_course_sub/',image)) image,is_free FROM app_course_sub WHERE md5(md5(course_id)) = '$course_id_md5' AND publish=1 $sql_search");



?>