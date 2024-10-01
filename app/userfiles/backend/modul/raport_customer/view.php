<?php
$periode_awal=$tgl1=$_GET['periode_awal']!=''?$_GET['periode_awal']:date('Y-m-01');
$periode_akhir=$tgl2=$_GET['periode_akhir']!=''?$_GET['periode_akhir']:date('Y-m-d');

if($action=='excel' or $action=='cetak' or $action=='pdf') {
	if($_GET['jenis']!='') {
		$sql_r[]=" t.jenis='".$_GET['jenis']."' ";
	}
	$sql=" 
	SELECT 
		t.id,
		t.tanggal_selesai,
		t.nama,
		t.nomor,
		t.hp,
		t.status_tes,
		u.fullname petugas_swab
	FROM 
		invoice t LEFT join user u ON t.printed_by=u.id
	WHERE t.printed_by>0 AND t.id_cabang=$id_cabang AND date_format(t.tanggal_selesai,'%Y-%m-%d')  BETWEEN '$tgl1' AND '$tgl2'
	
	";
	if(count($sql_r)>0){
		$sql.=" AND  (".join(" OR ",$sql_r).") ";
	}
	
$data_hasil	= $mysql->query_data($sql);


	
}
if($action=='excel' and count($data_hasil)>0) {
	build_excel($data_hasil);
}

if(($_GET['submit']=='proses') and count($data_tracking)<=0) {
 sweetalert2($type="warning","Data tidak ditemukan","");
}


if($action=="" and $_GET['view']=='')
{

//$tombol_download3=btn_download_xls("$modul/excel?periode_awal=$periode_awal&periode_akhir=$periode_akhir&submit=proses&jenis=".cleanInput($_GET['jenis']));
$ringkasan_pelanggan=ringkasan_pelanggan(array('awal'=>$periode_awal,'akhir'=>$periode_akhir));
$interaksi_pelanggan=interaksi_pelanggan(array('awal'=>$periode_awal,'akhir'=>$periode_akhir));
$pengembangan_pelanggan=pengembangan_pelanggan(array('awal'=>$periode_awal,'akhir'=>$periode_akhir));
$ringkasan_penjualan=ringkasan_penjualan(array('awal'=>$periode_awal,'akhir'=>$periode_akhir));
$media_publikasi=media_publikasi(array('awal'=>$periode_awal,'akhir'=>$periode_akhir));

echo <<<END
<div class="card">
		<div class="card-header">
		  <h3 class="card-title">Raport Customer</h3>  
		  <div class="float-right">$tombol_download1&nbsp;$tombol_download2&nbsp;$tombol_download3</div>
		  <form method="GET" role="form" style="">
		  <div class="ml-2 mt-4">
		  <div class="row">
		  
		  <div class="col-xs-3">
			  <input style="width:150px;" type="date" id="periode_awal" name="periode_awal" class="form-control" value="$periode_awal" /> 
		  </div>
		  <div class="col-xs-1">
			  <div style="line-height:40px;text-align:center;width:30px;">-</div>
		  </div>
		  <div class="col-xs-3">
			  <input style="width:150px;text-align:center;" type="date" id="periode_akhir" name="periode_akhir" class="form-control" value="$periode_akhir"/>
		  </div>
		  <div class="col-xs-2" style="line-height:40px;text-align:center;">
			  &nbsp;&nbsp;<input type="submit" name="submit" value="OK" class="btn btn-primary" style="width:75px;"/>
		  </div>
		  </div>
		  </div>
		  <br/>
	  </form>	
		</div>
		<!-- /.card-header -->
		<div class="card-body">
	
		

	<h5>Ringkasan Pelanggan</h5>
    <table class="table" style="width:700px;">
        <tr>
            <th>Total Database Baru</th>
            <td style="text-align:right;">{$ringkasan_pelanggan['database_baru']}</td>
        </tr>
        <tr>
            <th>Total Database Aktif</th>
            <td style="text-align:right;">{$ringkasan_pelanggan['database_aktif']}</td>
        </tr>
        <tr>
            <th>Total Prospek</th>
            <td style="text-align:right;">{$ringkasan_pelanggan['total_prospek']}</td>
        </tr>
        <tr>
            <th>Konversi Pelanggan/Prospek</th>
            <td style="text-align:right;">{$ringkasan_pelanggan['konversi_pelanggan']}</td>
        </tr>
        <tr>
            <th>Total Pelanggan Baru</th>
            <td style="text-align:right;">{$ringkasan_pelanggan['pelanggan_baru']}</td>
        </tr>
        <tr>
            <th>Total Pelanggan Aktif</th>
            <td style="text-align:right;">{$ringkasan_pelanggan['pelanggan_aktif']}</td>
        </tr>
        <tr>
            <th>Total Database Belum Jadi Pelanggan</th>
            <td style="text-align:right;">{$ringkasan_pelanggan['belum_jadi_pelanggan']}</td>
        </tr>
        <tr>
            <th>Pendapatan dari Pelanggan Baru</th>
            <td style="text-align:right;">{$ringkasan_pelanggan['pendapatan_pelanggan_baru']}</td>
        </tr>
    </table>

    <h2>Interaksi Pelanggan</h2>
    <table class="table" style="width:700px;">
        <tr>
            <th>Total Penawaran Terkirim</th>
            <td style="text-align:right;">{$interaksi_pelanggan['penawaran_terkirim']}</td>
        </tr>
        <tr>
            <th>Total Email Terkirim</th>
            <td style="text-align:right;">{$interaksi_pelanggan['email_terkirim']}</td>
        </tr>
        <tr>
            <th>Total Kontak Percakapan WhatsApp</th>
            <td style="text-align:right;">{$interaksi_pelanggan['percakapan_wa']}</td>
        </tr>
        <tr>
            <th>Total Panggilan Telphone Keluar</th>
            <td style="text-align:right;">{$interaksi_pelanggan['telp_keluar']}</td>
        </tr>
        <tr>
            <th>Waktu Respon rata-rata tiap penawaran (penawaran-closing)</th>
            <td style="text-align:right;">{$interaksi_pelanggan['respon_penawaran']} jam</td>
        </tr>
    </table>

    <h2>Pengembangan Pelanggan</h2>
    <table class="table" style="width:700px;">
        <tr>
            <th>Pelanggan yang repeat order</th>
            <td style="text-align:right;">{$pengembangan_pelanggan['pelanggan_repeat_order']}</td>
        </tr>
        <tr>
            <th>Pelanggan yang membatalkan kerjasama</th>
            <td style="text-align:right;">{$pengembangan_pelanggan['pelanggan_batal']}</td>
        </tr>
        <tr>
            <th>Jumlah Komplain</th>
            <td style="text-align:right;">{$pengembangan_pelanggan['pelanggan_komplain']}</td>
        </tr>
        <tr>
            <th>Komplain Terselesaikan</th>
            <td style="text-align:right;">{$pengembangan_pelanggan['komplain_selesai']}</td>
        </tr>
    </table>

    <h2>Ringkasan Penjualan</h2>
    <table class="table" style="width:700px;">
        <tr>
            <th>Total Kelas</th>
            <td style="text-align:right;">{$ringkasan_penjualan['total_kelas']}</td>
        </tr>
        <tr>
            <th>Total Peserta</th>
            <td style="text-align:right;">{$ringkasan_penjualan['total_peserta']}</td>
        </tr>
        <tr>
            <th>Produk Terlaris</th>
            <td style="text-align:right;">{$ringkasan_penjualan['produk_terlaris']}</td>
        </tr>
        <tr>
            <th>Produk dengan Pendapatan Tertinggi</th>
            <td  style="text-align:right;">{$ringkasan_penjualan['produk_pendapatan_tinggi']}</td>
        </tr>
        <tr>
            <th>Penjualan rata-rata per pelanggan</th>
            <td  style="text-align:right;">{$ringkasan_penjualan['penjualan_rata_rata_pelanggan']}</td>
        </tr>
		<tr>
			<th>Total Pendapatan di tiap circle</th>
			<th ></th>
		</tr>
        {$ringkasan_penjualan['penjualan_perjenis']}
    </table>

    <h2>Media Publikasi</h2>
    <table class="table" style="width:700px;">
        <tr>
            <th>Awal Mula Media informasi produk</th>
            <td>
            </td>
        </tr>
		{$media_publikasi}
		
    </table>



			
		</div>
		<!-- /.card-body -->
		<div class="card-footer">
		<button class="btn btn-default" onclick="history.back();">Kembali</button>
		</div>
	  </div>
</div>
END;
$url_data=backendurl("$modul/data?periode_awal=$periode_awal&periode_akhir=$periode_akhir&jenis=".cleanInput($_GET['jenis']));

$script_js.=<<<END
<script>
$(document).ready(function(){
	// datatables
		$('#datalist').DataTable({
			"pageLength": 100,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : true,
			'info'        : false,
			'processing'  : true,
			'responsive'  :true,
			"ajax": {
				"url": '$url_data',
				"type": "POST"
			},
			"order": [[ 0, 'ASC' ]],
			"language": {
				"paginate": {
				  "previous": "<",
				  "next": ">"
				}
			  },
			   /*
			 "columnDefs": [
				{ responsivePriority: 1, targets: 3 },
		        { responsivePriority: 2, targets: 4 }
			  ],
			 
			  responsive: {
				details: {
					display: $.fn.dataTable.Responsive.display.modal( {
						header: function ( row ) {
							var data = row.data();
							return 'Details for '+data[0]+' '+data[1];
						}
					} ),
					renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
						tableClass: 'table'
					} )
				}
			  }
			  */
			
			
		});
		
});
</script>	
END;
}
if($action=="data") {
	
	$column_order = array();
	$column_search = array('t.tanggal','t.nomor','t.nama','t.hp','t.nik','t.pekerjaan','t.alamat');
	$order = array('t.id' => 'ASC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY t.id ASC ";
	}
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
	if($_GET['jenis']!='') {
		$sql_r[]=" t.jenis=".$_GET['jenis'];
	}
	$sql=" 
	SELECT 
		t.id,
		t.tanggal_selesai,
		t.nama,
		t.nomor,
		t.hp,
		t.status_tes,
		u.fullname petugas_swab
	FROM 
		invoice t LEFT join user u ON t.printed_by=u.id
	WHERE t.printed_by>0 AND t.id_cabang=$id_cabang AND date_format(t.tanggal_selesai,'%Y-%m-%d')  BETWEEN '$tgl1' AND '$tgl2'
	
	";
	if(count($sql_r)>0){
		$sql.=" AND  (".join(" OR ",$sql_r).") ";
	}
	
	$result_total = $mysql->query($sql);
	$total=$mysql->num_rows($result_total);
	$sql .= " $order_by $where_limit";

	$result = $mysql->query($sql);
	
	$data = array();
	
	$option_tes=data_hasil_tes();
	$gotopage = $_POST['start']/$_POST['length'];
	$no = $_POST['start'];
	while($d = $mysql->fetch_assoc($result)) {
		
		$no++;
		$row = array();
		
		$row[]=$no;
		//$row[]=$d['awb'];	
		$row[]=tgl_indo_long(date("Y-m-d",strtotime($d['tanggal_selesai'])));
		$row[]=$d['nomor'];
		$row[]=$d['nama'];
		$row[]=$d['hp'];
		$row[]=$option_tes[$d['status_tes']];
		$row[]=$d['petugas_swab'];
		
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

$script_js.=<<<END
<script>
$(document).ready(function(){
		new GijgoDatePicker(document.getElementById("periode_awal"), { keyboardNavigation: true, modal: true, header: true, footer: true, format: 'dd/mm/yyyy',showRightIcon: false });
		new GijgoDatePicker(document.getElementById("periode_akhir"), { keyboardNavigation: true, modal: true, header: true, footer: true, format: 'dd/mm/yyyy',showRightIcon: false });	
							
});
</script>
END;
?>
