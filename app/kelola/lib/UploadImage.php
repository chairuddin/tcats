<?php
class UploadImage
{
	public $table;
	public $modul;
	public $uniqid;
	public $large_path;
	public $large_url;
	public function __construct($table,$modul) 
	{
	global $action,$modul,$config,$mysql;
	$this->table=$table;
	$this->modul=$modul;
	$this->large_path=$config['userfiles']."/UploadImage/$modul";
	$this->large_url=$config['urlfiles']."/UploadImage/$modul";
	
		
		if($_POST['UploadImage']!="" and $_POST['UploadImage']==1)
		{
		$this->save_image();
		}

$this->uniqid=uniqid();
load_plugin_js("template/js/plugins/fileupload/bootstrap-fileupload.min.js");
$sql = "SELECT type,basename, extension, namatampilan, maxdimension, maxfilesize FROM $table WHERE modul='$modul' ORDER BY id";
$random=uniqid();
$result = $mysql->query($sql);

echo "<form name=\"formheader\" method=\"POST\"  enctype=\"multipart/form-data\">\r\n";
echo "<input type=\"hidden\" name=\"UploadImage\" value=\"1\" />\r\n";

while (list($type,$basename, $extension, $namatampilan, $maxdimension, $maxfilesize) = $mysql->row($result)) 
{
	list($max,$mwidth,$mheight)=explode(";",$maxdimension);
	$dimension="size {$mwidth}px X {$mheight}px";
	if($mwidth >220 or $mheight>70)
	{
	$mwidth=$mwidth*0.4;
	$mheight=$mheight*0.4;
	}
	
echo <<<END

<div class="control-group">
<label for="textfield" class="control-label">$namatampilan ($dimension):</label>
<div class="controls">
	<div class="fileupload fileupload-new" data-provides="fileupload">
		<div class="fileupload-new thumbnail" style="width: {$mwidth}px; height: {$mheight}px"><img src="{$this->large_url}/$basename.$extension?random=$random" /></div>
		<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: {$mwidth}px; max-height: {$mheight}px; line-height: 20px;"></div>
		<div>
			<span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
			<input type="file" name='$basename' MAX_FILE_SIZE="$maxfilesize" /></span>
			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
		</div>
	</div>
</div>
</div>
<hr>
END;
}

echo "<div class=\"row-fluid\">";
echo "<div class=\"control-group\">";
echo "<label for=\"textfield\" class=\"control-label\">$namatampilan ($dimension):</label>";
echo "<div class=\"controls\"><input type=\"submit\" value=\""._SIMPAN."\" /></div>\r\n";
echo "</div></div>
</form>\r\n";

		
	}
	
	public function save_image()
	{
	global $mysql,$id,$modul;
	$sql = "SELECT type,basename, extension, maxdimension, maxfilesize FROM {$this->table}  WHERE modul='{$this->modul}' ORDER BY id";
			$result = $mysql->query($sql);
			while (list($type,$basename, $oldextension, $maxdimension, $maxfilesize) = $mysql->row($result)) 
			{
			
				if ($_FILES[$basename]['error']!=UPLOAD_ERR_NO_FILE) 
				{	//jika kolom file diisi
					$hasilupload = upload($basename,$this->large_path,$basename,$maxfilesize,"ico,jpg,jpeg,gif,png");
					if ($hasilupload!="")redirecto($hasilupload,"error");
					
					//ambil informasi extension
					$temp = explode(".",$_FILES[$basename]['name']);
					$extension = $temp[count($temp)-1];

					//resize gambar asli sesuai yang diizinkan
					list($aturan,$maxwidth,$maxheight) = explode(';',$maxdimension);
					switch ($aturan) {
						case 'fixed':
							$hasilresize = resize($this->large_path."/$basename.$extension",$this->large_path."/$basename.$extension",'f',$maxwidth,$maxheight);
							if ($hasilresize!="")redirecto($hasilresize,"error");
							break;
						case 'max':
							list($filewidth,$fileheight,$filetype,$fileattr) = getimagesize($this->large_path."/$basename.$extension");
							if ($filewidth>$maxwidth || $fileheight>$maxheight) 
							{
								$hasilresize = resize($this->large_path."/$basename.$extension",$this->large_path."/$basename.$extension",'b',$maxwidth,$maxheight);
								if ($hasilresize!="")redirecto($hasilresize,"error");
							}
							break;
					
					}
					
					
					if ($extension != $oldextension) unlink($this->large_path."/$basename.$oldextension");
					$mysql->query("UPDATE ".$this->table." SET extension='$extension' WHERE basename='$basename' and modul='".$this->modul."'");
					
				}
			}
	}
}
?>