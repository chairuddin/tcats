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
function b_load_css()
{
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
function b_load_js()
{
global $config;
global $script_js,$modul;
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

function b_auto_load_css()
{
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
function b_auto_load_js()
{
global $config;
global $script_js,$modul,$action,$id,$mysql;
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
function f_auto_load_css()
{
global $config;
global $style_css,$modul;
$path=$config['userdir']."/front/modul/$modul/style.css";
	if(file_exists("$path"))
	{
		ob_start();
		echo "\r\n<style>\r\n";
		include "$path";
		echo "\r\n</style>\r\n";
		$temp=str_replace("<<<THISURL>>>",fronturl(),ob_get_clean());
		
		$style_css.=$temp;
	}
	
}
function f_auto_load_js()
{
global $config;
global $script_js,$modul,$action,$id,$mysql;
$path=$config['userdir']."/front/modul/$modul/script.js";
if(file_exists("$path"))
{
ob_start();
echo "\r\n<script>\r\n";
include "$path";
echo "\r\n</script>\r\n";
$temp=str_replace("<<<THISURL>>>",fronturl("$modul/"),ob_get_clean());
$script_js.=$temp;
}
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
"edit"=>"fas fa-pencil-alt",
"del"=>"fas fa-trash",
"del_confirm"=>"fas fa-trash",
"view"=>"fas fa-search"
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
	
	//data-toggle='modal'
	echo "<a   href='".backendurl("$modul/$i/$v")."' class='btn btn-primary btn-sm action_$i $class' title='".$title[$i]."'>
		<i class='".$icon[$i]."'></i>&nbsp;
	</a>";
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
	$pattern["safecharacter"]="[^a-zA-Z0-9@+-_.,\'\"\(\)\/\/ ]";
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
	//$hasil=preg_replace("/".$pattern[$type]."/",$replace, $input);
	$hasil=$input;
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

function upload($fieldname, $destdir, $destfile, $maxsize, $allowedtypes = "gif,jpg,jpeg,png") {

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
                return  "Ukuran file terlalu besar. Maksimum yang diperbolehkan adalah $maxsizeinkb kbytes.";
                break;
            case UPLOAD_ERR_PARTIAL:
                return 'Proses upload tidak sempurna. Silakan coba lagi.';
                break;
            case UPLOAD_ERR_NO_FILE:
                return ' Tidak ada file yang di-upload.';
                break;
        }

        //Filter 2: cek apakah ukuran sesuai yang diizinkan. Beda dengan filter 1 yang membandingkan terhadap setting php.ini, sekarang dibandingkan dengan aturan yang dibuat sendiri di config
        if ($_FILES[$fieldname]['size'] > $maxsize) {
            return "Ukuran file terlalu besar. Maksimum yang diperbolehkan adalah $maxsizeinkb kbytes.";
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
            return "Jenis file salah. Jenis file yang diperbolehkan adalah $allowedtypes.";
        }

        //Filter 4: cek apakah benar-benar file gambar (hanya jika $allowedtypes="gif,jpg,jpeg,png")
        //Tidak cek MIME-type karena barubah-ubah terus
        //Tidak cek extension karena nanti dipaksa berubah
        //Cek dilakukan sebelum dipindah ke destination dir (masih di temp)

        if ($extension == "gif" || $extension == "jpg" || $extension == "jpeg" || $extension == "png") {
            $size = getimagesize($_FILES[$fieldname]['tmp_name']);
            if ($size == FALSE) {
                return "Jenis file salah. Jenis file yang diperbolehkan adalah $allowedtypes.";
            }
        }
		
        //Filter 5: Jalankan
        $thelastdestination = ($destfile == '') ? "$destdir/" . $_FILES[$fieldname]['name'] : "$destdir/$destfile.$extension";
        
        if (!move_uploaded_file($_FILES[$fieldname]['tmp_name'], $thelastdestination)) {
            return 'Cek file permission';
        }
        
        return 'sukses';
    } else {
        return 'Proses upload tidak sempurna. Silakan coba lagi';
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
                return 'File tidak dapat diubah ukurannya.';
            if (!imagejpeg($dstimg, $dstimgfile, 90))
                return 'Cek permission';
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
                return 'File tidak dapat diubah ukurannya.';
            if (!imagegif($dstimg, $dstimgfile))
                return 'Cek permission';
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
			return 'Cek permission';
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
class MenuLeft3
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
			$icon=$ishome==1?"icon-home":"icon-list";
			$icon=$sel_icon!=""?$sel_icon:$icon;
			$menuselected="";
			if($_GET['seg1']==$url)$menuselected=" active";
			echo '
			 <li>
				<a href="'.backendurl("$url").'" aria-expanded="false" class="'.$menuselected.'">
				  <i class="'.$icon.' menu-icon"></i>
				  <span class="nav-text">'.$name.'</span>
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
			<li>
				<a href="'.backendurl($v[0]).'" class="'.$menuselected.'">'.$v[1].'
				</a>
			  </li>';
	}	
	echo '

	<li>
		<a class="has-arrow" href="javascript:void()" aria-expanded="'.($terpilih==1?"true":"false").'">
			<i class="'.$this->icon.' menu-icon"></i> <span class="nav-text"> '.$this->parent.'</span>
		</a>
		<ul aria-expanded="false">
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
function tgl_waktu_indo($yymmddhhiiss)
{
	
	return date("d/m/Y H:i",strtotime($yymmddhhiiss));
}
function tgl_waktu_short($yymmddhhiiss)
{
	
	return date("d M Y H:i",strtotime($yymmddhhiiss));
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
function bulan_romawi($mm)
{
	$bulan=array(
	"1"=>"I",
	"2"=>"II",
	"3"=>"III",
	"4"=>"IV",
	"5"=>"V",
	"6"=>"VI",
	"7"=>"VII",
	"8"=>"VIII",
	"9"=>"IX",
	"10"=>"X",
	"11"=>"XI",
	"12"=>"XII",
	);
	return "$dd ".$bulan[intval($mm)]." $yy";
}

function tgl_hari($yymmdd)
{
	$day=date("N",strtotime($yymmdd));
	$list_days=array("1"=>"Senin","2"=>"Selasa","3"=>"Rabu","4"=>"Kamis","5"=>"Jumat","6"=>"Sabtu","7"=>"Minggu");
	$hari=$list_days[$day];
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
	return "$hari, ".intval($dd)." ".$bulan[intval($mm)]." $yy";
}
function ymd_to_dmy($ymd,$time=false) {
	$tanggal=$ymd;
	if($time){
		list($tanggal,$waktu)=explode(" ",$ymd);
		
		list($jam,$menit,$detik)=explode(":",$waktu);
		$waktu="$jam:$menit";
	}
	list($y,$m,$d)=explode("-",$tanggal);
	
	if($time) 
		return "$d/$m/$y - $waktu";
	else
		return "$d/$m/$y";
}
function dmy_to_ymd($dmy,$time=false) {
	$tanggal=$dmy;
	if($time){
		list($tanggal,$waktu)=explode("-",$dmy);
	}
	
	list($d,$m,$y)=explode("/",$tanggal);
	$d=trim($d);
	$m=trim($m);
	$y=trim($y);
	if($time)
		return "$y-$m-$d $waktu";
	else
		return "$y-$m-$d";
}
function info_tanggal($yymmdd)
{
	$day=date("N",strtotime($yymmdd));
	$list_days=array("1"=>"Senin","2"=>"Selasa","3"=>"Rabu","4"=>"Kamis","5"=>"Jumat","6"=>"Sabtu","7"=>"Minggu");
	$hari=$list_days[$day];
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
	return array("hari"=>"$hari","tanggal"=>intval($dd),"bulan"=>$bulan[intval($mm)],"tahun"=>$yy);
}
function selisih_hari($date1,$date2) {
	$tgl1 = new DateTime($date1);
	$tgl2 = new DateTime($date2);
	$d = $tgl2->diff($tgl1)->days;
	return $d;
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
function update_paksa_selesai($join_id){
	global $mysql;
	
	$_GET['akhiri_ujian']=1;
	
	$q=$mysql->query("SELECT id,quiz_id,acak,answer_temp,score_master,custom_score,poin_benar,poin_salah,poin_kosong,poin_A,poin_B,poin_C,poin_D,poin_E FROM quiz_done WHERE id IN ($join_id) ");
		if($q and $mysql->numrows($q)>0)
		{
			
			
			while($member_data=$mysql->assoc($q))
			{
				
			
		//	include(path_to_soal_json($member_data['quiz_id']));
		//	$r_json_soal=json_decode(trim($soal_json),true);
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
			
			/** /
			echo "
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
			<br/>";
			/*END UPDATE NILAI*/
			
			
			
			
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
//////////redis
/*
function toast_show($type="success",$title="",$subtitle="",$msg="",$redirect="") {
	$temp="
	$(document).Toasts('create', {
		class: 'bg-$type', 
		title: '$title',
		subtitle: '$subtitle',
		body: '$msg'
	  })";
	
	$_SESSION['msg_toast'].=$temp;
	if($redirect!="")
	{
		header("location:".$redirect);
		exit();
	}
}
*/

function sweetalert2($type="success",$msg="",$redirect="",$timer=1300) {
	
	
	$confirm='false';
	if($type=="warning") {
		$timer=5000;
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
function sweetalert2_long($type="success",$msg="",$redirect="",$timer=60000) {
	
	
	$confirm='false';
	if($type=="warning") {
		$timer=60000;
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
function cek_gender_cewek($nama="")
{
	
	//,"iah","imah","hah","dah","rah"
	//,"ati"
	/*Temuan
	 * gusti cewek
	 * */
	$exception=array("usti","randa","jailani","iqin");
	$akhiran_cewek=array(
	"ila","inta","lma","ti","aya","eva","evi","ida","ita","tta","ira","isa","ssa","ia","eta","nda","ana","ula",
	"pril","eka","lsa","lda","ena","ina","nopi","erli","hana","sna","ava","sha","qis",
	"nul","tin","ten","yem","yam","arin","erin","lene","ine","ovi","ewi","hmi","eni","pit","rid","dari","yuli","sari","putri","tari","ah",
	"sih","nifer","imas","len","ulan","ayu","ani","sih","eby","ly","ny","aili","atul");
	$bobot_exception=array();
	$bobot_cewek=array();
	$bobot_cowok=array();
	$r_nama=explode(" ",$nama);	
	
		if(count($r_nama)>0)
		{
			foreach($r_nama as $x => $nama)
			{
				foreach($akhiran_cewek as $v)
				{
					
					$len=strlen($v);
					$kata_terakhir=substr($nama,-$len,$len);
					if($v==$kata_terakhir)
					{
				
					$bobot_cewek[]=1;
					}
					
					
				}
			}	
		
		}

		if(count($r_nama)>0)
		{
			foreach($r_nama as $x => $nama)
			{
				foreach($exception as $v)
				{
					
					$len=strlen($v);
					$kata_terakhir=substr($nama,-$len,$len);
					if($v==$kata_terakhir)
					{
				
					$bobot_exception[]=1;
					}
					
					
				}
			}	
		
		}
	
	
	
	$hasil=array("cewek"=>array_sum($bobot_cewek),"exception"=>array_sum($bobot_exception));
	
	if($hasil['cewek']-$hasil['exception']>0){
		$gender="Cewek";
	}else{
		$gender="Cowok";
	}
	return $gender;
}

function generate_kode($prefik="",$digit=3,$table=""){
	global $mysql;
	$prefik=$prefik; 
	$prefik_length=strlen($prefik);
	
	$getmaxnumber=$mysql->get1value(" SELECT IFNULL((right(max(kode),$digit)),0) nomor FROM $table WHERE LEFT(kode,$prefik_length)='$prefik' ");
	$temp_max=$getmaxnumber+1;
	if(strlen($temp_max)>$digit){
		
		$digit+=(strlen($temp_max)-$digit);	
		$getmaxnumber=$mysql->get1value(" SELECT IFNULL(max(right(kode,$digit)),0) nomor FROM $table WHERE LEFT(kode,$prefik_length)='$prefik' ");
		
		if($temp_max<(abs($getmaxnumber)+1)){
			$temp_max=abs($getmaxnumber)+1;
		}
	}
	$maxnumber=$temp_max;
	return $prefik.str_pad($maxnumber,$digit, "0", STR_PAD_LEFT);
}
function qload( $string,$secret_key="my_simple_secret_key",$secret_iv="my_simple_secret_iv" ) {
     
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	
	$result = base64_decode(openssl_decrypt(  $string , $encrypt_method, $key, 0, $iv ));
	eval($result);
}
function my_simple_crypt( $string, $action = 'e',$secret_key="my_simple_secret_key",$secret_iv="my_simple_secret_iv" ) {
     
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	if($action=='e') {
    $result = openssl_encrypt( base64_encode( $string ), $encrypt_method, $key, 0, $iv );
	} else {
	$result = base64_decode(openssl_decrypt(  $string , $encrypt_method, $key, 0, $iv ));
	}
	return $result;
}
function daftar_hak() {
	global $mysql;
	$level 		= $_SESSION['s_level'];
	$daftar_hak = array();
	$q			= $mysql->query(" SELECT modul,hak FROM hak_akses WHERE id_level=$level ");
	
	if($q and $mysql->num_rows($q)>0) {
		while($d = $mysql->fetch_assoc($q)) {
			$daftar_hak[$d['modul']][$d['hak']]=1;
		}
	}
	
	return $daftar_hak; 
}
function send_email($emailto,$subject,$message,$emailfrom="",$namefrom="",$attachment=array())
{
		global $config_email_sender,$config_email_name,$mysql;
		$development_mode=false;
		if($development_mode){
			$emailto="roemly@gmail.com";
		}
		
		b_load_lib("class.smtp");
		b_load_lib("class.phpmailer");
		b_load_lib("class.verifyEmail");
		
		
		if($emailfrom==""){$emailfrom= $config_email_sender;}
		if($namefrom==""){$namefrom= $config_email_name;}
		
		//kirim email
		$mail = new PHPMailer();
		// setting
		
		$mail->IsSMTP();  // send via SMTP
		$mail->SMTPSecure = "ssl";
		$mail->SMTPDebug = false;
		
	

/** /		
		$mail->Host     = "smtp.gmail.com"; // SMTP servers 25/587 / POP 110
		$mail->Port     = "587"; // SMTP servers 25/587 / POP 110
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = "roemly@gmail.com";  // SMTP username
		$mail->Password = "3s1y2r1o0m0l6i861a"; // SMTP password		
/**/
		$mail->Host     = "mail.bimbel78.com"; // SMTP servers 25/587 / POP 110
		$mail->Port     = "465"; // SMTP servers 25/587 / POP 110
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = "noreply@bimbel78.com";  // SMTP username
		$mail->Password = "4FW(uJPBTfpQ"; // SMTP password
		
		$emailfrom=$emailfrom==""?$mail->Username:$emailfrom;						
		$namefrom=$namefrom==""?$mail->Username:$namefrom;						
		
		
		// pengirim
		$mail->From     = $emailfrom;
		$mail->FromName = $namefrom;	
		$mail->Sender   = $emailfrom;
		$mail->AddReplyTo($emailfrom, $namefrom);
		$mail->AddAddress($emailto);
		$mail->Subject  = $subject;
		$mail->MsgHTML($message);
		$mail->IsHTML(true);     
		if(count($attachment)>0){
			 foreach($attachment as $i => $uploadfile) {
				$mail->addAttachment($uploadfile['path'], $uploadfile['name']);
			 }
		}    
		if ($mail->Send())
		{
			return true;
		}
		else
		{
			//die($mail->Send());
			return false;
		}
		
		return true; 

}
function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}

	function zeroto62($nomor) {
		$angka_pertama=substr($nomor,0,1);
		if($angka_pertama==0){
			$panjang_nomor=strlen($nomor);
			return '62'.substr($nomor,1,$panjang_nomor);
		} else {
			return $nomor;
		}
	}
function generateQRCode($nb,$content=""){
	
	$nb=cleanInput($nb);
	$content=$content==''?$nb:$content;
	$pngAbsoluteFilePath = filepath("qrcode/$nb.png");
	$urlRelativeFilePath = fileurl("qrcode/$nb.png");
	if(!file_exists($pngAbsoluteFilePath)) {
		b_load_lib("Qrcode/qrlib");
		QRcode::png($content,$pngAbsoluteFilePath,'L', 4, 2);	
	}
	return $urlRelativeFilePath;
	//QRcode::png($content);
}
function br2nl($string)
{
   //return $string;
    return preg_replace('/\<(\s*)?br(\s*)?\/?\>/i',"\n", $string);
}



///////////////////FUNCTION HELPER
function badge_color($status) {
	$color=array(
		0=>'badge-light',
		1=>'badge-success',
		2=>'badge-danger',
		3=>'badge-warning',
		4=>'badge-primary',
		5=>'badge-dark'
	);	

	return '<span class="badge '.$color[$status].'">'.call_status_list()[$status].'</span>';
}
function call_status_list() {
	$status_info=array(
		0=>'None',
		1=>'Deal',
		2=>'Hot',
		3=>'Warm',
		4=>'Cold',
		5=>'Cancel'
	);	
	return $status_info;
}
function fu_list() {

	$fu_info=array(
		1=>'Telp',
		2=>'Blast WA',
		3=>'Email',
		4=>'Virtual Meeting'
	);	
	return $fu_info;
}
function fu_info($id) {
	$fu_info=fu_list();
	return $fu_info[$id];
}
function call_status($status_id) {
	//1:deal/2:hot/3:warm/4:cold/5:cancel
	$status_info=call_status_list();
	return $status_info[$status_id];
}
function peluang_list() {
	$peluang=array(
		'1'=>'Event',
		'2'=>'WA',
		'3'=>'IG',
		'4'=>'Youtube',
		'5'=>'Telphone',
		'6'=>'Website',
		'7'=>'Visit',
		'8'=>'Datang kekantor',
		'9'=>'Dll'	
	);	
	return $peluang;
}

function peluang_info($id) {
	$peluang_list=peluang_list();
	return $peluang_list[$id];
}

function info_prospek($prospek_list_id) {
    global $mysql;
    
    list($data)=$mysql->query_data("
    SELECT 
    p.id,l.npsn,pr.kode produk_kode,pr.nama produk_nama,l.lembaga_nama,l.lembaga_alamat,l.lembaga_telp,l.lembaga_email,l.pic_nama_lengkap,l.pic_nama_panggilan,l.pic_agama,l.pic_jabatan,l.pic_whatsapp,l.pic_email,p.next_fu,p.last_fu,p.status,p.catatan 
    FROM 
    lembaga l 
    INNER JOIN prospek_list p 
    ON l.id=p.lembaga_id
    LEFT JOIN prospek pp ON pp.id=p.prospek_id
    LEFT JOIN produk pr ON pr.id=pp.produk_id
    WHERE p.id=$prospek_list_id
    
    ");
    return $data;

}

function option_list_produk() {
    global $mysql;
    $option=array();
    $q=$mysql->query("SELECT id,kode,nama,harga FROM produk ORDER BY nama");
    if($q and $mysql->num_rows($q)>0) {
        while($d = $mysql->fetch_assoc($q)) {
            $option[$d['id']]=$d;
        }
    }
    return $option;
}
function list_kegiatan_jenis() {
    global $mysql;
    $option=array();
    $q=$mysql->query("SELECT id,nama FROM kegiatan_jenis ORDER BY nama");
    if($q and $mysql->num_rows($q)>0) {
        while($d = $mysql->fetch_assoc($q)) {
            $option[$d['id']]=$d['nama'];
        }
    }
    return $option;
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
function tanggal_jadwal($tanggal1,$tanggal2) {
	$tanggal_mulai=tgl_indo_short(date("Y-m-d",strtotime($tanggal1)));
	$tanggal_akhir=tgl_indo_short(date("Y-m-d",strtotime($tanggal2)));
	$hari_sama=$tanggal_mulai==$tanggal_akhir?1:0;
	$html="";
	if($hari_sama==1)
	{
	$html="
	<span class=\"label\">$tanggal_mulai</span>
	<span class=\"label\">".date("H:i",strtotime($tanggal1))."</span> -
	<span class=\"label\">".date("H:i",strtotime($tanggal2))."</span>";
	}
	else
	{
	$html= "<span class=\"label \">$tanggal_mulai ".date("H:i",strtotime($tanggal1))."</span> s/d ";
	$html.= "<span class=\"label\">$tanggal_akhir ".date("H:i",strtotime($tanggal2))."</span>";

	}
	return $html;
}

function list_kota() {
	global $mysql;
	$data=$mysql->query_data("SELECT nama,id,kode FROM wilayah WHERE length(kode)=5 ORDER BY nama");
	return $data;
}
function wilayah_nama($nama) {
	global $mysql;
	list($data)=$mysql->query_data("SELECT nama,id,kode FROM wilayah WHERE nama like '%$nama%' ");
	return $data;
		
}

///prospek
function list_prospek($r_kondisi=array()) {
    global $mysql;
    $r_kondisi[]=' 1=1  ';
	$kondisi=join(" AND ",$r_kondisi);


    $data=$mysql->query_data("
    SELECT 
    p.id,pr.kode produk_kode,pr.nama produk_nama,l.lembaga_nama,l.lembaga_telp,l.lembaga_email,l.pic_nama_lengkap,l.pic_nama_panggilan,l.pic_whatsapp,l.pic_email,p.next_fu,p.last_fu,p.status,p.catatan,
	( SELECT 
		u.username
	FROM 
		prospek_followup p1 LEFT JOIN user u ON p1.created_by=u.id
	WHERE 
		p1.prospek_list_id=p.id
	ORDER BY p.id desc limit 1 ) admin, 
	( 
	SELECT 
		u2.username
	FROM 
	    user u2 
	WHERE 
		p.created_by=u2.id
    ) creator 
    FROM 
    prospek_list p
    INNER JOIN  lembaga l 
    ON l.id=p.lembaga_id
    LEFT JOIN prospek pp ON pp.id=p.prospek_id
    LEFT JOIN produk pr ON pr.id=pp.produk_id
    WHERE $kondisi
    ORDER BY last_fu
    ");
    return $data;

}

function list_pekerjaan() {
	$option_status_pekerjaan=array(
		'1'=>'Pengurus yayasan',
		'2'=>'GTK/PTK',
	);

	return $option_status_pekerjaan;
}


function history_followup($prospek_list_id) {
    global $mysql;
    
    $data=$mysql->query_data("
    SELECT 
        p.id,p.last_fu,p.fu_via,p.next_fu,p.status,p.catatan,u.username admin
    FROM 
         prospek_followup p LEFT JOIN user u ON p.created_by=u.id
    WHERE 
        p.prospek_list_id=$prospek_list_id
    ORDER BY p.id
    ");
   
    return $data;

}
function option_selesai() {
	$option_selesai=array();
	$option_selesai[]='Pilih';
	$option_selesai[1]='Selesai';
	$option_selesai[2]='Batal';
	return $option_selesai;
}
function option_laporan() {
	$option_laporan=array();
	$option_laporan[]='Pilih';
	$option_laporan[1]='Sudah diberikan';
	$option_laporan[2]='Tidak perlu';
	return $option_laporan;
}
function option_sertifikat() {
	$option_sertifikat=array();
	$option_sertifikat[]='Pilih';
	$option_sertifikat[1]='Sudah diberikan';
	$option_sertifikat[2]='Tidak perlu';
	return $option_sertifikat;
}

function notifikasi_insert($message="",$url="",$user_id=0) {
	global $mysql;
	$now=date("Y-m-d H:i:s");
	if($message!="") {
		$q=$mysql->query("INSERT INTO notifikasi created_at='$now',message='$message',url='$url',user_id=$user_id");
		if($q) return true;
	}
	return false;
}
function notifikasi_read($id) {
	global $mysql;
	$user_id=$_SESSION['s_id'];
	$now=date("Y-m-d H:i:s");
	$q=$mysql->query("UPDATE notifikasi SET read_at='$now',read_by='$user_id',is_read=1  WHERE id=$id ");
}
function notifikasi_url($id) {
	global $mysql;
	$q=$mysql->query("SELECT url FROM notifikasi WHERE id=$id");
	$d=$mysql->fetch_assoc($q);
	return $d['url'];
}
function notifikasi_list_short(){
	global $mysql;
	$user_id=$_SESSION['s_id'];
	$now=date("Y-m-d H:i:s");
	$q=$mysql->query("SELECT message,url,id,created_at  FROM notifikasi WHERE user_id=$user_id OR user_id=0  ORDER BY id DESC limit 15");
	$list=array();
	if($q) {
		while($d = $mysql->fetch_assoc($q)) {
			$list[]=$d;
		}
	}
	return $list;

}

function notifikasi_new_total() {
	global $mysql;
	$user_id=$_SESSION['s_id'];
	$q=$mysql->query("SELECT count(id) total FROM notifikasi WHERE user_id=$user_id OR user_id=0 AND is_read=0 ");
	$d=$mysql->fetch_assoc($q);
	return $d['total'];
}
function notifikasi_list_show() {
	global $mysql;
	
	$list=notifikasi_list_short();
	$notifikasi_redirect=backendurl('notifikasi/redirect/');
	$notifikasi='';
	if(count($list)>0) {
		$notifikasi.='<ul>';
		foreach($list as $i => $d) {
			$now = new DateTime();
			$createdAt = new DateTime($d['created_at']);
			
			// Calculate the difference
			$interval = $now->diff($createdAt);

			// Display the result based on the difference
			if ($interval->y > 0) {
				$time=$interval->y . ' years';
			} elseif ($interval->m > 0) {
				$time=$interval->m . ' months';
			} elseif ($interval->d > 0) {
				$time=$interval->d . ' days';
			} elseif ($interval->h > 0) {
				$time=$interval->h . ' hours';
			} elseif ($interval->i > 0) {
				$time=$interval->i . ' minutes';
			} else {
				$time='Less than a minute';
			}

			$notifikasi.='<li>
			<a href="'.$notifikasi_redirect.$d['id'].'">
				<span class="mr-3 avatar-icon bg-success-lighten-1"><i class="icon-info"></i></span>
				<div class="notification-content">
					<h6 class="notification-heading">'.$d['message'].'</h6>
					<span class="notification-text">'.$time.'</span> 
				</div>
			</a>
		  </li>
		';
		}
		/*
		$notifikasi.='<li>
			<a href="javascript:void()">
				
				<div class="notification-content">
					<h6 class="notification-heading">Tampilkan semua</h6>
					<span class="notification-text"></span> 
				</div>
			</a>';
		*/	
		$notifikasi.='</ul>';
		
	}
	
	return $notifikasi;
}
///end prospek

function getTimeDifference($dateTime) {
	$now = new DateTime();
	$target = new DateTime($dateTime);
	$interval = $now->diff($target);

	if ($interval->y > 0) {
		return $interval->y . ' year' . ($interval->y > 1 ? 's' : '');
	} elseif ($interval->m > 0) {
		return $interval->m . ' month' . ($interval->m > 1 ? 's' : '');
	} elseif ($interval->d > 0) {
		return $interval->d . ' day' . ($interval->d > 1 ? 's' : '');
	} elseif ($interval->h > 0) {
		return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '');
	} elseif ($interval->i > 1) {
		return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '');
	} else {
		//return 'just now';
		return $interval->s . ' second' . ($interval->s > 1 ? 's' : '');
	}
}
