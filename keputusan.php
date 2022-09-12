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
$rating = query("SELECT tb_rating.*, tb_hasil_penilaian.nama FROM tb_rating INNER JOIN tb_hasil_penilaian ON tb_rating.id_penilaian = tb_hasil_penilaian.id_penilaian ORDER BY id_penilaian DESC");
$bobot = query("SELECT * FROM tb_bobot ORDER BY id_bobot ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Keputusan | SIE Kekompok 12</title>

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
                            <a class="nav-link" href="penilaian.php">Penilaian</a>
                        </li>

                        <p style="color: white; margin-left: 10px; margin-right: 10px; margin-top: 6px;">|</p>

                        <li class="nav-item">
                            <a class="nav-link active" href="#">Keputusan</a>
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
        <div class="row justify-content-center">

            <!-- START RATING KECOCOKAN -->
            <div class="col-10 mt-2 mb-2">
                <h4 style="font-weight: bold;">Rating Kecocokan Nilai</h4>
                <table class="table table-bordered text-center align-middle">
                    <thead style="background-color:  #867df9;">
                        <tr>
                            <th rowspan="2" class="align-middle">NO.</th>
                            <th rowspan="2" class="align-middle">NAMA LENGKAP</th>
                            <th colspan="3">KRITERIA</th>
                            <th rowspan="2" class="align-middle">TOTAL</th>
                        </tr>
                        <tr>
                            <th>K1</th>
                            <th>K2</th>
                            <th>K3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no_rating = 1; ?>
                        <?php foreach ($rating as $rt) : ?>
                            <?php $total_rating = $rt['kehadiran'] + $rt['tugas'] + $rt['quiz_project']; ?>
                            <tr>
                                <th><?= $no_rating; ?></th>
                                <td class="text-start"><?= $rt['nama']; ?></td>
                                <td><?= $rt['kehadiran']; ?></td>
                                <td><?= $rt['tugas']; ?></td>
                                <td><?= $rt['quiz_project']; ?></td>
                                <td><?= $total_rating; ?></td>
                            </tr>
                            <?php $no_rating++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- END RATING KECOCOKAN -->

            <?php
            $array_k1 = [];
            $array_k2 = [];
            $array_k3 = [];

            foreach ($rating as $rt) :
                array_push($array_k1, $rt['kehadiran']);
                array_push($array_k2, $rt['tugas']);
                array_push($array_k3, $rt['quiz_project']);

                $max_k1 = max($array_k1);
                $max_k2 = max($array_k2);
                $max_k3 = max($array_k3);
            endforeach;
            ?>

            <!-- START MAX VALUE -->
            <div class="col-10 mt-2 mb-2">
                <h4 style="font-weight: bold;">Nilai Maksimal</h4>
                <table class="table table-bordered text-center align-middle">
                    <thead style="background-color: #867df9;">
                        <tr>
                            <?php $no_maxValue = 1; ?>
                            <?php foreach ($bobot as $bt) : ?>
                                <th><?= $bt['kriteria']; ?> (K<?= $no_maxValue; ?>)</th>
                                <?php $no_maxValue++; ?>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($array_k1 && $array_k2 && $array_k3) : ?>
                            <td><?= $max_k1; ?></td>
                            <td><?= $max_k2; ?></td>
                            <td><?= $max_k3; ?></td>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- END MAX VALUE -->

            <!-- START NORMALISASI MATRIKS -->
            <div class="col-10 mt-2 mb-2">
                <h4 style="font-weight: bold;">Normalisasi Matriks</h4>
                <table class="table table-bordered text-center align-middle">
                    <thead style="background-color:  #867df9;">
                        <tr>
                            <th rowspan="2" class="align-middle">NO.</th>
                            <th rowspan="2" class="align-middle">NAMA LENGKAP</th>
                            <th colspan="3">KRITERIA</th>
                            <th rowspan="2" class="align-middle">TOTAL</th>
                        </tr>
                        <tr>
                            <th>K1</th>
                            <th>K2</th>
                            <th>K3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no_normalisasi = 1; ?>
                        <?php foreach ($rating as $rt) : ?>
                            <?php
                            $normalisasi_k1 = $rt['kehadiran'] / $max_k1;
                            $normalisasi_k2 = $rt['tugas'] / $max_k2;
                            $normalisasi_k3 = $rt['quiz_project'] / $max_k3;
                            ?>
                            <?php $total_normalisasi = $normalisasi_k1 + $normalisasi_k2 + $normalisasi_k3; ?>
                            <tr>
                                <th><?= $no_normalisasi; ?></th>
                                <td class="text-start"><?= $rt['nama']; ?></td>
                                <td><?= $normalisasi_k1; ?></td>
                                <td><?= $normalisasi_k2; ?></td>
                                <td><?= $normalisasi_k3; ?></td>
                                <td><?= $total_normalisasi; ?></td>
                            </tr>
                            <?php $no_normalisasi++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- END NORMALISASI MATRIKS -->

            <!-- START PERANKINGAN -->
            <div class="col-10 mt-2 mb-2">
                <h4 style="font-weight: bold;">PERANKINGAN</h4>
                <table class="table table-bordered text-center align-middle">
                    <thead style="background-color:  #867df9;">
                        <tr>
                            <th>NO.</th>
                            <th>NAMA LENGKAP</th>
                            <th>NILAI</th>
                            <th>PERSENTASE</th>
                            <th>RANKING</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no_ranking = 1;
                        $ranking = query("SELECT tb_rating.*, tb_hasil_penilaian.nama FROM tb_rating INNER JOIN tb_hasil_penilaian ON tb_rating.id_penilaian = tb_hasil_penilaian.id_penilaian ORDER BY total_rating DESC");
                        ?>

                        <?php foreach ($ranking as $rk) : ?>
                            <?php
                            $normalisasi_k1 = $rk['kehadiran'] / $max_k1;
                            $normalisasi_k2 = $rk['tugas'] / $max_k2;
                            $normalisasi_k3 = $rk['quiz_project'] / $max_k3;

                            $nilai_total = ($normalisasi_k1 * 0.33) + ($normalisasi_k2 * 0.33) + ($normalisasi_k3 * 0.33);
                            $persentase = $nilai_total * 100;
                            ?>
                            <tr>
                                <th><?= $no_ranking; ?></th>
                                <td class="text-start"><?= $rk['nama']; ?></td>
                                <td><?= $nilai_total; ?></td>
                                <td><?= $persentase; ?>%</td>
                                <td>Ranking-<?= $no_ranking; ?></td>
                            </tr>
                            <?php $no_ranking++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- END PERANKINGAN -->

        </div>
    </div>
    <!-- End Content -->

    <!-- Link Bootstrap JavaScript -->
    <script src="asset/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>