<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="favicon.png"/>
    <title>Reset Password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=fronturl();?>/../app/userfiles/front/template/elearning/asset/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=fronturl();?>/../app//userfiles/front/template/elearning/login/css/style.css?v=<?php echo rand(); ?>" />
    <link rel="stylesheet" href="<?=fronturl();?>/../app//userfiles/front/template/elearning/asset/css/font-awesome.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body id="login-page">
    <div class="login-wrapper">
        <img src="<?=fronturl().'/logo.png'?>" class="logo-login"/>
        <h2>T-CATS : Training Center Competency Assessment and Training System</h2>
        <div class="form-wrapper">
            <header class="">
              <a
                href="<?=backendurl();?>"
                class="d-flex align-items-center text-dark text-decoration-none mt-0 mb-4"
              >
                <i class="fa-solid fa-chevron-left me-3"></i>
                <p class="m-0 fs-5 fw-medium">Reset Password</p>
              </a>
            </header>
        
            <form id="resetPasswordForm" class="mt-3">
              <div class="mb-3">
                <!--<label for="email" class="form-label fw-bold">Email</label><br />-->
                <input
                  type="email"
                  class="form-input bg-success-subtle bg-opacity-25 border border-0"
                  id="email"
                  aria-describedby="emailHelp"
                  placeholder="Email"
                  required
                />
                <span id="emailError" class="text-danger"></span>
              </div>
              <button type="submit" class="btn-submit rounded p-2 w-100 text-white" id="resetButton">
                Reset Password
              </button>
              <div id="countdownMessage" class="text-warning mt-2"></div>
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
      $(document).ready(function() {
        $('#resetPasswordForm').on('submit', function(event) {
          event.preventDefault();

          var email = $('#email').val().trim();

          // Clear previous error messages
          $('#emailError').text('');

          // Validate email
          if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            $('#emailError').text('Email tidak valid.');
            return;
          }

          $.ajax({
            url: '<?=backendurl('api_reset_password')?>', // Replace with your actual API URL
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ email: email }),
            success: function(response) {
              if (response.success) {
                $('#successMessage').text(response.msg);
                $('#successModal').modal('show');
                startCountdown();
              } else {
                alert('Reset password gagal. Silakan coba lagi.');
              }
            },
            error: function(error) {
              console.error('Error:', error);
              alert('Terjadi kesalahan. Silakan coba lagi.');
            }
          });
        });

        function startCountdown() {
          var countdown = 60;
          $('#resetButton').prop('disabled', true);
          var countdownMessage = $('#countdownMessage');
          
          var interval = setInterval(function() {
            countdown--;
            countdownMessage.text('Anda dapat mengirim ulang permintaan dalam ' + countdown + ' detik.');

            if (countdown <= 0) {
              clearInterval(interval);
              $('#resetButton').prop('disabled', false);
              countdownMessage.text('');
            }
          }, 1000);
        }
      });
    </script>
  </body>
</html>
<?php die();?>