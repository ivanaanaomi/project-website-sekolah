<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["ssLoginSiakad"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config/config.php";

$queryMax = mysqli_query($koneksi, "SELECT MAX(no_ujian) as max_no FROM tbl_ujian");
$dataMax = mysqli_fetch_assoc($queryMax);
$lastNo = $dataMax['max_no'];
$urut = (int) substr($lastNo, 4, 3);
$urut++;
$noUjian = "UTS-" . sprintf("%03s", $urut);

if (isset($_POST["simpan"])) {
    $tgl   = mysqli_real_escape_string($koneksi, $_POST["tgl"]);
    $nis   = mysqli_real_escape_string($koneksi, $_POST["nis"]);
    $kelas = mysqli_real_escape_string($koneksi, $_POST["kelas"]);
    $sum   = (int) $_POST["sum"];
    $min   = (int) $_POST["min"];
    $max   = (int) $_POST["max"];
    $avg   = (int) $_POST["avg"];

    // Ambil nama & NISN dari tabel siswa
    $qSiswa = mysqli_query($koneksi, "SELECT nama, nisn FROM tbl_siswa WHERE nis = '$nis'");
    $dataSiswa = mysqli_fetch_assoc($qSiswa);

    if (!$dataSiswa) {
        die("Error: NIS $nis tidak ditemukan di tabel siswa.");
    }

    $nama = mysqli_real_escape_string($koneksi, $dataSiswa['nama']);
    $nisn = mysqli_real_escape_string($koneksi, $dataSiswa['nisn']);

    // Menentukan hasil ujian
    $hasilUjian = ($min < 50 || $avg < 60) ? "GAGAL" : "LULUS";

    $mapel = $_POST["mapel"];
    $kls   = $_POST["kls"];
    $nilai = $_POST["nilai"];

    // Simpan ke tabel tbl_ujian
    $sqlUjian = "INSERT INTO tbl_ujian 
        (no_ujian, tgl_ujian, nis, nisn, nama, kelas, total_nilai, nilai_terendah, nilai_tertinggi, nilai_rata2, hasil_ujian) 
        VALUES (
            '$noUjian', '$tgl', '$nis', '$nisn', '$nama', '$kelas',
            $sum, $min, $max, $avg, '$hasilUjian'
        )";

    if (!mysqli_query($koneksi, $sqlUjian)) {
        die("Error simpan ujian: " . mysqli_error($koneksi));
    }

    // Simpan nilai per mata pelajaran
    foreach ($mapel as $key => $mpl) {
        $mpl = mysqli_real_escape_string($koneksi, $mpl);
        $kelasMapel = mysqli_real_escape_string($koneksi, $kls[$key]);
        $nilaiUjian = (int) $nilai[$key];

        $sqlNilai = "INSERT INTO tbl_nilai_ujian 
            (no_ujian, pelajaran, kelas, nilai_ujian) 
            VALUES (
                '$noUjian', '$mpl', '$kelasMapel', $nilaiUjian
            )";

        if (!mysqli_query($koneksi, $sqlNilai)) {
            die("Error simpan nilai mapel: " . mysqli_error($koneksi));
        }
    }

    // Redirect
    header("location:../ujian/nilai-ujian.php?msg=$hasilUjian&nis=$nis");
    exit;
}
