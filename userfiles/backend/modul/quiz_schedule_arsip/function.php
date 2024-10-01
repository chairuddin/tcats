<?php
function modul_asset_url($url="")
{
	global $config;
	
	$url="http://".$_SERVER['HTTP_HOST']."/".($config['subdir']!=""?$config['subdir']."/":"")."userfiles/backend/modul/$url";
	return $url;
}
?>
