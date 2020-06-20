<?php
$ida = strip_tags($_POST['inpidalternatif']);
$nma = strip_tags($_POST['inpnama']);

$update = $pdo->Update('tb_alternatif', 'id_alternatif', $ida, ['alternatif'], [$nma]);

if ($update == 1) {
  exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
} else {
  exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
}