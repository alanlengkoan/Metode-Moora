<?php
$id_a = strip_tags($_POST['inpidalternatif']);
$id_k = array_map("strip_tags", $_POST['inpidkriteria']);
$nil  = array_map("strip_tags", $_POST['inpnilai']);

for ($i = 0; $i < count($id_k); $i++) {
    $sql = "UPDATE tb_evaluasi SET nilai = $nil[$i] WHERE id_kriteria = '$id_k[$i]' AND id_alternatif = '$id_a'";
    $qry = $pdo->Query($sql);
}

exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));