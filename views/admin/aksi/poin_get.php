<?php
$id     = $_POST['id'];
$query  = $pdo->GetWhere('tb_poin', 'id_poin', $id);
$row    = $query->fetch(PDO::FETCH_OBJ);

$result = [];
$result = [
    "id_poin" => $row->id_poin,
    "poin"    => $row->poin,
];

echo json_encode($result);
