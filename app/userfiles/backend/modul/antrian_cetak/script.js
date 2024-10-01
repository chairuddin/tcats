$(document).ready(function(){
		
	$('input[name="tanggal_selesai"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 2021,
		maxYear: parseInt(moment().format('YYYY'),10),
		locale: {
			format: 'DD/MM/YYYY'
		}
	  }, function(start, end, label) {
		//var years = moment().diff(start, 'years');
		//alert("You are " + years + " years old!");
	  });
	  
		//bsCustomFileInput.init();
		
	// datatables
		$('#datalist').DataTable({
		
			"pageLength": 100,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : true,
			'info'        : false,
			'responsive'  : true,
			'processing'  : true,
			'serverSide'  : true,
			"ajax": {
				"url": '<?php echo backendurl("$modul/data")?>',
				"type": "POST"
			},
			"order": [[ 0, 'ASC' ]],
			"columnDefs": [
				{ 
					"targets": [0,1,2,3,4], //first column / numbering column
					"orderable": false, //set not orderable
				}
			],
			
		});
		
	});
