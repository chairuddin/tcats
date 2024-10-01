<?php
b_auto_load_css();
b_auto_load_js();

$q=$mysql->query("SELECT id,nama FROM level ORDER BY nama");
if($q and $mysql->num_rows($q)>0) {
	while($d = $mysql->fetch_assoc($q)) {
		$options_level[$d['id']]=$d['nama'];
	}
}

$options_status = array("1"=>_AKTIF,"0"=>_TIDAKAKTIF);
include "action.php";
include "view.php";

?>
