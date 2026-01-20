<?php

$koneksi = mysqli_connect("localhost", "root", "", "db_sekolah");

$main_url = "http://localhost/sekolah/";

function uploadimg($url, $namainput)
{
    $namafile   = $_FILES['image']['name'];
    $ukuran     = $_FILES['image']['size'];
    $error      = $_FILES['image']['error'];
    $tmp        = $_FILES['image']['tmp_name'];

    $validExtension = ['jpg', 'jpeg', 'png'];
    $fileExtension = strtolower(pathinfo($namafile, PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $validExtension)) {
        header("location:" . $url . "?msg=notimage");
        die;
    }

    if ($ukuran > 1000000) {
        header("location:" . $url . "?msg=oversize");
        die;
    }



    // Sanitasi nama input (username/nama)
    $namainput = preg_replace("/[^a-zA-Z0-9]/", "-", strtolower($namainput));

    // Nama file baru
    $namafilebaru = rand(100, 9999) . '-' . $namainput . '.' . $fileExtension;

    move_uploaded_file($tmp, "../asset/image/" . $namafilebaru);
    return $namafilebaru;
}
