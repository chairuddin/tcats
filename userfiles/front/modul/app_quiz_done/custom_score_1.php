
<h4>Pilihan Ganda</h4>
<table class="score_exam_table">
	<?php
	
	if($info['custom_score']!=2){
	?>
	<tr>
		<td>Jawaban Benar</td><td>:</td><td class="kolom_nilai"><?php echo $info['benar'];?></td>
	</tr>
	<tr>
		<td>Jawaban Salah</td><td>:</td><td class="kolom_nilai"><?php echo $info['salah'];?></td>
	</tr>
	<?php
	}
	
	if($info['custom_score']!=2 && $info['tidak_jawab']>0){
	?>
	<tr>
		<td>Tidak Jawab</td><td>:</td><td class="kolom_nilai"><?php echo $info['tidak_jawab'];?></td>
	</tr>
	<?php
	}
	
	if($info['kkm']>0){
		
	?>
	<tr class="score_kkm">
		<td>KKM</td><td>:</td><td class="kolom_nilai"><?php echo $info['kkm'];?></td>
	</tr>
	<?php
	}
	?>
	<tr class="score_final">
		<td>Skor</td><td>:</td><td class="kolom_nilai"><?php echo $info['score'];?></td>
	</tr>
</table>
<?php 

if($info['score_essay']!='') :
?>
<hr/>
<h4>Essay</h4>
<table class="score_exam_table">
	<tr class="score_final">
		<td>Skor</td><td>:</td><td class="kolom_nilai"><?php echo $info['score_essay'];?></td>
	</tr>
</table>
<?php endif;?>
