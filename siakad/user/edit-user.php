<?php

session_start();

if (!isset($_SESSION["ssLoginSiakad"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../module/mode-user.php";

$title = "Edit User";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$id = $_GET['id'];

$sqlEdit = "SELECT * FROM user WHERE id = $id";
$user = getData($sqlEdit)[0];
$level = $user['level'];

if (isset($_POST['update'])) {
    if (update($_POST)) {
        echo '<script>alert("Data berhasil diperbaharui");
        document.location.href = "data-user.php";
        </script>';
    }
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>user/data-user.php">Users</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-header">
                        <h3 class="card-title"><strong><i class="fas fa-plus-square fa-sm mr-1"></i> Edit User</strong></h3>
                        <button type="submit" name="update" class="btn btn-primary btn-sm float-right"><i class="fas fa-save fa-sm mr-1"></i> Update</button>
                        <button type="reset" name="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times fa-sm mr-1"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" value="<?= $user['id'] ?>" name="id">
                            <div class="col-lg-8 mb-3">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control"
                                        id="username" placeholder="Masukkan Username"
                                        autofocus autocomplete="off" value="<?= $user['username'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="fullname">Fullname</label>
                                    <input type="text" name="fullname" class="form-control"
                                        id="fullname" placeholder="Masukkan Nama Lengkap"
                                        value="<?= $user['fullname'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <select name="level" id="level" class="form-control">
                                        <option value="">--Pilih Level--</option>
                                        <option value="1" <?= selectUser1($level) ?>>Administrator</option>
                                        <option value="2" <?= selectUser2($level) ?>>Guru</option>
                                        <option value="3" <?= selectUser3($level) ?>>Siswa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center">
                                <input type="hidden" name="oldImg" value="<?= $user['foto'] ?>">
                                <img src="<?= $main_url ?>asset/image/<?= $user['foto'] ?>"
                                    alt="Foto Profil"
                                    style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;"
                                    class="mb-3">
                                <input type="file" class="form-control" name="image">
                                <span class="text-sm">JPG, PNG, JPEG</span>
                                <span class="text-sm">
                                    <p>Width = Height</p>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php

    require "../template/footer.php";

    ?>