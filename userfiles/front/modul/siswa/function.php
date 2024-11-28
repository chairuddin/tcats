<?php
function do_my_simple_crypt( $string, $action = 'e',$secret_key="my_simple_secret_key",$secret_iv="my_simple_secret_iv" ) {
    // you may change these values to your own
    $string=$string!=""?$string:'';
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}
function set_login_session($data_member) {
		$encode_data=json_encode($data_member);
		$encrypted = do_my_simple_crypt( $encode_data, 'e','bismILLAH' );
		setcookie('STDSESSID',"",-1,"/");
		$bulan=(30*24*60*60);
		setcookie("STDSESSID",$encrypted,time()+$bulan,"/");
}
function set_logout_session() {
		setcookie('STDSESSID',"",-1,"/");
		//setcookie('PHPSESSID',"",-1,"/");
		setcookie("quiz_token","",-1,"/");	
}
function get_login_session() {
		$encrypted=$_COOKIE["STDSESSID"];
		$decrypted = do_my_simple_crypt( $encrypted, 'd','bismILLAH' );
		$data_member=json_decode($decrypted,true);
		return $data_member;
}
function cek_login_siswa() {
	global $mysql;
	$data_member=get_login_session();
	if(!$data_member) return false;
	
	$ada=$mysql->get1value(" SELECT count(id) FROM quiz_member WHERE id=".$data_member['id']." AND username='".$data_member['username']."' AND md5(password)='".$data_member['password']."' AND status=1 ");
	if($ada>=1) {
		return true;
	} else {
		set_logout_session();
		return false;
	}
}
function siswa_harus_login() {
	global $mysql;
	if(!cek_login_siswa()) {
		
		//header("location:".fronturl("siswa/login"));
		header("location:".fronturl("app"));
		
		exit();
	}
}
?>
