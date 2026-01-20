<?php

date_default_timezone_set('Asia/Jakarta');

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'db_sekolah';

$koneksi = mysqli_connect($host, $user, $pass, $db);

// if (mysqli_connect_errno()) {
//     echo "Gagal koneksi ke database";
//     exit();
// } else {
//     echo "Berhasil koneksi ke database";
// }

$main_url = 'http://localhost/siakad/';
