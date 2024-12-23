<?php
$hariini=date("Y-m-d H:i:s");
if($action=="custom_score") {
	
	if($_GET['custom_score']==2) {
		
		if($_GET['sub_action']=='edit'){
				$q=$mysql->query("SELECT poin_A,poin_B,poin_C,poin_D,poin_E,poin_F,poin_G,poin_H,poin_I,poin_J FROM quiz_master WHERE id=".$_GET['sub_id']);
				$data=$mysql->fetch_assoc($q);
				
				foreach($pilihan_ganda as $pil_gan) {
			      $default_score[$pil_gan]=$data['poin_'.$pil_gan];		
				}
				
		} else {
			$default_score = array(
			'A'=>100,
			'B'=>90,
			'C'=>80,
			'D'=>70,
			'E'=>60,
			'F'=>50,
			'G'=>40,
			'H'=>30,
			'I'=>20,
			'J'=>10,
			);
		}
		echo '<div style="border:1px solid #cecece; padding:15px;">';
		echo '<div class="row" style="">';
		echo '<div class="col-md-12"><p>Isian dalam bentuk persen(%) </p></div>';
		foreach($pilihan_ganda as $pil_gan) {
			$form_poin=$form->element_Textbox("Poin $pil_gan","poin_{$pil_gan}",array('autocomplete'=>'off','value'=>$default_score[$pil_gan]));
			echo '<div class="col-md-1 col-sm-4 col-xs-4">'.$form_poin.'</div>';
		}
		echo '</div>';
		echo '</div>';
	} else {
	
	}
	die();
}
if($action=="add" OR $action=="edit")
{
$list_sylabus=$mysql->get_assoc('id','name','master_sylabus','name');
$list_grade=$mysql->get_assoc('nama','nama','quiz_grade','nama');
$list_guru=$mysql->get_assoc('id','fullname','user','fullname');
if($action=='edit') {
	$q=$mysql->query("
	SELECT 
		*
	FROM
		quiz_master WHERE id=$id
	");
	$d=$mysql->assoc($q);
	foreach($d as $field => $value) {
		$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
	}
	
}
//default value add
$_POST['custom_score']=$_POST['custom_score']==''?0:$_POST['custom_score'];
$_POST['custom_score']=3; /* dipaksa 3 */


$_POST['score']=$_POST['score']==''?100:$_POST['score'];
$_POST['score_essay']=$_POST['score_essay']==''?100:$_POST['score_essay'];
$_POST['is_random']=$_POST['is_random'];
$_POST['is_random_option']=$_POST['is_random_option'];
$_POST['duration']=$_POST['duration']==''?90:$_POST['duration'];
$_POST['kkm']=$_POST['kkm']==''?70:$_POST['kkm'];

//end default value
$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";

//$form_grade= $form->element_Select("Pilih Grade","grade",$list_grade );
$form_code=$form->element_Textbox("Kode Soal","code");
$form_title_id=$form->element_Textbox("Nama Soal","title_id");
$form_keterangan=$form->element_Textbox("Keterangan","keterangan");
$form_duration=$form->element_Textbox("Durasi (menit)","duration");
//"2"=>"Manual",
//$form_model_skor= $form->element_Select("Model Skor PG","custom_score",array("0"=>"Skor Otomatis","3"=>"Skor Bobot & Kompetensi","4"=>"Skor Otomatis Paket Soal (A & B)"),array("onchange"=>"model_skor();") );
//,"4"=>"Skor Otomatis Paket Soal (A & B)"
$form_model_skor= $form->element_Select("Model Skor PG","custom_score",array("3"=>"Skor Bobot & Kompetensi"),array("onchange"=>"model_skor();") );
$form_score_pg=$form->element_Textbox("Skor PG(maksimal)","score");
$form_score_essay=$form->element_Textbox("Skor Essay(maksimal)","score_essay");
$form_kkm=$form->element_Textbox("KKM","kkm");
$form_total_pg=$form->element_Textbox("Jumlah Soal Pilihan Ganda","pg_total");
$form_total_essay=$form->element_Textbox("Jumlah Soal Essay","essay_total");

$form_is_random= $form->element_Select("Acak Soal","is_random",array("1"=>"Ya","0"=>"Tidak") );
$form_is_random_option= $form->element_Select("Acak Pilihan Jawaban (A,B,C,D,E)","is_random_option",array("1"=>"Ya","0"=>"Tidak") );

$form_created_by= $form->element_Select("Guru Mapel","created_by",$list_guru );
$form_sylabus= $form->element_Select("Sylabus","id_sylabus",$list_sylabus );



echo <<<END
  <div class="card card-navy">
              <div class="card-header">
                <h3 class="card-title">$label_action Master Soal</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" id="form-member"  class="form-horizontal yona-validation" action="$do_action"  novalidate enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
                <div class="card-body">
				  <div class="row">
					<div class="col-md-6">
						
						<div class="form-group">
							$form_code                 
						</div>
						<div class="form-group">
							$form_title_id                
						</div>
						<div class="form-group">
							$form_duration                    
						</div>
						<div class="form-group">
							$form_model_skor                    
						</div>
						<div class="form-group" >
						  <div  id="form_custom_score">
						  </div>
						</div>
						<div class="form-group">
							$form_score_pg                    
						</div>
						<!--
						<div class="form-group">
							$form_score_essay                 
						</div>
						<div class="form-group">
							$form_total_pg                    
						</div>
						<div class="form-group">
							$form_total_essay                 
						</div>
						-->

					</div>
					<div class="col-md-6">
						<div class="form-group">
						$form_kkm                   
						</div> 
						<div class="form-group">
						$form_keterangan                
						</div>
						<div class="form-group">
						$form_is_random                   
						</div>
						<div class="form-group">
						$form_is_random_option                   
						</div>              
						<!--    
						<div class="form-group">
						$form_created_by                   
						</div>
						-->
						<!--
						<div class="form-group">
						$form_sylabus                   
						</div>
						-->
					</div>
				  </div>
                 
                 
                <div class="card-footer">
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

END;


$url_custom_score=backendurl("$modul/custom_score?&custom_score=");
if($action=="edit" AND $_POST['custom_score']==2) {
	$url_custom_score=backendurl("$modul/custom_score?&sub_action=edit&sub_id=$id&custom_score=");
		/*buat load ajax untuk custom score manual*/
	$load_js_custom_score=<<<END
	   var jqxhr = $.get( "{$url_custom_score}2}", function(data) {
		document.getElementById("form_custom_score").innerHTML=data;
	   }).done(function() {
		 
	  }).fail(function() {
			Swal.fire({
			icon: 'error',
			title: 'Gagal request data',
			text: 'Silahkan refresh halaman',
			});
	  });
END;

}



$script_js .=<<<END
<script>
function model_skor() {
	custom_score = document.getElementById("custom_score").value;
   var jqxhr = $.get( "$url_custom_score"+custom_score, function(data) {
	document.getElementById("form_custom_score").innerHTML=data;
   }).done(function() {
     
  }).fail(function() {
		Swal.fire({
		icon: 'error',
		title: 'Gagal request data',
		text: 'Silahkan refresh halaman',
		});
  });
}
$(document).ready(function(){
$load_js_custom_score
});
</script>
END;
}
if($action=="view" or $action=="")
{
$btn_tambah=button_add("$modul/add");
//$btn_excel=button_excel("$modul/import_excel");
//$btn_excel&nbsp;&nbsp;
echo <<<END
<div class="card card-navy">
		<div class="card-header">
		  <h3 class="card-title">$form_title</h3>
		  <div class="float-right">$btn_tambah</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th style="width:40px;">No</th>
				<th>Soal</th>
				<th style="width:80px;">Action</th>
				</tr>
				</thead>
				</table>
		</div>
		<!-- /.card-body -->
	  </div>
</div>
END;
}
if($action=="data") {
	
	$column_order = array('m.id','m.code','m.title_id','m.kkm','m.duration');
	$column_search = array('m.code','m.grade','m.title_id','m.kkm','m.duration');
	$order = array('m.id' => 'DESC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY m.code DESC ";
	}
	if ($_POST['length'] != -1 AND $_POST['length']!="") {
		$where_limit = "LIMIT {$_POST['start']}, {$_POST['length']}";
	}
	$i = 0;
	$sql_search=array();
	foreach ($column_search as $item) { // loop column 
		
		if($_POST['search']['value']) { // if datatable send POST for search
			
			$sql_search[]= " $item LIKE '%{$_POST['search']['value']}%' ";
		}
		$i++;
	}
	
	if(count($sql_search)>0){
	$sql_r[]=" ".join(" OR ",$sql_search)." ";
	}
	/*
	<th>Kode</th>
				<th>Judul</th>
				<th>Durasi</th>
				<th>KKM</th>
				<th>Acak</th>
				<th>Soal</th>
				*/ 
	/*
	$sql=" 
	SELECT 
	
		id,
		code,
		title_id,
		kkm,
		duration
	FROM 
		quiz_master
		";
	
	$sql.=" WHERE 1=1 ";
	* */
	
	$sql="SELECT m.*,
	(select count(id) from quiz_detail q WHERE q.quiz_id=m.id  ) multiple,
	(select count(id) from quiz_complex q WHERE q.quiz_id=m.id  ) complex,
	(select count(id) from quiz_essay q WHERE q.quiz_id=m.id  ) essay,
	u.username,u.fullname,('$hariini' <= DATE_ADD(created_date, INTERVAL 5 MINUTE)) soal_baru 
	FROM 
		quiz_master m 
		LEFT JOIN user u ON m.created_by=u.id WHERE 1=1 ";
	if($_SESSION['s_level']==0){
	//$sql_r[]="m.created_by='".$_SESSION['s_id']."'";
	//$sql_r[]="m.grade IN ($config_join_grade) ";
	}
	if(count($sql_r)>0){
		$sql.=" AND  (".join(" OR ",$sql_r).") ";
	}
	
	$result_total = $mysql->query($sql);
	$total=$mysql->num_rows($result_total);
	$sql .= " $order_by $where_limit";
	
	$result = $mysql->query($sql);
	
	$data = array();
	

	$gotopage = $_POST['start']/$_POST['length'];
	$no = $_POST['start'];
	while($d = $mysql->fetch_assoc($result)) {

		$no++;
		$row = array();
		$jumlah_soal="(PG:".$d['multiple']." | ".$d['duration']." Menit"." | KKM:".$d['kkm'].")";
		$row[]=$no;
		$row[]='<b>'.$d['code'].'</b><br/>'.$d['title_id'].($d['keterangan']!=""?'<br/><i>'.$d['keterangan'].'</i>':'').'<br/>'.$jumlah_soal.'<br/><b>'.$d['fullname'].'</b>';
		//$row[]=$d['kkm'];
		//$row[]=$d['duration'];
		//$row[]=$d['multiple']."|".$d['essay'];
		//$row[]=$d['custom_score']==0?"A":"M";
		$action_add="";
		if($d['custom_score']==3) {
		$action_add=btn_kd(backendurl("quiz_master/kd?id_soal=".$d['id']));
		}
		if($d['custom_score']==4) {
			$action_add=btn_kd(backendurl("quiz_master/kd_silabus?id_soal=".$d['id']));
			$action_add.=btn_addA(backendurl("quiz_detail/view?paket=A&id_soal=".$d['id']));
			$action_add.=btn_addB(backendurl("quiz_detail/view?paket=B&id_soal=".$d['id']));
		
		
		
		} else {
			$action_add.=btn_add(backendurl("quiz_detail/view?id_soal=".$d['id']));
		
		}
		$action_edit=btn_edit(backendurl("$modul/edit/".$d['id']));
		
		if($id_user==$d['created_by'] or $_SESSION['s_level']>=1) {
			$action_delete=btn_delete(backendurl("$modul/del/".$d['id']));
		} else {
			$action_delete='';
		}
		/*
		$action_edit='<a href="'.backendurl("$modul/edit/".$d['id']).'"><i class="fas fa-edit" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		$action_delete='<a class=""  title="Hapus buku"
				data-toggle="modal" 
				data-target="#modal-default" 
				data-title="Hapus data" 
				data-body="Apakah anda yakin ingin menghapus data ini?"
				data-btn2=""
				data-btn2name=""
				data-btn1="'.backendurl("$modul/del/".$d['id']).'"
				data-btn1name="Hapus"
				>
				<i class="fas fa-trash"></i>
		</a>';
		*/
		$row[]='<div class="btn-group btn-group-sm">'.$action_add.$action_view.$action_edit.$action_delete.'</div>';
		
		$data[] = $row;
	}
	
	
	$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $total,
		"recordsFiltered" => $total,
		"data" => $data
	);
	die(json_encode($output));
}
if($action=="kd" or $action=="edit_kd") {
$col_tambah="";
$quiz_id=cleanInput($_GET['id_soal']);
$label_action="Tambah";
$do_action="save_kd";
if($action=="edit_kd") {
	$q_kd=$mysql->query("SELECT quiz_id,title_id,nomor_soal,score_max,kkm FROM quiz_kd WHERE id=$id");
	$d_kd=$mysql->fetch_assoc($q_kd);
	$quiz_id=$d_kd['quiz_id'];
	$_POST['title_id']=$d_kd['title_id'];
	$_POST['nomor_soal']=$d_kd['nomor_soal'];
	$_POST['score_max']=$d_kd['score_max'];
	$_POST['kkm']=$d_kd['kkm'];
	$label_action="Edit";
	$do_action="update_kd";
}
$form_title="Kompetensi Dasar <br/>".$mysql->get1value("SELECT title_id FROM quiz_master WHERE id=$quiz_id");
if($quiz_id=="")
{
	msg_warning("Master soal tidak ada","error");
	header("location:".backendurl("$modul"));
	exit();
}

/*
$form = new Form("newkd");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery", "focus"),
	"action" =>backendurl("$modul/save_kd") 
));


$form->addElement(new Element_HTML('<legend>Tambah Kompentensi Dasar</legend>'));
$form->addElement(new Element_Hidden("newkd", "reguser"));
$form->addElement(new Element_Hidden("quiz_id", $quiz_id));
$form->addElement(new Element_Textbox("Nama Kompetensi", "title_id", array("required" => 1,"value"=>$d['title_id'])));
$form->addElement(new Element_Textbox("Nomor Soal", "nomor_soal", array("required" => 1,"style"=>"width:auto;","placeholder"=>"ex: 1,2,3","value"=>$d['nomor_soal'])));
$form->addElement(new Element_Textbox("Skor Maksimal", "score_max", array("required" => 1,"style"=>"width:50px;","value"=>$d['score_max'])));
$form->addElement(new Element_Textbox("KKM", "kkm", array("required" => 1,"style"=>"width:50px;","value"=>$d['kkm'])));
$form->addElement(new Element_Button(_SIMPAN,"submit",array("value" => "Simpan","name"=>"simpan")));
$form->addElement(new Element_Button(_BATAL, "button", array(
	"onclick" => "history.go(-1);"
)));
$form->render();
*/

$do_action=backendurl("$modul/$do_action");
$form_title_id=$form->element_Textbox("Nama Kompetensi","title_id");
$form_nomor_soal=$form->element_Textbox("Nomor Soal","nomor_soal",array("placeholder"=>"ex: 1,2,3"));
$form_score_max=$form->element_Textbox("Skor Maksimal","score_max");
$form_kkm=$form->element_Textbox("KKM","kkm");


echo <<<END
		<div class="card card-navy">
              <div class="card-header">
                <h3 class="card-title">$label_action Kompetensi Dasar</h3>
              </div>
              <div class="card-body">
                <form role="form" method="POST" id="form-member"  class="form-member yona-validation" action="$do_action"  novalidate enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
				<input type="hidden" name="quiz_id" value="$quiz_id" />
             
                  <div class="form-group">
                    $form_title_id                 
                  </div>
                  <div class="form-group">
                    $form_nomor_soal                 
                  </div>
                  <div class="form-group">
                    $form_score_max                 
                  </div>
                  <div class="form-group">
                    $form_kkm                 
                  </div>
                  
                <div class="card-footer">
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
		</div>
            <!-- /.card -->

END;

ob_start();
$q=$mysql->query("SELECT * FROM quiz_kd WHERE quiz_id=$quiz_id");

if($q and $mysql->numrows($q) >0) 
{
	echo '<table id="datakompetensitables" class="view-table table table-nomargin table-bordered">';
	echo '<thead>
	<tr>
	<th>KD</th>
	<th>Nomor Soal</th>
	<th style="width:70px;">Skor Maks</th>
	<th style="width:70px;">KKM</th>
	<th>Action</th>
	</tr>
	</thead>
	';
	echo '<tbody>';
	$no=1;
	while($d=$mysql->assoc($q)) {
	
	$action_edit=btn_edit(backendurl($modul).'/edit_kd/'.$d['id']);
	$action_delete=btn_delete(backendurl($modul).'/del_kd/'.$d['id']);
	
	echo '<tr>
	<td>'.$d['title_id'].'</td>
	<td  style="text-align:left;">'.$d['nomor_soal'].'</td>
	<td  style="text-align:center;">'.$d['score_max'].'</td>
	<td  style="text-align:center;">'.$d['kkm'].'</td>
	<td>
	<div class="btn-group btn-group-sm">'.$action_edit.$action_delete.'
	</td>
	</tr>';
	$no++;
	}
	echo '</tbody>';
	echo '</table>';
} else {
	echo '<p>Silahkan buat KD terlebih dahulu</p>';
}
$soal_ada_kd = ob_get_clean();

echo <<<END
		<div class="card card-navy">
              <div class="card-header">
                <h3 class="card-title">Kompetensi Dasar</h3>
              </div>
			  <div class="card-body">
					$soal_ada_kd
			  </div>
        </div>
            <!-- /.card -->

END;

}

if($action=='kd' OR $action=='edit_kd') {
$kdq=$mysql->query("SELECT id,nomor_soal,title_id FROM quiz_kd WHERE quiz_id=$quiz_id");
$kd_r=array();
$kd_data=array();
if($kdq and $mysql->numrows($kdq)>0) {
	while($dkd=$mysql->assoc($kdq)) {
			$temp=explode(",",$dkd['nomor_soal']);
			$kd_r=array_merge($kd_r,$temp);
			$kd_data[]=array('title_id'=>$dkd['title_id'],'nomor_soal'=>$dkd['nomor_soal']);
	}
}

$kd_soal=array();
$q1=$mysql->query("SELECT * FROM quiz_detail WHERE quiz_id=$quiz_id ORDER BY urutan ");
if($q1 and $mysql->numrows($q1)>0) {

	while($d1=$mysql->assoc($q1)) {
		if(!in_array($d1['urutan'],$kd_r)) {
			$kd_soal[]= '<div class="soal-kd" style="border:1px solid #cecece;padding:15px;margin-bottom:5px;fon"><span class="soal-kd-urutan" style="font-weight:bold;font-size:16pt;">('.$d1['urutan'].')</span><br/>'.$d1['question'].'</div>';
		}
	}	
}
if(count($kd_soal)>0) {
	ob_start();
	echo join(" ",$kd_soal);
	$belum_ada_kd=ob_get_clean();
echo <<<END
		<div class="card card-navy">
              <div class="card-header">
                <h3 class="card-title">Daftar soal belum memiliki KD</h3>
              </div>
			  <div class="card-body">
					$belum_ada_kd
			  </div>
        </div>
            <!-- /.card -->

END;

} 

ob_start();
echo '<br/>';
if(count($kd_data)>0) {
	//echo join(" ",$kd_soal);
	$valid=true;
	foreach($kd_data as $i => $r_data) {
		echo '<form method="post" action="#bobot'.$i.'">';
		echo '<input type="hidden" name="posisi" value="bobot'.$i.'">';
		if($_POST['posisi']=="bobot$i") {
			foreach($_POST['bobot'] as $id_detail => $bobot){
				$update=$mysql->query("UPDATE quiz_detail SET bobot=$bobot WHERE quiz_id=$quiz_id AND id=$id_detail");
				if(!$update){
					$valid=false;
				}
			}
			if($valid) {
				$_SESSION['sub_msg']['bobot'.$i]='
					<div class="alert alert-success">
					<button data-dismiss="alert" class="close" type="button">×</button>
					Update bobot berhasil
					</div>
				';
			} else {
				$_SESSION['sub_msg']['bobot'.$i]='
					<div class="alert alert-warning">
					<button data-dismiss="alert" class="close" type="button">×</button>
					Gagal update bobot
					</div>
				';
			}
			header("location:".backendurl("quiz_master/kd?id_soal=$quiz_id#bobot$i"));
			die();
		}
		echo '<div class="bobot-kd" id="bobot'.$i.'">';
		echo '<h4>'.$r_data['title_id'].'</h4>';
		echo $_SESSION['sub_msg']['bobot'.$i];
		echo '<table border="1" cellpadding="5">';
		echo '<tr><th>No. Soal</th><th>Bobot</th></tr>';
		//<th style="text-align:left;">Soal</th>
		$qsoal=$mysql->query("SELECT * FROM quiz_detail WHERE quiz_id=$quiz_id AND urutan IN (".$r_data['nomor_soal'].") ORDER BY urutan ");
		if($qsoal and $mysql->numrows($qsoal)>0) {
			while($dsoal=$mysql->assoc($qsoal)) {
			//<td style="vertical-align:top;"><div style="display:none;">'.$dsoal['question'].'</div></td>	
			echo '<tr><td style="vertical-align:top;text-align:center;width:100px;">'.$dsoal['urutan'].'</td><td style="vertical-align:top;text-align:center;width:70px;"><input type="number" style="width:40px;text-align:center;" onfocus="this.select();" min="1" max="10"  name="bobot['.$dsoal['id'].']" value="'.$dsoal['bobot'].'" /></td></tr>';	
			}
		}
		echo '<tr><tr><td colspan="4"><input type="submit" name="save_bobot" value="Simpan"/></td></tr></tr>';	
		echo '</table>';
		echo '</div><br/>';
		echo '</form>';
	}
} else {
	echo '<p>Silahkan buat KD terlebih dahulu</p>';
}
$update_bobot=ob_get_clean();
echo <<<END
		<div class="card card-navy">
              <div class="card-header">
                <h3 class="card-title">Kelola KD</h3>
              </div>
			  <div class="card-body">
					$update_bobot
			  </div>
        </div>
            <!-- /.card -->

END;


}

if($action=="kd_silabus") {
	
	$quiz_id=cleanInput($_GET['id_soal']);
	list($data)=$mysql->query_data("SELECT * FROM quiz_master WHERE id=".$quiz_id);
	$competency=$mysql->query_data("SELECT * FROM sylabus_detail_competency WHERE id_sylabus_detail IN (SELECT id FROM sylabus_detail WHERE id_master_sylabus='".$data['id_sylabus']."')");
	
	
	$option_kd = array();
	foreach($competency as $i => $kd) {
		$option_kd[$kd['id']]=$kd['code'];
	}
	
	
	if($data['pg_total']>0) {

	/*jika ada post*/
	if($_POST['submit_pg']) {
		
		for($i=1;$i<=$data['pg_total'];$i++) {
			$post_pg[$_POST['kd_pg_'.$i]][]=$i;
		}
		$reset_kd=$mysql->query("DELETE FROM quiz_kd WHERE quiz_id=$quiz_id AND nomor_soal<>''");
		$created_by=$_SESSION['s_id'];
		foreach($post_pg as $id_competency => $nomor) {
				 $join_nomor=join(",",$nomor);
				 $kode=$option_kd[$id_competency];
				 $insert_kd=$mysql->query(" INSERT into quiz_kd SET quiz_id=$quiz_id,id_competency=$id_competency,title_id='$kode',nomor_soal='$join_nomor',score_max=0,kkm=0,created_by='$created_by',created_date='$hariini'");
		}
	}
	if($_POST['submit_essay']) {
		
		for($i=1;$i<=$data['essay_total'];$i++) {
			$post_essay[$_POST['kd_essay_'.$i]][]=$i;
		}
		$reset_kd=$mysql->query("DELETE FROM quiz_kd WHERE quiz_id=$quiz_id AND nomor_soal_essay<>''");
		$created_by=$_SESSION['s_id'];
		foreach($post_essay as $id_competency => $nomor) {
				 $join_nomor=join(",",$nomor);
				 $kode=$option_kd[$id_competency];
				 $insert_kd=$mysql->query(" INSERT into quiz_kd SET quiz_id=$quiz_id,id_competency=$id_competency,title_id='$kode',nomor_soal_essay='$join_nomor',score_max=0,kkm=0,created_by='$created_by',created_date='$hariini'");
		}
	}
	/*end jika ada post*/
	
	/*Load kd dari database*/
	$quiz_kd = $mysql->query_data("SELECT id_competency,title_id,nomor_soal,nomor_soal_essay FROM quiz_kd WHERE quiz_id=$quiz_id ");
	foreach($quiz_kd as $i => $kd) {
		if($kd['nomor_soal']!='') {
			$r_nomor=explode(",",$kd['nomor_soal']);
			foreach($r_nomor as $x => $no) {
				$_POST['kd_pg_'.$no]=$kd['id_competency'];
			}
		}
		if($kd['nomor_soal_essay']!='') {
			$r_nomor=explode(",",$kd['nomor_soal_essay']);
			foreach($r_nomor as $x => $no) {
				$_POST['kd_essay_'.$no]=$kd['id_competency'];
			}
		}
	}
	/*End load kd dari database*/
	
	
	$li=array();
	$li[]='<ul>';
	for($i=1;$i<=$data['pg_total'];$i++) {
		$post_pg[$_POST['kd_pg_'.$i]][]=$i;
		$li[]='<li>'.$form->element_Select("KD Soal $i","kd_pg_$i",$option_kd).'</li><br/>';
	}
	
	$li[]='</ul>';
	$list_li_pg=join("\r\n",$li);
	
	echo <<<END
		<div class="card card-navy">
              <div class="card-header">
                <h3 class="card-title">Penyesuaian Kompetensi Pilihan Ganda</h3>
              </div>
			  <div class="card-body">
					<form method="post" action="">
					$list_li_pg
					<button type="submit" name="submit_pg" value="1">Simpan</button>
					</form>
			  </div>
        </div>
            <!-- /.card -->
END;
	
	}

	if($data['essay_total']>0) {
	
	$li=array();
	$li[]='<ul>';
	for($i=1;$i<=$data['essay_total'];$i++) {
		$li[]='<li>'.$form->element_Select("KD Essay No $i","kd_essay_$i",$option_kd).'</li><br/>';
	}
	$li[]='</ul>';
	$list_li_essay=join("\r\n",$li);
	
	echo <<<END
		<div class="card card-navy">
              <div class="card-header">
                <h3 class="card-title">Penyesuaian Kompetensi Essay</h3>
              </div>
			  <div class="card-body">
					<form method="post" action="">
					$list_li_essay
					<button type="submit" name="submit_essay" value="1">Simpan</button>
					</form>
			  </div>
        </div>
            <!-- /.card -->
END;
	
	}

$style_css.=<<<END
<style>
label {
    margin-right: 19px;
    float: left;
    line-height: 40px;
}
select {
	width: 200px !important;
}
</style>

END;

}

unset($_SESSION['sub_msg']);
?>
