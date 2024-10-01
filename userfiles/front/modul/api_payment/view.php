    <?php
    $json_data= file_get_contents('php://input');
    $data=json_decode($json_data,true);

    $now=date("Y-m-d H:i:s");
    $q=$mysql->query("INSERT INTO app_log_payment SET created_date='".$now."',order_payment_id='".$order_id."',data='$json_data',action='$action'");
    $log_id=$mysql->insert_id();


    $payment_type=array(
    'credit_card'=>array('transaction_status'=>'capture','fraud_status'=>'accept'),
    'gopay'=>array('transaction_status'=>'settlement','fraud_status'=>'accept'),
    'qris'=>array('transaction_status'=>'settlement','fraud_status'=>'accept'),
    'shopeepay'=>array('transaction_status'=>'settlement','fraud_status'=>'accept'),
    'bank_transfer'=>array('transaction_status'=>'settlement','fraud_status'=>'accept'),
    'echannel'=>array('transaction_status'=>'settlement','fraud_status'=>'accept'),
    'bca_klikpay'=>array('transaction_status'=>'settlement','fraud_status'=>'accept'),
    'cimb_clicks'=>array('transaction_status'=>'settlement'),
    'cstore'=>array('transaction_status'=>'settlement'),
    'akulaku'=>array('transaction_status'=>'settlement','fraud_status'=>'accept'),
    'bri_epay'=>array('transaction_status'=>'settlement','fraud_status'=>'accept'),
    );
    /*
    {
        "transaction_time":"2022-06-01 21:48:59",
        "transaction_status":"settlement",
        "transaction_id":"18575401-e839-490c-8e53-6554114fc448",
        "status_message":"midtrans payment notification",
        "status_code":"200",
        "signature_key":"7c794a3d1aaf3f2d72c128e6d810154993f4bf7c7f29fe6b6e29052cec11954c410e9655687e3535a2aba09ba18ee802751e1c7fbbec265c0b05505fc58dab60",
        "settlement_time":"2022-06-01 21:49:13",
        "payment_type":"gopay",
        "order_id":"82",
        "merchant_id":"M001356",
        "gross_amount":"600000.00",
        "fraud_status":"accept",
        "currency":"IDR"}
    */
    if($action=='notification') {
        //cek settlement/capture
        $check_requirement=$payment_type[$data['payment_type']];
        $valid_count=0;
        $is_paid=false;
        $payment_type=$data['payment_type'];
        $payment_date=$data['transaction_time'];

        if(count($check_requirement)>0) {
            foreach($check_requirement as $field => $value_accepted) {
                if($data[$field]==$value_accepted) {
                    $valid_count++;
                }
            }

            if( count($check_requirement)==$valid_count ) {
                $is_paid=true;
            }
        } else {
            //pembayaran belum terdaftar di program saat ini
            if($data['transaction_status']=='settlement' or $data['transaction_status']=='capture') {
                $is_paid=true;
            }
        }
        if($is_paid) {
            $update_status_payment=$mysql->query("UPDATE app_order_payment SET is_paid=1,payment='$payment_type',payment_date='$payment_date',log_id='$log_id' WHERE id=".$data['order_id']);
            $order_id=$mysql->get1value("SELECT order_id FROM app_order_payment WHERE id='".$data['order_id']."'");
            $time_limit=$mysql->get1value("SELECT time_limit FROM app_order WHERE id='$order_id'");

            $now=date("Y-m-d");
            $d = strtotime("+$time_limit months",strtotime($now));
            $expired_date = date("Y-m-d",$d); // This will print **2015-06-25**


            $update_status_order=$mysql->query("UPDATE app_order SET is_paid=1,payment='$payment_type',payment_date='$payment_date',log_id='$log_id',expired_date='$expired_date' WHERE id=".$order_id);
        }
    }
    if($action=='notificationrec') {

    }
    if($action=='paystatus') {

    }



    ?>