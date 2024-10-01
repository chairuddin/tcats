<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
include "global.php";
$xparam=$_GET['xparam'];

$ishtml=0;
if(strpos($xparam,".html"))
{
	$ishtml=1;
	$_GET['xparam']=str_replace(".html","",$_GET['xparam']);
	
}
$r_xparam=explode("/",$_GET['xparam']);
if(count($r_xparam)>0)
{

	foreach($r_xparam as $xx =>$vv)
	{
		$_GET["seg".($xx+1)]=$vv;
	}
}
//AMBIL MENU URUTAN PERTAMA JIKA TIDAK ADA PARAMETER
if($xparam=="")
{
	$ishtml=1;
	$q_menu_awal=$mysql->query("SELECT url_id FROM menu WHERE  id in (SELECT id_menu FROM menu_layout ) ORDER BY urutan limit 1 ");
	if($q_menu_awal and $mysql->numrows($q_menu_awal)>0)
	{
		list($menu_awal)=$mysql->row($q_menu_awal);
		$_GET['seg1']=$menu_awal;
		
	}
}
//END AMBIL MENU URUTAN PERTAMA JIKA TIDAK ADA PARAMETER


if($ishtml and $modul!="ajax")
{
	$_GET['seg1'].=$_GET['seg1']!=""?".html":"";
}
if(!$ishtml and $modul!="ajax")
{
	if(!file_exists("modul/$modul/") or $modul=="")
	{
	
	 $_GET['seg1']=menu_utama().".html";
	} 
	
}

$p=$_GET['seg1'];
$modul=$_GET['seg1'];
$action=$_GET['seg2'];
$id=$_GET['seg3'];

list($menu_name,$extension)=explode(".",$modul);




if($modul=="")$modul=$menu_name;
if($modul=="" or ($modul!="" and $modul!="ajax"  and !file_exists("modul/$modul/"))  or  in_array($modul,$list_lang) )$modul=$menu_name;
ob_start();

/*seo variable*/

$q=$mysql->query("SELECT name,title_$lang title FROM web_config");
if($q and $mysql->numrows($q)>0)
{

	while($d=$mysql->assoc($q))
	{
		$var="web_config_".$d['name'];
		$$var=$d['title'];
	}	
	
	
}


/**/
$q=$mysql->query("SELECT name,title_$lang title FROM msg_warning");
if($q and $mysql->numrows($q)>0)
{
	while($d=$mysql->assoc($q))
	{
		$var="msg_".$d['name'];
		$$var=$d['title'];
	}	
	
}

/*translation*/
$TEXT=array();
$q=$mysql->query("SELECT variable,lang_$lang lang FROM translation");
if($q and $mysql->numrows($q)>0)
{
	while($d=$mysql->assoc($q))
	{
		
		$TEXT[$d['variable']]=$d['lang'];
	}	
}

/*end translation*/
/*contact footer*/

$q=$mysql->query("SELECT title_$lang title,desc_atas_$lang desc_atas,address_$lang address,telp,fax,email FROM contact_footer limit 1");

if($q and $mysql->numrows($q)>0)
{
	
	$d=$mysql->assoc($q);
	foreach($d as $i =>$v)
	{
		$CONTACT["footer"."_$i"]=$v;
	}	
}

/*end contact*/


/*
if(function_exists("{$action}"))
{
$action();
}
*/
if($web_config_exam_browser_only==1 and $modul!="session_invalid"){
	$headers = apache_request_headers();
	$browser_key=$headers['X-SafeExamBrowser-RequestHash'];
	$valid=$browser_key!=""?true:false;
	//$valid=$mysql->get1value("SELECT id FROM quiz_exam_browser WHERE browser_key='$browser_key' and status=1");
	if(!$valid){
		header("location:".fronturl("session_invalid"));
	}
} 

if($modul!="ajax")
{
	
	if($extension!="html")
	{
		
		if(file_exists("modul/$modul/function.php")){
		include "modul/$modul/function.php";
		}
		
		if($action=="ajax")
		{
			if(file_exists("modul/$modul/ajax.php"))
			{
			include "modul/$modul/ajax.php";
			}
		}
		else
		{
		
			ob_start();
			if(file_exists("config_color.php"))
			{
				include "config_color.php";
			}

			if(file_exists("modul/$modul/view.php"))
			{
				include "modul/$modul/view.php";
			}
			
			if(file_exists("config_template.php"))
			{
				include "config_template.php";
			}
			

			/*
			include "router_footer.php";
			$content=ob_get_clean();
			include "header.php";
			echo $content;
			include "footer.php";
			*/
			
		}
	}
	else
	{
	ob_start();
	if(file_exists("config_template.php"))
	{
		include "config_template.php";
	}
	else
	{
		die("config_template.php tidak ditemukan");
	}

	}
}

if($modul=="ajax")
{
		include "ajax.php";
}
else
{
$template=ob_get_clean();

$template=str_replace("<<<TEMPLATE_URL>>>",$template_url,$template);
echo $template;
}

?>
