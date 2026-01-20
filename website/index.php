<?php

require_once "config.php";

$title = "UPTD SMPN 14 Pematangsiantar";
require_once "template/header.php";
require_once "template/navbar.php";

$querySiswa = mysqli_query($koneksi, "SELECT * FROM tbl_siswa");
$jmlSiswa   = mysqli_num_rows($querySiswa);

$queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru");
$jmlGuru   = mysqli_num_rows($queryGuru);

$queryEkskul = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul");
$jmlEkskul   = mysqli_num_rows($queryEkskul);

$queryBerita = mysqli_query($koneksi, "SELECT * FROM tbl_berita");
$jmlBerita   = mysqli_num_rows($queryBerita);

$footer = mysqli_query($koneksi, "SELECT * FROM tbl_footer WHERE id=1");
$data = mysqli_fetch_assoc($footer);

$querySekolah = mysqli_query($koneksi, "SELECT * FROM tbl_sekolah LIMIT 1");
$dataSekolah  = mysqli_fetch_assoc($querySekolah);

?>

<!DOCTYPE html>
<html lang="en">



<body class="index-page">

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <img src="http://localhost/sekolah/asset/image/<?= $data['foto'] ?>" alt="" data-aos="fade-in">

            <div class="container">
                <h2 data-aos="fade-up" data-aos-delay="100">Belajar hari ini,<br>berprestasi esok hari</h2>
                <p data-aos="fade-up" data-aos-delay="200">Setiap langkah kecil dalam belajar akan membuka jalan<br>menuju masa depan yang lebih cerah</p>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                        <img src="http://localhost/sekolah/asset/image/<?= $dataSekolah['gambar'] ?>" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
                        <h3><?= $dataSekolah['ucapan'] ?></h3>
                        <p class="fst-italic">
                            <?= $dataSekolah['visi'] ?>
                        </p>
                        <span class="d-block mb-3" style="text-align: justify;"><?= $dataSekolah['sambutan'] ?></span>
                        <a href="<?= $main_url ?>about.php" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                    </div>

                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Counts Section -->
        <section id="counts" class="section counts light-background">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="<?= $jmlSiswa ?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Siswa</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="<?= $jmlGuru ?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Guru</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="<?= $jmlBerita ?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Berita</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="<?= $jmlEkskul ?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Ekstrakurikuler</p>
                        </div>
                    </div><!-- End Stats Item -->

                </div>

            </div>

        </section><!-- /Counts Section -->

        <!-- Berita Section -->
        <section id="why-us" class="section why-us" data-aos="fade-up" data-aos-delay="100">
            <div class="container section-title">
                <h2>Berita</h2>
                <p>Informasi & Kegiatan Terbaru</p>
            </div>
            <div class="container">
                <div class="row">
                    <?php
                    $berita = mysqli_query($koneksi, "SELECT * FROM tbl_berita ORDER BY id_berita DESC LIMIT 3");
                    $delay = 100; // nilai awal delay
                    while ($b = mysqli_fetch_assoc($berita)) { ?>
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                            <div class="card">
                                <img src="http://localhost/sekolah/asset/image/<?= $b['gambar'] ?>" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title text-center"><strong><?= $b['judul'] ?></strong></h5>
                                    <p class="card-text" style="text-align: justify;"><?= substr($b['isi'], 0, 100) ?>...</p>
                                    <div class="text-right">
                                        <a href="berita/detail-berita.php?id=<?= $b['id_berita'] ?>" class="more-btn">
                                            <span>Baca Selengkapnya</span> <i class="bi bi-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        $delay += 100; // tambahkan delay setiap loop
                    } ?>
                </div>
            </div>
        </section>

        <!-- GTK Section -->
        <section id="gtk" class="section gtk">
            <div class="container section-title">
                <h2>GTK</h2>
                <p>Guru & Tenaga Kependidikan</p>
            </div>
            <div class="container">
                <div class="row">
                    <?php
                    $guru = mysqli_query($koneksi, "SELECT * FROM tbl_guru LIMIT 6");
                    $delay = 100; // nilai awal delay
                    while ($g = mysqli_fetch_assoc($guru)) { ?>
                        <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                            <div class="member">
                                <img src="http://localhost/sekolah/asset/image/<?= $g['foto'] ?>" class="gtk-img" alt="">
                                <div class="member-content text-center">
                                    <h4 class="d-block mt-2 mb-0"><?= $g['nama'] ?></h4>
                                    <span class="d-block mb-3"><?= $g['jabatan'] ?></span>
                                </div>
                            </div>
                        </div><!-- End Team Member -->
                    <?php
                        $delay += 100; // tambahkan delay tiap guru
                    } ?>
                </div>
            </div>
        </section><!-- /GTK Section -->


        <!-- Courses Section -->
        <section id="courses" class="courses section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Ekstrakurikuler</h2>
                <p>Daftar Ekstrakurikuler</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row">
                    <?php
                    $ekskul = mysqli_query($koneksi, "
                SELECT e.id_ekskul, e.nama_ekskul, e.keterangan, f.nama_file 
                FROM tbl_ekskul e
                LEFT JOIN (
                    SELECT id_ekskul, MIN(id_foto) AS id_foto
                    FROM tbl_ekskul_foto
                    GROUP BY id_ekskul
                ) ff ON e.id_ekskul = ff.id_ekskul
                LEFT JOIN tbl_ekskul_foto f ON ff.id_foto = f.id_foto
            ");
                    $delay = 100;
                    while ($e = mysqli_fetch_assoc($ekskul)) { ?>
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                            <div class="card">
                                <?php if (!empty($e['nama_file'])) { ?>
                                    <img src="http://localhost/sekolah/asset/image/<?= $e['nama_file'] ?>" class="card-img-top" alt="">
                                <?php } else { ?>
                                    <img src="<?= $main_url ?>asset/image/image.png" class="card-img-top" alt="">
                                <?php } ?>
                                <div class="card-body">
                                    <h5 class="card-title text-center"><strong><?= $e['nama_ekskul'] ?></strong></h5>
                                    <p class="card-text" style="text-align: justify;"><?= substr($e['keterangan'], 0, 200) ?>...</p>
                                    <div class="text-right">
                                        <a href="ekskul/detail-ekskul.php?id=<?= $e['id_ekskul'] ?>" class="more-btn">
                                            <span>Baca Selengkapnya</span> <i class="bi bi-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        $delay += 100;
                    } ?>
                </div>
            </div>
        </section><!-- /Courses Section -->

    </main>

    <?php

    require_once "template/footer.php";

    ?>