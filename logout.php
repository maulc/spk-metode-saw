<?php

// MENGHUBUNGKAN KONEKSI DATABASE
require "koneksi.php";

// SESSION LOGOUT
$_SESSION = [];
session_unset();
session_destroy();
session_write_close();
setcookie('id_user', '', time() - 3600, '/');
setcookie('key', '', time() - 3600, '/');
session_regenerate_id(true);

header('location: login.php');
exit;
