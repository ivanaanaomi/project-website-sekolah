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
                    <h1 class="m-0">Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Siswa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong><i class="fas fa-list fa-sm mr-1"></i> Data Siswa</strong></h3>
                    <div class="card-tools">
                        <a href="http://localhost/sekolah/siswa/add-siswa.php" class="btn btn-sm btn-primary"><strong><i class="fas fa-plus fa-sm mr-1"></i> Tambah Data</strong></a>
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
                                    <center>Foto</center>
                                </th>
                                <th>
                                    <center>NIS</center>
                                </th>
                                <th>
                                    <center>NISN</center>
                                </th>
                                <th>
                                    <center>Nama</center>
                                </th>
                                <th>
                                    <center>Tanggal Lahir</center>
                                </th>
                                <th>
                                    <center>Agama</center>
                                </th>
                                <th>
                                    <center>Jenis Kelamin</center>
                                </th>
                                <th>
                                    <center>Kelas</center>
                                </th>
                                <th>
                                    <center>Alamat</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $no = 1;
                            $siswa = getData("SELECT * FROM tbl_siswa");
                            foreach ($siswa as $DataSiswa) :
                            ?>
                                <tr>
                                    <td>
                                        <center><?= $no++ ?>.</center>
                                    </td>
                                    <td><img src="http://localhost/sekolah/asset/image/<?= $DataSiswa['foto'] ?>"
                                            alt="Foto Siswa" class="rounded-circle mb-3" style="width: 65px; 
                                        height: 65px; object-fit: cover;"></td>
                                    <td>
                                        <center><?= $DataSiswa['nis'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $DataSiswa['nisn'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $DataSiswa['nama'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $DataSiswa['tgl_lahir'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $DataSiswa['agama'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $DataSiswa['jenis_kelamin'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $DataSiswa['kelas'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $DataSiswa['alamat'] ?></center>
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