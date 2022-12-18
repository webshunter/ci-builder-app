<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profile</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">

        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      <?php
                          link_button([
                              "link" => "admin/user/table_show/update/".datalogin('id'),
                              "class" => "btn btn-primary float-right",
                              "text" => "Ubah Profile",
                          ]);
                      ?>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-4">
                                <img width='100%' src="<?= base_url('assets/gambar/user/'.datalogin('foto')) ?>" alt="">
                            </div>
                            <div class="col-sm-8">
                              <table>
                                <tr>
                                  <td>Nama Pengguna</td>
                                  <td>:</td>
                                  <td><?= datalogin('nama') ?></td>
                                </tr>
                                <?php if (datalogin('level') != ""): ?>
                                  <?php

                                    $lv = datalogin('level');

                                    $level = $this->db->query("SELECT * FROM leveluser WHERE id = '$lv' ")->row()->pilihan;

                                  ?>
                                  <tr>
                                    <td>Level</td>
                                    <td>:</td>
                                    <td><?= $level ?></td>
                                  </tr>
                                <?php endif; ?>
                                <tr>
                                  <td>Username</td>
                                  <td>:</td>
                                  <td><?= datalogin('username') ?></td>
                                </tr>
                                <tr>
                                  <td>Password</td>
                                  <td>:</td>
                                  <td><?= datalogin('password') ?></td>
                                </tr>
                              </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
