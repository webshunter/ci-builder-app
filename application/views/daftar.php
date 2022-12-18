<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar Lainnya</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('toko') }}">Home</a></li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h1>Umum</h1>
                        <hr>
                        <div class=row>
                            <div class="col-sm-6">
                                <a href="<?= site_url('admin/satuan'); ?>">
                                    <h3>Satuan Barang</h3>
                                </a>
                                <p>Menampilkan data satuan barang.</p>
                            </div>
                            <!-- <div class="col-sm-6">
                                <a href="<?= site_url('admin/tipekontak'); ?>">
                                    <h3>Tipe Kontak</h3>
                                </a>
                                <p>Menampilkan data tipe kontak.</p>
                            </div> -->
                            <div class="col-sm-6">
                                <a href="<?= site_url('admin/goupkontak'); ?>">
                                    <h3>Grup Kontak</h3>
                                </a>
                                <p>Menampilkan data grup kontak.</p>
                            </div>
                            <div class="col-sm-6">
                                <a href="<?= site_url('admin/leveluser'); ?>">
                                    <h3>Level User</h3>
                                </a>
                                <p>Menampilkan data Level User.</p>
                            </div>
                            <div class="col-sm-6">
                                <a href="<?= site_url('admin/identitas'); ?>">
                                    <h3>Identitas</h3>
                                </a>
                                <p>Menampilkan data tipe identitas.</p>
                            </div>
                            <div class="col-sm-6">
                                <a href="<?= site_url('admin/kategoriproduk'); ?>">
                                    <h3>Kategori Produk</h3>
                                </a>
                                <p>Menampilkan data tipe kategori produk.</p>
                            </div>
                            <div class="col-sm-6">
                                <a href="<?= site_url('admin/paymen_method'); ?>">
                                    <h3>Cara Pembayaran</h3>
                                </a>
                                <p>Menampilkan cara pembayaran yang Anda pakai atau dipakai oleh Supplier Anda</p>
                            </div>
                            <div class="col-sm-6">
                                <a href="<?= site_url('admin/termin'); ?>">
                                    <h3>Syarat Pembayaran</h3>
                                </a>
                                <p>Menampilkan data syarat pembayaran</p>
                            </div>
                            <div class="col-sm-6">
                                <a href="<?= site_url('admin/gudang'); ?>">
                                    <h3>Gudang</h3>
                                </a>
                                <p>Menampilkan data gudang yang tersedia</p>
                            </div>
                        </div>
                        <h1>Accounting</h1>
                        <hr>
                        <div class=row>
                          <div class="col-sm-6">
                              <a href="<?= site_url('admin/pajak'); ?>">
                                  <h3>Pajak</h3>
                              </a>
                              <p>Menampilkan tipe-tipe pajak yang Anda pakai untuk penjualan kepada pelanggan atau pembelian dari supplier.</p>
                          </div>
                          <div class="col-sm-6">
                              <a href="<?= site_url('admin/kategoriakun'); ?>">
                                  <h3>Kategori Akun</h3>
                              </a>
                              <p>Menampilkan data kategori akun.</p>
                          </div>
                        </div>
                        <h1>Transaksi</h1>
                        <hr>
                        <div class=row>
                            <div class="col-sm-6">
                                <a href="<?= site_url('admin/matrikjual'); ?>">
                                    <h3>Matrik Penjualan</h3>
                                </a>
                                <p>Menampilkan data matrik penjualan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>
    <!-- /.content-header -->
