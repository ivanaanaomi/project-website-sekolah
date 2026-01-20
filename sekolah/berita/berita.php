<?php
session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Berita - SMPN 14 Pematangsiantar";
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
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> Data berita berhasil dihapus.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if ($msg == 'updated') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> Data berita berhasil diperbaharui.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if ($msg == 'cancel') {
    $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-xmark"></i> Gagal menyimpan berita. Judul sudah ada.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Berita Sekolah</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Berita</li>
            </ol>

            <?php if ($msg != '') echo $alert; ?>

            <div class="card">
                <div class="card-header h5">
                    <i class="fa-solid fa-list-ul me-1"></i> Data Berita/Agenda
                    <a href="form-berita.php" class="btn btn-sm btn-primary float-end me-1">
                        <i class="fa-solid fa-plus"></i> Tambah Berita
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                <th>
                                    <center>Gambar</center>
                                </th>
                                <th>
                                    <center>Judul</center>
                                </th>
                                <th>
                                    <center>Tanggal</center>
                                </th>
                                <th>
                                    <center>Isi Singkat</center>
                                </th>
                                <th>
                                    <center>Operasi</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $queryBerita = mysqli_query($koneksi, "SELECT * FROM tbl_berita ORDER BY tanggal DESC");
                            while ($data = mysqli_fetch_array($queryBerita)) { ?>
                                <tr>
                                    <td>
                                        <center><?= $no++ ?>.</center>
                                    </td>
                                    <td>
                                        <center>
                                            <img src="../asset/image/<?= $data['gambar'] ?>"
                                                alt="Gambar Berita" style="width: 80px; height: 60px; object-fit: cover;">
                                        </center>
                                    </td>
                                    <td><?= $data['judul'] ?></td>
                                    <td>
                                        <center><?= date('d-m-Y', strtotime($data['tanggal'])) ?></center>
                                    </td>
                                    <td><?= substr($data['isi'], 0, 100) ?>...</td>
                                    <td>
                                        <center>
                                            <a href="edit-berita.php?id_berita=<?= $data['id_berita'] ?>" class="btn btn-sm btn-warning" title="Update Berita">
                                                <i class="fa-solid fa-pen"></i></a>
                                            <button type="button" class="btn btn-sm btn-danger" id="btnHapus"
                                                data-id_berita="<?= $data['id_berita'] ?>" data-gambar="<?= $data['gambar'] ?>" title="Hapus Berita">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
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

    <!-- Modal Hapus -->
    <div class="modal" id="mdlHapus" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus berita ini?</p>
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
                let idBerita = $(this).data('id_berita');
                let gambar = $(this).data('gambar');
                $('#btnMdlHapus').attr("href", "hapus-berita.php?id_berita=" + idBerita + "&gambar=" + gambar);
            });
        });
    </script>

    <?php require_once "../template/footer.php"; ?>