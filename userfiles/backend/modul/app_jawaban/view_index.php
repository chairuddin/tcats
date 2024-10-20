
<?php 

$tombol_download='<a href="'.fronturl("get_excel_app/?material_id=".$_GET['material_id']."&date1=$date1&date2=$date2").'"><span class="progress-download-xls"><i class="fas fa-download"></i>&nbsp;Download Excel</span></a>&nbsp;&nbsp;&nbsp;';
?>
<div class="box-content" id="ujian_realtime">
	<div class="card  card-navy">
		  <div class="card-header border-0">
			<h3 class="card-title"><?=$periode_data_ujian[0]['kompetensi'];?> - <?=$_REQUEST['date1']?> s/d <?=$_REQUEST['date2']?></h3>
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
                                <td><a href="<?=backendurl("app_profile/view/".md5(md5($d['member_id'])))?>"><?=$d['member_code']?></a></td>
                                <td><a href="<?=backendurl("app_profile/view/".md5(md5($d['member_id'])))?>"><?=$d['member_fullname']?></a></td>
                                <td><a href="<?=backendurl("app_result/view/".md5($d['id']))?>"><?=round($d['avg_score'],2)?></a></td>
								<td><a href="<?=backendurl("app_result/view/".md5($d['id']))?>"><?=($d['avg_score']>=$d['kkm']?'Competent':'Not Competent')?></a></td>
        				    </tr>
        				<?php endforeach;?>
        				<?php endif;?>
        				</table>
    		        
    		      </div>
    		  </div>    
		  </div>
	</div>
</div>


