<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Mata Pelajaran - SMPN 14 Pematangsiantar";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

$alert = '';
if ($msg == 'cancel') {
    $alert = '<div class="alert alert-warning alert-dismissible 
    fade show" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i> 
    Data gagal diperbaharui.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}
if ($msg == 'updated') {
    $alert = '<div class="alert alert-success alert-dismissible 
    fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> 
    Data berhasil diperbaharui.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}
if ($msg == 'added') {
    $alert = '<div class="alert alert-success alert-dismissible 
    fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> 
    Data berhasil ditambahkan.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}
if ($msg == 'notimage') {
    $alert = '<div class="alert alert-warning alert-dismissible 
    fade show" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i> 
    Data sekolah gagal diperbaharui, file yang anda unggah bukan gambar.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}
if ($msg == 'oversize') {
    $alert = '<div class="alert alert-warning alert-dismissible 
    fade show" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i> 
    Data sekolah gagal diperbaharui, file yang anda unggah berukuran lebih dari 1MB.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}

$footer = mysqli_query($koneksi, "SELECT * FROM tbl_footer WHERE id = 1");
$data = mysqli_fetch_array($footer);

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Footer</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Footer</li>
            </ol>

            <form action="proses-footer.php" method="POST" enctype="multipart/form-data">

                <?php
                if ($msg != '') {
                    echo $alert;
                }
                ?>

                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-square-plus me-1">
                            </i> Tambah Footer</span>
                        <button type="submit" name="simpan" class="btn btn-primary 
                    float-end me-1"><i class="fa-solid fa-floppy-disk">
                            </i> Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger 
                    float-end me-1"><i class="fa-solid fa-xmark">
                            </i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 text-center px-5">
                                <input type="hidden" name="gbrLama" value="<?= $data['foto'] ?>">
                                <img src="../asset/image/<?= $data['foto'] ?>" alt="Gambar Sekolah"
                                    class="mb-3" width="100%">
                                <input type="file" name="image" class="form-control 
                            form-control-sm">
                                <small class="text-secondary">Pilih foto PNG, JPG atau JPEG dengan ukuran maximal 1MB</small>
                            </div>
                            <div class="col-8">
                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                <div class="mb-3 row">
                                    <label for="phone" class="col-sm-2 col-form-label">Telp</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="tel" class="form-control border-0
                                    border-bottom ps-2" id="phone" name="phone" value="<?= $data['phone'] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="email" class="form-control border-0
                                    border-bottom ps-2" id="email" name="email" value="<?= $data['email'] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="kota" class="col-sm-2 col-form-label">Alamat</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <textarea name="alamat" id="alamat" cols="30"
                                            rows="3" class="form-control"
                                            placeholder="Alamat Sekolah" required><?= $data['alamat'] ?></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="maps" class="col-sm-2 col-form-label">Link Maps</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="maps" class="form-control border-0
                                    border-bottom ps-2" id="maps" name="maps" value="<?= $data['maps'] ?>" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <?php

    require_once "../template/footer.php";

    ?>