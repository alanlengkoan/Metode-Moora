<?php
$result = [];
$id     = $_POST['id'];
$query  = $pdo->GetWhere('tb_alternatif', 'id_alternatif', $id);
$row    = $query->fetch(PDO::FETCH_OBJ);

$result = [
    "id_alternatif" => $row->id_alternatif,
    "alternatif"    => $row->alternatif,
];

echo json_encode($result);
