<?php
/*

$q_cabang=$mysql->query("SELECT id,nama FROM master_cabang ");
$option_cabang=array();
if($q_cabang and $mysql->num_rows($q_cabang))  {
	if($mysql->num_rows($q_cabang)>1) {
	  $option_cabang['']='Pilih Cabang';
	}
	while($d_cabang=$mysql->fetch_assoc($q_cabang)) 
	{
		$option_cabang[$d_cabang['id']]=$d_cabang['nama'];
	}
}

$q_jenjang=$mysql->query("SELECT id,nama FROM master_kelas ");
$option_jenjang=array();
if($q_jenjang and $mysql->num_rows($q_jenjang))  {
	if($mysql->num_rows($q_jenjang)>1) {
	  $option_jenjang['']='Pilih Jenjang';
	}
	while($d_jenjang=$mysql->fetch_assoc($q_jenjang)) 
	{
		$option_jenjang[$d_jenjang['id']]=$d_jenjang['nama'];
	}
}

$q_paket=$mysql->query("SELECT id,nama FROM master_paket WHERE status_aktif=1");
$option_paket=array();
if($q_paket and $mysql->num_rows($q_paket))  {
	if($mysql->num_rows($q_paket)>1) {
	  $option_paket['']='Pilih program yg akan diikuti';
	}
	while($d_paket=$mysql->fetch_assoc($q_paket)) 
	{
		$option_paket[$d_paket['id']]=$d_paket['nama'];
	}
}


$q_masa_program=$mysql->query("SELECT id,nama FROM master_masa_program ");
$option_masa_program=array();
if($q_masa_program and $mysql->num_rows($q_masa_program))  {
	if($mysql->num_rows($q_masa_program)>1) {
	  $option_masa_program['']='Pilih masa program';
	}
	while($d_masa_program=$mysql->fetch_assoc($q_masa_program)) 
	{
		$option_masa_program[$d_masa_program['id']]=$d_masa_program['nama'];
	}
}

$q_pola_hari=$mysql->query("SELECT id,nama FROM master_pola_hari ");
$option_pola_hari=array();
if($q_pola_hari and $mysql->num_rows($q_pola_hari))  {
	if($mysql->num_rows($q_pola_hari)>1) {
	  $option_pola_hari['']='Pilih pola hari';
	}
	while($d_pola_hari=$mysql->fetch_assoc($q_pola_hari)) 
	{
		$option_pola_hari[$d_pola_hari['id']]=$d_pola_hari['nama'];
	}
}

$q_info=$mysql->query("SELECT id,nama FROM master_info ");
$option_info=array();
if($q_info and $mysql->num_rows($q_info))  {
	if($mysql->num_rows($q_info)>1) {
	  $option_info['']='Pilih program yg akan diikuti';
	}
	while($d_info=$mysql->fetch_assoc($q_info)) 
	{
		$option_info[$d_info['id']]=$d_info['nama'];
	}
}
*/
$form_nama_lengkap=$form->element_Textbox("Nama Lengkap","nama_lengkap");
$form_nama_panggilan=$form->element_Textbox("Nama Panggilan","nama_panggilan");
$form_email=$form->element_Textbox("Email","email");
$form_alamat=$form->element_Textbox("Alamat","alamat");
$form_sekolah_asal=$form->element_Textbox("Asal Sekolah","sekolah_asal");
$form_nomor_hp		= $form->element_Textbox("No HP Siswa","nomor_hp");
$form_masa_program= $form->element_Select("Daftar untuk program","masa_program",$option_masa_program);
$form_check=$form->element_Checkbox("Apakah data yang diisikan sudah benar","form_check",array("value"=>"1")); 
//$do_action=fronturl("$modul/save");
$do_action="";
?>
	<section class="page_search pt--50 bg--white">
			
	</section>
	<!-- Start BEst Seller Area -->
	<section class="wn__product__area brown--color pt--80  pb--30">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section__title text-center">
						<h2 class="title__be--2">Formulir Pendaftaran</span></h2>
						<p></p>
					</div>
				</div>
			</div>
			
			<form role="form" method="POST" id="form-member"  class="form-member yona-validation" action="<?php echo $do_action;?>"  novalidate enctype="multipart/form-data">
			<div class="row">
			<div class="col-md-6 col-md-offset-3">
		
					<div class="card card-primary">
					  <div class="card-header">
					  </div>
					  
						<input type="hidden" name="id" value="$id" />
						<div class="card-body">
						  <div class="form-group">
							<?php echo $form_nama_lengkap; ?>
						  </div>
						  <div class="form-group">
							<?php echo $form_email; ?>                    
						  </div>
						  <div class="form-group">
							<?php echo $form_alamat; ?>                    
						  </div>
						  <div class="form-group">
							<?php echo $form_sekolah_asal; ?>                    
						  </div>
						  <div class="form-group">
							<?php echo $form_nomor_hp; ?>                    
						  </div>
						   <div class="form-group">
							<?php echo $form_check; ?>                    
						  </div>
						</div>
						<div class="card-footer">
						   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
						</div>

						
					</div>
					
				</div>
			
			</div>
			</form>
		</div>
	</section>

<?php
$form->release_data();
?>
