<?php
  $this->load->model('Tabledx');
?>

<div class="content-wrapper">

  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">List Produk</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
  </div>


<?php

$tr = new Tabledx;
$tr->table('produk');

?>

  <div class="content">
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>kode</th>
              <th>Nama Produk</th>
              <th>Deskripsi</th>
              <th class="text-center">#</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($tr->getResult() as $key => $sk): ?>
              <tr>
                <td><?= $key + 1; ?></td>
                <td><?= $sk->kode ?></td>
                <td><?= $sk->nama ?></td>
                <td><?= $sk->deskripsi ?></td>
                <td class="text-center">
                  <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton<?= $key ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Tindakan
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $key ?>">
                          <a data-id='{{id}}' class="dropdown-item edit" href="#"><i class='fas fa-edit'></i> Detail Produk</a>
                      </div>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
