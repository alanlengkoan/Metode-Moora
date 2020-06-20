<!-- begin:: form -->
<h2>Form</h2>

<form action="aksi/?aksi=kriteria_add" id="form-add">

  <input type="hidden" id="inpidkriteria">

  <table>
    <tr>
      <td>Kode</td>
      <td>
        <input type="text" name="inpkode" id="inpkode" placeholder="Masukkan nama kode">
        <div id="error"></div>
      </td>
    </tr>
    <tr>
      <td>Kriteria *</td>
      <td>
        <input type="text" name="inpnama" id="inpnama" placeholder="Masukkan nama kriteria">
        <div id="error"></div>
      </td>
    </tr>
    <tr>
      <td>Type *</td>
      <td>
        <select name="inptype" id="inptype">
          <option value="">- Pilih -</option>
          <option value="Benefit">Benefit</option>
          <option value="Cost">Cost</option>
        </select>
        <div id="error"></div>
      </td>
    </tr>
    <tr>
      <td>Bobot *</td>
      <td>
        <input type="text" name="inpbobot" id="inpbobot" placeholder="Masukkan bobot">
        <div id="error"></div>
      </td>
    </tr>
    <tr>
      <td>
        <button type="submit" name="add" id="add">Add</button>
      </td>
    </tr>
  </table>
</form>
<!-- end:: form -->

<!-- begin:: tabel -->
<h2>Tabel</h2>
<table border="1">
  <thead>
    <tr>
      <th>No</th>
      <th>Aksi</th>
      <th>Kode</th>
      <th>Nama</th>
      <th>Type</th>
      <th>Bobot</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query  = $pdo->GetAll('tb_kriteria', 'id_kriteria');
    $jumlah = $query->rowCount();
    $no = 1;
    if ($jumlah > 0) {
      while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
        <tr>
          <td align="center"><?= $no++; ?></td>
          <td align="center">
            <button class="btn btn-primary btn-sm" id="upd" data-id="<?= $row->id_kriteria ?>"><i class="fa fa-edit"></i> Ubah</button>&nbsp;
            <button class="btn btn-danger btn-sm" id="del" data-id="<?= $row->id_kriteria ?>"><i class="fa fa-trash"></i> Hapus</button>
          </td>
          <td align="center"><?= $row->kode; ?></td>
          <td align="center"><?= $row->kriteria; ?></td>
          <td align="center"><?= $row->type; ?></td>
          <td align="center"><?= $row->bobot; ?></td>
        </tr>
      <?php } ?>
    <?php } ?>
  </tbody>
</table>
<!-- end:: tabel -->