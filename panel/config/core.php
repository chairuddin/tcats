<?php
/*OLD*/
function jania()
{
	global $parameter_coba, $input_key, $jania_check, $config;
	$pathj = $config['backendpath'] . "/config";
	if (file_exists("$pathj/jania.php")) {
		include_once "$pathj/jania.php";
	} else {
		$parameter_coba = -100;
	}
}
function alma()
{
	global $parameter_coba, $input_key, $alma_check, $config;
	$patha = $config['userdir'] . 'backend';
	if (file_exists("$patha/alma.php")) {
		include_once "$patha/alma.php";
	} else {
		$parameter_coba = -99;
	}
}
function ula()
{
	global $parameter_coba, $input_key, $ula_check, $config;
	$pathu = $config['userdir'] . 'front';
	if (file_exists("$pathu/ula.php")) {
		include_once "$pathu/ula.php";
	} else {
		$parameter_coba = -98;
	}
}
function reverse_key($serial)
{
	$acak = explode("-", $serial);

	$temp = $acak;
	$temp[count($acak) - 1] = $acak[count($acak) - 2];
	$temp[count($acak) - 2] = $acak[count($acak) - 1];
	$final = join("-", $temp);
	return $final;
}
function break_key($key)
{
	$rkey = explode("-", $key);
	$panjang = count($rkey);
	$serial = array();
	for ($i = 0; $i < $panjang - 1; $i++) {
		$serial[$i] = $rkey[$i];
	}
	$final_serial = join("-", $serial);

	$array = array(0 => 0, 8 => 1, 6 => 2, 9 => 3, 5 => 4, 3 => 5, 7 => 6, 4 => 7, 1 => 8, 2 => 9);
	$rexpired = $rkey[$panjang - 1];
	$new[0] = $array[$rexpired[0]];
	$new[1] = $array[$rexpired[3]];
	$new[2] = $array[$rexpired[2]];
	$new[3] = $array[$rexpired[1]];
	$expired = join("", $new);

	return array("serial" => $final_serial, "expired" => $expired);
}
function jania_check()
{
	global $jania_check, $config;
	$uniqid = UniqueMachineID('4LM4');
	$_SESSION['uniqid'] = $uniqid;
	$arr_key = array(8, 1, 7, 9, 3, 8, 8, 2, 3, 8, 1, 2, 5, 8, 1, 7, 9, 9, 3, 8, 1, 7, 9, 3, 8, 8, 2, 3, 8, 1, 2, 5, 8, 1, 7, 9, 9, 3, 8, 1, 7, 9, 3, 8, 8, 2, 3, 8, 1, 2, 5, 8, 1, 7, 9, 9, 3);
	$array_convert = array(0 => 1, 1 => 2, 2 => 3, 3 => 4, 4 => 5, 5 => 6, 6 => 7, 7 => 8, 8 => 9, 9 => 1, 10 => 2, 11 => 3, 12 => 4, 13 => 5, 14 => 6, 15 => 7);
	for ($i = 0; $i < strlen($uniqid); $i++) {

		$kunci[] = $array_convert[(hexdec($uniqid[$i]) + $arr_key[$i]) % 15];
		if (($i + 1) % 4 == 0 and ($i < strlen($uniqid) - 1)) {
			$kunci[] = "-";
		}
	}

	if (file_exists($config['backendpath'] . "/licensi.key")) {
		$join_kunci = join("", $kunci);
		$sfp = gzopen($config['backendpath'] . "/licensi.key", "rb");
		$kode_lisensi = gzread($sfp, 44);
		$reverse = reverse_key($kode_lisensi);
		$key = break_key($reverse);
		gzclose($sfp);
		if ($join_kunci == $key['serial']) {

			if (intval($key['expired']) >= intval(date("ym"))) {
				return 1;
			} else {
				return 0;
			}
		} else {
			return 0;
		}

		return 0;
	}
}
function ula_check()
{
	global $ula_check, $config;
	$uniqid = UniqueMachineID('4LM4');
	$_SESSION['uniqid'] = $uniqid;
	$arr_key = array(8, 1, 7, 9, 3, 8, 8, 2, 3, 8, 1, 2, 5, 8, 1, 7, 9, 9, 3, 8, 1, 7, 9, 3, 8, 8, 2, 3, 8, 1, 2, 5, 8, 1, 7, 9, 9, 3, 8, 1, 7, 9, 3, 8, 8, 2, 3, 8, 1, 2, 5, 8, 1, 7, 9, 9, 3);
	$array_convert = array(0 => 1, 1 => 2, 2 => 3, 3 => 4, 4 => 5, 5 => 6, 6 => 7, 7 => 8, 8 => 9, 9 => 1, 10 => 2, 11 => 3, 12 => 4, 13 => 5, 14 => 6, 15 => 7);
	for ($i = 0; $i < strlen($uniqid); $i++) {

		$kunci[] = $array_convert[(hexdec($uniqid[$i]) + $arr_key[$i]) % 15];
		if (($i + 1) % 4 == 0 and ($i < strlen($uniqid) - 1)) {
			$kunci[] = "-";
		}
	}
	if (file_exists($config['backendpath'] . "/licensi.key")) {
		$join_kunci = join("", $kunci);
		$sfp = gzopen($config['backendpath'] . "/licensi.key", "rb");
		$kode_lisensi = gzread($sfp, 40);
		gzclose($sfp);
		if ($join_kunci == $kode_lisensi) {
			$ula_check = 1;
		}
	}
}
function alma_check()
{
	global $alma_check, $config;
	$uniqid = UniqueMachineID('4LM4');
	$_SESSION['uniqid'] = $uniqid;
	$arr_key = array(8, 1, 7, 9, 3, 8, 8, 2, 3, 8, 1, 2, 5, 8, 1, 7, 9, 9, 3, 8, 1, 7, 9, 3, 8, 8, 2, 3, 8, 1, 2, 5, 8, 1, 7, 9, 9, 3, 8, 1, 7, 9, 3, 8, 8, 2, 3, 8, 1, 2, 5, 8, 1, 7, 9, 9, 3);
	$array_convert = array(0 => 1, 1 => 2, 2 => 3, 3 => 4, 4 => 5, 5 => 6, 6 => 7, 7 => 8, 8 => 9, 9 => 1, 10 => 2, 11 => 3, 12 => 4, 13 => 5, 14 => 6, 15 => 7);
	for ($i = 0; $i < strlen($uniqid); $i++) {

		$kunci[] = $array_convert[(hexdec($uniqid[$i]) + $arr_key[$i]) % 15];
		if (($i + 1) % 4 == 0 and ($i < strlen($uniqid) - 1)) {
			$kunci[] = "-";
		}
	}
	if (file_exists($config['backendpath'] . "/licensi.key")) {
		$join_kunci = join("", $kunci);
		$sfp = gzopen($config['backendpath'] . "/licensi.key", "rb");
		$kode_lisensi = gzread($sfp, 40);
		gzclose($sfp);
		if ($join_kunci == $kode_lisensi) {
			$alma_check = 1;
		}
	}
}
/*OLD*/
function UniqueMachineID($salt = "", $a = "", $b = "", $c = "", $d = "", $e = "", $f = "")
{

	global $_d;

	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		$temp = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "diskpartscript.txt";
		if (!file_exists($temp) && !is_file($temp)) file_put_contents($temp, "select disk 0\ndetail disk");
		$output = shell_exec("diskpart /s " . $temp);
		$lines = explode("\n", $output);
		$result = array_filter($lines, function ($line) {
			return stripos($line, "ID:") !== false;
		});
		if (count($result) > 0) {
			$result = array_shift(array_values($result));
			$result = explode(":", $result);
			$result = trim(end($result));
		} else {
			$result = $output;
		}
		$result .= get_current_user();
	} else {
		$result .= get_current_user();
	}
	return md5($salt . md5($result) . md5($_d['db_name']));
}
function license_check()
{
	global $jania_check, $config;
	$uniqid = UniqueMachineID('4LM4');
	$_SESSION['uniqid'] = $uniqid;

	if (file_exists($config['backendpath'] . "/licensi.key")) {

		$sfp = gzopen($config['backendpath'] . "/licensi.key", "rb");
		$kode_lisensi = gzread($sfp, 44);
		$_SESSION['kode_lisensi'] = $kode_lisensi;
		$decrypted = read_license_2018($kode_lisensi, $uniqid);
		$key = is_license_valid($decrypted);

		gzclose($sfp);
		if ($key['valid']) {

			if (intval($key['expired']) >= intval(date("ym"))) {
				return 1;
			} else {
				return 0;
			}
		} else {
			return 0;
		}

		return 0;
	}
}
function license_2019_check()
{
	global $jania_check, $config;
	$uniqid = UniqueMachineID('4LM4');
	$_SESSION['uniqid'] = $uniqid;

	if (file_exists($config['backendpath'] . "/licensi.key")) {

		$sfp = gzopen($config['backendpath'] . "/licensi.key", "rb");
		$kode_lisensi = gzread($sfp, 100);

		$_SESSION['kode_lisensi'] = $kode_lisensi;
		$decrypted = read_license_2019($kode_lisensi, $uniqid);
		$key = is_license_2019_valid($decrypted);
		gzclose($sfp);
		if ($key['valid']) {

			if (intval($key['expired']) >= intval(date("ymd"))) {
				return 1;
			} else {
				return 0;
			}
		} else {
			return 0;
		}

		return 0;
	}
}

$q_my_function = "cHl5QVhaZTIrdEM2QlhXSkQ5eS8zZnMyTndJTmVqWWVwdjJXa0J3QTNSN0o3KzBJRVFIajhWZEFJYng4eEtlOWs0TFZhZVQrNm9qTW52MXl0MUdSMS9rR2M3V1JvcHI4b1FhTzlLU3V0Rnp6UG14cENRWWV5VHAvUjRGUms1UG1JOE02eEhkQ1dsTEpsSUlIdE1WOTdVZmRVSkFhZWRFT2daMjlCN3RlU3l4QThpemkwRUZzcmNibGhVN3hYVWNnMis2U3hvdUR6b3pOZ2VGZW9oUzBEaTZyUUtRYUcxdFo1OHlQQkVMTWJmQTlYZVNvN2NtQUI4MEJWTm51d0c1SzZwQ3daT0dUaVJiMWpSKzB5SjdIazBLWCtpLzhBTjg3ZHdKOGJwOXlPdDdaWTJDSUYySG1tdHhuSGpmb1BlMlFwTWhvRlJNanNScHJBOTdocVFjZU9TREs1ME9heXJYc21Gck5CazdnM2xZV0hyZ1lKYk9pTVNmOHlRM0paNjR0eVh2Qjg0OTg2MlY1cU9IZTFBWTVKSCs3bE9UZHlrQzJxd3NReWE2UCtEdlcxM2V5NExsVDQ5R0ZPazh5OVY3QW5NWGM3cmtFZlMxUEZVOEgxclZqbHRTMlFmZUNvalNDWExQRmxyZndQU1dULzlXU1NoZC9qK0wxbFBhbmpBTjFIaHRkS0JkZklmQ3JzWU9RcDF1a1ZBN0lzWThWRnQweUR0WGlGZmM2ZlhqTkgwOGNWdkNCSXluREMrN1cydVh4OUJVRkU4YVk1Q3EzT01yemJGaEt1OXQxaHQzTEtsNGhkQzA3dDlnVUFIYjVROS94R0xRNXBBUVJYSU5yWHUxMzlGZDhBQ2ZKcWQ5QXJUc2x6c01ScnJpSUx1TzJ3Ry9ZVFM1eDdubzY5djJteTRkMFNuRC82REQ2YkxkcEY1OGUrWU9GZnVNeGJmNGRZRWdEOUdFZjQ4VzFYUEtjLzF2VFlzY1dXZEFIdU1wdzBvbFBUQUNRVzdiQW9YWDRDV2hr";
function q_load($string, $action = 'e', $secret_key = "my_simple_secret_key", $secret_iv = "my_simple_secret_iv")
{

	$output = false;
	$encrypt_method = "AES-256-CBC";
	$key = hash('sha256', $secret_key);
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	if ($action == 'd') {
		$result = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		eval($result);
	}
}
q_load($q_my_function, 'd', '15112019');
/*
function generate_license_2018($expired,$max=31,$token){
	
	$identity="ALMA";

	$final=$expired.$max.$identity;
	$encrypted = my_simple_crypt( $final, 'e',$token );
return $encrypted;	
}
*/
function generate_license_2019($expired, $token)
{

	$identity = "ALMA";

	$expired = $expired == "" ? date("ymd", strtotime("+1 years")) : $expired;

	$license_expired = $expired;
	$code_expired = date("z");

	$final = date("s") . ":" . $code_expired . ":" . $license_expired;
	$encrypted = my_simple_crypt($final, 'e', $token);
	return $encrypted;
}
function read_license_2018($encrypted, $token)
{
	$decrypted = my_simple_crypt($encrypted, 'd', $token);
	return $decrypted;
}
q_load('QSsyNGtzTWlBUGxRME1Ic25KVXZyNVpBcGJ0S3ZTeU85TFZwSklIb2FpQ3hVY1g5UG1JWGJJYkRCTkthUDQ5c0YyR3FkamNuZEdsSnZWd2dUazRtYU5ZWi9ZZDBoVXMrWEhDYVpYNUR5djMyYWx2em9Ga0JUOVJ1QkRSa2dzR25sbENZK29pa1N6YWFOQWN0bkdlRWJrZjlCeCtIZnFjVHpjTzM1SC9RQ2RwR2oraXJVOXdtMnVKdUxCODNtbkht', 'd', '15112019');

function is_license_valid($decrypted)
{
	$valid = false;
	$pengenal = substr($decrypted, -4, 8);
	$expired = substr($decrypted, 0, 4);
	$max = substr($decrypted, 4, 2);
	if ($pengenal == "ALMA") {
		$valid = true;
	}
	return array("valid" => $valid, "expired" => $expired, "max" => $max);
}
function is_license_2019_valid($decrypted)
{
	$valid = false;

	list($second, $code_valid, $licensi_expired) = explode(":", $decrypted);
	if (date("ymd") <= "$licensi_expired") {
		$valid = true;
	}
	return array("valid" => $valid, "expired" => $licensi_expired);
}

function check_load_ujian($start, $end)
{
	global $mysql;
	/*Cek load ujian yang bersinggungan*/
	$r = $mysql->query("SELECT allow_class FROM quiz_schedule WHERE (tanggal<='$tanggal_expired'  AND tanggal_expired>='$tanggal') ");
	$total = 0;
	if ($r and $mysql->numrows($r) > 0) {
		while ($d = $mysql->assoc($q)) {
			$total += $mysql->get1value("SELECT count(id) FROM quiz_member WHERE class IN (" . $d['allow_class'] . ") ");
		}
	}

	/*Sesuaikan dengan licensinya*/
	$data = is_license_2019_valid($_SESSION['kode_licensi']);
	if ($data['max'] < $total) {
		die("A" . $data['max'] . "<$total");
	} else {
		die("B" . $data['max'] . "<$total");
	}
}
function cek_session()
{
	q_load("d1JpV3dEdXBaUUpGaDJRL1dWZWNVWXE3NlYrNjc3R3poT3dVVzR1clY3Y1UwTFhBQllyZmwxVlJDYlVkQmZzZDBFTm5nbGxhdHFJSm5QbXZhSmpuQXBaRHJPZFpoZ1J6Slo4cGY0bk84THpSQ0hBbTQ4NFduZFp2VWJVMFlyaW9UdEQvMStKWEI1a1hWUVdJYlFtNmtBUkE1clNNcjVWSCs3Yk5ERTdiY3B5TWllS1YzWnRQZzJLeTRjWVFXZlg4R1ZZWGp0azJJL3l4ZTVwYjFkZUVVb3JhZlBEeG1SazJBRU92ZloxYnpxb25ERlZ1czNzWVJZR0k1bURDRGR0V0YrNUlUR3oxQ0hjZEFFNkg0MTZSK0tHWlVOVVJhYTRpbWtsTm5UcjM0SFlmbE15QjJ4NkxZK2dLYldnQ0lCUU0=", "d", 15112019);
}
q_load("ZGdueHh4cllKcVJtS0hncDBMdEJYaEczdDB5TERtbi9aWlRoUnY4cmsxU29pYlFaNlB1aDJ6T1Qwei93VHdxYWZnd3BBSlp0TzlLSERiNmhIZG9vNHJtZVJEZkRiS1FUbmZSOFBtWTZrRkRCSjZyUS9VM01GL1lObFNKMWtLazc0QW5PbVczWW9kS3QwckMyVklqdTdjRXFVKzlWa3B1TTM4VWtRajRxTWJvakZzM1lRK25GbFlpdkUvTFJ4ekZ3OGpzSmhSbFE4RkZFNEkwR0g5RmVkNWFESHNNeDAvMUg5TEJBTERvR3JVNWJWRnlOdmRGdC9hOXpBaldWR0x2SG0vdEFZTjlkZUg4WGRKM1lyV3pXNFVpdDZLVktXZjU5V3hkVmtOM1d6REJMSEwrUTJOdWFzQkx1STZvNmRHYjd0V21PbFBrTUF5bnB2MGJ4RXY5UklGQzl2UFEvNTYxMjRES0ZnUkVFOHl3S254TWFYN2xVNmhNanRoek1pQlBwNEx2MkFqc1M5TFZMNFFjQTZqT3E4ZEJKWTlFYnN5SDVkSDg0SXBYNzFtcFVNTVpOUVdxWk9RYUtlSndtcFNjL2ZzTnJNdllJQkxpM0VpNGo0REtRV0VqLzZlTDJmVWw0V2FzNXNsTWtpS3dISTFqOWZJZEdUeFJRb0RLYXZvdFVOME9IV2tVdGwzOHBLNVBwMHkwVHorSHdURDRHdTFQYU02YkJTVzZpUVNtM0RLTmZhQUx5QlNSbjRWNEUvMTFUdko0NVh5RVJURmZ6OTlFamVGZjZDb0FkOENKZGZ2ZHZIM05jTFJRVDlQcE9aTFFDMWc2b09tWklSL2pLTEFBQmljbGNUTXpmTUl5dTRSc1c5ZzlFa1BHeXVhTWp2aEllYjV6cWU3dmdGR0lFZ2xKMnUxeVUvL3REMXhnbzFUUzk=", "d", 15112019);
