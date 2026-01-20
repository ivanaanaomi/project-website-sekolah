<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Guru - SMPN 14 Pematangsiantar";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

$alert = '';
if ($msg == 'deleted') {
    $alert = '<div class="alert alert-success alert-dismissible 
    fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> 
    Data berhasil dihapus.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}
if ($msg == 'updated') {
    $alert = '<div class="alert alert-success alert-dismissible 
    fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> 
    Data guru berhasil diperbahauri.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}
if ($msg == 'cancel') {
    $alert = '<div class="alert alert-success alert-dismissible 
    fade show" role="alert">
    <i class="fa-solid fa-circle-xmark"></i> 
    Data guru gagal berhasil diperbahauri, NIP sudah ada.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Guru</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Guru</li>
            </ol>

            <?php
            if ($msg != '') {
                echo $alert;
            }

            ?>

            <div class="card">
                <div class="card-header h5">
                    <i class="fa-solid fa-list-ul me-1"></i> Data Guru
                    <a href="<?= $main_url ?>guru/add-guru.php" class="btn btn-sm 
                    btn-primary float-end me-1"><i class="fa-solid fa-plus"></i>
                        Tambah Guru</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <center>No</center>
                                </th>
                                <th scope="col">
                                    <center>Foto</center>
                                </th>
                                <th scope="col">
                                    <center>NIP</center>
                                </th>
                                <th scope="col">
                                    <center>Nama</center>
                                </th>
                                <th scope="col">
                                    <center>Jabatan</center>
                                </th>
                                <th scope="col">
                                    <center>Tanggal Lahir</center>
                                </th>
                                <th scope="col">
                                    <center>Kontak</center>
                                </th>
                                <th scope="col">
                                    <center>Agama</center>
                                </th>
                                <th scope="col">
                                    <center>Jenis Kelamin</center>
                                </th>
                                <th scope="col">
                                    <center>Alamat</center>
                                </th>
                                <th scope="col">
                                    <center>Operasi</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            <?php
                            $no = 1;
                            $queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru");
                            while ($data = mysqli_fetch_array($queryGuru)) { ?>
                                <tr>
                                    <th scope="row">
                                        <center><?= $no++ ?>.</center>
                                    </th>
                                    <td>
                                        <center><img src="../asset/image/<?= $data['foto'] ?>"
                                                alt="Foto Guru" class="rounded-circle mb-3" style="width: 65px; 
                                        height: 65px; object-fit: cover;"></center>
                                    </td>
                                    <td>
                                        <center><?= $data['nip'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $data['nama'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $data['jabatan'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $data['tgl_lahir'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $data['kontak'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $data['agama'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $data['jenis_kelamin'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $data['alamat'] ?></center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="edit-guru.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-warning"
                                                title="Update Data Guru">
                                                <i class="fa-solid fa-pen"></i></a>
                                            <button type="button" class="btn btn-sm btn-danger" id="btnHapus" data-id="<?= $data['id'] ?>"
                                                data-foto="<?= $data['foto'] ?>" title="Hapus Data Guru"><i class="fa-solid fa-trash"></i></button>
                                        </center>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- modal hapus data -->
    <div class="modal" id="mdlHapus" tabindex="-1"
        data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="" id="btnMdlHapus" class="btn btn-primary">Hapus Data</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('click', "#btnHapus", function() {
                $('#mdlHapus').modal('show');
                let idGuru = $(this).data('id');
                let fotoGuru = $(this).data('foto');
                $('#btnMdlHapus').attr("href", "hapus-guru.php?id=" +
                    idGuru + "&foto=" + fotoGuru);
            })
        })
    </script>

    <?php

    require_once "../template/footer.php";

    ?>