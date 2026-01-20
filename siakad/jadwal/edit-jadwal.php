<?php

session_start();

if (!isset($_SESSION["ssLoginSiakad"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";

// Logika untuk memproses update data formulir
if (isset($_POST["update"])) {
    $id          = $_POST["id"];
    $hari        = mysqli_real_escape_string($koneksi, $_POST['hari']);
    $jam_mulai   = mysqli_real_escape_string($koneksi, $_POST['jam_mulai']);
    $jam_selesai = mysqli_real_escape_string($koneksi, $_POST['jam_selesai']);
    $mapel       = mysqli_real_escape_string($koneksi, $_POST['mapel']);
    $guru        = mysqli_real_escape_string($koneksi, $_POST['guru']);
    $kelas       = mysqli_real_escape_string($koneksi, $_POST['kelas']);

    $query = "UPDATE tbl_jadwal SET
                hari = '$hari',
                jam_mulai = '$jam_mulai',
                jam_selesai = '$jam_selesai',
                mapel = '$mapel',
                guru = '$guru',
                kelas = '$kelas'
              WHERE id = $id";

    $result = mysqli_query($koneksi, $query);

    // Cek apakah query berhasil atau gagal
    if ($result) {
        // Cek berapa baris yang terpengaruh
        if (mysqli_affected_rows($koneksi) > 0) {
            header("location:jadwal.php?msg=updated");
            exit();
        } else {
            // Query berhasil tapi tidak ada baris yang berubah (mungkin data yang diinput sama persis dengan data lama)
            header("location:jadwal.php?msg=nochange");
            exit();
        }
    } else {
        // Jika query GAGAL, tampilkan pesan error SQL
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        exit(); // Hentikan eksekusi agar pesan error terlihat jelas
    }
}


$title = "Edit Jadwal";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$id = $_GET['id'];

$queryJadwal = mysqli_query($koneksi, "SELECT * FROM tbl_jadwal WHERE id = $id");
$data = mysqli_fetch_array($queryJadwal);

// Jika data tidak ditemukan, arahkan kembali
if (!$data) {
    header("location:jadwal.php");
    exit();
}

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Jadwal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="jadwal.php">Jadwal</a></li>
                        <li class="breadcrumb-item active">Edit Jadwal</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="" method="post">
                    <!-- Input hidden untuk ID -->
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <div class="card-header">
                        <h3 class="card-title"><strong><i class="fas fa-edit fa-sm mr-1"></i> Edit Jadwal</strong></h3>
                        <button type="submit" name="update" class="btn btn-primary btn-sm float-right"><i class="fas fa-save fa-sm mr-1"></i> Update</button>
                        <a href="jadwal.php" class="btn btn-secondary btn-sm float-right mr-1"><i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label for="hari">Hari</label>
                                    <select name="hari" id="hari" class="form-control" required>
                                        <?php
                                        $hari_options = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                                        foreach ($hari_options as $day) {
                                            $selected = ($data['hari'] == $day) ? 'selected' : '';
                                            echo "<option value='{$day}' {$selected}>{$day}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jam_mulai">Jam Mulai</label>
                                    <input type="time" name="jam_mulai" value="<?= $data['jam_mulai'] ?>" class="form-control" id="jam_mulai" required>
                                </div>
                                <div class="form-group">
                                    <label for="jam_selesai">Jam Selesai</label>
                                    <input type="time" name="jam_selesai" value="<?= $data['jam_selesai'] ?>" class="form-control" id="jam_selesai" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label for="mapel">Mata Pelajaran</label>
                                    <select name="mapel" id="mapel" class="form-control" required>
                                        <?php
                                        $queryMapel = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran");
                                        while ($dataMapel = mysqli_fetch_array($queryMapel)) {
                                            $selected = ($data['mapel'] == $dataMapel['id']) ? 'selected' : '';
                                            echo "<option value='{$dataMapel['id']}' {$selected}>{$dataMapel['pelajaran']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="guru">Guru</label>
                                    <select name="guru" id="guru" class="form-control" required>
                                        <?php
                                        $queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru");
                                        while ($dataGuru = mysqli_fetch_array($queryGuru)) {
                                            $selected = ($data['guru'] == $dataGuru['id']) ? 'selected' : '';
                                            echo "<option value='{$dataGuru['id']}' {$selected}>{$dataGuru['nama']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select name="kelas" id="kelas" class="form-control" required>
                                        <?php
                                        $queryKelas = mysqli_query($koneksi, "SELECT * FROM tbl_kelas");
                                        while ($dataKelas = mysqli_fetch_array($queryKelas)) {
                                            $selected = ($data['kelas'] == $dataKelas['id']) ? 'selected' : '';
                                            echo "<option value='{$dataKelas['id']}' {$selected}>{$dataKelas['kelas']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
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