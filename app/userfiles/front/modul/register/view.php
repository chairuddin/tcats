<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="favicon.png"/>
    <title>Registrasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=fronturl();?>/userfiles/front/template/elearning/asset/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=fronturl();?>/userfiles/front/template/elearning/login/css/style.css?v=<?php echo rand(); ?>" />
    <link rel="stylesheet" href="<?=fronturl();?>/userfiles/front/template/elearning/asset/css/font-awesome.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body id="login-page" class="register-form">
    <div class="login-wrapper">
        <img src="<?=$kUrl.'/logo.png'?>" class="logo-login"/>
        <h2>T-CATS : Training Center Competency Assessment and Training System</h2>
    <div class="form-wrapper">
        <header class="">
          <a href="<?=fronturl('login');?>" class="d-flex align-items-center text-dark text-decoration-none mb-4 mt-0">
            <i class="fa-solid fa-chevron-left me-3"></i>
            <p class="m-0 fs-5 fw-bold">Registrasi</p>
          </a>
        </header>
    
        <form id="registrationForm" class=" mt-3">
          <div class="mb-3">
            <input
              name="nama"
              type="text"
              class="form-input bg-success-subtle bg-opacity-25 border border-danger border-start-0 border-end-0 border-top-0"
              id="nama"
              aria-describedby="nama"
              placeholder="Nama Lengkap"
            />
            <span id="namaError" class="text-danger"></span>
          </div>
          <div class="mb-3">
            <input name="wa"
              type="text"
              class="form-input bg-success-subtle bg-opacity-25 border border-danger border-start-0 border-end-0 border-top-0"
              id="whatsapp"
              placeholder="WhatsApp"
            />
            <span id="waError" class="text-danger"></span>
          </div>
          <div class="mb-3">
            <input
              name="email"
              type="email"
              class="form-input bg-success-subtle bg-opacity-25 border border-danger border-start-0 border-end-0 border-top-0"
              id="email"
              placeholder="Email"
            />
            <span id="emailError" class="text-danger"></span>
          </div>
          <div class="mb-3 position-relative">
            <input
              name="password"
              type="password"
              class="form-input bg-success-subtle bg-opacity-25 border border-danger border-start-0 border-end-0 border-top-0"
              id="password1"
              placeholder="Password"
            />
            <span id="togglePassword1" class="eye-icon"><i class="fa fa-eye"></i></span>
            <span id="passwordError" class="text-danger"></span>
          </div>
          <div class="mb-3 position-relative">
            <input
              name="repassword"
              type="password"
              class="form-input bg-success-subtle bg-opacity-25 border border-danger border-start-0 border-end-0 border-top-0"
              id="password2"
              placeholder="Ketik ulang password"
            />
            <span id="togglePassword2" class="eye-icon"><i class="fa fa-eye"></i></span>
            <span id="repasswordError" class="text-danger"></span>
          </div>
          <button type="submit" class="btn-submit rounded p-2 w-100 text-white">Registrasi</button>
        </form>
    
        <!-- Success Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p id="successMessage"></p>
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script>
    
    // Ambil elemen input dan ikon mata
    const passwordInput = document.getElementById("password1");
    const togglePassword = document.getElementById("togglePassword1");
    
    // Fungsi untuk toggle show/hide password
    togglePassword.addEventListener("click", function () {
        // Cek tipe input saat ini
        const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
        
        // Ganti tipe input
        passwordInput.setAttribute("type", type);
        
        // Ubah ikon mata (opsional, tergantung simbol atau font yang digunakan)
        if (type === "password") {
            togglePassword.innerHTML = "<i class='fa fa-eye'></i>"; // Ikon mata
        } else {
            togglePassword.innerHTML = "<i class='fa fa-eye-slash'></i>"; // Ikon mata dengan garis (misal)
        }
    });
    
    // Ambil elemen input dan ikon mata
    const passwordInput2 = document.getElementById("password2");
    const togglePassword2 = document.getElementById("togglePassword2");
    
    // Fungsi untuk toggle show/hide password
    togglePassword2.addEventListener("click", function () {
        // Cek tipe input saat ini
        const type = passwordInput2.getAttribute("type") === "password" ? "text" : "password";
        
        // Ganti tipe input
        passwordInput2.setAttribute("type", type);
        
        // Ubah ikon mata (opsional, tergantung simbol atau font yang digunakan)
        if (type === "password") {
            togglePassword2.innerHTML = "<i class='fa fa-eye'></i>"; // Ikon mata
        } else {
            togglePassword2.innerHTML = "<i class='fa fa-eye-slash'></i>"; // Ikon mata dengan garis (misal)
        }
    });
      $(document).ready(function() {
        $('#registrationForm').on('submit', function(event) {
          event.preventDefault();

          var formData = {
            nama: $('#nama').val().trim(),
            wa: $('#whatsapp').val().trim(),
            email: $('#email').val().trim(),
            password: $('#Password1').val().trim(),
            repassword: $('#Password2').val().trim()
          };

          var isValid = true;

          // Clear previous error messages
          $('#namaError').text('');
          $('#waError').text('');
          $('#emailError').text('');
          $('#passwordError').text('');
          $('#repasswordError').text('');

          // Validation
          if (formData.nama === "") {
            $('#namaError').text('Nama harus diisi.');
            isValid = false;
          }

          if (!/^\d{10,15}$/.test(formData.wa)) {
            $('#waError').text('Nomor WhatsApp tidak valid.');
            isValid = false;
          }

          if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
            $('#emailError').text('Email tidak valid.');
            isValid = false;
          }

          if (formData.password === "") {
            $('#passwordError').text('Password harus diisi.');
            isValid = false;
          }

          if (formData.password !== formData.repassword) {
            $('#repasswordError').text('Password dan konfirmasi password tidak sama.');
            isValid = false;
          }

          if (isValid) {
            $.ajax({
              url: '<?=$kUrl?>/api_registrasi/insert', // Replace with your actual API URL
              type: 'POST',
              contentType: 'application/json',
              data: JSON.stringify(formData),
              success: function(response) {
                if (response.success) {
                  $('#successMessage').text(response.msg);
                  $('#successModal').modal('show');
                  setTimeout(function() {
                    window.location.href = '<?=fronturl('login')?>'; 
                  }, 2000);
                } else {
                  alert('Pendaftaran gagal. Silakan coba lagi.');
                }
              },
              error: function(error) {
                console.error('Error:', error);
                // Handle the error response here
                alert('Terjadi kesalahan. Silakan coba lagi.');
              }
            });
          }
        });
      });
    </script>
  </body>
</html>
<?php die();?>