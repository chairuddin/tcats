<?php
if($modul=="")
{		
header("location:".fronturl("quiz_login"));
exit();	
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo $web_config_description; ?>"/>
<meta name="keyword" content="<?php echo $web_config_keyword; ?>"/>
<meta name="author" content="websuka.com" >
<meta name="theme-color" content="<?php echo $color_1;?>" />
<link rel="shortcut icon" href="<?php echo favicon();?>?<?php echo uniqid();?>"/>
<title><?php echo $web_config_title; ?></title>


<!-- Style owl carousel -->
<!-- FONT -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<!-- Bootstrap -->

<link href="<<<TEMPLATE_URL>>>/css/bootstrap.min.css" rel="stylesheet"> 
<!-- <link href="<<<TEMPLATE_URL>>>/js/jquery-ui.min.css" rel="stylesheet"> -->
<link href="<<<TEMPLATE_URL>>>/css/support.css" rel="stylesheet"> 
<link href="<<<TEMPLATE_URL>>>/css/basic.css?v=<?=rand();?>" rel="stylesheet">

<style>
<?php
/*
if(file_exists("template/".$d_template['template']."/js/jquery-ui.min.css")){
include "template/".$d_template['template']."/js/jquery-ui.min.css";
}

if(file_exists("template/".$d_template['template']."/css/bootstrap.min.css")){
include "template/".$d_template['template']."/css/bootstrap.min.css";
}
if(file_exists("template/".$d_template['template']."/css/support.css")){
include "template/".$d_template['template']."/css/support.css";
}
*/ 



?>
</style>


<?php

if(is_array($style_css) )
{
	if(count($style_css)>0) {
		echo implode("\r\n",$style_css);
	}
}

?>

<style>
<?php
echo $template_custom_css;
?>
</style>
 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php 
	echo $web_config_ga; 
	$logo=logo();
?>
</head>
<body>
    <!--
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><img src="<?php echo $logo;?>"></a>
                <?php echo $panel_user;  ?>
            </div>
        </div>
-->  
		<!--<div id="user-welcome">
			<i class="glyphicon glyphicon-user"></i>
			<div class="right-side-welcome">
				Selamat Datang
				<div class="nama-siswa">Muhammad Ahfi</div>
				<a href="#">Logout <i class="glyphicon glyphicon-log-out"></i></a>
			</div>
		</div>-->
 <!--   </nav> -->
<!-- div wrapper start -->
<div id="middle-block" class="<?php echo $boxed;?>">
