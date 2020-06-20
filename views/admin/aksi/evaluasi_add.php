<?php
$id_a = strip_tags($_POST['inpidalternatif']);
$id_k = array_map("strip_tags", $_POST['inpidkriteria']);
$nil  = array_map("strip_tags", $_POST['inpnilai']);

$error = [];
foreach ($_POST as $key => $value) {
  if (empty($value)) {
    $error[] = $key;
  }
  if (is_array($value)) {
    for ($c = 0; $c < count($value); $c++) {
      $check_value_arr = trim($value[$c]);
      if (empty($check_value_arr)) {
        $error[] = $c;
      }
    }
  }
}

if (count($error) != 0) {
  exit(json_encode(array('type' => 'validasi', 'error' => $error)));
} else {
  for ($i = 0; $i < count($id_k); $i++) {
    $insert = $pdo->Insert("tb_evaluasi", ["id_alternatif", "id_kriteria", "nilai"], [$id_a, $id_k[$i], $nil[$i]]);
  }

  if ($insert == 1) {
    exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data ditambah.', 'type' => 'success', 'button' => 'Ok!')));
  } else {
    exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data gagal ditambah.', 'type' => 'success', 'button' => 'Ok!')));
  }
}
