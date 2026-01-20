<?php

session_start();

if (!isset($_SESSION["ssLoginSiakad"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../module/mode-user.php";

$title = "Data User";
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
                    <h1 class="m-0">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong><i class="fas fa-list fa-sm mr-1"></i> Data User</strong></h3>
                    <div class="card-tools">
                        <a href="<?= $main_url ?>user/add-user.php" class="btn btn-sm btn-primary"><i class="fas fa-plus fa-sm mr-1"></i> Add User</a>
                    </div>
                </div>
                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <center>No.</center>
                                </th>
                                <th>
                                    <center>Foto</center>
                                </th>
                                <th>
                                    <center>Username</center>
                                </th>
                                <th>
                                    <center>Fullname</center>
                                </th>
                                <th>
                                    <center>Level User</center>
                                </th>
                                <th style="width: 10%;">
                                    <center>Operasi</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $users = getData("SELECT * FROM user");
                            foreach ($users as $user) : ?>
                                <tr>
                                    <td>
                                        <center><?= $no++ ?>.</center>
                                    </td>
                                    <td>
                                        <center>
                                            <img src="../asset/image/<?= $user['foto'] ?>"
                                                class="rounded-circle"
                                                style="width:60px; height:60px; object-fit:cover;">
                                        </center>
                                    </td>
                                    <td>
                                        <center><?= $user['username'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $user['fullname'] ?></center>
                                    </td>
                                    <td>
                                        <center>
                                            <?php
                                            if ($user['level'] == 1) {
                                                echo "Administrator";
                                            } else if ($user['level'] == 2) {
                                                echo "Guru";
                                            } else {
                                                echo "Siswa";
                                            }
                                            ?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="edit-user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-warning"
                                                title="Edit Data"><i class="fas fa-edit fa-sm"></i></a>
                                            <a href="del-user.php?id=<?= $user['id'] ?>&foto=<?= $user['foto'] ?>"
                                                class="btn btn-sm btn-danger"
                                                title="Hapus Data"
                                                onclick="return confirm('Anda yakin akan menghapus data ini?')">
                                                <i class="fas fa-trash fa-sm"></i></a>
                                        </center>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php

    require "../template/footer.php";

    ?>