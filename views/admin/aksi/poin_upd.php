<?php
$id = strip_tags($_POST['inpidpoin']);
$kd = strip_tags($_POST['inpkdpoin']);
$po = strip_tags($_POST['inppoin']);
$kt = strip_tags($_POST['inpketerangan']);

$error = [];
foreach ($_POST as $key => $value) {
  if (empty($value)) {
    $error[] = $key;
  }
}

if (count($error) != 0) {
  exit(json_encode(array('type' => 'validasi', 'error' => $error)));
} else {
  $update = $pdo->Update('tb_poin', 'id_poin', $id, ['kd_poin', 'poin', 'kt_poin'], [$kd, $po, $kt]);

  if ($update == 1) {
    exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
  } else {
    exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
  }
}