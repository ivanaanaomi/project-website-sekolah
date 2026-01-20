<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="sindex.html" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename" style="font-size: 24px;">UPTD SMPN 14 Pematangsiantar</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="<?= $main_url ?>index.php"
                        class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Home</a></li>
                <li><a href="<?= $main_url ?>about.php"
                        class="<?= ($current_page == 'about.php') ? 'active' : '' ?>">About</a></li>
                <li><a href="<?= $main_url ?>guru.php"
                        class="<?= ($current_page == 'guru.php') ? 'active' : '' ?>">GTK</a></li>
                <li><a href="<?= $main_url ?>berita/berita.php"
                        class="<?php
                                $is_berita_active = ($current_page == 'berita/berita.php');
                                echo $is_berita_active ? 'active' : '';
                                echo " DEBUG_NAV_BERITA: " . ($is_berita_active ? 'TRUE' : 'FALSE');
                                echo " C_PAGE_VAL: '" . htmlspecialchars($current_page) . "'"; // Tambahkan ini
                                ?>">Berita</a></li>
                <li class="dropdown"><a href="<?= $main_url ?>ekskul/ekstrakurikuler.php"
                        class="<?= ($current_page == 'ekskul/ekstrakurikuler.php' ||
                                    strpos($current_page, 'ekskul/') === 0) ? 'active' : '' ?>">
                        <span>Ekstrakurikuler</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="<?= $main_url ?>ekskul/detail-ekskul.php?id=1"
                                class="<?= ($current_page == 'ekskul/detail-ekskul.php'
                                            && isset($_GET['id']) && $_GET['id'] == 1) ? 'active' : '' ?>">Pramuka</a></li>
                        <li><a href="<?= $main_url ?>ekskul/detail-ekskul.php?id=3"
                                class="<?= ($current_page == 'ekskul/detail-ekskul.php'
                                            && isset($_GET['id']) && $_GET['id'] == 3) ? 'active' : '' ?>">Seni Tari</a></li>
                    </ul>
                </li>
                <li><a href="http://localhost/siakad/" class="<?= ($current_page == 'http://localhost/siakad/') ? 'active' : '' ?>">SIAKAD</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="http://localhost/sekolah/">Login</a>

    </div>
</header>