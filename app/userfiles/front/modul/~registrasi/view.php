<?php


if($action=="form")
{
$id=cleanInput($id);
$r=$mysql->query("SELECT * from jadwal where concat(md5(concat(kegiatan_id,'G')),'-',md5(concat(id,'G')))='$id' AND status_selesai=0 ");
if($r and $mysql->num_rows($r)>0) {

} else {
	//redirect to page link broken
	die('link broken');
}
$d=$mysql->assoc($r);
$kegiatan_judul=$d['kegiatan_judul'];
/*
foreach($d as $field => $value) {
	$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
}
*/

$_POST['expired']=($_POST['expired']=='' or $_POST['expired']=='0000-00-00')?date("d/m/Y"):ymd_to_dmy($_POST['expired']);
$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";

$option_lembaga_jenis=option_lembaga_jenis();
$option_lembaga_jenjang=option_lembaga_jenjang();
$option_lembaga_status=array(
	''=>'Pilih Status',
	'N'=>'Negeri',
	'S'=>'Swasta'
);

if($action=="edit") {
	$_POST['harga']=currency($_POST['harga']);
}

$option_kota=array();
$list_kota=list_kota();
$option_kota[]='Pilih';
foreach($list_kota as $index =>$r_kota) {
	$option_kota[$r_kota['id']]=$r_kota['nama'];
}

$option_kelamin=array(
	''=>'Pilih Jenis Kelamin',
	'1'=>'Laki-laki',
	'2'=>'Perempuan',
);

$option_status_pekerjaan=array(
	''=>'Pilih ',
	'1'=>'Pengurus yayasan',
	'2'=>'GTK/PTK',
);

$form_lembaga_jenjang=$form->element_Select("Jenjang Lembaga","lembaga_jenjang",$option_lembaga_jenjang,array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_status=$form->element_Select("Status","lembaga_status",$option_lembaga_status,array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_kota=$form->element_Select("Kota","lembaga_kota",$option_kota,array('class'=>'select2'),$mode=array('label'=>4,'input'=>8));

$form_npsn=$form->element_Textbox("NPSN","npsn",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_nama=$form->element_Textbox("Nama Lembaga","lembaga_nama",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_alamat=$form->element_Textarea("Alamat","lembaga_alamat",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_telp=$form->element_Textbox("Telp","lembaga_telp",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_email=$form->element_Textbox("Email","lembaga_email",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_website=$form->element_Textbox("Website","lembaga_website",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_tahun_berdiri=$form->element_Textbox("Tahun Berdiri","lembaga_tahun_berdiri",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_ulang_tahun=$form->element_Textbox("Ulang Tahun","lembaga_ulang_tahun",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_jumlah_siswa=$form->element_Textbox("Jumlah Siswa","lembaga_jumlah_siswa",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_biaya_spp=$form->element_Textbox("Biaya SPP Sekolah","lembaga_biaya_spp",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_biaya_pendaftaran=$form->element_Textbox("Biaya Pendaftaran","lembaga_biaya_pendaftaran",array(),$mode=array('label'=>4,'input'=>8));
$form_status_pekerjaan=$form->element_Select("Status saat ini","status_pekerjaan",$option_status_pekerjaan,array('class'=>'select2'),$mode=array('label'=>4,'input'=>8));

$form_pic_nama_lengkap=$form->element_Textbox("Nama Lengkap","pic_nama_lengkap",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_nama_panggilan=$form->element_Textbox("Nama Panggilan","pic_nama_panggilan",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_kelamin=$form->element_Select("Jenis Kelamin","pic_kelamin",$option_kelamin,array(),$mode=array('label'=>4,'input'=>8));
$form_pic_whatsapp=$form->element_Textbox("Whatsapp","pic_whatsapp",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_email=$form->element_Textbox("Email","pic_email",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_tanggal_lahir=$form->element_Date("Tanggal Lahir","pic_tanggal_lahir",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_agama=$form->element_Textbox("Agama","pic_agama",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_jabatan=$form->element_Textbox("Jabatan","pic_jabatan",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_tahun_menjabat=$form->element_Textbox("Tahun Menjabat","pic_tahun_menjabat",array(),$mode=array('label'=>4,'input'=>8));
$jadwal_id=cleanInput($_GET["jadwal_id"]);
$do_action=fronturl("$modul/save");
$link_login=fronturl("login/form/$id");
$_SESSION['link_jadwal_id']=$id;
echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">$kegiatan_judul</h3>
				<div style="float:right"><a href="$link_login">Login</a></div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" autocomplete="off" class="yona-validation" method="POST" action="$do_action" enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
				<input type="hidden" name="jadwal_id" value="$jadwal_id" />
                <div class="card-body">
				<div class="row">
				<div class="col-md-5">
					<h5>Data Lembaga</h5>
					<div class="form-group row">
						$form_lembaga_jenis
					</div>	
				
					<div class="form-group row field-sekolah">
						$form_npsn
					</div>	
					
					<div class="form-group row field-yayasan field-lembaga" >
						$form_npyp
					</div>
					<div class="form-group row field-ngo field-lembaga" >
						$form_kode
					</div>	
					<div class="form-group row field-lembaga">
						$form_lembaga_nama
					</div>		
					<div class="form-group row field-lembaga">
						$form_lembaga_jenjang
					</div>
					<div class="form-group row field-lembaga">
						$form_lembaga_status
					</div>
					<div class="form-group row field-lembaga">
						$form_lembaga_alamat
					</div>	
					<div class="form-group row field-lembaga">
						$form_lembaga_kota
					</div>	
					<div class="form-group row field-lembaga">
						$form_lembaga_telp
					</div>	
					<div class="form-group row field-lembaga">
						$form_lembaga_email
					</div>
					<div class="form-group row field-lembaga">
						$form_lembaga_website
					</div>
					<div class="form-group row field-lembaga">
						$form_lembaga_tahun_berdiri
					</div>	
					<div class="form-group row field-lembaga">
						$form_lembaga_ulang_tahun
					</div>
					
					
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-5">
				<h5>Data Personal</h5>
					<div class="form-group row">
					$form_status_pekerjaan
					</div>	
					<div class="form-group row">
					$form_pic_nama_lengkap
					</div>		
					<div class="form-group row">
					$form_pic_nama_panggilan
					</div>
					<div class="form-group row">
					$form_pic_kelamin
					</div>
					<div class="form-group row">
					$form_pic_whatsapp
					</div>
					<div class="form-group row">
					$form_pic_email
					</div>
					<div class="form-group row">
					$form_pic_tanggal_lahir
					</div>
					<div class="form-group row">
					$form_pic_agama
					</div>
					<div class="form-group row">
					$form_pic_jabatan
					</div>
					<div class="form-group row">
					$form_pic_tahun_menjabat
					</div>
					
				</div>
				</div>
				 
				  
				  
					
				
				 
				
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" class="btn btn-primary" value="1">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

END;
}
if($action=="import_excel")
{
$url_download =backendurl("$modul/download_template");
$do_action=backendurl("$modul/upload_xls");
echo <<<END
	  <div class="card card-navy">
				  <div class="card-header">
					<h3 class="card-title">Import data personal</h3>
				  </div>
				  <!-- /.card-header -->
				  <!-- form start -->
				  <form role="form" method="POST" id="form-member"  class="form-member yona-validation" action="$do_action"  novalidate enctype="multipart/form-data">
					<input type="hidden" name="id" value="$id" />
					<div class="card-body">
					  <div class="form-group">
						<p>Langkah langkah import peserta :</p>
						<p>1. Silahkan download template(.xls)
						<br/><a href="$url_download" class="btn btn-success">Download Template Excel</a>
						</p>
						<p>2. Silahkan isi template yang sudah di download dengan format yang sesuai</p>
						<p>3. Silahkan upload kembali template yang sudah terisi</p>
						<p>Pilih template yang sudah terisi <br/><input type="file" required="required" name="filename" accept="xls/*"  /></p>
						
					  </div>
		 
					<div class="card-footer">
					   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;
					   <button type="submit" name="submit" value="1" class="btn btn-primary">Upload Peserta</button>
					</div>
				  </form>
				</div>
				<!-- /.card -->
	
END;

}

?>
