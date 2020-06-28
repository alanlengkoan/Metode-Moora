<h2>Form</h2>

<form action="aksi/?aksi=poin_add" id="form-add">

  <input type="hidden" id="inpidpoin">

  <table>
    <tr>
      <td>Kode *</td>
      <td>
        <input type="text" name="inpkdpoin" id="inpkdpoin" placeholder="Masukkan kode">
      </td>
    </tr>
    <tr>
      <td>Poin *</td>
      <td>
        <input type="text" name="inppoin" id="inppoin" placeholder="Masukkan poin">
      </td>
    </tr>
    <tr>
      <td>Keterangan *</td>
      <td>
        <input type="text" name="inpketerangan" id="inpketerangan" placeholder="Masukkan keterangan">
      </td>
    </tr>
    <tr>
      <td>
        <button type="submit" name="add" id="add" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</button>
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
      <th>Kode</th>
      <th>Poin</th>
      <th>Keterangan</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query  = $pdo->GetAll('tb_poin', 'id_poin');
    $jumlah = $query->rowCount();
    $no = 1;
    if ($jumlah > 0) {
      while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
        <tr>
          <td><?= $no++; ?></td>
          <td align="center">
            <button class="btn btn-primary btn-sm" id="upd" data-id="<?= $row->id_poin ?>"><i class="fa fa-edit"></i> Ubah</button>&nbsp;
            <button class="btn btn-danger btn-sm" id="del" data-id="<?= $row->id_poin ?>"><i class="fa fa-trash"></i> Hapus</button>
          </td>
          <td><?= $row->kd_poin; ?></td>
          <td><?= $row->poin; ?></td>
          <td><?= $row->kt_poin; ?></td>
        </tr>
      <?php } ?>
    <?php } ?>
  </tbody>
</table>