<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";

$title = "Profile Sekolah - SMPN 14";
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
    Data sekolah gagal diperbaharui.
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
if ($msg == 'updated') {
    $alert = '<div class="alert alert-success alert-dismissible 
    fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> 
    Data sekolah berhasil diperbaharui.
    <button type="button" class="btn-close" data-bs-dismiss="alert" 
    aria-label="Close"></button>
    </div>';
}

$sekolah = mysqli_query($koneksi, "SELECT * FROM tbl_sekolah WHERE id = 1");
$data = mysqli_fetch_array($sekolah);

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Sekolah</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Profile Sekolah</li>
            </ol>

            <form action="proses-sekolah.php" method="POST" enctype="multipart/form-data">
                <?php
                if ($msg != '') {
                    echo $alert;
                }
                ?>

                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-pen-to-square"></i>
                            Data Sekolah</span>
                        <button type="submit" name="simpan" class="btn btn-primary 
                    float-end"><i class="fa-solid fa-floppy-disk"></i>
                            Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger 
                    float-end me-1"><i class="fa-solid fa-xmark"></i>
                            Reset</button>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 text-center px-5">
                                <input type="hidden" name="gbrLama" value="<?= $data['gambar'] ?>">
                                <img src="../asset/image/<?= $data['gambar'] ?>" alt="Gambar Sekolah"
                                    class="mb-3" width="100%">
                                <input type="file" name="image" class="form-control 
                            form-control-sm">
                                <small class="text-secondary">Pilih foto PNG, JPG atau JPEG dengan ukuran maximal 1MB</small>
                            </div>
                            <div class="col-8">
                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-2 
                                col-form-label">Nama</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0
                                    border-bottom" id="nama" name="nama" value="<?= $data['nama'] ?>"
                                            placeholder="Nama Sekolah" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="npsn" class="col-sm-2 
                                col-form-label">NPSN</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0
                                    border-bottom" id="npsn" name="npsn" value="<?= $data['npsn'] ?>"
                                            placeholder="NPSN Sekolah" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-2 
                                col-form-label">Email</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0
                                    border-bottom" id="email" name="email" value="<?= $data['email'] ?>"
                                            placeholder="Email Sekolah" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="status" class="col-sm-2
                                col-form-label">Status</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -35px;">
                                        <input type="text" readonly class="form-control-plaintext border-0"
                                            id="status" value="Negeri">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="akreditasi" class="col-sm-2 
                                col-form-label">Akreditasi</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <select name="akreditasi" id="akreditasi"
                                            class="form-select border-0 border-bottom" required>
                                            <!-- <option value="" selected>--Pilih Akreditasi--</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option> -->
                                            <?php

                                            $akreditasi = ['A', 'B', 'C', 'D'];
                                            foreach ($akreditasi as $akre) {
                                                if ($data['akreditasi'] == $akre) { ?>
                                                    <option value="<?= $akre ?>"
                                                        selected><?= $akre ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $akre ?>">
                                                        <?= $akre ?></option>
                                            <?php
                                                }
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="akreditasi" class="col-sm-2 
                                col-form-label">Akreditasi</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <?php

                                        $kurikulum = ['KTSP 2006', 'Kurikulum 2013', 'Kurikulum Merdeka'];
                                        $kurikulumDb = isset($data['kurikulum']) ? explode(",", $data['kurikulum']) : [];
                                        foreach ($kurikulum as $kur) {
                                            $checked = in_array($kur, $kurikulumDb) ? 'checked' : '';
                                            echo '<label style="margin-right:15px;">
                    <input type="checkbox" name="kurikulum[]" value="' . $kur . '" ' . $checked . '> ' . $kur . '
                  </label>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-2 
                                col-form-label">Alamat</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <textarea name="alamat" id="alamat" cols="30"
                                            rows="3" class="form-control"
                                            placeholder="Alamat Sekolah" required><?= $data['alamat'] ?></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="visi" class="col-sm-2 
                                col-form-label">Visi</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <textarea name="visi" id="visi" cols="30"
                                            rows="3" class="form-control"
                                            placeholder="Visi Sekolah" required><?= $data['visi'] ?></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="misi" class="col-sm-2 
                                col-form-label">Misi</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <textarea name="misi" id="misi" cols="30"
                                            rows="3" class="form-control"
                                            placeholder="Misi Sekolah" required><?= $data['misi'] ?></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="sambutan" class="col-sm-2 
                                col-form-label">Sambutan</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <textarea name="sambutan" id="sambutan" cols="30"
                                            rows="3" class="form-control"
                                            placeholder="sambutan kepsek/sejarah singkat" required><?= $data['sambutan'] ?></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="ucapan" class="col-sm-2 
                                col-form-label">Ucapan</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <textarea name="ucapan" id="ucapan" cols="30"
                                            rows="3" class="form-control"
                                            placeholder="Ucapan Selamat Datang" required><?= $data['ucapan'] ?></textarea>
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