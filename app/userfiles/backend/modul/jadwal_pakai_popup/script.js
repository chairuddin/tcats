<?php

/*
{
title: "Hey!",
start: new Date(e.now() + 158e6),
className: "bg-dark"
}, {
title: "See John Deo",
start: n,
end: n,
className: "bg-danger"
}, {
title: "Buy a Theme",
start: new Date(e.now() + 338e6),
className: "bg-primary"
	}
*/
?>

async function ringkasan_view(kegiatan_id) {
	fetch('<?php echo backendurl("jadwal/ringkasan_view?kegiatan_id=")?>'+kegiatan_id)
	.then((response) => {
	return response.text();
	})
	.then((html) => {
		$("#ringkasan_jadwal").html(html);    
	});
}

async function postData(url = "", data = {}) {
	// Default options are marked with *
	const response = await fetch(url, {
	  method: "POST", // *GET, POST, PUT, DELETE, etc.
	  mode: "cors", // no-cors, *cors, same-origin
	  cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
	  credentials: "same-origin", // include, *same-origin, omit
	  headers: {
		"Content-Type": "application/json",
		// 'Content-Type': 'application/x-www-form-urlencoded',
	  },
	  redirect: "follow", // manual, *follow, error
	  referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
	  body: JSON.stringify(data), // body data type must match "Content-Type" header
	});
	return response.json(); // parses JSON response into native JavaScript objects
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
			"ajax": {
				"url": '<?php echo backendurl("$modul/data")?>',
				"type": "POST"
			},
			
			"columnDefs": [
				{ "width": "5%", "targets": 0 },
				{ "width": "15%", "targets": 1 },
				{ "width": "15%", "targets": 2 },
				{ "width": "10%", "targets": 3 },
				{ "width": "10%", "targets": 4 },
				
			
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
		
	


$('#createEventForm').on('submit', function(e) {
	e.preventDefault();

	var jadwal_id = $('#jadwal_id').val();
	const kegiatan_id = $('#kegiatan_id').val();
	var produk_id = $('#produk_id').val();
	var waktu_mulai = $('#waktu_mulai').val();
	var waktu_selesai = $('#waktu_selesai').val();
	
	const coach=[];
	const select_coach = document.querySelectorAll('select[name="coach[]"]');
	select_coach.forEach(coach_array => {
		coach.push(coach_array.value);
	});
   
	postData("<?php echo backendurl("jadwal/save")?>", { produk_id: produk_id,waktu_mulai:waktu_mulai,waktu_selesai:waktu_selesai,coach:coach,kegiatan_id:kegiatan_id,jadwal_id:jadwal_id }).then((data) => {
  		console.log(data); // JSON data parsed by `data.json()` call
		  $('#createEventModal').modal('hide');
		  $('#calendar').fullCalendar('refetchEvents');
		  ringkasan_view(kegiatan_id);
			$('#jadwal_id').val('');
			$('#produk_id').val('');
			$('#waktu_mulai').val('');
			$('#waktu_selesai').val('');
			const coaches_reset = document.querySelectorAll('select[name="coach[]"]');
			coaches_reset.forEach(coach => {
				coach.value = '';
			});

	});
/*
	$.ajax({
	   url: '<?php echo backendurl("jadwal/save")?>',
	   type: 'POST',
	   dataType: "jsonp",
	   data: {
		 kegiatan_judul: kegiatan_judul,
		 waktu_mulai: waktu_mulai,
		 waktu_selesai: waktu_selesai
	   },
	   success: function(response) {
		 $('#createEventModal').modal('hide');
		 $('#calendar').fullCalendar('refetchEvents');
	   }
	});
	*/
   });
   
   <?php $kegiatan_id=$_GET['kegiatan_id'];?>
   $('#calendar').fullCalendar({
	events: {
	   url: '<?php echo backendurl("jadwal/load?kegiatan_id=$kegiatan_id")?>',
	   type: 'POST',
	},
	editable: false,
	disableDragging: true,
	eventClick: function(event) {
		if(event.disabled==1) {
			console.log('disabled');
		} else {
			
			$('#jadwal_id').val(event.jadwal_id);
			$('#kegiatan_id').val(event.kegiatan_id);
			$('#produk_id').val(event.produk_id);
			$('#waktu_mulai').val(event.waktu_mulai);
			$('#waktu_selesai').val(event.waktu_selesai);
			i=0;
			const coaches = document.querySelectorAll('select[name="coach[]"]');
			coaches.forEach(coach => {
				coach.value = event.coach[i];
				i++;
			});

		console.log(event);
		$('#createEventModal').modal('show');
		}
	
	},
	eventDrop: function(event, delta, revertFunc) {
		if(event.disabled==1) {
			console.log('disabled');
		} else {
			if(event) {
			console.log(event.start.format());
			//console.log(event.end.format());
			console.log(event);
			}
		}
		// Get the new start and end dates.
		/*
		var newStart = event.start.format();
		var newEnd = event.end.format();
		// Update the event with the new dates.
		event.start = newStart;
		event.end = newEnd;
		alert(newStart);
		// Save the event.
		/*
		$.ajax({
		  url: 'update_event.php',
		  type: 'POST',
		  data: {
			id: event.id,
			start: newStart,
			end: newEnd
		  },
		  success: function(data) {
			// The event was updated successfully.
		  },
		  error: function(data ) {
			// There was an error updating the event.
			//revertFunc();
		  }
		});
		*/
	  }

   });

});
