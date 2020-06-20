<?php
$idk = strip_tags($_POST['inpidkriteria']);
$kde = strip_tags($_POST['inpkode']);
$nma = strip_tags($_POST['inpnama']);
$tpe = strip_tags($_POST['inptype']);
$bot = strip_tags($_POST['inpbobot']);

$error = [];
foreach ($_POST as $key => $value) {
    if (empty($value)) {
        $error[] = $key;
    }
}

if (count($error) != 0) {
    exit(json_encode(array('type' => 'validasi', 'error' => $error)));
} else {
    $update = $pdo->Update('tb_kriteria', 'id_kriteria', $idk, ['kode', 'kriteria', 'type', 'bobot'], [$kde, $nma, $tpe, $bot]);

    if ($update == 1) {
        exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
    } else {
        exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
    }
}