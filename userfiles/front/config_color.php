<?php
$lang="id";
$list_lang=array("id","en");
$req_lang=array("id"=>1,"en"=>0); /*lang required*/
//$lang=in_array($_SESSION['front_lang'],$list_lang)?$_SESSION['front_lang']:$lang;
$lang=in_array($lang_selected,$list_lang)?$lang_selected:$lang;

ob_start();
require_once("styleClass.php");

//$colorscheme = new appColorScheme("#B5155D","default");

/*GET COLOR DEFAULT*/
$q_color=$mysql->query("SELECT * FROM template_option");
$d_template['color']='#282828';
if($q_color and $mysql->numrows($q_color))
{
	$d_template=$mysql->assoc($q_color);
}

$color_r=hexdec(substr($d_template['color'],1,2));
$color_g=hexdec(substr($d_template['color'],3,2));
$color_b=hexdec(substr($d_template['color'],5,2));

/*END GET COLOR DEFAULT*/

$colorscheme = new appColorScheme($d_template['color']);
//$colorscheme = new appColorScheme("#FFCC00");
/** /
foreach($colorscheme as $i =>$v)
{
	foreach($v as $x =>$y)
	{
	if(!is_array($y))
	echo "<div style='display:inline-block;width:200px;height:50px;background-color:$y'>$x</div>";
	}
}
die();

/**/
 
$color_v1=$colorscheme->color['baseVeryDark'];
$color_v2=$colorscheme->color['baseDark'];
$color_v3=$colorscheme->color['baseNormal'];
$color_v4=$colorscheme->color['baseLight'];
$color_v5=$colorscheme->color['baseVeryLight'];
$color_v6=$colorscheme->color['baseVeryVeryLight'];



/*TEMPLATE COLOR 1* /
$color_1='#282828';
$color_2='#F03F37';
$color_2_dark='#8B0305';
$color_button='#F04033';
$color_footer='#434345';
/*END TEMPLATE COLOR 1*/



/*TEMPLATE COLOR 1*/
$color_1=$color_v3;
$color_2=$color_v2;
$color_2_white=$color_v6;

$color_button=$color_2;
$color_button_hover=$color_2_dark;


$color_footer=$color_1;
/*END TEMPLATE COLOR 1*/

/*TEMPLATE COLOR 1* /
$color_1=$d_template['color'];
$color_2=$color_v1;
$color_2_dark=$color_v4;
$color_button=$color_v2;
$color_footer=$d_template['color'];
/*END TEMPLATE COLOR 1*/

$temp=ob_get_clean();
?>
