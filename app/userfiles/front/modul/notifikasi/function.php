<?php
$auth_data=check_session();
$userid=$auth_data['id'];
$data=$mysql->sql_get_assoc(" SELECT id,title,subtitle FROM app_notifikasi  WHERE member_id=$userid ORDER BY id desc limit 20");

?>