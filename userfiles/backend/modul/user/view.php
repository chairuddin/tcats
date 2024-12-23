<?php
if($action=="edit")
{

if($_SESSION['s_level']<=0){redirecto(_TIDAKBERHAK,"error","view");}
$r=$mysql->query("SELECT * from user where id=$id");
$d=$mysql->assoc($r);

if($_SESSION['s_level']<$d['level']){redirecto(_TIDAKBERHAK,"error","view");}
$form = new Form("updateuser");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery", "focus"),
	"action" =>backendurl("user/update") 
));
$options_status = array("1"=>_AKTIF,"0"=>_TIDAKAKTIF);

$form->addElement(new Element_HTML('<legend>'._EDITUSER.'</legend>'));
$form->addElement(new Element_Hidden("form", "updateuser"));
$form->addElement(new Element_Hidden("id",$d['id']));
$form->addElement(new Element_Textbox('Username', "username", array("readonly" => 1,"required" => 1,"class"=>"form-control","value"=>$d['username'])));
$form->addElement(new Element_Password(_PASSWORD, "password", array("placeholder" =>"******","class"=>"form-control")));
$form->addElement(new Element_Password(_RETYPEPASSWORD, "password2", array("placeholder" =>"*******","class"=>"form-control")));
$form->addElement(new Element_Textbox(_NAMALENGKAP, "fullname", array("required" => 1,"value"=>$d['fullname'],"class"=>"form-control")));
$form->addElement(new Element_Textbox('Email', "email", array("required" => 1,"value"=>$d['email'],"class"=>"form-control")));
$form->addElement(new Element_Select(_LEVEL, "level", $options_level,array("class"=>"form-control","value"=>$d['level'])));
$form->addElement(new Element_Select(_STATUS, "status", $options_status,array("class"=>"form-control","value"=>$d['status'])));

$form->addElement(new Element_HTML('<br/>'));
$form->addElement(new Element_Button(_SIMPAN));
$form->addElement(new Element_Button(_BATAL, "button", array(
	"onclick" => "history.go(-1);"
)));
echo '
<style>
.control-group {
    margin-bottom: 14px;
}
</style>
<div class="row">
<div class="col-md-6">
<div class="card card-navy">
	<div class="card-header">
	  <h3 class="card-title">Edit Login User</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
';
$form->render();
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
}

if($action=="add")
{
if($_SESSION['s_level']<=0){redirecto(_TIDAKBERHAK,"error","view");}
$form = new Form("reguser");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery", "focus"),
	"action" =>backendurl("user/save") 
));
$options_status = array("1"=>_AKTIF,"0"=>_TIDAKAKTIF);

$form->addElement(new Element_Hidden("form", "reguser"));
$form->addElement(new Element_Textbox(_EMAILLOGIN, "username", array("class"=>"form-control","required" => 1)));
$form->addElement(new Element_Password(_PASSWORD, "password", array("class"=>"form-control","required" => 1)));
$form->addElement(new Element_Password(_RETYPEPASSWORD, "password2", array("class"=>"form-control","required" => 1)));
$form->addElement(new Element_Textbox(_NAMALENGKAP, "fullname", array("class"=>"form-control","required" => 1)));
$form->addElement(new Element_Textbox('Email', "email", array("required" => 1,"value"=>$d['email'],"class"=>"form-control")));
$form->addElement(new Element_Select(_LEVEL, "level", $options_level,array("class"=>"form-control","value"=>0)));
$form->addElement(new Element_Select(_STATUS, "status", $options_status,array("class"=>"form-control","value"=>1)));

$form->addElement(new Element_Button(_SIMPAN));
$form->addElement(new Element_Button(_BATAL, "button", array(
	"onclick" => "history.go(-1);"
)));

echo '
<style>
.control-group {
    margin-bottom: 14px;
}
</style>
<div class="row">
<div class="col-md-6">
<div class="card card-navy">
	<div class="card-header">
	  <h3 class="card-title">Tambah Login User</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
';
$form->render();
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

}
if($action=="form_upload"){
$form = new Form("uploaduser");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery", "focus"),
	"action" =>backendurl("$modul/upload_xls"),
	"enctype" =>"multipart/form-data"));

$form->addElement(new Element_Hidden("form", "uploaduser"));
$form->addElement(new Element_HTML('<legend>'._UPLOADMEMBER.'</legend>'));

$form->addElement(new Element_HTML('
<div class="control-group">
<label for="foto_add" class="control-label"></label>
<div class="controls">
Silahkan download template dengan format .xls terlebih dahulu '.button_download("$modul/download_xls").'
 <br/>Lakukan pengisian data di template tersebut. <br/>Selanjutnya di upload kembali file xls dibawah ini.<br/>

</div>
</div>
'));
$form->addElement(new Element_HTML('
<div class="control-group">
<label for="foto_add" class="control-label"></label>
<div class="controls">
'._UPLOAD.'
<input type="file"  id="filename" required="required" name="filename" accept="xls/*" class="">
</div>
</div>
'));
$form->addElement(new Element_Button(_SIMPAN));
$form->addElement(new Element_Button(_BATAL, "button", array(
	"onclick" => "history.go(-1);"
)));
$form->render();
}
if($action=="" or $action=="search" or $action=="view")
{
$form_search=form_search($keyword);
}

if($action=="view" or $action=="" or $action=="search")
{

if($_SESSION['s_level']>0)
{
$btn_tambah=button_add("user/add");
$btn_tambah.="&nbsp;&nbsp; <a href=\"".backendurl("user/form_upload")."\" class=\"btn btn-upload\">Upload Login User</a>";
$col_tambah.="&nbsp;&nbsp;
<span class=\"upload_master\" style=\"display:none;\">
<form method=\"post\" enctype=\"multipart/form-data\" action=\"".backendurl("$modul/upload_xls")."\">
File Excel (*.xls)<input type=\"file\" accept=\"xlsx/*\" name=\"filename\" required=\"required\">
<button type=\"submit\" class=\"btn btn-primary\" name=\"proses_upload\" value=\"1\" />Submit</button>
</form></span>";
}

$sql="SELECT id,username,fullname,if(level=2,'"._SUPERADMINISTRATOR."',if(level=1,'"._ADMINISTRATOR."','"._OPERATOR."')) level,lastlogin,if(status=1,'"._AKTIF."','"._TIDAKAKTIF."') status FROM user ";

$sql.=" WHERE level<".$_SESSION['s_level']." and id<>".$_SESSION['s_id'];

if($action=="search")
{

$sql.=" AND  (username like '%$keyword%' or 
fullname like '%$keyword%' )
";
}





$r=$mysql->query($sql);
$total_records = $mysql->numrows($r);
$start = $screen * $max_page_list;
$pages = ceil($total_records/$max_page_list);
if ($pages>1) $col_pagination=pagination($screen);
//$sql.="  order by $sort_by $sort_order  LIMIT $start, $max_page_list";
$sql.="  order by $sort_by $sort_order ";

$r=$mysql->query($sql);
ob_start();
echo "<table id='datatables' class='table'>";
echo "
<thead>
<tr>
<th>No</th>
<th>"._EMAILLOGIN."</th>
<th>"._NAMALENGKAP."</th>
<th>"._LEVEL."</th>
<th>"._STATUS."</th>
<th>"._LOGINTERAKHIR."</th>";
if($_SESSION['s_level']>0)
{
echo "<th>Action</th>";
}
echo "</tr></thead>";

$no=($start+1);
echo '<tbody>';

while($d=$mysql->assoc($r))
{
echo "
<tr>
<td>$no</td>
<td>".$d['username']."</td>
<td>".$d['fullname']."</td>
<td>".$d['level']."</td>
<td>".$d['status']."</td>
<td>".$d['lastlogin']."</td>";
if($_SESSION['s_level']>0)
{
$action_edit=btn_edit(backendurl("$modul/edit/".$d['id']));
$action_delete=btn_delete(backendurl("$modul/del/".$d['id']));

echo "<td>".'<div class="btn-group btn-group-sm">'.$action_add.$action_view.$action_edit.$action_delete.'</div>'."</td>";
$no++;
}
echo "</tr>";
}
echo "</tbody>";

echo "</table>";

$tabel=ob_get_clean();
$btn_tambah=button_add("$modul/add");
echo '
<div class="card card-navy">
	<div class="card-header">
	  <h3 class="card-title">Daftar User</h3>
	   <div class="float-right">'.$btn_tambah.'</div>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
	'.$tabel.'
	</div>
</div>	
';

$script_js.=<<<END
<script>
$(document).ready(function(){
	  
	
		$('#datatables').DataTable({
		
			'searching'   : true,
			'ordering'    : true,
			'info'        : true,
			'responsive'  : true,
			"order": [[ 0, 'desc' ]],
			
			
		});
		
	});
</script>
END;
if($action=="regfinish")
{
echo "Berhasil daftar silahkan cek email anda";
}


}
?>
