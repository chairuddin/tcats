<?php
if($_GET['id_soal']==""){
	msg_warning("Pilih paket soal terlebih dahulu","error");
	header("location:".backendurl("quiz_master/view/"));
	exit();	
}

//$col_back="<input type=\"button\" class=\"btn back\" onclick=\" window.location.href='".backendurl("quiz_master")."';\" value=\"Back\">";
$col_back="<input type=\"button\" class=\"btn back\" onclick=\" window.location.href='".backendurl("quiz_detail/view/?id_soal=".$_GET['id_soal'])."';\" value=\"Back\">";	
$kondisi="";
if(($_SESSION['s_level']==0 and $_GET['id_soal']!="")){
	$kondisi=" AND created_by='".$_SESSION['s_id']."'";
	$r=$mysql->query("SELECT * from quiz_master where id=".$_GET['id_soal']." $kondisi");
	if($r and $mysql->numrows($r)==0){
	msg_warning("Anda tidak berhak mengakses soal tersebut","error");
	header("location:".backendurl("quiz_master/view/"));
	exit();	
	}
}	

if( $_GET['download_template']==1 and intval($_GET['jumlah_soal'])>0 ) {

$kode_soal=$mysql->get1value(" SELECT code FROM quiz_master WHERE id='".$_GET['id_soal']."' ");	
$styleTable = array('borderSize' => 6, 'borderColor' => '006699','cellMargin' => 0, 'cellMarginRight' => 0, 'cellMarginBottom' => 3, 'cellMarginLeft' => 3);	
$styleWarning = array('size' => 14, 'bold' => true);	
$noSpace = array('spaceAfter' => 0,'spaceBefore' => 0);
$section = $phpWord->addSection(array('orientation'=>"portrait"));

$section->addText(htmlspecialchars('Warning:!!!'),$styleWarning);
$section->addText(htmlspecialchars('Jangan merubah kolom yang berwarna kuning'), array('color' => '996699'));
$section->addText(htmlspecialchars('Jangan merubah layout table dibawah ini'), array('color' => '996699'));
$section->addText(htmlspecialchars(''));
$section->addText(htmlspecialchars('Template: Alma-05'),array('color' => '990000','bold'=>true));
$section->addTextBreak();
$styleCell = array('valign' => 'top','align' => 'left','spaceAfter' => 0);
$styleCell1 = array('valign' => 'top','align' => 'center','size'=>14,'bold'=>true,'shading' => array('fill' => 'ffff00'));
$phpWord->addTableStyle('Fancy Table', $styleTable);

//$table = $section->addTable();

for($i=1;$i<=($_GET['jumlah_soal']);$i++){
	/*
	$table->addRow();
	$table->addCell(600)->addText($i,$styleCell1,$noSpace);
	$cel2=$table->addCell(8000);
	$cel2->addTableStyle($styleTable);
	*/ 
	$cel21=$section->addTable("Fancy Table");
	$cel21->addRow();
	$cel21->addCell(500)->addText($i,$styleCell1,$noSpace);
	$cel21->addCell(1600)->addText("PERTANYAAN",$styleCell1,$noSpace);
	$cel21->addCell(6000)->addText("",$styleCell,$noSpace);
	foreach($pilihan_ganda as $pil_gan) {
		$default='';
		if(in_array($pil_gan,array('F','G','H','I','J'))) {
			$default='-';
		}
		$cel21->addRow();
		$cel21->addCell(500)->addText("",$styleCell,$noSpace);
		$cel21->addCell(1600)->addText("$pil_gan",$styleCell1,$noSpace);
		$cel21->addCell(6000)->addText("$default",$styleCell,$noSpace);
	}
	$cel21->addRow();
	$cel21->addCell(500)->addText("",$styleCell,$noSpace);
	$cel21->addCell(1600)->addText("KUNCI",$styleCell1,$noSpace);
	$cel21->addCell(6000)->addText("",$styleCell,$noSpace);
	if($mode_pembahasan) {
		
		$cel21->addRow();
		$cel21->addCell(500)->addText("",$styleCell,$noSpace);
		$cel21->addCell(1600)->addText("PEMBAHASAN",$styleCell1,$noSpace);
		$cel21->addCell(6000)->addText("",$styleCell,$noSpace);
	}
	//$cel2->addTextBreak();
	//$cel2->addTextBreak();
	$section->addTextBreak();
	$section->addTextBreak();
}

$styleCell1 = array('valign' => 'top','align' => 'center','size'=>14,'bold'=>true,'shading' => array('fill' => '00ff00'));
$phpWord->addTableStyle('Fancy Table', $styleTable);

for($i=1;$i<=($_GET['jumlah_essay']);$i++) {
	$cel21=$section->addTable("Fancy Table");
	$cel21->addRow();
	$cel21->addCell(600)->addText($i,$styleCell1,$noSpace);
	$cel21->addCell(1600)->addText("ESSAY",$styleCell1,$noSpace);
	$cel21->addCell(6000)->addText("",$styleCell,$noSpace);
	
	foreach($pilihan_kunci_essay as $pil_kunci_essay) {
		$cel21->addRow();
		$cel21->addCell(600)->addText("",$styleCell1,$noSpace);
		$cel21->addCell(1600)->addText($pil_kunci_essay,$styleCell1,$noSpace);
		$cel21->addCell(6000)->addText("",$styleCell,$noSpace);
	}
	
	$section->addTextBreak();
	$section->addTextBreak();
}



	$filename="Template_Soal_".stripslashes($kode_soal)	.'.docx';
	// Save file
	$targetFile=$config['userdir'].'backend/modul/quiz_upload_wordx/backup/'.$filename;
	
	$phpWord->save($targetFile,"Word2007");	
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.$filename.'');
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . filesize($targetFile));
	ob_clean();
	flush();
	
	$status = readfile($targetFile);
	unlink($targetFile);
	exit;

}

if($_GET['download_template_full']==1){	
$kode_soal=$mysql->get1value("SELECT code FROM quiz_master WHERE id='".$_GET['id_soal']."'");	
$styleTable = array('borderSize' => 6, 'borderColor' => '006699','cellMargin' => 0, 'cellMarginRight' => 0, 'cellMarginBottom' => 3, 'cellMarginLeft' => 3);	
$styleWarning = array('size' => 14, 'bold' => true);	
$noSpace = array('spaceAfter' => 0,'spaceBefore' => 0);
$section = $phpWord->addSection(array('orientation'=>"portrait"));
$section->addText(htmlspecialchars('Warning:!!!'),$styleWarning);
$section->addText(htmlspecialchars('Jangan merubah kolom yang berwarna kuning'), array('color' => '996699'));
$section->addText(htmlspecialchars('Jangan merubah layout table dibawah ini'), array('color' => '996699'));
$section->addTextBreak();
$styleCell = array('valign' => 'top','align' => 'left','spaceAfter' => 0);
$styleCell1 = array('valign' => 'top','align' => 'center','size'=>14,'bold'=>true,'shading' => array('fill' => 'ffff00'));
$phpWord->addTableStyle('Fancy Table', $styleTable);

$table = $section->addTable();
$q_soal=$mysql->query("select * from quiz_detail WHERE quiz_id='".$_GET['id_soal']."'");
if($q_soal and $mysql->numrows($q_soal)>0){
$i=1;
while($d=$mysql->assoc($q_soal)){
$table->addRow();
$table->addCell(600)->addText($i,$styleCell1,$noSpace);
$cel2=$table->addCell(8000);
$cel2->addTableStyle($styleTable);
$cel21=$cel2->addTable("Fancy Table");
$cel21->addRow();
$cel21->addCell(1600)->addText("PERTANYAAN",$styleCell1,$noSpace);
$cel21->addCell(6000)->addText(strip_tags($d['question']),$styleCell,$noSpace);
$cel21->addRow();
$cel21->addCell(1600)->addText("A",$styleCell1,$noSpace);
$cel21->addCell(6000)->addText("",$styleCell,$noSpace);
$cel21->addRow();
$cel21->addCell(1600)->addText("B",$styleCell1,$noSpace);
$cel21->addCell(6000)->addText("",$styleCell,$noSpace);
$cel21->addRow();
$cel21->addCell(1600)->addText("C",$styleCell1,$noSpace);
$cel21->addCell(6000)->addText("",$styleCell,$noSpace);
$cel21->addRow();
$cel21->addCell(1600)->addText("D",$styleCell1,$noSpace);
$cel21->addCell(6000)->addText("",$styleCell,$noSpace);
$cel21->addRow();
$cel21->addCell(1600)->addText("E",$styleCell1,$noSpace);
$cel21->addCell(6000)->addText("",$styleCell,$noSpace);
$cel21->addRow();
$cel21->addCell(1600)->addText("KUNCI",$styleCell1,$noSpace);
$cel21->addCell(6000)->addText("",$styleCell,$noSpace);
$cel2->addTextBreak();
$cel2->addTextBreak();
$i++;
}
}
	$filename="Template_Full_Soal_".$kode_soal.'.docx';
	// Save file
	$targetFile=$config['userdir'].'backend/modul/quiz_upload_wordx/backup/'.$filename;
	
	$phpWord->save($targetFile,"Word2007");	
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.$filename.'');
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . filesize($targetFile));
	ob_clean();
	flush();
	//$status = readfile($targetFile);
	unlink($targetFile);
	exit;
	
}

if($action==""){
$kode_soal=$mysql->get1value("SELECT code FROM quiz_master WHERE id=".$_GET['id_soal']);	
$judul_soal=$mysql->get1value("SELECT title_id FROM quiz_master WHERE id=".$_GET['id_soal']);
$id_soal=$_GET['id_soal'];
$url_upload = backendurl("$modul/uploadwordx?id_soal=$id_soal");	

echo <<<END
<div class="card">
		<div class="card-header">
		  <h3 class="card-title">Upload Soal (Docx)</h3>
		  <div class="float-right"></div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
		 <div class="row">
		 <div class="col-md-12">
		 <p>1. Silahkan download template soal terlebih dahulu</p>
			<form method="get" action="">
				<table>
				<tr><td>Jumlah Pilihan Ganda</td><td>&nbsp;<input type="number" class="text-center" name="jumlah_soal" value="40" size="2" style="width:45px;"/></td></tr>
				<tr><td>Jumlah Essay</td><td>&nbsp;<input type="number"  class="text-center" name="jumlah_essay" value="0" size="2" style="width:45px;"/></td></tr>
				</table>
				<input type="hidden" name="download_template" value="1"/>
				<input type="hidden" name="id_soal" value="$id_soal"/>
				<button class="btn btn-primary" type="Submit">Download Template</button>
			</form>
			<br/>
		 <p>2. Silahkan isi template tersebut sesuai panduan video tutorial.</p>
		 <p>3. Silahkan upload template soal yang sudah diconvert menjadi zip sesuai video tutorial .</p>
		 <form method="post" action="$url_upload" enctype="multipart/form-data">
				<p>Pilih template </p>
				<input type="hidden" name="form" value="uploadwordx"/>
				<input type="hidden" name="id_soal" value="$id_soal"/>
				<input type="file"  id="file_wordx" required="required" name="file_wordx" accept="zip/*" class="">
				<br/><br/><input type="checkbox" name="timpa" value="1" /> Hapus soal lama ganti dengan yang baru?
				<br/>
				<button class="btn btn-primary" type="submit">Upload Template</button>
			</form>
		 </div>
		</div>
		</div>
		<!-- /.card-body -->
	  
</div>
END;
/*
echo '
<div class="row-fluid">
	<div class="span12">
	<br/>
	<table>
	<tr><td>Kode Soal</td><td>:</td><td><b>'.$kode_soal.'</b></td></tr>
	<tr><td>Judul Soal</td><td>:</td><td><b>'.$judul_soal.'</b></td></tr>
	</table>
	</div>
</div>
<div class="row-fluid">
<div class="span6">
<div class="box box-color box-bordered">
<div class="box-title">
	<h3>
		<i class="icon-th-large"></i>
		Download Template
	</h3>
</div>
<div class="box-content">
	<form method="get" action="">
	Silahkan 
	<table>
	<tr><td>Pilihan Ganda</td><td>:&nbsp;<input type="number" name="jumlah_soal" value="40" size="2" style="width:40px;"/></td></tr>
	<tr><td>Essay</td><td>:&nbsp;<input type="number" name="jumlah_essay" value="0" size="2" style="width:40px;"/></td></tr>
	</table>
	<input type="hidden" name="form" value="uploadwordx"/>
	<input type="hidden" name="id_soal" value="'.$_GET['id_soal'].'"/>
	
	</form>
</div>
</div>
</div>
';
$form = new Form("uploadwordx");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery", "focus"),
	"action" =>backendurl("$modul/uploadwordx?id_soal=".$_GET['id_soal']),
	"enctype" =>"multipart/form-data"));

$form->addElement(new Element_Hidden("form", "uploadwordx"));
$form->addElement(new Element_HTML('
<span style="background-color:#cece00;padding:5px;">
Jika anda menggunakan template lama silahkan klik <a href="'.backendurl("quiz_upload_wordx_old/?id_soal=".$_GET['id_soal']).'">disini</a> untuk upload soal 
</span>
<br/>
<span>
Silahkan upload template yang sudah dikonversi menjadi *.htm
</span>

'));
$form->addElement(new Element_HTML('
<div>
Upload file *.zip
<input type="file"  id="file_wordx" required="required" name="file_wordx" accept="zip/*" class="">
<div class="konfirmasi_timpa">
<br/><input type="checkbox" name="timpa" value="1" /> Hapus soal lama ganti dengan yang baru?
</div>
</div>
'));
$form->addElement(new Element_Button(_UPLOAD));
$form->addElement(new Element_Button(_BATAL, "button", array(
	"onclick" => "history.go(-1);"
)));

echo '
<div class="span6">
<div class="box box-color box-bordered">
<div class="box-title">
	<h3>
		<i class="icon-th-large"></i>
		Upload soal
	</h3>
</div>
<div class="box-content">';
$form->render();
echo '

</div>
</div>
</div>
</div>
';
*/
}
if($action=="view_soal"){
$col_back="<input type=\"button\" class=\"btn back\" onclick=\" window.location.href='".backendurl("quiz_upload_wordx/?id_soal=".$_GET['id_soal'])."';\" value=\"Back\">";
$form_title="Pratinjau Soal";	
//Buat directory
	$id_soal=$_GET['id_soal'];
	$folder_soal=$_GET['id_soal'];
	$folder_guru=$mysql->get1value("SELECT username FROM user WHERE id IN(SELECT created_by FROM quiz_master WHERE id='".$id_soal."')");
	$directory_soal_1="/".$folder_guru."/dir_".$folder_soal;
	$directory_soal_2=$folder_guru."/dir_".$folder_soal."/";
	$upload_dir ="/userfiles/file/".$_d['dir']."/media/source/$directory_soal_2"; // path from base_url to base of upload folder (with start and final /)
	
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
	
	
//END Buat directory	
	
$kode_soal=$mysql->get1value("SELECT code FROM quiz_master WHERE id='".$_GET['id_soal']."'");	

$htmlname="Template_Soal_".$kode_soal.'.htm';

$document=$destination;
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

if (($index = $zip->locateName("$htmlname")) !== false) {
    $text = $zip->getFromIndex($index);
	$xml= new DOMDocument(); 
	$xml->preserveWhiteSpace=false;
	$xml->formatOutput= true;
	$xml->loadHTML($text); 
	
    //$table=$xml->getElementsByTagName('table');
	$r_pertanyaan	= array();
	$r_essay		= array();
	libxml_use_internal_errors(TRUE);
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
					$img->setAttribute('src',backendurl("$modul/display/?id_soal=".$_GET['id_soal']."&filename=".$filename."&index=".$index));
					$src = $img->getAttribute('src');
					
				
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
					if($label=="PERTANYAAN" OR in_array($label,$pilihan_ganda) OR  $label=="KUNCI" OR  $label=="PEMBAHASAN"){
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
					
					if($label=="ESSAY"  OR in_array($label,$pilihan_kunci_essay) ){
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
	
	/*
	foreach ($xpath->query('//body/div/table') as $table) {
		// in case you really wanted them...
		$superCol = $table->parentNode;
		$superRow = $superCol->parentNode;
		
		$imgs=$table->getElementsByTagName('img');
		foreach ($imgs as $i => $img) 
		{
			$src = $img->getAttribute('src');
			$file = basename($src); 
			$index=$array_images[$file];
			//$img->setAttribute('src','/userfiles/file/quiz/media/source/'.$file);
			$img->setAttribute('src',backendurl("$modul/display/?id_soal=".$_GET['id_soal']."&filename=".$filename."&index=".$index));
			$src = $img->getAttribute('src');
			
		
			//echo $src;
			//echo "<br/>";
		}
		foreach ($table->childNodes as $row) {
			$column=$row->childNodes;
		
			$nomor=$column->item(0)->nodeValue;
			$tanya=$column->item(2);
			$tanya_table=$tanya->childNodes->item(1);
			$tanya_table_row=$tanya_table->childNodes->item(0);
			$tanya_table_td=$tanya_table_row->childNodes;
			
			$label_tanya=$tanya_table_td->item(0)->nodeValue;
			$isi_tanya=$tanya_table_td->item(2);
			
			
			
			//extract tabel essay
			if(trim($label_tanya)=="ESSAY"){
				
				$isi=$isi_tanya->childNodes;
				if(count($isi)>0){

					foreach ($isi as $cell){
					
						$string = $cell->C14N();
						$string = upload_wordx_cleaner($string);
						if(strlen($string)>0){
							$r_essay[$nomor]['question'].=$string;
						}
					}
				}
			}
			
			
			//extract tabel pertanyaan
			if(trim($label_tanya)=="PERTANYAAN"){
				$isi=$isi_tanya->childNodes;
				foreach ($isi as $cell){
					//$r_pertanyaan[$nomor]['question'].=$cell->C14N();	
					$string = $cell->C14N();
					$r_pertanyaan[$nomor]['question'].=upload_wordx_cleaner($string);
				}
			}
			
			//extract A
			$tanya_table_row=$tanya_table->childNodes->item(1);
			$tanya_table_td=$tanya_table_row->childNodes;
			if($tanya_table_td!= NULL){
			$label_tanya=$tanya_table_td->item(0)->nodeValue;
			$isi_tanya=$tanya_table_td->item(2);
				if(trim($label_tanya)=="A"){
					$isi=$isi_tanya->childNodes;
					foreach ($isi as $cell){
						$string = $cell->C14N();
						$r_pertanyaan[$nomor]['A'].=upload_wordx_cleaner($string);
											
					}
					
					
				}
			}
			//extract B
			$tanya_table_row=$tanya_table->childNodes->item(2);
			$tanya_table_td=$tanya_table_row->childNodes;
			if($tanya_table_td!= NULL){
			$label_tanya=$tanya_table_td->item(0)->nodeValue;
			$isi_tanya=$tanya_table_td->item(2);
				if(trim($label_tanya)=="B"){
					
					$isi=$isi_tanya->childNodes;
					foreach ($isi as $cell){
						$string = $cell->C14N();
						$r_pertanyaan[$nomor]['B'].=upload_wordx_cleaner($string);
						//$r_pertanyaan[$nomor]['B'].=$cell->C14N();				
					}
					
				}
			}
			//extract C
			$tanya_table_row=$tanya_table->childNodes->item(3);
			$tanya_table_td=$tanya_table_row->childNodes;
			if($tanya_table_td!= NULL){
			$label_tanya=$tanya_table_td->item(0)->nodeValue;
			$isi_tanya=$tanya_table_td->item(2);
				if(trim($label_tanya)=="C"){
					$isi=$isi_tanya->childNodes;
					foreach ($isi as $cell){
						$string = $cell->C14N();
						$r_pertanyaan[$nomor]['C'].=upload_wordx_cleaner($string);			
					}
					
				}
			}
			//extract D
			$tanya_table_row=$tanya_table->childNodes->item(4);
			$tanya_table_td=$tanya_table_row->childNodes;
				if($tanya_table_td!= NULL){
				$label_tanya=$tanya_table_td->item(0)->nodeValue;
				$isi_tanya=$tanya_table_td->item(2);
				if(trim($label_tanya)=="D"){
					$isi=$isi_tanya->childNodes;
					foreach ($isi as $cell){
						$string = $cell->C14N();
						$r_pertanyaan[$nomor]['D'].=upload_wordx_cleaner($string);
					}
					
				}
			}
			//extract E
			$tanya_table_row=$tanya_table->childNodes->item(5);
			$tanya_table_td=$tanya_table_row->childNodes;
				if($tanya_table_td!= NULL){
				$label_tanya=$tanya_table_td->item(0)->nodeValue;
				$isi_tanya=$tanya_table_td->item(2);
				if(trim($label_tanya)=="E"){
					$isi=$isi_tanya->childNodes;
					foreach ($isi as $cell){
						$string = $cell->C14N();
						$r_pertanyaan[$nomor]['E'].=upload_wordx_cleaner($string);			
					}					
				}
			}
			//extract KUNCI
			$tanya_table_row=$tanya_table->childNodes->item(6);
			$tanya_table_td=$tanya_table_row->childNodes;
				if($tanya_table_td!= NULL){
				$label_tanya=$tanya_table_td->item(0)->nodeValue;
				$isi_tanya=$tanya_table_td->item(2);
				if(trim($label_tanya)=="KUNCI"){
					
					$isi=$isi_tanya->childNodes->item(1);
					$r_pertanyaan[$nomor]['answer']=strtoupper(trim($isi->nodeValue));
				}
			}
		
		}
		
	}
	*/

$zip->close();
$kode_soal=$mysql->get1value("SELECT code FROM quiz_master WHERE id=".$_GET['id_soal']);	
$judul_soal=$mysql->get1value("SELECT title_id FROM quiz_master WHERE id=".$_GET['id_soal']);	
echo '
<div class="row-fluid">
	<div class="span12">
	<br/>
	<table>
	<tr><td>Kode Soal</td><td>:</td><td><b>'.$kode_soal.'</b></td></tr>
	<tr><td>Judul Soal</td><td>:</td><td><b>'.$judul_soal.'</b></td></tr>
	</table>
	</div>
	<br/>
</div>';

echo "<div class='info-soal alert alert-info'>
<p>
Untuk memasukkan soal kedalam database silahkan klik tombol setuju yang ada paling bawah.
</p>
</div>";
echo '<h1>PILIHAN GANDA</h1>';
echo "<table id='DataTables_Table_3_wrapper' class='quiz_detail  table table-hover table-nomargin table-bordered '>";
echo "
<thead>
<tr>
<th>No</th>

";
//<th>"._THUMBNAIL."</th>
echo "<th>"._PERTANYAAN."</th>";
echo "
</tr>
</thead>
";
$no=($start+1);

if(count($r_pertanyaan)>0)
{
echo '<tbody id="brand_row" class="ui-sortable">';
foreach($r_pertanyaan as $nomor => $d){
	
echo "
<tr id='list_{$d['id']}' class='rowmove'>
<td style='width:10px;'>$nomor</td>
";

echo "<td>".$d["PERTANYAAN"]."<br/>";
$option_pilihan="";
foreach($pilihan_ganda as $pil_gan) {
		if(strip_tags($d["$pil_gan"])!="-"){
		$option_pilihan.= "<li><span class='point_jawaban ".($d["KUNCI"]=="$pil_gan"?"jawaban":"")."'>$pil_gan</span><span class='hasil_jawaban'>".$d["$pil_gan"]."</span></li>";
		}
}
if($option_pilihan!=""){
echo "
Pilihan Jawaban
<ul class='pilihan_jawaban'>";
echo "$option_pilihan";
echo "</ul>";
}
if($mode_pembahasan==1) {
	echo '<br/><b>Pembahasan:</b><br/>';
	echo $d["PEMBAHASAN"];
	echo '<br/><br/>';
}
echo "</td>";
echo "</tr>";
$no++;
}
echo "</tbody>";
}
echo "</table>";

echo '<h1>ESSAY</h1>';
echo "<table id='DataTables_Table_3_wrapper' class='quiz_detail  table table-hover table-nomargin table-bordered '>";
echo "
<thead>
<tr>
<th style='width:10px;'>No</th>

";
//<th>"._THUMBNAIL."</th>
echo "<th>"._PERTANYAAN."</th>";
echo "
</tr>
</thead>
";
$no=($start+1);

if(count($r_essay)>0)
{
echo '<tbody id="brand_row" class="ui-sortable">';
foreach($r_essay as $nomor => $d){
	
echo "
<tr id='list_{$d['id']}' class='rowmove'>
<td>$nomor</td>
";

echo "<td>".$d["ESSAY"]."<br/>";
$option_pilihan="";
foreach($pilihan_kunci_essay as $kunci_essay) {
	if($d[$kunci_essay]!=""){
		$option_pilihan.="<div>".$d[$kunci_essay]."</div>";
	}
}
echo "<b>Kunci Jawaban:</b><br/>";
echo $option_pilihan;
echo "</tr>";
$no++;
}
echo "</tbody>";
}
echo "</table>";



echo "<form class='form-approve' method='post' action='".backendurl("$modul/approve?id_soal=".$_GET['id_soal'])."'>
<p>Soal belum masuk kedalam database, Apakah anda ingin menyetujui untuk memasukkan soal ini kedalam database?</p>
<input type='hidden' name='timpa' value='".($_POST['timpa']==1?1:0)."' /> 
<input type='hidden' name='file_wordx' value='$filename' >
<input type='hidden' name='id_soal' value='".$_GET['id_soal']."' >
<button class='btn btn-success' name='setuju' value='1' type='submit'>Saya Setuju </button>
</form>";
}else{
echo "<div class='info-soal alert alert-warning'>
File template yang di upload tidak cocok
</div>";
}
}
if($action=="display"){

/*Tell the browser that we want to display an image*/
 header('Content-Type: image/jpeg');


/*Create a new ZIP archive object*/
    $zip = new ZipArchive;

    /*Open the received archive file*/
    if (true === $zip->open($config['userdir'].'backend/modul/quiz_upload_wordx/backup/'.$_GET['filename'])) {


/*Get the content of the specified index of ZIP archive*/
 echo $zip->getFromIndex($_GET['index']);
 }

 $zip->close();
 exit();
}
?>
