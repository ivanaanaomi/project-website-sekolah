<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Tambah Berita - SMPN 14 Pematangsiantar";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

$alert = '';
if ($msg == 'notimage') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i> 
    File yang diunggah bukan gambar.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if ($msg == 'oversize') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i> 
    Ukuran gambar lebih dari 1MB.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if ($msg == 'cancel') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i> 
    Berita gagal ditambahkan.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if ($msg == 'added') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> 
    Berita berhasil ditambahkan.
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
                <li class="breadcrumb-item"><a href="berita.php">Berita</a></li>
                <li class="breadcrumb-item active">Tambah Berita</li>
            </ol>

            <form action="proses-berita.php" method="POST" enctype="multipart/form-data">
                <?php
                if ($msg != '') {
                    echo $alert;
                }
                ?>

                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-square-plus"></i>
                            Tambah Berita</span>
                        <button type="submit" name="simpan"
                            class="btn btn-primary float-end me-1"> <i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger float-end me-1">
                            <i class="fa-solid fa-xmark"></i> Reset
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mb-3 row">
                                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0 border-bottom ps-2"
                                            id="judul" name="judul" required>
                                    </div>
                                </div>
                                <!-- Slug otomatis, tidak ditampilkan -->
                                <input type="hidden" name="slug" id="slug">

                                <div class="mb-3 row">
                                    <label for="isi" class="col-sm-2 col-form-label">Isi Berita</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <textarea name="isi" id="isi" cols="30" rows="5"
                                            class="form-control" placeholder="Tulis isi berita..." required></textarea>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0 border-bottom ps-2"
                                            id="penulis" name="penulis" value="Admin">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <select name="kategori" id="kategori" class="form-select">
                                            <option value="Umum" selected>Umum</option>
                                            <option value="Prestasi">Prestasi</option>
                                            <option value="Pengumuman">Pengumuman</option>
                                            <option value="Kegiatan">Kegiatan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4 text-center px-5">
                                <img src="../asset/image/default.png" alt="Foto Berita" class="img-thumbnail mb-3" id="preview" style="width: 100%; max-width: 250px; height: auto; object-fit: cover;">
                                <input type="file" name="image" class="form-control form-control-sm" onchange="previewImage(this)">
                                <small class="text-secondary">Pilih foto PNG, JPG atau JPEG max 1MB</small>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <?php require_once "../template/footer.php"; ?>
</div>

<script>
    // Fungsi untuk membuat slug otomatis dari judul
    document.getElementById("judul").addEventListener("keyup", function() {
        let judul = this.value;
        let slug = judul.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, "") // Hapus karakter non-alfanumerik kecuali spasi dan strip
            .trim() // Hapus spasi di awal/akhir
            .replace(/\s+/g, "-") // Ganti spasi dengan strip
            .replace(/-+/g, "-"); // Ganti beberapa strip dengan satu strip
        document.getElementById("slug").value = slug;
    });

    // Fungsi untuk pratinjau gambar
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>