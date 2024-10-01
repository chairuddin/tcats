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

function remove_prospek(lembaga_id,prospek_id) {
	//alert(lembaga_id+"vs"+prospek_id);
	let postObj = { 
		lembaga_id: lembaga_id, 
		prospek_id: prospek_id, 
	}
	let post = JSON.stringify(postObj)

	fetch('<?php echo backendurl("$modul/remove_prospek")?>', {
		method: 'post',
		body: post,
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json'
		}
	}).then((response) => {
		return response.json()
	}).then((res) => {
		if (res.status === 201) {
			console.log("Post successfully created!")
		}
	}).catch((error) => {
		console.log(error)
	})

}
function add_prospek(lembaga_id,prospek_id) {
	//alert(lembaga_id+"vs"+prospek_id);
	let postObj = { 
		lembaga_id: lembaga_id, 
		prospek_id: prospek_id, 
	}
	let post = JSON.stringify(postObj)

	fetch('<?php echo backendurl("$modul/add_prospek")?>', {
		method: 'post',
		body: post,
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json'
		}
	}).then((response) => {
		return response.json()
	}).then((res) => {
		if (res.status === 201) {
			console.log("Post successfully created!")
		}
	}).catch((error) => {
		console.log(error)
	})

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
			'autoWidth'	  : false ,
			'processing'  : true,
			'serverSide'  : true,
			'order': [[0, 'desc']],
			"ajax": {
				"url": '<?php echo backendurl("$modul/data")?>',
				"type": "POST"
			},
			
			"columnDefs": [
				{ "width": "4%", "targets": 0 },
				{ "width": "7%", "targets": 1 },
				{ "width": "15%", "targets": 2 },
				{ "width": "5%", "targets": 3 },
				{ "width": "5%", "targets": 4 },
				{ "width": "5%", "targets": 5 },
				{ "width": "7%", "targets": 6 },
			  ]
			
			
		});

		var table=$('#filter-datalist-prospek').DataTable({
		
			"pageLength": 100,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : false,
			'info'        : false,
			'autoWidth'	  : false,
			'responsive'  : true,
			'processing'  : true,
			'serverSide'  : true,
			'order': [[0, 'desc']],
			"ajax": {
				"url": '<?php echo backendurl("$modul/filter-data-prospek/$id")?>',
				"type": "POST"
			},
			
			"columnDefs": [
				{ "width": "5%", "targets": 0 },
				{ "width": "", "targets": 1 },
				{ "width": "10%", "targets": 2 },
				{ "width": "10%", "targets": 3 },
				{ "width": "25%", "targets": 4 },
				
			  ]
			
			
		});

		table.on('click', '.btn-add-prospek', (e) => {
			let classList = e.currentTarget.classList;
		 
			if (classList.contains('selected')) {
				classList.remove('selected');
			}
			else {
				table.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
				classList.add('selected');
			}

			setTimeout(function(){
				table.row('.selected').remove().draw(false);
			},100);
		});
		 
		


		$("#filter").click(function() {
			var is_buy=$("input[name='is_buy']:checked").val();
			var urut_customer=$("input[name='urut_customer']:checked").val();
			var produk_id=$('#produk_id option:selected').val();
			var kurun_waktu=$('#kurun_waktu').val();
			var lembaga_jenis=$('#lembaga_jenis option:selected').val();
			
			// subsequent ajax call, with button click:
			requestUrl = "<?php echo backendurl("$modul/filter-data-prospek/$id")?>?"+"is_buy="+is_buy+"&urut_customer="+urut_customer+"&produk_id="+produk_id+"&lembaga_jenis="+lembaga_jenis+"&kurun_waktu="+kurun_waktu;
			
			table.ajax.url( requestUrl ).load();
		  });





		  var table2=$('#datalist-prospek').DataTable({
		
			"pageLength": 100,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : true,
			'info'        : false,
			'responsive'  : true,
			'processing'  : true,
			'serverSide'  : true,
			'order': [[0, 'desc']],
			"ajax": {
				"url": '<?php echo backendurl("$modul/data-prospek/$id")?>',
				"type": "POST"
			},
			
			"columnDefs": [
				{ "width": "5%", "targets": 0 },
				{ "width": "15%", "targets": 1 },
				{ "width": "10%", "targets": 2 },
				{ "width": "10%", "targets": 3 },
				{ "width": "10%", "targets": 4 },
				
			  ]
			
			
		});

		table2.on('click', '.btn-remove-prospek', (e) => {
			
			let classList = e.currentTarget.classList;
		 
			if (classList.contains('selected')) {
				classList.remove('selected');
			}
			else {
				table2.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
				classList.add('selected');
			}

			setTimeout(function(){
				table2.row('.selected').remove().draw(false);
			},100);
		});
		 

		var table3=$('#progress_list_data').DataTable({
		
			"pageLength": 100,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : true,
			'info'        : false,
			'responsive'  : true,
			'autoWidth'	  : false ,
			'processing'  : true,
			'serverSide'  : true,
			'order': [[0, 'desc']],
			"ajax": {
				"url": '<?php echo backendurl("$modul/progress_list_data/$id")?>',
				"type": "POST"
			},
			
			"columnDefs": [
				{ responsivePriority: 1, targets: 0 },
				{ responsivePriority: 2, targets: 5 },
				{ "width": "5%", "targets": 0 },
				{ "width": "40%", "targets": 1 },
				{ "width": "10%", "targets": 2 },
				{ "width": "10%", "targets": 3 },
				{ "width": "15%", "targets": 4 },
				{ "width": "10%", "targets": 5 },
				{ "width": "10%", "targets": 6 },
	
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

	function show_data(id) {

		$.ajax({
		  url: '<?php echo backendurl("prospek/history/")?>'+id, // Replace with your actual endpoint
		  method: 'GET',
		  success: function(response) {
			// Build the HTML content for the table
			 tableContent = response;
	  
			// Display the SweetAlert popup with the table content
			Swal.fire({
				title: "<strong>Penawaran</strong>",
				icon: "info",
				html:tableContent,
				showCloseButton: true,
				showCancelButton: false,
				focusConfirm: false,
				width: '100%',
				
			  });
			
		  },
		  error: function(error) {
			// Handle the error, if any
			console.log('Error fetching data:', error);
		  }
		});
	  }
	  
	  // Attach click event to the Show Data l
