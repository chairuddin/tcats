
document.addEventListener("DOMContentLoaded", function() {
window.updateStatus = function(element) {
	var taskId = element.dataset.id;
	var status = element.dataset.value;

	var dropdownButton = element.closest('.btn-group').querySelector('.dropdown-toggle');
	yonachecklist=dropdownButton.querySelector('.yona_checklist');
	yonachecklist.innerHTML = '<span class="loading-gif"></span>';
	
	// Send AJAX request to update status
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '<?php echo backendurl("dashboard_v2/update_status")?>', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
		var response = JSON.parse(xhr.responseText);
		if (response.status === 'true') {
			// Update the status text in the button
			yonachecklist.innerHTML = '';
			document.getElementById('yona_update_at_'+taskId).textContent=response.update_at;
			yonachecklist.textContent = status;
			//load_data_list();
		} else {
			alert('Failed to update status: ' + response.msg);
		}
	};
	xhr.send('task_id=' + taskId + '&status=' + status);
	
};
});


$(document).ready(function(){
	
	
	$("#lembaga_jenis").change(function(){
		lembaga=$(this).val();
		//1=personal
		//2=sekolah
		//3=yayasan
		//4=csr
		//5=ngo
		//6=dinas
		if(lembaga=='2') {
			$(".field-sekolah").show();
			$(".field-yayasan").hide();
			$(".field-ngo").hide();
		}
		if(lembaga=='3') {
			$(".field-yayasan").show();
			$(".field-sekolah").hide();
			$(".field-ngo").hide();
		}
		if(lembaga=='4' || lembaga=='5') {
			$(".field-yayasan").hide();
			$(".field-sekolah").hide();
			$(".field-ngo").show();
		}
	});

	$(".field-sekolah").hide();
	$(".field-yayasan").hide();
	$(".field-ngo").hide();

	if( $("#lembaga_jenis option:selected").val()=='2' ) {
		$(".field-sekolah").show();
		$(".field-yayasan").hide();
		$(".field-ngo").hide();
	}

	if( $("#lembaga_jenis option:selected").val()=='3' ) {
		$(".field-yayasan").show();
		$(".field-sekolah").hide();
		$(".field-ngo").hide();
	}
	if( $("#lembaga_jenis option:selected").val()=='4' ) {
		$(".field-yayasan").hide();
		$(".field-sekolah").hide();
		$(".field-ngo").show();
	}
	if( $("#lembaga_jenis option:selected").val()=='5' ) {
		$(".field-yayasan").hide();
		$(".field-sekolah").hide();
		$(".field-ngo").show();
	}

	load_data_list();
	// datatables
	
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

function load_data_list() {
	var table_task=$('#datalist').DataTable({
		
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
		
		"columnDefs": [
			{ "width": "5%", "targets": 0 },
			{ "width": "40%", "targets": 1 },
			{ "width": "10%", "targets": 2 },
			{ "width": "7%", "targets": 3 },
			{ "width": "5%", "targets": 4 },
		
		  ]
		
		
	});
}