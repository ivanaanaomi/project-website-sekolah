<?php

session_start();

if (!isset($_SESSION["ssLoginSiakad"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../module/mode-user.php";

$title = "Add User";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_POST['simpan'])) {
    if (insert($_POST) > 0) {
        echo '<script>
                alert("Registrasi berhasil");
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
                    <h1 class="m-0">Add User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>user/data-user.php">Users</a></li>
                        <li class="breadcrumb-item active">Add User</li>
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
                        <h3 class="card-title"><strong><i class="fas fa-plus-square fa-sm mr-1"></i> Add User</strong></h3>
                        <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right"><i class="fas fa-save fa-sm mr-1"></i> Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times fa-sm mr-1"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 mb-3">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username" autofocus autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="fullname">Fullname</label>
                                    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukkan Nama Lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="password2">Konfirmasi Password</label>
                                    <input type="password" name="password2" class="form-control" id="password2" placeholder="Masukkan Ulang Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <select name="level" id="level" class="form-control">
                                        <option value="">--Pilih Level--</option>
                                        <option value="1">Administrator</option>
                                        <option value="2">Guru</option>
                                        <option value="3">Siswa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center">
                                <img src="<?= $main_url ?>asset/image/default.png" class="profile-user-img img-circle mb-3" width="60px;" alt="">
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
</div>

<?php

require "../template/footer.php";

?>