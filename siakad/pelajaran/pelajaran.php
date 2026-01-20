<?php

session_start();

if (!isset($_SESSION["ssLoginSiakad"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
// require "../module/mode-user.php";

$title = "Data Siswa";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pelajaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Pelajaran</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong><i class="fas fa-list fa-sm mr-1"></i> Data Pelajaran</strong></h3>
                    <div class="card-tools">
                        <a href="http://localhost/sekolah/pelajaran/pelajaran.php" class="btn btn-sm btn-primary"><strong><i class="fas fa-plus fa-sm mr-1"></i> Tambah Data</strong></a>
                    </div>
                </div>
                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap" id="tblData">
                        <thead>
                            <tr>
                                <th>
                                    <center>No.</center>
                                </th>
                                <th>
                                    <center>Mata Pelajaran</center>
                                </th>
                                <th>
                                    <center>Guru</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $no = 1;
                            $mapel = getData("SELECT pelajaran, guru FROM tbl_pelajaran");
                            foreach ($mapel as $DataMapel) :
                            ?>
                                <tr>
                                    <td>
                                        <center><?= $no++ ?>.</center>
                                    </td>
                                    <td>
                                        <?= $DataMapel['pelajaran'] ?>
                                    </td>
                                    <td>
                                        <?= $DataMapel['guru'] ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php

    require "../template/footer.php";

    ?>