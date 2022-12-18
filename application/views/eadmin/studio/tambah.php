<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Studio</h1>
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
                    <form action="<?= site_url('eadmin/studio/simpan') ?>" method="post" enctype="multipart/form-data">
                        
                <?=
                    form::input([
                        "title" => "Foto",
                        "type" => "file",
                        "fc" => "foto",
                        "placeholder" => "tambahkan foto",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => " Nama",
                        "type" => "text",
                        "fc" => "nama",
                        "placeholder" => "tambahkan nama",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => " Theaters",
                        "type" => "text",
                        "fc" => "theaters",
                        "placeholder" => "tambahkan theaters",
                    ])
                ?>
            
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <a class="btn btn-default" href="<?= site_url('eadmin/studio'); ?>">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>