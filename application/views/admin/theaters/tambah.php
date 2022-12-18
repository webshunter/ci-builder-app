<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Theater</h1>
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
                    <form action="<?= site_url('admin/theaters/simpan') ?>" method="post" enctype="multipart/form-data">
                        
                <?=
                    form::input([
                        "title" => " Alamat",
                        "type" => "text",
                        "fc" => "nama",
                        "placeholder" => "tambahkan nama",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => " Lokasi",
                        "type" => "text",
                        "fc" => "alamat",
                        "placeholder" => "tambahkan alamat",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => " Telp",
                        "type" => "text",
                        "fc" => "lokasi",
                        "placeholder" => "tambahkan lokasi",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "",
                        "type" => "text",
                        "fc" => "telp ",
                        "placeholder" => "tambahkan telp ",
                    ])
                ?>
            
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <a class="btn btn-default" href="<?= site_url('admin/theaters'); ?>">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>