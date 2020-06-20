<?php
$id = $_POST['id'];
// untuk fungsi delete parameternya (nama_tabel, id, id_value)
$delete = $pdo->Delete("tb_kriteria", "id_kriteria", $id);

if ($delete == 1) {
  exit(json_encode(array('text' => 'Data telah dihapus.', 'type' => 'success')));
} else {
  exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak dapat dihapus.', 'type' => 'error', 'button' => 'Ok!')));
}