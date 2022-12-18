<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ubah datapost</h1>
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
                    <form action="<?= site_url('admin/datapost/update') ?>" method="post" enctype="multipart/form-data">
                        
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
                        "fc" => "post_id",
                        "placeholder" => "tambahkan post_id",
                        "value" => $form_data->post_id,
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "Judul",
                        "type" => "text",
                        "fc" => "tipe_kontent",
                        "placeholder" => "tambahkan tipe_kontent",
                        "value" => $form_data->tipe_kontent,
                    ])
                ?>
            
                <?=
                    form::editor([
                        "title" => "Slug",
                        "type" => "text",
                        "fc" => "kontent",
                        "placeholder" => "tambahkan kontent",
                        "value" => $form_data->kontent,
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "Kategori",
                        "type" => "text",
                        "fc" => "created_at",
                        "placeholder" => "tambahkan created_at",
                        "value" => $form_data->created_at,
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "Thumbnails",
                        "type" => "text",
                        "fc" => "updated_at",
                        "placeholder" => "tambahkan updated_at",
                        "value" => $form_data->updated_at,
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "Tanggal",
                        "type" => "text",
                        "fc" => "delete_set",
                        "placeholder" => "tambahkan delete_set",
                        "value" => $form_data->delete_set,
                    ])
                ?>
            
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <a class="btn btn-default" href="<?= site_url('admin/datapost'); ?>">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>

