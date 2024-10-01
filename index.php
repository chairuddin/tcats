<?php
session_start();
//header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
//die('a');
error_reporting(0);
include "panel/config/config.php";
include "panel/config/connect.php";
include "panel/config/function.php";

$config_user=$config['userdir']."/front/config.php";

if(file_exists("$config_user"))include "$config_user";
$file_url=fronturl("userfiles/file/".$_d['dir']);
$file_path=frontpath("userfiles/file/".$_d['dir']);
$app_url=fronturl("userfiles/front");
chdir($config['userdir']."front");
include $config['userdir']."front/index.php";

//session_write_close();
$mysql->close();

?>
