<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $nip            = htmlspecialchars($_POST['nip']);
    $nama           = htmlspecialchars($_POST['nama']);
    $jabatan        = htmlspecialchars($_POST['jabatan']);
    $tgl_lahir      = $_POST['tgl_lahir'];
    $kontak         = htmlspecialchars($_POST['kontak']);
    $agama          = $_POST['agama'];
    $jenis_kelamin  = $_POST['jenis_kelamin'];
    $alamat         = htmlspecialchars($_POST['alamat']);
    $foto           = htmlspecialchars($_FILES['image']['name']);

    $cekNip = mysqli_query($koneksi, "SELECT nip FROM tbl_guru 
                                      WHERE nip = '$nip'");
    if (mysqli_num_rows($cekNip) > 0) {
        header("location:add-guru.php?msg=cancel");
        return;
    }

    if ($foto != null) {
        $url = "add-guru.php";
        $foto = uploadimg($url, $nama);
    } else {
        $foto = "default.png";
    }

    mysqli_query($koneksi, "INSERT INTO tbl_guru VALUES (null, '$nip',
                '$nama','$jabatan','$tgl_lahir','$jenis_kelamin',
                '$alamat','$kontak','$agama','$foto')");

    header("location:add-guru.php?msg=added");
    return;
}

if (isset($_POST['update'])) {
    $id             = $_POST['id'];
    $nip            = htmlspecialchars($_POST['nip']);
    $nama           = htmlspecialchars($_POST['nama']);
    $jabatan        = htmlspecialchars($_POST['jabatan']);
    $tgl_lahir      = $_POST['tgl_lahir'];
    $kontak         = htmlspecialchars($_POST['kontak']);
    $agama          = $_POST['agama'];
    $jenis_kelamin  = $_POST['jenis_kelamin'];
    $alamat         = htmlspecialchars($_POST['alamat']);
    $foto           = htmlspecialchars($_POST['fotoLama']);

    $sqlGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru WHERE id = $id");
    $data = mysqli_fetch_array($sqlGuru);
    $curNIP = $data['nip'];

    $newNIP = mysqli_query($koneksi, "SELECT nip FROM tbl_guru WHERE nip = '$nip'");

    if ($nip != $curNIP) {
        if (mysqli_num_rows($newNIP) > 0) {
            header("location:guru.php?msg=cancel");
            return;
        }
    }

    if ($_FILES['image']['error'] === 4) {
        $fotoGuru = $foto;
    } else {
        $url = "guru.php";
        $fotoGuru = uploadimg($url, $nama);
        if ($foto != 'default.png') {
            @unlink('../asset/image/' . $foto);
        }
    }

    mysqli_query($koneksi, "UPDATE tbl_guru SET
                            nip = '$nip',
                            nama = '$nama',
                            jabatan = '$jabatan',
                            tgl_lahir = '$tgl_lahir',
                            jenis_kelamin = '$jenis_kelamin',
                            alamat = '$alamat',
                            kontak = '$kontak',
                            agama = '$agama',
                            foto = '$fotoGuru'
                            WHERE id = $id");
    header("location:guru.php?msg=updated");
    return;
}
