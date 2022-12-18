<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ubah oto</h1>
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
                    <form action="<?= site_url('admin/oto/update') ?>" method="post" enctype="multipart/form-data">
                        
        <?=
            form::input([
                "type" => "hidden",
                "fc" => "id",
                "value" => $form_data->id,
            ])
        ?>
    
                <?=
                    form::input([
                        "title" => "tabel",
                        "type" => "text",
                        "fc" => "tbl",
                        "placeholder" => "tambahkan tbl",
                        "value" => $form_data->tbl,
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "row",
                        "type" => "text",
                        "fc" => "rw",
                        "tag" => true,
                        "placeholder" => "tambahkan rw",
                        "value" => $form_data->rw,
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "row tipe",
                        "type" => "text",
                        "fc" => "rwt",
                        "placeholder" => "tambahkan rwt",
                        "value" => $form_data->rwt,
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "row tipe 2",
                        "type" => "text",
                        "fc" => "rwt2",
                        "placeholder" => "tambahkan rwt2",
                        "value" => $form_data->rwt2,
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "row name",
                        "type" => "text",
                        "fc" => "rwn",
                        "tag" => true,
                        "placeholder" => "tambahkan rwn",
                        "value" => $form_data->rwn,
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "Form name",
                        "type" => "text",
                        "fc" => "nf",
                        "tag" => true,
                        "placeholder" => "tambahkan nf",
                        "value" => $form_data->nf,
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "view",
                        "type" => "text",
                        "fc" => "vw",
                        "placeholder" => "tambahkan vw",
                        "value" => $form_data->vw,
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "edit",
                        "type" => "text",
                        "fc" => "edt",
                        "placeholder" => "tambahkan edt",
                        "value" => $form_data->edt,
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "new",
                        "type" => "text",
                        "fc" => "nw",
                        "placeholder" => "tambahkan nw",
                        "value" => $form_data->nw,
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "comand",
                        "type" => "text",
                        "fc" => "cmd",
                        "placeholder" => "tambahkan cmd",
                        "value" => $form_data->cmd,
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "show table",
                        "type" => "text",
                        "fc" => "sh",
                        "tag" => true,
                        "placeholder" => "tambahkan sh",
                        "value" => $form_data->sh,
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

