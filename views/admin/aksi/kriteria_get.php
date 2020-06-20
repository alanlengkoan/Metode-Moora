<?php
$id     = $_POST['id'];
$query  = $pdo->GetWhere('tb_kriteria', 'id_kriteria', $id);
$row    = $query->fetch(PDO::FETCH_OBJ);

$result = [];
$result = [
    "id_kriteria" => $row->id_kriteria,
    "kode"        => $row->kode,
    "kriteria"    => $row->kriteria,
    "type"        => $row->type,
    "bobot"       => $row->bobot,
];

echo json_encode($result);
