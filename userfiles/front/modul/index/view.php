<?php
if($web_config_mode_login==1) {
	header("location:".fronturl("siswa"));
	exit();
} else {
	header("location:".fronturl("quiz_login"));
	exit();
}

?>
<div class="container">
<div class="row">

	<div class="col-md-6">
		<div class="pilihan-login">
		<img class="img-responsive" src="<?php echo fileurl("asset/school.svg")?>">
		<p>
			Halaman guru untuk mengakses nilai hasil ujian
		</p>
		<?php
		if($web_config_allow_teacher){
		?>
		<a href="<?php echo fronturl("sekolah_login");?>"> <button type="button" class="btn btn-primary">Login Guru</button></a>
		<?php
		}else{
		?>
		<button type="button" class="btn btn-disabled">Login Guru</button>
		<?php
		}
		?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="pilihan-login">
		<img class="img-responsive" src="<?php echo fileurl("asset/smartphone.svg")?>">
		<p>
			Halaman siswa untuk mengakses halaman ujian
		</p>
		<a href="<?php echo fronturl("quiz_login");?>"> <button type="button" class="btn btn-primary">Mulai Ujian</button></a>
	</div>
	</div>

</div>
<div class="row">

	<div class="col-md-12">
		<p>
			&nbsp;
			<br/>
			<br/>
			<br/>
			<br/>
		</p>
	</div>

</div>
