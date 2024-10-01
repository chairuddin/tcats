$(document).ready(function(){
		
		//bsCustomFileInput.init();
		
	// datatables
		$('#datalist').DataTable({
		
			'searching'   : true,
			'ordering'    : true,
			'info'        : true,
			'responsive'  : true,
			'processing'  : true,
			'autoWidth'   : false,
			'serverSide'  : true,
			"ajax": {
				"url": '<?php echo backendurl("$modul/data")?>',
				"type": "POST"
			},
			"columnDefs": [
				{ 
					"targets": [0,4,5], //first column / numbering column
					"orderable": false, //set not orderable
				}
			],
			
		});
		
	});
