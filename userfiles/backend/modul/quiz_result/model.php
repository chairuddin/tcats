<?php
$hariini=date("Y-m-d");
$hariini_long=date("Y-m-d H:i:s");

if($action=="del")
{
$valid=true;
$mysql->autocommit(false);	

$id=cleanInput($id,'numeric');
$sql="DELETE FROM quiz_done_arsip WHERE schedule_id='$id'";
$q=$mysql->query($sql);
if(!$q){$valid=false;}

if($valid){
	$sql="DELETE FROM quiz_schedule_arsip WHERE id='$id'";
	$r=$mysql->query($sql);	
	if(!$r){$valid=false;}
}

if($valid)
{
	$mysql->commit();
	Form::clearValues("update{$modul}");
	msg_warning(_BERHASILHAPUS,"success");
	header("location:".backendurl("$modul/view"));
	exit();
}
else
{
	$mysql->rollback();
	msg_warning(_GAGALHAPUS,"error");
	header("location:".backendurl("$modul/view"));
	exit();
}
}

if($action=="sortitem")
{
$list=$_POST['list'];
for($i=1;$i<=count($list);$i++)
{
$idlist=cleanInput($list[$i-1],'numeric');

$q=$mysql->query("UPDATE $modul set urutan=$i WHERE id='$idlist'");

}
exit();
}

if($action=="download_excel")
{

error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);
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



//AMBIL KUNCI JAWABAN

	$quiz_id=$mysql->get1value("SELECT quiz_id FROM quiz_done_arsip WHERE schedule_id='".cleanInput($_GET['schedule_id'])."'");
	$kunci=array();
	$qkey=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id=$quiz_id");
	if($qkey and $mysql->numrows($qkey)>0){
		while($d=$mysql->assoc($qkey)){
			$kunci[$d['id']]=$d['answer'];
		}
	}
	
$join_kunci=join("",$kunci);	
//AMBIL KUNCI JAWABAN
/////////////////////////////////////////

$id=cleanInput($id);	
$sql="SELECT * FROM quiz_done_arsip  WHERE is_done=1 AND schedule_id='".$_GET['schedule_id']."'";
if($_GET['class']!="" AND $_GET['class']!="ALL"){
	$sql.=" AND member_class='".$_GET['class']."'";
}
$sql.="  order by member_code";

$r=$mysql->query($sql);

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',_UJIANMULAI)
            ->setCellValue('B1',_KODELOGIN)
            ->setCellValue('C1',_NAMALENGKAP)
            ->setCellValue('D1',_CLASS)
            ->setCellValue('E1',_KODESOAL)
            ->setCellValue('F1',_NAMASOAL)
            ->setCellValue('G1',_B)
            ->setCellValue('H1',_S)
            ->setCellValue('I1',_TIDAK_JAWAB)
            ->setCellValue('J1',_SCORE)
            ->setCellValue('K1',_KKM)
            ->setCellValue('L1',_KET);



$no=1;
$quiz_date=$quiz_code=$quiz_title="";
while($d=$mysql->assoc($r))
{
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
	$ket=($d['score']>=$d['kkm']?_LULUS:_TIDAKLULUS);
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$no,$d['start_time'])
            ->setCellValue('B'.$no,$d['member_code'])
            ->setCellValue('C'.$no,$d['member_fullname'])
            ->setCellValue('D'.$no,$d['member_class'])
            ->setCellValue('E'.$no,$d['quiz_code'])
            ->setCellValue('F'.$no,$d['quiz_title_id'])
            ->setCellValue('G'.$no,$d['benar'])
            ->setCellValue('H'.$no,$d['salah'])
            ->setCellValue('I'.$no,$d['tidak_jawab'])
            ->setCellValue('J'.$no,$d['score'])
            ->setCellValue('K'.$no,$d['kkm'])
            ->setCellValue('L'.$no,$ket);
}

$q_schedule=$mysql->query("SELECT * FROM quiz_schedule_arsip WHERE id=".cleanInput($_GET['schedule_id']));
	if($q_schedule and $mysql->numrows($q_schedule)>0){
		while($d=$mysql->assoc($q_schedule)){
			$quiz_id=$d['id'];
			$quiz_info=json_decode($d['quiz_info'],true);
			$quiz_date=date("Ymd",strtotime($d['tanggal']));
			$quiz_code=$quiz_info['quiz_id'];
			$quiz_title=$quiz_info['title_id'];
		}
	}

$filename=$_GET['class']."_{$quiz_date}_{$quiz_code}_{$quiz_title}";
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

//AMBIL KUNCI JAWABAN

	$quiz_id=$mysql->get1value("SELECT quiz_id FROM quiz_done_arsip WHERE schedule_id='".cleanInput($_GET['schedule_id'])."'");
	$kunci=array();
	$qkey=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id=".$quiz_id);
	if($qkey and $mysql->numrows($qkey)>0){
		while($d=$mysql->assoc($qkey)){
			$kunci[$d['id']]=$d['answer'];
		}
	}
	
$join_kunci=join("",$kunci);	

//AMBIL KUNCI JAWABAN

$rschedule=$mysql->query_data("SELECT quiz_info,date_format(tanggal,'%Y-%m-%d %H:%i') tanggal,date_format(tanggal_expired,'%Y-%m-%d %H:%i') tanggal_expired FROM quiz_schedule_arsip WHERE id='".cleanInput($_GET['schedule_id'])."' ");

$dschedule=json_decode($rschedule[0]['quiz_info'],true);

$dschedule['tanggal']=$rschedule[0]['tanggal'];
$dschedule['tanggal_expired']=$rschedule[0]['tanggal_expired'];
$sql="SELECT * FROM quiz_done_arsip  WHERE is_done=1 AND schedule_id='".cleanInput($_GET['schedule_id'])."'";
if($_GET['class']!=""){
$sql.=" AND member_class='".$_GET['class']."'";
}
$sql.="  order by member_code ";

$r=$mysql->query($sql);

$objWorkSheet->setCellValue('A1', 'No')
		   ->setCellValue('B1', _KODELOGIN)
		   ->setCellValue('C1', _NAMALENGKAP)
		   ->setCellValue('D1', _SCORE)
		   ->setCellValue('E1',"");


$panjang=count($kunci);

$kolom=kolom_excel($panjang,"F");
$nomor=1;
foreach($kolom as $a =>$k){
	$objWorkSheet->setCellValue($k.'1', $nomor);
	$objPHPExcel->getActiveSheet()->getStyle($k.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$nomor++;
}

$objWorkSheet->setCellValue('A2', '')
		   ->setCellValue('B2', '')
		   ->setCellValue('C2', '')
		   ->setCellValue('D2', '')
		   ->setCellValue('E2', '');

$i=0;		   
foreach($kunci as $a =>$k){
	$objWorkSheet->setCellValue($kolom[$i].'2', $k);
	$objPHPExcel->getActiveSheet()->getStyle($kolom[$i].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$i++;
	
}

/*
foreach($kolom as $a =>$k){
	$objWorkSheet->setCellValue($k.'2', $kunci[$a]);
}
*/ 
 

$no=1;
$baris_excel=3;
$tandai_warna=array();
while($d=$mysql->assoc($r))
{
	
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
			
			$objWorkSheet->setCellValue('A'.$baris_excel, $no)
		   ->setCellValue('B'.$baris_excel, $d['member_code'])
		   ->setCellValue('C'.$baris_excel, $d['member_fullname'])
		   ->setCellValue('D'.$baris_excel, $d['score'])
		   ->setCellValue('E'.$baris_excel, '');
		   
			$no++;

			$nomor=1;
			
			foreach($kolom as $a =>$k){
				
				$objWorkSheet->setCellValue($k.$baris_excel, $r_answer[$a+1]);
				if($c_answer[$a+1]=="salah"){
					$tandai_warna[]=array("0"=>"{$k}$baris_excel","1"=>"FF0000");
				}else{
					$tandai_warna[]=array("0"=>"{$k}$baris_excel","1"=>"00FF00");
				}
				$nomor++;
			}
			$baris_excel++;		
		}
}		


// Rename sheet
foreach($tandai_warna as $i =>$v){	
	//die($v[0]);
	$objPHPExcel->getActiveSheet()->getStyle($v[0])->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF'.$v[1]);
	$objPHPExcel->getActiveSheet()->getStyle($v[0])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}

$objWorkSheet->setTitle("Jawaban");

////////////////////////////////////////END JAWABAN SISWA


////////////////////////////////////////ANALISA
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

list($dschedule)=$mysql->query_data("SELECT * FROM quiz_schedule_arsip WHERE id=$schedule_id");

//AMBIL KUNCI JAWABAN	
	$qkey=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id=$quiz_id");
	if($qkey and $mysql->numrows($qkey)>0){
		while($d=$mysql->assoc($qkey)){
			$kunci[$d['id']]=$d['answer'];
		}
	}
//END AMBIL KUNCI JAWABAN

$sql="SELECT * FROM quiz_done_arsip  WHERE is_done=1 AND schedule_id='".$schedule_id."' AND member_class='".cleanInput($_GET['class'])."'  ORDER BY score DESC";

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
		   ->setCellValue('B'.($i+1), $jawab_prope[$i]["A"]."%")
		   ->setCellValue('C'.($i+1), $jawab_prope[$i]["B"]."%")
		   ->setCellValue('D'.($i+1), $jawab_prope[$i]["C"]."%")
		   ->setCellValue('E'.($i+1), $jawab_prope[$i]["D"]."%")
		   ->setCellValue('F'.($i+1), $jawab_prope[$i]["E"]."%")
		   ->setCellValue('G'.($i+1), $jawab_prope[$i]["out"]."%")
		   ->setCellValue('H'.($i+1), $daya_pembeda)
		   ->setCellValue('I'.($i+1), $tingkat_kesulitan)
		   ->setCellValue('J'.($i+1), $efektifitas_option)
		   ->setCellValue('K'.($i+1), $status_soal);
		   
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
$objWorkSheet->setTitle("Analisa");
////////////////////////////////////////END ANALISA

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
?>
