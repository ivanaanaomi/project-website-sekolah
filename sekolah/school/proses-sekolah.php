<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $id         = $_POST['id'];
    $nama       = trim(htmlspecialchars($_POST['nama']));
    $npsn       = trim(htmlspecialchars($_POST['npsn']));
    $email      = trim(htmlspecialchars($_POST['email']));
    $akreditasi = $_POST['akreditasi'];
    $kurikulum = isset($_POST['kurikulum']) ? implode(",", $_POST['kurikulum']) : "";
    $alamat     = trim(htmlspecialchars($_POST['alamat']));
    $visi       = trim(htmlspecialchars($_POST['visi']));
    $misi       = trim(htmlspecialchars($_POST['misi']));
    $sambutan       = trim(htmlspecialchars($_POST['sambutan']));
    $ucapan       = trim(htmlspecialchars($_POST['ucapan']));
    $gbr        = trim(htmlspecialchars($_POST['gbrLama']));

    if ($_FILES['image']['error'] === 4) {
        $gbrSekolah = $gbr;
    } else {
        $url = 'profile-sekolah.php';
        $gbrSekolah = uploadimg($url, $nama);
        @unlink('../asset/image/' . $gbr);
    }

    mysqli_query($koneksi, "UPDATE tbl_sekolah SET
                            nama = '$nama',
                            npsn = '$npsn',
                            alamat = '$alamat',
                            akreditasi = '$akreditasi',
                            kurikulum = '$kurikulum',
                            email = '$email',
                            visi = '$visi',
                            misi = '$misi',
                            sambutan = '$sambutan',
                            ucapan = '$ucapan',
                            gambar = '$gbrSekolah'
                            WHERE id = '$id'");
    header("location:profile-sekolah.php?msg=updated");
    return;
}
