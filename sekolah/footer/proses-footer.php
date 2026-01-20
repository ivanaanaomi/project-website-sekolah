<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $id     = $_POST['id'];
    $phone  = trim(htmlspecialchars($_POST['phone']));
    $email  = trim(htmlspecialchars($_POST['email']));
    $alamat = trim(htmlspecialchars($_POST['alamat']));
    $maps   = $_POST['maps'];
    $gbr    = trim(htmlspecialchars($_POST['gbrLama']));

    if ($_FILES['image']['error'] === 4) {
        $gbrSekolah = $gbr;
    } else {
        $url = 'input-footer.php';
        $gbrSekolah = uploadimg($url, $nama);
        @unlink('../asset/image/' . $gbr);
    }

    if (!empty($id)) {
        // UPDATE
        mysqli_query($koneksi, "UPDATE tbl_footer SET
                                alamat = '$alamat',
                                phone = '$phone',
                                email = '$email',
                                maps = '$maps',
                                foto = '$gbrSekolah'
                                WHERE id = $id");
        header("location:input-footer.php?msg=updated");
    } else {
        // INSERT
        mysqli_query($koneksi, "INSERT INTO tbl_footer (alamat, phone, email, maps, foto) 
                                VALUES ('$alamat', '$phone', '$email', '$maps','$gbrSekolah')");
        header("location:input-footer.php?msg=added");
    }
    return;
}
