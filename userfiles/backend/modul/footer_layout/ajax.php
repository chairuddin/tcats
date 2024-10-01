<?php
if($id=="del_pic_main_block")
{
	$id_block=$_POST['id_block'];
	
	$v=$mysql->get1value("SELECT thumbnail FROM footer_block_layout WHERE id='$id_block'");
	if(file_exists("$small_pic/" . $v))
	{
	unlink("$small_pic/" . $v);
	}
	if(file_exists("$large_pic/" . $v))
	{
	unlink("$large_pic/" . $v);
	}
}

if($id=="move_block")
{
	$r_item=$_POST['item'];
	//id_layout
	$id_layout=intVal($_POST['id_layout']);
	$position=intVal($_POST['position']);
	if($id_layout>0)
	{
		$urut=1;
		if(count($r_item)>0)
		{
			foreach($r_item as $i=>$v)
			{
			list($id)=explode(",",$v);
			$q=$mysql->query("UPDATE footer_layout_item SET urutan='$urut',id_layout='$id_layout',position='$position' WHERE id='$id'");	
			$urut++;
			}
		}
	}
}

if($id=="move_main_block")
{

	
	$r_item=$_POST['block'];
	//id_layout
	$id_menu=intVal($_POST['id_menu']);
	$id_block=intVal($_POST['id_block']);
	if($id_block>0 AND $id_menu>0)
	{
		$urut=1;
		if(count($r_item)>0)
		{
			foreach($r_item as $i=>$v)
			{
			list($id)=explode(",",$v);
			$q=$mysql->query("UPDATE footer_layout SET urutan='$urut',id_block='$id_block',id_menu='$id_menu' WHERE id='$id'");	
			$urut++;
			}
		}
	}
}
if($id=="save_urutan")
{
	$r_item=$_POST['item'];
	//id_layout
	$id_layout=intVal($_POST['id_layout']);
	$position=intVal($_POST['position']);
	if($id_layout>0)
	{
		$urut=1;
		if(count($r_item)>0)
		{
			foreach($r_item as $i=>$v)
			{
			list($id)=explode(",",$v);
			$q=$mysql->query("UPDATE footer_layout_item SET urutan='$urut',id_layout='$id_layout',position='$position' WHERE id='$id'");	
			$urut++;
			}
		}
	}
}
if($id=="save_urutan_block")
{
	$r_item=$_POST['block'];
	$id_menu=$_POST['id_menu'];
	$urut=1;
	if(count($r_item)>0)
	{
		foreach($r_item as $i=>$v)
		{
		list($id,$id_menu)=explode(",",$v);
		$q=$mysql->query("UPDATE footer_layout SET urutan='$urut' WHERE id='$id' and id_menu='$id_menu'");	
		$urut++;
		}
	}
}
if($id=="save_block_wrapper")
{
	$r_item=$_POST['block_wrapper'];
	$id_menu=$_POST['id_menu'];
	$urut=1;
	if(count($r_item)>0)
	{
		foreach($r_item as $i=>$id)
		{
		$q=$mysql->query("UPDATE footer_block_layout SET urutan='$urut' WHERE id='$id' and id_menu='$id_menu'");	
		$urut++;
		}
	}
}
if($id=="save_block")
{
	//pilihblock=slide_show:Slide Show&blockid=block0&layout=11,1&position=1
	
	list($block,$name_id)=explode(":",cleanInput($_POST['pilihblock']));
	list($idlayout,$idmenu)=explode(",",cleanInput($_POST['layout']));
	$position=cleanInput($_POST['position']);
	$auto_increment=$mysql->last_auto_increment("footer_layout_item");
	$urutan = getMaxNumber("footer_layout_item", 'urutan'," id_layout='$idlayout' AND position='$position' ")+2;
	$q="
	INSERT INTO footer_layout_item (id,id_layout,name_id,block,urutan,value,position)
	values ('$auto_increment','$idlayout','$name_id','$block','$urutan','',$position)
	";
	$djson=array();
	$class_col="";
	$r=$mysql->query($q);
	if($r)
	{
		$djson['msg']='Berhasil tambah blok '.$name_id;
		$djson['error']=0;
		$r_type=explode(",",$block_page[$block]["type"]);
		$type=join(" ",$r_type);
		/*
		 echo "<div class=\"kat_item ui-state-default ui-draggable\"><i title='up or down only' class='glyphicon-move'></i><div class=\"kat_nama\"><a href=\"#\" data-pk=\"".$cats->cats[$i]['id']."\"  data-name=\"name_$lang\" class=\"title-cat\">".$cats->cats[$i]['nama']."</a></div>";
           echo "<div class=\"kat_action\">
           <a href=\"".backendurl("block_".$cats->cats[$i]['block']."/edit/".$cat_id)."\"><i class='icon-cogs'></i></a>
           <a class=\"footer_layout_action-remove\" href=\"" .backendurl("$modul/del/").$cats->cats[$i]['id_menu']."/".$cats->cats[$i]['id']."\"><i class='glyphicon-remove'></i></a>
			</div></div>";
		 
		 * */
		$djson['block_item']="<div id='item_$auto_increment,$idlayout' class='kat_item block_layout_item ui-state-default ui-draggable $type'>
		   <i title='up or down only' class='glyphicon-move'></i>
		   <div class=\"kat_nama\"><a href=\"#\" data-pk=\"".$auto_increment."\"  data-name=\"name_$lang\" class=\"title-cat\">".$name_id."</a></div>
           <div class=\"kat_action\">
           <a href=\"".backendurl("block_".$block."/edit/".$auto_increment."/footer_layout/$idmenu")."\"><i class='icon-cogs'></i></a>
           <a class=\"footer_layout_action-remove\" href=\"" .backendurl("$modul/del_item/").$auto_increment."/".$idmenu."\"><i class='glyphicon-remove'></i></a>
        		</div>
        	<script>
			$('.footer_layout_action-remove').click(function() {
			var r = confirm('Anda yakin akan menghapus block ini?');
			if (r == true){		return true;}
			else{		return false;	}});

        	</script>	";
	}
	else
	{
		$djson['msg']='Gagal tambah block';
		$djson['error']=1;
	}
	
	echo json_encode($djson);
}

exit();
?>
