function uploadFile(doc_type,deal_id) {
	
    const fileInput = document.getElementById(doc_type);
    const file = fileInput.files[0];
	
    if (file) {
        const formData = new FormData();
        formData.append('file', file);
	    const xhr = new XMLHttpRequest();

        xhr.upload.addEventListener('progress', function (event) {
            if (event.lengthComputable) {
                const percentComplete = (event.loaded / event.total) * 100;
                const progressBar = document.getElementById(doc_type+'_progressBar');
                progressBar.style.width = percentComplete + '%';
                progressBar.innerHTML = percentComplete.toFixed(2) + '%';
            }
        });

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                // File upload complete
                if (xhr.status === 200) {
					response=JSON.parse(xhr.responseText);
					if(response.success=='1') {
						document.getElementById(doc_type+'_link').style.display = 'block';
						document.getElementById(doc_type+'_link').href = response.url;
						
					} else {
						document.getElementById(doc_type+'_link').style.display = 'none';
					}
                    console.log('Server response:', xhr.responseText);

                } else {
                    console.error('File upload failed. Status:', xhr.status);
                }
            }
        };

        xhr.open('POST', '<?php echo backendurl("deal/upload_berkas")?>?doc_type='+doc_type+'&deal_id='+deal_id, true);
        xhr.send(formData);

        // Show the progress bar
        const progressBarContainer =  document.getElementById(doc_type+'_progress');

        progressBarContainer.style.display = 'block';
    } else {
        console.error('No file selected.');
    }
}

function change_termin() {
	termin_end=parseInt($("#termin").val());

	for(i=1;i<=10;i++) {
			if(i>termin_end) {
				$(".termin-"+i).hide();
			} else {
				$(".termin-"+i).show();
			}
	}
}
function hitung_termin(id_termin) {
	persen_termin=parseInt($("#"+id_termin).val());
	if(persen_termin>0) {
	nominal_deal=$("#nominal_deal").val();
	nominal_deal=nominal_deal.replaceAll(".", ""); 
	
	nominal_deal=parseInt(nominal_deal);
	
	termin=nominal_deal*(persen_termin/100);

	
	const formatter = new Intl.NumberFormat('id-ID');
	const formattedNumber = formatter.format(termin);


	$("#"+id_termin+"_nominal").html(formattedNumber);

	} else {
		$("#"+id_termin+"_nominal").html('');	
	}
	

}
$(document).ready(function(){
	
	for(i=1;i<=10;i++) {
		$(".termin-"+i).hide();
		hitung_termin('termin_'+i);
		
	}
	
	change_termin();


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
				{ "width": "10%", "targets": 1 },
				{ "width": "30%", "targets": 2 },
				{ "width": "7%", "targets": 3 },
				{ "width": "5%", "targets": 4 },
				{ "width": "10%", "targets": 5 },
			
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
