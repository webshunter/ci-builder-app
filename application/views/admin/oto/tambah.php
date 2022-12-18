<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambahkan oto</h1>
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
                    <form action="<?= site_url('admin/oto/simpan') ?>" method="post" enctype="multipart/form-data">
                        
                <?=
                    form::input([
                        "title" => "tabel",
                        "type" => "text",
                        "fc" => "tbl",
                        "placeholder" => "tambahkan tbl",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "row",
                        "type" => "text",
                        "fc" => "rw",
                        "tag" => true,
                        "placeholder" => "tambahkan rw",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "row tipe",
                        "type" => "text",
                        "fc" => "rwt",
                        "placeholder" => "tambahkan rwt",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "row tipe 2",
                        "type" => "text",
                        "fc" => "rwt2",
                        "placeholder" => "tambahkan rwt2",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "row name",
                        "type" => "text",
                        "fc" => "rwn",
                        "tag" => true,
                        "placeholder" => "tambahkan rwn",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "Form name",
                        "type" => "text",
                        "fc" => "nf",
                        "tag" => true,
                        "placeholder" => "tambahkan nf",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "view",
                        "type" => "text",
                        "fc" => "vw",
                        "placeholder" => "tambahkan vw",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "edit",
                        "type" => "text",
                        "fc" => "edt",
                        "placeholder" => "tambahkan edt",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "new",
                        "type" => "text",
                        "fc" => "nw",
                        "placeholder" => "tambahkan nw",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "comand",
                        "type" => "text",
                        "fc" => "cmd",
                        "placeholder" => "tambahkan cmd",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "show table",
                        "type" => "text",
                        "tag" => true,
                        "fc" => "sh",
                        "placeholder" => "tambahkan sh",
                    ])
                ?>
            
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <a class="btn btn-default" href="<?= site_url('admin/oto'); ?>">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>