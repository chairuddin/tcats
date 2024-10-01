<?php
$maxfilesize='500000';
$cfg_thumb_width='200';
$cfg_max_width='200';


b_load_lib("YonaForm");
$validation = new YonaValidation();
$form = new YonaForm();
$login_session=get_login_session();

$validation->set_validation(array('var'=>'fullname','label'=>'Nama'))->required();
$validation->set_validation(array('var'=>'alamat','label'=>'Alamat'))->required();
$validation->set_validation(array('var'=>'asal_instansi','label'=>'Asal Instansi'))->required();

$validation->generate_js_validation();

$data_login=get_login_session();

if($_POST['submit'] && $validation->valid()){
		$namasaja="profile_$id_member_".time();
		
		$valid=true;
		$fullname=cleanInput($_POST['fullname']);
		$alamat=cleanInput($_POST['alamat']);
		$asal_instansi=cleanInput($_POST['asal_instansi']);
		$id_member=$data_login['id'];
		$field_foto='';
		/** /
		if($_POST['foto64']!="") {
			$namafile="$namasaja.jpg";
			$targetPathBig = $path_images."/source/$namafile";
			base64_to_jpeg($_POST['foto64'],$targetPathBig);
			list($filewidth, $fileheight, $filetype, $fileattr) = getimagesize($targetPathBig);
				
			if ($filewidth > $cfg_max_width) {
				//rename sambil resize gambar asli sesuai yang diizinkan
				$hasilresize = resize($targetPathBig, $targetPathBig, 'l', $cfg_max_width);
				//rename($targetPathBig, $targetPath);
			}
			$field_foto =", foto='$namafile' "; 
			
			$old_foto=$mysql->get1value("SELECT foto FROM quiz_member WHERE id=$id_member");
			if($old_foto!="" and file_exists("$path_images/source/$old_foto")) {
				unlink("$path_images/source/$old_foto");
			}
		}
		/**/
		/**/
		if(is_uploaded_file($_FILES["foto"]['tmp_name'])) {
			$sourcePath = $_FILES["foto"]['tmp_name'];
			$path = $_FILES["foto"]['name'];
			$ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
			
			$namafile="$namasaja.$ext";
			$targetPath = $path_images."/$namafile";
			$targetPathSmall = $path_images."/thumbs/$namafile";
			$targetPathBig = $path_images."/source/$namafile";
			
			$hasilupload = upload("foto", $path_images_large,$namasaja, $maxfilesize="50000000",$allowedtypes="gif,jpg,jpeg,png");
			
			if($hasilupload==_SUCCESS) {
			
				list($filewidth, $fileheight, $filetype, $fileattr) = getimagesize($targetPathBig);
				
				if ($filewidth > $cfg_max_width) {
					//rename sambil resize gambar asli sesuai yang diizinkan
					$hasilresize = resize($targetPathBig, $targetPathBig, 'l', $cfg_max_width);
					//rename($targetPathBig, $targetPath);
				} 
				$field_foto =", foto='$namafile' ";
			} else {
				$valid=false;
				$msg=", Foto gagal terupdate";
			}
		}
		/**/
		

		if($valid) {
			
			$update_profil= $mysql->query("UPDATE quiz_member SET fullname='$fullname', alamat='$alamat', asal_instansi='$asal_instansi' $field_foto WHERE id=$id_member ");
			if(!$update_profil) {$valid=false;}
		}
			
		if($valid){
			sweetalert2($type="success"," Update profil berhasil $msg",fronturl("siswa/dashboard"));
		} else {			
			sweetalert2($type="warning"," Update profil gagal $msg.",fronturl("siswa/edit_profil"));
		}

		
		
}
$qexisting=$mysql->query("SELECT fullname,alamat,asal_instansi,foto FROM quiz_member WHERE id=".$data_login['id']);
if($qexisting) {
	$dexisting=$mysql->fetch_assoc($qexisting);
	$_POST['fullname']=$dexisting['fullname'];
	$_POST['alamat']=$dexisting['alamat'];
	$_POST['asal_instansi']=$dexisting['asal_instansi'];

}

$form_foto=$form->element_File("","foto",array("autocomplete"=>"off", "accept"=>"image/*","onchange"=>"loadFile(event)" ));
//$form_foto=$form->element_File("","foto",array("id"=>"foto", "autocomplete"=>"off", "accept"=>"image/*","onchange"=>"proccessData()" ));
//$form_foto64=$form->element_Textbox("foto64","foto64",array("id"=>"foto64") );
//$form_foto64=$form->element_Textarea("foto64","foto64",array("id"=>"foto64") );
$form_nama=$form->element_Textbox("Nama","fullname",array("autocomplete"=>"off"));
$form_alamat=$form->element_Textbox("Alamat","alamat",array("autocomplete"=>"off"));
$form_instansi=$form->element_Textbox("Asal Institusi","asal_instansi",array("autocomplete"=>"off"));
$thumbnail_foto='<img id="preview_foto" style="max-width:150px;" src="" />';

if(file_exists($path_images_large."/".$dexisting['foto'])) {
	$thumbnail_foto_url=$url_images_large."/".$dexisting['foto'];
	$thumbnail_foto='<img id="preview_foto" style="max-width:150px;" src="'.$thumbnail_foto_url.'" />';
}

?>
<div class="card card-custom">
	  <div class="card-header border-0">
		<h3 class="card-title">Edit Profil</h3>
	  </div>
	  <div class="card-body table-responsive p-0">
		  <div style="padding:15px;">
			
		  </div>		
		  <form role="form" method="POST" id="form-member"  class="form-member yona-validation" action="<?php fronturl("siswa/edit_profil")?>"  novalidate enctype="multipart/form-data">
				
                <div class="card-body">
				
				<div class="form-group">
					<span><?php echo $thumbnail_foto;?></span>            
				</div>
				<div class="form-group">
					<?php echo $form_foto;?>            
				</div>
				
				<?php echo $form_foto64;?>
                  
                  <div class="form-group">
                    <?php echo $form_nama;?>            
                   </div>
                   
                  <div class="form-group">
                    <?php echo $form_alamat	;?>            
                   </div>
                  <div class="form-group">
                    <?php echo $form_instansi	;?>            
                   </div>
                   

                <div class="card-footer">
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
                </div>
              </form>
	  </div>
	</div>

<?php
$script_js.=<<<END
<script>

var loadFile = function(event) {
	var image = document.getElementById('preview_foto');
	image.src = URL.createObjectURL(event.target.files[0]);
	
};


</script>
END;
?>
