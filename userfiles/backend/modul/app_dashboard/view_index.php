
<?php


$form_date1=$form->element_Textbox("","date1",array('autocomplete'=>'off','placeholder'=>'Periode Awal','value'=>$_REQUEST['date1']));
$form_date2=$form->element_Textbox("","date2",array('autocomplete'=>'off','placeholder'=>'Periode Akhir','value'=>$_REQUEST['date2']));

?>
<div class="box-content" id="ujian_realtime">
	<div class="card  card-navy">
		  <div class="card-header border-0">
			<h3 class="card-title">Uji Kompetensi berdasarkan periode</h3>
		  </div>
		  <div class="card-body">
    		   <form role="form" method="GET" id="form-member"  class="form-member yona-validation" action=""  novalidate enctype="multipart/form-data">     
    		   <div class="row filter-dashboard mb-4">
    		        <div class="col-md-2"><?=$form_date1?></div>	
    		        <div class="col-md-2"><?=$form_date2?></div>
    		        <div class="col-md-2"><button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button></div>	
    		   </div>
    		  </form>
		  
    		  <div class="row">
    		      <div class="col-md-12 table-responsive">
    		          	<table class="table">
        				<tr>
        				 
              			    <th>Ujian</th>
        				    <th>Peserta</th>
        				</tr>
        				<?php if(count($periode_data_ujian)>0): ?>
        				<?php foreach($periode_data_ujian as $i =>$d):?>
        					<tr>
        				    <td><a href="<?=backendurl("app_jawaban?date1=$request_date1&date2=$request_date2&material_id={$d['material_id']}")?>"><?=$d['title']?></a></td>
        				    <td><a  class="btn btn-info" href="<?=backendurl("app_jawaban?date1=$request_date1&date2=$request_date2&material_id={$d['material_id']}")?>"> <?=$d['jumlah']?></a></td>
        				</tr>
        				<?php endforeach;?>
        				<?php endif;?>
        				</table>
    		        
    		      </div>
    		  </div>    
		  </div>
	</div>
</div>



<div class="box-content" id="ujian_realtime">
	<div class="card  card-navy">
		  <div class="card-header border-0">
			<h3 class="card-title">Ujian Terbaru</h3>
		  </div>
		  <div class="card-body table-responsive">
				<table class="table">
				<tr>
				    <th>Waktu</th>
				    <th>Nama</th>
				    <th>Ujian</th>
				    <th>Score</th>
				</tr>
				<?php if(count($data_ujian)>0): ?>
				<?php foreach($data_ujian as $i =>$d):?>
					<tr>
				    <td><?=$d['end_time']?></td>
				    <td><?=$d['member_fullname']?></td>
				    <td><?=$d['title']?></td>
				    <td><?=round($d['avg_score'],2)?></td>
				</tr>
				<?php endforeach;?>
				<?php endif;?>
				</table>
		  </div>
	</div>
</div>

<?php
$url_data=backendurl("$modul/data?category_id=$category_id&is_paid=$action");

$script_js.=<<<END

<script>
$(document).ready(function(){
	  
	// datatables
		$('#datalist').DataTable({
		
			'searching'   : true,
			'ordering'    : true,
			'info'        : true,
			'responsive'  : true,
			'processing'  : true,
			'serverSide'  : true,
			"ajax": {
				"url": '$url_data',
				"type": "POST"
			
			 },
			 "order": [
				[ 0, "desc" ]
			],
			
			
		});
		
	});
	
</script>
END;
?>