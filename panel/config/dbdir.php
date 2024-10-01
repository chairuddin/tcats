<?php

require_once  __DIR__."/../../configuration.php";

$host[$_SERVER['HTTP_HOST']]=array(
"db_host"=>$db_host,
"db_user"=>$db_user,
"db_pass"=>$db_pass,
"db_name"=>$db_name,
"dir"=>"quiz",
"online"=>"1",
"memcached"=>"0"
);

?>
