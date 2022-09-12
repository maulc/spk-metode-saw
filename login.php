<?php

// MENGHUBUNGKAN KONEKSI DATABASE
require "koneksi.php";

// CEK COOKIE
checkCookie();

// JIKA SUDAH LOGIN MASUKKAN KEDALAM INDEX
if (isset($_SESSION["login"])) {
    header('location: index.php');
    exit;
}
?>

<?php





// TRY AND CATCH
if (isset($_POST["login"])) {
    try {
        //code...
        if (login($_POST) == false) {
            throw new Exception("email / password wrong !!!");
        }
        header('location: index.php');
        exit;
    } catch (Exception $error) {
        echo "<script>
        alert ('" . $error->getMessage() . "');
            document.location.href = 'login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Login</title>

    <!-- Link Icon -->
    <link rel="icon" href="asset/icons/logo.jpg" type="image/gif" sizes="16x16">
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('asset/bootstrap/css/bootstrap.min.css'); ?>">
    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset/fontawesome-free-5.15.3/css/all.css'); ?>">
    <!--load all styles -->
    <link rel="stylesheet" href="<?= base_url('asset/style/login.css?') . time(); ?>">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
            body{
                font-family: Poppins;
             background-color: rgb(57, 54, 107);
             }
  </style>

</head>

<body>
  

    <!-- Start Content -->
    <div class="container align-content-center" >
        <div class="row justify-content-center align-items-center">
            <p></p>
            <p></p>
            <p></p>
            <div class="col-5">
                <h2 class="mt-2 mb-2" style="color: white; font-size : 40px;">SIE Kelompok 12</h2>
            </div>
            <div class="col-12">
                <h5>Sistem Pendukung Keputusan “Penentuan Nilai UN Terbaik Tingkat Sekolah Dasar</h5>
                <br><br><br><br><br><br>
            </div>
            <div class="col-12" >
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-4 mt-2 mb-5">
                            <div class = "baru">
                            <!-- START FORM LOGIN -->
                            <form action="login.php" method="POST" enctype="multipart/form-data">

                                <div class="form-group mt-3 mb-3">
                                    <label for="email_user" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email_user" name="email_user" placeholder="Email" minlength="3" maxlength="50" title="Email must be 3-50 character and contain '@'" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password_user" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password_user" name="password_user" placeholder="password" minlength="5" maxlength="20" title="Password must be 5-20 character" required>
                                </div>

                                <div class="form-check mb-3">
                                    <div class="fa-pull-left">
                                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                                        <label class="form-text mt-1" for="remember_me">Remember me</label>
                                    </div>
                                </div>

                                <br><br><br><br>

                                <div class="form-group" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary mb-2" id="login" name="login">Sign - In</button>
                                </div>

                            </form>
                            <!-- END FORM INPUTAN -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- End Content -->

    <!-- Link Bootstrap JavaScript -->
    <script src="<?= base_url('asset/bootstrap/js/bootstrap.bundle.js'); ?>"></script>
</body>

</html>