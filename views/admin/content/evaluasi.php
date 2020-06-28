<h2>Form</h2>

<!-- begin:: form -->
<form action="aksi/?aksi=evaluasi_add" id="form-add">
  <table>
    <tr>
      <td>Alternatif *</td>
      <td>
        <select name="inpidalternatif" id="inpidalternatif" class="form-control">
          <option value="">- Pilih -</option>
          <?php
          $query = $pdo->GetAll('tb_alternatif', 'id_alternatif');
          while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
            <option value="<?= $row->id_alternatif ?>"><?= $row->alternatif ?></option>
          <?php } ?>
        </select>
        <div id="error"></div>
      </td>
    </tr>
    <?php
    $query1 = $pdo->GetAll('tb_kriteria', 'id_kriteria');
    while ($row_k = $query1->fetch(PDO::FETCH_OBJ)) { ?>
      <tr>
        <td><?= $row_k->kriteria ?> *</td>
        <td>
          <input type="hidden" name="inpidkriteria[]" value="<?= $row_k->id_kriteria ?>" readonly="readonly" />
          <select name="inpnilai[]" id="inpnilai" class="form-control">
            <option value="">- Pilih -</option>
            <?php
            $query2 = $pdo->GetAll('tb_poin', 'id_poin');
            while ($row_p = $query2->fetch(PDO::FETCH_OBJ)) { ?>
              <option value="<?= $row_p->poin ?>"><?= $row_p->kt_poin ?></option>
            <?php } ?>
          </select>
          <div id="error"></div>
        </td>
      </tr>
    <?php } ?>
    <tr>
      <td>
        <button type="submit" name="add" id="add" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</button>
      </td>
    </tr>
  </table>
</form>
<!-- end:: form -->

<h2>Tabel</h2>
<!-- begin:: tabel -->
<table border="1">
  <thead>
    <tr>
      <th>No</th>
      <th>Aksi</th>
      <th>Alternatif</th>
      <?php
      $query1 = $pdo->GetAll('tb_kriteria', 'id_kriteria');
      while ($row_k = $query1->fetch(PDO::FETCH_OBJ)) { ?>
        <th><?= $row_k->kriteria ?></th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $query1 = $pdo->GetAll('tb_kriteria', 'id_kriteria');
    $sum = $query->rowCount();
    if ($sum > 0) {
      $case1 = '';
      $case2 = '';

      while ($row_k = $query1->fetch(PDO::FETCH_OBJ)) {
        $hilangkan_spasi = str_replace(' ', '_', $row_k->kriteria);
        $case1 .= "SUM($hilangkan_spasi) AS '$row_k->kriteria',";
        $case2 .= "CASE WHEN id_kriteria = '$row_k->id_kriteria' THEN nilai END AS $hilangkan_spasi,";
      }

      $hapus_karakter1 = substr($case1, 0, -1);
      $hapus_karakter2 = substr($case2, 0, -1);
      $sql = "SELECT a.id_alternatif, tb_alternatif.alternatif, $hapus_karakter1 FROM (SELECT id_alternatif, $hapus_karakter2 FROM tb_evaluasi) AS a INNER JOIN tb_alternatif ON a.id_alternatif = tb_alternatif.id_alternatif  GROUP BY a.id_alternatif";
      $qry = $pdo->Query($sql);
      $sum = $qry->rowCount();
      $no = 1;

      while ($row_s = $qry->fetch(PDO::FETCH_OBJ)) { ?>
        <tr>
          <td align="center"><?= $no++; ?></td>
          <td>
            <button class="btn btn-primary btn-sm" id="upd" data-id="<?= $row_s->id_alternatif ?>"><i class="fa fa-edit"></i> Ubah</button>&nbsp;
            <button class="btn btn-danger btn-sm" id="del" data-id="<?= $row_s->id_alternatif ?>"><i class="fa fa-trash"></i> Hapus</button>
          </td>
          <td><?= $row_s->alternatif ?></td>
          <?php
          $qry2 = $pdo->GetAll('tb_kriteria', 'id_kriteria');
          while ($row_k = $qry2->fetch(PDO::FETCH_OBJ)) {
            $key = $row_k->kriteria; ?>
            <td><?= $row_s->$key ?></td>
          <?php } ?>
        </tr>
      <?php } ?>
    <?php } ?>
  </tbody>
</table>
<!-- end:: tabel -->