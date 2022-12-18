<style>
    .CodeMirror {
  border: 1px solid #eee;
  height: auto;
}
#simpan{
  position: fixed;
  right: 20px;
  bottom: 50px;
  z-index: 99999;
  border-radius: 20px;
  border: 4px solid #fff;
  box-shadow: 0 0 10px #ddd;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ubah Post</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('toko') }}">Home</a></li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="postid" action="<?= site_url('admin/post/update') ?>" method="post" enctype="multipart/form-data">

        <?=
            form::input([
                "type" => "hidden",
                "fc" => "id",
                "value" => $form_data->id,
            ])
        ?>

                <?=
                    form::input([
                        "title" => "No Post",
                        "type" => "text",
                        "fc" => "no_post",
                        "readonly" => true,
                        "placeholder" => "tambahkan no_post",
                        "value" => $form_data->no_post,
                    ])
                ?>

                <?=
                    form::input([
                        "title" => "Judul",
                        "type" => "text",
                        "fc" => "judul",
                        "placeholder" => "tambahkan judul",
                        "value" => $form_data->judul,
                    ])
                ?>

                <?=
                    form::input([
                        "title" => "Slug",
                        "type" => "text",
                        "readonly" => true,
                        "fc" => "slug",
                        "placeholder" => "tambahkan slug",
                        "value" => $form_data->slug,
                    ])
                ?>

                <?=
                    form::select_db([
                        "title" => "Kategori",
                        "type" => "password",
                        "fc" => "kategori",
                        "placeholder" => "tambahkan kategori",
                        "db" => "kategori",
                        "data" => "id",
                        "name" => "pilihan",
                        "selected" => $form_data->kategori,
                    ])
                ?>

                <?=
                    form::input([
                        "title" => "Thumbnails",
                        "type" => "file",
                        "show-image" => true,
                        "fc" => "thumbnails",
                        "placeholder" => "tambahkan thumbnails",
                        "value" => $form_data->thumbnails,
                    ])
                ?>

                <?=
                    form::input([
                        "title" => "Tanggal",
                        "type" => "date",
                        "fc" => "tanggal",
                        "placeholder" => "tambahkan tanggal",
                        "value" => $form_data->tanggal,
                    ])
                ?>

                <?=
                    form::input([
                        "title" => "Tag",
                        "type" => "text",
                        "fc" => "tag",
                        "tag" => true,
                        "placeholder" => "tambahkan tag",
                        "value" => $form_data->tag,
                    ])
                ?>

                <?=
                    form::input([
                        "title" => "keyword",
                        "type" => "text",
                        "fc" => "keyword",
                        "placeholder" => "tambahkan keyword",
                        "value" => $form_data->keyword,
                    ])
                ?>

                <?=
                    form::editor([
                        "title" => "Deskripsi",
                        "type" => "text",
                        "fc" => "deskripsi",
                        "text-area" => true,
                        "placeholder" => "tambahkan deskripsi",
                        "value" => $form_data->deskripsi,
                    ])
                ?>

                <hr>
                <h3 class="text-center">Content</h3>

                <?php

                  $this->load->model("Tabledx");

                  $tx = new Tabledx;
                  $tx->table("datapost");
                  $tx->condition([
                    "post_id" => $form_data->id
                  ]);

                ?>

                <div id="produk-list">
                  <?php foreach ($tx->getResult() as $key => $value): ?>
                    <?php $tipe = $value->tipe_kontent; ?>
                    <?php $urutan = $key + 1; ?>
                    <div id="td-close<?= $urutan ?>" class="row" data-no="<?= $urutan ?>">
                      <div class="col-sm-12">
                        <input type="hidden" name="databarangpembelian[<?= $urutan ?>][tipe_kontent]" value="<?= $tipe ?>">
                        <?php if ($tipe == 1): ?>
                          <?=
                            form::editor([
                              "type" => "text",
                              "fc" => "databarangpembelian[$urutan][kontent]",
                              "placeholder" => "tambahkan tag",
                              "value" => json_decode($value->kontent)
                            ])
                          ?>
                        <?php elseif ($tipe == 2): ?>
                          <?=
                            form::input([
                              "type" => "text",
                              "fc" => "databarangpembelian[$urutan][kontent]",
                              "required" => true,
                              "tag" => true,
                              "placeholder" => "inputkan file",
                              "value" => $value->kontent
                            ])
                          ?>
                        <?php elseif ($tipe == 3 || $tipe == 4): ?>
                          <?=
                            form::editor([
                              "type" => "text",
                              "fc" => "databarangpembelian[$urutan][kontent]",
                              "tag" => true,
                              "codeeditor" => true,
                              "placeholder" => "tambahkan tag",
                              "value" => json_decode($value->kontent)
                            ])
                          ?>
                        <?php elseif ($tipe == 5): ?>
                            <?=
                              form::input([
                                "type" => "text",
                                "fc" => "databarangpembelian[$urutan][kontent]",
                                "required" => true,
                                "show-image" => true,
                                "placeholder" => "inputkan image",
                                "value" => $value->kontent
                              ])
                            ?>
                          <?php elseif ($tipe == 6): ?>
                              <?=
                                form::input([
                                  "type" => "text",
                                  "readonly" => true,
                                  "fc" => "databarangpembelian[$urutan][kontent]",
                                  "placeholder" => "inputkan image",
                                  "value" => "adpaylink",
                                ])
                              ?>
                          <?php elseif ($tipe == 7): ?>
                              <?=
                                form::input([
                                  "type" => "text",
                                  "readonly" => true,
                                  "fc" => "databarangpembelian[$urutan][kontent]",
                                  "placeholder" => "inputkan image",
                                  "value" => "propeller",
                                ])
                              ?>
                          <?php elseif ($tipe == 8): ?>
                            <?=
                              form::editor([
                                "type" => "text",
                                "fc" => "databarangpembelian[$urutan][kontent]",
                                "tag" => true,
                                "codeeditor" => true,
                                "placeholder" => "tambahkan tag",
                                "value" => json_decode($value->kontent)
                              ])
                            ?>
                            <?php elseif ($tipe == 9): ?>
                            <?=
                              form::editor([
                                "type" => "text",
                                "fc" => "databarangpembelian[$urutan][kontent]",
                                "tag" => true,
                                "codeeditor" => true,
                                "placeholder" => "tambahkan tag",
                                "value" => json_decode($value->kontent)
                              ])
                            ?>
                            <?php elseif ($tipe == 10): ?>
                            <?=
                              form::editor([
                                "type" => "text",
                                "fc" => "databarangpembelian[$urutan][kontent]",
                                "tag" => true,
                                "codeeditor" => true,
                                "placeholder" => "tambahkan tag",
                                "value" => json_decode($value->kontent)
                              ])
                            ?>
                        <?php endif; ?>
                        <button type="button" class="btn btn-primary" onclick="document.querySelector('#td-close<?= $urutan ?>').remove()" name="button">Hapus Content</button>
                      </div>
                    </div>

                  <?php endforeach; ?>
                </div>

                <div class="text-center mb-5">
                  <div class="row d-flex justify-content-center">
                    <div class="col-12 col-sm-4">
                      <?=
                      form::select_db([
                        "type" => "password",
                        "fc" => "tipe_kontent",
                        "placeholder" => "tambahkan kategori",
                        "db" => "tipekontent",
                        "data" => "id",
                        "name" => "pilihan",
                        "selected" => "1",
                      ])
                      ?>
                    </div>
                    <div class="col-12 col-sm-4">
                      <button type="button" id="tambah-barang" class="btn btn-primary floa-left"><i class="fas fa-plus"></i> Tambah Biaya</button>
                    </div>
                  </div>
                </div>

                <script>

                   $(document).on('click', '#tambah-barang', function(){

                       var sl = Array.from(document.querySelectorAll('[data-no]'));

                       var pl = sl.length + 1;

                       console.log(sl);

                       $.ajax({
                           url: '<?= site_url('admin/post/temp/')?>'+pl+'/'+$("#tipe_kontent").val(),
                           success:function(res){
                               $("#produk-list").append(res)
                           }
                       })
                   })

               </script>

                        <div class="form-group">
                          <button type="button" id="simpan" class="btn btn-primary">Simpan</button>
                          <a class="btn btn-default" href="<?= site_url('admin/post'); ?>">Back</a>
                        </div>
                    </form>
                    <script>
                        
                        $("#simpan").click(function(){        
                            $.post("<?= site_url('admin/post/update') ?>", $("#postid").serialize(), function(data) {
                                alert('simpan');
                            });
                        });
                        
                    </script>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>
