<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah film</h1>
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
                    <form action="<?= site_url('eadmin/film/simpan') ?>" method="post" enctype="multipart/form-data">
                        
                <?=
                    form::input([
                        "title" => "cover",
                        "type" => "file",
                        "fc" => "cover",
                        "placeholder" => "tambahkan cover",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "judul",
                        "type" => "text",
                        "fc" => "judul",
                        "placeholder" => "tambahkan judul",
                    ])
                ?>
            
                <?=
                    form::editor([
                        "title" => "deskripsi",
                        "type" => "text",
                        "fc" => "deskripsi",
                        "placeholder" => "tambahkan deskripsi",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "producer",
                        "type" => "text",
                        "fc" => "producer",
                        "placeholder" => "tambahkan producer",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "director",
                        "type" => "text",
                        "fc" => "director",
                        "placeholder" => "tambahkan director",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "writer",
                        "type" => "text",
                        "fc" => "writer",
                        "placeholder" => "tambahkan writer",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "cast",
                        "type" => "text",
                        "fc" => "cast",
                        "placeholder" => "tambahkan cast",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "distributor",
                        "type" => "text",
                        "fc" => "distributor",
                        "placeholder" => "tambahkan distributor",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "website",
                        "type" => "text",
                        "fc" => "website",
                        "placeholder" => "tambahkan website",
                    ])
                ?>
            
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <a class="btn btn-default" href="<?= site_url('eadmin/film'); ?>">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>