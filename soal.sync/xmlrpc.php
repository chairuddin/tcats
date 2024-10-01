<?php
/**
 * XML-RPC protocol support for WordPress
 *
 * @package WordPress
 */

/**
 * Whether this is an XML-RPC Request
 *
 * @var bool
 */
define('XMLRPC_REQUEST', true);

// Some browser-embedded clients send cookies. We don't want them.
$_COOKIE = array();

// A bug in PHP < 5.2.2 makes $HTTP_RAW_POST_DATA not set by default,
// but we can do it ourself.
if ( !isset( $HTTP_RAW_POST_DATA ) ) {
	$HTTP_RAW_POST_DATA = file_get_contents( 'php://input' );
}

// fix for mozBlog and other cases where '<?xml' isn't on the very first line
if ( isset($HTTP_RAW_POST_DATA) )
	$HTTP_RAW_POST_DATA = trim($HTTP_RAW_POST_DATA);

/** Include the bootstrap for setting up WordPress environment */
include( dirname( __FILE__ ) . '/wp-load.php' );

if ( isset( $_GET['rsd'] ) ) { // http://cyber.law.harvard.edu/blogs/gems/tech/rsd.html
header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);
?>
<?php echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>
<rsd version="1.0" xmlns="http://archipelago.phrasewise.com/rsd">
  <service>
    <engineName>WordPress</engineName>
    <engineLink>https://wordpress.org/</engineLink>
    <homePageLink><?php bloginfo_rss('url') ?></homePageLink>
    <apis>
      <api name="WordPress" blogID="1" preferred="true" apiLink="<?php echo site_url('xmlrpc.php', 'rpc') ?>" />
      <api name="Movable Type" blogID="1" preferred="false" apiLink="<?php echo site_url('xmlrpc.php', 'rpc') ?>" />
      <api name="MetaWeblog" blogID="1" preferred="false" apiLink="<?php echo site_url('xmlrpc.php', 'rpc') ?>" />
      <api name="Blogger" blogID="1" preferred="false" apiLink="<?php echo site_url('xmlrpc.php', 'rpc') ?>" />
      <?php
      /**
       * Add additional APIs to the Really Simple Discovery (RSD) endpoint.
       *
       * @link http://cyber.law.harvard.edu/blogs/gems/tech/rsd.html
	   *
       * @since 3.5.0
       */
      do_action( 'xmlrpc_rsd_apis' );
      ?>
    </apis>
  </service>
</rsd>
<?php
exit;
}

include_once(ABSPATH . 'wp-admin/includes/admin.php');
include_once(ABSPATH . WPINC . '/class-IXR.php');
include_once(ABSPATH . WPINC . '/class-wp-xmlrpc-server.php'); 

/**
 * Posts submitted via the XML-RPC interface get that title
 * @name post_default_title
 * @var string
 */
$post_default_title = "";

/**
 * Filters the class used for handling XML-RPC requests.
 *
 * @since 3.1.0
 *
 * @param string $class The name of the XML-RPC server class.
 */
$wp_xmlrpc_server_class = apply_filters( 'wp_xmlrpc_server_class', 'wp_xmlrpc_server' );
$wp_xmlrpc_server = new $wp_xmlrpc_server_class;

// Fire off the request

///////////////////////////////////////////////
///////////////////////////////////////////////
function upload_wordx_trimmer($string){
	
	$string	= strip_tags($string);
	$string = str_replace("&#xD;",'',$string);
	$string	= preg_replace('/\s+/', '', $string);
	$string	= trim($string);
	
	return $string;
}

function upload_wordx_cleaner($string){
	$string = str_replace("&#xD;",'',$string);
	$string = preg_replace('/\s\s+/', ' ', $string);
	$string = trim($string);
	
	return $string;
}

include "../panel/config/function.php";
include "../panel/config/config.php";
include "../panel/config/connect.php";



ob_start();
 
	$data_xml=htmlspecialchars_decode($HTTP_RAW_POST_DATA);

	$xml= new DOMDocument(); 
	$xml->preserveWhiteSpace=false;
	$xml->formatOutput= true;
	$xml->loadXML($data_xml); 
	/*kode soal*/
	$xpath = new DOMXPath($xml);
	$kode="";
	foreach ($xpath->query('//methodCall/params/param/value/struct/member/value/string') as $kode_node) {
		if($kode==""){
		$kode=$kode_node->nodeValue;
		}
	}
	$id_soal=$mysql->get1value("SELECT id FROM quiz_master WHERE code='$kode'");
	//////////////create folder/////////////////
	
	$folder_soal=$id_soal;
	
	$folder_guru=$mysql->get1value("SELECT username FROM user WHERE id IN(SELECT created_by FROM quiz_master WHERE id='".$id_soal."')");
	$directory_soal_1=$folder_guru."/dir_".$folder_soal;
	$directory_soal_2=$folder_guru."/dir_".$folder_soal;
	$upload_dir =($config['subdir']!=""?"/".$config['subdir']:"")."/userfiles/file/".$_d['dir']."/media/source/{$directory_soal_2}"; // path from base_url to base of upload folder (with start and final /)
	
	if(!file_exists(DIR_IMAGES))
	{
		mkdir(DIR_IMAGES,0777);
	}
	else
	{
	//dir(DIR_IMAGES);
	}
	
	
	if(file_exists(DIR_IMAGES."/source/$folder_guru")){
		$images = glob(DIR_IMAGES."/source/{$folder_guru}*.jpg");
		foreach($images as $image){
			 @unlink($image);
			 echo "$image <br/>";
		}
		
		
		
	
	}
	if(file_exists(DIR_IMAGES."/source/$folder_guru")==false){
	mkdir(DIR_IMAGES."/source/$folder_guru",0755);
	}
	if(file_exists(DIR_IMAGES."/thumbs/$folder_guru")==false){
	mkdir(DIR_IMAGES."/thumbs/$folder_guru",0755);
	}
	
	if(file_exists(DIR_IMAGES."/source/$directory_soal_1")==false){
	mkdir(DIR_IMAGES."/source/$directory_soal_1",0755);
	}
	if(file_exists(DIR_IMAGES."/thumbs/$directory_soal_1")==false){
	mkdir(DIR_IMAGES."/thumbs/$directory_soal_1",0755);
	}
	
	//////////////end create folder///////////////
	
    $r_pertanyaan=array();
	$r_essay=array();
	$path_image_del=array();
	$xpath = new DOMXPath($xml);
	foreach ($xpath->query('//methodCall/params/param/value/struct/member/value/string/div/table/tbody') as $table) {
			$is_first=true;
				
				
				$imgs=$table->getElementsByTagName('img');
				foreach ($imgs as $i => $img) 
				{
					$url_image = $img->getAttribute('src');
					echo $url_image."\r\n";
					//echo "$upload_dir/{$uniqid}{$file}"."\r\n";
					$x = parse_url($url_image);
					$path_image_del[]=$x['path'];
					$copyfrom=$x['path'];
					$file = basename($url_image); 
					//$uniqid=uniqid();
					$uniqid="xyz";
					$img->setAttribute('src',"$upload_dir/{$uniqid}{$file}");
					$src = $img->getAttribute('src');
					$image = file_get_contents($url_image);
					//echo DIR_IMAGES."/source/{$directory_soal_2}/{$uniqid}{$file} \r\n";
					//echo "$image \r\n";
					echo $copyfrom.",|".DIR_IMAGES."/source/{$directory_soal_2}/{$uniqid}{$file}";
					//copy($copyfrom,DIR_IMAGES."/source/{$directory_soal_2}/{$uniqid}{$file}");
					file_put_contents(DIR_IMAGES."/source/{$directory_soal_2}/{$uniqid}{$file}",$image); 
					
				}
				//var_dump($path_image_del);
				foreach ($table->childNodes as $row) {
					
					$column=$row->childNodes;
					if($is_first){
						$nomor=$column->item(0)->nodeValue;
						$is_first=false;
					}
					
					$label=$column->item(1)->nodeValue;	
					if($label=="PERTANYAAN" OR in_array($label,$pilihan_ganda) OR  $label=="KUNCI" OR  $label=="PEMBAHASAN"){
						$content=$column->item(2);	
						$isi=$content->childNodes;
						foreach ($isi as $cell){
							if($label=="KUNCI" ){
								$string = trim(cleanInput($cell->nodeValue),"alpha");
							}else{
								if(trim(cleanInput($cell->nodeValue))=="-"){
									$string = "-";	
								}else{
									$string = $cell->C14N();	
								}
								
							}
							
							$r_pertanyaan[$nomor][$label].=upload_wordx_cleaner($string);		
						}
					}
					$label=$column->item(1)->nodeValue;	
					if($label=="ESSAY"  OR in_array($label,$pilihan_kunci_essay)){
						$content=$column->item(2);	
						$isi=$content->childNodes;
						foreach ($isi as $cell){
							$string = $cell->C14N();
							if(in_array($label,$pilihan_kunci_essay)) {
								$r_essay[$nomor][$label].=strip_tags($string);		
							} else {
								$r_essay[$nomor][$label].=upload_wordx_cleaner($string);		
							}
						}
					}
					
				}
				
				
	}



var_dump($path_image_del);
/*hapus image*/
if(count($path_image_del)>0){
	foreach($path_image_del as $i => $v){
		//echo DIR_SYNC.$v."\r\n";
		@unlink(DIR_SYNC.$v);
	}
}
/*end hapus image*/


print_r($r_pertanyaan);
$hasil=ob_get_clean();

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile, $hasil);
fclose($myfile);


$valid=true;
$urutan=array();
if(count($r_pertanyaan)>0)
{	
	
		foreach($r_pertanyaan as $nomor => $d)
		{
		$urutan[]=$nomor;	
		${"model"}=1;
		if($A=="-" AND $B=="-" AND $B=="-" AND $D=="-" AND $E=="-"){
		${"model"}=0;	
		}
		
		foreach($pilihan_ganda as $pil_gan) {
			
			if(in_array($pil_gan,array('F','G','H','I','J'))) {
				$d[$pil_gan]=$d[$pil_gan]==''?'-':$d[$pil_gan];
			}
			${"$pil_gan"}=addslashes($d[$pil_gan]);
		}
		
		${"answer"}=addslashes($d["KUNCI"]);
		${"question"}=addslashes($d["PERTANYAAN"]);
		${"pembahasan"}=addslashes($d["PEMBAHASAN"]);
		
		${"id_soal"}=cleanInput($id_soal);
		
		
		
		$sql_r=array();
		$quiz_detail_id=0;
		$r_exist=$mysql->query("SELECT id FROM quiz_detail WHERE quiz_id='".${"id_soal"}."' AND urutan='".$nomor."'");
		if($mysql->numrows($r_exist)>0){
			list($quiz_detail_id)=$mysql->row($r_exist);
			$sql="
			UPDATE quiz_detail SET ";
			
			$sql_r[]="question='".${"question"}."'";	
			foreach($pilihan_ganda as $pil_gan) {
				$sql_r[]="$pil_gan='".${"$pil_gan"}."'";	
			} 
			$sql_r[]="answer='".${"answer"}."'";	
			$sql_r[]="model='".${"model"}."'";	
			$sql.=join(",",$sql_r);
			$sql.=" WHERE quiz_id='".${"id_soal"}."' AND urutan='".$nomor."'";
			
		}else{
			$sql="
			INSERT INTO quiz_detail SET ";
			
			$sql_r[]="question='".${"question"}."'";	
			foreach($pilihan_ganda as $pil_gan) {
				$sql_r[]="$pil_gan='".${"$pil_gan"}."'";	
			} 
			$sql_r[]="answer='".${"answer"}."'";	
			$sql_r[]="model='".${"model"}."'";	
			$sql_r[]="quiz_id='".${"id_soal"}."'";	
			$sql_r[]="urutan='".$nomor."'";	
			$sql.=join(",",$sql_r);
		}
		
		
		
		$sukses=$r=$mysql->query($sql);
		if($quiz_detail_id<=0) {
			//berarti soal baru
			$quiz_detail_id = $mysql->insert_id();
		}
		if(!$sukses){
		$valid=false;
		}
		if($mode_pembahasan) {
			$sql_pembahasan="REPLACE INTO quiz_pembahasan_pg SET pembahasan='$pembahasan',quiz_detail_id=$quiz_detail_id ";
			
			$q_pembahasan=$mysql->query($sql_pembahasan);
			if(!$q_pembahasan){
				$valid=false;
			}
		}
		
		}
		
	
	}
//hapus urutan yang lebih
if(count($urutan)>0){
	$join_urutan=join(",",$urutan);
	$sql=" DELETE FROM quiz_detail WHERE urutan NOT IN($join_urutan) AND quiz_id='".${"id_soal"}."'  ";
	$sukses=$r=$mysql->query($sql);
}	



	$urutan_essay=array();
	if(count($r_essay)>0 and $valid)
	{	
		
		
		foreach($r_essay as $nomor => $d)
		{
			$urutan_essay[]=trim($nomor);		
			${"question"}=addslashes($d["ESSAY"]);
			foreach($pilihan_kunci_essay as $pil_kunci_essay) {
			${"$pil_kunci_essay"}=addslashes($d[$pil_kunci_essay]);
			}
			${"id_soal"}=cleanInput($id_soal);	
			$sql_r=array();
			$r_exist=$mysql->query("SELECT id FROM quiz_essay WHERE quiz_id='".${"id_soal"}."' AND urutan='".$nomor."'");
			if($mysql->numrows($r_exist)>0){
				$sql="
				UPDATE quiz_essay SET ";
				$sql_r[]="question='".${"question"}."'";	
				foreach($pilihan_kunci_essay as $pil_kunci_essay) {
					$field=str_replace("KUNCI","answer",$pil_kunci_essay);
					$sql_r[]="$field='".${"$pil_kunci_essay"}."'";	
				}
				$sql_r[]="quiz_id='".${"id_soal"}."'";	
				$sql_r[]="urutan='".$nomor."'";	
				$sql.=join(",",$sql_r);
				$sql.=" WHERE quiz_id='".${"id_soal"}."' AND urutan='".$nomor."'";
			}else{
				$sql="
				INSERT INTO quiz_essay SET ";
				$sql_r[]="question='".${"question"}."'";	
				foreach($pilihan_kunci_essay as $pil_kunci_essay) {
					$field=str_replace("KUNCI","answer",$pil_kunci_essay);
					$sql_r[]="$field='".${"$pil_kunci_essay"}."'";	
				}
				$sql_r[]="quiz_id='".${"id_soal"}."'";	
				$sql_r[]="urutan='".$nomor."'";	
				$sql.=join(",",$sql_r);
			}	
			
			
			$sukses=$r=$mysql->query($sql);
			if(!$sukses){
				$r=$mysql->query($sql);
				$valid=false;
			}
		
		}	
	}
//hapus urutan yang lebih
if(count($urutan_essay)>0){
	$join_urutan=join(",",$urutan_essay);
	$sql=" DELETE FROM quiz_essay WHERE urutan NOT IN($join_urutan) AND quiz_id='".${"id_soal"}."'  ";
	$sukses=$r=$mysql->query($sql);
}	
generate_soal_json($id_soal);


///////////////////////////////////////////////
///////////////////////////////////////////////

$wp_xmlrpc_server->serve_request();


exit;

/**
 * logIO() - Writes logging info to a file.
 *
 * @deprecated 3.4.0 Use error_log()
 * @see error_log()
 *
 * @param string $io Whether input or output
 * @param string $msg Information describing logging reason.
 */
function logIO( $io, $msg ) {
	_deprecated_function( __FUNCTION__, '3.4.0', 'error_log()' );
	if ( ! empty( $GLOBALS['xmlrpc_logging'] ) )
		error_log( $io . ' - ' . $msg );
}
