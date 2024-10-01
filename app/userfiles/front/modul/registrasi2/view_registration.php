<?php

/*
array(10) { ["id"]=> string(2) "20" ["kegiatan_id"]=> string(1) "9" ["kegiatan_judul"]=> string(23) "Workshop Manajemen Mutu" ["waktu_mulai"]=> string(19) "2023-10-12 08:00:00" ["waktu_selesai"]=> string(19) "2023-10-13 12:00:00" ["produk_id"]=> string(2) "12" ["created_by"]=> string(1) "1" ["created_at"]=> string(19) "2023-10-14 15:38:00" ["modified_by"]=> string(1) "1" ["modified_at"]=> string(19) "2023-10-14 15:45:38" }

*/
$ada_jadwal=false;
$action=cleanInput($action);
$q=$mysql->query(" SELECT * FROM jadwal WHERE md5(concat(kegiatan_id,'-',id))='$action' ");
if($q and $mysql->num_rows($q)>0) {
	$d=$mysql->fetch_assoc($q);

	$ada_jadwal=true;
}
?>
<div class="container ">
	<div class="row">
		<div class="col-md-12">
		<div class="mt-5">
			<a href="#">
				<img style="max-width:150px;" src="<?php echo fileurl("asset/logo.png?v=1");?>" alt="Kuanta">
			</a>
		</div>
		<?php if($ada_jadwal):?>
		<h5 class="text-success mt-4 text-center"><?php echo $d['kegiatan_judul'];?></h5>
		
		
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h5 class="text-center">Form Kehadiran</h5>
                <form id="myForm">
                    <div class="form-group">
                        <label for="naame">NPSN *</label>
                        <input type="text" class="form-control" id="a" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="naame">Nama *</label>
                        <input type="text" class="form-control" id="a" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Bagaimana kami memanggil anda? *</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="1">Bapak</option>
                            <option value="2">Ibu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lembaga_nama">Nama Lembaga + Kabupaten/Kota *</label>
                        <input type="text" class="form-control" id="lembaga_nama" name="lembaga_nama" required>
                    </div>
                    <div class="form-group">
                        <label for="hp">Nomor Telepon *</label>
                        <input type="text" class="form-control" id="hp" name="hp" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat *</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>
					<div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
					<div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
					<div class="form-group">
                        <label for="re-password">Ketik Ulang Password *</label>
                        <input type="password" class="form-control" id="re-password" name="re-password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    


		<?php endif;?>		
		<?php if(!$ada_jadwal):?>
		<h1 class="text-danger">Url tidak valid atau jadwal sudah kadaluarsa</h1>
		<?php endif;?>
		</div>
	</div>
</div>



<?php
$url_form=fronturl("registrasi/save");
$script_js.=<<<END
<script>
$(document).ready(function() {
    $("#myForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 15
            },
           
            password: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            name: {
                required: "Nama harus diisi",
                minlength: "Nama minimal 3 karakter"
            },
            email: {
                required: "Email harus diisi",
                email: "Email tidak valid"
            },
            phone: {
                required: "Telepon harus diisi",
                minlength: "Telepon minimal 10 karakter",
                maxlength: "Telepon maksimal 15 karakter"
            },
           
            password: {
                required: "Password harus diisi",
                minlength: "Password minimal 8 karakter"
            }
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
		submitHandler: function(form) {
			alert('Form submitted successfully');
			var formData = $('#myForm').serialize();
			$.ajax({
				type: 'POST',
				url: '$url_form', // Replace with your server-side script URL
				data: formData,
				beforeSend: function() {
					// Show the loading icon
					$('.btn-primary').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
				},
				success: function(response) {
					// Handle the successful submission here
					alert('Form submitted successfully');
				},
				error: function(jqXHR, textStatus, errorThrown) {
					// Handle the error here
					alert('Failed to submit the form');
				},
				complete: function() {
					// Hide the loading icon
					$('.btn-primary').html('Submit');
				}
			});
        }
    });
});



</script>
END;
?>