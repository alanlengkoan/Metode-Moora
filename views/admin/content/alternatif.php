<h2>From</h2>

<form action="aksi/?aksi=alternatif_add" id="form-add">

  <input type="hidden" id="inpidalternatif">

  <table>
    <tr>
      <td>Nama *</td>
      <td>
        <input type="text" name="inpnama" id="inpnama" class="form-control" placeholder="Masukkan nama alternatif">
      </td>
    </tr>
    <tr>
      <td>
        <button type="submit" name="add" id="add"> Add</button>
      </td>
    </tr>
  </table>
</form>

<h2>Tabel</h2>

<table border="1">
  <thead>
    <tr>
      <th>No</th>
      <th>Aksi</th>
      <th>Alternatif</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query  = $pdo->GetAll('tb_alternatif', 'id_alternatif');
    $jumlah = $query->rowCount();
    $no = 1;
    if ($jumlah > 0) {
      while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
        <tr>
          <td align="center"><?= $no++; ?></td>
          <td align="center">
            <button id="upd" data-id="<?= $row->id_alternatif ?>"> Ubah</button>&nbsp;
            <button id="del" data-id="<?= $row->id_alternatif ?>"> Hapus</button>
          </td>
          <td><?= $row->alternatif; ?></td>
        </tr>
      <?php } ?>
    <?php } ?>
    </Aksi>