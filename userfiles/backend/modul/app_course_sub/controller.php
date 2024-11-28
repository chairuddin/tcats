<?php

b_auto_load_css();
b_auto_load_js();
b_load_lib("YonaForm");
b_load_lib("PHPExcel/Classes/PHPExcel");

  
$validation = new YonaValidation();
$form = new YonaForm();

    if($action=="") {
        $course_id = $_GET['course'];
        list($r_course)=$mysql->query_data("SELECT a.title,c.title category,c.id category_id FROM app_course a LEFT JOIN app_category c ON c.id=a.category_id  WHERE a.id=".$course_id);

        //$course_title.="Kategori > ".$r_course['title'];
        
        $course_title='<a href="'.backendurl("app_course").'">'."Function".'</a>';
        $course_title.=" > ";
        //$course_title.='<a href="'.backendurl("app_course?category_id=".$r_course['category_id']).'">'.$r_course['category'].'</a>';
        //$course_title.=" > ";
        $course_title.=$r_course['title'];
    }
    if($action=="add" or $action=="edit") {
      //  $course_id = $mysql->get1value("SELECT course_id FROM app_course_sub WHERE id=$id ");
    }
    
   
    if($action=="add" or $action=="edit") {
        $course_title.="> Uji Kompetensi ";    
    }



include "function.php";
include "model.php";
include "view.php";

$form->release_data();
?>
