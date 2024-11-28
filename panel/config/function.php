<?php
function generateUniqueUrl($url,$table,$id="",$tambahan="")
{
	global $mysql,$lang;
	$cari=true;
	$lasturl=$url;
	$i=1;
	$option="";
	if($id!="")
	{
		$option=" AND id<>$id ";
	}
	while($cari)
	{
		$q=$mysql->query("SELECT * FROM $table WHERE url_$lang='$lasturl' $option $tambahan");
		if($q and $mysql->numrows($q)>0)
		{
			$lasturl=$url.$i;
		}
		else
		{
			$cari=false;
		}
		$i++;
	}
	return $lasturl;
	
}
function b_load_lib($lib)
{
global $config;
include_once $config['lib']."/$lib.php";
}
function b_load_css($args = array() )
{
extract($args);	
global $config;
global $style_css,$modul;
$path=$config['userdir']."/backend/modul/$modul/$modul.css";
	if(file_exists("$path"))
	{
	ob_start();
	echo "\r\n<style>\r\n";
	include "$path";
	echo "\r\n</style>\r\n";
	$temp=str_replace("<<<THISURL>>>",backendurl(),ob_get_clean());
	
	$style_css.=$temp;
	}
	
}
function b_load_js($args=array())
{
global $config;
global $script_js,$modul;
extract($args);
die($category_id);
$path=$config['userdir']."/backend/modul/$modul/$modul.js";
if(file_exists("$path"))
{
ob_start();
echo "\r\n<script>\r\n";
include "$path";
echo "\r\n</script>\r\n";
$temp=str_replace("<<<THISURL>>>",backendurl("$modul/"),ob_get_clean());
$script_js.=$temp;
}
}
function b_auto_load_css($args = array())
{
extract($args);
global $config;
global $style_css,$modul;
$path=$config['userdir']."/backend/modul/$modul/style.css";
	if(file_exists("$path"))
	{
	ob_start();
	echo "\r\n<style>\r\n";
	include "$path";
	echo "\r\n</style>\r\n";
	$temp=str_replace("<<<THISURL>>>",backendurl(),ob_get_clean());
	
	$style_css.=$temp;
	}
	
}
function b_auto_load_js($args = array())
{
extract($args);	
global $config;
global $script_js,$modul;
$path=$config['userdir']."/backend/modul/$modul/script.js";
if(file_exists("$path"))
{
ob_start();
echo "\r\n<script>\r\n";
include "$path";
echo "\r\n</script>\r\n";
$temp=str_replace("<<<THISURL>>>",backendurl("$modul/"),ob_get_clean());
$script_js.=$temp;
}
}
function button_excel($url="")
{
ob_start();
echo "<a href='".backendurl($url)."' class='btn btn-primary'>Import Excel</a>";
return ob_get_clean();
}
function button_add($url="")
{
ob_start();
echo "<a href='".backendurl($url)."' class='btn btn-primary'>"._TAMBAH."</a>";
return ob_get_clean();
}
function button_card_config($url="")
{
ob_start();
echo "<a href='".backendurl($url)."' class='btn btn-primary'>Konfigurasi kartu</a>";
return ob_get_clean();
}
function button_download($url="")
{
ob_start();
echo "<a href='".backendurl($url)."' class='btn btn-download'>"._DOWNLOAD_TEMPLATE."</a>";
return ob_get_clean();
}
function button_upload($url="")
{
ob_start();
echo "<a href='".backendurl($url)."' class='btn btn-upload'>"._UPLOAD."</a>";
return ob_get_clean();
}
function form_search($keyword="",$tambahan="")
{
global $modul;
ob_start();
// $form = new Form("searching");
// $form->configure(array(
	// "prevent" => array("bootstrap", "jQuery", "focus"),
	// "action" =>backendurl("$modul/search"), 
	 // "view" => new View_Inline
// ));
// $form->addElement(new Element_Search(_PENCARIAN,"keyword",array("value"=>"$keyword","class"=>"span6","placeholder"=>"Search here...")));
// $form->addElement(new Element_Button("search","search",array("class"=>"btn btn-primary span3")));

// $form->render();
$thisurl=backendurl("$modul/search").$tambahan;
$label=_PENCARIAN;
$label=_PENCARIAN;
echo <<<END
<form class="search-form" method="POST" action="$thisurl">
				<div class="search-pane">
					<input type="text" placeholder="Search here..." name="keyword" value="$keyword">
					<button type="submit">
						<i class="icon-search"></i>
					</button>
				</div>
			</form>
END;
			
return ob_get_clean();
}

function button_action($ar_action)
{
global $config,$modul;
ob_start();
$icon=array(
"edit"=>"glyphicon-edit",
"del"=>"glyphicon-remove",
"del_confirm"=>"glyphicon-remove",
"view"=>"glyphicon-zoom_in"
);
$title=array(
"edit"=>"Edit",
"del"=>"Delete",
"del_confirm"=>"Delete",
"view"=>"View"
);
foreach($ar_action as $i =>$v)
{
	$class="";
	if($i=="del" or $i=="del_confirm")$class="action-remove";//content-remove
	echo "<a  data-toggle='modal' href='".backendurl("$modul/$i/$v")."' class='button_action action_$i $class' title='".$title[$i]."'><i class='".$icon[$i]."'></i></a>";
}
return ob_get_clean();
}
function backendurl($url="")
{
global $config;
return $config['backendurl']."/$url";
}
function url_master($url)
{
//	url_master($url="",$langsupport=0,$ishtml=0)
global $_d;
return $_d['master']."/$url";
}
function fronturl($url="",$langsupport=0,$ishtml=0)
{
global $config,$lang;
if($ishtml)$url=$url.".html";
if($langsupport and $lang=="en")
return $config['fronturl']."/$lang/$url";
else
return $config['fronturl']."/$url";
}
function frontpath($path="")
{
global $config;
return $config['frontpath']."/$path";
}
function fileurl($path="")
{
global $config;
return $config['urlfiles']."/$path";
}
function filepath($path="")
{
global $config;
return $config['userfiles']."/$path";
}
function front_load_plugin($plugin="")
{
	global $script_js;
	
	
	if($plugin!="" AND file_exists(pluginpath($plugin)))
	{
		$script_js['plugin_masonry']="<script src=\"".pluginurl($plugin)."\"></script>";
		
	}
	
}
function pluginurl($plugin="")
{
	$plugin_url=fronturl("userfiles/front/plugin/$plugin/{$plugin}.js");
	return $plugin_url;
}
function pluginpath($plugin="")
{
	$pluginpath=frontpath("userfiles/front/plugin/$plugin/{$plugin}.js");
	
	return $pluginpath;
}

function pagination($screen='',$tambahan="") {
	global $pages, $pagurl,$keyword;	
		
	if (!isset($screen)){
		$screen = 0;
	}
	
	$hal.="<div id=\"pagination_content\">";
	if ($screen > 0){
		$prev = $screen - 1;
		$hal .=  "<a class=\"pagination_first blue\" href=\"".backendurl("$pagurl/0").$tambahan."\"><i class='icon-double-angle-left'></i></a>\r\n"; //&lt; 
		if ($prmtr=="") {
			$hal .=  "<a class=\"pagination_prev blue\" href=\"".backendurl("$pagurl/$prev").$tambahan."\"><i class='icon-angle-left'></i></a>\r\n"; //&lt;
		} else {
			$hal .=  "<a class=\"pagination_prev blue\" href=\"".backendurl("$pagurl/$prev").$tambahan."\"><i class='icon-angle-left'></i></a>\r\n"; //&lt; 
			
		}
	}
	else
	{
		$hal.="<span class=\"pagination_first gray\"><i class='icon-double-angle-left'></i></span> <span class=\"pagination_prev gray\"><i class='icon-angle-left'></i></span>\r\n";
	} 
	$diawal = ($pages<=5)?0:((($screen+1)==$pages)?$screen-3:(($screen==($pages-2))?$screen-2:(($screen >= 3)?$screen-1:0)));
	$diakhir = ($pages<=5)?$pages:(($screen==$pages-1)?0:(($screen==$pages-2)?($screen+2):($diakhir = ($screen=="1")?5:(($screen==0)?5:(($screen <= ($pages-2))?$screen+3:$pages)))));
	if($diakhir==0)$diakhir=$pages;
	
	//
	$hal .=  "<form name=\"pagination_form\" id=\"pagination_form\" action=\"$currentPaginationFile$tambahan\" method=\"post\">";
	$hal.="<select class=\"\" name=\"screen\" id=\"pagination_select\" onchange=\"pagination_form.submit()\">";
	for($i=1;$i<=$pages;$i++)
	{
		$selected=$screen==($i-1)?"selected=selected":"";
		$hal.="<option value=\"".($i-1)."\" $selected>";
		$hal.="$i";
		$hal.="</option>";
	}
	$hal.="</select>";
	// foreach($_GET as $field => $value)
	// {
		if($keyword!='')
		{
			$hal.="<input type=\"hidden\" name=\"keyword\" value=\"$keyword\" /> \n\r";
		}
	//}
	$hal .= " | ";
	$hal .= $pages;
	$hal .= "</form>";	


	
	if ($screen < $pages) 
	{
		$next = $screen + 1;
		if ($next < $pages ){
			if ($prmtr=="") {
				$hal .=  " <a class=\"pagination_next blue\" href=\"".backendurl("$pagurl/$next").$tambahan."\"><i class='icon-angle-right'></i></a>\r\n"; //&gt; 
			} else {
				$hal .=  " <a class=\"pagination_next blue\" href=\"".backendurl("$pagurl/$next").$tambahan."\"><i class='icon-angle-right'></i></a>\r\n"; //&gt; 
			}
			$hal .=  " <a class=\"pagination_last blue\" href=\"".backendurl("$pagurl/".($pages-1)).$tambahan."\"><i class='icon-double-angle-right'></i></a>\r\n"; //&gt; 
		}
		else
		{
				$hal .=" <span class=\"pagination_next gray\"><i class='icon-angle-right'></i></span> <span class=\"pagination_last gray\"><i class='icon-double-angle-right'></i></span>";
		}
	}
		
	$hal .="</div>";
	return $hal;
}
function allowHtml($input,$usejs=false)
{
if(!$usejs)
{
$pattern[]='/\<(SCRIPT|script)\>+([ ]|[a-z0-9A-Z])+\<\/(script|SCRIPT)\>/'; //semua yang ada didalam tag script ()
$pattern[]='/\<(SCRIPT|script)\>\<\/(script|SCRIPT)\>/'; //<SCRIPT><script>
$replace="";
$input=preg_replace($pattern,$replace, $input);
}
$input=addslashes($input);
return $input;
}
function cleanHtml($keyword,$addkey=array())
{
	/**/
	// membersikan karakter \ # -- 1=1 ' " ; 1=true anything=anything /
	//$pattern[]='/[\\\\|#|\'|\"|\;]|(\-\-)|(1\=1)|(1\=true)|[0-9a-zA-Z]+=+[0-9a-zA-Z]/'; 	
	// membersikan karakter \ # -- 1=1 ; 1=true anything=anything /
	$pattern[]='/[\\\\|#|\;]|(\-\-)|(1\=1)|(1\=true)|[0-9a-zA-Z]+=+[0-9a-zA-Z]/'; 
	//$pattern[]='/[\\\\|#|\'|\"|\;]|(\-\-)|(1\=1)|(1\=true)|[0-9a-zA-Z]+=+[0-9a-zA-Z]/'; 
	//$pattern[]='/\bor|OR\b/'; 
	//$pattern[]='/\band|AND\b/'; 
	//$pattern[]='/[\(]+[a-z0-9A-Z]+[\)]/'; //semua yang ada didalam kurung (isi)
	//$pattern[]='/[\(]+[]+[\)]/'; //semua yang ada didalam kurung ()
	//$pattern[]='/[\(]+[ ]+[\)]/'; //semua yang ada didalam kurung ( )
	// all tag script
	$pattern[]='/\<(SCRIPT|script)\>+([ ]|[a-z0-9A-Z])+\<\/(script|SCRIPT)\>/'; //semua yang ada didalam tag script ()
	$pattern[]='/\<(SCRIPT|script)\>\<\/(script|SCRIPT)\>/'; //<SCRIPT><script>
	/**/
	// ALL TAG//
	$pattern[]='/\<([a-zA-Z0-9])+\>\<\/([a-zA-Z0-9])+\>/'; // semua tag < >< />
	$pattern[]='/\<([a-zA-Z0-9])+\>+([ ]|[a-z0-9A-Z])+\<\/([a-zA-Z0-9])+\>/';// semua tag < >isi< />
	$pattern[]='/\<([a-zA-Z0-9])+\>/'; // semua tag < >
	$pattern[]='/\<\/([a-zA-Z0-9])+\>/'; // semua tag < />
	/**/
	$replace='';
	$hasil=preg_replace($pattern,$replace, $keyword);
	/**/
	if(in_array("singlequote",$addkey))
	{
	#	warning : tidak untuk query ex: untuk membuat link  yg ada single quotenya => &keyword='
	# cleanKeyword($keyword,$arr=array('singlequote')
	$hasil=str_replace("'",'&#039;',$hasil);
	}
	/**/
	return $hasil;
}

function cleanInput($input,$type='safecharacter',$length=0)
{
	$input=trim($input);
	$pattern["alpha"]="[^a-zA-Z]";
	$pattern["numeric"]="[^0-9]";
	$pattern["date"]="[^0-9\/-]";
	$pattern["alphanumeric"]="[^a-zA-Z0-9]";
	$pattern["safecharacter"]="[^a-zA-Z0-9@+-_.,\'\"\(\)\/\/{} ]";
	$pattern["field"]="[^a-zA-Z0-9\-\_\.]";
	$pattern["code"]="[^a-zA-Z0-9\-\_\.]";
	$pattern["field_name"]="[^a-zA-Z0-9\-\_\.]";
	$pattern["email"]="[^a-zA-Z0-9@_.]";
	
	if($type=="money") 
	{
		$temp=str_replace('.','',$input);
		$hasil=str_replace(',','.',$temp);
	}
	elseif($type=="html")
	{
	$hasil=preg_replace("/".$pattern[$type]."/",$replace, $input);
	}
	elseif($type=="url")
	{
	$input=str_replace(" ","-",$input);
	$pattern["url"]="[^a-zA-Z0-9_.-]";
	$replace="";
	$hasil=preg_replace("/".$pattern[$type]."/",$replace, $input);
	$hasil=strtolower($hasil);
	}
	elseif($type=="clear_tag")
	{
	$pattern[]='/\<([a-zA-Z0-9])+\>/'; // semua tag < >
	$pattern[]='/\<\/([a-zA-Z0-9])+\>/'; // semua tag < />
	$pattern[]='/\<img+?([a-zA-Z0-9 ])\>/'; // semua tag < >
	$replace=" ";
	$hasil=preg_replace($pattern,$replace, $input);
	}
	else
	{
	$replace="";
	$hasil=preg_replace("/".$pattern[$type]."/",$replace, $input);
	}
	
	if($length>0)
	{
		$hasil=substr($hasil,0,$length);
	}
	$hasil=addslashes($hasil);
	return $hasil;
}
function hanyaAngka($input){
	return cleanInput($input,'numeric');
}
function orderBy($field="",$title="",$order="asc",$field_active="",$param="")
{
global $orderurl;

if($field==$field_active)
{
$icon=$order=="asc"?"icon-sort-down":"icon-sort-up";
$order=$order=="asc"?"desc":"asc";
}
else
{
$icon="icon-sort";
$order="asc";
}
$param=$param!=""?"?$param":"";
$url=backendurl("$orderurl/$field/$order".$param);
$url="<a href='$url' class='th-order'><div class='order-title'>$title</div><div class='order-angle'><i class='$icon'></i></div></a>";
return $url;
}
function msg_warning($message,$i="")
{
$r_type=array("success"=>"alert-success","info"=>"alert-info","error"=>"alert-error");
$type=$r_type[$i];
$temp=<<<END
<div class="row-fluid">
<div class="span12">
	<div class="alert $type">
		<button data-dismiss="alert" class="close" type="button">×</button>
		$message.
	</div>
</div>
</div>
END;
$_SESSION['msg_warning'].=$temp;
}

	function upload($fieldname, $destdir, $destfile, $maxsize, $allowedtypes = "gif,jpg,jpeg,png",$quality="70") {

		/*
		  $fieldname : field name di form
		  $destdir : direktori tujuan
		  $destfile : nama file (minus extension, which is always the same as uploaded)
		  $maxsize : ukuran maksimum dalam byte (harus konsisten dengan MAX_FILE_SIZE di html)
		  $lang : (optional) bahasa. default="id".
		  $allowedtypes : (optional) jenis extension yang diizinkan, dipisahkan tanda koma. default = "gif,jpg,jpeg,png".
		 */
		if ($_FILES[$fieldname]['name'] != '') {
			$maxsizeinkb = intval($maxsize / 1000);



			//Filter 1: cek apakah file terupload dengan benar
			switch ($_FILES[$fieldname]['error']) {
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					return _FILETOOBIG . " $maxsizeinkb kbytes.";
					break;
				case UPLOAD_ERR_PARTIAL:
					return _FILEPARTIAL;
					break;
				case UPLOAD_ERR_NO_FILE:
					return _FILEERROR1;
					break;
			}

			//Filter 2: cek apakah ukuran sesuai yang diizinkan. Beda dengan filter 1 yang membandingkan terhadap setting php.ini, sekarang dibandingkan dengan aturan yang dibuat sendiri di config
			if ($_FILES[$fieldname]['size'] > $maxsize) {
				return _FILETOOBIG . " $maxsizeinkb kbytes.";
			}

			//Filter 3: cek apakah extension sesuai yang diizinkan

			$rallowedtypes = explode(',', $allowedtypes);
			$temp = explode('.', $_FILES[$fieldname]['name']);
			$extension = strtolower($temp[count($temp) - 1]);

			$isallowed = false;
			foreach ($rallowedtypes as $allowedtype) {
				if ($extension == $allowedtype)
					$isallowed = true;
			}

			if (!$isallowed) {
				return _ALLOWEDTYPE . " $allowedtypes.";
			}

			//Filter 4: cek apakah benar-benar file gambar (hanya jika $allowedtypes="gif,jpg,jpeg,png")
			//Tidak cek MIME-type karena barubah-ubah terus
			//Tidak cek extension karena nanti dipaksa berubah
			//Cek dilakukan sebelum dipindah ke destination dir (masih di temp)

			if ($extension == "gif" || $extension == "jpg" || $extension == "jpeg" || $extension == "png") {
				$size = getimagesize($_FILES[$fieldname]['tmp_name']);
				if ($size == FALSE) {
					return _ALLOWEDTYPE . " $allowedtypes.";
				}
			}

			//Filter 5: Jalankan
			$thelastdestination = ($destfile == '') ? "$destdir/" . $_FILES[$fieldname]['name'] : "$destdir/$destfile.$extension";		
			if (!move_uploaded_file($_FILES[$fieldname]['tmp_name'], $thelastdestination)) {
				return _MAYBEPERMISSION;
			}
			else
			{
				if ($extension == "gif" || $extension == "jpg" || $extension == "jpeg" || $extension == "png") {
				//compress image
				$info = getimagesize($thelastdestination);

				if ($info['mime'] == 'image/jpeg') 
				{
					$image = imagecreatefromjpeg($thelastdestination);
					imagejpeg($image, $thelastdestination, $quality);
				}
				elseif ($info['mime'] == 'image/gif') 
				{
					$image = imagecreatefromgif($thelastdestination);
					imagegif($image, $thelastdestination);
				}elseif ($info['mime'] == 'image/png') 
				{
					$image = imagecreatefrompng($thelastdestination);
					imagealphablending($image, false);
					imagesavealpha($image, true);
					imagepng($image, $thelastdestination, 9); // 0 = no compression, 9 = maximum compression
				}

				
				}
				return _SUCCESS;

			}
			
		} else {
			return _FILEPARTIAL;
		}
	}
	function resize($srcimgfile, $dstimgfile, $thumbcalcbase, $thumbcalcpx, $thumbcalcpxheight = 100) {
		
		/*
		  Resize gambar (misalnya bikin thumbnail)

		  string $scrimgfile : nama file asal
		  string $dstimgfile : nama file tujuan
		  string enum('s'|'l'|'w'|'h') $thumbcalcbase : dasar perhitungan resize menjadi thumbnail (shorter side, longer side, width, height).
		  int $thumbcalcpx : thumbnail image width/height in pixel

		  16:14 14/02/2010 tambahan:
		  string enum('b'|'f') $thumbcalcbase : dasar perhitungan resize menjadi thumbnail
		  b = both = maxwidth dan maxweight dua2nya ditentukan, ukuran hasil dimaksimalkan namun dipertahankan proporsional
		  f = fixed = maxwidth dan maxweight dua2nya ditentukan, ukuran hasil dipaksa mengikuti ketentuan meskipun terpaksa tidak proporsional
		  int $thumbcalcpxheight : thumbnail image height in pixel, hanya jika tambahan dipakai. default = 100 pixel.
		 */

		$temp = explode('.', $srcimgfile);
		
		$extension = strtolower($temp[count($temp) - 1]);
		//$mime = mime_content_type($srcimgfile);
		
		switch ($extension) {
			case 'jpg':
			case 'jpeg':
				$srcimg = imagecreatefromjpeg($srcimgfile);
				list($dstw, $dsth) = resizecalc($srcimg, $thumbcalcbase, $thumbcalcpx, $thumbcalcpxheight);
				$dstimg = imagecreatetruecolor($dstw, $dsth);
				if (!imagecopyresampled($dstimg, $srcimg, 0, 0, 0, 0, $dstw, $dsth, imagesx($srcimg), imagesy($srcimg)))
					return _CANTRESAMPLE;
				if (!imagejpeg($dstimg, $dstimgfile, 90))
					return _MAYBEPERMISSION;
				break;
			case 'gif':
				$srcimg = imagecreatefromgif($srcimgfile);
				list($dstw, $dsth) = resizecalc($srcimg, $thumbcalcbase, $thumbcalcpx, $thumbcalcpxheight);
				// $dstimg = imagecreate($dstw,$dsth); 

				// return value sumber gambar harus dari function imagecreatetruecolor()
				// - http://php.net/manual/en/function.imagecolortransparent.php
				$dstimg = imagecreatetruecolor($dstw, $dsth);
				$imgallocate = imagecolorallocate($dstimg, 0, 0, 0);

				// set backgroud menjadi transparan
				imagecolortransparent($dstimg, $imgallocate);
				$transparent = imagecolorallocatealpha($dstimg, 255, 255, 255, 127);
				imagefilledrectangle($dstimg, 0, 0, $dstw, $dsth, $transparent);
				//==========================			
				if (!imagecopyresampled($dstimg, $srcimg, 0, 0, 0, 0, $dstw, $dsth, imagesx($srcimg), imagesy($srcimg)))
					return _CANTRESAMPLE;
				if (!imagegif($dstimg, $dstimgfile))
					return _MAYBEPERMISSION;
				break;
			case 'png':
			/**/
			
				$image = imagecreatefrompng ($srcimgfile);
				
				list($dst_width, $dst_height) = resizecalc($image, $thumbcalcbase, $thumbcalcpx, $thumbcalcpxheight);
				//die("$dst_width, $dst_height");
				$new_image = imagecreatetruecolor ($dst_width, $dst_height ); // new wigth and height
				imagealphablending($new_image , false);
				imagesavealpha($new_image , true);
				imagecopyresampled ( $new_image, $image, 0, 0, 0, 0, $dst_width, $dst_height, imagesx ( $image ), imagesy ( $image ) );
				$image = $new_image;

				// saving
				imagealphablending($image , false);
				imagesavealpha($image , true);
				if (!imagepng ($image, $dstimgfile))
				return _MAYBEPERMISSION;
				/**/
				break;
		}
		
	}
	function resizecalc($srcimg, $thumbcalcbase, $thumbcalcpx, $thumbcalcpxheight) {
		switch ($thumbcalcbase) {
			case 'h':
				$dsth = $thumbcalcpx;
				$dstw = round(imagesx($srcimg) / imagesy($srcimg) * $dsth);
				break;
			case 'w':
				$dstw = $thumbcalcpx;
				$dsth = round(imagesy($srcimg) / imagesx($srcimg) * $dstw);
				break;
			case 'l':
			
				if (imagesx($srcimg) <= imagesy($srcimg)) { //portrait
					$dsth = $thumbcalcpx;
					$dstw = round(imagesx($srcimg) / imagesy($srcimg) * $dsth);
				} else { //landscape
					$dstw = $thumbcalcpx;
					$dsth = round(imagesy($srcimg) / imagesx($srcimg) * $dstw);
				}
			  //  die($dsth." vv ".imagesx($srcimg));
				break;
			case 's':
				if (imagesx($srcimg) <= imagesy($srcimg)) { //portrait
					$dstw = $thumbcalcpx;
					$dsth = round(imagesy($srcimg) / imagesx($srcimg) * $dstw);
				} else { //landscape
					$dsth = $thumbcalcpx;
					$dstw = round(imagesx($srcimg) / imagesy($srcimg) * $dsth);
				}
				break;
			case 'b':
				if ($thumbcalcpx / imagesx($srcimg) <= $thumbcalcpxheight / imagesy($srcimg)) { //ikuti x
					$dstw = $thumbcalcpx;
					$dsth = round(imagesy($srcimg) / imagesx($srcimg) * $dstw);
				} else { //ikuti y
					$dsth = $thumbcalcpxheight;
					$dstw = round(imagesx($srcimg) / imagesy($srcimg) * $dsth);
				}
				break;
			case 'f':
				$dstw = $thumbcalcpx;
				$dsth = $thumbcalcpxheight;
				break;
		}
		return array($dstw, $dsth);
	}
function redirecto($message,$type="error",$action="")
{
global $modul;
if($message!="")
{
msg_warning($message,$type);
}
if($action!="")
{
header("location:".backendurl("$modul/$action"));
exit();
}
}




function pagename($id,$prop=array())
{
global $mysql,$config;
$q=$mysql->query("SELECT title from page where id=$id");
if($mysql->numrows($q)>0)
{
list($title)=$mysql->row($q);
$t="<a href='".$config['backendurl']."/page/edit/$id'";
foreach($prop as $i =>$v)
{
$t."$i='$v'";
}
$t.="><span>$title</span></a>";
return $t;
}

}

function form_title($vmodul="")
{
/*
global $mysql,$modul,$list_lang;
ob_start();
$label=_JUDUL;
$labelbutton=_GANTIJUDUL;
$dopost=0;
foreach($list_lang as $i =>$v)
{
	${"title_$v"}=$_POST["title_$v"];
	
}
if($_POST['do_title_change'])
{
$namamodul=$vmodul!=""?$vmodul:$modul;
$judul=cleanInput($_POST['title_modul']);
$sql="REPLACE INTO modul(title_id,title_en,modul) VALUES('$title_id','$title_en','$modul')";
$q=$mysql->query($sql);
}
$q=$mysql->query("SELECT * FROM modul WHERE modul='$modul'");
if($q and $mysql->numrows($q)>0)
{
	$d=$mysql->assoc($q);
}
echo '<form class="form-horizontal" method="POST" action="">';
foreach($list_lang as $i =>$v)
{
$judul=$d["title_$v"];
echo <<<END
			<div class="control-group">
			<label class="control-label" for="judul-element-$v">$label ($v)</label>
			<div class="controls">
			<input type="text" id="judul-element-$v" value="$judul" name="title_$v" class="search-query">
			</div>
			</div>	
END;
}

echo '<div class="form-actions"><button class="btn btn-primary" type="submit" value="1" name="do_title_change">'.$labelbutton.'</button></form>';
return ob_get_clean();
*/
}

function modul_title($vmodul="")
{
global $modul,$mysql,$lang;
$namamodul=$vmodul!=""?$vmodul:$modul;
$q=$mysql->query("SELECT title_$lang FROM modul WHERE modul='$namamodul'");
if($q and $mysql->numrows($q)>0)
{
	list($judul)=$mysql->row($q);
}
return $judul;
}

function logcounter() 
{
$sql = "SELECT DISTINCT visitor FROM counter";
    $result = $mysql->query($sql);
    $visitor = '';
    while (list($visitor) = $mysql->row($result)) {
        if (strpos($visitor, $_COOKIE['countertrack']) > -1)
            break;
    }
    if (isset($visitor)) {
        $sql = "UPDATE counter SET kunjungan=kunjungan+1 WHERE visitor='$visitor'";
        $mysql->query($sql);
    } else {
		$visitor = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'].time());
        setCookie("countertrack", $visitor, time() + 60 * 30); //definisi unique visitor = 30 menit
        $sql = "INSERT INTO counter(visitor, kunjungan, tanggal) VALUES ('$visitor','1', NOW())";
        $r=$mysql->query($sql);			
    }
   
}
function delcounter()
{
    $sql = "SELECT COUNT(kunjungan), SUM(kunjungan) FROM counter WHERE tanggal <= DATE_SUB(NOW(), INTERVAL 60 DAY)";
    $result = mysql_query($sql);
    list($visitors, $hits) = mysql_fetch_row($result);
    $sql = "UPDATE counterhistory SET nilai=nilai+$visitors WHERE nama='pasttimevisitors'";
    mysql_query($sql);
    $sql = "UPDATE counterhistory SET nilai=nilai+$hits WHERE nama='pasttimehits'";
    mysql_query($sql);
    $sql = "DELETE FROM counter WHERE tanggal <= DATE_SUB(NOW(), INTERVAL 60 DAY)";
    mysql_query($sql);
}
class categories {

    var $cats = array();
    var $subs = num;
    var $cat_map = array();

    function get_cats_($cats_result, $parent_id = 0, $level = 1) {
        for ($i = 0; $i < count($cats_result); $i++) {
            if ($cats_result[$i]['parent'] == $parent_id) {
                $cats_result[$i]['level'] = $level;
                $this->cats[] = $cats_result[$i];
                $this->get_cats_($cats_result, $cats_result[$i]['id'], $level + 1, $type);
            }
        }
    }

    function get_cats($cats_result, $parent_id = 0, $level = 1) {
        $this->cats = array();
        $this->tmp_cats = array();
        $this->get_cats_($cats_result, $parent_id, $level);
    }

    function count_subs($id, $cats_result) {
        $this->tmp_cats = array();
        $this->subs = NULL;
        $this->get_cats($cats_result, $id, 1);
        $this->subs = count($this->tmp_cats);
    }

    function cat_map_($id, $cats_result) {
        for ($i = 0; $i < count($cats_result); $i++) {
            $cats_result_[$cats_result[$i]['id']] = $cats_result[$i];
        }
        while (list($a, $b) = @each($cats_result_)) {
            if ($cats_result_[$id]['parent'] > 0 && $cats_result_[$id]['parent'] == $cats_result_[$a]['id']) {
                $this->cat_map[] = $cats_result_[$a];
                if ($cats_result_[$a]['parent'] > 0) {
                    $this->cat_map_($cats_result_[$a]['id'], $cats_result, $type);
                }
            }
        }
    }

    function cat_map($id, $cats_result) {
        @$this->cat_map = array();
        @$this->tmp_cat_map = array();
        $this->cat_map_($id, $cats_result);
        $this->cat_map = @array_reverse($this->cat_map);
    }

}
function load_datepicker()
{
global $config;
global $style_css,$script_js,$modul;
$style_css.='<link rel="stylesheet" href="'.backendurl("template/css/plugins/datepicker/datepicker.css").'">';
$script_js='<script src="'.backendurl("template/js/plugins/datepicker/bootstrap-datepicker.js").'"></script>';
}
function load_plugin_css($url="")
{
global $style_css,$script_js,$modul;
$style_css.='<link rel="stylesheet" href="'.backendurl($url).'">';
}
function load_plugin_js($url="")
{
global $style_css,$script_js,$modul;
$script_js.='<script src="'.backendurl($url).'"></script>'."\r\n";
}
function multiple_upload($fieldname, $destdir, $destfile, $maxsize, $prefname = "", $allowedtypes = "gif,jpg,jpeg,png") {
    global $namathumbnail;
    /*
      $fieldname : field name di form
      $destdir : direktori tujuan
      $destfile : nama file (minus extension, which is always the same as uploaded)
      $maxsize : ukuran maksimum dalam byte (harus konsisten dengan MAX_FILE_SIZE di html)
      $lang : (optional) bahasa. default="id".
      $allowedtypes : (optional) jenis extension yang diizinkan, dipisahkan tanda koma. default = "gif,jpg,jpeg,png".
     */
    $totalupload = count($_FILES[$fieldname]['name']);
    for ($i = 0; $i <= $totalupload; $i++) {
        if ($_FILES[$fieldname]['name'][$i] != '') {
            $maxsizeinkb = intval($maxsize / 1000);

            //Filter 1: cek apakah file terupload dengan benar
            switch ($_FILES[$fieldname]['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    return _FILETOOBIG . " $maxsizeinkb kbytes.";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    return _FILEPARTIAL;
                    break;
                case UPLOAD_ERR_NO_FILE:
                    return _FILEERROR1;
                    break;
            }

            //Filter 2: cek apakah ukuran sesuai yang diizinkan. Beda dengan filter 1 yang membandingkan terhadap setting php.ini, sekarang dibandingkan dengan aturan yang dibuat sendiri di config
            if ($_FILES[$fieldname]['size'][$i] > $maxsize) {
                return _FILETOOBIG . " $maxsizeinkb kbytes.";
            }

            //Filter 3: cek apakah extension sesuai yang diizinkan

            $rallowedtypes = explode(',', $allowedtypes);
            $temp = explode('.', $_FILES[$fieldname]['name'][$i]);
            $extension = strtolower($temp[count($temp) - 1]);

            $isallowed = false;
            foreach ($rallowedtypes as $allowedtype) {
                if ($extension == $allowedtype)
                    $isallowed = true;
            }

            if (!$isallowed) {
                return _ALLOWEDTYPE . " $allowedtypes.";
            }

            //Filter 4: cek apakah benar-benar file gambar (hanya jika $allowedtypes="gif,jpg,jpeg,png")
            //Tidak cek MIME-type karena barubah-ubah terus
            //Tidak cek extension karena nanti dipaksa berubah
            //Cek dilakukan sebelum dipindah ke destination dir (masih di temp)

            if ($extension == "gif" || $extension == "jpg" || $extension == "jpeg" || $extension == "png") {
                $size = getimagesize($_FILES[$fieldname]['tmp_name'][$i]);
                if ($size == FALSE) {
                    return _ALLOWEDTYPE . " $allowedtypes.";
                }
            }

            //Filter 5: Jalankan
            $uniq = uniqid();
            $thumb_name =$prefname!=""?"-".$uniq.$extension:"$uniq.$extension";
            $namathumbnail[$i] = $thumb_name;
            $thelastdestination = "$destdir/$thumb_name";
            if (!move_uploaded_file($_FILES[$fieldname]['tmp_name'][$i], $thelastdestination)) {
                return _MAYBEPERMISSION;
            }
        }
    }

}
function currency($uang,$matauang="")
{
return $matauang.number_format($uang, 0, ',', '.');
}
function build_url() 
{
	$build_url_r=array();
	$join_url="";
	for($i=1;$i<=6;$i++)
	{
	if($_GET["seg$i"]!="")
	$build_url_r[]=$_GET["seg$i"];
	}
	if(count($build_url_r)>0)
	$join_url=join("/",$build_url_r);
	
	return $join_url;
}
function current_url() 
{
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
class MenuLeft
{
	public $parent="";
	public $child=array();
	public $ishome=array();
	public $temp="";
	
	public function __construct()
	{
		list($url,$name,$ishome,$sel_icon) = func_get_args();
		if($url!="" and $name!="")
		{
			$icon=$ishome==1?"icon-home":"icon-leaf";
			$icon=$sel_icon!=""?$sel_icon:$icon;
			$menuselected="";
			if($_GET['seg1']==$url)$menuselected="class='menu-left-selected'";
			echo '		
			<div class="subnav">	
			<ul id="menu'.cleanInput($url,"url").'" class="subnav-menu">	
			<li '.$menuselected.'><i class="'.$icon.'"></i><a  href="'.backendurl("$url").'" id="'.cleanInput($url,"url").'">'.$name.'</a></li>
			</ul> 
			</div>';
			
		}
	}
	public function parent($name,$ishome=0,$sel_icon="")
	{
		$this->parent=$name;
		$this->ishome=$ishome;
		$this->icon=$ishome==1?"icon-home":"icon-leaf";
		$this->icon=$sel_icon!=""?$sel_icon:$this->icon;
	}
	public function child($url="",$name="",$sel_icon="")
	{
		$this->child[]=array($url,$name,$sel_icon);
		
		
	}
	public function show()
	{
	$menuchild="";
	$terpilih=0;
	foreach($this->child as $i =>$v)
	{
		$menuselected="";
		if($_GET['seg1']==$v[0] or ($_GET['seg1']."/".$_GET['seg2']==$v[0]) or ($_GET['seg1']."/".$_GET['seg2']."/".$_GET['seg3']==$v[0]))
		{
			$menuselected="class='menu-left-selected'";$terpilih=1;
		}
		$menuchild.= '<li '.$menuselected.'><i class="glyphicon-chevron-right"></i><a  href="'.backendurl($v[0]).'">'.$v[1].'</a></li>';
	}	
	echo '
	<div class="subnav'.($terpilih==1?"":" subnav-hidden").'">	
	<div class="subnav-title">
		<i class="'.$this->icon.'"></i>
		<a href="#" class="toggle-subnav">'.$this->parent.'<i class="icon-angle-down"></i></a>
	</div>
	<ul id="menu'.cleanInput($this->parent,"url").'" class="subnav-menu child-menu">';
	 echo $menuchild;	
	 echo '</ul> 
	</div>';	
	$this->child=array();
	}
}
class MenuLeft2
{
	public $parent="";
	public $child=array();
	public $ishome=array();
	public $temp="";
	
	public function __construct()
	{
		list($url,$name,$ishome,$sel_icon) = func_get_args();
		if($url!="" and $name!="")
		{
			$icon=$ishome==1?"fa-circle":"fa-circle";
			$icon=$sel_icon!=""?$sel_icon:$icon;
			$menuselected="";
			if($_GET['seg1']==$url)$menuselected=" active";
			echo '
			 <li class="nav-item">
				<a href="'.backendurl("$url").'" class="nav-link'.$menuselected.'">
				  <i class="fas '.$icon.' nav-icon"></i>
				  <p>
					'.$name.'
				  </p>
				</a>
			  </li>
			';
			/*
			echo '		
			<div class="subnav">	
			<ul id="menu'.cleanInput($url,"url").'" class="subnav-menu">	
			<li '.$menuselected.'><i class="'.$icon.'"></i><a  href="'.backendurl("$url").'" id="'.cleanInput($url,"url").'">'.$name.'</a></li>
			</ul> 
			</div>';
			*/ 
			
		}
	}
	public function parent($name,$ishome=0,$sel_icon="")
	{
		$this->parent=$name;
		$this->ishome=$ishome;
		$this->icon=$ishome==1?"fa-circle":"fa-circle";
		$this->icon=$sel_icon!=""?$sel_icon:$this->icon;
	}
	public function child($url="",$name="",$sel_icon="")
	{
		$this->child[]=array($url,$name,$sel_icon);
		
		
	}
	public function show()
	{
	$menuchild="";
	$terpilih=0;
	foreach($this->child as $i =>$v)
	{
		$menuselected="";
		if($_GET['seg1']==$v[0] or ($_GET['seg1']."/".$_GET['seg2']==$v[0]) or ($_GET['seg1']."/".$_GET['seg2']."/".$_GET['seg3']==$v[0]))
		{
			//$menuselected="class='menu-left-selected'";$terpilih=1;
			$menuselected=" active";$terpilih=1;
		}
		//$menuchild.= '<li '.$menuselected.'><i class="glyphicon-chevron-right"></i><a  href="'.backendurl($v[0]).'">'.$v[1].'</a></li>';
		$menuchild .=' 
			<li class="nav-item">
				<a href="'.backendurl($v[0]).'" class="nav-link'.$menuselected.'">
				  <i class="fas fa-circle nav-icon"></i>
				  <p>
					'.$v[1].'
				  </p>
				</a>
			  </li>';
	}	
	echo '
	 <li class="nav-item has-treeview '.($terpilih==1?"menu-open":"").'">
		<a href="#" class="nav-link '.($terpilih==1?"active":"").'">
		  <i class="nav-icon fas '.$this->icon.'"></i>
		  <p>
			 '.$this->parent.'
			<i class="right fas fa-angle-left"></i>
		  </p>
		</a>
		<ul class="nav nav-treeview">
		'.$menuchild.'
		</ul>
     </li>
     
     ';
    /*
    echo ' 
	<div class="subnav'.($terpilih==1?"":" subnav-hidden").'">	
	<div class="subnav-title">
		<i class="'.$this->icon.'"></i>
		<a href="#" class="toggle-subnav">'.$this->parent.'<i class="icon-angle-down"></i></a>
	</div>
	<ul id="menu'.cleanInput($this->parent,"url").'" class="subnav-menu child-menu">';
	 echo $menuchild;	
	 echo '</ul> 
	</div>';	
	*/ 
	
	$this->child=array();
	}
}
class MenuSiswa
{
	public $parent="";
	public $child=array();
	public $ishome=array();
	public $temp="";
	
	public function __construct()
	{
		list($url,$name,$ishome,$sel_icon) = func_get_args();
		if($url!="" and $name!="")
		{
			$icon=$ishome==1?"fa-circle":"fa-circle";
			$icon=$sel_icon!=""?$sel_icon:$icon;
			$menuselected="";
			if($_GET['seg2']==$url)$menuselected=" active";
			echo '
			 <li class="nav-item">
				<a href="'.fronturl("siswa/$url").'" class="nav-link'.$menuselected.'">
				  <i class="fas '.$icon.' nav-icon"></i>
				  <p>
					'.$name.'
				  </p>
				</a>
			  </li>
			';
			/*
			echo '		
			<div class="subnav">	
			<ul id="menu'.cleanInput($url,"url").'" class="subnav-menu">	
			<li '.$menuselected.'><i class="'.$icon.'"></i><a  href="'.fronturl("siswa/$url").'" id="'.cleanInput($url,"url").'">'.$name.'</a></li>
			</ul> 
			</div>';
			*/ 
			
		}
	}
	public function parent($name,$ishome=0,$sel_icon="")
	{
		$this->parent=$name;
		$this->ishome=$ishome;
		$this->icon=$ishome==1?"fa-circle":"fa-circle";
		$this->icon=$sel_icon!=""?$sel_icon:$this->icon;
	}
	public function child($url="",$name="",$sel_icon="")
	{
		$this->child[]=array($url,$name,$sel_icon);
		
		
	}
	public function show()
	{
	$menuchild="";
	$terpilih=0;
	foreach($this->child as $i =>$v)
	{
		$menuselected="";
		if($_GET['seg2']==$v[0] or ($_GET['seg2']."/".$_GET['seg3']==$v[0]) or ($_GET['seg2']."/".$_GET['seg3']."/".$_GET['seg4']==$v[0]))
		{
			//$menuselected="class='menu-left-selected'";$terpilih=1;
			$menuselected=" active";$terpilih=1;
		}
		//$menuchild.= '<li '.$menuselected.'><i class="glyphicon-chevron-right"></i><a  href="'.fronturl($v[0]).'">'.$v[1].'</a></li>';
		$menuchild .=' 
			<li class="nav-item">
				<a href="'.fronturl($v[0]).'" class="nav-link'.$menuselected.'">
				  <i class="fas fa-circle nav-icon"></i>
				  <p>
					'.$v[1].'
				  </p>
				</a>
			  </li>';
	}	
	echo '
	 <li class="nav-item has-treeview '.($terpilih==1?"menu-open":"").'">
		<a href="#" class="nav-link '.($terpilih==1?"active":"").'">
		  <i class="nav-icon fas '.$this->icon.'"></i>
		  <p>
			 '.$this->parent.'
			<i class="right fas fa-angle-left"></i>
		  </p>
		</a>
		<ul class="nav nav-treeview">
		'.$menuchild.'
		</ul>
     </li>
     
     ';
    /*
    echo ' 
	<div class="subnav'.($terpilih==1?"":" subnav-hidden").'">	
	<div class="subnav-title">
		<i class="'.$this->icon.'"></i>
		<a href="#" class="toggle-subnav">'.$this->parent.'<i class="icon-angle-down"></i></a>
	</div>
	<ul id="menu'.cleanInput($this->parent,"url").'" class="subnav-menu child-menu">';
	 echo $menuchild;	
	 echo '</ul> 
	</div>';	
	*/ 
	
	$this->child=array();
	}
}
/*
class MenuLeft
{
	public $parent="";
	public $child=array();
	public $ishome=array();
	public $temp="";
	public $icon="";
	public $r_icon=array();
	
	public function __construct()
	{
		list($url,$name,$ishome,$sel_icon) = func_get_args();
		if($url!="" and $name!="")
		{
		$icon=$ishome==1?"icon-home":"icon-leaf";
		$icon=$sel_icon!=""?$sel_icon:$icon;
			echo '		
			<div class="subnav">	
			<ul id="menu'.cleanInput($url,"url").'" class="subnav-menu">	
			<li><i class="'.($icon).'"></i><a href="'.backendurl("$url").'" id="'.cleanInput($url,"url").'">'.$name.'</a></li>
			</ul> 
			</div>';
			
		}
	}
	public function parent($name,$ishome=0,$sel_icon="")
	{
		$this->parent=$name;
		$this->ishome=$ishome;
		$this->icon=$ishome==1?"icon-home":"icon-leaf";
		$this->icon=$sel_icon!=""?$sel_icon:$this->icon;
	}
	public function child($url="",$name="",$sel_icon="")
	{
		$this->child[]=array($url,$name,$sel_icon);
		
		
	}
	public function show($hiddensub=1)
	{
	$class="";
	if($hiddensub==1)
	{
		$class=" subnav-hidden";
	}
	echo '
	<div class="subnav'.$class.'">	
	<div class="subnav-title">
		<i class="'.($this->icon).'"></i>
		<a href="#" class="toggle-subnav">'.$this->parent.'<i class="icon-angle-down"></i></a>
	</div>
	<ul id="menu'.cleanInput($this->parent,"url").'" class="subnav-menu child-menu">';
	foreach($this->child as $i =>$v)
	{
		$child_icon=$v[2]==""?"glyphicon-chevron-right":$v[2];
		echo '<li><i class="'.$child_icon.'"></i><a href="'.backendurl($v[0]).'">'.$v[1].'</a></li>';
	}	
	 echo '</ul> 
	</div>';	
	}
}
* */


function delete_files($dir) { 
  foreach(glob($dir . '/*') as $file) { 
    if(is_dir($file)) delete_files($file); else unlink($file); 
  } rmdir($dir); 
}


function xcopy($source, $dest, $permissions = 0755)
{
    // Check for symlinks
    if (is_link($source)) {
        return symlink(readlink($source), $dest);
    }

    // Simple copy for a file
    if (is_file($source)) {
        return copy($source, $dest);
    }

    // Make destination directory
    if (!is_dir($dest)) {
        mkdir($dest, $permissions);
    }

    // Loop through the folder
    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        // Deep copy directories
        xcopy("$source/$entry", "$dest/$entry", $permissions);
    }

    // Clean up
    $dir->close();
    return true;
}



function tgl_indo($yymmdd)
{
	list($yy,$mm,$dd)=explode("-",$yymmdd);
	return "$dd/$mm/$yy";
}
function tgl_indo_waktu($yymmddhhiiss)
{
	
	$tanggal = date('d/m/Y',strtotime($yymmddhhiiss));
	$waktu = date('H:i',strtotime($yymmddhhiiss));
	return "$tanggal $waktu";
}
function tgl_indo_long($yymmdd)
{
	list($yy,$mm,$dd)=explode("-",$yymmdd);
	$bulan=array(
	"1"=>"Januari",
	"2"=>"Februari",
	"3"=>"Maret",
	"4"=>"April",
	"5"=>"Mei",
	"6"=>"Juni",
	"7"=>"Juli",
	"8"=>"Agustus",
	"9"=>"September",
	"10"=>"Oktober",
	"11"=>"Nopember",
	"12"=>"Desember",
	);
	return "$dd ".$bulan[intval($mm)]." $yy";
}
function tgl_indo_short($yymmdd)
{
	list($yy,$mm,$dd)=explode("-",$yymmdd);
	$bulan=array(
	"1"=>"Jan",
	"2"=>"Feb",
	"3"=>"Mar",
	"4"=>"Apr",
	"5"=>"Mei",
	"6"=>"Jun",
	"7"=>"Jul",
	"8"=>"Agu",
	"9"=>"Sep",
	"10"=>"Okt",
	"11"=>"Nop",
	"12"=>"Des",
	);
	return "$dd ".$bulan[intval($mm)]." $yy";
}
function path_to_soal_json($id_soal){
	$nama_file=filename_soal_json($id_soal);
	return filepath("db_question/$nama_file.php");
}
function filename_soal_json($id_soal){
	return "alma_{$id_soal}_".md5(sha1("goreng".$id_soal));
}
function utf8ize($d) {
    if (is_array($d) || is_object($d)) {
        foreach ($d as &$v) $v = utf8ize($v);
    } else {
        $enc   = mb_detect_encoding($d);

        $value = iconv($enc, 'UTF-8', $d);
        return $value;
    }

    return $d;
}
function reset_web_config(){
	global $mysql,$_d;	
	$memcached=$_d['memcached'];
	if($memcached){
		$mem = new Memcached();
		$mem->addServer("127.0.0.1", 11211);
		$mem->delete("web_config"); 
		
		$result=array();
		$q=$mysql->query("SELECT name,title_id title FROM web_config");
		if($q and $mysql->numrows($q)>0)
		{
			while($d=$mysql->assoc($q))
			{
				$var="web_config_".$d['name'];
				$result[$var]=$d['title'];
			}			
			
		}
		
		$mem->set($_d['db_name']."_"."web_config", $result) or die("Couldn't save anything to memcached...");
	}

}
function web_config(){
	global $mysql,$_d;
	$result=array();
	$memcached=$_d['memcached'];
	if($memcached){
		$mem = new Memcached();
		$mem->addServer("127.0.0.1", 11211); 
		$result = $mem->get($_d['db_name']."_"."web_config");
	}

	if (is_array($result) and count($result)>0) {
		return $result;
	} else {
		$result=array();
		$q=$mysql->query("SELECT name,title_id title FROM web_config");
		if($q and $mysql->numrows($q)>0)
		{
			while($d=$mysql->assoc($q))
			{
				$var="web_config_".$d['name'];
				$result[$var]=$d['title'];
			}			
			
		}
		if($memcached){
			$mem->set($_d['db_name']."_"."web_config", $result) or die("Couldn't save anything to memcached...");
		}
	}
return $result;	
}
function generate_soal_json($id_soal){
	global $mysql,$_d;
	$memcached=$_d['memcached'];
	if($memcached==1){
		$m = new Memcached();
		$m->addServer('localhost', 11211);
		$m->delete($_d['db_name']."_"."data_soal_$id_soal");
	}
	if($id_soal!="" && !$memcached)
	{
		
		generate_master_soal_json($id_soal);
		
		$nama_file=filename_soal_json($id_soal);
		/**/
		$myfile = fopen(path_to_soal_json($id_soal), "w") or die("Unable to open file!");
		$data=array();
		$data['master_soal']=$mysql->query_data("SELECT * FROM quiz_master WHERE id=$id_soal");
		$data['soal_ganda']=$mysql->query_data("SELECT * FROM quiz_detail WHERE quiz_id=$id_soal ORDER BY id, urutan","id");
		$data['soal_complex']=$mysql->query_data("SELECT * FROM quiz_complex WHERE quiz_id=$id_soal ORDER BY id, urutan","id");
		$data['soal_essay']=$mysql->query_data("SELECT * FROM quiz_essay WHERE quiz_id=$id_soal ORDER BY id, urutan","id");
		
		fwrite($myfile,'<?php '.PHP_EOL);
		ob_start();
		fwrite($myfile,'$soal_json='.PHP_EOL);
		//JSON_HEX_APOS to JSON_HEX_TAG 
		echo "'".json_encode(utf8ize($data), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)."'";
		//echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
		$txt =ob_get_clean();
		fwrite($myfile, $txt.PHP_EOL);
		fwrite($myfile,';'.PHP_EOL.PHP_EOL);
		
		fwrite($myfile,'?> ');
		fclose($myfile);
		/**/
	}
}

////////////////////////
function path_to_master_soal_json($kode_soal){
	$nama_file=filename_master_soal_json($kode_soal);
	return filepath("db_question/$nama_file.php");
}
function filename_master_soal_json($kode_soal){
	return "alma_master_{$kode_soal}_".md5(sha1("goreng".$kode_soal));
}
function generate_master_soal_json($id_soal){
	global $mysql;
	if($id_soal!="")
	{
		$data=array();
		list($data['master_soal'])=$mysql->query_data("SELECT * FROM quiz_master WHERE id=$id_soal");
		
		
		$nama_file=filename_master_soal_json($data['master_soal']['code']);
		$myfile = fopen(path_to_master_soal_json($data['master_soal']['code']), "w") or die("Unable to open file!");
		
		
		fwrite($myfile,'<?php '.PHP_EOL);
		ob_start();
		fwrite($myfile,'$master_soal_json='.PHP_EOL);
		//JSON_HEX_APOS to JSON_HEX_TAG 
		echo "'".json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)."'";
		//echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
		$txt =ob_get_clean();
		fwrite($myfile, $txt.PHP_EOL);
		fwrite($myfile,';'.PHP_EOL.PHP_EOL);
		
		fwrite($myfile,'?> ');
		fclose($myfile);
		/**/
	}
}
function get_master_soal_json($kode_soal){
	include(path_to_master_soal_json($kode_soal));
	$r_json_soal=json_decode($master_soal_json,true);
	return $r_json_soal['master_soal'];
}
////////////////////////
function remove_soal_json($id_soal){
	unlink(path_to_soal_json($id_soal));
}

function path_to_member_json(){
	$nama_file=filename_member_json();
	return filepath("db_member/$nama_file.php");
}

function filename_member_json(){
	return "alma_member_".md5(sha1("goreng"));
}

function generate_member_json(){
	global $mysql;
	
		//$nama_file=filename_member_json();
		/**/
		$myfile = fopen(path_to_member_json(), "w") or die("Unable to open file!");
		$data=array();
		
		$data=$mysql->query_data("SELECT * FROM quiz_member ");
		
		
		fwrite($myfile,'<?php '.PHP_EOL);
		ob_start();
		fwrite($myfile,'$member_json='.PHP_EOL);
		//JSON_HEX_APOS to JSON_HEX_TAG 
		echo "'".json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)."'";
		//echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
		$txt =ob_get_clean();
		fwrite($myfile, $txt.PHP_EOL);
		fwrite($myfile,';'.PHP_EOL.PHP_EOL);
		
		fwrite($myfile,'?> ');
		fclose($myfile);
		/**/
	
}
function reset_member($username){
	global $mysql,$_d;
	$memcached=$_d['memcached'];
	$data_member=array();
	if($memcached){
		$mem = new Memcached();
		$mem->addServer("127.0.0.1", 11211);
		$mem->delete($_d['db_name']."_"."dm_".$username);	
		/*
		$q=$mysql->query("SELECT username FROM quiz_member ");
		if($q AND $mysql->numrows($q)>0){
			while($d=$mysql->assoc($q)){
				$mem->delete("dm_".$d['username']);	
			}
		}
		*/ 
		
	}
}

function get_member_json($username){
	global $mysql,$_d;
	$memcached=$_d['memcached'];
	$isredis=$_d['redis'];
	$data_member=array();
	if($memcached){
		$mem = new Memcached();
		$mem->addServer("127.0.0.1", 11211);
		$data_member = $mem->get($_d['db_name']."_"."dm_".$username);
	}
	if($isredis){

		$redis = new Redis(); 
		$redis->connect('127.0.0.1', 6379); 
		$data_member=unserialize($redis->get("dm_".$username));
			
	}
	
	if(count($data_member)>1){
		return $data_member;
	}else{
		$q=$mysql->query("SELECT * FROM quiz_member WHERE lower(username)='".strtolower($username)."'  ");
		if($q and $mysql->numrows($q)>0){
			$data_member=$mysql->assoc($q);
			unset($data_member['password']);
		}
		
		if($memcached and count($data_member)>0){
			$mem->set($_d['db_name']."_"."dm_".$username,$data_member);
		}
		if($isredis and count($data_member)>0){
			
			$redis->set($_d['db_name']."_"."dm_".$username,serialize($data_member));
		}
		
	}
	
	return $data_member;
	
	
	
}
function get_soal_json($quiz_id){
	global $mysql,$_d,$bahas_soal;
	
	$memcached=$_d['memcached'];
	$isredis=$_d['redis'];
	$result=array();
	if(($memcached or $isredis) and !$bahas_soal){
		
		if($memcached){
			$mem = new Memcached();
			$mem->addServer("127.0.0.1", 11211);
			$result = $mem->get($_d['db_name']."_"."data_soal_$quiz_id");
		}
		
		if($isredis){
			
			$redis = new Redis(); 
			$redis->connect('127.0.0.1', 6379); 
			$result=unserialize($redis->get($_d['db_name']."_"."data_soal_$quiz_id"));
		}
	
		$data=array();
		if (is_array($result)) {
			
			return $result;
		} else {
			$data=array();
			$data['master_soal']=$mysql->query_data("SELECT * FROM quiz_master WHERE id=$quiz_id");
			$data['soal_ganda']=$mysql->query_data("SELECT * FROM quiz_detail WHERE quiz_id=$quiz_id ORDER BY urutan,id","id");
			$data['soal_complex']=$mysql->query_data("SELECT * FROM quiz_complex WHERE quiz_id=$quiz_id ORDER BY urutan,id","id");
			$data['soal_essay']=$mysql->query_data("SELECT * FROM quiz_essay WHERE quiz_id=$quiz_id ORDER BY urutan,id","id");
			if($memcached){
				$mem->set($_d['db_name']."_"."data_soal_$quiz_id", $data) or die("Couldn't save anything to memcached...");
			}
			if($isredis){
				$redis->set($_d['db_name']."_"."data_soal_$quiz_id", $data);
				
			}
			
			return $data;
		}
	}else{
	$data=array();
	$data['master_soal']=$mysql->query_data("SELECT * FROM quiz_master WHERE id=$quiz_id");
	if($bahas_soal) {
	$data['soal_ganda']=$mysql->query_data("SELECT q.*,p.pembahasan FROM quiz_detail q LEFT JOIN quiz_pembahasan_pg p ON q.id=p.quiz_detail_id WHERE quiz_id=$quiz_id ORDER BY id, urutan","id");
	} else {
	$data['soal_ganda']=$mysql->query_data("SELECT * FROM quiz_detail WHERE quiz_id=$quiz_id ORDER BY urutan,id","id");	
	}
	$data['soal_complex']=$mysql->query_data("SELECT * FROM quiz_complex WHERE quiz_id=$quiz_id ORDER BY urutan,id","id");
	$data['soal_essay']=$mysql->query_data("SELECT * FROM quiz_essay WHERE quiz_id=$quiz_id ORDER BY urutan,id","id");
	
	return $data;
	/*
	include(path_to_soal_json($quiz_id));
	$r_json_soal=json_decode(trim($soal_json),true);	
	return $r_json_soal;
	*/ 
	}	
		
}
function kolom_excel($batas=1,$mulai="A"){
	//var_dump(kolom_excel(100,"AA"));
	$iterasi=1;
	$azRange = range('A', 'Z');
	$abjad=array();
	$start=false;
	foreach ($azRange as $letter)
	{
		if($mulai==$letter && !$start){
			$start=true;
		}
		if($iterasi>$batas){
			return $abjad;
		}
		if($start){
			$abjad[]=$letter;
			$iterasi++;
		}
		
		
	}
	
	
	foreach ($azRange as $letter)
	{
		$azRange1 = range('A', 'Z');
		foreach ($azRange1 as $letter1)
		{
			if($mulai=="$letter{$letter1}" && !$start){
				$start=true;
			}
			if($iterasi>$batas){
			return $abjad;
			}
			if($start){
				$abjad[]=$letter.$letter1;
				$iterasi++;
			}
			
		}
	}	
}
function scoring_essay($done_id) {
	global $mysql;


	$q_essay= $mysql->query(" SELECT id_quiz_essay,answer  FROM quiz_done_essay WHERE id_quiz_done=$done_id ");
	if($q_essay and $mysql->num_rows($q_essay)>0) {
		while($d_essay=$mysql->fetch_assoc($q_essay)) {
			$id_essay=$d_essay['id_quiz_essay'];
			$answer=$d_essay['answer'];
			$kunci_essay=$mysql->fetch_assoc($mysql->query("SELECT  quiz_id,answer1,answer2,answer3,answer4,answer5,point1,point2,point3,point4,point5 FROM quiz_essay WHERE id=".$id_essay));
			$list_kunci=array();
			$score=0;
			$score_persen=0;
			
			if($kunci_essay['answer1']!='' or $kunci_essay['answer2']!='' or $kunci_essay['answer3']!='' or $kunci_essay['answer4']!='' or $kunci_essay['answer5']!='')
			{
				
				$skor_maksimal=$q=$mysql->get1value("SELECT score_essay FROM quiz_master WHERE id=".$kunci_essay['quiz_id']);
				$jumlah_soal=$q=$mysql->get1value("SELECT count(id) FROM quiz_essay WHERE quiz_id=".$kunci_essay['quiz_id']);
				$bobot=$skor_maksimal/$jumlah_soal;
				$list_kunci=array(
				1=>strtolower($kunci_essay['answer1']),
				2=>strtolower($kunci_essay['answer2']),
				3=>strtolower($kunci_essay['answer3']),
				4=>strtolower($kunci_essay['answer4']),
				5=>strtolower($kunci_essay['answer5'])
				);	
				
				$find=array_search(strtolower($answer),$list_kunci);
				if($find>0) {
					$score=$bobot*($kunci_essay['point'.$find]/100);
					$score_persen=$kunci_essay['point'.$find];
				} 
				
				
				
				
			}
			
			$answer=addslashes($answer);
			$q=$mysql->query("
			INSERT INTO quiz_done_essay 
			SET 
				id_quiz_done='$done_id',
				id_quiz_essay='$id_essay',
				answer='$answer',
				score='$score',
				score_persen='$score_persen'
			ON DUPLICATE KEY UPDATE answer='$answer',score='$score', score_persen='$score_persen'	
			");
			
			
		}
	}

}
function scoring_ulang($join_id,$akhiri_ujian=1) {
	
	global $mysql;
	$_GET['akhiri_ujian']=$akhiri_ujian; //algoritma ini copy dari front/ajax jadi disesuaikan aja kondisinya biar gak terllau banyak ngoding
	$q=$mysql->query("SELECT id,quiz_id,acak,score_master,answer_temp,custom_score,poin_benar,poin_salah,poin_kosong,poin_A,poin_B,poin_C,poin_D,poin_E,poin_F,poin_G,poin_H,poin_I,poin_J FROM quiz_done WHERE id IN ($join_id) ");
		if($q and $mysql->numrows($q)>0)
		{
			
			ob_start();
			while($member_data=$mysql->assoc($q)) { //ini
			
			
		
			//if($_GET['akhiri_ujian']==1){
				
				$r_json_soal=get_soal_json($member_data['quiz_id']);
				$r_answer_temp=json_decode($member_data['answer_temp'],true);//ini
	
					
				$r_acak_id=explode(",",$member_data['acak']);
				
				$nomor=1;
				foreach($r_acak_id as $i =>  $id_acak){
					$post_soal[$id_acak]=$r_answer_temp[($i+1)];
					$nomor++;
				}
				
				
				if(count($r_json_soal['soal_ganda'])>0)
				{
					
					$benar=0;
					$salah=0;
					$tidak_jawab=0;
					$total_quiz=0;
					$r_jawaban=array();
					$no=0;
					$score_custom=array();
					/*custom_score = 3*/
					$bobot=array();
					$betul=array();
					/*custom_score = 3*/
					//while($d=$mysql->assoc($q))
					foreach($r_json_soal['soal_ganda'] as $d)
					{
						$no++;
						$total_quiz++;
						$jawaban=$post_soal[$d['id']];
						if($member_data['custom_score']==2){
							$r_jawaban[$no]=$jawaban;
							$score_custom[]=$member_data["poin_".$jawaban];
						} elseif($member_data['custom_score']==3) {
							$bobot[$d['urutan']]=$d['bobot'];
							$r_jawaban[$no]=$jawaban;
							if($jawaban!="" AND $jawaban==$d['answer'])
							{
								$benar++;
								$betul[$d['urutan']]=$d['bobot'];
							}
							elseif($jawaban!="" AND $jawaban!=$d['answer'])
							{
								$salah++;
							}
							else
							{
								$tidak_jawab++;
							}
						} else{
							
							$r_jawaban[$no]=$jawaban;
							if($jawaban!="" AND $jawaban==$d['answer'])
							{
								$benar++;
							}
							elseif($jawaban!="" AND $jawaban!=$d['answer'])
							{
								$salah++;
							}
							else
							{
								$tidak_jawab++;
							}
						}
						
					
					}
				}
			$answer=json_encode($r_jawaban);
			
			if ($member_data['custom_score']==1) {				
				$score=($benar*$member_data['poin_benar'])+($salah*$member_data['poin_salah'])+($tidak_jawab*$member_data['poin_kosong']);	
			} elseif($member_data['custom_score']==0){
				$bobot=$member_data['score_master']/$total_quiz;
				$score=round($benar*$bobot,2);	
			} elseif($member_data['custom_score']==2){
				$bobot=$member_data['score_master']/$total_quiz;
				foreach($score_custom as $persentase_poin) {
					$score += $bobot * ($persentase_poin/100);
				}
				//$score=array_sum($score_custom);
			} elseif($member_data['custom_score']==3) {
				$qkd=$mysql->query("SELECT id,score_max,kkm,nomor_soal,title_id FROM quiz_kd WHERE quiz_id='".$member_data['quiz_id']."' ");
				if($qkd and $mysql->numrows($qkd)>0) {
					
					while($dkd = $mysql->assoc($qkd)) {
						$r_nomor = explode(",",$dkd['nomor_soal']);
						$total_bobot=0;
						
						foreach($r_nomor as $nomor) {
							$total_bobot+=$bobot[$nomor];
						}
						$bobot_perpoint=$dkd['score_max']/$total_bobot;
						$t_skor=0;
						
						if(count($betul)>0) {
							foreach($r_nomor as $nomor) {
								if($betul[$nomor]!="") {
									$betul_bobot=$betul[$nomor];
									$t_skor+=$betul_bobot*$bobot_perpoint;
								}
							}
							
						}
						
						$score+=$t_skor;
						$score_kd_update=array();
						$score_kd_insert=array();
						$score_kd_insert[]=" id_quiz_done='".$member_data['id']."'";
						$score_kd_insert[]=" id_quiz_kd='".$dkd['id']."'";
						$score_kd_insert[]=" nama_kd='".$dkd['title_id']."'";
						$score_kd_insert[]=" score='".$t_skor."'";
						$score_kd_insert[]=" score_max='".$dkd['score_max']."'";
						$score_kd_update[]=" nama_kd='".$dkd['title_id']."'";
						$score_kd_update[]=" score='".$t_skor."'";
						$score_kd_update[]=" kkm='".$dkd['kkm']."'";
						
						$sql_kd = 'INSERT INTO quiz_done_kd SET '.join(",",$score_kd_insert).' ON DUPLICATE KEY UPDATE '.join(",",$score_kd_update);
						$insert_kd = $mysql->query($sql_kd);
						
						}
					}
				$score=round($score);
				
				//$score=array_sum($score_sbmptn);
			}
			
			//}
			
			$r_acak_id=explode(",",$member_data['acak']);
			$r_jawaban_temp=array();
			$nomor=1;
			foreach($r_acak_id as $id_acak){
			//$r_jawaban_temp[$nomor]=$_POST['soal_'.md5($id_acak)];
			$r_jawaban_temp[$nomor]=$_POST['soal_'.$id_acak];
			$nomor++;
			}
			$answer_temp=json_encode($r_jawaban_temp);
			$score_essay='NULL';
			$hari_ini=date("Y-m-d H:i:s");
			/*UPDATE NILAI*/
			if($_GET['akhiri_ujian']==1){
				
				$tambahan="
				,
				end_time='$hari_ini',
				check_point='$hari_ini',
				is_done=1 ";
			
			}
			
			scoring_essay($member_data['id']);
			$score_essay=$mysql->get1value("SELECT sum(score) FROM quiz_done_essay WHERE id_quiz_done=".$member_data['id']);
			
			$update=$mysql->query("
			UPDATE 
				quiz_done 
			SET 
				
				benar='$benar',
				salah='$salah',
				score='$score',
				score_essay='$score_essay'
				$tambahan
			WHERE 
				id='".$member_data['id']."'
			");
			$temp=ob_get_clean();	
			}
		}
}
function update_paksa_selesai($join_id){
	global $mysql;
	
	$_GET['akhiri_ujian']=1;
	
		$q=$mysql->query("SELECT id,quiz_id,acak,score_master,custom_score,poin_benar,poin_salah,poin_kosong,poin_A,poin_B,poin_C,poin_D,poin_E,poin_F,poin_G,poin_H,poin_I,poin_J  FROM quiz_done WHERE id IN ($join_id) ");
		if($q and $mysql->numrows($q)>0)
		{
			
			
			while($member_data=$mysql->assoc($q))
			{
				
			
			$r_json_soal=get_soal_json($member_data['quiz_id']);
			$r_answer_temp=json_decode($member_data['answer_temp'],true);
			
			
			$r_acak_id=explode(",",$member_data['acak']);
			
			$nomor=1;
			foreach($r_acak_id as $i =>  $id_acak){
				$post_soal[$id_acak]=$r_answer_temp[($i+1)];
				$nomor++;
			}
			
			
			/////////////////////////////////////
			if($_GET['akhiri_ujian']==1)
			{
				if(count($r_json_soal['soal_ganda'])>0)
				{
					$benar=0;
					$salah=0;
					$tidak_jawab=0;
					$total_quiz=0;
					$r_jawaban=array();
					$no=0;
					$score_sbmptn=array();
					//while($d=$mysql->assoc($q))
					foreach($r_json_soal['soal_ganda'] as $d)
					{
						$no++;
						$total_quiz++;
						$jawaban=$post_soal[$d['id']];
						if($member_data['custom_score']==2){
							$score_sbmptn[]=$member_data["poin_".$jawaban];
						}else{
							
							$r_jawaban[$no]=$jawaban;
							if($jawaban!="" AND $jawaban==$d['answer'])
							{
								$benar++;
							}
							elseif($jawaban!="" AND $jawaban!=$d['answer'])
							{
								$salah++;
							}
							else
							{
								$tidak_jawab++;
							}
						}
						
					
					}
				}
			$answer=json_encode($r_jawaban);
			
			if($member_data['custom_score']==1){				
				$score=($benar*$member_data['poin_benar'])+($salah*$member_data['poin_salah'])+($tidak_jawab*$member_data['poin_kosong']);	
			}elseif($member_data['custom_score']==0){
				$bobot=$member_data['score_master']/$total_quiz;
				$score=round($benar*$bobot,2);	
			}elseif($member_data['custom_score']==2){
				$score=array_sum($score_sbmptn);
			}
			
			}
			
			$r_acak_id=explode(",",$member_data['acak']);
			$r_jawaban_temp=array();
			$nomor=1;
			foreach($r_acak_id as $id_acak){
			$r_jawaban_temp[$nomor]=$_POST['soal_'.md5($id_acak)];
			$nomor++;
			}
			$answer_temp=json_encode($r_jawaban_temp);
			
			$hari_ini=date("Y-m-d H:i:s");
			/*UPDATE NILAI*/
			if($_GET['akhiri_ujian']==1){
				
				$tambahan="
				end_time='$hari_ini',
				is_done=1 ";
			}else{
				$tambahan="
				is_done=0 ";
			}
			/**/
			$update=$mysql->query("
			UPDATE 
				quiz_done 
			SET 
				
				benar='$benar',
				salah='$salah',
				answer='$answer',
				tidak_jawab='$tidak_jawab',
				score='$score',
				$tambahan
			WHERE 
				id='".$member_data['id']."'
			");
			
			
			
			
			}
	}

	
}	
///////////////////////////DOWNLOAD EXCEL
function patient_char($str)
{
$alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
$newName = '';
do {
    $str--;
    $limit = floor($str / 26);
    $reminder = $str % 26;
    $newName = $alpha[$reminder].$newName;
    $str=$limit;
} while ($str >0);
return $newName;
}
function generate_token_jadwal($i){
	$string=rand(1,9).str_pad($i,6,"0",STR_PAD_LEFT);
	$alphanumeric = patient_char($string);
	return strtoupper($alphanumeric);
}
function modul_asset_url($url="")
{
	global $config;
	
	$url=fronturl("/userfiles/backend/modul/$url");
	return $url;
}
// Function to calculate square of value - mean
function sd_square($x, $mean) { return pow($x - $mean,2); }

// Function to calculate standard deviation (uses sd_square)   
function sd($array) {
// square root of sum of squares devided by N-1
return sqrt(array_sum(array_map("sd_square", $array, array_fill(0,count($array), (array_sum($array) / count($array)) ) ) ) / (count($array)-1) );
}
///////////////////////////END DOWNLOAD EXCEL
function persentase_jawaban($schedule_id,$class)
{
global $mysql;
$member_salah=array();	
$data_member=array();
$final_salah=array();
$final_tidak_jawab=array();
$final_benar=array();
$kunci=array();


list($dschedule)=$mysql->query_data("SELECT * FROM quiz_schedule WHERE id=$schedule_id");

//AMBIL KUNCI JAWABAN	
	$qkey=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id=".$dschedule['quiz_id']);
	if($qkey and $mysql->numrows($qkey)>0){
		while($d=$mysql->assoc($qkey)){
			$kunci[$d['id']]=$d['answer'];
		}
	}
//END AMBIL KUNCI JAWABAN

$sql="SELECT * FROM quiz_done  WHERE is_done=1 AND schedule_id='".$schedule_id."' AND member_class='".cleanInput($class)."' ORDER BY score DESC";

$r=$mysql->query($sql);
if($r and $mysql->numrows($r)){
	$r_temp=array();
	$class_rank="";
	$correct=array();
	$member_terpilih=array();
	$score_individu=array();
	$jawab=array();
	$jumlah_peserta=$mysql->numrows($r);
	$peta_biner=array();
	
	while($d=$mysql->assoc($r)){
		
		$class_rank=($d['score']>=70)?"upper":(($d['score']<=30)?"lower":"middle");
		
		if($class_rank=="upper" OR $class_rank=="middle" OR $class_rank=="lower"){
			$member_terpilih[$d['member_id']]=$d['score'];
		}
			
		
		$temp_answer=json_decode($d['answer'],true);
		
		$r_answer=array();
		
		if(count($kunci)>0){	
			$index=0;
			foreach($kunci as $idsoal => $idsoal){
				$index+=1;
				$r_answer[$idsoal]=$temp_answer[$index];			
				$jawab[$index]["A"]+=$temp_answer[$index]=="A"?1:0;
				$jawab[$index]["B"]+=$temp_answer[$index]=="B"?1:0;
				$jawab[$index]["C"]+=$temp_answer[$index]=="C"?1:0;
				$jawab[$index]["D"]+=$temp_answer[$index]=="D"?1:0;
				$jawab[$index]["E"]+=$temp_answer[$index]=="E"?1:0;	
								
				$final_salah[$index]+=0;
				$final_benar[$index]+=0;
				$final_tidak_jawab[$index]+=0;
				
				//BANDINGKAN JAWABAN
				
				if($temp_answer[$index]!="" and $temp_answer[$index]==$kunci[$idsoal]){
					//BENAR
					$score_individu[$d['member_id']]+=1;
					$peta_biner[$index][]=$d['member_id'];
					$final_benar[$index]+=1;
					$correct[$class_rank][$index]+=1;
				}elseif($temp_answer[$index]!="" and $temp_answer[$index]!=$kunci[$idsoal]){
					//SALAH
					$final_salah[$index]+=1;
					$member_salah[$index][]=$d['member_id'];
					$score_individu[$d['member_id']]+=0;
				}else{
					//TAK JAWAB
					$final_salah[$index]+=1;
					$final_tidak_jawab[$index]+=1;
					$member_salah[$index][]=$d['member_id'];
					$score_individu[$d['member_id']]+=0;
				}
				//END BANDINGKAN JAWABAN
			}
				
		}
	}
	
}

$jumlah_member_terpilih=count($member_terpilih);
foreach($jawab as $i =>$data){
		$jawab_prope[$i]["A"]=round(($jawab[$i]["A"]/$jumlah_member_terpilih)*100,0);	
		$jawab_prope[$i]["B"]=round(($jawab[$i]["B"]/$jumlah_member_terpilih)*100,0);	
		$jawab_prope[$i]["C"]=round(($jawab[$i]["C"]/$jumlah_member_terpilih)*100,0);	
		$jawab_prope[$i]["D"]=round(($jawab[$i]["D"]/$jumlah_member_terpilih)*100,0);	
		$jawab_prope[$i]["E"]=round(($jawab[$i]["E"]/$jumlah_member_terpilih)*100,0);
		$jawab_prope[$i]["jawab_benar"]=$final_benar[$i];
		$jawab_prope[$i]["jawab_salah"]=$final_salah[$i]+$final_tidak_jawab[$i];
		$out=round((($jumlah_member_terpilih-($jawab[$i]["A"]+$jawab[$i]["B"]+$jawab[$i]["C"]+$jawab[$i]["D"]+$jawab[$i]["E"]))/$jumlah_member_terpilih)*100,0);	
}

//var_dump(count($member_terpilih));
return $jawab_prope;
} 
function persentase_jawaban_complex($schedule_id,$class)
{
global $mysql;
$member_salah=array();	
$data_member=array();
$final_salah=array();
$final_tidak_jawab=array();
$final_benar=array();
$kunci=array();


list($dschedule)=$mysql->query_data("SELECT * FROM quiz_schedule WHERE id=$schedule_id");

//AMBIL KUNCI JAWABAN	
	$qkey=$mysql->query("SELECT id,answer FROM quiz_complex WHERE quiz_id=".$dschedule['quiz_id']);
	if($qkey and $mysql->numrows($qkey)>0){
		while($d=$mysql->assoc($qkey)){
			$kunci[$d['id']]=$d['answer'];
		}
	}
	
//END AMBIL KUNCI JAWABAN

$sql="SELECT d.id,d.score,c.answer FROM quiz_done d LEFT JOIN quiz_done_complex c ON d.id=c.id_quiz_done  WHERE d.is_done=1 AND d.schedule_id='".$schedule_id."' AND d.member_class='".cleanInput($class)."' ORDER BY d.score DESC";

$r=$mysql->query($sql);
if($r and $mysql->numrows($r)){
	$r_temp=array();
	$class_rank="";
	$correct=array();
	$member_terpilih=array();
	$score_individu=array();
	$jawab=array();
	$jumlah_peserta=$mysql->numrows($r);
	$peta_biner=array();
	
	while($d=$mysql->assoc($r)){
		
		$class_rank=($d['score']>=70)?"upper":(($d['score']<=30)?"lower":"middle");
		
		if($class_rank=="upper" OR $class_rank=="middle" OR $class_rank=="lower"){
			$member_terpilih[$d['member_id']]=$d['score'];
		}
			
		
		$temp_answer=json_decode($d['answer'],true);
		
		$r_answer=array();
	
		if(count($kunci)>0){	
			$index=0;
			foreach($kunci as $idsoal => $kunci_abjad){
				$index+=1;
				
				$r_answer[$idsoal]=$temp_answer[$idsoal];		
				/*	
				$jawab[$index]["A"]+=$temp_answer[$idsoal]=="A"?1:0;
				$jawab[$index]["B"]+=$temp_answer[$idsoal]=="B"?1:0;
				$jawab[$index]["C"]+=$temp_answer[$idsoal]=="C"?1:0;
				$jawab[$index]["D"]+=$temp_answer[$idsoal]=="D"?1:0;
				$jawab[$index]["E"]+=$temp_answer[$idsoal]=="E"?1:0;	
				*/
				$jawab[$index][$kunci_abjad]+=$temp_answer[$idsoal]=="$kunci_abjad"?1:0;	
			
				$final_salah[$index]+=0;
				$final_benar[$index]+=0;
				$final_tidak_jawab[$index]+=0;
				
				//BANDINGKAN JAWABAN
				
				if($temp_answer[$idsoal]!="" and $temp_answer[$idsoal]==$kunci[$idsoal]){
					//BENAR
					$score_individu[$d['member_id']]+=1;
					$peta_biner[$index][]=$d['member_id'];
					$final_benar[$index]+=1;
					$correct[$class_rank][$index]+=1;
					
				}elseif($temp_answer[$idsoal]!="" and $temp_answer[$idsoal]!=$kunci[$idsoal]){
					//SALAH
					$final_salah[$index]+=1;
					$member_salah[$index][]=$d['member_id'];
					$score_individu[$d['member_id']]+=0;
				}else{
					//TAK JAWAB
					$final_salah[$index]+=1;
					$final_tidak_jawab[$index]+=1;
					$member_salah[$index][]=$d['member_id'];
					$score_individu[$d['member_id']]+=0;
				}
				//END BANDINGKAN JAWABAN
			}
				
		}
	}
	
}

$jumlah_member_terpilih=count($member_terpilih);
foreach($jawab as $i =>$data){
		foreach ($data as $kunci => $jumlah) {
			$jawab_prope[$i][$kunci]=round(($jawab[$i][$kunci]/$jumlah_member_terpilih)*100,0);	
			/*
			$jawab_prope[$i]["B"]=round(($jawab[$i]["B"]/$jumlah_member_terpilih)*100,0);	
			$jawab_prope[$i]["C"]=round(($jawab[$i]["C"]/$jumlah_member_terpilih)*100,0);	
			$jawab_prope[$i]["D"]=round(($jawab[$i]["D"]/$jumlah_member_terpilih)*100,0);	
			$jawab_prope[$i]["E"]=round(($jawab[$i]["E"]/$jumlah_member_terpilih)*100,0);
			*/
			
			
			$jawab_prope[$i]["jawab_benar"]=$final_benar[$i];
			$jawab_prope[$i]["jawab_salah"]=$final_salah[$i]+$final_tidak_jawab[$i];
			$out=round((($jumlah_member_terpilih-($jawab[$i][$kunci]))/$jumlah_member_terpilih)*100,0);	
		}
}


//var_dump(count($member_terpilih));
return $jawab_prope;
} 

if( !function_exists('apache_request_headers') ) {
function apache_request_headers() {
  $arh = array();
  $rx_http = '/\AHTTP_/';
  foreach($_SERVER as $key => $val) {
    if( preg_match($rx_http, $key) ) {
      $arh_key = preg_replace($rx_http, '', $key);
      $rx_matches = array();
      // do some nasty string manipulations to restore the original letter case
      // this should work in most cases
      $rx_matches = explode('_', $arh_key);
      if( count($rx_matches) > 0 and strlen($arh_key) > 2 ) {
        foreach($rx_matches as $ak_key => $ak_val) $rx_matches[$ak_key] = ucfirst($ak_val);
        $arh_key = implode('-', $rx_matches);
      }
      $arh[$arh_key] = $val;
    }
  }
  return( $arh );
}
}



function persentase_jawaban_app()
{
global $mysql;
$member_salah=array();	
$data_member=array();
$final_salah=array();
$final_tidak_jawab=array();
$final_benar=array();
$kunci=array();



//AMBIL KUNCI JAWABAN	
	$qkey=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id=".$_GET['quiz_id']);
	if($qkey and $mysql->numrows($qkey)>0){
		while($d=$mysql->assoc($qkey)){
			$kunci[$d['id']]=$d['answer'];
		}
	}
//END AMBIL KUNCI JAWABAN

$sql="SELECT * FROM app_quiz_done  WHERE is_done=1 AND quiz_id='".$_GET['quiz_id']."' AND   date_format(start_time,'%Y-%m-%d') BETWEEN '".$_GET['date1']."' AND '".$_GET['date2']."' ORDER BY score DESC";

$r=$mysql->query($sql);
if($r and $mysql->numrows($r)){
	$r_temp=array();
	$class_rank="";
	$correct=array();
	$member_terpilih=array();
	$score_individu=array();
	$jawab=array();
	$jumlah_peserta=$mysql->numrows($r);
	$peta_biner=array();
	
	while($d=$mysql->assoc($r)){
		
		$class_rank=($d['score']>=70)?"upper":(($d['score']<=30)?"lower":"middle");
		
		if($class_rank=="upper" OR $class_rank=="middle" OR $class_rank=="lower"){
			$member_terpilih[$d['member_id']]=$d['score'];
		}
			
		
		$temp_answer=json_decode($d['answer'],true);
		
		$r_answer=array();
		
		if(count($kunci)>0){	
			$index=0;
			foreach($kunci as $idsoal => $idsoal){
				$index+=1;
				$r_answer[$idsoal]=$temp_answer[$index];			
				$jawab[$index]["A"]+=$temp_answer[$index]=="A"?1:0;
				$jawab[$index]["B"]+=$temp_answer[$index]=="B"?1:0;
				$jawab[$index]["C"]+=$temp_answer[$index]=="C"?1:0;
				$jawab[$index]["D"]+=$temp_answer[$index]=="D"?1:0;
				$jawab[$index]["E"]+=$temp_answer[$index]=="E"?1:0;	
								
				$final_salah[$index]+=0;
				$final_benar[$index]+=0;
				$final_tidak_jawab[$index]+=0;
				
				//BANDINGKAN JAWABAN
				
				if($temp_answer[$index]!="" and $temp_answer[$index]==$kunci[$idsoal]){
					//BENAR
					$score_individu[$d['member_id']]+=1;
					$peta_biner[$index][]=$d['member_id'];
					$final_benar[$index]+=1;
					$correct[$class_rank][$index]+=1;
				}elseif($temp_answer[$index]!="" and $temp_answer[$index]!=$kunci[$idsoal]){
					//SALAH
					$final_salah[$index]+=1;
					$member_salah[$index][]=$d['member_id'];
					$score_individu[$d['member_id']]+=0;
				}else{
					//TAK JAWAB
					$final_salah[$index]+=1;
					$final_tidak_jawab[$index]+=1;
					$member_salah[$index][]=$d['member_id'];
					$score_individu[$d['member_id']]+=0;
				}
				//END BANDINGKAN JAWABAN
			}
				
		}
	}
	
}

$jumlah_member_terpilih=count($member_terpilih);
foreach($jawab as $i =>$data){
		$jawab_prope[$i]["A"]=round(($jawab[$i]["A"]/$jumlah_member_terpilih)*100,0);	
		$jawab_prope[$i]["B"]=round(($jawab[$i]["B"]/$jumlah_member_terpilih)*100,0);	
		$jawab_prope[$i]["C"]=round(($jawab[$i]["C"]/$jumlah_member_terpilih)*100,0);	
		$jawab_prope[$i]["D"]=round(($jawab[$i]["D"]/$jumlah_member_terpilih)*100,0);	
		$jawab_prope[$i]["E"]=round(($jawab[$i]["E"]/$jumlah_member_terpilih)*100,0);
		$jawab_prope[$i]["jawab_benar"]=$final_benar[$i];
		$jawab_prope[$i]["jawab_salah"]=$final_salah[$i]+$final_tidak_jawab[$i];
		$out=round((($jumlah_member_terpilih-($jawab[$i]["A"]+$jawab[$i]["B"]+$jawab[$i]["C"]+$jawab[$i]["D"]+$jawab[$i]["E"]))/$jumlah_member_terpilih)*100,0);	
}

//var_dump(count($member_terpilih));
return $jawab_prope;
} 

function persentase_jawaban_app_complex()
{
global $mysql;
$member_salah=array();	
$data_member=array();
$final_salah=array();
$final_tidak_jawab=array();
$final_benar=array();
$kunci=array();


//AMBIL KUNCI JAWABAN	
	$qkey=$mysql->query("SELECT id,answer FROM quiz_complex WHERE quiz_id=".$_GET['quiz_id']);
	if($qkey and $mysql->numrows($qkey)>0){
		while($d=$mysql->assoc($qkey)){
			$kunci[$d['id']]=$d['answer'];
		}
	}
	
//END AMBIL KUNCI JAWABAN

$sql="SELECT d.id,d.score,c.answer FROM quiz_done d LEFT JOIN quiz_done_complex c ON d.id=c.id_quiz_done  WHERE d.is_done=1 AND date_format(d.start_time,'%Y-%m-%d') BETWEEN '".$_GET['date1']."' AND '".$_GET['date2']."'  ORDER BY d.score DESC";

$r=$mysql->query($sql);
if($r and $mysql->numrows($r)){
	$r_temp=array();
	$class_rank="";
	$correct=array();
	$member_terpilih=array();
	$score_individu=array();
	$jawab=array();
	$jumlah_peserta=$mysql->numrows($r);
	$peta_biner=array();
	
	while($d=$mysql->assoc($r)){
		
		$class_rank=($d['score']>=70)?"upper":(($d['score']<=30)?"lower":"middle");
		
		if($class_rank=="upper" OR $class_rank=="middle" OR $class_rank=="lower"){
			$member_terpilih[$d['member_id']]=$d['score'];
		}
			
		
		$temp_answer=json_decode($d['answer'],true);
		
		$r_answer=array();
	
		if(count($kunci)>0){	
			$index=0;
			foreach($kunci as $idsoal => $kunci_abjad){
				$index+=1;
				
				$r_answer[$idsoal]=$temp_answer[$idsoal];		
				/*	
				$jawab[$index]["A"]+=$temp_answer[$idsoal]=="A"?1:0;
				$jawab[$index]["B"]+=$temp_answer[$idsoal]=="B"?1:0;
				$jawab[$index]["C"]+=$temp_answer[$idsoal]=="C"?1:0;
				$jawab[$index]["D"]+=$temp_answer[$idsoal]=="D"?1:0;
				$jawab[$index]["E"]+=$temp_answer[$idsoal]=="E"?1:0;	
				*/
				$jawab[$index][$kunci_abjad]+=$temp_answer[$idsoal]=="$kunci_abjad"?1:0;	
			
				$final_salah[$index]+=0;
				$final_benar[$index]+=0;
				$final_tidak_jawab[$index]+=0;
				
				//BANDINGKAN JAWABAN
				
				if($temp_answer[$idsoal]!="" and $temp_answer[$idsoal]==$kunci[$idsoal]){
					//BENAR
					$score_individu[$d['member_id']]+=1;
					$peta_biner[$index][]=$d['member_id'];
					$final_benar[$index]+=1;
					$correct[$class_rank][$index]+=1;
					
				}elseif($temp_answer[$idsoal]!="" and $temp_answer[$idsoal]!=$kunci[$idsoal]){
					//SALAH
					$final_salah[$index]+=1;
					$member_salah[$index][]=$d['member_id'];
					$score_individu[$d['member_id']]+=0;
				}else{
					//TAK JAWAB
					$final_salah[$index]+=1;
					$final_tidak_jawab[$index]+=1;
					$member_salah[$index][]=$d['member_id'];
					$score_individu[$d['member_id']]+=0;
				}
				//END BANDINGKAN JAWABAN
			}
				
		}
	}
	
}

$jumlah_member_terpilih=count($member_terpilih);
foreach($jawab as $i =>$data){
		foreach ($data as $kunci => $jumlah) {
			$jawab_prope[$i][$kunci]=round(($jawab[$i][$kunci]/$jumlah_member_terpilih)*100,0);	
			/*
			$jawab_prope[$i]["B"]=round(($jawab[$i]["B"]/$jumlah_member_terpilih)*100,0);	
			$jawab_prope[$i]["C"]=round(($jawab[$i]["C"]/$jumlah_member_terpilih)*100,0);	
			$jawab_prope[$i]["D"]=round(($jawab[$i]["D"]/$jumlah_member_terpilih)*100,0);	
			$jawab_prope[$i]["E"]=round(($jawab[$i]["E"]/$jumlah_member_terpilih)*100,0);
			*/
			
			
			$jawab_prope[$i]["jawab_benar"]=$final_benar[$i];
			$jawab_prope[$i]["jawab_salah"]=$final_salah[$i]+$final_tidak_jawab[$i];
			$out=round((($jumlah_member_terpilih-($jawab[$i][$kunci]))/$jumlah_member_terpilih)*100,0);	
		}
}


//var_dump(count($member_terpilih));
return $jawab_prope;
} 

//////////redis
function sweetalert2($type="success",$msg="",$redirect="") {
	
	$timer=1000000;
	$confirm='false';
	if($type=="warning") {
		$timer=50000000;
		$confirm='true';
	}
	$temp="

	Swal.fire({
	  position: 'top',
	  type: '$type',
	  title: '$msg',
	  showConfirmButton: $confirm,
	  timer: $timer
	});
";

	
	$_SESSION['msg_toast'].=$temp;
	if($redirect!="")
	{
		header("location:".$redirect);
		exit();
	}
}
function generateQRCode($nb,$name=""){
	
	$nb=cleanInput($nb);

	if($name=="") $name=$nb;
	
	$content=$nb;
	
	if(!file_exists(filepath("qrcode"))) {
		mkdir(filepath("qrcode"),"775");
	}
	
	$pngAbsoluteFilePath = filepath("qrcode/$name.png");
	$urlRelativeFilePath = fileurl("qrcode/$name.png");
	if(!file_exists($pngAbsoluteFilePath)){
		b_load_lib("Qrcode/qrlib");
		QRcode::png($content,$pngAbsoluteFilePath,'L', 10, 0);
	};
	return $urlRelativeFilePath; 
	/*
	b_load_lib("Qrcode/qrlib");
	QRcode::png($content);
	*/
	
}
function sort_pg($quiz_id) {
	global $mysql;
	$kondisi_paket='';
	if($_SESSION['paket']!='') {
			$kondisi_paket=" AND type='".$_SESSION['paket']."' ";
	}
	$q=$mysql->query("SELECT id FROM quiz_detail WHERE quiz_id=$quiz_id $kondisi_paket ORDER BY id ");
	if($quiz_id!='' AND $q AND $mysql->num_rows($q)>0) {
	$mysql->autocommit(false);	
		$urutan=1;
		while($d = $mysql->fetch_assoc($q)) {
			$update=$mysql->query("UPDATE quiz_detail SET urutan=$urutan WHERE id=".$d['id']);
			$urutan++;
		}
	$mysql->commit();
	$mysql->autocommit(true);
	}

}

function sort_essay($quiz_id) {
	global $mysql;
	$kondisi_paket='';
	if($_SESSION['paket']!='') {
			$kondisi_paket=" AND type='".$_SESSION['paket']."' ";
	}
	$q=$mysql->query("SELECT id FROM quiz_essay WHERE quiz_id=$quiz_id $kondisi_paket ORDER BY id");
	if($quiz_id!='' AND $q AND $mysql->num_rows($q)>0) {
	$mysql->autocommit(false);	
		$urutan=1;
		while($d = $mysql->fetch_assoc($q)) {
			$update=$mysql->query("UPDATE quiz_essay SET urutan=$urutan WHERE id=".$d['id']);
			$urutan++;
		}
	$mysql->commit();
	$mysql->autocommit(true);
	}
}
function cleanK($string) {
	return str_replace("_K",'',$string);
}
function base64_to_jpeg($base64_string, $output_file) {
    // open the output file for writing
    $ifp = fopen( $output_file, 'wb' ); 

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode( ',', $base64_string );

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

    // clean up the file resource
    fclose( $ifp ); 

    return $output_file; 
}

function fiestophpmailer($to, $subject, $txtmsg, $from, $namafrom = '', $replyto = '', $htmlmsg = '', $attachments = '') {
    global  $mail_host,$mail_port,$mail_smtp_auth,$mail_username,$mail_password,$mail_smtp_secure,$mail_smptp_debug;
        
		b_load_lib("class.phpmailer");
		b_load_lib("class.smtp");
	
        $mail = new PHPMailer();
        $mail->Host = $mail_host;
        $mail->Port = $mail_port;
        $mail->Username = $mail_username;
        $mail->Password = $mail_password;
        $mail->WordWrap = 50;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Subject = $subject;
        $mail->From = $mail_username;
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html'; 
        
       
        if ($htmlmsg == '') {
            $mail->IsHTML(false);
            $mail->Body = $txtmsg;
        } else {
            $mail->IsHTML(true);
            $mail->Body = $htmlmsg;
            $mail->AltBody = $txtmsg;
        }

        $mail->FromName = $mail_username;
        $mail->AddReplyTo($mail_username);
        $mail->SMTPSecure = $mail_smtp_secure;
        
        
        if ($attachments != '') {
            $r_attachments = explode(',', $attachments);
            foreach ($r_attachments as $attachment) {
                $attachment = trim($attachment);
                $mail->AddAttachment($attachment);
            }
        }
        $r_kepada = explode(',', $to);
        foreach ($r_kepada as $kepada) {
			$kepada = trim($kepada);
			$mail->ClearAddresses();
		
			$mail->AddAddress($kepada);
				if ($mail->Send())
        		{
        		
        			return true;
        		}
        		else
        		{
        			return false;
        		}
		}
      
        return true;

}
function link_to_profile($id,$text="",$attr="") {
    return '<a href="'.backendurl("app_profile/view/".md5(md5($id))).'" '.$attr.'>'.$text.'</a>';
}
function link_to_result($id,$text="",$attr="") {
    return '<a href="'.backendurl("app_result/view/".md5($id)).'" '.$attr.'>'.$text.'</a>';
}
function each(&$array) {
    if (!is_array($array)) {
        trigger_error("each() expects parameter 1 to be an array", E_USER_WARNING);
        return false;
    }

    $key = key($array); // Get the current key
    if ($key === null) {
        return false; // No more elements in the array
    }

    $value = current($array); // Get the current value
    next($array); // Advance the internal pointer

    return ['key' => $key, 'value' => $value, 0 => $key, 1 => $value];
}

?>
