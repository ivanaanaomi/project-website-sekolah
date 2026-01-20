        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->


            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <?php $user = userLogin(); ?>
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php
                        $foto = $user['foto'] ?? '';
                        if ($foto) {
                            $src = "http://localhost/sekolah/asset/image/" . $foto;
                        } else {
                            $src = "../asset/image/default.png"; // ganti dengan path foto default
                        }
                        ?>
                        <img src="<?= $src ?>"
                            alt="Foto Profil"
                            style="width:50px; height:50px; object-fit:cover; border-radius:50%;">
                    </div>
                    <div class="info d-flex align-items-center ms-2" style="height:60px;">
                        <a href="#" class="d-block" style="line-height:1;">
                            <?php
                            $user = userLogin();
                            ?>
                            <span><?= !empty($user['nama']) ? htmlspecialchars($user['nama']) : 'User' ?></span>

                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= $main_url ?>dashboard.php" class="nav-link <?= menuHome() ?>">
                                <i class="nav-icon fas fa-tachometer-alt text-sm"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>


                        <?php

                        if (userRole() == 1) {
                        ?>
                            <li class="nav-item <?= menuMaster() ?>">
                                <a href="#" class="nav-link">
                                    <i class=" nav-icon fas fa-folder text-sm"></i>
                                    <p>
                                        Master
                                        <i class="fas fa-angle-right right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= $main_url ?>siswa/data-siswa.php" class="nav-link <?= menuSiswa() ?>">
                                            <i class="far fa-circle nav-icon text-sm"></i>
                                            <p>Siswa</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= $main_url ?>guru/data-guru.php" class="nav-link <?= menuGuru() ?>">
                                            <i class="far fa-circle nav-icon text-sm"></i>
                                            <p>Guru</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= $main_url ?>pelajaran/pelajaran.php" class="nav-link <?= menuPelajaran() ?>">
                                            <i class="far fa-circle nav-icon text-sm"></i>
                                            <p>Pelajaran</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="<?= $main_url ?>jadwal/jadwal.php" class="nav-link <?= menuJadwal() ?>">
                                <i class="nav-icon fas fa-calendar-week text-sm"></i>
                                <p>Jadwal</p>
                            </a>
                        </li>
                        <?php if (userRole() == 2) { ?>
                            <li class="nav-item">
                                <a href="<?= $main_url ?>ujian/ujian.php" class="nav-link <?= menuUjian() ?>">
                                    <i class="nav-icon fas fa-file-invoice nav-icon text-sm"></i>
                                    <p>Ujian</p>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (userRole() == 3) { ?>
                            <li class="nav-item">
                                <a href="<?= $main_url ?>ujian/hasil-ujian.php" class="nav-link <?= menuUjian() ?>">
                                    <i class="nav-icon fas fa-file-invoice text-sm"></i>
                                    <p>Hasil Ujian</p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>