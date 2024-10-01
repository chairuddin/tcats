
<?php
$list_produk=option_list_produk();
$r_harga=array();
$option_produk='<option value="0">Pilih Produk</option>';
foreach($list_produk as $i => $v) {
	$option_produk.='<option value="'.$v['id'].'">'.$v['nama'].'</option>';
	$r_harga[$v['id']]=$v['harga'];
}
?>

var json_harga='<?php echo json_encode($r_harga);?>';
var r_harga=JSON.parse(json_harga);

function calculateTotal() {
	let total = 0;
  
	$('input[name="nominal[]"]').each(function() {
	  const value = parseFloat($(this).val().replace(/\./g, '').replace(',', '.'));
	  if (!isNaN(value)) {
		total += value;
	  }
	});
	dp=parseFloat($('#dp').val().replace(/\./g, '').replace(',', '.'));
	diskon=parseFloat($('#diskon').val().replace(/\./g, '').replace(',', '.'));
	total=total-dp;
	total=total-diskon;
	$('#total').html('Total: ' + formatAngka(total));
  }

function harga(id) {
	return r_harga[id];
}

window.unique_id_counter = 0 ;
function simpan() {
	window.unique_id_counter++;
	produk=$("#produk").val();
	
	deskripsi=$("#transaksi_item").val();
	nominal=$("#transaksi_nominal").val();
	input_produk='<select class="class_product form-control product-select2" id="produk_'+window.unique_id_counter+'" name="produk[]"><?php echo $option_produk;?></select>';
	input_deskripsi='<textarea class="class_deskripsi form-control" id="deskripsi_'+window.unique_id_counter+'" name="deskripsi[]">'+deskripsi+'</textarea>';
	input_nominal='<input class="class_nominal format-angka form-control" type="text"  id="nominal_'+window.unique_id_counter+'" name="nominal[]" value="'+nominal+'">';
	time= new Date().getTime();
	
	mode=$("#input_mode").val();
	if(mode=='add') {
		row=detail_row(time,input_produk,input_deskripsi,input_nominal);
		$("#table_list_transaksi").append(row);
	} else if(mode=='edit') {
		col=detail_col(input_produk,nput_deskripsi,input_nominal);
		row_id=document.getElementById("row_id").value;
		$("#"+row_id).html(col);
		
	}
	clear_form();
	$("#close_button").click();
	setTimeout(function(){
		maskNumericFields();
		$(".product-select2").select2();
		const valueToSelect = produk;
		$('#produk_'+window.unique_id_counter).val(valueToSelect).trigger('change');

		$('#produk_'+window.unique_id_counter).on('change', function (event) {
			const selectedValue = $(this).val();
			nominal=harga(selectedValue);
			$("#nominal_"+window.unique_id_counter).val(formatAngka(nominal));
			$("#deskripsi_"+window.unique_id_counter).val($('#produk_'+window.unique_id_counter+' option:selected').text());
			
		});

	
		calculateTotal();
		
		$('input[name="nominal[]"]').on('input', function() {
			calculateTotal();
		});
	


	},200);
}
function edit_detail(this_button) {
	id=this_button.getAttribute("data-row");
	transaksi_item=document.querySelector("#"+id+" > td > .class_deskripsi").value;
	transaksi_nominal=document.querySelector("#"+id+" > td > .class_nominal").value;
	document.getElementById("row_id").value=id;
	document.getElementById("transaksi_item").value=transaksi_item;
	document.getElementById("transaksi_nominal").value=transaksi_nominal;	
}
function hapus_detail(this_button) {
	id=this_button.getAttribute("data-row");
	document.getElementById(id).remove();
}
function clear_form() {
	document.getElementById("row_id").value='';
	document.getElementById("transaksi_item").value='';
	document.getElementById("transaksi_nominal").value='';	
	//const $select = document.querySelector('#produk');
 	// $select.value = '0';
	//$("#produk").select2("val",0);
	const valueToSelect = '0';
	$('#produk').val(valueToSelect).trigger('change');
}

function detail_row(time,input_produk,input_deskripsi,input_nominal) {
	//<a href="#" data-row="row_'+time+'" data-judul="Ubah item" data-tombol="Simpan" data-mode="edit"  data-toggle="modal" data-target="#transaksiModal" onclick="edit_detail(this);"><i class="fa fa-edit fa-1x"></i></a>&nbsp;&nbsp;
	return '<tr id="row_'+time+'"><td>'+input_produk+'</td><td>'+input_deskripsi+'</td><td>'+input_nominal+'</td><td><a href="#" onclick="hapus_detail(this);" data-row="row_'+time+'"><i class="fa fa-trash"></i></a></td></tr>'
}
function detail_col(input_produk,input_deskripsi,input_nominal) {
	return '<td>'+input_produk+'</td><td>'+input_deskripsi+'</td><td>'+input_nominal+'</td><td><a href="#" data-row="row_'+time+'" data-judul="Ubah item" data-tombol="Simpan" data-mode="edit"  data-toggle="modal" data-target="#transaksiModal" onclick="edit_detail(this);"><i class="fa fa-edit fa-1x"></i></a>&nbsp;&nbsp;<a href="#" onclick="hapus_detail(this);" data-row="row_'+time+'"><i class="fa fa-trash"></i></a></td>'
}


$(document).ready(function(){
	
	calculateTotal();
	
	$('input[name="nominal[]"]').on('input', function() {
		calculateTotal();
	});


	$('input[name="dp"]').on('input', function() {
		calculateTotal();
	});


	$('input[name="diskon"]').on('input', function() {
		calculateTotal();
	});

	$('#transaksiModal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var judul_form = button.data('judul');
	var judul_tombol = button.data('tombol');
	var mode = button.data('mode');
	//var judul_form = button.data('data-title'); // Extract info from data-* attributes
	//var judul_tombol = button.data('data-button'); // Extract info from data-* attributes
	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	
	var modal = $(this)
		modal.find('.modal-title').text( judul_form)
		modal.find('#tombol_update').text(judul_tombol)
		modal.find('#input_mode').val(mode)
	
	/*
	
	document.getElementById("modal-title").value=transaksi_item;
	document.querySelector(".modal-title").innerHTML=judul_form;
	document.getElementById("tombol_update").value=transaksi_nominal;	
	*/
		setTimeout(function(){
			$("#transaksi_item").focus();
		},1000);
	})
	
	$('.select2modal').select2({
        dropdownParent: $('#transaksiModal')
    });

	$('#produk').on('change', function (event) {
		const selectedValue = $(this).val();
		nominal=harga(selectedValue);
		$("#transaksi_nominal").val(formatAngka(nominal));
		$("#transaksi_item").val($('#produk option:selected').text());
		
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
			"columnDefs": [
				{ 
					"targets": [0,1,2], //first column / numbering column
					"orderable": false, //set not orderable
				}
			],
			"order": [[ 0, 'DESC' ]],
			"language": {
				"paginate": {
				  "previous": "<",
				  "next": ">"
				}
			  }
			
		});
		
	});
