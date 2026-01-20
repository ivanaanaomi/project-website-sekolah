<?php

session_start();

if (!isset($_SESSION["ssLoginSiakad"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";

// ... (Blok pemrosesan POST tidak berubah, sudah benar)
if (isset($_POST['absensi'])) {
    $jadwal_id = (int)$_POST['id_jadwal'];
    $siswa_id = (int)$_POST['siswa'];
    $kehadiran = $_POST['kehadiran'];
    $tanggal_absen = $_POST['tanggal'];
    $catatan = !empty(trim($_POST['catatan'])) ? htmlspecialchars($_POST['catatan']) : NULL;
    if (empty($jadwal_id) || empty($siswa_id) || empty($kehadiran) || empty($tanggal_absen)) {
        die("Data tidak lengkap (Jadwal, Siswa, Kehadiran, dan Tanggal wajib diisi).");
    }
    $stmtCek = mysqli_prepare($koneksi, "SELECT jadwal FROM tbl_absensi WHERE jadwal = ? AND siswa = ?");
    mysqli_stmt_bind_param($stmtCek, 'ii', $jadwal_id, $siswa_id);
    mysqli_stmt_execute($stmtCek);
    $resultCek = mysqli_stmt_get_result($stmtCek);
    if (mysqli_num_rows($resultCek) > 0) {
        $query = "UPDATE tbl_absensi SET kehadiran = ?, catatan = ?, tanggal = ? WHERE jadwal = ? AND siswa = ?";
        $stmt_update = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt_update, 'sssii', $kehadiran, $catatan, $tanggal_absen, $jadwal_id, $siswa_id);
        mysqli_stmt_execute($stmt_update);
    } else {
        $query = "INSERT INTO tbl_absensi (jadwal, siswa, kehadiran, catatan, tanggal) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt_insert, 'iisss', $jadwal_id, $siswa_id, $kehadiran, $catatan, $tanggal_absen);
        if (!mysqli_stmt_execute($stmt_insert)) {
            die("Eksekusi (INSERT) Gagal: " . mysqli_stmt_error($stmt_insert));
        }
    }
    $_SESSION['msg'] = 'Absensi berhasil disimpan!';
    header("Location: jadwal.php");
    exit();
}

$title = "Jadwal";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$id_guru     = $_SESSION["ssIDGuru"] ?? null;
$id_siswa_from_session = $_SESSION["ssIDSiswa"] ?? null;
$role        = $_SESSION["ssRoleSiakad"] ?? null;
$id_kelas_siswa = $_SESSION["ssKelasSiswa"] ?? null;

$baseQuery = "SELECT tbl_jadwal.id, tbl_jadwal.hari, tbl_jadwal.jam_mulai, tbl_jadwal.jam_selesai, tbl_pelajaran.pelajaran AS nama_mapel, tbl_guru.nama AS nama_guru, tbl_kelas.kelas AS nama_kelas, tbl_jadwal.kelas AS id_kelas FROM tbl_jadwal JOIN tbl_pelajaran ON tbl_jadwal.mapel = tbl_pelajaran.id JOIN tbl_guru ON tbl_jadwal.guru = tbl_guru.id JOIN tbl_kelas ON tbl_jadwal.kelas = tbl_kelas.id";
$params = [];
$types = '';
if ($role == '2' && $id_guru) {
    $baseQuery .= " WHERE tbl_jadwal.guru = ?";
    $params[] = $id_guru;
    $types .= 'i';
} elseif ($role == '3' && $id_kelas_siswa) {
    $baseQuery .= " WHERE tbl_jadwal.kelas = ?";
    $params[] = $id_kelas_siswa;
    $types .= 'i';
}
$baseQuery .= " ORDER BY FIELD(hari,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'), jam_mulai";

$stmt = mysqli_prepare($koneksi, $baseQuery);
if ($stmt) {
    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    die("Query Error: " . mysqli_error($koneksi));
}

?>

<div class="content-wrapper">
    <!-- ... Konten ... -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jadwal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Jadwal</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <?php if (isset($_SESSION['msg'])): ?> <div class="alert alert-success alert-dismissible fade show" role="alert"> <?= $_SESSION['msg']; ?> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div> <?php unset($_SESSION['msg']);
                                                                                                                                                                                                                                                                                        endif; ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-calendar-week fa-sm mr-1"></i> <strong>Jadwal Pelajaran</strong></h3> <?php if (userRole() == '1'): ?> <div class="card-tools"> <a href="input-jadwal.php" class="btn btn-sm btn-primary"><i class="fas fa-plus fa-sm mr-1"></i> <strong>Tambah Jadwal</strong></a> </div> <?php endif; ?>
                </div>
                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap table-bordered" id="tblData">
                        <thead>
                            <!-- ... (Header tabel tidak berubah) ... -->
                            <tr>
                                <th>
                                    <center>Hari</center>
                                </th>
                                <th>
                                    <center>Jam</center>
                                </th>
                                <th>
                                    <center>Mata Pelajaran</center>
                                </th>
                                <th>
                                    <center>Guru</center>
                                </th>
                                <th>
                                    <center>Kelas</center>
                                </th>
                                <?php if (userRole() == '2'): ?>
                                    <th style="width: 15%;">
                                        <center>Siswa</center>
                                    </th>
                                    <th>
                                        <center>Tanggal</center>
                                    </th>
                                    <th style="width: 12%;">
                                        <center>Kehadiran</center>
                                    </th>
                                    <th>
                                        <center>Catatan</center>
                                    </th>
                                    <th>
                                        <center>Aksi</center>
                                    </th>
                                <?php endif; ?>
                                <?php if (userRole() == '3'): ?>
                                    <th>
                                        <center>Tanggal</center>
                                    </th>
                                    <th>
                                        <center>Kehadiran</center>
                                    </th>
                                    <th>
                                        <center>Catatan</center>
                                    </th>
                                <?php endif; ?>
                                <?php if (userRole() == '1'): ?>
                                    <th>
                                        <center>Aksi</center>
                                    </th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <!-- ... (Kolom-kolom utama tidak berubah) ... -->
                                    <td class="text-center align-middle"><?= $row['hari']; ?></td>
                                    <td class="text-center align-middle"><?= date('H:i', strtotime($row['jam_mulai'])) . " - " . date('H:i', strtotime($row['jam_selesai'])); ?></td>
                                    <td class="align-middle"><?= $row['nama_mapel']; ?></td>
                                    <td class="align-middle"><?= $row['nama_guru']; ?></td>
                                    <td class="text-center align-middle"><?= $row['nama_kelas']; ?></td>

                                    <?php if (userRole() == '2'): ?>
                                        <!-- ... (Blok form guru tidak berubah) ... -->
                                        <td class="align-middle">
                                            <form method="POST" id="form-absensi-<?= $row['id'] ?>"></form>
                                            <input type="hidden" name="id_jadwal" value="<?= $row['id'] ?>" form="form-absensi-<?= $row['id'] ?>">
                                            <select name="siswa" class="form-control form-control-sm" required form="form-absensi-<?= $row['id'] ?>">
                                                <option value="" disabled selected>--Pilih Siswa--</option> <?php $id_kelas_jadwal = $row['id_kelas'];
                                                                                                            $stmtSiswa = mysqli_prepare($koneksi, "SELECT id, nama FROM tbl_siswa WHERE kelas = ? ORDER BY nama ASC");
                                                                                                            mysqli_stmt_bind_param($stmtSiswa, 'i', $id_kelas_jadwal);
                                                                                                            mysqli_stmt_execute($stmtSiswa);
                                                                                                            $resultSiswa = mysqli_stmt_get_result($stmtSiswa);
                                                                                                            while ($s = mysqli_fetch_assoc($resultSiswa)) {
                                                                                                                echo "<option value='{$s['id']}'>{$s['nama']}</option>";
                                                                                                            }
                                                                                                            mysqli_stmt_close($stmtSiswa); ?>
                                            </select>
                                        </td>
                                        <td class="align-middle"> <input type="date" name="tanggal" class="form-control form-control-sm" required form="form-absensi-<?= $row['id'] ?>" value="<?= date('Y-m-d') ?>"> </td>
                                        <td class="align-middle"> <select name="kehadiran" class="form-control form-control-sm" required form="form-absensi-<?= $row['id'] ?>">
                                                <option value="" disabled selected>--Status--</option>
                                                <option>Hadir</option>
                                                <option>Izin</option>
                                                <option>Sakit</option>
                                                <option>Alfa</option>
                                            </select> </td>
                                        <td class="align-middle"><textarea name="catatan" cols="20" rows="1" class="form-control form-control-sm" form="form-absensi-<?= $row['id'] ?>"></textarea></td>
                                        <td class="text-center align-middle"><button type="submit" name="absensi" class="btn btn-sm btn-info" title="Simpan Absensi" form="form-absensi-<?= $row['id'] ?>"><i class="fas fa-save"></i></button></td>
                                    <?php endif; ?>

                                    <?php if (userRole() == '3'): ?>
                                        <?php
                                        $jadwal_id = $row['id'];
                                        $tanggal_absen_siswa = '-';
                                        $kehadiran_siswa = '-';
                                        $catatan_siswa = '-';

                                        if ($id_siswa_from_session) {
                                            $query_absensi = "SELECT kehadiran, catatan, tanggal FROM tbl_absensi WHERE jadwal = ? AND siswa = ?";
                                            $stmt_absensi = mysqli_prepare($koneksi, $query_absensi);

                                            // PERBAIKAN 1: Tambahkan pemeriksaan error setelah prepare
                                            if (!$stmt_absensi) {
                                                // Jika gagal, tampilkan pesan error SQL dan lewati iterasi ini
                                                echo "<td colspan='3' class='text-danger'>Error: " . mysqli_error($koneksi) . "</td>";
                                            } else {
                                                mysqli_stmt_bind_param($stmt_absensi, 'ii', $jadwal_id, $id_siswa_from_session);
                                                mysqli_stmt_execute($stmt_absensi);
                                                $result_absensi = mysqli_stmt_get_result($stmt_absensi);

                                                if (mysqli_num_rows($result_absensi) > 0) {
                                                    $data_absensi = mysqli_fetch_assoc($result_absensi);
                                                    $kehadiran_siswa = $data_absensi['kehadiran'];
                                                    $catatan_siswa = $data_absensi['catatan'] ?? '-';
                                                    if (!empty($data_absensi['tanggal'])) {
                                                        $tanggal_absen_siswa = date('d/m/Y', strtotime($data_absensi['tanggal']));
                                                    }
                                                }
                                                mysqli_stmt_close($stmt_absensi);

                                                // Tampilkan kolom data seperti biasa jika berhasil
                                                echo "<td class='text-center align-middle'>{$tanggal_absen_siswa}</td>";
                                                echo "<td class='text-center align-middle'>{$kehadiran_siswa}</td>";
                                                echo "<td class='align-middle'>{$catatan_siswa}</td>";
                                            }
                                        } else {
                                            // Tampilkan kolom kosong jika tidak ada id siswa di sesi
                                            echo "<td class='text-center align-middle'>-</td>";
                                            echo "<td class='text-center align-middle'>-</td>";
                                            echo "<td class='align-middle'>-</td>";
                                        }
                                        ?>
                                    <?php endif; ?>

                                    <?php if (userRole() == '1'): ?>
                                        <td class="text-center align-middle"> <a href="edit-jadwal.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning" title="Edit Jadwal"><i class="fas fa-edit"></i></a> <a href="del-jadwal.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" title="Hapus Jadwal" onclick="return confirm('Anda yakin akan menghapus jadwal ini?')"><i class="fas fa-trash"></i></a> </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <?php
                    // PERBAIKAN 2: Tutup statement utama setelah loop selesai
                    mysqli_stmt_close($stmt);
                    ?>
                </div>
            </div>
        </div>
    </section>

<?php
require "../template/footer.php";
?>