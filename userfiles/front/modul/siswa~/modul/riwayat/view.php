<?php
include "function.php";
$list_riwayat=list_riwayat();
?>
<div class="card  card-primary">
	  <div class="card-header border-0">
		<h3 class="card-title">Riwayat Ujian</h3>
	  </div>
	  <div class="card-body table-responsive p-0">
		<?php if (count($list_riwayat>0)) : ?>
		<table class="table table-striped table-valign-middle">
		  <thead>
		  <tr>
			<th>Pelajaran</th>
			<th>Waktu</th>
			<th>Score</th>
			<th>Status</th>
			<?php 
			if($mode_pembahasan) {
				echo '<th>Pembahasan</th>';
			}
			?>
		  </tr>
		  </thead>
		  <tbody>
			<?php foreach( $list_riwayat as $i => $data)  : ?>
			<tr>
			<td><?php echo $data['quiz_title_id']?></td>
			<td><?php echo tgl_indo_waktu($data['check_point']);?></td>
			<td><?php echo $data['score']+$data['score_essay'];?></td>
			<td><?php echo status_ujian($data['is_done']);?></td>
			<?php 
			if($mode_pembahasan) {
				if($data['is_done']==1) {
					echo '<td><a href="'.fronturl("quiz_bahas/".$data['token']).'">Lihat</a></td>';
				} else {
					echo '<td>&nbsp;</td>';
				}
			}
			?>
			</tr>
			<?php endforeach ?>
		  </tr>
		  </tbody>
		</table>
		<?php endif ?>
	  </div>
	</div>

