<?php

function build_print($data_peserta) {
$tanggal_cetak="Tanggal Cetak ".tgl_indo(date("Y-m-d"))." ".date("H:i:s");
ob_start();
if(count($data_peserta)>0) {
	echo '
	<html>
	<head></head>
	<body onload="window.print()">
	<table id="datalist" cellspacing="0"  cellpadding="5" border="1" class="table table-bordered table-striped responsive no-wrap">
	<h3>Laporan Order Terkirim</h3>
	'.$tanggal_cetak.'
	<thead>
	<tr>
	<th style="width:40px;">No</th>
	<th>Nama</th>
	<th>Telp</th>
	<th>Status</th>
	<th>Alamat</th>
	<th>Catatan</th>
	</tr>
	</thead>
	<tbody>';
	
	foreach( $data_peserta as $i => $data ) 
	{
	echo '	
	<tr>
	<td>'.(++$no).'</td>
	<td>'.$data['nama'].'</td>
	<td>'.$data['telp'].'</td>
	<td>'.($data['created_by_text']!=''?"Selesai: ".$data['created_by_text']:'').'</td>
	<td>'.$data['alamat'].'</td>
	<td>'.$data['catatan'].'</td>
	</tr>
	';
	
	}
	echo '
	</tbody>
	</table>
	</body>
	</html>
	';	
}
echo ob_get_clean();	
die();

}
function build_excel($data_peserta) {
	global $action,$mysql;
	
	$type_pengiriman=$mysql->get1value("SELECT name FROM master_jenis WHERE id=".$_GET['jenis']);
	$data_excel=array();
	$excel_sheet=0;

	$data_excel[$excel_sheet]['sheet']=$type_pengiriman;
	
	$data_excel[$excel_sheet]['judul']="LAPORAN HARIAN";
	//$data_excel[$excel_sheet]['periode']="Tanggal Cetak ".tgl_indo(date("Y-m-d"))." ".date("H:i:s");
	
	$option_tes=data_hasil_tes();
	$data_excel[$excel_sheet]['heading'][]='No';
	$data_excel[$excel_sheet]['heading'][]='Tanggal';
	$data_excel[$excel_sheet]['heading'][]='No. Surat';
	$data_excel[$excel_sheet]['heading'][]='Nama';
	$data_excel[$excel_sheet]['heading'][]='No. Telp';
	$data_excel[$excel_sheet]['heading'][]='Hasil';
	$data_excel[$excel_sheet]['heading'][]='Petugas Swab';


	foreach( $data_peserta as $i => $data )  {
		$tdata=array();
		$tdata[]=(++$no);
		$tdata[]=' '.tgl_hari(date("Y-m-d",strtotime($data['tanggal_selesai'])));
		$tdata[]=' '.$data['nomor'];
		$tdata[]=$data['nama'];
		$tdata[]=' '.$data['hp'];
		$tdata[]=$option_tes[$data['status_tes']];
		$tdata[]=$data['petugas_swab'];
		$data_excel[$excel_sheet]['data'][]=$tdata;	
		
	}
	
	if($action=='excel') {
		generate_excel2($data_excel,"Laporan ".tgl_indo(date("Y-m-d")));
	}
}
function generate_excel2($data_excel,$filename){
	
	
	ini_set('display_errors', FALSE);
	ini_set('display_startup_errors', FALSE);
	date_default_timezone_set('Asia/Jakarta');
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()
    ->getNumberFormat()
    ->setFormatCode(
        PHPExcel_Style_NumberFormat::FORMAT_GENERAL
    );
	$objPHPExcel->getProperties()->setCreator("raja_qr")
							 ->setLastModifiedBy("raja_qr")
							 ->setTitle("raja_qr")
							 ->setSubject("raja_qr")
							 ->setDescription("raja_qr")
							 ->setKeywords("raja_qr")
							 ->setCategory("raja_qr");
	
	foreach($data_excel as $i => $data) {

	$sheet = $objPHPExcel->getActiveSheet();
	$objWorkSheet = $objPHPExcel->createSheet($i); //Setting index when creating
	
	$objWorkSheet->setTitle($data['sheet']);
	
	$objPHPExcel->setActiveSheetIndex($i);
	$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
	
	$objWorkSheet->setCellValue('A1', $data['judul']);
	//$objWorkSheet->setCellValue('A2', $data['periode']);
	$panjang=count($data['heading']);
	
	$kolom=kolom_excel($panjang,"A");
	$nomor=1;
	$baris=2;
	foreach($kolom as $a =>$k){
		$objWorkSheet->setCellValue($k.$baris, $data['heading'][$a]);
		if($a>0){
			$objPHPExcel->getActiveSheet()->getColumnDimension($k)->setAutoSize(TRUE);
		}
		$objPHPExcel->getActiveSheet()->getStyle($k.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
	}
	$baris++;
	
	foreach($data['data'] as $x => $value) {
		
			foreach($kolom as $a =>$k){
			if($k=='R') {
			//nomor telp supaya bisa ada nol didepannya	
			$objPHPExcel->getActiveSheet()->setCellValueExplicit($k.$baris, $value[$a], PHPExcel_Cell_DataType::TYPE_STRING);
			} else {
			$objWorkSheet->setCellValue($k.$baris, $value[$a]);
			}
		}
		
		
		$baris++;
	}
	
	
	}
	$objPHPExcel->setActiveSheetIndex(0);
	$t=ob_get_clean();
	
	
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
	//$t=ob_get_clean();
	//ob_start();
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	//$t=ob_get_clean();
	exit;
}
function build_pdf($data_pemesan) {
	global $id_cabang;
	global $mysql;
	b_load_lib("TCPDF-master/examples/config/tcpdf_config_alt");
	b_load_lib("TCPDF-master/tcpdf");
	
	// create new PDF document
	//die(PDF_PAGE_FORMAT);
	
	// Extend the TCPDF class to create custom Header and Footer
	class MYPDF extends TCPDF {

		//Page header
		public function Header() {
			global $tanggal_antar;
			$html='	<table>
			<tr><td style="border-bottom:2px solid black;">Laporan Paket Masuk / Tanggal Cetak '.date("d/m/Y").'</td></tr>
			</table>	';
			$this->writeHTML($html, true, false, true, false, '');
		}

		// Page footer
		public function Footer() {
			// Position at 15 mm from bottom
			$this->SetY(-15);
			// Set font
			$this->SetFont('helvetica', 'I', 8);
			// Page number
			$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		}
	}

	
	// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('raja_qrexpress.com');
$pdf->SetTitle("Laporan Paket Masuk");
$pdf->SetSubject("Laporan Paket Masuk");
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
	}

	// ---------------------------------------------------------
	$pdf->setPageMark();
	// set font
	$pdf->SetFont('Tahoma', '',10);
	//$params = $pdf->serializeTCPDFtagParameters(array($data['kode'], 'C128', '', '', 60, 12, 0.1, array('position'=>'S', 'border'=>false, 'padding'=>2, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'montserrat', 'fontsize'=>14, 'stretchtext'=>4), 'N'));
	//$barcode = '<tcpdf method="write1DBarcode" params="'.$params.'" />';
	// add a page
	$pdf->AddPage();

	

	if(count($data_pemesan)>0) {
		$no=1;
		$html.='<table border="1"  cellpadding="2">';
		$html.='
			<thead>
			<tr>
			<th style="width:30px;font-weight:bold;">No</th>
			<th style="width:100px;font-weight:bold;">Tanggal</th>
			<th style="width:75px;font-weight:bold;">AWB</th>
			<th style="width:100px;font-weight:bold;">No Invoice</th>
			<th style="width:200px;font-weight:bold;">Nama Konsultan</th>
			<th style="width:150px;font-weight:bold;">Status</th>
			<th style="width:300px;font-weight:bold;">Alamat</th>
			</tr>
			</thead>
			';
		$html.='<tbody>';
		//while($d_order = $mysql->fetch_assoc($q_order)) 
		foreach($data_pemesan as $id_order => $d_order)
		{
			
			
		
				$jumlah_baris++;
				$html.='
				<tr>
				<td style="width:30x;">'.$no.'</td>
				<td style="width:100px;">'.$d_order['created_date'].'</td>
				<td style="width:75px;">'.$d_order['awb'].'</td>
				<td style="width:100px;">'.$d_order['nomor_invoice'].'</td>
				<td style="width:200px;">'.$d_order['nama_consultan'].'</td>
				<td style="width:150px;">'.($d_order['created_by_text']!=''?"Selesai: ".$d_order['created_by_text']:'').'</td>
				<td style="width:300px;">'.$d_order['address'].'</td>
				</tr>';
			    
					
				
				
				/*End Ringkasan catalog*/
			$no++;
			
			

		}
		$html.='</tbody>';
		$html.='</table>';

	
	}
	$pdf->writeHTML($html, true, false, true, false, '');
	/////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////
	

	// reset pointer to the last page
	$pdf->lastPage();
	//Close and output PDF document
	$t=ob_get_clean();
	$pdf->Output("Laporan Paket Masuk.pdf", 'I');
	die('');
}
?>
