<?php
session_start();

include "panel/config/function.php";
include "panel/config/config.php";
include "panel/config/connect.php";

$config_user=$config['userdir']."/config.php";
if(file_exists("$config_user"))include "$config_user";
$file_url=fronturl("userfiles/".$_d['dir']."/file");
$file_path=frontpath("userfiles/".$_d['dir']."/file");
$app_url=fronturl("userfiles/".$_d['dir']."/front");

?>
