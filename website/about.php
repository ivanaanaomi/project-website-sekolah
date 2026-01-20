<?php

require_once "config.php";

$title = "About - UPTD SMPN 14 Pematangsiantar";
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

$querySekolah = mysqli_query($koneksi, "SELECT * FROM tbl_sekolah LIMIT 1");
$dataSekolah  = mysqli_fetch_assoc($querySekolah);

?>


<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>About Us<br></h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="<?= $main_url ?>index.php">Home</a></li>
                    <li class="current">About Us<br></li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- About Us Section -->
    <section id="about-us" class="section about-us">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                    <img src="http://localhost/sekolah/asset/image/<?= $dataSekolah['gambar'] ?>" class="img-fluid" alt="" style="width: 100%;">
                </div>

                <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
                    <h3><?= $dataSekolah['nama'] ?></h3>
                    <p class="fst-italic"><?= $dataSekolah['alamat'] ?></p>
                    <ul>
                        <li><i class="bi bi-caret-right-fill"></i> <span><strong>NPSN:</strong> <?= $dataSekolah['npsn'] ?></span></li>
                        <li><i class="bi bi-caret-right-fill"></i> <span><strong>Akreditasi:</strong> <?= $dataSekolah['akreditasi'] ?></span></li>
                        <li><i class="bi bi-caret-right-fill"></i> <span><strong>Kurikulum:</strong>
                                <?php
                                $kurikulumArr = explode(",", $dataSekolah['kurikulum']);
                                $jml = count($kurikulumArr);

                                if ($jml > 1) {
                                    $tampil = implode(", ", array_slice($kurikulumArr, 0, -1));
                                    $tampil .= " dan " . end($kurikulumArr);
                                } else {
                                    $tampil = $kurikulumArr[0];
                                }

                                echo $tampil;
                                ?>
                            </span></li>
                        <li><i class="bi bi-caret-right-fill"></i> <span><strong>Visi:</strong> <?= $dataSekolah['visi'] ?></span></li>
                        <li><i class="bi bi-caret-right-fill"></i>
                            <span><strong style="margin-right: 6px;">Misi:</strong>
                                <ul>
                                    <?php
                                    $misiList = explode("\n", $dataSekolah['misi']);
                                    foreach ($misiList as $misi) {
                                        echo "<li>" . htmlspecialchars(trim($misi)) . "</li>";
                                    }
                                    ?>
                                </ul>
                            </span>
                        </li>
                    </ul>
                </div>

            </div>

        </div>

    </section><!-- /About Us Section -->

    <!-- Counts Section -->
    <section id="counts" class="section counts">

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


</main>

<?php

require_once "template/footer.php";

?>