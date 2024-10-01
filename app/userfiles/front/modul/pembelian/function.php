<?php
$auth_data=check_session();

$course_material_id_md5=md5(cleanInput($action));

$userid=$auth_data['id'];
$auth_token=$_COOKIE['qr_token'];
$condition_filter_by_category='';
if($action=="filter") {
    $category_id_md5=md5($id);
    $condition_filter_by_category=" AND md5(md5(a.category_id))='$category_id_md5' ";
}
    $data=array();
    
    $image_default="https://wifiukai.com/cbt/userfiles/file/quiz/app_asset/education.png";
    
    $now=date("Y-m-d");

    $product=$mysql->sql_get_assoc("
    SELECT
        a.id,
        a.title,
        a.subtitle,
        a.category_id,
        if(LENGTH(a.image)<=0,'$image_default',a.image) image,
        concat('Rp ',FORMAT(a.price, 0,'id_ID')) price,
        concat('Rp ',FORMAT(a.price_promo, 0,'id_ID')) price_promo,
        a.content,
        a.content_short,
        IFNULL(o.product_id,'') order_product_id,
        IFNULL( o.is_paid,0) is_paid
        FROM
        app_product a
        LEFT JOIN
        app_order o ON (a.id=o.product_id AND o.member_id=$userid AND o.expired_date>'$now' )
        WHERE
        a.category_id IN (SELECT id FROM app_category  WHERE publish=1) $condition_filter_by_category
        AND
        a.publish=1
        GROUP BY a.id
        ORDER BY a.title
        
    ");


?>