<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";

$title = "Tambah User - SMPN 14";
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
    Tambah user gagal, username sudah terdaftar.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}
if ($msg == 'notimage') {
    $alert = '<div class="alert alert-warning alert-dismissible 
    fade show" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i> 
    Tambah user gagal, file yang anda unggah bukan gambar.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}
if ($msg == 'oversize') {
    $alert = '<div class="alert alert-warning alert-dismissible 
    fade show" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i> 
    Tambah user gagal, file yang anda unggah berukuran lebih dari 1MB.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}
if ($msg == 'added') {
    $alert = '<div class="alert alert-success alert-dismissible 
    fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> 
    Tambah user berhasil, segera ganti password anda.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah User</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Tambah User</li>
            </ol>

            <form action="proses-user.php" method="POST" enctype="multipart/form-data">
                <?php
                if ($msg != '') {
                    echo $alert;
                }

                ?>

                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-square-plus"></i> Tambah User</span>
                        <button type="submit" name="simpan" class="btn btn-primary 
                    float-end"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger
                    float-end me-1"><i class="fa-solid fa-xmark"></i> Reset</button>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mb-3 row">
                                    <label for="username" class="col-sm-2 
                                col-form-label">Username</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" pattern="[A-Za-z0-9]{3,}"
                                            title="minimal 3 karakter kombinasi huruf besar,
                                    huruf kecil, dan angka" class="form-control border-0
                                    border-bottom" id="username" name="username"
                                            maxlength="20" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-2 
                                col-form-label">Nama</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0
                                    border-bottom" id="nama" name="nama" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="jabatan" class="col-sm-2 
                                col-form-label">Jabatan</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <select name="jabatan" id="jabatan"
                                            class="form-select border-0 border-bottom" required>
                                            <option value="" selected>--Pilih Jabatan--</option>
                                            <option value="kepsek">Kepsek</option>
                                            <option value="operator">Operator</option>
                                            <option value="guru">Guru Mata Pelajaran</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-2 
                                col-form-label">Alamat</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <textarea name="alamat" id="alamat" cols="30"
                                            rows="3" class="form-control"
                                            placeholder="Alamat Domisili" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4 text-center ps-5">
                                <img src="../asset/image/default.png" alt="Gambar User"
                                    class="rounded-circle mb-3" style="width: 140px; 
                                    height: 140px; object-fit: cover;">
                                <input type="file" name="image" class="form-control 
                                form-control-sm">
                                <small class="text-secondary">Pilih foto PNG, JPG atau JPEG dengan ukuran maximal 1MB</small>
                                <div><small class="text-secondary">Width = Height</small></div>
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