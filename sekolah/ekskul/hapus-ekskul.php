<?php
session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";

if (isset($_GET["id_ekskul"])) {
    $id_ekskul = (int) $_GET["id_ekskul"];

    // cek apakah data ekskul ada
    $queryEkskul = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul WHERE id_ekskul = $id_ekskul");
    if (!$queryEkskul || mysqli_num_rows($queryEkskul) == 0) {
        die("Data ekskul tidak ditemukan.");
    }

    // ambil semua foto terkait
    $fotoQ = mysqli_query($koneksi, "SELECT nama_file FROM tbl_ekskul_foto WHERE id_ekskul = $id_ekskul");
    while ($foto = mysqli_fetch_assoc($fotoQ)) {
        $gambar = $foto['nama_file'];
        if ($gambar != 'default.png' && file_exists("../asset/image/" . $gambar)) {
            unlink("../asset/image/" . $gambar);
        }
    }

    // hapus semua foto di database
    mysqli_query($koneksi, "DELETE FROM tbl_ekskul_foto WHERE id_ekskul = $id_ekskul");

    // hapus data ekskul utama
    mysqli_query($koneksi, "DELETE FROM tbl_ekskul WHERE id_ekskul = $id_ekskul");

    header("location: ekstrakurikuler.php?msg=deleted");
    exit();
} else {
    die("Parameter id_ekskul tidak ada di URL.");
}
