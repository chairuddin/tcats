
<?php 
$tombol_download='<a href="'.fronturl("get_excel_app/?quiz_id=".$quiz_id."&date1=$date1&date2=$date2").'"><span class="progress-download-xls"><i class="fas fa-download"></i>&nbsp;Download Excel</span></a>&nbsp;&nbsp;&nbsp;';
?>
<div class="box-content" id="ujian_realtime">
	<div class="card  card-navy">
		  <div class="card-header border-0">
			<h3 class="card-title"><?=$periode_data_ujian[0]['quiz_title_id'];?> - <?=$_REQUEST['date1']?> s/d <?=$_REQUEST['date2']?></h3>
			  <div class="float-right"><?=$tombol_download?></div>
		  </div>
		  <div class="card-body">
    		  
		  
    		  <div class="row">
    		      <div class="col-md-12 table-responsive">
    		          	<table class="table">
        				<tr>
        				 
              			    <th>Kode</th>
              			    <th>Nama</th>
        				    <th>Score</th>
							<th>Status</th>
        				</tr>
        				<?php if(count($periode_data_ujian)>0): ?>
        				<?php foreach($periode_data_ujian as $i =>$d):?>
        					<tr>
                                <td><?=$d['member_code']?></td>
                                <td><a href="<?=backendurl("app_jawaban/detail/".$d['id'])?>"><?=$d['member_fullname']?></a></td>
                                <td><?=round($d['avg_score'],2)?></td>
								<td><?=($d['avg_score']>=$d['kkm']?'Competent':'Not Competent')?></td>
        				    </tr>
        				<?php endforeach;?>
        				<?php endif;?>
        				</table>
    		        
    		      </div>
    		  </div>    
		  </div>
	</div>
</div>


