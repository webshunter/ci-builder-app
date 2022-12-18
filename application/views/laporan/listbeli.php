<?php
  $this->load->model('Tabledx');
?>

<div class="content-wrapper">

  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0 text-dark">List Pembelian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
          </div><!-- /.row -->
      </div>
    </div>
    <section style="padding: 18px; padding-right: 18px;">
        <div class="container-fluid">
          <div class="row">
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box bg-white" style="padding: 10px;">
              <div class="container">
                <div class="row d-flex align-items-center">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="">Pilih kategori filter</label>

                        <?php $pilihan = [
                          "1" => "hari ini",
                          "2" => "Bulan ini",
                          "3" => "Custome"
                        ]; ?>

                      <select id="type-filter" name="filter" class="form-control">
                        <?php foreach ($pilihan as $key => $value): ?>
                          <?php if ($type == $key): ?>
                            <option selected value="<?= $key ?>"><?= $value ?></option>
                            <?php else: ?>
                              <option value="<?= $key ?>"><?= $value ?></option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="">Pilih range awal</label>
                      <?php if (isset($date2)): ?>
                          <input id="date1" type="date" class="form-control" value="<?= $date1; ?>">
                        <?php else: ?>
                          <input id="date1" type="date" readonly class="form-control">
                    <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="">Pilih range akhir</label>
                      <?php if (isset($date2)): ?>
                          <input id="date2" type="date" class="form-control" value="<?= $date2 ?>">
                        <?php else: ?>
                          <input id="date2" type="date" readonly class="form-control">
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for=""></label>
                      <button id="go-filter" type="button" class="form-control btn btn-primary">Filter</button>
                    </div>
                  </div>
                  <script type="text/javascript">
                  $(document).ready(function(){

                    document.getElementById('type-filter').addEventListener('change', function(){

                      if(this.value == 1){
                          location.href = '<?= site_url('admin/list-pembelian/hari-ini') ?>';
                      }

                      if(this.value == 2){
                        location.href = '<?= site_url('admin/list-pembelian/bulan-ini') ?>';
                      }

                      if(this.value == 3){
                          document.getElementById('date1').removeAttribute('readonly');
                          document.getElementById('date2').removeAttribute('readonly');
                      }

                    },false)

                    document.getElementById('go-filter').addEventListener('click', function(){
                      var a = document.getElementById('date1').value;
                      var b = document.getElementById('date2').value;

                      if (a != '' && b != '') {
                        location.href = '<?= site_url('admin/list-pembelian/custome/') ?>'+a+'/'+b;
                      }else{
                          alert('lengkapi data terlebih dahulu');
                      }

                    },false)

                  })

                  </script>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
    </section>
    <section style="padding-left: 18px; padding-right: 18px;">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-12">
              <div class="small-box bg-white">
                <div class="inner">
                  <?php
                    $tr = new Tabledx;
                    $tr->table('pembelian');
                    $tr->select(" * ");
                  ?>
                  <?php
                  if ($type == 1) {
                    $tr->condition([
                      "tanggal" => date('Y-m-d')
                    ]);
                  }elseif ($type == 2) {
                    $tr->condition([
                      "tanggal" => [
                        "opsi" => "LIKE",
                        "val" => date('Y-m')."%"
                      ]
                    ]);
                  }elseif ($type == 3) {
                    $tr->condition([
                      "tanggal" => [
                        "opsi" => ">=",
                        "val" => $date1
                      ],
                      "tanggal" => [
                        "opsi" => "<=",
                        "val" => $date2
                      ]
                    ]);
                  }
                  ?>
                  <table class="table">
                    <tr style="background-color: #4c8bf5; color: white;">
                      <th>Tanggal</th>
                      <th>No Transaksi</th>
                      <th>Customer</th>
                      <th>alamat</th>
                      <th>Total</th>
                    </tr>
                    <?php foreach ($tr->getResult() as $key => $value): ?>
                      <tr>
                        <td><?= $value->tanggal ?></td>
                        <td><?= $value->no_nota ?></td>
                        <td><?= $value->nama ?></td>
                        <td><?= $value->alamat ?></td>
                        <td>Rp <?= rupiah($value->subtotal) ?></td>
                      </tr>
                    <?php endforeach; ?>

                    <?php

                    $tr->select(' SUM(subtotal) as total ');

                     ?>

                    <tr>
                      <td colspan="4" style="text-align:right;">Total</td>
                      <td>Rp <?= rupiah($tr->row('total')); ?></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>
