<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Laporan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="row">
        <div class="col-12">
                    <div class="container">
                        <div class=row>
                            <div class="col-sm-12">
                              <div class="card card-primary card-outline card-tabs">
                                <div class="card-header p-0 pt-1 border-bottom-0">
                                  <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                    <li class="nav-item">
                                      <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Sekilas Bisnis</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="custom-tabs-two-penjualan-tab" data-toggle="pill" href="#custom-tabs-two-penjualan" role="tab" aria-controls="custom-tabs-two-penjualan" aria-selected="false">Penjualan</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="custom-tabs-two-pembelian-tab" data-toggle="pill" href="#custom-tabs-two-pembelian" role="tab" aria-controls="custom-tabs-two-pembelian" aria-selected="false">Pembelian</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="custom-tabs-two-produk-tab" data-toggle="pill" href="#custom-tabs-two-produk" role="tab" aria-controls="custom-tabs-two-produk" aria-selected="false">Produk</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="custom-tabs-two-asset-tab" data-toggle="pill" href="#custom-tabs-two-asset" role="tab" aria-controls="custom-tabs-two-asset" aria-selected="false">Asset</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="custom-tabs-two-bank-tab" data-toggle="pill" href="#custom-tabs-two-bank" role="tab" aria-controls="custom-tabs-two-bank" aria-selected="false">Bank</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="custom-tabs-two-pajak-tab" data-toggle="pill" href="#custom-tabs-two-pajak" role="tab" aria-controls="custom-tabs-two-pajak" aria-selected="false">Pajak</a>
                                    </li>
                                  </ul>
                                </div>
                                <div class="card-body">
                                  <div class="tab-content" id="custom-tabs-two-tabContent">
                                    <!-- home -->
                                    <div class="tab-pane fade active show" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                       <div class="row">
                                         <div class="col-sm-6 mb-3">
                                             <a href="<?= site_url('admin/laporan-jurnal')?>">
                                                 <h2>Jurnal</h2>
                                             </a>
                                             <p>Menampilan Jurnal Transaksi.</p>
                                             <a href="<?= site_url('admin/laporan-jurnal')?>" class="btn btn-primary"> Lihat Laporan</a>
                                         </div>
                                         <div class="col-sm-6 mb-3">
                                             <a href="#">
                                                 <h2>Neraca</h2>
                                             </a>
                                             <p>Menampilan apa yang anda miliki (aset), apa yang anda hutang (liabilitas), dan apa yang anda sudah investasikan pada perusahaan anda (ekuitas).</p>
                                             <a href="<?= site_url('admin/jurnal')?>" class="btn btn-primary"> Lihat Laporan</a>
                                         </div>
                                         <div class="col-sm-6 mb-3">
                                             <a href="#">
                                                 <h2>Laba Rugi</h2>
                                             </a>
                                             <p>Menampilkan laporan laba rugi .</p>
                                             <a href="<?= site_url('admin/jurnal')?>" class="btn btn-primary"> Lihat Laporan</a>
                                         </div>
                                       </div>
                                    </div>

                                    <!-- penjualan -->
                                    <div class="tab-pane fade" id="custom-tabs-two-penjualan" role="tabpanel" aria-labelledby="custom-tabs-two-penjualan-tab">
                                      <div class="row">
                                          <div class="col-sm-6 mb-3">
                                              <a href="<?= site_url('admin/list-penjualan')?>">
                                                  <h2>List Penjualan</h2>
                                              </a>
                                              <p>Menampilkan daftar kronologis semua faktur, pesanan, penawaran, dan pembayaran Anda untuk rentang tanggal yang dipilih.</p>
                                              <a href="<?= site_url('admin/list-penjualan')?>" class="btn btn-primary"> Lihat Laporan</a>
                                          </div>
                                          <div class="col-sm-6 mb-3">
                                              <a href="<?= site_url('admin/umur-piutang')?>">
                                                  <h2>Umur Piutang</h2>
                                              </a>
                                              <p>Laporan ini memberikan ringkasan piutang usaha Anda, menunjukkan setiap pelanggan berutang kepada Anda, berdasarkan bulanan, serta jumlah total dari waktu ke waktu. Praktis untuk membantu Anda melacak piutang Anda.</p>
                                              <a href="<?= site_url('admin/umur-piutang')?>" class="btn btn-primary"> Lihat Laporan</a>
                                          </div>
                                        </div>
                                     </div>


                                    <div class="tab-pane fade" id="custom-tabs-two-pembelian" role="tabpanel" aria-labelledby="custom-tabs-two-pembelian-tab">
                                      <div class="row">
                                          <div class="col-sm-6 mb-3">
                                              <a href="<?= site_url('admin/list-pembelian')?>">
                                                  <h2>List Pembelian</h2>
                                              </a>
                                              <p>Menampilkan daftar kronologis semua faktur, pesanan, penawaran, dan pembayaran Anda untuk rentang tanggal yang dipilih.</p>
                                              <a href="<?= site_url('admin/list-pembelian')?>" class="btn btn-primary"> Lihat Laporan</a>
                                          </div>
                                          <div class="col-sm-6 mb-3">
                                              <a href="<?= site_url('admin/umur-hutang')?>">
                                                  <h2>Umur hutang</h2>
                                              </a>
                                              <p>Laporan ini memberikan ringkasan hutang usaha Anda, menunjukkan hutang anda pada setiap supplier, berdasarkan bulanan, serta jumlah total dari waktu ke waktu. Praktis untuk membantu Anda melacak hutang Anda.</p>
                                              <a href="<?= site_url('admin/umur-hutang')?>" class="btn btn-primary"> Lihat Laporan</a>
                                          </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="custom-tabs-two-produk" role="tabpanel" aria-labelledby="custom-tabs-two-produk-tab">
                                      <div class="row">
                                          <div class="col-sm-6 mb-3">
                                              <a href="<?= site_url('admin/list-produk')?>">
                                                  <h2>List Produk</h2>
                                              </a>
                                              <p>Menampilkan daftar produk. </p>
                                              <a href="<?= site_url('admin/list-produk')?>" class="btn btn-primary"> Lihat Laporan</a>
                                          </div>
                                          <div class="col-sm-6 mb-3">
                                              <a href="<?= site_url('admin/laporan-persediaan')?>">
                                                  <h2>Persediaan</h2>
                                              </a>
                                              <p>Menampilkan laporan persediaan serta detail barang masuk dan detail barang keluar. </p>
                                              <a href="<?= site_url('admin/laporan-persediaan')?>" class="btn btn-primary"> Lihat Laporan</a>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="custom-tabs-two-asset" role="tabpanel" aria-labelledby="custom-tabs-two-asset-tab">
                                      <div class="row">
                                          <div class="col-sm-6 mb-3">
                                              <a href="<?= site_url('admin/jurnal')?>">
                                                  <h2>List Penjualan</h2>
                                              </a>
                                              <p>Menampilkan daftar kronologis semua faktur, pesanan, penawaran, dan pembayaran Anda untuk rentang tanggal yang dipilih.</p>
                                              <a href="<?= site_url('admin/jurnal')?>" class="btn btn-primary"> Lihat Laporan</a>
                                          </div>
                                          <div class="col-sm-6 mb-3">
                                              <a href="<?= site_url('admin/jurnal')?>">
                                                  <h2>Umur Piutang</h2>
                                              </a>
                                              <p>Laporan ini memberikan ringkasan piutang usaha Anda, menunjukkan setiap pelanggan berutang kepada Anda, berdasarkan bulanan, serta jumlah total dari waktu ke waktu. Praktis untuk membantu Anda melacak piutang Anda.</p>
                                              <a href="<?= site_url('admin/jurnal')?>" class="btn btn-primary"> Lihat Laporan</a>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-two-bank" role="tabpanel" aria-labelledby="custom-tabs-two-bank-tab">
                                      <div class="row">
                                          <div class="col-sm-6 mb-3">
                                              <a href="<?= site_url('admin/jurnal')?>">
                                                  <h2>List Penjualan</h2>
                                              </a>
                                              <p>Menampilkan daftar kronologis semua faktur, pesanan, penawaran, dan pembayaran Anda untuk rentang tanggal yang dipilih.</p>
                                              <a href="<?= site_url('admin/jurnal')?>" class="btn btn-primary"> Lihat Laporan</a>
                                          </div>
                                          <div class="col-sm-6 mb-3">
                                              <a href="<?= site_url('admin/jurnal')?>">
                                                  <h2>Umur Piutang</h2>
                                              </a>
                                              <p>Laporan ini memberikan ringkasan piutang usaha Anda, menunjukkan setiap pelanggan berutang kepada Anda, berdasarkan bulanan, serta jumlah total dari waktu ke waktu. Praktis untuk membantu Anda melacak piutang Anda.</p>
                                              <a href="<?= site_url('admin/jurnal')?>" class="btn btn-primary"> Lihat Laporan</a>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-two-pajak" role="tabpanel" aria-labelledby="custom-tabs-two-pajak-tab">
                                      <div class="row">
                                          <div class="col-sm-6 mb-3">
                                              <a href="<?= site_url('admin/jurnal')?>">
                                                  <h2>List Penjualan</h2>
                                              </a>
                                              <p>Menampilkan daftar kronologis semua faktur, pesanan, penawaran, dan pembayaran Anda untuk rentang tanggal yang dipilih.</p>
                                              <a href="<?= site_url('admin/jurnal')?>" class="btn btn-primary"> Lihat Laporan</a>
                                          </div>
                                          <div class="col-sm-6 mb-3">
                                              <a href="<?= site_url('admin/jurnal')?>">
                                                  <h2>Umur Piutang</h2>
                                              </a>
                                              <p>Laporan ini memberikan ringkasan piutang usaha Anda, menunjukkan setiap pelanggan berutang kepada Anda, berdasarkan bulanan, serta jumlah total dari waktu ke waktu. Praktis untuk membantu Anda melacak piutang Anda.</p>
                                              <a href="<?= site_url('admin/jurnal')?>" class="btn btn-primary"> Lihat Laporan</a>
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- /.card -->
                              </div>
                            </div>
                        </div>
                    </div>
        </div>
      </div>
    </section>
</div>
    <!-- /.content-header -->
