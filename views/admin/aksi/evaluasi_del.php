<?php
$id = $_POST['id'];
$delete = $pdo->Delete("tb_evaluasi", "id_alternatif", $id);

if ($delete == 1) {
  exit(json_encode(array('text' => 'Data telah dapat dihapus.', 'type' => 'success')));
} else {
  exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak dapat dihapus.', 'type' => 'error', 'button' => 'Ok!')));
}