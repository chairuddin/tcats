<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="favicon.ico"/>
    <title>Login Form</title>
      <link rel="stylesheet" href="<?=fronturl();?>/userfiles/front/template/elearning/login/css/style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <p class="text-center mt-3 mb-1">
    <img src="<?=$kUrl.'/logo.png'?>" />

    </p>
    <p class="fw-bold text-center m-0"></p>
     <div id="response"></div>
    <form class="mx-3" method="post">
      <div class="mb-3">
        <label for="username" class="form-label fw-bold">Email</label><br>
        <input
          type="email"
          class="form-input bg-success-subtle bg-opacity-25 border border-0"
          id="username" name="username"
          aria-describedby="emailHelp"
        />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label fw-bold">Password</label><br>
        <input
          type="password" name="password"
          class="form-input bg-success-subtle bg-opacity-25 border border-0"
          id="password"
        />
      </div>
      <button type="button"  onclick="submitLogin()" class="btn-submit rounded p-2 w-100 text-white">Login</button>
    </form>
    <div class="d-flex justify-content-between mx-3">
        <a href="<?=fronturl('register')?>" class="text-dark text-decoration-none fw-medium">Daftar Sekarang</a>
        <a href="<?=fronturl('reset-password')?>" class="text-dark text-decoration-none fw-medium">Lupa password?</a>
    </div>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script>
    function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

// Usage


        function submitLogin() {
            var username = $('#username').val();
            var password = $('#password').val();
        
            $.ajax({
                url: '<?=$api_login?>', 
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    username: username,
                    password: password
                }),
                success: function(response) {
                    console.log(response);
                    if(response.success ==1) {
                        $('#response').html('<div class="alert alert-success" role="alert">Login berhasil</div>');
                        console.log('Success:', response);
                          var token = response.token;
                        var userid = response.userid;
                        var username = response.username;
                        var name = response.name;
                        var picture = response.picture;
                        var lastLogin = response.lastLogin;
                        var email = response.email;
                        
                        // Saving session data in localStorage
                        localStorage.setItem('token', token);
                        localStorage.setItem('userid', userid);
                        localStorage.setItem('username', username);
                        localStorage.setItem('name', name);
                        localStorage.setItem('picture', picture);
                        localStorage.setItem('lastLogin', lastLogin);
                        localStorage.setItem('email', email);
                        setCookie("qr_token",token, 365); 
                        window.location.href = '<?=fronturl('login')?>'; 
                        
                    } else {
                         $('#response').html('<div class="alert alert-danger" role="alert">Login gagal</div>');
                        console.log('Success:', response);
                    }
                    
                },
                error: function(xhr, status, error) {
                    $('#response').html('<div class="alert alert-danger" role="alert">Login gagal silakan coba lagi</div>');
                    console.log('Error:', error);
                }
            });
        }
    </script>
  </body>
</html>
<?php die();?>