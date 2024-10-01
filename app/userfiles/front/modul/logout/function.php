<?php
setcookie('qr_token',"",-1,"/");

header("location:".fronturl('login'));
exit();

?>