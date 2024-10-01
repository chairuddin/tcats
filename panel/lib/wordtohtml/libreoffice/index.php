<?php
$this_path =  getcwd();
//set tmp
$temp_folder='temp';
$html_folder='html';
if(!file_exists("$this_path/$temp_folder")) {
	$a=mkdir($temp_folder);
	var_dump($a);
	chmod($temp_folder, 0777);
}
if(!file_exists("$this_path/$html_folder")) {
	mkdir($html_folder);
	chmod($html_folder, 0777);
}

$cmd = "export HOME=$this_path/$temp_folder && /usr/bin/libreoffice --headless --convert-to html $this_path/sample.docx --outdir $this_path/$html_folder";
$a=shell_exec($cmd);
var_dump($a);
die('a');
?>
