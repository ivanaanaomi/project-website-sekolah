<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Tambah Guru - SMPN 14 Pematangsiantar";
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
    Tambah data gagal, nip sudah terdaftar.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}
if ($msg == 'notimage') {
    $alert = '<div class="alert alert-warning alert-dismissible 
    fade show" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i> 
    Tambah data gagal, file yang anda unggah bukan gambar.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}
if ($msg == 'oversize') {
    $alert = '<div class="alert alert-warning alert-dismissible 
    fade show" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i> 
    Tambah data gagal, file yang anda unggah berukuran lebih dari 1MB.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}
if ($msg == 'added') {
    $alert = '<div class="alert alert-success alert-dismissible 
    fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> 
    Data guru berhasil ditambahkan.
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
                <li class="breadcrumb-item"><a href="guru.php">Guru</a></li>
                <li class="breadcrumb-item active">Tambah Guru</li>
            </ol>

            <form action="proses-guru.php" method="POST" enctype="multipart/form-data">
                <?php
                if ($msg != '') {
                    echo $alert;
                }

                ?>

                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-square-plus"></i>
                            Tambah Guru</span>
                        <button type="submit" name="simpan"
                            class="btn btn-primary float-end me-1"> <i class="fa-solid 
                    fa-floppy-disk"></i> Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger 
                    float-end me-1"><i class="fa-solid fa-xmark">
                            </i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mb-3 row">
                                    <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0
                                    border-bottom ps-2" id="nip" name="nip" pattern="[0-9]{18,}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0
                                    border-bottom ps-2" id="nama" name="nama" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0
                                    border-bottom ps-2" id="jabatan" name="jabatan" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="tgl_lahir" class="col-sm-2 
                                col-form-label">Tanggal Lahir</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="kontak" class="col-sm-2 col-form-label">Kontak</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="tel" class="form-control border-0
                                    border-bottom ps-2" id="kontak" name="kontak"
                                            pattern="^(\+62|62|0)8[1-9][0-9]{7,10}$">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="agama" class="col-sm-2 
                                col-form-label">Agama</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <select name="agama" id="agama" class="form-select 
                                    border-0 border-bottom" required>
                                            <option selected>--Pilih Agama--</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Protestan">Protestan</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Khonghucu">Khonghucu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="jenis_kelamin" class="col-sm-2 
                                    col-form-label">Jenis Kelamin</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <select name="jenis_kelamin" id="jenis_kelamin"
                                            class="form-select border-0 border-bottom" required>
                                            <option selected>--Pilih Jenis Kelamin--</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
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
                                            placeholder="Alamat Guru"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center px-5">
                                <img src="../asset/image/default.png" alt="Foto Guru"
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