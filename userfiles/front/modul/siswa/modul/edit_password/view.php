<?php

b_load_lib("YonaForm");
$validation = new YonaValidation();
$form = new YonaForm();
$login_session=get_login_session();

$validation->set_validation(array('var'=>'password_lama','label'=>'Password Lama'))->minlength(6)->required();
$validation->set_validation(array('var'=>'password_baru1','label'=>'Password Baru'))->minlength(6)->required();
$validation->set_validation(array('var'=>'password_baru2','label'=>'Ketik Ulang Password Baru'))->minlength(6)->required();

$validation->generate_js_validation();

if($_POST['submit'] && $validation->valid()){
		$valid=true;
		$password_lama=md5("quizroom_".$_POST['password_lama']);
		$password_baru1=$_POST['password_baru1'];
		$password_baru2=$_POST['password_baru2'];
		$data_login=get_login_session();
		
		if($password_lama!='') {
			$password_cocok=$mysql->get1value("SELECT count(id) FROM quiz_member WHERE password='$password_lama' ");
			if($password_cocok<=0) {
				$validation->set_validation(array('var'=>'password_lama','label'=>'Password Lama'))->custom_msg(1,"Password lama Salah");
			}
		}
		if($password_baru1!=$password_baru2) {
			$validation->set_validation(array('var'=>'password_baru1','label'=>'Password Baru'))->custom_msg(1,"Password b tidak sama");
			$validation->set_validation(array('var'=>'password_baru2','label'=>'Ketik Ulang Password Baru'))->custom_msg(1,"Password baru tidak sama");
		}
		
		if(!$validation->valid()) {
			$valid=false;
		}
		if($valid) {
			$id_member=$data_login['id'];
			$password_baru=md5("quizroom_".$_POST['password_baru1']);		
			$update_password= $mysql->query("UPDATE quiz_member SET password='$password_baru' WHERE id=$id_member ");
			if(!$update_password) {$valid=false;}
		}
			
		if($valid){
			sweetalert2($type="success"," Update password berhasil",fronturl("siswa/dashboard"));
		} else {			
			sweetalert2($type="warning"," Update password gagal. ",fronturl("siswa/edit_password"));
		}

		
		
}

$form_password_lama=$form->element_Password("Password Lama","password_lama",array("placeholder"=>"******","autocomplete"=>"off"));
$form_password_baru1=$form->element_Password("Password Baru","password_baru1",array("placeholder"=>"******","autocomplete"=>"off"));
$form_password_baru2=$form->element_Password("Password Baru","password_baru2",array("placeholder"=>"******","autocomplete"=>"off"));


?>
<div class="card card-custom">
	  <div class="card-header border-0">
		<h3 class="card-title">Edit Password</h3>
	  </div>
	  <div class="card-body table-responsive p-0">
		  <form role="form" method="POST" id="form-member"  class="form-member yona-validation" action="<?php fronturl("siswa/edit_password")?>"  novalidate enctype="multipart/form-data">
				
                <div class="card-body">
              
                  <div class="form-group">
                    <?php echo $form_password_lama;?>            
                    <small id="passwordLamaHelp" class="form-text text-muted">Masukkan password lama</small>   
                  </div>
                  <div class="form-group">
                    <?php echo $form_password_baru1;?>                
                    <small id="passwordBaru1Help" class="form-text text-muted">Ketik password baru</small>   
                  </div>
                  <div class="form-group">
                   <?php echo $form_password_baru2;?>            
                    <small id="passwordBaru2Help" class="form-text text-muted">Ketik ulang password baru</small>   
                  </div>
                   

                <div class="card-footer">
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
                </div>
              </form>
	  </div>
	</div>

