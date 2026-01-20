<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Mata Pelajaran - SMPN 14 Pematangsiantar";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$id = $_GET["id"];

$queryPelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE id = $id");
$data = mysqli_fetch_array($queryPelajaran);

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Update Mata Pelajaran</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="pelajaran.php">Kembali</a></li>
                <li class="breadcrumb-item active">Update Mata Pelajaran</li>
            </ol>

            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header h5">
                            <i class="fa-solid fa-pen me-1"></i>
                            Update Mata Pelajaran
                        </div>
                        <div class="card-body">
                            <form action="proses-pelajaran.php" method="POST">
                                <input type="number" name="id" value="<?= $data['id'] ?>" hidden>
                                <div class="mb-3">
                                    <label for="pelajaran" class="form-label ps-1">Pelajaran</label>
                                    <input type="text" class="form-control" id="pelajaran"
                                        name="pelajaran" placeholder="Nama mata pelajaran"
                                        value="<?= $data['pelajaran'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="guru" class="form-label ps-1">Guru</label>
                                    <select name="guru" id="guru" class="form-select" required>
                                        <?php
                                        $queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru");
                                        while ($dataGuru = mysqli_fetch_array($queryGuru)) {
                                            if ($data['guru'] == $dataGuru['nama']) {
                                        ?>
                                                <option value="<?= $dataGuru['nama'] ?>"
                                                    selected><?= $dataGuru['nama'] ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $dataGuru['nama'] ?>">
                                                    <?= $dataGuru['nama'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" name="update">
                                    <i class="fa-solid fa-floppy-disk me-1"></i> Update
                                </button>
                                <a href="pelajaran.php" class="btn btn-danger">
                                    <i class="fa-solid fa-xmark me-1"></i> Cancel
                                </a>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="card">
                        <div class="card-header h5">
                            <i class="fa-solid fa-list me-1"></i> Data Pelajaran
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <center>No</center>
                                        </th>
                                        <th scope="col">
                                            <center>Mata Pelajaran</center>
                                        </th>
                                        <th scope="col">
                                            <center>Guru</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    <tr>
                                        <th scope="row">
                                            <center><?= $no ?>.</center>
                                        </th>
                                        <td><?= $data['pelajaran'] ?></td>
                                        <td><?= $data['guru'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>



    <?php

    require_once "../template/footer.php";

    ?>