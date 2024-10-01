<?php
/*DEFINISIKAN CLASS*/

$boxed=$d_template['isboxed']==1?"boxed":"";
/*END DEFINISIKAN CLASS*/

$template_url=fronturl("userfiles/front/template/".$d_template['template']);

ob_start();
if(file_exists("template/".$d_template['template']."/custom.php")){
include "template/".$d_template['template']."/custom.php";
}
if(file_exists("template/".$d_template['template']."/custom.css")){
include "template/".$d_template['template']."/custom.css";
}
$template_custom_css=ob_get_clean();
/*
include "router_header.php";
include "router.php";
include "router_footer.php";
*/ 
$content=ob_get_clean();

if(file_exists("template/".$d_template['template']."/function.php")){
	include "template/".$d_template['template']."/function.php";
}
if(file_exists("template/".$d_template['template']."/header.php")){
	include "template/".$d_template['template']."/header.php";
}
if(file_exists("template/".$d_template['template']."/body.php")){
	include "template/".$d_template['template']."/body.php";
}
if(file_exists("template/".$d_template['template']."/footer.php")){
	include "template/".$d_template['template']."/footer.php";
}

?>
