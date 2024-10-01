<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
    <link rel="stylesheet" href="<?=fronturl();?>/userfiles/front/template/elearning/login/css/style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <header class="p-4 bg-opacity-50">
      <a
        href="<?=fronturl('login');?>"
        class="d-flex align-items-center text-dark text-decoration-none gap-2"
      >
        <i class="fa-solid fa-chevron-left"></i>
        <p class="m-0 fs-5 fw-medium">Reset Password</p>
      </a>
    </header>

    <form id="resetPasswordForm" class="mx-3 mt-3">
      <div class="mb-3">
        <label for="email" class="form-label fw-bold">Email</label><br />
        <input
          type="email"
          class="form-input bg-success-subtle bg-opacity-25 border border-0"
          id="email"
          aria-describedby="emailHelp"
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
            url: '<?=$kUrl?>/api_reset_password', // Replace with your actual API URL
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