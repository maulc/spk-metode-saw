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
$penilaian = query("SELECT * FROM tb_hasil_penilaian ORDER BY id_penilaian DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Penilaian | SIE Kelompok 12</title>

    <!-- Link Icon -->
    <link rel="icon" href="asset/icons/logo.jpg" type="image/gif" sizes="16x16">
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="asset/fontawesome-free-5.15.3/css/all.css">
    <!--load all styles -->
    <link rel="stylesheet" href="asset/style/index.css">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
            body{
                font-family: Poppins;
             }
             body nav {
             background-color: rgb(57, 54, 107);
            }
  </style>
</head>

<body>
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
        <a class="navbar-brand">
                <p></p>
                <p style="font-weight : bold;">SPK Perangkingan</p>
            </a>

            <!-- DROPDOWN -->
            <div class="fa-pull-right">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Kriteria</a>
                        </li>

                        <p style="color: white; margin-left: 10px; margin-right: 10px; margin-top: 6px;">|</p>

                        <li class="nav-item">
                            <a class="nav-link active" href="#">Penilaian</a>
                        </li>

                        <p style="color: white; margin-left: 10px; margin-right: 10px; margin-top: 6px;">|</p>

                        <li class="nav-item">
                            <a class="nav-link" href="keputusan.php">Keputusan</a>
                        </li>

                        <p style="color: white; margin-left: 10px; margin-right: 10px; margin-top: 6px;">|</p>

                        <li class="nav-item">
                            <a class="nav-link" href="#"><?= $user["email"] ?></a>
                        </li>

                        <p style="color: white; margin-left: 10px; margin-right: 10px; margin-top: 6px;">|</p>

                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fa fa-power-off"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- DROPDOWN -->

        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Start Content -->
    <div class="container">
        <a href="tambah.php" class="btn btn-primary" style="margin-left: 110px;">Tambah Data</a>
        <div class="row justify-content-center">

            <!-- START HASIL PENILAIAN -->
            <div class="col-10 mt-2 mb-2">
                <h4 style="font-weight: bold;">Hasil Penilaian</h4>
                <table class="table table-bordered text-center align-middle">
                    <thead style="background-color:  #867df9;">
                        <tr>
                            <th rowspan="2" class="align-middle">NO.</th>
                            <th rowspan="2" class="align-middle">NAMA LENGKAP</th>
                            <th colspan="3">KRITERIA</th>
                        </tr>
                        <tr>
                            <th>K1</th>
                            <th>K2</th>
                            <th>K3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($penilaian as $pn) : ?>
                            <tr>
                                <th><?= $no; ?></th>
                                <td class="text-start"><?= $pn['nama']; ?></td>
                                <td><?= $pn['kehadiran']; ?></td>
                                <td><?= $pn['tugas']; ?></td>
                                <td><?= $pn['quiz_project']; ?></td>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- END HASIL PENILAIAN -->

        </div>
    </div>
    <!-- End Content -->

    <!-- Link Bootstrap JavaScript -->
    <script src="asset/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>