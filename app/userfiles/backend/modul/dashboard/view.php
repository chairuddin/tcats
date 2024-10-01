<?php

if($action=="fu_prospek") {
	$info_prospek=info_prospek($id);

	$call_status_list=call_status_list();
	$fu_list=fu_list();
	$call_status_list['']='Pilih';
	$fu_list['']='Pilih';
	$_POST['last_fu']=date("Y-m-d H:i:s");
	$_POST['next_fu']=date("Y-m-d",strtotime('+7 days'));
	
	//$form_last_fu=$form->element_Textbox("FU Terakhir","last_fu",array('class'=>'tanggal'),$mode=array('label'=>6,'input'=>6));
	//$form_next_fu=$form->element_Textbox("FU Berikutnya","next_fu",array('class'=>'tanggal'),$mode=array('label'=>6,'input'=>6));
	$form_last_fu=$form->element_DateTime("FU Terakhir","last_fu",array('class'=>''),$mode=array('label'=>6,'input'=>6));
	$form_next_fu=$form->element_Date("FU Berikutnya","next_fu",array('class'=>''),$mode=array('label'=>6,'input'=>6));
	
	$form_fu_via=$form->element_Select("Bentuk FU","fu_via",$fu_list,array(),$mode=array('label'=>6,'input'=>6));
	$form_status=$form->element_Select("Status","status",$call_status_list,array(),$mode=array('label'=>6,'input'=>6));
	$form_catatan=$form->element_Textarea("Catatan","catatan",array(),$mode=array('label'=>6,'input'=>6));
	$tambahan_pic='';
	if($info_prospek['npsn']!='') {
		$q_npsn=$mysql->query(" SELECT * FROM personal WHERE npsn='".$info_prospek['npsn']."' ");
		if($q_npsn and $mysql->num_rows($q_npsn)) {
			while($d_npsn = $mysql->fetch_assoc($q_npsn)) {
				$tambahan_pic.='<tr><td>'.$d_npsn['nama_lengkap'].'</td><td>'.$d_npsn['nama_panggilan'].'</td><td>'.$d_npsn['jabatan'].'</td><td>'.$d_npsn['agama'].'</td><td><a href="https://wa.me/'.zeroto62($info_prospek['pic_whatsapp']).'">'.$d_npsn['whatsapp'].'</a></td><td><a href="mailto:'.$d_npsn['email'].'">'.$d_npsn['email'].'</a></td></tr>';
			}
		}
	}
	
	$html_info='
	
	<h5 class="mb-sm-3">Target </h5>
	<div class="data-container">
    		<div class="data-item">
      			<span class="data-label"><strong class="">Produk</strong></span> <span>'.$info_prospek['produk_nama'].'</span>
    		</div>
  	</div>
	<hr/>	
	<h5 class="mb-sm-3">Lembaga </h5>	 		
	  <div class="data-container">
		  <div class="data-item">
				<span class="data-label"><strong class="">Nama</strong></span> <span>'.$info_prospek['lembaga_nama'].'</span>
		  </div>
		<div class="data-item">
			<span class="data-label"><strong class="">Alamat</strong></span> <span>'.$info_prospek['lembaga_alamat'].'</span>
		</div>
		<div class="data-item">
				<span class="data-label"><strong class="">Telp</strong></span> <span>'.$info_prospek['lembaga_telp'].'</span>
		</div>
		<div class="data-item">
				<span class="data-label"><strong class="">Email</strong></span> <span><a href="mailto:'.$info_prospek['lembaga_email'].'">'.$info_prospek['lembaga_email'].'</a></span>
		</div>
 	 </div>
	  <hr/>
	  <h5 class="mb-sm-3">PIC </h5>	 		
	  <div class="data-container">
	  <table class="" width="100%">
	 	<tr><th>Nama</th><th>Panggilan</th><th>Jabatan</th><th>Agama</th><th>Whatsapp</th><th>Email</th></tr> 
		<tr><td>'.$info_prospek['pic_nama_lengkap'].'</td><td>'.$info_prospek['pic_nama_panggilan'].'</td><td>'.$info_prospek['pic_jabatan'].'</td><td>'.$info_prospek['pic_agama'].'</td><td><a href="https://wa.me/'.zeroto62($info_prospek['pic_whatsapp']).'">'.$info_prospek['pic_whatsapp'].'</a></td><td><a href="mailto:'.$info_prospek['pic_email'].'">'.$info_prospek['pic_email'].'</a></td></tr>
		'.$tambahan_pic.'
	  </table>
		
 	 </div>
	';
	
	$history_followup=history_followup($id);
	$tr_history_followup='';
	foreach($history_followup as $i =>$v) {
		$action_delete=btn_delete_swal(backendurl("$modul/del/".$v['id']));
		$tr_history_followup.='	
		 <tr>
			<td>'.tgl_indo_short($v['last_fu']).'</td>
			<td>'.fu_info($v['fu_via']).'</td>
			<td>'.call_status($v['status']).'</td>
			<td>'.tgl_indo_short($v['next_fu']).'</td>
			<td>'.$v['catatan'].'</td>
			<td>'.$v['admin'].'</td>
			<td>'.$action_delete.'</td>
		</tr>';
		
	}


	$action_fu=backendurl("dashboard/save/$id?from=".$_GET['from']);
	
	echo <<<END
							<div class="row">
								<div class="col-lg-7 ">
									<div class="card">
										<div class="card-body">
											$html_info
										</div>
									</div>
								</div>
								<div class="col-lg-5">

								<!-- form -->
								<form role="form" class="yona-form" autocomplete="off" method="POST" action="$action_fu" enctype="multipart/form-data">
								<div class="card">
									<div class="card-body">
									
											<div class="form-group row">
												$form_last_fu
											</div>
											<div class="form-group row">
												$form_fu_via
											</div>
											<div class="form-group row">
												$form_status
											</div>
											<div class="form-group row">
												$form_catatan
											</div>
											<div class="form-group row">
												$form_next_fu
											</div>
										
									</div>
									<div class="card-footer">
									<button type="button" class="btn btn-dark" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name="submit" value="1">Submit</button>
									</div>
								</div>
								</form>
								<!-- end form -->

								
								</div> <!-- col -->
								
							</div> <!-- row -->
							<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-body">
									
												<table class="table">
													<thead>
														<tr>
															<th>Terakhir</th>
															<th>Fu Via</th>
															<th>Status</th>
															<th>Berikutnya</th>
															<th>Catatan</th>
															<th>Oleh</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													$tr_history_followup
													</tbody>
												</table>
							
										</div>
									</div>
								</div>
							</div>


							
		
	END;
	
	}
if($action=="view" or $action=="") {
$tanggal_sekarang=date("Y-m-d");
$bulan_ini=date("Ym");

if(date("d")=="1") {
	$periode_sekarang=tgl_indo_short(date("Y-m-d"));
	
} else {
	$periode_sekarang="1 - ".tgl_indo_short(date("Y-m-d"));
}

$periode_x_kedepan=date("Y-m-d",strtotime("$tanggal_sekarang +3 month"));
$periode_x_kebelakang=date("Y-m-d",strtotime("$tanggal_sekarang -3 month"));

$terjual_bulan_ini=currency($mysql->get1value(" SELECT SUM(total_harga) FROM invoice WHERE DATE_FORMAT(tanggal,'%Y%m')='$bulan_ini' "),"Rp");
$terjual_x_bulan_kebelakang=currency($mysql->get1value(" SELECT SUM(total_harga) FROM invoice WHERE tanggal>'$periode_x_kebelakang' "),"Rp");


$proyeksi_x_bulan_kedepan=currency($mysql->get1value("
SELECT count(pl.lembaga_id)*harga total FROM prospek p LEFT JOIN prospek_list pl ON p.id=pl.prospek_id
LEFT JOIN produk pd ON pd.id=p.produk_id
WHERE p.target_deal>'$tanggal_sekarang' AND p.target_deal<='$periode_x_kedepan'
"),"Rp");

$jumlah_kegiatan=$mysql->get1value("SELECT count(DISTINCT kegiatan_id) FROM jadwal WHERE DATE_FORMAT(waktu_mulai,'%Y%m')='$bulan_ini'  ");

echo <<<END
<div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body mb-4">
                                <h3 class="card-title text-white">Pendapatan</h3>
                                <div class="d-inline-block">
                                    <h5 class="text-white">$terjual_bulan_ini</h5>
                                    <p class="text-white mb-0">$periode_sekarang</p>
                                </div>
                                <span style="position:absolute;bottom:5px;" class="display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body mb-4">
                                <h3 class="card-title text-white">Target 3 Bulan</h3>
                                <div class="d-inline-block">
                                    <h5 class="text-white">$proyeksi_x_bulan_kedepan</h5>
                                    <p class="text-white mb-0">&nbsp;</p>
                                </div>
                                <span style="position:absolute;bottom:5px;" class="display-5 opacity-5"><i class="fa fa-money"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body mb-4">
                                <h3 class="card-title text-white">Realisasi 3 Bulan</h3>
                                <div class="d-inline-block">
                                    <h5 class="text-white">$terjual_x_bulan_kebelakang</h5>
                                    <p class="text-white mb-0">&nbsp;</p>
                                </div>
                                <span style="position:absolute;bottom:5px;" class="display-5 opacity-5"><i class="fa fa-money"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body mb-4">
                                <h3 class="card-title text-white">Kegiatan</h3>
                                <div class="d-inline-block">
                                    <h5 class="text-white">$jumlah_kegiatan</h5>
                                    <p class="text-white mb-0">$periode_sekarang</p>
                                </div>
                                <span style="position:absolute;bottom:5px;" class="display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
END;


$r_kondisi=array();
$now=date("Y-m-d");
$r_kondisi[]=" (p.last_fu='0000-00-00 00:00:00' or next_fu<='$now') ";
$r_kondisi[]=" p.status<>5  ";

$list_prospek=list_prospek($r_kondisi);

$tr_list_lembaga_baru=$tr_list_lembaga='';
foreach($list_prospek as $i =>$v) {
	$action_button=btn_call(backendurl('dashboard/fu_prospek/'.$v['id']));
	$action_deal=btn_deal(backendurl('deal/add/'.$v['id']));
	$badge=$v['status']>0?badge_color($v['status']):'';
	if($v['last_fu']=='0000-00-00 00:00:00' or v['last_fu']=='') {
	    
	$tr_list_lembaga_baru.='	
	 <tr>
		<td>'.$v['lembaga_nama']."&nbsp;&nbsp;".$badge.'<br/>'.$v['produk_kode'].' '.$v['produk_nama'].' <br/>Last:'.(($v['last_fu']=='0000-00-00 00:00:00' or v['last_fu']=='')?'':tgl_indo_short(date("Y-m-d",strtotime($v['last_fu'])))).'</td>
		<td>'.($v['next_fu']=='0000-00-00'?'':tgl_indo_short($v['next_fu'])).'</td>
		<td>'.($v['last_fu']=='0000-00-00 00:00:00'?'':tgl_indo_short(date("Y-m-d",strtotime($v['last_fu'])))).'</td>
		<td>'.$v['catatan'].'</td>
			<td>'.($v['admin']==''?$v['creator']:$v['admin']).'</td>
		<td>'.$action_button.($v['status']=='1'?$action_deal:'').'</td>
	</tr>';
	
	} else {
	     $tr_list_lembaga.='	
    	 <tr>
    		<td>'.$v['lembaga_nama']."&nbsp;&nbsp;".$badge.'<br/>'.$v['produk_kode'].' '.$v['produk_nama'].' <br/>Last:'.(($v['last_fu']=='0000-00-00 00:00:00' or v['last_fu']=='')?'':tgl_indo_short(date("Y-m-d",strtotime($v['last_fu'])))).'</td>
    		<td>'.($v['next_fu']=='0000-00-00'?'':tgl_indo_short($v['next_fu'])).'</td>
    		<td>'.($v['last_fu']=='0000-00-00 00:00:00'?'':tgl_indo_short(date("Y-m-d",strtotime($v['last_fu'])))).'</td>
    		<td>'.$v['catatan'].'</td>
    		<td>'.($v['admin']==''?$v['creator']:$v['admin']).'</td>
    		<td>'.$action_button.($v['status']=='1'?$action_deal:'').'</td>
    	</tr>';
	}

	

	
}
echo <<<END
                        <div class="card">
                            <div class="card-body">
							<h5>Follow Up Hari ini</h5>
                                <div class="active-member">
                                    <div class="table-responsive">
                                        <table class="table table-xs mb-0">
                                            <thead>
                                                <tr>
                                                  
                                                    <th>Lembaga</th>
													<th style="width:150px;">FU Berikutnya</th>
													<th style="width:150px;">FU Terakhir</th>
													<th style="width:200px;">Catatan</th>
													<th style="100px">Admin</th>
													<th style="width:90px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               $tr_list_lembaga
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>              
                        <div class="card">
                            <div class="card-body">
							<h5>Prospek Baru</h5>
                                <div class="active-member">
                                    <div class="table-responsive">
                                        <table class="table table-xs mb-0">
                                            <thead>
                                                <tr>
                                                  
                                                    <th>Lembaga</th>
													<th style="width:150px;">FU Berikutnya</th>
													<th style="width:150px;">FU Terakhir</th>
													<th style="width:200px;">Catatan</th>
													<th style="100px">Admin</th>
													<th style="width:90px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               $tr_list_lembaga_baru
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>        
    
END;

}
if($action=="data") {
	
	$column_order = array('b.id','b.lembaga_nama','b.lembaga_telp','b.lembaga_email');
	$column_search = array('b.lembaga_nama','b.lembaga_telp','b.lembaga_email');
	$order = array('b.nama' => 'ASC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY b.nama ASC ";
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
	
	if(count($sql_search)>0){
	$sql_r[]=" ".join(" OR ",$sql_search)." ";
	}
	
	$sql=" SELECT b.id,b.lembaga_nama,b.lembaga_telp,b.lembaga_email FROM $modul b  ";
	
	$sql.=" WHERE 1=1  ";

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
		$row[]=$d['lembaga_nama'];
		$row[]=$d['lembaga_telp'];
		$row[]=$d['lembaga_email'];
		
		if($daftar_hak[$modul]['edit']==1) {
			$action_edit='<a  title="Edit Lembaga" href="'.backendurl("$modul/edit/".$d['id']).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		}
		if($daftar_hak[$modul]['del']==1) {
		
		$action_delete=btn_delete_swal(backendurl("$modul/del/".$d['id']));
		}
		$row[]=$action_add.$action_edit.$action_delete;
		
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
?>
