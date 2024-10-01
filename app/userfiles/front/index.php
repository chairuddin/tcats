<?php
//session_start();
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
	/*
	$q_menu_awal=$mysql->query("SELECT url_id FROM menu WHERE  id in (SELECT id_menu FROM menu_layout ) ORDER BY urutan limit 1 ");
	if($q_menu_awal and $mysql->numrows($q_menu_awal)>0)
	{
		list($menu_awal)=$mysql->row($q_menu_awal);
		$_GET['seg1']=$menu_awal;
		
	}
	*/ 
}
//END AMBIL MENU URUTAN PERTAMA JIKA TIDAK ADA PARAMETER

/*
if($ishtml and $modul!="ajax")
{
	$_GET['seg1'].=$_GET['seg1']!=""?".html":"";
}
*/ 
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


if($modul=="")$modul="index";



/*seo variable*/
/*
$r_web_config=web_config();
foreach($r_web_config as $var =>$value)
{
	$$var=$value;
}
*/ 


if($modul!="ajax")
{
	
	if($extension!="html")
	{
		
		
			ob_start();
			if(file_exists("modul/$modul/index.php")) {
				include "modul/$modul/index.php";
			} elseif(file_exists("modul/$modul/view.php")) {
				if(file_exists("modul/$modul/function.php")) {
					include "modul/$modul/function.php";
				} 
				include "modul/$modul/view.php";
			}
			$content = ob_get_clean();
			
			
			$d_template['template']='elearning';
			$template_url=fronturl("userfiles/front/template/".$d_template['template']);

			ob_start();
			if(file_exists("template/".$d_template['template']."/custom.php")){
			include "template/".$d_template['template']."/custom.php";
			}
			if(file_exists("template/".$d_template['template']."/custom.css")){
			include "template/".$d_template['template']."/custom.css";
			}
			$template_custom_css=ob_get_clean();


			ob_start();
			if(file_exists("template/".$d_template['template']."/function.php")){
				include "template/".$d_template['template']."/function.php";
			}
			if(file_exists("template/".$d_template['template']."/header.php")){
				include "template/".$d_template['template']."/header.php";
			}
			if(file_exists("template/".$d_template['template']."/body.php")){
				include "template/".$d_template['template']."/body.php";
			}
			
			if(file_exists("template/".$d_template['template']."/footer.php")){
				include "template/".$d_template['template']."/footer.php";
			
			}
			
			$template= ob_get_clean();

		
	}
}

if($modul=="ajax")
{
		include "ajax.php";
}
else
{


$template=str_replace("<<<TEMPLATE_URL>>>",$template_url,$template);
echo $template;
}

?>
