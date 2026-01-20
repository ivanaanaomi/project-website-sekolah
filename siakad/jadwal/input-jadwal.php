<?php

session_start();

if (!isset($_SESSION["ssLoginSiakad"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
// require "../module/mode-user.php";

$title = "Input Jadwal";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_POST['simpan'])) {
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $mapel = $_POST['mapel'];
    $guru = $_POST['guru'];
    $kelas = $_POST['kelas'];

    $sql = "INSERT INTO tbl_jadwal (hari, jam_mulai, jam_selesai, mapel, guru, kelas)
    VALUES ('$hari','$jam_mulai','$jam_selesai','$mapel','$guru','$kelas')";
    mysqli_query($koneksi, $sql);

    echo "<script>window.location='input-jadwal.php?msg=sukses'</script>";
    exit;
}

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <?php if (isset($_GET['msg']) && $_GET['msg'] == 'sukses'): ?>
                <div class="alert alert-success">Jadwal berhasil disimpan!</div>
            <?php endif; ?>

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Input Jadwal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="jadwal.php">Jadwal</a></li>
                        <li class="breadcrumb-item active">Input Jadwal</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="" method="post">
                    <div class="card-header">
                        <h3 class="card-title"><strong><i class="fas fa-plus-square fa-sm mr-1"></i> Tambah Jadwal</strong></h3>
                        <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right"><i class="fas fa-save fa-sm mr-1"></i> Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times fa-sm mr-1"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label for="hari">Hari</label>
                                    <select name="hari" id="hari" class="form-control" required>
                                        <option value="">--Masukkan Hari--</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jam_mulai">Jam Mulai</label>
                                    <input type="time" name="jam_mulai" value="<?= formatJam($data['jam_mulai']) ?>" class=" form-control" id="jam_mulai" required>
                                </div>
                                <div class="form-group">
                                    <label for="jam_selesai">Jam Selesai</label>
                                    <input type="time" name="jam_selesai" value="<?= formatJam($data['jam_selesai']) ?>" class=" form-control" id="jam_selesai" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label for="mapel">Mata Pelajaran</label>
                                    <select name="mapel" id="mapel" class="form-control" required>
                                        <option value="">--Pilih Pelajaran--</option>
                                        <option value="2">Seni</option>
                                        <option value="6">Bahasa Inggris</option>
                                        <option value="13">Sejarah</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="guru">Guru</label>
                                    <select name="guru" id="guru" class="form-control" required>
                                        <option value="">--Pilih Guru--</option>
                                        <?php
                                        $qGuru = mysqli_query($koneksi, "SELECT id, nama FROM tbl_guru");
                                        while ($g = mysqli_fetch_assoc($qGuru)) {
                                            echo "<option value='{$g['id']}'>{$g['nama']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select name="kelas" id="kelas" class="form-control" required>
                                        <option value="">--Pilih Kelas--</option>
                                        <option value="1">VII</option>
                                        <option value="2">VIII</option>
                                        <option value="3">IX</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </section>

    <?php

    require "../template/footer.php";

    ?>