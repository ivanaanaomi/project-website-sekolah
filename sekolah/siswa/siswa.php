<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Data Siswa - SMPN 14 Pematangsiantar";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Siswa</li>
            </ol>

            <div class="card">
                <div class="card-header">
                    <span class="h5 my-2"><i class="fa-solid 
                    fa-list me-1"></i> Data Siswa</span>
                    <a href="<?= $main_url ?>siswa/add-siswa.php"
                        class="btn btn-primary float-end">
                        <i class="fa-solid fa-square-plus me-1"></i> Tambah Siswa</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <center>No</center>
                                </th>
                                <th scope="col">
                                    <center>Foto</center>
                                </th>
                                <th scope="col">
                                    <center>NIS</center>
                                </th>
                                <th scope="col">
                                    <center>Nama</center>
                                </th>
                                <th scope="col">
                                    <center>NISN</center>
                                </th>
                                <th scope="col">
                                    <center>Tanggal Lahir</center>
                                </th>
                                <th scope="col">
                                    <center>Agama</center>
                                </th>
                                <th scope="col">
                                    <center>Jenis Kelamin</center>
                                </th>
                                <th scope="col">
                                    <center>Kelas</center>
                                </th>
                                <th scope="col">
                                    <center>Alamat</center>
                                </th>
                                <th scope="col">
                                    <center>Operasi</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            <?php
                            $no = 1;
                            $querySiswa = mysqli_query($koneksi, " SELECT tbl_siswa.id,
                                                        tbl_siswa.nis,
                                                        tbl_siswa.nisn,
                                                        tbl_siswa.nama,
                                                        tbl_siswa.tgl_lahir,
                                                        tbl_siswa.agama,
                                                        tbl_siswa.jenis_kelamin,
                                                        tbl_siswa.alamat,
                                                        tbl_siswa.foto,
                                                        tbl_kelas.kelas AS kelas
                                                        FROM tbl_siswa
                                                        JOIN tbl_kelas ON tbl_siswa.kelas = tbl_kelas.id
                                                        ") or die(mysqli_error($koneksi));
                            while ($data = mysqli_fetch_array($querySiswa)) { ?>
                                <tr>
                                    <th scope="row">
                                        <center><?= $no++ ?>.</center>
                                    </th>
                                    <td>
                                        <center><img src="../asset/image/<?= $data['foto'] ?>"
                                                alt="Foto Siswa" class="rounded-circle mb-3" style="width: 65px; 
                                        height: 65px; object-fit: cover;"></center>
                                    </td>
                                    <td>
                                        <center><?= $data['nis'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $data['nama'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $data['nisn'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $data['tgl_lahir'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $data['agama'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $data['jenis_kelamin'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $data['kelas'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $data['alamat'] ?></center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="edit-siswa.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-warning"
                                                title="Update Data Siswa">
                                                <i class="fa-solid fa-pen"></i></a>
                                            <a href="hapus-siswa.php?id=<?= $data['id'] ?>
                                            &foto=<?= $data['foto'] ?>" class="btn btn-sm btn-danger"
                                                title="Hapus Data Siswa" onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                                <i class="fa-solid fa-trash"></i></a>
                                        </center>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <?php

    require_once "../template/footer.php"

    ?>