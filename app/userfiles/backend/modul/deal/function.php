<?php
function option_lembaga_jenis() {
    global $mysql;
    $option=array();
    $q=$mysql->query("SELECT id,nama FROM lembaga_jenis ORDER BY id");
    $option[]="Pilih jenis";
    if($q and $mysql->num_rows($q)>0) {
        while($d = $mysql->fetch_assoc($q)) {
            $option[$d['id']]=$d['nama'];
        }
    }
    return $option;
}
function option_lembaga_jenjang() {
    global $mysql;
    $option=array();
    $q=$mysql->query("SELECT id,nama FROM lembaga_jenjang ORDER BY id");
    $option[]="Pilih jenis";
    if($q and $mysql->num_rows($q)>0) {
        while($d = $mysql->fetch_assoc($q)) {
            $option[$d['id']]=$d['nama'];
        }
    }
    return $option;
}
?>