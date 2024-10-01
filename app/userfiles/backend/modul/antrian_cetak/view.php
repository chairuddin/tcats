<?php
if($action=="pra_cetak") {
	$url_pdf=backendurl("$modul/cetak/$id");
	list($data)=$mysql->query_data("SELECT * FROM invoice WHERE id=$id");
	//$file_qrcode=generateQRCode($data['id'],fronturl("validasi/".($data["urut"])));
	$hari_ini=date("Y-m-d H:i:s");
	$url_back=backendurl("$modul/");
	$tombol_back=btn_general($url_back,$icon="fa-arrow-left");
	
	echo <<<END
		<div class="card">
              <div class="card-header">
                <h3 class="card-title">Cetak</h3>
				<div class="float-right">$tombol_back</div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
               <div class="card-body" id="body-cetak">
				</div>
            </div>
            <!-- /.card -->

END;

$script_js.= <<<END
<script>
printFrame = document.createElement('iframe');
printFrame.id = 'print-frame';
printFrame.src = '$url_pdf';
printFrame.style = 'width:100%;min-height:700px;';
printFrame.onload = function () {
  var mediaQueryList =   printFrame.contentWindow.matchMedia('print');
  mediaQueryList.addListener(function (mql) {
    console.log('print event', mql);
   // alert('print event');
  });
/*
  setTimeout(function () {
    printFrame.contentWindow.print();
  }, 0);
  */
 }
 
 document.getElementById("body-cetak").appendChild(printFrame);
 
/*
$(document).ready(function(){
	 window.frames['PrintFrame'].contentWindow.print();
});

(function() {
    var beforePrint = function() {
        console.log('Functionality to run before printing.');
    };
    var afterPrint = function() {
        console.log('Functionality to run after printing');
		window.location = "$url_new";
    };

    if (window.matchMedia) {
        var mediaQueryList = window.matchMedia('print');
        mediaQueryList.addListener(function(mql) {
            if (mql.matches) {
                beforePrint();
            } else {
                afterPrint();
            }
        });
    }

    window.onbeforeprint = beforePrint;
    window.onafterprint = afterPrint;
}());
*/
</script>
END;

}
if($action=="cetak") {

list($data)=$mysql->query_data("SELECT * FROM invoice WHERE id=$id");
$termin_ke=$data['termin_ke'];
$total_termin=$mysql->get1value("SELECT termin FROM deal WHERE id='".$data['deal_id']."'");
//$file_qrcode=generateQRCode($data['id'],fronturl("validasi/".($data["urut"])));
$pemeriksa=$mysql->get1value("SELECT fullname FROM user WHERE id=".$data['printed_by']);
b_load_lib("TCPDF-master/tcpdf");


class PDF extends TCPDF {
    // Set the header content with an image
    public function Header() {
        // Load and set the header image
		
        $headerImagePath = filepath("asset/kop-nota.png");
		$size = getimagesize($headerImagePath);
		$ratio = $size[0]/$size[1]; // width/height
		//$ratio = $width/$height; // width/height
		if( $ratio > 1) {
			$width = 220;
			$height = 220/$ratio;
		}
		else {
			$width = 220*$ratio;
			$height = 220;
		}

        $this->Image($headerImagePath,0,0, $width, $height, 'PNG');
    }

    // Set the footer content with an image
    public function Footer() {
        // Load and set the footer image
      
        $footerImagePath = filepath("asset/footer-nota.png");
		$size = getimagesize($footerImagePath);
		$ratio = $size[0]/$size[1]; // width/height
		//$ratio = $width/$height; // width/height
		if( $ratio > 1) {
			$width = 220;
			$height = 220/$ratio;
		}
		else {
			$width = 220*$ratio;
			$height = 220;
		}

        $this->Image($footerImagePath,-4,276, $width, $height, 'PNG');

    }
}

$option_jenis_kelamin=data_jenis_kelamin();

//$pageLayout = array($width=10, $height=6); //  or array($height, $width) 
//$pdf = new TCPDF('L', 'cm', $pageLayout, true, 'UTF-8', false);
$pageLayout = A4; //  or array($height, $width) 
$pdf = new PDF('P', 'mm', $pageLayout, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('print out');
$pdf->SetTitle(cleanInput($data['nomor'],'field'));
$pdf->SetSubject('print out');
$pdf->SetKeywords('print out');

// remove default header/footer
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(15,10,15, false); // set the margins 

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);
$pdf->setListIndentWidth(4);

// Add a page
// This method has several options, check the source code documentation for more information.
//$pdf->AddPage('L', array(140,210));
//$pdf->AddPage('P','A4');
$pdf->AddPage();
ob_start();

?>
<br/>
<br/>
<br/>
<br/><br/>
	<table>
		<tr>
			
			<td  style="font-size:11pt">
			
				<table >
					<tr><td colspan="2" style="font-weight:bold;text-align:center;font-size:12pt;"><span style="padding:5px;font-size:15pt;"> INVOICE </span></td></tr>
					<tr><td colspan="2" style="text-align:center;font-size:12pt;">No. <?php echo $data['nomor'];?> </td></tr>
				</table>
			</td>
		</tr>
		
	</table>
	<p style="line-height:0">&nbsp;</p>
	<p style="line-height:0">&nbsp;</p>
	<p style="line-height:0">&nbsp;</p>
	
	<table cellpadding="1" style="font-size:10pt">
		
		
			<tr>
				<td width="60%">
				<strong>Kepada Yth,</strong><br/>
				<?php echo $data['perusahaan'];?><br/>
				<?php echo $data['alamat'];?>
				</td>
				<td width="10%"> </td>
				<td width="30%">
					<table>
					<tr><td style="width:3cm;">Tanggal Order</td><td style="width:0.3cm">:</td><td style="width:4cm"><?php echo date('d/m/Y',strtotime($data['tanggal']));?></td></tr>
					<tr><td style="width:3cm;">Jatuh Tempo</td><td style="width:0.3cm">:</td><td style="width:4cm"><?php echo date('d/m/Y',strtotime($data['tanggal_jatuh_tempo']));?></td></tr>
				
					</table>

				</td>
			</tr>
			
			
		</table>	
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<table cellpadding="10" border="1">
			<tr  style="font-size:14pt">
				<td width="10%" style="text-align:center;font-size:12pt">No</td>
				<td width="40%" style="text-align:center;font-size:12pt">Nama Produk/Jasa</td>
				<td width="25%" style="text-align:center;font-size:12pt">Keterangan</td>
				<td width="25%" style="text-align:center;font-size:12pt">Jumlah</td>
			</tr>	
			<?php
			$total=0;
			$q_detail=$mysql->query("SELECT id,deskripsi,nominal FROM invoice_detail WHERE invoice_id='$id'");
			if($q_detail and $mysql->num_rows($q_detail)>0) {
				$no=1;
				while($d_detail = $mysql->fetch_assoc($q_detail)) {
					$keterangan=$total_termin>1?"Termin $termin_ke/$total_termin":"";
					echo '
					<tr>
					<td>'.$no.'</td>
					<td>'.$d_detail['deskripsi'].'</td>
					<td style="text-align:center;">'.$keterangan.'</td>
					<td style="text-align:right;">'.currency($d_detail['nominal'],"Rp ").'</td>

					</tr>';
					$total+=$d_detail['nominal'];
					$no++;
				}

				$total=$total-$data['dp'];
				$total=$total-$data['diskon'];
				echo '
				<tr><td></td><td></td><td>Down Payment</td><td style="text-align:right;">'.currency($data['dp'],'Rp ').'</td></tr>
				<tr><td></td><td></td><td>Diskon</td><td style="text-align:right;">'.currency($data['diskon'],'Rp ').'</td></tr>
				<tr><td colspan="3" style="font-weight:bold;text-align:center;">Jumlah</td><td style="text-align:right;font-weight:bold;">'.currency($total,'Rp ').'<br/></td></tr>
				';
				echo '
				<tr><td colspan="4">Terbilang:'.Ucwords(terbilang($total)).' Rupiah</td></tr>
				';
			}

			?>
			
	</table>	
	
<?php
$html=ob_get_clean();


$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$pembayaran_html=<<<END
<table>
		<tr><td>
			<br/>
	<p   style="font-size:10pt">
<strong>Pembayaran dapat di transfer ke:</strong><br/>		
Bank Syariah Indonesia		<br/>
a.c : 7211185176		<br/>
Bank Central Asia (BCA)		<br/>
a.c : 4290891367		<br/>
a.n : PT. Kuanta Prima Indonesia<br/>		
(Mohon konfirmasi bukti pembayaran ke Bagian Keuangan di nomor 0812-4928-6884)		<br/>
		</p>
		</td><td>&nbsp;</td></tr>
		</table>

END;


$currentY = $pdf->GetY();

$pdf->SetXY(15, $currentY+2);
$pdf->writeHTMLCell(0, 0, '', '', $pembayaran_html, 0, 1, 0, true, '', true);

$size = getimagesize(filepath("asset/ttd-nota.png"));
$ratio = $size[0]/$size[1]; // width/height
//$ratio = $width/$height; // width/height
if( $ratio > 1) {
    $width = 50;
    $height = 50/$ratio;
}
else {
    $width = 50*$ratio;
    $height = 50;
}
if($data['template']==1) {
$pdf->Image(filepath("asset/ttd-nota.png"), 120, $currentY+20, $width, $height, '', '', '', false, 300, '', false, false, 72);//
}


$size_stamp = getimagesize(filepath("asset/stamp-nota.png"));
$ratio_stamp = $size_stamp[0]/$size_stamp[1]; // width/height
//$ratio = $width/$height; // width/height
if( $ratio_stamp > 1) {
	$width_stamp = 50;
	$height_stamp = 50/$ratio_stamp;
}
else {
	$width_stamp = 50*$ratio_stamp;
	$height_stamp = 50;
}

if($data['template']==1) {
	$pdf->Image(filepath("asset/stamp-nota.png"), 150, $currentY+30, $width_stamp, $height_stamp, '', '', '', false, 300, '', false, false, 72);//
}
//}


$kotak_tanda_tangan.="
<table>
<tr><td>Hormat Kami</td></tr>
<tr><td><br/><br/><br/><br/><br/><br/><br/><br/></td></tr>
<tr><td>Allaily Mar'atus Solikhah<br/>	
Lead Finance	</td></tr>
</table>

";
$pdf->SetXY(140, $currentY+10);

$pdf->writeHTMLCell(0, 0, '', '', $kotak_tanda_tangan, 0, 1, 0, true, '', true);

$filename='Invoice '.cleanInput($data['nomor'],'field').date("Y-m-d H:i:s").'.pdf';

$pdf->Output($filename, 'I');

die('');

}

if($action=="")
{
$btn_tambah=button_add("$modul/add");
echo <<<END
<div class="card">
		<div class="card-header">
		  <h3 class="card-title">Antrian Cetak</h3>
		  <div class="float-right"></div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th style="width:40px;">No</th>
				<th>Tanggal</th>
				<th>Perusahaan</th>
				<th>PIC</th>
				<th style="width:150px;">Action</th>
				</tr>
				</thead>
				</table>
		</div>
		<!-- /.card-body -->
	  </div>
</div>
END;
}
if($action=="data") {
	
	$column_order = array('b.tanggal','b.perusahaann','b.nama');
	$column_search = array('b.tanggal','b.nomor','b.nama','b.hp','b.perusahaan','b.alamat');
	$order = array('b.tanggal' => 'DESC');
	/*
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY B.tanggal DESC,b.created_date DESC ";
	}
	*/
	$order_by = " ORDER BY b.tanggal DESC,b.created_date DESC ";
	if ($_POST['length'] != -1 AND $_POST['length']!="") {
		$where_limit = "LIMIT {$_POST['start']}, {$_POST['length']}";
	}
	$i = 0;
	$sql_search=array();
	foreach ($column_search as $item) { // loop column 
		
		if($_POST['search']['value']) { // if datatable send POST for search
			
			$sql_search[]= " $item LIKE '%{$_POST['search']['value']}%' ";
		}
		$i++;
	}
	
	if(count($sql_search)>0){
	$sql_r[]=" ".join(" OR ",$sql_search)." ";
	}
	
	$sql=" SELECT b.id,b.nomor,date_format(b.tanggal,'%d/%m/%Y') tanggal,b.nama,b.hp,b.perusahaan FROM invoice b  ";
	
	$sql.=" WHERE printed_by=0 ";

	if(count($sql_r)>0){
		$sql.=" AND  (".join(" OR ",$sql_r).") ";
	}
	
	$result_total = $mysql->query($sql);
	$total=$mysql->num_rows($result_total);
	$sql .= " $order_by $where_limit";
	
	$result = $mysql->query($sql);
	
	$data = array();
	
	
	$gotopage = $_POST['start']/$_POST['length'];
	$no = $_POST['start'];
	while($d = $mysql->fetch_assoc($result)) {
		
		$no++;
		$row = array();
		
		$row[]=$no;
		$row[]=$d['tanggal'];
		$row[]=$d['perusahaan'];
		$row[]=$d['nama'];
		$action_print=btn_print_small(backendurl("$modul/edit/".$d['id']));
		
		if($daftar_hak[$modul]['edit']==1) {
			$action_edit='<a  title="Edit Customer" href="'.backendurl("$modul/edit/".$d['id']).'"><i class="fas fa-edit" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		}
		
		$row[]=$action_print;
		$data[] = $row;
	}
	
	$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $total,
		"recordsFiltered" => $total,
		"data" => $data
	);
	die(json_encode($output));
}
if($action=="view") {
	list($data_invoice)=$mysql->query_data("
	 SELECT * FROM invoice WHERE id=$id
	");
	echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Invoice </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
				<div class="card-body">
					
				 </div>
                <!-- /.card-body -->

                <div class="card-footer">
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary">Submit</button>
                </div>
           
            </div>
            <!-- /.card -->

END;

}

if($action=="edit")
{	
$r=$mysql->query("SELECT * from invoice where id=$id");
$d=$mysql->assoc($r);
extract($d);
foreach($d as $field => $value) {
	$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
}


$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";
/*CUSTOMER*/

//jenis


$tanggal=tgl_indo_long(date("Y-m-d",strtotime($tanggal)));
$total_harga=currency($total_harga);



$option_metode_bayar=array();
$option_metode_bayar['']="Pilih";
$q=$mysql->query("SELECT id,nama FROM metode_bayar  ORDER BY nama ");
if($q and $mysql->num_rows($q)>0) {
	while($d=$mysql->fetch_assoc($q)) {
		$option_metode_bayar[$d['id']]=$d['nama'];
	}
}

$option_status_lunas=array();
$option_status_lunas[]='Pilih';
$option_status_lunas[1]='Lunas';
$option_status_lunas[2]='Batal';

$form_metode_bayar=$form->element_Select("Pembayaran Via","metode_bayar",$option_metode_bayar,array(),array('label'=>3,'input'=>5));
$form_status_lunas=$form->element_Select("Status Invoice","status_lunas",$option_status_lunas,array(),array('label'=>3,'input'=>5));



$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tandai Lunas</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="$do_action" class="yona-validation" enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
				<div class="card-body">
					<table class="table">
						<tr><td style="width:100px">Tgl </td><td>:</td><td>$tanggal</td></tr>
						<tr><td>Nomor</td><td>:</td><td>$nomor</td></tr>
						<tr><td>Lembaga</td><td>:</td><td>$perusahaan</td></tr>
						<tr><td>Alamat</td><td>:</td><td>$alamat</td></tr>
						<tr><td>Nominal</td><td>:</td><td>$total_harga</td></tr>
					
							
					</table>
					<br/>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								$form_metode_bayar
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								$form_status_lunas
							</div>
						</div>
					</div>
					
				 </div>
                <!-- /.card-body -->

                <div class="card-footer">
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary">Lunas</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

END;

$url_ajax=backendurl("$modul/get_customer");
$url_ajax_detail_customer=backendurl("$modul/get_customer_detail");
$url_ajax_transaction_customer=backendurl("$modul/get_customer_transaction");
$script_js.=<<<END
<script>
function get_transaction(id_customer) {
	$.get( "$url_ajax_transaction_customer?id_customer="+id_customer, function( data ) {
			
			if(data.length>0) {
				$("#info_transaction").html(data);
			
			} else {
				$("#info_transaction").html('');
				alert('Data tidak ditemukan');
			}
		});
}
$(document).ready(function(){
	
	$('.js-customer').select2({
		  ajax: {
			url: '$url_ajax',
			delay:250,
			dataType: 'json',
			data: function (params) {

            var queryParameters = {
                term: params.term
            }
            return queryParameters;
			},
			processResults: function (data) {
				return {
					results: $.map(data, function (item) {
						return {
							text: item.text,
							id: item.id
						}
					})
				};
			}
		  }
	});
	
	$('.js-customer').on('select2:select', function (e) {
	  data = e.params.data;
	    id_customer=data.id;
		$.get( "$url_ajax_detail_customer?id_customer="+id_customer, function( data ) {
			
			if(data.length>0) {
				
				var obj = JSON.parse(data);
				$("#nik").val(obj.nik);
				$("#nama").val(obj.nama);
				$("#jenis_kelamin").val(obj.jenis_kelamin);
				$("#hp").val(obj.hp);
				$("#pekerjaan").val(obj.pekerjaan);
				$("#alamat").html(obj.alamat);
				$("#info_customer").html('');
			
			} else {
				$("#info_customer").html('');
				alert('tidak ditemukan');
			}
		});
	  
	});
	
	
});
</script>
END;


}

?>
