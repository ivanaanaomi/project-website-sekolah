<?php
session_start();

if (isset($_SESSION["ssLoginSiakad"])) {
    header("location:../dashboard.php");
    exit();
}

require "../config/config.php";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // ====== 1. Cek tbl_user (Level 1) ======
    $queryUser = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username' LIMIT 1");
    if (mysqli_num_rows($queryUser) === 1) {
        $row = mysqli_fetch_assoc($queryUser);
        if (password_verify($password, $row['password'])) {
            $_SESSION["ssLoginSiakad"] = true;
            $_SESSION["ssUserSiakad"]  = $row['username'];
            $_SESSION["ssRoleSiakad"]  = 1;
            $_SESSION["ssTableSiakad"] = "tbl_user";

            header("location:../dashboard.php");
            exit();
        } else {
            echo "<script>alert('Password yang anda masukkan salah');</script>";
            exit();
        }
    }

    // ====== 2. Cek tbl_guru (Level 2) ======
    $usernameCheck = mysqli_real_escape_string($koneksi, strtolower(str_replace(' ', '', $username)));
    $queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru 
        WHERE LOWER(REPLACE(nama, ' ', '')) = '$usernameCheck' LIMIT 1");

    if ($queryGuru && mysqli_num_rows($queryGuru) === 1) {
        $row = mysqli_fetch_assoc($queryGuru);
        $tglObj = date_create($row['tgl_lahir']); // lebih fleksibel

        if ($tglObj) {
            $passGuru = $tglObj->format("dmY");
            if ($password === $passGuru) {
                $_SESSION["ssLoginSiakad"] = true;
                $_SESSION["ssUserSiakad"]  = $row['nip']; // gunakan NIP
                $_SESSION["ssRoleSiakad"]  = 2;
                $_SESSION["ssIDGuru"]      = $row['id'];
                $_SESSION["ssTableSiakad"] = "tbl_guru";

                header("location:../dashboard.php");
                exit();
            }
        }

        echo "<script>alert('Password yang anda masukkan salah');</script>";
        exit();                                                                                 
    }

    // ====== 3. Cek tbl_siswa (Level 3) ======
    $usernameCheck = mysqli_real_escape_string($koneksi, strtolower(str_replace(' ', '', $username)));
    $querySiswa = mysqli_query($koneksi, "SELECT * FROM tbl_siswa 
        WHERE LOWER(REPLACE(nama, ' ', '')) = '$usernameCheck' LIMIT 1");

    if (mysqli_num_rows($querySiswa) === 1) {
        $row = mysqli_fetch_assoc($querySiswa);
        $tglObj = date_create($row['tgl_lahir']);   

        if ($tglObj) {
            $passSiswa = $tglObj->format("dmY");
            if ($password === $passSiswa) {
                $_SESSION["ssLoginSiakad"] = true;
                $_SESSION["ssUserSiakad"]  = $row['nis']; // gunakan NIS
                $_SESSION["ssRoleSiakad"]  = 3;
                $_SESSION["ssIDSiswa"]     = $row['id'];
                $_SESSION["ssTableSiakad"] = "tbl_siswa";
                $_SESSION["ssKelasSiswa"] = $row['kelas'];

                header("location:../dashboard.php");
                exit();
            }
        }

        echo "<script>alert('Password yang anda masukkan salah');</script>";
        exit();
    }

    // ====== Jika tidak ditemukan ======
    echo "<script>alert('Username yang anda masukkan tidak terdaftar');</script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login SIAKAD</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= $main_url ?>asset/dashboard/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= $main_url ?>asset/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= $main_url ?>asset/dashboard/dist/css/adminlte.min.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="<?= $main_url ?>asset/image/toga.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box slide-down">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>SIAKAD</b><br>UPTD SMPN 14</a>
            </div>
            <div class="card-body">

                <form action="" method="post">
                    <div class="input-group mb-4">
                        <input type="text" name="username" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="mb-4">
                        <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </form>
                <!-- /.card-body -->
                <p class="my-3 text-center">
                    <strong>Copyright &copy; <?= date('Y') ?>
                        <br><span class="text-info">UPTD SMPN 14 Pematangsiantar</span></strong>
                </p>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="<?= $main_url ?>asset/dashboard/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?= $main_url ?>asset/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= $main_url ?>asset/dashboard/dist/js/adminlte.min.js"></script>
</body>

</html>