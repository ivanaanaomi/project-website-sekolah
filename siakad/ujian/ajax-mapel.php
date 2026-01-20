<?php

require_once "../config/config.php";

$kelas = $_GET['kelas'];

$no = 1;
$queryPelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE kelas = '$kelas'");
while ($data = mysqli_fetch_array($queryPelajaran)) { ?>
    <tr>
        <td>
            <center><?= $no++ ?>.</center>
        </td>
        <td>
            <center><input type="text" name="mapel[]" value="<?= $data['pelajaran'] ?>" class="border-0 bg-transparent col-12" readonly></center>
        </td>
        <td>
            <center><input type="text" name="kls[]" value="<?= $data['kelas'] ?>" class="border-0 bg-transparent col-12" readonly></center>
        </td>
        <td>
            <center><input type="number" name="nilai[]" value="0" min="0" max="100" step="5" class="form-control nilai text-center" onchange="fnhitung()"></center>
        </td>
    </tr>
<?php

}

?>