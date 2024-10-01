<?php
/* created by roemly@gmail.com
 * -buat field dengan nama publish atau terserah di table yang akan anda gunakan
 * -buat dan taruh script berikut di bagian view 
 * $US=new UpdateStatus("$modul","publish",".setpublish");
 * -buat dan taruh script berikut di bagian td :
 * $checked=$d['publish']==1?"checked":"";
 * echo "<td><input class='setpublish' type='checkbox' data-id='".$d['id']."' name='publish' $checked value='1' ></td>";
 * */
class UpdateStatus
{
	public $table="";
	public $field="";
	public function __construct($table,$field,$identifier) 
	{
		global $modul;
		$this->table=$table;
		
		if($_POST['pid']!="" and $_POST['checked']!="" and $_POST['name']!="")
		{
		$this->field=$_POST['name'];
		$this->save();
		}
		else
		{
			echo "
			<script>
			$(function () 
			{
				$('$identifier').click(function(){
				var c = this.checked;
				if(c){ $(this).prop('checked',true);c=1;}
				else{ $(this).prop('checked',false);c=0}
				id=$(this).attr('data-id');
				name=$(this).attr('name');
				send='pid='+id+'&checked='+c+'&name='+name;
				$.ajax({ 
				type: 'POST',
				url:'".backendurl("$modul")."',
				data:send,
				success: function(html)
				{

				}
				});
				});

			});
			</script>	
			";
			
		}
	}
	
	public function save()
	{
	global $mysql,$id,$modul;
	$pid=$_POST['pid'];
	if($pid!="")
	{
	$checked=$_POST['checked']==true?"1":"0";
	$q=$mysql->query("UPDATE ".$this->table." set ".$this->field."=$checked WHERE id='$pid'");
	}
	exit();
	}
}
?>
