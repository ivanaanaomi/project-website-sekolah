<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Update Ekskul - SMPN 14 Pematangsiantar";
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

if (isset($_GET["id_ekskul"])) {
    $id_ekskul = (int) $_GET["id_ekskul"];

    $queryEkskul = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul WHERE id_ekskul = $id_ekskul");

    if ($queryEkskul && mysqli_num_rows($queryEkskul) > 0) {
        $data = mysqli_fetch_array($queryEkskul);
    } else {
        die("Data ekskul tidak ditemukan.");
    }

    $fotoQ = mysqli_query($koneksi, "SELECT nama_file FROM tbl_ekskul_foto WHERE id_ekskul=$id_ekskul LIMIT 1");
    $foto = ($fotoQ && mysqli_num_rows($fotoQ) > 0) ? mysqli_fetch_assoc($fotoQ) : null;
} else {
    die("Parameter id_ekskul tidak ada di URL.");
}


?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Ekstrakurikuler Sekolah</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="ekstrakurikuler.php">Ekstrakurikuler</a></li>
                <li class="breadcrumb-item active">Edit Ekskul</li>
            </ol>

            <form action="proses-ekskul.php" method="POST" enctype="multipart/form-data">
                <?php
                if ($msg != '') {
                    echo $alert;
                }
                ?>

                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-square-plus"></i>
                            Edit Ekskul</span>
                        <button type="submit" name="update"
                            class="btn btn-primary float-end me-1"> <i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <input type="hidden" name="id_ekskul" id="id_ekskul" value="<?= $data['id_ekskul'] ?>">
                                <div class="mb-3 row">
                                    <label for="nama_ekskul" class="col-sm-2 col-form-label">Nama</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0 border-bottom ps-2"
                                            id="nama_ekskul" name="nama_ekskul" placeholder="Nama Ekstrakurikuler"
                                            value="<?= $data['nama_ekskul'] ?>" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <textarea name="keterangan" id="keterangan" cols="30" rows="5"
                                            class="form-control" placeholder="Tulis Keterangan..." required><?= $data['keterangan'] ?></textarea>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="pembina_putra" class="col-sm-2 col-form-label">Pembina Putra</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0 border-bottom ps-2"
                                            id="pembina_putra" name="pembina_putra" placeholder="Opsional" value="<?= $data['pembina_putra'] ?>">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="pembina_putri" class="col-sm-2 col-form-label">Pembina Putri</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0 border-bottom ps-2"
                                            id="pembina_putri" name="pembina_putri" placeholder="Opsional" value="<?= $data['pembina_putri'] ?>">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="pelatih" class="col-sm-2 col-form-label">Pelatih</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0 border-bottom ps-2"
                                            id="pelatih" name="pelatih" placeholder="Opsional" value="<?= $data['pelatih'] ?>">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="hari" class="col-sm-2 col-form-label">Jadwal Kegiatan</label>
                                    <label class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0 border-bottom ps-2"
                                            id="hari" name="hari" placeholder="Masukkan jadwal kegiatan" value="<?= $data['hari'] ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4 text-center px-5">
                                <img src="../asset/image/default.png" alt="Dokumentasi Ekskul" class="img-thumbnail mb-3"
                                    id="preview" style="width: 100%; max-width: 250px; height: auto; object-fit: cover;">
                                <input type="file" name="image[]" multiple accept="image/*"
                                    class="form-control form-control-sm" onchange="previewImage(this)">
                                <small class="text-secondary">Pilih foto PNG, JPG atau JPEG max 1MB <br></small>
                                <small class="text-secondary">Foto dokumentasi bisa lebih dari 1 foto</small>
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