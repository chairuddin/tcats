<?php

function find_status_by_nama($keyword="") {
   if(strtolower(cleanInput($keyword,'alpha'))=='negeri') {
        return 'N';
    } elseif(strtolower($keyword)=='swasta') {
        return 'S';
    } else {
        return '';
    }
}
function find_jenis_kelamin($keyword="") {
    if(strtolower(cleanInput($keyword,'alpha'))=='lakilaki') {
         return '1';
     } elseif(strtolower($keyword)=='perempuan') {
         return '2';
     } else {
         return '0';
     }
 }
function find_lembaga_jenis_by_nama($arr=array(),$keyword="") {
    foreach($arr as $key => $val) {
        if(strtolower($key)==strtolower($keyword)) {
            return $val;
        }
    }
    return 0;
}
function lembaga_jenis_by_nama() {
    global $mysql;
    $option=array();
    $q=$mysql->query("SELECT id,nama FROM lembaga_jenis ORDER BY id");
    if($q and $mysql->num_rows($q)>0) {
        while($d = $mysql->fetch_assoc($q)) {
            $option[$d['nama']]=$d['id'];
        }
    }
    return $option;
}

function find_lembaga_jenjang_by_nama($arr=array(),$temp_keyword="") {
    $r_keyword=explode('/',$temp_keyword);

    foreach($r_keyword as $keyword) {
        foreach($arr as $key => $val) {
        
            if(strtolower($key)==strtolower(cleanInput($keyword,'alpha'))) {
                return $val;
            }
        }
    }
    return 0;
}
function lembaga_jenjang_by_nama() {
    global $mysql;
    $option=array();
    $q=$mysql->query("SELECT id,nama FROM lembaga_jenjang ORDER BY id");
  
    if($q and $mysql->num_rows($q)>0) {
        while($d = $mysql->fetch_assoc($q)) {
            $r_temp=explode("/",$d['nama']);
            foreach($r_temp as $v) {
                $option[$v]=$d['id'];
            }
           
        }
    }
    return $option;
}
function find_kota_by_nama($arr=array(),$keyword="") {
    foreach($arr as $key => $val) {
        if(strtolower(cleanInput($key,'alpha'))==strtolower(cleanInput($keyword,'alpha'))) {
            return $val;
        }
    }
    return 0;
}
function kota_by_nama() {
	global $mysql;
    $option=array();
	$data=$mysql->query_data("SELECT nama,id,kode FROM wilayah WHERE length(kode)=5 ORDER BY nama");
    foreach($data as $i =>$v) {
        $option[$v['nama']]=$v['id'];
    }
	return $option;
}


function option_lembaga_jenis() {
    global $mysql;
    $option=array();
    $q=$mysql->query("SELECT id,nama FROM lembaga_jenis ORDER BY id");
    $option['']="Pilih Segmen";
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
    $option['']="Pilih jenis";
    if($q and $mysql->num_rows($q)>0) {
        while($d = $mysql->fetch_assoc($q)) {
            $option[$d['id']]=$d['nama'];
        }
    }
    return $option;
}
?>