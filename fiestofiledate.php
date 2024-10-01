<?php
$directory=".";
$allFiles = getAllFiles($directory,true);
if (arsort($allFiles)) {
	echo "<table>\r\n";
	foreach ($allFiles as $key=>$value) {
		echo "<tr><td>$key</td><td>$value</td></tr>\r\n";
	}
	echo "</table>\r\n";
}
function getAllFiles($directory, $recursive=true) {
	$result = array();
	$handle =  opendir($directory);
	while ($datei = readdir($handle))
	{
		if (($datei != '.') && ($datei != '..'))
		{
			$file = $directory.'/'.$datei;
			if (is_dir($file)) {
				if ($recursive) {
					$result = array_merge($result, getAllFiles($file));
				}
			} else {
				switch ($_GET['mulai']) {
					case '0':
						$result[$file] = date("Y-m-d",filemtime($file));
						break;
					case '':
						break;
					default:
						if (filemtime($file)>strtotime($_GET['mulai'])) $result[$file] = date("Y-m-d",filemtime($file));
						break;
				}
			}
		}
	}
	closedir($handle);
	return $result;
}
?>