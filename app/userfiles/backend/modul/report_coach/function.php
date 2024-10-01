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
/* RINGKASAN PELANGGAN*/
function ringkasan_pelanggan($periode=array()) {
	global $mysql;
	$data=array();
	$data['database_baru']=database_baru($periode);
	$data['database_aktif']=database_aktif($periode);
	$data['total_prospek']=total_prospek($periode);
	$data['konversi_pelanggan']=(($data['total_prospek']/$data['database_baru'])*100)."%";
	$data['pelanggan_baru']=pelanggan_baru($periode);
	$data['pelanggan_aktif']=pelanggan_aktif($periode);
	$data['belum_jadi_pelanggan']=belum_jadi_pelanggan($periode);
	$data['pendapatan_pelanggan_baru']=pendapatan_pelanggan_baru($periode);
	return $data;
}
function database_baru($periode=array()) {
	//database lembaga yang baru diinputkan
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	$total=$mysql->get1value("SELECT count(id) FROM lembaga WHERE date_format(created_at,'%Y-%m-%d')  BETWEEN '$awal' AND '$akhir' ");
	return $total;
}
function database_aktif($periode=array()) {
	//database lembaga yang 
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	$total=$mysql->get1value("SELECT count(id) FROM lembaga WHERE date_format(created_at,'%Y-%m-%d')  BETWEEN '$awal' AND '$akhir' ");
	return $total;
}
function total_prospek($periode=array()) {
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	$total=$mysql->get1value("SELECT count(id) FROM prospek_list WHERE date_format(created_at,'%Y-%m-%d')  BETWEEN '$awal' AND '$akhir' ");
	return $total;
}
function konversi_pelanggan($periode=array()) {
	/*
	//database baru yang jadi pelanggan berapa %
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	return $total;	
	*/
}
function pelanggan_baru($periode=array()) {
	//data lembaga yang baru terdaftar dan deal
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	$total=$mysql->get1value("SELECT count(id) FROM lembaga WHERE date_format(created_at,'%Y-%m-%d')  BETWEEN '$awal' AND '$akhir' ");
	return $total;
}
function pelanggan_aktif($periode=array()) {
	global $mysql;
	
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	$total=$mysql->get1value("SELECT count(distinct lembaga_id) FROM deal WHERE date_format(created_at,'%Y-%m-%d')  BETWEEN '$awal' AND '$akhir' ");
	
	return $total;
}
function belum_jadi_pelanggan($periode=array()) {
	global $mysql;
	
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	
	$total=$mysql->get1value("
	SELECT count(id) FROM lembaga WHERE date_format(created_at,'%Y-%m-%d')  BETWEEN '$awal' AND '$akhir' AND id NOT IN 
	(
		SELECT  lembaga_id FROM deal WHERE date_format(created_at,'%Y-%m-%d')  BETWEEN '$awal' AND '$akhir' 
	)
	");
	
	return $total;
}
function pendapatan_pelanggan_baru($periode=array()) {
	global $mysql;
	
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	$total=$mysql->get1value("
	SELECT sum(total_harga) FROM invoice WHERE deal_id IN 
	(
		SELECT id FROM deal WHERE date_format(created_at,'%Y-%m-%d')  BETWEEN '$awal' AND '$akhir'  AND lembaga_id IN 
		(
			SELECT id FROM lembaga WHERE date_format(created_at,'%Y-%m-%d')  BETWEEN '$awal' AND '$akhir'
		)
	)

	
	");
	
	return currency($total,"Rp");
}
/* END RINGKASAN PELANGGAN*/
/* INTERAKSI PELANGGAN*/
function interaksi_pelanggan($periode=array()) {
	global $mysql;
	$data=array();
	$data['penawaran_terkirim']=penawaran_terkirim($periode);
	$data['email_terkirim']=email_terkirim($periode);
	$data['percakapan_wa']=percakapan_wa($periode);
	$data['telp_keluar']=telp_keluar($periode);
	$data['respon_penawaran']=respon_penawaran($periode);
	//kode
	return $data;
}
function penawaran_terkirim($periode=array()) {
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	
	$total=$mysql->get1value("
	SELECT count(IF(length(dokumen_penawaran)>0,1,0)) FROM prospek_list  WHERE DATE_FORMAT(last_fu,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir' 
	");
	
	return $total;
}
function email_terkirim($periode=array()) {
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	
	$total=$mysql->get1value("
		SELECT count(id) FROM prospek_list  WHERE fu_via=3 AND DATE_FORMAT(last_fu,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir' 
	");
	
	return $total;
}
function percakapan_wa($periode=array()) {
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	
	$total=$mysql->get1value("
	SELECT count(id) FROM prospek_list  WHERE fu_via=2 AND DATE_FORMAT(last_fu,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir' 
	");

	return $total;
}
function telp_keluar($periode=array()) {
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	$total=$mysql->get1value("
	SELECT count(id) FROM prospek_list  WHERE fu_via=1 AND DATE_FORMAT(last_fu,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir' 
	");

	return $total;
}
function respon_penawaran($periode=array()) {
	global $mysql;
	$awal=date("Y-m-d",strtotime($periode['awal']));
	$akhir=date("Y-m-d",strtotime($periode['akhir']));
	$total=$mysql->get1value("
	select AVG(response_time_hours) from (
		SELECT prospek_id,MIN(last_fu) start,MAX(last_fu) end, TIMESTAMPDIFF(HOUR, MIN(last_fu), MAX(last_fu)) AS response_time_hours FROM prospek_list  WHERE (status=1 or status=5) AND DATE_FORMAT(last_fu,'%Y-%m-d') BETWEEN '$awal' AND '$akhir' GROUP BY prospek_id
		) x WHERE x.start<>'0000-00-00 00:00:00' and x.end<>'0000-00-00 00:00:00';
	");
	
	return currency($total);
}
/* END INTERAKSI PELANGGAN*/
/* PENGEMBANGAN PELANGGAN*/
function pengembangan_pelanggan($periode=array()) {
	$data=array();
	//kode
	$data=array();
	$data['pelanggan_repeat_order']=pelanggan_repeat_order($periode);
	$data['pelanggan_batal']=pelanggan_batal($periode);
	$data['pelanggan_komplain']=pelanggan_komplain($periode);
	$data['komplain_selesai']=komplain_selesai($periode);
	return $data;
}
function pelanggan_repeat_order($periode=array()) {
	global $mysql;
	//$awal=$periode['awal'];
	$awal=(date('Y')-1)."-01-01";
	$akhir=$periode['akhir'];
	
	$total=$mysql->get1value("
	SELECT count(lembaga_id) FROM  (
		SELECT count(id) jumlah,lembaga_id FROM deal  WHERE  DATE_FORMAT(created_at,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir' GROUP BY lembaga_id
	) x WHERE x.jumlah>1
	");

	return $total;
}
function pelanggan_batal($periode=array()) {
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	
	$total=$mysql->get1value("
	SELECT count(id) FROM jadwal  WHERE status_selesai=2 AND DATE_FORMAT(created_at,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir' 
	GROUP BY kegiatan_id
	");
	
	
	return $total+0;
}
function pelanggan_komplain($periode=array()) {
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	/*
	$total=$mysql->get1value("
	SELECT count(id) FROM prospek_list  WHERE fu_via=1 AND DATE_FORMAT(last_fu,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir' 
	");
	*/
	//return $total;
	return 'unavailable';
}
function komplain_selesai($periode=array()) {
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	/*
	$total=$mysql->get1value("
	SELECT count(id) FROM prospek_list  WHERE fu_via=1 AND DATE_FORMAT(last_fu,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir' 
	");
	*/
	//return $total;
	return 'unavailable';
}


/* END PENGEMBANGAN PELANGGAN*/
/* RINGKASAN PENJUALAN */
function ringkasan_penjualan($periode=array()) {
	$data=array();
	$data['total_kelas']=total_kelas($periode);
	$data['total_peserta']=total_peserta($periode);
	$data['produk_terlaris']=produk_terlaris($periode);
	$data['produk_pendapatan_tinggi']=produk_pendapatan_tinggi($periode);
	$data['penjualan_rata_rata_pelanggan']=penjualan_rata_rata_pelanggan($periode);
	$data['penjualan_perjenis']=penjualan_perjenis($periode);
	
	//kode
	return $data;
}
function total_kelas($periode=array()) {
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	
	$total=$mysql->get1value("
		SELECT count(id) FROM jadwal  WHERE  DATE_FORMAT(created_at,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir' 
	");

	return $total;
}
function total_peserta($periode=array()) {
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];

	$total=$mysql->get1value("
		SELECT sum(jumlah_peserta) FROM jadwal  WHERE  DATE_FORMAT(created_at,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir' 
	");
	return $total;
}
function produk_terlaris($periode=array()) {
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	
	$nama_produk=$mysql->get1value("
	SELECT p.nama FROM 
	(
		SELECT count(id.produk_id) jumlah,id.produk_id FROM invoice_detail id INNER JOIN invoice i ON i.id=id.invoice_id  WHERE DATE_FORMAT(i.tanggal,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir' GROUP BY id.produk_id 
	) x LEFT JOIN produk p ON p.id=x.produk_id
	ORDER BY x.jumlah DESC LIMIT 1
	");
	
	return $nama_produk;
}
function produk_pendapatan_tinggi($periode=array()) {
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];

	$nama_produk=$mysql->get1value("
	SELECT p.nama FROM 
	(
		SELECT count(id.nominal) jumlah,id.produk_id FROM invoice_detail id INNER JOIN invoice i ON i.id=id.invoice_id  WHERE DATE_FORMAT(i.tanggal,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir' GROUP BY id.produk_id 
	) x LEFT JOIN produk p ON p.id=x.produk_id
	ORDER BY x.jumlah DESC LIMIT 1
	");
	
	return $nama_produk;
	
	
}
function penjualan_rata_rata_pelanggan($periode=array()) {
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	
	$total=$mysql->get1value("
		SELECT AVG(nominal_deal) FROM deal WHERE DATE_FORMAT(created_at,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir'  
	");
	
	return currency($total);
	
}
function penjualan_perjenis($periode=array()) {
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	$q=$mysql->query("
	SELECT px.id,px.nama,IFNULL(tx.total,0) total FROM produk_jenis px LEFT JOIN
	( 
	SELECT pj.id,pj.nama,sum(id.nominal) total FROM 
	invoice_detail id 
	INNER JOIN produk p ON p.id=id.produk_id
	INNER JOIN produk_jenis pj ON pj.id=p.jenis
	INNER JOIN
	invoice i ON i.id=id.invoice_id
	INNER JOIN 
	deal d ON d.id=i.deal_id WHERE DATE_FORMAT(i.tanggal,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir'  
	GROUP BY pj.id
	) tx ON px.id=tx.id
	");
	$response="";
	if($q and $mysql->num_rows($q)) {
		while($d = $mysql->fetch_assoc($q)) {
			$response.= '<tr><td>'.$d['nama'].'</td><td  style="text-align:right;">'.currency($d['total']).'</td></tr>';
		}
	}
	/*
	$total=$mysql->get1value("
	SELECT count(id) FROM prospek_list  WHERE fu_via=1 AND DATE_FORMAT(last_fu,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir' 
	");
	*/
	return $response;// tr td ;
}
/* END RINGKASAN PENJUALAN*/
/* MEDIA PUBLIKASI */
function media_publikasi($periode=array()) {
	global $mysql;
	$data=array();
	//kode
	
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	$q=$mysql->query("
		SELECT peluang_tercipta FROM prospek WHERE DATE_FORMAT(created_at,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir' 
	");
	
	$peluang=array();
	if($q and $mysql->num_rows($q)) {
		while($d = $mysql->fetch_assoc($q)) {
			$r_temp=explode(",",$d['peluang_tercipta']);
			foreach($r_temp as $i => $fu_id) {
				$peluang[$fu_id]+=1;
			}
		}
	}
	
	$response="";
	$fu_list=fu_list();

	foreach($fu_list as $i =>$v) {
		$response.= '<tr><td>'.$v.'</td><td  style="text-align:right;">'.currency($peluang[$i]).'</td></tr>';
	}
	return $response;
	
}
/* END MEDIA PUBLIKASI*/

function list_report_coach($periode=array()) {
	global $mysql;
	$awal=$periode['awal'];
	$akhir=$periode['akhir'];
	$q=$mysql->query(" SELECT jc.coach_id,c.nama,sum(TIMESTAMPDIFF(HOUR, jh.jam_mulai, jh.jam_selesai)) jumlah_jam, count(coach_id) jumlah_kelas FROM jadwal_coach jc INNER JOIN jadwal_harian jh ON jc.jadwal_harian_id=jh.id  
	LEFT JOIN coach c ON c.id=jc.coach_id
	WHERE DATE_FORMAT(jh.jam_mulai,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir'  GROUP BY jc.coach_id
	ORDER BY c.nama
	");
	$response='';
	$coach=array();
	if($q and $mysql->num_rows($q)>0) {
		$no=1;
		while($d=$mysql->fetch_assoc($q)) {
			//$coach[$coach_id]=array('jam'=>$d['jumlah_jam'],'kelas'=>$d['jumlah_kelas']);
			$response.= '<tr><td>'.$no.'</td><td>'.$d['nama'].'</td><td style="text-align:center">'.$d['jumlah_jam'].'</td><td   style="text-align:center">'.$d['jumlah_kelas'].'</td></tr>';
			$no++;
	
		}
	}

 return $response;
}
?>
