
<?php
b_load_lib("midtrans-php/Midtrans");
//require_once dirname(__FILE__) . '/Midtrans.php';
// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'Mid-server-NcP88utYzF5kq0vKLaJdMwyb'; //production
//\Midtrans\Config::$serverKey = 'SB-Mid-server-WphPnjr4Rn8zoenhOP2qmJXJ'; //Sandbox

// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = true;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

$order_id=$action;


//total transaction
$q=$mysql->query("SELECT member_id,title,subtitle,is_paid,total FROM app_order WHERE id=$order_id ");
$d=$mysql->fetch_assoc($q);

$total=$d['total'];
$waktu=date("Y-m-d H:i:s");
$sql_payment="
        INSERT INTO
            app_order_payment
        SET
            order_id='$order_id',
            created_date='$waktu',
            total='$total'
 ";

 $q_payment=$mysql->query($sql_payment);
 $order_payment_id=$mysql->insert_id();


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
 
$snapToken = \Midtrans\Snap::getSnapToken($params);
//client key Production Mid-client-Jsokd52UdqZZ_hPF
//client key sandbox SB-Mid-client-EZts1Kb45wULUFfT
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <!--
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-EZts1Kb45wULUFfT"></script>
     --> 
     
     <script type="text/javascript"
      src="https://app.midtrans.com/snap/snap.js"
      data-client-key="Mid-client-Jsokd52UdqZZ_hPF"></script>
     
      
    <!-- Note: replace with src="" for Production environment -->
  </head>
 
  <body>
    
    <p><?php echo $d['title'];?></p>
    <p style="background-color: #FFFFFF;
    border-bottom: 1px solid #102C42;
    height: 60px;"><?php echo currency($d['total'],'Rp ');?></p>
    <button id="pay-button">Lanjutkan Pembayaran</button>
 
    <script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('<?php echo $snapToken; ?>');
        // customer will be redirected after completing payment pop-up
      });
     setTimeout(function(){
        window.snap.pay('<?php echo $snapToken; ?>');
    },200);
    </script>
  </body>
</html>
<?php die();?>
