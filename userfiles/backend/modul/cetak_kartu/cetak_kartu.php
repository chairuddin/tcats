<html>
<head>
<title><?php  echo $id ?></title>

</head>
<body>
<style>@media print {
    footer {page-break-after: always;}
}
</style>
<?php

function kartu($data) {
extract($data);
?>
<table style="width:10.2cm;border:1px solid black; padding-top:6px; font-family:Arial, Helvetica, sans-serif; font-size:12px" class="kartu" border="0">
					<tbody>
                    <tr>
						<td colspan="3" style="padding:1px" align="center">
							<table width="98%" class="kartu" cellpadding="0px">
							<tbody><tr>
								<td><img src="<?php echo $url_logo_sekolah; ?>" height="48"></td>
								<td align="center" style="font-weight:bold">
									<?php echo $judul_kartu; ?> <br><?php echo $sub_judul_kartu; ?> <BR /> 
							  </td>
							</tr>
							</tbody></table>
						</td>
					</tr>
			<tr height="10px"><td >&nbsp;Username</td><td>:</td><td style="font-size:12px;font-weight:bold;"><?php echo $nomor_ujian; ?></td></tr>
			<tr height="10px"><td width="90">&nbsp;Nama Peserta</td><td width="8">:</td><td width="226" style="font-size:12px;font-weight:bold;"><?php echo $nama_siswa ?></td></tr>
			<tr height="10px"><td width="90">&nbsp;Kelas</td><td width="8">:</td><td width="226" style="font-size:12px;font-weight:bold;"><?php echo $kelas ?></td></tr>
			<?php if($jurusan!='') { ?>
			<tr height="10px"><td>&nbsp;Jurusan</td><td>:</td><td style="font-size:12px;font-weight:bold;"><?php echo $jurusan; ?></td></tr>    
			<?php }?>
			<tr height="10px"><td>&nbsp;Ruang</td><td>:</td><td style="font-size:12px;font-weight:bold;">
			<?php echo $ruang; ?></td></tr>                      
			<?php if($jurusan=='') { ?>
			<tr height="10px"><td>&nbsp;</td><td></td><td style="font-size:12px;font-weight:bold;"></td></tr>    
			<?php }?>
			<tr>
			<td colspan="3">
			<table border="0" width="100%">
			<tr height="10px">
			<td  valign="top" align="center" style="font-size:12px;font-weight:bold;width:50%;">
			<?php echo $nama_sekolah; ?><br/>
			Ttd ,<br/><br/>
			<?php echo $nama_kepsek; ?>
			</td>
			<td " align="right" ><img src="<?php echo $url_qrcode; ?>" height="70px" border="thin solid red"></td>            </tr>                 
			
			</table>
			</td>
			</tr>
                    
				</tbody></table>
<?php        
}
?>

<?php
$nama_logo=$mysql->get1value("SELECT concat(basename,'.',extension) nama_logo FROM decoration WHERE type='logo'");
$url_logo_sekolah = fileurl("decoration/$nama_logo");
//$nama_sekolah = $mysql->get1value("SELECT title_id FROM web_config WHERE name='nama_sekolah'");
//$nama_kepala_sekolah = $mysql->get1value("SELECT title_id FROM web_config WHERE name='nama_kepsek'");
//$judul_kartu = $mysql->get1value("SELECT title_id FROM web_config WHERE name='judul_kartu'");
//$sub_judul_kartu = $mysql->get1value("SELECT title_id FROM web_config WHERE name='sub_judul_kartu'");

$q=$mysql->query(" SELECT name,title_id FROM web_config WHERE 	name='nama_sekolah' OR 	name='nama_kepsek' OR name='judul_kartu' OR	name='sub_judul_kartu' ");
$var_config=array();
while($d=$mysql->fetch_assoc($q)) {
	$var_config[$d['name']]=$d['title_id'];
}
extract($var_config);
$data_peserta = [];
$q = $mysql->query("SELECT id,username,fullname,jurusan,class, ruang FROM quiz_member WHERE class='$id' ORDER BY username ");
$urut=1;

if($q and $mysql->num_rows($q)>0) {
	while ($d = $mysql->fetch_assoc($q)) {
		
		$data = array(
		'nama_siswa' =>$d['fullname'],
		'kelas' =>$d['class'],
		'nomor_ujian' => $d['username'], 
		'ruang' => $d['ruang'],
		'jurusan' => $d['jurusan'],
		'nama_sekolah' => $nama_sekolah,
		'nama_kepsek'=>$nama_kepsek,
		'judul_kartu'=>$judul_kartu,
		'sub_judul_kartu'=>$sub_judul_kartu,
		'url_logo_sekolah'=>$url_logo_sekolah,
		'url_qrcode'=>generateQRCode(md5(md5($d['id'])),$d['id'])
		);
		$data_peserta[$urut] = $data;
		$urut++;
	}
}

$jumlah_data = ceil(count($data_peserta)/2);
?>
		<table width="100%" border="0" style="margin-top:8px;">
		<?php
		$kolom=1;
		for($baris=1;$baris<=$jumlah_data;$baris++) {
		?>
        <tr>
			<td><?php is_array($data_peserta[$kolom])?kartu($data_peserta[$kolom]):''; ?></td>
			<td><?php $kolom++;is_array($data_peserta[$kolom])?kartu($data_peserta[$kolom]):''; ?></td>
        </tr>
        <?php 
        $kolom++;
        }
        ?>
         </table>

</body>
</html>
