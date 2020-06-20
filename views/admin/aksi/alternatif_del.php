<?php
$id = $_POST['id'];
// untuk fungsi delete parameternya (nama_tabel, id, id_value)
$delete = $pdo->Delete("tb_alternatif", "id_alternatif", $id);

if ($delete == 1) {
  exit(json_encode(array('text' => 'Data telah dapat dihapus.', 'type' => 'success')));
} else {
  exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak dapat dihapus.', 'type' => 'error', 'button' => 'Ok!')));
}