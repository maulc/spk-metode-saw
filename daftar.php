<?php

// MENGHUBUNGKAN KONEKSI DATABASE
  require "koneksi2.php";

  if (isset($_POST["daftar"])) {
    if (daftar($_POST) > 0) {
      echo "<script>
          alert( 'Data berhasil ditambahkan' );
      </script>";
    } else {
      echo "<script>
          alert( 'Data gagal ditambahkan !' );
      </script>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="POST">
    <input type="text" name="username">
    <input type="text" name="email">
    <input type="text" name="password">

    <button type="submit" name="daftar">xxx</button>
  </form>
  </body>
</html>