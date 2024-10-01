<?php

if($action=="uploadwordx" AND  $_POST['form']=='uploadwordx'){ 
	$destination=$config['userdir'].'backend/modul/quiz_upload_wordx/backup/'.$_FILES['file_wordx']['name'];
	$filename=$_FILES['file_wordx']['name'];
	if (!move_uploaded_file($_FILES['file_wordx']['tmp_name'], $destination)) {
		return _MAYBEPERMISSION;
	}else{
	$action="view_soal";
	}
}
if($action=="approve"){
	
	$id_soal=$_POST['id_soal'];
	$file_wordx=$_POST['file_wordx'];
	$document=$config['userdir'].'backend/modul/quiz_upload_wordx/backup/'.$file_wordx;	
	$kode_soal=$mysql->get1value("SELECT code FROM quiz_master WHERE id='".$id_soal."'");	
	$htmlname="Template_Soal_".$kode_soal.'.htm';
	$folder_soal=$_POST['id_soal'];
	
	$folder_guru=$mysql->get1value("SELECT username FROM user WHERE id IN(SELECT created_by FROM quiz_master WHERE id='".$id_soal."')");
	$directory_soal_1="/".$folder_guru."/dir_".$folder_soal;
	$directory_soal_2=$folder_guru."/dir_".$folder_soal."/";
	$upload_dir =($config['subdir']!=""?"/".$config['subdir']:"")."/userfiles/file/".$_d['dir']."/media/source/$directory_soal_2"; // path from base_url to base of upload folder (with start and final /)
	
	if(!file_exists(DIR_IMAGES))
	{
		mkdir(DIR_IMAGES,0777);
	}
	else
	{
	//dir(DIR_IMAGES);
	}
	
	
	if(file_exists(DIR_IMAGES."/source/$folder_guru")==false){
	mkdir(DIR_IMAGES."/source/$folder_guru",0755);
	}
	if(file_exists(DIR_IMAGES."/thumbs/$folder_guru")==false){
	mkdir(DIR_IMAGES."/thumbs/$folder_guru",0755);
	}
	
	if(file_exists(DIR_IMAGES."/source$directory_soal_1")==false){
	mkdir(DIR_IMAGES."/source$directory_soal_1",0755);
	}
	if(file_exists(DIR_IMAGES."/thumbs$directory_soal_1")==false){
	mkdir(DIR_IMAGES."/thumbs$directory_soal_1",0755);
	}
	
	
	


	
	////////////////
$array_images=array();
///////////////
$zip = new ZipArchive;
$zip->open($document);
for( $i = 0; $i < $zip->numFiles; $i++ ){ 
    $stat = $zip->statIndex( $i ); 
    $zipfilename = basename($stat['name']);
	$ext = pathinfo($zipfilename, PATHINFO_EXTENSION);
	
	if($ext=="htm"){
		$htmlname=$zipfilename;
	}else{
		continue;
	}
	
}

//cek gambar
 /*Open the received archive file*/
	if (true === $zip->open($document)) {
		for ($i=0; $i<$zip->numFiles;$i++) {
		/*Loop via all the files to check for image files*/
		 $zip_element = $zip->statIndex($i);


			/*Check for images*/
			if(preg_match("([^\s]+(\.(?i)(jpg|jpeg|png|gif|bmp))$)",$zip_element['name'])) {
			$file = basename($zip_element['name']); 	
			$array_images[$file]=$i;

			/*Display images if present by using display.php*/
			//echo $zip_element['name']."<br/>";
			//echo "<img src='display.php?filename=".$filename."&index=".$i."' /><hr />";
			}
		}
	}
//end cek gambar


$pertanyaan=array();
$essay=array();
/**/
if (($index = $zip->locateName($htmlname)) !== false) {
    $text = $zip->getFromIndex($index);
	$xml= new DOMDocument(); 
	$xml->preserveWhiteSpace=false;
	$xml->formatOutput= true;
	$xml->loadHTML($text); 
	
    //$table=$xml->getElementsByTagName('table');
	$r_pertanyaan=array();
	$r_essay=array();
	$xpath = new DOMXPath($xml);
	foreach ($xpath->query('//body/div/table') as $table) {
		
			
					
				$is_first=true;
				$imgs=$table->getElementsByTagName('img');
				foreach ($imgs as $i => $img) 
				{
					$src = $img->getAttribute('src');
					$file = basename($src); 
					$index=$array_images[$file];
					//$img->setAttribute('src','/userfiles/file/quiz/media/source/'.$file);
					//die("$upload_dir{$file}");
					$uniqid=uniqid();
					$img->setAttribute('src',"$upload_dir{$uniqid}{$file}");
					$src = $img->getAttribute('src');
					/* upload image */
					$url_image=backendurl("images/display.php?filename=".urlencode($file_wordx)."&index=".$index);
					
					$arrContextOptions=array(
						"ssl"=>array(
							"verify_peer"=>false,
							"verify_peer_name"=>false,
						),
					);  

					$image = file_get_contents($url_image, false, stream_context_create($arrContextOptions));
					//$image = file_get_contents($url_image);
					
					//die(DIR_IMAGES."/source/$directory_soal_2{$file}");
					//die(DIR_IMAGES."/source/$directory_soal_2{$uniqid}{$file}");
					file_put_contents(DIR_IMAGES."/source/$directory_soal_2{$uniqid}{$file}",$image); 
					//die(DIR_IMAGES."/source/$directory_soal_2"."a"."{$uniqid}{$file}");
					//Where to save the image on your server
					/* end upload image */
					//echo $src;
					//echo "<br/>";
				}
				
				foreach ($table->childNodes as $row) {
					if(!$row->hasChildNodes()) {
						continue;
					}
					$column=$row->childNodes;
					
					if($is_first){
						if($mode_algoritma==1){
							$nomor=$column->item(0)->nodeValue;
						} else {
							$nomor=$column->item(1)->nodeValue;
						}
						
						$is_first=false;
					}
					
					if($mode_algoritma==1){
						$label=trim($column->item(2)->nodeValue);	
					 } else {
						$label=trim($column->item(3)->nodeValue);	
					}
					
					
					
					if($label=="PERTANYAAN" OR in_array($label,$pilihan_ganda)  OR  $label=="KUNCI" OR  $label=="PEMBAHASAN"){
						 if($mode_algoritma==1){
							$content=$column->item(4);	
						 } else {
							$content=$column->item(5);
						 }						
						$isi=$content->childNodes;
						
						
						foreach ($isi as $cell){
							if($label=="KUNCI"){
								$string = $cell->nodeValue;
							}else{
								if($cell->nodeValue=="-"){
									$string = "-";	
								}else{
									$string = $cell->C14N();	
								}
								
							}
							
							$r_pertanyaan[$nomor][$label].=upload_wordx_cleaner($string);		
						}
					}
					
					
					if($label=="ESSAY"  OR in_array($label,$pilihan_kunci_essay)){
						if($mode_algoritma==1){
							$content=$column->item(4);	
						 } else {
							$content=$column->item(5);
						 }
					
						$isi=$content->childNodes;
						foreach ($isi as $cell){
							$string = $cell->C14N();
							$r_essay[$nomor][$label].=upload_wordx_cleaner($string);		
						}
					}
					
					
					
				}
				
				
	}
}
	if(count($r_pertanyaan)>0)
	{	
		$valid=true;
		
		if($_POST['timpa']==1){
		$timpa_soal=$mysql->query("DELETE FROM quiz_detail WHERE quiz_id='$id_soal'");
		}
		foreach($r_pertanyaan as $ix => $d)
		{
		$nomor=trim($ix);	
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
				$sql_r[]="$pil_gan='".${$pil_gan}."'";	
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
	

	if(count($r_essay)>0 and $valid)
	{	
		
		
		if($_POST['timpa']==1){
		$timpa_soal=$mysql->query("DELETE FROM quiz_essay WHERE quiz_id='$id_soal'");
		}
		foreach($r_essay as $ix => $d)
		{
			
		$nomor=trim($ix);
		${"question"}=addslashes($d["ESSAY"]);
		${"id_soal"}=cleanInput($id_soal);	
		foreach($pilihan_kunci_essay as $pil_kunci_essay) {
			${"$pil_kunci_essay"}=addslashes(trim(strip_tags($d["$pil_kunci_essay"])));
		}
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
			$valid=false;
			}
		}	
	}
	
	if($valid){
	generate_soal_json($id_soal);	
	msg_warning("Soal berhasil dimasukkan kedalam database","success");
	unlink($document);
	header('Cache-Control: no-cache');
	header('Pragma: no-cache');
	header("location:".backendurl("quiz_detail/view/?id_soal=$id_soal"));
	exit();	
	}
	else{
	msg_warning("Soal gagal dimasukkan kedalam database","success");
	unlink($document);
	header('Cache-Control: no-cache');
	header('Pragma: no-cache');
	header("location:".backendurl("quiz_detail/view/?id_soal=$id_soal"));
	
	}
}
?>
