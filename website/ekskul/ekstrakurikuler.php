<?php

require_once "../config.php";

$title = "Ekstrakurikuler - UPTD SMPN 14 Pematangsiantar";
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
                        <h1>Daftar Ekstrakurikuler</h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="<?= $main_url ?>index.php">Home</a></li>
                    <li class="current">Ekstrakurikuler</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <section id="events" class="events section">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <?php
                // ambil berita terbaru, misalnya 4 berita terakhir
                $queryEkskul = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul");
                while ($data = mysqli_fetch_assoc($queryEkskul)) {
                    $id_ekskul = $data['id_ekskul']; // <-- ambil id dari looping utama

                    $fotoQ = mysqli_query($koneksi, "SELECT nama_file FROM tbl_ekskul_foto WHERE id_ekskul=$id_ekskul LIMIT 1");
                    $dataFoto = mysqli_fetch_assoc($fotoQ);
                ?>
                    <div class="col-md-6 d-flex align-items-stretch mb-4">
                        <div class="card">
                            <div class="card-img">
                                <img src="http://localhost/sekolah/asset/image/<?= $dataFoto['nama_file'] ?>"
                                    alt="<?= $data['nama_ekskul'] ?>"
                                    style="width:100%; height:250px; object-fit:cover;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="detail-ekskul.php?id=<?= $data['id_ekskul'] ?>">
                                        <?= $data['nama_ekskul'] ?>
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <?= substr(strip_tags($data['keterangan']), 0, 150) ?>...
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