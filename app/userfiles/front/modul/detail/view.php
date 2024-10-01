 <?php

// if($detail['is_subscribe']=='1' || $detail['is_free']=='1') {

     if($detail['type']=='text') {
        include "view_text.php";   
     }
     if($detail['type']=='video') {
        include "view_video.php";   
     }
     if($detail['type']=='quiz') {
        include "view_quiz.php";   
     }
     
// } else {
 
     //redirect ke halaman pembelian
 //    header("location:".fronturl('pembelian/filter/'.md5($category_id)));
 //    exit();
 //}
 ?>