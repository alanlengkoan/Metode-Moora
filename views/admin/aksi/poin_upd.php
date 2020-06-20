<?php
$idp = strip_tags($_POST['inpidpoin']);
$po  = strip_tags($_POST['inppoin']);

$error = [];
foreach ($_POST as $key => $value) {
  if (empty($value)) {
    $error[] = $key;
  }
}

if (count($error) != 0) {
  exit(json_encode(array('type' => 'validasi', 'error' => $error)));
} else {
  $update = $pdo->Update('tb_poin', 'id_poin', $idp, ['poin'], [$po]);

  if ($update == 1) {
    exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
  } else {
    exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
  }
}