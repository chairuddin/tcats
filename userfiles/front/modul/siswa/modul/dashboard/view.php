<?php
include 'function.php';
$list_pengumuman = list_pengumuman();
$list_jadwal = list_jadwal();
?>
<div class="row">
<?php if(count($list_pengumuman)>0) : ?>
<div class="col-md-12">
	<div class="card  card-primary">
	<div class="card-header border-0">
		<h3 class="card-title">Pengumuman</h3>
	  </div>
    <div class="card-body">
	<?php if (count($list_pengumuman>0)) : ?>
	<?php foreach( $list_pengumuman as $i => $data)  : ?>
	<div class="post">
		  <div class="user-block">
			<span class="username">
			  <a href="#"><?php echo $data['fullname'];?></a>
			</span>
			<span class="description"><?php echo $data['title'];?>&nbsp;&nbsp;&nbsp;<?php echo tgl_indo($data['tanggal']);?></span>
		  </div>
		  <!-- /.user-block -->
		  <?php echo $data['content'];?>

	</div>
		<!-- /.post -->
	<?php endforeach ?>
	<?php endif ?>
    </div>
    </div>	
</div>
<?php endif; ?>

<div class="col-md-12">
<div class="card  card-primary">
	  <div class="card-header border-0">
		<h3 class="card-title">Jadwal Ujian</h3>
	  </div>
	  <div class="card-body table-responsive">
		<?php if (count($list_jadwal)>0) { ?>
		<table class="table table-striped table-valign-middle">
		  <thead>
		  <tr>
			<th>Pelajaran</th>
			<th>Aksi</th>
		  </tr>
		  </thead>
		  <tbody>
			<?php foreach( $list_jadwal as $i => $data)  : ?>
			<tr>
			<td><b><?php echo $data['info']['title_id']?></b><br/>
			Dari: <?php echo tgl_indo_waktu($data['tanggal']);?><br/>
			Sampai: <?php echo tgl_indo_waktu($data['tanggal_expired']);?><br/>
			Durasi: <?php echo $data['is_done']==3?$data['quiz_duration']:$data['info']['duration'];?> Menit
			</td>
			<td>
				
			<?php if($d['quiz_done']=="") { ?>	
			 <a title="Mulai Ujian" href="<?php echo fronturl("quiz_login?username=".$biodata['username']."&jadwal_token=".$data['token']."&uniq=".uniqid()."&submit=Mulai+Ujian");?>" class="text-muted">
				<i class="fas fa-play"></i>
			  </a>
			 <?php } ?>	 
			</td>
			</tr>
			<?php endforeach ?>
		  </tr>
		  </tbody>
		</table>
		<?php } else {?>
			<p class=" p-1">Belum ada jadwal ujian</p>
		<?php } ?>
	  </div>
	</div>
	
</div>
<?php
$style_css.=<<<END
.user-block .comment, .user-block .description, .user-block .username {
    display: block;
    margin-left:0 !important;
}
END;

?>
