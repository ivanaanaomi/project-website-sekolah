<?php

require_once "config.php";

$title = "GTK - UPTD SMPN 14 Pematangsiantar";
require_once "template/header.php";
require_once "template/navbar.php";

?>

<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Guru dan Tenaga Kependidikan</h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li class="current">Trainers</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->


    <section id="trainers" class="section trainers">

        <div class="container">

            <div class="row gy-5">

                <?php

                $queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru ORDER BY id ASC");

                while ($guru = mysqli_fetch_assoc($queryGuru)) {
                ?>

                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="http://localhost/sekolah/asset/image/<?= $guru['foto'] ?>" class="mb-3"
                                style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; display: block; margin: 0 auto; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"
                                alt="Foto <?= $guru['nama'] ?>">
                            <div class="social">
                                <a href="<?= $guru['kontak'] ?>"><i class="bi bi-messenger"></i></a>
                            </div>
                        </div>
                        <div class="member-info text-center">
                            <h4><?= $guru['nama'] ?></h4>
                            <span class="d-block mb-0"><?= $guru['nip'] ?></span>
                            <p class="d-block mb-3"><?= $guru['jabatan'] ?></p>
                        </div>
                    </div><!-- End Team Member -->
                <?php } ?>

            </div>
        </div>
    </section>

    <?php

    require_once "template/footer.php";

    ?>