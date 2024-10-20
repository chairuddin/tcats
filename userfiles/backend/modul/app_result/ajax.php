<?php
if($id=="ujian_realtime")
{
ob_start();
$update=0;
$realtime_array=$_POST['realtime_array'];
$realtime_array=json_decode($realtime_array,true);
$hariini_long=date("Y-m-d H:i:s");
$kondisi=" AND is_deleted=0 ";
$sql_r=array();

if($_SESSION['s_level']==0){
$sql_r[]="  quiz_id IN (SELECT id FROM quiz_master WHERE created_by='".$_SESSION['s_id']."')";
//$kondisi.=" AND FIND_IN_SET IN (quiz_id,SELECT id FROM quiz_master WHERE created_by='".$_SESSION['s_id']."' )";
		if($is_wali_kelas){
			if(count($config_wali_kelas)>0) {
				foreach($config_wali_kelas as $kelas) {
					$sql_r[]=" FIND_IN_SET('$kelas',allow_class) ";
				}
			
			}
		}
if(count($sql_r)>0) {
	$kondisi.=" AND (".join(" or ",$sql_r).")";
}
		
}
$q=$mysql->query("SELECT * FROM quiz_schedule WHERE  '$hariini_long'  BETWEEN tanggal AND DATE_ADD(tanggal_expired, INTERVAL + 40 Minute) $kondisi");
if($q and $mysql->numrows($q)>0){
	
	
		while($d=$mysql->assoc($q)){
				
		$id=$d['id'];
		$info_ujian = info_ujian($id);

		$jadwal=$mysql->query("SELECT  allow_class,quiz_info,token FROM quiz_schedule WHERE id=$id")->fetch_assoc();

		$quiz_info=json_decode($jadwal['quiz_info'],true);
		$token=$jadwal['token'];
		$kelas=$jadwal['allow_class'];
		$r_kelas = explode(",",$kelas);
		$join_kelas = "'".join("','",$r_kelas);
		$nama_kelas_sambung = join(", ",$r_kelas);

		$tampilan_jumlah_kelas='';
		foreach($r_kelas as $x => $value) {
		$total_peserta = $mysql->get1value("SELECT count(id)+0 jml FROM quiz_member WHERE class='$value' ");	
		$sudah_ujian = $mysql->get1value("SELECT count(id) jml FROM quiz_done WHERE member_class='$value'  AND schedule_id= $id ");	
		$tombol_download='';
		if($sudah_ujian>0) {
			$tombol_download='<a href="'.fronturl("get_excel/?schedule_id=".$id."&class=$value").'"><span class="progress-download-xls"><i class="fas fa-download"></i>&nbsp;Excel</span></a>&nbsp;&nbsp;&nbsp;';
		}
		$belum_ujian = $total_peserta - $sudah_ujian; 
		$persen = ($sudah_ujian / $total_peserta) * 100;
		$persen = round($persen,2);
		$tampilan_jumlah_kelas .= '
					<div class="progress-group">
					  '.$value.'
					  <span class="float-right">'.$tombol_download.'<b>'.$sudah_ujian.'</b>/'.$total_peserta.'</span>
					  <div class="progress progress-sm">
						<div class="progress-bar bg-success" style="width: '.$persen.'%"></div>
					  </div>
					</div>
		';
		}
		/*JUMLAN PESERTA BERDASARKAN KELAS*/
		$url_belum_ujian = backendurl("quiz_realtime/?filter=belum_ujian&schedule_id=$id");
		$url_sedang_ujian = backendurl("quiz_ongoing/?filter=sedang_ujian&schedule_id=$id");
		$url_pending_ujian = backendurl("quiz_ongoing/?filter=pending&schedule_id=$id");
		$url_sudah_ujian = backendurl("quiz_ongoing/?filter=sudah_ujian&schedule_id=$id");
		
		
		if($realtime_array[$d['id']]['re']!=$info_ujian['reset_ujian'] OR 
		$realtime_array[$d['id']]['be']!=$info_ujian['belum_ujian'] OR
		$realtime_array[$d['id']]['se']!=$info_ujian['sedang_ujian'] OR
		$realtime_array[$d['id']]['su']!=$info_ujian['sudah_ujian']){
			$update=1;
		}	
		$realtime_array[$d['id']]=array("be"=>$info_ujian['belum_ujian'],"re"=>$info_ujian['reset_ujian'],"se"=>$info_ujian['sedang_ujian'],"su"=>$info_ujian['sudah_ujian']);
		

echo <<<END
		<div class="card">
		  <div class="card-header">
			<h3 class="card-title">Monitor Ujian $quiz_info[title_id]</h3><br/>
			<div class="card-tools">
			  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
			  </button>
			</div>
		  </div>
		  <!-- /.card-header -->
		  <div class="card-body">
			<div class="row">
			  <div class="col-md-6">
			  <table>
					<tr><td valign="top">Token</td><td valign="top">:</td><td>$token</td></tr>
					<tr><td valign="top">Kode</td><td valign="top">:</td><td>$quiz_info[code]</td></tr>
					<tr><td valign="top">Soal</td><td valign="top">:</td><td>$quiz_info[title_id]</td></tr>
					<tr><td valign="top">Durasi</td><td valign="top">:</td><td>$quiz_info[duration] Menit</td></tr>
					<tr><td valign="top">Kelas</td><td valign="top">:</td><td><div style="font-size:10pt;">$nama_kelas_sambung</div></td></tr>
				</table>
			  </div>
			  <div class="col-md-3">
				<div class="chart-responsive">
				  <canvas id="pieChart$id" height="150"></canvas>
				</div>
				<!-- ./chart-responsive -->
			  </div>
			  <!-- /.col -->
			  <div class="col-md-3">
				<ul class="chart-legend clearfix">
				  <li>
					  <a  class="badge badge-secondary" href="$url_belum_ujian">Belum($info_ujian[belum_ujian]/$info_ujian[total_peserta]) $info_ujian[belum_ujian_prosentase]%</a>
				  </li>
				  <li>
					<a class="badge badge-warning" href="$url_sedang_ujian">Sedang($info_ujian[sedang_ujian]) $info_ujian[sedang_ujian_prosentase]% </a>
					
					</li>
				  <li>
					<a class="badge badge-danger" href="$url_pending_ujian">Pending($info_ujian[reset_ujian]) $info_ujian[reset_ujian_prosentase]%</a>
					</li>
				  <li>
					<a class="badge badge-success" href="$url_sudah_ujian">Sudah($info_ujian[sudah_ujian]/$info_ujian[total_peserta]) $info_ujian[sudah_ujian_prosentase]%  </a>
					</li>
				</ul>
			  </div>
			  <!-- /.col -->
			</div>
			<!-- /.row -->
		  </div>
		  <!-- /.card-body -->
		</div>
		<!-- /.card -->

END;

echo <<<END
<script>
$(document).ready(function(){
var pieChartCanvas = $('#pieChart$id').get(0).getContext('2d')
    var pieData        = {
      labels: [
          'Belum Ujian', 
          'Sedang Ujian',
          'Pending Ujian',
          'Sudah Ujian' 
      ],
      datasets: [
        {
          data: [$info_ujian[belum_ujian],$info_ujian[sedang_ujian],$info_ujian[reset_ujian],$info_ujian[sudah_ujian]],
          backgroundColor : ['#d2d6de', '#f39c12', '#f56954', '#00a65a'],
        }
      ]
    }
    var pieOptions     = {
      legend: {
        display: false
      }
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions      
    })
});
</script>
END;
	}
	$realtime_array=json_encode($realtime_array);
	echo "<input id=\"realtime_hidden\" type=\"hidden\" value='$realtime_array' />";
}
$data=ob_get_clean();
if($update==1){
echo $data;
}else{
echo 1;
}
}
exit();
?>
