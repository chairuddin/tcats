<?php
if($action=='save') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form data

      

        // Escape user inputs for security
        $nama = cleanInput($_POST['nama']);
        $jenis_kelamin = cleanInput($_POST['jenis_kelamin']);
        $hp = cleanInput($_POST['hp']);
        $alamat = cleanInput($_POST['alamat']);
        $email = cleanInput($_POST['email']);
        $address = cleanInput($_POST['phone']);
        $password = cleanInput($_POST['password']);
        $re_password = cleanInput($_POST['re-password']);
        $sql = "
        INSERT INTO kontak 
        SET
        nama='$nama', 
        jenis_kelamin='$jenis_kelamin',
        hp='$hp', 
        alamat='$alamat',
        email='$email',
        password='$password'
        ";
        $q=$mysql->query($sql);
        if ($q) {
        echo 'berhasil';
        }
        /*
        // Validate the form data
        if (empty($username) || empty($password)) {
            echo "Please enter a username and password.";
        } else if (strlen($username) < 5) {
            echo "Your username must be at least 5 characters long.";
        } else if (strlen($password) < 8) {
            echo "Your password must be at least 8 characters long.";
        } else {
            // The form data is valid, so process it
            // ...
        }
        */
        die();
    }
}
?>