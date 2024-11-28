<?php
include "dbdir.php";
//error_reporting(1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

ini_set('display_errors', 1);

/* PATH */
/*extract url from slash into array $_GET[seg1]-$_GET[segn]*/
$parameter_coba=0;
$xparam=$_GET['xparam']!=""?$_GET['xparam']:"";
$r_xparam = explode("/", $_GET['xparam'] ?? '');
if(count($r_xparam)>0)
{	
	foreach($r_xparam as $xx =>$vv)
	{
		$_GET["seg".($xx+1)]=$vv;
	}
}
/*----------------------------*/

$config['default']="";
$config['userid']=str_replace("www.","",$_SERVER['HTTP_HOST']);
//$config['userid']="awal";
$_d=$host[$config['userid']];

if($_d['online'])
{
$config['panel']="panel";
$config['subdir']=$config_sub_dir;
}
else
{
$config['panel']="panel";
$config['subdir']=$config_sub_dir;
}

$ssl=$config_ssl;
$http=$ssl?'https':'http';
//URL 
$config['host']=$_SERVER['HTTP_HOST'];

$config['backendurl']="$http://".$_SERVER['HTTP_HOST']."/".($config['subdir']!=""?$config['subdir']."/":"").$config['panel'];

$config['tinyurl']="$http://".$_SERVER['HTTP_HOST'].($config['subdir']!=""?"/".$config['subdir']:"");
$config['urlfiles']="$http://".$_SERVER['HTTP_HOST']."/".($config['subdir']!=""?$config['subdir']."/":"")."userfiles/file/".$_d['dir'];
$config['urlbackend']="$http://".$_SERVER['HTTP_HOST']."/".($config['subdir']!=""?$config['subdir']."/":"")."userfiles/backend";

//FRONT

$config['fronturl']="$http://".$_SERVER['HTTP_HOST']."".($config['subdir']!=""?"/".$config['subdir']:"");
//$config['fronturl']="https://".$_SERVER['HTTP_HOST']."".($config['subdir']!=""?"/".$config['subdir']:"");





$config['userdir']=$_SERVER['DOCUMENT_ROOT']."/".($config['subdir']!=""?$config['subdir']."/":"")."userfiles/";
$config['userfiles']=$config['userdir']."file/".$_d['dir'];
$config['lib']=$_SERVER['DOCUMENT_ROOT']."/".($config['subdir']!=""?$config['subdir']."/":"").$config['panel']."/lib";
//front
$config['frontpath']=$_SERVER['DOCUMENT_ROOT']."/".($config['subdir']!=""?$config['subdir']:"");
$config['backendpath']=$_SERVER['DOCUMENT_ROOT']."/".($config['subdir']!=""?$config['subdir']."/":"").($config['panel']!=""?$config['panel']:"");

$config['lang']="id";
$modul=$_GET['modul']!=''?$_GET['modul']:$_GET['seg1'];
$action=$_GET['action']!=''?$_GET['action']:$_GET['seg2'];
$id=$_GET['id']!=''?$_GET['id']:$_GET['seg3'];

define('DIR_IMAGES', $config['userdir']."file/".($_d['dir']!=""?$_d['dir']:"")."/media");

define('DIR_SYNC',$_SERVER['DOCUMENT_ROOT']);
//define

$loadfromindex=1;
$form_search="";
$col_left="";
$col_right="";
$msg_warning=$_SESSION['msg_warning'];

/* PATH */
//$pilihan_ganda = array ("A","B","C","D","E","F","G","H","I","J");
//$pilihan_kunci_essay = array ("KUNCI1","KUNCI2","KUNCI3","KUNCI4","KUNCI5");
$pilihan_ganda = array ("A","B","C","D","E");
$pilihan_kunci_essay = array ("KUNCI1","KUNCI2","KUNCI3","KUNCI4","KUNCI5");
$pilihan_komplek = array ("A_K","B_K","C_K","D_K","E_K");
/*mode algoritma ini adalah switch untuk import soal valuenya = 1/2 */
/*mode algoritma muncul karena ada beberapa kejadian di php yang lama tidak ada masalah waktu import xml soal */
/*setelah apache/pakai teknologi lain phpnya jadi aneh jadi import jadi meleset xmlnya bisa di trace di code model.php dan view.php untui variable $mode_algoritma maksudnya apa  */
/* 1. PHP lama (gak perduli versi) */
/* 2. PHP baru (gak perduli versi) */
/* kalau gagal waktu import coba ganti antara 1 dan 2*/
$mode_algoritma=2;

/*mengaktifkan mode pembahasan soal*/
$mode_pembahasan=0;


?>
