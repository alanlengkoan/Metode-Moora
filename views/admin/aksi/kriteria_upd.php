<?php
$idk = strip_tags($_POST['inpidkriteria']);
$nma = strip_tags($_POST['inpnama']);
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
    $update = $pdo->Update('tb_kriteria', 'id_kriteria', $idk, ['nama_kriteria', 'bobot'], [$nma, $bot]);

    if ($update == 1) {
        exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
    } else {
        exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
    }
}