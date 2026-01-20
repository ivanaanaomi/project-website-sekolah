<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";

$id_berita = $_GET["id_berita"];
$gambar = $_GET["gambar"];

mysqli_query($koneksi, "DELETE FROM tbl_berita WHERE id_berita = $id_berita");
if ($gambar != 'default.png' && file_exists("../asset/image/" . $gambar)) {
    unlink("../asset/image/" . $gambar);
}

header("location:berita.php?msg=deleted");
exit();
