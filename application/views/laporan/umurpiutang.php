<?php
  $this->load->model('Tabledx');
?>

<div class="content-wrapper">

  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0 text-dark">Umur Piutang</h1>
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
                  <div class="col-sm-4">
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
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="">Pilih range awal</label>
                      <?php if (isset($date1)): ?>
                          <input id="date1" type="date" class="form-control" value="<?= $date1; ?>">
                        <?php else: ?>
                          <input id="date1" type="date" readonly class="form-control">
                    <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for=""></label>
                      <button id="go-filter" type="button" class="form-control btn btn-primary">Filter</button>
                    </div>
                  </div>
                  <script type="text/javascript">
                  $(document).ready(function(){
                    document.getElementById('type-filter').addEventListener('change', function(){
                      if(this.value == 1){
                          location.href = '<?= site_url('admin/umur-piutang/hari-ini') ?>';
                      }
                      if(this.value == 2){
                        location.href = '<?= site_url('admin/umur-piutang/bulan-ini') ?>';
                      }
                      if(this.value == 3){
                          document.getElementById('date1').removeAttribute('readonly');
                          document.getElementById('date2').removeAttribute('readonly');
                      }
                    },false)
                    document.getElementById('go-filter').addEventListener('click', function(){
                      var a = document.getElementById('date1').value;
                      if (a != '') {
                        location.href = '<?= site_url('admin/umur-piutang/custome/') ?>'+a;
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

                  $cekpiutang = '';

                  if ($type == 1) {
                    $cekpiutang = 'CURRENT_DATE ()';
                  }elseif($type == 2){
                    $hari_ini = date("Y-m-d");
                    $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
                    $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));
                    $cekpiutang = "'$tgl_terakhir'";
                  }elseif($type == 3){
                    $cekpiutang = "'$date1'";
                  }
                    $tr = new Tabledx;
                    $tr->table('penjualan');
                    $tr->condition([
                      "hutang" => [
                        "opsi" => "IS NOT",
                        "val" => "NULL"
                      ],
                      "hutang" => [
                        "opsi" => "<>",
                        "val" => "0"
                      ],
                      "hutang" => [
                        "opsi" => "<>",
                        "val" => ""
                      ],
                      "tanggal" => [
                        "opsi" => "<=",
                        "val" => str_replace("'", "", $cekpiutang)
                      ]
                    ]);
                    $tr->select(" DISTINCT(kode) as kode ");
                  ?>
                  <table class="table">
                    <tr style="background-color: #4c8bf5; color: white;">
                      <th>Customer</th>
                      <th>Total</th>
                      <th>1-30</th>
                      <th>31-60</th>
                      <th>60-90</th>
                      <th> > 90</th>
                    </tr>
                    <?php foreach ($tr->getResult() as $key => $value): ?>
                      <?php
                      $ts = new Tabledx;
                      $ts->table("kontak");
                      $ts->condition([
                        "id" => $value->kode
                      ]);

                      $qa = "
                        SELECT
                          sum(hutang) as total
                        FROM
                        penjualan
                        WHERE
                        kode = '$value->kode'
                        AND delete_set = '0'
                        AND tanggal <= $cekpiutang
                      ";

                      $qr = "
                        SELECT
                          sum(hutang) as total
                        FROM
                        penjualan
                        WHERE
                        kode = '$value->kode'
                        AND delete_set = '0'
                        AND TIMESTAMPDIFF( DAY, '2021-07-06', $cekpiutang ) > 0
                        AND TIMESTAMPDIFF( DAY, '2021-07-06', $cekpiutang ) <= 30
                      ";

                      $qr2 = "
                        SELECT
                          sum(hutang) as total
                        FROM
                        penjualan
                        WHERE
                        kode = '$value->kode'
                        AND delete_set = '0'
                        AND TIMESTAMPDIFF( DAY, '2021-07-06', $cekpiutang ) > 30
                        AND TIMESTAMPDIFF( DAY, '2021-07-06', $cekpiutang ) <= 60
                      ";

                      $qr3 = "
                        SELECT
                          sum(hutang) as total
                        FROM
                        penjualan
                        WHERE
                        kode = '$value->kode'
                        AND delete_set = '0'
                        AND TIMESTAMPDIFF( DAY, '2021-07-06', $cekpiutang ) > 60
                        AND TIMESTAMPDIFF( DAY, '2021-07-06', $cekpiutang ) <= 90
                      ";

                      $qr4 = "
                        SELECT
                          sum(hutang) as total
                        FROM
                        penjualan
                        WHERE
                        kode = '$value->kode'
                        AND delete_set = '0'
                        AND TIMESTAMPDIFF( DAY, '2021-07-06', $cekpiutang ) > 90
                      ";

                        $ad = 0;
                        $aa = 0;
                        $a1 = 0;
                        $a2 = 0;
                        $a3 = 0;
                        if ($this->db->query($qa)->row() != NULL) {
                          $ad = $this->db->query($qa)->row()->total;
                        }
                        if ($this->db->query($qr)->row() != NULL) {
                          $aa = $this->db->query($qr)->row()->total;
                        }
                        if ($this->db->query($qr2)->row() != NULL) {
                          $a1 = $this->db->query($qr2)->row()->total;
                        }
                        if ($this->db->query($qr3)->row() != NULL) {
                          $a2 = $this->db->query($qr3)->row()->total;
                        }
                        if ($this->db->query($qr4)->row() != NULL) {
                          $a3 = $this->db->query($qr4)->row()->total;
                        }

                       ?>
                      <tr>
                        <td><?= $ts->row("nama_panggilan"); ?></td>
                        <td>Rp <?= rupiah($ad); ?></td>
                        <td>Rp <?= rupiah($aa); ?></td>
                        <td>Rp <?= rupiah($a1); ?></td>
                        <td>Rp <?= rupiah($a2); ?></td>
                        <td>Rp <?= rupiah($a3); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>
