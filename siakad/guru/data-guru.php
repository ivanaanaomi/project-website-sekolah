<?php

session_start();

if (!isset($_SESSION["ssLoginSiakad"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
// require "../module/mode-user.php";

$title = "Data Guru";
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
                    <h1 class="m-0">Guru</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Guru</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong><i class="fas fa-list fa-sm mr-1"></i> Data Guru</strong></h3>
                    <div class="card-tools">
                        <a href="http://localhost/sekolah/siswa/add-guru.php" class="btn btn-sm btn-primary"><strong><i class="fas fa-plus fa-sm mr-1"></i> Tambah Data</strong></a>
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
                                    <center>NIP</center>
                                </th>
                                <th>
                                    <center>Nama</center>
                                </th>
                                <th>
                                    <center>Jabatan</center>
                                </th>
                                <th>
                                    <center>Tanggal Lahir</center>
                                </th>
                                <th>
                                    <center>Kontak</center>
                                </th>
                                <th>
                                    <center>Agama</center>
                                </th>
                                <th>
                                    <center>Jenis Kelamin</center>
                                </th>
                                <th>
                                    <center>Alamat</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $no = 1;
                            $guru = getData("SELECT * FROM tbl_guru");
                            foreach ($guru as $DataGuru) :
                            ?>
                                <tr>
                                    <td>
                                        <center><?= $no++ ?>.</center>
                                    </td>
                                    <td><img src="http://localhost/sekolah/asset/image/<?= $DataGuru['foto'] ?>"
                                            alt="Foto Siswa" class="rounded-circle mb-3" style="width: 65px; 
                                        height: 65px; object-fit: cover;"></td>
                                    <td>
                                        <center><?= $DataGuru['nip'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $DataGuru['nama'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $DataGuru['jabatan'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $DataGuru['tgl_lahir'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $DataGuru['kontak'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $DataGuru['agama'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $DataGuru['jenis_kelamin'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $DataGuru['alamat'] ?></center>
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