<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Update Data Siswa";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$id = $_GET["id"];

$siswa = mysqli_query($koneksi, "SELECT * FROM tbl_siswa WHERE id = '$id'");
$data = mysqli_fetch_array($siswa);

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Update Siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="siswa.php">Siswa</a></li>
                <li class="breadcrumb-item active">Update Siswa</li>
            </ol>

            <form action="proses-siswa.php" method="POST"
                enctype="multipart/form-data">

                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-pen-to-square me-1">
                            </i> Update Siswa</span>
                        <button type="submit" name="update" class="btn btn-primary 
                    float-end me-1"><i class="fa-solid fa-floppy-disk">
                            </i> Update</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0
                                    border-bottom ps-2" id="nis" name="nis"
                                            value="<?= $data['nis'] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-2 
                                col-form-label">Nama</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0
                                    border-bottom ps-2" id="nama" name="nama"
                                            value="<?= $data['nama'] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nisn" class="col-sm-2 
                                col-form-label">NISN</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="text" class="form-control border-0
                                    border-bottom ps-2" id="nisn" name="nisn"
                                            value="<?= $data['nisn'] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="tgl_lahir" class="col-sm-2 
                                col-form-label">Tanggal Lahir</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="date" class="form-control" id="tgl_lahir"
                                            name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="agama" class="col-sm-2 
                                col-form-label">Agama</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <select name="agama" id="agama" class="form-select 
                                    border-0 border-bottom" required>
                                            <?php
                                            $agama = ["Islam", "Protestan", "Katolik", "Buddha", "Hindu", "Khonghucu"];
                                            foreach ($agama as $reli) {
                                                if ($data["agama"] == $reli) { ?>
                                                    <option value="<?= $reli; ?>"
                                                        selected><?= $reli; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $reli; ?>">
                                                        <?= $reli; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
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
                                            <?php
                                            $jenis_kelamin = ["Laki-laki", "Perempuan"];
                                            foreach ($jenis_kelamin as $jk) {
                                                if ($data["jenis_kelamin"] == $jk) { ?>
                                                    <option value="<?= $jk; ?>"
                                                        selected><?= $jk; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $jk; ?>">
                                                        <?= $jk; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="kelas" class="col-sm-2 
                                col-form-label">Kelas</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <select name="kelas" id="kelas" class="form-select 
                                    border-0 border-bottom" required>
                                            <?php
                                            $kelas = ["VII", "VIII", "IX"];
                                            foreach ($kelas as $kls) {
                                                if ($data["kelas"] == $kls) { ?>
                                                    <option value="<?= $kls; ?>"
                                                        selected><?= $kls; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $kls; ?>">
                                                        <?= $kls; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-2 
                                col-form-label">Alamat</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <textarea name="alamat" id="alamat" cols="30" rows="3"
                                            class="form-control" placeholder="Alamat Siswa"
                                            required><?= $data['alamat'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center px-5">
                                <input type="hidden" name="fotoLama" value="<?= $data['foto'] ?>">
                                <img src="../asset/image/<?= $data['foto'] ?>" alt="Gambar Siswa"
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