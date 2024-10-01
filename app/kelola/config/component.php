<?php
function btn_generic($url,$fa='',$color="",$params=array()) {
	$par='';
	if(count($params)>0) {
		foreach($params as $attribut => $data) {
			$par.=" $attribut='$data' ";
		}
	}
	return '<a class="btn btn-xs '.$color.'" href="'.$url.'" '.$par.' style="margin-right:5px;"><i class="fa '.$fa.' fa-1x"></i></a>';
}
function btn_jadwal($url,$params=array()) {
	return btn_generic($url,"fa-calendar","btn-info",$params);	
}
function btn_call($url,$params=array()) {
	return btn_generic($url,"fa-phone","btn-info",$params);
}
function btn_folder($url,$params=array()) {
	return btn_generic($url,"fa-folder","btn-info",$params);
}

function btn_deal($url,$params=array()) {
	return btn_generic($url,"fa-money","btn-success",$params);
}
function btn_access($url,$params=array()) {
	return btn_generic($url,"fa-lock","btn-info",$params);
	//return '<a class="btn" href="'.$url.'"><i class="fa fa-lock fa-1x"></i></a>';
}
function btn_new($url, $params=array()) {
	return btn_generic($url,"fa-plus","btn-info",$params);
	//return '<a class="btn btn-success" href="'.$url.'"><i class="fa fa-plus fa-1x"></i></a>';
}
function btn_add_user($url, $params=array('title'=>'Tambah peserta')) {
	return btn_generic($url,"fa-user","btn-info",$params);
	//return '<a class="btn btn-success" href="'.$url.'"><i class="fa fa-plus fa-1x"></i></a>';
}
function btn_edit($url,$params=array()) {
	if($params['title']=='') {
		$params['title']='Edit data';
	}
	return btn_generic($url,"fa-edit","btn-info",$params);
}
function btn_group($url,$params=array()) {
	return btn_generic($url,"fa-users","btn-info",$params);
}
function btn_done($url,$params=array('title'=>'Tandai selesai')) {
	return btn_generic($url,"fa-check","btn-info",$params);
}
function btn_delete_swal($url) {
	return 	'<a style="margin-right:5px;color:white;" title="Hapus data" class="btn btn-xs btn-danger"><i class="fa fa-trash" onclick="action_hapus(\''.$url.'\')"></i></a>';
}

function btn_eye($url) {
	return '<a class="btn btn-xs" href="'.$url.'"><i class="fa fa-eye fa-1x"></i></a>';
}

function btn_custom($url,$icon="fa fa-receipt",$cls_btn="btn-info",$title="") {
	return '<a class="btn btn-xs '.$cls_btn.'" href="'.$url.'" title="'.$title.'"><i class="'.$icon.' fa-1x"></i></a>';
}

function btn_print_small($url,$params=array()) {
	$par='';
	if(count($params)>0) {
		foreach($params as $attribut => $data) {
			$par.=" $attribut='$data' ";
		}
	}
	return '<a class="btn btn-xs btn-warning" '.$par.' href="'.$url.'"><img style="width: 10px;" src="'.fileurl("asset/print.svg").'"/></a>';
}
function btn_print($url) {
	return '<a class="" href="'.$url.'"><img style="width: 40px;" src="'.fileurl("asset/print.svg").'"/></a>';
}
function btn_download_xls($url) {
	return '<a class="" href="'.$url.'"><img style="width: 40px;" src="'.fileurl("asset/xls.svg").'"/></a>';
}
function btn_download_pdf($url) {
	return '<a class="" href="'.$url.'"><img style="width: 40px;" src="'.fileurl("asset/pdf.svg").'"/></a>';
}

function btn_delete($url) {
	return '<a class="btn btn-xs btn-danger"  style="margin-right:5px;color:white;"title="Hapus data"
				data-toggle="modal" 
				data-target="#modal-default" 
				data-title="Hapus data" 
				data-body="Apakah anda yakin ingin menghapus data ini?"
				data-btn2=""
				data-btn2name=""
				data-btn1="'.$url.'"
				data-btn1name="Hapus"
				>
				<i class="fa fa-trash fa-1x"></i>
		</a>';
}

function btn_general($url,$icon="fa-trash") {
	return '<a class="btn btn-xs '.$class.'"  title="'.$title.'" href="'.$url.'">
				<i class="fa '.$icon.' fa-1x"></i>
		</a>';
}
function btn_general2($title,$message,$url,$btn_name1="Ok",$class='btn-danger',$icon="fa-trash") {
	return '<a class="btn '.$class.'"  title="'.$title.'"
				data-toggle="modal" 
				data-target="#modal-default" 
				data-title="'.$title.'" 
				data-body="'.$message.'"
				data-btn2=""
				data-btn2name=""
				data-btn1="'.$url.'"
				data-btn1name="'.$btn_name1.'"
				>
				<i class="fa '.$icon.' fa-1x"></i>
		</a>';
}

//component big button
function button_add($url="")
{
global $daftar_hak,$modul,$action;
ob_start();
if($daftar_hak[$modul]['add']==1) {
	echo "<a href='".backendurl($url)."' class='btn btn-primary'>"._TAMBAH."</a>";
}
return ob_get_clean();
}
function button_download($url="")
{
ob_start();
echo "<a href='".backendurl($url)."' class='btn btn-download'>"._DOWNLOAD_TEMPLATE."</a>";
return ob_get_clean();
}
function button_upload($url="")
{
ob_start();
echo "<a href='".backendurl($url)."' class='btn btn-upload'>"._UPLOAD."</a>";
return ob_get_clean();
}

?>
