<?php
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
  $insert = $pdo->Insert("tb_poin", ["kd_poin", "poin", "kt_poin"], [$kd, $po, $kt]);

  if ($insert == 1) {
    exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data ditambah.', 'type' => 'success', 'button' => 'Ok!')));
  } else {
    exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data gagal ditambah.', 'type' => 'success', 'button' => 'Ok!')));
  }
}
