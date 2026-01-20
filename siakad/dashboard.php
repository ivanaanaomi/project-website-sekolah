<?php

session_start();

if (!isset($_SESSION["ssLoginSiakad"])) {
  header("location: auth/login.php");
  exit();
}

require "config/config.php";
require "config/function.php";

$title = "Dashboard - UPTD SMPN 14";
require "template/header.php";
require "template/navbar.php";
require "template/sidebar.php";


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner" style="padding-top: 35px;">
              <h3 class="mb-4">Jadwal</h3>

              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-calendar"></i>
            </div>
            <a href="<?= $main_url ?>jadwal/jadwal.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <?php

        if (userRole() != 1) {
        ?>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 style="font-size: 34px;">Hasil<br>Ujian</h3>
              </div>
              <div class="icon">
                <i class="ion ion-ios-printer"></i>
              </div>
              <a href="<?= $main_url ?>ujian/hasil-ujian.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php } ?>

        <?php

        if (userRole() == 1) {
        ?>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner" style="padding-top: 35px;">
                <h3 class="mb-4">Siswa</h3>
              </div>
              <div class="icon">
                <i class="ion ion-university"></i>
              </div>
              <a href="<?= $main_url ?>siswa/data-siswa.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner" style="padding-top: 35px;">
                <h3 class="mb-4">Guru</h3>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              <a href="<?= $main_url ?>guru/data-guru.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner" style="padding-top: 35px;">
                <h3 class="mb-4">Pelajaran</h3>
              </div>
              <div class="icon">
                <i class="ion ion-ios-book"></i>
              </div>
              <a href="<?= $main_url ?>pelajaran/pelajaran.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>

          <?php } ?>

          </div>
          <!-- ./col -->
      </div>
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->

  <?php

  require "template/footer.php";

  ?>