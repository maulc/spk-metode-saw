<?php
//setting default timezone
date_default_timezone_set('Asia/Jakarta');

//start session
session_start();



//membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_saw");

if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}



//membuat function base_url
function base_url($url = null)
{
    $base_url = "http://localhost/spk_metode_saw";

    if ($url != null) {
        return $base_url . "/" . $url;
    } else {
        return $base_url;
    }
}
?>

<?php
// FUNCTION LOGIN
function login($data)
{
    global $conn;

    $email = $_POST["email_user"];
    $password = $_POST["password_user"];

    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email' ") or die(mysqli_error($conn));

    // CEK USERNAME APAKAH ADA PADA TABEL TB_REGIS_MHS
    if (mysqli_num_rows($result) === 1) {

        // CEK APAKAH PASSWORD BENAR 
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {

            // SET SESSION LOGIN
            $_SESSION["login"] = true;

            // SET SESSION USER
            $_SESSION["id_user"] = $row["id_user"];

            // Cek Remember
            if (isset($_POST['remember_me'])) {
                // Buat Cookie
                setcookie('id_user', $row['id_user'], time() + 86400, '/');
                setcookie('key', hash('sha256', $row['username']), time() + 86400, '/');
            }
        } else {
            return false;
        }
    }
    return mysqli_affected_rows($conn);
}





// CHECK COOKIE
function checkCookie()
{
    global $conn;

    // Cek Cookie
    if (isset($_COOKIE['id_user']) && isset($_COOKIE['key'])) {
        $id_user = $_COOKIE['id_user'];
        $key = $_COOKIE['key'];

        $result = mysqli_query($conn, "SELECT username FROM tb_user WHERE id_user = '$id_user' ");
        $row = mysqli_fetch_assoc($result);

        if ($key === hash('sha256', $row['username'])) {
            $_SESSION['login'] = true;
        }
    }
}





// MEMBUAT FUNCTION SHOW DATA (READ)
function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $boxs = [];

    // AMBIL DATA (FETCH) DARI VARIABEL RESULT DAN MASUKKAN KE ARRAY
    while ($box = mysqli_fetch_assoc($result)) {
        $boxs[] = $box;
    }
    return $boxs;
}



function tambah_data($data)
{
    global $conn;

    $nama = strtolower(stripcslashes($data["nama"]));
    $k1 = strtolower(stripcslashes($data["kehadiran"]));

    $k2 = (float)stripcslashes($data["tugas"]);
    $k2 = number_format($k2, 2, '.', ' ');

    $k3 = (float)stripcslashes($data["quiz_project"]);
    $k3 = number_format($k3, 2, '.', ' ');


    // CHECK APAKAH NILAI YANG DIINPUTKAN MEMENUHI SYARAT
    if (($k2 < 0) || ($k2 > 5) || ($k3 < 0) || ($k3 > 5)) {
        echo "<script>
                alert( 'Value range : 0.00 - 100' );
            </script>";

        return false;
    }

    // CEK NAMA SUDAH ADA ATAU BELUM
    $result = mysqli_query($conn, "SELECT nama FROM tb_hasil_penilaian WHERE nama = '$nama' ");

    // CHECK DUCPLICATE
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
		alert('Nama yang anda inputkan sudah ada !');
		</script>";

        return false;
    }

    // TAMBAHKAN HASIL PENILAIAN
    $query_penilaian = "INSERT INTO tb_hasil_penilaian(nama, kehadiran, tugas, quiz_project) 
	VALUES('$nama', '$k1', '$k2', '$k3')";
    mysqli_query($conn, $query_penilaian) or die(mysqli_error($conn));

    // PEMBULATAN NILAI
    if ($k1 == "1") {
        $bobot_k1 = (float)0.2;
    } else if ($k1 == "2") {
        $bobot_k1 = (float)0.4;
    } else if ($k1 == "3") {
        $bobot_k1 = (float)0.6;
    } else if ($k1 == "4") {
        $bobot_k1 = (float)0.8;
    } else if ($k1 == "5") {
        $bobot_k1 = (float)1;
    }

    $k2 = ceil($k2);
    if ($k2 == 1) {
        $bobot_k2 = (float)0.2;
    } else if ($k2 == 2) {
        $bobot_k2 = (float)0.4;
    } else if ($k2 == 3) {
        $bobot_k2 = (float)0.6;
    } else if ($k2 == 4) {
        $bobot_k2 = (float)0.8;
    } else if ($k2 == 5) {
        $bobot_k2 = (float)1;
    }

    $k3 = ceil($k3);
    if ($k3 == 1) {
        $bobot_k3 = (float)0.2;
    } else if ($k3 == 2) {
        $bobot_k3 = (float)0.4;
    } else if ($k3 == 3) {
        $bobot_k3 = (float)0.6;
    } else if ($k3 == 4) {
        $bobot_k3 = (float)0.8;
    } else if ($k3 == 5) {
        $bobot_k3 = (float)1;
    }


    $total_rating = $bobot_k1 + $bobot_k2 + $bobot_k3;

    $get_id = mysqli_query($conn, "SELECT * FROM tb_hasil_penilaian WHERE nama = '$nama' ");
    if (mysqli_num_rows($get_id) === 1) {

        $row = mysqli_fetch_assoc($get_id);
        $id_penilaian = $row["id_penilaian"];

        // TAMBAHKAN RATING
        $query_rating = "INSERT INTO tb_rating(id_penilaian, kehadiran, tugas, quiz_project, total_rating) 
        VALUES('$id_penilaian', '$bobot_k1', '$bobot_k2', '$bobot_k3','$total_rating')";
        mysqli_query($conn, $query_rating) or die(mysqli_error($conn));
    }


    return mysqli_affected_rows($conn);
}
