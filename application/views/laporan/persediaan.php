<?php

  $this->load->model('Tabledx');


 ?>
<div class="content-wrapper">
  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0 text-dark">Laporan Persediaan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>

  <div class="content">
    <div class="card">
      <div class="card-body">

        <?php

          $tr = new Tabledx;

          $tr->table('produk');

         ?>

        <div style="overflow-x: auto;">
          <table width="100%" class="table table-bordered">
            <thead>
              <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Unit/ Satuan</th>
                <th>Stok Awal</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($tr->getResult() as $key => $value): ?>
                <tr>
                  <td><?= $value->kode ?></td>
                  <td><?= $value->nama ?></td>
                  <td><?= $value->nama ?></td>
                  <td><?= $value->nama ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

</div>
