<?php
if($_SESSION['f_id']==""){
	header("location:".fronturl("sekolah_login"));
	exit();
}
function nama_kelas($nama_gabung){
	list($kelas)=explode("-",$nama_gabung);
	return trim($kelas);
}

//ambil data sekolah
$nama_sekolah=$_SESSION['f_fullname'];
//ambil data kelas
$data_kelas=array();
$q=$mysql->query("SELECT nama FROM quiz_school_class WHERE school_id=".$_SESSION['f_id']);
if($q and $mysql->numrows($q)>0){
	while($d=$mysql->assoc($q)){
	$data_kelas[]=$d['nama'];	
	}
}
$join_class="'".join("','",$data_kelas)."'";
//$join_class
$r_schedule_id=array();
$sql=array();
foreach($data_kelas as $i =>$v){
	
	$q_jadwal=$mysql->query("
	SELECT q.id,date_format(q.tanggal,'%Y-%m-%d') tanggal,q.tanggal_expired,q.quiz_id,m.title_id FROM quiz_schedule q LEFT join quiz_master m ON q.quiz_id=m.id  WHERE FIND_IN_SET('$v',q.allow_class)  
	");
	if($q_jadwal and $mysql->numrows($q_jadwal)>0){
		while($d_jadwal=$mysql->assoc($q_jadwal)){
			
			$r_schedule_id[]=array("kelas"=>$v,"schedule_id"=>$d_jadwal['id'],"tanggal"=>$d_jadwal['tanggal'],"expired"=>$d_jadwal['tanggal_expired'],"quiz_id"=>$d_jadwal['quiz_id'],"quiz_title"=>$d_jadwal['title_id']);		
		}
	}
}

?>
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="page-header">
 <h1>Hasil Ujian</h1>
</div>
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Kelas</th>
                <th>Ujian</th>
                <th>Tanggal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
			<?php
			
			if(count($r_schedule_id)>0){
				foreach($r_schedule_id as $i =>$data){
				?>
				<tr>
					<td><?php echo nama_kelas($data['kelas']);?></td>
					<td><?php echo $data['quiz_title'];?></td>
					<td><?php echo $data['tanggal'];?></td>
					<td>
					<a href="<?php echo fronturl("get_excel/?schedule_id=".$data['schedule_id']."&class=".$data['kelas']);?>">	
					<button class="btn btn-primary" type="button">
					  <span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download
					</button>
					</a></td>
				</tr>
				<?php
				}
            }
             
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>
</div>
</div>
<?php
$script_js[]=<<<END
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
END;
?>
