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
$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";

$form_npsn=$form->element_Textbox("NPSN","npsn",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_whatsapp=$form->element_Textbox("Whatsapp","pic_whatsapp",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_tanggal_lahir=$form->element_Date("Tanggal Lahir","pic_tanggal_lahir",array(),$mode=array('label'=>4,'input'=>8));
$jadwal_id=cleanInput($_GET["jadwal_id"]);
$do_action=fronturl("$modul/save");
$link_login=fronturl("login/$id");
$_SESSION['link_jadwal_id']=$id;
echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">$kegiatan_judul</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" autocomplete="off" class="yona-validation" method="POST" action="$do_action" enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
				<input type="hidden" name="jadwal_id" value="$jadwal_id" />
                <div class="card-body">
				<div class="row">
				<div class="col-md-5">
					<div class="form-group row">
					$form_npsn
					</div>	
					<div class="form-group row">
					$form_pic_whatsapp
					</div>
					<div class="form-group row">
					$form_pic_tanggal_lahir
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
