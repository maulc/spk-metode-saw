<?php 

//membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_saw");

if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}


function daftar($data)
{
    global $conn;

    $username = strtoupper(stripcslashes($data["username"]));
    $email = strtolower(stripcslashes($data["email"]));
    $pwd = mysqli_real_escape_string($conn, $data["password"]);

    $password_enc = password_hash($pwd, PASSWORD_DEFAULT);


    $query = "INSERT INTO tb_user(username, email, password) VALUES ('$username', '$email', '$password_enc')";

    mysqli_query($conn, $query) or die (mysqli_error($conn));
}