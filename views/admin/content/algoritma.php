<?php
// untuk kriteria
$sql      = "SELECT * FROM tb_kriteria";
$result   = $pdo->Query($sql);
$kriteria = [];
foreach ($result as $row) {
    $kriteria[$row['id_kriteria']] = [
        $row['kriteria'],
        $row['type'],
        $row['bobot'],
    ];
}

// untuk alternatif
$sql        = "SELECT * FROM tb_alternatif";
$result     = $pdo->Query($sql);
$alternatif = [];
foreach ($result as $row) {
    $alternatif[$row['id_alternatif']] = [
        $row['alternatif'],
    ];
}

// untuk mengambil data pada hasil evaluasi
$sql    = "SELECT * FROM tb_evaluasi ORDER BY id_alternatif, id_kriteria";
$result = $pdo->Query($sql);
$sample = [];
foreach ($result as $row) {
    if (!isset($sample[$row['id_alternatif']])) {
        $sample[$row['id_alternatif']] = array();
    }
    $sample[$row['id_alternatif']][$row['id_kriteria']] = $row['nilai'];
}

$normal = $sample;
foreach ($kriteria as $id_kriteria => $k) {
    $pembagi = 0;
    foreach ($alternatif as $id_alternatif => $a) {
        $pembagi += pow($sample[$id_alternatif][$id_kriteria], 2);
    }
    foreach ($alternatif as $id_alternatif => $a) {
        $normal[$id_alternatif][$id_kriteria] /= sqrt($pembagi);
    }
}

$optimasi = [];
foreach ($alternatif as $id_alternatif => $a) {
    $optimasi[$id_alternatif] = 0;
    foreach ($kriteria as $id_kriteria => $k) {
        $optimasi[$id_alternatif] += $normal[$id_alternatif][$id_kriteria] * ($k[1] == 'Benefit' ? 1 : -1) * $k[2];
    }
}

?>

<h2>Algoritma</h2>

<h3><b> Pengambilan Nilai Alternatif </b></h3>
<table width="100%" border="1">
    <thead align="center">
        <tr>
            <th>Alternatif</th>
            <?php
            foreach ($kriteria as $key => $value) {
                echo "<th>" . $value[0] . "</th>";
            }
            ?>
        </tr>
    </thead>
    <tbody align="center">
        <?php
        foreach ($sample as $key => $value) {
            echo "<tr>";
            echo "<td>" . $alternatif[$key][0] . "</td>";
            foreach ($value as $val) {
                echo "<td>" . $val . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<h3><b> Membuat Matriks Normalisasi </b></h3>
<table width="100%" border="1">
    <thead align="center">
        <tr>
            <th>Alternatif</th>
            <?php
            foreach ($kriteria as $key => $value) {
                echo "<th>" . $value[0] . "</th>";
            }
            ?>
        </tr>
    </thead>
    <tbody align="center">
        <?php
        foreach ($normal as $key => $value) {
            echo "<tr>";
            echo "<td>" . $alternatif[$key][0] . "</td>";
            foreach ($value as $val) {
                echo "<td>" . $val . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<h3><b> Menghitung Nilai Optimasi </b></h3>
<table width="100%" border="1">
    <thead align="center">
        <tr>
            <th>Alternatif</th>
            <th>Nilai Optimasi</th>
        </tr>
    </thead>
    <tbody align="center">
        <?php
        foreach ($optimasi as $key => $value) {
            echo "<tr>";
            echo "<td>" . $alternatif[$key][0] . "</td>";
            echo "<td>" . $value . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<h3> <b> Hasil Rekomendasi </b></h3>
<?php
arsort($optimasi);
$index = key($optimasi);
$hasil_alternatif = empty($alternatif[$index][0]) ? 'Belum ada!' : $alternatif[$index][0];
$hasil_optimasi = empty($optimasi[$index]) ? 'Belum ada!' : $optimasi[$index];
?>

<p>
    Hasilnya adalah alternatif <b><?= $hasil_alternatif ?></b> dengan nilai optimasi <b><?= $hasil_optimasi ?></b> yang terpilih.
</p>