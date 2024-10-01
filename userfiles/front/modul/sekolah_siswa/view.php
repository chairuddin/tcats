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

$q_siswa=$mysql->query("SELECT q.username,q.fullname,q.class FROM quiz_member q WHERE q.class IN($join_class) ORDER BY q.username,q.class");
?>
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="page-header">
 <h1>Data Siswa</h1>
</div>
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
			<?php
			if($q_siswa AND $mysql->numrows($q_siswa)>0){
				while($d_siswa=$mysql->assoc($q_siswa)){
				?>
				<tr>
					<td><?php echo $d_siswa['username'];?></td>
					<td><?php echo $d_siswa['fullname'];?></td>
					<td><?php echo nama_kelas($d_siswa['class']);?></td>
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
