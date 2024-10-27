
<?php


$form_date1=$form->element_Textbox("","date1",array('autocomplete'=>'off','placeholder'=>'Periode Awal','value'=>$_REQUEST['date1']));
$form_date2=$form->element_Textbox("","date2",array('autocomplete'=>'off','placeholder'=>'Periode Akhir','value'=>$_REQUEST['date2']));

?>

<?php if(count($data_ujian_ulang)>0): ?>
<div class="box-content" id="ujian_realtime">
	<div class="card  card-navy">
		  <div class="card-header border-0">
			<h3 class="card-title">Permintaan Ujian Ulang</h3>
		  </div>
		  <div class="card-body table-responsive">
				<table class="table">
				<tr>
				    <th>Waktu</th>
				    <th>Indeks/TIK</th>
				    <th>Nama</th>
				    <th>Ujian</th>
					<th>Retake</th>
					<th>Score</th>
				    <th>Action</th>
				</tr>
				
				<?php foreach($data_ujian_ulang as $i =>$d):?>
					<tr id="uji_ulang_<?=$d['id']?>">
				    <td><?=$d['created_at']?></td>
				     <td><?=link_to_profile($d['member_id'],$d['username'],$attr="");?></td>
				    <td><?=link_to_profile($d['member_id'],$d['fullname'],$attr="");?></td>
				    <td><?=link_to_result($d['quiz_done_id'],$d['title'])?></td>
					<td><?=$d['retake']?></td>
					<td><?=round($score_ujian_ulang[$d['quiz_done_id']],2)?></td>
				    <td><a href="#" onclick="accept('<?=$d['id']?>')" class="btn btn-success mr-2">Terima</a><a  href="#" onclick="deny('<?=$d['id']?>')" class="btn btn-danger">Tolak</a></td>
				</tr>
				<?php endforeach;?>
				
				</table>
		  </div>
	</div>
</div>
<?php endif;?>


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
				    <th>Indeks/TIK</th>
				    <th>Nama</th>
				    <th>Ujian</th>
				    <th>Score</th>
				</tr>
				<?php if(count($data_ujian)>0): ?>
				<?php foreach($data_ujian as $i =>$d):?>
					<tr>
				    <td><?=$d['end_time']?></td>
				    <td><?=link_to_profile($d['member_id'],$d['member_code'],$attr="");?></td>
				    <td><?=link_to_profile($d['member_id'],$d['member_fullname'],$attr="");?></td>
				    <td><?=link_to_result($d['id'],$d['title'])?></td>
				    <td class="text-right"><?=round($d['avg_score'],2)?></td>
				</tr>
				<?php endforeach;?>
				<?php endif;?>
				</table>
		  </div>
	</div>
</div>

<?php
$url_data=backendurl("$modul/data?category_id=$category_id&is_paid=$action");
$url_api_request_test=backendurl('api_request_test');
$script_js.=<<<END

<script>

function accept(request_id) {
 				$.ajax({
                    url: '$url_api_request_test', // Replace with your server URL
                    type: 'POST',
                    data: {
                        request_id: request_id,
						mode:'accept',
            
                    },
                    dataType: 'json', // Expect JSON response
                    success: function (response) {
                       if(response.success==1) {
					  		$('#uji_ulang_'+request_id).remove();
						} else {
						 	alert(response.msg);
						}
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $('#response').html('<p>Error: ' + textStatus + '</p>');
                    }
                });
}
function deny(request_id) {
				$.ajax({
                    url: '$url_api_request_test', // Replace with your server URL
                    type: 'POST',
                    data: {
                        request_id: request_id,
						mode:'deny',
            
                    },
                    dataType: 'json', // Expect JSON response
                    success: function (response) {
                       if(response.success==1) {
					  		$('#uji_ulang_'+request_id).remove();
						} else {
						 	alert(response.msg);
						}
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $('#response').html('<p>Error: ' + textStatus + '</p>');
                    }
				 });
}


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