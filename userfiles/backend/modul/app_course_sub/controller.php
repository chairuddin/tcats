<?php

b_auto_load_css();
b_auto_load_js();
b_load_lib("YonaForm");
b_load_lib("PHPExcel/Classes/PHPExcel");


$validation = new YonaValidation();
$form = new YonaForm();

list($r_course)=$mysql->query_data("SELECT a.title,c.title category,c.id category_id FROM app_course a LEFT JOIN app_category c ON c.id=a.category_id  WHERE a.id=".$_GET['course']);

/*
$course_title='<a href="'.backendurl("app_category").'">'."Category".'</a>';
$course_title.=" > ";
$course_title.='<a href="'.backendurl("app_course?category_id=".$r_course['category_id']).'">'.$r_course['category'].'</a>';
$course_title.=" > ";
$course_title.=$r_course['title'];
*/

include "function.php";
include "model.php";
include "view.php";

$form->release_data();
?>
