<?php
$id=cleanInput($action,'code');
list($data)=$mysql->query_data("SELECT nomor,nik,nama,jenis_kelamin,tanggal_lahir,nik,pekerjaan,alamat,status_tes,date_format(tanggal,'%Y-%m-%d') tanggal_ambil,date_format(tanggal_selesai,'%Y-%m-%d') tanggal_selesai FROM invoice WHERE urut='$id'");
extract($data);
?>

<div class="container text-center">
	<div class="row">
		<div class="col-md-12">
		<div class="logo">
			<a href="#">
				<img src="<?php echo fileurl("asset/logo.png?v=1");?>" alt="bimbel78">
			</a>
		</div>
		<?php if($nomor!=''):?>
		<h1 class="text-success">Valid</h1>
			<table>
				<tr><td colspan="3">SARS-COV2 Antigen Rapid Test Cassette</td></tr>
				<tr><td>Nomor</td><td>:</td><td><?php echo $nomor;?></td></tr>
				<tr><td>Tgl. Pengambilan</td><td>:</td><td><?php echo tgl_indo_long($tanggal_ambil);?></td></tr>
				<tr><td>Tgl. Selesai</td><td>:</td><td><?php echo tgl_indo_long($tanggal_selesai);?></td></tr>
				<tr><td>NIK</td><td>:</td><td><?php echo $nik;?></td></tr>
				<tr><td>Nama</td><td>:</td><td><?php echo $nama;?></td></tr>
				<tr><td>Jenis Kelamin</td><td>:</td><td><?php echo get_jenis_kelamin($jenis_kelamin);?></td></tr>
				<tr><td>Pekerjaan</td><td>:</td><td><?php echo $pekerjaan;?></td></tr>
				<tr><td>Alamat</td><td>:</td><td><?php echo $alamat;?></td></tr>
				<tr><td>Hasil</td><td>:</td><td><?php echo '<span style="'.($status_tes==2?'color:red':'').'">'.(get_hasil_tes($status_tes)).'</span>';?></td></tr>
				</table>
		<?php endif;?>		
		<?php if($nomor==''):?>
		<h1 class="text-danger">Data tidak valid</h1>
		<?php endif;?>
		</div>
	</div>
</div>
