<?php
session_start();

if (!isset($_SESSION["ssLoginSiakad"]) || $_SESSION['ssRoleSiakad'] != 3) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php"; // Pastikan file ini berisi function ambilDataUjianSiswa($nis)

// MODIFIKASI KUNCI: Ambil NIS dari session yang benar
$nisSiswa = $_SESSION['ssUserSiakad'];

// Panggil fungsi untuk mengambil data ujian HANYA untuk siswa ini
$dataUjian = dataSiswa($nisSiswa);


$title = "Hasil Ujian";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Hasil Ujian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Hasil Ujian</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong><i class="fas fa-list fa-sm mr-1"></i> Nilai</strong></h3>
                    <div class="card-tools">
                        <!-- Tombol cetak langsung, hanya muncul jika data ada -->
                        <?php if (!empty($dataUjian)) : ?>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalCetak">
                                <strong><i class="fas fa-print mr-1"></i> Cetak Hasil Ujian</strong>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap" id="tblData">
                        <thead class="thead-light">
                            <tr>
                                <th>
                                    <center>No Ujian</center>
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
                                    <td colspan="9" align="center">Anda belum memiliki data ujian.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Skrip untuk mencetak PDF -->
    <div class="modal fade" id="modalCetak" tabindex="-1" aria-labelledby="modalCetakLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCetakLabel">Pilih No Ujian untuk Dicetak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="noUjianSelect">Nomor Ujian</label>
                        <select name="noUjian" id="noUjianSelect" class="form-control">
                            <option value="">-- Silakan Pilih --</option>
                            <?php
                            // Loop lagi untuk mengisi pilihan dropdown
                            foreach ($dataUjian as $ujian) {
                                echo '<option value="' . $ujian['no_ujian'] . '">' . $ujian['no_ujian'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="previewPDF()">Cetak</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewPDF() {
            var select = document.getElementById('noUjianSelect');
            var noUjian = select.value;

            if (noUjian && noUjian !== '') {
                window.open("../report/r-nilai-ujian.php?noUjian=" + noUjian, "_blank");
                $('#modalCetak').modal('hide');
            } else {
                alert('Silahkan pilih nomor ujian terlebih dahulu');
            }
        }
    </script>

    <?php
    require "../template/footer.php";
    ?>