<?php
$r_category=$mysql->sql_get_assoc(" SELECT id,title,grup FROM app_category  WHERE publish=1");
$category=array();
$sub_category=array();
foreach($r_category as $i =>$data) {
    $category[$data['grup']]=1;
    $sub_category[$data['grup']][]=array('id'=>$data['id'],'title'=>$data['title']);
}
?>