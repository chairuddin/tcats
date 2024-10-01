
<?php


$order_id_md5=md5($action);


//total transaction
$q=$mysql->query("SELECT member_id,title,subtitle,is_paid,total FROM app_order WHERE md5(md5(id))='$order_id_md5' ");
$d=$mysql->fetch_assoc($q);

$total=$d['total'];
$is_paid=$d['is_paid'];

//get info_customer
$q_customer=$mysql->query("SELECT fullname,email,telp FROM quiz_member WHERE id=".$d['member_id']);
$customer=$mysql->fetch_assoc($q_customer);
list($nama_depan,$nama_belakang)=explode(" ",$customer['fullname']);
$params = array(
    'transaction_details' => array(
        'order_id' => $order_payment_id,
        'gross_amount' => $d['total'],
    ),
    'customer_details' => array(
        'first_name' => $nama_depan,
        'last_name' => $nama_belakang,
        'email' => $customer['email'],
        'phone' => $customer['telp'],
    ),
);
 

//client key Production Mid-client-Jsokd52UdqZZ_hPF
//client key sandbox SB-Mid-client-EZts1Kb45wULUFfT
?>

