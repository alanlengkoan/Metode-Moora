<?php
$id   = $_POST['id'];
$qry1 = $pdo->GetWhere('tb_evaluasi', 'id_alternatif', $id);
$qry2 = $pdo->GetWhere('tb_evaluasi', 'id_alternatif', $id);

$result = [];
$row = $qry1->fetch(PDO::FETCH_OBJ);
$result['id_alternatif'] = $row->id_alternatif;

while ($rows = $qry2->fetch(PDO::FETCH_OBJ)) {
    $result['detail'][] = [
        "id_kriteria" => $rows->id_kriteria,
        "nilai" => $rows->nilai,
    ];
}

// echo '<pre>';
// print_r($result);
echo json_encode($result);