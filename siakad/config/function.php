<?php
function uploadimg($url = null)
{
    $namafile = $_FILES["image"]["name"];
    $ukuran   = $_FILES["image"]["size"];
    $tmp      = $_FILES["image"]["tmp_name"];

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = strtolower(pathinfo($namafile, PATHINFO_EXTENSION));

    // cek ekstensi
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $pesan = "File yang anda upload bukan gambar";
        if ($url != null) {
            echo "<script>alert('$pesan'); document.location.href = '$url';</script>";
            die();
        } else {
            echo "<script>alert('$pesan');</script>";
            return false;
        }
    }

    // cek ukuran
    if ($ukuran > 1000000) {
        $pesan = "Ukuran file tidak boleh melebihi 1MB";
        if ($url != null) {
            echo "<script>alert('$pesan'); document.location.href = '$url';</script>";
            die();
        } else {
            echo "<script>alert('$pesan');</script>";
            return false;
        }
    }

    $namaFileBaru = rand(10, 1000) . '-' . $namafile;
    move_uploaded_file($tmp, '../asset/image/' . $namaFileBaru);
    return $namaFileBaru;
}

function getData($sql)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function dataSiswa($nis)
{
    global $koneksi;
    $query = "SELECT 
                ujian.no_ujian,
                siswa.nama,
                siswa.nis,
                siswa.nisn,
                kelas.kelas AS kelas,
                ujian.nilai_terendah,
                ujian.nilai_tertinggi,
                ujian.nilai_rata2,
                ujian.hasil_ujian
              FROM tbl_ujian AS ujian
              JOIN tbl_siswa AS siswa ON ujian.nis = siswa.nis
              JOIN tbl_kelas AS kelas ON siswa.id = kelas.id
              WHERE ujian.nis = '$nis' ORDER BY ujian.no_ujian DESC";

    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Error Query: " . mysqli_error($koneksi));
    }

    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        // Tambahkan setiap baris yang ditemukan ke dalam array $data
        $data[] = $row;
    }

    return $data;
}

function userLogin()
{
    global $koneksi;

    if (!isset($_SESSION["ssLoginSiakad"])) {
        return [];
    }

    $idUser = $_SESSION["ssUserSiakad"] ?? '';
    $tabel  = $_SESSION["ssTableSiakad"] ?? '';

    if (!$idUser || !$tabel) {
        return [];
    }

    if ($tabel == "tbl_user") {
        $fieldID = "username";
    } elseif ($tabel == "tbl_guru") {
        $fieldID = "nip";
    } elseif ($tabel == "tbl_siswa") {
        $fieldID = "nis";
    } else {
        return [];
    }

    $query = mysqli_query($koneksi, "SELECT * FROM $tabel WHERE $fieldID = '$idUser' LIMIT 1");
    if (!$query || mysqli_num_rows($query) === 0) {
        return [];
    }

    return mysqli_fetch_assoc($query);
}

function userRole()
{
    return $_SESSION["ssRoleSiakad"] ?? 0;
}

function userMenu()
{
    $uri_path    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segment = explode('/', $uri_path);
    return $uri_segment[2] ?? '';
}

function menuHome()
{
    return (userMenu() == 'dashboard.php') ? 'active' : null;
}

function menuSetting()
{
    return (userMenu() == 'user') ? 'menu-is-opening menu-open' : null;
}

function menuMaster()
{
    return (userMenu() == 'siswa') ? 'menu-is-opening menu-open' : null;
}

function menuUser()
{
    return (userMenu() == 'user') ? 'active' : null;
}

function menuSiswa()
{
    return (userMenu() == 'siswa') ? 'active' : null;
}

function menuGuru()
{
    return (userMenu() == 'guru') ? 'active' : null;
}

function menuPelajaran()
{
    return (userMenu() == 'pelajaran') ? 'active' : null;
}

function menuUjian()
{
    return (userMenu() == 'ujian') ? 'active' : null;
}

function menuJadwal()
{
    return (userMenu() == 'jadwal') ? 'active' : null;
}

function ambilDataUjian()
{
    global $koneksi;
    $result = mysqli_query($koneksi, "SELECT * FROM tbl_ujian");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function formatTanggalJam($datetime)
{
    if (!$datetime) return '';
    return date('d-m-Y H:i', strtotime($datetime));
    // Contoh hasil: 12-08-2025 13:45
}

function formatTanggal($tanggal)
{
    if (!$tanggal) return '';
    return date('d-m-Y', strtotime($tanggal));
}

function formatJam($waktu)
{
    if (!$waktu) return ''; // kalau kosong, jangan error
    return date('H:i', strtotime($waktu));
}
