<?php
$id = strip_tags($_POST['inpidusers']);
$nm = strip_tags($_POST['inpnama']);
$em = strip_tags($_POST['inpemail']);
$us = strip_tags($_POST['inpusername']);
$dt = date("Y-m-d H:i:s");

if (isset($_POST['inppassword1']) || isset($_POST['inppassword2'])) {
    $p1 = strip_tags($_POST['inppassword1']);
    $p2 = strip_tags($_POST['inppassword2']);

    $ph = password_hash($p2, PASSWORD_DEFAULT);
    
    $update = $pdo->Update('tb_users', 'id_users', $id, ["nama", "email", "username", "password", "modified"], [$nm, $em, $us, $ph, $dt]);

    if ($update == 1) {
        exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
    } else {
        exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
    }
} else {
    $update = $pdo->Update('tb_users', 'id_users', $id, ["nama", "email", "username", "modified"], [$nm, $em, $us, $dt]);
    
    if ($update == 1) {
        exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
    } else {
        exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
    }
}
