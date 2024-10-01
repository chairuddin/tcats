

async function npsn_api() {
	//https://dapo.kemdikbud.go.id/api/getHasilPencarian?keyword=20532203
	
	//Api ambil dari database sekolah dan Ambil dari dapo.kemdikbud.go.id
	npsn=$("#npsn").val();
	url='<?php echo backendurl("$modul/check_npsn?npsn=");?>'+npsn;
	const response = await fetch(url);
	const data = await response.json();
	//{"kode_prop":"050000  ","propinsi":"Prov. Jawa Timur","kode_kab_kota":"056000  ","kabupaten_kota":"Kota Surabaya","kode_kec":"056017  ","kecamatan":"Kec. Sawahan","id":"245CFAC6-6C14-4298-80B6-B5DE8FFF6E8F","npsn":"20532203","sekolah":"SMKN 2 SURABAYA","bentuk":"SMK","status":"N","alamat_jalan":"JL. TENTARA GENIE PELAJAR 26","lintang":"-7.2584000","bujur":"112.7256000"}
	jenjang=0;
	if(data.bentuk) {
		if(data.bentuk=='PAUD' 	|| data.bentuk=='TK') 						jenjang=1;
		if(data.bentuk=='SD' 	|| data.bentuk=='MI') 						jenjang=2;
		if(data.bentuk=='SMP' 	|| data.bentuk=='MTs') 						jenjang=3;
		if(data.bentuk=='SMA' 	|| data.bentuk=='MA' || data.bentuk=='SMK') jenjang=4;
	}

	if(data.status.toLowerCase()=='negeri') data.status='N'; //khusus api langung ke dapodik ditambah ini
	if(data.status.toLowerCase()=='swasta') data.status='S'; //khusus api langung ke dapodik ditambah 
	

	if(data.nama_sekolah && data.nama_sekolah.length>0) {
		//api dapodik
		$("#lembaga_nama").val(data.nama_sekolah);
	} else {
		//api internal
		$("#lembaga_nama").val(data.sekolah);
	}
	if(data.is_lembaga_exist) {
		$(".field-lembaga").show();
		$(".field-lembaga").addClass("read-only");
	} else {
		$(".field-lembaga").show();
		$(".field-lembaga").removeClass("read-only");
	}
	$("#lembaga_status").val(data.status);
	$("#lembaga_alamat").val(data.alamat_jalan);
	$("#lembaga_website").val(data.website);
	$("#lembaga_email").val(data.email);
	$("#lembaga_tahun_berdiri").val(data.tahun_berdiri);
	$("#lembaga_ulang_tahun").val(data.tahun_berdiri);
	$("#lembaga_telp").val(data.telp);
	$("#lembaga_jenjang").val(jenjang);
	$("#lembaga_kota").val(data.kota_id).trigger("change");
	
}
		
$(document).ready(function(){
	if($("#npsn").length>0) {
		if($("#npsn").val().length>0) {
			npsn_api();
		}
	}
	$(".field-lembaga").hide();
	$("#npsn").change(function(){
		npsn_api();
	}) 

	/*
	$("#lembaga_jenis").change(function(){
		
		lembaga=$(this).val();
		lembaga=2;
		//1=personal
		//2=sekolah
		//3=yayasan
		//4=csr
		//5=ngo
		//6=dinas
		$(".field-sekolah").show();
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

	//$(".field-sekolah").hide();
	//$(".field-yayasan").hide();
	//$(".field-ngo").hide();

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
	*/

	// datatables
		$('#datalist').DataTable({
		
			"pageLength": 100,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : true,
			'info'        : false,
			'responsive'  : true,
			'autoWidth'	  : false,
			'processing'  : true,
			'serverSide'  : true,
			"ajax": {
				"url": '<?php echo backendurl("$modul/data")?>',
				"type": "POST"
			},
			
			"columnDefs": [
				{ "width": "5%", "targets": 0 },
				{ "width": "25%", "targets": 1 },
				{ "width": "10%", "targets": 2 },
				{ "width": "10%", "targets": 3 },
				{ "width": "25%", "targets": 4 },
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
