<?php
require_once "../config.php";

if (!isset($_GET['slug']) || empty($_GET['slug'])) {
    header("Location: berita.php");
    exit;
}

$slug = mysqli_real_escape_string($koneksi, $_GET['slug']);
$query = mysqli_query($koneksi, "SELECT * FROM tbl_berita WHERE slug = '$slug'");
$data  = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: berita.php");
    exit;
}

$title = $data['judul']; // Supaya title di header.php sesuai
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
                        <h1>UPTD SMPN 14 Pematangsiantar</h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="<?= $main_url ?>index.php">Home</a></li>
                    <li><a href="berita.php">Daftar Berita</a></li>
                    <li class="current">Berita</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- ======= Detail Berita Section ======= -->
    <section class="section">
        <div class="container col-8" data-aos="fade-up">

            <h2 class="mb-3 text-center"><?= $data['judul'] ?></h2>

            <p class="text-muted mb-4 text-center">
                <em><?= date('l, d F Y', strtotime($data['tanggal'])) ?> | <?= $data['penulis'] ?> | <?= $data['kategori'] ?></em>
            </p>

            <img src="http://localhost/sekolah/asset/image/<?= $data['gambar'] ?: 'default.png' ?>"
                alt="<?= $data['judul'] ?>"
                class="img-fluid rounded mb-4"
                style="max-height:400px; object-fit:cover; width:100%;">

            <div class="content mb-4">
                <?php
                $paragraf = explode("\n", $data['isi']);
                foreach ($paragraf as $p) {
                    if (trim($p) !== "") {
                        echo "<p>$p</p>";
                    }
                }
                ?>
            </div>

        </div>
    </section>
    <!-- End Detail Berita Section -->

</main>

<?php require_once "../template/footer.php"; ?>