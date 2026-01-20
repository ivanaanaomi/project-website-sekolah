<?php

require_once __DIR__ . "/../config.php";


$footer = mysqli_query($koneksi, "SELECT * FROM tbl_footer WHERE id=1");
$data = mysqli_fetch_assoc($footer);

?>

<footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="index.html" class="logo d-flex align-items-center">
                    <span class="sitename" style="font-size: 23;">UPTD SMPN 14 Pematangsiantar</span>
                </a>
                <div class="footer-contact pt-3">
                    <p><?= $data['alamat'] ?></p>
                    <p class="mt-3"><strong>Phone:</strong> <span><?= $data['phone'] ?></span></p>
                    <p><strong>Email:</strong> <span><?= $data['email'] ?></span></p>
                </div>
                <div class="social-links d-flex mt-4">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 footer-maps">
                <div class="ratio ratio-16x9" style="margin-left: -50px;">
                    <iframe src="<?= $data['maps']; ?>"
                        width="100%" height="100%" style="border:0;"
                        allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Menu Utama</h4>
                <ul>
                    <li><a href="<?= $main_url ?>index.php">Home</a></li>
                    <li><a href="<?= $main_url ?>about.php">About</a></li>
                    <li><a href="<?= $main_url ?>guru.php">GTK</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Informasi</h4>
                <ul>
                    <li><a href="<?= $main_url ?>berita/berita.php">Berita</a></li>
                    <li><a href="<?= $main_url ?>ekskul/ekstrakurikuler.php">Ekstrakurikuler</a></li>
                    <li><a href="http://localhost/siakad">Siakad</a></li>
            </div>


        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>&copy; <span>Copyright</span> <strong class="px-1 sitename">SMPN 14 Pematangsiantar</strong> <span>All Rights Reserved</span></p>
        <!-- <div class="credits"> -->
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href=“https://themewagon.com>ThemeWagon -->
        <!-- </div> -->
    </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="<?= $main_url ?>asset/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $main_url ?>asset/assets/vendor/php-email-form/validate.js"></script>
<script src="<?= $main_url ?>asset/assets/vendor/aos/aos.js"></script>
<script src="<?= $main_url ?>asset/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= $main_url ?>asset/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="<?= $main_url ?>asset/assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="<?= $main_url ?>asset/assets/js/main.js"></script>

</body>

</html>