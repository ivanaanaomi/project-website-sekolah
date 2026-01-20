<?php

use Dom\Mysql;

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $nis            = htmlspecialchars($_POST['nis']);
    $nama           = htmlspecialchars($_POST['nama']);
    $nisn           = htmlspecialchars($_POST['nisn']);
    $tgl_lahir      = $_POST['tgl_lahir'];
    $agama          = $_POST['agama'];
    $jenis_kelamin  = $_POST['jenis_kelamin'];
    $kelas          = $_POST['kelas'];
    $alamat         = htmlspecialchars($_POST['alamat']);
    $foto           = htmlentities($_FILES['image']['name']);

    if ($foto != null) {
        $url = "add-siswa.php";
        $foto = uploadimg($url, $nama);
    } else {
        $foto = "default.png";
    }

    mysqli_query($koneksi, "INSERT INTO tbl_siswa VALUES (null, '$nis',
                '$nisn','$nama','$agama','$tgl_lahir','$jenis_kelamin',
                '$alamat','$kelas','$foto')");

    echo "<script>
            alert('Data siswa berhasil disimpan');
            document.location.href = 'add-siswa.php';
         </script>";
    return;
} else if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nis = htmlspecialchars($_POST['nis']);
    $nama = htmlspecialchars($_POST['nama']);
    $nisn = htmlspecialchars($_POST['nisn']);
    $tgl_lahir = $_POST['tgl_lahir'];
    $agama = $_POST['agama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kelas = $_POST['kelas'];
    $alamat = htmlspecialchars($_POST['alamat']);
    $foto = htmlspecialchars($_POST['fotoLama']);

    if ($_FILES['image']['error'] === 4) {
        $fotoSiswa = $foto;
    } else {
        $url = "siswa.php";
        $fotoSiswa = uploadimg($url, $nama);
        if ($foto != 'default.png') {
            @unlink('../asset/image/' . $foto);
        }
    }

    mysqli_query($koneksi, "UPDATE tbl_siswa SET
                            nis = '$nis',
                            nisn = '$nisn',
                            nama = '$nama',
                            tgl_lahir = '$tgl_lahir',
                            agama = '$agama',
                            jenis_kelamin = '$jenis_kelamin',
                            alamat = '$alamat',
                            kelas = '$kelas',
                            foto = '$fotoSiswa'
                            WHERE id = '$id'");
    echo "<script>
            alert('Data berhasil diperbaharui');
            document.location.href='siswa.php';
          </script>";
    return;
}
