<?php
function option_lembaga_jenis() {
    global $mysql;
    $option=array();
    $q=$mysql->query("SELECT id,nama FROM lembaga_jenis ORDER BY id ");
    if($q and $mysql->num_rows($q)>0) {
        while($d = $mysql->fetch_assoc($q)) {
            $option[$d['id']]=$d['nama'];
        }
    }
    return $option;
}
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

function produk_terpilih($parent_id) {
    global $mysql;
    $terpilih=array();
    $q=$mysql->query("SELECT produk_id FROM produk_paket WHERE parent_id=$parent_id");
    if($q and $mysql->num_rows($q)>0) {
        while($d = $mysql->fetch_assoc($q)) {
            $terpilih[$d['produk_id']]=1;
        }
    }
    return $terpilih;
}
?>