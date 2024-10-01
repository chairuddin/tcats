
<?php


$order_id=$action;


//total transaction
$q=$mysql->query("SELECT member_id,title,subtitle,is_paid,total FROM app_order WHERE id=$order_id ");
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
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
  </head>
 
  <body>

<?php if($is_paid) { ?>
<p>Terima kasih <?php echo $customer['fullname'];?>,</p>
<p>Anda telah menyelesaikan pembelian <?php echo $d['title'];?></p>

<?php } ?>

<?php if(!$is_paid) { ?>
<p>Terima kasih <?php echo $customer['fullname'];?>,</p>
<p>Berikut ini adalah langkah-langkah untuk menyelesaikan pembelian <?php echo $d['title'];?></p>
<p>Jumlah yang ditransfer adalah [nominal],- + kode unik yang dipilih secara acak oleh sistem untuk identifikasi transfer yang Anda lakukan. Pastikan jumlah yang ditransfer tertera di bawah ini:</p>
<p><strong><?php echo currency($d['total'],'Rp ');?>,-</strong><br /><br />Dana ditransfer ke:<br />Nama :FERI ANDIKA<br />Bank : BRI<br />No rekening: 726201001719502<br />Bank : BNI<br />No Rekening : 0696972382</p>
<p>&nbsp;</p>
<p>Pastikan jumlah ditransfer sesuai nominal di atas. Ketidaksesuaian jumlah yang ditransfer dapat memperlambat proses verifikasi yang dilakukan oleh sistem kami. Setelah melakukan transfer, mohon mengirimkan bukti transfer beserta nama lengkap pengguna via WhatsApp ke nomor ini&nbsp;<br/>
<a href="https://wa.me/6285361466360">&nbsp;<img src="/userfiles/file/web/media/source/580b57fcd9996e24bc43c543.png" alt="580b57fcd9996e24bc43c543" width="30" height="30" />0853 6146 6360</a>.</p>
<?php } ?>   
 
  </body>
</html>
<?php die();?>
