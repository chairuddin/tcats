<?php
function draw_menu()
{
global $lang,$mysql,$ishtml,$modul;
ob_start();

$q=$mysql->query("SELECT * FROM menu WHERE url_id='$modul' ORDER BY urutan");	
if($q and $mysql->numrows($q)>0)
{
	$found=$mysql->assoc($q);
}
$q=$mysql->query("SELECT * FROM menu WHERE parent=0 ORDER BY urutan");	
if($q and $mysql->numrows($q)>0)
{
	$menu_pertama=1;
	echo '<ul class="nav navbar-nav pull-right">';
	while($d=$mysql->assoc($q))
	{
			$ob=child_menu($d['id']);
			if($ob!="")
			{
				
				$class_active=(($menu_pertama==1 and $modul=="") or ($menu_pertama==1 and $found['urutan']==1) or ($modul==$d["url_$lang"]))?" class='active' ":"";
				echo '
				<li class="'.$class_active.'">
				<a href="'.fronturl($d["url_$lang"]).'.html" class="dropdown-toggle" data-toggle="dropdown">'.$d["name_$lang"].' <b class="caret"></b></a>
				'.$ob.'
				</li>';
			}
			else
			{
				$class_active=(($menu_pertama==1 and $modul=="") or ($menu_pertama==1 and $found['urutan']==1) or ($modul==$d["url_$lang"]))?" class='active' ":"";
				echo '
				<li'.$class_active.'>
				<a href="'.fronturl($d["url_$lang"]).'.html">'.$d["name_$lang"].'</a>
				</li>';
			}
	$menu_pertama++;		
	}
	
	
	
	
	echo '</ul>';
}
return ob_get_clean();
}

?>
