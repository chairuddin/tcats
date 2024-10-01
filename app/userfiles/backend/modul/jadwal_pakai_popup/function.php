<?php
function ringkasan_jadwal($kegiatan_id) {
    global $mysql;
    $jadwal_q=$mysql->query(" SELECT id,kegiatan_id,kegiatan_judul,waktu_mulai,waktu_selesai  FROM jadwal WHERE kegiatan_id=$kegiatan_id ORDER BY waktu_mulai asc");
    $data=array();
    if($jadwal_q and $mysql->num_rows($jadwal_q)>0) {
        while($jadwal_d = $mysql->fetch_assoc($jadwal_q)) {
            $temp_coach=array();
            $coach_q=$mysql->query(" SELECT c.id_trainer,c.nama FROM jadwal_coach jc LEFT JOIN coach c ON jc.coach_id=c.id WHERE jadwal_id=".$jadwal_d['id']." ORDER BY jc.id ASC");
            if($coach_q and $mysql->num_rows($coach_q)>0) {
                while($coach_d=$mysql->fetch_assoc($coach_q)) {
                    $temp_coach[]=$coach_d;
                }
            }
            $data[]=array('data'=>$jadwal_d,'coach'=>$temp_coach);
        }
    }
    return $data;
}
function ringkasan_view($kegiatan_id) {
$ringkasan_jadwal=ringkasan_jadwal($kegiatan_id);
$temp='<div class="table-responsive">';
$temp.='<table class="table table-hover">';
$temp.='
<tr>
<th>No</th>
<th>Kegiatan</th>
<th>Jadwal</th>
<th>Coach</th>
<th>Link</th>
</tr>
';
$no=1;
foreach($ringkasan_jadwal as $x => $data ) {
    
   // $jadwal=ymd_to_dmy($data['data']['waktu_mulai'],true)." s/d ".ymd_to_dmy($data['data']['waktu_selesai'],true);
   $jadwal=tanggal_jadwal($data['data']['waktu_mulai'],$data['data']['waktu_selesai']);
    $coach_view=coach_view($data['coach']);
    $temp.='<tr>';
    $temp.='<td valign="top">'.$no.'</td>';
    $temp.='<td valign="top">'.$data['data']['kegiatan_judul'].'</td>';
    $temp.='<td valign="top"> '.$jadwal.'</td>';
    $temp.='<td valign="top">'.$coach_view.'</td>';
    $temp.='<td valign="top"><a href="'.fronturl("registrasi/".md5($data['data']['kegiatan_id']."-".$data['data']['id'])).'">Link</a></td>';
    $temp.='</tr>';
    $no++;
}
$temp.='</table>';
$temp.='</div>';
return $temp;
}

function coach_view($coaches) {
   
    $temp='<table class="table">';
   
    $no=1;
    foreach($coaches as $coach ) {
        
      
        $temp.='<tr>';
        $temp.='<td>'.$no.'</td>';
        $temp.='<td>'.$coach['id_trainer'].'</td>';
        $temp.='<td>'.$coach['nama'].'</td>';
        $temp.='</tr>';
        $no++;
    }
    $temp.='</table>';
    return $temp;
    }

?>