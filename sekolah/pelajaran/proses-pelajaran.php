<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $pelajaran  = htmlspecialchars($_POST['pelajaran']);
    $guru       = $_POST['guru'];

    mysqli_query($koneksi, "INSERT INTO tbl_pelajaran VALUES 
    (null, '$pelajaran', '$guru')");

    header("location:pelajaran.php?msg=added");
    return;
}

if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $pelajaran  = htmlspecialchars($_POST['pelajaran']);
    $guru       = $_POST['guru'];

    mysqli_query($koneksi, "UPDATE tbl_pelajaran SET pelajaran = '$pelajaran', guru = '$guru' WHERE id = '$id'");

    header("location:pelajaran.php?msg=updated");
    return;
}
