<?php
  $this->load->model('Tabledx');
?>

<div class="content-wrapper">

  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0 text-dark">Jurnal</h1>
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
                          location.href = '<?= site_url('admin/laporan-jurnal/hari-ini') ?>';
                      }

                      if(this.value == 2){
                        location.href = '<?= site_url('admin/laporan-jurnal/bulan-ini') ?>';
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
                        location.href = '<?= site_url('admin/laporan-jurnal/custome/') ?>'+a+'/'+b;
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

    <section style="padding-left: 18px; padding-right: 18px;">
        <div class="container-fluid">
          <div class="row">

            <?php if ($tr->num_rows() != 0): ?>
              <div class="col-lg-12 col-12">
                <div class="small-box bg-white">
                  <div class="inner">
                    <h5 style="font-weight: bold;">Jurnal Pembelian <span class="float-right">( <?= $tr->num_rows() ?> Transaksi )</span></h5>
                    <table class="table">
                      <tr style="background-color: #4c8bf5; color: white;">
                        <th>Akun</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                      </tr>
                      <?php foreach ($tr->getResult() as $key => $fr): ?>
                        <tr style="background: #dff;">
                          <td colspan="3"><span style="color:#4c8bf5; font-weight: bold;">Journal Entry <?= $fr->no_nota ?></span> | <span style="color:#333; font-weight: bold;"> ( Create On <?= $fr->created_at ?> ) </span> </td>
                        </tr>
                        <?php
                          $tc = new Tabledx;
                          $tc->table('datapembelian');
                          $tc->condition([
                            "pembelian_id" => $fr->id
                          ]);
                          $tax = 1;
                          $nomBar = 0;
                          $akunbeli = null;
                        ?>
                        <?php foreach ($tc->getResult() as $key => $fc): ?>
                          <?php
                            $fp = new Tabledx;
                            $fp->table('produk');
                            $fp->condition([
                              "id" => $fc->produk
                            ]);
                            $akunbeli = $fp->row("akun_pembelian");
                           ?>
                          <tr>
                            <td>(1-10200) - Persediaan Barang <br> <?= $fp->row('nama') ?></td>
                            <td>Rp. <?= rupiah($fc->jumlah) ?></td>
                            <td>Rp. 0,00</td>
                          </tr>
                          <?php
                            $tax = $fp->row('pajak_pembelian');
                            $nomBar += $fc->jumlah;
                           ?>
                        <?php endforeach; ?>
                        <?php if ($fr->pajak != NULL): ?>
                          <?php

                          $pajak = new Tabledx;
                          $pajak->table('pajak');
                          $pajak->condition([
                            "id" => $tax
                          ]);

                          $akun = new Tabledx;
                          $akun->table("akun");
                          $akun->condition([
                            "id" => $pajak->row("akun_pajak_pembelian")
                          ]);

                          ?>
                          <tr>
                            <td> <?= '('.$akun->row('kode_akun').') - '.$akun->row('nama_akun') ?></td>
                            <td>Rp. <?= rupiah($fr->total * ($pajak->row('persentase_efektif') / 100)); ?></td>
                            <td>Rp. 0,00</td>
                          </tr>
                        <?php endif; ?>
                        <?php
                        $akun = new Tabledx;
                        $akun->table("akun");
                        ?>
                        <?php if($fr->ongkir != null) : ?>
                            <tr>
                              <?php
                                $akun->condition([
                                  "id" => setting('akun-ongkir')
                                ]);
                              ?>
                              <td><?= '('.$akun->row('kode_akun').') - '.$akun->row('nama_akun') ?></td>
                              <td>Rp. <?= rupiah($fr->ongkir); ?></td>
                              <td>Rp. 0,00</td>
                            </tr>
                        <?php endif; ?>
                        <?php if($fr->diskon_faktur != null && $fr->diskon_faktur != 0 ) : ?>
                            <tr>
                              <td> Diskon</td>
                              <td>Rp. 0,00</td>
                              <td>Rp. <?= rupiah($fr->diskon_faktur); ?></td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                        <?php

                          $akun->condition([
                            "id" => $akunbeli
                          ]);

                        ?>
                          <td> <?= '('.$akun->row('kode_akun').') - '.$akun->row('nama_akun') ?></td>
                          <td>Rp. 0,00</td>
                          <td>Rp. <?= rupiah($fr->grand_total); ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </table>
                  </div>
                </div>
              </div>
          <?php endif; ?>


          <?php
            $tr = new Tabledx;
            $tr->table('penjualan');
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

          <?php if ($tr->num_rows() != 0): ?>


            <div class="col-lg-12 col-12">
              <div class="small-box bg-white">
                <div class="inner">

                  <h5 style="font-weight: bold;">Jurnal Penjualan <span class="float-right">( <?= $tr->num_rows() ?> Transaksi )</span></h5>
                  <table class="table">
                    <tr style="background-color: #4c8bf5; color: white;">
                      <th>Akun</th>
                      <th>Debit</th>
                      <th>Kredit</th>
                    </tr>

                    <?php foreach ($tr->getResult() as $key => $fr): ?>
                      <tr style="background: #dff;">
                        <td colspan="3"><span style="color:#4c8bf5; font-weight: bold;">Journal Entry <?= $fr->no_nota ?></span> | <span style="color:#333; font-weight: bold;"> ( Create On <?= $fr->created_at ?> ) </span> </td>
                      </tr>
                      <?php
                        $tc = new Tabledx;
                        $tc->table('datapenjualan');
                        $tc->condition([
                          "penjualan_id" => $fr->id
                        ]);
                        $tax = 1;
                        $nomBar = 0;
                        $akunbeli = null;
                      ?>
                      <?php foreach ($tc->getResult() as $key => $fc): ?>
                        <?php
                          $fp = new Tabledx;
                          $fp->table('produk');
                          $fp->condition([
                            "id" => $fc->produk
                          ]);
                          $akunbeli = $fp->row("akun_penjualan");
                         ?>
                         <?php
                           $tax = $fp->row('pajak_pembelian');
                           $nomBar += $fc->jumlah;
                         ?>
                         <?php if ($key == 0): ?>
                           <?php
                           $akun = new Tabledx;
                           $akun->table("akun");
                           $akun->condition([
                             "id" => $akunbeli
                           ]);

                           ?>
                           <tr>
                             <td> <?= '('.$akun->row('kode_akun').') - '.$akun->row('nama_akun') ?></td>
                             <td>Rp. <?= rupiah($fr->grand_total); ?></td>
                             <td>Rp. 0,00</td>
                           </tr>
                           <?php if ($fr->diskon_faktur != NULL && $fr->diskon_faktur != 0): ?>
                            <tr>
                              <td> Diskon</td>
                              <td>Rp. <?= rupiah($fr->diskon_faktur); ?></td>
                              <td>Rp. 0,00</td>
                            </tr>
                           <?php endif; ?>
                           <?php if ($fr->ongkir != NULL): ?>
                            <tr>
                              <td> Ongkir</td>
                              <td>Rp. 0,00</td>
                              <td>Rp. <?= rupiah($fr->ongkir); ?></td>
                            </tr>
                           <?php endif; ?>
                           <?php if ($fr->pajak != NULL): ?>
                             <?php

                             $pajak = new Tabledx;
                             $pajak->table('pajak');
                             $pajak->condition([
                               "id" => $tax
                             ]);

                             $akun = new Tabledx;
                             $akun->table("akun");
                             $akun->condition([
                               "id" => $pajak->row("akun_pajak_penjualan")
                             ]);
                             ?>
                             <tr>
                               <td><?= '('.$akun->row('kode_akun').') - '.$akun->row('nama_akun') ?></td>
                               <td>Rp. 0,00</td>
                               <td>Rp. <?= rupiah($fr->total * ($pajak->row('persentase_efektif') / 100)); ?></td>
                             </tr>
                           <?php endif; ?>
                         <?php endif; ?>
                        <tr>
                          <td>(1-10200) - Persediaan Barang <br>  penjualan  <?= $fp->row('nama') ?></td>
                          <td>Rp. 0,00</td>
                          <td>Rp. <?= rupiah($fc->jumlah) ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php endforeach; ?>
                  </table>
                </div>
              </div>
            </div>

          <?php endif; ?>

            <div class="col-lg-12 col-12">
              <div class="small-box bg-white">
                <div class="inner">
                  <?php
                    $tr = new Tabledx;
                    $tr->table('biaya');
                    $tr->select(" * ");
                  ?>
                  <?php
                  if ($type == 1) {
                    $tr->condition([
                      "tanggal_transaksi" => date('Y-m-d')
                    ]);
                  }elseif ($type == 2) {
                    $tr->condition([
                      "tanggal_transaksi" => [
                        "opsi" => "LIKE",
                        "val" => date('Y-m')."%"
                      ]
                    ]);
                  }elseif ($type == 3) {
                    $tr->condition([
                      "tanggal_transaksi" => [
                        "opsi" => ">=",
                        "val" => $date1
                      ],
                      "tanggal_transaksi" => [
                        "opsi" => "<=",
                        "val" => $date2
                      ]
                    ]);
                  }
                  ?>
                  <h5 style="font-weight: bold;">Jurnal Biaya <span class="float-right">( <?= $tr->num_rows() ?> Transaksi )</span></h5>
                  <table class="table">
                    <tr style="background-color: #4c8bf5; color: white;">
                      <th>Akun</th>
                      <th>Debit</th>
                      <th>Kredit</th>
                    </tr>

                    <?php foreach ($tr->getResult() as $key => $fr): ?>
                      <tr style="background: #dff;">
                        <td colspan="3"><span style="color:#4c8bf5; font-weight: bold;">Journal Entry <?= $fr->no_biaya?></span> | <span style="color:#333; font-weight: bold;"> ( Create On <?= $fr->created_at ?> ) </span> </td>
                      </tr>
                      <?php
                        $tc = new Tabledx;
                        $tc->table('databiaya');
                        $tc->condition([
                          "biaya_id" => $fr->id
                        ]);
                        $tax = 1;
                        $nomBar = 0;
                        $akunbeli = null;

                        $akun = new Tabledx;
                        $akun->table("akun");

                      ?>
                      <?php foreach ($tc->getResult() as $key => $fc): ?>
                        <?php

                          $akun->condition([
                            "id" => $fc->akun_biaya
                          ]);

                        ?>
                        <tr>
                          <td><?= '('.$akun->row('kode_akun').') - '.$akun->row('nama_akun') ?></td>
                          <td>Rp. <?= rupiah($fc->jumlah) ?></td>
                          <td>Rp. 0,00</td>
                        </tr>
                      <?php endforeach; ?>
                      <?php

                        $akun->condition([
                          "id" => $fr->akun_pembayaran
                        ]);

                      ?>
                      <tr>
                        <td> <?= '('.$akun->row('kode_akun').') - '.$akun->row('nama_akun') ?></td>
                        <td>Rp. 0,00</td>
                        <td>Rp. <?= rupiah($fr->total) ?></td>
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
