<?php
$result = [];
$id     = $_POST['id'];
$query  = $pdo->GetWhere('tb_evaluasi', 'id_evaluasi', $id);
$row    = $query->fetch(PDO::FETCH_OBJ);

$result = [
    "id_evaluasi" => $row->id_evaluasi,
    "kd_diagnosa" => $row->kd_diagnosa,
    "kd_gejala"   => $row->kd_gejala,
    "cf"          => $row->cf,
];

echo json_encode($result);
