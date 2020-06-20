<div class="pcoded-content">
  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper">
        <div class="page-header">
          <div class="row align-items-end">
            <div class="col-lg-8">
              <div class="page-header-title">
                <div class="d-inline">
                  <h4>Gejala</h4>
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
                    <a href="#!">Gejala</a>
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
                  <form action="aksi/?aksi=poin_add" id="form-add">

                    <input type="hidden" id="inpidpoin">

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Poin *</label>
                      <div class="col-sm-10">
                        <input type="text" name="inppoin" id="inppoin" class="form-control" placeholder="Masukkan poin">
                        <div id="error"></div>
                      </div>
                    </div>
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
                          <th>Aksi</th>
                          <th>Poin</th>
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
                              <td><?= $row->poin; ?></td>
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