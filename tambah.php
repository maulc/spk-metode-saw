<?php

// MENGHUBUNGKAN KONEKSI DATABASE
require "koneksi.php";

// CEK COOKIE
checkCookie();

// JIKA SUDAH LOGIN MASUKKAN KEDALAM SHOWDATA
if (!isset($_SESSION["login"])) {
    header('location: login.php');
    exit;
} else {
    if (isset($_SESSION['id_user'])) {
        // var_dump($_SESSION['id_user']); die;
        $my_id = $_SESSION['id_user'];
    } else {
        $my_id = $_COOKIE['id_user'];
    }

    // QUERY MAHASISWA
    $user = query("SELECT * FROM tb_user WHERE id_user = '$my_id' ")[0];
}
?>

<?php
// CEK APAKAH TOMBOL SUBMIT SUDAH DITEKAN
if (isset($_POST["submit"])) {

    // CEK APAKAH BERHASIL DIUBAH ATAU TIDAK
    if (tambah_data($_POST) > 0) {
        echo "<script>
            alert( 'Data berhasil ditambahkan' );
            document.location.href = 'penilaian.php';
        </script>";
    } else {
        echo "<script>
            alert( 'Data gagal ditambahkan !' );
            document.location.href = 'penilaian.php';
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

    <title>SIE Kelompok 12</title>

    <!-- Link Icon -->
    <link rel="icon" href="asset/icons/logo.jpg" type="image/gif" sizes="16x16">
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="asset/fontawesome-free-5.15.3/css/all.css">
    <!--load all styles -->
    <link rel="stylesheet" href="asset/style/index.css">

</head>

<body>
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
        <a class="navbar-brand">
                <p></p>
                <p style="font-weight : bold;">SPK Perangkingan</p>
            </a>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Start Content -->
    <div class="container align-content-center">
        <div class="row justify-content-center align-items-center">
            <div class="col-12">
                <div class="container">
                    <h3 class="text-center" style="font-weight: bold">Tambah Data</h3>
                    <div class="row justify-content-center">
                        <div class="col-4 mt-2 mb-5">

                            <!-- START FORM LOGIN -->
                            <form action="tambah.php" method="POST">

                                <div class="form-group mx-5 mt-5 mb-3">
                                    <label for="nama">Nama Lengkap :</label>
                                    <input type="text" name="nama" id="nama" class="form-control" minlength="3" maxlength="100" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" title="Nama Lengkap must be 3-100 character and contain only letters" placeholder="Nama Lengkap" required="">
                                </div>

                                <div class="form-group mx-5 my-3">
                                    <label for="kehadiran">Nilai Matematika :</label>
                                    <input type="text" name="kehadiran" id="kehadiran" class="form-control" min="0" max="5" step="0.01" minlength="1" maxlength="4" pattern="([0-9]{1,2})+(\.[0-9][0-9]?)?" title="Nilai Kehadiran only be filled with a value range of 0-5 with max 2 decimal (.00)" placeholder="Value range : 0.00 - 5.00" required="">
                                    </select>
                                </div>

                                <div class="form-group mx-5 my-3">
                                    <label for="tugas">Nilai Bahasa Indonesia :</label>
                                    <input type="text" name="tugas" id="tugas" class="form-control" min="0" max="5" step="0.01" minlength="1" maxlength="4" pattern="([0-9]{1,2})+(\.[0-9][0-9]?)?" title="Nilai Tugas only be filled with a value range of 0-5 with max 2 decimal (.00)" placeholder="Value range : 0.00 - 5.00" required="">
                                </div>

                                <div class="form-group mx-5 my-3">
                                    <label for="quiz_project">Nilai IPA :</label>
                                    <input type="text" name="quiz_project" id="quiz_project" class="form-control" min="0" max="5" step="0.01" minlength="1" maxlength="4" pattern="([0-9]{1,2})+(\.[0-9][0-9]?)?" title="Nilai Quiz dan Final Project only be filled with a value range of 0-5 with max 2 decimal (.00)" placeholder="Value range : 0.00 - 5.00" required="">
                                </div>

                                <div class="form-group mx-5 mb-5">
                                    <div class="float-end mb-3">
                                        <a href="index.php" class="btn btn-warning">Back</a>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- END FORM INPUTAN -->

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