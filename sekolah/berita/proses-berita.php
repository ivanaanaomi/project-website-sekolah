<?php

use Dom\Mysql;

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $judul = htmlspecialchars($_POST['judul']);
    $slug           = $_POST['slug'];
    $isi           = htmlspecialchars($_POST['isi']);
    $penulis      = htmlspecialchars($_POST['penulis']);
    $kategori          = $_POST['kategori'];
    $tanggal  = $_POST['tanggal'];

    $gambar = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $newName = uniqid() . "." . $ext;
        $uploadPath = "../asset/image/" . $newName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            $gambar = $newName;
        }
    } else {
        $gambar = "default.png";
    }


    mysqli_query($koneksi, "INSERT INTO tbl_berita VALUES (null, '$judul',
                '$slug','$isi','$gambar','$penulis','$kategori','$tanggal', NOW(), NOW())");

    echo "<script>
            alert('Data siswa berhasil disimpan');
            document.location.href = 'form-berita.php';
         </script>";
    return;
} else if (isset($_POST['update'])) {
    $id_berita = $_POST['id_berita'];
    $judul = htmlspecialchars($_POST['judul']);
    $slug           = $_POST['slug'];
    $isi           = htmlspecialchars($_POST['isi']);
    $penulis      = htmlspecialchars($_POST['penulis']);
    $kategori          = $_POST['kategori'];
    $tanggal  = $_POST['tanggal'];
    $created_at          = $_POST['created_at'];
    $updated_at         = $_POST['updated_at'];
    $gambar = htmlspecialchars($_POST['fotoLama']);

    if ($_FILES['image']['error'] === 4) {
        $fotoBerita = $gambar; // pakai foto lama
    } else {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $newName = uniqid() . "." . $ext;
        $uploadPath = "../asset/image/" . $newName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            $fotoBerita = $newName;
            // hapus foto lama kecuali default
            if ($gambar != "default.png") {
                @unlink("../asset/image/" . $gambar);
            }
        }
    }


    mysqli_query($koneksi, "UPDATE tbl_berita SET
                            judul = '$judul',
                            slug = '$slug',
                            isi = '$isi',
                            gambar = '$fotoBerita',
                            penulis = '$penulis',
                            kategori = '$kategori',
                            tanggal = '$tanggal',
                            updated_at = NOW()
                            WHERE id_berita = '$id_berita'");
    echo "<script>
            alert('Data berhasil diperbaharui');
            document.location.href='berita.php';
          </script>";
    return;
}
