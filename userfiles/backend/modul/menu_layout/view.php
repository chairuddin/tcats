<?php
if ($action == "css") {
	$id_menu = $_GET['seg5'];
	$q = $mysql->query("SELECT style,isfull,thumbnail FROM menu_block_layout WHERE id=$id ");
	if ($q and $mysql->numrows($q) > 0) {
		$d = $mysql->assoc(q);
		if ($d['style'] != "") {
			$r_css = explode(";", $d['style']);
		}
		$v_css = array();
		if (count($r_css) > 0) {
			foreach ($r_css as $i => $v) {
				list($attribut, $value) = explode(":", $v);
				$v_css[$attribut] = $value;
			}
		}
		$isfull = $d['isfull'];
	}

	$doaction = backendurl("$modul/save_css/$id/menu_layout/$id_menu");
	echo "<form  enctype=\"multipart/form-data\" method=\"POST\" action=\"" . $doaction . "\">";
	echo "<input type=\"hidden\" name=\"id\" value=\"" . $id . "\"/>";
	echo "<input type=\"hidden\" name=\"id_menu\" value=\"" . $id_menu . "\"/>";
	echo "<table>";
	echo "<tr>";
	echo "<td>Width Normal</td>";
	$checked = $isfull == 0 ? "checked='checked'" : "";
	echo "<td><input type='radio' name='isfull' value='0' $checked /></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Width Full </td>";
	$checked = $isfull == 1 ? "checked='checked'" : "";
	echo "<td><input type='radio' name='isfull' value='1' $checked /></td>";
	echo "</tr>";
	/*
	echo "<tr>";
	echo "<td>Width Full No Margin</td>";
	$checked=$isfull==2?"checked='checked'":"";
	echo "<td><input type='radio' name='isfull' value='2' $checked /></td>";
	echo "</tr>";
*/
	echo "<tr>";
	echo "<td>Background Image</td>";
	echo "<td>";

	$thumb_blank = backendurl("images/blank70x70.jpg");
	if ($d['thumbnail'] == "" or !file_exists("$small_pic/{$d['thumbnail']}")) {
		$thumb_url = $thumb_blank;
	} else {
		$thumb_url = "$small_url/{$d['thumbnail']}";
		$linkdelete = "<a  class='product_foto_del'  data-div='list_$v' ><img alt=\"" . _DEL . "\" border=\"0\" src=\"" . backendurl("images/deletepic.png") . "\"></a>";
		$urldel = backendurl("$modul/ajax/del_pic_main_block");
		echo <<<END
<script>
$(document).ready(function(){
$(".btn.btn-file").hide();
	$('.product_foto_del').click(function() {
	var r = confirm("Hapus gambar  background ?");
	if (r == true)
	{
		
		id_block=$id;
		$.ajax({
				type: 'POST',
				url: '$urldel',
				data: 'id_block='+id_block,
				error: function() {
				},
				success: function(data) {
					$(".fileupload-preview > img").attr('src','$thumb_blank');
					$(".linkdelete").remove();
					$(".btn.btn-file").show();
				}

				});
		
	}
	});
	});
	</script>
END;
	}
	echo <<<END

<div class="control-group">
<div class="controls">
	<div class="fileupload fileupload-new" data-provides="fileupload">
		
		<div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 110px;max-width: 200px; max-height: 200px; line-height: 20px;">
		<img src="$thumb_url?random=$random" />
		<div class='linkdelete'>$linkdelete</div>
		</div>
		<div>
			<span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
			<input type="file" name='thumbnail' MAX_FILE_SIZE="$maxfilesize" /></span>
			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
		</div>
	</div>
</div>
</div>
<hr>
END;

	echo "</td>";
	echo "</tr>";
	$style_css .= <<<END
	<style>
	.pickcolor
	{
	width:100px;
	}
	.evo-pointer{height:28px;width:28px;}
	</style>
END;
	foreach ($css as $i => $v) {
		$id_element = ($v[0] == "background-color" or $v[0] == "color") ? " id='pickcolor$i'  class='pickcolor' " : "";
		if ($id_element != "") {
			$warna_terpilih = $v_css[$v[0]];
			$script_js .= <<<END
<script>
$(document).ready(function(){
$('#pickcolor$i').colorpicker({color:'$warna_terpilih'});
});
</script>
END;
		}
		echo "<tr>";
		echo "<td>" . $v[0] . "</td>";
		echo "<td><input type='text' $id_element name='" . $v[0] . "' value='" . $v_css[$v[0]] . "' size='10'/></td>";
		echo "</tr>";
	}
	echo "<tr>";
	echo "<td colspan='2'><input class=\"buton\" type=\"submit\" name=\"submit\" value=\"" . _SAVE . "\">
	<a href=\"" . backendurl("$modul/edit/$id_menu") . "\"><input class=\"btn back\" type=\"button\" name=\"back\" value=\"" . _BATAL . "\"></a></td>";
	echo "</tr>";
	echo "</table>";
	echo "</form>";
}
if ($action == "" or $action == "search" or $action == "view" or $action == "edit") {
	$col_back = '<a href="' . backendurl("menu") . '" class="btn back">Back to menu</a>';


	$q_block_layout = $mysql->query("SELECT * FROM menu_block_layout WHERE id_menu=$id ORDER BY urutan");
	if ($q_block_layout and $mysql->numrows($q_block_layout) > 0) {
		$index = 0;
		$id_block = array();
		$id_main_block = array();
		$block_index = 1;
		echo "<div id='block_sortable'>";
		while ($d_block_layout = $mysql->assoc($q_block_layout)) {
			$id_main_block[] = $d_block_layout['id'];
			/*START CONTENT BLOCK*/
			echo "<div class='block_wrapper box'  id='block_wrapper_" . $d_block_layout['id'] . "'>";
			echo "<div class='block_layout_action box-title'>";
			echo "<div class='block_layout_action_left'>";
			echo "<a class=\"block_layout_action-move\"><i class='glyphicon-move'></i> Blok #" . ($block_index++) . "</a>";
			echo "</div>";
			echo "<div class='block_layout_action_right actions'>";
			echo "<a class=\"block_layout_action-advance\" href=\"" . backendurl("$modul/css/") . $d_block_layout['id'] . "/menu_layout/" . $id . "\"><i class='glyphicon-settings'></i></a>";
			echo "<a class=\"block_layout_action-remove\" href=\"" . backendurl("$modul/del_block_layout/") . $d_block_layout['id'] . "/" . $id . "\"><i class='glyphicon-remove_2'></i></a>";
			echo "<a class=\"block_layout_action-toggle\"><i class='icon-sort-down'></i></a>";
			echo "</div>";
			echo "</div>";
			echo "<div class='box-content'>";
			echo "<div id='main_block_layout_" . $d_block_layout['id'] . "' data-idmenu='$id' data-idblock='" . $d_block_layout['id'] . "' class='block_layout'>";
			$q = $mysql->query("SELECT * FROM menu_layout WHERE id_block='" . $d_block_layout['id'] . "' ORDER BY urutan");
			if ($q and $mysql->numrows($q) > 0) {


				while ($d = $mysql->assoc($q)) {
					$id_layout = $d['id'] . "," . $id;
					echo '<div id="block_' . $id_layout . '" class="block_layout_inline" style="' . $d['style'] . '">';
					//echo "<h1>".$d["name_id"]."</h1>";
					echo "<div class='layout_action row-fluid'>";
					//echo "<a class=\"layout_action-advance\" href=\"" .backendurl("$modul/css/").$d['id']."/menu_layout/".$id."\"><i class='glyphicon-settings'></i></a>";		
					echo "<a class=\"layout_action-remove\" href=\"" . backendurl("$modul/del_layout/") . $d['id'] . "/" . $id . "\"><i class='glyphicon-remove_2'></i></a>";
					echo "<a class=\"layout_action-move\"><i class='glyphicon-move'></i></a>";
					echo "</div>";
					echo "<div class='block_layout_row row-fluid'>";

					$column = explode("_", $d['block']);
					if ($column[0] == "mod") {
						$position = 1;
						echo "<div class='block_layout_column span12'>";
						//echo "<div>";
						$q1 = $mysql->query("SELECT * FROM menu_layout_item WHERE id_layout='" . $d['id'] . "' AND position=$position ORDER BY urutan");

						if ($q1 and $mysql->numrows($q1) > 0) {
							while ($d1 = $mysql->assoc($q1)) {
								$r_type = explode(",", $block_page[$d1['block']]["type"]);
								$rjson = json_decode($d1['value'], true);

								$type = join(" ", $r_type);
								$judul_block = "";
								if ($rjson['title'] != "") {
									$judul_block = $rjson['title'];
								} else {
									$judul_block = $d1['name_id'];
								}
								echo "
								  <div id='item_" . $d1['id'] . "," . $d1['id_layout'] . "' class='kat_item block_layout_item ui-state-default ui-draggable $type'>
							   	   <div class=\"kat_nama\"><a href=\"#\" data-pk=\"" . $d1['id'] . "\"  data-name=\"name_$lang\" class=\"title-cat\">" . $judul_block . "</a></div>
								   <div class=\"kat_action\">
								   <a href=\"" . backendurl("block_" . $d1['block'] . "/edit/" . $d1['id'] . "/menu_layout/" . $id) . "\"><i class='icon-cogs'></i></a>
								   	</div>
									</div>
									";
							}
						}

						//	echo "</div>";
						echo "</div>";
					} else {
						/////////////////////////////////////START LAYOUT COLUMN//////////////////////////
						$position = 1;
						foreach ($column as $i => $v) {
							if ($i > 0) {
								echo "<div class='block_layout_column span$v'>";
								echo "<div id='block$index' data-idlayout='" . $d['id'] . "' data-position='" . $position . "' >";
								$q1 = $mysql->query("SELECT * FROM menu_layout_item WHERE id_layout='" . $d['id'] . "' AND position=$position ORDER BY urutan");

								if ($q1 and $mysql->numrows($q1) > 0) {
									while ($d1 = $mysql->assoc($q1)) {
										$r_type = explode(",", $block_page[$d1['block']]["type"]);
										$type = join(" ", $r_type);
										$rjson = json_decode($d1['value'], true);
										//print_r($rjson);
										$judul_block = "";
										if ($rjson['title_id'] != "") {
											$judul_block = $rjson['title_id'];
										} else {
											$judul_block = $d1['name_id'];
										}
										echo "
								  <div id='item_" . $d1['id'] . "," . $d1['id_layout'] . "' class='kat_item block_layout_item ui-state-default ui-draggable $type'>
								   <i title='up or down only' class='glyphicon-move'></i>
								   <div class=\"kat_nama\"><a href=\"#\" data-pk=\"" . $d1['id'] . "\"  data-name=\"name_$lang\" class=\"title-cat\">" . $judul_block . "</a></div>
								   <div class=\"kat_action\">
								   <a href=\"" . backendurl("block_" . $d1['block'] . "/edit/" . $d1['id'] . "/menu_layout/" . $id) . "\"><i class='icon-cogs'></i></a>
								   <a class=\"menu_layout_action-remove\" href=\"" . backendurl("$modul/del_item/") . $d1['id'] . "/" . $id . "\"><i class='glyphicon-remove'></i></a>
									</div>
									</div>
									";
									}
								}

								echo "</div>";
								echo "<div><a  id='tambah_block$index'   data-id='block$index'  class='tambah_block btn'>Tambah konten</a></div>";
								echo "<div data-id='block$index' id='show_block$index' style='display:none;background-color: white; padding: 8px;'>";
								echo "<select style='width:100%;' name=\"block\" id=\"pilih_block$index\">\n";
								echo "<option id=\"pilih_block\" name=\"pilih_block\">Pilih tipe konten</option>";
								foreach ($block_page as $x => $y) {
									echo "<option value='" . $x . ":" . $y['name'] . "'>" . $y['name'] . "</option>";
								}
								echo "</select>";
								echo "<input data-position='$position' data-layout='$id_layout' data-id='block$index' type='button' class='save_block btn btn-blue' id='save_block$index' value='simpan' />";
								echo "<input data-id='block$index' type='button' class='cancel_block btn btn-lightgrey' id='cancel_block$index' value='batal' />";
								echo "</div>";

								echo "</div>";
								//						
								$id_block[] = "col-$v";
								$index++;
								$position++;
							}
						}
						/////////////////////////////////////END LAYOUT COLUMN//////////////////////////
					}

					echo "</div>";
					echo "</div>";
				}
			}
			echo "</div>";

			$doaction = backendurl("$modul/update/$id");


			echo "<div class=\"form-add-column\">";
			echo "<form class=\"form-horizontal\" enctype=\"multipart/form-data\" method=\"POST\" action=\"" . $doaction . "\">";
			echo "<input type=\"hidden\" name=\"id\" value=\"" . $id . "\"/>";
			echo "<input type=\"hidden\" name=\"id_block\"  value=\"" . $d_block_layout['id'] . "\"/>";
			echo "<div class=\"control-group\"><label class=\"control-label\">Pilih model kolom</label>";
			echo "<div class=\"controls\">";
			echo "<select name=\"block\" id=\"block\" required=\"required\">\n";
			echo "<option name=\"\"></option>";
			foreach ($block_layout as $i => $v) {
				$value = json_encode($v);
				echo "<option value='" . $value . "'>" . $v['name'] . "</option>";
			}
			echo "</select>";
			echo "<input class=\"buton\" type=\"submit\" name=\"submit\" value=\"Tambah	\">";
			echo "</div>";
			echo "</div>";

			echo "</form>";
			echo "</div>";
			echo "</div>";

			/*END CONTENT BLOCK*/
			echo "</div>";
		}
		/*END Block_sortable*/
		echo "</div>";
	}

	echo "<script>";
	//for($i=1;$i<$id_block;$i++)
	foreach ($id_main_block as $i => $v) {
		$r_id = array();
		for ($x = 0; $x < count($id_main_block); $x++) {
			if ($id_main_block[$x] == $v) {
				continue;
			} else {
				$r_id[] = "#main_block_layout_" . $id_main_block[$x];
			}
		}
		$join_id = join(",", $r_id);

		echo "
$('#main_block_layout_" . $v . "').sortable({
connectWith: '$join_id',
  update: function(event, ui)
  {
	  
	  id_menu=$(this).attr('data-idmenu');
	  var sorted ='id_menu='+id_menu+'&'+$('#main_block_layout_" . $v . "').sortable('serialize');
	  $.ajax({
		type: 'POST',
		url: '" . backendurl($modul . "/ajax/save_urutan_block") . "',
		data: sorted,
		error: function() {
		},
		success: function(data) {
		
		}

	});
	  
  }
  ,receive: function(event, ui) {
  
	
			id_menu=$(this).attr('data-idmenu');
			id_block=$(this).attr('data-idblock');
			var sorted ='id_menu='+id_menu+'&id_block='+id_block+'&'+$('#main_block_layout_" . $v . "').sortable('serialize');

			$.ajax({
				type: 'POST',
				url: '" . backendurl($modul . "/ajax/move_main_block") . "',
				data: sorted,
				error: function() {
				},
				success: function(data) {
				
				}

				});
			
		
		
	}
	
	
});
";
	}


	foreach ($id_block as $i => $v) {
		$r_id = array();
		for ($x = 0; $x < count($id_block); $x++) {
			if ($x == $i) {
				continue;
			} else {
				$r_id[] = "#block$x";
			}
		}
		$join_id = join(",", $r_id);

		echo "
$('#block$i').sortable({
	cursor: 'move',
	revert: '300',
	connectWith: '$join_id',
	update: function() {
	id_layout=$(this).attr('data-idlayout');
	position=$(this).attr('data-position');
	var sorted ='position='+position+'&id_layout='+id_layout+'&'+$('#block$i').sortable('serialize');
	
	$.ajax({
		type: 'POST',
		url: '" . backendurl($modul . "/ajax/save_urutan") . "',
		data: sorted,
		error: function() {
		},
		success: function(data) {
		
		}

	});

	},
	receive: function(event, ui) {
	
		if(ui.item.hasClass('" . $v . "'))
		{
			id_layout=$(this).attr('data-idlayout');
			var sorted ='position='+position+'&id_layout='+id_layout+'&'+$('#block$i').sortable('serialize');

			$.ajax({
				type: 'POST',
				url: '" . backendurl($modul . "/ajax/move_block") . "',
				data: sorted,
				error: function() {
				},
				success: function(data) {
				
				}

				});
			
		}
		else
		{
		alert('element tidak sesuai');
		$(ui.sender).sortable('cancel');
		return false
		}
	},
	beforeStop: function(event, ui) {
		
	}
	
}).disableSelection();
";
	}
	echo <<<END
 $(".block_layout_action-toggle").click(function (e) {
        e.preventDefault();
        var el = $(this);
        content = el.parents('.box').find(".box-content");
        content.slideToggle('fast', function(){
            el.find("i").toggleClass('icon-sort-up').toggleClass("icon-sort-down");
            if(!el.find("i").hasClass("icon-sort-up")){
                if(content.hasClass('scrollable')) slimScrollUpdate(content);
            } else {
                if(content.hasClass('scrollable')) destroySlimscroll(content);
            }
        });
    });
END;
	echo "
$('#block_sortable').sortable({
	cursor: 'move',
	revert: '300',
	update: function() {
	var sorted ='id_menu={$id}&'+$('#block_sortable').sortable('serialize');
	
	$.ajax({
		type: 'POST',
		url: '" . backendurl($modul . "/ajax/save_block_wrapper") . "',
		data: sorted,
		error: function() {
		},
		success: function(data) {
		
		}

	});

	}
	
	
});
";

	echo "</script>";
	$doaction = backendurl("$modul/save_block");
	echo "<div class=\"content-widgets\">";
	echo "<form class=\"form-horizontal\" enctype=\"multipart/form-data\" method=\"POST\" action=\"" . $doaction . "\">";
	echo "<input type=\"hidden\" name=\"id\" $selected value=\"" . $id . "\"/>";
	echo "<input class=\"buton\" type=\"submit\" name=\"submit\" value=\"Tambah blok utama	\">";
	echo "</form>";
	echo "</div>";
	echo "<hr>";
}
