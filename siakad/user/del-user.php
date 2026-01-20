<?php

session_start();

if (!isset($_SESSION["ssLoginSiakad"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../module/mode-user.php";

$id = $_GET['id'];
$foto = $_GET['foto'];

if (delete($id, $foto)) {
    echo "
    <script> 
        alert('Data berhasil dihapus');
        document.location.href = 'data-user.php';
    </script>
    ";
} else {
    echo "
    <script> 
        alert('Data berhasil dihapus');
        document.location.href = 'data-user.php';
    </script>
    ";
}
