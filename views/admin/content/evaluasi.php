<div class="pcoded-content">
  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper">
        <div class="page-header">
          <div class="row align-items-end">
            <div class="col-lg-8">
              <div class="page-header-title">
                <div class="d-inline">
                  <h4>Evaluasi</h4>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                  <li class="breadcrumb-item">
                    <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="#!">Evaluasi</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="page-body">
          <div class="row">
            <div class="col-sm-12">
              <!-- begin:: form -->
              <div class="card">
                <div class="card-header">
                  <h5>Form</h5>
                </div>
                <div class="card-block">
                  <form action="aksi/?aksi=evaluasi_add" id="form-add">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Puskesmas *</label>
                      <div class="col-sm-10">
                        <select name="inpidalternatif" id="inpidalternatif" class="form-control">
                          <option value="">- Pilih -</option>
                          <?php
                          $query = $pdo->GetAll('tb_alternatif', 'id_alternatif');
                          while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                            <option value="<?= $row->id_alternatif ?>"><?= $row->nama_alternatif ?></option>
                          <?php } ?>
                        </select>
                        <div id="error"></div>
                      </div>
                    </div>
                    <?php
                    $query1 = $pdo->GetAll('tb_kriteria', 'id_kriteria');
                    while ($row_k = $query1->fetch(PDO::FETCH_OBJ)) { ?>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><?= $row_k->nama_kriteria ?> *</label>
                        <div class="col-sm-10">
                          <input type="hidden" name="inpidkriteria[]" value="<?= $row_k->id_kriteria ?>" readonly="readonly" />
                          <select name="inpnilai[]" id="inpnilai" class="form-control">
                            <option value="">- Pilih -</option>
                            <?php
                            $query2 = $pdo->GetAll('tb_poin', 'id_poin');
                            while ($row_p = $query2->fetch(PDO::FETCH_OBJ)) { ?>
                              <option value="<?= $row_p->poin ?>"><?= $row_p->poin ?></option>
                            <?php } ?>
                          </select>
                          <div id="error"></div>
                        </div>
                      </div>
                    <?php } ?>
                    <button type="submit" name="add" id="add" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</button>
                  </form>
                </div>
              </div>
              <!-- end:: form -->

              <!-- begin:: tabel -->
              <div class="card">
                <div class="card-header">
                  <h5>Tabel</h5>
                </div>
                <div class="card-block">
                  <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Alternatif</th>
                          <th>Kriteria</th>
                          <th>Bobot</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql    = "SELECT tb_evaluasi.id_evaluasi, tb_alternatif.nama_alternatif, tb_kriteria.nama_kriteria, tb_evaluasi.nilai FROM tb_evaluasi INNER JOIN tb_alternatif ON tb_evaluasi.id_alternatif = tb_alternatif.id_alternatif INNER JOIN tb_kriteria ON tb_evaluasi.id_kriteria = tb_kriteria.id_kriteria";
                        $query  = $pdo->Query($sql);
                        $jumlah = $query->rowCount();
                        $no = 1;
                        if ($jumlah > 0) {
                          while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                            <tr>
                              <td align="center"><?= $no++; ?></td>
                              <td><?= $row->nama_alternatif; ?></td>
                              <td><?= $row->nama_kriteria; ?></td>
                              <td><?= $row->nilai; ?></td>
                            </tr>
                          <?php } ?>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- end:: tabel -->
            </div>
          </div>
        </div>
      </div>
      <div id="styleSelector">

      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>