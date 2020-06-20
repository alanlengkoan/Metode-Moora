<?php
$po = strip_tags($_POST['inppoin']);

$error = [];
foreach ($_POST as $key => $value) {
  if (empty($value)) {
    $error[] = $key;
  }
}

if (count($error) != 0) {
  exit(json_encode(array('type' => 'validasi', 'error' => $error)));
} else {
  $insert = $pdo->Insert("tb_poin", ["poin"], [$po]);

  if ($insert == 1) {
    exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data ditambah.', 'type' => 'success', 'button' => 'Ok!')));
  } else {
    exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data gagal ditambah.', 'type' => 'success', 'button' => 'Ok!')));
  }
}
