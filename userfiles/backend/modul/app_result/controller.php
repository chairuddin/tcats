<?php
b_load_lib("YonaForm");
b_load_lib("PHPExcel/Classes/PHPExcel");


$validation = new YonaValidation();
$form = new YonaForm();

b_auto_load_css();
b_auto_load_js();


include "model.php";
if($action=="ajax")
{
	include "function.php";
	include "ajax.php";
	
}
else
{
	
	include "function.php";
	include "view.php";
	
}

?>
