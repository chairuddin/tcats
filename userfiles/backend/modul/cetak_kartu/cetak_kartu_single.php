<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<title><?php  echo $id ?></title>

</head>
<body>
<style>@media print {
    footer {page-break-after: always;}
    *{
    font-family: "Poppins", sans-serif;
}
    .kartu-wrapper{
        background: url(<?php echo $config['backendurl'];?>/images/bg-card.png)no-repeat;
        border: 0 !important;
        background-size: cover;
        height: 7.2cm;
        padding: 6px 10px 0 40px !important;
    }
}
*{
    font-family: "Poppins", sans-serif;
}
    .kartu-wrapper{
        background: url(<?php echo $config['backendurl'];?>/images/bg-card.png)no-repeat;
        border: 0 !important;
        background-size: cover;
        height: 7.2cm;
        padding: 6px 10px 0 40px !important;
    }
</style>
<?php

function kartu($data) {
extract($data);
?>
<table style="width:10.2cm;border:1px solid black; padding-top:6px; font-family:Arial, Helvetica, sans-serif; font-size:12px" class="kartu kartu-wrapper" border="0">
					<tbody>
     <!--               <tr>-->
					<!--	<td colspan="3" style="padding:1px" align="center">-->
					<!--		<table width="98%" class="kartu" cellpadding="0px">-->
					<!--		<tbody><tr>-->
					<!--			<td><img src="<?php echo $url_logo_sekolah; ?>" height="48"></td>-->
					<!--			<td align="center" style="font-weight:bold">-->
					<!--				<?php echo $judul_kartu; ?> <br><?php echo $sub_judul_kartu; ?> <BR /> -->
					<!--		  </td>-->
					<!--		</tr>-->
					<!--		</tbody></table>-->
					<!--	</td>-->
					<!--</tr>-->
					<tr>
					    <td colspan="3" style="height:1.85cm"></td>
					</tr>
			<tr height="10px"><td style="width:38%" >&nbsp;No. Indeks</td><td style="width:1%">:</td><td style="font-size:12px;font-weight:normal;"><?php echo $nomor_ujian; ?></td></tr>
			<tr height="10px"><td width="90">&nbsp;Full Name</td><td width="8">:</td><td width="226" style="font-size:12px;font-weight:normal;"><?php echo $nama_siswa ?></td></tr>
			<tr height="10px"><td width="90">&nbsp;Organization Unit</td><td width="8">:</td><td width="226" style="font-size:12px;font-weight:normal;"><?php echo $organization_unit ?></td></tr>
			<tr height="10px"><td width="90">&nbsp;Position</td><td width="8">:</td><td width="226" style="font-size:12px;font-weight:normal;"><?php echo $position ?></td></tr>
			<?php if($jurusan!='') { ?>
			<tr height="10px"><td>&nbsp;Jurusan</td><td>:</td><td style="font-size:12px;font-weight:normal;"><?php echo $jurusan; ?></td></tr>    
			<?php }?>
			<?php if($ruang!=""){?>
				<tr height="10px"><td>&nbsp;Ruang</td><td>:</td><td style="font-size:12px;font-weight:normal;">
			<?php echo $ruang; ?></td></tr>  
			<?php }?>
			                    
			<?php if($jurusan=='') { ?>
			<!--<tr height="10px"><td>&nbsp;</td><td></td><td style="font-size:12px;font-weight:normal;"></td></tr>    -->
			<?php }?>
			<tr>
			<td colspan="3">
			<table border="0" width="100%" style="margin-top:-27px">
			<tr height="10px">
			<td  valign="top" align="center" style="font-size:12px;font-weight:bold;width:50%;">
			<!--<?php echo $nama_sekolah; ?><br/>-->
			<!--Ttd ,<br/><br/>-->
			<!--<?php echo $nama_kepsek; ?>-->
			</td>
			<td " align="right" style="padding-right:14px" ><img src="<?php echo $url_qrcode; ?>" height="64px" border="thin solid red"></td>            </tr>                 
			
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
$q = $mysql->query("SELECT id,username,fullname,jurusan,class, ruang FROM quiz_member WHERE id='$id'");
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
