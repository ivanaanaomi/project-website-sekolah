<?php

if (userLogin()['level'] != 1) {
    header("location:" . $main_url . "error-page.php");
    exit();
}

function insert($data)
{
    global $koneksi;

    $username = strtolower(mysqli_real_escape_string($koneksi, $data['username']));
    $fullname = mysqli_real_escape_string($koneksi, $data['fullname']);
    $password = mysqli_real_escape_string($koneksi, $data['password']);
    $password2 = mysqli_real_escape_string($koneksi, $data['password2']);
    $level = mysqli_real_escape_string($koneksi, $data['level']);
    $gambar = mysqli_real_escape_string($koneksi, $_FILES['image']['name']);


    // Cek konfirmasi password
    if ($password !== $password2) {
        echo '<script>alert("Registrasi gagal, konfirmasi password salah");</script>';
        return false;
    }

    // Hash password
    $pass = password_hash($password, PASSWORD_DEFAULT);

    // Cek username sudah ada atau belum
    $cekUsername = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_num_rows($cekUsername) > 0) {
        echo '<script>alert("Registrasi gagal, username sudah terdaftar");</script>';
        return false;
    }

    // Upload gambar jika ada
    if (!empty($_FILES['image']['name'])) {
        $gambar = uploadimg();
        if ($gambar === false) {
            return false; // upload gagal
        }
    } else {
        $gambar = 'default.png';
    }

    // Simpan data
    $sqlUser = "INSERT INTO user VALUES (null, '$username', '$fullname', '$pass', '$level', '$gambar')";
    mysqli_query($koneksi, $sqlUser);

    return mysqli_affected_rows($koneksi);
}

function delete($id, $foto)
{
    global $koneksi;

    $sqlDel = "DELETE FROM user WHERE id = $id";
    mysqli_query($koneksi, $sqlDel);
    if ($foto != 'default.png') {
        unlink('../asset/image/' . $foto);
    }

    return mysqli_affected_rows($koneksi);
}

function selectUser1($level)
{
    $result = null;
    if ($level == 1) {
        $result = "selected";
    }
    return $result;
}

function selectUser2($level)
{
    $result = null;
    if ($level == 2) {
        $result = "selected";
    }
    return $result;
}

function selectUser3($level)
{
    $result = null;
    if ($level == 3) {
        $result = "selected";
    }
    return $result;
}

function update($data)
{
    global $koneksi;

    $iduser = mysqli_real_escape_string($koneksi, $data['id']);
    $username = strtolower(mysqli_real_escape_string($koneksi, $data['username']));
    $fullname = mysqli_real_escape_string($koneksi, $data['fullname']);
    $level = mysqli_real_escape_string($koneksi, $data['level']);
    $gambar = mysqli_real_escape_string($koneksi, $_FILES['image']['name']);
    $fotoLama = mysqli_real_escape_string($koneksi, $data['oldImg']);

    $queryUsername = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$iduser'");
    $dataUsername = mysqli_fetch_assoc($queryUsername);
    $curUsername = $dataUsername['username'];

    $newUsername = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");

    if ($username !== $curUsername) {
        if (mysqli_num_rows($newUsername)) {
            echo '<script>alert("Update data gagal, username sudah terpakai");
            document.location.href = "data-user.php";
            </script>';
            return false;
        }
    }

    if ($gambar != null) {
        $url = "data-user.php";
        $imgUser = uploadimg($url);
        if ($fotoLama != 'default.png') {
            @unlink('../asset/image/' . $fotoLama);
        }
    } else {
        $imgUser = $fotoLama;
    }

    mysqli_query($koneksi, "UPDATE user SET
                        username = '$username',
                        fullname = '$fullname',
                        level    = '$level',
                        foto     = '$imgUser'
                        WHERE id = $iduser
                        ");

    return mysqli_affected_rows($koneksi);
}
