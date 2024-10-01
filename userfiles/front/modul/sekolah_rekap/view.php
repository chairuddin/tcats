<?php
if($_SESSION['f_id']==""){
	header("location:".fronturl("sekolah_login"));
	exit();
}
//set action awal
if($action==""){$action="view";}
//ambil data kelas
$data_kelas=array();
$q=$mysql->query("SELECT id,nama FROM quiz_school_class WHERE school_id=".$_SESSION['f_id']);
if($q and $mysql->numrows($q)>0){
	while($d=$mysql->assoc($q)){
	$id_kelas[]=$d['id'];	
	$data_kelas[$d['id']]=$d['nama'];	
	}
}
echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-md-12">';
echo '
<div style="padding-top:15px;">
<a href="'.fronturl("get_excel_rekap").'">
<button type="button" class="btn btn-primary pull-right ">
  <span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download
</button>
</a>
</div>';
echo '<ul class="nav nav-tabs">';
foreach($id_kelas as $i =>$v){
	//set id awal
	if($id=="" AND $i==0){
		$id=$v;
	}
	$active=(($id=="" AND $i=0) OR ($v==$id))?"active":"";
	echo '<li role="presentation" class="'.$active.'"><a href="'.fronturl("sekolah_rekap/view/".$v).'">'.nama_kelas($data_kelas[$v]).'</a></li>';
}
echo '</ul>';

echo '<br/>';

if($action=="view"){
//ambil data id kelas
	$id_kelas=$id;	
	$kelas=$data_kelas[$id_kelas];
//ambil data jadwal
	$r_schedule_id=array();
	$sql=array();
	
		
	$q_jadwal=$mysql->query("
	SELECT q.id,date_format(q.tanggal,'%Y-%m-%d') tanggal,q.tanggal_expired,q.quiz_id,m.title_id FROM quiz_schedule q LEFT join quiz_master m ON q.quiz_id=m.id  WHERE FIND_IN_SET('$kelas',q.allow_class)  
	");
	if($q_jadwal and $mysql->numrows($q_jadwal)>0){
		while($d_jadwal=$mysql->assoc($q_jadwal)){
			$r_schedule_id[]=array("kelas"=>$v,"schedule_id"=>$d_jadwal['id'],"tanggal"=>$d_jadwal['tanggal'],"expired"=>$d_jadwal['tanggal_expired'],"quiz_id"=>$d_jadwal['quiz_id'],"quiz_title"=>$d_jadwal['title_id']);		
		}
	}
	
//ambil data siswa	
	$data_siswa=$mysql->query_data("SELECT id,username,fullname FROM quiz_member WHERE class='$kelas' ORDER BY fullname ","id");

//ambil nilai per jadwal
	$data_ujian=array();
	foreach($r_schedule_id as $i =>$jadwal){
		$data_ujian[$jadwal['schedule_id']]=$mysql->query_data("SELECT id,score,member_id FROM quiz_done WHERE schedule_id=".$jadwal['schedule_id'],"member_id");
	}
//rata2	
	$hasil_akhir=array();	
	$total_rata2=array();
	$ranking=array();
	foreach($data_siswa as $x => $siswa){
		foreach($r_schedule_id as $i =>$jadwal){
				$rata2[$siswa['id']][]=$data_ujian[$jadwal['schedule_id']][$siswa['id']]['score'];
		}
		$total_rata2[$siswa['id']]=round(array_sum($rata2[$siswa['id']])/count($r_schedule_id),2);
		$ranking_rata2[]=$total_rata2[$siswa['id']];
	}
//peringkat

$rankings = array_unique($ranking_rata2);
rsort($rankings);
$return = array();
foreach($total_rata2 as $i => $value)
{	
    $rankedValue = array();
    $rankedValue['value'] = $value;
    $rankedValue['rank'] = array_search($value, $rankings) + 1;
    $return[] = $rankedValue;
    $peringkat[$i]=$rankedValue['rank'];
}

//Hasil Akhir

//////CETAK//////
echo '<table id="example" class="display" style="width:100%">';
echo '<thead>';
echo '<tr>';
echo '<th>No</th>';
echo '<th>Kode Peserta</th>';
echo '<th>Nama</th>';
foreach($r_schedule_id as $i =>$jadwal){
echo '<th>'.clean_quiz_title($jadwal['quiz_title']).'</th>';
}
echo '<th>Rata2</th>';
echo '<th>Peringkat</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
$nomor=0;
$rata2=array();
foreach($data_siswa as $x => $siswa){
$nomor++;
echo '<tr>';
echo '<td>'.$nomor.'</td>';
echo '<td>'.$siswa['username'].'</td>';
echo '<td>'.$siswa['fullname'].'</td>';
	foreach($r_schedule_id as $i =>$jadwal){
		$rata2[$siswa['id']][]=$data_ujian[$jadwal['schedule_id']][$siswa['id']]['score'];
		echo '<td>'.$data_ujian[$jadwal['schedule_id']][$siswa['id']]['score'].'</td>';
	}

echo '<td>'.$total_rata2[$siswa['id']].'</td>';
echo '<td>'.$peringkat[$siswa['id']].'</td>';	
echo '</tr>';
}
echo '</tbody>';
echo '<tfoot>';
echo '<tr>';
echo '<th>No</th>';
echo '<th>Kode Peserta</th>';
echo '<th>Nama</th>';
foreach($r_schedule_id as $i =>$jadwal){
echo '<th>'.clean_quiz_title($jadwal['quiz_title']).'</th>';
}
echo '<th>Rata2</th>';
echo '<th>Peringkat</th>';
echo '</tr>';
echo '</tfoot>';
echo '</table>';	
}
echo '</div>';
echo '</div>';
echo '</div>';
?>

<?php
$script_js[]=<<<END
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
END;
?>
