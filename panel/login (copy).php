<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo $config['backendurl'];?>/template/login/images/favicon.png">
<title>Administration</title>
<script language="javascript" type="text/javascript">

function setfocus(){

    document.forms[0].tUsr.focus()

}

</script>

<link rel="stylesheet" type="text/css" href="<?php echo $config['backendurl'];?>/template/login/css/lato_light.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo $config['backendurl'];?>/template/login/css/lato_bold.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo $config['backendurl'];?>/template/login/css/lato_reguler.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo $config['backendurl'];?>/template/login/css/lato_black.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo $config['backendurl'];?>/template/login/css/font-awesome.min.css"/>

<style type="text/css">
.logo-websuka img {
  bottom: 16px;
  position: absolute;
  right: 25px;
  width: 193px;
}
	body {

		background-color:#368EE0;

		margin:0 0 0 0;

		padding:0 0 0 0;

	}

	.info {

		font-family:Lato-Reguler;

		font-size:100%;

		color:#FFFFFF;

		width:500px;

		padding:10px;

		background-color:#FF8888;

		-webkit-border-radius: 4px;

		-moz-border-radius: 4px;

		border-radius: 4px;

		margin:0 auto;

	}

	#spasi_atas {

		margin-top:140px;		

	}

	#spasi_atas_info {

		margin-top:87px;			

	}

	#login_box {
  background-color: #ffffff;
  height: 327px;
  margin: 0 auto;
  width: 289px;
}

	#login_box #login_info {

		position:relative;

		top:15px;

		width:270px;

		float:left;	

		border-right:#e1e1e1 solid 2px;

	}

	#login_box #login_info #title-1 {

		font-family:Lato-Bold;

		font-size:26px;

		float:left;	

		color:#666666;

		margin-left:30px;		

	}

	#login_box #login_info #title-2 {

		font-family:Lato-Bold;

		font-size:28px;

		float:left;	

		color:#368EE0;

		margin-left:30px;	

	}

	#login_box #login_info #desc-1 {

		font-family:Lato-Light;

		font-size:15px;	

		color:#666666;

		float:left;	

		margin:20px 10px 20px 30px;

	}

	#login_box #login_info #desc-2 {

		font-family:Lato-Bold;	

		font-size:14px;

		color:#666666;

		float:left;

		margin:0 10px 20px 30px;

	}

	#login_box #login_form {

		position:relative;

		padding:15px;

		width:270px;


	}

	#login_box #login_form #form_holder {

		margin-top:20px;	

	}

	#login_box #login_form #form_holder label {

		font-family:Lato-Light;

		font-size:100%;

		color:#666;

		margin-left:40px;

	}

	#login_box #login_form #form_holder input[type=text],input[type=password] {

		background-color:#e0e0e0;

		color:#333;

		border:0;

		margin-top:7px;

		margin-bottom:10px;

		margin-left:40px;

		width:70%;

		height:26px;

		padding:2px 5px 2px 7px;

	}

	#login_box #login_form #form_holder input[type=submit] {

		background-color:#999;

		color:#FFFFFF;	

		border:0;

		margin-top:10px;

		margin-left:40px;

		padding:10px;

		width:80px;

	}

<!-- FOOTER -->

	.section {

		clear: both;

		padding: 0px;

		margin: 0px;

	}

	

	.group:before,

	.group:after {

		content:"";

		display:table;

	}

	.group:after {

		clear:both;

	}

	.group {

		zoom:1; /* For IE 6/7 (trigger hasLayout) */

	}

	

	.col {

		display: block;

		float:left;

		margin: 9% 0 1% 0;

	}

	

	.col:first-child { margin-left: 0; } /* all browsers except IE6 and lower */

	

	

	.span_2_of_2 {

		width: 100%;

	}

	

	.span_1_of_2 {

		width: 49.2%;

	}

	.span_1_of_2 .kanan {

		float:right;	

	}

	.span_1_of_2 .kanan .hub {

		font-family:Lato-Bold;

		font-size:20px;

		color:#ffffff;

				

	}

	.span_1_of_2 .kanan .email {

		font-family:Lato-Reguler;

		font-size:14px;

		color:#ffffff;

		margin-left:1px;		

	}

	.span_1_of_2 .kanan .email a {

		color:#ffffff;		

		text-decoration:none;	

	}

	.span_1_of_2 .kiri {

		margin-left:3%;		

	}

	.span_1_of_2 .kiri .copyright {

		font-family:Lato-Reguler;

		font-size:14px;

		color:#ffffff;

		margin-top:5px;	

	}

	#display {

		display:none;	

	}

@media screen and (max-width: 800px) {

	#spasi_atas {

		margin-top:20px;		

	}	

	#spasi_atas_info {

		margin-top:10px;			

	}

	.info {

		font-family:Lato-Reguler;

		font-size:14px;

		color:#FFFFFF;

		width:70%;

		padding:10px;

		background-color:#FF8888;

		-webkit-border-radius: 4px;

		-moz-border-radius: 4px;

		border-radius: 4px;

		margin:0 auto;

	}

	#login_box {

		width:270px;

	}

	#login_box #login_info {

		position:relative;

		top:15px;

		float:none;	

		border-right:0;

		background-color:#FFFFFF;

	}

	#login_box #login_info #title-1 {

		font-family:Lato-Bold;

		font-size:26px;

		float:none;	

		color:#666666;

		margin-left:30px;		

	}

	#login_box #login_info #title-2 {

		font-family:Lato-Bold;

		font-size:28px;

		float:none;	

		color:#66cc99;

		margin-left:30px;	

	}

	#login_box #login_info #desc-1 {

		font-family:Lato-Light;

		font-size:15px;	

		color:#666666;

		float:left;	

		margin:20px 20px 20px 30px;

	}

	#login_box #login_info #desc-2 {

		font-family:Lato-Bold;	

		font-size:14px;

		color:#666666;

		float:left;	

		margin:0 20px 20px 30px;

	}

	#login_box #login_form {

		width:270px;

		float:right;	

		background-color:#FFFFFF;

	}

	#login_box #login_form #form_holder {

		margin-top:20px;

		background-color:#FFFFFF;	

	}

	#login_box #login_form #form_holder label {

		font-family:Lato-Light;

		font-size:100%;

		color:#666;

		margin-left:40px;

	}

	#login_box #login_form #form_holder input[type=text],input[type=password] {

		background-color:#e0e0e0;

		color:#333;

		border:0;

		margin-top:7px;

		margin-bottom:10px;

		margin-left:40px;

		width:190px;

		height:26px;

	}

	#login_box #login_form #form_holder input[type=submit] {

		background-color:#999;

		color:#FFFFFF;	

		border:0;

		margin-top:10px;

		margin-left:40px;

		margin-bottom:20px;

		padding:10px;

		width:80px;

	}

	.span_2_of_2 {

		width: 100%;

	}

	.span_1_of_2 {

		width: 100%;

	}

	.span_1_of_2 .kanan {

		float:left;

		position:relative;

		bottom:120px;

		width: 100%; 

		text-align:center;		

	}

	.span_1_of_2 .kanan .hub {

		font-family:Lato-Bold;

		font-size:18px;

		color:#ffffff;

				

	}

	.span_1_of_2 .kanan .email {

		font-family:Lato-Reguler;

		font-size:14px;

		color:#ffffff;		

	}

	.span_1_of_2 .kanan .email a {

		color:#ffffff;		

		text-decoration:none;	

	}

	.span_1_of_2 .kiri {

		float:left;

		position:relative;

		bottom:-60px;

		text-align:center;

		right:3%;

		width: 100%; 

	}

	.span_1_of_2 .kiri .copyright {

		font-family:Lato-Reguler;

		font-size:14px;

		color:#ffffff;

		margin-top:5px;	

	}

	#display {

		display:none;	

	}

}

@media screen and (max-width: 600px) {

	#display {

		display:block;	

	}

	.span_1_of_2 .kanan {

		float:left;

		position:relative;

		bottom:100px;

		width: 100%; 

		text-align:center;		

	}	

	.span_1_of_2 .kiri {

		float:left;

		position:relative;

		bottom:-70px;

		text-align:center;

		right:3%;

		width: 100%; 

	}

}

@media screen and (max-width: 480px) {



	.span_1_of_2 .kanan {

		float:left;

		position:relative;

		bottom:80px;

		width: 100%; 

		text-align:center;		

	}	

	.span_1_of_2 .kiri {

		float:left;

		position:relative;

		bottom:-60px;

		text-align:center;

		right:3%;

		width: 100%; 

	}

}
#login_form img {
  width: 218px;
}	

</style>

</head>

<body>

	<div id="spasi_atas" ></div>
	<?php 
	if($_SESSION['msg_warning']!="")
	{
	echo '<div class="info" align="center">';
	echo $_SESSION['msg_warning'];
	echo '</div>
	<div>&nbsp;</div>';
	}
	?>
    
	<div id="login_box">

    	
        <div id="login_form">

       		<div align="center"><img src="<?php echo $config['backendurl'];?>/template/login/images/logo-warna.png"/></div>
			
            <div id="form_holder">
			<form action="<?php echo backendurl("login/check")?>" method="post">
            <label>Username</label>
            <input type="text" name="username" />
            <label>Password</label>
            <input type="password" name="password" />
            <input type="submit" name="btnLogin" value="LOGIN" />
            </form>
            </div>

            <!--<div id="display">600</div>-->

        </div>

    </div>	

<div class="logo-websuka"><img src="<?php echo $config['backendurl'];?>/template/login/images/logo-websuka.png"/></div>    
<!--
Software Developer:
Mohammad Romli
romli@websuka.com
-->
</body>

</html>
