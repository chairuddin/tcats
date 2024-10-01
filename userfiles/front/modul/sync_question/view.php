<?php
ob_start();
$mid=$_GET['mid'];
if($action=="images"){
$daftar_gambar= scandir_soal($mid);
$data= base64_encode(json_encode($daftar_gambar));	
echo $data;
//echo json_encode($daftar_gambar);
}

if($action=="question"){
$data= base64_encode(json_encode(download_soal($mid)));	
echo $data;	
}
if($action=="master"){
$data= base64_encode(json_encode(list_soal($mid)));	
echo $data;	
}
if($action=="soal_id"){
$data= base64_encode(json_encode(list_soal_id()));	
echo $data;	
}
if($action=="jadwal"){
$data= base64_encode(json_encode(list_jadwal()));	
echo $data;	
}
if($action=="member"){
$data= base64_encode(json_encode(list_member()));	
echo $data;	
}

/*
$data1= json_decode(base64_decode($data),true);
*/
$t=ob_get_clean();
die($t);
?>
