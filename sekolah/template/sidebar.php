<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion bg-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Home</div>
                    <a class="nav-link" href="<?= $main_url ?>index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <hr class="mb-0">
                    <div class="sb-sidenav-menu-heading">Admin</div>
                    <a class="nav-link" href="<?= $main_url ?>user/add-user.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        User
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>user/password.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-key"></i></div>
                        Ganti Password
                    </a>
                    <hr class="mb-0">
                    <div class="sb-sidenav-menu-heading">Data</div>
                    <a class="nav-link" href="<?= $main_url ?>siswa/siswa.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                        Siswa
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>guru/guru.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                        Guru
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>pelajaran/pelajaran.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                        Mata Pelajaran
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>ujian/ujian.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user-graduate"></i></div>
                        Ujian
                    </a>
                    <hr class="mb-0">
                    <div class="sb-sidenav-menu-heading">Isi</div>
                    <a class="nav-link" href="<?= $main_url ?>footer/input-footer.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-caret-right"></i></div>
                        Footer
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>berita/berita.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-caret-right"></i></div>
                        Berita dan Agenda
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>ekskul/ekstrakurikuler.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-caret-right"></i></div>
                        Ekstrakurikuler
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer border text-capitalize">
                <div class="small tex">Logged in as:</div>
                <?= $_SESSION["ssUser"] ?>
            </div>
        </nav>
    </div>