<?php
$id    = strip_tags($_POST['inpidevaluasi']);
$kde_d = strip_tags($_POST['inpkddiagnosa']);
$kde_g = strip_tags($_POST['inpkdgejala']);
$cf    = strip_tags($_POST['inpcf']);

$update = $pdo->Update('tb_evaluasi', 'id_evaluasi', $id, ['kd_diagnosa', 'kd_gejala', 'cf'], [$kde_d, $kde_g, $cf]);

if ($update == 1) {
    exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
} else {
    exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
}