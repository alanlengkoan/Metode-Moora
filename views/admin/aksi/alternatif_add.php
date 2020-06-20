<?php
$nma = strip_tags($_POST['inpnama']);

// untuk fungsi INSERT parameternya (nama_tabel, nama_kolom, nama_value/nama_hasil)
$insert = $pdo->Insert("tb_alternatif", ["alternatif"], [$nma]);

if ($insert == 1) {
  exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data ditambah.', 'type' => 'success', 'button' => 'Ok!')));
} else {
  exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data gagal ditambah.', 'type' => 'success', 'button' => 'Ok!')));
}