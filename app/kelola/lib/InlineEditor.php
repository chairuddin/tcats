<?php
class InlineEditor
{
	public $table;
	public $field;
	public $uniqid;
	public function __construct($table) 
	{
		global $action,$id,$modul;
		$this->table=$table;
		if($_POST['name']!="" and $_POST['name']==$id)
		{
		$this->save_inline();
		}
		else
		{
		$this->uniqid=uniqid();
		load_plugin_css("template/css/plugins/xeditable/bootstrap-editable.css");
		//load_plugin_js("template/js/plugins/momentjs/jquery.moment.js");
		//load_plugin_js("template/js/plugins/mockjax/jquery.mockjax.js");
		load_plugin_js("template/js/plugins/xeditable/bootstrap-editable.min.js");
		}
	}
	public function text($identifier,$var=array())
	{
	global $modul,$action;
	$url=$var['url'];
	$field=$var['field'];
	if($identifier!="")
	{
	$url.="/$field";
	
echo <<<END
<script>
$(function () {
		$.fn.editable.defaults.mode = 'inline';
		$('$identifier').editable({
			type: 'text',
			url: '$url',
			title: 'Inline-Editor'
		});
	});
</script>

END;
	}
	}
	public function save_inline()
	{
	global $mysql,$id,$modul;
	if($id!="")
	{
	$field=$id;
	$pk=cleanInput($_POST['pk'],"numeric");
	$value=$_POST['value'];
	$sql="UPDATE ".$this->table." SET ".$field."='$value' WHERE id='$pk'";
	$q=$mysql->query($sql);
	exit($q);
	}
	}
}
?>
