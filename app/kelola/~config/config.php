<?php
date_default_timezone_set("Asia/Jakarta");

//error_reporting(0);
error_reporting(E_ERROR);
ini_set('display_errors', 2);
include "dbdir.php";
include "function_generic.php";
/*extract url from slash into array $_GET[seg1]-$_GET[segn]*/
$parameter_coba=0;
$xparam=$_GET['xparam'];
$r_xparam=explode("/",$_GET['xparam']);
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
$config['panel']="kelola";
$config['subdir']="custom/crm-kuanta";
}
else
{
$config['panel']="kelola";
$config['subdir']="custom/crm-kuanta";
}

//URL 
$config['host']=$_SERVER['HTTP_HOST'];

$config['backendurl']="http://".$_SERVER['HTTP_HOST']."/".($config['subdir']!=""?$config['subdir']."/":"").$config['panel'];

$config['tinyurl']="http://".$_SERVER['HTTP_HOST'].($config['subdir']!=""?"/".$config['subdir']:"");
$config['urlfiles']="http://".$_SERVER['HTTP_HOST']."/".($config['subdir']!=""?$config['subdir']."/":"")."userfiles/file/".$_d['dir'];
$config['urlbackend']="http://".$_SERVER['HTTP_HOST']."/".($config['subdir']!=""?$config['subdir']."/":"")."userfiles/backend";

//FRONT

$config['fronturl']="http://".$_SERVER['HTTP_HOST']."".($config['subdir']!=""?"/".$config['subdir']:"");
//$config['fronturl']="http://".$_SERVER['HTTP_HOST']."".($config['subdir']!=""?"/".$config['subdir']:"");


//PATH 
/*
 * Jika di online khan buang "web_demo" dibawah
 * */

//$config['panel']=$config['subdir']!=""?$config['subdir']."/":"panel";


$config['userdir']=$_SERVER['DOCUMENT_ROOT']."/".($config['subdir']!=""?$config['subdir']."/":"")."userfiles/";
$config['userfiles']=$config['userdir']."file/".$_d['dir'];
$config['lib']=$_SERVER['DOCUMENT_ROOT']."/".($config['subdir']!=""?$config['subdir']."/":"").$config['panel']."/lib";
//front
$config['frontpath']=$_SERVER['DOCUMENT_ROOT']."/".($config['subdir']!=""?$config['subdir']:"");
$config['backendpath']=$_SERVER['DOCUMENT_ROOT']."/".($config['panel']!=""?$config['panel']:"");

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
?>
