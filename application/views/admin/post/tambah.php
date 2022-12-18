<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambahkan Post</h1>
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
                    <form action="<?= site_url('admin/post/simpan') ?>" method="post" enctype="multipart/form-data">

                <?=
                    form::input([
                        "title" => "No Post",
                        "type" => "text",
                        "fc" => "no_post",
                        "readonly" => true,
                        "placeholder" => "tambahkan no_post",
                        "value" => $code
                    ])
                ?>

                <?=
                    form::input([
                        "title" => "Judul",
                        "type" => "text",
                        "fc" => "judul",
                        "placeholder" => "tambahkan judul",
                    ])
                ?>

                <script type="text/javascript">
                  $("#judul").slug()
                </script>

                <?=
                    form::input([
                        "title" => "Slug",
                        "type" => "text",
                        "readonly" => true,
                        "fc" => "slug",
                        "placeholder" => "tambahkan slug",
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
                    ])
                ?>

                <?=
                    form::input([
                        "title" => "Thumbnails",
                        "type" => "file",
                        "show-image" => true,
                        "required" => true,
                        "fc" => "thumbnails",
                        "placeholder" => "tambahkan thumbnails",
                    ])
                ?>

                <?=
                    form::input([
                        "title" => "Tanggal",
                        "type" => "date",
                        "fc" => "tanggal",
                        "placeholder" => "tambahkan tanggal",
                        "value" => date('Y-m-d'),
                    ])
                ?>

                <?=
                    form::input([
                        "title" => "Tag",
                        "type" => "text",
                        "fc" => "tag",
                        "tag" => true,
                        "placeholder" => "tambahkan tag",
                    ])
                ?>

                <?=
                    form::input([
                        "title" => "keyword",
                        "type" => "text",
                        "fc" => "keyword",
                        "placeholder" => "tambahkan keyword",
                    ])
                ?>

                <?=
                    form::editor([
                        "title" => "Deskripsi",
                        "type" => "text",
                        "fc" => "deskripsi",
                        "text-area" => true,
                        "placeholder" => "tambahkan deskripsi",
                    ])
                ?>

                <hr>
                <h3 class="text-center">Content</h3>

                <div id="produk-list">

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
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <a class="btn btn-default" href="<?= site_url('admin/post'); ?>">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>
