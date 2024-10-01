<?php
function patient_char($str)
{
$alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X ', 'Y', 'Z');
$newName = '';
do {
    $str--;
    $limit = floor($str / 26);
    $reminder = $str % 26;
    $newName = $alpha[$reminder].$newName;
    $str=$limit;
} while ($str >0);
return $newName;
}
function generate_token_jadwal($i){
	$string=rand(1,9).str_pad($i,6,"0",STR_PAD_LEFT);
	$alphanumeric = patient_char($string);
	return strtoupper($alphanumeric);
}
function modul_asset_url($url="")
{
	global $config;
	
	$url="http://".$_SERVER['HTTP_HOST']."/".($config['subdir']!=""?$config['subdir']."/":"")."userfiles/backend/modul/$url";
	return $url;
}
?>
