<?php
$id     = $_POST['id'];
$query  = $pdo->GetWhere('tb_poin', 'id_poin', $id);
$row    = $query->fetch(PDO::FETCH_OBJ);

$result = [];
$result = [
    "id_poin" => $row->id_poin,
    "kd_poin" => $row->kd_poin,
    "poin"    => $row->poin,
    "kt_poin" => $row->kt_poin,
];

echo json_encode($result);
