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

<!-- Bootstrap -->

<link href="<<<TEMPLATE_URL>>>/css/bootstrap.min.css" rel="stylesheet"> 
<!-- <link href="<<<TEMPLATE_URL>>>/js/jquery-ui.min.css" rel="stylesheet"> -->
<link href="<<<TEMPLATE_URL>>>/css/support.css" rel="stylesheet"> 
<link href="<<<TEMPLATE_URL>>>/css/basic.css" rel="stylesheet">

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
if(count($style_css)>0)
{
echo join("\r\n",$style_css);
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
<?php echo $web_config_ga; ?>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><img src="<<<TEMPLATE_URL>>>/images/logo.png"></a>
            </div>
        </div>
		
			<?php echo $panel_user;?>
			<!--
			<i class="glyphicon glyphicon-user"></i>
			<div class="right-side-welcome">
				Selamat Datang
				<div class="nama-siswa">Muhammad Ahfi</div>
				<a href="#">Logout <i class="glyphicon glyphicon-log-out"></i></a>
			</div>
			-->
		
    </nav>
<!-- div wrapper start -->
<div id="middle-block" class="<?php echo $boxed;?>">
