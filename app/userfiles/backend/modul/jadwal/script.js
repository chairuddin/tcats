async function ringkasan_view(kegiatan_id) {
	fetch('<?php echo backendurl("jadwal/ringkasan_view?kegiatan_id=")?>'+kegiatan_id)
	.then((response) => {
	return response.text();
	})
	.then((html) => {
		$("#ringkasan_jadwal").html(html);    
	});
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
			alert('a');
			/*
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
		*/
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
		
	  }

   });


   

});



//tambah
<?php
$option_coach='';
$q_coach=$mysql->query(" SELECT id,id_trainer,nama FROM coach WHERE status_aktif=1 ORDER BY nama");
if($q_coach and $mysql->num_rows($q_coach)>0) {
	while($d_coach = $mysql->fetch_assoc($q_coach)) {
		$option_coach.='<option value="'.$d_coach['id'].'">['.$d_coach['id_trainer'].'] '.$d_coach['nama'].'</option>';
	}
}
?>
function addDay() {
	
	

	let table = document.getElementById("scheduleContainer").getElementsByTagName('tbody')[0];
	let dayIndex = table.childElementCount + 1;
	// Create row element
	let row = document.createElement("tr");
	
	// Create cells
	let c1 = document.createElement("td");
	let c2 = document.createElement("td");
	let c3 = document.createElement("td");
	let c4 = document.createElement("td");
	let c5 = document.createElement("td");
	
	// Insert data to cells
	c1.innerText = dayIndex-1;
	c2.innerHTML =`<input type="date" class="form-control" id="day${dayIndex}Date" name="schedule[${dayIndex}][tanggal]" required>`;
	c3.innerHTML = `<input type="time"  class="form-control" id="day${dayIndex}StartTime" name="schedule[${dayIndex}][jam_mulai]" required>`;
	c4.innerHTML = `<input type="time"  class="form-control" id="day${dayIndex}EndTime" name="schedule[${dayIndex}][jam_selesai]" required>`;
	c5.innerHTML = `<select id="day${dayIndex}Coaches" name="schedule[${dayIndex}][coaches][]" multiple class="js-select2 form-control">
	<?php echo $option_coach;?>
</select>`;
	// Append cells to row
	row.appendChild(c1);
	row.appendChild(c2);
	row.appendChild(c3);
	row.appendChild(c4);
	row.appendChild(c5);
	// Append row to table body
	table.appendChild(row)
	

	// Initialize Select2 for the new coach selection input
	$(".js-select2").select2();
}

$(document).ready(function(){
	$(".js-select2").select2();

	$('#personal_id').select2({
		ajax: {
		  url: '<?php echo backendurl("jadwal/get_personal_id")?>', // Replace with your actual endpoint
		  dataType: 'json',
		  delay: 250,
		  processResults: function(data) {
			// Assuming your data is in the format { results: [{id: ..., text: ...}, ...] }
			return {
			  results: data
			};
		  },
		  cache: true
		}
	  });

})
function copyToClipboard() {
	// Get the input element
	var inputElement = document.getElementById("bagikan_link");

	// Select the text in the input element
	inputElement.select();
	inputElement.setSelectionRange(0, 99999); // For mobile devices

	try {
	  // Attempt to copy the selected text to the clipboard using the Clipboard API
	  document.execCommand("copy");

	  // Display a success message
	  showMessage("Text copied to clipboard!");
	} catch (err) {
	  // If the copy command fails, display an error message
	  showMessage("Oops, unable to copy text to clipboard. Please try manually.");
	}

	// Deselect the text (optional)
	inputElement.setSelectionRange(0, 0);
  }

  function showMessage(message) {
	// Display the message in the "copyMessage" element
	var messageElement = document.getElementById("copyMessage");
	messageElement.textContent = message;

	// Clear the message after a few seconds (you can adjust the delay)
	setTimeout(function() {
	  messageElement.textContent = "";
	}, 3000);
  }