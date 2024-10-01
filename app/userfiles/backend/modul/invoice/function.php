<?php
function insert_customer($hp) {
	global $mysql,$id_cabang,$admin_id,$hari_ini;
		$is_exist=$mysql->get1value("SELECT count(id) ketemu FROM master_customer WHERE hp='".cleanInput($hp)."'");
		
		$action=$is_exist>0?'update':'save';
		$r_post=array(
			'nama',
			'hp',
			'alamat',
			'perusahaan',
		);
		
		foreach($r_post as $i => $v) {
			$post=cleanInput($_POST[$v]);
			$r_sql[]="$v = '$post'";
		}
	

		if($action=="update") {
			$sql=" UPDATE master_customer SET ";
		} else {
			$sql=" INSERT INTO master_customer SET ";		
		}
		
		if($action=="save") {
			$r_sql[]="id_cabang='$id_cabang'";
			$r_sql[]="created_by='$admin_id'";
			$r_sql[]="created_date='$hari_ini'";

		}
		
		if($action=="update") {
			$r_sql[]="modified_by='$admin_id'";
			$r_sql[]="modified_date='$hari_ini'";
		}
		
		
		$sql.=join(",",$r_sql);
		
		if($action=="update") {
			$sql.=" WHERE hp='$hp' ";
		}
		
		$q=$mysql->query($sql);
		$id_customer=$mysql->get1value("SELECT id FROM master_customer WHERE hp='$hp' ");
		return $id_customer;
}
function get_customer_transaction_html($id_customer,$choosen=array()) {
	global $mysql;
	ob_start();
	$id_choosen="";
	if(count($choosen)>0) {
			$id_choosen=" OR id IN (".join(",",$choosen).") ";
	}
	$q_transaction = $mysql->query("
	SELECT id,awb,jenis_kiriman,jml_koli,satuan,m3,kg,total_harga,date_format(created_date,'%Y-%m-%d') created_date FROM master_data WHERE id_penerima=$id_customer AND id_invoice=0 $id_choosen");
	
	echo '<table cellpadding="5" border="1">';
	echo '<tr><th></th><th>AWB</th><th>Tgl</th><th>Barang</th><th>Jumlah</th><th>Satuan</th><th>M<sup>3</sup></th><th>TON</th><th>Total</th></tr>';
	if($q_transaction and $mysql->num_rows($q_transaction)) {
		while($d=$mysql->fetch_assoc($q_transaction)) {
			$checked=in_array($d['id'],$choosen)?'checked="checked"':'';
			
			echo '<tr>
					<td><input '.$checked.' type="checkbox" name="data_awb['.$d['id'].']" class="hitung_harga" harga="'.$d['total_harga'].'" value="'.$d['total_harga'].'"/>	</td>
					<td>'.$d['awb'].'</td>
					<td>'.$d['created_date'].'</td>
					<td>'.$d['jenis_kiriman'].'</td>
					<td align="center">'.format_angka($d['jml_koli']).'</td>
					<td>'.$d['satuan'].'</td>
					<td align="right">'.format_angka($d['m3']).'</td>
					<td align="right">'.format_angka($d['kg']).'</td>
					<td  align="right">'.currency($d['total_harga']).'</td>
				  </tr>';
		}
	} 
	echo '</table>';
	return ob_get_clean();
}
function generate_urut_invoice($prefik="",$digit=3,$table="invoice"){
	global $mysql;
	$prefik=$prefik; 
	$prefik_length=strlen($prefik);
	
	$getmaxnumber=$mysql->get1value(" SELECT max(index_nota) nomor FROM $table WHERE LEFT(urut,$prefik_length)='$prefik' ");
	$temp_max=$getmaxnumber+1;
	if(strlen($temp_max)>$digit){
		
		$digit+=(strlen($temp_max)-$digit);	
		$getmaxnumber=$mysql->get1value(" SELECT max(index_nota) nomor FROM $table WHERE LEFT(urut,$prefik_length)='$prefik' ");
		
		if($temp_max<(abs($getmaxnumber)+1)){
			$temp_max=abs($getmaxnumber)+1;
		}
	}
	$maxnumber=$temp_max;
	return $prefik.str_pad($maxnumber,$digit, "0", STR_PAD_LEFT);
}
?>