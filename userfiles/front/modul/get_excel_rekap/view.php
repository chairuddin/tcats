<?php
if($_SESSION['f_id']==""){
	header("location:".fronturl("sekolah_login"));
	exit();
}
define(_NAMA,"Judul Ujian");
define(_KELAS,"Kelas");
define(_NAMALENGKAP,"Nama Lengkap");
define(_KODE,"Kode Soal");
define(_SOAL,"Soal");
define(_TANGGAL,"Tanggal Uji");
define(_DURASI,"Durasi");
define(_KONTEN,"Keterangan");
define(_PEKERJAAN,"Pekerjaan");
define(_TITLE,"Konten");
define(_KODESOAL,"Kode");
define(_TANGGAL,"Tanggal Uji");
define(_NAMASOAL,"Soal");
define(_RANDOM,"Acak");
define(_UJIANMULAI,"Mulai");
define(_TIDAK_JAWAB,"Tidak jawab");
define(_JAWABAN,"Jawaban");
define(_B,"Benar");
define(_S,"Salah");
define(_SCORE,"Skor");
define(_SALAH,"Jumlah Salah");
define(_PERSENTASE,"%");
define(_KET,"Ket");
define(_KKM,"KKM");
define(_LULUS,"Lulus");
define(_TIDAKLULUS,"Tidak Lulus");
define(_KODELOGIN,"Kode Login");
define(_CLASS,"Kelas");




$hariini=date("Y-m-d");
$hariini_long=date("Y-m-d H:i:s");
ob_start();
b_load_lib("PHPExcel/Classes/PHPExcel");

{

error_reporting(E_ALL);
ini_set('display_errors', false);
ini_set('display_startup_errors', false);
date_default_timezone_set('Asia/Jakarta');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("websuka.com")
							 ->setLastModifiedBy("websuka.com")
							 ->setTitle("Ujian Online Berbasis Komputer")
							 ->setSubject("Ujian Online Berbasis Komputer")
							 ->setDescription("Ujian Online Berbasis Komputer")
							 ->setKeywords("Ujian Online Berbasis Komputer")
							 ->setCategory("Ujian Online Berbasis KOmputer");





//ambil data kelas
$data_kelas=array();
$q=$mysql->query("SELECT id,nama FROM quiz_school_class WHERE school_id=".$_SESSION['f_id']);
if($q and $mysql->numrows($q)>0){
	while($d=$mysql->assoc($q)){
	$id_kelas[]=$d['id'];	
	$data_kelas[$d['id']]=$d['nama'];	
	}
}
$index_sheet=0;
foreach($data_kelas as $id_kelas => $kelas)
{

$objPHPExcel->createSheet($index_sheet); //Setting index when creating
$objPHPExcel->setActiveSheetIndex($index_sheet);

//ambil data id kelas
//$id_kelas=$id;	
//$kelas=$data_kelas[$id_kelas];

//ambil data jadwal
$r_schedule_id=array();
$sql=array();

	
$q_jadwal=$mysql->query("
SELECT q.id,date_format(q.tanggal,'%Y-%m-%d') tanggal,q.tanggal_expired,q.quiz_id,m.title_id FROM quiz_schedule q LEFT join quiz_master m ON q.quiz_id=m.id  WHERE FIND_IN_SET('$kelas',q.allow_class)  
");
if($q_jadwal and $mysql->numrows($q_jadwal)>0){
	while($d_jadwal=$mysql->assoc($q_jadwal)){
		$r_schedule_id[]=array("kelas"=>$v,"schedule_id"=>$d_jadwal['id'],"tanggal"=>$d_jadwal['tanggal'],"expired"=>$d_jadwal['tanggal_expired'],"quiz_id"=>$d_jadwal['quiz_id'],"quiz_title"=>$d_jadwal['title_id']);		
	}
}

//ambil data siswa	
	$data_siswa=$mysql->query_data("SELECT id,username,fullname FROM quiz_member WHERE class='$kelas' ORDER BY fullname ","id");

//ambil nilai per jadwal
	$data_ujian=array();
	foreach($r_schedule_id as $i =>$jadwal){
		$data_ujian[$jadwal['schedule_id']]=$mysql->query_data("SELECT id,score,member_id FROM quiz_done WHERE schedule_id=".$jadwal['schedule_id'],"member_id");
	}
//rata2	
	$hasil_akhir=array();	
	$total_rata2=array();
	$ranking=array();
	foreach($data_siswa as $x => $siswa){
		foreach($r_schedule_id as $i =>$jadwal){
				$rata2[$siswa['id']][]=$data_ujian[$jadwal['schedule_id']][$siswa['id']]['score'];
		}
		$total_rata2[$siswa['id']]=round(array_sum($rata2[$siswa['id']])/count($r_schedule_id),2);
		$ranking_rata2[]=$total_rata2[$siswa['id']];
	}
//peringkat

$rankings = array_unique($ranking_rata2);
rsort($rankings);
$return = array();
foreach($total_rata2 as $i => $value)
{	
    $rankedValue = array();
    $rankedValue['value'] = $value;
    $rankedValue['rank'] = array_search($value, $rankings) + 1;
    $return[] = $rankedValue;
    $peringkat[$i]=$rankedValue['rank'];
}





$objPHPExcel->setActiveSheetIndex($index_sheet)
            ->setCellValue('A1',"No")
            ->setCellValue('B1',"No Peserta")
            ->setCellValue('C1',"Nama");

$panjang=count($r_schedule_id)+2;
$kolom=kolom_excel($panjang,"D");

	
$index=0;
foreach($r_schedule_id as $i =>$jadwal){
$objPHPExcel->setActiveSheetIndex($index_sheet)
            ->setCellValue($kolom[$index].'1', clean_quiz_title($jadwal['quiz_title']));
$index++;
}

$objPHPExcel->setActiveSheetIndex($index_sheet)
            ->setCellValue($kolom[$index].'1', "Rata2");
$index++;
$objPHPExcel->setActiveSheetIndex($index_sheet)
            ->setCellValue($kolom[$index].'1', "Peringkat");

//////////////////////////////////////////////////
$nomor=0;
$rata2=array();
$baris_excel=2;

foreach($data_siswa as $x => $siswa){
	$nomor++;
	$objPHPExcel->setActiveSheetIndex($index_sheet)
				->setCellValue('A'.$baris_excel,$nomor)
				->setCellValue('B'.$baris_excel,' '.$siswa['username'])
				->setCellValue('C'.$baris_excel,$siswa['fullname']);

	$index=0;
	foreach($r_schedule_id as $i =>$jadwal){
		$rata2[$siswa['id']][]=$data_ujian[$jadwal['schedule_id']][$siswa['id']]['score'];
		$objPHPExcel->setActiveSheetIndex($index_sheet)
				->setCellValue($kolom[$index].$baris_excel, $data_ujian[$jadwal['schedule_id']][$siswa['id']]['score']);
	$index++;
	}
	$objPHPExcel->setActiveSheetIndex($index_sheet)
				->setCellValue($kolom[$index].$baris_excel, $total_rata2[$siswa['id']]);
	$index++;
	$objPHPExcel->setActiveSheetIndex($index_sheet)
				->setCellValue($kolom[$index].$baris_excel, $peringkat[$siswa['id']]);
	$objPHPExcel->getActiveSheet()
    ->getStyle("B".$baris_excel)
    ->getNumberFormat()
    ->setFormatCode(
        PHPExcel_Style_NumberFormat::FORMAT_GENERAL
    );         
$baris_excel++;				
}
for ($i = 'A'; $i <=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}

$objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

$objPHPExcel->getActiveSheet()->setTitle(nama_kelas($kelas));
$index_sheet++;

}
$objPHPExcel->setActiveSheetIndex(0);
$filename="Rekap ".$_SESSION['f_fullname'];    
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

exit;

}
$t=ob_get_clean();
die($t);
?>
