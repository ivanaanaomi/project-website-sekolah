<?php
session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";

$id = intval($_GET["id"]);
$foto = $_GET["foto"];

$updateKelas = mysqli_query($koneksi, "UPDATE tbl_kelas SET wali_kelas = NULL WHERE wali_kelas = $id");
if (!$updateKelas) {
    die("Query gagal melepaskan wali kelas: " . mysqli_error($koneksi));
}

$updateJadwal = mysqli_query($koneksi, "UPDATE tbl_jadwal SET guru = NULL WHERE guru = $id");
if (!$updateJadwal) {
    die("Query gagal melepaskan guru dari jadwal: " . mysqli_error($koneksi));
}

$deleteGuru = mysqli_query($koneksi, "DELETE FROM tbl_guru WHERE id = $id");

if ($deleteGuru) {
    // Jika berhasil, hapus file foto dari server (jika bukan foto default)
    if ($foto != 'default.png' && file_exists("../asset/image/" . $foto)) {
        unlink("../asset/image/" . $foto);
    }
    // Arahkan kembali ke halaman guru dengan pesan sukses
    header("location:guru.php?msg=deleted");
} else {
    // Jika query DELETE gagal (seharusnya tidak terjadi jika langkah 1 & 2 berhasil)
    die("Query hapus guru gagal: " . mysqli_error($koneksi));
}
