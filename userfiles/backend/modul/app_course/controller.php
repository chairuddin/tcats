<?php

b_load_lib("YonaForm");
b_load_lib("PHPExcel/Classes/PHPExcel");


$validation = new YonaValidation();
$form = new YonaForm();

$category_id=$_REQUEST['category_id'];

$course_title='<a href="'.backendurl("app_course").'">'."Function".'</a>';

include "function.php";
include "model.php";
include "view.php";


b_auto_load_css();
b_auto_load_js(array('category_id'=>$category_id));


$form->release_data();
?>
