<?php
function option_list_jenis() {
    global $mysql;
    $option=array();
    $q=$mysql->query("SELECT id,kode,nama FROM produk_jenis ORDER BY nama");
    $option[]="Pilih jenis";
    if($q and $mysql->num_rows($q)>0) {
        while($d = $mysql->fetch_assoc($q)) {
            $option[$d['id']]=$d['nama'];
        }
    }
    return $option;
}
?>