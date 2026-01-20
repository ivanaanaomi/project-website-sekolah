<?php
session_start();

if (!isset($_SESSION["ssLoginSiakad"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php"; // berisi function ambilDataUjian()
$dataUjian = ambilDataUjian();


$title = "Data Ujian";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Ujian Siswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Data Ujian</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong><i class="fas fa-list fa-sm mr-1"></i> Data Ujian</strong></h3>
                    <div class="card-tools">
                        <a href="nilai-ujian.php" class="btn btn-sm btn-primary float-right ml-1">
                            <i class="fas fa-plus-square mr-1"></i> <b>Tambah Data</b>
                        </a>
                        <div class="dropdown float-right">
                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                <strong>Cetak</strong>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#mdlCetak">
                                    <strong><i class="fas fa-search mr-1"></i> Nilai Ujian</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap" id="tblData">
                        <thead class="thead-light">
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                <th>
                                    <center>Nama</center>
                                </th>
                                <th>
                                    <center>NIS</center>
                                </th>
                                <th>
                                    <center>NISN</center>
                                </th>
                                <th>
                                    <center>Kelas</center>
                                </th>
                                <th>
                                    <center>Nilai Terendah</center>
                                </th>
                                <th>
                                    <center>Nilai Tertinggi</center>
                                </th>
                                <th>
                                    <center>Nilai Rata-Rata</center>
                                </th>
                                <th>
                                    <center>Hasil Ujian</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($dataUjian)) : ?>
                                <?php foreach ($dataUjian as $row) : ?>
                                    <tr>
                                        <td align="center"><?= $row['no_ujian'] ?></td>
                                        <td align="center"><?= $row['nama'] ?></td>
                                        <td align="center"><?= $row['nis'] ?></td>
                                        <td align="center"><?= $row['nisn'] ?></td>
                                        <td align="center"><?= $row['kelas'] ?></td>
                                        <td align="center"><?= $row['nilai_terendah'] ?></td>
                                        <td align="center"><?= $row['nilai_tertinggi'] ?></td>
                                        <td align="center"><?= $row['nilai_rata2'] ?></td>
                                        <td align="center">
                                            <?php if ($row['hasil_ujian'] == 'LULUS') : ?>
                                                <span class="btn btn-success btn-sm rounded-0 col-10 font-weight-bold text-uppercase">
                                                    <?= $row['hasil_ujian'] ?>
                                                </span>
                                            <?php else : ?>
                                                <span class="btn btn-danger btn-sm rounded-0 col-10 font-weight-bold text-uppercase">
                                                    <?= $row['hasil_ujian'] ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="8" align="center">Tidak ada data ujian</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Cetak -->
    <div class="modal fade" id="mdlCetak" tabindex="-1" role="dialog" aria-labelledby="mdlCetakLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <label class="form-label">Pilih No Peserta Ujian</label>
                    <select name="no" id="no" class="form-control">
                        <option value="">--No Ujian--</option>
                        <?php if (!empty($dataUjian)) : ?>
                            <?php foreach ($dataUjian as $row) : ?>
                                <option value="<?= $row['no_ujian'] ?>">
                                    <?= $row['nama'] . '-' . $row['nis'] . '-' . $row['kelas'] ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="previewPDF()">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewPDF() {
            var noUjian = document.getElementById('no').value;
            if (noUjian !== '') {
                window.open("../report/r-nilai-ujian.php?noUjian=" + noUjian);
            }
        }
    </script>

    <?php

    require "../template/footer.php";

    ?>