<?php
function btn_kd($url)
{
	return '<a class="btn btn-success" href="' . $url . '">&nbsp;KD&nbsp;</a>';
}
function btn_info($url)
{
	return '<a class="btn btn-info" href="' . $url . '">&nbsp;<i class="fas fa-info"></i>&nbsp;</a>';
}
function btn_folder($url)
{
	return '<a class="btn btn-info" href="' . $url . '">&nbsp;<i class="fas fa-folder-plus"></i>&nbsp;</a>';
}
function btn_access($url)
{
	return '<a class="btn btn-warning" href="' . $url . '"><i class="fas fa-user-lock"></i></a>';
}
function btn_edit($url)
{
	return '<a class="btn btn-success" href="' . $url . '"><i class="fas fa-edit"></i></a>';
}
function btn_eye($url)
{
	return '<a class="btn btn-info" href="' . $url . '"><i class="fas fa-eye"></i></a>';
}
function btn_add($url)
{
	return '<a class="btn btn-info" href="' . $url . '"><i class="fas fa-plus"></i></a>';
}
function btn_addA($url)
{
	return '<a class="btn btn-info" href="' . $url . '">A</a>';
}
function btn_addB($url)
{
	return '<a class="btn btn-info" href="' . $url . '">B</a>';
}

function btn_print($url)
{
	return '<a class="btn btn-info" href="' . $url . '"><i class="fas fa-print"></i></a>';
}
function btn_confirm_dialog($data)
{
	/*
	$data array(
	'title' => 'Hapus',
	'body' => 'apakah anda yakin ingin menghapus data ini ?',
	'btn1url' => 'link1',
	'btn2url' => 'link2',
	'btn1name' => 'tombol1',
	'btn2name' => 'tombol1',
	'icon' => 'fa-trash',
	);
	*/
	extract($data);
	return '<a class="btn btn-danger"  title="' . $title . '"
				data-toggle="modal" 
				data-target="#modal-default" 
				data-title="' . $title . '" 
				data-body="' . $body . '"
				data-btn2="' . $btn2url . '" 
				data-btn2name="' . $btn2name . '" 
				data-btn1="' . $btn1url . '" 
				data-btn1name="' . $btn1name . '" 
				>
				<i class="fas ' . $icon . '"></i>
		</a>';
}
function btn_delete($url)
{
	return '<a class="btn btn-danger"  title="Hapus data"
				data-toggle="modal" 
				data-target="#modal-default" 
				data-title="Hapus data" 
				data-body="Apakah anda yakin ingin menghapus data ini?"
				data-btn2=""
				data-btn2name=""
				data-btn1="' . $url . '"
				data-btn1name="Hapus"
				>
				<i class="fas fa-trash"></i>
		</a>';
}
function btn_general($title, $message, $url, $btn_name1 = "Ok", $class = 'btn-danger', $icon = "fa-trash")
{
	return '<a class="btn ' . $class . '"  title="' . $title . '"
				data-toggle="modal" 
				data-target="#modal-default" 
				data-title="' . $title . '" 
				data-body="' . $message . '"
				data-btn2=""
				data-btn2name=""
				data-btn1="' . $url . '"
				data-btn1name="' . $btn_name1 . '"
				>
				<i class="fas ' . $icon . '"></i>
		</a>';
}
