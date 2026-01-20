<?php
require_once "../config.php";


if (!isset($_GET['id'])) {
    header("Location: ekstrakurikuler.php");
    exit;
}

$id = (int) $_GET['id'];

// ambil data ekskul
$qEkskul = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul WHERE id_ekskul=$id");
$data = mysqli_fetch_assoc($qEkskul);

if (!$data) {
    header("Location: ekstrakurikuler.php");
    exit;
}


$title = $data['nama_ekskul']; // Supaya title di header.php sesuai
require_once "../template/header.php";
require_once "../template/navbar.php";

$qFoto = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul_foto WHERE id_ekskul=$id");

?>

<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-8">
                        <h1>UPTD SMPN 14 Pematangsiantar</h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="<?= $main_url ?>index.php">Home</a></li>
                    <li><a href="eksktrakurikuler.php">Daftar Ekskul</a></li>
                    <li class="current">Ekstrakurikuler</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- ======= Detail Ekskul Section ======= -->
    <section class="section">
        <div class="container col-8" data-aos="fade-up">

            <h2 class="mb-3 text-center"><?= $data['nama_ekskul'] ?></h2>

            <p class="text-muted mb-4 text-center">
                <em><?= date('l, d F Y', strtotime($data['created_at'])) ?></em>
            </p>

            <div class="row">
                <!-- Container 1: Keterangan -->
                <div class="col-12 mb-5">
                    <div class="p-4 shadow-sm rounded bg-white">
                        <?php if (!empty($data['pembina_putra']) || !empty($data['pembina_putri']) || !empty($data['pelatih'])) { ?>
                            <h5 class="mt-4">Pembina / Pelatih</h5>
                            <ul>
                                <?php if (!empty($data['pembina_putra'])) { ?>
                                    <strong>Pembina Putra:</strong> <?= $data['pembina_putra'] ?>
                                <?php } ?>
                                <?php if (!empty($data['pembina_putri'])) { ?>
                                    <strong>Pembina Putri:</strong> <?= $data['pembina_putri'] ?>
                                <?php } ?>
                                <?php if (!empty($data['pelatih'])) { ?>
                                    <strong>Pelatih:</strong> <?= $data['pelatih'] ?>
                                <?php } ?>
                            </ul>
                        <?php } ?>

                        <p><?= nl2br($data['keterangan']) ?></p>

                    </div>
                </div>

                <!-- Container 2: Galeri -->
                <div class="col-12">
                    <div class="p-4 shadow-sm rounded bg-white">
                        <h4 class="mb-4"><strong>Galeri Kegiatan</strong></h4>
                        <div class="row g-3">
                            <?php while ($foto = mysqli_fetch_assoc($qFoto)) { ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="card shadow-sm border-0">
                                        <img src="http://localhost/sekolah/asset/image/<?= $foto['nama_file'] ?>"
                                            class="card-img-top rounded-3"
                                            alt="<?= $data['nama_ekskul'] ?>"
                                            style="height:200px; object-fit:cover;">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End Detail Ekskul Section -->

</main>

<?php require_once "../template/footer.php"; ?>