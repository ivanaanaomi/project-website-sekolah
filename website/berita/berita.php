<?php

require_once "../config.php";

$title = "Berita/Agenda - UPTD SMPN 14 Pematangsiantar";
require_once "../template/header.php";
require_once "../template/navbar.php";

?>

<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-8">
                        <h1>Berita dan Agenda</h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="<?= $main_url ?>index.php">Home</a></li>
                    <li class="current">Berita dan Agenda</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <section id="events" class="events section">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <?php
                // ambil berita terbaru, misalnya 4 berita terakhir
                $queryBerita = mysqli_query($koneksi, "SELECT * FROM tbl_berita ORDER BY tanggal DESC LIMIT 4");
                while ($data = mysqli_fetch_assoc($queryBerita)) {
                ?>
                    <div class="col-md-6 d-flex align-items-stretch mb-4">
                        <div class="card">
                            <div class="card-img">
                                <img src="http://localhost/sekolah/asset/image/<?= $data['gambar'] ?: 'default.png' ?>"
                                    alt="<?= $data['judul'] ?>"
                                    style="width:100%; height:250px; object-fit:cover;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="detail-berita.php?slug=<?= $data['slug'] ?>">
                                        <?= $data['judul'] ?>
                                    </a>
                                </h5>
                                <p class="fst-italic text-center">
                                    <?= date('l, d F Y', strtotime($data['tanggal'])) ?> |
                                    <?= $data['penulis'] ?> | <?= $data['kategori'] ?>
                                </p>
                                <p class="card-text">
                                    <?= substr(strip_tags($data['isi']), 0, 150) ?>...
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php

    require_once "../template/footer.php";

    ?>