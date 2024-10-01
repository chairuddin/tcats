<?php
/* created by roemly@gmail.com
 * <tbody id="product_row" class="ui-sortable">
 * <tr id='list_{$d['id']}' class='rowmove'>
 * <td><span class='show_row_move'><i class='glyphicon-move'></i></span></td>
<td><span class='show_row_move'>$no</span> </td>
 * echo "<td><a href='#' data-pk='".$d['id']."'  data-name='title_$lang' class='nama-produk'>".$d["title_$lang"]."</a></td>";
 * */
class Sortable
{
	public $table="";
	
	public function __construct($table,$identifier) 
	{
		global $modul;
		$this->table=$table;
		if(count($_POST['list'])>0)
		{
		$this->save();
		}
		else
		{
echo "
<script>	$(document).ready(function(){
	$('$identifier').sortable({	update: function(event, ui){
			sort=$('$identifier').sortable('serialize');	$.ajax({ 	type: 'POST',	url:'".backendurl($modul)."',	data:sort,	success: function(html)	{	}	});	}	});
	});
</script>
";	
		}
	}
	
	public function save()
	{
	global $mysql,$id,$modul;
	$list=$_POST['list'];	for($i=1;$i<=count($list);$i++)	{	$idlist=cleanInput($list[$i-1],'numeric');	$q=$mysql->query("UPDATE $modul set urutan=$i WHERE id='$idlist'");
	}
	exit($q);
	}
}
?>
