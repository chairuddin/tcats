function hitung_total_harga() {
	total_harga=0;
	 $('.list_produk').each(function (index, obj) {
		
        if (this.checked === true) {
           total_harga+=parseInt($(this).attr('data-harga'));
        }
    });
	
	const formatter = new Intl.NumberFormat('id-ID');
	const formattedNumber = formatter.format(total_harga);

	$("#harga").val(formattedNumber);
}
$(document).ready(function(){
	
		
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
			'autoWidth'   : false,
			"ajax": {
				"url": '<?php echo backendurl("$modul/data")?>',
				"type": "POST"
			},
			
			"columnDefs": [
				{ "width": "5%", "targets": 0 },
				{ "width": "5%", "targets": 1 },
				{ "width": "10%", "targets": 2 },
				{ "width": "5%", "targets": 3 },
				{ "width": "5%", "targets": 4 },
			  ]
			
			
		});
			/*
			responsive: {
				details: false
			},

			"columnDefs": [
				{ 
					"targets": [0,2], //first column / numbering column
					"orderable": false, //set not orderable
				}
			],
			*/
		/*	
		$('.min-date').bootstrapMaterialDatePicker({
			format: 'DD/MM/YYYY',
			time: false,
			minDate: '01/01/2022'
		});
		*/
		
	});
