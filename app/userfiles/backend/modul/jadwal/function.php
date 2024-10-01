<?php
function ringkasan_jadwal($kegiatan_id) {
    global $mysql;
    $jadwal_q=$mysql->query(" SELECT j.id,j.kegiatan_id,j.kegiatan_judul,k.nama jenis_kegiatan,j.status_selesai  FROM jadwal j LEFT JOIN kegiatan_jenis k ON k.id=j.kegiatan_jenis_id WHERE j.kegiatan_id=$kegiatan_id ORDER BY j.id asc");
    $data=array();
    if($jadwal_q and $mysql->num_rows($jadwal_q)>0) {
        while($jadwal_d = $mysql->fetch_assoc($jadwal_q)) {
            $data[$jadwal_d['id']]['data']=$jadwal_d;
            $harian_q=$mysql->query(" SELECT id,jam_mulai,jam_selesai FROM jadwal_harian WHERE jadwal_id=".$jadwal_d['id']." ORDER BY jam_mulai asc");
            if($harian_q and $mysql->num_rows($harian_q)) {
                while($harian_d = $mysql->fetch_assoc($harian_q)) {
                    $temp_coach=array();
                    $coach_q=$mysql->query(" SELECT c.id_trainer,c.nama FROM jadwal_coach jc LEFT JOIN coach c ON jc.coach_id=c.id WHERE jadwal_harian_id=".$harian_d['id']." ORDER BY jc.id ASC");
                    if($coach_q and $mysql->num_rows($coach_q)>0) {
                        while($coach_d=$mysql->fetch_assoc($coach_q)) {
                            $temp_coach[]=$coach_d;
                        }
                    }
                    $data[$jadwal_d['id']]['harian'][]=array('data'=>$harian_d,'coach'=>$temp_coach);
                }
            }
           // var_dump($data);
          
        }
    }
    return $data;
}
function ringkasan_view($kegiatan_id) {
$ringkasan_jadwal=ringkasan_jadwal($kegiatan_id);
$temp='<div class="table-responsive">';
$temp.='<table class="table header-border">';
$temp.='
<tr>
<th>No</th>
<th>Kegiatan</th>
<th>Jenis</th>
<th>Jadwal</th>
<th>Coach</th>
<th>Action</th>
</tr>
';
$no=1;
foreach($ringkasan_jadwal as $x => $data ) {
    
   // $jadwal=ymd_to_dmy($data['data']['tanggal_mulai'],true)." s/d ".ymd_to_dmy($data['data']['tanggal_selesai'],true);
 

  
    $pertama=true;
    foreach( $data['harian'] as $i => $harian) {
        
        $coach_view=coach_view($harian['coach']);
        $jadwal=tanggal_jadwal($harian['data']['jam_mulai'],$harian['data']['jam_selesai']);
        
        if($pertama) {
            $action_button='';
            if($data['data']['status_selesai']<=0) {
                $action_button=btn_edit(backendurl("jadwal/edit/".$data['data']['id']));
            }
           
            if($data['data']['status_selesai']<=0) {
                $action_button.=btn_done(backendurl("jadwal/selesai/".$data['data']['id']));
            }
            if($data['data']['status_selesai']<=0) {
                $action_button.=btn_delete_swal(backendurl("jadwal/del/".$data['data']['id']));
            }
            //if($data['data']['status_selesai']<=0) {
            $action_button.=btn_add_user(backendurl("jadwal/peserta/".$data['data']['id']));
            //}
            $temp.='<tr>';
            $temp.='<td valign="top">'.$no.'</td>';
            $temp.='<td valign="top">'.$data['data']['kegiatan_judul'].'</td>';
            $temp.='<td valign="top">'.$data['data']['jenis_kegiatan'].'</td>';
            $temp.='<td valign="top">'.$jadwal.'</td>';
            $temp.='<td valign="top">'.$coach_view.'</td>';
            $temp.='<td valign="top">'.$action_button.'</td>';
            //<a href="'.fronturl("registrasi/".md5($data['data']['kegiatan_id']."-".$data['data']['id'])).'">Link</a>
            $temp.='</tr>';
            $pertama=false;
        } else {
            $temp.='<tr>';
            $temp.='<td valign="top">&nbsp;</td>';
            $temp.='<td valign="top">&nbsp;</td>';
            $temp.='<td valign="top">&nbsp;</td>';
            $temp.='<td valign="top"> '.$jadwal.'</td>';
            $temp.='<td valign="top">'.$coach_view.'</td>';
            $temp.='<td valign="top">&nbsp;</td>';
            $temp.='</tr>';
        }
        
    }
    $no++;
}
$temp.='</table>';
$temp.='</div>';
return $temp;
}

function coach_view($coaches) {
   
    $temp='<table class="table header-border table-hover verticle-middle" border="0" cellpadding="0" cellspacing=""';
    $no=1;
    foreach($coaches as $coach ) {
        $temp.='<tr style="border:none;">';
        $temp.='<td style="display:none;">'.$no.'</td>';
        $temp.='<td style="width:15px;">'.$coach['id_trainer'].'</td>';
        $temp.='<td style="text-align:left;">'.$coach['nama'].'</td>';
        $temp.='</tr>';
        $no++;
    }
    $temp.='</table>';
    return $temp;
}



function data_peserta($jadwal_id) {
    global $mysql;
    $data=$mysql->query_data("SELECT p.id personal_id,p.nama_lengkap,p.nama_panggilan,p.whatsapp,p.email,l.lembaga_nama,w.nama lembaga_kota 
    FROM jadwal_peserta j 
    LEFT JOIN personal p ON j.personal_id=p.id 
    LEFT JOIN lembaga l ON l.id=p.lembaga_id
    LEFT JOIN wilayah w ON w.id=l.lembaga_kota
    WHERE j.jadwal_id=$jadwal_id 
    ORDER BY p.nama_lengkap 
    ");
    return $data;
}
function tabel_list_peserta($jadwal_id) {
    global $mysql;
    $data_peserta=data_peserta($jadwal_id);
    $temp='<table class="table header-border table-hover verticle-middle" border="0" cellpadding="0" cellspacing=""';
    $temp.='<tr >';
    $temp.='<td>No</td>';
    $temp.='<td>Nama Lengkap</td>';
    $temp.='<td>Nama Panggilan</td>';
    $temp.='<td>Whatsapp</td>';
    $temp.='<td>Email</td>';
    $temp.='<td>Lembaga</td>';
    $temp.='<td>Action</td>';
    $temp.='</tr>';
    $no=1;
    foreach($data_peserta as $i => $peserta ) {
        $url=backendurl("jadwal/hapus_kepesertaan?jadwal_id=$jadwal_id&personal_id=".$peserta['personal_id']);
        $temp.='<tr>';
        $temp.='<td>'.$no.'</td>';
        $temp.='<td >'.$peserta['nama_lengkap'].'</td>';
        $temp.='<td>'.$peserta['nama_panggilan'].'</td>';
        $temp.='<td>'.$peserta['whatsapp'].'</td>';
        $temp.='<td>'.$peserta['email'].'</td>';
        $temp.='<td>'.$peserta['lembaga_nama']." ".$peserta['lembaga_kota'].'</td>';
        $temp.='<td>'.btn_delete_swal($url).'</td>';
        $temp.='</tr>';
        $no++;
    }
    $temp.='</table>';
    return $temp;
}
function find_personal($keyword) {
    global $mysql;
   
    $data=$mysql->query_data("SELECT p.id,p.nama_lengkap,p.nama_panggilan,p.whatsapp,p.email,l.lembaga_nama,w.nama lembaga_kota 
    FROM personal p 
    LEFT JOIN lembaga l ON l.id=p.lembaga_id
    LEFT JOIN wilayah w ON w.id=l.lembaga_kota
    WHERE 
        p.nama_lengkap like '%$keyword%' OR
        p.whatsapp like '%$keyword%'
    
    ");
    return $data;
}
?>