<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', 2);

/*
if($_SESSION['f_id']==""){
	header("location:".fronturl("sekolah_login"));
	exit();
}
*/ 

define('_NAMA',"Judul Ujian");
define('_KELAS',"Kelas");
define('_NAMALENGKAP',"Nama Lengkap");
define('_KODE',"Kode Soal");
define('_SOAL',"Soal");
define('_DURASI',"Durasi");
define('_KONTEN',"Keterangan");
define('_PEKERJAAN',"Pekerjaan");
define('_TITLE',"Konten");
define('_GAGALADDIMAGE',"Gagal tambah image");
define('_GAGALADDTHUMBNAIL',"Gagal buat thumbnail");
define('_GAGALRESIZE',"Gagal resize");
define('_MODULTAMBAH',"Tambah jadwal");
define('_MODULEDIT',"Ubah jadwal");
define('_MODULCOPY',"Save As");
define('_BERHASILTAMBAH',"Berhasil tambah");
define('_GAGALADD',"Gagal tambah");
define('_BERHASILUPDATE',"Berhasil ubah");
define('_GAGALUPDATE',"Gagal ubah");
define('_BERHASILHAPUS',"Berhasil hapus");
define('_GAGALHAPUS',"Gagal hapus");
define('_EDIT',"Edit news");
define('_THUMBNAIL',"Thumbnail");
define('_KODESOAL',"Kode");
define('_TANGGAL',"Tanggal Uji");
define('_NAMASOAL',"Soal");
define('_RANDOM',"Acak");
define('_UJIANMULAI',"Mulai");
define('_TIDAK_JAWAB',"Tidak jawab");
define('_JAWABAN',"Jawaban");
define('_B',"Benar");
define('_S',"Salah");
define('_SCORE',"Skor");
define('_SALAH',"Jumlah Salah");
define('_PERSENTASE',"%");
define('_KET',"Ket");
define('_KKM',"KKM");
define('_LULUS',"Lulus");
define('_TIDAKLULUS',"Tidak Lulus");
define('_KODELOGIN',"Kode Login");
define('_CLASS',"Kelas");




$hariini=date("Y-m-d");
$hariini_long=date("Y-m-d H:i:s");
$quiz_id=$_GET['quiz_id'];
$date1=$_GET['date1'];
$date2=$_GET['date2'];


b_load_lib("PHPExcel/Classes/PHPExcel");
if($_GET['quiz_id']!="")
{

//error_reporting(E_ALL);
//ini_set('display_errors', false);
//ini_set('display_startup_errors', false);
date_default_timezone_set('Asia/Jakarta');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("rajaqr.com")
							 ->setLastModifiedBy("rajaqr.com")
							 ->setTitle("Ujian Online Berbasis Komputer")
							 ->setSubject("Ujian Online Berbasis Komputer")
							 ->setDescription("Ujian Online Berbasis Komputer")
							 ->setKeywords("Ujian Online Berbasis Komputer")
							 ->setCategory("Ujian Online Berbasis KOmputer");


//AMBIL KUNCI JAWABAN


	
	$kunci=array();
	$qkey=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id=$quiz_id");
	if($qkey and $mysql->numrows($qkey)>0){
		while($d=$mysql->assoc($qkey)){
			$kunci[$d['id']]=$d['answer'];
		}
	}
	
$join_kunci=join("",$kunci);	
//AMBIL KUNCI JAWABAN

//AMBIL KUNCI JAWABAN COMPLEX
$kunci_complex=array();
$qkey=$mysql->query("SELECT id,answer FROM quiz_complex WHERE quiz_id=$quiz_id");
if($qkey and $mysql->numrows($qkey)>0){
	while($d=$mysql->assoc($qkey)){
		$kunci_complex[$d['id']]=$d['answer'];
	}
}
//END AMBIL KUNCI JAWABAN COMPLEX
/////////////////////////////////////////



$sql="SELECT d.*,c.answer answer_complex FROM app_quiz_done d LEFT JOIN app_quiz_done_complex c ON d.id=c.id_quiz_done WHERE d.is_done=1 AND d.quiz_id='".$_GET['quiz_id']."'";




$sql.=" AND  date_format(d.start_time,'%Y-%m-%d') BETWEEN '$date1' AND '$date2' ";

$sql.="  order by d.member_code";

$data_ujian = $mysql->assoc($mysql->query($sql." limit 1"));

$r=$mysql->query($sql);
// Add some data
if($data_ujian['custom_score']==3) {
$data_kd=array();
$qkd=$mysql->query("SELECT id,title_id FROM quiz_kd WHERE quiz_id=".$data_ujian['quiz_id']);
if($qkd and $mysql->numrows($qkd)) {
	while($dkd = $mysql->assoc($qkd)) {
		$data_kd[]=$dkd;
	}
}
$panjang_kolom=count($data_kd);

$kolom=kolom_excel($panjang_kolom,"J");

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',_UJIANMULAI)
            ->setCellValue('B1',_KODELOGIN)
            ->setCellValue('C1',_NAMALENGKAP)
            ->setCellValue('D1',_KELAS)
            ->setCellValue('E1',_KODESOAL)
            ->setCellValue('F1',_NAMASOAL)
            ->setCellValue('G1',_B)
            ->setCellValue('H1',_S)
            ->setCellValue('I1',_TIDAK_JAWAB);
//            ->setCellValue('J1',_SCORE)
//            ->setCellValue('K1',_KKM)
//            ->setCellValue('L1',_KET)
$kolom_terakhir='';
foreach($kolom as $i => $nama) {
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($nama.'1',$data_kd[$i]['title_id']);
		$kolom_terakhir=$nama;
}

$kolom=kolom_excel(2,$kolom_terakhir);
$kolom_essay=end($kolom);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($kolom_essay.'1','Skor Essay');

$kolom=kolom_excel(2,$kolom_essay);
$kolom_total=end($kolom);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($kolom_total.'1','Total Skor');

$kolom=kolom_excel(2,$kolom_total);
$kolom_kkm=end($kolom);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($kolom_kkm.'1','KKM');

$kolom=kolom_excel(2,$kolom_kkm);
$kolom_ket=end($kolom);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($kolom_ket.'1','KET');


} else {
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',_UJIANMULAI)
            ->setCellValue('B1',_KODELOGIN)
            ->setCellValue('C1',_NAMALENGKAP)
            ->setCellValue('D1',_KELAS)
            ->setCellValue('E1',_KODESOAL)
            ->setCellValue('F1',_NAMASOAL)
            ->setCellValue('G1',_B)
            ->setCellValue('H1',_S)
            ->setCellValue('I1',_TIDAK_JAWAB)
            ->setCellValue('J1','Skor PG')
            ->setCellValue('K1','Skor Essay')
            ->setCellValue('L1','Total Skor')
            ->setCellValue('M1',_KKM)
            ->setCellValue('N1',_KET);
}
$no=1;
$quiz_date=$quiz_code=$quiz_title="";
while($d=$mysql->assoc($r))
{
    
    $quiz_title=$d['quiz_title_id'];
  
	$no++;
	$answer=str_replace("{","=",$d['answer']);
	$answer=str_replace("}","=",$answer);
	$temp_answer=json_decode($d['answer'],true);
		$r_answer=array();
		
		if(count($kunci)>0){	
			$index=0;
			foreach($kunci as $idsoal => $idsoal){
				$index+=1;
				
				//BANDINGKAN JAWABAN
				if($temp_answer[$index]!="" and $temp_answer[$index]==$kunci[$idsoal]){
					//BENAR
					$r_answer[]="".$temp_answer[$index]."";
				}elseif($temp_answer[$index]!="" and $temp_answer[$index]!=$kunci[$idsoal]){
					//SALAH
					$r_answer[]="".$temp_answer[$index]."";
				}else{
					//TAK JAWAB
					$r_answer[]="".$temp_answer[$index]."";
				}
				//END BANDINGKAN JAWABAN
			}
			
		}

$json_answer=join("",$r_answer);	
	
	if($data_ujian['custom_score']==3) {
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$no,$d['start_time'])
            ->setCellValue('B'.$no," ".$d['member_code'])
            ->setCellValue('C'.$no,$d['member_fullname'])
            ->setCellValue('D'.$no,$d['member_class'])
            ->setCellValue('E'.$no,$d['quiz_code'])
            ->setCellValue('F'.$no,$d['quiz_title_id'])
            ->setCellValue('G'.$no,$d['benar'])
            ->setCellValue('H'.$no,$d['salah'])
            ->setCellValue('I'.$no,$d['tidak_jawab']);
        
		$kolom=kolom_excel($panjang_kolom,"J");
		$lulus=1;
        $nilai_kd=array();
        $kkm_kd=array();
        $q_nilai_kd = $mysql->query("SELECT id_quiz_kd,score,kkm FROM app_quiz_done_kd WHERE id_quiz_done=".$d['id']);    
        if($q_nilai_kd and $mysql->numrows($q_nilai_kd)>0) {
			while($d_nilai_kd = $mysql->assoc($q_nilai_kd)) {
				$nilai_kd[$d_nilai_kd['id_quiz_kd']]=$d_nilai_kd['score'];
				$kkm_kd[$d_nilai_kd['id_quiz_kd']]=$d_nilai_kd['kkm'];
			}
		}
		
		$kolom_terakhir='';
		foreach($kolom as $i => $nama) {
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($nama.$no,$nilai_kd[$data_kd[$i]['id']]);
				if($nilai_kd[$data_kd[$i]['id']] < $kkm_kd[$data_kd[$i]['id']]) {
				$lulus=0;
				$objPHPExcel->getActiveSheet()->getStyle($nama.$no)->getFont()->getColor()->setRGB('BB0000');
				}
				$kolom_terakhir=$nama;
		}	
		
		
		$kolom=kolom_excel(2,$kolom_terakhir);
		$kolom_skor_essay=end($kolom);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($kolom_skor_essay.$no,$d['score_essay']);
		
		$kolom=kolom_excel(2,$kolom_skor_essay);
		$kolom_total=end($kolom);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($kolom_total.$no,$d['score']+$d['score_essay']);
		
		if(($d['score']+$d['score_essay'])<$d['kkm']) {
			$lulus=0;
		}
		if($lulus==0) {
			$objPHPExcel->getActiveSheet()->getStyle($kolom_total.$no)->getFont()->getColor()->setRGB('BB0000');
		}
		$kolom=kolom_excel(2,$kolom_total);
		$kolom_kkm=end($kolom);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($kolom_kkm.$no,$d['kkm']);

		$ket=($lulus==1?_LULUS:_TIDAKLULUS);
		$kolom=kolom_excel(2,$kolom_kkm);
		$kolom_ket=end($kolom);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($kolom_ket.$no,$ket);

   
   } else {
	$ket=(($d['score']+$d['score_essay'])>=$d['kkm']?_LULUS:_TIDAKLULUS);
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$no,$d['start_time'])
            ->setCellValue('B'.$no," ".$d['member_code'])
            ->setCellValue('C'.$no,$d['member_fullname'])
            ->setCellValue('D'.$no,$d['member_class'])
            ->setCellValue('E'.$no,$d['quiz_code'])
            ->setCellValue('F'.$no,$d['quiz_title_id'])
            ->setCellValue('G'.$no,$d['benar'])
            ->setCellValue('H'.$no,$d['salah'])
            ->setCellValue('I'.$no,$d['tidak_jawab'])
            ->setCellValue('J'.$no,$d['score'])
            ->setCellValue('K'.$no,$d['score_essay'])
            ->setCellValue('L'.$no,$d['score']+$d['score_essay'])
            ->setCellValue('M'.$no,$d['kkm'])
            ->setCellValue('N'.$no,$ket);
   }
   $objPHPExcel->getActiveSheet()
    ->getStyle("B".$no)
    ->getNumberFormat()
    ->setFormatCode(
        PHPExcel_Style_NumberFormat::FORMAT_GENERAL
    );         
}



$filename="{$date1}_{$date2}_{$quiz_title}";

$filename=cleanInput($filename,"field_name");
$sheet_title="Nilai";
$sheet_title=cleanInput($sheet_title,"field_name");

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($sheet_title);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
//

////////////////////////////////////////JAWABAN SISWA

$sheet = $objPHPExcel->getActiveSheet();
// Add new sheet
$objWorkSheet = $objPHPExcel->createSheet(1); //Setting index when creating
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
//AMBIL KUNCI JAWABAN

	$kunci=array();
	$qkey=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id=".$quiz_id);
	if($qkey and $mysql->numrows($qkey)>0){
		while($d=$mysql->assoc($qkey)){
			$kunci[$d['id']]=$d['answer'];
		}
	}
	
$join_kunci=join("",$kunci);	

//AMBIL KUNCI JAWABAN


$sql="SELECT d.*,c.answer answer_complex FROM app_quiz_done d LEFT JOIN app_quiz_done_complex c ON d.id=c.id_quiz_done WHERE d.is_done=1 AND d.quiz_id='".$_GET['quiz_id']."'";
$sql.=" AND  date_format(d.start_time,'%Y-%m-%d') BETWEEN '$date1' AND '$date2' ";
$sql.="  order by d.member_code";
 
$r=$mysql->query($sql);


/*
$objWorkSheet->setCellValue('A1', 'No')
		   ->setCellValue('B1', _KODELOGIN)
		   ->setCellValue('C1', _NAMALENGKAP)
		   ->setCellValue('D1', _SCORE)
		   ->setCellValue('E1',"");
*/
$objPHPExcel->getActiveSheet()->mergeCells('A1:K1');
$objWorkSheet->setCellValue('A1', 'ANALISIS JAWABAN '.$quiz_title);
$objPHPExcel->getActiveSheet()->getStyle("A1:F1")->getFont()->setSize(18)->getColor()->setRGB('0000BB');
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
$panjang=count($kunci);
$kolom=kolom_excel($panjang,"E");
$panjang_complex=count($kunci_complex);
$kolom_akhir=kolom_excel(2,end($kolom));
$kolom_complex=kolom_excel($panjang_complex,end($kolom_akhir));

$nomor=1;
foreach($kolom as $a =>$k){
	$objWorkSheet->setCellValue($k.'2', $nomor);
	//$objPHPExcel->getActiveSheet()->getColumnDimension('A1:'.$kolom_terakhir.'1')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->getColumnDimension($k)->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->getStyle($k.'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$nomor++;
}

foreach($kolom_complex as $a =>$k){
	$objWorkSheet->setCellValue($k.'2', $nomor);
	//$objPHPExcel->getActiveSheet()->getColumnDimension('A1:'.$kolom_terakhir.'1')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->getColumnDimension($k)->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->getStyle($k.'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$nomor++;
}
$kolom_all=kolom_excel(4+$panjang+$panjang_complex,"A");
$objPHPExcel->getActiveSheet()->getStyle('C8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF79DE56');
$objPHPExcel->getActiveSheet()->getStyle('C8')->getAlignment()->setWrapText(true);
$kolom_terakhir="";
foreach($kolom_all as $a =>$k){
	
	$objPHPExcel->getActiveSheet()->getStyle($k.'6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFAFF17');
	$objPHPExcel->getActiveSheet()->getStyle($k.'7')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFAFF17');
	$objPHPExcel->getActiveSheet()->getStyle($k.'9')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF84CFDD');
	$kolom_terakhir=$k;
}
$objPHPExcel->getActiveSheet()->mergeCells('E9:'.$kolom_terakhir.'9');
$objWorkSheet->setCellValue('E9', 'JAWABAN PESERTA');
$objPHPExcel->getActiveSheet()->getStyle('E9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getRowDimension('8')->setRowHeight(50);
$objPHPExcel->getActiveSheet()->getStyle('B8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$objPHPExcel->getActiveSheet()->getRowDimension('9')->setRowHeight(35);
$objPHPExcel->getActiveSheet()->getStyle('A9:'.$kolom_terakhir.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objWorkSheet->setCellValue('A2', '')
		   ->setCellValue('B2', '')
		   ->setCellValue('C2', '')
		   ->setCellValue('D2', '');
		   

$i=0;		   
foreach($kunci as $a =>$k){
	$objWorkSheet->setCellValue($kolom[$i].'3', $k);
	$objPHPExcel->getActiveSheet()->getStyle($kolom[$i].'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$i++;	
}
$i=0;	
foreach($kunci_complex as $a =>$k){
	$objWorkSheet->setCellValue($kolom_complex[$i].'3', $k);
	$objPHPExcel->getActiveSheet()->getStyle($kolom_complex[$i].'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$i++;	
}

$objWorkSheet->setCellValue('A3', '')
		   ->setCellValue('B3', '')
		   ->setCellValue('C3', '')
		   ->setCellValue('D3', '');
/*ambil persentase*/		   
$data_persen=persentase_jawaban_app();
$data_persen_complex=persentase_jawaban_app_complex();
/*end ambil persentase*/		   
$i=0;
$nomor_soal=1;
foreach($kunci as $a =>$k){
	$objWorkSheet->setCellValue($kolom[$i].'4', $data_persen[$nomor_soal]['jawab_benar']);
	$objWorkSheet->setCellValue($kolom[$i].'5', $data_persen[$nomor_soal]['jawab_salah']);
	$objWorkSheet->setCellValue($kolom[$i].'6', $data_persen[$nomor_soal][$k]."%");
	$objWorkSheet->setCellValue($kolom[$i].'7', (100-$data_persen[$nomor_soal][$k])."%");
	$tuntas=(100-$data_persen[$nomor_soal][$k])>25?"TT":"";
	if($tuntas=="TT"){
		$objPHPExcel->getActiveSheet()->getStyle($kolom[$i].'8')->getFont()->getColor()->setRGB('FFFFFF');
		$objPHPExcel->getActiveSheet()->getStyle($kolom[$i].'8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');
	}else{
		$objPHPExcel->getActiveSheet()->getStyle($kolom[$i].'8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF79DE56');
	}
	
	$objWorkSheet->setCellValue($kolom[$i].'8',$tuntas) ;
	$objPHPExcel->getActiveSheet()->getStyle($kolom[$i].'4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($kolom[$i].'5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($kolom[$i].'6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($kolom[$i].'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($kolom[$i].'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	
	$i++;	
	$nomor_soal++;	
}
$i=0;
foreach($kunci_complex as $a =>$k){
	
	$objWorkSheet->setCellValue($kolom_complex[$i].'4', $data_persen_complex[$i+1]['jawab_benar']);
	$objWorkSheet->setCellValue($kolom_complex[$i].'5', $data_persen_complex[$i+1]['jawab_salah']);
	$objWorkSheet->setCellValue($kolom_complex[$i].'6', $data_persen_complex[$i+1][$k]."%");
	$objWorkSheet->setCellValue($kolom_complex[$i].'7', (100-$data_persen_complex[$i+1][$k])."%");
	$tuntas=(100-$data_persen_complex[$i+1][$k])>25?"TT":"";
	if($tuntas=="TT"){
		$objPHPExcel->getActiveSheet()->getStyle($kolom_complex[$i].'8')->getFont()->getColor()->setRGB('FFFFFF');
		$objPHPExcel->getActiveSheet()->getStyle($kolom_complex[$i].'8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');
	}else{
		$objPHPExcel->getActiveSheet()->getStyle($kolom_complex[$i].'8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF79DE56');
	}
	
	$objWorkSheet->setCellValue($kolom_complex[$i].'8',$tuntas) ;
	$objPHPExcel->getActiveSheet()->getStyle($kolom_complex[$i].'4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($kolom_complex[$i].'5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($kolom_complex[$i].'6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($kolom_complex[$i].'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($kolom_complex[$i].'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	
	$i++;	
	$nomor_soal++;	
}

/*
foreach($kolom as $a =>$k){
	$objWorkSheet->setCellValue($k.'2', $kunci[$a]);
}
*/ 

$objWorkSheet->setCellValue('A9', 'No')
		   ->setCellValue('B9', _KODELOGIN)
		   ->setCellValue('C9', _NAMALENGKAP)
		   ->setCellValue('D9', _SCORE);
		    

$no=1;
$baris_excel=10;
$tandai_warna=array();
while($d=$mysql->assoc($r))
{
		$objWorkSheet->setCellValue('A'.$baris_excel, $no)
		   ->setCellValue('B'.$baris_excel, $d['member_code'])
		   ->setCellValue('C'.$baris_excel, $d['member_fullname'])
		   ->setCellValue('D'.$baris_excel, $d['score']);
	
		$temp_answer=json_decode($d['answer'],true);
		$r_answer=array();
		$c_answer=array();
		if(count($kunci)>0){	
			$index=0;
			foreach($kunci as $idsoal => $kunci_abjad){
				$index+=1;
				
				//BANDINGKAN JAWABAN
				if($temp_answer[$index]!="" and $temp_answer[$index]==$kunci[$idsoal]){
					$c_answer[$index]="benar";
				
				}elseif($temp_answer[$index]!="" and $temp_answer[$index]!=$kunci[$idsoal]){
					$c_answer[$index]="salah";
				
				}else{
					$c_answer[$index]="salah";
				
				}
				$r_answer[$index]=$temp_answer[$index];
				//END BANDINGKAN JAWABAN
			}
			
		
		   
			$no++;

			$nomor=1;
			
			
			foreach($kolom as $a =>$k){
			//var_dump($k);	
				$objWorkSheet->setCellValue($k.$baris_excel, $r_answer[$a+1]);
				if($c_answer[$a+1]=="salah"){
					$tandai_warna[]=array("0"=>"{$k}$baris_excel","1"=>"FF0000");
				}else{
					//var_dump($c_answer[$a+1]);
					$tandai_warna[]=array("0"=>"{$k}$baris_excel","1"=>"00FF00");
				}
				$nomor++;
			}
			
			//$baris_excel++;		
		}

		$temp_answer_complex=json_decode($d['answer_complex'],true);
		
		$r_answer_complex=array();
		$c_answer_complex=array();
		if(count($kunci_complex)>0){	
			$index=0;
			foreach($kunci_complex as $idsoal => $kunci_abjad){
				$index+=1;
				
				//BANDINGKAN JAWABAN
				if($temp_answer_complex[$idsoal]!="" and $temp_answer_complex[$idsoal]==$kunci_complex[$idsoal]){
					$c_answer_complex[$idsoal]="benar";
				
				}elseif($temp_answer_complex[$index]!="" and $temp_answer_complex[$idsoal]!=$kunci_complex[$idsoal]){
					$c_answer_complex[$idsoal]="salah";
				
				}else{
					$c_answer_complex[$idsoal]="salah";
				
				}
				$r_answer_complex[$index]=$temp_answer_complex[$idsoal];
				//END BANDINGKAN JAWABAN
			}
			
		
		 
			$no++;

			//$nomor=1;
			
			
			foreach($kolom_complex as $a =>$k){
			
				$objWorkSheet->setCellValue($k.$baris_excel, $r_answer_complex[$a+1]);
				if($c_answer_complex[$a+1]=="salah"){
					$tandai_warna[]=array("0"=>"{$k}$baris_excel","1"=>"FF0000");
				}else{
					//var_dump($c_answer_complex[$a+1]);
					$tandai_warna[]=array("0"=>"{$k}$baris_excel","1"=>"00FF00");
				}
				$nomor++;
			}
			
			
		}
		$baris_excel++;		
}		


$objPHPExcel->getActiveSheet()->mergeCells('A2:B8');
$objPHPExcel->getActiveSheet()->setCellValue('A2', 'HASIL ANALISIS JAWABAN SISWA');
$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("A2:B8")->getFont()->setSize(16)->getColor()->setRGB('FF0000');
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('C2:C8')->getAlignment()->setIndent(3);

$objPHPExcel->getActiveSheet()->setCellValue('C2', 'Nomor Soal')->getStyle('C2')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Kunci Jawaban')->getStyle('C3')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->setCellValue('C4', '(B) siswa menjawab benar')->getStyle('C4')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->setCellValue('C5', '(S) siswa menjawab salah')->getStyle('C5')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->setCellValue('C6', '% siswa menjawab benar')->getStyle('C6')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->setCellValue('C7', '% siswa menjawab salah')->getStyle('C7')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->setCellValue('C8', 'Ketuntasan Indikator
 *TT = Indikator yang tidak tuntas dan harus diremidi')->getStyle('C8')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->mergeCells('C2:D2')->getStyle('A2')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->mergeCells('C3:D3');
$objPHPExcel->getActiveSheet()->mergeCells('C4:D4');
$objPHPExcel->getActiveSheet()->mergeCells('C5:D5');
$objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
$objPHPExcel->getActiveSheet()->mergeCells('C7:D7');
$objPHPExcel->getActiveSheet()->mergeCells('C8:D8');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->freezePane('E10');
// Rename sheet
foreach($tandai_warna as $i =>$v){	
	//die($v[0]);
	$objPHPExcel->getActiveSheet()->getStyle($v[0])->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF'.$v[1]);
	$objPHPExcel->getActiveSheet()->getStyle($v[0])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}

/** Borders for all data */
   for($i=1;$i<=$objPHPExcel->getActiveSheet()->getHighestRow();$i++){
	if($i==1 or $i==8 or $i==9){
	continue;
	}
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(15);
   }
   $objPHPExcel->getActiveSheet()->getStyle(
    'A2:' . 
    $objPHPExcel->getActiveSheet()->getHighestColumn() . 
    $objPHPExcel->getActiveSheet()->getHighestRow()
)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$objPHPExcel->getActiveSheet()->getStyle('B9:D'.$objPHPExcel->getActiveSheet()->getHighestRow())->getAlignment()->setIndent(1);

$objWorkSheet->setTitle("Jawaban PG");

////////////////////////////////////////END JAWABAN SISWA


////////////////////////////////////////ANALISA
//KPI MINTA DIMATIKAN 
$sheet = $objPHPExcel->getActiveSheet();
// Add new sheet
$objWorkSheet = $objPHPExcel->createSheet(2); //Setting index when creating
$objPHPExcel->setActiveSheetIndex(2);


$schedule_id=cleanInput($_GET['schedule_id']);	
$member_salah=array();	
$data_member=array();
$final_salah=array();
$final_tidak_jawab=array();
$final_benar=array();
$kunci=array();


//AMBIL KUNCI JAWABAN	
	$qkey=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id=$quiz_id");
	if($qkey and $mysql->numrows($qkey)>0){
		while($d=$mysql->assoc($qkey)){
			$kunci[$d['id']]=$d['answer'];
		}
	}
//END AMBIL KUNCI JAWABAN

$sql="SELECT * FROM quiz_done  WHERE is_done=1 AND schedule_id='".$schedule_id."' AND member_class='".cleanInput($_GET['class'])."' ORDER BY score DESC";

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
		//$temp_acak=explode(",",$d['acak']);
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

	if(count($member_salah)>0){
	$json_member=json_encode($member_salah);
	$insert=$mysql->query("REPLACE INTO quiz_analize(schedule_id,json_member) values ('$schedule_id','$json_member')");
	}
	
}

$nama_quiz=$mysql->get1value("SELECT concat(code,' ',title_id) judul FROM quiz_master WHERE id='$quiz_id'");
$jumlah_soal=count($kunci);


$objWorkSheet->setCellValue('A1', 'Item')
			->setCellValue('B1', 'A')
			->setCellValue('C1', 'B')
			->setCellValue('D1', 'C')
			->setCellValue('E1', 'D')
			->setCellValue('F1', 'E')
			->setCellValue('G1', '?')
			->setCellValue('H1', 'Daya Pembeda')
			->setCellValue('I1', 'Tingkat Kesulitan')
			->setCellValue('J1', 'Efektifitas Option')
			->setCellValue('K1', 'Status Soal');

$kunci_nomor=array();
if(count($kunci)>0){	
	$index=0;
	foreach($kunci as $idsoal => $idsoal){
	$index+=1;
	$kunci_nomor[$index]=$kunci[$idsoal];
	}			
}

$jumlah_member_terpilih=count($member_terpilih);
$rata_rata_benar=round(array_sum($score_individu)/count($score_individu),2);

$std_benar=round(sd($score_individu),2);

$total_score=array_sum($final_benar);
$propc=array();
$jawab_prope=array();
$p_x_q=array();
$kunci_warna=array();

foreach($final_salah as $i => $v)
{
$r_mean=array();
$mean=0;
if(count($peta_biner[$i])>0){
	$jml_biner=count($peta_biner[$i]);
	foreach($peta_biner[$i] as $x => $member_id){
		$r_mean[]=$score_individu[$member_id];
	}
	$mean=round(array_sum($r_mean)/count($r_mean),2);
}

$p=round(($final_benar[$i]==$jumlah_member_terpilih?$final_benar[$i]-1:$final_benar[$i])/$jumlah_member_terpilih,2);

$q=1-$p;
$sqrt_p_q=round(sqrt(($p/$q)),2);

$r_pBis=round((($mean-$rata_rata_benar)/$std_benar)*$sqrt_p_q,2);
$ordinat_y=round((1/sqrt(2*pi()))*exp(-0.5*$p),4);
$r_Bis=round((($mean-$rata_rata_benar)/$std_benar)*($p/$ordinat_y),2);
$p_x_q[]=round($p*$q,2);

/**/
//statistic option	

$jawab_prope[$i]["A"]=round($jawab[$i]["A"]/$jumlah_member_terpilih,2)*100;	
$jawab_prope[$i]["B"]=round($jawab[$i]["B"]/$jumlah_member_terpilih,2)*100;	
$jawab_prope[$i]["C"]=round($jawab[$i]["C"]/$jumlah_member_terpilih,2)*100;	
$jawab_prope[$i]["D"]=round($jawab[$i]["D"]/$jumlah_member_terpilih,2)*100;	
$jawab_prope[$i]["E"]=round($jawab[$i]["E"]/$jumlah_member_terpilih,2)*100;
$out=(($jumlah_member_terpilih-($jawab[$i]["A"]+$jawab[$i]["B"]+$jawab[$i]["C"]+$jawab[$i]["D"]+$jawab[$i]["E"]))/$jumlah_member_terpilih)*100;	

$jawab_prope[$i]["out"]=round($out,2);	
$jawab_max=$jawab_prope[$i][$kunci_nomor[$i]];
$efektifitas_option=(
$jawab_max<$jawab_prope[$i]["A"] OR 
$jawab_max<$jawab_prope[$i]["B"] OR 
$jawab_max<$jawab_prope[$i]["C"] OR 
$jawab_max<$jawab_prope[$i]["D"] OR 
$jawab_max<$jawab_prope[$i]["E"] OR 
$jawab_max<$jawab_prope[$i]["out"])?
"Ada Option lain yang bekerja lebih baik":"Baik";
//end statistic option

$jumlah_benar=($correct['upper'][$i]+$correct['middle'][$i]+$correct['lower'][$i]);
$propc[$i]=$jumlah_benar>=$jumlah_member_terpilih?(($jumlah_benar-1)/$jumlah_member_terpilih):($jumlah_benar/$jumlah_member_terpilih);
$daya_pembeda=$r_Bis>0.21?"Dapat Membedakan":"Tidak dapat membeda- kan";
$tingkat_kesulitan=$propc[$i]>=0.7?"Mudah":(($propc[$i]>0.3 AND $propc[$i]<0.7)?"Sedang":"Sulit");
$point_pembeda=$r_Bis>0.21?1:-2;
$point_tk=($propc[$i]==1 OR $propc[$i]==0)?0:1;

$point_efektif=(
$jawab_max<$jawab_prope[$i]["A"] OR 
$jawab_max<$jawab_prope[$i]["B"] OR 
$jawab_max<$jawab_prope[$i]["C"] OR 
$jawab_max<$jawab_prope[$i]["D"] OR 
$jawab_max<$jawab_prope[$i]["E"] OR 
$jawab_max<$jawab_prope[$i]["out"])?0:1;


$total_point=($point_pembeda+$point_tk+$point_efektif);
$status_soal=$total_point>2?"Dapat diterima":(($total_point>0 AND $total_point<=2)?"Soal sebaiknya Direvisi":"Ditolak/ Jangan Digunakan");


$objWorkSheet->setCellValue('A'.($i+1),"Pertanyaan $i")
		   ->setCellValue('B'.($i+1), round($jawab_prope[$i]["A"],3)."%")
		   ->setCellValue('C'.($i+1), round($jawab_prope[$i]["B"],3)."%")
		   ->setCellValue('D'.($i+1), round($jawab_prope[$i]["C"],3)."%")
		   ->setCellValue('E'.($i+1), round($jawab_prope[$i]["D"],3)."%")
		   ->setCellValue('F'.($i+1), round($jawab_prope[$i]["E"],3)."%")
		   ->setCellValue('G'.($i+1), round($jawab_prope[$i]["out"],3)."%")
		   ->setCellValue('H'.($i+1), $daya_pembeda)
		   ->setCellValue('I'.($i+1), $tingkat_kesulitan)
		   ->setCellValue('J'.($i+1), $efektifitas_option)
		   ->setCellValue('K'.($i+1), $status_soal) ;

		   
	if($kunci_nomor[$i]=="A"){$kunci_warna[]=array("0"=>"B".($i+1),1=>"FF00FF00");}	   
	if($kunci_nomor[$i]=="B"){$kunci_warna[]=array("0"=>"C".($i+1),1=>"FF00FF00");}	   
	if($kunci_nomor[$i]=="C"){$kunci_warna[]=array("0"=>"D".($i+1),1=>"FF00FF00");}	   
	if($kunci_nomor[$i]=="D"){$kunci_warna[]=array("0"=>"E".($i+1),1=>"FF00FF00");}	   
	if($kunci_nomor[$i]=="E"){$kunci_warna[]=array("0"=>"F".($i+1),1=>"FF00FF00");}	   
}
$reabilitas=round($jumlah_soal/($jumlah_soal-1)*(1-(array_sum($p_x_q)/pow($std_benar,2))),3);
foreach($kunci_warna as $i =>$v){	
	
	$objPHPExcel->getActiveSheet()->getStyle($v[0])->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB($v[1]);
	$objPHPExcel->getActiveSheet()->getStyle($v[0])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}

// Rename sheet
$objWorkSheet->setTitle("Analisa PG");
////////////////////////////////////////END ANALISA
////////////////////////////////////////JAWABAN ESSAY

$sheet = $objPHPExcel->getActiveSheet();
// Add new sheet
$objWorkSheet = $objPHPExcel->createSheet(3); //Setting index when creating
$objPHPExcel->setActiveSheetIndex(3);



$jumlah_soal_essay = $mysql->get1value("SELECT count(id) FROM quiz_essay WHERE quiz_id = ".$quiz_id);
$master_essay = $mysql->query_data("SELECT id FROM quiz_essay WHERE quiz_id= ".$quiz_id." ORDER BY id ");
$objWorkSheet->setCellValue('A1', 'Kode'); 
$objWorkSheet->setCellValue('B1', 'Nama'); 
$objWorkSheet->setCellValue('C1', 'Skor'); 
$r_kolom=kolom_excel($jumlah_soal_essay,$mulai="D");
foreach($r_kolom as $a =>$k){
 $objWorkSheet->setCellValue($k.'1', 'Soal '.($a+1));
}

//anchor
$sql="SELECT * FROM app_quiz_done  WHERE is_done=1 AND quiz_id='".$quiz_id."' AND  date_format(start_time,'%Y-%m-%d') BETWEEN '$date1' AND '$date2'  ORDER BY score DESC";
$r=$mysql->query($sql);
if($r and $mysql->numrows($r)) {
	$jumlah_peserta=$mysql->numrows($r);
	
	$i=2;
	while($d=$mysql->assoc($r)) {
		
		$objWorkSheet->setCellValue('A'.$i,$d['member_code']); 
		$objWorkSheet->setCellValue('B'.$i,$d['member_fullname']); 
		$objWorkSheet->setCellValue('C'.$i,$d['score_essay']); 
		$r_kolom=kolom_excel($jumlah_soal_essay,$mulai="D");
		$q_essay=$mysql->query("SELECT answer,id_quiz_essay FROM app_ quiz_done_essay WHERE id_quiz_done ='".$d['id']."' ");
		$isian_essay = array();
		if($q_essay AND $mysql->numrows($q_essay)>0) {
			while($r_isian_essay = $mysql->assoc($q_essay)) {
				$isian_essay[$r_isian_essay['id_quiz_essay']]=$r_isian_essay['answer'];
			}
		}
		foreach($r_kolom as $a =>$k){
			$id_essay = $master_essay[$a]['id'];
			$objWorkSheet->setCellValueExplicit($k.$i, $isian_essay[$id_essay]!=''?$isian_essay[$id_essay]:'-');
			$objPHPExcel->getActiveSheet()->getStyle($k.$i)->getAlignment()->applyFromArray(
     array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_FILL)
    );
		}

	$i++;
	}
	
}




// Rename sheet
$objWorkSheet->setTitle("Jawaban Essay");


for ($i = 'A'; $i <=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}

$objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

$objPHPExcel->setActiveSheetIndex(1);
for ($i = 'A'; $i <=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}
$objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);


$objPHPExcel->setActiveSheetIndex(0);
for ($i = 'A'; $i <=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}
$objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

    
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.stripslashes($filename).'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$t=ob_get_clean();
ob_start();
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

exit;

}
$t=ob_get_clean();
die($t);
?>
