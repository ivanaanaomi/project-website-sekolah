<?php
session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";

$folder = "../asset/image/";

// === TAMBAH EKSKUL BARU ===
if (isset($_POST['simpan'])) {
    $nama      = $_POST['nama_ekskul'];
    $ket       = $_POST['keterangan'];
    $p_putra   = $_POST['pembina_putra'] ?? null;
    $p_putri   = $_POST['pembina_putri'] ?? null;
    $pelatih   = $_POST['pelatih'] ?? null;
    $hari      = $_POST['hari'];

    $sql = "INSERT INTO tbl_ekskul (nama_ekskul, keterangan, pembina_putra, pembina_putri, pelatih, hari)
            VALUES ('$nama', '$ket', '$p_putra', '$p_putri', '$pelatih', '$hari')";
    if (!mysqli_query($koneksi, $sql)) {
        die("Gagal simpan ekskul: " . mysqli_error($koneksi));
    }

    $id_ekskul = mysqli_insert_id($koneksi);

    // Upload foto
    if (!empty($_FILES['image']['name'][0])) {
        $jumlahFile = count($_FILES['image']['name']);
        for ($i = 0; $i < $jumlahFile; $i++) {
            if ($_FILES['image']['error'][$i] === UPLOAD_ERR_OK) {
                $tmp = $_FILES['image']['tmp_name'][$i];
                $ext = strtolower(pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION));
                $namaFile = time() . "_" . uniqid() . "." . $ext;

                if (move_uploaded_file($tmp, $folder . $namaFile)) {
                    mysqli_query(
                        $koneksi,
                        "INSERT INTO tbl_ekskul_foto (id_ekskul, nama_file) 
                         VALUES ('$id_ekskul', '$namaFile')"
                    );
                }
            }
        }
    }

    header("Location: ekstrakurikuler.php?msg=saved");
    exit;
}

// === UPDATE EKSKUL ===
if (isset($_POST['update'])) {
    $id_ekskul = $_POST['id_ekskul'];
    $nama      = $_POST['nama_ekskul'];
    $ket       = $_POST['keterangan'];
    $p_putra   = $_POST['pembina_putra'] ?? null;
    $p_putri   = $_POST['pembina_putri'] ?? null;
    $pelatih   = $_POST['pelatih'] ?? null;
    $hari      = $_POST['hari'];

    $sql = "UPDATE tbl_ekskul 
            SET nama_ekskul='$nama',
                keterangan='$ket',
                pembina_putra='$p_putra',
                pembina_putri='$p_putri',
                pelatih='$pelatih',
                hari='$hari'
            WHERE id_ekskul='$id_ekskul'";

    if (!mysqli_query($koneksi, $sql)) {
        die("Gagal update ekskul: " . mysqli_error($koneksi));
    }

    // Tambahkan foto baru kalau ada
    if (!empty($_FILES['image']['name'][0])) {
        $jumlahFile = count($_FILES['image']['name']);
        for ($i = 0; $i < $jumlahFile; $i++) {
            if ($_FILES['image']['error'][$i] === UPLOAD_ERR_OK) {
                $tmp = $_FILES['image']['tmp_name'][$i];
                $ext = strtolower(pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION));
                $namaFile = time() . "_" . uniqid() . "." . $ext;

                if (move_uploaded_file($tmp, $folder . $namaFile)) {
                    mysqli_query(
                        $koneksi,
                        "INSERT INTO tbl_ekskul_foto (id_ekskul, nama_file) 
                         VALUES ('$id_ekskul', '$namaFile')"
                    );
                }
            }
        }
    }

    header("Location: ekstrakurikuler.php?id=$id_ekskul&msg=updated");
    exit;
}

// === HAPUS FOTO TERTENTU ===
if (isset($_GET['hapus_foto'])) {
    $id_foto = $_GET['hapus_foto'];

    // ambil nama file
    $fotoQ = mysqli_query($koneksi, "SELECT nama_file, id_ekskul FROM tbl_ekskul_foto WHERE id_foto='$id_foto'");
    $foto = mysqli_fetch_assoc($fotoQ);

    if ($foto) {
        $filePath = $folder . $foto['nama_file'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        mysqli_query($koneksi, "DELETE FROM tbl_ekskul_foto WHERE id_foto='$id_foto'");
        $id_ekskul = $foto['id_ekskul'];
        header("Location: edit-ekskul.php?id=$id_ekskul&msg=fotodeleted");
        exit;
    }
}
